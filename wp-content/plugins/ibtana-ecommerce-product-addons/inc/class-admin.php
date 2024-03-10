<?php

/**
 * IEPA blocks Admin class
 */
class IEPA_Blocks_Admin {

  private static $_instance = null;

  public static function instance() {
		if ( null == self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	} // End instance()

  public function enqueue() {
    wp_register_script(
      'iepa-inline',
      IEPA_URL . 'dist/iepa-inline.js',
      [ 'ibtana-visual-editor-modal-js' ],
      time(),
      true
    );
    wp_localize_script(
      'iepa-inline',
      'iepa_inline_object',
      array(
        'admin_url' =>  admin_url()
      )
    );
    wp_enqueue_script( 'iepa-inline' );
  }

  function rest_api_init() {}

  function enable_gutenberg_products( $can_edit, $post_type ) {
		return ( 'product' === $post_type ) ? IEPA_Blocks::enabled() : $can_edit;
	}

}
