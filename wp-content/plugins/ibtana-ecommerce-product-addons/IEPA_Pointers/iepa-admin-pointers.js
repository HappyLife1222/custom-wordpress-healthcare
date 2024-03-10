(function( $ ) {


  var iepa_pointers = JSON.parse( decodeURIComponent( iepa_admin_pointers.pointers ) );
  var IEPA_TEXT_DOMAIN  = iepa_admin_pointers.IEPA_TEXT_DOMAIN;
  var __ = wp.i18n.__;

  console.log( 'iepa_pointers', iepa_pointers );
  console.log( 'IEPA_TEXT_DOMAIN', IEPA_TEXT_DOMAIN );

  setTimeout( init_iepa_pointers, 400 );

  function init_iepa_pointers() {
    $.each( iepa_pointers.pointers, function( i ) {
      show_iepa_pointer( i );
      return false;
    } );
  }


  function show_iepa_pointer( id ) {

    console.log( 'id', id );

    var pointer = iepa_pointers.pointers[ id ];

    console.log( 'pointer printing', pointer );
    var pointer_options = pointer.options;


    var options = $.extend( pointer.options, {
      pointerClass: 'wp-pointer',
      close: function() {
        if ( pointer.next ) {
          show_iepa_pointer( pointer.next );
        }
      },
      buttons: function( event, t ) {

        console.log( 'pointer_options', pointer_options );

        var buttons_wrapper   =   $( '<div class="iepa_pointer_buttons" />' );


        // Button Dismiss code Starts here
        if ( pointer_options.button_dismiss ) {
          var button_dismiss    =   $( '<a class="close iepa_wizard_close_btn" href="#">' + __( 'Dismiss', IEPA_TEXT_DOMAIN ) + '</a>' );

          button_dismiss.on( 'click.pointer', function(e) {

            e.preventDefault();
            iepa_update_product_tutorial_status( pointer_options.step, function( iepa_res ) {
              t.element.pointer( 'destroy' );
            } );

          } );

          buttons_wrapper.append( button_dismiss );
        }
        // Button Dismiss code Ends here


        // Next Button code Starts Here
        var button_next       = '';
        var next_button_text  = __( 'Next', IEPA_TEXT_DOMAIN );
        if ( pointer_options.hasOwnProperty( 'next_button' ) ) {
          next_button_text  = pointer_options.next_button.text;

          if ( pointer_options.next_button.event_type == 'href' ) {

            button_next       =   $( '<a class="button button-primary iepa_wizard_next_btn" href="' + pointer_options.next_button.href + '">' + next_button_text + '</a>' );

            // if ( pointer_options.next_button.href === '#' ) {
              button_next.on( 'click.pointer', function(e) {
                e.preventDefault();
                iepa_update_product_tutorial_status( pointer_options.step, function( iepa_res ) {
                  console.log( 'iepa_res', iepa_res );
                  if ( pointer_options.next_button.event_type != '#' ) {
                    window.location.href = pointer_options.next_button.href;
                  }
                } );
                t.element.pointer('close');
              } );
            // }

          } else {

            button_next       =   $( '<a class="button button-primary iepa_wizard_next_btn">' + next_button_text + '</a>' );
            button_next.on( 'click.pointer', function(e) {
              e.preventDefault();

              iepa_update_product_tutorial_status( pointer_options.step, function( iepa_res ) {
                console.log( 'iepa_res', iepa_res );
                if ( pointer_options.next_button.event_type == 'change' ) {
                  $( pointer_options.next_button.selector ).prop( 'checked', true )
                }
                $( pointer_options.next_button.selector ).trigger( pointer_options.next_button.event_type );
              } );

              t.element.pointer('close');
            } );


          }
        }

        if ( button_next != '' ) {
          buttons_wrapper.append( button_next );
        }
        // Next Button code Ends Here


        return buttons_wrapper;
      },
    } );

    console.log( 'options', options );

    var this_pointer = $( pointer.target ).pointer( options );

    this_pointer.pointer( 'open' );

    if ( pointer.next_trigger ) {
      $( pointer.next_trigger.target ).on( pointer.next_trigger.event, function() {
        setTimeout( function() { this_pointer.pointer( 'close' ); }, 400 );
      });
    }


  }


  function iepa_update_product_tutorial_status( step, callback ) {
    jQuery.post( wp.ajax.settings.url, {
      action: 'iepa_update_product_tutorial_status',
      iepa_tutorial_step:   step
    }, function( iepa_response ) {
      callback( iepa_response );
    });
  }

})( jQuery );
