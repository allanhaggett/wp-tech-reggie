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
function my_custom_post_course() {
    $labels = array(
        'name'               => _x( 'Tech Services', 'post type general name' ),
        'singular_name'      => _x( 'Tech Services', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'course' ),
        'add_new_item'       => __( 'Add New Tech Service' ),
        'edit_item'          => __( 'Edit Tech Service' ),
        'new_item'           => __( 'New Tech Service' ),
        'all_items'          => __( 'All Tech Services' ),
        'view_item'          => __( 'View Tech Service' ),
        'search_items'       => __( 'Search Tech Services' ),
        'not_found'          => __( 'No services found' ),
        'not_found_in_trash' => __( 'No services found in the Trash' ), 
        'parent_item_colon'  => ’,
        'menu_name'          => 'Tech Services'
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
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        // , 'custom-fields'        
    );
    register_post_type( 'course', $args ); 
}
add_action( 'init', 'my_custom_post_course' );


/**
 * Start applying various taxonomies; start with the methods, 
 * then init them all in one place
 */

/**
 * Learning Partner. Courses can synchronize from multiple different Learning Partners; 
 * e.g. PSA Learning System We use this taxonomy to keep things fresh with that system, 
 * so we can update/add/remove courses within each system separately.
 */
function my_taxonomies_learning_partner() {
    $labels = array(
        'name'              => _x( 'Learning Partners', 'taxonomy general name' ),
        'singular_name'     => _x( 'Learning Partners', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Learning Partners' ),
        'all_items'         => __( 'All Learning Partners' ),
        'parent_item'       => __( 'Parent Learning Partner' ),
        'parent_item_colon' => __( 'Parent Learning Partner:' ),
        'edit_item'         => __( 'Edit Learning Partner' ), 
        'update_item'       => __( 'Update Learning Partner' ),
        'add_new_item'      => __( 'Add New Learning Partner' ),
        'new_item_name'     => __( 'New Learning Partner' ),
        'menu_name'         => __( 'Learning Partners' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'show_in_rest' => true,
    );
    register_taxonomy( 'learning_partner', 'course', $args );
}

/**
 * Course Categories
 */
function my_taxonomies_course_category() {
    $labels = array(
        'name'              => _x( 'Course Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Course Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Course Categories' ),
        'all_items'         => __( 'All Course Categories' ),
        'parent_item'       => __( 'Parent Course Category' ),
        'parent_item_colon' => __( 'Parent Course Category:' ),
        'edit_item'         => __( 'Edit Course Category' ), 
        'update_item'       => __( 'Update Course Category' ),
        'add_new_item'      => __( 'Add New Course Category' ),
        'new_item_name'     => __( 'New Course Category' ),
        'menu_name'         => __( 'Course Categories' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
    );
    register_taxonomy( 'course_category', 'course', $args );
}

/**
 * Delivery Methods
 */
function my_taxonomies_course_delivery_method() {
    $labels = array(
        'name'              => _x( 'Delivery Methods', 'taxonomy general name' ),
        'singular_name'     => _x( 'Delivery Method', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Delivery Methods' ),
        'all_items'         => __( 'All Delivery Methods' ),
        'parent_item'       => __( 'Parent Delivery Method' ),
        'parent_item_colon' => __( 'Parent Delivery Method:' ),
        'edit_item'         => __( 'Edit Delivery Method' ), 
        'update_item'       => __( 'Update Delivery Method' ),
        'add_new_item'      => __( 'Add New Delivery Method' ),
        'new_item_name'     => __( 'New Delivery Method' ),
        'menu_name'         => __( 'Delivery Methods' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
    );
    register_taxonomy( 'delivery_method', 'course', $args );
}

/** 
 * Course best suited to a role
 */
function my_taxonomies_course_role() {
    $labels = array(
        'name'              => _x( 'Roles', 'taxonomy general name' ),
        'singular_name'     => _x( 'Role', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Roles' ),
        'all_items'         => __( 'All Roles' ),
        'parent_item'       => __( 'Parent Role' ),
        'parent_item_colon' => __( 'Parent Role:' ),
        'edit_item'         => __( 'Edit Role' ), 
        'update_item'       => __( 'Update Role' ),
        'add_new_item'      => __( 'Add New Role' ),
        'new_item_name'     => __( 'New Role' ),
        'menu_name'         => __( 'Roles' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'show_in_rest' => true,
    );
    register_taxonomy( 'role', 'course', $args );
}

/** 
 * Course is a part of a larger program or initiative
 */
function my_taxonomies_course_program() {
    $labels = array(
        'name'              => _x( 'Programs', 'taxonomy general name' ),
        'singular_name'     => _x( 'Program', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Programs' ),
        'all_items'         => __( 'All Programs' ),
        'parent_item'       => __( 'Parent Program' ),
        'parent_item_colon' => __( 'Parent Program:' ),
        'edit_item'         => __( 'Edit Program' ), 
        'update_item'       => __( 'Update Program' ),
        'add_new_item'      => __( 'Add New Program' ),
        'new_item_name'     => __( 'New Program' ),
        'menu_name'         => __( 'Programs' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'show_in_rest' => true,
    );
    register_taxonomy( 'program', 'course', $args );
}

/** 
 * Now let's initiate all of those awesome taxonomies!
 */

add_action( 'init', 'my_taxonomies_course_category', 0 );
add_action( 'init', 'my_taxonomies_course_delivery_method', 0 );
add_action( 'init', 'my_taxonomies_course_role', 0 );
add_action( 'init', 'my_taxonomies_course_program', 0 );
add_action( 'init', 'my_taxonomies_learning_partner', 0 );

/**
 * Now let's make sure that we're using our own customized template
 * so that courses can show the meta data in a customizable fashion.
 *  
 * #TODO extend this to include archive.php for main index page
 * and also taxonomy pages
 * 
 */
function load_course_template( $template ) {
    global $post;
    if ( 'course' === $post->post_type && locate_template( array( 'single-course.php' ) ) !== $template ) {
        /*
         * This is a 'course' page
         * AND a 'single course template' is not found on
         * theme or child theme directories, so load it
         * from our plugin directory.
         */
        return plugin_dir_path( __FILE__ ) . 'single-course.php';
    }
    return $template;
}

function course_archive_template( $archive_template ) {
     global $post;
     if ( is_post_type_archive ( 'course' ) ) {
          $archive_template = dirname( __FILE__ ) . '/archive-course.php';
     }
     return $archive_template;
}

function course_tax_template( $tax_template ) {
    global $post;
    if ( is_tax ( 'course_category' ) ) {
         $tax_template = dirname( __FILE__ ) . '/taxonomy.php';
    }
    return $tax_template;
}

add_filter( 'single_template', 'load_course_template' );
add_filter( 'archive_template', 'course_archive_template');
add_filter( 'taxonomy_template', 'course_tax_template');

function course_menu() {
	add_submenu_page(
		'edit.php?post_type=course',
		__( 'ELM Sync', 'elm-sync' ),
		__( 'ELM Sync', 'elm-sync' ),
		'elm-sync',
		'elm-sync',
		'course_elm_sync'
	);
}
add_action( 'admin_menu', 'course_menu' );

/**
 * Synchronize with the public feed for the PSA Learning System (ELM)
 */
function course_elm_sync() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    echo '<h1>PSA Learning System - Synchronize</h1>';
    echo '<p>Here we make all courses from <a href="';
    echo 'edit-tags.php?taxonomy=source_system&post_type=course';
    echo '">this Learning Partner</a> private so that we can selectively reenable them ';
    echo 'whem we read the PSA Learning System public feed of courses and compare it ';
    echo 'to what we already have. If the course exists, we check for updates and make ';
    echo 'those accordingly. If the course does not exist, we create it.</p>';
    echo '<p><strong>*NOTE</strong> that if the course existed previously, but is now no ';
    echo 'longer in the feed, it will remain set to "private" and not published on the site.</p>';
    /**
     * First let's make every page private so that if the course is no longer in the catalog, 
     * that it gets removed from the listing here. Note that we're just making these courses
     * private, and NOT deleting them. We're going to loop through the source catalog after 
     * this, and if the post already exists and nothing has changed, then we just make it 
     * published again and move on.
     * 
     * The term_id for the "PSA Learning System" category in the "Learning Partner" taxonomy
     * is 14; you may need to change this value if it changes as we move betwixt platforms.
     */
    $all_posts = get_posts(array(
        'post_type' => 'course',
        'numberposts' => -1,
        'tax_query' => array(
            array(
            'taxonomy' => 'learning_partner',
            'field' => 'term_id',
            'terms' => 50)
        ))
    );
    foreach ($all_posts as $single_post){
        $single_post->post_status = 'private';
        wp_update_post( $single_post );
    }
    /**
     * Now that all those courses are private, let's grab the public listing of courses from 
     * the PSA Learning System and loop through those, updating existing ones as required 
     * and publishing new ones.
     */
    $feed = file_get_contents('https://learn.bcpublicservice.gov.bc.ca/learningcentre/courses/feed.json');
    $courses = json_decode($feed);
    echo '<h3>' . count($courses->items) . ' Courses.</h3>';
    foreach($courses->items as $course) {

        if(!empty($course->title)) {
            $existing = post_exists($course->title);
            if($existing) {
                echo 'ID: ' . $existing . ' ' . $course->title . ' ALREADY EXISTS<br>';
                $existingcourse = get_post($existing);
                if($existingcourse->description != $course->summary) {
                    $existingcourse->description = $course->summary;
                }
                $existingcourse->post_status = 'publish';
                wp_update_post( $existingcourse );
                echo $existingcourse->title . ' Updated<br>';
            } else {
                $new_course = array(
                    'post_title' => $course->title,
                    'post_type' => 'course',
                    'post_status' => 'publish', 
                    'post_content' => $course->summary,
                    'post_excerpt' => substr($course->summary, 0, 100),
                    'meta_input'   => array(
                        'course_link' => $course->url,
                        'elm_course_code' => $course->id
                    )
                );
                $post_id = wp_insert_post( $new_course );
                wp_set_object_terms( $post_id, 'PSA Learning System', 'learning_partner  ', false);
                wp_set_object_terms( $post_id, $course->delivery_method, 'delivery_method', false);
                $cats = explode(',', $course->tags);
                foreach($cats as $cat) {
                    wp_set_object_terms( $post_id, $cat, 'course_category', true);
                }
                echo $post_id . ' - ' . $course->title . ' Created<br>';
            }

            
        }
    }
}

// First we create a function
function list_terms_custom_taxonomy( $atts ) {
 
    // Inside the function we extract custom taxonomy parameter of our shortcode
    extract( shortcode_atts( array(
        'custom_taxonomy' => '',
    ), $atts ) );
     
    // arguments for function wp_list_categories
    $args = array( 
            'taxonomy' => $custom_taxonomy,
            'title_li' => ''
    );
     
    // We wrap it in unordered list 
    echo '<ul>'; 
    echo wp_list_categories($args);
    echo '</ul>';
}

// Add a shortcode that executes our function
add_shortcode( 'ct_terms', 'list_terms_custom_taxonomy' );

//Allow Text widgets to execute shortcodes
add_filter('widget_text', 'do_shortcode');

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'courses_meta_boxes_setup' );
add_action( 'load-post-new.php', 'courses_meta_boxes_setup' );

/* Meta box setup function. */
function courses_meta_boxes_setup() {

    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'courses_add_post_meta_boxes' );
    /* Save post meta on the 'save_post' hook. */
    add_action( 'save_post', 'course_save_course_link_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function courses_add_post_meta_boxes() {

    add_meta_box(
        'course-link',      // Unique ID
        esc_html__( 'Course Link', 'course-link' ),    // Title
        'course_link_meta_box',   // Callback function
        'course',         // Admin page (or post type)
        'side',         // Context
        'default'         // Priority
    );
}
/* Display the post meta box. */
function course_link_meta_box( $post ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'course_link_nonce' ); ?>
    <div>
        <label for="course-link">
        <?php _e( "A hyperlink to the session registration page for this course.", 'course-link' ); ?></label>
        <br />
        <input class="widefat" 
                type="text" 
                name="course-link" 
                id="course-link" 
                value="<?php echo esc_attr( get_post_meta( $post->ID, 'course_link', true ) ); ?>" 
                size="30" />
    </div>
<?php }

/* Save a meta box’s post metadata. */
function course_save_course_link_meta ( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['course_link_nonce'] ) || !wp_verify_nonce( $_POST['course_link_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }
    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

    /* Get the posted data */
    $new_meta_value = ( isset( $_POST['course-link'] ) ? $_POST['course-link'] : ’ );

    /* Get the meta key. */
    $meta_key = 'course_link';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta( $post_id, $meta_key, true );

    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && ’ == $meta_value ) {
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );
    /* If the new meta value does not match the old value, update it. */
    } elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
        update_post_meta( $post_id, $meta_key, $new_meta_value );
    /* If there is no new meta value but an old value exists, delete it. */
    } elseif ( ’ == $new_meta_value && $meta_value ) {
        delete_post_meta( $post_id, $meta_key, $meta_value );
    }
}