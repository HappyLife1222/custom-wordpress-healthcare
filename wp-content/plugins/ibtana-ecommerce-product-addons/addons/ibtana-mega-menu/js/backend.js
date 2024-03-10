/**
 * IEPA Mega Menu jQuery Plugin
 */
jQuery(function($) {

  /* Initial Tab Start */
  $('.imma-tab-wrap .imma-tab-links li:nth-child(1)').addClass('active');
  $('#imma-tab-one').addClass('active');

  $('.imma-tab-wrap .imma-tab-links li').click(function() {
    $('.imma-tab-wrap .imma-tab-links li').removeClass('active');
    $('#imma-tab-one').removeClass('active');
    $('.imma-tab-content-wrap .imma-content-wrap').removeClass('active');


    $(this).addClass('active');
    let current_tab = $(this).attr('imma-tab-id');
    $('#' + current_tab).addClass('active');

  });
  /* Initial Tab End */

  "use strict";

  // $('.imma-selection').selectbox();
  if ( typeof jQuery.fn.dropdown != "undefined" ) {
    $( '.imma-selection' ).selectpicker({
      showSubtext: true,
      size: 10
    });
  }


  $(document).on("click", function() {
    $('.menulistsicons_open').removeClass('list_open').addClass('list_close');
    $('.menulistsicons_close').removeClass('list_open').addClass('list_close');
  });

  $('.toggle_menu_icons').click(function(event) {
    event.stopPropagation();
    var id = $(this).attr('id');
    // $('.menulistsicons_'+id).slideToggle();
    if ($('.menulistsicons_' + id).hasClass('list_open')) {
      $('.menulistsicons_' + id).addClass('list_close').removeClass('list_open');
    } else {
      $('.menulistsicons_' + id).addClass('list_open').removeClass('list_close');
    }

    $('.menulistsicons_' + id + ' li.imma-menuicon').each(function() {
      $(this).click(function(event) {
        event.stopPropagation();
        var iconclass = $(this).find('i').attr('class');
        var html = "<i class='" + iconclass + "'></i>";
        $('#' + id).find('span').html(html);
        $('#' + id + '_menu_icon').val(iconclass);
      });
    });
  });



  /* create theme toggle */
  $(".imma-mm-slideToggle").click(function() {
    var idd = $(this).attr('id');
    $('.imma-mm-slideTogglebox_' + idd).slideToggle();
  });

  /* arrow type preview */
  $('.imma_mm_theme_arrow').on('change', function() {
    var arrow_type = $(this).val();
    $('.arrow_type').hide();
    $('.arrow_section').show();
    $('#arrow_' + arrow_type).show();
  });

  var selected_arrowtype = $('.imma_mm_theme_arrow option:selected').val();
  $('.arrow_type').hide();
  $('.arrow_section').show();
  $('#arrow_' + selected_arrowtype).show();

  $('.imma-mm-color-picker').wpColorPicker();

  /* check of follow_scroll div exists on page or not for visibility of save custom theme on page scroll */
  if ($('.follow-scroll').length > 0) {
    /* scroll save postbox on page scroll */
    var element = $('.follow-scroll'),
      originalY = element.offset().top;

    // Space between element and top of screen (when scrolling)
    var topMargin = 50;

    // Should probably be set in CSS; but here just for emphasis
    element.css('position', 'relative');

    $(window).on('scroll', function(event) {
      var scrollTop = $(window).scrollTop();

      element.stop(false, false).animate({
        top: scrollTop < originalY ?
          0 :
          scrollTop - originalY + topMargin
      }, 300);
    });
  }


  $('select.iepa-orientation').on('change', function() {
    var orientation = this.value;
    if (orientation == "vertical") {
      $('tr.imma_show_valigntype').show('slow');
    } else {
      $('tr.imma_show_valigntype').hide();
    }
  });

  var orientation_value = $('select.iepa-orientation option:selected').val();
  if (orientation_value == "vertical") {
    $('tr.imma_show_valigntype').show('slow');
  } else {
    $('tr.imma_show_valigntype').hide();
  }


  /*
   * WP Meta Box Settings
   */
  $(".imma-settings-box").each(function(index) {
    var thisRow = $(this);
    thisRow.find('select.iepa_theme_type').change(function() {
      var selected_value = this.value;

      if (selected_value == "available_skins") {
        thisRow.find('tr.iepa_show_themes').hide();
        thisRow.find('tr.iepa_show_skins').show('slow');
      } else {
        thisRow.find('tr.iepa_show_themes').show('slow');
        thisRow.find('tr.iepa_show_skins').hide();
      }
    });
  });

  $(".imma-settings-box").each(function(index) {
    var thisRow2 = $(this);
    var selectedval = thisRow2.find('select.iepa_theme_type option:selected').val();
    if (selectedval == "available_skins") {
      thisRow2.find('tr.iepa_show_themes').hide();
      thisRow2.find('tr.iepa_show_skins').show('slow');
    } else {
      thisRow2.find('tr.iepa_show_themes').show('slow');
      thisRow2.find('tr.iepa_show_skins').hide();
    }

  });


  $('body').on("click", ".icon-picker", function(e) {
    $(this).iconPicker();
  });


  //Manual code switcher
  $('.menu_shortcode').on('change', function() {
    var id = $(this).val();
    $('.iepamegamenu-integration-code').hide();
    $('#imma-integration-' + id).slideDown('slow');
  });

  var selected_menu = $('.menu_shortcode option:selected').val();
  $('#imma-integration-' + selected_menu).show();


  //Highlight code
  $('.highlightcode').on('click', function(e) {
    // SelectText( $(this)[0] );
    var doc = document,
      range, selection;
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(this).text()).select();
    document.execCommand("copy");
    var selection = window.getSelection();
    var range = doc.createRange();
    range.selectNodeContents($(this)[0]);
    selection.removeAllRanges();
    selection.addRange(range);
  });

  function imma_selectText(element) {
    var doc = document
      //, text = element //doc.getElementById(element)
      ,
      range, selection;
    if (doc.body.createTextRange) { //ms
      //console.log('windowselection'+doc.body.createTextRange);
      range = doc.body.createTextRange();
      range.moveToElementText(element);
      range.select();
    } else if (window.getSelection) { //all others
      //console.log('windowselection'+window.getSelection);
      selection = window.getSelection();
      range = doc.createRange();
      range.selectNodeContents(element);
      selection.removeAllRanges();
      selection.addRange(range);
    }
  }

  //  if($('#imma_custom_css').length > 0){
  //  var editor = CodeMirror.fromTextArea(document.getElementById("imma_custom_css"), {
  //                       lineNumbers: true,
  //                        autofocus: true,
  //                       matchBrackets: true,
  //                       styleActiveLine: true
  //                  });
  // }
  //  if($('#iepa_mm_custom_js').length > 0){
  //  var editor = CodeMirror.fromTextArea(document.getElementById("iepa_mm_custom_js"), {
  //                       lineNumbers: true,
  //                        autofocus: true,
  //                       matchBrackets: true,
  //                       styleActiveLine: true
  //                  });
  // }

  $('.tabs-left li a').on('click', function() {
    var bindtab = $(this).attr('href');
    if (bindtab == '#custom_theme_export' || bindtab == '#shortcode_menu_location' || bindtab == '#custom_theme_import') {
      $('#imma-mm-add-button').hide();
      $('#restore_settings_btn').hide();
    } else {
      $('#imma-mm-add-button').show();
      $('#restore_settings_btn').show();
    }
    if (bindtab == '#custom_css') {
      setTimeout(function() {
        // editor.refresh();
        codeMirrorDisplay();
      }, 100);

      //codeMirrorDisplay($('.iepa_mm_custom_js'));
    }


  });

  function codeMirrorDisplay() {
    var $codeMirrorEditors = $('.imma_custom');
    $codeMirrorEditors.each(function(i, el) {
      var $active_element = $(el);
      if ($active_element.data('cm')) {
        $active_element.data('cm').doc.cm.toTextArea();
      }
      var codeMirrorEditor = CodeMirror.fromTextArea(el, {
        lineNumbers: true,
        lineWrapping: true
        // autofocus: true
        // theme: 'eclipse'
      });
      $active_element.data('cm', codeMirrorEditor);
    });
  }
  codeMirrorDisplay();



  if (!document.getElementById("iepa_mm_uploadBtn")) {
    //It does not exist
  } else {
    document.getElementById("iepa_mm_uploadBtn").onchange = function() {
      document.getElementById("iepa_mm_uploadFile").value = this.value;
    };
  }


  /* widget script*/
  $('.show_image_options').hide();

  $('.widgets-holder-wrap,#iepa_menu_settings_frame').on('click', '.immashowimg', function() {
    if ($(this).is(":checked")) {
      $('.show_image_options').slideDown("slow");
    } else {
      $('.show_image_options').slideUp("slow");
    }
  });
  if ($('.immashowimg').is(":checked")) {
    $('.show_image_options').show();
  }

  $('.widgets-holder-wrap,#iepa_menu_settings_frame').on('change', '.immapro-listsize', function() {
    var valuee = $(this).val();
    if (valuee == "custom_size") {
      $('.smallfieldsize').slideDown("slow");
    } else {
      $('.smallfieldsize').slideUp("slow");
    }

  });

  $(document).on("click", ".imma_image_url", function(e) {
    e.preventDefault();
    var btnClicked = $(this);
    var btnClickedid = $(this).attr('id');
    var image = wp.media({
        title: 'Insert Image',
        button: {
          text: 'Insert Image'
        },
        library: {
          type: 'image'
        },
        multiple: false
      }).open()
      .on('select', function(e) {
        var uploaded_image = image.state().get('selection').first();
        // console.log(uploaded_image);
        var image_url = uploaded_image.toJSON().url;

        $(btnClicked).closest('p').find('.imma-image').attr('src', image_url);
        $(btnClicked).closest('p').find('.iepa-image-url').val(image_url);
        if ($(btnClicked).closest('p').find('.iepa-image-url').val(image_url) != '') {
          $('.imma-image').show();
        } else {
          $('.imma-image').hide();
        }


      });
  });

  /* Widget Featured Box Layout */
  var count = 0;
  $("body").on('click', '.iepa-add-featuredbox', function(event) {
    event.preventDefault();
    var additional = $(this).parent().parent().find('.imma-additional');
    if ($(this).parent().parent().parent().parent().hasClass('imma_widget_area')) {
      var container = $(this).parent().parent().parent().parent();
      var container_class = container.attr('data-id');
    } else {
      var container = $(this).parent().parent().parent().parent();
      var container_class = container.attr('id');
    }

    var container_class_array = container_class.split("iepa_featured_box_layout-").reverse();
    var instance = container_class_array[0];
    count = additional.find('.iepa-featured-section').length;
    var totalcount = count + 1;

    additional.append(
      '<div class="iepa-featured-section"><div class="sub-option section widget-icon-class"><h3>Box ' + totalcount + '</h3>' +
      '<label for="widget-iepa_featured_box_layout[' + instance + '][features][' + count + '][fonticon_class]">Font Icon Class :</label>' +

      '<input class="widefat parallax-img upload" id="widget-iepa_featured_box_layout-' + instance + '-features-' + count + '-fonticon_class" name="widget-iepa_featured_box_layout[' + instance + '][features][' + count + '][fonticon_class]" type="text" placeholder="fa fa-home" />' +

      '<label for="widget-iepa_featured_box_layout[' + instance + '][features][' + count + '][titletag]">Title Tag :</label>' +
      '<input class="widefat" id="widget-iepa_featured_box_layout-' + instance + '-features-' + count + '-titletag" name="widget-iepa_featured_box_layout[' + instance + '][features][' + count + '][titletag]" type="text" value="" />' +

      '<label for="widget-iepa_featured_box_layout[2][' + instance + '][features][' + count + '][firstlink]">URL Link :</label>' +
      '<input class="widefat" id="widget-iepa_featured_box_layout-' + instance + '-features-' + count + '-firstlink" name="widget-iepa_featured_box_layout[' + instance + '][features][' + count + '][firstlink]" type="url" value="" />' +

      '<label for="widget-iepa_featured_box_layout[2][' + instance + '][features][' + count + '][description]">Description :</label>' +
      '<textarea class="widefat" id="widget-iepa_featured_box_layout-' + instance + '-features-' + count + '-description" name="widget-iepa_featured_box_layout[' + instance + '][features][' + count + '][description]"/></textarea> <a class="iepamegamenu-remove delete">Remove Feature</a></div>'
    );
  });


  $("body").on('click', '.iepamegamenu-remove', function(event) {
    event.preventDefault();
    $(this).parent().parent().remove();
  });

  /* Widget Posts By category*/
  var slayout = $('.iepa-posts-layout option:selected').val();
  $('#my_' + slayout).css('display', 'block');
  $("body").on('change', '.iepa-posts-layout', function(event) {
    event.preventDefault();
    var layouttype = $(this).val();
    if (layouttype == 'layout1') {
      $('.iepa-post-display-section #my_layout1').css('display', 'block');
      $('.iepa-post-display-section #my_layout2').css('display', 'none');
      $('.iepa-post-display-section #my_layout3').css('display', 'none');
    } else if (layouttype == "layout2") {
      $('.iepa-post-display-section #my_layout2').css('display', 'block');
      $('.iepa-post-display-section #my_layout1').css('display', 'none');
      $('.iepa-post-display-section #my_layout3').css('display', 'none');
    } else {
      $('.iepa-post-display-section #my_layout3').css('display', 'block');
      $('.iepa-post-display-section #my_layout2').css('display', 'none');
      $('.iepa-post-display-section #my_layout1').css('display', 'none');
    }
  });

  /* Widget Posts By category*/
  var playout = $('.imma-posts-layout2 option:selected').val();
  $('#' + playout).css('display', 'block');
  $("body").on('change', '.imma-posts-layout2', function(event) {
    event.preventDefault();
    var layouttype = $(this).val();
    if (layouttype == 'hoverlayout1') {
      $('.imma-post-display-section2 #hoverlayout1').css('display', 'block');
      $('.imma-post-display-section2 #hoverlayout2').css('display', 'none');
      $('.imma-post-display-section2 #hoverlayout3').css('display', 'none');
    } else if (layouttype == "hoverlayout2") {
      $('.imma-post-display-section2 #hoverlayout2').css('display', 'block');
      $('.imma-post-display-section2 #hoverlayout1').css('display', 'none');
      $('.imma-post-display-section2 #hoverlayout3').css('display', 'none');
    } else {
      $('.imma-post-display-section2 #hoverlayout3').css('display', 'block');
      $('.imma-post-display-section2 #hoverlayout1').css('display', 'none');
      $('.imma-post-display-section2 #hoverlayout2').css('display', 'none');
    }
  });


  $("body").on('change', '.iepa-posts-layout', function(event) {
    event.preventDefault();
    var layouttype = $(this).val();
    if (layouttype == 'layout1') {
      $('.immapro-widget-layout-options[data-option="12_Layout"]').show();
      $('.immapro-widget-layout-options[data-option="123_Layout"]').show();
    } else if (layouttype == "layout2") {
      $('.immapro-widget-layout-options[data-option="12_Layout"]').show();
      $('.immapro-widget-layout-options[data-option="123_Layout"]').show();
    } else {
      $('.immapro-widget-layout-options[data-option="12_Layout"]').hide();
      $('.immapro-widget-layout-options[data-option="123_Layout"]').show();
    }
  });


  // IEPA: Post Taxonomy Layout JS START
  $( "body" ).on( 'click', '.iepa-pctl-add-term', function( event ) {
    event.preventDefault();

    var cards_count         = $( this ).closest( 'form' ).find('.iepa-pctl-container .iepa-pctl-content').length;
    var cards_total_count   = 1 + cards_count;

    var $imma_widget_area   = $(this).closest('.imma_widget_area');
    var imma_widget_area_id = $imma_widget_area.attr('id');

    var imma_widget_area_id_array = imma_widget_area_id.split('iepa_post_category_tabs_widget-').reverse();
    var instance                  = imma_widget_area_id_array[0];

    $( this ).closest( 'form' ).find( '.iepa-pctl-container' ).append(
      `<div class="iepa-pctl-content">
        <h3>Term ${cards_total_count}</h3>

        <p>
          <label for="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][label]">Label: </label>
          <input type="text" name="widget-iepa_post_category_tabs_widget[${instance}][filters][${cards_count}][label]" value="Browse By Uncategorized" id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][label]">
        </p>

        <p>
          <label for="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][taxonomy]">Select Taxonomy: </label>
          <select class="widefat" name="widget-iepa_post_category_tabs_widget[${instance}][filters][${cards_count}][taxonomy]" id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][taxonomy]">
          </select>
        </p>

        <p>
          <label for="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][term]">Select Term: </label>
          <select class="widefat" name="widget-iepa_post_category_tabs_widget[${instance}][filters][${cards_count}][term]" id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][term]">
          </select>
        </p>

        <p>
          <label for="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][postmeta]">Select Post Meta: </label>
          <select class="widefat" name="widget-iepa_post_category_tabs_widget[${instance}][filters][${cards_count}][postmeta][]" id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][postmeta]" multiple="">
          </select>
        </p>
        <p class="description">Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</p>

        <p>
          <label for="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][view_all_link]">View All Link: </label>
          <input type="text" class="widefat" name="widget-iepa_post_category_tabs_widget[${instance}][filters][${cards_count}][view_all_link]" id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][view_all_link]">
        </p>

        <a class="iepa-pctl-remove-content">Remove</a>
      </div>`
    );

    var $selected_taxonomy  = $( this ).closest( 'form' ).find( `[name="widget-iepa_post_category_tabs_widget[${instance}][selected_taxonomy]"]` );

    var select_val          = $selected_taxonomy.val();
    var val_arr             = select_val.split( ' - ' );
    var post_type           = val_arr[0];
    var option_tabs         = $selected_taxonomy.find( 'option[value*="' + post_type + ' - "]' );

    $.each( option_tabs, function ( key, option_el ) {
      var option_el_val = $(option_el).val();
      var option_el_tax = option_el_val.split( ' - ' )[1];
      $( `[id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][taxonomy]"]` ).append(
        `<option value="${option_el_tax}">${$(option_el).text()}</option>`
      );
    });
    $( `[id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][taxonomy]"]` ).trigger( 'change' );

    // postmeta multiple select START
    var iepa_pctl_postmeta_json = JSON.parse( $( this ).closest( 'form' ).find( '.iepa-pctl-postmeta-json' ).html() );
    var postmeta                = iepa_pctl_postmeta_json[post_type];
    for ( var i = 0; i < postmeta.length; i++ ) {
      var single_postmeta = postmeta[i];
      $( `[id="widget-iepa_post_category_tabs_widget-${instance}-filters[${cards_count}][postmeta]"]` ).append(
        `<option value="${single_postmeta}">${single_postmeta}</option>`
      );
    }
    // postmeta multiple select END
  });

  $( "body" ).on( 'change', '[name*="widget-iepa_post_category_tabs_widget"][name*="display_posts_by_terms"]', function( event ) {
    if ( $(this).is(":checked") ) {
      $(this).closest( 'form' ).find( '.iepa-pctl-container' ).show();
      $(this).closest( 'form' ).find( '.iepa-pctl-add-term' ).show();
    } else {
      $(this).closest( 'form' ).find( '.iepa-pctl-container' ).hide();
      $(this).closest( 'form' ).find( '.iepa-pctl-add-term' ).hide();
    }
  });

  $( "body" ).on( 'click', '.iepa-pctl-remove-content', function( event ) {
    event.preventDefault();
    $(this).closest('.iepa-pctl-content').remove();
  });

  //
  $( 'body' ).on( 'change', '[name*="widget-iepa_post_category_tabs_widget"][name*="[selected_taxonomy]"]', function() {
    var $this_select  = $( this );
    var select_val    = $this_select.val();
    var val_arr       = select_val.split( ' - ' );

    // Select Post Taxonomy Terms START
    var taxonomy_type = val_arr[1];
    var iepa_pctl_terms_json  = JSON.parse( $this_select.closest( 'form' ).find( '.iepa-pctl-terms-json' ).html() );
    $this_select.closest( 'form' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="[selected_taxonomy_terms]"]' ).empty();
    $.each( iepa_pctl_terms_json, function ( iepa_pctl_term_key, iepa_pctl_term_value ) {
      if ( taxonomy_type == iepa_pctl_term_value.taxonomy ) {
        $this_select.closest( 'form' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="[selected_taxonomy_terms]"]' ).append(
          `<option value="`+iepa_pctl_term_value.slug+`">`+iepa_pctl_term_value.name+`</option>`
        );
      }
    });
    // Select Post Taxonomy Terms END

    var post_type     = val_arr[0];
    var option_tabs   = $this_select.find( 'option[value*="' + post_type + ' - "]' );
    $this_select.closest( 'form' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="filters"][name*="taxonomy"]' ).empty();
    $.each( option_tabs, function ( key, option_el ) {
      var option_el_val = $(option_el).val();
      var option_el_tax = option_el_val.split( ' - ' )[1];
      $this_select.closest( 'form' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="filters"][name*="taxonomy"]' ).append(
        `<option value="${option_el_tax}">${$(option_el).text()}</option>`
      );
    });
    $this_select.closest( 'form' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="filters"][name*="taxonomy"]' ).trigger( 'change' );


    // postmeta multiple select START
    var iepa_pctl_postmeta_json = JSON.parse( $( this ).closest( 'form' ).find( '.iepa-pctl-postmeta-json' ).html() );
    var postmeta                = iepa_pctl_postmeta_json[post_type];
    $(this).closest( 'form' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="[filters]"][name*="[postmeta][]"]' ).empty();
    for ( var i = 0; i < postmeta.length; i++ ) {
      var single_postmeta = postmeta[i];
      $(this).closest( 'form' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="[filters]"][name*="[postmeta][]"]' ).append(
        `<option value="${single_postmeta}">${single_postmeta}</option>`
      );
    }
    // postmeta multiple select END
  });

  //
  $( 'body' ).on( 'change', '[name*="widget-iepa_post_category_tabs_widget"][name*="filters"][name*="taxonomy"]', function() {
    var $this_tax_select      = $(this);
    var tax_select_val        = $this_tax_select.val();

    var iepa_pctl_terms_json  = JSON.parse( $this_tax_select.closest( 'form' ).find( '.iepa-pctl-terms-json' ).html() );

    var $term_select  = $this_tax_select.closest( '.iepa-pctl-content' ).find( '[name*="widget-iepa_post_category_tabs_widget"][name*="filters"][name*="term"]' );

    $term_select.empty();
    $.each( iepa_pctl_terms_json, function( key, obj ) {
      if ( tax_select_val != obj.taxonomy ) {
        return;
      }
      $term_select.append(
        `<option value="${obj.slug}">${obj.name}</option>`
      );
    });
  });
  // IEPA: Post Taxonomy Layout JS END

});
