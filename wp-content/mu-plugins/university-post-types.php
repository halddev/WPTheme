<?php


function university_post_types()
{
    //Campus Post type:
    register_post_type('campus', array(
        'capability_type' => 'campus',   //Give events separate permissions instead
        'map_meta_cap' => true,         // of using 'posts' permissions
        'show_in_rest' => 'true', //use modern block editor for this post type (also requires 'editor' below)
        'supports' => array('title', 'editor', 'excerpt'), //adding excerpt field
        'rewrite' => array('slug' => 'campuses'), //Rewriting slug
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));

    //Event Post type:
    register_post_type('event', array(
        'capability_type' => 'event',   //Give events separate permissions instead
        'map_meta_cap' => true,         // of using 'posts' permissions
        'show_in_rest' => 'true', //use modern block editor for this post type (also requires 'editor' below)
        'supports' => array('title', 'editor', 'excerpt'), //adding excerpt field
        'rewrite' => array('slug' => 'events'), //Rewriting slug
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    //Programs Post Type:
    register_post_type('program', array(
        'show_in_rest' => 'true', //use modern block editor for this post type (also requires 'editor' below)
        'supports' => array('title'),
        'rewrite' => array('slug' => 'programs'), //Rewriting slug
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));

    //Professor Post Type
    register_post_type('professor', array(
        'show_in_rest' => 'true', //use modern block editor for this post type (also requires 'editor' below)
        'supports' => array('title', 'editor', 'thumbnail'), //adding thumbnail (featured image)
        'public' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));

    //Note Post Type
    register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'show_in_rest' => 'true', //allow in REST API and modern block editor (also requires 'editor' below)
        'supports' => array('title', 'editor'), //adding thumbnail (featured image)
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    ));

    //Like Post Type
    register_post_type('like', array(
        'supports' => array('title'), //adding thumbnail (featured image)
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all_items' => 'All Likes',
            'singular_name' => 'Like'
        ),
        'menu_icon' => 'dashicons-heart'
    ));
}




add_action('init', 'university_post_types');
