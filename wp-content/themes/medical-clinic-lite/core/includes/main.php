<?php

/**
* Get started notice
*/

add_action( 'wp_ajax_medical_clinic_lite_dismissed_notice_handler', 'medical_clinic_lite_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function medical_clinic_lite_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function medical_clinic_lite_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started', FALSE ) ) {?>

            <?php
            $current_screen = get_current_screen();
				if ($current_screen->id !== 'appearance_page_medical-clinic-lite-guide-page') {
             $medical_clinic_lite_comments_theme = wp_get_theme(); ?>
            <div class="medical-clinic-lite-notice-wrapper updated notice notice-get-started-class is-dismissible" data-notice="get_started">
			<div class="medical-clinic-lite-notice">
				<div class="medical-clinic-lite-notice-img">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/admin-logo.png'); ?>" alt="<?php esc_attr_e('logo', 'medical-clinic-lite'); ?>">
				</div>
				<div class="medical-clinic-lite-notice-content">
					<div class="medical-clinic-lite-notice-heading"><?php esc_html_e('Thanks for installing ','medical-clinic-lite'); ?><?php echo esc_html( $medical_clinic_lite_comments_theme ); ?></div>
					<p><?php printf(__('In order to fully benefit from everything our theme has to offer, please make sure you visit our <a href="%s">For Premium Options</a>.', 'medical-clinic-lite'), esc_url(admin_url('themes.php?page=medical-clinic-lite-guide-page'))); ?></p>
					<?php if (is_child_theme()) { ?>
						<?php $child_theme = wp_get_theme(); ?>
						<?php printf(esc_html__('You\'re using %1$s theme, It\'s a child theme of %2$s.', 'medical-clinic-lite'), '<strong>' . $child_theme->Name . '</strong>', '<strong>' . esc_html__('medical_clinic_lite', 'medical-clinic-lite') . '</strong>'); 
						?>
						<?php
						$copy_link_args = array(
							'page' => 'medical-clinic-lite',
							'action' => 'show_copy_settings',
						);
						$copy_link = add_query_arg($copy_link_args, admin_url('themes.php'));
						?>
						<?php printf('%s <a href="%s" class="go-to-setting">%s</a>', esc_html__('Now you can copy setting data from parent theme to this child theme', 'medical-clinic-lite'), esc_url($copy_link), esc_html__('Copy Settings', 'medical-clinic-lite')); ?>
					<?php } ?>
				</div>
			</div>
		</div>
        <?php }
	}
}

add_action( 'admin_notices', 'medical_clinic_lite_deprecated_hook_admin_notice' );

add_action( 'admin_menu', 'medical_clinic_lite_getting_started' );
function medical_clinic_lite_getting_started() {
	add_theme_page( esc_html__('Get Started', 'medical-clinic-lite'), esc_html__('Get Started', 'medical-clinic-lite'), 'edit_theme_options', 'medical-clinic-lite-guide-page', 'medical_clinic_lite_test_guide');
}

