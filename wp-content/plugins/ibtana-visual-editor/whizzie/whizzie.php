<?php

/**
 * Wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Free_Whizzie
{


	protected $version = '1.1.0';

	/** @var string Current theme name, used as namespace in actions. */
	protected $theme_name = '';
	protected $theme_title = '';
	protected $plugin_path = '';

	/** @var string Wizard page slug and title. */
	protected $page_slug = '';
	protected $page_title = '';
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

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */

	protected $widget_file_url = '';

	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct($config)
	{
		$this->set_vars($config);
		$this->init();
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars($config)
	{
		if (isset($config['page_slug'])) {
			$this->page_slug = esc_attr($config['page_slug']);
		}
		if (isset($config['page_title'])) {
			$this->page_title = esc_attr($config['page_title']);
		}
		if (isset($config['steps'])) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit(dirname(__FILE__));
		$relative_url = str_replace(get_template_directory(), '', $this->plugin_path);
		$this->plugin_url = plugin_dir_url(__FILE__);
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get('Name');
		$this->theme_name = strtolower(preg_replace('#[^a-zA-Z]#', '', $current_theme->get('Name')));
		$this->page_slug = apply_filters($this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-setup');
		$this->parent_slug = apply_filters($this->theme_name . '_theme_setup_wizard_parent_slug', '');

		$this->widget_file_url = trailingslashit(IVE_WHIZZIE_DIR) . 'content/widgets.wie';
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init()
	{
		add_action('after_switch_theme', array($this, 'redirect_to_wizard'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('admin_menu', array($this, 'menu_page'));
		add_action('wp_ajax_setup_plugins_freeSW', array($this, 'setup_plugins_freeSW'));
		add_action('wp_ajax_setup_widgets_freeSW', array($this, 'setup_widgets_freeSW'));
		add_action('wp_ajax_setup_elementor_freeSW', array($this, 'setup_elementor_freeSW'));
	}

	public function redirect_to_wizard()
	{
		global $pagenow;
		if (is_admin() && 'admin.php' == $pagenow && isset($_GET['activated']) && current_user_can('manage_options')) {
			wp_redirect(admin_url('admin.php?page=' . esc_attr($this->page_slug)));
		}
	}

	public function enqueue_scripts()
	{
		wp_enqueue_style('whizzie-style', $this->plugin_url . 'assets/css/whizzie-admin-style.css', array(), time());
		wp_register_script('whizzie', $this->plugin_url . 'assets/js/whizzie.js', array('jquery'), time());
		wp_localize_script(
			'whizzie',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url('admin-ajax.php'),
				'wpnonce' 		=> wp_create_nonce('whizzie_nonce'),
				'verify_text'	=> esc_html('verifying', 'whizzie')
			)
		);
		wp_enqueue_script('whizzie');
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */

	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page()
	{

		if ( defined('VW_FREE_THEME') || defined('ELEMENTOR_DEMO_IMPORT') ) {
			add_submenu_page('ibtana-visual-editor', esc_html__($this->page_title), esc_html__($this->page_title), 'manage_options', $this->page_slug, array($this, 'wizard_page'), 20);
		}
	}

	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page()
	{
		$url = wp_nonce_url(add_query_arg(array('plugins' => 'go')), 'whizzie-setup');
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys($_POST); // Extra fields to pass to WP_Filesystem.
		if (false === ($creds = request_filesystem_credentials(esc_url_raw($url), $method, false, false, $fields))) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		if (!WP_Filesystem($creds)) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials(esc_url_raw($url), $method, true, false, $fields);
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="wrap">
			<?php printf('<h1></h1>', esc_html($this->page_title));
			echo '<div class=" ibtana-whizzie-wrap">';
			// The wizard is a list with only one item visible at a time
			$steps = $this->get_steps();
			echo '<ul style="text-align: center" class="ibtana-whizzie-menu">';
			foreach ($steps as $step) {
				$class = 'step step-' . esc_attr($step['id']);
				echo '<li data-step="' . esc_attr($step['id']) . '" class="' . esc_attr($class) . '">';
				printf('<h2>%s</h2>', esc_html($step['title']));
				// $content is split into summary and detail
				$content = call_user_func(array($this, $step['view']));
				if (isset($content['summary'])) {
					printf(
						'<div class="summary">%s</div>',
						wp_kses_post($content['summary'])
					);
				}
				if (isset($content['detail'])) {
					// Add a link to see more detail
					printf('<p><a href="#" class="ibtana-more-info">%s</a></p>', __('More Info', 'whizzie'));
					printf(
						'<div class="detail">%s</div>',
						$content['detail'] // Need to escape this
					);
				}
				// The next button
				if (isset($step['button_text1']) && $step['button_text1']) {
					printf(
						'<div class="ibtana-button-wrap"><a href="%s" class="button button-primary" data-callback="%s" data-step="%s">%s</a></div>',
						$homePath = get_home_url(),
						esc_attr($step['callback']),
						esc_attr($step['id']),
						esc_html($step['button_text1'])
					);
				}
				if (isset($step['button_text2']) && $step['button_text2']) {
					printf(
						'<div class="ibtana-button-wrap"><a href= "%s" class="button button-primary" data-callback="%s" data-step="%s">%s</a></div>',
						$adminPath = admin_url() . "customize.php",
						esc_attr($step['callback']),
						esc_attr($step['id']),
						esc_html($step['button_text2'])
					);
				}

				if (isset($step['button_text']) && $step['button_text']) {
					printf(
						'<div class="ibtana-button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
						esc_attr($step['callback']),
						esc_attr($step['id']),
						esc_html($step['button_text'])
					);
				}


				if (isset($step['button_text_one']) && $step['button_text_one'] && defined('VW_FREE_THEME') ) {
					printf(
						'<div class="button-wrap button-wrap-one">
							<a href="#" class="button button-primary do-it" data-callback="install_widgets_freeSW" data-step="widgets"><img src="'.IVE_URL.'/whizzie/assets/images/Customize-Icon.png"></a>
							<p class="demo-type-text">%s</p>
						</div>',
						esc_html($step['button_text_one'])
					);
				}

				if (isset($step['button_text_two']) && $step['button_text_two'] && defined('ELEMENTOR_DEMO_IMPORT') ) {
					printf(
						'<div class="button-wrap button-wrap-two">
							<a href="#" class="button button-primary do-it" data-step="widgets" data-callback="install_elementor_freeSW" id="ibtana_button"><img src="'.IVE_URL.'/whizzie/assets/images/Elementor-Icon.png"></a>
							<p class="demo-type-text">%s</p>
						</div>',
						esc_html($step['button_text_two'])
					);
				}

				// The skip button
				if (isset($step['can_skip']) && $step['can_skip']) {
					printf(
						'<div class="ibtana-button-wrap" style="margin-left: 0.5em;"><a href="#" class="button button-secondary do-it" data-callback="%s" data-step="%s">%s</a></div>',
						'do_next_step_freeSW',
						esc_attr($step['id']),
						__('Skip', 'whizzie')
					);
				}

				echo '</li>';
			}
			echo '</ul>';
			echo '<ul class="ibtana-whizzie-nav">';
			foreach ($steps as $step) {
				if (isset($step['icon']) && $step['icon']) {
					echo '<li class="nav-step-' . esc_attr($step['id']) . '"><span class="dashicons dashicons-' . esc_attr($step['icon']) . '"></span></li>';
				}
			}
			echo '</ul>';
			?>
			<div class="step-loading"><span class="spinner"></span></div>
		</div><!-- .ibtana-whizzie-wrap -->
		</div><!-- .wrap -->
	<?php }

	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps()
	{
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __('Welcome to ', 'whizzie') . $this->theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step_freeSW', // Callback for JS
				'button_text'	=> __('Start Now', 'whizzie'),
				'can_skip'		=> false // Show a skip button?
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __('Widgets', 'whizzie'),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets_freeSW',
				'button_text_one'	=> __('Click On The Image To Import Customizer Demo', 'whizzie'),
				'button_text_two'	=> __('Click On The Image To Import Elementor Demo', 'whizzie'),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __('All Done', 'whizzie'),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> 'visit_links',
				'button_text1'	=> __('Visit Site', 'whizzie'),
				'button_text2'	=> __('Customize Site', 'whizzie'),
			)
		);

		// Iterate through each step and replace with dev config values
		if ($dev_steps) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array('title', 'icon', 'button_text', 'can_skip', 'button_text1', 'button_text2');
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
	public function get_step_intro()
	{
		$content = array();
		// The summary element will be the content visible to the user
		$content['summary'] = sprintf('<p>%s</p>', 'Thank you for choosing this VW Plugin. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.', 'whizzie');
		$content['summary'] .= sprintf('<p>%s</p>', 'You may even skip the steps and get back to the dashboard if you have no time at the present moment. You can come back any time if you change your mind.', 'whizzie');
		return $content;
	}

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */

	public function get_step_plugins()
	{
		$plugins = $this->get_plugins();
		$content = array();
		// The summary element will be the content visible to the user
		$content['summary'] = sprintf(
			'<p>%s</p>',
			__('This theme works best with some additional plugins. Click the button to install. You can still install or deactivate plugins later from the dashboard.', 'whizzie')
		);
		$content = apply_filters('whizzie_filter_summary_content', $content);
		// The detail element is initially hidden from the user
		$content['detail'] = '<ul class="ibtana-whizzie-do-plugins">';
		// Add each plugin into a list
		foreach ($plugins['all'] as $slug => $plugin) {
			$content['detail'] .= '<li data-slug="' . esc_attr($slug) . '">' . esc_html($plugin['name']) . '<span>';
			$keys = array();
			if (isset($plugins['install'][$slug])) {
				$keys[] = 'Installation';
			}
			if (isset($plugins['update'][$slug])) {
				$keys[] = 'Update';
			}
			if (isset($plugins['activate'][$slug])) {
				$keys[] = 'Activation';
			}
			$content['detail'] .= implode(' and ', $keys) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}

	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets()
	{
		$content = array();
		$file = $this->has_widget_file();
		if ($file) {
		} else {
			$content['summary'] = sprintf(
				'<p>%s</p>',
				__('No widgets.wie found.', 'whizzie')
			);
		}
	?>
		<div>
			<h3>Click on the Install Demo button to Import Theme Demo</h3>
		</div>

<?php
		return $content;
	}
	/**
	 * Print the content for the final step
	 */
	public function get_step_done()
	{
		$content = array();
		$content['summary'] = sprintf('<p>%s</p>', 'Finished! You have successfully imported the Demo for this Theme.', 'whizzie');
		return $content;
	}

	/**
	 * Get the plugins registered with TGMPA
	 */

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file()
	{
		if (file_exists($this->widget_file_url)) {
			return true;
		}
		return false;
	}
	public function setup_plugins_freeSW()
	{
		if (!check_ajax_referer('whizzie_nonce', 'wpnonce') || empty($_POST['slug'])) {
			wp_send_json_error(array('error' => 1, 'message' => esc_html__('No Slug Found')));
		}
		$json = array();
		if ($json) {
			$json['hash'] = md5(serialize($json)); // used for checking if duplicates happen, move to next plugin
			wp_send_json($json);
		} else {
			wp_send_json(array('done' => 1, 'message' => esc_html__('Success')));
		}
		exit;
	}

	public function upload_image($theme_image, $post_id)
	{
		$attachment_ids = array();
		$image_url = $theme_image->link;
		$image_name = $theme_image->name;
		$image_type = false;

		if (isset($theme_image->post_type)) {
			$image_type = $theme_image->post_type;
		}
		$upload_dir       = wp_upload_dir();
		$image_data       = file_get_contents($image_url);

		// Get image data
		$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
		// Generate unique name
		$filename = basename($unique_file_name);
		// Create image file name
		// Check folder permission and define file location
		if (wp_mkdir_p($upload_dir['path'])) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		file_put_contents($file, $image_data);
		$wp_filetype = wp_check_filetype($filename, null);
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name($filename),
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		if ($image_type) {
			$attachment[$image_type] = $image_type;
		}

		$attach_id = wp_insert_attachment($attachment, $file, $post_id);
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata($attach_id, $file);
		wp_update_attachment_metadata($attach_id, $attach_data);

		set_post_thumbnail($post_id, $attach_id);

		if ($image_type) {
			$attachment_ids[$image_type][$image_name] = $attach_id;
		}
	}

	public function theme_create_customizer_nav_menu($theme_pages)
	{
		$themeDomain = get_stylesheet();
		$menuname = 'Primary Menu';
		$bpmenulocation = 'primary';
		$menu_exists = wp_get_nav_menu_object($menuname);

		if (!$menu_exists) {
			$menu_id = wp_create_nav_menu($menuname);
			foreach ($theme_pages as $theme_page) {
				if (isset($theme_page->setnavmenu)) {
					wp_update_nav_menu_item($menu_id, 0, array(
						'menu-item-title' =>  __($theme_page->title, $themeDomain),
						'menu-item-classes' => $theme_page->slug,
						'menu-item-url' => home_url($theme_page->pageID),
						'menu-item-status' => $theme_page->status
					));
				}
			}

			if (!has_nav_menu($bpmenulocation)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$bpmenulocation] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}
	}

	/**
	 * Imports the widgets.wie file
	 * @since 1.1.0
	 */

	public function setup_widgets_freeSW()
	{
		if (defined('VW_FREE_THEME')) {

			$json_url = "https://vwthemesdemo.com/ibtana_json/free_theme/setup_wizard_json/json.php?text_domain=" . VW_FREE_THEME;

			$response = wp_remote_get($json_url);
			$body = json_decode($response['body']);

			$data = $body->data;
			$post_type_ids = array();

			foreach ($data->post_types->pages as $theme_page) {
				$themePage = array(
					'post_type' => $theme_page->type,
					'post_title' => $theme_page->title,
					'post_content' => $theme_page->content,
					'post_status' => $theme_page->status,
				);

				$post_id = wp_insert_post($themePage);
				$post_type_ids[$theme_page->title] = $post_id;

				if (isset($theme_page->image)) {
					$this->upload_image($data->images[$theme_page->image], $post_id);
				}

				if (isset($theme_page->author)) {
					$themePage['post_author'] = $theme_page->author;
				}

				if (isset($theme_page->slug)) {
					$themePage['post_slug'] = $theme_page->slug;
				}

				if (isset($theme_page->meta)) {
					add_post_meta($post_id, $theme_page->meta->key, $theme_page->meta->value);
				}

				$themePage = get_page_by_title('Free Home');
				update_option('page_on_front', $themePage->ID);
				update_option('show_on_front', $theme_page->type);
			}

			wp_insert_term(
				'Service', // the term
				'category', // the taxonomy
				array(
					'description' => 'This is Service Category',
					'slug' => 'service',
					'term_id' => 12,
					'term_taxonomy_id'	=> 34,
				)
			);

			foreach ($data->post_types->posts as $theme_page) {
				$my_post = array(
					'post_title' => wp_strip_all_tags($theme_page->title),
					'post_content' => $theme_page->content,
					'post_status' => $theme_page->status,
					'post_type' => $theme_page->type,
				);

				$post_id = wp_insert_post($my_post);
				$post_type_ids[$theme_page->title] = $post_id;

				$vw_term = get_term_by('name', 'Service', 'category');
				wp_set_object_terms($post_id, $vw_term->term_id, 'category');

				if (isset($theme_page->image)) {
					$this->upload_image($data->images[$theme_page->image], $post_id);
				}
			}

			foreach ($data->theme_mods as $theme_mod) {
				if ($theme_mod->value == 'post_type') {
					set_theme_mod($theme_mod->key, $post_type_ids[$theme_mod->title]);
				} else {
					set_theme_mod($theme_mod->key, $theme_mod->value);
				}
			}

			$this->theme_create_customizer_nav_menu($data->post_types->pages);

			wp_send_json_success();
			exit;
		}
	}

	public function setup_elementor_freeSW(){
		if (defined('ELEMENTOR_DEMO_IMPORT')) {

			$text_domain = wp_get_theme()->get( 'TextDomain' );

			$json_theme = array('slug' => $text_domain);
	    $json_args = array(
				'method' => 'POST',
				'headers'     => array(
					'Content-Type'  => 'application/json'
				),
				'body' => json_encode($json_theme),
	    );

			$request_data = wp_remote_post( IBTANA_LICENSE_API_ENDPOINT . 'get_client_ibtana_elementor_template_details',$json_args);
	    $response_json = json_decode(wp_remote_retrieve_body( $request_data));

			$elementor_template_data = $response_json->data->json;

			$this->import_inner_pages_data($elementor_template_data);

			wp_send_json_success();
			exit;
		}
	}

	public function import_inner_pages_data($elementor_template_data_json){
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
		$elemento_page = array('post_type' => 'page', 'post_title' => 'Elementor Home', 'post_content' => $elementor_home_data['elementor_content'], 'post_status' => 'publish', 'post_author' => 1, 'meta_input' => $elementor_home_data['elementor_content_meta']);
		$home_id = wp_insert_post($elemento_page);

		update_option('page_on_front', $home_id);
		update_option('show_on_front', 'page');
	}

	public function random_string($length) {
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));
		for ($i = 0;$i < $length;$i++) {
			$key.= $keys[array_rand($keys) ];
		}
		return $key;
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
}
