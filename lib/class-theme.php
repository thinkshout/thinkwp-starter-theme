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
 * Sets template directory locations inside the theme.
 */
Timber::$locations = array( get_template_directory() . '/templates', get_template_directory() );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 */
class Theme extends Timber\Site {
	/**
	 * Scripts version.
	 *
	 * @var string $scripts_version The version of the scripts to be used.
	 */
	protected $scripts_version = '';
	/**
	 * Scripts directory.
	 *
	 * @var string $this->scripts_dir The directory of the scripts to be used.
	 */
	protected $scripts_dir = 'dist';
	/**
	 * Theme menus.
	 *
	 * @var array $this->menus The menus to be registered.
	 */
	protected $thinktimber_menus = array();

	/** Add timber support. */
	public function __construct() {
		// Theme activation and deactivation hooks!
		add_action( 'after_switch_theme', array( $this, 'thinktimber_activate' ) );

		// Actions, Filters, and Theme Setup!
		// Actions.
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'after_setup_theme', array( $this, 'thinktimber_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'thinktimber_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'thinktimber_admin_scripts' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'thinktimber_block_editor_scripts' ) );
		add_action( 'admin_init', array( $this, 'thinktimber_disable_comments' ) );
		add_action( 'admin_init', array( $this, 'remove_content_editor' ) );
		add_action( 'admin_menu', array( $this, 'thinktimber_remove_comments_page' ) );

