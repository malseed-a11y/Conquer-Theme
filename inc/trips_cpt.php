<?php

/**
 * Plugin Name: Trips CPT + JWT REST API
 * Description: Registers Trips CPT, taxonomies, and JWT-protected REST API endpoints.
 * Version: 1.0
 * Author: ChatGPT
 */



//==========================
// Exit if accessed directly
if (!defined('ABSPATH')) exit;
//==========================






// ===========================
// CPT & Taxonomies
// ===========================
add_action('init', function () {





    // CPT Trips
    $labels = array(
        'name' => 'Trips',
        'singular_name' => 'Trip',
        'menu_name' => 'Trips',
        'add_new_item' => 'Add New Trip',
        'edit_item' => 'Edit Trip',
        'all_items' => 'All Trips',
        'view_item' => 'View Trip',
        'search_items' => 'Search Trips',
        'not_found' => 'No trips found',
        'not_found_in_trash' => 'No trips found in Trash',
    );
    register_post_type('trip', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'taxonomies' => array('trip_category', 'trip_tag'),
        'rewrite' => array('slug' => 'trips'),
    ));

    // Trip Categories
    register_taxonomy('trip_category', 'trip', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Trip Categories',
            'singular_name' => 'Trip Category',
            'search_items' => 'Search Trip Categories',
            'all_items' => 'All Trip Categories',
            'edit_item' => 'Edit Trip Category',
            'add_new_item' => 'Add New Trip Category'
        ),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'trip-category')
    ));

    // Trip Tags
    register_taxonomy('trip_tag', 'trip', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => 'Trip Tags',
            'singular_name' => 'Trip Tag',
            'search_items' => 'Search Trip Tags',
            'all_items' => 'All Trip Tags',
            'edit_item' => 'Edit Trip Tag',
            'add_new_item' => 'Add New Trip Tag'
        ),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'trip-tag')
    ));
});
