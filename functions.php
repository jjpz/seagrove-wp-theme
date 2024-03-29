<?php

include '.env.php';

/**
 * seagrove functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package seagrove
 */

if (!function_exists('seagrove_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function seagrove_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on seagrove, use a find and replace
		 * to change 'seagrove' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('seagrove', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			//'menu-1' => esc_html__( 'Primary', 'seagrove' ),
			'main_nav_left' => __('Main Navigation - Left', 'seagrove'),
			'main_nav_right' => __('Main Navigation - Right', 'seagrove'),
			'footer_nav' => __('Footer Navigation', 'seagrove')
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('seagrove_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
}
add_action('after_setup_theme', 'seagrove_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
function seagrove_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('seagrove_content_width', 640);
}
add_action('after_setup_theme', 'seagrove_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function seagrove_widgets_init() {
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'seagrove'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'seagrove'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
//add_action( 'widgets_init', 'seagrove_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Enqueue scripts and styles.
 */
function seagrove_scripts() {
	wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1');

	if (is_front_page() || is_singular('property')) {
		wp_enqueue_style('slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
		wp_enqueue_script('slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
	}

	wp_enqueue_style('seagrove-style', get_stylesheet_uri());

	if (is_front_page()) {
		wp_enqueue_script('instafeed-js', get_template_directory_uri() . '/assets/dist/lib/js/instafeed.min.js', array(), '', true);
	}

	if (is_page_template(array('page-map.php', 'page-listings.php', 'page-sold.php', 'page-commercial.php', 'page-contact.php')) || is_singular(array('property', 'agent'))) {
		$API_KEY = getenv('GMAPS_API_KEY');
		wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . $API_KEY, array(), '', true);
		wp_enqueue_script('markerclusterer-js', 'https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js', array(), '', true);
		wp_enqueue_script('maps-js', get_template_directory_uri() . '/assets/dist/js/maps.min.js', array('jquery'), '1.0', true);
	}

	// wp_enqueue_script('seagrove-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true);
	// wp_enqueue_script('seagrove-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

	if (is_singular('property')) {
		wp_enqueue_script('clipboardjs', 'https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js', array(), '', true);
	}

	// Comments
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/dist/js/main.min.js', array('jquery'), '1.0', true);
	//wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), '1.12.1', true );
}
add_action('wp_enqueue_scripts', 'seagrove_scripts');

if (wp_get_environment_type() === 'local') {
	// Include the composer autoloader for the Sentry library
	include_once __DIR__ . '/vendor/autoload.php';
	// Register error handler to report to Sentry
	Sentry\init([
		'dsn' => getenv('SENTRY_DSN'),
		// Be sure to lower this in production to prevent quota issues
		'traces_sample_rate' => 1.0,
	]);
	// Sample error
	//throw new Exception("TEST ERROR!");
}
