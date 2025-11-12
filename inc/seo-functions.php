<?php

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