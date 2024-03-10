(function($) {
    window.addEventListener(
        'load',
        function() {

            var data_to_post = {
                action: 'bdi_get_admin_notices',
                wpnonce:  bdi_notice_params.wpnonce
            };
            jQuery.ajax({
                method:   "POST",
                url:      bdi_notice_params.ajax_url,
                data:     data_to_post
            }).done(function( data ) {

                if ( data.success == true ) {

                    var bdi_admin_notices_res = data.data;
          
                    var show_bdi_admin_notices = false;
          
                    for ( var i = 0; i < bdi_admin_notices_res.length; i++ ) {
                      var bdi_admin_notice_data = bdi_admin_notices_res[i];
          
                      var bdi_show_notice = bdi_admin_notice_data.is_ibtana_admin_notice_enabled;
          
                      if ( bdi_show_notice ) {
          
                        var bdi_admin_notice_id = bdi_admin_notice_data.ibtana_admin_notice_unique_id;
          
                        var bdi_notice_params_bdi_admin_notices = bdi_notice_params.bdi_admin_notices;
          
                        for ( var j = 0; j < bdi_notice_params_bdi_admin_notices.length; j++ ) {
                          var bdi_admin_notice_single = bdi_notice_params_bdi_admin_notices[j];
                          if ( bdi_admin_notice_single == bdi_admin_notice_id ) {
                            bdi_show_notice = false;
                            break;
                          }
                        }
          
                        if ( bdi_show_notice ) {
                          show_bdi_admin_notices = true;
          
                          if ( bdi_admin_notice_data.ibtana_admin_notice_contents != '' ) {
          
                            if ( bdi_admin_notice_data.ibtana_admin_notice_css != '' ) {
                              $( 'head' ).append(
                                `<style>
                                  ${bdi_admin_notice_data.ibtana_admin_notice_css}
                                </style>`
                              );
                            }
          
                            $( '#bdi-admin-notice' ).append(
                              `<div class="notice" data-bdi-admin-notice-id="${bdi_admin_notice_id}">
                                <button type="button" class="bdi-admin-notice-dismiss"></button>
                                ${bdi_admin_notice_data.ibtana_admin_notice_contents}
                              </div>`
                            );
          
                          }
                        }
          
                      }
                    }
          
                    if ( show_bdi_admin_notices ) {
          
                      $( '.notice[data-bdi-admin-notice-id]' ).on( 'click', '.bdi-admin-notice-dismiss', function() {
          
                        var bdi_admin_notice_el = jQuery( this ).closest( '[data-bdi-admin-notice-id]' );
          
                        var bdi_admin_notice_id = bdi_admin_notice_el.attr( 'data-bdi-admin-notice-id' );
          
                        jQuery.post(
                          bdi_notice_params.ajax_url,
                          {
                            'action':             'bdi_admin_notice_ignore',
                            'bdi_admin_notice_id': bdi_admin_notice_id,
                            'wpnonce':             bdi_notice_params.wpnonce
                          },
                          function( result ) {
                            bdi_admin_notice_el.remove();
                            if ( !jQuery('#bdi-admin-notice .notice').length ) {
                              $( '#bdi-admin-notice' ).hide();
                            }
                          }
                        );
          
                      } );
          
                      $( '#bdi-admin-notice' ).show();
          
                    }
                }
            });

        },
        false
    );
})( jQuery );