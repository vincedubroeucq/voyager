<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Voyager
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="widget-area footer-widget-area grey-1">
    <div class="wrapper widget-area-wrapper grid maxw-xxl mx-auto px-4 py-7">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>            
    </div>
</aside>
