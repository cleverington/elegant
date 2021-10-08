<?php
/**
 * Block: Hero
 *
 * ACF Block for a mobile 'Hero Area'.
 *
 * Loads breadcrumbs, if placed first.
 *
 * @package Elegant
 */

namespace Elegant\Block\Hero;

use Timber;

/**
 * Block: Hero
 *
 * @access public
 */
class Hero {
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
	 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 * @return bool | acf_register_block
	 */
	public function acf_block_gutenberg_generate() {
		if ( ! function_exists( 'acf_register_block_type' ) ) {
			return false;
		}

		$settings = array(
			'name'            => 'hero-area',
			'title'           => __('Hero Area', 'elegant'),
			'description'     => __('Hero Area block.'),
			'render_callback' => array( $this, 'acf_block_gutenberg_callback' ),
			'category'        => 'common',
			'icon'            => 'dashicons-layout',
			'post_types'      => array( 'page', 'post' ),
			'keywords'        => array( 'hero', 'hero area' ),
			'mode'            => 'edit',
			'align'           => 'full',
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
			Timber::render( 'inc/Block/Hero/views/hero-area.twig', $context );
		}
	}

}
