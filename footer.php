<?php
/**
 * The default footer template
 */
/* translators: %1$s author URL, %2$s Author name*/
$footer_text = get_theme_mod( 'voyager_footer_text', sprintf( __( 'Theme by <a href="%1$s">%2$s</a>', 'voyager' ), 'https://vincentdubroeucq.com', 'Vincent Dubroeucq' ) );
?>
    <footer class="site-footer">
        <div class="wrapper footer-wrapper">
            <?php get_sidebar( 'sidebar-1' ); ?>
            <div class="site-info text-center bg-grey-5 grey-1">
                <div class="wrapper site-info-wrapper flex-wrap align-center space-between maxw-xxl mx-auto px-4 py-1">
                    <span class="copyright">
                        <?php echo wp_kses_post( $footer_text ); ?>
                    </span>
                    <nav class="navigation footer-navigation ml-auto">
                        <?php 
                            wp_nav_menu( array(
                                'theme_location' => 'menu-3',
                                'menu_class'     => 'menu footer-menu naked flex align-center flex-center',
                                'container'      => 'ul',
                                'fallback_cb'    => false
                            ) );
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>