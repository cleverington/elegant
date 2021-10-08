<?php
/**
 * Block: Feed Block
 *
 * ACF Block for selecting curated listings of posts and displaying via a Gutenberg Block.
 *
 * @package Elegant
 */

namespace Elegant\Block\Feedblock;

use Timber;

/**
 * Block: Feed Block
 *
 * @access public
 */
class FeedBlock {
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
	 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/ for full options.
	 * @return bool | acf_register_block
	 */
	public function acf_block_gutenberg_generate() {
		if ( ! function_exists( 'acf_register_block_type' ) ) {
			return false;
		}

		$settings = array(
			'name'            => 'feed-block',
			'title'           => __('Feed Block', 'elegant'),
			'description'     => __('A customizable block of Post-selected content.'),
			'render_callback' => array( $this, 'acf_block_gutenberg_callback' ),
			'category'        => 'common',
			'icon'            => 'dashicons-tickets',
			'post_types'      => array( 'page', 'post' ),
			'keywords'        => array( 'feed', 'posts' ),
			'mode'            => 'edit',
			'align'           => 'full',
			'enqueue_assets'  => 'acf_enqueue_assets', // See acf_enqueue_assets().
		);

		return acf_register_block_type( $settings );
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
		$context['content'] = get_fields(); // Get all ACF fields.
		// Get the preview, if preset.
		$context['is_preview'] = $is_preview;

		// Render the block, if present.
		if ( ! empty( $context['content'] ) ) {
			Timber::render( 'inc/Block/Feedblock/views/feed-blocks.twig', $context );
		}
	}

	/**
	 * Enqueue Assets
	 *
	 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/ -> enqueue_assets
	 */
	public function acf_enqueue_assets() {
		// Get the latest file-changes.
		$elegant_js_ver = gmdate( 'ymd-Gis', filemtime( get_template_directory_uri() . 'inc/Block/Feedblock/js/Feedblock.js' ) );

		wp_enqueue_script(
			'feed_block_js',
			get_template_directory_uri() . '/inc/Block/Feedblock/js/Feedblock.js',
			array( 'jquery' ),  // Load jQuery?
			$elegant_js_ver,  // Auto-generate version?
			true          // Load via Footer?
		);
	}
}
