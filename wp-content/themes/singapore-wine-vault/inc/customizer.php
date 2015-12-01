<?php
/***************
 * Site Logo
 *****************/
 $customizer->add_setting( 'naked_logo');
 $customizer->add_control(
        new WP_Customize_Image_Control($customizer, 'naked_logo',
        array(
                'label'   => __('Site Logo', 'swv'),
                'setting' => 'naked_logo',
                'section' => 'title_tagline'
        )));
 
/********************
 * Settings Panel
 **************************/
 $customizer->add_panel( 'naked_settings', array(
        'title'       => __('SWG Settings', 'swv'),
        'description' => __('Fully customized the look and feel of your theme!', 'swv'),
        'priority'    => 25
 ));
 
 /********************
 * General Settings
 **************************/
 $customizer->add_section( 'naked_general', array(
        'title' => __('General', 'naked'),
        'panel' => 'naked_settings' )
        );
 $customizer->add_setting( 'naked_resource', array('default' => 'local' ) );
 $customizer->add_control(
        new WP_Customize_Control( $customizer,
        'naked_resource',
        array(
                'label'       => __('Resource Libraries (CSS & JS)', 'naked'),
                'section'     => 'naked_general',
                'setting'     => 'naked_resource',
                'description' => __('This theme allows you to load CSS and Javascript libraries directly from CDN to help optimized your site.', 'naked'),
                'type'        => 'select',
                'choices'     => array(
                        'local' => __('Local', 'naked'),
                        'cdn'   => __('CDN', 'naked')
                )
        )));

/******************
 * Social Links
 ***************************/
 $customizer->add_section( 'naked_socials', array(
        'title'       => __('Social Links', 'naked'),
        'description' => __('Enter the complete URL. Ex: https://www.facebook.com/irenem<br />To remove LINK from the list, simply remove the URL from the box.', 'naked'),
        'panel'       => 'naked_settings'
        ));
 
 foreach( array(
        'linkedin'    => __('LinkedIn', 'naked'),
        'google-plus' => __('Google+', 'naked'),
        'facebook'    => __('Facebook', 'naked'),
        'twitter'     => __('Twitter', 'naked'),
        'youtube'     => __('YouTube', 'naked'),
        'instagram'   => __('Instagram', 'naked')
 ) as $social => $social_title ){
        $social_id = "naked_socials[{$social}]";
        $customizer->add_setting( $social_id );
        $customizer->add_control(
                new WP_Customize_Control( $customizer,
                $social_id,
                array(
                        'label'   => $social_title,
                        'setting' => $social_id,
                        'section' => 'naked_socials'
                ))     
        );
 }
