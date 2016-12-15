<?php
/*
Plugin Name: UFCLAS Syllabus
Plugin URI: https://it.clas.ufl.edu/
Description: Manage syllabuses for department sites
Version: 1.2.1
Author: Priscilla Chapman (CLAS IT)
Author URI: https://it.clas.ufl.edu/
License: GPL2
Build Date: 20161215
*/

// Path to the root of the plugin, used for including template files
define( 'UFCLAS_SYLLABUS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require UFCLAS_SYLLABUS_PLUGIN_DIR . 'inc/class-ufclas-syllabus-loader.php';

/**
 * Register Syllabus page custom post type
 * @since 0.0.4
 */
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
		'name'                => _x( 'Course Syllabuses', 'Syllabus Archive', 'ufclas_syllabus' ),
		'singular_name'       => _x( 'Syllabus Page', 'Syllabus Archive pages', 'ufclas_syllabus' ),
		'menu_name'           => __( 'Syllabus', 'ufclas_syllabus' ),
		'parent_item_colon'   => __( 'Parent Item', 'ufclas_syllabus' ),
		'all_items'           => __( 'All Syllabus Pages', 'ufclas_syllabus' ),
		'view_item'           => __( 'View Syllabus Page', 'ufclas_syllabus' ),
		'add_new_item'        => __( 'Add New Syllabus', 'ufclas_syllabus' ),
		'add_new'             => __( 'Add New Syllabus', 'ufclas_syllabus' ),
		'edit_item'           => __( 'Edit Syllabus', 'ufclas_syllabus' ),
		'update_item'         => __( 'Update Item', 'ufclas_syllabus' ),
		'search_items'        => __( 'Search Item', 'ufclas_syllabus' ),
		'not_found'           => __( 'Not found', 'ufclas_syllabus' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ufclas_syllabus' ),
	);
	$cpt_rewrite = array(
		'slug'                => 'syllabus',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => false,
	);
	$cpt_args = array(
		'label'               => __( 'ufclas_syllabus', 'ufclas_syllabus' ),
		'description'         => __( 'Post Type for course syllabuses', 'ufclas_syllabus' ),
		'labels'              => $cpt_labels,
		'supports'            => array( 'title', 'editor' ),
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
	
	ufclas_syllabus_rewrite();
}
// Register the syllabus archive custom post type and taxonomies
add_action( 'init', 'ufclas_register_syllabus', 0 );


/** 
 * Add rewrite rule to allow permalink structure (syllabus/%semester_year%/%syllabus_page_name%)
 * @since 0.0.4
 */
function ufclas_syllabus_rewrite() {
    add_rewrite_rule("^syllabus/([^/]+)/([^/]+)/?",'index.php?post_type=ufclas_syllabus&syllabus_year=$matches[1]&syllabus=$matches[2]','top');
}
add_action('init','ufclas_syllabus_rewrite', 0 );


/** 
 * Change the syllabus page permalink structure
 * @since 0.0.4
 */
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

/**
 * Flush rewrite rules on activation and deactivation
 * @since 0.0.4
 */
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


/**
 * Attachments plugin functions
 * @since 0.0.4
 * @see https://github.com/jchristopher/attachments/blob/master/docs/usage.md	Attachments documentation
 */
function syllabus_attachments( $attachments )
{
  $fields         = array(
    array(
      'name'      => 'syllabus_course_number', 
      'type'      => 'text',       
      'label'     => __( 'Course Number/Section', 'ufclas_syllabus' ),
      'default'   => '',
    ),
	array(
      'name'      => 'syllabus_section', 
      'type'      => 'text',       
      'label'     => __( 'Section', 'ufclas_syllabus' ),
      'default'   => '',
    ),
    array(
      'name'      => 'title',                         // unique field name
      'type'      => 'text',                          // registered field type
      'label'     => __( 'Title', 'ufclas_syllabus' ),    // label to display
      'default'   => 'title',                         // default value upon selection
    ),
    array(
      'name'      => 'syllabus_instructor', 
      'type'      => 'text',       
      'label'     => __( 'Instructor(s)', 'ufclas_syllabus' ),
      'default'   => '',
    ),
  );

  $args = array(

    // title of the meta box (string)
    'label'         => 'Syllabus',

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
    'button_text'   => __( 'Attach Syllabus Files', 'ufclas_syllabus' ),

    // text for modal 'Attach' button (string)
    'modal_text'    => __( 'Attach', 'ufclas_syllabus' ),

    // which tab should be the default in the modal (string) (browse|upload)
    'router'        => 'browse',

    // whether Attachments should set 'Uploaded to' (if not already set)
    'post_parent'   => true,

    // fields array
    'fields'        => $fields,

  );

  $attachments->register( 'syllabus_attachments', $args ); // unique instance name
}

add_action( 'attachments_register', 'syllabus_attachments' );
add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance

/**
 * Custom sort attachment function
 *
 * @param object $a First attachment argument
 * @param object $b Second attachment argument
 * @return int Sort order
 * @since 1.1.1
 * @todo Add 'syllabus_section'
 */
function ufclas_syllabus_attachments_sort( $a, $b ){
	$order = 0;
	$field_order = array('syllabus_course_number', 'title', 'syllabus_instructor');
	
	foreach( $field_order as $field ){
		$a_field = strtolower( $a->fields->{$field} );
		$b_field = strtolower( $b->fields->{$field} );
		
		if( ($a_field != $b_field) && ($order == 0) ) {
			$order =  ( $a_field > $b_field )? 1 : -1;
		}
	}
	return $order;
}

/**
 * Sort the displayed attachments by fields
 *
 * @param array $attachments Post attachments
 * @return array Filtered attachments
 * @since 1.1.1
 */
function ufclas_syllabus_get_attachments( $attachments ){
	usort( $attachments, 'ufclas_syllabus_attachments_sort' );
	return $attachments;
}
add_filter( 'attachments_get_syllabus_attachments', 'ufclas_syllabus_get_attachments' );


/*====================================================/

	General

/====================================================*/

/**
 * Remove metaboxes from Page links to and Expiration for syllabus pages
 * @since 0.0.4
 */
function ufclas_syllabus_remove_plugin_metaboxes() {  
	$post_types = get_post_types();
	$custom_post_types = array_diff($post_types, array('post','page','tribe_events'));
	foreach ($custom_post_types as $cpt) {
		remove_meta_box('expirationdatediv', $cpt, 'side');
		remove_meta_box('page-links-to', $cpt, 'advanced');
	}
}
add_action('do_meta_boxes', 'ufclas_syllabus_remove_plugin_metaboxes'); 

/**
 * Add custom templates depending on theme
 * @since 0.0.4
 */
function ufclas_syllabus_templates( $template_path ){
	
	// Change template for archive page if files exist in theme
	if( is_singular( 'ufclas_syllabus' ) ){
		$templates = new UFCLAS_Syllabus_Template_Loader;
		$template_path = $templates->get_template_part( 'single', 'syllabus', false );
	}
	if( is_post_type_archive( 'ufclas_syllabus' ) || is_tax('ufclas_syllabus_year') ){
		$templates = new UFCLAS_Syllabus_Template_Loader;
		$template_path = $templates->get_template_part( 'archive', 'syllabus', false );
	}
	return $template_path;
}
add_filter( 'template_include', 'ufclas_syllabus_templates', 1 );

/**
 * Add ufclas-syllabus shortcode
 * @todo Add parameters so shortcode can be used on any page
 * @since 1.1.0
 */
function ufclas_syllabus_shortcode() {
	$template_loader = new UFCLAS_Syllabus_Template_Loader;
	ob_start();
	$template_loader->get_template_part( 'content', 'syllabus' );
	return ob_get_clean();
}
add_shortcode( 'ufclas-syllabus', 'ufclas_syllabus_shortcode' );

/**
 * Add ufclas-syllabus shortcode to single syllabus pages
 * @param string $content Content from the editor
 * @return string Modified content
 * @since 1.1.0
 */
function ufclas_syllabus_content( $content ) {
	
	if ( is_singular('ufclas_syllabus') ){
		$current_theme = wp_get_theme();
		if ('ufclas-ufl-responsive' != wp_get_theme()->get_template()){
			$content .= do_shortcode('[ufclas-syllabus]');	
		}
	}
	return $content;
}
add_filter( 'the_content', 'ufclas_syllabus_content' );
