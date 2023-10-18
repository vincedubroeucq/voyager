<?php 
/**
 * Template Name: Full Width
 * Template Post Type: page, post
 */
get_header(); ?>

<main id="primary"class="site-main">
    <div class="wrapper main-wrapper mx-auto py-7">
        <?php 
            while( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;
        ?>
    </div>
</main>

<?php get_footer();