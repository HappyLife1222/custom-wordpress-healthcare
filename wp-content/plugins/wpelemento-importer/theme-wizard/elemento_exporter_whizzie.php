<?php
/**
 * Wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */
class WPElemento_Importer_ThemeWhizzie {
    public static $is_valid_key = 'false';
    public static $theme_key = '';
    protected $version = '1.1.0';
    /** @var string Current theme name, used as namespace in actions. */
    protected $plugin_name = '';
    protected $plugin_title = '';
    /** @var string Wizard page slug and title. */
    protected $page_slug = '';
    protected $page_title = '';
    protected $page_heading = '';
    protected $plugin_path = '';
    protected $parent_slug = '';
    /** @var array Wizard steps set by user. */
    protected $config_steps = array();
    /**
     * Relative plugin url for this plugin folder
     * @since 1.0.0
     * @var string
     */
    protected $plugin_url = '';
    /**
     * TGMPA instance storage
     *
     * @var object
     */
    protected $tgmpa_instance;
    /**
     * TGMPA Menu slug
     *
     * @var string
     */
    protected $tgmpa_menu_slug = 'wpelemento-importer-tgmpa-install-plugins';
    /**
     * TGMPA Menu url
     *
     * @var string
     */
    protected $tgmpa_url = 'admin.php?page=wpelemento-importer-tgmpa-install-plugins';
    // Where to find the widget.wie file
    protected $widget_file_url = '';
    /**
     * Constructor
     *
     * @param $wpelemento_importer_config Our config parameters
     */
    public function __construct($wpelemento_importer_config) {
        $this->set_vars($wpelemento_importer_config);
        $this->init();
    }

    public static function get_the_validation_status() {
      return get_option('wpelemento_importer_pro_theme_validation_status');
    }
    public static function set_the_validation_status($is_valid) {
      update_option('wpelemento_importer_pro_theme_validation_status', $is_valid);
    }
    public static function set_the_suspension_status($is_suspended) {
      update_option('wpelemento_importer_pro_suspension_status', $is_suspended);
    }
    public static function set_the_theme_key($the_key) {
      update_option('wp_pro_theme_key', $the_key);
    }
    public static function remove_the_theme_key() {
      delete_option('wp_pro_theme_key');
    }
    public static function get_the_theme_key() {
      return get_option('wp_pro_theme_key');
    }

