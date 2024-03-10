<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! class_exists( 'IEPA_MM_Theme_Settings' ) ) {

  /**
   * Handles all admin related functionality.
   */
  final class IEPA_MM_Theme_Settings {

    /**
     * Constructor
     */
    public function __construct() {
      $this->settings = get_option( "iepamega_settings" );
    }


    /**
     * get custom theme data from table.
     **/
    function get_custom_theme_data( $id ) {
      global $wpdb;
      $table_name = $wpdb->prefix . "iepa_mm_custom_theme";
      if( intval( $id ) ) {
        $iepa_custom_theme = $wpdb->get_results( "SELECT * FROM $table_name where theme_id = $id" );
      } else {
        $iepa_custom_theme = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY theme_id DESC" );
      }
      return $iepa_custom_theme;
    }

    /**
     * get custom theme row data from table.
     * */
    public static function get_custom_theme_rowdata( $id ) {
      global $wpdb;
      $table_name = $wpdb->prefix . "iepa_mm_custom_theme";
      if( intval( $id ) ) {
        $iepa_custom_theme = $wpdb->get_row( "SELECT * FROM $table_name where theme_id = $id" );
      } else {
        $iepa_custom_theme = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY theme_id DESC" );
      }
      return $iepa_custom_theme;
    }

    /**
     * Model to return form settings by form id
     */
    public static function get_theme_detail( $id ) {
      global $wpdb;
      $table_name = $wpdb->prefix . "iepa_mm_custom_theme";
      $themess    = $wpdb->get_row( "SELECT * FROM $table_name WHERE theme_id = $id", ARRAY_A );
      return $themess;
    }


    /*
     * Create theme slug function
     */
    public static function imma_theme_make_slug( $title, $table_name ) {
      global $wpdb;
      $slug               = preg_replace( "/-$/", "", preg_replace( '/[^a-z0-9]+/i', "-", strtolower( $title ) ) );
      $iepa_custom_theme  = $wpdb->get_results( "SELECT * FROM $table_name where slug like '%$slug'" );

      $numHits            = count( $iepa_custom_theme );
      return ( $numHits > 0 ) ? ( $slug . '-' . $numHits ) : $slug;
    }


  }
  $global['imma_theme_obj'] = new IEPA_MM_Theme_Settings();

}
