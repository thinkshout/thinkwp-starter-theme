<?php
/**
 * Custom Taxonomy class
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package WordPress
 * @subpackage  Timber
 */

/**
 * Create a custom taxonomy and expose the register taxonomy function.
 */
class Custom_Taxonomy {
	/**
	 * Register a custom taxonomy
	 *
	 * @param string  $name The plaintext name of the taxonomy.
	 * @param string  $names The plural plaintext name of the taxonomy.
	 * @param boolean $hierarchical True if this taxonomy can have children.
	 * @param boolean $public True if this taxonomy is queryable and should appear user in searches.
	 * @param array   $post_types The sanitize_title output of the post types this taxonomy is registered to.
	 */
	public function __construct( $name, $names, $hierarchical = true, $public = true, $post_types = [ 'post' ] ) {
		$labels = array(
			'name'              => $names,
			'singular_name'     => $name,
			'search_items'      => 'Search ' . $names,
			'all_items'         => 'All ' . $names,
			'parent_item'       => $hierarchical ? 'Parent ' . $name : null,
			'parent_item_colon' => $hierarchical ? 'Parent ' . $name . ':' : null,
			'edit_item'         => 'Edit ' . $name,
			'update_item'       => 'Update ' . $name,
			'add_new_item'      => 'Add New ' . $name,
			'new_item_name'     => 'New ' . $name . ' Name',
			'menu_name'         => $names,
		);

		$this->taxonomy = array(
			'names'      => sanitize_title( $names, $name ),
			'post_types' => $post_types,
			'args'       => array(
				'hierarchical'      => $hierarchical,
				'labels'            => $labels,
				'show_ui'           => $public,
				'show_in_rest'      => $public,
				'show_admin_column' => $public,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => sanitize_title( $names, $name ) ),
			),
		);
	}

	/**
	 * Register custom taxonomies
	 */
	public function add_to_wp() {
		register_taxonomy(
			$this->taxonomy['names'],
			$this->taxonomy['post_types'],
			$this->taxonomy['args'],
		);
	}
}
