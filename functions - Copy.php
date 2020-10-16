<?php
/**
 * solid functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package solid
 */

if ( ! function_exists( 'solid_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function solid_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on solid, use a find and replace
		 * to change 'solid' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'solid', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			//'menu-1' => esc_html__( 'Primary', 'solid' ),
			'main_nav_left' => __( 'Main Navigation - Left', 'solid' ),
			'main_nav_right' => __( 'Main Navigation - Right', 'solid' ),
			'footer_nav' => __( 'Footer Navigation', 'solid' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'solid_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
}
add_action( 'after_setup_theme', 'solid_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
function solid_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'solid_content_width', 640 );
}
add_action( 'after_setup_theme', 'solid_content_width', 0 );

/**
 * Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function solid_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'solid' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'solid' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'solid_widgets_init' );

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';
/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';
/* Functions which enhance the theme by hooking into WordPress. */
require get_template_directory() . '/inc/template-functions.php';
/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';
/* Load Jetpack compatibility file. */
if ( defined( 'JETPACK__VERSION' ) ) { require get_template_directory() . '/inc/jetpack.php'; }

/* Enqueue scripts and styles. */
function solid_scripts() {
	// CSS
	//wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/css/bootstrap-grid.min.css', array(), '4.2.1' );
	wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1' );

	//if ( is_front_page() || is_singular('property') ) {
		wp_enqueue_style( 'slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1' );
	//}

	wp_enqueue_style( 'solid-style', get_stylesheet_uri() );

	if ( is_page_template( array( 'page-map.php', 'page-listings.php', 'page-sold.php', 'page-commercial.php', 'page-contact.php' ) ) || is_singular( array( 'property', 'agent' ) ) ) {
		wp_enqueue_style( 'maps', get_template_directory_uri() . '/maps.css', array(), '1.0' );
	}

	wp_enqueue_style( 'custom', get_template_directory_uri() . '/custom.css', array(), '1.0' );

	// JS
	//if ( is_front_page() || is_singular('property') ) {
		wp_enqueue_script( 'slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true );
	//}

	if ( is_front_page() ) {
		wp_enqueue_script( 'instafeed-js', get_template_directory_uri() . '/js/instafeed.min.js', array(), '', true );
	}

	if ( is_page_template( array( 'page-map.php', 'page-listings.php', 'page-sold.php', 'page-commercial.php', 'page-contact.php' ) ) || is_singular( array( 'property', 'agent' ) ) ) {
		$API_KEY = 'AIzaSyCOIFLDkRXYDQgdf8AFQdpzYd_io6sQ8fk';
		wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?key='.$API_KEY, array(), '', true );
		wp_enqueue_script( 'listings-js', get_template_directory_uri() . '/js/listings.js', array('jquery'), '1.0', true );
	}

	wp_enqueue_script( 'solid-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'solid-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular('property') ) {
		wp_enqueue_script( 'clipboardjs', 'https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js', array(), '', true );
	}

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), '1.12.1', true );
}
add_action( 'wp_enqueue_scripts', 'solid_scripts' );

/********************
 * CUSTOM FUNCTIONS *
 ********************/

// Admin login logo
add_action('login_enqueue_scripts', function(){
	?><style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/SeaGrove_icon.svg);
			background-size: contain;
			background-position: center top;
			background-repeat: no-repeat;
			width: 100px;
			margin: 0 auto 25px;
		}
	</style><?php
});

// Admin login logo URL
add_filter('login_headerurl', function(){
	return home_url();
});

// Admin login logo text
add_filter('login_headertext', function(){
	return get_bloginfo('name');
});

// Admin favicon
add_filter('admin_head', function(){
	echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/favicons/favicon.ico">';
});

// Admin CSS + JS
add_action('admin_enqueue_scripts', function(){
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css', array(), '1.0.0');
	wp_enqueue_script('admin-custom-js', get_stylesheet_directory_uri() . '/js/admin-custom.js');
});

// Remove WP 5.3+ new image scaling sizes
add_filter('intermediate_image_sizes_advanced', function($sizes){
	unset($sizes['1536x1536']);
	unset($sizes['2048x2048']);
	return $sizes;
});

// Remove WP 5.3+ new "big image" threshold
//add_filter('big_image_size_threshold', '__return_false');

// Add post types to the Admin Dashboard Activity Widget
add_filter( 'dashboard_recent_posts_query_args', function($query){
	if ( is_admin() ) {
		// return all post types
		// $post_types = get_post_types();
		// return post types of your choice
		$post_types = ['post', 'page', 'attachment', 'property', 'agent', 'marketing', 'partnership', 'wpcf7_contact_form'];
		if ( is_array( $query['post_type'] ) ) {
			$query['post_type'] = $post_types;
		} else {
			$temp = $post_types;
			$query['post_type'] = $temp;
		}
		return $query;
	}
});

// Add post types to the Admin Dashboard At a Glance Widget
add_action( 'dashboard_glance_items', function(){
	$args = array(
		'public' => true,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	$post_types = get_post_types( $args, $output, $operator );
	foreach ( $post_types as $post_type ) {
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
			echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
		}
	}
});

/****************
 * Carbon Fields
 ****************/

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Theme Options
add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
	$theme_options = Container::make( 'theme_options', __( 'Theme Options' ) )
		->set_page_menu_position( 4 )
		->set_icon( 'dashicons-admin-generic' )
		->add_fields( array(
			Field::make( 'separator', 'crb_contact_separator', 'Contact' ),
			Field::make( 'text', 'crb_theme_address', 'Address' ),
			Field::make( 'text', 'crb_theme_city', 'City' )->set_classes( 'admin-col-4' ),
			Field::make( 'text', 'crb_theme_state', 'State' )->set_classes( 'admin-col-4' ),
			Field::make( 'text', 'crb_theme_zipcode', 'Zip Code' )->set_classes( 'admin-col-4' ),
			Field::make( 'text', 'crb_theme_lat', 'Latitude' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_theme_lng', 'Longitude' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_theme_phone', 'Phone' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_theme_email', 'Email' )->set_classes( 'admin-col-6' ),
			Field::make( 'separator', 'crb_social_separator', 'Social Media' ),
			Field::make( 'text', 'crb_theme_facebook_link', __( 'Facebook Link' ) ),
			Field::make( 'text', 'crb_theme_instagram_link', __( 'Instagram Link' ) ),
			Field::make( 'text', 'crb_theme_youtube_link', __( 'Youtube Link' ) ),
			Field::make( 'separator', 'crb_sharefile_separator', 'Sharefile' ),
			Field::make( 'text', 'crb_theme_sharefile_link_url', 'Sharefile Login Link URL' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_theme_sharefile_link_text', 'Sharefile Login Link Text' )->set_classes( 'admin-col-6' ),
			Field::make( 'separator', 'crb_loaderimg_separator', 'Loader Image' ),
			Field::make( 'image', 'crb_theme_loader_image', 'Loader Image' )
		) );
}

// Property Gallery
add_action( 'carbon_fields_register_fields', 'crb_property_meta' );
function crb_property_meta() {
	Container::make( 'post_meta', __( 'Property Gallery', 'crb' ) )
		->where( 'post_type', '=', 'property' )
		->add_fields( array(
			Field::make( 'media_gallery', 'crb_property_media_gallery', __( 'Media Gallery' ) )
		) );
}

// Agent Info
add_action( 'carbon_fields_register_fields', 'crb_agent_meta' );
function crb_agent_meta() {
	Container::make( 'post_meta', __( 'Agent Info - CRB', 'crb' ) )
		->where( 'post_type', '=', 'agent' )
		->add_fields( array(
			Field::make( 'complex', 'crb_agent_education', 'Education' )->set_classes( 'admin-agent-info' )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'agent_education', 'School' )
				) ),
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_agent_languages', 'Languages' )->set_classes( 'admin-agent-info' )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'agent_language', 'Language' )
				) ),
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_agent_community', 'Community' )->set_classes( 'admin-agent-info' )
				->set_layout( 'grid' )
				->add_fields( array(
					Field::make( 'text', 'agent_community', 'Community' )
				) ),
		) );
}

