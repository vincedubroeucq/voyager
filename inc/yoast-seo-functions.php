<?php
/**
 * Yoast SEO integration functions
 */

add_filter( 'wpseo_breadcrumb_separator', 'voyager_breadcrumb_seperator' );
/**
 * Adds a wrapper to breadcrumbs seperator.
 * 
 * @param   string  $seperator 
 * @return  string  $seperator 
 */
function voyager_breadcrumb_seperator( $seperator ) {
    return sprintf( '<span class="seperator mx-1">%s</span>', $seperator );
}

add_filter( 'wpseo_breadcrumb_single_link', 'voyager_breadcrumb_link', 10, 2 );
/**
 * Adds classes to breadcrumb links
 * 
 * @param   string  $link        Link HTML
 * @param   array   $breadcrumb  Breadcrumb data
 * @return  string  $link
 */
function voyager_breadcrumb_link( $link, $breadcrumb ) {
    $link = str_replace( '<a href=', '<a class="breadcrumb naked" href=', $link );
    return $link;
}

