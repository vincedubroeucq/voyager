<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Voyager
 */

get_header(); 
?>
    <main class="site-main">
        
        <?php if ( have_posts() ) : ?>

            <div class="wrapper main-wrapper maxw-xxl mx-auto py-7">        
                <div class="grid posts-grid">
                    <?php 
                        while ( have_posts() ) : the_post();     
                            get_template_part( 'template-parts/card' );
                        endwhile; 
                    ?>
                </div>

                <?php 
                    the_posts_pagination( array(
                        'class' => 'pagination',
                        'prev_text' => sprintf( '%s<span class="screen-reader-text">%s</span>', voyager_icon( 'previous', false ), _x( 'Previous', 'previous set of posts' ) ),
                        'next_text' => sprintf( '<span class="screen-reader-text">%s</span>%s' , _x( 'Next', 'next set of posts' ), voyager_icon( 'next', false ) ), 
                    ) ); 
                ?>
            </div>

        <?php else : ?>

            <div class="wrapper main-wrapper maxw-mlg mx-auto py-7">
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            </div>
            
        <?php endif; ?>
    </main>
<?php 
get_footer();