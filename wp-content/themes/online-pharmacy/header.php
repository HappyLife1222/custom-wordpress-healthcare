<?php
/**
 * The header for our theme
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
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

<?php if(get_theme_mod('online_pharmacy_preloader_show_hide','') != ''){ ?>
	<div class="loader">
		<div class="center center1">
		    <div class="ring"></div>
		</div>
		<div class="center center2">
		    <div class="ring"></div>
		</div>
	</div>
<?php }?>

<header role="banner">
	<a class="screen-reader-text skip-link" href="#tp_content"><?php esc_html_e( 'Skip to content', 'online-pharmacy' ); ?></a>
	<?php
	  get_template_part( 'template-parts/header/top', 'header' );
	  get_template_part( 'template-parts/header/site', 'branding' );
	?>
</header>