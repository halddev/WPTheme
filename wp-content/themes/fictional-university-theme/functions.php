<?php

require get_theme_file_path('/inc/like-route.php');
require get_theme_file_path('/inc/search-route.php');

//Adding custom field/property for use in the REST API - used in Search.js
function university_custom_rest()
{
    //params:
    //  - Object type to modify
    //  - Field to add
    //  - Array with anon. function to get value of field
    register_rest_field('post', 'authorName', array(
        'get_callback' => function () {
            return get_the_author();}
    ));

    register_rest_field('note', 'userNoteCount', array(
        'get_callback' => function () {
            return count_user_posts(get_current_user_id(), 'note');}
    ));
}

add_action('rest_api_init', 'university_custom_rest');

//========Page Banner==========
function pageBanner($args = NULL)
{

    if (!$args['title']) {
        $args['title'] = get_the_title();
    }

    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!$args['photo']) {
        if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }


?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle']; ?></p>
            </div>
        </div>
    </div>
<?php }


//==========Stylesheets, scripts etc in WP (not done in header or footer in WP)=========================
//Automated using node.js
function university_files()
{
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyDIjUH3P_Ac5beO8bjmgO1Obsj3dbwi4Ro', NULL, '1.0', true);

    if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
        wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
    } else {
        wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.9f081058b0665e3bdd11.js'), NULL, '1.0', true);
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.57dec199a038fb72a090.js'), NULL, '1.0', true);
        wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.57dec199a038fb72a090.css'));
    }

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'university_files');

//===============Various features===================
function university_features()
{
    add_theme_support('title-tag'); //Have WP generate title for us:
    add_theme_support('post-thumbnails'); //Enable featured images (thumbnails) for blog posts

    //Add custom image sizes:
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'university_features');
//==============End of various features===============


//==============Adjusting default queries============= 

function university_adjust_queries($query)
{
    // Adjust campus-archive query (number of pins on map)
    if (!is_admin() && is_post_type_archive('campus') && $query->is_main_query()) {
        $query->set('posts_per_apge', -1);
    }
    // Adjust program-archive query
    if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_apge', -1);
    }


    // Adjusting query in events-archive:
    if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');

        $today = date('Ymd');
        $query->set('meta_query', array(
            //Only return events if event_date is later than today's date:
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }
}

//Adjusting queries just before getting posts
add_action('pre_get_posts', 'university_adjust_queries');


//Key for Google APIs
function universityMapKey($api)
{
    $api['key'] = 'AIzaSyDIjUH3P_Ac5beO8bjmgO1Obsj3dbwi4Ro';
    return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');


// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend()
{
    $ourCurrentUser = wp_get_current_user();

    if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}

//Remove admin bar for subscribers
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
    $ourCurrentUser = wp_get_current_user();

    if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}

//Customize login screen - redirect to frontend instead of WP.org upon clicking logo
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl()
{
    return esc_url(site_url('/'));
}

//Customize login screen - Changing logo, font and styles through CSS
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS()
{
    wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.57dec199a038fb72a090.css'));
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

//Customize login screen - Change header title
add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle()
{
    return get_bloginfo('name');
}

// Force note posts to be private
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr)
{
    if ($data['post_type'] == 'note') {
        if (count_user_posts(get_current_user_id(), 'note') > 4 and !$postarr['ID']) {
            die("You have reached your note limit.");
        }

        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field($data['post_title']);
    }

    if ($data['post_type'] == 'note' && $data['post_status'] != 'trash') {
        $data['post_status'] = 'private';
    }

    return $data;
}

//Ignore files/folders when exporting for hosting
add_filter('ai1wm_exclude_content_from_export', 'ignoreCertainFiles');

function ignoreCertainFiles($exclude_filters) {
    $exclude_filters[] = 'themes/fictional-university-theme/node_modules';
    return $exclude_filters;
}