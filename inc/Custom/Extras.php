<?php // phpcs:ignore
/**
 * Extras
 *
 * @package Elegant
 */

namespace Elegant\Custom;

/**
 * Extras.
 */
class Extras {
	/**
	 * Run default hooks and actions for WordPress
	 *
	 * @return void
	 */
	public function run() : void {
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}


	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * Displays the class names for the body element.
	 *
	 * @todo Add an auto-class for 'Post', 'Events', 'News', etc. (Use get_post_type()? )
	 *
	 * @param array $classes Space-separated string or array of class names to add to the class list.
	 *
	 * @return $classes array
	 */
	public function body_class( $classes ) : array {
		if ( is_front_page() ) {
			$classes[] = 'Front-page';
		}

		if ( ! is_front_page() ) {
			$classes[] = 'Page';
		}

		return $classes;
	}

}
