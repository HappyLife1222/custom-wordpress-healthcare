<?php

/**
 * Plugin Name:       Themify - WooCommerce Product Filter
 * Plugin URI:        https://themify.me/themify-product-filter
 * Description:       This plugin allows you to create unlimited product filters for WooCommerce. Users can refine product search by applying multiple filters/conditions such as categories, tags, price, in-stock, on-sale, and even attributes such as colors and sizes.
 * Version:           1.4.5
 * Author:            Themify
 * Author URI:        https://themify.me
 * Text Domain:       wpf
 * Domain Path:       /languages
 * WC tested up to:   current
 * Requires PHP: 7.2
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php')) {
    add_action( 'init', 'run_wpf' );
} elseif(is_admin()) {
    add_action('admin_notices', 'wpf_admin_notice');
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpf-deactivator.php
 */
function deactivate_wpf() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-wpf-deactivator.php';
    WPF_Deactivator::deactivate();
}

register_deactivation_hook(__FILE__, 'deactivate_wpf');
register_activation_hook( __FILE__, 'activate_wpf' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpf() {
    /**
    * The core plugin class that is used to define internationalization,
    * dashboard-specific hooks, and public-facing site hooks.
    */
    require plugin_dir_path(__FILE__) . 'includes/class-wpf.php';
    $wpf = WPF::get_instance();
    $wpf->set_version( '1.4.5' );
    $wpf->init();
}

/**
* Call once on plugin activation.
*
* @since    1.0.3
*/
function activate_wpf(){
	add_option( 'themify_WPF_activation_redirect', true );
}

function wpf_admin_notice(){
    ?>
    <div class="error">
        <p><?php _e('Themify WooCommerce Product Filter requires the WooCommerce plugin. Please install and activate WooCommerce first, then activate this plugin.', 'wpf'); ?></p>
    </div>
    <?php
    deactivate_plugins(plugin_basename(__FILE__));
}

/**
 * HPOS compatibility
 *
 * @since 1.4.1
 */
add_action( 'before_woocommerce_init', function() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class,false ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
} );
