<?php
/**
 * The Template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

namespace App;

use Timber\Timber;

$context   = Timber::context();
$post      = $context['post'];
$templates = [ 'pages/single-' . $post->post_type . '.twig', 'pages/single.twig' ];

if ( post_password_required( $post->ID ) ) {
	$templates = 'pages/single-password.twig';
}

Timber::render( $templates, $context );
