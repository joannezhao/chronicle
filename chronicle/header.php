<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Chronicle
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->

<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body>
<div id="page" class="site">
	
	<?php if (get_header_image()): ?>
	  <div id="navbar"
	  	data-top="position:absolute; top:!0px;"
	  	<?php if (is_admin_bar_showing()): ?> data-78="position:fixed; top:!-46px;">
	  	<?php else: ?> data-78="position:fixed; top:!-78px;">
	  	<?php endif; ?>

	  	<div id="navbar-center">
		
				<div id="navbar-title-wrapper">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="300 <?php //echo get_custom_header()->width; ?>" height="45 <?php //echo get_custom_header()->height; ?>" alt="">
					</a>
				</div>

				<div id="navbar-link-wrapper">
			    <span class="navbar-link">
			      <span class="navbar-link-text">About</span>
			    </span>
			    <span class="navbar-link">
			      <span class="navbar-link-text">Science</span>
			    </span>
			    <span class="navbar-link">
			      <span class="navbar-link-text">Arts</span>
			    </span>
			    <span class="navbar-link">
			      <span class="navbar-link-text">Narrative</span>
			    </span>
			    <span class="navbar-link">
			      <span class="navbar-link-text">Sports</span>
			    </span>
			    <span class="navbar-link">
			      <span class="navbar-link-text">Media</span>
			    </span>
			    <span class="navbar-link">
			    	<span class="navbar-link-text">Search</span>
			    </span>
			  </div>

		  </div>
		</div>
	<?php endif; ?>

<!-- 	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<div class="search-toggle">
				<a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'twentyfourteen' ); ?></a>
			</div>

			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<button class="menu-toggle"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
				<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav>
		</div>

		<div id="search-container" class="search-box-wrapper hide">
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
		</div>
	</header> -->

	<div id="main" class="site-main">
