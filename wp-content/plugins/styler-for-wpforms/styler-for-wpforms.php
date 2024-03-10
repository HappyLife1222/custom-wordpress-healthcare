<?php
/*
Plugin Name: Styler for WPForms
Plugin URI:  http://wpmonks.com/styler-wpforms
Description: Create beautiful styles for your WPForms
Version:     2.0.5
Author:      Sushil Kumar
Author URI:  http://wpmonks.com/
License:     GPL2License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
define( 'SFWF_DIR', WP_PLUGIN_DIR . '/' . basename( __DIR__ ) );
define( 'SFWF_URL', plugins_url() . '/' . basename( __DIR__ ) );
define( 'SFWF_STORE_URL', 'https://wpmonks.com' );

if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include_once SFWF_DIR . '/admin-menu/EDD_SL_Plugin_Updater.php';
}

require_once 'helpers/utils/class-sfwf-review.php';
require_once SFWF_DIR . '/admin-menu/licenses.php';
require_once SFWF_DIR . '/admin-menu/welcome-page.php';
require_once SFWF_DIR . '/admin-menu/addons.php';



require_once 'helpers/utils/responsive.php';
class Sk_Sfwf_Main_Class {

	const VERSION = '2.0.5';
	const SLUG    = 'styler-wpforms';
	const NAME    = 'Styler for WPForms';
	const AUTHOR  = 'Sushil Kumar';
	const PREFIX  = 'sk_sfwf';

	/**
	 * Instance of class.
	 *
	 * @var instance
	 * @since 1.0
	 */
	private static $instance;
	private $trigger;
	private $sfwf_form_id;
	/**
	 * Plugin Directory
	 *
	 * @since 1.0
	 * @var string $dir
	 */
	public static $dir = '';

	/**
	 * Plugin URL
	 *
	 * @since 1.0
	 * @var string $url
	 */
	public static $url = '';

	/**
	 * Main Plugin Instance
	 *
	 * Insures that only one instance of a plugin class exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.0
	 * @static
	 * @static var array $instance
	 * @return sk_sfwf_main_class instance
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof sk_sfwf_main_class ) ) {
			self::$dir = plugin_dir_path( __FILE__ );

			self::$url = plugin_dir_url( __FILE__ );

			self::$instance = new sk_sfwf_main_class();

		}

		return self::$instance;
	}

	public function __construct() {

		add_action( 'customize_register', array( $this, 'sfwf_customize_register' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'sfwf_autosave_form' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'customize_preview_init', array( $this, 'sfwf_live_preview' ) );
		add_action( 'customize_save_after', array( $this, 'customize_save_after' ) );
		add_action( 'wpforms_frontend_output_before', array( $this, 'swfw_display_styles_frontend' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'welcome_page_css' ) );
		// Primary panel button.
		if ( function_exists( 'wpforms' ) || class_exists( 'wpforms' ) ) {

			add_action( 'template_redirect', array( $this, 'sfwf_preview_template' ) );
			$this->trigger = 'sfwf-customizer';
			// only load controls for this plugin.
			if ( isset( $_GET[ $this->trigger ] ) ) {
				if ( ! empty( $_GET['sfwf_form_id'] ) ) {
					$this->sfwf_form_id = sanitize_text_field( wp_unslash( $_GET['sfwf_form_id'] ) );
				}
				add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
			}
		}

		// Admin footer text.
		add_filter( 'admin_footer_text', array( $this, 'admin_footer' ), 2, 2 );
	}

	/**
	 * If the right query var is present load the WPForms Forms preview template
	 *
	 * @since 1.0.0
	 */
	public function sfwf_preview_template( $wp_query ) {

		// load this conditionally based on the query var.
		if ( get_query_var( $this->trigger ) ) {
			wp_head();
			ob_start();
			$form_id = sanitize_text_field( wp_unslash( $_GET['sfwf_form_id'] ) );
			include self::$dir . '/helpers/utils/html-template-preview.php';
			$message = ob_get_clean();
			wp_footer();
			echo $message;
			exit;
		}
		return $wp_query;
	}

		/**
		 * Add custom variables to the available query vars
		 *
		 * @since 1.0.0
		 * @param mixed $vars
		 * @return mixed
		 */
	public function add_query_vars( $vars ) {
		$vars[] = $this->trigger;
		return $vars;
	}

	/**
	 * Primary panel button in the left panel navigation.
	 *
	 * @since 1.0.0
	 * @param mixed  $form
	 * @param string $view
	 */
	public function button( $form, $view ) {

		$form_id = $form->ID;
		$url     = $this->_set_customizer_url( $form_id );

		// $active = $view == $this->slug ? 'active' : '';
		printf( '<button class="wpforms-panel-styler-button">' );

			printf( '<i class="fa fa-paint-brush" ></i>' );

			printf( '<span>Styler</span>' );

		echo '</button>';
	}

	/**
	 * Set the customizer url
	 *
	 * @since 1.0.0
	 */
	private function _set_customizer_url( $form_id ) {
		$url                  = admin_url( 'customize.php' );
		$url                  = add_query_arg( 'sfwf-customizer', 'true', $url );
		$url                  = add_query_arg( 'sfwf_form_id', $form_id, $url );
		$url                  = add_query_arg( 'autofocus[panel]', 'sfwf_panel', $url );
		$url                  = add_query_arg(
			'url',
			wp_nonce_url(
				urlencode(
					add_query_arg(
						array(
							'sfwf_form_id'     => $form_id,
							'sfwf-customizer'  => 'true',
							'autofocus[panel]' => 'sfwf_panel',
						),
						site_url()
					)
				),
				'preview-popup'
			),
			$url
		);
		$url                  = add_query_arg(
			'return',
			urlencode(
				add_query_arg(
					array(
						'page'    => 'wpforms-builder',
						'form_id' => $form_id,
					),
					admin_url( 'admin.php' )
				)
			),
			$url
		);
		$this->customizer_url = esc_url_raw( $url );
		return $this->customizer_url;
	}

	public function wp_enqueue_scripts() {
		if ( is_customize_preview() ) {
			wp_enqueue_style( 'sfwf_live_preview_styles', self::$url . '/css/live-preview.css' );
			wp_enqueue_script( 'sfwf_frontend_preview_wp', self::$url . '/js/frontend.js', array( 'jquery', 'customize-preview' ), '', true );
		}
	}
	/**
	 * Function to display styles in frontend
	 *
	 * @param [array]  $form_data [description].
	 * @param [object] $form      [description].
	 * @return [none]            [no return]
	 */
	public function swfw_display_styles_frontend( $form_data, $form ) {
		$style_current_form = get_option( 'sfwf_form_id_' . $form_data['id'] );

		if ( ! empty( $style_current_form ) ) {

			$css_form_id       = $form_data['id'];
			$main_class_object = self::instance();
			include 'display/class-styles.php';
		}
		do_action( 'sfwf_after_post_style_display' );
	}

	/**
	 * Enqueue js file that autosaves the form selection in database.
	 *
	 * @author Sushil Kumar
	 * @since  v1.0
	 */
	public function sfwf_autosave_form() {

		wp_enqueue_script( 'sfwf_customizer_controls', self::$url . '/js/customizer-controls/customizer-controls.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'sfwf_auto_save_form', self::$url . '/js/auto-save-form.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'sfwf_customizer_css', self::$url . '/css/customizer/sfwf-customizer-controls.css' );
		wp_enqueue_style( 'sfwf_admin_css', self::$url . '/css/customizer-controls.css' );
	}
	public function welcome_page_css() {
		wp_enqueue_style( 'sfwf_welcome_page_css', self::$url . '/css/admin.css' );
	}
	/**
	 * Shows live preview of css changes.
	 *
	 * @author Sushil Kumar
	 * @since  v1.0
	 */
	public function sfwf_live_preview() {
		$current_form_id = get_option( 'sfwf_select_form_id' );

		wp_enqueue_script( 'sfwf_show_live_changes', self::$url . 'js/live-preview/live-preview-changes.js', array( 'jquery', 'customize-preview' ), '', true );
		$current_form_id = get_option( 'sfwf_select_form_id' );
		wp_enqueue_script( 'sfwf_customizer_shortcut_icons', self::$url . 'js/live-preview/edit-shortcuts.js', array( 'jquery', 'customize-preview', 'wpforms' ), '', true );
		wp_localize_script( 'sfwf_show_live_changes', 'sfwf_localize_current_form', array( 'formId' => $current_form_id ) );
		wp_localize_script( 'sfwf_customizer_shortcut_icons', 'sfwf_localize_edit_shortcuts', array( 'formId' => $current_form_id ) );
	}
	public function customize_save_after() {

		// get name of style to be deleted
		$style_to_be_deleted = get_option( 'sfwf_general_settings' );
		if ( $style_to_be_deleted['reset-styles'] != -1 || ! empty( $style_to_be_deleted['reset-styles'] ) ) {
			delete_option( 'sfwf_form_id_' . $style_to_be_deleted['reset-styles'] );
			$style_to_be_deleted['reset-styles'] = -1;
			update_option( 'sfwf_general_settings', $style_to_be_deleted );
		}
	}

	public function sfwf_customize_register( $wp_customize ) {

		$current_form_id = get_option( 'sfwf_select_form_id' );
		$border_types    = array(
			'inherit' => 'Inherit',
			'solid'   => 'Solid',
			'dotted'  => 'Dotted',
			'dashed'  => 'Dashed',
			'double'  => 'Double',
			'groove'  => 'Groove',
			'ridge'   => 'Ridge',
			'inset'   => 'Inset',
			'outset'  => 'Outset',
		);
		$align_pos       = array(
			'left'    => 'Left',
			'center'  => 'Center',
			'justify' => 'Justify',
			'right'   => 'Right',
		);
		include 'helpers/utils/fonts.php';
		$wp_customize->add_panel(
			'sfwf_panel',
			array(
				'title'       => __( 'Styler for WPForms' ),
				'description' => '<p> Craft your Forms</p>', // Include html tags such as <p>.
				'priority'    => 160, // Mixed with top-level-section hierarchy.
			)
		);

		// hidden field to get form id in jquery.
		if ( ! array_key_exists( 'autofocus', $_GET ) || ( array_key_exists( 'autofocus', $_GET ) && 'sfwf_panel' !== $_GET['autofocus']['panel'] ) ) {

			$wp_customize->add_setting(
				'sfwf_hidden_field_for_form_id',
				array(
					'default'   => $current_form_id,
					'transport' => 'postMessage',
					'type'      => 'option',
				)
			);

			$wp_customize->add_control(
				'sfwf_hidden_field_for_form_id',
				array(
					'type'        => 'hidden',
					'priority'    => 10, // Within the section.
					'section'     => 'sfwf_select_form_section', // Required, core or custom.
					'input_attrs' => array(
						'value' => $current_form_id,
						'id'    => 'sfwf_hidden_field_for_form_id',
					),
				)
			);
		}
		$border_types = array(
			// 'inherit' => 'Inherit',
			'solid'  => 'Solid',
			'dotted' => 'Dotted',
			'dashed' => 'Dashed',
			'double' => 'Double',
			'groove' => 'Groove',
			'ridge'  => 'Ridge',
			'inset'  => 'Inset',
			'outset' => 'Outset',
		);
		$align_pos    = array(
			'left'    => 'Left',
			'center'  => 'Center',
			'right'   => 'Right',
			'justify' => 'Justify',
		);

		$font_style_choices = array(
			'bold'      => 'Bold',
			'italic'    => 'Italic',
			'uppercase' => 'Uppercase',
			'underline' => 'underline',
		);

		include 'helpers/customizer-controls/desktop-text-input.php';
		include 'helpers/customizer-controls/tab-text-input.php';
		include 'helpers/customizer-controls/mobile-text-input.php';
		include 'helpers/customizer-controls/text-alignment.php';
		include 'helpers/customizer-controls/font-style.php';
		include 'helpers/customizer-controls/range-slider.php';
		include 'helpers/customizer-controls/label.php';
		include 'includes/form-select.php';
		include 'includes/customizer-addons.php';
		include 'includes/general-settings.php';
		do_action( 'sfwf_add_addons_section', $wp_customize, $current_form_id );
		include 'includes/form-wrapper.php';
		include 'includes/form-header.php';
		include 'includes/form-title.php';
		include 'includes/form-description.php';
		include 'includes/field-labels.php';
		include 'includes/field-descriptions.php';
		include 'includes/text-fields.php';
		include 'includes/dropdown-fields.php';
		include 'includes/radio-inputs.php';
		include 'includes/checkbox-inputs.php';
		include 'includes/paragraph-textarea.php';
		include 'includes/submit-button.php';
		include 'includes/confirmation-message.php';
		include 'includes/error-message.php';
	} // main customizer function ends here.

	/**
	 * Convert saved database values to CSS propetise
	 *
	 * @param [int]    $form_id  [form id to get the saved values for it].
	 * @param [string] $category [settings section for which details must be used].
	 * @return [string]           [CSS code]
	 */
	public function swfw_get_saved_styles( $form_id, $category, $important = '' ) {

		$settings = get_option( 'sfwf_form_id_' . $form_id );
		if ( is_customize_preview() ) {
			$important = '';
		}
		if ( empty( $settings ) ) {
			return;
		}
		$input_styles = '';
		if ( ! empty( $settings[ $category ]['font-style'] ) ) {
			$font_styles = explode( '|', $settings[ $category ]['font-style'] );

			foreach ( $font_styles as $value ) {
				foreach ( $font_styles as $value ) {
					switch ( $value ) {
						case 'bold':
							$input_styles .= 'font-weight: bold;';
							break;
						case 'italic':
							$input_styles .= 'font-style: italic;';
							break;
						case 'uppercase':
							$input_styles .= 'text-transform: uppercase;';
							break;
						case 'underline':
							$input_styles .= 'text-decoration: underline;';
							break;
						default:
							break;
					}
				}
			}
		}

		if ( isset( $settings[ $category ]['use-outer-shadows'] ) ) {
			$input_styles .= empty( $settings[ $category ]['horizontal-offset'] ) ? 'box-shadow: 0px ' : 'box-shadow:' . $settings[ $category ]['outer-horizontal-offset'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-vertical-offset'] ) ? '0px ' : $settings[ $category ]['outer-vertical-offset'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-blur-radius'] ) ? '0px ' : $settings[ $category ]['outer-blur-radius'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-spread-radius'] ) ? '0px ' : $settings[ $category ]['outer-spread-radius'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-shadow-color'] ) ? ';' : $settings[ $category ]['outer-shadow-color'] . ' ';

			if ( isset( $settings[ $category ]['use-inner-shadows'] ) ) {
				$input_styles .= empty( $settings[ $category ]['inner-horizontal-offset'] ) ? ', 0px ' : ', ' . $settings[ $category ]['inner-horizontal-offset'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-vertical-offset'] ) ? '0px ' : $settings[ $category ]['inner-vertical-offset'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-blur-radius'] ) ? '0px ' : $settings[ $category ]['inner-blur-radius'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-spread-radius'] ) ? '0px ' : $settings[ $category ]['inner-spread-radius'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-shadow-color'] ) ? ';' : $settings[ $category ]['inner-shadow-color'] . ' inset; ';
			} else {
				$input_styles .= ';';
			}
		}

		if ( isset( $settings[ $category ]['use-outer-shadows'] ) ) {
			$input_styles .= empty( $settings[ $category ]['outer-horizontal-offset'] ) ? '-moz-box-shadow: 0px ' : '-moz-box-shadow:' . $settings[ $category ]['outer-horizontal-offset'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-vertical-offset'] ) ? '0px ' : $settings[ $category ]['outer-vertical-offset'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-blur-radius'] ) ? '0px ' : $settings[ $category ]['outer-blur-radius'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-spread-radius'] ) ? '0px ' : $settings[ $category ]['outer-spread-radius'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-shadow-color'] ) ? ';' : $settings[ $category ]['outer-shadow-color'] . ' ';

			if ( isset( $settings[ $category ]['use-inner-shadows'] ) ) {
				$input_styles .= empty( $settings[ $category ]['inner-horizontal-offset'] ) ? ', 0px ' : ', ' . $settings[ $category ]['inner-horizontal-offset'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-vertical-offset'] ) ? '0px ' : $settings[ $category ]['inner-vertical-offset'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-blur-radius'] ) ? '0px ' : $settings[ $category ]['inner-blur-radius'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-spread-radius'] ) ? '0px ' : $settings[ $category ]['inner-spread-radius'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-shadow-color'] ) ? ';' : $settings[ $category ]['inner-shadow-color'] . ' inset; ';
			} else {
				$input_styles .= ';';
			}
		}

		if ( isset( $settings[ $category ]['use-outer-shadows'] ) ) {

			$input_styles .= empty( $settings[ $category ]['outer-horizontal-offset'] ) ? '-webkit-box-shadow: 0px ' : '-webkit-box-shadow:' . $settings[ $category ]['outer-horizontal-offset'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-vertical-offset'] ) ? '0px ' : $settings[ $category ]['outer-vertical-offset'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-blur-radius'] ) ? '0px ' : $settings[ $category ]['outer-blur-radius'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-spread-radius'] ) ? '0px ' : $settings[ $category ]['outer-spread-radius'] . ' ';
			$input_styles .= empty( $settings[ $category ]['outer-shadow-color'] ) ? ';' : $settings[ $category ]['outer-shadow-color'] . ' ';

			if ( isset( $settings[ $category ]['use-inner-shadows'] ) ) {
				$input_styles .= empty( $settings[ $category ]['inner-horizontal-offset'] ) ? ', 0px ' : ', ' . $settings[ $category ]['inner-horizontal-offset'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-vertical-offset'] ) ? '0px ' : $settings[ $category ]['inner-vertical-offset'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-blur-radius'] ) ? '0px ' : $settings[ $category ]['inner-blur-radius'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-spread-radius'] ) ? '0px ' : $settings[ $category ]['inner-spread-radius'] . ' ';
				$input_styles .= empty( $settings[ $category ]['inner-shadow-color'] ) ? ';' : $settings[ $category ]['inner-shadow-color'] . ' inset; ';
			} else {
				$input_styles .= ';';
			}
		}

		$input_styles .= empty( $settings[ $category ]['color'] ) ? '' : 'color:' . $settings[ $category ]['color'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['background-color'] ) ? '' : 'background-color:' . $settings[ $category ]['background-color'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['background-color1'] ) ? '' : 'background:-webkit-linear-gradient(to left,' . $settings[ $category ]['background-color'] . ',' . $settings[ $category ]['background-color1'] . ') ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['background-color1'] ) ? '' : 'background:linear-gradient(to left,' . $settings[ $category ]['background-color'] . ',' . $settings[ $category ]['background-color1'] . ') ' . $important . ';';

		// $input_styles.= empty( $settings[$category]['padding'] )?'':'padding:'. $settings[$category]['padding'].';';
		$input_styles .= empty( $settings[ $category ]['width'] ) ? '' : 'width:' . $settings[ $category ]['width'] . $this->sfwf_add_px_to_value( $settings[ $category ]['width'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['height'] ) ? '' : 'height:' . $settings[ $category ]['height'] . $this->sfwf_add_px_to_value( $settings[ $category ]['height'] ) . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['title-position'] ) ? '' : 'text-align:' . $settings[ $category ]['title-position'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['text-align'] ) ? '' : 'text-align:' . $settings[ $category ]['text-align'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['error-position'] ) ? '' : 'text-align:' . $settings[ $category ]['error-position'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['description-position'] ) ? '' : 'text-align:' . $settings[ $category ]['description-position'] . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['title-color'] ) ? '' : 'color:' . $settings[ $category ]['title-color'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['font-color'] ) ? '' : 'color:' . $settings[ $category ]['font-color'] . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['description-color'] ) ? '' : 'color:' . $settings[ $category ]['description-color'] . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['button-color'] ) ? '' : 'background-color:' . $settings[ $category ]['button-color'] . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['description-color'] ) ? '' : 'color:' . $settings[ $category ]['description-color'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['line-height'] ) ? '' : 'line-height:' . $settings[ $category ]['line-height'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['font-family'] ) ? '' : 'font-family:' . $settings[ $category ]['font-family'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['font-size'] ) ? '' : 'font-size:' . $settings[ $category ]['font-size'] . $this->sfwf_add_px_to_value( $settings[ $category ]['font-size'] ) . ';';
		$input_styles .= empty( $settings[ $category ]['max-width'] ) ? '' : 'width:' . $settings[ $category ]['max-width'] . $this->sfwf_add_px_to_value( $settings[ $category ]['max-width'] ) . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['maximum-width'] ) ? '' : 'width:' . $settings[ $category ]['maximum-width'] . $this->sfwf_add_px_to_value( $settings[ $category ]['maximum-width'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['margin'] ) ? '' : 'margin:' . $settings[ $category ]['margin'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['padding'] ) ? '' : 'padding:' . $settings[ $category ]['padding'] . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['border-size'] ) ? '' : 'border-width:' . $settings[ $category ]['border-size'] . $this->sfwf_add_px_to_value( $settings[ $category ]['border-size'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['border-color'] ) ? '' : 'border-color:' . $settings[ $category ]['border-color'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['border-type'] ) ? '' : 'border-style:' . $settings[ $category ]['border-type'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['border-bottom'] ) ? '' : 'border-bottom-style:' . $settings[ $category ]['border-bottom'] . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['border-bottom-size'] ) ? '' : 'border-bottom-width:' . $settings[ $category ]['border-bottom-size'] . $this->sfwf_add_px_to_value( $settings[ $category ]['border-bottom-size'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['border-bottom-color'] ) ? '' : 'border-bottom-color:' . $settings[ $category ]['border-bottom-color'] . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['background-image-url'] ) ? '' : 'background: url(' . $settings[ $category ]['background-image-url'] . ') no-repeat' . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['border-bottom-color'] ) ? '' : 'border-bottom-color:' . $settings[ $category ]['border-bottom-color'] . ' ' . $important . ';';
		if ( ! empty( $settings[ $category ]['display'] ) && $settings[ $category ]['display'] === true ) {
			$input_styles .= 'display:none' . ' ' . $important . ';';
		}
		if ( ! empty( $settings[ $category ]['border-radius'] ) ) {
			$input_styles .= 'border-radius:' . $settings[ $category ]['border-radius'] . $this->sfwf_add_px_to_value( $settings[ $category ]['border-radius'] ) . ' ' . $important . ';';
			$input_styles .= '-web-border-radius:' . $settings[ $category ]['border-radius'] . $this->sfwf_add_px_to_value( $settings[ $category ]['border-radius'] ) . ' ' . $important . ';';
			$input_styles .= '-moz-border-radius:' . $settings[ $category ]['border-radius'] . $this->sfwf_add_px_to_value( $settings[ $category ]['border-radius'] ) . ' ' . $important . ';';
		}

		$input_styles .= empty( $settings[ $category ]['custom-css'] ) ? '' : $settings[ $category ]['custom-css'] . ';';
		return $input_styles;
	}
	public function swfw_get_saved_styles_tab( $form_id, $category, $important ) {
		$settings = get_option( 'sfwf_form_id_' . $form_id );
		if ( empty( $settings ) ) {
			return;
		}
		$input_styles  = '';
		$input_styles .= empty( $settings[ $category ]['width-tab'] ) ? '' : 'width:' . $settings[ $category ]['width-tab'] . $this->sfwf_add_px_to_value( $settings[ $category ]['width-tab'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['max-width-tab'] ) ? '' : 'width:' . $settings[ $category ]['max-width-tab'] . $this->sfwf_add_px_to_value( $settings[ $category ]['max-width-tab'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['maximum-width-tab'] ) ? '' : 'width:' . $settings[ $category ]['maximum-width-tab'] . $this->sfwf_add_px_to_value( $settings[ $category ]['maximum-width-tab'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['height-tab'] ) ? '' : 'height:' . $settings[ $category ]['height-tab'] . $this->sfwf_add_px_to_value( $settings[ $category ]['height-tab'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['font-size-tab'] ) ? '' : 'font-size:' . $settings[ $category ]['font-size-tab'] . $this->sfwf_add_px_to_value( $settings[ $category ]['font-size-tab'] ) . ' ' . $important . ';';

		$input_styles .= empty( $settings[ $category ]['line-height-tab'] ) ? '' : 'line-height:' . $settings[ $category ]['line-height-tab'] . $this->$settings[ $category ]['line-height-tab'] . ' ' . $important . ';';

		return $input_styles;
	}

	public function swfw_get_saved_styles_phone( $form_id, $category, $important ) {
		$settings = get_option( 'sfwf_form_id_' . $form_id );
		if ( empty( $settings ) ) {
			return;
		}
		$input_styles  = '';
		$input_styles .= empty( $settings[ $category ]['width-phone'] ) ? '' : 'width:' . $settings[ $category ]['width-phone'] . $this->sfwf_add_px_to_value( $settings[ $category ]['width-phone'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['max-width-phone'] ) ? '' : 'width:' . $settings[ $category ]['max-width-phone'] . $this->sfwf_add_px_to_value( $settings[ $category ]['max-width-phone'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['maximum-width-phone'] ) ? '' : 'width:' . $settings[ $category ]['maximum-width-phone'] . $this->sfwf_add_px_to_value( $settings[ $category ]['maximum-width-phone'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['height-phone'] ) ? '' : 'height:' . $settings[ $category ]['height-phone'] . $this->sfwf_add_px_to_value( $settings[ $category ]['height-phone'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['font-size-phone'] ) ? '' : 'font-size:' . $settings[ $category ]['font-size-phone'] . $this->sfwf_add_px_to_value( $settings[ $category ]['font-size-phone'] ) . ' ' . $important . ';';
		$input_styles .= empty( $settings[ $category ]['line-height-phone'] ) ? '' : 'line-height:' . $settings[ $category ]['line-height-phone'] . $this->$settings[ $category ]['line-height-phone'] . ' ' . $important . ';';

		return $input_styles;
	}


	public function sfwf_add_px_to_value( $value ) {

		if ( ctype_digit( $value ) ) {
			$value = 'px';
		} else {
			$value = '';
		}
		return $value;
	}

	/**
	 * When user is on a Styler for WPForms related admin page, display footer text
	 * that graciously asks them to rate us.
	 *
	 * @since 1.3.2
	 *
	 * @param string $text
	 *
	 * @return string
	 */
	public function admin_footer( $text ) {

		global $current_screen;

		if ( ! empty( $current_screen->id ) && strpos( $current_screen->id, 'styler-wpforms' ) !== false ) {
			$url  = 'https://wordpress.org/support/plugin/styler-for-wpforms/reviews/?filter=5#new-post';
			$text = sprintf(
				wp_kses(
					/* translators: $1$s - WPForms plugin name; $2$s - WP.org review link; $3$s - WP.org review link. */
					__( 'Please rate %1$s <a href="%2$s" target="_blank" rel="noopener noreferrer">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="%3$s" target="_blank" rel="noopener">WordPress.org</a> to help us spread the word. Thank you from the Styler for WPForms team!', 'sk_sfwf' ),
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
						),
					)
				),
				'<strong>Styler for WPForms</strong>',
				$url,
				$url
			);
		}

		return $text;
	}
} // Class ends here.


add_action( 'plugins_loaded', 'sk_sfwf_main_class' );

/**
 * The main function responsible for returning The Highlander Plugin
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @since 3.0
 * @return {class} Highlander Instance
 */
function sk_sfwf_main_class() {
	return Sk_Sfwf_Main_Class::instance();
}
