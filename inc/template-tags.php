<?php
/**
 * Custom template tags for this theme
 *
 * @package Voyager
 */

if( ! function_exists( 'voyager_header_image' ) ) :
/**
 * Displays header image, depending on page type.
 * 
 * @param   bool    $echo   Whether to echo or just return.
 * @return  string  $html   Image html
 */
function voyager_header_image( $echo = true ){
    $header   = get_custom_header();
    $image_id = ! empty( $header->attachment_id ) ? (int) $header->attachment_id : 0;

    if( is_singular() && $post_thumbnail_id = get_post_thumbnail_id() ){
        $image_id = $post_thumbnail_id;
    }

    $html  = '';
    $image = wp_get_attachment_image( $image_id, '2048x2048', false, array( 'class' => 'header-image' ) );
    if( $image ){
        $html = sprintf( '<div class="header-image-container absolute cover">%s</div>', $image );
    }

    $html = apply_filters( 'voyager_header_image_html', $html );
    if( $echo ) {
        echo $html;
    }
    return $html;
}
endif;


if( ! function_exists( 'voyager_hero_title' ) ) :
/**
 * Displays or returns page title.
 * 
 * @param   bool    $echo  Echo or not.
 * @return  string  $html  Page title HTML
 */
function voyager_hero_title( $echo = true ){
    $title = single_post_title( '', false );
    if( is_front_page() && is_home() ){
        $title = get_bloginfo( 'name' );
    }
    if( is_archive() ){
        $title = get_the_archive_title();
    }
    if( is_search() ){
        /* translators: %s Search query */
        $title = sprintf( esc_html__( 'Search Results for: %s', 'voyager' ), '<span>' . get_search_query() . '</span>' );
    }
    if( is_404() ){
        $title = __( 'Not found !', 'voyager' );
    }
    $html = ! empty( $title ) ? sprintf( '<h1 class="page-title mt-0">%s</h1>', wp_kses_post( $title ) ) : ''; 
    $html = apply_filters( 'voyager_hero_title', $html );
    if( $echo ) {
        echo $html;
    }
    return $html;
}
endif;


if( ! function_exists( 'voyager_hero_description' ) ) :
/**
 * Displays or returns page description.
 * 
 * @param   bool    $echo  Echo or not.
 * @return  string  $html  Page description HTML
 */
function voyager_hero_description( $echo = true ){
    $description = '';
    if( is_single() ){
        $description = voyager_post_meta( false );
    }
    if( is_front_page() && is_home() ){
        $description = get_bloginfo( 'description' );
    }

    $html = ! empty( $description ) ? sprintf( '<div class="page-description">%s</div>', wp_kses_post( $description ) ) : ''; 
    $html = apply_filters( 'voyager_hero_description', $html );
    if( $echo ) {
        echo $html;
    }
    return $html;
}
endif;


if( ! function_exists( 'voyager_post_meta' ) ) :
/**
 * Displays post meta on cards and post header on single pages
 * 
 * @param   bool    $echo  Echo or not.
 * @return  string  $html  Page description HTML
 */
function voyager_post_meta( $echo = true ){
    $html = '';
    $meta = array();

    $time   = sprintf( '<time class="entry-date published" datetime="%s">%s</time>', esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ) );
    $prefix = sprintf( '<span class="screen-reader-text">%s</span>', __( 'Published on: ', 'voyager' ) );
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time   = sprintf( '<time class="entry-date updated" datetime="%s">%s</time>', esc_attr( get_the_modified_date( DATE_W3C ) ), esc_html( get_the_modified_date() ) );
        $prefix = sprintf( '<span class="screen-reader-text">%s</span>', __( 'Updated on: ', 'voyager' ) );
    }
    $meta[] = sprintf( '<span class="meta date">%s%s</span>', $prefix, $time );

    $categories = get_the_category();
    if( ! empty( $categories ) ){
        foreach ( $categories as $category ) {
            $meta[] = sprintf( '<span class="meta category mb-0"><a class="naked" href="%s">%s</a></span>', esc_url( get_category_link( $category->term_id ) ), esc_html( $category->name ) ); 
        }
    }

    $edit_link = get_edit_post_link();
    if( $edit_link ){
        $meta[] = sprintf( '<span class="meta edit-link"><a href="%s" class="post-edit-link naked">%s</a></span>', $edit_link, __( 'Edit', 'voyager' ) );
    }

    $meta = apply_filters( 'voyager_post_meta', $meta );
    $html = ! empty( $meta ) ? sprintf( '<div class="post-meta uppercase txt-2">%s</div>', join( '<span class="seperator mx-1">|</span>', $meta ) ) : '';
    $html = apply_filters( 'voyager_post_meta_html', $html );
    if( $echo ) {
        echo $html;
    }
    return $html;
}
endif;


