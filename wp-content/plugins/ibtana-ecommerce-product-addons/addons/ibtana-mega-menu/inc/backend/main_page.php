<?php Ibtana_Visual_Editor_Menu_Class::ibtana_visual_editor_banner_head(); ?>

<div class="imma-admin-wrapper imma-admin-wrapper-tab-main">
	<div class="imma-admin-flex">
		<div class="imma-tab-wrap" style="display:none;">
			<ul class="imma-tab-links imma-tab-main-class">
				<li class="tab-class" imma-tab-id="imma-tab-one">
					<?php esc_html_e( 'General Settings', IEPA_TEXT_DOMAIN ); ?>
				</li>
			</ul>
		</div>
		<div class="imma-tab-content-wrap">
			<div class="imma-mm-header" style="display:none;">
				<?php include_once( 'panel_head.php' ); ?>
			</div>
			<div id="imma-tab-one" class="imma-content-wrap">
				<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" );
				$iepamega_settings					=	get_option( 'iepamega_settings' );
				$advanced_click							=	( ( isset( $iepamega_settings['advanced_click'] ) ) ? esc_attr( $iepamega_settings['advanced_click'] ) : '' );
				$mlabel_animation_type			=	( ( isset( $iepamega_settings['mlabel_animation_type'] ) ) ? esc_attr( $iepamega_settings['mlabel_animation_type'] ) : esc_attr( 'none' ) );
				$animation_delay						=	( ( isset( $iepamega_settings['animation_delay'] ) ) ? esc_attr( $iepamega_settings['animation_delay'] ) : esc_attr( '2s' ) );
				$animation_duration					= ( ( isset( $iepamega_settings['animation_duration'] ) ) ? esc_attr( $iepamega_settings['animation_duration'] ) : esc_attr( '3s' ) );
				$animation_iteration_count	= ( ( isset( $iepamega_settings['animation_iteration_count'] ) ) ? esc_attr( $iepamega_settings['animation_iteration_count'] ) : esc_attr( '1' ) );
				$enable_mobile							= ( ( isset( $iepamega_settings['enable_mobile'] ) ) ? esc_attr( $iepamega_settings['enable_mobile'] ) : '' );
				$enable_rtl       					= ( isset( $iepamega_settings['enable_rtl'] ) && $iepamega_settings['enable_rtl'] == 1 ) ? esc_attr( '1' ) : esc_attr( '0' );
				$disable_submenu_retractor  = ( ( isset( $iepamega_settings['disable_submenu_retractor'] ) ) ? esc_attr( $iepamega_settings['disable_submenu_retractor'] ) : '' );
				$mobile_toggle_option 			= ( ( isset( $iepamega_settings['mobile_toggle_option'] ) ) ? esc_attr( $iepamega_settings['mobile_toggle_option'] ) : '' );
				$close_menu_icon      			= ( ( isset( $iepamega_settings['close_menu_icon'] ) ) ? esc_attr( $iepamega_settings['close_menu_icon'] ) : esc_attr( 'dashicons dashicons-menu' ) );
				$open_menu_icon       			= ( ( isset( $iepamega_settings['open_menu_icon'] ) ) ? esc_attr( $iepamega_settings['open_menu_icon'] ) : esc_attr( 'dashicons dashicons-no' ) );
				$image_size           			= ( ( isset( $iepamega_settings['image_size'] ) ) ? esc_attr( $iepamega_settings['image_size'] ) : esc_attr( 'thumbnail' ) );
				$custom_width         			= ( ( isset( $iepamega_settings['custom_width'] ) ) ? esc_attr( $iepamega_settings['custom_width'] ) : '' );
				$hide_icons           			= ( ( isset( $iepamega_settings['hide_icons'] ) ) ? esc_attr( $iepamega_settings['hide_icons'] ) : '' );
				$icon_width           			= ( ( isset( $iepamega_settings['icon_width'] ) ) ? esc_attr( $iepamega_settings['icon_width'] ) : '' );
				$enable_custom_css    			= ( ( isset( $iepamega_settings['enable_custom_css'] ) && $iepamega_settings['enable_custom_css'] == 1 ) ? esc_attr( '1' ) : esc_attr( '0' ) );
				$custom_css           			= ( ( isset( $iepamega_settings['custom_css'] ) ) ? esc_attr( $iepamega_settings['custom_css'] ) : '' );
				$enable_custom_js    				= ( ( isset( $iepamega_settings['enable_custom_js'] ) && $iepamega_settings['enable_custom_js'] == 1 ) ? esc_attr( '1' ) : esc_attr( '0' ) );
				$custom_js           				= ( ( isset( $iepamega_settings['custom_js'] ) ) ? esc_attr( $iepamega_settings['custom_js'] ) : '' );
				$theme_object 							= new IEPA_MM_Theme_Settings();
				$custom_theme 							= $theme_object->get_custom_theme_data('');

				/*features*/
				$activestickymenu					=	( ( isset( $iepamega_settings['active_sticky_menu'] ) ) ? esc_attr( $iepamega_settings['active_sticky_menu'] ) : esc_attr( '0' ) );
				$sticky_on_mobile					= ( ( isset( $iepamega_settings['sticky_on_mobile'] ) && $iepamega_settings['sticky_on_mobile'] == 1 ) ? esc_attr( '1' ) : esc_attr( '0' ) );
				$sticky_theme_location		= ( ( isset( $iepamega_settings['sticky_theme_location'] ) ) ? esc_attr( $iepamega_settings['sticky_theme_location'] ) : '' );
				$sticky_opacity						= ( ( isset( $iepamega_settings['sticky_opacity'] ) && $iepamega_settings['sticky_opacity'] != '' ) ? esc_attr( $iepamega_settings['sticky_opacity'] ) : esc_attr( '1' ) );
				$sticky_zindex						= ( ( isset( $iepamega_settings['sticky_zindex'] ) ) ? esc_attr( $iepamega_settings['sticky_zindex'] ) : esc_attr( '9999' ) );
				$sticky_offset						= ( ( isset( $iepamega_settings['sticky_offset'] ) ) ? esc_attr( $iepamega_settings['sticky_offset'] ) : esc_attr( '0px' ) );
				$choose_woo_cart_display	= ( ( isset( $iepamega_settings['choose_woo_cart_display'] ) ) ? esc_attr( $iepamega_settings['choose_woo_cart_display'] ) : '' );
				$cart_display_pattern			= ( ( isset( $iepamega_settings['cart_display_pattern'] ) ) ? esc_attr( $iepamega_settings['cart_display_pattern'] ) : '' );
				$pre_responsive_bp				= ( ( isset( $iepamega_settings['pre_responsive_bp'] ) ) ? esc_attr( $iepamega_settings['pre_responsive_bp'] ) : esc_attr( '910' ) );
				?>

				<div class="iepa-mm-settings-main-wrapper">
					<?php
					if( isset( $_GET['error_message'] ) ) {
						if( $_GET['error_message'] == 1 ) {
							?>
							<div class="notice notice-error iepa-mm-message">
								<p>
									<?php esc_html_e( 'Something went wrong. Please try again later.', IEPA_TEXT_DOMAIN ); ?>
								</p>
							</div>
							<?php
						} else if( $_GET['error_message'] == 2 ) {
							?>
							<div class="notice notice-error iepa-mm-message">
								<p>
									<?php esc_html_e( 'Something went wrong. Please check the write permission of temp folder inside the plugin\'s folder', IEPA_TEXT_DOMAIN ); ?>
								</p>
							</div>
							<?php
						} else if( $_GET['error_message'] == 3 ) {
							?>
							<div class="notice notice-error iepa-mm-message">
								<p><?php esc_html_e( 'Invalid File Extension', IEPA_TEXT_DOMAIN );?></p>
							</div>
							<?php
						} else if( $_GET['error_message'] == 4 ){
							?>
							<div class="notice notice-error iepa-mm-message">
								<p><?php esc_html_e( 'No any file uploaded.', IEPA_TEXT_DOMAIN );?></p>
							</div>
							<?php
						}
					}
					?>
					<?php
					if( isset( $_GET['message'] ) ) {
						if( $_GET['message'] == 1 ) {
							?>
							<div class="notice notice-success iepa-mm-message">
								<p><?php esc_html_e('Settings Saved successfully.',IEPA_TEXT_DOMAIN);?></p>
							</div>
							<?php
						} else if( $_GET['message'] == 2 ) {
							?>
							<div class="notice notice-success iepa-mm-message">
								<p><?php esc_html_e('Restored Default Settings Successfully.',IEPA_TEXT_DOMAIN);?></p>
							</div>
							<?php
						} else if( $_GET['message'] == 3 ) {
							?>
							<div class="notice notice-success iepa-mm-message">
								<p><?php esc_html_e( 'Custom Theme imported successfully.', IEPA_TEXT_DOMAIN ); ?></p>
							</div>
							<?php
						}
					}
					?>
					<div class="container iepa-mm-tab-container">
						<div class="row">
							<div class="col-sm-12">

								<div class="col-xs-2" style="display:none">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs tabs-left">
										<li class="active">
											<a class="tab_settings" href="#general_settings" data-toggle="tab">
												<?php esc_html_e( 'General Settings', IEPA_TEXT_DOMAIN ); ?>
											</a>
										</li>
										<li>
											<a href="#sticky_settings" class="sticky_settings" data-toggle="tab">
												<?php esc_html_e( 'Sticky Menu', IEPA_TEXT_DOMAIN ); ?>
											</a>
										</li>
										<li>
											<a href="#image_settings" class="image_settings" data-toggle="tab">
												<?php esc_html_e( 'Image Settings',IEPA_TEXT_DOMAIN ); ?>
											</a>
										</li>
										<li>
											<a href="#shortcode_menu_location" class="shortcode_settings" data-toggle="tab">
												<?php esc_html_e( 'Shortcodes', IEPA_TEXT_DOMAIN ); ?>
											</a>
										</li>
										<li style="display:none;">
											<a href="#custom_theme_import" class="import_settings" data-toggle="tab">
												<?php esc_html_e( 'Import/Export', IEPA_TEXT_DOMAIN ); ?>
											</a>
										</li>
										<li>
											<a href="#custom_css" class="custom_css" data-toggle="tab">
												<?php esc_html_e( 'Custom CSS & JS', IEPA_TEXT_DOMAIN ); ?>
											</a>
										</li>
									</ul>
								</div>

								<div class="iepa-mm-content">
									<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
										<input type="hidden" name="action" value="iepamegamenu_mm_save_settings" />
										<?php wp_nonce_field( 'iepammmegamenu-nonce', 'iepammmegamenu-nonce-setup' ); ?>
										<!-- Tab panes -->
										<div class="immapro-tab-content">

											<!-- <div class="tab-pane active" id="general_settings"> -->
											<div class="tab-pane" id="general_settings">
												<?php include_once( 'tabs/general-settings.php' ); ?>
											</div>
											<div class="tab-pane" id="sticky_settings">
												<?php include_once( 'tabs/sticky-settings.php' ); ?>
											</div>
											<div class="tab-pane" id="image_settings">
												<?php include_once( 'tabs/image-settings.php' ); ?>
											</div>
											<div class="tab-pane" id="shortcode_menu_location">
												<?php include_once( 'tabs/shortcode-menu-location.php' ); ?>
											</div>

											<div class="tab-pane" id="custom_css">
												<?php include_once( 'tabs/custom-css.php' ); ?>
											</div>
										</div>
										<div class="imma-mm-field-wrapper imma-mm-form-field iepa-admin-sticky-submit-wrapper">
											<input type="submit" class="button button-primary" id="imma-mm-add-button" name="settings_submit" value="<?php esc_attr_e( 'Save', IEPA_TEXT_DOMAIN ); ?>" />
											<input type="submit" class="button button-primary" id="restore_settings_btn" name="restore_old_settings" value="<?php esc_attr_e( 'Restore Default Settings', IEPA_TEXT_DOMAIN ); ?>" />
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
