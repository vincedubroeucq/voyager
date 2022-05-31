<?php
/**
 * Template part for displaying header topbar
 *
 * @package Voyager
 */
?>
<?php if( has_nav_menu( 'menu-2' ) ) : ?>
    <div class="topbar relative">
        <div class="wrapper flex flex-wrap align-center maxw-xxl mx-auto px-4 py-1">
            <nav class="navigation topbar-navigation ml-auto">
                <?php 
                    wp_nav_menu( array(
                        'theme_location' => 'menu-2',
                        'menu_class'     => 'menu topbar-menu naked flex align-center',
                        'container'      => 'ul',
                        'fallback_cb'    => false
                    ) ); 
                ?>
            </nav>
        </div>
    </div>
<?php endif; ?>