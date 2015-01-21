<?php
/*
Plugin Name: UF CLAS - Syllabus
Plugin URI: http://it.clas.ufl.edu/
Description: Manage syllabi for department sites
Version: 0.0.2
Author: Priscilla Chapman (CLAS IT)
Author URI: http://it.clas.ufl.edu/
License: GPL2
*/

/*====================================================/

	Syllabus Page custom post type

/====================================================*/

function ufclas_register_syllabus() {
	
	// Register Syllabus Year Taxonomy
	
	$year_labels = array(
		'name'                       => _x( 'Syllabus Year', 'Taxonomy General Name', 'ufclas_syllabus' ),
		'singular_name'              => _x( 'Syllabus Year', 'Taxonomy Singular Name', 'ufclas_syllabus' ),
		'menu_name'                  => __( 'Syllabus Year', 'ufclas_syllabus' ),
		'all_items'                  => __( 'All Years', 'ufclas_syllabus' ),
		'parent_item'                => __( 'Parent Year', 'ufclas_syllabus' ),
		'parent_item_colon'          => __( 'Parent Year', 'ufclas_syllabus' ),
		'new_item_name'              => __( 'New Year', 'ufclas_syllabus' ),
		'add_new_item'               => __( 'Add New Year', 'ufclas_syllabus' ),
		'edit_item'                  => __( 'Edit Year', 'ufclas_syllabus' ),
		'update_item'                => __( 'Update Year', 'ufclas_syllabus' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'ufclas_syllabus' ),
		'search_items'               => __( 'Search years', 'ufclas_syllabus' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'ufclas_syllabus' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'ufclas_syllabus' ),
		'not_found'                  => __( 'Not Found', 'ufclas_syllabus' ),
	);
	$year_rewrite = array(
		'slug'                       => 'syllabus',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$year_args = array(
		'labels'                     => $year_labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'query_var'         				 => 'syllabus_year',
		'rewrite'                    => $year_rewrite,
	);
	register_taxonomy( 'ufclas_syllabus_year', array( 'ufclas_syllabus' ), $year_args );
	
	// Register syllabus semester categories
	
	$semester_labels = array(
		'name'                       => _x( 'Semesters', 'Taxonomy General Name', 'ufclas_syllabus' ),
		'singular_name'              => _x( 'Semester', 'Taxonomy Singular Name', 'ufclas_syllabus' ),
		'menu_name'                  => __( 'Syllabus Semester', 'ufclas_syllabus' ),
		'all_items'                  => __( 'All Semester', 'ufclas_syllabus' ),
		'parent_item'                => __( 'Parent Semester', 'ufclas_syllabus' ),
		'parent_item_colon'          => __( 'Parent Semester', 'ufclas_syllabus' ),
		'new_item_name'              => __( 'New Semester', 'ufclas_syllabus' ),
		'add_new_item'               => __( 'Add New Semester', 'ufclas_syllabus' ),
		'edit_item'                  => __( 'Edit Semester', 'ufclas_syllabus' ),
		'update_item'                => __( 'Update Semester', 'ufclas_syllabus' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'ufclas_syllabus' ),
		'search_items'               => __( 'Search semesters', 'ufclas_syllabus' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'ufclas_syllabus' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'ufclas_syllabus' ),
		'not_found'                  => __( 'Not Found', 'ufclas_syllabus' ),
	);
	$semester_args = array(
		'labels'                     => $semester_labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
	);
	register_taxonomy( 'ufclas_syllabus_semester', array( 'ufclas_syllabus' ), $semester_args );
	

	// Register custom post type
	
	$cpt_labels = array(
		'name'                => _x( 'Syllabus Page', 'Syllabus Archive', 'ufclas' ),
		'singular_name'       => _x( 'Syllabus Page', 'Syllabus Archive pages', 'ufclas' ),
		'menu_name'           => __( 'Syllabus Pages', 'ufclas' ),
		'parent_item_colon'   => __( 'Parent Item', 'ufclas' ),
		'all_items'           => __( 'All Syllabus Pages', 'ufclas' ),
		'view_item'           => __( 'View Syllabus Page', 'ufclas' ),
		'add_new_item'        => __( 'Add New Syllabus', 'ufclas' ),
		'add_new'             => __( 'Add New Syllabus', 'ufclas' ),
		'edit_item'           => __( 'Edit Syllabi', 'ufclas' ),
		'update_item'         => __( 'Update Item', 'ufclas' ),
		'search_items'        => __( 'Search Item', 'ufclas' ),
		'not_found'           => __( 'Not found', 'ufclas' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ufclas' ),
	);
	$cpt_rewrite = array(
		'slug'                => 'syllabus',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => false,
	);
	$cpt_args = array(
		'label'               => __( 'ufclas_syllabus', 'ufclas' ),
		'description'         => __( 'Post Type for course syllabi', 'ufclas' ),
		'labels'              => $cpt_labels,
		'supports'            => array( 'title' ),
		'taxonomies'          => array('ufclas_syllabus_semester', 'ufclas_syllabus_year'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 60,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'syllabus',
		'rewrite'             => $cpt_rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'ufclas_syllabus', $cpt_args );
	
}
// Register the syllabus archive custom post type and taxonomies
add_action( 'init', 'ufclas_register_syllabus', 0 );


// Add rewrite rule to allow permalink structure (syllabus/%semester_year%/%syllabus_page_name%)

function ufclas_syllabus_rewrite() {
    add_rewrite_rule("^syllabus/([^/]+)/([^/]+)/?",'index.php?post_type=ufclas_syllabus&syllabus_year=$matches[1]&syllabus=$matches[2]','top');
}
add_action('init','ufclas_syllabus_rewrite', 0 );


// Change the syllabus page permalink structure

function ufclas_syllabus_permalink( $permalink, $post ) {
     if ( is_wp_error($post) || 'ufclas_syllabus' != $post->post_type || empty($post->post_name) )
        return $permalink;
     
     // Get taxonomy terms
     $terms = get_the_terms($post->ID, 'ufclas_syllabus_year');
 
    if( is_wp_error($terms) || !$terms ) {
        $tax = 'none';
    }
    else {
        $tax_obj = array_pop($terms);
        $tax = $tax_obj->slug;
    }
    return home_url(user_trailingslashit( "syllabus/$tax/$post->post_name" ));
} 
add_filter('post_type_link', 'ufclas_syllabus_permalink', 10, 2);

// Flush rewrite rules on activation and deactivation

function ufclas_syllabus_activation() {
 
    // Register post type and taxonomy rewrite rules
    ufclas_register_syllabus();
 
    // Then flush them
    flush_rewrite_rules();
}
function ufclas_syllabus_deactivation() {
 
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'ufclas_syllabus_activation');
register_deactivation_hook( __FILE__, 'ufclas_syllabus_deactivation');


 // Add custom templates 
 
function ufclas_syllabus_templates( $template_path ){
	
	// Change template for the newsletter page
	if( is_singular('ufclas_syllabus') ){
		$template_path = plugin_dir_path( __FILE__ ) . 'templates/single-syllabus.php';
	}
	
	// Change template for the newsletter page
	if( is_post_type_archive( 'ufclas_syllabus' ) ){
		$template_path = plugin_dir_path( __FILE__ ) . 'templates/archive-syllabus.php';
	}
	
	return $template_path;
}

add_filter( 'template_include', 'ufclas_syllabus_templates', 1 );


/*====================================================/

	Attachments
	Documentation: https://github.com/jchristopher/attachments/blob/master/docs/usage.md

/====================================================*/

function my_attachments( $attachments )
{
  $fields         = array(
    array(
      'name'      => 'syllabus_course_number', 
      'type'      => 'text',       
      'label'     => __( 'Course Number/Section', 'ufclas' ),
      'default'   => '',
    ),
    array(
      'name'      => 'title',                         // unique field name
      'type'      => 'text',                          // registered field type
      'label'     => __( 'Title', 'ufclas' ),    // label to display
      'default'   => 'title',                         // default value upon selection
    ),
    array(
      'name'      => 'syllabus_instructor', 
      'type'      => 'text',       
      'label'     => __( 'Instructor(s)', 'ufclas' ),
      'default'   => '',
    ),
  );

  $args = array(

    // title of the meta box (string)
    'label'         => 'Syllbus',

    // all post types to utilize (string|array)
    'post_type'     => array( 'ufclas_syllabus' ),

    // meta box position (string) (normal, side or advanced)
    'position'      => 'normal',

    // meta box priority (string) (high, default, low, core)
    'priority'      => 'core',

    // allowed file type(s) (array) (image|video|text|audio|application)
    'filetype'      => array('application'),  // no filetype limit

    // include a note within the meta box (string)
    'note'          => 'Attach files below.',

    // by default new Attachments will be appended to the list
    // but you can have then prepend if you set this to false
    'append'        => true,

    // text for 'Attach' button in meta box (string)
    'button_text'   => __( 'Attach Syllabus Files', 'ufclas' ),

    // text for modal 'Attach' button (string)
    'modal_text'    => __( 'Attach', 'ufclas' ),

    // which tab should be the default in the modal (string) (browse|upload)
    'router'        => 'browse',

    // whether Attachments should set 'Uploaded to' (if not already set)
    'post_parent'   => true,

    // fields array
    'fields'        => $fields,

  );

  $attachments->register( 'my_attachments', $args ); // unique instance name
}

add_action( 'attachments_register', 'my_attachments' );
add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance


/*====================================================/

	General

/====================================================*/

// Remove Page links to and Expiration metaboxes
function ufclas_remove_plugin_metaboxes() {  
	$post_types = get_post_types();
	$custom_post_types = array_diff($post_types, array('post','page','tribe_events'));
	foreach ($custom_post_types as $cpt) {
		remove_meta_box('expirationdatediv', $cpt, 'side');
		remove_meta_box('page-links-to', $cpt, 'advanced');
	}
}
add_action('do_meta_boxes', 'ufclas_remove_plugin_metaboxes'); 


