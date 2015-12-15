<?php
/*********
 * Main functions and definitions
 ********************************/

 if( ! function_exists( 'swv_setup' ) ):
 /*******
  * Add supports
  ***************/
        
        function swv_setup(){
                add_theme_support( 'automatic-feed-links' );
                add_theme_support( 'title-tag' );
                add_theme_support( 'post-thumbnails' );
                
                add_theme_support( 'html5', array(
                        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
                ) );
                
                # This theme only supports 1 menu
                register_nav_menus(array(
                        'primary' => __('Main Navigation', 'swv'),
                        'blog_menu' => __('Blog Menu', 'swv')
                ));
        }
        add_action( 'after_setup_theme', 'swv_setup' );
 endif;

 /*********
  * Register sidebars and widgets
  *******************************/
 if( ! function_exists( 'swv_widgets_init' ) ):
 
        function swv_widgets_init(){
                $sidebar = array(
                        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</aside>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>'
                );
                
                // Define Left Sidebar
                register_sidebar( array_merge($sidebar, array(
                    'name' => __('Left Sidebar', 'swv'),
                    'description' => __('Left Sidebar', 'swv'),
                    'id' => 'widget-area-2'
                )));
                
                // Define Right Sidebar
                register_sidebar(array_merge( $sidebar, array(
                    'name' => __('Right Sidebar', 'swv'),
                    'description' => __('Right Sidebar', 'swv'),
                    'id' => 'right-sidebar'
                )));
            
                for($i=1; $i <= 4; $i++ ){
                        register_sidebar( array_merge( array(
                                'id'          => "footer-{$i}",
                                'name'        => __('Footer Box ', 'naked') . $i,
                                'description' => __('Appears at the bottom to all pages.', 'swv')
                        ), $sidebar ));
                        
                }
                
        }
        add_action( 'widgets_init', 'swv_widgets_init' );
 
 endif;
 
 if( ! function_exists( 'swv_site_option' ) ):
/*******************
 * A helper function to get the theme's settings
 *
 * @param (string) $option_name         The option name to get the value from.
 * @param (mixed) $default_value       The default value to use when no value is found.
 * @param (mixed)  $default             The default value to use when settings is not set.
 * 
 *******************************************************************************************/
        function swv_site_option($option_name, $default_value = '', $default = '' ){
                $option_name = "swv_{$option_name}";
                $value = get_theme_mod( $option_name, $default );
                
                return empty( $value ) ? $default_value : $value;
        }
endif;
 
 if( ! function_exists( 'swv_customizer' ) ):
 /**********
  * Include customizer for theme-options
  **************************************/
 
        function swv_customizer( $customizer ){
                require_once dirname(__FILE__) . '/inc/customizer.php';
        }
        add_action( 'customize_register', 'swv_customizer' );
        
 endif;
 
 /******
  * Include functions used at front-end
  *************************************/
 if( ! is_admin() ) get_template_part( 'inc/init' );