		// Filters.
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_filter( 'acf/settings/save_json', array( $this, 'thinktimber_acf_json_save_point' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'thinktimber_acf_json_load_point' ) );
		add_filter( 'render_block', array( $this, 'thinktimber_wrap_gutenberg_blocks' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'check_post_can_gutenberg' ), 10, 2 );
		add_filter( 'gutenberg_can_edit_post_type', array( $this, 'check_post_can_gutenberg' ), 10, 2 );
		add_filter( 'allowed_block_types_all', array( $this, 'allowed_block_types' ), 10, 2 );
		// Disable Comments and Ping Backs.
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );
		// XML-RPC Disabler.
		add_filter( 'xmlrpc_enabled', '__return_false' );

		// Set scripts version to theme version set in style.css.
		$this->scripts_version = wp_get_theme()->get( 'Version' );

		// Theme menus.
		$this->thinktimber_menus = array(
			array(
				'location'    => 'header_primary_navigation',
				'description' => 'Header Primary Navigation',
			),
			array(
				'location'    => 'header_utility_navigation',
				'description' => 'Header Utility Navigation',
			),
			array(
				'location'    => 'footer_about',
				'description' => 'Footer About',
			),
			array(
				'location'    => 'footer_programs',
				'description' => 'Footer Programs',
			),
			array(
				'location'    => 'footer_get_involved',
				'description' => 'Footer Get Involved',
			),
			array(
				'location'    => 'footer_copyright',
				'description' => 'Footer Copyright',
			),
		);

		// If the Timber ACF Blocks library is installed, load it. https://github.com/palmiak/timber-acf-wp-blocks .
		if ( class_exists( 'Timber_Acf_Wp_Blocks' ) ) {
			// Register blocks in views/blocks with ACF.
			new Timber_Acf_Wp_Blocks();
		}

		// That's it, construct the parent Timber\Site object.
		parent::__construct();
	}

	/**
	 * Theme activation hook
	 */
	public function thinktimber_activate() {
		// Create a style guide page if it doesn't exist.
		$style_guide_page = array(
			'post_title'  => 'Style Guide',
			'post_status' => 'private',
			'post_author' => 1,
			'post_type'   => 'page',
		);
		// Check if the page exists.
		$style_guide_page_check = get_page_by_title( $style_guide_page['post_title'] );
		// If the page doesn't exist, create it.
		if ( ! $style_guide_page_check ) {
			wp_insert_post( $style_guide_page );
		}
		// Add any additional activation code here.
	}

	/** This is where you can register custom post types. */
	public function register_post_types() {
		require_once __DIR__ . '/helpers/class-custom-post-type.php';
		$thinktimber_post_types = array();
		foreach ( $thinktimber_post_types as $thinktimber_post_type ) {
			$thinktimber_post_type->add_to_wp();
		}
	}

	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {
		require_once __DIR__ . '/helpers/class-custom-taxonomy.php';
		$thinktimber_taxonomies = array();
		foreach ( $thinktimber_taxonomies as $thinktimber_taxonomy ) {
			$thinktimber_taxonomy->add_to_wp();
		}
	}

	/**
	 * Get post loaded in editor
	 */
	protected function get_admin_post() {
		// @codingStandardsIgnoreStart
		if ( ! ( is_admin() && ! empty( $_GET['post'] ) ) ) {
			return null;
		}
		return $_GET['post'];
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Check if we're editing the style guide page.
	 */
	protected function is_style_guide_page() {
		$post_id = $this->get_admin_post();
		if ( is_null( $post_id ) ) {
			return false;
		}
		$style_guide_page    = get_page_by_title( 'Style Guide' );
		$style_guide_page_id = strval( $style_guide_page->ID );
		if ( $style_guide_page_id === $post_id ) {
			return true;
		}
		return false;
	}

	/**
	 * Remove Gutenberg Editor from front page and any other pages that shouldn't have it.
	 *
	 * @param boolean $can_edit true or false user can edit.
	 */
	public function check_post_can_gutenberg( $can_edit ) {
		$post_id = $this->get_admin_post();
		if ( is_null( $post_id ) ) {
			return $can_edit;
		}
		$post_can_gutenberg = true;
		if ( get_option( 'page_on_front' ) === $post_id || $this->is_style_guide_page() ) {
			$post_can_gutenberg = false;
		}
		return $post_can_gutenberg;
	}

	/**
	 * Remove Content Editor from front page
	 */
	public function remove_content_editor() {
		$post_id = $this->get_admin_post();
		if ( is_null( $post_id ) ) {
			return;
		}
		if ( get_option( 'page_on_front' ) === $post_id || $this->is_style_guide_page() ) {
			remove_post_type_support( 'page', 'editor' );
		}
	}

	/**
	 * Filter allowed gutenberg blocks.
	 *
	 * @param array                   $allowed_block_types Allowed block types.
	 * @param WP_Block_Editor_Context $block_editor_context The block editor context.
	 *
	 * @return array
	 */
	public function allowed_block_types( $allowed_block_types, $block_editor_context ) {
		// If we're not on a post, return the default allowed block types.
		if ( empty( $block_editor_context->post ) ) {
			return $allowed_block_types;
		}

		require_once __DIR__ . '/helpers/allowed-blocks.php';

		// Make sure we allow our ACF blocks.
		$acf_block_types     = acf_get_store( 'block-types' );
		$acf_block_types     = array_keys( $acf_block_types->get_data() );
		$allowed_block_types = array_merge( $thinkwp_allowed_blocks, $acf_block_types );

		return $allowed_block_types;
	}

	/**
	 * Add wrapping div to all core gutenberg blocks.
	 *
	 * @param string $block_content The block content about to be appended.
	 * @param array  $block The block being rendered.
	 *
	 * @return string The block content with a wrapping div.
	 */
	public function thinktimber_wrap_gutenberg_blocks( $block_content, $block ) {
		// Target core/* and core-embed/* blocks.
		return $block_content;
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your lib/class-theme.php file';
		$context['notes'] = 'These values are available every time you call Timber::context();';

		// Add menus to context.
		$context['menus'] = array();
		foreach ( $this->thinktimber_menus as $thinktimber_menu ) {
			$context['menus'][ $thinktimber_menu['location'] ] = new Timber\Menu( sanitize_title( $thinktimber_menu['description'] ) );
		}

		// Add site to context.
		$context['site'] = $this;

		// Add site logo to context if it exists.
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id ) {
			$context['site_logo'] = new Timber\Image( $custom_logo_id );
		}

		// Return context.
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
		 * Register navigation menus.
		 */
		$thinktimber_nav_menus = array();
		foreach ( $this->thinktimber_menus as $nav_menu ) {
			$thinktimber_nav_menus[ $nav_menu['location'] ] = $nav_menu['description'];
		}
		register_nav_menus( $thinktimber_nav_menus );

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

		/**
		 * Enable support for Custom Logo.
		 * 
		 * @link https://developer.wordpress.org/themes/functionality/custom-logo/
		 */
		add_theme_support( 'custom-logo' );

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

		add_theme_support( 'editor-styles' );
		add_editor_style( "$this->scripts_dir/motif-admin.css" );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function thinktimber_scripts() {
		wp_enqueue_style( 'thinktimber-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap', array(), $this->scripts_version );
		wp_enqueue_style( 'thinktimber-styles', get_template_directory_uri() . "/$this->scripts_dir/motif.css", array(), $this->scripts_version );
		wp_enqueue_script( 'thinktimber-scripts', get_template_directory_uri() . "/$this->scripts_dir/motif.js", array( 'jquery' ), $this->scripts_version, true );

		wp_localize_script(
			'thinktimber-scripts',
			'thinktimber',
			array(
				'themeBase' => get_theme_file_uri(),
				'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			)
		);

		wp_enqueue_script( 'thinktimber-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), $this->scripts_version, true );

		wp_enqueue_script( 'thinktimber-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), $this->scripts_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Enqueue admin scripts and styles.
	 */
	public function thinktimber_admin_scripts() {
		// Fonts.
	}

	/**
	 * Enqueue block editor scripts and styles.
	 */
	public function thinktimber_block_editor_scripts() {
		// Scripts.
		wp_enqueue_script( 'thinktimber-admin-scripts', get_template_directory_uri() . "/$this->scripts_dir/motif-admin.js", array( 'wp-edit-post' ), $this->scripts_version, true );
	}

	/**
	 * Modify ACF JSON save point.
	 *
	 * @param string $path The path to the ACF JSON save point.
	 *
	 * @return string The path to the ACF JSON save point.
	 */
	public function thinktimber_acf_json_save_point( $path ) {
		$path = get_stylesheet_directory() . '/acf-json';

		return $path;
	}

	/**
	 * Modify ACF JSON load point.
	 *
	 * @param array $paths The paths to the ACF JSON load points.
	 *
	 * @return array The paths to the ACF JSON load points.
	 */
	public function thinktimber_acf_json_load_point( $paths ) {
		$paths[] = get_stylesheet_directory() . '/acf-json';

		return $paths;
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
	 * Get posts by an array of IDs.
	 *
	 * @param array $post_ids The post IDs to get.
	 *
	 * @return array The timber posts.
	 */
	public function get_posts_by_ids( $post_ids = array() ) {
		$posts = array();
		foreach ( $post_ids as $post_id ) {
			$posts[] = new Timber\Post( $post_id );
		}
		return $posts;
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
		// Get Posts by IDs.
		$twig->addFunction(
			new Timber\Twig_Function(
				'get_posts_by_ids',
				array( $this, 'get_posts_by_ids' )
			)
		);
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}
