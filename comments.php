<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Voyager
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area my-5 p-5 bg-grey-0">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title"><?php esc_html_e( 'Discussion', 'voyager' ); ?></h2>

		<?php 
            the_comments_navigation(
                array(
                    'prev_text' => sprintf( '<span class="mr-1">%s</span><span>%s</span>', voyager_icon( 'previous', false ), __( 'Older comments', 'voyager' ) ),
                    'next_text' => sprintf( '<span>%s</span><span class="ml-1">%s</span>', __( 'Newer comments', 'voyager' ), voyager_icon( 'next', false ) ),
                )
            ); 
        ?>

		<ul class="comment-list naked">
			<?php
                wp_list_comments(
                    array(
                        'style'    => 'ul',
                        'callback' => 'voyager_comment',
                        'avatar_size' => 48
                    )
                );
			?>
		</ul>

		<?php
            the_comments_navigation(
                array(
                    'prev_text' => sprintf( '<span class="mr-1">%s</span><span>%s</span>', voyager_icon( 'previous', false ), __( 'Older comments', 'voyager' ) ),
                    'next_text' => sprintf( '<span>%s</span><span class="ml-1">%s</span>', __( 'Newer comments', 'voyager' ), voyager_icon( 'next', false ) ),
                )
            ); 

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'voyager' ); ?></p>
		<?php endif;

	endif;

	comment_form();
	?>

</div>
