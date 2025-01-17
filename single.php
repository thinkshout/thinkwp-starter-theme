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
$templates = [ 'posts/single-' . $post->post_type . '.twig', 'posts/single.twig' ];

if ( post_password_required( $post->ID ) ) {
	$templates = 'posts/single-password.twig';
}

Timber::render( $templates, $context );
