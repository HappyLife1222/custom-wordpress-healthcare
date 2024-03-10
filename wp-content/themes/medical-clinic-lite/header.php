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

<?php $medical_clinic_lite_icon1 = get_theme_mod( 'medical_clinic_lite_dashicons_setting_1', 'dashicons dashicons-clock' ); ?>
<?php $medical_clinic_lite_icon2 = get_theme_mod( 'medical_clinic_lite_dashicons_setting_2', 'dashicons dashicons-location' ); ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'medical-clinic-lite' ); ?></a>

<?php if ( get_theme_mod('medical_clinic_lite_site_loader', false) == true ) : ?>
	<div class="cssloader">
    	<div class="sh1"></div>
    	<div class="sh2"></div>
    	<h1 class="lt"><?php esc_html_e( 'loading',  'medical-clinic-lite' ); ?></h1>
    </div>
<?php endif; ?>

<div class="top-header text-center text-md-left">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-9 align-self-center">
				<?php if ( get_theme_mod('medical_clinic_lite_header_announcement_alert_text') ) : ?>
					<span class="mr-3"><?php echo esc_html( get_theme_mod('medical_clinic_lite_header_announcement_alert_text' ) ); ?></span>
				<?php endif; ?>
				<?php if ( get_theme_mod('medical_clinic_lite_header_announcement_text') ) : ?>
					<span class="mr-3"><?php echo esc_html( get_theme_mod('medical_clinic_lite_header_announcement_text' ) ); ?></span>
				<?php endif; ?>
				<?php if ( get_theme_mod('medical_clinic_lite_header_phone_number') ) : ?>
					<span class="phone-number"><i class="fas fa-phone mr-2"></i><a href="callto:<?php echo esc_html(get_theme_mod('medical_clinic_lite_header_phone_number','')); ?>"><?php echo esc_html(get_theme_mod('medical_clinic_lite_header_phone_number','')); ?></a></span>
				<?php endif; ?>
			</div>
			<div class="col-lg-3 col-md-3 align-self-center">
				<?php $medical_clinic_lite_settings = get_theme_mod( 'medical_clinic_lite_social_links_settings' ); ?>
				<div class="social-links text-center text-md-left text-lg-right">
					<?php if ( is_array($medical_clinic_lite_settings) || is_object($medical_clinic_lite_settings) ){ ?>
				    	<?php foreach( $medical_clinic_lite_settings as $medical_clinic_lite_setting ) { ?>
					        <a href="<?php echo esc_url( $medical_clinic_lite_setting['link_url'] ); ?>">
					            <i class="<?php echo esc_attr( $medical_clinic_lite_setting['link_text'] ); ?> mr-3"></i>
					        </a>
				    	<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<header id="site-navigation" class="header text-center text-md-left">
	<div class="center-header py-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 align-self-center">
		    		<div class="logo text-center text-md-left">
			    		<div class="logo-image mr-3">
			    			<?php echo the_custom_logo(); ?>
				    	</div>
				    	<div class="logo-content">
					    	<?php
					    		if ( get_theme_mod('medical_clinic_lite_display_header_title', true) == true ) :
						      		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
						      			echo esc_attr(get_bloginfo('name'));
						      		echo '</a>';
						      	endif;

						      	if ( get_theme_mod('medical_clinic_lite_display_header_text', false) == true ) :
					      			echo '<span>'. esc_attr(get_bloginfo('description')) . '</span>';
					      		endif;
				    		?>
						</div>
					</div>
			   	</div>
			   	<div class="col-lg-4 col-md-4 align-self-center">
			   		<?php if ( get_theme_mod('medical_clinic_lite_opening_time') || get_theme_mod('medical_clinic_lite_opening_time_text') ) : ?>
				   		<div class="row">
				   			<div class="col-lg-2 col-md-2">
				   				<span class="dashicons dashicons-<?php echo esc_attr( $medical_clinic_lite_icon1 ); ?>"></span>
				   			</div>
				   			<div class="col-lg-10 col-md-10">
				   				<h6><?php echo esc_html( get_theme_mod('medical_clinic_lite_opening_time' ) ); ?></h6>
				   				<p class="mb-0"><?php echo esc_html( get_theme_mod('medical_clinic_lite_opening_time_text' ) ); ?></p>
				   			</div>
				   		</div>
				   	<?php endif; ?>
			   	</div>
			   	<div class="col-lg-4 col-md-4 align-self-center">
			   		<?php if ( get_theme_mod('medical_clinic_lite_location') || get_theme_mod('medical_clinic_lite_location_text') ) : ?>
				   		<div class="row">
				   			<div class="col-lg-2 col-md-2 ">
				   				<span class="dashicons dashicons-<?php echo esc_attr( $medical_clinic_lite_icon2 ); ?>"></span>
				   			</div>
				   			<div class="col-lg-10 col-md-10">
				   				<h6><?php echo esc_html( get_theme_mod('medical_clinic_lite_location' ) ); ?></h6>
				   				<p class="mb-0"><?php echo esc_html( get_theme_mod('medical_clinic_lite_location_text' ) ); ?></p>
				   			</div>
				   		</div>
				   	<?php endif; ?>
			   	</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-9 align-self-center">
				<button class="menu-toggle my-2 py-2 px-3" aria-controls="top-menu" aria-expanded="false" type="button">
					<span aria-hidden="true"><?php esc_html_e( 'Menu', 'medical-clinic-lite' ); ?></span>
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
			<div class="col-lg-3 col-md-3 align-self-center py-4 py-md-0 text-md-right">
				<?php if ( get_theme_mod('medical_clinic_lite_header_url_appointment_button') || get_theme_mod('medical_clinic_lite_header_text_appointment_button') ) : ?>
					<a href="<?php echo esc_url( get_theme_mod('medical_clinic_lite_header_url_appointment_button' ) ); ?>" class="appoint-btn"><?php echo esc_html( get_theme_mod('medical_clinic_lite_header_text_appointment_button' ) ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
