<?php
/************
 * The themes main header content which outputs the site logo and primary menu
 *****************************************************************************/
?>
<div class="container main-header-container">
        <div class="masthead">
                <?php swv_site_identity(); ?>
        </div>
        <div class="header-container">
                <button type="button" class="flat navbar-toggle">
                        <span class="fa fa-bars"></span>
                        <span class="toggle-text"><?php _e('Menu', 'swv'); ?></span>
                </button>
                <nav id="navigation" role="navigation">
                        <?php
                                wp_nav_menu(array(
                                        'theme_location' => 'primary',
                                        'fallback_cb' => false,
                                        'container' => 'div',
                                        'container_class' => 'primary-menu',
                                        'menu_class' => 'nav navbar-nav'
                                ));
                        ?>
                </nav>
        </div>
</div>