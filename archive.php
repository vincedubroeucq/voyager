<?php
/**
 * The archive template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Voyager
 */
$description = get_the_archive_description();
get_header(); 
?>
    <main id="primary" class="site-main">
        
        <?php if ( have_posts() ) : ?>

            <div class="wrapper main-wrapper maxw-xxl mx-auto py-7">
                
                <?php if ( ! empty( $description ) ) : ?>
                    <div class="archive-description maxw-mlg mx-auto my-5 p-5 bg-grey-0">
                        <?php echo wp_kses_post( $description ); ?>
                    </div>
                <?php endif; ?>

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