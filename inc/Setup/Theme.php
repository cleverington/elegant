<?php
/**
 * Bootstraps WordPress theme related functions, most importantly enqueuing javascript and styles.
 *
 * @package Elegant
 * @subpackage Elegant/Setup/Theme
 *
 * @todo Create a custom Class for managing 'allowed_block_types' which automatically searches a specific set of 'Component' folders.
 *  See https://rudrastyh.com/gutenberg/remove-default-blocks.html#block_manager
 */

namespace Elegant\Setup;

use Timber\{ Timber, Menu };
use Twig\{ TwigFunction };

/**
 * Initialize Timber via new Timber\Timber()
 */
$timber = new Timber();

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/no-timber/index.html';
		}
	);
	return;
}

/**
 * Set available Timber directories.
 */
Timber::$dirname = elegant_get_timber_template_directories();

/**
 * Theme
 */
class Theme {

	/**
	 * The manifest of this theme
	 *
	 * @access private
	 * @var    array
	 */
	private $theme_manifest;

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function run() : void {
		$this->theme_manifest = get_theme_manifest();

		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_filter( 'timber_context', array( $this, 'add_menus_to_context' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_to_theme' ) );

		/**
		 * Optional Contructor Filter (if function added)
		 * add_filter( 'timber_context', array( $this, 'add_socials_to_context' ) );
		 */
	}

	/**
	 * Add to Twig
	 *
	 * @param object $twig Twig environment.
	 * @return object $twig
	 * @access public
	 */
	public function add_to_twig( object $twig ) : object {
		if ( function_exists( 'post_class' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'post_class',
					function ( $class = '', $post_id = null ) {
						return post_class( $class, $post_id );
					}
				)
			);
		}

		if ( function_exists( 'body_class' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'body_class',
					function ( $args = '' ) {
						return body_class( $args );
					}
				)
			);
		}

		if ( function_exists( 'html_class' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'html_class',
					function ( $args = '' ) {
						return html_class( $args );
					}
				)
			);
		}

		if ( function_exists( 'yoast_breadcrumb' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'yoast_breadcrumb',
					function () {
						return yoast_breadcrumb();
					}
				)
			);
		}

		if ( function_exists( 'get_body_class' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'get_body_class',
					function () {
						return get_body_class();
					}
				)
			);
		}

		if ( function_exists( 'do_shortcode' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'do_shortcode',
					function ( $id ) {
						return do_shortcode();
					}
				)
			);
		}

		if ( function_exists( 'wp_get_document_title' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'wp_get_document_title',
					function () {
						return wp_get_document_title();
					}
				)
			);
		}

		return $twig;
	}

	/**
	 * Add to theme
	 *
	 * @param array $context Timber context.
	 */
	public function add_to_theme( array $context ) : array {
		$context['theme']->manifest = get_theme_manifest();

		return $context;
	}

	/**
	 * Add menus to context
	 *
	 * @param array $context Timber context.
	 * @return array
	 * @since  1.0.0
	 */
	public function add_menus_to_context( array $context ) : array {
		$menus = get_registered_nav_menus();

		foreach ( $menus as $menu => $value ) {
			$context['menus'][ $menu ] = new Menu( $menu );
		}

		return $context;
	}

	/**
	 * Add to context
	 *
	 * @param array $context Timber context.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	public function add_to_context( array $context ) : array {
		global $wp;

		$context['current_url'] = home_url( add_query_arg( array(), $wp->request ) );

		return $context;
	}

}

/**
 * Loader function for Timber Direcgtories.
 *
 * Note: Requires Component have following directory structure:
 *   - PHP: /<component-type>/<component-name>/<component>.php
 *   - TWIG: /<component-type>/<component-name>/views/<component>.twig
 * Example: See 'inc/Block'.
 */
function elegant_get_timber_template_directories() {
	// Blank array for gathering Timber template file paths.
	$timber_paths = array();

	// Add Block Component paths.
	$timber_paths = elegant_add_to_timber_paths( '/inc/Block/' );

	// Add Default (and expected) Timber directories.
	$timber_paths[] = 'views';
	$timber_paths[] = 'templates';
	$timber_paths[] = 'dist';

	return $timber_paths;
}

/**
 * Helper function to add various Components to Timber.
 *
 * @param string $location Format: /dir/ or /parent/dir/ for path.
 * @return array of paths.
 */
function elegant_add_to_timber_paths( string $location ) {

	// Add Block component directories.
	$component_paths = glob( get_template_directory() . $location . '*', GLOB_ONLYDIR );

	$timber_paths = [];

	// Loop through each folder and determine what the main php filename for the associated block is.
	foreach ( $component_paths as $component_path ) {

		$component_name = basename( $component_path );
		$file_location  = get_template_directory() . $location . $component_name . '/' . $component_name . '.php';

		// If Block exists, include it.
		if ( file_exists( $file_location ) ) {
			include $file_location;
			$timber_paths[] = get_template_directory() . $location . $component_name . '/views';
		}
	}

	return $timber_paths;
}
