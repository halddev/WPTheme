<?php
get_header();
while (have_posts()) {
    the_post();
    pageBanner();
?>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses </a> <span class="metabox__main"><?php the_title(); ?></span></p>
        </div>

        <div class="generic-content"><?php the_content(); ?></div>

        <!--Google map (doesn't quite work)-->
        <?php
        $mapLocation = get_field('map_location');
        ?>

        <div class="acf-map">
            <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
                <h3><?php the_title(); ?></h3>
                <?php echo $mapLocation['address']; ?>
            </div>
        </div>

        <?php
        //Related Professors
        $relatedPrograms = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'program',
            //Order by custom event_date, ascending (most recent post at bottom):
            'orderby' => 'title',
            'order' => 'ASC',
            //Additional 'filters'
            'meta_query' => array(
                //Only return events if event_date is later than today's date:
                array(
                    'key' => 'related_campus',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));
        //Check if there are related events
        if ($relatedPrograms->have_posts()) {
            echo "<hr class='section-break'>";
            echo "<h2 class='headline headline--medium'>Programs Available At This Campus</h2>";

            echo "<ul class='min-list link-list'>";
            while ($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
        <?php }
            echo "</ul>";
            wp_reset_postdata();
        }

        ?>

    </div>

<?php }
get_footer();
?>