<?php
/*
Plugin Name: BC Gov Corporate Learning Tech Services Registry
Plugin URI: https://github.com/allanhaggett/wp-bcgov-tech-reggie
Description: 
Author: Allan Haggett <allan.haggett@gov.bc.ca>
Version: 1
Author URI: https://learning.gww.gov.bc.ca
*/


/**
 * Start by defining the course content type, then start tacking on our taxonomies
 */
function psalc_custom_post_solutions() {
    $labels = array(
        'name'               => _x( 'Solutions', 'post type general name' ),
        'singular_name'      => _x( 'Solutions', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'course' ),
        'add_new_item'       => __( 'Add New Solution' ),
        'edit_item'          => __( 'Edit Solution' ),
        'new_item'           => __( 'New Solution' ),
        'all_items'          => __( 'All Solutions' ),
        'view_item'          => __( 'View Solution' ),
        'search_items'       => __( 'Search Solutions' ),
        'not_found'          => __( 'No solutions found' ),
        'not_found_in_trash' => __( 'No solutions found in the Trash' ), 
        'parent_item_colon'  => __( 'Solutions:' ),
        'menu_name'          => 'Solutions'
    );
    $args = array(
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'capability_type'     => 'page',
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
    );
    register_post_type( 'solutions', $args ); 
}
function psalc_custom_post_usecases() {
    $labels = array(
        'name'               => _x( 'Use Cases', 'post type general name' ),
        'singular_name'      => _x( 'Use Cases', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'course' ),
        'add_new_item'       => __( 'Add New Use Case' ),
        'edit_item'          => __( 'Edit Use Case' ),
        'new_item'           => __( 'New Use Case' ),
        'all_items'          => __( 'All Use Cases' ),
        'view_item'          => __( 'View Use Case' ),
        'search_items'       => __( 'Search Use Cases' ),
        'not_found'          => __( 'No use cases found' ),
        'not_found_in_trash' => __( 'No use cases found in the Trash' ), 
        'parent_item_colon'  => __( 'Use Case:' ),
        'menu_name'          => 'Use Cases'
    );
    $args = array(
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'capability_type'     => 'page',
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),        
    );
    register_post_type( 'usecases', $args ); 
}

add_action( 'init', 'psalc_custom_post_solutions' );
add_action( 'init', 'psalc_custom_post_usecases' );


/**
 * Start applying various taxonomies; start with the methods, 
 * then init them all in one place
 */

/**
 * Use Case Categories
 */
function psalc_taxonomies_usecase_categories() {
    $labels = array(
        'name'              => _x( 'Use Case Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Use Case Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Use Case Categories' ),
        'all_items'         => __( 'All Use Case Categories' ),
        'parent_item'       => __( 'Parent Use Case Category' ),
        'parent_item_colon' => __( 'Parent Use Case Category:' ),
        'edit_item'         => __( 'Edit Use Case Category' ), 
        'update_item'       => __( 'Update Use Case Category' ),
        'add_new_item'      => __( 'Add New Use Case Category' ),
        'new_item_name'     => __( 'New Use Case Category' ),
        'menu_name'         => __( 'Case Categories' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'show_in_rest' => true,
    );
    register_taxonomy( 'usecase_categories', 'usecases', $args );
}


/** 
 * Now let's initiate all of those awesome taxonomies!
 */

add_action( 'init', 'psalc_taxonomies_usecase_categories', 0 );


/**
 * Now let's make sure that we're using our own customized template
 * so that courses can show the meta data in a customizable fashion.
 *  
 * #TODO extend this to include archive.php for main index page
 * and also taxonomy pages
 * 
 */
function load_custom_templates( $template ) {
    global $post;
    if ( 'solutions' === $post->post_type && locate_template( array( 'single-solution.php' ) ) !== $template ) {
        /*
         * This is a 'course' page
         * AND a 'single course template' is not found on
         * theme or child theme directories, so load it
         * from our plugin directory.
         */
        return plugin_dir_path( __FILE__ ) . 'single-solution.php';
    } 
    if ( 'usecases' === $post->post_type && locate_template( array( 'single-usecase.php' ) ) !== $template ) {
        /*
         * This is a 'course' page
         * AND a 'single course template' is not found on
         * theme or child theme directories, so load it
         * from our plugin directory.
         */
        return plugin_dir_path( __FILE__ ) . 'single-usecase.php';
    }
    return $template;
}

function custom_archive_templates( $archive_template ) {
     global $post;
     if ( is_post_type_archive ( 'solutions' ) ) {
          $archive_template = dirname( __FILE__ ) . '/archive-solutions.php';
     }
     if ( is_post_type_archive ( 'usecases' ) ) {
        $archive_template = dirname( __FILE__ ) . '/archive-usecases.php';
   }
     return $archive_template;
}

function custom_tax_templates( $tax_template ) {
    global $post;
    if ( is_tax ( 'usecase_categories' ) ) {
         $tax_template = dirname( __FILE__ ) . '/taxonomy-usecases.php';
    }
    return $tax_template;
}

add_filter( 'single_template', 'load_custom_templates' );
add_filter( 'archive_template', 'custom_archive_templates');
add_filter( 'taxonomy_template', 'custom_tax_templates');