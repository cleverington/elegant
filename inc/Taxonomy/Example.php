<?php // phpcs:disable
/**
 * Taxonomy: Example
 *
 * This is an example file showcasing how you can add custom taxonomies to your Flynt theme.
 *
 * For a full list of parameters see https://developer.wordpress.org/reference/functions/register_taxonomy/ or use https://generatewp.com/taxonomy/ to generate the code for you.
 *
 * @package Elegant
 */

namespace Elegant\Taxonomy;

/**
 * Taxonomy: Example
 */
// class TaxonomyExample {

// 	/**
// 	 * Runs initialization tasks.
// 	 *
// 	 * @access public
// 	 */
// 	public function run() {
// 		add_action( 'init', array( $this, 'register' ), 10, 0 );
// 	}

// 	/**
// 	 * Register Custom Taxonomy
// 	 *
// 	 * @access public
// 	 * @return void
// 	 */
// 	public function register() : void {
// 		$name_of_custom_taxonomy = 'example'; // Replace with name of custom taxonomy.

// 		$labels = array(
// 			'name'                   => _x( 'Taxonomies', 'Taxonomy General Name', 'elegant' ),
// 			'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'elegant' ),
// 			'menu_name'              => __( 'Taxonomy', 'elegant' ),
// 			'all_items'                  => __( 'All Items', 'elegant' ),
// 			'parent_item'                => __( 'Parent Item', 'elegant' ),
// 			'parent_item_colon'          => __( 'Parent Item:', 'elegant' ),
// 			'new_item_name'              => __( 'New Item Name', 'elegant' ),
// 			'add_new_item'               => __( 'Add New Item', 'elegant' ),
// 			'edit_item'                  => __( 'Edit Item', 'elegant' ),
// 			'update_item'                => __( 'Update Item', 'elegant' ),
// 			'view_item'                  => __( 'View Item', 'elegant' ),
// 			'separate_items_with_commas' => __( 'Separate items with commas', 'elegant' ),
// 			'add_or_remove_items'        => __( 'Add or remove items', 'elegant' ),
// 			'choose_from_most_used'      => __( 'Choose from the most used', 'elegant' ),
// 			'popular_items'              => __( 'Popular Items', 'elegant' ),
// 			'search_items'               => __( 'Search Items', 'elegant' ),
// 			'not_found'                  => __( 'Not Found', 'elegant' ),
// 			'no_terms'                   => __( 'No items', 'elegant' ),
// 			'items_list'                 => __( 'Items list', 'elegant' ),
// 			'items_list_navigation'      => __( 'Items list navigation', 'elegant' ),
// 		);

// 		$args = array(
// 			'labels'                     => $labels,
// 			'hierarchical'               => false,
// 			'public'                     => true,
// 			'show_ui'                    => true,
// 			'show_admin_column'          => true,
// 			'show_in_nav_menus'          => true,
// 			'show_tagcloud'              => true,
// 			'rewrite'              => array( 'slug' => 'examples' ),
// 			'show_in_rest'               => true,
// 		);

// 		// List all applicable post-types
// 		$post_types = array(
// 			'post',
// 		);

// 		register_taxonomy( $name_of_custom_taxonomy, $post_types, $args );
// 	}
// }
