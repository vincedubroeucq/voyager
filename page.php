<?php
/**
 * The template for displaying all single pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package Voyager
 */

get_header();
?>
    <main id="primary" class="site-main">
        <div class="wrapper main-wrapper maxw-mlg mx-auto py-7">
            <?php 
                if ( have_posts() ) :  
                    while ( have_posts() ) : 
                        the_post();                        
                        get_template_part( 'template-parts/content', get_post_type() );
                    endwhile; 
                endif;
            ?>
        </div>
    </main>
<?php 
get_footer();