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
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$templates = array( 'templates/pages/page.twig' );

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

// Add page slug based template lookup.
array_unshift(
	$templates,
	'templates/pages/page-' . $timber_post->post_name
	. '.twig'
);

// Check if this is the style guide page.
if ( 'style-guide' === $timber_post->post_name ) {
	$acf_block_types      = acf_get_store( 'block-types' );
	$context['ts_blocks'] = $acf_block_types->get_data();
}

// Check if this is the home page and add template lookup.
if ( is_front_page() ) {
	array_unshift( $templates, 'templates/pages/page-home.twig' );
}

Timber::render( $templates, $context );
