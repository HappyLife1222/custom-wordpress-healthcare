<?php
/**
 * The WP_Members Class.
 *
 * This is the main WP_Members object class. This class contains functions
 * for loading settings, shortcodes, hooks to WP, plugin dropins, constants,
 * and registration fields. It also manages whether content should be blocked.
 *
 * @package WP-Members
 * @subpackage WP_Members Object Class
 * @since 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class WP_Members {
	
	/**
	 * Plugin version.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $version = WPMEM_VERSION;
	
	/**
	 * Database version
	 *
	 * @since  3.2.2
	 * @access public
	 * @var    string
	 */
	public $db_version = WPMEM_DB_VERSION;
	
	/**
	 * Plugin path.
	 *
	 * @since  3.3.0
	 * @access public
	 * @var    string
	 */
	public $path;
	
	/**
	 * Plugin __FILE__.
	 *
	 * @since  3.3.0
	 * @access public
	 * @var    string
	 */
	public $name;
	
	/**
	 * Plugin slug.
	 *
	 * @since  3.3.0
	 * @access public
	 * @var    string
	 */
	public $slug;
	
	/**
	 * Plugin URL.
	 *
	 * @since  3.3.0
	 * @access public
	 * @var    string
	 */
	public $url;
	
	/**
	 * Content block settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $block;
	
	/**
	 * Excerpt settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $show_excerpt;
	
	/**
	 * Show login form settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $show_login;
	
	/**
	 * Show registration form settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $show_reg;
	
	/**
	 * Auto-excerpt settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $autoex;
	
	/**
	 * Notify admin settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $notify;
	
	/**
	 * Moderated registration settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $mod_reg;
	
	/**
	 * Captcha settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $captcha;
	
	/**
	 * Enable expiration extension settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $use_exp;
	
	/**
	 * Expiration extension enable trial period.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $use_trial;
	
	/**
	 * 
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $warnings;
	
	/**
	 * Enable drop-ins setting.
	 *
	 * @since  3.1.9
	 * @access public
	 * @var    string
	 */
	public $dropins = 0;
	
	/**
	 * Container for enabled dropins.
	 *
	 * @since  3.1.9
	 * @access public
	 * @var    array
	 */
	public $dropins_enabled = array();

	/**
	 * Current plugin action container.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $action;
	
	/**
	 * Regchk container.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $regchk;
	
	/**
	 * User page settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $user_pages;
	
	/**
	 * Custom Post Type settings.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    array
	 */
	public $post_types;
	
	/**
	 * Setting for applying texturization.
	 *
	 * @since  3.1.7
	 * @access public
	 * @var    boolean
	 */
	public $texturize;
	
	/**
	 * Enable product creation.
	 *
	 * @since 3.2.0
	 * @access public
	 * @var boolean
	 */
	public $enable_products;
	
	/**
	 * Enable logged-in menu clones.
	 *
	 * @since  3.2.0
	 * @access public
	 * @var    string
	 */
	public $clone_menus;
	
	/**
	 * Container for error messages.
	 *
	 * @since  3.2.0
	 * @access public
	 * @var    stdClass
	 */
	public $error;
	
	/**
	 * Container for admin notices.
	 *
	 * @since 3.3.0
	 * @access public
	 * @var array
	 */
	public $admin_notices;
	
	/**
	 * Container for stylesheet setting.
	 *
	 * @since  3.2.7
	 * @access public
	 * @var    string
	 */
	public $select_style;

	/**
	 * Container for the CSS URL.
	 * 
	 * @since  Unknown
	 * @access public
	 * @var    string
	 */
	public $cssurl;

	/**
	 * The attribution setting.
	 * 
	 * @since Unknown
	 * @access public
	 * @var string
	 */
	public $attrib;

	/**
	 * Container for form tags.
	 * 
	 * @since Unknown
	 * @access public
	 * @var array
	 * @todo verify @var
	 */
	public $form_tags;
	
	/**
	 * Container for dropin folder location.
	 *
	 * @since  3.3.0
	 * @access public
	 * @var    string
	 */
	public $dropin_dir;
	
	/**
	 * REST conditional.
	 *
	 * @since  3.3.2
	 * @access public
	 * @var    boolean
	 */
	public $is_rest = false;

	/**
	 * Temporary setting for activation link.
	 * 
	 * @todo Will default to 0 until 3.4.0, then 1 until 3.5.0 at which point we'll remove the old process.
	 *
	 * @since 3.3.5
	 * @access public
	 * @var string
	 */
	public $act_link = 0;
	
	/**
	 * Temporary setting for password reset.
	 * 
	 * @todo Will default to 0 until 3.4.0, then 1 until 3.5.0 at which point we'll remove the old process.
	 *
	 * @since 3.3.5
	 * @access public
	 * @var string
	 */
	public $pwd_link = 1;
	
	/**
	 * Setting for login error option.
	 * 
	 * @todo Will be deprecated in 3.5.0 when the WP login error is the only error.
	 *
	 * @since 3.3.5
	 * @access public
	 * @var string
	 */
	public $login_error = 1;
	
	/**
	 * Default file upload directory.
	 *
	 * @since 3.3.8
	 * @access public
	 * @var string
	 */
	public $upload_base = 'wpmembers';

	/**
	 * Opt in to update and security notifications.
	 * 
	 * @since 3.4.2
	 */
	public $optin;

	/**
	 * Container for WooCommerce-specific settings.
	 * 
	 * @since Unknown
	 * @access public
	 * @var array
	 */
	public $woo;

	/**
	 * The forms object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $forms;

	/**
	 * The fields object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $fields;

	/**
	 * The API object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $api;

	/**
	 * The shortcodes object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $shortcodes;

	/**
	 * The membership object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $membership;
	
	/**
	 * The email object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $email;

	/**
	 * The user object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $user;

	/**
	 * The menus object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $menus;

	/**
	 * The dialogs object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $dialogs;

	/**
	 * The clone menus object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $menus_clone;

	/**
	 * The password reset object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $pwd_reset;

	/**
	 * The new account email activation object.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $act_newreg;

	/**
	 * The admin object class.
	 * 
	 * @since Unknown
	 * @access public
	 * @var object
	 */
	public $admin;

	/**
	 * Objects for premium extensions.
	 * 
	 * @access public
	 * @var    object
	 */
	public $advanced;
	public $downloads;
	public $editor;
	public $invite_codes;
	public $mailchimp;
	public $salesforce;
	public $security;
	public $stop_spam;
	public $usertrack;
	public $user_list;

	/**
	 * Plugin initialization function.
	 *
	 * @since 3.0.0
	 * @since 3.1.6 Dependencies now loaded by object.
	 */
	function __construct() {
		
		// Constants.
		$this->path = plugin_dir_path( __DIR__ );
		$this->name = $this->path . 'wp-members.php';
		$this->slug = substr( basename( $this->name ), 0, -4 );
		$this->url  = plugin_dir_url ( __DIR__ );
	
		$settings = get_option( 'wpmembers_settings' );
		
		// Validate that v3 settings are loaded.
		if ( ! isset( $settings['version'] ) 
			|| $settings['version'] != $this->version
			|| ! isset( $settings['db_version'] ) 
			|| $settings['db_version'] != $this->db_version ) {
			// Load installation routine and pdate settings.
			require_once $this->path . 'includes/install.php';
			$settings = wpmem_do_install();
		}

		/**
		 * Filter the options before they are loaded into constants.
		 *
		 * @since 2.9.0
		 * @since 3.0.0 Moved to the WP_Members class.
		 *
		 * @param array $this->settings An array of the WP-Members settings.
		 */
		$settings = apply_filters( 'wpmem_settings', $settings );

		// Assemble settings.
		foreach ( $settings as $key => $val ) {
			$this->$key = $val;
		}

		// Load dependent files.
		$this->load_dependencies();
				
		// @todo Until I think of a better place to put this.
		$this->optin = get_option( 'wpmembers_optin' );
		
		$this->load_user_pages();
		$this->set_style();
		
		$this->forms       = new WP_Members_Forms;         // Load forms.
		$this->api         = new WP_Members_API;           // Load api.
		$this->shortcodes  = new WP_Members_Shortcodes();  // Load shortcodes.
		$this->membership  = new WP_Members_Products();    // Load membership plans
		$this->email       = new WP_Members_Email;         // Load email functions
		$this->user        = new WP_Members_User( $this ); // Load user functions.
		$this->menus       = new WP_Members_Menus();
		$this->dialogs     = new WP_Members_Dialogs();
		
		// @deprecated Clone menus are technically deprecated, but kept in the plugin for legacy users.
		if ( $this->clone_menus ) {
			$this->menus_clone = new WP_Members_Clone_Menus(); // Load clone menus.
		}

		if ( 1 == $this->pwd_link ) {
			$this->pwd_reset  = new WP_Members_Pwd_Reset;
		}
		if ( 1 == $this->act_link ) {
			$this->act_newreg = new WP_Members_Validation_Link;
		}
		
		// @todo Is this a temporary fix?
		$this->email->load_from();
		
		/**
		 * Fires after main settings are loaded.
		 *
		 * @since 3.0
		 * @deprecated 3.2.0 Use wpmem_after_init instead.
		 */
		do_action( 'wpmem_settings_loaded' );
	
		// Preload the expiration module, if available.
		$exp_active = ( function_exists( 'wpmem_exp_init' ) || function_exists( 'wpmem_set_exp' ) ) ? true : false;
		define( 'WPMEM_EXP_MODULE', $exp_active ); 
	
		// Load actions and filters.
		$this->load_hooks();
		
		// Load contants.
		$this->load_constants();
		
		// Load dropins.
		if ( $this->dropins ) {
			$this->load_dropins();
		}
		
		// Check for anything that we should stop execution for (currently just the default tos).
		if ( 'display' == wpmem_get( 'tos', false, 'get' ) ) {
			// If themes are not loaded, we don't need them.
			$user_themes = ( ! defined( 'WP_USE_THEMES'  ) ) ? define( 'WP_USE_THEMES',  false  ) : '';
			$this->load_default_tos();
			die();
		}
	}
	
	/**
	 * Plugin initialization function to load hooks.
	 *
	 * @since 3.0.0
	 */
	function load_hooks() {
		
		/**
		 * Fires before action and filter hooks load.
		 *
		 * @since 3.0.0
		 * @since 3.1.6 Fires before hooks load.
		 */
		do_action( 'wpmem_load_hooks' );

		// Add actions.
		
		add_action( 'init',                  array( $this, 'load_textdomain' ) );
		add_action( 'init',                  array( $this->membership, 'add_cpt' ), 0 ); // Adds membership plans custom post type.
		add_action( 'init',                  array( $this, 'load_dependent_classes' ) );
		add_action( 'widgets_init',          array( $this, 'widget_init' ) );            // initializes the widget
		add_action( 'rest_api_init',         array( $this, 'rest_init'   ) );
		add_action( 'pre_get_posts',         array( $this, 'do_hide_posts' ), 20 );
		add_action( 'template_redirect',     array( $this, 'get_action'  ) );
		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_style_wp_login' ) ); // styles the native registration
		add_action( 'wp_enqueue_scripts',    array( $this, 'enqueue_style' ) );          // Enqueues the stylesheet.
		add_action( 'wp_enqueue_scripts',    array( $this, 'loginout_script' ) );
		add_action( 'customize_register',    array( $this, 'customizer_settings' ) );
		add_action( 'wp_footer',             array( $this, 'invisible_captcha' ) );

		if ( is_admin() ) {
			add_action( 'init', array( $this, 'load_admin' ) ); // @todo Check user role to load correct dashboard
		}
		
		if ( is_user_logged_in() ) {
			add_action( 'wpmem_pwd_change',  array( $this->user, 'set_password' ), 9, 2 );
			add_action( 'wpmem_pwd_change',  array( $this->user, 'set_as_logged_in' ), 10 );
		}
		
		add_action( 'register_form', 'wpmem_wp_register_form' ); // Adds fields to the default wp registration
		
		// Add filters.
		add_filter( 'the_content',             array( $this, 'do_securify' ), 99 );
		add_filter( 'comments_open',           array( $this, 'do_securify_comments' ), 99, 2 ); // securifies the comments
		add_filter( 'wpmem_securify',          array( $this, 'reg_securify' ) );             // adds success message on login form if redirected
		add_filter( 'rest_prepare_post',       array( $this, 'do_securify_rest' ), 10, 3 );
		add_filter( 'rest_prepare_page',       array( $this, 'do_securify_rest' ), 10, 3 );
		foreach( $this->post_types as $post_type ) {
			add_filter( "rest_prepare_{$post_type}", array( $this, 'do_securify_rest' ), 10, 3 );
		}
				   
		//add_filter( 'query_vars',                array( $this, 'add_query_vars' ), 10, 2 ); // adds custom query vars
		add_filter( 'get_pages',               array( $this, 'filter_get_pages' ) );
		add_filter( 'wp_get_nav_menu_items',   array( $this, 'filter_nav_menu_items' ), null, 3 );
		add_filter( 'get_previous_post_where', array( $this, 'filter_get_adjacent_post_where' ) );
		add_filter( 'get_next_post_where',     array( $this, 'filter_get_adjacent_post_where' ) );
		add_filter( 'allow_password_reset',    array( $this->user, 'no_reset' ) );           // no password reset for non-activated users

		// If registration is moderated, check for activation (blocks backend login by non-activated users).
		if ( 1 == $this->mod_reg ) { 
			add_filter( 'authenticate', array( $this->user, 'check_activated' ), 99, 3 ); 
		}

		// Replace login error object, if profile page is set, AND it is not the wp-login.php page.
		if ( 1 == $this->login_error 
			&& isset( $this->user_pages['profile'] ) 
			&& '' != $this->user_pages['profile']
			&& 'wp-login.php' !== $GLOBALS['pagenow']
		    && ! wpmem_is_woo_active() ) {
			add_filter( 'lostpassword_url',  array( $this, 'lost_pwd_url' ), 10, 2 );
		}
		
		if ( function_exists( 'wpmem_custom_translation_strings' ) ) {
			add_filter( 'wpmem_fields', array( $this->forms, 'localize_fields' ), 9 );
		}
		/**
		 * Fires after action and filter hooks load.
		 *
		 * @since 3.0.0
		 * @since 3.1.6 Was wpmem_load_hooks, now wpmem_hooks_loaded.
		 */
		do_action( 'wpmem_hooks_loaded' );
	}
	
	/**
	 * Load drop-ins.
	 *
	 * @since 3.0.0
	 *
	 * @todo This is experimental. The function and its operation is subject to change.
	 */
	function load_dropins() {

		/**
		 * Fires before dropins load (for adding additional drop-ins).
		 *
		 * @since 3.0.0
		 * @since 3.1.6 Fires before dropins.
		 */
		do_action( 'wpmem_load_dropins' );
		
		/**
		 * Filters the drop-in file directory.
		 *
		 * @since 3.0.0
		 * @since 3.3.0 Filter previously unpublished, changed hook name.
		 *
		 * @param string $wpmem->dropin_dir The drop-in file directory.
		 */
		$dir = apply_filters( 'wpmem_dropin_dir', $this->dropin_dir );
		
		// Load any drop-ins.
		$settings = get_option( 'wpmembers_dropins' );
		$this->dropins_enabled = ( $settings ) ? $settings : array();
		if ( ! empty( $this->dropins_enabled ) ) {
			foreach ( $this->dropins_enabled as $filename ) {
				$dropin = $dir . $filename;
				if ( file_exists( $dropin ) ) {
					include_once $dropin;
				}
			}
		}

		/**
		 * Fires before dropins load (for adding additional drop-ins).
		 *
		 * @since 3.0.0
		 * @since 3.1.6 Was wpmem_load_dropins, now wpmem_dropins_loaded.
		 */
		do_action( 'wpmem_dropins_loaded' );
	}
	
	/**
	 * Loads pre-3.0 constants (included primarily for add-on compatibility).
	 *
	 * @since 3.0.0
	 * @since 3.3.0 Deprecated all but exp and trl constants.
	 */
	function load_constants() {
		( ! defined( 'WPMEM_MOD_REG' ) ) ? define( 'WPMEM_MOD_REG', $this->mod_reg   ) : '';
		( ! defined( 'WPMEM_USE_EXP' ) ) ? define( 'WPMEM_USE_EXP', $this->use_exp   ) : '';
		( ! defined( 'WPMEM_USE_TRL' ) ) ? define( 'WPMEM_USE_TRL', $this->use_trial ) : '';
	}

	/**
	 * Load dependent files.
	 *
	 * @since 3.1.6
	 */
	function load_dependencies() {
		
		/**
		 * Filter the location and name of the pluggable file.
		 *
		 * @since 2.9.0
		 * @since 3.1.6 Moved in load order to come before dependencies.
		 *
		 * @param string The path to WP-Members plugin functions file.
		 */
		$wpmem_pluggable = apply_filters( 'wpmem_plugins_file', WP_PLUGIN_DIR . '/wp-members-pluggable.php' );
	
		// Preload any custom functions, if available.
		if ( file_exists( $wpmem_pluggable ) ) {
			include( $wpmem_pluggable );
		}
		
		require_once $this->path . 'includes/vendor/rocketgeek-utilities/loader.php';
		require_once $this->path . 'includes/class-wp-members-api.php';
		require_once $this->path . 'includes/class-wp-members-clone-menus.php';
		require_once $this->path . 'includes/class-wp-members-captcha.php';
		require_once $this->path . 'includes/class-wp-members-dialogs.php';
		require_once $this->path . 'includes/class-wp-members-email.php';
		require_once $this->path . 'includes/class-wp-members-forms.php';
		require_once $this->path . 'includes/class-wp-members-menus.php';
		require_once $this->path . 'includes/class-wp-members-products.php';
		require_once $this->path . 'includes/class-wp-members-pwd-reset.php';
		require_once $this->path . 'includes/class-wp-members-shortcodes.php';
		require_once $this->path . 'includes/class-wp-members-user.php';
		require_once $this->path . 'includes/class-wp-members-user-profile.php';
		require_once $this->path . 'includes/class-wp-members-validation-link.php';
		require_once $this->path . 'includes/class-wp-members-widget.php';
		require_once $this->path . 'includes/class-wp-members-woocommerce-integration.php';
		require_once $this->path . 'includes/api/api.php';
		require_once $this->path . 'includes/api/api-email.php';
		require_once $this->path . 'includes/api/api-forms.php';
		require_once $this->path . 'includes/api/api-products.php';
		require_once $this->path . 'includes/api/api-settings.php';
		require_once $this->path . 'includes/api/api-users.php';
		require_once $this->path . 'includes/api/api-utilities.php';

		//require_once $this->path . 'includes/blocks/class-wp-members-blocks.php';

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			require_once $this->path . 'includes/cli/class-wp-members-cli.php';
			require_once $this->path . 'includes/cli/class-wp-members-cli-user.php';
			require_once $this->path . 'includes/cli/class-wp-members-cli-settings.php';
		}

		require_once $this->path . 'includes/deprecated.php';
		require_once $this->path . 'includes/legacy/dialogs.php'; // File is totally deprecated at this point; eval for removal.
	}

	/**
	 * Load classes that depend on the $wpmem object class to be fully loaded.
	 * 
	 * @since 3.4.7
	 */
	public function load_dependent_classes() {
		if ( wpmem_is_woo_active() ) {
			$this->woo = new WP_Members_WooCommerce_Integration( $this );
		}
	}

	/**
	 * Load admin API and dependencies.
	 *
	 * Determines which scripts to load and actions to use based on the 
	 * current users capabilities.
	 *
	 * @since 2.5.2
	 * @since 3.1.0 Added admin api object.
	 * @since 3.1.7 Moved from main plugin file as wpmem_chk_admin() to main object.
	 */
	function load_admin() {

		/**
		 * Fires before initialization of admin options.
		 *
		 * @since 2.9.0
		 */
		do_action( 'wpmem_pre_admin_init' );

		/**
		 * Load the admin api class.
		 *
		 * @since 3.1.0
		 */	
		require_once $this->path . 'includes/admin/class-wp-members-admin-api.php';
		$this->admin = new WP_Members_Admin_API;

		/**
		 * Fires after initialization of admin options.
		 *
		 * @since 2.9.0
		 */
		do_action( 'wpmem_after_admin_init' );
	}
	
	/**
	 * Gets the requested action.
	 *
	 * @since 3.0.0
	 *
	 * @global string $wpmem_a The WP-Members action variable.
	 */
	function get_action() {

		// Get the action being done (if any).
		$this->action = sanitize_text_field( wpmem_get( 'a', '', 'request' ) );

		// For backward compatibility with processes that check $wpmem_a.
		global $wpmem_a;
		$wpmem_a = $this->action;
		
		/**
		 * Fires when the wpmem action is retrieved.
		 *
		 * @since 3.1.7
		 * @since 3.4.2 Added action as a param.
		 */
		do_action( 'wpmem_get_action', $this->action );

		// Get the regchk value (if any).
		$this->regchk = $this->get_regchk( $this->action );
	}
	
	/**
	 * Gets the regchk value.
	 *
	 * regchk is a legacy variable that contains information about the current
	 * action being performed. Login, logout, password, registration, profile
	 * update functions all return a specific value that is stored in regchk.
	 * This value and information about the current action can then be used to
	 * determine what content is to be displayed by the securify function.
	 *
	 * @since 3.0.0
	 *
	 * @global string $wpmem_a The WP-Members action variable.
	 *
	 * @param  string $action The current action.
	 * @return string         The regchk value.
	 */
	function get_regchk( $action ) {

		switch ( $action ) {

			case 'login':
				$regchk = $this->user->login();
				break;

			case 'logout':
				$regchk = $this->user->logout();
				break;
			
			case 'pwdchange':
			case 'set_password_from_key':
				$regchk = $this->user->password_update( 'change' );
				break;

			case 'pwdreset':
				global $wpmem;
				if ( 1 == $wpmem->pwd_link ) {
					$regchk = $this->user->password_update( 'link' );
				} else {
					$regchk = $this->user->password_update( 'reset' );
				}
				break;
			
			case 'getusername':
				$regchk = $this->user->retrieve_username();
				break;
			
			case 'register':
			case 'update':
				$regchk = wpmem_user_register( $action  );
				break;

			default:
				$regchk = ( isset( $regchk ) ) ? $regchk : '';
				break;
		}
		
		/**
		 * Filter wpmem_regchk.
		 *
		 * The value of regchk is determined by functions that may be run in the get_regchk function.
		 * This value determines what happens in the wpmem_securify() function.
		 *
		 * @since 2.9.0
		 * @since 3.0.0 Moved to get_regchk() in WP_Members object.
		 *
		 * @param  string $this->regchk The value of wpmem_regchk.
		 * @param  string $this->action The $wpmem_a action.
		 */
		$regchk = apply_filters( 'wpmem_regchk', $regchk, $action );
		
		// Legacy global variable for use with older extensions.
		global $wpmem_regchk;
		$wpmem_regchk = $regchk;
		
		return $regchk;
	}
	
	/**
	 * Determines if content should be blocked.
	 *
	 * This function was originally stand alone in the core file and
	 * was moved to the WP_Members class in 3.0.
	 *
	 * @since 3.0.0
	 * @since 3.3.0 Added $post_id
	 * @since 3.4.0 Added $is_post_check to allow for individual post checking.
	 *
	 * @global object $post The WordPress Post object.
	 *
	 * @param  int    $post_id
	 * @return bool   $block   true|false
	 */
	function is_blocked( $post_id = false ) {
	
		global $post;
		
		$is_post_check = ( false == $post_id ) ? false : true;
		
		if ( $post || $post_id ) {
		
			$the_post = ( false == $post_id ) ? $post : get_post( $post_id );
 
			$meta = wpmem_get_block_setting( $the_post->ID );
			
			// Backward compatibility for old block/unblock meta.
			if ( ! $meta ) {
				// Check for old meta.
				$old_block   = get_post_meta( $the_post->ID, 'block',   true );
				$old_unblock = get_post_meta( $the_post->ID, 'unblock', true );
				$meta = ( $old_block ) ? 1 : ( ( $old_unblock ) ? 0 : $meta );
			}
	
			// Setup defaults.
			$defaults = array(
				'post_id'    => $the_post->ID,
				'post_type'  => $the_post->post_type,
				'block'      => ( isset( $this->block[ $the_post->post_type ] ) && $this->block[ $the_post->post_type ] == 1 ) ? true : false,
				'block_meta' => $meta,
				'block_type' => ( isset( $this->block[ $the_post->post_type ] ) ) ? $this->block[ $the_post->post_type ] : 0,
			);
	
			/**
			 * Filter the block arguments.
			 *
			 * @since 2.9.8
			 * @since 3.0.0 Moved to is_blocked() in WP_Members object.
			 * @since 3.3.0 Passes $defaults, second argument deprecated.
			 *
			 * @param array $args     $defaults.
			 * @param array $defaults Deprecated 3.3.0. @todo Obsolete in 3.5.0
			 */
			$args = apply_filters( 'wpmem_block_args', $defaults, $defaults );
	
			// Merge $args with defaults.
			$args = ( wp_parse_args( $args, $defaults ) );
	
			if ( $is_post_check || is_single() || is_page() || wpmem_is_rest() ) {	
				switch( $args['block_type'] ) {
					case 1: // If content is blocked by default.
						$args['block'] = ( $args['block_meta'] == '0' ) ? false : $args['block'];
						break;
					case 0 : // If content is unblocked by default.
						$args['block'] = ( $args['block_meta'] == '1' ) ? true : $args['block'];
						break;
				}

			} else {
				$args['block'] = false;
			}

		} else {
			$args = array( 'block' => false );
		}
	
		// Don't block user pages.
		$args['block'] = ( in_array( get_permalink(), $this->user_pages ) ) ? false : $args['block'];

		/**
		 * Filter the block boolean.
		 *
		 * @since 2.7.5
		 *
		 * @param bool  $args['block']
		 * @param array $args {
		 *     An array of arguments used in the function.
		 *
		 *     @type string $post_id
		 *     @type string $post_type
		 *     @type string $block
		 *     @type string $block_meta 
		 *     @tyep string $block_type
		 * }
		 */
		return apply_filters( 'wpmem_block', $args['block'], $args );
	}
	
	/**
	 * The Securify Content Filter.
	 *
	 * This is the primary function that picks up where get_action() leaves off.
	 * Determines whether content is shown or hidden for both post and pages. This
	 * is a filter function for the_content.
	 *
	 * @link https://developer.wordpress.org/reference/functions/the_content/
	 * @link https://developer.wordpress.org/reference/hooks/the_content/
	 *
	 * @since 3.0.0
	 *
	 * @global object $post         The WordPress Post object.
	 * @global string $wpmem_themsg Contains messages to be output.
	 * @param  string $content
	 * @return string $content
	 */
	function do_securify( $content = null ) {

		global $post, $wpmem_themsg;
		
		$orig_content = $content;

		$content = ( is_single() || is_page() ) ? $content : wpmem_do_excerpt( $content );

		if ( $this->regchk == "captcha" ) {
			global $wpmem_captcha_err;
			$wpmem_themsg = wpmem_get_text( 'reg_captcha_err' )  . '<br /><br />' . $wpmem_captcha_err;
		}

		// Block/unblock Posts.
		if ( ! is_user_logged_in() && true == $this->is_blocked() ) {

			// If there is a regchk action, show the login and/or registration forms.
			if ( $this->regchk ) {

				$content = wpmem_get_display_message( $this->regchk, $wpmem_themsg );
				$content .= ( 'loginfailed' == $this->regchk || 'success' == $this->regchk ) ? wpmem_login_form() : wpmem_register_form();

			} else {

				// Toggle shows excerpt above login/reg on posts/pages.
				global $wp_query;
				if ( isset( $wp_query->query_vars['page'] ) && $wp_query->query_vars['page'] > 1 ) {

					// Shuts down excerpts on multipage posts if not on first page.
					$content = '';

				} elseif ( isset( $this->show_excerpt[ $post->post_type ] ) && 1 == $this->show_excerpt[ $post->post_type ] ) {

					// @todo Can this be condensed or eliminated?
					$len = strpos( $content, '<span id="more' );
					if ( false === $len ) {
						$content = wpmem_do_excerpt( $content );
					} else {
						$content = substr( $content, 0, $len );
					}

				} else {

					// Empty all content.
					$content = '';

				}
				
				// Build up default view based on settings.
				$content = $content . wpmem_restricted_message();
				$content = ( isset( $this->show_login[ $post->post_type ] ) && 1 == $this->show_login[ $post->post_type ] ) ? $content . wpmem_login_form()    : $content;
				$content = ( isset( $this->show_reg[   $post->post_type ] ) && 1 == $this->show_reg[   $post->post_type ] ) ? $content . wpmem_register_form() : $content;
			}
			
		// Protects comments if expiration module is used and user is expired.
		} elseif ( is_user_logged_in() && true == $this->is_blocked() ) {

			// Allows for a view of the forms in the Customizer.
			if ( is_customize_preview() ) {

				if ( get_theme_mod( 'wpmem_show_logged_out_state', false ) ) {
					$content = '';
					if ( get_theme_mod( 'wpmem_show_form_message_dialog', false ) ) {
						$content = $this->dialogs->login_failed();
					} else {
						$content = wpmem_restricted_message();
					}
					$content = ( isset( $this->show_login[ $post->post_type ] ) && 1 == $this->show_login[ $post->post_type ] ) ? $content . wpmem_login_form()    : $content;
					$content = ( isset( $this->show_reg[   $post->post_type ] ) && 1 == $this->show_reg[   $post->post_type ] ) ? $content . wpmem_register_form() : $content;
				}
			} else {

				// @todo Test with expired membership.
				if ( 1 == $this->use_exp && function_exists( 'wpmem_do_expmessage' ) ) {
					/**
					 * Filters the user expired message used by the PayPal extension.
					 *
					 * @since 3.2.0
					 *
					 * @param string $message
					 * @param string $content
					 */
					$content = apply_filters( 'wpmem_do_expmessage', wpmem_do_expmessage( $content ), $content );
				}
			}
		}

		/**
		 * Filter the value of $content after wpmem_securify has run.
		 *
		 * @since 2.7.7
		 * @since 3.0.0 Moved to new method in WP_Members Class.
		 * @since 3.4.0 Added $orig_content param.
		 *
		 * @param string $content The content after securify has run.
		 */
		$content = apply_filters( 'wpmem_securify', $content, $orig_content );

		return $content;
		
	}
	
	/**
	 * Securifies the comments.
	 *
	 * If the user is not logged in and the content is blocked
	 * (i.e. $wpmem->is_blocked() returns true), function loads a
	 * dummy/empty comments template.
	 *
	 * @since 2.9.9
	 * @since 3.2.0 Moved wpmem_securify_comments() to main class, renamed.
	 * @since 3.3.2 Added $post_id.
	 *
	 * @param  bool $open    Whether the current post is open for comments.
     * @param  int  $post_id The post ID.
	 * @return bool $open    True if current post is open for comments, otherwise false.
	 */
	function do_securify_comments( $open, $post_id ) {

		$open = ( ! is_user_logged_in() && wpmem_is_blocked( $post_id ) ) ? false : $open;

		/**
		 * Filters whether comments are open or not.
		 *
		 * @since 3.0.0
		 * @since 3.2.0 Moved to main class.
		 * @since 3.3.2 Added $post_id.
		 *
		 * @param bool $open true if current post is open for comments, otherwise false.
		 */
		$open = apply_filters( 'wpmem_securify_comments', $open, $post_id );

		if ( ! $open ) {
			/** This filter is documented in wp-includes/comment-template.php */
			add_filter( 'comments_array', array( $this, 'do_securify_comments_array' ), 10, 2 );
		}

		return $open;
	}
	
	/**
	 * Empties the comments array if content is blocked.
	 *
	 * @since 3.0.1
	 * @since 3.2.0 Moved wpmem_securify_comments_array() to main class, renamed.
	 *
	 * @param  array $comments
	 * @param  int   $post_id
	 * @return array $comments The comments array.
	 */
	function do_securify_comments_array( $comments , $post_id ) {
		// @todo This logic is checked in do_securify_comments() before the filter is added. Is it needed here?
		$comments = ( ! is_user_logged_in() && wpmem_is_blocked( $post_id ) ) ? array() : $comments;
		return $comments;
	}

	/**
	 * Handles REST request.
	 *
	 * @since 3.3.2
	 *
	 * @param WP_REST_Response $response The response object.
	 * @param WP_Post          $post     Post object.
	 * @param WP_REST_Request  $request  Request object.
	 * @return
	 */
	function do_securify_rest( $response, $post, $request ) {
		
		if ( ! is_user_logged_in() ) { // @todo This needs to be changed to check for whether the user has access (for internal requests).
			// Response for restricted content
			$block_value = wpmem_is_blocked( $response->data['id'] );
			if ( $block_value ) {

				/**
				 * 
				 * 
				 * @since 3.4.7
				 * 
				 * @param 
				 * @param WP_REST_Response $response The response object.
				 * @param WP_Post          $post     Post object.
				 * @param WP_REST_Request  $request  Request object. 
				 */
				$drop = apply_filters( "wpmem_securify_rest_{$post->post_type}_drop_response_data", array(), $response, $post, $request );

				foreach ( $drop as $dropped_key ) {
					$response->data[ $dropped_key ] = array();
				}

				if ( isset( $response->data['content']['rendered'] ) ) {
					/**
					 * Filters restricted content message.
					 *
					 * @since 3.3.2
					 * @since 3.3.4 Added $response, $post, and $request
					 *
					 * @param string $message
					 */
					$response->data['content']['rendered'] = apply_filters( "wpmem_securify_rest_{$post->post_type}_content", __( "You must be logged in to view this content.", 'wp-members' ), $response, $post, $request );
				}
				if ( isset( $response->data['excerpt']['rendered'] ) ) {
					/**
					 * Filters restricted excerpt message.
					 *
					 * @since 3.3.2
					 * @since 3.3.4 Added $response, $post, and $request
					 *
					 * @param string $message
					 */
					$response->data['excerpt']['rendered'] = apply_filters( "wpmem_securify_rest_{$post->post_type}_excerpt", __( "You must be logged in to view this content.", 'wp-members' ), $response, $post, $request );
				}
			}

			// Response for hidden content. @todo This needs to be changed to check for whether the user has access (for internal requests).
			if ( ! is_admin() && in_array( $post->ID, $this->hidden_posts() ) ) {
				return new WP_REST_Response( __( 'The page you are looking for does not exist', 'wp-members' ), 404 );
			}
		}
		return $response;
	}
	
	/**
	 * Adds the successful registration message on the login page if reg_nonce validates.
	 *
	 * @since 3.1.7
	 * @since 3.2.0 Moved to wpmem object, renamed reg_securify()
	 *
	 * @param  string $content
	 * @return string $content
	 */
	function reg_securify( $content ) {
		global $wpmem, $wpmem_themsg;
		$nonce = wpmem_get( 'reg_nonce', false, 'get' );
		if ( $nonce && wp_verify_nonce( $nonce, 'register_redirect' ) ) {
			$content = wpmem_get_display_message( 'success', $wpmem_themsg );
			$content = $content . wpmem_login_form();
		}
		return $content;
	}

	/**
	 * Runs if the REST API is initialized.
	 *
	 * @since 3.3.2
	 */
	function rest_init() {
		$this->is_rest = true;
	}
	
	/**
	 * Gets an array of hidden post IDs.
	 *
	 * @since 3.2.0
	 *
	 * @global object $wpdb
	 * @return array  $hidden
	 */
	function hidden_posts() {
		global $wpdb;
		$hidden = get_option( 'wpmem_hidden_posts' );
		if ( false === $hidden ) {
			$hidden = $this->update_hidden_posts();
		}
		return $hidden;
	}
	
	/**
	 * Updates the hidden post array transient.
	 *
	 * @since 3.2.0
	 * @since 3.3.3 Don't include posts from post types not set as handled by WP-Members.
	 *
	 * @global object $wpdb
	 * @return array  $hidden
	 */
	function update_hidden_posts() {
		global $wpdb;
		$hidden  = array();
		$default_post_types = array( 'post'=>'Posts', 'page'=>'Page' );
		$post_types = array_merge( $this->post_types, $default_post_types );
		// $results = $wpdb->get_results( "SELECT post_id FROM " . $wpdb->prefix . "postmeta WHERE meta_key = '_wpmem_block' AND meta_value = 2" );
		$results = $wpdb->get_results( 
			"SELECT
				p1.id,
				p1.post_type,
				m1.meta_key AS _wpmem_block
			FROM " . $wpdb->prefix . "posts p1
			JOIN " . $wpdb->prefix . "postmeta m1 ON (m1.post_id = p1.id AND m1.meta_key = '_wpmem_block') 
			WHERE m1.meta_value = '2';"
		);
		foreach( $results as $result ) {
			if ( array_key_exists( $result->post_type, $post_types ) ) {
				$hidden[] = $result->id;
			}
		}
		update_option( 'wpmem_hidden_posts', $hidden );
		return $hidden;
	}
	
	/**
	 * Gets an array of hidden post IDs.
	 *
	 * @since 3.2.0
	 *
	 * @global stdClass $wpdb
	 * @return array    $hidden
	 */
	function get_hidden_posts() {
		$hidden = array();
		
		// Return empty array if this is the admin and user can edit posts.
		if ( is_admin() && current_user_can( 'edit_posts' ) ) {
			return $hidden;
		}
	
		// If the user is not logged in, return all hidden posts.
		if ( ! is_user_logged_in() ) {
			$hidden = $this->hidden_posts();
		} else {
			// If the user is logged in.
			if ( 1 == $this->enable_products ) {
				// Get user product access.
				$hidden = $this->hidden_posts();
				$hidden = ( is_array( $hidden ) ) ? $hidden : array();

				// Remove posts with a product the user has access to.
				foreach ( $this->membership->products as $key => $value ) {
					if ( isset( $this->user->access[ $key ] ) && ( true == $this->user->access[ $key ] || $this->user->is_current( $this->user->access[ $key ] ) ) ) {
						foreach ( $hidden as $post_id ) {
							if ( 1 == get_post_meta( $post_id, wpmem_get_membership_meta( $key ), true ) ) {
								$hidden_key = array_search( $post_id, $hidden );
								unset( $hidden[ $hidden_key ] );	
							}
						}
					}
				}

				// Remove posts that don't have a product assignment (general login).
				foreach( $hidden as $hidden_key ) {
					$unattached = get_post_meta( $hidden_key, '_wpmem_products', true );												   
					if ( false == $unattached ) {
						$hidden_key = array_search( $hidden_key, $hidden );
						unset( $hidden[ $hidden_key ] );
					}
				}
			}
		}
		/**
		 * Filter the hidden posts array.
		 *
		 * @since 3.3.4
		 *
		 * @param array $hidden
		 */
		return apply_filters( 'wpmem_hidden_posts', $hidden );
	}

	/**
	 * Hides posts based on settings and meta.
	 *
	 * @since 3.2.0
	 *
	 * @param  array  $query
	 * @return array  $query
	 */
	function do_hide_posts( $query ) {
		$hidden_posts = $this->get_hidden_posts();
		if ( ! empty( $hidden_posts ) ) {
			// Add hidden posts to post__not_in while maintaining any existing exclusions.
			$post__not_in = ( ! isset( $query->query_vars['post__not_in'] ) ) ? $hidden_posts : array_merge( $query->query_vars['post__not_in'], $hidden_posts );
			/**
			 * Filter post__not_in.
			 *
			 * @since 3.3.4
			 *
			 * @param array $post__not_in
			 */
			$post__not_in = apply_filters( 'wpmem_post__not_in', $post__not_in );
			$query->set( 'post__not_in', $post__not_in );
		}
		return $query;
	}

	/**
	 * Filter to hide pages for get_pages().
	 *
	 * @since 3.2.0
	 *
	 * @global object $wpdb
	 * @param  array  $pages
	 * @return array  $pages
	 */
	function filter_get_pages( $pages ) {
		$hidden_posts = $this->get_hidden_posts();
		if ( ! empty ( $hidden_posts ) ) {
			$new_pages = array();
			foreach ( $pages as $key => $page ) {
				if ( ! in_array( $page->ID, $hidden_posts ) ) {
					$new_pages[ $key ] = $page;
				}
			}
			$pages = $new_pages;
		}
		return $pages;
	}

	/**
	 * Filter to hide menu items.
	 *
	 * @since 3.2.0
	 *
	 * @param  array  $items
	 * @param         $menu
	 * @param  array  $args
	 * @return array  $items
	 */
	function filter_nav_menu_items( $items, $menu, $args ) {
		$hidden_posts = $this->get_hidden_posts();
		if ( ! empty( $hidden_posts ) ) {
			foreach ( $items as $key => $item ) {
				if ( in_array( $item->object_id, $hidden_posts ) ) {
					unset( $items[ $key ] );
				}
			}
		}
		return $items;
	}

	/**
	 * Filter to remove hidden posts from prev/next links.
	 *
	 * @since 3.2.4
	 *
	 * @global object $wpmem
	 * @param  string $where
	 * @return string $where
	 */
	function filter_get_adjacent_post_where( $where ) {
		global $wpmem;
		if ( ! is_user_logged_in() ) {
			$hidden_posts = $this->get_hidden_posts();
			if ( ! empty( $hidden_posts ) ) {
				$hidden = implode( ",", $hidden_posts );	
				$where  = $where . " AND p.ID NOT IN ( $hidden )";
			}
		}
		return $where;
	}
	
	/**
	 * Set page locations.
	 *
	 * Handles numeric page IDs while maintaining
	 * compatibility with old full url settings.
	 *
	 * @since 3.0.8
	 */
	function load_user_pages() {
		foreach ( $this->user_pages as $key => $val ) { 
			if ( is_numeric( $val ) ) {
				if ( false !== get_post_status( $val ) ) {
					$this->user_pages[ $key ] = get_page_link( $val );
				} else {
					$notice = sprintf( __( 'You have a linked page in the WP-Members page settings that corresponds to a post ID that no longer exists. Please %s review and update the %s page settings %s.', 'wp-members' ), '<a href="' . esc_url( get_admin_url() . '/options-general.php?page=wpmem-settings&tab=options' ) . '">', $key, '</a>' );
					$this->admin_notices[] = array(
						'type'=>'error',
						'notice'=>$notice
					); 
				}
			}
		}
	}
	
	/**
	 * Sets the stylesheet URL.
	 *
	 * @since 3.3.0
	 */
	function set_style() {
		$this->cssurl = ( 'use_custom' == $this->select_style ) ? $this->cssurl : $this->url . 'assets/css/forms/' . $this->select_style . wpmem_get_suffix() . '.css'; // Set the stylesheet.
	}
	
	/**
	 * Returns a requested text string.
	 *
	 * This function manages all of the front-end facing text.
	 * All defaults can be filtered using wpmem_default_text_strings.
	 *
	 * @since 3.1.0
	 *
	 * @global object $wpmem
	 *
	 * @param  string $str
	 * @return string $text
	 */	
	function get_text( $str ) {
		global $wpmem;
		return $wpmem->dialogs->get_text( $str );
	} // End of get_text().
	
	/**
	 * Initializes the WP-Members widget.
	 *
	 * @since 3.2.0 Replaces widget_wpmemwidget_init
	 */
	public function widget_init() {
		// Register the WP-Members widget.
		register_widget( 'widget_wpmemwidget' );
	}
	
	/**
	 * Adds WP-Members query vars to WP's public query vars.
	 *
	 * @since 3.2.0
	 *
	 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
	 *
	 * @param	array	$qvars
	 */
	public function add_query_vars ( $qvars ) {
		$qvars[] = 'a'; // The WP-Members action variable.
		return $qvars;
	}
	
	/**
	 * Enqueues login/out script for the footer.
	 *
	 * @since 3.2.0
	 */
	public function loginout_script() {
		if ( is_user_logged_in() ) {
			wp_enqueue_script( 'jquery' );
			add_action( 'wp_footer', array( $this, 'do_loginout_script' ), 50 );
		}
	}
	
	/**
	 * Outputs login/out script for the footer.
	 *
	 * @since 3.2.0
	 *
	 * @global object $wpmem
	 */
	public function do_loginout_script() {
		global $wpmem;
		/** This filter is defined in /includes/api/api.php */
		$logout = apply_filters( 'wpmem_logout_link', add_query_arg( 'a', 'logout' ) );
		?><script type="text/javascript">
			jQuery('.wpmem_loginout').html('<a class="login_button" href="<?php echo esc_url( $logout ); ?>"><?php echo $this->get_text( 'menu_logout' ); ?></a>');
		</script><?php
	}
		
	/**
	 * Adds WP-Members controls to the Customizer
	 *
	 * @since 3.2.0
	 *
	 * @param object $wp_customize The Customizer object.
	 */
	function customizer_settings( $wp_customize ) {
		$wp_customize->add_section( 'wp_members' , array(
			'title'      => 'WP-Members',
			'priority'   => 190,
		) );

		// Add settings for output description
		$wp_customize->add_setting( 'wpmem_show_logged_out_state', array(
			'default'    => '1',
			'type'       => 'theme_mod', //'option'
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
		) );

		// Add settings for output description
		$wp_customize->add_setting( 'wpmem_show_form_message_dialog', array(
			'default'    => '1',
			'type'       => 'theme_mod', //'option'
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
		) );

		// Add control and output for select field
		$wp_customize->add_control( 'wpmem_show_form_logged_out', array(
			'label'      => __( 'Show forms as logged out', 'wp-members' ),
			'section'    => 'wp_members',
			'settings'   => 'wpmem_show_logged_out_state',
			'type'       => 'checkbox',
			'std'        => '1'
		) );
		
		// Add control for showing dialog
		$wp_customize->add_control( 'wpmem_show_form_dialog', array(
			'label'      => __( 'Show form message dialog', 'wp-members' ),
			'section'    => 'wp_members',
			'settings'   => 'wpmem_show_form_message_dialog',
			'type'       => 'checkbox',
			'std'        => '0'
		) );
	}
	
	/**
	 * Loads the stylesheet for tableless forms.
	 *
	 * @since 2.6
	 * @since 3.2.3 Moved to WP_Members class.
	 *
	 * @global object $wpmem The WP_Members object. 
	 */
	function enqueue_style() {
		global $wpmem;
		wp_enqueue_style ( 'wp-members', wpmem_force_ssl( $wpmem->cssurl ), false, $wpmem->version );
	}

	/**
	 * Loads the wp-login.php stylesheet.
	 *
	 * @since 3.3.0
	 *
	 * @global stdClass $wpmem
	 */
	function enqueue_style_wp_login() {
		global $wpmem;
		wp_enqueue_style( 'wp-members', $wpmem->url . 'assets/css/wp-login' . wpmem_get_suffix() . '.css', false, $wpmem->version );
	}
	
	/**
	 * Creates an excerpt on the fly if there is no 'more' tag.
	 *
	 * @since 2.6
	 * @since 3.2.3 Moved to WP_Members class.
	 * @since 3.2.5 Check if post object exists.
	 *
	 * @global object $post  The post object.
	 * @global object $wpmem The WP_Members object.
	 *
	 * @param  string $content
	 * @return string $content
	 */
	function do_excerpt( $content ) {

		global $post, $more, $wpmem;
		
		if ( is_object( $post ) ) {
			
			$post_id   = $post->ID;
			$post_type = $post->post_type;

			$autoex = ( isset( $wpmem->autoex[ $post->post_type ] ) && 1 == $wpmem->autoex[ $post->post_type ]['enabled'] ) ? $wpmem->autoex[ $post->post_type ] : false;

			// Is there already a 'more' link in the content?
			$has_more_link = ( stristr( $content, 'class="more-link"' ) ) ? true : false;

			// If auto_ex is on.
			if ( $autoex ) {

				// Build an excerpt if one does not exist.
				if ( ! $has_more_link ) {

					$is_singular = ( is_singular( $post->post_type ) ) ? true : false;

					if ( $is_singular ) {
						// If it's a single post, we don't need the 'more' link.
						$more_link_text = '';
						$more_link      = '';
					} else {
						// The default $more_link_text.
						if ( isset( $wpmem->autoex[ $post->post_type ]['text'] ) && '' != $wpmem->autoex[ $post->post_type ]['text'] ) {
							$more_link_text = __( $wpmem->autoex[ $post->post_type ]['text'], 'wp-members' );
						} else {
							$more_link_text = __( '(more&hellip;)' );
						}
						// The default $more_link.
						$more_link = ' <a href="'. get_permalink( $post->ID ) . '" class="more-link">' . $more_link_text . '</a>';
					}

					// Apply the_content_more_link filter if one exists (will match up all 'more' link text).
					/** This filter is documented in /wp-includes/post-template.php */
					$more_link = apply_filters( 'the_content_more_link', $more_link, $more_link_text );

					$defaults = array(
						'length'           => $autoex['length'],
						'more_link'        => $more_link,
						'blocked_only'     => false,
					);
					/**
					 * Filter auto excerpt defaults.
					 *
					 * @since 3.0.9
					 * @since 3.1.5 Deprecated add_ellipsis, strip_tags, close_tags, parse_shortcodes, strip_shortcodes.
					 *
					 * @param array {
					 *     An array of settings to override the function defaults.
					 *
					 *     @type int         $length           The default length of the excerpt.
					 *     @type string      $more_link        The more link HTML.
					 *     @type boolean     $blocked_only     Run autoexcerpt only on blocked content. default: false.
					 * }
					 * @param string $post->ID        The post ID.
					 * @param string $post->post_type The content's post type.					 
					 */
					$args = apply_filters( 'wpmem_auto_excerpt_args', $defaults, $post->ID, $post->post_type );

					// Merge settings.
					$args = wp_parse_args( $args, $defaults );

					// Are we only excerpting blocked content?
					if ( $args['blocked_only'] ) {
						$post_meta = get_post_meta( $post->ID, '_wpmem_block', true );
						if ( 1 == $wpmem->block[ $post->post_type ] ) {
							// Post type is blocked, if post meta unblocks it, don't do excerpt.
							$do_excerpt = ( "0" == $post_meta ) ? false : true;
						} else {
							// Post type is unblocked, if post meta blocks it, do excerpt.
							$do_excerpt = ( "1" == $post_meta ) ? true : false;
						} 
					} else {
						$do_excerpt = true;
					}

					if ( true === $do_excerpt ) {
						$content = ( $args['length'] > 0 ) ? wp_trim_words( $content, $args['length'], $args['more_link'] ) : '';
						// Check if the more link was added (note: singular has no more_link):
						if ( ! $is_singular && ! strpos( $content, $args['more_link'] ) ) {
							$content = $content . $args['more_link'];
						}
					}
				}
			}
		} else {
			$post_id   = false;
			$post_type = false;
		}

		/**
		 * Filter the auto excerpt.
		 *
		 * @since 2.8.1
		 * @since 3.0.9 Added post ID and post type parameters.
		 * @since 3.2.5 Post ID and post type may be false if there is no post object.
		 * 
		 * @param string $content   The content excerpt.
		 * @param string $post_id   The post ID.
		 * @param string $post_type The content's post type.
		 */
		$content = apply_filters( 'wpmem_auto_excerpt', $content, $post_id, $post_type );

		// Return the excerpt.
		return $content;
	}

	/**
	 * Convert form tag.
	 *
	 * @todo This is temporary to handle form tag conversion.
	 *
	 * @since 3.1.7
	 * @since 3.2.3 Moved to WP_Members class.
	 * @since 3.3.0 Removed unnecessary tags.
	 *
	 * @param  string $tag
	 * @return string $tag
	 */
	function convert_tag( $tag ) {
		switch ( $tag ) {
			case 'new':
				return 'register';
				break;
			case 'edit':
			case 'update':
				return 'profile';
				break;
			default:
				return $tag;
				break;
		}
		return $tag;
	}

	/**
	 * Loads translation files.
	 *
	 * @since 3.0.0
	 * @since 3.2.5 Moved to main object, dropped wpmem_ stem.
	 */
	function load_textdomain() {

		// Plugin textdomain.
		$domain = 'wp-members';

		// Wordpress locale.
		/** This filter is documented in wp-includes/l10n.php */
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		/**
		 * Filter translation file.
		 *
		 * If the translate.wordpress.org language pack is available, it will
		 * be /wp-content/languages/plugins/wp-members-{locale}.mo by default.
		 * You can filter this if you want to load a language pack from a
		 * different location (or different file name).
		 *
		 * @since 3.0.0
		 * @since 3.2.0 Added locale as a parameter.
		 *
		 * @param string $file   The translation file to load.
		 * @param string $locale The current locale.
		 */
		$file = apply_filters( 'wpmem_localization_file', trailingslashit( WP_LANG_DIR ) . 'plugins/' . $domain . '-' . $locale . '.mo', $locale );

		$loaded = load_textdomain( $domain, $file );
		if ( true == $loaded ) {
			return $loaded;
		} else {
			/**
			 * Filter translation directory.
			 *
			 * @since 3.0.3
			 * @since 3.2.0 Added locale as a parameter.
			 *
			 * @param string $dir    The translation directory.
			 * @param string $locale The current locale.
			 */
			$dir = apply_filters( 'wpmem_localization_dir', basename( $this->path ) . '/i18n/languages/', $locale );
			load_plugin_textdomain( $domain, FALSE, $dir );
		}
		return;
	}
	
	/**
	 * Load default tos template.
	 *
	 * @since 3.2.8
	 */
	function load_default_tos() {
		// Check for custom template or load default.
		$custom_template = get_stylesheet_directory() . '/wp-members/templates/tos.php';
		if ( file_exists( $custom_template ) ) {
			require_once $custom_template;
		} else {
			require_once $this->path . 'templates/tos.php';
		}
	}

	/**
	 * Builds defaults for login/out links/buttons.
	 *
	 * @since 3.3.5
	 *
	 * @param  array  $args
	 * @return string $html
	 */
	function loginout_args( $args = array() ) {
		$defaults = array(
			'format'             => ( isset( $args['format']             ) ) ? $args['format']             : 'link',
			'login_redirect_to'  => ( isset( $args['login_redirect_to']  ) ) ? $args['login_redirect_to']  : wpmem_current_url(),
			'logout_redirect_to' => ( isset( $args['logout_redirect_to'] ) ) ? $args['logout_redirect_to'] : wpmem_current_url(), // @todo - This is not currently active.
			'login_text'         => ( isset( $args['login_text']         ) ) ? $args['login_text']         : __( 'log in',  'wp-members' ),
			'logout_text'        => ( isset( $args['logout_text']        ) ) ? $args['logout_text']        : __( 'log out', 'wp-members' ),
			'class'              => ( isset( $args['class']              ) ) ? $args['class']              : 'wpmem_loginout_link',
			'id'                 => ( isset( $args['id']                 ) ) ? $args['id']                 : 'wpmem_loginout_link',
		);
		$args     = wp_parse_args( $args, $defaults );
		$redirect = ( is_user_logged_in() ) ? $args['logout_redirect_to'] : $args['login_redirect_to'];
		$text     = ( is_user_logged_in() ) ? $args['logout_text']        : $args['login_text'];
		if ( is_user_logged_in() ) {
			/** This filter is defined in /includes/api/api.php */
			$link = apply_filters( 'wpmem_logout_link', add_query_arg( 'a', 'logout' ) );
		} else {
			$link = wpmem_login_url( $redirect );
		}
		
		if ( 'button' == $args['format'] ) {
			$html = '<form action="' . $link . '" id="' . $args['id'] . '" class="' . $args['class'] . '">';
			$html.= ( is_user_logged_in() ) ? '<input type="hidden" name="a" value="logout" />' : '';
			$html.= '<input type="submit" value="' . $text . '" /></form>';
		} else {
			$html = sprintf( '<a href="%s" id="%s" class="%s">%s</a>', $link, $args['id'], $args['class'], $text );
		}
		return $html;
	}

	/**
	 * Filters the password URL to point to the WP-Members process.
	 *
	 * @since 3.3.5
	 */
	function lost_pwd_url( $lostpwd_url, $redirect ) {
		return wpmem_profile_url( 'pwdreset' );
	}
	
	/**
	 * Google recaptcha v3 (invisible) gives more accurate user scores
	 * if it is loaded on all pages.
	 *
	 * @since 3.4.0
	 */
	function invisible_captcha() {
		if ( 4 == $this->captcha && true !== wpmem_is_reg_form_showing() ) {
			echo WP_Members_Captcha::show();
		}
	}

	/**
	 * Check for errors.
	 * 
	 * @since 3.4.6
	 * @since 3.4.8 Check as WP_Error (use is_wp_error()).
	 */
	public function has_errors() {
		return ( is_wp_error( $this->error ) && $this->error->has_errors() ) ? true : false;
	}
} // End of WP_Members class.