<?php
/**
 * Taxonomy: Locations
 *
 * For a full list of parameters see https://developer.wordpress.org/reference/functions/register_taxonomy/ or use https://generatewp.com/taxonomy/ to generate the code for you.
 *
 * @package Elegant
 */

namespace Elegant\Taxonomy;

/**
 * Taxonomy: Locations
 *
 * @todo: Add Location ACF subfields
 */
class Locations {

	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );
	}

	/**
	 * Register Custom Taxonomy
	 *
	 * @access public
	 * @return void
	 */
	public function register() : void {
		$name_of_custom_taxonomy = 'locations'; // Replace with name of custom taxonomy.

		$labels = array(
			'name'                       => _x( 'Locations', 'Taxonomy General Name', 'elegant' ),
			'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'elegant' ),
			'menu_name'                  => __( 'Locations', 'elegant' ),
			'all_items'                  => __( 'All Locations', 'elegant' ),
			'parent_item'                => __( 'Parent Location', 'elegant' ),
			'parent_item_colon'          => __( 'Parent Location:', 'elegant' ),
			'new_item_name'              => __( 'New Location', 'elegant' ),
			'add_new_item'               => __( 'Add Location', 'elegant' ),
			'edit_item'                  => __( 'Edit Location', 'elegant' ),
			'update_item'                => __( 'Update Location', 'elegant' ),
			'view_item'                  => __( 'View Location', 'elegant' ),
			'separate_items_with_commas' => __( 'Separate Locations with commas', 'elegant' ),
			'add_or_remove_items'        => __( 'Add or remove Locations', 'elegant' ),
			'choose_from_most_used'      => __( 'Choose from the most used Locations', 'elegant' ),
			'popular_items'              => __( 'Popular Locations', 'elegant' ),
			'search_items'               => __( 'Search Locations', 'elegant' ),
			'not_found'                  => __( 'Location Not Found', 'elegant' ),
			'no_terms'                   => __( 'No Locations found', 'elegant' ),
			'items_list'                 => __( 'Items list', 'elegant' ),
			'items_list_navigation'      => __( 'Items list navigation', 'elegant' ),
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => 'locations' ),
			'show_in_rest'      => true,
		);

		$post_types = array(
			'',
		);

		register_taxonomy( $name_of_custom_taxonomy, $post_types, $args );
	}
}
