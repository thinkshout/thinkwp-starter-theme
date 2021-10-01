<?php
/**
 * Custom Post Type class
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package WordPress
 * @subpackage  Timber
 */

/**
 * Create a custom post type and expose the register post type function.
 */
class Custom_Post_Type {
	/**
	 * Register a custom post type
	 *
	 * @param string  $name The plaintext name of the post type.
	 * @param string  $names The plural plaintext name of the post type.
	 * @param string  $dashicon The slug of the dashicon you want you use for this post type.
	 * @param integer $position The numerical position or area in the admin menu that this post type should appear in.
	 * @param boolean $public True if this post type is queryable and should appear user in searches.
	 * @param array   $taxonomies The WordPress taxonomies this post type uses.
	 * @param array   $supports The WordPress features this post type uses.
	 */
	public function __construct( $name, $names, $dashicon, $position, $public = true, $taxonomies = [ 'category' ], $supports = [ 'title' ] ) {
		$type_args       = array(
			'labels'              => array(
				'name'                  => $names,
				'singular_name'         => $name,
				'add_new'               => 'Add ' . $name,
				'add_new_item'          => 'Add New ' . $name,
				'edit_item'             => 'Edit ' . $name,
				'new_item'              => 'New ' . $name,
				'view_item'             => 'View ' . $name,
				'search_items'          => 'Search ' . $names,
				'not_found'             => 'No ' . $names . ' found',
				'not_found_in_trash'    => 'No ' . $names . ' in the trash',
				'all_items'             => 'All ' . $names,
				'archives'              => $names,
				'insert_into_item'      => 'Insert into ' . $name,
				'uploaded_to_this_item' => 'Upload to ' . $name,
				'featured_image'        => 'Featured Image',
				'set_featured_image'    => 'Set Featured Image',
				'remove_featured_image' => 'Remove Featured Image',
				'use_featured_image'    => 'Use as featured image',
			),
			'description'         => 'An object that includes all details about a ' . $name . ' type',
			'exclude_from_search' => false,
			'public'              => $public,
			'publicly_queryable'  => $public,
			'has_archive'         => $public,
			'show_ui'             => $public,
			'show_in_nav_menus'   => $public,
			'show_in_menu'        => $public,
			'show_in_admin_bar'   => $public,
			'show_in_rest'        => in_array( 'editor', $supports, true ),
			'menu_position'       => $position,
			'menu_icon'           => $dashicon,
			'taxonomies'          => $taxonomies,
			'rewrite'             => array( 'slug' => strtolower( $names ) ),
			'supports'            => $supports,
		);
		$this->post_type = array(
			'name' => $name,
			'args' => $type_args,
		);
	}

	/**
	 * Add Custom Post Types
	 */
	public function add_to_wp() {
		register_post_type( $this->post_type['name'], $this->post_type['args'] );
	}
}
