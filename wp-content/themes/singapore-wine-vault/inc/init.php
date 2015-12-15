<?php
/**********
 * Useful functions for front-end
 ********************************/

 if( ! function_exists( 'swv_default_title' ) ):
/**************
 * Replace empty title with post published date.
 ***********************************************/

        function swv_default_title( $title ){
                if( empty( $title ) && in_array( get_post_type(), array( 'post', 'page', 'attachment' ) ) ){
                        $title = get_the_date();
                }
                return $title;
        }
        add_filter( 'the_title', 'swv_default_title', 1);
        
endif;

if( ! function_exists( 'swv_paginate' ) ):
/****************
 * Shows paginate on archives
 *
 * @param (string) $next_text   The text to render on the next link.
 * @param (string) $prev_text   The text to render on the previous link.
 ***********************************************************************/

        function swv_paginate( $title = 'Load More', $container = '', $post_type = 'post', $per_page = 5 ){
                global $wp_query;
                
                $paged = (int) get_query_var( 'page' );
                $paged = $paged == 0 ? 1 : $paged;
                
                if( $wp_query->max_num_pages > $paged ): ?>
                        <div class="text-center">
                                <?php
                                $more_link = add_query_arg(array(
                                        'nonce' => wp_create_nonce( 'load_more' ),
                                        'post_type' => $post_type,
                                        'per_page' => $per_page
                                ), home_url( '/' ) );
                                ?>
                                <span class="btn-loader"></span>
                                <a href="<?php echo esc_url( $more_link ); ?>" data-limit="<?php echo $wp_query->max_num_pages; ?>" data-page="<?php echo $paged; ?>" data-ajax="1" data-container="<?php echo $container; ?>" class="btn btn-show-more"><?php echo $title; ?></a>
                        </div>
                <?php
                endif;
        }
endif;

if( ! function_exists( 'swv_loadmore' ) ):
/********
 * Get more results via ajax
 ***************************/

        function get_loadmore(){
               global $wp_query;
               
               if( isset($_REQUEST['nonce']) && wp_verify_nonce( $_REQUEST['nonce'], 'load_more' ) ):
                       $post_type = get_query_var( 'post_type' );
                       $paged = (int) $_REQUEST['page'];
                       $per_page = 5;
                       
                       # Check if post_type set as $_REQUEST
                       if( isset( $_REQUEST['post_type'] ) ):
                               $post_type = $_REQUEST['post_type'];
                       endif;
                       
                       if( isset($_REQUEST['per_page'] ) ):
                               $per_page = (int) $_REQUEST['per_page'];
                       endif;
                       
                       $args = array( 'post_type' => $post_type, 'paged' => $paged, 'posts_per_page' => $per_page );
                       
                       $wp_query = new WP_Query( $args );
                       if( have_posts() ):
                                while( have_posts() ):
                                       the_post();
                                       get_template_part( 'content', get_post_type() );
                                endwhile;
                        endif;
                        exit;
               endif;
        }
        add_action( 'init', 'get_loadmore' );
 endif;
 
 if( ! function_exists( 'swv_site_identity' ) ):
/*****************
 * Shows the site's logo if set or the site title.
 *************************************************/

        function swv_site_identity(){
                
                $site_logo  = get_theme_mod( 'naked_logo', '' );
                $site_title = sprintf('<a href="%s" class="fadeIn site_title" rel="bookmark" title="%2$s"><span>%3$s</span></a>',
                        esc_url( home_url( '/') ),
                        __('Home Page', 'swv'),
                        get_bloginfo( 'name' )
                );
                
                if( !empty( $site_logo ) ){
                        printf('<a href="%1$s" class="site_logo" rel="bookmark" title="%2$s">%3$s</a>',
                                      esc_url( home_url('/' ) ),
                                       __('Home Page', 'naked'),
                                       sprintf('<img src="%s" alt="logo" />', esc_url( $site_logo))
                                );
                } else {
                        echo $site_title;
                }
        }
endif;

if( ! function_exists( 'swv_assets' ) ):
/****************
 * Set CSS and JS assets
 ***********************/

        function swv_assets(){
                
                $is_cdn       = swv_site_option( 'resource', 'local', 'local' ) == 'cdn';
                $local_assets = get_template_directory_uri() . '/assets';
                $cdn_assets   = "//cdnjs.cloudflare.com/ajax/libs";
                
                $css_assets = array(
                        'bootstrap-css' => 'twitter-bootstrap/3.3.5/css/bootstrap.min.css',
                        'font-awesome'  => 'font-awesome/4.4.0/css/font-awesome.min.css',
                        'animate-css'   => 'animate.css/3.4.0/animate.min.css',
                );
                $js_assets = array(
                        'jquery'     => 'jquery/1.11.3/jquery.min.js',
                        'underscore' => 'underscore.js/1.6.0/underscore-min.js',
                        'lazyload'   => 'jquery.lazyload/1.9.1/jquery.lazyload.min.js'
                );
                
                if( $is_cdn ){
                        
                        foreach( $js_assets as $script_id => $script_url ){
                                wp_deregister_script( $script_id );
                                wp_register_script( $script_id, "{$cdn_assets}/{$script_url}" );
                        }
                        
                        foreach( $css_assets as $css_id => $css_url ){
                                wp_deregister_style( $css_id );
                                wp_register_style( $css_id, "{$cdn_assets}/{$css_url}" );
                        }
                        
                } else {
                        wp_register_script( 'lazyload', "{$local_assets}/js/jquery.lazyload.min.js" );
                        wp_register_style( 'bootstrap-css', "{$local_assets}/css/bootstrap.min.css" );
                        wp_register_style( 'font-awesome', "{$local_assets}/css/font-awesome.min.css" );
                        wp_register_style( 'animate-css', "{$local_assets}/css/animate.min.css" );
                }
                
                wp_enqueue_script( 'jquery' ); // We use jQuery to all javascription instances
                wp_enqueue_script( 'underscore' ); // We use underscore to render some templates
                wp_enqueue_script( 'lazyload' );
                wp_enqueue_script( 'naked-common-js', "{$local_assets}/js/common.js" );
        
                wp_enqueue_style( 'bootstrap-css' );
                wp_enqueue_style( 'font-awesome' );
                wp_enqueue_style( 'animate-css' );
                wp_enqueue_style( 'swv-stylesheet', get_template_directory_uri() . '/style.css' );
                
        }
        add_action( 'wp_enqueue_scripts', 'swv_assets', 1 );
        
endif;

 function swv_excerpt_length( $length ){
        return 20;
 }
 add_filter( 'excerpt_length', 'swv_excerpt_length' );
 
 function swv_excerpt_more($more){
        return '...';
 }
 add_filter( 'excerpt_more', 'swv_excerpt_more' );