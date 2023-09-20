<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package WordPress
 * @subpackage  Timber
 */

/**
 * Grab necessary theme class from lib dir
 */
require_once get_template_directory() . '/lib/class-theme.php';

/**
 * Instantiate theme
 */
new Theme();

function add_font() {
  $font_script = <<<'EOD'
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  EOD;
  echo $font_script;
}
add_action('wp_head', 'add_font');