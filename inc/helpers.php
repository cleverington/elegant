<?php
/**
 * Utilities
 *
 * PHP version 7.2.10
 *
 * @category Utilities
 * @package  Elegant
 * @author   Charles Leverington
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://19h47.fr
 */

if ( ! function_exists( 'get_html_class' ) ) :

	/**
	 * Retrieve the classes for the html element as an array.
	 *
	 * @param  string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function get_html_class( $class = '' ) {
		$classes = array();
		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}
		$classes = array_map( 'esc_attr', $classes );
		/**
		 * Filter the list of CSS html classes for the current post or page.
		 *
		 * @param array  $classes An array of html classes.
		 * @param string $class   A comma-separated list of additional classes added to the html.
		 */
		$classes = apply_filters( 'html_class', $classes, $class );

		return array_unique( $classes );
	}
endif;


if ( ! function_exists( 'html_class' ) ) :

	/**
	 * Display the classes for the html element.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function html_class( $class = '' ) {
		// Separates classes with a single space, collates classes for html element.
		return 'class="' . join( ' ', get_html_class( $class ) ) . '"';
	}
endif;


/**
 * Get theme manifest
 *
 * If WebPack has not generated a manifest, skip enqueue.
 *
 * @todo Replace file_get_contents() with wp_remote_get().
 * @return bool|array
 */
function get_theme_manifest() {
	$file = get_template_directory() . '/dist/manifest.json';

	if ( file_exists( $file ) ) {
		$js_data = json_decode( file_get_contents( $file ), true ); // phpcs:ignore

		return $js_data; // phpcs:ignore
	}

	return false;
}

/**
 * Retrieve the name of the theme.
 *
 * @since  1.0.0
 * @return string The name of the theme.
 */
function get_theme_name() : string {
	return wp_get_theme()->Name;
}

/**
 * Retrieve the text domain.
 *
 * @since  1.0.0
 * @return string The text domain.
 */
function get_theme_text_domain() : string {
	return wp_get_theme()->get( 'TextDomain' );
}

/**
 * Meta Box Removal
 * Solution modified from: Misha Rudrastyh
 * https://rudrastyh.com/wordpress/tag-metabox-like-categories.html
 *
 * $id: string: Can be found in page source box for metabox.
 * $post_type: string or array of strings: List of Post Types to remove.
 * $position: string: Current position of metabox to be removed.
 *
 * @author Charles Leverington
 * @since 1.0.0
 * @param string $id is the id-tag from the HTML element.
 * @param string $post_type is the associated post type.
 * @param string $position is where the metabox is loaded (side, main, etc.).
 * @return void
 */
function elegant_meta_box_remove( $id = 'tagsdiv-post_tag', $post_type = 'post', $position = 'side' ) : void {

	remove_meta_box( $id, $post_type, $position );

	add_action( 'admin_menu', 'elegant_meta_box_remove' );
}
