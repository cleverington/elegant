<?php
/**
 * Index
 *
 * @package Elegant
 * @author  Charles Leverington
 * @todo 'new Timber\Post()' is deprecated in 2.x.
 */

use Timber\{ Timber, Post };

$context = Timber::context();

$context['post']       = new Post();
$context['node_type']  = 'default-page';
$context['body_class'] = 'index';

$templates = array( 'index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}
Timber::render( $templates, $context );
