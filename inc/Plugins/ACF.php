<?php // phpcs:ignore
/**
 * ACF
 *
 * @package Elegant
 * @subpackage Elegant/Plugins/ACF
 * @todo Add validation to auto-exit if 'acf' doesn't exist.
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
		add_filter( 'acf/validate_value/type=url', array( $this, 'acf_validate_url' ) );

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

	/**
	 * Allow ACF URL fields to accept ALL URLs
	 * 
	 * By default, the 'url' field doesn't accept things like 'tel:', 'mailto:',
	 *   or '#' based urls.  This function adds functional support.
	 * 
	 * @see https://www.advancedcustomfields.com/resources/acf-validate_value/
	 * @param boolean $valid true / false whether valid or not.
	 * @param string  $value value from ACF field.
	 * @param object  $field is the associated ACF field.
	 * @param string  $input user's inputted telephone number.
	 * @return boolean $valid confirms that the saved field is valid.
	 */
	public static function acf_validate_url( $valid, $value, $field, $input ) {

		// These are strings that a possible URL can start with and still be a valid URL.
		//   Otherwise it only accepts strings that start with 'http://' or 'https://'.
		$valid_url_prefixes = [
			'tel:', // Allow telephone links.
			'mailto:', // Allow email links.
			'#', // Allow jump/null links.
		];
	
		foreach ( $valid_url_prefixes as $prefix ) {
			if ( strpos($value, $prefix) === 0 ) {
				// If $value (the string value from the ACF field) starts with one of
				//   the prefixes defined above, then this is a valid URL.
				$valid = true;
			}
		}
	
		return $valid;
	}
}
