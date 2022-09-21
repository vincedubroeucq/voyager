<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Voyager
 */
$message = is_search() ? __( 'Sorry, but we could not find anything that matched your search terms. Please try again with some different keywords.', 'voyager' ) : __( 'Sorry, but we could not find what you are looking for. Can you maybe try a search ?', 'voyager' );
?>
<div class="no-results not-found p-5 bg-grey-0">
    <?php
        echo sprintf( '<p>%s</p>', esc_html__( $message ) );
        get_search_form();
    ?>
</div><!-- .no-results -->
