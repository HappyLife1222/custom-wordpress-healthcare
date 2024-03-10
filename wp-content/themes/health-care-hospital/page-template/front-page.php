<?php
/**
 * Template Name: Custom Home Page
 *
 * @package Health Care Hospital
 * @subpackage health_care_hospital
 */

get_header(); ?>

<main id="tp_content" role="main">
	<?php get_template_part( 'template-parts/home/slider' ); ?>
	<?php get_template_part( 'template-parts/home/about_products' ); ?>
	<?php get_template_part( 'template-parts/home/home-content' ); ?>
</main>

<?php get_footer();