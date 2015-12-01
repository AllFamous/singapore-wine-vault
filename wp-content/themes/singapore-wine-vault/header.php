<?php
/************
 * Header template.
 **************************/
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="main-page">
        <header id="main-header">
                <?php
                /****************
                 * Include top header if exist
                 ********************************/
                get_template_part( 'header-top' );
                
                /******************
                 * Include the main header content
                 ***********************************/
                get_template_part( 'header-content' );
                ?>
        </header>