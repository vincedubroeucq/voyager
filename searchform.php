<?php
/**
 * The search form for our theme
 *
 * @package Voyager
 */
?>
<form role="search" method="get" class="search-form flex flex-wrap" action="<?php echo esc_attr( home_url() );?>">
    <label>
        <span class="screen-reader-text"><?php esc_html_e( 'Search:', 'voyager' )?></span>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search the site', 'voyager' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
    </label>
    <button type="submit" class="search-submit">
        <?php voyager_icon( 'search' ); ?>
        <span class="search-submit-label screen-reader-text"><?php esc_html_e( 'Search', 'voyager' ); ?></span>
    </button>
</form>