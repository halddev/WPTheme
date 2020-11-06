<?php

get_header();
pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events.'
));

?>

<div class="container container--narrow page-section">
    <?php
    //WP's "The loop", looping through all posts one by one and listing them

    $today = date('Ymd');
    $pastEvents = new WP_Query(array(
        'paged' => get_query_var('paged', 1), //Pagination
        'post_type' => 'event',
        //Order by custom event_date, ascending (most recent post at bottom):
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        //Additional 'filters'
        'meta_query' => array(
            //Only return events if event_date is later than today's date:
            array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
            )
        )
    ));

    while ($pastEvents->have_posts()) {
        $pastEvents->the_post();
        get_template_part('template-parts/content', 'event'); //get file named 'content-event'.
    }
    //pagination - done manually due to custom query
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages
    ));
    ?>


</div>

<?php get_footer(); ?>