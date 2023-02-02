<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Voyager
 */

add_filter( 'body_class', 'voyager_body_classes' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function voyager_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_action( 'wp_head', 'voyager_pingback_header' );
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function voyager_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

if ( ! function_exists( 'voyager_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see voyager_custom_header_setup().
 */
function voyager_header_style() {
    $header_text_color = get_header_textcolor();
    $hero_title_color  = get_theme_mod( 'voyager_hero_title_color', '#e0e0e0' );
    $hero_text_color   = get_theme_mod( 'voyager_hero_default_text_color', '#e0e0e0' );
    ?>
        <style type="text/css" id="voyager_header_styles">
            <?php if ( ! display_header_text() ) : ?>
                .site-title-block {
                    position: absolute;
                    clip: rect(1px, 1px, 1px, 1px);
                }
            <?php endif; ?>
            .site-title,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }
            .title-block {
                color: <?php echo esc_attr( $hero_text_color );?>
            }
            .title-border {
                border-color: <?php echo esc_attr( $hero_text_color );?>
            }
            .page-title {
                color: <?php echo esc_attr( $hero_title_color );?>
            }
        </style>
    <?php
}
endif;

add_filter( 'nav_menu_css_class', 'voyager_nav_menu_item_classes', 10, 4 );
/**
 * Customize our menu item classes
 * 
 * @param   array    $classes    Menu item CSS classes
 * @param   WP_Post  $menu_item
 * @param   array    $args       Arguments passed to wp_nav_menu()
 * @param   int      $depth      Depth of the menu item
 * @return  array    $classes
 */
function voyager_nav_menu_item_classes( $classes, $menu_item, $args, $depth ){
    switch ( $args->theme_location ) {
        case 'menu-1':
            $classes[] = 'my-5';
            break;
        case 'menu-2':
            $classes[] = 'flex align-center flex-wrap ml-2 mb-0';
            break;
        case 'menu-3':
            $classes[] = 'mb-0';
            break;
    }
    return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'voyager_submenu_class', 10, 3 );
/**
 * Customize our submenu classes
 * 
 * @param   array    $classes    Menu CSS classes
 * @param   array    $args       Arguments passed to wp_nav_menu()
 * @param   int      $depth      Depth of the menu item
 * @return  array    $classes
 */
function voyager_submenu_class( $classes, $args, $depth ){
    switch ( $args->theme_location ) {
        case 'menu-1':
            $classes = array_merge( $classes, array( 'primary-submenu', 'naked', 'relative' ) );
            break;
        case 'menu-2':
            $classes = array_merge( $classes, array( 'topbar-submenu', 'naked', 'flex', 'align-center', 'flex-wrap' ) );
            break;
    }
    return $classes;
}

add_filter( 'nav_menu_link_attributes', 'voyager_menu_link_attributes', 10, 4 );
/**
 * Adds classes to navigation links
 * 
 * @param   array    $atts       Link attributes
 * @param   WP_Post  $menu_item
 * @param   array    $args       Arguments passed to wp_nav_menu()
 * @param   int      $depth      Depth of the menu item
 * @return  array    $atts       Link attributes
 */
function voyager_menu_link_attributes( $atts, $menu_item, $args, $depth ){
    switch ( $args->theme_location ) {
        case 'menu-1':
            if ( 1 <= $depth ) {
                $atts['class'] = 'naked grey-1 inline-flex align-center flex-center txt-2 uppercase p-1';
            } else {
                $atts['class'] = 'naked grey-1 inline-flex align-center flex-center uppercase bold p-1';
            }
            break;
        case 'menu-2':
            $atts['class'] = 'naked grey-4 inline-flex align-center p-1';
            break;
        case 'menu-3':
            $atts['class'] = 'naked grey-2 inline-flex align-center p-1';
            break;
    }
    return $atts;
}

add_filter( 'nav_menu_item_title', 'voyager_menu_item_title', 10, 4 );
/**
 * Adds icons to navigation items
 * 
 * @param   array    $title      Menu item title
 * @param   WP_Post  $menu_item
 * @param   array    $args       Arguments passed to wp_nav_menu()
 * @param   int      $depth      Depth of the menu item
 * @return  array    $title
 */
function voyager_menu_item_title( $title, $menu_item, $args, $depth ){
    $icons     = voyager_icons();
	$icon_keys = array_values( array_intersect( $menu_item->classes, array_keys( $icons ) ) );
    $icon_only = in_array( 'icon-only', $menu_item->classes );
	if ( ! empty( $icon_keys ) ){
		$icon  = $icons[$icon_keys[0]];
        $title = sprintf( '<span class="mr-1">%s</span><span class="menu-item-title %s">%s</span>', $icon, $icon_only ? 'screen-reader-text' : '', $title );
	}
    return $title;
}

/**
 * Returns all icons used in the theme
 * 
 * @return  array  $icons
 */
function voyager_icons(){
    $icons = array(
        'icon-user'     => '<svg class="icon icon-user" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M8 8c1.7 0 3-1.3 3-3S9.7 2 8 2 5 3.3 5 5s1.3 3 3 3zm2 1H6c-1.7 0-3 1.3-3 3v2h10v-2c0-1.7-1.3-3-3-3z"/></g></svg>',
        'icon-cart'     => '<svg class="icon icon-cart" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M11 12c-.6 0-1 .4-1 1s.4 1 1 1 1-.4 1-1-.4-1-1-1zm-6 0c-.6 0-1 .4-1 1s.4 1 1 1 1-.4 1-1-.4-1-1-1zm6-2H5V9h5.6c.8 0 1.5-.5 1.9-1.3L14 4H5V3c0-.6-.4-1-1-1H2v1h2v7c0 .6.4 1 1 1h7c0-.6-.4-1-1-1z"/></g></svg>',
        'icon-menu'     => '<svg class="icon icon-menu" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M0 14h16v-2H0v2zM0 2v2h16V2H0zm0 7h16V7H0v2z"/></g></svg>',
        'icon-search'   => '<svg class="icon icon-search" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M14.7 13.3L11 9.6c.6-.9 1-2 1-3.1C12 3.5 9.5 1 6.5 1S1 3.5 1 6.5 3.5 12 6.5 12c1.2 0 2.2-.4 3.1-1l3.7 3.7 1.4-1.4zM2.5 6.5c0-2.2 1.8-4 4-4s4 1.8 4 4-1.8 4-4 4-4-1.8-4-4z"/></g></svg>',
        'icon-next'     => '<svg class="icon icon-next" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M3 7h6.6L7.3 4.7l1.4-1.4L13.4 8l-4.7 4.7-1.4-1.4L9.6 9H3"/></g></svg>',
        'icon-previous' => '<svg class="icon icon-previous" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M13 7H6.4l2.3-2.3-1.4-1.4L2.6 8l4.7 4.7 1.4-1.4L6.4 9H13"/></g></svg>',
        'icon-video'    => '<svg class="icon icon-video" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M12 4v1h-1V4H5v1H4V4H2v9h2v-1h1v1h6v-1h1v1h2V4h-2zm-7 7H4v-1h1v1zm0-2H4V8h1v1zm0-2H4V6h1v1zm7 4h-1v-1h1v1zm0-2h-1V8h1v1zm0-2h-1V6h1v1z"/></g></svg>',
        'icon-audio'    => '<svg class="icon icon-video" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><rect x="0" fill="none" width="16" height="16"/><g><path d="M7.3 2.7L4 6H2v4h2l3.3 3.3c.6.6 1.7.2 1.7-.7V3.4c0-.9-1.1-1.3-1.7-.7zM13 3l-.7.7C13.3 4.8 14 6.3 14 8s-.7 3.2-1.8 4.2l.7.7c1.3-1.3 2.1-3 2.1-5 0-1.9-.8-3.6-2-4.9zm-1.5 1.5l-.7.7c.8.7 1.2 1.7 1.2 2.8s-.5 2.1-1.2 2.8l.7.7c.9-.9 1.5-2.1 1.5-3.5s-.6-2.6-1.5-3.5z"/></g></svg>',
        'icon-twitter'  => '<svg class="icon icon-twitter" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="0" fill="none" width="24" height="24"/><g><path d="M22.23 5.924a8.212 8.212 0 01-2.357.646 4.115 4.115 0 001.804-2.27 8.221 8.221 0 01-2.606.996 4.103 4.103 0 00-6.991 3.742 11.647 11.647 0 01-8.457-4.287 4.087 4.087 0 00-.556 2.063 4.1 4.1 0 001.825 3.415 4.09 4.09 0 01-1.859-.513v.052a4.104 4.104 0 003.292 4.023 4.099 4.099 0 01-1.853.07 4.11 4.11 0 003.833 2.85 8.236 8.236 0 01-5.096 1.756 8.33 8.33 0 01-.979-.057 11.617 11.617 0 006.29 1.843c7.547 0 11.675-6.252 11.675-11.675 0-.178-.004-.355-.012-.531a8.298 8.298 0 002.047-2.123z"/></g></svg>',
        'icon-facebook' => '<svg class="icon icon-facebook" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="0" fill="none" width="24" height="24"/><g><path d="M12 2C6.5 2 2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.3v7C18.3 21.1 22 17 22 12c0-5.5-4.5-10-10-10z"/></g></svg>',
        'icon-linkedin' => '<svg class="icon icon-linkedin" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="0" fill="none" width="24" height="24"/><g><path d="M19.7 3H4.3A1.3 1.3 0 003 4.3v15.4A1.3 1.3 0 004.3 21h15.4a1.3 1.3 0 001.3-1.3V4.3A1.3 1.3 0 0019.7 3zM8.339 18.338H5.667v-8.59h2.672v8.59zM7.004 8.574a1.548 1.548 0 11-.002-3.096 1.548 1.548 0 01.002 3.096zm11.335 9.764H15.67v-4.177c0-.996-.017-2.278-1.387-2.278-1.389 0-1.601 1.086-1.601 2.206v4.249h-2.667v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.779 3.203 4.092v4.711z"/></g></svg>',
        'icon-github'   => '<svg class="icon icon-github" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="0" fill="none" width="24" height="24"/><g><path d="M12 2C6.477 2 2 6.477 2 12c0 4.419 2.865 8.166 6.839 9.489.5.09.682-.218.682-.484 0-.236-.009-.866-.014-1.699-2.782.602-3.369-1.34-3.369-1.34-.455-1.157-1.11-1.465-1.11-1.465-.909-.62.069-.608.069-.608 1.004.071 1.532 1.03 1.532 1.03.891 1.529 2.341 1.089 2.91.833.091-.647.349-1.086.635-1.337-2.22-.251-4.555-1.111-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.254-.447-1.27.097-2.646 0 0 .84-.269 2.75 1.025A9.548 9.548 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.748-1.025 2.748-1.025.546 1.376.202 2.394.1 2.646.64.699 1.026 1.591 1.026 2.682 0 3.841-2.337 4.687-4.565 4.935.359.307.679.917.679 1.852 0 1.335-.012 2.415-.012 2.741 0 .269.18.579.688.481A9.997 9.997 0 0022 12c0-5.523-4.477-10-10-10z"/></g></svg>',
        'icon-instagram'=> '<svg class="icon icon-instagram" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="0" fill="none" width="24" height="24"/><g><path d="M12 4.622c2.403 0 2.688.009 3.637.052.877.04 1.354.187 1.671.31.42.163.72.358 1.035.673.315.315.51.615.673 1.035.123.317.27.794.31 1.671.043.949.052 1.234.052 3.637s-.009 2.688-.052 3.637c-.04.877-.187 1.354-.31 1.671-.163.42-.358.72-.673 1.035-.315.315-.615.51-1.035.673-.317.123-.794.27-1.671.31-.949.043-1.233.052-3.637.052s-2.688-.009-3.637-.052c-.877-.04-1.354-.187-1.671-.31a2.786 2.786 0 01-1.035-.673 2.786 2.786 0 01-.673-1.035c-.123-.317-.27-.794-.31-1.671-.043-.949-.052-1.234-.052-3.637s.009-2.688.052-3.637c.04-.877.187-1.354.31-1.671.163-.42.358-.72.673-1.035.315-.315.615-.51 1.035-.673.317-.123.794-.27 1.671-.31.949-.043 1.234-.052 3.637-.052M12 3c-2.444 0-2.751.01-3.711.054-.958.044-1.612.196-2.184.418a4.401 4.401 0 00-1.594 1.039c-.5.5-.808 1.002-1.038 1.594-.223.572-.375 1.226-.419 2.184C3.01 9.249 3 9.556 3 12s.01 2.751.054 3.711c.044.958.196 1.612.418 2.185.23.592.538 1.094 1.038 1.594s1.002.808 1.594 1.038c.572.222 1.227.375 2.185.418.96.044 1.267.054 3.711.054s2.751-.01 3.711-.054c.958-.044 1.612-.196 2.185-.418a4.411 4.411 0 001.594-1.038c.5-.5.808-1.002 1.038-1.594.222-.572.375-1.227.418-2.185.044-.96.054-1.267.054-3.711s-.01-2.751-.054-3.711c-.044-.958-.196-1.612-.418-2.185A4.411 4.411 0 0019.49 4.51c-.5-.5-1.002-.808-1.594-1.038-.572-.222-1.227-.375-2.185-.418C14.751 3.01 14.444 3 12 3zm0 4.378a4.622 4.622 0 100 9.244 4.622 4.622 0 000-9.244zM12 15a3 3 0 110-6 3 3 0 010 6zm4.804-8.884a1.08 1.08 0 10.001 2.161 1.08 1.08 0 00-.001-2.161z"/></g></svg>',
    );
    return apply_filters( 'voyager_icons', $icons );
}

/**
 * Retrieves or echoes a single icon
 * 
 * @param   string  $slug  Icon to display
 * @param   bool    $echo  Echo or not.
 * @return  string  $icon  Icon HTML
 */
function voyager_icon( $slug, $echo = true ){
    $icons = voyager_icons();
    $slug  = false === strpos( $slug, 'icon-' ) ? 'icon-' . $slug : $slug;
    $icon  = array_key_exists( $slug, $icons ) ? $icons[$slug] : '';
    if( $echo ){
        echo $icon;
    }
    return $icon;
}

add_filter( 'option_medium_size_w', 'voyager_default_image_dimensions', 10, 2 );
add_filter( 'option_medium_size_h', 'voyager_default_image_dimensions', 10, 2 );
/**
 * Filter the default 'Medium' image size.
 * 
 * @param   mixed   $value   Value of the option
 * @param   string  $option  Name of the option
 * @return  mixed   $value
 */
function voyager_default_image_dimensions( $value, $option ){
    $defaults = array(
        'medium_size_w' => 576,
        'medium_size_h' => false,
    );
    if( array_key_exists( $option, $defaults ) ){
        $value = $defaults[$option];
    }
    return $value;
}

add_filter( 'get_the_archive_title_prefix', 'voyager_archive_prefix', 10, 1 );
/**
 * Filters the archive prefix
 * 
 * @param   string  $prefix
 * @return  string  $prefix
 */
function voyager_archive_prefix( $prefix ){
    $prefix = '';
    return $prefix;
}