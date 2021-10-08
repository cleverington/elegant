<?php
/**
 * Enqueue
 *
 * @package Elegant
 */

namespace Elegant\Setup;

use Timber\{ Timber };

/**
 * Enqueue
 */
class Enqueue {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() : void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts
	 *
	 * @access public
	 * @return void
	 * @since  1.0.0
	 */
	public function enqueue_scripts() : void {
		wp_deregister_script( 'wp-embed' );

		if ( 'true' === getenv( 'PRODUCTION' ) ) {
			wp_deregister_script( 'jquery' );
		}

		if ( ! null === get_theme_manifest() ) {
			wp_register_script( // phpcs:ignore
				get_theme_text_domain() . '-main',
				get_template_directory_uri() . '/' . get_theme_manifest()['main.js'],
				array(),
				null,
				true
			);
		}

		wp_localize_script(
			get_theme_text_domain() . '-main',
			'elegant',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);

		wp_enqueue_script( // phpcs:ignore
			'feature',
			'//cdnjs.cloudflare.com/ajax/libs/feature.js/1.0.1/feature.min.js',
			array(),
			null,
			false
		);
		wp_add_inline_script(
			'feature',
			'document.documentElement.className=document.documentElement.className.replace("no-js","js"),feature.touch&&!navigator.userAgent.match(/Trident\/(6|7)\./)&&(document.documentElement.className=document.documentElement.className.replace("no-touch","touch"));'
		);

		wp_enqueue_script( get_theme_text_domain() . '-main' );
	}


	/**
	 * Enqueue styles.
	 *
	 * @access public
	 * @return void
	 * @since  1.0.0
	 */
	public function enqueue_style() : void {

		wp_dequeue_style( 'wp-block-library' );

		if ( ! null === get_theme_manifest() ) {
			// Theme stylesheet.
			wp_register_style( // phpcs:ignore
				get_theme_text_domain() . '-global',
				get_template_directory_uri() . '/' . get_theme_manifest()[' .css'],
				array(),
				null
			);
		}

		wp_enqueue_style( get_theme_text_domain() . '-global' );
	}

}
