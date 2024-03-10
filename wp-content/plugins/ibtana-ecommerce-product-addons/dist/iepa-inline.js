(function($) {
  function get_iepa_activation_status() {
    jQuery.post( ibtana_visual_editor_modal_js.adminAjax, {
      action:							'iepa_activation_status'
    }, function( iepa_response ) {
      console.log( 'iepa_response', iepa_response );
    });
  }

  get_iepa_activation_status();

})( jQuery );
