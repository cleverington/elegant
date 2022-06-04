<?php
/**
 * Class Admin
 *
 * PHP version 7.x
 *
 * @author  Charles Leverington
 * @package Elegant
 */

namespace Elegant\Setup;

/**
 * Admin class
 */
class Admin {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_filter( 'admin_footer_text', array( $this, 'set_admin_footer_text' ) );
		add_action( 'admin_init', array( $this, 'disable_site_comments_admin' ) );
		add_action('wp_head', array( $this, 'hide_wp_link_in_admin_bar') );
	}

	/**
	 * Set admin footer text
	 *
	 * @link   https://developer.wordpress.org/reference/hooks/admin_footer_text/
	 * @author Charles Leverington
	 * @access public
	 * @return string
	 */
	public function set_admin_footer_text() {
		return 'Thank you for creating with the College of Education 🔥';
	}

	/**
	 * Disables Comments, Trackbacks, and Metaboxes, then adjusts Redirects
	 *
	 * Adapted from https://gist.github.com/mattclements/eab5ef656b2f946c4bfb.
	 *
	 * Disables comments and then adds numerous functions to disable
	 * trackbacks, metaboxes, and adds redirects.
	 *
	 * To re-enable comments, comment out 'disable_site_comments_admin' action in run().
	 *
	 * @author Charles Leverington
	 * @access public
	 * @return void
	 */
	public function disable_site_comments_admin() : void {
		// Remove comments links from admin bar.
		add_action(
			'init',
			function() {
				if ( is_admin_bar_showing() ) {
					remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
				}
			}
		);

		// Remove comments page in menu.
		add_action(
			'admin_menu',
			function() {
				remove_menu_page( 'edit-comments.php' );
			}
		);

		// Close comments on the front-end.
		add_filter(
			'comments_open',
			function() {
				return false;
			}
		);

		add_filter(
			'pings_open',
			function() {
				return false;
			}
		);

		// Hide existing comments.
		add_filter(
			'comments_array',
			function( $comments ) {
				$comments = array();
				return $comments;
			}
		);

		// Removes comments from WP's Admin Bar.
		add_action( 'wp_before_admin_bar_render', 'remove_comments_toolbar_node', 999 );

		// Remove comments metabox from dashboard.
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

		// Disable support for comments and trackbacks in post types.
		disable_site_comments_post_types_support();

		// Redirect any user trying to access comments page.
		disable_site_comments_admin_menu_redirect();
	}


	/**
	 * Disable support for comments and trackbacks in post types
	 *
	 * Helper function for disable_site_comments_admin().
	 *
	 * @access public
	 * @return void
	 */
	public function disable_site_comments_post_types_support() : void {
		$post_types = get_post_types();
		foreach ( $post_types as $post_type ) {
			if ( post_type_supports( $post_type, 'comments' ) ) {
				remove_post_type_support( $post_type, 'comments' );
				remove_post_type_support( $post_type, 'trackbacks' );
			}
		}
	}

	/**
	 * Redirect any user trying to access comments page
	 *
	 * Helper function for disable_site_comments_admin().
	 *
	 * @todo Replace wp_redirect() with wp_safe_redirect().
	 * @access public
	 * @return void
	 */
	public function disable_site_comments_admin_menu_redirect() : void {
		global $pagenow;
		if ( 'edit-comments.php' === $pagenow ) {
			wp_redirect( admin_url() ); // phpcs:ignore
			exit;
		}
	}

	/**
	 * Removes comments from WP's Admin Bar
	 *
	 * Helper function for disable_site_comments_admin()
	 *
	 * @access public
	 * @param object $wp_admin_bar is WP's admin bar.
	 * @return void
	 */
	public function remove_comments_toolbar_node( $wp_admin_bar ) : void {

		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'comments' );
	}

	/**
	 * Remove the Admin Bar's 'WordPress' link
	 *
	 * For logged in users (admins) hide the WordPress link in the admin bar.
	 * This is a custom theme. We can act like it!
	 *
	 * @since 1.0.1
	 */
	public static function hide_wp_link_in_admin_bar() {
		if ( is_user_logged_in() ) : ?>
			<style>#wp-admin-bar-wp-logo{display:none}</style>
			<?php
		endif;

	}
}