// Home About Section
add_action( 'carbon_fields_register_fields', 'crb_home_about_meta' );
function crb_home_about_meta() {
	Container::make( 'post_meta', __( 'Home About Section', 'crb' ) )
		->where( 'post_id', '=', get_option( 'page_on_front' ) )
		->add_fields( array(
			Field::make( 'text', 'crb_home_about_title', 'About Headline' )
		) )
		->add_fields( array(
			Field::make( 'media_gallery', 'crb_home_about_images', __( 'About Media Gallery' ) )
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_home_about_items', 'About Subsections' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'text', 'crb_home_about_item_title', 'Headline' ),
					Field::make( 'textarea', 'crb_home_about_item_text', 'Paragraph' ),
					Field::make( 'text', 'crb_home_about_item_link_url', 'Link URL' ),
					Field::make( 'text', 'crb_home_about_item_link_text', 'Link Text' )
				) )
		) );
}

// Buying About Section
add_action( 'carbon_fields_register_fields', 'crb_buy_about_meta' );
function crb_buy_about_meta() {
	Container::make( 'post_meta', __( 'Buying About Section', 'crb' ) )
		->show_on_template( 'page-buy.php' )
		->add_fields( array(
			Field::make( 'text', 'crb_buy_about_btn_url', 'Button URL' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_buy_about_btn_text', 'Button Text' )->set_classes( 'admin-col-6' )
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_buy_about_items', 'About Subsections' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'text', 'crb_buy_about_item_title', 'Headline' ),
					Field::make( 'textarea', 'crb_buy_about_item_text', 'Paragraph' ),
					Field::make( 'text', 'crb_buy_about_item_link_url', 'Link URL' ),
					Field::make( 'text', 'crb_buy_about_item_link_text', 'Link Text' )
				) )
		) );
}

// Working With Us
add_action( 'carbon_fields_register_fields', 'crb_working_with_us_meta' );
function crb_working_with_us_meta() {
	Container::make( 'post_meta', __( 'Working With Us', 'crb' ) )
		->show_on_template( 'page-working-with-us.php' )
		->add_fields( array(
			Field::make( 'complex', 'crb_working_with_us_items', '' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'separator', 'crb_working_with_us_items_separator', 'Columns' ),
					Field::make( 'text', 'crb_working_with_us_item_title', 'Headline' ),
					Field::make( 'textarea', 'crb_working_with_us_item_text', 'Paragraph' ),
					Field::make( 'text', 'crb_working_with_us_item_link_url', 'Link URL' ),
					Field::make( 'text', 'crb_working_with_us_item_link_text', 'Link Text' )
				) )
		) )
		->add_fields( array(
			Field::make( 'separator', 'crb_working_with_us_contact_separator', 'Contact Button' ),
			Field::make( 'text', 'crb_working_with_us_btn_url', 'Button Url' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_working_with_us_btn_text', 'Button Text' )->set_classes( 'admin-col-6' )
		) );
}

// Join Our Team
add_action( 'carbon_fields_register_fields', 'crb_join_our_team_meta' );
function crb_join_our_team_meta() {
	Container::make( 'post_meta', __( 'Join Our Team', 'crb' ) )
		->show_on_template( 'page-join-our-team.php' )
		->add_fields( array(
			Field::make( 'separator', 'crb_join_our_team_top_separator', 'Top Section' ),
			Field::make( 'text', 'crb_join_our_team_top_title', 'Headline' ),
			Field::make( 'textarea', 'crb_join_our_team_top_text', 'Paragraph' ),
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_join_our_team_top_items', '' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'image', 'crb_join_our_team_top_item_image', 'Image' ),
					Field::make( 'text', 'crb_join_our_team_top_item_title', 'Headline' ),
					Field::make( 'textarea', 'crb_join_our_team_top_item_text', 'Paragraph' ),
					Field::make( 'text', 'crb_join_our_team_top_item_link_url', 'Link URL' )->set_classes( 'admin-col-6' ),
					Field::make( 'text', 'crb_join_our_team_top_item_link_text', 'Link Text' )->set_classes( 'admin-col-6' )
				) )
		) )
		->add_fields( array(
			Field::make( 'separator', 'crb_join_our_team_bottom_separator', 'Bottom Section' ),
			Field::make( 'text', 'crb_join_our_team_bottom_title', 'Headline' ),
			Field::make( 'textarea', 'crb_join_our_team_bottom_text', 'Paragraph' ),
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_join_our_team_bottom_items', '' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'image', 'crb_join_our_team_bottom_item_image', 'Image' ),
					Field::make( 'text', 'crb_join_our_team_bottom_item_title', 'Headline' ),
					Field::make( 'textarea', 'crb_join_our_team_bottom_item_text', 'Paragraph' ),
					Field::make( 'text', 'crb_join_our_team_bottom_item_link_url', 'Link URL' )->set_classes( 'admin-col-6' ),
					Field::make( 'text', 'crb_join_our_team_bottom_item_link_text', 'Link Text' )->set_classes( 'admin-col-6' )
				) )
		) )
		->add_fields( array(
			Field::make( 'separator', 'crb_join_our_team_contact_separator', 'Contact' ),
			Field::make( 'text', 'crb_join_our_team_contact_title', 'Contact Form Headline' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_join_our_team_contact_subtitle', 'Contact Form Subheadline' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_join_our_team_contact_shortcode', 'Contact Form Shortcode' )
		) );
}

// Consulting
add_action( 'carbon_fields_register_fields', 'crb_consulting_meta' );
function crb_consulting_meta() {
	Container::make( 'post_meta', __( 'Consulting', 'crb' ) )
		->show_on_template( 'page-consulting.php' )
		->add_fields( array(
			Field::make( 'separator', 'crb_consulting_top_separator', 'Top Section' ),
			Field::make( 'text', 'crb_consulting_top_title', 'Headline' ),
			Field::make( 'textarea', 'crb_consulting_top_text', 'Paragraph' ),
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_consulting_top_items', '' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'image', 'crb_consulting_top_item_image', 'Image' ),
					Field::make( 'text', 'crb_consulting_top_item_title', 'Headline' ),
					Field::make( 'textarea', 'crb_consulting_top_item_text', 'Paragraph' ),
					Field::make( 'text', 'crb_consulting_top_item_link_url', 'Link URL' )->set_classes( 'admin-col-6' ),
					Field::make( 'text', 'crb_consulting_top_item_link_text', 'Link Text' )->set_classes( 'admin-col-6' )
				) )
		) )
		->add_fields( array(
			Field::make( 'separator', 'crb_consulting_bottom_separator', 'Bottom Section' ),
			Field::make( 'text', 'crb_consulting_bottom_title', 'Headline' ),
			Field::make( 'textarea', 'crb_consulting_bottom_text', 'Paragraph' ),
		) )
		->add_fields( array(
			Field::make( 'complex', 'crb_consulting_bottom_items', '' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(
					Field::make( 'image', 'crb_consulting_bottom_item_image', 'Image' ),
					Field::make( 'text', 'crb_consulting_bottom_item_title', 'Headline' ),
					Field::make( 'textarea', 'crb_consulting_bottom_item_text', 'Paragraph' ),
					Field::make( 'text', 'crb_consulting_bottom_item_link_url', 'Link URL' )->set_classes( 'admin-col-6' ),
					Field::make( 'text', 'crb_consulting_bottom_item_link_text', 'Link Text' )->set_classes( 'admin-col-6' )
				) )
		) )
		->add_fields( array(
			Field::make( 'separator', 'crb_consulting_contact_separator', 'Contact' ),
			Field::make( 'text', 'crb_consulting_contact_title', 'Contact Form Headline' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_consulting_contact_subtitle', 'Contact Form Subheadline' )->set_classes( 'admin-col-6' ),
			Field::make( 'text', 'crb_consulting_contact_shortcode', 'Contact Form Shortcode' )
		) );
}

