jQuery(function($) {

  var __ = wp.i18n.__;

  $(".nav-tabs li").click(function(e){
    e.preventDefault();
    $(".nav-tabs li").removeClass('active');
    $(this).addClass('active');
    let tid = $(this).find('a').attr('href');
    $('.tab-pane').removeClass('active in');
    $(tid).addClass('active in');
  });

  $( '#custom-posttype-addon-taxonomy-form' ).on( 'submit', function(e) {
    if ( !$(this).find('input[type="checkbox"][name*="posttype"]:checked').length ) {
      e.preventDefault();
      alert( __( 'Please select a post type to associate with.' ) );
    }
  } );

  $('#taxonomy .icpa_add_taxonomy').click(function(e){
    if ($("#taxonomy .field_icpa :checkbox:checked").length == 0) {
      alert( __( 'Please select a post type to associate with.' ) );
      e.preventDefault();
    }
  });

  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get('tab');
  if (myParam == 'taxonomy_tab') {
    $(".taxonomy_tab a").click();
  }

});
