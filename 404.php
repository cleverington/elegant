<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  Elegant
 * @since    Timber 0.1
 * @author  Charles Leverington
 */

$context = Timber::context();

$context['node_type']  = 'default-page';
$context['body_class'] = '404';

Timber::render( 'pages/404.twig', $context );
