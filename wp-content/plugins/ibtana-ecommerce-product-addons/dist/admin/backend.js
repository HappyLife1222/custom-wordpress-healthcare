(function( $ ) {

    "use strict";

    // javascript code here. i.e.: $(document).ready( function(){} );


    console.log( 'admin script' );

    $('.iepa-accordion-header').on('click', function() {
      $( this ).closest( '.iepa-accordion' ).toggleClass( 'actively-open' );
    });

    jQuery('.iepa_premium_page').on('click', function() {
      window.open('https://www.vwthemes.com/plugins/woocommerce-product-add-ons/', '_blank');
    })


})(jQuery);
