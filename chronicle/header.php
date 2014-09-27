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
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body>
<div class="skrollr-body"></div>
<div id="page" class="site">
	
	<?php if (get_header_image()): ?>
	  <div id="navbar"
	  	data-top="position:absolute; top:!0px;"
	  	<?php if (is_admin_bar_showing()): ?> data-75="position:fixed; top:!-43px;">
	  	<?php else: ?> data-75="position:fixed; top:!-75px;">
	  	<?php endif; ?>

	  	<div id="navbar-center">
		
			<div id="navbar-title-wrapper">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<!-- <img src="<?php header_image(); ?>" width="300 <?php //echo get_custom_header()->width; ?>" height="45 <?php //echo get_custom_header()->height; ?>" alt=""> -->
					<div id="title-upper">Dartmouth</div>
					<div id="title-lower">Chronicle</div>
				</a>
			</div>

			<div id="navbar-link-wrapper">
			  <div id="navbar-link-subwrapper">
			    <a href="/about/" class="navbar-link">
			      <span class="navbar-link-text">About</span>
			    </a>
			    <a href="<?php echo get_category_link(get_cat_ID('Science')); ?>" class="navbar-link">
			      <span class="navbar-link-text">Science</span>
			    </a>
			    <a href="<?php echo get_category_link(get_cat_ID('Arts')); ?>" class="navbar-link">
			      <span class="navbar-link-text">Arts</span>
			    </a>
			    <a href="<?php echo get_category_link(get_cat_ID('Narrative')); ?>" class="navbar-link">
			      <span class="navbar-link-text">Narrative</span>
			    </a>
			    <a href="<?php echo get_category_link(get_cat_ID('Politics')); ?>" class="navbar-link">
			      <span class="navbar-link-text">Politics</span>
			    </a>
			    <a href="<?php echo get_category_link(get_cat_ID('Sports')); ?>" class="navbar-link">
			      <span class="navbar-link-text">Sports</span>
			    </a>
			    <a href="<?php echo get_category_link(get_cat_ID('Media')); ?>" class="navbar-link">
			      <span class="navbar-link-text">Media</span>
			    </a>
			    <span id="navbar-search" data-expanded="false">
				  <form id="navbar-search-form" action="/" method="get">
				  	<input id="navbar-search-field" type="text" name="s" />
				  </form>
			      <span id="navbar-search-text"><span class="glyphicon glyphicon-search"></span></span>
			    </span>
		      </div>
		    </div>

		</div>
	  </div>
	<?php endif; ?>

	<div id="main" class="site-main">
