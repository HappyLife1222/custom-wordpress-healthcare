<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-vw">
 *
 * @package VW Healthcare
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
	  	<meta charset="<?php bloginfo( 'charset' ); ?>">
	  	<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	  	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	<?php if ( function_exists( 'wp_body_open' ) )
		{
	    	wp_body_open();
	  	}else{
	    	do_action('wp_body_open');
	  	}
	?>

	<header role="banner">
		<a class="screen-reader-text skip-link" href="#maincontent" ><?php esc_html_e( 'Skip to content', 'vw-healthcare' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'vw-healthcare' ); ?></span></a>
		<div class="home-page-header">
			<?php get_template_part('template-parts/header/top-header'); ?>
			<?php get_template_part('template-parts/header/middle-header'); ?>
			<?php get_template_part('template-parts/header/navigation'); ?>
		</div>
	</header>

	<?php if(get_theme_mod('vw_healthcare_loader_enable',false) != '') { ?>
	  	<div id="preloader">
		    <div class="loader-inner">
		      <div class="loader-line-wrap">
		        <div class="loader-line"></div>
		      </div>
		      <div class="loader-line-wrap">
		        <div class="loader-line"></div>
		      </div>
		      <div class="loader-line-wrap">
		        <div class="loader-line"></div>
		      </div>
		      <div class="loader-line-wrap">
		        <div class="loader-line"></div>
		      </div>
		      <div class="loader-line-wrap">
		        <div class="loader-line"></div>
		      </div>
		    </div>
	  	</div>
	<?php } ?>