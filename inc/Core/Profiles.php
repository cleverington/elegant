<?php // phpcs:ignore
/**
 * Profiles
 *
 * @package Elegant
 */

namespace Elegant\Core;

/**
 * Profiles
 *
 * @todo: Explore merging the 'DP Title' and 'DP Honor Title' fields. Could just
 *   have a Checkbox that asks if the person is 'Endowed' versus not. It feels like there
 *   should either 'only' be a single title field or use a Repeater that
 *
 * @todo: Replace 'DP Title' / 'DP Honor Title' text fields with dedicated Taxonomy fields
 *   that users can choose from.
 *
 * @todo: Interview Susan heavily and define the expects use cases and best options for
 *   UX from this Post Type. The usage (and rebuilding) of EACH field should be explored
 *   prior to discussing migration plans.  The 'Thesis' section, for example, could maybe
 *   just be a large text-box field? Mabye the 'DP Office' field is a taxonomy?
 *
 * @todo: See if 'tabs' can be used to improve the UX of data entry.
 *
 * @todo: Also check and see if 'Profile Type' is supposed to be only have one answer.
 *
 * @todo: Consider purchasing ACF Extended PRO for the 'Phone Number' field available
 *   at https://www.acf-extended.com/features/fields/phone-number. Would be additional
 *   $49/yr (or $149/yr) on top of the $49/yr ($149/yr) for ACF Pro.
 *
 * @todo Bug Charles and get the function to enabled `tel:` fields to work.
 *
 * @todo: Either add a field for name 'Suffixes' or explore PHP-based way to ignore
 *   suffixes, so that DP Profiles can be sorted
 */
class Profiles {

	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );
		add_action( 'admin_head', array( $this, 'css' ) );

		add_filter( 'manage_profiles_posts_columns', array( $this, 'add_custom_columns' ) );
		add_action( 'manage_profiles_posts_custom_column', array( $this, 'render_custom_columns' ), 10, 2 );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @access public
	 * @return void
	 */
	public function register() : void {
		$custom_post_type = 'profiles'; // Replace with custom name.

		$labels = array(
			'name'                  => _x( 'Profiles', 'Post Type General Name', 'elegant' ),
			'singular_name'         => _x( 'Profile', 'Post Type Singular Name', 'elegant' ),
			'menu_name'             => __( 'Profiles', 'elegant' ),
			'name_admin_bar'        => __( 'Profile', 'elegant' ),
			'archives'              => __( 'Profile Archives', 'elegant' ),
			'attributes'            => __( 'Profile Attributes', 'elegant' ),
			'parent_item_colon'     => __( 'Parent Profile:', 'elegant' ),
			'all_items'             => __( 'All Profiles', 'elegant' ),
			'add_new_item'          => __( 'Add New Profile', 'elegant' ),
			'add_new'               => __( 'Add New Profile', 'elegant' ),
			'new_item'              => __( 'New Profile', 'elegant' ),
			'edit_item'             => __( 'Edit Profile', 'elegant' ),
			'update_item'           => __( 'Update Profile', 'elegant' ),
			'view_item'             => __( 'View Profile', 'elegant' ),
			'view_items'            => __( 'View Profiles', 'elegant' ),
			'search_items'          => __( 'Search Profile', 'elegant' ),
			'not_found'             => __( 'Profile Not found', 'elegant' ),
			'not_found_in_trash'    => __( 'Profile Not found in Trash', 'elegant' ),
			'featured_image'        => __( 'Featured Image', 'elegant' ),
			'set_featured_image'    => __( 'Set featured image', 'elegant' ),
			'remove_featured_image' => __( 'Remove featured image', 'elegant' ),
			'use_featured_image'    => __( 'Use as featured image', 'elegant' ),
			'insert_into_item'      => __( 'Insert into item', 'elegant' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'elegant' ),
			'items_list'            => __( 'Items list', 'elegant' ),
			'items_list_navigation' => __( 'Items list navigation', 'elegant' ),
			'filter_items_list'     => __( 'Filter items list', 'elegant' ),
		);

		$rewrite = array(
			'slug'       => _x( 'profile', 'profile slug', 'elegant' ),
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		$supports = array(
			'title',
			'thumbnail',
			'revisions',
		);

		$args = array(
			'label'               => __( 'Profile', 'elegant' ),
			'description'         => __( 'General profile for faculty, staff, students and alumni.', 'elegant' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'taxonomies'          => array( 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 7,
			'menu_icon'           => 'dashicons-buddicons-buddypress-logo',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'rest_base'           => 'profile',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		register_post_type( $custom_post_type, $args );
	}


	/**
	 * Add custom columns
	 *
	 * @param array $columns Array of columns.
	 * @return array $new_columns
	 * @link https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
	 */
	public function add_custom_columns( array $columns ) : array {

		$new_columns = array();

		foreach ( $columns as $key => $value ) {
			if ( 'title' === $key ) {
				$new_columns['thumbnail'] = __( 'Thumbnail', 'elegant' );
			}

			$new_columns[ $key ] = $value;
		}
		return $new_columns;
	}


	/**
	 * Render custom columns
	 *
	 * @param string $column_name The column name.
	 * @param int    $post_id The ID of the post.
	 * @link https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
	 *
	 * @return void
	 */
	public function render_custom_columns( string $column_name, int $post_id ) : void {
		switch ( $column_name ) {
			case 'thumbnail':
				if ( get_the_post_thumbnail( $post_id ) ) {
					echo '<a href="' . esc_attr( get_edit_post_link( $post_id ) ) . '">';
					the_post_thumbnail( 'full' );
					echo '</a>';
				} else {
					echo '—';
				}

				break;
		}
	}


	/**
	 * CSS
	 *
	 * Uncomment to add custom CSS, if needed.
	 *
	 * @return bool
	 */
	public function css() : bool {
		global $typenow;

		if ( 'event' !== $typenow ) {
			return false;
		}

		?>
		<!-- <style>
			.fixed .column-thumbnail {
				vertical-align: top;
				width: 80px;
			}

			.column-thumbnail a {
				display: block;
			}
			.column-thumbnail a img {
				display: inline-block;
				vertical-align: middle;
				width: 80px;
				height: 80px;
				object-fit: cover;
				object-position: center;
			}
		</style> -->
		<?php

		return true;
	}
}
