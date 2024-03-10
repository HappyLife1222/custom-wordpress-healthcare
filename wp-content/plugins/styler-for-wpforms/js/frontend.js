(function($){
    wp.customize.bind( 'preview-ready', function() {
        wp.customize.preview.bind( 'sfwfFormSelectionStatus', function( message ) {
           if( message === 1){
               $('.sfwf-partial-formwrapper-shortcut').css('display', 'none');
               $('.wpforms-container').addClass('sfwf-live-edit-disabled');
           }
        } );
      } );
    })(jQuery);