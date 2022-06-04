<?php
/**
 * Template: Search
 *
 * @package  Elegant
 * @since    1.0.0
 */

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );

$context                 = Timber::context();
$context['search_query'] = get_search_query();
$context['title']        = 'Search results for "' . $context['search_query'] . '"';

// Limit posts to just 'Page' and 'Resource' post types.
$args = array(
	'post_type' => array(
		'resources',
		'page',
		'media-press',
	),
	's' => get_search_query(),
);

$context['posts']        = Timber::get_posts( $args );
$context['pagination']   = Timber::get_pagination();

/** Add 'Options' to Pages */
$context['page_options'] = get_fields('options');

/** Yoast SEO Breadcrumbs */
if ( function_exists( 'yoast_breadcrumb' ) ) {
	$context['breadcrumbs'] = yoast_breadcrumb('<nav id="breadcrumbs" class="main-breadcrumbs">', '</nav>', false );
}

Timber::render( $templates, $context );