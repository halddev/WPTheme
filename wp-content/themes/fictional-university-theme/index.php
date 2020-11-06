<?php

get_header();
pageBanner(array(
  'title' => 'Welcome to our blog!',
  'subtitle' => 'Keep up with our latest news'
));

?>

<div class="container container--narrow page-section">
  <?php
  //WP's "The loop", looping through all posts one by one and listing them
  while (have_posts()) {
    the_post(); ?>
    <div class="post-item">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F jS, Y') ?> in <?php echo get_the_category_list(', '); ?></p>
      </div>

      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a class="btn btn--blue" href="<?php echo the_permalink(); ?>">Continue reading</a></p>
      </div>

    </div>

  <?php }
  //pagination
  echo paginate_links();
  ?>


</div>

<?php get_footer(); ?>