/*****************************
 * Register Custom Taxonomies
 *****************************/

function seagrove_neighborhoods_tax() {
	$labels = array(
		'name'                       => _x( 'Neighborhoods', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Neighborhood', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Neighborhoods', 'text_domain' ),
		'all_items'                  => __( 'All Neighborhoods', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Neighborhood', 'text_domain' ),
		'add_new_item'               => __( 'Add New Neighborhood', 'text_domain' ),
		'edit_item'                  => __( 'Edit Neighborhood', 'text_domain' ),
		'update_item'                => __( 'Update Neighborhood', 'text_domain' ),
		'view_item'                  => __( 'View Neighborhood', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'neighborhood',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'neighborhood', array( 'property' ), $args );
}
add_action( 'init', 'seagrove_neighborhoods_tax', 0 );

function seagrove_group_tax() {
	$labels = array(
		'name' => __( 'Group', 'text_domain' ),
		'singular_name' => __( 'Group', 'text_domain' ),
		'search_items' => __( 'Search Group', 'text_domain' ),
		'all_items' => __( 'All Group', 'text_domain' ),
		'parent_item' => __( 'Parent Group', 'text_domain' ),
		'parent_item_colon' => __( 'Parent Group:', 'text_domain' ),
		'edit_item' => __( 'Edit Group', 'text_domain' ),
		'update_item' => __( 'Update Group', 'text_domain' ),
		'add_new_item' => __( 'Add New Group', 'text_domain' ),
		'new_item_name' => __( 'New Group', 'text_domain' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'agent-group', 'with_front' => false),
	);
	register_taxonomy( 'group', array( 'agent' ), $args );
}
add_action( 'init', 'seagrove_group_tax', 0 );

/*****************************
 * Register Custom Post Types
 *****************************/

function seagrove_properties() {
	$labels = array(
		'name' => __( 'Properties', 'text_domain' ),
		'singular_name' => __( 'Property', 'text_domain' ),
		'add_new' => __( 'Add New', 'Properties' ),
		'add_new_item' => __( 'Add New Property', 'text_domain' ),
		'edit_item' => __( 'Edit Property', 'text_domain' ),
		'new_item' => __( 'New Property', 'text_domain' ),
		'view_item' => __( 'View Property', 'text_domain' ),
		'search_items' => __( 'Search Properties', 'text_domain' ),
		'not_found' => __( 'No Properties found', 'text_domain' ),
		'not_found_in_trash' => __( 'No Properties found in Trash', 'text_domain' ),
		'parent_item_colon' => ''
	);
	$rewrite = array(
		'slug' => 'properties',
		'with_front' => false,
		'hierarchical' => true
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => $rewrite,
		'capability_type' => 'post',
		'taxonomies' => array('post_tag', 'neighborhood'),
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-location-alt',
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes')
	);
	register_post_type( 'property', $args );
}
add_action( 'init', 'seagrove_properties', 0 );

function seagrove_agents() {
	$labels = array(
		'name'                  => _x( 'Agents', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Agent', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Agents', 'text_domain' ),
		'name_admin_bar'        => __( 'Agent', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Agents', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'agent',
		'with_front'            => false
	);
	$args = array(
		'label'                 => __( 'Agent', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
		'taxonomies'            => array( 'group' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page'
	);
	register_post_type( 'agent', $args );
}
add_action( 'init', 'seagrove_agents', 0 );

function seagrove_marketing() {
	$labels = array(
		'name' => __( 'Marketing', 'text_domain' ),
		'singular_name' => __( 'Marketing', 'text_domain' ),
		'add_new' => __( 'Add New', 'text_domain' ),
		'add_new_item' => __( 'Add New Marketing', 'text_domain' ),
		'edit_item' => __( 'Edit Marketing', 'text_domain' ),
		'new_item' => __( 'New Marketing', 'text_domain' ),
		'view_item' => __( 'View Marketing', 'text_domain' ),
		'search_items' => __( 'Search Marketing', 'text_domain' ),
		'not_found' => __( 'No Marketing found', 'text_domain' ),
		'not_found_in_trash' => __( 'No Marketing found in Trash', 'text_domain' ),
		'parent_item_colon' => ''
	);
	$rewrite = array(
		'slug' => 'marketing',
		'with_front' => false,
		'hierarchical' => true
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => $rewrite,
		'capability_type' => 'post',
		'taxonomies' => array(),
		'hierarchical' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-megaphone',
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes')
	);
	register_post_type( 'marketing', $args );
}
add_action( 'init', 'seagrove_marketing', 0 );

function seagrove_partnerships() {
	$labels = array(
		'name' => __( 'Partnerships', 'text_domain' ),
		'singular_name' => __( 'Partnership', 'text_domain' ),
		'add_new' => __( 'Add New Partnership', 'text_domain' ),
		'add_new_item' => __( 'Add New Partnership', 'text_domain' ),
		'edit_item' => __( 'Edit Partnership', 'text_domain' ),
		'new_item' => __( 'New Partnership', 'text_domain' ),
		'view_item' => __( 'View Partnership', 'text_domain' ),
		'search_items' => __( 'Search Partnerships', 'text_domain' ),
		'not_found' => __( 'No Partnerships found', 'text_domain' ),
		'not_found_in_trash' => __( 'No Partnerships found in Trash', 'text_domain' ),
		'parent_item_colon' => ''
	);
	$rewrite = array(
		'slug' => 'partnerships',
		'with_front' => false,
		'hierarchical' => true
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => $rewrite,
		'capability_type' => 'post',
		'taxonomies' => array(),
		'hierarchical' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-groups',
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes')
	);
	register_post_type( 'partnership', $args );
}
add_action( 'init', 'seagrove_partnerships', 0 );

/******************************************************
 * Add Google Maps metabox to Wordpress property admin
 ******************************************************/

// 1. Add Google Maps & API key
function wp_google_scripts() {
	$API_KEY = "AIzaSyCOIFLDkRXYDQgdf8AFQdpzYd_io6sQ8fk";
	wp_enqueue_script( 'google-maps-native', "https://maps.googleapis.com/maps/api/js?key=".$API_KEY."&libraries=places");
}
add_action( 'admin_enqueue_scripts', 'wp_google_scripts' );

// 2. Create Metabox
function add_embed_gmaps_meta_box() {
	add_meta_box(
		'gmaps_embed_meta_box', // $id
		'Property Address', // $title
		'show_embed_gmaps_meta_box', // $callback
		'post', // $page
		'normal', // $context
		'high' // $priority
	);
	add_meta_box(
		'gmaps_embed_meta_box', // $id
		'Property Address', // $title
		'show_embed_gmaps_meta_box', // $callback
		'property', // $page
		'normal', // $context
		'high' // $priority
	);
}
add_action('add_meta_boxes', 'add_embed_gmaps_meta_box');

// 3. Show Metabox content
function show_embed_gmaps_meta_box() {
    global $post;
	//update_post_meta($post->ID, 'lat', '');
	//update_post_meta($post->ID, 'lng', '');
	//update_post_meta($post->ID, 'street_number', '');
	//update_post_meta($post->ID, 'route', '');
	//update_post_meta($post->ID, 'unit', '');
	//update_post_meta($post->ID, 'locality', '');
	//update_post_meta($post->ID, 'administrative_area_level_1', '');
	//update_post_meta($post->ID, 'postal_code', '');
	//update_post_meta($post->ID, 'country', '');
	$lat = get_post_meta($post->ID, 'lat', true);
	$lng = get_post_meta($post->ID, 'lng', true);
	$street_number = get_post_meta($post->ID, 'street_number', true);
	$route = get_post_meta($post->ID, 'route', true);
	$unit = get_post_meta($post->ID, 'unit', true);
	$locality = get_post_meta($post->ID, 'locality', true);
	$administrative_area_level_1 = get_post_meta($post->ID, 'administrative_area_level_1', true);
	$postal_code = get_post_meta($post->ID, 'postal_code', true);
	$country = get_post_meta($post->ID, 'country', true);
	$nonce = wp_create_nonce(basename(__FILE__));

	echo '
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<table id="address">
					<tr>
						<td class="search-address">
							<input id="pac-input" placeholder="Search Address...">
						</td>
					</tr>
					<tr>
						<td>
							<label>Latitude</label>
							<input name="g_lat" id="latitude" value="' . $lat . '">
						</td>
						<td>
							<label>Longitude</label>
							<input name="g_lng" id="longitude" value="' . $lng . '">
						</td>
					</tr>
					<tr>
						<td>
							<label>Address Line 1</label>
							<input name="g_street_number" id="street_number" value="' . $street_number . ' ' . $route . '" />
							<input type="hidden" name="g_route" id="route" value="' . $route . '" />
						</td>
						<td>
							<label>Building/Community Name</label>
							<input name="g_unit" id="unit" value="' . $unit . '" />
						</td>
					</tr>
					<tr>
						<td>
							<label>City</label>
							<input name="g_locality" id="locality" value="' . $locality . '" />
						</td>
						<td>
							<label>State</label>
							<input name="g_administrative_area_level_1" id="administrative_area_level_1" value="' . $administrative_area_level_1 . '" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Postal / Zip Code</label>
							<input name="g_postal_code" id="postal_code" value="' . $postal_code . '" />
						</td>
						<td>
							<label>Country</label>
							<input name="g_country" id="country" value="' . $country . '" />
						</td>
					</tr>
				</table>
			</div>
			<div class="col-sm-6">
				<div id="map"></div>
			</div>
		</div>
	</div>
	<div><input type="hidden" name="custom_meta_box_nonce" value="' . $nonce . '"></div>
	';
}

// 4. Add Javascript Logic + custom style
function custom_js_css() {
	global $post;
	wp_enqueue_style('gmaps-meta-box', get_stylesheet_directory_uri() . '/css/admin-maps.css');
	wp_enqueue_script('gmaps-meta-box', get_stylesheet_directory_uri() . '/js/admin-maps.js');
	$helper = array(
		'lat' => get_post_meta($post->ID, 'lat', true),
		'lng' => get_post_meta($post->ID, 'lng', true),
		'street_number' => get_post_meta($post->ID, 'street_number', true),
		'route' => get_post_meta($post->ID, 'route', true),
		'unit' => get_post_meta($post->ID, 'unit', true),
		'locality' => get_post_meta($post->ID, 'locality', true),
		'administrative_area_level_1' => get_post_meta($post->ID, 'administrative_area_level_1', true),
		'postal_code' => get_post_meta($post->ID, 'postal_code', true),
		'country' => get_post_meta($post->ID, 'country', true)
	);
	wp_localize_script('gmaps-meta-box', 'helper', $helper);
}
add_action('admin_print_styles-post.php', 'custom_js_css');
add_action('admin_print_styles-post-new.php', 'custom_js_css');

// 5. Save Metaboxes.
function save_embed_gmap($post_id) {

// verify nonce
if (isset($_POST['custom_meta_box_nonce']) && !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
	return $post_id;
}

// check autosave
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	return $post_id;
}

// check permissions
if ( !empty($_POST) ) {
if ('property' == $_POST['post_type']) {
	if (!current_user_can('edit_page', $post_id))
		return $post_id;
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
}
}

if (isset($_POST["g_lat"])) {
	$old_lat = get_post_meta($post_id, "lat", true);
	$new_lat = $_POST["g_lat"]; 
	if ($new_lat != $old_lat) {
		update_post_meta($post_id, "lat", $new_lat);
	}
}

if (isset($_POST["g_lng"])) {
	$old_lng = get_post_meta($post_id, "lng", true);
	$new_lng = $_POST["g_lng"]; 
	if ($new_lng != $old_lng) {
		update_post_meta($post_id, "lng", $new_lng);
	}
}

if (isset($_POST["g_street_number"])) {
	$old_street_number = get_post_meta($post_id, "street_number", true);
	$new_street_number = $_POST["g_street_number"]; 
	if ($new_street_number != $old_street_number) {
		update_post_meta($post_id, "street_number", $new_street_number);
	}
}

if (isset($_POST["g_route"])) {
	$old_route = get_post_meta($post_id, "route", true);
	$new_route = $_POST["g_route"]; 
	if ($new_route != $old_route) {
		update_post_meta($post_id, "route", $new_route);
	}
}

if (isset($_POST["g_unit"])) {
	$old_unit = get_post_meta($post_id, "unit", true);
	$new_unit = $_POST["g_unit"]; 
	if ($new_unit != $old_unit) {
		update_post_meta($post_id, "unit", $new_unit);
	}
}

if (isset($_POST["g_locality"])) {
	$old_locality = get_post_meta($post_id, "locality", true);
	$new_locality = $_POST["g_locality"]; 
	if ($new_locality != $old_locality) {
		update_post_meta($post_id, "locality", $new_locality);
	}
}

if (isset($_POST["g_administrative_area_level_1"])) {
	$old_administrative_area_level_1 = get_post_meta($post_id, "administrative_area_level_1", true);
	$new_administrative_area_level_1 = $_POST["g_administrative_area_level_1"]; 
	if ($new_administrative_area_level_1 != $old_administrative_area_level_1) {
		update_post_meta($post_id, "administrative_area_level_1", $new_administrative_area_level_1);
	}
}

if (isset($_POST["g_postal_code"])) {
	$old_postal_code = get_post_meta($post_id, "postal_code", true);
	$new_postal_code = $_POST["g_postal_code"]; 
	if ($new_postal_code != $old_postal_code) {
		update_post_meta($post_id, "postal_code", $new_postal_code);
	}
}

if (isset($_POST["g_country"])) {
	$old_country = get_post_meta($post_id, "country", true);
	$new_country = $_POST["g_country"]; 
	if ($new_country != $old_country) {
		update_post_meta($post_id, "country", $new_country);
	}
}

}
add_action('save_post', 'save_embed_gmap');

// Update "property_address" field in "property notes" section
add_action('acf/save_post', function($post_id){
	if ( is_admin() && get_post_type($post_id) === 'property' ) {
		update_field('property_address', $_POST['g_street_number'], $post_id);
	}
});

// Make "property_address" field readonly
add_filter('acf/load_field/name=property_address', function($field){
	$field['readonly'] = 1;
	return $field;
});

// Save property title & description to custom meta
add_action('save_post', function($post_id){
	if ( is_admin() && get_post_type($post_id) === 'property' ) {
		update_post_meta($post_id, 'title', get_the_title($post_id));
		update_post_meta($post_id, 'description', get_the_content(null, false, $post_id));
	}
});

// Custom Query Vars
add_filter('query_vars', function($vars){
	$vars[] = "search";
	$vars[] = "availability";
	$vars[] = "status";
	$vars[] = "type";
	$vars[] = "bed";
	$vars[] = "bath";
	$vars[] = "price_min";
	$vars[] = "price_max";
	$vars[] = "size_min";
	$vars[] = "size_max";
	$vars[] = "hood";
	$vars[] = "sort_by";
	$vars[] = "sort_order";
	$vars[] = "_agent";
	$vars[] = "home";
	$vars[] = "buying";
	$vars[] = "selling";
	return $vars;
});

/********************************
 * Custom Property Admin Columns
 ********************************/

add_filter('manage_property_posts_columns', function($columns){
	$columns = array(
	'cb' => $columns['cb'],
	'title' => 'Title',
	'address' => 'Address',
	'availability' => 'Availability',
	'sale_type' => 'Sale Type',
	'property_type' => 'Property Type',
	'price' => 'Price',
	'agent' => 'Agent(s)',
	'date' => 'Date'
	);
	return $columns;
});

add_action('manage_property_posts_custom_column', function($column){
	global $post;
	if ( $column === 'address' ) {
		$address = get_post_meta($post->ID, 'street_number', true);
		$city = get_post_meta($post->ID, 'locality', true);
		$state = get_post_meta($post->ID, 'administrative_area_level_1', true);
		$zipcode = get_post_meta($post->ID, 'postal_code', true);
		if ( !empty($address) ) { echo $address; }
		echo '<br>';
		if ( !empty($city) ) { echo $city . ', '; }
		if ( !empty($state) ) { echo $state . ' '; }
		if ( !empty($zipcode) ) { echo $zipcode; }
	}
	if ( $column === 'availability' ) {
		echo get_field('property_availability', $post->ID);
	}
	if ( $column === 'sale_type' ) {
		echo get_field('property_status', $post->ID);
	}
	if ( $column === 'property_type' ) {
		echo get_field('property_type', $post->ID);
	}
	if ( $column === 'price' ) {
		$price = get_field('property_price', $post->ID);
		if ( !empty($price) ) {
			$price = number_format($price);
			echo '$' . $price;
		}
	}
	if ( $column === 'agent' ) {
		$agents = get_field('property_agents', $post->ID);
		if ( !empty($agents) ) {
			foreach ( $agents as $agent ) {
				echo get_the_title($agent) . '<br>';
			}
		}
	}
});

// make "price" column sortable
add_filter('manage_edit-property_sortable_columns', function($columns){
	$columns['price'] = 'price';
	return $columns;
});

add_action('pre_get_posts', function($query){
	global $pagenow;
	if( is_admin() && $pagenow === 'edit.php' &&  $query->query_vars['post_type'] === 'property' ) {
		if ( 'price' === $query->get( 'orderby') ) {
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'meta_key', 'property_price' );
			$query->set( 'meta_type', 'numeric' );
		}
	}
});

// Ignore Post Types Order sort for properties
add_filter('pto/posts_orderby/ignore', function($ignore, $orderBy, $query){
	if ( isset($query->query_vars['post_type']) === 'property' ) {
		$ignore = true;
		return $ignore;
	}
}, 10, 3);

/********************************
 * Custom Property Admin Filters
 ********************************/

// Remove category dropdown
add_action('load-edit.php', function(){
	global $pagenow, $typenow;
	if ( is_admin() && $pagenow === 'edit.php' && $typenow === 'property' ) {
		add_filter( 'wp_dropdown_cats', '__return_false' );
	}
});

// Custom filter dropdowns
add_action('restrict_manage_posts', function(){
	global $pagenow, $typenow;
	if ( is_admin() && $pagenow === 'edit.php' && $typenow === 'property' ) {
		// Availability filter
		$availability_values = array(
			'Yes' => 'Yes', 
			'No' => 'No',
		);
		?>
		<select name="availability">
		<option value="">Availability</option>
		<?php
		$current_availability_value = isset($_GET['availability']) ? $_GET['availability'] : '';
		foreach ( $availability_values as $label => $value ) {
			printf('<option value="%s"%s>%s</option>', $value, $value === $current_availability_value ? ' selected="selected"' : '', $label);
		}
		?>
		</select>
		<?php
		
		//Sale Type filter
		$sale_type_values = array(
			'Sale' => 'Sale', 
			'Lease' => 'Lease',
		);
		?>
		<select name="status">
		<option value="">Sale Types</option>
		<?php
		$current_sale_type_value = isset($_GET['status']) ? $_GET['status'] : '';
		foreach ( $sale_type_values as $label => $value ) {
			printf('<option value="%s"%s>%s</option>', $value, $value === $current_sale_type_value ? ' selected="selected"' : '', $label );
		}
		?>
		</select>
		<?php
		
		// Property Type filter
		$property_type_values = array(
			'Residential' => 'Residential', 
			'Commercial' => 'Commercial',
		);
		?>
		<select name="type">
		<option value="">Property Types</option>
		<?php
		$current_property_type_value = isset($_GET['type']) ? $_GET['type'] : '';
		foreach ( $property_type_values as $label => $value ) {
			printf('<option value="%s"%s>%s</option>', $value, $value == $current_property_type_value ? ' selected="selected"' : '', $label);
		}
		?>
		</select>
		<?php
	}
});

function agents_admin_posts_filter_restrict_manage_posts(){
	global $pagenow, $typenow;
	if ( is_admin() && $pagenow === 'edit.php' && $typenow === 'property' ) {
		$values = array();
		$agents = get_posts(array(
			'post_type' => 'agent',
			'post_status' => 'publish'
		));
		foreach ( $agents as $agent ) {
			$agent_id = $agent->ID;
			$agent_name = $agent->post_title;
			$agent_array = array(
				$agent_name => $agent_id
			);
			$values = array_merge( $values, $agent_array);
		}
		?>
		<select name="agent">
		<option value=""><?php _e('Agents', 'wose45436'); ?></option>
		<?php
		$current_v = isset($_GET['agent']) ? $_GET['agent'] : '';
		foreach ( $values as $label => $value ) {
			printf('<option value="%s"%s>%s</option>', $value, $value == $current_v ? ' selected="selected"' : '', $label);
		}
		?>
		</select>
		<?php
	}
}
//add_action('restrict_manage_posts', 'agents_admin_posts_filter_restrict_manage_posts');

// Filter by post meta on submit
add_filter('parse_query', function($query){
	global $pagenow, $typenow;
	if ( is_admin() && $pagenow === 'edit.php' && $typenow === 'property' ) {
		//if( ! isset($query->query_vars['meta_query']) ) { $query->query_vars['meta_query'] = array(); }
		$meta = array ('relation' => 'AND');
		if ( isset($_GET['availability']) && $_GET['availability'] != '' ) {
			$meta[] = array (
				'key'  =>   'property_availability',
				'value' =>   $_GET['availability'],
				'compare' => '='
			);
		}
		if ( isset($_GET['status']) && $_GET['status'] != '' ) {
			$meta[] = array (
				'key'  =>   'property_status',
				'value' =>   $_GET['status'],
				'compare' => '='
			);
		}
		if ( isset($_GET['type']) && $_GET['type'] != '') {
			$meta[] = array (
				'key'  =>   'property_type',
				'value' =>   $_GET['type'],
				'compare' => '='
			);
		}
		if ( isset($_GET['agent']) && $_GET['agent'] != '' ) {
			$meta[] = array (
				'key'  =>   'property_agents',
				'value' =>   $_GET['agent'],
				'compare' => '='
			);
		}
		// append to meta_query array
		$query->query_vars['meta_query'][] = $meta;
	}
});

/*****************************
 * Custom Agent URL endpoints
 *****************************/

add_action('init', 'add_url_endpoints');
function add_url_endpoints(){
	add_rewrite_endpoint('home', EP_PERMALINK);
	add_rewrite_endpoint('buying', EP_PERMALINK);
	add_rewrite_endpoint('selling', EP_PERMALINK);
}

add_filter('request', 'filter_url_request');
function filter_url_request($vars){
	if ( isset($vars['home']) ) $vars['home'] = true;
	if ( isset($vars['buying']) ) $vars['buying'] = true;
	if ( isset($vars['selling']) ) $vars['selling'] = true;
	return $vars;
}

// Alternate templates
add_filter('template_include', function($t){
	if ( get_query_var('_agent') ) {
		$t = locate_template('single-property-2.php');
	}
	if( is_singular('agent') && get_query_var('home') ) {
		$t = locate_template('front-page-agent.php');
	}
	if( is_singular('agent') && get_query_var('buying') ) {
		$t = locate_template('page-buy-agent.php');
	}
	if( is_singular('agent') && get_query_var('selling') ) {
		$t = locate_template('page-sell-agent.php');
	}
	return $t;
});

/*********************
 * AJAX Filter & Sort
 *********************/
function sg_filter_function(){

check_ajax_referer('filter_posts', 'security');

//$loader_image = carbon_get_theme_option('crb_theme_loader_image');

if ( isset( $_POST['search'] ) ) {
$search = sanitize_text_field( $_POST['search'] );
}

$meta_query = array('relation' => 'AND');
if( isset( $_POST['agent'] ) && $_POST['agent'] != '' ) {
$agent_id = $_POST['agent'];
$meta_query[] = array(
'key' => 'property_agents',
'value' => $agent_id,
'compare' => 'LIKE'
);
}
if( isset( $_POST['availability'] ) && $_POST['availability'] != '' ) {
$availability = $_POST['availability'];
$meta_query[] = array(
'key' => 'property_availability',
'value' => $availability,
'compare' => '='
);
}
if( isset( $_POST['status'] ) && $_POST['status'] != '' ) {
$status = $_POST['status'];
$meta_query[] = array(
'key' => 'property_status',
'value' => $status,
'compare' => '='
);
}
if( isset( $_POST['type'] ) && $_POST['type'] != '' ) {
$type = $_POST['type'];
$meta_query[] = array(
'key' => 'property_type',
'value' => $type,
'compare' => '='
);
}
if( isset( $_POST['bed'] ) && $_POST['bed'] != '' ) {
$bed = $_POST['bed'];
//if ( $bed == 5 ) {
$meta_query[] = array(
'key' => 'property_beds',
'value' => $bed,
'compare' => '>='
);
//} else {
/*$meta_query[] = array(
'key' => 'property_beds',
'value' => $bed,
'compare' => '='
);*/
//}
}
if( isset( $_POST['bath'] ) && $_POST['bath'] != '' ) {
$bath = $_POST['bath'];
$meta_query[] = array(
'key' => 'property_bath',
'value' => $bath,
'compare' => '>='
);
}

if( isset( $_POST['price_min'] ) && $_POST['price_min'] && isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
$meta_query[] = array(
'key' => 'property_price',
'value' => array( $_POST['price_min'], $_POST['price_max'] ),
'type' => 'numeric',
'compare' => 'between'
);
} else {
if( isset( $_POST['price_min'] ) && $_POST['price_min'] ) {
$meta_query[] = array(
'key' => 'property_price',
'value' => $_POST['price_min'],
'type' => 'numeric',
'compare' => '>='
);
}
if( isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
$meta_query[] = array(
'key' => 'property_price',
'value' => $_POST['price_max'],
'type' => 'numeric',
'compare' => '<='
);
}
}

if( isset( $_POST['size_min'] ) && $_POST['size_min'] && isset( $_POST['size_max'] ) && $_POST['size_max'] ) {
$meta_query[] = array(
'key' => 'property_size',
'value' => array( $_POST['size_min'], $_POST['size_max'] ),
'type' => 'numeric',
'compare' => 'between'
);
} else {
if( isset( $_POST['size_min'] ) && $_POST['size_min'] ) {
$meta_query[] = array(
'key' => 'property_size',
'value' => $_POST['size_min'],
'type' => 'numeric',
'compare' => '>='
);
}
if( isset( $_POST['size_max'] ) && $_POST['size_max'] ) {
$meta_query[] = array(
'key' => 'property_size',
'value' => $_POST['size_max'],
'type' => 'numeric',
'compare' => '<='
);
}
}

$tax_query = array();
if( isset( $_POST['hood'] ) && $_POST['hood'] != '' ) {
$hood = $_POST['hood'];
$tax_query[] = array(
'taxonomy' => 'neighborhood',
'field' => 'slug',
'terms' => $hood
);
}

$args = array(
'post_type' => 'property',
'post_status' => 'publish',
'posts_per_page' => 30,
's' => $search,
'meta_query' => $meta_query,
'tax_query' => $tax_query
);

if ( isset( $_POST['sort_by'] ) && $_POST['sort_by'] != '' ) {
if ( $_POST['sort_by'] === 'property_availability' ) {
$args['meta_key'] = 'property_availability';
$args['orderby'] = 'meta_value';
$args['order'] = $_POST['sort_order'];
} else {
$args['meta_key'] = $_POST['sort_by'];
$args['orderby'] = 'meta_value_num';
$args['order'] = $_POST['sort_order'];
}
}

$query = new WP_Query( $args );

if( $query->have_posts() ) {
while( $query->have_posts() ) {
$query->the_post();
$ID = get_the_ID();
$index = $query->current_post;
$src = get_the_post_thumbnail_url($ID, 'large');
$src_medium = get_the_post_thumbnail_url($ID, 'medium');
$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'large');
$image = wp_get_attachment_image($loader_image, 'thumbnail', false, array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
$title = get_the_title($ID);
$url = get_the_permalink($ID);
$content = get_the_content($ID);
$lat = get_post_meta($ID, 'lat', true);
$lng = get_post_meta($ID, 'lng', true);
$street_number = get_post_meta($ID, 'street_number', true);
$route = get_post_meta($ID, 'route', true);
$unit = get_post_meta($ID, 'unit', true);
$locality = get_post_meta($ID, 'locality', true);
$administrative_area_level_1 = get_post_meta($ID, 'administrative_area_level_1', true);
$postal_code = get_post_meta($ID, 'postal_code', true);
$country = get_post_meta($ID, 'country', true);
$availability = get_field( 'property_availability', $ID );
$status = get_field( 'property_status', $ID );
$type = get_field( 'property_type', $ID );
$bed = get_field( 'property_beds', $ID );
$bath = get_field( 'property_bath', $ID );
$size = number_format( (float) get_field( 'property_size', $ID ) );
$lot = number_format( (float) get_field( 'property_size_lot', $ID ) );
$price = number_format( (float) get_field( 'property_price', $ID ) );
$hood = get_field( 'property_neighborhood', $ID );
if ( $hood ) {
$hood_name = $hood->name;
}
if ( $availability == 'Yes' ) {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-aqua.svg';
} else {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-red.svg';
}
$new_locations[] = array(
'ID' => $ID,
'index' => $index,
'url' => $url,
'image' => $src_medium,
'title' => $title,
'lat' => $lat,
'lng' => $lng,
'street_number' => $street_number,
'route' => $route,
'unit' => $unit,
'locality' => $locality,
'administrative_area_level_1' => $administrative_area_level_1,
'postal_code' => $postal_code,
'country' => $country,
'bed' => $bed,
'bath' => $bath,
'size' => $size,
'lot' => $lot,
'price' => $price,
'marker' => $marker
);
?>
<article id="property-<?php echo $ID; ?>" class="list-item list-item-<?php echo $index; ?> property listing" data-index="<?php echo $index; ?>" data-id="<?php echo $ID; ?>" data-avail="<?php echo $availability; ?>" data-status="<?php echo $status; ?>" data-type="<?php echo $type; ?>" data-hood="<?php echo $hood_name; ?>" data-price="<?php echo $price; ?>" data-size="<?php echo $size; ?>">
	<div class="property-card">
		<div class="content">
			<div class="image">
				<div class="thumbnail">
					<?php //echo $image; ?>
					<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
					<div class="lazy-overlay on"></div>
					<?php
					if ( $availability == 'Yes' ) {
						$avail = 'avail';
						if ( $status == 'Sale' ) {
							$stat = 'sale';
							$text = 'For Sale';
						} else {
							$stat = 'rent';
							$text = 'For Rent';
						}
					} else {
						$avail = 'no-avail';
						if ( $status == 'Sale' ) {
							$stat = 'sale';
							$text = 'Sold';
						} else {
							$stat = 'rent';
							$text = 'Leased';
						}
					}
					?>
					<div class="flag <?php echo $avail . ' ' . $stat; ?>"><?php echo $text; ?></div>
				</div>
			</div>
			<div class="info">
				<div class="title">
					<h6><?php echo $title; ?></h6>
				</div>
				
				<div class="address">
					<span><?php echo $street_number; ?></span>
				</div>
				
				<div class="d-none">
					<?php if ( $availability ) { ?><div>Available: <?php echo $availability; ?></div><?php } ?>
					<?php if ( $status ) { ?><div>Status: <?php echo $status; ?></div><?php } ?>
					<?php if ( $type ) { ?><div>Type: <?php echo $type; ?></div><?php } ?>
					<?php if ( $hood ) { ?><div>Hood: <?php echo $hood_name; ?></div><?php } ?>
				</div>
				
				<div class="details">
					<?php if ( isset($bed) && !empty($bed) && $bed != 0 ) { ?>
					<span class="meta bed">&bull; <?php echo $bed; ?> bed</span>
					<?php } ?>
					<?php if ( isset($bath) && !empty($bath) && $bath != 0 ) { ?>
					<span class="meta bath">&bull; <?php echo $bath; ?> bath</span>
					<?php } ?>
					<?php if ( isset($size) && !empty($size) && $size != 0 ) { ?>
					<span class="meta size">&bull; <?php echo $size; ?> sqft</span>
					<?php } ?>
					<?php if ( isset($lot) && !empty($lot) && $lot != 0 ) { ?>
					<span class="meta lot">&bull; <?php echo $lot; ?> sqft lot</span>
					<?php } ?>
					<?php if ( isset($price) && !empty($price) && $price != 0 ) { ?>
					<span class="meta price">&bull; $<?php echo $price; ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="buttons">
			<a href="#" id="marker-link" class="marker-link" data-marker-id="<?php echo $index; ?>">Locate</a>
			<a href="<?php echo $url; ?>">View Details</a>
		</div>
	</div>
</article>
<?php
}
wp_reset_postdata();
?>
<script id="locations-filter" type="text/javascript">
var new_locations = <?php echo json_encode($new_locations); ?>;
locations = new_locations.slice(0);
console.log(locations);
</script>
<?php
} else {
echo '<div class="filter-no-results"><p>No results found.</p></div>';
?>
<script>
locations = [];
</script>
<?php
}
$new_data = array(
'current_page' => get_query_var( 'page' ) ? get_query_var('page') : 1,
'max_page' => $query->max_num_pages,
);
?>
<script>
var new_data = <?php echo json_encode($new_data); ?>;
</script>
<?php
die();
}
add_action('wp_ajax_sgfilter', 'sg_filter_function');
add_action('wp_ajax_nopriv_sgfilter', 'sg_filter_function');

/*********************
 * AJAX Load More
 *********************/
function load_more_ajax_handler(){

check_ajax_referer('loadmore_posts', 'security');

//$loader_image = carbon_get_theme_option('crb_theme_loader_image');

global $wp_query;
$init_locations = $_POST['locations'];

if ( isset( $_POST['search'] ) ) {
$search = sanitize_text_field( $_POST['search'] );
}

$meta_query = array('relation' => 'AND');
if( isset( $_POST['agent'] ) && $_POST['agent'] != '' ) {
$agent_id = $_POST['agent'];
$meta_query[] = array(
'key' => 'property_agents',
'value' => $agent_id,
'compare' => 'LIKE'
);
}
if( isset( $_POST['availability'] ) && $_POST['availability'] != '' ) {
$availability = $_POST['availability'];
$meta_query[] = array(
'key' => 'property_availability',
'value' => $availability,
'compare' => '='
);
}
if( isset( $_POST['status'] ) && $_POST['status'] != '' ) {
$status = $_POST['status'];
$meta_query[] = array(
'key' => 'property_status',
'value' => $status,
'compare' => '='
);
}
if( isset( $_POST['type'] ) && $_POST['type'] != '' ) {
$type = $_POST['type'];
$meta_query[] = array(
'key' => 'property_type',
'value' => $type,
'compare' => '='
);
}
if( isset( $_POST['bed'] ) && $_POST['bed'] != '' ) {
$bed = $_POST['bed'];
//if ( $bed == 5 ) {
$meta_query[] = array(
'key' => 'property_beds',
'value' => $bed,
'compare' => '>='
);
//} else {
/*$meta_query[] = array(
'key' => 'property_beds',
'value' => $bed,
'compare' => '='
);*/
//}
}
if( isset( $_POST['bath'] ) && $_POST['bath'] != '' ) {
$bath = $_POST['bath'];
$meta_query[] = array(
'key' => 'property_bath',
'value' => $bath,
'compare' => '>='
);
}

if( isset( $_POST['price_min'] ) && $_POST['price_min'] && isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
$meta_query[] = array(
'key' => 'property_price',
'value' => array( $_POST['price_min'], $_POST['price_max'] ),
'type' => 'numeric',
'compare' => 'between'
);
} else {
if( isset( $_POST['price_min'] ) && $_POST['price_min'] ) {
$meta_query[] = array(
'key' => 'property_price',
'value' => $_POST['price_min'],
'type' => 'numeric',
'compare' => '>'
);
}
if( isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
$meta_query[] = array(
'key' => 'property_price',
'value' => $_POST['price_max'],
'type' => 'numeric',
'compare' => '<'
);
}
}

if( isset( $_POST['size_min'] ) && $_POST['size_min'] && isset( $_POST['size_max'] ) && $_POST['size_max'] ) {
$meta_query[] = array(
'key' => 'property_size',
'value' => array( $_POST['size_min'], $_POST['size_max'] ),
'type' => 'numeric',
'compare' => 'between'
);
} else {
if( isset( $_POST['size_min'] ) && $_POST['size_min'] ) {
$meta_query[] = array(
'key' => 'property_size',
'value' => $_POST['size_min'],
'type' => 'numeric',
'compare' => '>'
);
}
if( isset( $_POST['size_max'] ) && $_POST['size_max'] ) {
$meta_query[] = array(
'key' => 'property_size',
'value' => $_POST['size_max'],
'type' => 'numeric',
'compare' => '<'
);
}
}

$tax_query = array();
if( isset( $_POST['hood'] ) && $_POST['hood'] != '' ) {
$hood = $_POST['hood'];
$tax_query[] = array(
'taxonomy' => 'neighborhood',
'field' => 'slug',
'terms' => $hood
);
}

$args = array(
'post_type' => 'property',
'post_status' => 'publish',
'posts_per_page' => 30,
's' => $search,
'meta_query' => $meta_query,
'tax_query' => $tax_query
);

if ( isset( $_POST['sort_by'] ) && $_POST['sort_by'] != '' ) {
if ( $_POST['sort_by'] === 'property_availability' ) {
$args['meta_key'] = 'property_availability';
$args['orderby'] = 'meta_value';
$args['order'] = $_POST['sort_order'];
} else {
$args['meta_key'] = $_POST['sort_by'];
$args['orderby'] = 'meta_value_num';
$args['order'] = $_POST['sort_order'];
}
}

$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded

// it is always better to use WP_Query but not here
query_posts( $args );

if ( have_posts() ) {
while ( have_posts() ) {
the_post();
$ID = get_the_ID();
$index = $wp_query->current_post;
$src = get_the_post_thumbnail_url($ID, 'large');
$src_medium = get_the_post_thumbnail_url($ID, 'medium');
$srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($ID), 'large');
$image = wp_get_attachment_image($loader_image, 'thumbnail', false, array('data-src' => $src, 'data-srcset' => $srcset, 'class' => 'lazy'));
$title = get_the_title($ID);
$url = get_the_permalink($ID);
$content = get_the_content($ID);
$lat = get_post_meta($ID, 'lat', true);
$lng = get_post_meta($ID, 'lng', true);
$street_number = get_post_meta($ID, 'street_number', true);
$route = get_post_meta($ID, 'route', true);
$unit = get_post_meta($ID, 'unit', true);
$locality = get_post_meta($ID, 'locality', true);
$administrative_area_level_1 = get_post_meta($ID, 'administrative_area_level_1', true);
$postal_code = get_post_meta($ID, 'postal_code', true);
$country = get_post_meta($ID, 'country', true);
$availability = get_field( 'property_availability', $ID );
$status = get_field( 'property_status', $ID );
$type = get_field( 'property_type', $ID );
$bed = get_field( 'property_beds', $ID );
$bath = get_field( 'property_bath', $ID );
$size = get_field( 'property_size', $ID );
$lot = get_field( 'property_size_lot', $ID );
$price = get_field( 'property_price', $ID );
$hood = get_field( 'property_neighborhood', $ID );
if ( $hood ) {
$hood_name = $hood->name;
}
if ( $availability == 'Yes' ) {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-aqua.svg';
} else {
	$marker = get_stylesheet_directory_uri() . '/icons/map-marker-red.svg';
}
$new_locations[] = array(
'ID' => $ID,
'index' => $index + 4,
'url' => $url,
'image' => $src_medium,
'title' => $title,
'lat' => $lat,
'lng' => $lng,
'street_number' => $street_number,
'route' => $route,
'unit' => $unit,
'locality' => $locality,
'administrative_area_level_1' => $administrative_area_level_1,
'postal_code' => $postal_code,
'country' => $country,
'bed' => $bed,
'bath' => $bath,
'size' => $size,
'lot' => $lot,
'price' => $price,
'marker' => $marker
);
$locations = array_merge($init_locations, $new_locations);
foreach ( $locations as $key => $value ) {
$index = $key;
}
?>
<article id="property-<?php echo $ID; ?>" class="list-item list-item-<?php echo $index; ?> property listing" data-index="<?php echo $index; ?>" data-id="<?php echo $ID; ?>">
	<div class="property-card">
		<div class="content">
			<div class="image">
				<div class="thumbnail">
					<?php //echo $image; ?>
					<img src="" srcset="" data-srcset="<?php echo $srcset; ?>" sizes="(min-width: 992px) 1024px" class="lazy" />
					<div class="lazy-overlay on"></div>
					<?php
					if ( $availability == 'Yes' ) {
						$avail = 'avail';
						if ( $status == 'Sale' ) {
							$stat = 'sale';
							$text = 'For Sale';
						} else {
							$stat = 'rent';
							$text = 'For Rent';
						}
					} else {
						$avail = 'no-avail';
						if ( $status == 'Sale' ) {
							$stat = 'sale';
							$text = 'Sold';
						} else {
							$stat = 'rent';
							$text = 'Leased';
						}
					}
					?>
					<div class="flag <?php echo $avail . ' ' . $stat; ?>"><?php echo $text; ?></div>
				</div>
			</div>
			<div class="info">
				<div class="title">
					<h6><?php echo $title; ?></h6>
				</div>
				
				<div class="address">
					<span><?php echo $street_number; ?></span>
				</div>
				
				<div class="d-none">
					<?php if ( $availability ) { ?><div>Available: <?php echo $availability; ?></div><?php } ?>
					<?php if ( $status ) { ?><div>Status: <?php echo $status; ?></div><?php } ?>
					<?php if ( $type ) { ?><div>Type: <?php echo $type; ?></div><?php } ?>
					<?php if ( $hood ) { ?><div>Hood: <?php echo $hood_name; ?></div><?php } ?>
				</div>
				
				<div class="details">
					<?php if ( isset($bed) && !empty($bed) && $bed != 0 ) { ?>
					<span class="meta bed">&bull; <?php echo $bed; ?> bed</span>
					<?php } ?>
					<?php if ( isset($bath) && !empty($bath) && $bath != 0 ) { ?>
					<span class="meta bath">&bull; <?php echo $bath; ?> bath</span>
					<?php } ?>
					<?php if ( isset($size) && !empty($size) && $size != 0 ) { ?>
					<span class="meta size">&bull; <?php echo $size; ?> sqft</span>
					<?php } ?>
					<?php if ( isset($lot) && !empty($lot) && $lot != 0 ) { ?>
					<span class="meta lot">&bull; <?php echo $lot; ?> sqft lot</span>
					<?php } ?>
					<?php if ( isset($price) && !empty($price) && $price != 0 ) { ?>
					<span class="meta price">&bull; $<?php echo $price; ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="buttons">
			<a href="#" id="marker-link" class="marker-link" data-marker-id="<?php echo $index; ?>">Locate</a>
			<a href="<?php echo $url; ?>">View Details</a>
		</div>
	</div>
</article>
<?php
}
}
?>
<script id="locations-loadmore" type="text/javascript">
var new_locations = <?php echo json_encode($new_locations); ?>;
locations.push.apply(locations, new_locations);
console.log(new_locations);
console.log(locations);
</script>
<?php
die();
}
add_action('wp_ajax_loadmore', 'load_more_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'load_more_ajax_handler');

/*******************************
 * Custom Admin Property Search
 *******************************/
function custom_search_query($query){
	global $pagenow;
	if( is_admin() && $pagenow == 'edit.php' && $query->is_main_query() ) {

	$custom_fields = array(
		'title',
		//'description',
		'street_number',
		'route',
		'unit',
		'locality',
		'administrative_area_level_1'
	);
	$searchterm = $query->query_vars['s'];

	// we have to remove the "s" parameter from the query, because it will prevent the posts from being found
	$query->query_vars['s'] = '';

	if ( $searchterm != '' ) {
		//$meta_query = array();
		$meta_query = array('relation' => 'AND');
		$search_query = array('relation' => 'OR');
		foreach ( $custom_fields as $cf ) {
			array_push( $search_query, array(
				'key' => $cf,
				'value' => $searchterm,
				'compare' => 'LIKE'
			));
		}
		array_push($meta_query, $search_query);
		if ( isset($_GET['availability']) && $_GET['availability'] != '') {
			$meta_query[] = array (
				'key'  =>   'property_availability',
				'value' =>   $_GET['availability'],
				'compare' => '='
			);
		}
		if ( isset($_GET['status']) && $_GET['status'] != '') {
			$meta_query[] = array (
				'key'  =>   'property_status',
				'value' =>   $_GET['status'],
				'compare' => '='
			);
		}
		if ( isset($_GET['type']) && $_GET['type'] != '') {
			$meta_query[] = array (
				'key'  =>   'property_type',
				'value' =>   $_GET['type'],
				'compare' => '='
			);
		}
		if ( isset($_GET['agent']) && $_GET['agent'] != '') {
			$meta_query[] = array (
				'key'  =>   'property_agents',
				'value' =>   $_GET['agent'],
				'compare' => 'LIKE'
			);
		}
		// Use an 'OR' comparison for each additional custom meta field.
		//if ( count( $meta_query ) > 1 ) {
			//$meta_query['relation'] = 'OR';
		//}
		// Set the meta_query parameter
		$query->set('meta_query', $meta_query);
		// To allow the search to also return "OR" results on the post_title
		//$query->set('_meta_or_title', $searchterm);
		//echo '<pre>'; var_dump($meta_query); echo '</pre>';
	}
	//echo '<pre>'; var_dump($meta_query); echo '</pre>';
	return $query;
	}
}
add_action('pre_get_posts', 'custom_search_query');
