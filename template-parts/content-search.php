<?php
/**
 * Template part for displaying posts in list format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Voyager
 */
$permalink = get_permalink();
?>

<article <?php post_class( 'search-result p-4' ); ?>>
    <div class="wrapper card-wrapper flex flex-wrap align-start">
        <?php if( has_post_thumbnail() ) : ?>
            <a class="post-thumbnail block relative mr-4" href="<?php echo esc_url( $permalink ); ?>">
                <?php 
                    the_post_thumbnail( 'thumbnail' ); 
                    voyager_post_format_icon();
                ?>
            </a>
        <?php endif; ?>
        <div class="post-summary">
            <h2 class="entry-title txt-6 my-1">
                <a class="naked" href="<?php echo esc_url( $permalink ) ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>
            <div class="excerpt"><?php the_excerpt(); ?></div>
            <footer class="post-footer grey-3">
                <?php voyager_post_meta(); ?>
            </footer>
        </div>
    </div>
</article>