<?php
 if( ! function_exists( 'swv_customize_scripts' ) ):
/**********
 * Add scripts and css
 *********************/
        
        function swv_customize_scripts(){
                wp_enqueue_script( 'media-js', get_template_directory_uri() . '/assets/js/media.js' );
                wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/assets/css/admin-css.css' );
        }
        add_action( 'customize_controls_print_footer_scripts', 'swv_customize_scripts' );
endif;

/****
 * Page Walker
 *************/
global $page_depth;
$page_depth = 0;

function walk_page( $page_id ){
        global $page_depth;
        
        $args = array();
        $page_lists = array();
        
        if( $page_depth == 0 ){
                $page_lists[] = __('-Select-');
        }
        
        if( $page_id > 0 ) $args['child_of'] = $page_id;
        else $args['parent'] = 0;
                
        $pages = get_pages( $args );
        $str = str_repeat('&rarr;', $page_depth);
                
        if( $pages && !is_wp_error($pages) ){
                foreach( $pages as $page ){
                        $page_lists[$page->ID] = $str . $page->post_title;
                        $child = walk_page( $page->ID );
                        $child = array_filter( $child );
                                
                        foreach( $child as $kid_id => $kid_title ) $page_lists[$kid_id] = $kid_title;
                }
        }
                
        if( $page_id > 0 && count( $page_lists ) > 0 && $page_depth == 0 ) $page_depth++;
                
        return $page_lists;
 }
        
/***************
 * Site Logo
 *****************/
 $customizer->add_setting( 'swv_logo');
 $customizer->add_control(
        new WP_Customize_Image_Control($customizer, 'swv_logo',
        array(
                'label'   => __('Site Logo', 'swv'),
                'setting' => 'swv_logo',
                'section' => 'title_tagline'
        )));
 
/********************
 * Settings Panel
 **************************/
 $customizer->add_panel( 'swv_settings', array(
        'title'       => __('SWG Settings', 'swv'),
        'description' => __('Fully customized the look and feel of your theme!', 'swv'),
        'priority'    => 25
 ));
 
 /********************
 * General Settings
 **************************/
 $customizer->add_section( 'swv_general', array(
        'title' => __('General', 'swv'),
        'panel' => 'swv_settings' )
        );
 $customizer->add_setting( 'swv_resource', array('default' => 'local' ) );
 $customizer->add_control(
        new WP_Customize_Control( $customizer,
        'swv_resource',
        array(
                'label'       => __('Resource Libraries (CSS & JS)', 'swv'),
                'section'     => 'swv_general',
                'setting'     => 'swv_resource',
                'description' => __('This theme allows you to load CSS and Javascript libraries directly from CDN to help optimized your site.', 'swv'),
                'type'        => 'select',
                'choices'     => array(
                        'local' => __('Local', 'swv'),
                        'cdn'   => __('CDN', 'swv')
                )
        )));

