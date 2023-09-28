<?php
/**
 * Template Name: Landing Page Template
 *
 * @package WordPress
 * @subpackage thinktimber
 * @since ThinkTimber 1.0
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
Timber::render( array( 'templates/template-landing-page.twig', 'pages/page-' . $timber_post->post_name . '.twig', 'pages/page.twig' ), $context );