    /**
     * Set some settings
     * @since 1.0.0
     * @param $wpelemento_importer_config Our config parameters
     */
    public function set_vars($wpelemento_importer_config) {
        require_once trailingslashit(WPELEMENTO_IMPORTER_WHIZZIE_DIR) . 'tgm/tgm.php';
        if (isset($wpelemento_importer_config['page_slug'])) {
            $this->page_slug = esc_attr($wpelemento_importer_config['page_slug']);
        }
        if (isset($wpelemento_importer_config['page_title'])) {
            $this->page_title = esc_attr($wpelemento_importer_config['page_title']);
        }
        if (isset($wpelemento_importer_config['steps'])) {
            $this->config_steps = $wpelemento_importer_config['steps'];
        }
        if (isset($wpelemento_importer_config['page_heading'])) {
            $this->page_heading = esc_attr($wpelemento_importer_config['page_heading']);
        }
        $this->plugin_path = trailingslashit(dirname(__FILE__));
        $relative_url = str_replace(get_template_directory(), '', $this->plugin_path);
        $this->plugin_url = trailingslashit(get_template_directory_uri() . $relative_url);
        $current_plugin = get_plugin_data(EDI_FILE);
        $this->plugin_title = $current_plugin['Name'];
        $this->plugin_name = strtolower(preg_replace('#[^a-zA-Z]#', '', $current_plugin['Name']));
        $this->page_slug = apply_filters($this->plugin_name . '_theme_setup_wizard_page_slug', $this->plugin_name . '-wizard');
        $this->parent_slug = apply_filters($this->plugin_name . '_theme_setup_wizard_parent_slug', '');
    }
    /**
     * Hooks and filters
     * @since 1.0.0
     */
    public function init() {
        add_action('activated_plugin', array($this, 'redirect_to_wizard'), 100, 2);
        if (class_exists('WPELEMENTO_IMPORTER_TGM_Plugin_Activation') && isset($GLOBALS['wpelemento_importer_tgmpa'])) {
            add_action('init', array($this, 'get_tgmpa_instance'), 30);
            add_action('init', array($this, 'set_tgmpa_url'), 40);
        }
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_menu', array($this, 'menu_page'));
        add_action('admin_init', array($this, 'get_plugins'), 30);
        add_filter('wpelemento_importer_tgmpa_load', array($this, 'wpelemento_importer_tgmpa_load'), 10, 1);
        add_action('wp_ajax_setup_plugins', array($this, 'setup_plugins'));
        add_action('wp_ajax_setup_widgets', array($this, 'setup_widgets'));
        add_action('wp_ajax_wpelemento_importer_setup_themes', array($this, 'wpelemento_importer_setup_themes'));
        add_action('wp_ajax_wz_activate_elemento_exporter_pro', array($this, 'wz_activate_elemento_exporter_pro'));
        add_action('wp_ajax_wpelemento_importer_setup_elementor', array($this, 'wpelemento_importer_setup_elementor'));
        add_action('admin_enqueue_scripts', array($this, 'wpelemento_importer_pro_admin_plugin_style'));
    }
    public static function get_the_plugin_key() {
        return get_option('wpelemento_importer_plugin_license_key');
    }
    public function redirect_to_wizard($plugin, $network_wide) {
        global $pagenow;
        if (is_admin() && ('plugins.php' == $pagenow) && current_user_can('manage_options') && (EDI_BASE == $plugin)) {
            wp_redirect(esc_url(admin_url('admin.php?page=' . esc_attr($this->page_slug))));
        }
    }
    public function enqueue_scripts($hook) {
        if ( $hook == 'toplevel_page_' . $this->page_slug ) {
          wp_enqueue_style('theme-wizard-style', EDI_URL . 'theme-wizard/assets/css/theme-wizard-style.css');
          wp_enqueue_script('notify-js', EDI_URL . '/theme-wizard/assets/js/notify.min.js', array('bootstrap-js'));
          wp_register_script('theme-wizard-script', EDI_URL . 'theme-wizard/assets/js/theme-wizard-script.js', array('jquery'), time());
          wp_localize_script('theme-wizard-script', 'wpelemento_importer_pro_whizzie_params', array('ajaxurl' => esc_url(admin_url('admin-ajax.php')), 'wpnonce' => wp_create_nonce('whizzie_nonce'), 'verify_text' => esc_html('verifying', 'wpelemento-importer')));
          wp_enqueue_script('theme-wizard-script');
          wp_localize_script('elementor-exporter-wizard-script', 'wpelemento_importer_wizard_script_params', array(
            'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
            'admin_url' => esc_url(admin_url()),
            'site_url' => esc_url(site_url()),
            'wpnonce' => wp_create_nonce('wpelemento_importer_whizzie_nonce'),
            'verify_text' => esc_html(' verifying', WPELEMENTO_IMPORTER_TEXT_DOMAIN),
            'pro_badge' => esc_url(EDI_URL . 'whizzie/assets/img/pro-badge.svg'))
          );
          wp_enqueue_script('elementor-exporter-wizard-script');
          wp_enqueue_script('tabs', EDI_URL . 'theme-wizard/assets/js/tab.js');
          wp_enqueue_script('wp-notify-popup', EDI_URL . 'theme-wizard/assets/js/notify.min.js');
        }
    }
    public static function get_instance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function wpelemento_importer_tgmpa_load($status) {
        return is_admin() || current_user_can('install_themes');
    }
    /**
     * Get configured TGMPA instance
     *
     * @access public
     * @since 1.1.2
     */
    public function get_tgmpa_instance() {
        $this->tgmpa_instance = call_user_func(array(get_class($GLOBALS['wpelemento_importer_tgmpa']), 'get_instance'));
    }
    /**
     * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
     *
     * @access public
     * @since 1.1.2
     */
    public function set_tgmpa_url() {
        $this->tgmpa_menu_slug = (property_exists($this->tgmpa_instance, 'menu')) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
        $this->tgmpa_menu_slug = apply_filters($this->plugin_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug);
        $tgmpa_parent_slug = (property_exists($this->tgmpa_instance, 'parent_slug') && $this->tgmpa_instance->parent_slug !== 'plugin.php') ? 'admin.php' : 'plugin.php';
        $this->tgmpa_url = apply_filters($this->plugin_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug);
    }
    /**
     * Make a modal screen for the wizard
     */
    public function menu_page() {
        add_menu_page(esc_html($this->page_title), esc_html($this->page_title), 'manage_options', $this->page_slug, array($this, 'wpelemento_importer_pro_mostrar_guide'), 'dashicons-admin-plugins', 40);
    }
    public function activation_page() {
      if(defined('GET_PREMIUM_THEME')){
        $theme_key = WPElemento_Importer_ThemeWhizzie::get_the_theme_key();
        $validation_status = WPElemento_Importer_ThemeWhizzie::get_the_validation_status();
        ?>
        <div class="wee-wrap">
          <label><?php esc_html_e('Enter Your Theme License Key:', 'wpelemento-importer'); ?></label>
          <form id="wpelemento_importer_pro_license_form">
            <input type="text" name="wpelemento_importer_pro_license_key" value="<?php esc_attr_e($theme_key) ?>" <?php if ($validation_status === 'true') {
              esc_html("disabled");
            } ?> required placeholder="License Key" />
            <div class="licence-key-button-wrap">
              <button class="button" type="submit" name="button" <?php if ($validation_status === 'true') {
                esc_html("disabled");
              } ?>>
              <?php if ($validation_status === 'true') {
                ?>
                Activated
                <?php
              } else { ?>
                Activate
                <?php
              }
              ?>
            </button>
            <?php if ($validation_status === 'true') { ?>
              <button id="change--key" class="button" type="button" name="button">
                Change Key
              </button>
              <div class="next-button">
                <button id="start-now-next" class="button" type="button" name="button" onclick="openCity(event, 'wee_demo_offer')">
                  Next
                </button>
              </div>
              <?php
            } ?>
          </div>
        </form>
      </div>
      <?php
    }else{
      echo "string";
    }
  }
  /**
  * Make an interface for the wizard
  */
  public function wizard_page() {
    tgmpa_load_bulk_installer();
    if (!class_exists('WPELEMENTO_IMPORTER_TGM_Plugin_Activation') || !isset($GLOBALS['wpelemento_importer_tgmpa'])) {
      die('Failed to find TGM');
    }
    $url = wp_nonce_url(add_query_arg(array('plugins' => 'go')), 'whizzie-setup');
    $method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
    $fields = array_keys($_POST); // Extra fields to pass to WP_Filesystem.
    if (false === ($creds = request_filesystem_credentials(esc_url_raw($url), $method, false, false, $fields))) {
      return true; // Stop the normal page form from displaying, credential request form will be shown.
    }
    // Now we have some credentials, setup WP_Filesystem.
    if (!WP_Filesystem($creds)) {
      // Our credentials were no good, ask the user for them again.
      request_filesystem_credentials(esc_url_raw($url), $method, true, false, $fields);
      return true;
    }
    /* If we arrive here, we have the filesystem */
    ?>
    <div class="wee-wrap">
      <div class="wee-wizard-logo-wrap">
        <span class="wee-wizard-main-title">
          <?php esc_html_e('Quick Setup ', 'wpelemento-importer'); ?>
        </span>
      </div>
      <?php echo '<div class="card wee-whizzie-wrap">';
      // The wizard is a list with only one item visible at a time
      $steps = $this->get_steps();
      echo '<ul class="whizzie-menu wp-wizard-menu-page">';
      foreach ($steps as $step) {
        $class = 'step step-' . esc_attr($step['id']);
        echo '<li data-step="' . esc_attr($step['id']) . '" class="' . esc_attr($class) . '" >';
        printf('<span class="wee-wizard-main-title">%s</span>', esc_html($step['title']));
        // $content is split into summary and detail
        $content = call_user_func(array($this, $step['view']));
        if (isset($content['summary'])) {
          printf('<div class="summary">%s</div>', wp_kses_post($content['summary']));
        }
        if (isset($content['detail'])) {
          // Add a link to see more detail
          printf('<div class="wz-require-plugins">');
          printf('<div class="detail">%s</div>', $content['detail'] // Need to escape this
        );
        printf('</div>');
      }
      printf('<div class="wizard-button-wrapper">');
      if(defined('GET_PREMIUM_THEME')){
        if (WPElemento_Importer_ThemeWhizzie::get_the_validation_status() === 'true') {
          if (isset($step['button_text']) && $step['button_text'] && isset($step['multiple'])) {
            echo "<div class='multiple-home-page-imports'>";
            foreach ($step['multiple'] as $import) {
              $button_html = '<div class="button-wrap">
              <a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s" data-slug="' . $import['slug'] . '">
              <img src="' . $import['card_image'] . '" />
              <p class="themes-name"> %s </p>
              </a>
              </div>';
              printf($button_html, esc_attr($step['callback']), esc_attr($step['id']), esc_html($import['card_text']));
            }
            echo "</div>";
          } elseif (isset($step['button_text']) && $step['button_text']) {
            printf('<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>', esc_attr($step['callback']), esc_attr($step['id']), esc_html($step['button_text']));
          }
          if (isset($step['button_text_one'])) {
            printf('<div class="button-wrap button-wrap-one">
            <a href="#" class="button button-primary do-it" data-callback="install_widgets" data-step="widgets"><img src="' . get_template_directory_uri() . '/theme-wizard/assets/images/Customize-Icon.png"></a>
            <p class="demo-type-text">%s</p>
            </div>', esc_html($step['button_text_one']));
          }
          if (isset($step['button_text_two'])) {
            printf('<div class="button-wrap button-wrap-two">
            <a href="#" class="button button-primary do-it" data-callback="page_builder" data-step="widgets"><img src="' . get_template_directory_uri() . '/theme-wizard/assets/images/Gutenberg-Icon.png"></a>
            <p class="demo-type-text">%s</p>
            </div>', esc_html($step['button_text_two']));
          }
        } else {
          printf('<div class="button-wrap"><a href="#" class="button button-primary key-activation-tab-click">%s</a></div>', esc_html(__('Activate Your License', 'wpelemento-importer')));
        }
      }else{
        if (isset($step['button_text']) && $step['button_text'] && isset($step['multiple'])) {
          echo "<div class='multiple-home-page-imports'>";
          foreach ($step['multiple'] as $import) {
            $button_html = '<div class="button-wrap">
            <a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s" data-slug="' . $import['slug'] . '">
            <img src="' . $import['card_image'] . '" />
            <p class="themes-name"> %s </p>
            </a>
            </div>';
            printf($button_html, esc_attr($step['callback']), esc_attr($step['id']), esc_html($import['card_text']));
          }
          echo "</div>";
        } elseif (isset($step['button_text']) && $step['button_text']) {
          printf('<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>', esc_attr($step['callback']), esc_attr($step['id']), esc_html($step['button_text']));
        }
        if (isset($step['button_text_one'])) {
          printf('<div class="button-wrap button-wrap-one">
          <a href="#" class="button button-primary do-it" data-callback="install_widgets" data-step="widgets"><img src="' . get_template_directory_uri() . '/theme-wizard/assets/images/Customize-Icon.png"></a>
          <p class="demo-type-text">%s</p>
          </div>', esc_html($step['button_text_one']));
        }
        if (isset($step['button_text_two'])) {
          printf('<div class="button-wrap button-wrap-two">
          <a href="#" class="button button-primary do-it" data-callback="page_builder" data-step="widgets"><img src="' . get_template_directory_uri() . '/theme-wizard/assets/images/Gutenberg-Icon.png"></a>
          <p class="demo-type-text">%s</p>
          </div>', esc_html($step['button_text_two']));
        }
      }


      printf('</div>');
      echo '</li>';
    }
    echo '</ul>';
    echo '<ul class="wee-whizzie-nav wizard-icon-nav">';
    $stepI = 1;
    foreach ($steps as $step) {
      $stepAct = ($stepI == 1) ? 1 : 0;
      if (isset($step['icon_url']) && $step['icon_url']) {
        echo '<li class="nav-step-' . esc_attr($step['id']) . '" wizard-steps="step-' . esc_attr($step['id']) . '" data-enable="' . esc_attr($stepAct) . '">
        <img src="' . esc_attr($step['icon_url']) . '">
        </li>';
      }
      $stepI++;
    }
    echo '</ul>';
    ?>
    <div class="step-loading"><span class="spinner">
      <img src="<?php echo esc_url(EDI_URL . 'theme-wizard/assets/images/spinner-animaion.gif'); ?>">
    </span></div>
    <?php echo '</div>'; ?>
  </div>
  <?php
  }
  public function get_step_widgets() { ?>
    <div class="summary">
      <p>
        <?php esc_html_e('Click the below button to import the demo content using Elementor.', 'wpelemento-importer'); ?>
      </p>
    </div>
    <?php
  }
    /**
     * Set options for the steps
     * Incorporate any options set by the theme dev
     * Return the array for the steps
     * @return Array
     */
     public function get_steps() {
       $dev_steps = $this->config_steps;
       $steps = array(
         // secelt themes page start//
         'intro' => array(
           'id'          => 'intro',
           'title'       => __('Welcome to WPElemento Importer', 'wpelemento-importer') ,
           'icon'        => 'dashboard',
           'view'        => 'get_step_intro', // Callback for content
           'callback'    => 'do_next_step', // Callback for JS
           'button_text' => __('Start Now', 'wpelemento-importer'),
           'can_skip'    => false, // Show a skip button?
           'icon_url'    => EDI_URL . 'theme-wizard/assets/images/battery.png'
         ),
         'plugins' => array(
           'id' => 'plugins',
           'title' => __('Plugins', 'wpelemento-importer'),
           'icon' => 'admin-plugins',
           'view' => 'get_step_plugins',
           'callback' => 'install_plugins',
           'button_text' => __('Install Plugins', 'wpelemento-importer'),
           'can_skip' => true,
           'icon_url' => EDI_URL . 'theme-wizard/assets/images/plugin.png'
         ),
         'widgets' => array(
           'id' => 'widgets',
           'title' => __('Demo Importer', 'wpelemento-importer'),
           'icon' => 'welcome-widgets-menus',
           'view' => 'get_step_widgets',
           'callback' => 'install_widgets',
           'button_text' => __('Import Demo', 'wpelemento-importer'),
           'can_skip' => true
         ),
         'done' => array(
           'id' => 'done',
           'title' => __('All Done', 'wpelemento-importer'),
           'icon' => 'yes',
           'view' => 'get_step_done',
           'callback' => '',
           'icon_url' => EDI_URL . 'theme-wizard/assets/images/check-mark.png'));
           // Iterate through each step and replace with dev config values
           if ($dev_steps) {
             // Configurable elements - these are the only ones the dev can update from config.php
             $can_config = array('title', 'icon', 'button_text', 'can_skip', 'button_text_two');
             foreach ($dev_steps as $dev_step) {
               // We can only proceed if an ID exists and matches one of our IDs
               if (isset($dev_step['id'])) {
                 $id = $dev_step['id'];
                 if (isset($steps[$id])) {
                   foreach ($can_config as $element) {
                     if (isset($dev_step[$element])) {
                       $steps[$id][$element] = $dev_step[$element];
                     }
                   }
                 }
               }
             }
           }
           return $steps;
         }
     /**
     * Print the content for the intro step
     */
     public function get_step_intro() { ?>
          <div class="summary">
            <p>
              <?php esc_html_e('Thank you for choosing this WPElemento Importer Pro Plugin. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.', 'wpelemento-importer'); ?>
            </p>
            <p>
              <?php esc_html_e('You may even skip the steps and get back to the dashboard if you have no time at the present moment. You can come back any time if you change your mind.', 'wpelemento-importer'); ?>
            </p>
          </div>
          <?php
        }
     public function get_step_importer() { ?>
       <div class="summary">
         <p>
           <?php esc_html_e('Thank you for choosing this WPElemento Importer Pro Plugin. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.', 'wpelemento-importer'); ?>
         </p>
       </div>
       <?php
     }
    /**
     * Get the content for the plugins step
     * @return $content Array
     */
     public function get_step_plugins() {
       $plugins = $this->get_plugins();
       $content = array(); ?>
       <?php // The detail element is initially hidden from the user
       $content['detail'] = '<span class="wizard-plugin-count">' . count($plugins['all']) . '</span><ul class="whizzie-do-plugins">';
       foreach ($plugins['all'] as $slug => $plugin) {
         $content['detail'].= '<li data-slug="' . esc_attr($slug) . '">' . esc_html($plugin['name']) . '<div class="wizard-plugin-title">';
         $content['detail'].= '<span class="wizard-plugin-status">Installation Required</span><i class="spinner"></i></div></li>';
       }
       $content['detail'].= '</ul>';
       return $content;
     }
    /**
     * Print the content for the final step
     */
     public function get_step_done() { ?>
       <div class="wp-setup-finish">
         <p>
           <?php echo esc_html('Your demo content has been imported successfully . Click on the finish button for more information.'); ?>
         </p>
         <div class="finish-buttons">
           <a href="<?php echo esc_url(admin_url('/customize.php')); ?>" class="wz-btn-customizer" target="_blank"><?php esc_html_e('Customize Your Demo', 'wpelemento-importer') ?></a>
           <a href="" class="wz-btn-builder" target="_blank"><?php esc_html_e('Customize Your Demo', 'wpelemento-importer'); ?></a>
           <a href="<?php echo esc_url(site_url()); ?>" class="wz-btn-visit-site" target="_blank"><?php esc_html_e('Visit Your Site', 'wpelemento-importer'); ?></a>
         </div>
         <div class="wp-finish-btn">
           <a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary" onclick="openCity(event, 'theme_info')" data-tab="theme_info" >Finish</a>
         </div>
       </div>
       <?php
     }
    /**
     * Get the plugins registered with TGMPA
     */
     public function get_plugins() {
       $instance = call_user_func(array(get_class($GLOBALS['wpelemento_importer_tgmpa']), 'get_instance'));
       $new_instance_plugins = $instance->plugins;

       $plugins = array('all' => array(), 'install' => array(), 'update' => array(), 'activate' => array());
       foreach ($new_instance_plugins as $slug => $plugin) {
         if ($instance->is_plugin_active($slug) && false === $instance->does_plugin_have_update($slug)) {
           // Plugin is installed and up to date
           continue;
         } else {
           $plugins['all'][$slug] = $plugin;
           if (!$instance->is_plugin_installed($slug)) {
             $plugins['install'][$slug] = $plugin;
           } else {
             if (false !== $instance->does_plugin_have_update($slug)) {
               $plugins['update'][$slug] = $plugin;
             }
             if ($instance->can_plugin_activate($slug)) {
               $plugins['activate'][$slug] = $plugin;
             }
           }
         }
       }
       return $plugins;
     }
     public function setup_plugins() {
       if (!check_ajax_referer('whizzie_nonce', 'wpnonce') || empty($_POST['slug'])) {
         wp_send_json_error(array('error' => 1, 'message' => esc_html__('No Slug Found', 'wpelemento-importer')));
       }
       $json = array();
       // send back some json we use to hit up TGM
       $plugins = $this->get_plugins();
       // what are we doing with this plugin?
       foreach ($plugins['activate'] as $slug => $plugin) {
         if ($_POST['slug'] == $slug) {
           $json = array('url' => esc_url(admin_url($this->tgmpa_url)),
            'plugin' => array($slug), 'tgmpa-page' => $this->tgmpa_menu_slug, 'plugin_status' => 'all', '_wpnonce' => wp_create_nonce('bulk-plugins'), 'action' => 'tgmpa-bulk-activate', 'action2' => - 1, 'message' => esc_html__('Activating Plugin', 'wpelemento-importer')
          );
           break;
         }
       }
       foreach ($plugins['update'] as $slug => $plugin) {
         if ($_POST['slug'] == $slug) {
           $json = array('url' => esc_url(admin_url($this->tgmpa_url)),
            'plugin' => array($slug), 'tgmpa-page' => $this->tgmpa_menu_slug, 'plugin_status' => 'all', '_wpnonce' => wp_create_nonce('bulk-plugins'), 'action' => 'wpelemento-importer-tgmpa-bulk-update', 'action2' => - 1, 'message' => esc_html__('Updating Plugin', 'wpelemento-importer')
          );
           break;
         }
       }
       foreach ($plugins['install'] as $slug => $plugin) {
         if ($_POST['slug'] == $slug) {
           $json = array('url' => esc_url(admin_url($this->tgmpa_url)),
            'plugin' => array($slug), 'tgmpa-page' => $this->tgmpa_menu_slug, 'plugin_status' => 'all', '_wpnonce' => wp_create_nonce('bulk-plugins'), 'action' => 'wpelemento-importer-tgmpa-bulk-install', 'action2' => - 1, 'message' => esc_html__('Installing Plugin', 'wpelemento-importer')
          );
           break;
         }
       }
       delete_transient('elementor_activation_redirect');
       if ($json) {
         $json['hash'] = md5(serialize($json)); // used for checking if duplicates happen, move to next plugin
         wp_send_json($json);
       } else {
         wp_send_json(array('done' => 1, 'message' => esc_html__('Success', 'wpelemento-importer')));
       }
       exit;
     }

       public function isAssoc(array $arr) {
       if (array() === $arr) return false;
       return array_keys($arr) !== range(0, count($arr) - 1);
     }

     /**
     * Imports the Demo Content
     * @since 1.1.0
     */
       public function setup_widgets() {
       }
       function wz_activate_elemento_exporter_pro() {
         if(defined('GET_PREMIUM_THEME')){
           $wpelemento_importer_pro_license_key = $_POST['wpelemento_importer_pro_license_key'];
           $endpoint = WPEI_THEME_LICENCE_ENDPOINT . 'wpei_client_activate_premium_theme';
           $body = ['theme_license_key' => $wpelemento_importer_pro_license_key, 'site_url' => site_url(), 'theme_text_domain' => wp_get_theme()->get('TextDomain') ];
           $body = wp_json_encode($body);
           $options = ['body' => $body, 'headers' => ['Content-Type' => 'application/json', ]];
           $response = wp_remote_post($endpoint, $options);
           if (is_wp_error($response)) {
             WPElemento_Importer_ThemeWhizzie::remove_the_theme_key();
             WPElemento_Importer_ThemeWhizzie::set_the_validation_status('false');
             $response = array('status' => false, 'msg' => 'Something Went Wrong!');
             wp_send_json($response);
             exit;
           } else {
             $response_body = wp_remote_retrieve_body($response);
             $response_body = json_decode($response_body);
             if ($response_body->is_suspended == 1) {
               WPElemento_Importer_ThemeWhizzie::set_the_suspension_status('true');
             } else {
               WPElemento_Importer_ThemeWhizzie::set_the_suspension_status('false');
             }
             if ($response_body->status === false) {
               WPElemento_Importer_ThemeWhizzie::remove_the_theme_key();
               WPElemento_Importer_ThemeWhizzie::set_the_validation_status('false');
               $response = array('status' => false, 'msg' => $response_body->msg);
               wp_send_json($response);
               exit;
             } else {
               WPElemento_Importer_ThemeWhizzie::set_the_validation_status('true');
               WPElemento_Importer_ThemeWhizzie::set_the_theme_key($wpelemento_importer_pro_license_key);
               $response = array('status' => true, 'msg' => 'Theme Activated Successfully!');
               wp_send_json($response);
               exit;
             }
           }
         }
       }
       // ------------ Activation Close -----------
       public function wpelemento_importer_pro_mostrar_guide() {
         $display_string = '';
         // Check the validation Start
         $wpelemento_importer_pro_license_key = WPElemento_Importer_ThemeWhizzie::get_the_theme_key();
         $endpoint = WPEI_THEME_LICENCE_ENDPOINT . 'wpei_client_premium_theme_check_activation_status';
         $body = ['theme_license_key' => $wpelemento_importer_pro_license_key, 'site_url' => site_url(), 'theme_text_domain' => wp_get_theme()->get('TextDomain') ];
         $body = wp_json_encode($body);
         $options = ['body' => $body, 'headers' => ['Content-Type' => 'application/json', ]];
         $response = wp_remote_post($endpoint, $options);
         if (is_wp_error($response)) {
           // WPElemento_Importer_ThemeWhizzie::set_the_validation_status('false');
         } else {
           $response_body = wp_remote_retrieve_body($response);
           $response_body = json_decode($response_body);
      if ( isset($response_body->is_suspended) && $response_body->is_suspended == 1) {
        WPElemento_Importer_ThemeWhizzie::set_the_suspension_status('true');
      } else {
        WPElemento_Importer_ThemeWhizzie::set_the_suspension_status('false');
      }
      $display_string = isset($response_body->display_string) ? $response_body->display_string : '';
      if ($display_string != '') {
        if (strpos($display_string, '[THEME_NAME]') !== false) {
          $display_string = str_replace("[THEME_NAME]", "WPElemento Importer", $display_string);
        }
        if (strpos($display_string, '[THEME_PERMALINK]') !== false) {
          $display_string = str_replace("[THEME_PERMALINK]", "", $display_string);
        }
      }
      if ( isset($response_body->status) && $response_body->status === false) {
        WPElemento_Importer_ThemeWhizzie::set_the_validation_status('false');
      } else {
        WPElemento_Importer_ThemeWhizzie::set_the_validation_status('true');
      }
    }
        // Check the validation END
        $theme_validation_status = WPElemento_Importer_ThemeWhizzie::get_the_validation_status();
      //custom function about theme customizer
      $return = add_query_arg(array());
      $theme = wp_get_theme('wpelemento-importer');
      ?>
      <div class="wrapper-info get-stared-page-wrap">
      <div class="wee-tab-sec wee-theme-option-tab">
      <div class="wee-tab">
        <?php
        if(defined('GET_PREMIUM_THEME')){
          ?>
          <div class="tab">
            <button class="tablinks active" onclick="openCity(event, 'wee_theme_activation')" data-tab="wee_theme_activation"><?php _e('Key Activation', 'wpelemento-importer'); ?></button>
          </div>
        <?php }?>
      </div>
        <!-- Tab content -->
        <div id="wee_theme_activation" class="wee-tabcontent  <?php echo defined('GET_PREMIUM_THEME') ? 'open' : '' ?>">
          <?php if(defined('GET_PREMIUM_THEME')){ ?>
            <div class="wee_theme_activation-wrapper">
              <div class="wee_theme_activation_spinner">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                  <g transform="translate(50,50)">
                    <g transform="scale(0.7)">
                      <circle cx="0" cy="0" r="50" fill="#0f81d0"></circle>
                      <circle cx="0" cy="-28" r="15" fill="#cfd7dd">
                        <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 0 0;360 0 0"></animateTransform>
                      </circle>
                    </g>
                  </g>
                </svg>
              </div>
              <div class="wee-theme-wizard-key-status">
                <?php
                if ($theme_validation_status === 'false') {
                  esc_html_e('Theme License Key is not activated!', 'wpelemento-importer');
                } else {
                  esc_html_e('Theme License is Activated!', 'wpelemento-importer');
                }
                ?>
              </div>
              <?php $this->activation_page(); ?>
            </div>
          <?php } ?>
        </div>
        <div id="wee_demo_offer" class="wee-tabcontent <?php echo !defined('GET_PREMIUM_THEME') ? 'open' : '' ?>">
          <?php $this->wizard_page(); ?>
        </div>
      </div>
      <?php
      ?>
      <?php
    }
    // Add a Custom CSS file to WP Admin Area
    public function wpelemento_importer_pro_admin_plugin_style() {
      wp_enqueue_style('wpelementor-font', $this->wpelemento_importer_pro_admin_font_url(), array());
      wp_enqueue_style('custom-admin-style', EDI_URL . 'theme-wizard/assets/css/getstart.css');
    }
    // Theme Font URL
    public function wpelemento_importer_pro_admin_font_url() {
      $font_url = '';
      $font_family = array();
      $font_family[] = 'Muli:300,400,600,700,800,900';
      $query_args = array('family' => urlencode(implode('|', $font_family)),);
      $font_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
      return $font_url;
    }
    public function can_theme_activate($slug) {
      return ((wp_get_theme()->get('TextDomain') != $slug) && !get_theme_update_available(wp_get_theme($slug)));
    }
    // adding select theme page start //
    public function get_themes() {
      $themes = array(
        'all' => array(),
        'install' => array(),
        'update' => array(),
        'network_enable' => array(),
        'activate' => array()
      );
      $instance_themes = array(
        'elementor-wptheme' => array(
          'name' => 'Elementor Wptheme',
           'slug' => 'elementor-wptheme',
           'source' => 'repo',
           'required' => 1,
           'version' => '',
           'force_activation' => '',
           'force_deactivation' => '',
           'external_url' => '',
           'is_callable' => '',
           'file_path' => 'elementor-wptheme',
           'source_type' => '',
         ),

          );
          foreach ($instance_themes as $slug => $theme) {
            if ((wp_get_theme()->get('TextDomain') == $slug) && (false === get_theme_update_available(wp_get_theme()))) {
              // Theme is installed and up to date
              continue;
            } else {
              $themes['all'][$slug] = $theme;
              if (!wp_get_theme($slug)->exists()) {
                $themes['install'][$slug] = $theme;
              } else {
                if (false != get_theme_update_available(wp_get_theme($slug))) {
                  $themes['update'][$slug] = $theme;
                }
                if (current_user_can('manage_network_themes') && $this->is_theme_available_to_network_activate($slug) && $this->can_theme_activate($slug)) {
                  $themes['network_enable'][$slug] = $theme;
                } else if ($this->can_theme_activate($slug)) {
                  $themes['activate'][$slug] = $theme;
                }
              }
            }
          }
          return $themes;
        }
        // end get_themes
        public function get_step_themes() {
          $themes = $this->get_themes();
          $content = array();
          // The summary element will be the content visible to the user
          $content['summary'] = sprintf('<p>%s</p>', __('This plugin works only when required themes are installed. Click the button to install. You can still install or deactivate plugins later from the dashboard.', 'wpelemento-importer'), 'wpelemento-importer');
          $content = apply_filters('whizzie_filter_summary_content', $content);
          // The detail element is initially hidden from the user
          $content['detail'] = '<ul class="wpelemento-importer-do-themes">';
          // Add each theme into a list
          foreach ($themes['all'] as $slug => $theme) {
            $content['detail'].= '<li data-slug="' . esc_attr($slug) . '">' . esc_html($theme['name']) . '<span>';
            $keys = array();
            if (isset($themes['install'][$slug])) {
              $keys[] = esc_html('Installation');
            }
            if (isset($themes['update'][$slug])) {
                $keys[] = esc_html('Update');
            }
            if (isset($themes['network_enable'][$slug])) {
                $keys[] = esc_html('Network Enable');
            }
            if (isset($themes['activate'][$slug])) {
                $keys[] = esc_html('Activation');
            }
            $content['detail'].= implode(' and ', $keys) . ' required';
            $content['detail'].= '</span></li>';
        }
        $content['detail'].= '</ul>';
        return $content;
    }
    public function wpelemento_importer_setup_themes() {
      if (!check_ajax_referer('whizzie_nonce', 'wpnonce') || empty($_POST['slug'])) {
        wp_send_json_error(array('error' => 1, 'message' => esc_html__('No Slug Found')));
      }
      $json = array();
      // send back some json we use to hit up TGM
      $themes = $this->get_themes();
      if (current_user_can('manage_network_themes')) {
        foreach ($themes['network_enable'] as $slug => $theme) {
          if ($_POST['slug'] == $slug) {
            $encoded_slug = urlencode($slug);
            $theme_network_enable_url = esc_url(wp_nonce_url(network_admin_url('themes.php?action=enable&amp;theme=' . $encoded_slug), 'enable-theme_' . $slug));
            $theme_network_enable_url = str_replace('&amp;', '&', $theme_network_enable_url);
            $json = array('url' => $theme_network_enable_url, 'theme' => array($slug), 'tgmpa-page' => $this->tdi_tgmpa_menu_slug, 'theme_status' => 'all', '_wpnonce' => wp_create_nonce('bulk-plugins'), 'action' => $theme_network_enable_url, 'action2' => - 1, 'message' => esc_html__('Network Enabling Theme'),);
            break;
          }
        }
      }
      // what are we doing with this plugin?
      foreach ($themes['activate'] as $slug => $theme) {
        if ($_POST['slug'] == $slug) {
          $encoded_slug = urlencode($slug);
          $theme_activate_url = esc_url(wp_nonce_url(admin_url('themes.php?action=activate&amp;stylesheet=' . $encoded_slug), 'switch-theme_' . $slug));
          $theme_activate_url = str_replace('&amp;', '&', $theme_activate_url);
          $json = array('url' => $theme_activate_url, 'theme' => array($slug), 'tgmpa-page' => $this->tdi_tgmpa_menu_slug, 'theme_status' => 'all', '_wpnonce' => wp_create_nonce('bulk-plugins'), 'action' => $theme_activate_url, 'action2' => - 1, 'message' => esc_html__('Activating Theme'),);
          break;
        }
      }
      foreach ($themes['update'] as $slug => $theme) {
        if ($_POST['slug'] == $slug) {
          $update_php = esc_url(admin_url('update.php?action=upgrade-theme'));
          $theme_update_url = add_query_arg(array('theme' => $slug, '_wpnonce' => wp_create_nonce('upgrade-theme_' . $slug),), $update_php);
          $json = array('url' => $theme_update_url, 'theme' => array($slug), 'tgmpa-page' => $this->tdi_tgmpa_menu_slug, 'theme_status' => 'all', '_wpnonce' => wp_create_nonce('bulk-plugins'), 'action' => $theme_update_url, 'action2' => - 1, 'message' => esc_html__('Updating Theme'),);
          break;
        }
      }
      foreach ($themes['install'] as $slug => $theme) {
        if ($_POST['slug'] == $slug) {
          $install_php = esc_url(admin_url('update.php?action=install-theme'));
          $theme_install_url = add_query_arg(array('theme' => $slug, '_wpnonce' => wp_create_nonce('install-theme_' . $slug),), $install_php);
          $json = array('url' => $theme_install_url, 'theme' => array($slug), 'tgmpa-page' => $this->tdi_tgmpa_menu_slug, 'theme_status' => 'all', '_wpnonce' => wp_create_nonce('bulk-plugins'), 'action' => $theme_install_url, 'action2' => - 1, 'message' => esc_html__('Installing Theme'),);
          break;
        }
      }
      if ($json) {
        $json['hash'] = md5(serialize($json)); // used for checking if duplicates happen, move to next theme
        wp_send_json($json);
      } else {
        wp_send_json(array('done' => 1, 'message' => esc_html__('Success')));
      }
      exit;
    }
    function random_string($length) {
      $key = '';
      $keys = array_merge(range(0, 9), range('a', 'z'));
      for ($i = 0;$i < $length;$i++) {
        $key.= $keys[array_rand($keys) ];
      }
      return $key;
    }
    // this code is for demo elementor importer start //
    function wpelemento_importer_setup_elementor() {

      $elemento_themes = $this->get_elemento_themes();

      $arrayJson = array();
      if( $elemento_themes['status'] == 200 && !empty($elemento_themes['data']) ) {
        $elemento_themes_data = $elemento_themes['data'];

        foreach ( $elemento_themes_data as $single_theme ) {
          $arrayJson[$single_theme->theme_text_domain] = array(
            'title' => $single_theme->theme_page_title,
            'url' => $single_theme->theme_url
          );
        }
      }

      $my_theme_txd = wp_get_theme();
      $get_textdomain = $my_theme_txd->get('TextDomain');

      $pages_arr = array();
      if (array_key_exists($get_textdomain, $arrayJson)) {
        $getpreth = $arrayJson[$get_textdomain];

        array_push($pages_arr, array(
          'title' => $getpreth['title'],
          'ishome' => 1,
          'type' => '',
          'post_type' => 'page',
          'url' => $getpreth['url']
        ));

        if(defined('GET_PREMIUM_THEME')){

          if(file_exists( get_template_directory() . '/inc/page.json' )){
            $inner_page_json = $this->fetch_remote_content( get_template_directory_uri() . '/inc/page.json' );
            $inner_page_json_decoded = json_decode($inner_page_json, true);
            foreach ($inner_page_json_decoded as $page) {
              array_push($pages_arr, array(
                'type' => isset($page['type']) ? $page['type'] : '',
                'title' => $page['name'],
                'ishome' => 0,
                'post_type' => $page['posttype'],
                'url' => $page['source']
              ));
            }
          }

        }
      } else {
        array_push($pages_arr, array(
          'title' => 'Elemento Business',
          'type' => '',
          'ishome' => 1,
          'post_type' => 'page',
          'url' => WPELEMENTO_MAIN_URL . "themes-json/elemento-business/elemento-business.json"
        ));
      }

      foreach ($pages_arr as $page) {
        $elementor_template_data = $page['url'];
        $elementor_template_data_title = $page['title'];
        $ishome = $page['ishome'];
        $post_type = $page['post_type'];
        $type = $page['type'];
        $this->import_inner_pages_data($elementor_template_data, $elementor_template_data_title, $ishome,$post_type,$type);
      }

      // call theme function start //
      $setup_widgets_function = str_replace( '-', '_', $get_textdomain ) . '_setup_widgets';
      if ( class_exists('Whizzie') && method_exists( 'Whizzie', $setup_widgets_function ) ) {
        Whizzie::$setup_widgets_function();
      }
      // call theme function end //

      wp_send_json(
        array(
          'permalink' => get_permalink($home_id),
          'edit_post_link' => admin_url('post.php?post=' . $home_id . '&action=elementor')
        )
      );
    }

    function fetch_remote_content($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $content = curl_exec($ch);
      curl_close($ch);
      return $content;
    }


    public function import_inner_pages_data($elementor_template_data, $elementor_template_data_title, $ishome,$post_type,$type){
      $elementor_template_data_json = $this->fetch_remote_content($elementor_template_data);
      // Upload the file first
      $upload_dir = wp_upload_dir();
      $filename = $this->random_string(25) . '.json';
      if (wp_mkdir_p($upload_dir['path'])) {
        $file = $upload_dir['path'] . '/' . $filename;
      } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
      }
      $file_put_contents = file_put_contents($file, $elementor_template_data_json);
      $json_path = $upload_dir['path'] . '/' . $filename;
      $json_url = $upload_dir['url'] . '/' . $filename;
      $elementor_home_data = $this->get_elementor_theme_data($json_url, $json_path);
      $page_title = $elementor_template_data_title;
      $elemento_page = array('post_type' => $post_type, 'post_title' => $page_title, 'post_content' => $elementor_home_data['elementor_content'], 'post_status' => 'publish', 'post_author' => 1, 'meta_input' => $elementor_home_data['elementor_content_meta']);
      $home_id = wp_insert_post($elemento_page);

      if($post_type == 'elementskit_template'){
      update_post_meta( $home_id, '_wp_page_template', 'elementor_canvas' );
      update_post_meta( $home_id, 'elementskit_template_activation', 'yes' );
      update_post_meta( $home_id, 'elementskit_template_type', $type );
      update_post_meta( $home_id, 'elementskit_template_condition_a', 'entire_site' );
    }else {
      if ($ishome !== 0) {
        update_option('page_on_front', $home_id);
        update_option('show_on_front', $post_type);

        $my_theme_txd = wp_get_theme();
        $get_textdomain = $my_theme_txd->get('TextDomain');
        $wpei_free_text_domain = array('elemento-business', 'elemento-it-solutions', 'elemento-conference', 'elemento-startup', 'green-farm-elementor', 'web-developer-elementor','digital-marketing-elementor', 'web-agency-elementor', 'eco-nature-elementor', 'plumbing-contractor', 'business-directory-elementor', 'web-designer-elementor', 'beauty-spa-elementor', 'software-company-elementor', 'industrial-services-elementor', 'photographer-elementor', 'scuba-diving-sport', 'shoes-store-elementor', 'medical-healthcare-elementor', 'lms-education-elementor', 'fitness-elementor', 'fashion-shop-storefront', 'printing-press', 'travel-hiking', 'editorial-news-agency', 'seo-digital-agency', 'ev-bike-shop', 'diy-tutorials', 'equipment-rental', 'books-printing', 'cafe-elementor', 'hairstylist-salon', 'charitable-non-profit', 'house-cleaning', 'magazine-news-agency', 'event-organizer-elemento', 'auto-car-repair', 'coming-soon-shortly');
        if(in_array($get_textdomain,  $wpei_free_text_domain)) {
          add_post_meta( $home_id, '_wp_page_template', 'templates/frontpage.php' );
        }
      }
    }
  }

    public function get_elementor_theme_data($json_url, $json_path) {
      // Mime a supported document type.
      $elementor_plugin = \Elementor\Plugin::$instance;
      $elementor_plugin->documents->register_document_type('not-supported', \Elementor\Modules\Library\Documents\Page::get_class_full_name());
      $template = $json_path;
      $name = '';
      $_FILES['file']['tmp_name'] = $template;
      $elementor = new \Elementor\TemplateLibrary\Source_Local;
      $elementor->import_template($name, $template);
      unlink($json_path);
      $args = array('post_type' => 'elementor_library', 'nopaging' => true, 'posts_per_page' => '1', 'orderby' => 'date', 'order' => 'DESC', 'suppress_filters' => true,);
      $query = new \WP_Query($args);
      $last_template_added = $query->posts[0];
      //get template id
      $template_id = $last_template_added->ID;
      wp_reset_query();
      wp_reset_postdata();
      //page content
      $page_content = $last_template_added->post_content;
      //meta fields
      $elementor_data_meta = get_post_meta($template_id, '_elementor_data');
      $elementor_ver_meta = get_post_meta($template_id, '_elementor_version');
      $elementor_edit_mode_meta = get_post_meta($template_id, '_elementor_edit_mode');
      $elementor_css_meta = get_post_meta($template_id, '_elementor_css');
      $elementor_metas = array('_elementor_data' => !empty($elementor_data_meta[0]) ? wp_slash($elementor_data_meta[0]) : '', '_elementor_version' => !empty($elementor_ver_meta[0]) ? $elementor_ver_meta[0] : '', '_elementor_edit_mode' => !empty($elementor_edit_mode_meta[0]) ? $elementor_edit_mode_meta[0] : '', '_elementor_css' => $elementor_css_meta,);
      $elementor_json = array('elementor_content' => $page_content, 'elementor_content_meta' => $elementor_metas);
      return $elementor_json;
    }
    // adding select theme page end //

    public function get_elemento_themes() {
      $endpoint = WPEI_THEME_LICENCE_ENDPOINT . 'get_elemento_themes_records';
      $options = ['headers' => ['Content-Type' => 'application/json', ]];
      $response = wp_remote_get($endpoint, $options);
      if (is_wp_error($response)) {

        $response = array( 'status' => 100, 'msg' => 'Something Went Wrong!', 'data' => [] );
        return $response;
      } else {
        $response_body = wp_remote_retrieve_body($response);
        $response_body = json_decode($response_body);

        $response = array( 'status' => 200, 'msg' => 'Elemento themes list', 'data' => $response_body->data );
        return $response;
      }
    }
  }
