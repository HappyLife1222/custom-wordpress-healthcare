<?php
/**
 * Template Name: Custom Home Page
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

get_header(); ?>

<main id="tp_content" role="main">
	<?php do_action( 'online_pharmacy_before_slider' ); ?>

	<?php get_template_part( 'template-parts/home/slider' ); ?>
	<?php do_action( 'online_pharmacy_after_slider' ); ?>

	<?php get_template_part( 'template-parts/home/home-content' ); ?>
	<?php do_action( 'online_pharmacy_after_home_content' ); ?>
</main>

<?php get_footer();