<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="iepa_main_container" id="imma_menu_<?php echo esc_attr( $menu_item_id ); ?>" data-depth="depth_<?php echo esc_attr( $menu_item_depth ); ?>">
	<div class="iepa_main_header">
		<div class="settings_megamenu">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
				<g id="Icon_Color_Change_1" transform="translate(0.121 0.121)">
					<circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(-0.121 -0.121)" fill="#016194"/>
					<path id="Path_5" data-name="Path 5" d="M10.314,6.213A1.367,1.367,0,0,0,8.979,4.877H6.2a1.277,1.277,0,0,0-1.119.655,3.316,3.316,0,0,0-.208.539v3.1a1.352,1.352,0,0,0,1.352,1.144H8.973a1.352,1.352,0,0,0,1.344-1.335C10.325,8.062,10.325,7.128,10.314,6.213ZM9.394,7.6V8.892a.439.439,0,0,1-.381.506H6.3a.456.456,0,0,1-.489-.423V6.3a.456.456,0,0,1,.406-.489H8.908a.447.447,0,0,1,.489.4Zm.92,4.973a1.367,1.367,0,0,0-1.335-1.335H6.2a1.269,1.269,0,0,0-1.108.647,2.661,2.661,0,0,0-.216.554v3.048A2.952,2.952,0,0,0,5.064,16a1.277,1.277,0,0,0,.953.672H9.181a1.359,1.359,0,0,0,1.144-1.327c0-.912,0-1.841,0-2.761Zm-.92,2.686a.472.472,0,0,1-.431.514H6.3a.472.472,0,0,1-.5-.447V12.692a.472.472,0,0,1,.416-.522H8.883a.472.472,0,0,1,.514.423Zm7.292-2.678a1.367,1.367,0,0,0-1.327-1.335H12.572a1.367,1.367,0,0,0-1.327,1.335V15.35a1.319,1.319,0,0,0,.547,1.061,1.55,1.55,0,0,0,.672.277h3.067a1.376,1.376,0,0,0,1.153-1.327c.008-.936.017-1.858,0-2.786Zm-.928,2.678a.439.439,0,0,1-.381.506H12.669a.447.447,0,0,1-.514-.373.4.4,0,0,1,0-.139V12.67a.439.439,0,0,1,.381-.506h2.719a.439.439,0,0,1,.5.389.277.277,0,0,1,0,.116ZM16.687,7.6V6.321a1.392,1.392,0,0,0-1.335-1.45H12.68a1.392,1.392,0,0,0-1.442,1.344v2.66A1.4,1.4,0,0,0,12.6,10.315h2.661a1.4,1.4,0,0,0,1.428-1.366Zm-.928,1.277a.464.464,0,0,1-.406.514H12.669a.472.472,0,0,1-.514-.406V6.312a.456.456,0,0,1,.416-.506h2.678a.464.464,0,0,1,.514.406V8.882Z" transform="translate(-0.902 -0.902)" fill="#fff"/>
				</g>
			</svg>
			&nbsp
			<?php echo esc_html( IEPA_MM_TITLE . ' SETTINGS' ); ?>
		</div>
		<span class="iepa_menu_title">
			<i class="fas fa-slash" aria-hidden="true"></i>
			<?php esc_html_e( 'Submenu: ', IEPA_TEXT_DOMAIN ); ?>
			<?php echo ( isset( $menu_item_title ) && $menu_item_title != '' ) ? esc_html( $menu_item_title ) : ''; ?>
		</span>
		<p class="description imma_note">
			<?php esc_html_e( 'Mega Menus can only be created on top level menu items.', IEPA_TEXT_DOMAIN ); ?>
		</p>
		<div class="save_ajax_data" style="display:none;">
			<img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/ajax-loader.svg' ); ?>" />
			<span class="saving_message"></span>
		</div>
	</div>
	<div class="imma_secondary_content">
		<div class="tabs_left_section" style="display:none;">
			<ul>
				<li>
					<div class="imma_tabs active" id="submenu_settings">
						<?php esc_html_e( 'SubMenu Settings', IEPA_TEXT_DOMAIN ); ?>
					</div>
				</li>
				<li>
					<div class="imma_tabs" id="sub_icon_settings">
						<?php esc_html_e( 'Icon Settings', IEPA_TEXT_DOMAIN ); ?>
					</div>
				</li>
				<li>
					<div class="imma_tabs" id="upload_settings">
						<?php esc_html_e( 'Custom Settings', IEPA_TEXT_DOMAIN ); ?>
					</div>
				</li>
				<li>
					<div class="imma_tabs" id="image_settings">
						<?php esc_html_e( 'Image Settings', IEPA_TEXT_DOMAIN ); ?>
					</div>
				</li>
			</ul>
		</div>
		<div class="iepa_content_rtsection">
			<form action="" method="post">
				<input type="hidden" name="action" value="iepa_mm_save_menuitem_settings" />
				<input type="hidden" name="iepa_mm_menu_item_id" value="<?php echo ( isset( $menu_item_id ) && $menu_item_id != '' ) ? esc_attr( $menu_item_id ) : ''; ?>" />
				<input type="hidden" name="imma_menu_id" value="<?php echo ( isset( $menu_id ) && $menu_id != '' ) ? esc_attr( $menu_id ) : ''; ?>" />
				<input type="hidden" name="imma_menu_item_title" value="<?php echo ( isset( $menu_item_title ) && $menu_item_title != '' ) ? esc_attr( $menu_item_title ) : ''; ?>" />
				<input type="hidden" name="imma_menu_item_depth" value="<?php echo ( isset( $menu_item_depth ) && $menu_item_depth != '' ) ? esc_attr( $menu_item_depth ) : ''; ?>" />
				<?php $nonce = wp_create_nonce( 'iepa-mm-ajax-nonce' ); ?>
				<input type="hidden" name="_wpnonce" value="<?php echo esc_attr( $nonce ); ?>" />
				<div class="tab-pane" id="tab_submenu_settings">
					<?php include( IEPA_MM_PATH . 'inc/backend/menu_settings/top_menu/general_settings.php' ); ?>
        </div>
				<div class="tab-pane" id="tab_sub_icon_settings">
					<?php include( IEPA_MM_PATH . 'inc/backend/menu_settings/top_menu/icon_settings.php' ); ?>
				</div>
        <div class="tab-pane" id="tab_upload_settings">
					<?php include( IEPA_MM_PATH . 'inc/backend/menu_settings/top_menu/upload_image_settings.php' ); ?>
        </div>
        <div class="tab-pane" id="tab_image_settings">
					<?php include( IEPA_MM_PATH . 'inc/backend/menu_settings/top_menu/sub_image_settings.php' ); ?>
        </div>

				<div class="main_submit_section">
					<?php echo get_submit_button(); ?>
				</div>
			</form>
		</div>
	</div>
</div>
