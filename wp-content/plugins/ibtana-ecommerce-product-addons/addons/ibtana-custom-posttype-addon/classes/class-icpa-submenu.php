<?php
/**
* Ibtana submenu for woocommerce editor settings
*/
class ICPA_Submenu extends Ibtana_Visual_Editor_Menu_Creator {
  public $icpa_submenu_defaults = array(
    'page_type'       =>  'menu_page',
    'page_title'      =>  '',
    'menu_title'      =>  '',
    'capability'      =>  '',
    'menu_slug'       =>  '',
    'icon_url'        =>  '',
    'position'        =>  '',
    'parent_slug'     =>  '',
    'priority'        =>  10,
    'network_page'    =>  false,
    'page_functions'  =>  ''
  );
	public $icpa_args;
	public $icpa_ivehook;

  function __construct( $icpa_args ) {
		$this->active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );

    /* Global that will hold all the arguments for all the menu pages */
    global $ibtana_visual_editor_pages;

    /* Merge the input arguments and the icpa_submenu_defaults. */
    $this->icpa_args = wp_parse_args( $icpa_args, $this->icpa_submenu_defaults );

    /* Add the settings for this page to the global object */
    $ibtana_visual_editor_pages[$this->icpa_args['page_title']] = $this->icpa_args;

    if( !$this->icpa_args['network_page'] ) {
      /* Hook the page function to 'admin_menu'. */
      add_action( 'admin_menu', array( &$this, 'ibtana_visual_editor_page_init' ), $this->icpa_args['priority'] );
    } else {
      /* Hook the page function to 'admin_menu'. */
      add_action( 'network_admin_menu', array( &$this, 'ibtana_visual_editor_page_init' ), $this->icpa_args['priority'] );
    }
  }


  /**
	 * Function that creates the admin page
	 */
	function ibtana_visual_editor_page_init() {
		global $ibtana_visual_editor_pages_ivehooks;

    /* don't add the page at all if the user doesn't meet the capabilities */
    if( !empty( $this->icpa_args['capability'] ) ) {
      if( !current_user_can( $this->icpa_args['capability'] ) ) {
        return;
      }
    }

		/* Create the page using either add_menu_page or add_submenu_page functions depending on the 'page_type' parameter. */
	 if( $this->icpa_args['page_type'] == 'submenu_page' ) {
			$this->icpa_ivehook = add_submenu_page(
        $this->icpa_args['parent_slug'],
        __( $this->icpa_args['page_title'], 'ibtana-ecommerce-product-addons' ),
        __( $this->icpa_args['menu_title'], 'ibtana-ecommerce-product-addons' ),
        $this->icpa_args['capability'],
        $this->icpa_args['menu_slug'],
        array(
          $this,
          $this->icpa_args['page_functions']
        )
      );

			$ibtana_visual_editor_pages_ivehooks[$this->icpa_args['menu_slug']] = $this->icpa_ivehook;
		}

	}

  /**
 * Editor setting submenu
 */
  public function icpa_save_page() {
    include_once( ICPA_PATH . 'inc/settings_page.php' );
  }

  /**
  * End : create sub main menu page editor  of ibtana plugin
  */
}

$icpa_editor_settings = array(
  'page_type'       =>  'submenu_page',
  'page_title'      =>  'Custom Posttype',
  'menu_title'      =>  'Custom Posttype',
  'capability'      =>  'edit_theme_options',
  'menu_slug'       =>  'ibtana-custom-post-type',
  'icon_url'        =>  '',
  'parent_slug'     =>  'ibtana-visual-editor',
  'page_functions'  =>  'icpa_save_page'
);

new ICPA_Submenu( $icpa_editor_settings );

 ?>
