<?php

get_header();
pageBanner(array(
    'title' => 'All programs',
    'subtitle' => 'There is something for everyone. Have a look around.'
));

?>

<div class="container container--narrow page-section">
    <ul class="link-list min-list">
        <?php
        //WP's "The loop", looping through all posts one by one and listing them
        while (have_posts()) {
            the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

        <?php }
        //pagination
        echo paginate_links();
        ?>
    </ul>

</div>

<?php get_footer(); ?>