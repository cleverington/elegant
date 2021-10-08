<?php
/**
 * Block: Example
 *
 * Example ACF Block for the Block Editor.
 *
 * @package Elegant
 */

namespace Elegant\Block\Example;

use Timber;

/**
 * Block: Example
 *
 * @access public
 */
class Example {
	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run() {
		add_action( 'acf/init', array( $this, 'acf_block_gutenberg_generate' ) );
	}

	/**
	 * ACF Generate Block for Block Editor
	 *
	 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/ for all available settings.
	 * @return bool | acf_register_block
	 */
	public function acf_block_gutenberg_generate() {
		if ( ! function_exists( 'acf_register_block_type' ) ) {
			return false;
		}

		$settings = array(
			'name'            => 'example-block',
			'title'           => __('Example Block', 'elegant'),
			'description'     => __('A customizable block of Post-selected content.'),
			'render_callback' => array( $this, 'acf_block_gutenberg_callback' ),
			'category'        => 'common',
			'icon'            => 'dashicons-admin-appearance',
			'post_types'      => array( 'page', 'post' ),
			'keywords'        => array( 'example', 'posts' ),
			'mode'            => 'edit',
			'align'           => 'full',
			'example'         => array( // Adds block previews!
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'example_header'  => 'Heading Text....',
						'example_content' => 'Body content. Lorem ipsum and such.',
						'role'            => 'Person',
						'is_preview'      => true,
					),
				),
			),
		);

		return acf_register_block( $settings );
	}

	/**
	 * This is the callback that displays the custom ACF block.
	 *
	 * @param arr  $block The block settings and attributes.
	 * @param str  $content The block content (empty string).
	 * @param bool $is_preview True during AJAX preview.
	 * @return void
	 */
	public function acf_block_gutenberg_callback( $block, $content = '', $is_preview = false ) {

		$slug = str_replace( 'acf/', '', $block['name'] );

		$context = Timber::context();

		// Store block values.
		$context['block']       = $block;
		$context['id_of_block'] = $block['id'];

		// Store field values.
		$context['content'] = get_fields();

		// Get the preview, if preset.
		$context['is_preview'] = $is_preview;

		// Render the block, if present.
		if ( ! empty( $context['content'] ) ) {
			Timber::render( 'inc/Block/Example/views/example-block.twig', $context );
		}
	}

	/**
	 * Enqueue Assets
	 *
	 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/ -> enqueue_assets.
	 */
	public function acf_enqueue_assets() {
		// Get the latest file-changes.
		$elegant_css_ver = gmdate( 'ymd-Gis', filemtime( get_template_directory_uri() . '/inc/Block/Example/css/Example.css' ) );
		$elegant_js_ver  = gmdate( 'ymd-Gis', filemtime( get_template_directory_uri() . 'inc/Block/Example/js/Example.js' ) );

		// Add theming.
		// Note: wp_enqueue_style() typically unused due to Gulp.
		wp_enqueue_style( 'example_block_css', get_template_directory_uri() . '/inc/Block/Example/scss/Example.scss', false, $elegant_css_ver );
		wp_enqueue_script(
			'example_block_js',
			get_template_directory_uri() . '/inc/Block/Example/js/Example.js',
			array( 'jquery' ),  // Load jQuery?
			$elegant_js_ver,  // Auto-generate version?
			true          // Load via Footer?
		);
	}

}