function medical_clinic_lite_admin_enqueue_scripts() {
	wp_enqueue_style( 'medical-clinic-lite-admin-style', esc_url( get_template_directory_uri() ).'/css/main.css' );
	wp_enqueue_script( 'medical-clinic-lite-admin-script', get_template_directory_uri() . '/js/medical-clinic-lite-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'medical-clinic-lite-admin-script', 'medical_clinic_lite_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'medical_clinic_lite_admin_enqueue_scripts' );

if ( ! defined( 'MEDICAL_CLINIC_LITE_DOCS_FREE' ) ) {
define('MEDICAL_CLINIC_LITE_DOCS_FREE',__('https://www.misbahwp.com/docs/medical-clinic-free-docs/','medical-clinic-lite'));
}
if ( ! defined( 'MEDICAL_CLINIC_LITE_DOCS_PRO' ) ) {
define('MEDICAL_CLINIC_LITE_DOCS_PRO',__('https://www.misbahwp.com/docs/medical-clinic-pro-docs','medical-clinic-lite'));
}
if ( ! defined( 'MEDICAL_CLINIC_LITE_BUY_NOW' ) ) {
define('MEDICAL_CLINIC_LITE_BUY_NOW',__('https://www.misbahwp.com/themes/medical-clinic-wordpress-theme/','medical-clinic-lite'));
}
if ( ! defined( 'MEDICAL_CLINIC_LITE_SUPPORT_FREE' ) ) {
define('MEDICAL_CLINIC_LITE_SUPPORT_FREE',__('https://wordpress.org/support/theme/medical-clinic-lite','medical-clinic-lite'));
}
if ( ! defined( 'MEDICAL_CLINIC_LITE_REVIEW_FREE' ) ) {
define('MEDICAL_CLINIC_LITE_REVIEW_FREE',__('https://wordpress.org/support/theme/medical-clinic-lite/reviews/#new-post','medical-clinic-lite'));
}
if ( ! defined( 'MEDICAL_CLINIC_LITE_DEMO_PRO' ) ) {
define('MEDICAL_CLINIC_LITE_DEMO_PRO',__('https://www.misbahwp.com/demo/medical-clinic/','medical-clinic-lite'));
}
if( ! defined( 'MEDICAL_CLINIC_LITE_THEME_BUNDLE' ) ) {
define('MEDICAL_CLINIC_LITE_THEME_BUNDLE',__('https://www.misbahwp.com/themes/wordpress-bundle/','medical-clinic-lite'));
}

function medical_clinic_lite_test_guide() { ?>
	<?php $medical_clinic_lite_theme = wp_get_theme(); ?>
	<div class="wrap" id="main-page">
		<div id="lefty">
			<div id="admin_links">
				<a href="<?php echo esc_url( MEDICAL_CLINIC_LITE_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Documentation', 'medical-clinic-lite' ) ?></a>
				<a href="<?php echo esc_url( admin_url('customize.php') ); ?>" id="customizer" target="_blank"><?php esc_html_e( 'Customize', 'medical-clinic-lite' ); ?> </a>
				<a class="blue-button-1" href="<?php echo esc_url( MEDICAL_CLINIC_LITE_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'medical-clinic-lite' ) ?></a>
				<a class="blue-button-2" href="<?php echo esc_url( MEDICAL_CLINIC_LITE_REVIEW_FREE ); ?>" target="_blank" class="btn4"><?php esc_html_e( 'Review', 'medical-clinic-lite' ) ?></a>
			</div>
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','medical-clinic-lite'); ?><?php echo esc_html( $medical_clinic_lite_theme ); ?>  <span><?php esc_html_e('Version: ', 'medical-clinic-lite'); ?><?php echo esc_html($medical_clinic_lite_theme['Version']);?></span></h3>
				<img class="img_responsive" style="width:100%;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
				<div id="description-insidee">
					<?php
						$medical_clinic_lite_theme = wp_get_theme();
						echo wp_kses_post( apply_filters( 'misbah_theme_description', esc_html( $medical_clinic_lite_theme->get( 'Description' ) ) ) );
					?>
				</div>
			</div>
		</div>
		<div id="righty">
			<div class="postboxx donate">
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'medical-clinic-lite' ); ?></h3>
				<div class="insidee">
					<p><?php esc_html_e('Discover upgraded pro features with premium version click to upgrade.','medical-clinic-lite'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( MEDICAL_CLINIC_LITE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'medical-clinic-lite' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( MEDICAL_CLINIC_LITE_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'medical-clinic-lite' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( MEDICAL_CLINIC_LITE_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'medical-clinic-lite' ) ?></a>
					</div>
				</div>

				<h3 class="hndle bundle"><?php esc_html_e( 'Go For Theme Bundle', 'medical-clinic-lite' ); ?></h3>
				<div class="insidee theme-bundle">
					<p class="offer"><?php esc_html_e('Get 80+ Perfect WordPress Theme In A Single Package at just $79."','medical-clinic-lite'); ?></p>
					<p class="coupon"><?php esc_html_e('Exclusive Offer !! Get Our Theme Pack of 60+ WordPress Themes At 10% Off','medical-clinic-lite'); ?><span class="coupon-code"><?php esc_html_e('"Themespack10"','medical-clinic-lite'); ?></span></p>
					<div id="admin_pro_linkss">
						<a class="blue-button-1" href="<?php echo esc_url( MEDICAL_CLINIC_LITE_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e( 'Theme Bundle', 'medical-clinic-lite' ) ?></a>
					</div>
				</div>
				<div class="d-table">
			    <ul class="d-column">
			      <li class="feature"><?php esc_html_e('Features','medical-clinic-lite'); ?></li>
			      <li class="free"><?php esc_html_e('Pro','medical-clinic-lite'); ?></li>
			      <li class="plus"><?php esc_html_e('Free','medical-clinic-lite'); ?></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('24hrs Priority Support','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Kirki Framework','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('One Click Demo Import','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Secton Reordering','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Enable / Disable Option','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Posttype','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Multiple Sections','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Color Pallete','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Widgets','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Page Templates','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Typography','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Background Image / Color ','medical-clinic-lite'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
	  		</div>
			</div>
		</div>
	</div>

<?php } ?>
