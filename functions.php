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
