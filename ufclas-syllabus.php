<?php
/*
Plugin Name: UF CLAS - Syllabus
Plugin URI: http://it.clas.ufl.edu/
Description: Manage syllabi for department sites
Version: 0.0.1
Author: Priscilla Chapman (CLAS IT)
Author URI: http://it.clas.ufl.edu/
License: GPL2
*/
//

function ufclas_remove_plugin_metaboxes() {  
	$post_types = get_post_types();
	$custom_post_types = array_diff($post_types, array('post','page','tribe_events'));
	foreach ($custom_post_types as $cpt) {
		remove_meta_box('expirationdatediv', $cpt, 'side');
		remove_meta_box('page-links-to', $cpt, 'advanced');
	}
}  
add_action('do_meta_boxes', 'ufclas_remove_plugin_metaboxes'); 

// Register Custom Post Type
function ufclas_register_courses() {

	$labels = array(
		'name'                => _x( 'Courses', 'Post Type General Name', 'ufclas' ),
		'singular_name'       => _x( 'Course', 'Post Type Singular Name', 'ufclas' ),
		'menu_name'           => __( 'Courses', 'ufclas' ),
		'parent_item_colon'   => __( 'Parent Item', 'ufclas' ),
		'all_items'           => __( 'All Items', 'ufclas' ),
		'view_item'           => __( 'View Item', 'ufclas' ),
		'add_new_item'        => __( 'Add New Course', 'ufclas' ),
		'add_new'             => __( 'Add New', 'ufclas' ),
		'edit_item'           => __( 'Edit Item', 'ufclas' ),
		'update_item'         => __( 'Update Item', 'ufclas' ),
		'search_items'        => __( 'Search Item', 'ufclas' ),
		'not_found'           => __( 'Not found', 'ufclas' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ufclas' ),
	);
	$rewrite = array(
		'slug'                => 'syllabus',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __( 'ufclas_course', 'ufclas' ),
		'description'         => __( 'Post Type for course syllabi', 'ufclas' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', ),
		'taxonomies'          => array( 'ufclas_course_semester' ),
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
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'ufclas_course', $args );
	
	

}

// Register Custom Taxonomy
function ufclas_register_course_semester() {

	$labels = array(
		'name'                       => _x( 'Semesters', 'Taxonomy General Name', 'ufclas' ),
		'singular_name'              => _x( 'Semester', 'Taxonomy Singular Name', 'ufclas' ),
		'menu_name'                  => __( 'Course Semester', 'ufclas' ),
		'all_items'                  => __( 'All Items', 'ufclas' ),
		'parent_item'                => __( 'Parent Item', 'ufclas' ),
		'parent_item_colon'          => __( 'Parent Item:', 'ufclas' ),
		'new_item_name'              => __( 'New Course Semester', 'ufclas' ),
		'add_new_item'               => __( 'Add New Item', 'ufclas' ),
		'edit_item'                  => __( 'Edit Item', 'ufclas' ),
		'update_item'                => __( 'Update Item', 'ufclas' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'ufclas' ),
		'search_items'               => __( 'Search Items', 'ufclas' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'ufclas' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'ufclas' ),
		'not_found'                  => __( 'Not Found', 'ufclas' ),
	);
	$rewrite = array(
		'slug'                       => 'syllabus/semester',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'query_var'                  => 'semester',
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'ufclas_course_semester', array( 'ufclas_course' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'ufclas_register_course_semester', 0 );

add_action( 'init', 'ufclas_register_courses', 0 );

