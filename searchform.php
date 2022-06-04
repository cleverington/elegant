<?php
/**
 * Template: SearchForm
 *
 * @package  Elegant
 * @since    1.0.0
 */

$context = Timber::get_context();
$site    = new TimberSite();

Timber::render( 'searchform.twig', $context );