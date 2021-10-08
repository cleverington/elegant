<?php // phpcs:ignore
/**
 * Event
 *
 * @package Elegant
 */

namespace Elegant\Core;

/**
 * Event
 *
 * @todo: Re-name 'Excerpt' field to 'Event Teaser' (just for this post-type).
 */
class Events {

	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ), 10, 0 );
		add_action( 'admin_head', array( $this, 'css' ) );

		add_filter( 'manage_event_posts_columns', array( $this, 'add_custom_columns' ) );
		add_action( 'manage_event_posts_custom_column', array( $this, 'render_custom_columns' ), 10, 2 );
	}


	/**
	 * Register Custom Post Type
	 *
	 * @access public
	 * @return void
	 */
	public function register() : void {
		$custom_post_type = 'events'; // Replace with custom name.

		$description = 'Events post type'; // Replace with short description.

		$labels = array(
			'name'                     => _x( 'Events', 'event type generale name', 'elegant' ),
			'singular_name'            => _x( 'Event', 'event type singular name', 'elegant' ),
			'add_new'                  => _x( 'Add New', 'event type', 'elegant' ),
			'add_new_item'             => __( 'Add New Event', 'elegant' ),
			'edit_item'                => __( 'Edit Event', 'elegant' ),
			'new_item'                 => __( 'New Event', 'elegant' ),
			'view_item'                => __( 'View Event', 'elegant' ),
			'view_items'               => __( 'View Events', 'elegant' ),
			'search_items'             => __( 'Search Events', 'elegant' ),
			'not_found'                => __( 'No events found.', 'elegant' ),
			'not_found_in_trash'       => __( 'No events found in Trash.', 'elegant' ),
			'parent_item_colon'        => __( 'Parent Event:', 'elegant' ),
			'all_items'                => __( 'All Events', 'elegant' ),
			'archives'                 => __( 'Event Archives', 'elegant' ),
			'attributes'               => __( 'Event Attributes', 'elegant' ),
			'uploaded_to_this_item'    => __( 'Uploaded to this event', 'elegant' ),
			'insert_into_item'         => __( 'Insert into event', 'elegant' ),
			'featured_image'           => _x( 'Featured Image', 'event', 'elegant' ),
			'set_featured_image'       => _x( 'Set featured image', 'event', 'elegant' ),
			'remove_featured_image'    => _x( 'Remove featured image', 'event', 'elegant' ),
			'use_featured_image'       => _x( 'Use as featured image', 'event', 'elegant' ),
			'items_list_navigation'    => __( 'Events list navigation', 'elegant' ),
			'items_list'               => __( 'Events list', 'elegant' ),
			'item_published'           => __( 'Event published.', 'elegant' ),
			'item_published_privately' => __( 'Event published privately.', 'elegant' ),
			'item_reverted_to_draft'   => __( 'Event reverted to draft.', 'elegant' ),
			'item_scheduled'           => __( 'Event scheduled.', 'elegant' ),
			'item_updated'             => __( 'Event updated.', 'elegant' ),
		);

		$rewrite = array(
			'slug'       => _x( 'event', 'event slug', 'elegant' ),
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'excerpt',
		);

		$args = array(
			'label'               => __( 'Event', 'elegant' ),
			'description'         => __( 'Post Type for entering College of Education events.', 'elegant' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'taxonomies'          => array( 'post_tag', 'locations' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'rest_base'           => 'event',
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-groups',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
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
