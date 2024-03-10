<?php
namespace WPS\WPS_Child_Theme_Generator;

class Plugin {

    use Singleton;

    protected function init() {
        add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );

        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue_scripts' ) );

        add_filter( 'plugin_action_links_' . WPS_CHILD_THEME_GENERATOR_BASENAME, array(
            __CLASS__,
            'plugin_action_links'
        ) );

        add_action( 'tool_box', array( __CLASS__, 'tool_box' ) );
    }

    /**
     * Admin menu WPServeur
     */
    public static function admin_menu() {

        if ( ! current_user_can( 'manage_options' ) ) {
            return false;
        }

        add_management_page(
            __( 'WPS Child Theme Generator', 'wps-child-theme-generator' ),
            __( 'WPS Child Theme Generator', 'wps-child-theme-generator' ),
            'manage_options',
            'wps-child-theme-generator',
            array( __CLASS__, 'admin_page' )
        );
    }

    /**
     * Display a custom menu page
     */
    public static function admin_page() {
        include( WPS_CHILD_THEME_GENERATOR_DIR . '/admin_page/plugin.php' );
    }

    /**
     * @param $hook
     *
     * @return bool
     */
    public static function admin_enqueue_scripts( $hook ) {
        if ( false === strpos( $hook, 'wps-child-theme-generator' ) ) {
            return false;
        }

        wp_enqueue_style( 'wps-child-theme-generator-fa', WPS_CHILD_THEME_GENERATOR_URL . 'assets/fontawesome/css/all.css' );
        wp_enqueue_style( 'wps-child-theme-generator-style', WPS_CHILD_THEME_GENERATOR_URL . 'assets/css/style.css', array(), WPS_CHILD_THEME_GENERATOR_VERSION );
        wp_enqueue_script( 'wps-child-theme-generator-fa', WPS_CHILD_THEME_GENERATOR_URL . 'assets/fontawesome/js/all.js', array(), false, true );

        wp_enqueue_media();

        wp_enqueue_script( 'wps-child-theme-generator-functions', WPS_CHILD_THEME_GENERATOR_URL . 'assets/js/functions.js', array( 'jquery' ) );
        wp_localize_script(
            'wps-child-theme-generator-functions',
            'screenHelp',
            array(
                'title'            => __( 'Select or upload new file for screenshot', 'wps-child-theme-generator' ),
                'buttomText'       => __( 'Add screenshot', 'wps-child-theme-generator' ),
                'uploadButtonText' => __( 'Modify screenshot', 'wps-child-theme-generator' ),
                'image_size_name'  => __( 'Image size name', 'wps-child-theme-generator' ),
                'image_size_slug'  => __( 'Image size slug', 'wps-child-theme-generator' ),
                'image_weight'     => __( 'Width', 'wps-child-theme-generator' ),
                'image_height'     => __( 'Height', 'wps-child-theme-generator' ),
                'default_px'       => __( 'default px', 'wps-child-theme-generator' ),
            )
        );

        // Enqueue code editor and settings for manipulating HTML.
        $settings = wp_enqueue_code_editor( array(
                'type' => 'text/css',
            )
        );

        // Bail if user disabled CodeMirror.
        if ( false === $settings ) {
            return false;
        }

        wp_add_inline_script(
            'code-editor',
            sprintf(
                'jQuery( function() { wp.codeEditor.initialize( "b7ectg_add_css", %s ); } );',
                wp_json_encode( $settings )
            )
        );

        wp_add_inline_script(
            'wp-codemirror',
            'window.CodeMirror = wp.CodeMirror;'
        );
    }

    /**
     *
     * Add link tools in plugin page
     *
     * @param $links
     *
     * @return mixed
     */
    public static function plugin_action_links( $links ) {
        array_unshift( $links, '<a href="' . admin_url( 'admin.php?page=wps-child-theme-generator' ) . '">' . __( 'Tools' ) . '</a>' );

        return $links;
    }

    /**
     * Add tools in toolbox WordPress
     */
    public static function tool_box() { ?>
        <div class="card">
            <h2 class="title"><?php _e( 'Child Theme Generator', 'wps-child-theme-generator' ) ?></h2>
            <p><?php printf( __( 'Don\'t know where to start with your child theme, use the <a href="%s">WPS Child Theme Generator</a>.' ), admin_url( 'admin.php?page=wps-child-theme-generator' ) ); ?></p>
        </div>
        <?php
    }

    /**
     *
     * Check if is plugin installed
     *
     * @param $plugin
     *
     * @return bool
     */
    public static function is_plugin_installed( $plugin ) {
        if ( ! function_exists( 'get_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset( $installed_plugins[ $plugin ] );
    }

    /**
     *
     * Return PF current user
     *
     * @return null|string|string[]
     */
    public static function wps_ip_check_return_pf() {
        $pf        = '';
        $host_name = gethostname();
        if ( strpos( $host_name, 'wps' ) !== false ) {

            if ( false !== strpos( $host_name, 'wpserveur' ) ) {
                $pf = 'pf1';

                return $pf;
            }

            $pf = preg_replace( "/[^0-9]/", '', $host_name );
            $pf = 'pf' . $pf;
        }

        return $pf;
    }

    /**
     *
     * Not display pub in plugin
     *
     * @param $array
     *
     * @return array
     */
    public static function wps_bidouille_not_display_pub_array( $array ) {
        $array[] = 'tools_page_wps-cleaner';

        return $array;
    }

}