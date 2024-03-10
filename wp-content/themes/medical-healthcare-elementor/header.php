<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Medical Healthcare Elementor
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>
<?php if(get_theme_mod('medical_healthcare_elementor_preloader_hide','')){ ?>
	<div class="loader">
		<div class="preloader">
			<div class="diamond">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
<?php } ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'medical-healthcare-elementor' ); ?></a>

<header id="site-navigation" class="header text-center text-md-left">
	<div class="upperheader">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 align-self-center">
					<?php if ( get_theme_mod('medical_healthcare_elementor_header_toptxt') ) : ?>
						<p class="mb-0"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_toptxt' ) ); ?></p>
					<?php endif; ?>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 align-self-center">
					<?php if ( get_theme_mod('medical_healthcare_elementor_contact_button_text') ) : ?>
						<span><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_contact_button_text' ) ); ?>:<span><a class="contact-button" href="tel:<?php echo esc_url( get_theme_mod('medical_healthcare_elementor_contact_number' ) ); ?>"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_contact_number' ) ); ?></a>
					<?php endif; ?>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 align-self-center">
					<?php $medical_healthcare_elementor_settings = get_theme_mod( 'medical_healthcare_elementor_social_links_settings' ); ?>
					<div class="social-links text-center text-md-right">
						<?php if ( is_array($medical_healthcare_elementor_settings) || is_object($medical_healthcare_elementor_settings) ){ ?>
							<span class="mr-3"><?php esc_html_e('Follow Us: ','medical-healthcare-elementor'); ?></span>
					    	<?php foreach( $medical_healthcare_elementor_settings as $medical_healthcare_elementor_setting ) { ?>
						        <a href="<?php echo esc_url( $medical_healthcare_elementor_setting['link_url'] ); ?>" target="_blank">
						            <i class="<?php echo esc_attr( $medical_healthcare_elementor_setting['link_text'] ); ?> mr-2"></i>
						        </a>
					    	<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="middleheader py-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12 col-sm-12 align-self-center">
					<div class="logo text-center text-lg-left mb-3 mb-lg-0">
			    		<div class="logo-image">
			    			<?php the_custom_logo(); ?>
				    	</div>
				    	<div class="logo-content">
							<?php
								if ( get_theme_mod('medical_healthcare_elementor_display_header_title', true) == true ) :
									echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
									echo esc_attr(get_bloginfo('name'));
									echo '</a>';
								endif;
								if ( get_theme_mod('medical_healthcare_elementor_display_header_text', false) == true ) :
									echo '<span>'. esc_attr(get_bloginfo('description')) . '</span>';
								endif;
							?>
						</div>
					</div>
			   	</div>
				<div class="col-lg-8 col-md-12 col-sm-12 align-self-center">
			   		<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 align-self-center">
							<?php if ( get_theme_mod('medical_healthcare_elementor_header_time') || get_theme_mod('medical_healthcare_elementor_header_time_text') ) : ?>
								<div class="row header-icon">
									<div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
										<i class="fas fa-clock"></i>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 align-self-center">
										<p class="mb-0"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_time_text' ) ); ?></p>
										<h6 class="mb-0"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_time' ) ); ?></h6>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-5 align-self-center">
							<?php if ( get_theme_mod('medical_healthcare_elementor_header_location') || get_theme_mod('medical_healthcare_elementor_header_location_text') ) : ?>
								<div class="row header-icon">
									<div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
										<i class="fas fa-map-marker-alt"></i>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 align-self-center">
										<p class="mb-0"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_location_text' ) ); ?></p>
										<h6 class="mb-0"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_location' ) ); ?></h6>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-3 align-self-center">
							<?php if ( get_theme_mod('medical_healthcare_elementor_header_phone_number') || get_theme_mod('medical_healthcare_elementor_header_phone_number_text') ) : ?>
								<div class="row header-icon">
									<div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
										<i class="fas fa-phone"></i>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 align-self-center">
										<p class="mb-0"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_phone_number_text' ) ); ?></p>
										<a href="tel:<?php echo esc_url( get_theme_mod('medical_healthcare_elementor_header_phone_number' ) ); ?>"><h6 class="mb-0"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_phone_number' ) ); ?></h6></a>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>                                                                                                                      
	<div class="topheader <?php if( get_theme_mod( 'medical_healthcare_elementor_sticky_header',false) != '') { ?>sticky-header<?php } else { ?>close-sticky <?php } ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-8 col-sm-8 align-self-center">
					<button class="menu-toggle my-2 py-2 px-3" aria-controls="top-menu" aria-expanded="false" type="button">
						<span aria-hidden="true"><?php esc_html_e( 'Menu', 'medical-healthcare-elementor' ); ?></span>
					</button>
					<nav id="main-menu" class="close-panal">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'main-menu',
								'container' => 'false'
							));
						?>
						<button class="close-menu my-2 p-2" type="button">
							<span aria-hidden="true"><i class="fa fa-times"></i></span>
						</button>
					</nav>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-4 align-self-center head-btn text-center text-md-right">
					<?php if ( get_theme_mod('medical_healthcare_elementor_header_button_text') ) : ?>
						<a href="<?php echo esc_url( get_theme_mod('medical_healthcare_elementor_header_button_url' ) ); ?>"><?php echo esc_html( get_theme_mod('medical_healthcare_elementor_header_button_text' ) ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
