<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber.This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( class_exists( 'Timber\Timber' ) ) {
	$timber = new Timber\Timber();
} else {
	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure to install via composer.</p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 */
class Theme extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		// Theme activation and deactivation hooks!
		register_activation_hook( __FILE__, [ $this, 'thinktimber_activate' ] );

		// Actions, Filters, and Theme Setup!
		add_action( 'after_setup_theme', [ $this, 'thinktimber_content_width' ], 0 );
		add_action( 'after_setup_theme', [ $this, 'thinktimber_setup' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'thinktimber_scripts' ] );
		add_filter( 'timber/context', [ $this, 'add_to_context' ] );
		add_filter( 'timber/twig', [ $this, 'add_to_twig' ] );
		add_action( 'init', [ $this, 'register_post_types' ] );
		add_action( 'init', [ $this, 'register_taxonomies' ] );
		parent::__construct();
	}

	/**
	 * Theme activation hook
	 */
	public function thinktimber_activate() {
		$style_guide_page = array(
			'post_title'  => 'Style Guide',
			'post_status' => 'private',
			'post_author' => 1,
			'post_type'   => 'page'
		);
		wp_insert_post( $style_guide_page );
		// Add any additional activation code here.
	}

	/** This is where you can register custom post types. */
	public function register_post_types() {
		require_once __DIR__ . '/helpers/class-custom-post-type.php';
		$thinktimber_post_types = [];
		foreach ( $thinktimber_post_types as $thinktimber_post_type ) {
			$thinktimber_post_type->add_to_wp();
		}
	}

	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {
		require_once __DIR__ . '/helpers/class-custom-taxonomies.php';
		$thinktimber_taxonomies = [];
		foreach ( $thinktimber_taxonomies as $thinktimber_taxonomy ) {
			$thinktimber_taxonomy->add_to_wp();
		}
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['menu']  = new Timber\Menu();
		$context['site']  = $this;
		return $context;
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function thinktimber_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thinktimber, use a find and replace
		 * to change 'thinktimber' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'thinktimber', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function thinktimber_scripts() {
		$scripts_version = '1.0.0';
		$scripts_dir = 'dist';
		wp_enqueue_style( 'thinktimber-styles', get_template_directory_uri() . "/$scripts_dir/main.css", [], $scripts_version );
		wp_enqueue_script( 'thinktimber-scripts', get_template_directory_uri() . "/$scripts_dir/main.min.js", [ 'jquery' ], $scripts_version, true );

		wp_localize_script(
			'thinktimber-scripts',
			'thinktimber',
			array(
				'themeBase' => get_theme_file_uri(),
				'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			)
		);

		wp_enqueue_script( 'alpinejs', 'https://unpkg.com/alpinejs@3.4.1/dist/cdn.min.js', [], '3.4.1', false );
		wp_enqueue_script( 'thinktimber-alpine', get_template_directory_uri() . '/js/alpine.js', [ 'alpinejs' ], $scripts_version, false );

		wp_enqueue_script( 'thinktimber-navigation', get_template_directory_uri() . '/js/navigation.js', [], $scripts_version, true );

		wp_enqueue_script( 'thinktimber-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', [], $scripts_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function thinktimber_content_width() {
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'thinktimber_content_width', 640 );
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/**
	 * Console Logging PHP Values
	 *
	 * @param multi $value The variables to be logged.
	 */
	public function php_console( $value = null ) {
		// Console Log a mixed var.
		echo '<script type="text/javascript">console.log(' . wp_json_encode( $value ) . ');</script>';
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		// PHP Console.
		$twig->addFunction(
			new Timber\Twig_Function(
				'console',
				array( $this, 'php_console' )
			)
		);
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}
