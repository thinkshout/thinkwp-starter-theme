<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://github.com/timber/starter-theme
 * @link https://github.com/thinkshout/thinkwp-starter-theme
 */

namespace App;

use Timber\Timber;

require_once __DIR__ . '/src/StarterSite.php';

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber\Timber' ) ) {
	add_action(
		'admin_notices',
		function () {
			echo '<div class="error"><p>Timber not activated. Make sure to install via composer.</p></div>';
		}
	);
	return;
}

Timber::init();

new StarterSite();
