<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/**
 * Posted Data
 *
 */

$iepamega_settings['advanced_click']              = sanitize_text_field( $_POST['advanced_click'] );
$iepamega_settings['enable_mobile']               = isset( $_POST['enable_mobile'] ) ? sanitize_text_field( $_POST['enable_mobile'] ) : '0';
$iepamega_settings['enable_rtl']                  = ( isset( $_POST['enable_rtl'] ) && $_POST['enable_rtl'] == 1 ) ? '1' : '0';
$iepamega_settings['disable_submenu_retractor']   = isset( $_POST['disable_submenu_retractor'] ) ? sanitize_text_field( $_POST['disable_submenu_retractor'] ) : '0';

$iepamega_settings['mlabel_animation_type']       = isset( $_POST['mlabel_animation_type'] ) ? sanitize_text_field( $_POST['mlabel_animation_type'] ) : 'none';
$iepamega_settings['animation_delay']             = isset( $_POST['animation_delay'] ) ? sanitize_text_field( $_POST['animation_delay'] ) : '2';
$iepamega_settings['animation_duration']          = isset( $_POST['animation_duration'] ) ? sanitize_text_field( $_POST['animation_duration'] ) : '3';
$iepamega_settings['animation_iteration_count']   = isset( $_POST['animation_iteration_count'] ) ? sanitize_text_field( $_POST['animation_iteration_count'] ) : '1';

$iepamega_settings['mobile_toggle_option']        = sanitize_text_field( $_POST['mobile_toggle_option'] );
$iepamega_settings['pre_responsive_bp']           = intval( sanitize_text_field( $_POST['pre_responsive_bp'] ) );
$iepamega_settings['image_size']  		            = sanitize_text_field( $_POST['image_size'] );
$iepamega_settings['hide_bg_images']              = isset( $_POST['hide_bg_images'] ) ? sanitize_text_field( $_POST['hide_bg_images'] ) : '0';
$iepamega_settings['hide_icons']                  = isset( $_POST['hide_icons'] ) ? sanitize_text_field( $_POST['hide_icons'] ) : '0';

$iepamega_settings['custom_width']                = isset( $_POST['custom_width'] ) ? sanitize_text_field( $_POST['custom_width'] ) : '';


$iepamega_settings['icon_width']                  = ( isset( $_POST['icon_width'] ) && $_POST['icon_width'] != '' ) ? sanitize_text_field( $_POST['icon_width'] ) : '15px';

$iepamega_settings['close_menu_icon']             = ( isset( $_POST['close_menu_icon'] ) && $_POST['close_menu_icon'] != '' ) ? sanitize_text_field( $_POST['close_menu_icon'] ) : 'dashicons dashicons-menu';
$iepamega_settings['open_menu_icon']              = ( isset( $_POST['open_menu_icon'] ) && $_POST['open_menu_icon'] != '' ) ? sanitize_text_field( $_POST['open_menu_icon'] ) : 'dashicons dashicons-no';

$iepamega_settings['enable_custom_css']           = ( isset( $_POST['enable_custom_css'] ) && $_POST['enable_custom_css'] == '1' ) ? '1' : '0';
$iepamega_settings['custom_css']                  = ( isset( $_POST['custom_css'] ) && $_POST['custom_css'] != '' ) ? stripcslashes( sanitize_text_field( $_POST['custom_css'] ) ) : '';

$iepamega_settings['enable_custom_js']            = ( isset( $_POST['enable_custom_js'] ) && $_POST['enable_custom_js'] == '1' ) ? '1' : '0';
$iepamega_settings['custom_js']                   = ( isset( $_POST['custom_js'] ) && $_POST['custom_js'] != '' ) ? stripcslashes( sanitize_text_field( $_POST['custom_js'] ) ) : '';

$iepamega_settings['active_sticky_menu']          = ( isset( $_POST['active_sticky_menu'] ) && $_POST['active_sticky_menu'] == 1 ) ? '1' : '0';
$iepamega_settings['sticky_theme_location']       = ( isset( $_POST['sticky_theme_location'] ) && $_POST['sticky_theme_location'] != '' ) ? sanitize_text_field( $_POST['sticky_theme_location'] ) : '';
$iepamega_settings['transition_style']            = ( isset( $_POST['transition_style'] ) && $_POST['transition_style'] != '' ) ? sanitize_text_field( $_POST['transition_style'] ) : '';
$iepamega_settings['sticky_on_mobile']            = ( isset( $_POST['sticky_on_mobile'] ) && $_POST['sticky_on_mobile'] == 1 ) ? 1 : 0;
$iepamega_settings['sticky_opacity']              = ( isset( $_POST['sticky_opacity'] ) && $_POST['sticky_opacity'] != '' ) ? sanitize_text_field( $_POST['sticky_opacity'] ) : '1';
$iepamega_settings['sticky_zindex']               = ( isset( $_POST['sticky_zindex'] ) && $_POST['sticky_zindex'] != '' ) ? sanitize_text_field( $_POST['sticky_zindex'] ) : '999';
$iepamega_settings['sticky_offset']               = ( isset( $_POST['sticky_offset'] ) && $_POST['sticky_offset'] != '' ) ? sanitize_text_field( $_POST['sticky_offset'] ) : '0px';

$iepamega_settings['choose_woo_cart_display']     = ( isset( $_POST['choose_woo_cart_display'] ) && $_POST['choose_woo_cart_display'] != '' ) ? sanitize_text_field( $_POST['choose_woo_cart_display'] ) : 'both_pi';
$iepamega_settings['cart_display_pattern']        = ( isset( $_POST['cart_display_pattern'] ) && $_POST['cart_display_pattern'] != '' ) ? sanitize_text_field( $_POST['cart_display_pattern'] ) : '(#price)#item_count items';
update_option( 'iepamega_settings', $iepamega_settings );
wp_redirect( admin_url( 'admin.php?page=iepa-mega-menu&message=1' ) );
exit();
