<?php
/**
 * Block: Promo Repeater
 *
 * Promo Repeater ACF Block for the Block Editor.
 *
 * @todo Determine if a 'subheader' is needed and/or should be included to 'match' other layouts.
 *
 * @package Elegant
 */

namespace Elegant\Block\PromoRepeater;

use Timber;

/**
 * Block: Feed Block
 *
 * @access public
 */
class PromoRepeater {
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
			'name'            => 'promo-repeater',
			'title'           => __('Promo Repeater', 'elegant'),
			'description'     => __('A structured content block for grouped content.'),
			'render_callback' => array( $this, 'acf_block_gutenberg_callback' ),
			'category'        => 'common',
			'icon'            => 'dashicons-welcome-widgets-menus',
			'post_types'      => array( 'page', 'post' ),
			'keywords'        => array( 'example', 'posts' ),
			'mode'            => 'edit',
			'align'           => 'full',
			'example'         => array( // Adds block previews!
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'testimonial' => 'Happy people....',
						'author'      => 'Other things.',
						'role'        => 'Person',
						'is_preview'  => true,
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
			Timber::render( 'inc/Block/Promorepeater/views/promo-repeater.twig', $context );
		}
	}

}
