<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 */

namespace App;

use Timber\Timber;

$context = Timber::context();

if ( isset( $context['author'] ) ) {
	$context['title'] = sprintf( __( 'Archive of %s', 'thinktimber' ), $context['author']->name() );
}

Timber::render( [ 'pages/author.twig', 'pages/archive.twig' ], $context );
