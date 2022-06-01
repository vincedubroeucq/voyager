<?php
/**
 * Voyager Theme Customizer
 *
 * @package Voyager
 */

add_action( 'customize_register', 'voyager_customize_register' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function voyager_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title',
				'render_callback' => 'voyager_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'voyager_customize_partial_blogdescription',
			)
		);
	}

	// Register additional panel
	$wp_customize->add_panel( 'voyager_theme_options', array(
		'title'       => __( 'Voyager theme options', 'voyager' ),
		'description' => __( 'Voyager theme options', 'voyager' ),
		'priority'    => 160, 
	) );

	// Register additional section
	$wp_customize->add_section( 'voyager_header', array(
		'title'       => __( 'Header', 'voyager' ),
		'description' => __( 'Tweak navbar and header settings.', 'voyager' ),
		'panel'       => 'voyager_theme_options',
		'priority'    => 160,
		'capability'  => 'edit_theme_options',
	) );
	$wp_customize->add_section( 'voyager_footer', array(
		'title'       => __( 'Footer', 'voyager' ),
		'description' => __( 'Tweak footer settings.', 'voyager' ),
		'panel'       => 'voyager_theme_options',
		'priority'    => 160,
		'capability'  => 'edit_theme_options',
	) );

	// Additional color settings
	$wp_customize->add_setting( 'voyager_hero_default_text_color', array(
		'capability' => 'edit_theme_options',
		'default'    => '#e0e0e0',
		'transport'  => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'voyager_hero_default_text_color', array(
		'label'   => __( 'Hero default text color', 'voyager' ),
		'section' => 'colors',
	) ) );
	$wp_customize->add_setting( 'voyager_hero_title_color', array(
		'capability' => 'edit_theme_options',
		'default'    => '#e0e0e0',
		'transport'  => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'voyager_hero_title_color', array(
		'label'   => __( 'Hero title color', 'voyager' ),
		'section' => 'colors',
	) ) );

	// Additional header setting
	$wp_customize->add_setting( 'voyager_display_search', array(
		'capability' => 'edit_theme_options',
		'default'    => true,
		'transport'  => 'refresh',
		'sanitize_callback' => '',
	) );
	$wp_customize->add_control( 'voyager_display_search', array(
		'label'   => __( 'Display search form in the navbar', 'voyager' ),
		'type'    => 'checkbox',
		'section' => 'voyager_header',
	) );

	// Additional footer setting
	$wp_customize->add_setting( 'voyager_footer_text', array(
		'capability' => 'edit_theme_options',
		/* translators: %1$s author URL, %2$s Author name*/
		'default'    => sprintf( __( 'Theme by <a href="%1$s">%2$s</a>', 'voyager' ), 'https://vincentdubroeucq.com', 'Vincent Dubroeucq' ),
		'transport'  => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'voyager_footer_text', array(
		'label'   => __( 'Footer copyright text', 'voyager' ),
		'section' => 'voyager_footer',
	) );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function voyager_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function voyager_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

add_action( 'customize_preview_init', 'voyager_customize_preview_js' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function voyager_customize_preview_js() {
	$version = wp_get_theme()->get( 'Version' );
	wp_enqueue_script( 'voyager-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), $version, true );
}
