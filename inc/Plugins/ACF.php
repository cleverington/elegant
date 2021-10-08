<?php // phpcs:ignore
/**
 * ACF
 *
 * @package Elegant
 * @subpackage Elegant/Plugins/ACF
 */

namespace Elegant\Plugins;

use WP_Post;

/**
 * WordPress
 */
class ACF {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		// Show field set on password protected pages.
		add_filter( 'acf/location/rule_types', array( $this, 'rules_types' ) );
		add_filter( 'acf/location/rule_values/visibility', array( $this, 'rules_values_visibility' ) );
		add_filter( 'acf/location/rule_match/visibility', array( $this, 'rules_match_visibility' ), 10, 3 );

		// Add Configuration page, if associated ACF exists.
		// Note: Access requires 'Administrator' user-level.
		if ( current_user_can( 'activate_plugins' ) ) {
			// Adds Site Configuration options menu.
			if ( function_exists( 'acf_set_options_page_menu' ) ) {
				acf_add_options_page(
					array(
						'page_title' => __( 'Site Configuration' ),
						'menu_title' => __( 'Configuration' ),
						'menu_slug'  => 'configuration',
						'capability' => 'edit_others_posts',
						'redirect'   => false,
					)
				);
			}
		}
	}



	/**
	 * Location rules types
	 *
	 * @param arr $choices The choices.
	 * @return $choices
	 */
	public function rules_types( $choices ) {

		$choices['Page']['visibility'] = __( 'Post Visibility' );

		return $choices;

	}



	/**
	 * Location rules values visibility
	 *
	 * @param  arr $choices The choices.
	 * @return $coices
	 */
	public function rules_values_visibility( $choices ) {

		$choices['password'] = __( 'Password Protected' );

		return $choices;
	}


	/**
	 * Location rules match visibility
	 *
	 * @param  [type] $match   Match.
	 * @param  [type] $rule    Rule.
	 * @param  arr    $options Array of options.
	 *
	 * @return $match
	 */
	public function rules_match_visibility( $match, $rule, $options ) {
		$post          = get_post( $options['post_id'] );
		$post_password = $post->post_password;

		if ( isset( $post_password ) ) {
			if ( ! empty( $post_password ) ) {
				$match = true;
			}
		} else {
			$match = false;
		}

		return $match;
	}

	/**
	 * Hide ACF 'Custom Class' field(s) from non-Admins
	 *
	 * Helper ACF function to limit the 'Custom CSS Class' field from being
	 *   used by non-admins. The limit is imposed for accessibility, as
	 *   incorrect utility class usage can lead to WCAG violations.
	 *
	 * See acf.php on uc-wft-roadmap20 for example usage.
	 *
	 * @param [type] $field references each ACF field, in turn.
	 * @return $field or false
	 */
	public function hide_custom_class_field( $field ) {
		// Hide the ACF field is user is not admin.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return false;
		}

		return $field;
	}
}
