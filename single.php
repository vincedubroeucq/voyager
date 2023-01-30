<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Voyager
 */

get_header(); 
?>
    <main class="site-main">
        <div class="wrapper main-wrapper maxw-mlg mx-auto py-7">
            <?php 
                if ( have_posts() ) :  
                    while ( have_posts() ) : 
                        the_post();                        
                        get_template_part( 'template-parts/content', get_post_type() );
                        
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    endwhile; 
                    
                    the_post_navigation(
                        array(
                            'prev_text' => sprintf( '<span class="mr-1">%s</span><span>%%title</span>', voyager_icon( 'previous', false ) ),
                            'next_text' => sprintf( '<span>%%title</span><span class="ml-1">%s</span>', voyager_icon( 'next', false ) ),
                        )
                    );
                endif;
            ?>
        </div>
    </main>
<?php 
get_footer();