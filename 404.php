<?php
/**
 * The template for displaying the 404 page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#404-not-found
 *
 * @package Voyager
 */

get_header(); 
?>
    <main class="site-main">
        <div class="wrapper main-wrapper maxw-mlg mx-auto py-7 px-4">
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        </div>
    </main>
<?php 
get_footer();