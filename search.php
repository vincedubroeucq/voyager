<?php
/**
 * The template file for search results page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Voyager
 */

get_header(); 
?>
    <main class="site-main">
        
        <?php if ( have_posts() ) : ?>

            <div class="wrapper main-wrapper maxw-lg mx-auto py-7 px-4">        
                <div class="posts-list">
                    <?php 
                        while ( have_posts() ) : the_post();     
                            get_template_part( 'template-parts/content-search' );
                        endwhile; 
                    ?>
                </div>

                <?php 
                    the_posts_pagination( array(
                        'class' => 'pagination text-center',
                        'prev_text' => sprintf( '%s<span class="screen-reader-text">%s</span>', voyager_icon( 'previous', false ), _x( 'Previous', 'previous set of posts' ) ),
                        'next_text' => sprintf( '<span class="screen-reader-text">%s</span>%s' , _x( 'Next', 'next set of posts' ), voyager_icon( 'next', false ) ), 
                    ) ); 
                ?>
            </div>

        <?php else : ?>

            <div class="wrapper main-wrapper maxw-mlg mx-auto py-7 px-4">
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            </div>
            
        <?php endif; ?>
    </main>
<?php 
get_footer();