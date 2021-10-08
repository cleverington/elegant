<?php
/**
 * Front page
 *
 * @package Elegant
 * @author  Charles Leverington
 * @todo 'new Timber\Post()' is deprecated in 2.x.
 */

use Timber\{ Timber, Post };

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

$context = Timber::context();

$context['post']       = new Post();
$context['node_type']  = 'default-page';
$context['body_class'] = 'index';

$templates = array( 'front-page.twig', 'index.twig', 'base.twig' );

Timber::render( $templates, $context );
