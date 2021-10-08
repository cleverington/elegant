<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  Elegant
 * @since    Timber 0.1
 * @todo 'new Timber\Post()' is deprecated in 2.x.
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

/**
 * ACF's Page Options
 *
 * Add this line:
 * $context['page_options'] = get_field('page_options');
 */

Timber::render( array( 'pages/page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context);
