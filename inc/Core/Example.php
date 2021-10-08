<?php // phpcs:disable
/**
 * Example
 *
 * @package Elegant
 */

namespace Elegant\Core;

// /**
//  * Example
//  */
// class Example {

// 	/**
// 	 * Runs initialization tasks.
// 	 *
// 	 * @access public
// 	 */
// 	public function run() {
// 		add_action( 'init', array( $this, 'register' ), 10, 0 );
// 		add_action( 'admin_head', array( $this, 'css' ) );

// 		add_filter( 'manage_example_posts_columns', array( $this, 'add_custom_columns' ) );
// 		add_action( 'manage_example_posts_custom_column', array( $this, 'render_custom_columns' ), 10, 2 );
// 	}


// 	/**
// 	 * Register Custom Post Type
// 	 *
// 	 * @access public
// 	 * @return void
// 	 */
// 	public function register() : void {
		// $custom_post_type = 'examples'; // Replace with custom name.

		// $labels = array(
		// 		'name'                  => _x( 'Post Types', 'Post Type General Name', 'elegant' ),
		// 		'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'elegant' ),
		// 		'menu_name'             => __( 'Post Types', 'elegant' ),
		// 		'name_admin_bar'        => __( 'Post Type', 'elegant' ),
		// 		'archives'              => __( 'Item Archives', 'elegant' ),
		// 		'attributes'            => __( 'Item Attributes', 'elegant' ),
		// 		'parent_item_colon'     => __( 'Parent Item:', 'elegant' ),
		// 		'all_items'             => __( 'All Items', 'elegant' ),
		// 		'add_new_item'          => __( 'Add New Item', 'elegant' ),
		// 		'add_new'               => __( 'Add New', 'elegant' ),
		// 		'new_item'              => __( 'New Item', 'elegant' ),
		// 		'edit_item'             => __( 'Edit Item', 'elegant' ),
		// 		'update_item'           => __( 'Update Item', 'elegant' ),
		// 		'view_item'             => __( 'View Item', 'elegant' ),
		// 		'view_items'            => __( 'View Items', 'elegant' ),
		// 		'search_items'          => __( 'Search Item', 'elegant' ),
		// 		'not_found'             => __( 'Not found', 'elegant' ),
		// 		'not_found_in_trash'    => __( 'Not found in Trash', 'elegant' ),
		// 		'featured_image'        => __( 'Featured Image', 'elegant' ),
		// 		'set_featured_image'    => __( 'Set featured image', 'elegant' ),
		// 		'remove_featured_image' => __( 'Remove featured image', 'elegant' ),
		// 		'use_featured_image'    => __( 'Use as featured image', 'elegant' ),
		// 		'insert_into_item'      => __( 'Insert into item', 'elegant' ),
		// 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'elegant' ),
		// 		'items_list'            => __( 'Items list', 'elegant'),
		// 		'items_list_navigation' => __( 'Items list navigation', 'elegant' ),
		// 		'filter_items_list'     => __( 'Filter items list', 'elegant' ),
		// );

		// $rewrite = array(
		// 	'slug'       => _x( 'example', 'example slug', 'elegant' ),
		// 	'with_front' => true,
		// 	'pages'      => true,
		// 	'feeds'      => true,
		// );

		// $supports = array(
		// 	'title',
		// 	'editor',
		// 	'thumbnail',
		// 	'revisions',
		// 	'excerpt',
		// );

		// // Check 'events.php' for full example of in-use '$args'.
		// $args = array(
		// 		'label'                 => __( 'Post Type', 'elegant' ),
		// 		'description'           => __( 'Post Type Description', 'elegant' ),
		// 		'labels'                => $labels,
		// 		'supports'              => $supports,
		// 		'taxonomies'            => array( 'category', 'post_tag' ),
		// 		'hierarchical'          => false,
		// 		'public'                => true,
		// 		'show_ui'               => true,
		// 		'show_in_menu'          => true,
		// 		'menu_position'         => 8, // increment for each custom post type
		// 		'menu_icon'           => 'dashicons-groups', // See https://developer.wordpress.org/resource/dashicons/#bank for options
		// 		'show_in_admin_bar'     => true,
		// 		'show_in_nav_menus'     => true,
		// 		'show_in_rest'        => true,
		// 		'rest_base'           => 'example',
		// 		'can_export'            => true,
		// 		'has_archive'           => true,
		// 		'exclude_from_search'   => false,
		// 		'publicly_queryable'    => true,
		// 		'capability_type'       => 'page',
		// );

		// register_post_type( $custom_post_type, $args );
// 	}


// 	/**
// 	 * Add custom columns
// 	 *
// 	 * @param array $columns Array of columns.
// 	 * @return array $new_columns
// 	 * @link https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
// 	 */
// 	public function add_custom_columns( array $columns ) : array {

// 		$new_columns = array();

// 		foreach ( $columns as $key => $value ) {
// 			if ( 'title' === $key ) {
// 				$new_columns['thumbnail'] = __( 'Thumbnail', 'elegant' );
// 			}

// 			$new_columns[ $key ] = $value;
// 		}
// 		return $new_columns;
// 	}


// 	/**
// 	 * Render custom columns
// 	 *
// 	 * @param string $column_name The column name.
// 	 * @param int    $post_id The ID of the post.
// 	 * @link https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
// 	 *
// 	 * @return void
// 	 */
// 	public function render_custom_columns( string $column_name, int $post_id ) : void {
// 		switch ( $column_name ) {
// 			case 'thumbnail':
// 				if ( get_the_post_thumbnail( $post_id ) ) {
// 					echo '<a href="' . esc_attr( get_edit_post_link( $post_id ) ) . '">';
// 					the_post_thumbnail( 'full' );
// 					echo '</a>';
// 				} else {
// 					echo '—';
// 				}

// 				break;
// 		}
// 	}


// 	/**
// 	 * CSS
// 	 *
// 	 * Uncomment to add custom CSS, if needed.
// 	 *
// 	 * @return bool
// 	 */
// 	public function css() : bool {
// 		global $typenow;

// 		if ( 'event' !== $typenow ) {
// 			return false;
// 		}

// 		?>
// 		<!-- <style>
// 			.fixed .column-thumbnail {
// 				vertical-align: top;
// 				width: 80px;
// 			}

// 			.column-thumbnail a {
// 				display: block;
// 			}
// 			.column-thumbnail a img {
// 				display: inline-block;
// 				vertical-align: middle;
// 				width: 80px;
// 				height: 80px;
// 				object-fit: cover;
// 				object-position: center;
// 			}
// 		</style> -->
// 		<?php // phpcs:ignore

// 		return true;
// 	}
// }
