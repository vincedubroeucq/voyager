<?php
/**
 * Voyager functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Voyager
 */

add_action( 'after_setup_theme', 'voyager_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function voyager_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Voyager, use a find and replace
	 * to change 'voyager' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'voyager', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Support for Yoast SEO Breadcrumbs
	 */
	add_theme_support( 'yoast-seo-breadcrumbs' );

	/**
	 * Register navigation menus
	 */
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'voyager' ),
			'menu-2' => esc_html__( 'Topbar', 'voyager' ),
			'menu-3' => esc_html__( 'Footer', 'voyager' ),
		)
	);

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'voyager_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'voyager_custom_header_args',
			array(
				'default-text-color' => 'e0e0e0',
				'width'              => 2048,
				'height'             => 900,
				'flex-height'        => true,
				'flex-width'         => true,
				'wp-head-callback'   => 'voyager_header_style',
			) 
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 250,
			'flex-width'  => true,
			// 'flex-height' => true,
			'header-text' => array( 'site-title' ),
		)
	);

	// Add support for video and audio post formats
	add_theme_support( 'post-formats', array( 'audio', 'video' ) );

	// Add support for editor styles
	add_theme_support( 'editor-styles' );
	add_editor_style();

	// Add support for alignments options 
	add_theme_support( 'align-wide' );

	// Add support for editor color palettes
	add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'Darkest grey', 'voyager' ),
            'slug'  => 'grey-5',
            'color' => '#141412',
        ),
        array(
            'name'  => __( 'Dark grey', 'voyager' ),
            'slug'  => 'grey-4',
            'color' => '#3b3b3b',
        ),
        array(
            'name'  => __( 'Medium grey', 'voyager' ),
            'slug'  => 'grey-3',
            'color' => '#808080',
        ),
        array(
            'name'  => __( 'Light grey', 'voyager' ),
            'slug'  => 'grey-2',
            'color' => '#bfbfbf',
        ),
        array(
            'name'  => __( 'Lightest grey', 'voyager' ),
            'slug'  => 'grey-1',
            'color' => '#e0e0e0',
        ),
        array(
            'name'  => __( 'Darkest orange', 'voyager' ),
            'slug'  => 'orange-5',
            'color' => '#cc3d00',
        ),
        array(
            'name'  => __( 'Dark orange', 'voyager' ),
            'slug'  => 'orange-4',
            'color' => '#e95b02',
        ),
        array(
            'name'  => __( 'Medium orange', 'voyager' ),
            'slug'  => 'orange-3',
            'color' => '#ff7033',
        ),
        array(
            'name'  => __( 'Light orange', 'voyager' ),
            'slug'  => 'orange-2',
            'color' => '#ffa782',
        ),
        array(
            'name'  => __( 'Lightest orange', 'voyager' ),
            'slug'  => 'orange-1',
            'color' => '#ffdbcc',
        ),
    ) );

	// Add a sample gradient
	add_theme_support(
		'editor-gradient-presets',
		array(
			array(
				'name'     => __( 'Transparent to dark grey', 'voyager' ),
				'gradient' => 'linear-gradient( to bottom, transparent 50%, #141412 )',
				'slug'     => 'transparent-to-grey-5'
			),
		)
	);

	// Add support for font sizes
	add_theme_support( 'disable-custom-font-sizes' );
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'Small', 'voyager' ),
			'size' => 12,
			'slug' => 'txt-2'
		),
		array(
			'name' => __( 'Regular', 'voyager' ),
			'size' => 16,
			'slug' => 'txt-4'
		),
		array(
			'name' => __( 'Large', 'voyager' ),
			'size' => 20,
			'slug' => 'txt-6'
		),
		array(
			'name' => __( 'Very large', 'voyager' ),
			'size' => 26,
			'slug' => 'txt-7'
		)
	) );

	// Add support for responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Add support for spacing features
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-units', 'px', 'rem' );
	add_theme_support( 'custom-spacing' );

}

add_action( 'after_setup_theme', 'voyager_content_width', 0 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function voyager_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'voyager_content_width', 768 );
}

add_action( 'widgets_init', 'voyager_widgets_init' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function voyager_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer widget area', 'voyager' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'voyager' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s p-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'wp_enqueue_scripts', 'voyager_scripts' );
/**
 * Enqueue scripts and styles.
 */
function voyager_scripts() {
	$version = wp_get_theme()->get( 'Version' );

	// wp_enqueue_style( 'voyager-font', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,600;1,400;1,600&display=swap', array(), $version );
	wp_enqueue_style( 'voyager-style', get_stylesheet_uri(), array(), $version );
	wp_style_add_data( 'voyager-style', 'rtl', 'replace' );
	wp_enqueue_script( 'voyager-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}


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
 * Load Yoast SEO integration file.
 */
if ( defined( 'WPSEO_VERSION' ) ) {
	require get_template_directory() . '/inc/yoast-seo-functions.php';
}
