<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  Elegant
 * @since    1.0.0
 */

$context         = Timber::context();
$single_post     = Timber::get_post();
$context['post'] = $single_post;

/** Get all the POST TYPES terms */
$all_posttype_terms            = get_the_terms( $single_post->ID, 'post_types' );
$context['all_posttype_terms'] = $all_posttype_terms;

if ( $all_posttype_terms ) {
	$context['parent_posttype_term'] = reset( $all_posttype_terms );
}

/**
 * Get Most recent posts in category but not posts that are opinions or offsite
 *
 * Another Option:
 *   $current_category = $current_category[0]->cat_ID;
 */
$current_category = get_the_category( $single_post->ID );

/**
 * Query Timber
 *
 * Example Custom Query:
 *  'tax_query'     => array(
 *    array(
 *     'taxonomy' => '',
 *     'terms' => array(
 *    ),
 *    'field' => 'slug',
 *    'operator' => 'NOT IN',
 *   ),
 *  ),
 */
$context['latest_posts'] = Timber::get_posts(
	array(
		'post_type'    => 'post',
		'numberposts'  => 3,
		'offset'       => 0,
		/** 'category__in' => array( $current_category ), */
		'post_status'  => 'publish',
		'order'        => 'DESC',
		'post__not_in' => array( $single_post->ID ),
	)
);

if ( post_password_required( $single_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $single_post->ID . '.twig', 'single-' . $single_post->post_type . '.twig', 'single.twig' ), $context );
}
