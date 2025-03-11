<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

namespace App;

use Timber\Timber;

$context = Timber::context();
$post = $context['post'];

// Check if this is the style guide page.
if ( 'style-guide' === $post->post_name ) {
  $styleguide_directory_scans = array(
    'ts_blocks' => '/views/organisms/blocks',
    'ts_molecules' => '/views/molecules',
  );
  foreach( $styleguide_directory_scans as $context_label => $theme_path ) {
    $context[$context_label] = [];
    $directory = get_template_directory() . $theme_path;
    $element_directories = scandir($directory);
    if ($element_directories) {
      foreach ($element_directories as $id) {
        $styleguide_file = "$directory/$id/styleguide/$id--styleguide-layout.twig";
        if ( file_exists( $styleguide_file ) ) {
          $controller_file = "$directory/$id/controller/$id--controller.twig";
          if ( file_exists( $styleguide_file ) ) {

          }
          $context[$context_label][$id] = ucfirst(str_replace('-', ' ', $id));
        }
      }
    }
  }
}

$templates = array( 'pages/page-' . $post->post_name . '.twig', 'pages/page.twig' );

if ( is_front_page() ) {
	array_unshift( $templates, 'pages/front-page.twig' );
}

Timber::render( $templates, $context );