/******************
 * Social Links
 ***************************/
 $customizer->add_section( 'swv_socials', array(
        'title'       => __('Social Links', 'swv'),
        'description' => __('Enter the complete URL. Ex: https://www.facebook.com/irenem<br />To remove LINK from the list, simply remove the URL from the box.', 'swv'),
        'panel'       => 'swv_settings'
        ));
 
 foreach( array(
        'linkedin'    => __('LinkedIn', 'swv'),
        'google-plus' => __('Google+', 'swv'),
        'facebook'    => __('Facebook', 'swv'),
        'twitter'     => __('Twitter', 'swv'),
        'youtube'     => __('YouTube', 'swv'),
        'instagram'   => __('Instagram', 'swv')
 ) as $social => $social_title ){
        $social_id = "swv_socials[{$social}]";
        $customizer->add_setting( $social_id );
        $customizer->add_control(
                new WP_Customize_Control( $customizer,
                $social_id,
                array(
                        'label'   => $social_title,
                        'setting' => $social_id,
                        'section' => 'swv_socials'
                ))     
        );
 }
 
 /*********
  * Home Page
  *****************/
 $page_lists = walk_page(0);
 
 $customizer->add_panel('home_page', array(
        'title' => __('Front Page', 'swv'),
        'description' => __('The page that appears at your home page.', 'swv'),
        'priority' => 26
 ));
 
 # Section 1
 $customizer->add_section( 'swv_section_1', array(
        'title' => __('Section 1: Featured Video', 'swv'),
        'panel' => 'home_page'
 ));
 $customizer->add_setting( 'swv_section[1][heading]' );
 $customizer->add_control( new WP_Customize_Control(
        $customizer,
        'swv_section[1][heading]',
        array(
                'label' => __('Heading', 'swv'),
                'type' => 'text',
                'setting' => 'swv_section[1][heading]',
                'sanitized_callback' => 'sanitized_field',
                'section' => 'swv_section_1'
        )
 ));
 $customizer->add_setting( 'swv_section[1][tagline]' );
 $customizer->add_control( new WP_Customize_Control(
        $customizer,
        'swv_section[1][tagline]',
        array(
                'label' => __('Description', 'swv'),
                'type' => 'textarea',
                'setting' => 'swv_section[1][Tagline]',
                'sanitized_callback' => 'sanitized_field',
                'section' => 'swv_section_1'
        )
 ));
 $customizer->add_setting( 'swv_section[1][video_link]' );
 $customizer->add_control( new WP_Customize_Control(
        $customizer,
        'swv_section[1][video_link]',
        array(
                'label' => __('Video Link', 'swv'),
                'description' => __('Enter the complete video link or YouTube VIDEO_ID.', 'swv'),
                'type' => 'text',
                'setting' => 'swv_section[1][video_link]',
                'sanitized_callback' => 'sanitized_field',
                'section' => 'swv_section_1'
        )
 ));
 $customizer->add_setting( 'swv_section[1][portrait]' );
 $customizer->add_control( new WP_Customize_Control(
        $customizer,
        'swv_section[1][portrait]',
        array(
                'label' => __('Portrait Image', 'swv'),
                'type' => 'text',
                'setting' => 'swv_section[1][portrait]',
                'input_attrs' => array(
                        'data-addimage' => 'image',
                        'data-width' => 300,
                        'data-height' => 150,
                        'data-title'  => __('Video Portrait Image', 'swv')
                ),
                'section' => 'swv_section_1'
        )
 ));
 $customizer->add_setting( 'swv_section[1][contact_link]');
 $customizer->add_control(new WP_Customize_Control(
        $customizer,
        'swv_section[1][contact_link]',
        array(
                'label' => __('Contact Link', 'swv'),
                'description' => __('Enter the complete URL. Ex. http://www.singaporewinevault.com', 'swv'),
                'sanitized_callback' => 'sanitized_textfield',
                'setting' => 'swv_section[1][contact_link]',
                'section' => 'swv_section_1'
        )
 ));
 $customizer->add_setting( 'swv_section[1][more_link]');
 $customizer->add_control(new WP_Customize_Control(
        $customizer,
        'swv_section[1][more_link]',
        array(
                'label' => __('More Link', 'swv'),
                'description' => __('Enter the complete URL. Ex. http://www.singaporewinevault.com', 'swv'),
                'sanitized_callback' => 'sanitized_textfield',
                'setting' => 'swv_section[1][more_link]',
                'section' => 'swv_section_1'
        )
 ));
 
 #Section 2
 $customizer->add_section( 'swv_section_2', array(
        'title' => __('Section 2: Featured Contents', 'swv'),
        'panel' => 'home_page'
 ));
 
 for($i=1; $i <=3 ; $i++):
        $section2_id = "swv_section[2][{$i}]";
        $customizer->add_setting( "{$section2_id}[img]" );
        $customizer->add_control( new WP_Customize_Control(
                $customizer,
                "{$section2_id}[img]",
                array(
                        'label' => __('Content ' . $i, 'swv'),
                        'description' => __('Featured Image', 'swv'),
                        'section' => 'swv_section_2',
                        'setting' => "{$section2_id}[img",
                        'sanitized_callback' => 'sanitized_textfield',
                        'input_attrs' => array(
                                'data-addimage' => 'image',
                                'data-title' => __('Featured Image '. $i, 'swv'),
                                'data-width' => 300,
                                'data-height' => 120
                        )
                )
        ));
        $customizer->add_setting( "{$section2_id}[heading]" );
        $customizer->add_control( new WP_Customize_Control(
                $customizer,
                "{$section2_id}[heading]",
                array(
                        'description' => __('Title', 'swv'),
                        'section' => 'swv_section_2',
                        'setting' => "{$section2_id}[heading]",
                        'sanitized_callback' => 'sanitized_textfield'
                )
        ));
        $customizer->add_setting( "{$section2_id}[tagline]" );
        $customizer->add_control( new WP_Customize_Control(
                $customizer,
                "{$section2_id}[tagline]",
                array(
                        'description' => __('Description', 'swv'),
                        'section' => 'swv_section_2',
                        'setting' => "{$section2_id}[tagline]",
                        'sanitized_callback' => 'sanitized_textarea',
                        'type' => 'textarea'
                )
        ));
 endfor;
 
 # Section 3
 $customizer->add_section( 'swv_section_3', array(
        'title' => __('Section 3: The Vault', 'swv'),
        'panel' => 'home_page'
 ));
 $customizer->add_setting( 'swv_section[3][heading]' );
 $customizer->add_control(new WP_Customize_Control(
        $customizer,
        'swv_section[3][heading]',
        array(
                'label' => __('Heading', 'swv'),
                'setting' => 'swv_section[3][heading]',
                'section'=> 'swv_section_3',
                'sanitized_callback' => 'sanitized_field'
        )
 ));
 $customizer->add_setting( 'swv_section[3][tagline]' );
 $customizer->add_control(new WP_Customize_Control(
        $customizer,
        'swv_section[3][tagline]',
        array(
                'label' => __('Short Description', 'swv'),
                'setting' => 'swv_section[3][tagline]',
                'section'=> 'swv_section_3',
                'sanitized_callback' => 'sanitized_field',
                'type' => 'textarea'
        )
 ));
 
 # Section 4
 $customizer->add_section( 'swv_section_4', array(
        'title' => __('Section 4: Wine Vault APP', 'swv'),
        'panel' => 'home_page'
 ));
 $customizer->add_setting( 'swv_section[4][heading]' );
 $customizer->add_control(new WP_Customize_Control(
        $customizer,
        'swv_section[4][heading]',
        array(
                'label' => __('Heading', 'swv'),
                'setting' => 'swv_section[4][heading]',
                'section'=> 'swv_section_4',
                'sanitized_callback' => 'sanitized_field'
        )
 ));
 $customizer->add_setting( 'swv_section[4][tagline]' );
 $customizer->add_control(new WP_Customize_Control(
        $customizer,
        'swv_section[4][tagline]',
        array(
                'label' => __('Short Description', 'swv'),
                'setting' => 'swv_section[4][tagline]',
                'section'=> 'swv_section_4',
                'sanitized_callback' => 'sanitized_field',
                'type' => 'textarea'
        )
 ));
 $customizer->add_setting( 'swv_section[4][page_id]' );
 $customizer->add_control( new WP_Customize_Control(
        $customizer,
        'swv_section[4][page_id]',
        array(
                'label' => __('Link to', 'swv'),
                'type' => 'select',
                'choices' => $page_lists,
                'setting' => 'swv_section[4][page_id]',
                'sanitized_callback' => 'sanitized_field',
                'section' => 'swv_section_4'
        )
 ));