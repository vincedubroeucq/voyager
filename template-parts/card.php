<?php
/**
 * Template part for displaying posts cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Voyager
 */
$permalink = get_permalink();
?>

<article <?php post_class( 'card maxw-sm mx-auto bg-grey-0' ); ?>>
    <div class="wrapper card-wrapper p-5">
        <?php if( has_post_thumbnail() ) : ?>
            <a class="post-thumbnail block relative" href="<?php echo esc_url( $permalink ); ?>">
                <?php 
                    the_post_thumbnail( 'medium' ); 
                    voyager_post_format_icon();
                ?>
            </a>
        <?php endif; ?>
        <div class="post-summary">
            <h2 class="entry-title txt-6 mt-3 mb-1">
                <a class="naked" href="<?php echo esc_url( $permalink ) ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>
            <div class="excerpt"><?php the_excerpt(); ?></div>
        </div>
        <footer class="post-footer grey-3">
            <?php voyager_post_meta(); ?>
        </footer>
    </div>
</article>