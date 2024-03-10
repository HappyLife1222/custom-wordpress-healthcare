<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function ibtana_ecommerce_product_addons_iepa_block_assets() { // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style(
		'ibtana-ecommerce-product-addons-iepa-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor script for backend.
	wp_register_script(
		'ibtana-ecommerce-product-addons-iepa-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'ibtana-ecommerce-product-addons-iepa-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	wp_enqueue_script( 'iepa-slick-js', plugins_url( '/dist/js/slick.min.js', dirname( __FILE__ ) ), array( 'jquery' ), IEPA_VERSION, false );
	wp_enqueue_script( 'iepa-fancybox-js', plugins_url( '/dist/js/jquery.fancybox.js', dirname( __FILE__ ) ), array( 'jquery' ), IEPA_VERSION, true );
	wp_enqueue_script( 'iepa-zoom-js', plugins_url( '/dist/js/jquery.zoom.min.js', dirname( __FILE__ ) ), array( 'jquery' ), IEPA_VERSION, true );
	wp_enqueue_style( 'iepa-fancybox-css', plugins_url( '/dist/css/fancybox.css', dirname( __FILE__ ) ), [], IEPA_VERSION );
	wp_enqueue_style( 'iepa-front-css', plugins_url( '/dist/css/gallery-slider.css', dirname( __FILE__ ) ), [], IEPA_VERSION );
	wp_enqueue_script( 'iepa-front-js', plugins_url( '/dist/js/gallery-slider.js', dirname( __FILE__ ) ), array( 'jquery' ), IEPA_VERSION, true );

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `iepaGlobal` object.
	wp_localize_script(
		'ibtana-ecommerce-product-addons-iepa-block-js',
		'iepaGlobal', // Array containing dynamic data for a JS Global.
		[
			'iepa_license'				=>	get_option( str_replace( '-', '_', 'ibtana-ecommerce-product-addons' ) . '_license_key' ),
			'pluginDirPath' 			=>	plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  			=>	plugin_dir_url( __DIR__ ),
			'admin_url'						=>	admin_url(),
			'desktop_breakpoint'	=>	IEPA_DESKTOP_STARTPOINT,
			'tablet_breakpoint' 	=>	IEPA_TABLET_BREAKPOINT,
			'mobile_breakpoint' 	=>	IEPA_MOBILE_BREAKPOINT
			// Add more data here that you want to access from `iepaGlobal` object.
		]
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'iepa/block-iepa', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'ibtana-ecommerce-product-addons-iepa-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'ibtana-ecommerce-product-addons-iepa-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'ibtana-ecommerce-product-addons-iepa-block-editor-css',
		)
	);
}

// Hook: Block assets.
add_action( 'init', 'ibtana_ecommerce_product_addons_iepa_block_assets' );
