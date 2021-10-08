<?php
/**
 * Bootstraps WordPress theme related functions, most importantly enqueuing javascript and styles.
 *
 * @package Elegant
 */

namespace Elegant;

use Elegant\{ Setup, Custom, Plugins, Block, Core, Taxonomy };

/**
 * Init
 */
class Init {

	/**
	 * Store all the classes inside an array
	 *
	 * @todo: Compare with usage of PHP's default 'DirectoryIterator' class
	 *   as used by 'Flynt'. This approach violates PSR12, but Flynt's doesn't.
	 *   https://github.com/flyntwp/flynt/blob/master/functions.php
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() : array {
		return array(
			Setup\Theme::class,
			Setup\Enqueue::class,
			Setup\WordPress::class,
			Setup\Menus::class,
			Setup\Supports::class,
			Setup\Textdomain::class,
			Custom\Extras::class,
			Plugins\ACF::class,
			Plugins\TinyMCE::class,
			/** Add Custom Taxonomies. */
			Taxonomy\Locations::class,
			/** Add Custom Post Types. */
			Core\Events::class,
			Core\Researchlabs::class,
			Core\Profiles::class,
			/** Add Component: Block Editor Blocks. */
			Block\Featuredhighlight\Featuredhighlight::class,
			Block\Feedblock\Feedblock::class,
			Block\Hero\Hero::class,
			Block\PromoRepeater\PromoRepeater::class,
			Block\TabBox\TabBox::class,
		);
	}

	/**
	 * Function to run all services.
	 *
	 * Loop through the classes, initialize them, and call the run() method if
	 *   it exists.
	 *
	 * @return void
	 */
	public static function run_services() : void {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'run' ) ) {
				$service->run();
			}
		}
	}


	/**
	 * Initialize the class
	 *
	 * @param  string $class class name from the services array.
	 * @return object
	 */
	private static function instantiate( string $class ) : object {
		return new $class();
	}

}
