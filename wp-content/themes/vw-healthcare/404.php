<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package VW Healthcare
 */

get_header(); ?>

<main id="maincontent" role="main" class="content-vw">
	<div class="container">
		<div class="page-content py-4">
	    	<h1><?php echo esc_html(get_theme_mod('vw_healthcare_404_page_title',__('404 Not Found','vw-healthcare')));?></h1>
			<p class="text-404"><?php echo esc_html(get_theme_mod('vw_healthcare_404_page_content',__('Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.','vw-healthcare')));?></p>
			<?php if( get_theme_mod('vw_healthcare_404_page_button_text','Return to the home page') != ''){ ?>
				<div class="error-btn">
		    		<a class="view-more" href="<?php echo esc_url(home_url()); ?>"><?php echo esc_html(get_theme_mod('vw_healthcare_404_page_button_text',__('Return to the home page','vw-healthcare')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_healthcare_404_page_button_text',__('Return to the home page','vw-healthcare')));?></span></a>
				</div>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</main>

<?php get_footer(); ?>