if( ! function_exists( 'voyager_post_footer' ) ) :
    /**
     * Displays post footer, with tags and edit link.
     * 
     * @param   bool    $echo  Echo or not.
     * @return  string  $html  Page description HTML
     */
    function voyager_post_footer( $echo = true ){
        $html = '';
        $meta = [];
    
        $tags = get_the_tags();
        if( ! empty( $tags ) ){
            foreach ( $tags as $tag ) {
                $meta[] = sprintf( '<span class="meta tag mb-0"><a class="naked" href="%s">%s</a></span>', esc_url( get_tag_link( $tag->term_id ) ), esc_html( $tag->name ) ); 
            }
        }
    
        $edit_link = get_edit_post_link();
        if( $edit_link ){
            $meta[] = sprintf( '<span class="meta edit-link"><a href="%s" class="post-edit-link naked">%s</a></span>', $edit_link, __( 'Edit', 'voyager' ) );
        }
    
        $html = sprintf( '<footer class="post-footer uppercase txt-2 flex flex-wrap flex-end">%s</footer>', join( '<span class="seperator mx-1">|</span>', $meta ) );
        $html = apply_filters( 'voyager_post_footer', $html );
        if( $echo ) {
            echo $html;
        }
        return $html;
    }
    endif;


if( ! function_exists( 'voyager_post_format_icon' ) ) :
    /**
     * Displays optional post format icon on cards
     */
function voyager_post_format_icon( $echo = true ){
    $html   = '';
    $format = get_post_format();
    $icon   = voyager_icon( sanitize_title( $format ), false );
    $url    = get_post_format_link( $format );
    if( $format && $icon  ){
        $html = sprintf( '<a href="%s" class="post-format-icon absolute flex flex-center align-center">%s<span class="post-format-label screen-reader-text">%s</span></a>', esc_url( $url ), $icon, esc_html( get_post_format_string( $format ) ) );
    }

    $html = apply_filters( 'voyager_post_format_icon', $html );
    if( $echo ) {
        echo $html;
    }
    return $html;
}
endif;

if( ! function_exists( 'voyager_comment' ) ) :
/**
 * Custom callback for comments
 * 
 * @param  WP_Comment  $comment
 * @param  array       $args     Arguments passed to wp_list_comment()
 * @param  int         $depth    Depth of the comment
 */
function voyager_comment( $comment, $args, $depth ){
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

    $commenter          = wp_get_current_commenter();
    $show_pending_links = ! empty( $commenter['comment_author'] );
    
    $comment_author = get_comment_author_link( $comment );
    if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
        $comment_author = get_comment_author( $comment );
    }

    if ( $commenter['comment_author_email'] ) {
        $moderation_note = __( 'Your comment is awaiting moderation.' );
    } else {
        $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class( ! empty( $comment->get_children() ) ? 'parent' : '', get_comment_ID() ); ?>>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body mb-2 p-4">
            <div class="comment-content">   
                <?php 
                    if ( '0' == $comment->comment_approved ) {
                        sprintf( '<div class="comment-awaiting-moderation"><em>%s</em></div>', esc_html( $moderation_note ) );
                    }
                    if ( 0 != $args['avatar_size'] ) {
                        echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'alignleft') );
                    }
                    comment_text();
                ?>
            </div><!-- .comment-content -->

            <footer class="comment-meta uppercase flex flex-wrap flex-end align-center smaller grey-3">
                <span class="comment-author vcard">
                    <?php printf( '<strong class="fn author-name">%s</strong>', $comment_author ); ?>
                </span><!-- .comment-author -->
                <span class="seperator mx-1">|</span>
                <span class="comment-date">
                    <?php printf(
                        '<time datetime="%s">%s</time>',
                        get_comment_time( 'c' ),
                        sprintf(
                            /* translators: 1: Comment date, 2: Comment time. */
                            __( '%1$s at %2$s' ),
                            get_comment_date( '', $comment ),
                            get_comment_time()
                        )
                    ); ?>
                </span><!-- .comment-metadata -->
                <?php 
                    if ( '1' == $comment->comment_approved || $show_pending_links ) {
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<span class="seperator mx-1">|</span><span class="reply">',
                                    'after'     => '</span></span>',
                                )
                            )
                        );
                    }
                    edit_comment_link( __( 'Edit' ), '<span class="seperator mx-1">|</span><span class="edit-link">', '</span>' ); ?>
            </footer><!-- .comment-meta -->
        </div><!-- .comment-body -->
    <?php
}
endif;
