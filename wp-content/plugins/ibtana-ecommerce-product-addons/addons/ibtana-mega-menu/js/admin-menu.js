/**
 * IEPA Mega Menu - 2.0.8 version Admin JS Script
 */

jQuery(function($) {
  "use strict";
  var AjaxUrl                 = iepa_mm_variable.ajax_url;
  var admin_nonce             = iepa_mm_variable.ajax_nonce;
  var saved_success_message   = iepa_mm_variable.success_msg;
  var menu_lightbox           = iepa_mm_variable.menu_lightbox;
  var checked_disabled_error  = iepa_mm_variable.checked_disabled_error;
  var saving_data             = iepa_mm_variable.saving_msg;
  var plugin_javascript_path  = iepa_mm_variable.plugin_javascript_path;
  var depth_check             = iepa_mm_variable.depth_check_message;
  var editmsg                 = iepa_mm_variable.group_edit_message;
  var check_version           = iepa_mm_variable.check_version;
  var is_ive_loaded           = iepa_mm_variable.is_ive_loaded;


  //IEPA Mega Menu Settings submit button save data
  $(".iepa-mega-menu-save").on('click', function(e) {
    e.preventDefault();
    // retrieve the widget settings form
    var iepa_settings = JSON.stringify($("[name^='iepammmegamenu_meta']").serializeArray());
    $.ajax({
      url: AjaxUrl,
      type: 'post',
      data: {
        action: "iepammsavesettings",
        wp_menu_id: $('#menu').val(),
        im_menuaddon_meta: iepa_settings,
        wp_nonce: admin_nonce
      },
      beforeSend: function() {
        $(".nav-menu-theme-iepamegamenus .iepa_mm_loader").css('display', 'block');
      },
      complete: function() {
        $(".nav-menu-theme-iepamegamenus .iepa_mm_loader").css('display', 'none');
        $(".nav-menu-theme-iepamegamenus .iepamm_success").show();
      },
      success: function(res) {
        $(".nav-menu-theme-iepamegamenus .iepa_mm_loader").css('display', 'none');
        $(".nav-menu-theme-iepamegamenus .iepamm_success").html(saved_success_message).delay(5000).fadeOut('slow');
        location.reload();
      }
    });

  });

  /* checked if wp mega menu is enabled or not and add body class */
  var iepa_mm_enabled_class = function() {
    if ($('input.iepammmegamenu_enabled:checked') && $('input.iepammmegamenu_enabled:checked').length) {
      $('body').addClass('iepa_megamenu_enabled');
    } else {
      $('body').removeClass('iepa_megamenu_enabled');
    }
  }

  $('input.iepammmegamenu_enabled').on('change', function() {
    iepa_mm_enabled_class();
  });

  iepa_mm_enabled_class();

  $('#iepamegamenu_accordion').accordion({
    heightStyle: "content",
    collapsible: true,
    active: false,
    animate: 200
  });

  if (parseInt(is_ive_loaded) == 1) {
    $('#menu-to-edit li.menu-item').each(function() {
      var menu_item = $(this);
      var menu_id = $('input#menu').val();
      var menu_title = menu_item.find('.menu-item-title').text();
      if (!menu_title) {
        menu_title = menu_item.find('.item-title').text();
      }
      var id = parseInt(menu_item.attr('id').match(/[0-9]+/)[0], 10);
      var button = $("<span>").addClass("iepa_launch")
        .html(menu_lightbox)
        .on('click', function(e) {
          e.preventDefault();

          if (!$('body').hasClass('iepa_megamenu_enabled')) {
            alert(checked_disabled_error);
            return;
          }

          var depth = menu_item.attr('class').match(/\menu-item-depth-(\d+)\b/)[1];

          $.ajax({
            url: AjaxUrl,
            type: 'post',
            data: {
              action: "iepa_mm_show_lightbox_html",
              menu_item_id: id,
              menu_item_title: menu_title,
              menu_item_depth: depth,
              menu_id: menu_id,
              wp_nonce: admin_nonce,
            },
            cache: false,
            beforeSend: function() {
              $('.iepa_menu_wrapper .iepa_overlay').css('display', 'block');
              $('.iepa_menu_wrapper .close_btn').css('display', 'block');
            },
            complete: function() {
              $('.iepa_overlay').css('display', 'block');
              $('#iepa_menu_settings_frame').css('display', 'block');
              $('.iepa_menu_wrapper .close_btn').css('display', 'block');
              // fix for WordPress 4.8 widgets when lightbox is opened, closed and reopened
              if (wp.textWidgets !== undefined) {
                wp.textWidgets.widgetControls = {}; // WordPress 4.8 Text Widget
              }

              if (wp.mediaWidgets !== undefined) {
                wp.mediaWidgets.widgetControls = {}; // WordPress 4.8 Media Widgets
              }

              if (wp.customHtmlWidgets !== undefined) {
                wp.customHtmlWidgets.widgetControls = {}; // WordPress 4.9 Custom HTML Widgets
              }
            },
            success: function(res) {
              $('.iepa_menu_wrapper .imma_main_content').html(res);
              var depth_class = $('#imma_menu_' + id).attr('data-depth');
              $('.icon-picker-input').iconPicker();

              $('#imma_menu_' + id + ' .imma-mm-color-picker').wpColorPicker();

              /*
               * CKEDITOR HTML CONTENT FOR TOP AND BOTTOM SECTION
               */
              /* if(depth_class == "depth_0"){

                var editor =  CKEDITOR.replace( 'imma_html_content',{
                  uiColor: '#dfdfdf',
                  stylesSet: 'my_custom_style',
                  allowedContent: true,
                  width: '600px',
                  height: '200px',
                  filebrowserBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Images',
                  filebrowserFlashBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Flash',
                  filebrowserUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                  filebrowserImageUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                  filebrowserWindowWidth : '1000',
                  filebrowserWindowHeight : '700'
              });
                var changesCount = 0;
                var changesCount2 = 0;
                editor.on( 'change', function ( ev ) {
                 changesCount++;
                           // document.getElementById( 'content2' ).style.display = '';
                           document.getElementById( 'changes' ).innerHTML = changesCount.toString();
                           document.getElementById( 'tophtmlcontent' ).innerHTML = editor.getData();
                       } );

                var beditor =  CKEDITOR.replace( 'imma_html_content2',{
                  uiColor: '#dfdfdf',
                  stylesSet: 'my_custom_style',
                  allowedContent: true,
                  width: '600px',
                  height: '200px',
                  filebrowserBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Images',
                  filebrowserFlashBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Flash',
                  filebrowserUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                  filebrowserImageUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                  filebrowserWindowWidth : '1000',
                  filebrowserWindowHeight : '700'
              });

                beditor.on( 'change', function ( ev ) {
                 changesCount2++;
                 document.getElementById( 'changes2' ).innerHTML = changesCount2.toString();
                 document.getElementById( 'bottomhtmlcontent' ).innerHTML = beditor.getData();
             } );
            }
           CKEDITOR HTML CONTENT FOR TOP AND BOTTOM SECTION END*/
              //var editorIdd = $('#imma_html_content_'+id);

              if (check_version == "addeditor") {
                $("#imma_choose_topcontent_type option[value='html']").removeAttr('disabled');
                $("#imma_choose_bottomcontent_type option[value='html']").removeAttr('disabled');
                var key = $('#imma_menu_' + id).find('.imma_key_unique').val();
                var key1 = "imma_html_content";
                var key21 = "imma_html_content_" + id + '_' + key;
                // this is need for the tabs to work
                quicktags({
                  id: key21
                }); // use wordpress settings
                tinymce.init({
                  selector: key21,
                  selector: "#" + key21,
                  theme: "modern",
                  skin: "lightgray",
                  language: "en",
                  formats: {
                    alignleft: [{
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
                        styles: {
                          textAlign: 'left'
                        }
                      },
                      {
                        selector: 'img,table,dl.wp-caption',
                        classes: 'alignleft'
                      }
                    ],
                    aligncenter: [{
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
                        styles: {
                          textAlign: 'center'
                        }
                      },
                      {
                        selector: 'img,table,dl.wp-caption',
                        classes: 'aligncenter'
                      }
                    ],
                    alignright: [{
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
                        styles: {
                          textAlign: 'right'
                        }
                      },
                      {
                        selector: 'img,table,dl.wp-caption',
                        classes: 'alignright'
                      }
                    ],
                    strikethrough: {
                      inline: 'del'
                    }
                  },
                  relative_urls: false,
                  remove_script_host: false,
                  convert_urls: false,
                  browser_spellcheck: true,
                  fix_list_elements: true,
                  entities: "38,amp,60,lt,62,gt",
                  entity_encoding: "raw",
                  keep_styles: false,
                  paste_webkit_styles: "font-weight font-style color",
                  preview_styles: "font-family font-size font-weight font-style text-decoration text-transform",
                  wpeditimage_disable_captions: false,
                  wpeditimage_html5_captions: true,
                  plugins: "charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview",
                  resize: "vertical",
                  menubar: false,
                  wpautop: true,
                  height: 200,
                  width: 700,
                  indent: false,
                  toolbar1: "bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv",
                  toolbar2: "formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
                  toolbar3: "",
                  toolbar4: "",
                  tabfocus_elements: ":prev,:next",
                  body_class: "id post-type-post post-status-publish post-format-standard",
                });
                // this is needed for the editor to initiate
                tinyMCE.execCommand('mceAddEditor', false, key21);

                var key24 = "imma_html_content_" + key;
                quicktags({
                  id: key24
                });
                // use wordpress settings
                tinymce.init({
                  selector: key24,
                  selector: "#" + key24,
                  theme: "modern",
                  skin: "lightgray",
                  language: "en",
                  formats: {
                    alignleft: [{
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
                        styles: {
                          textAlign: 'left'
                        }
                      },
                      {
                        selector: 'img,table,dl.wp-caption',
                        classes: 'alignleft'
                      }
                    ],
                    aligncenter: [{
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
                        styles: {
                          textAlign: 'center'
                        }
                      },
                      {
                        selector: 'img,table,dl.wp-caption',
                        classes: 'aligncenter'
                      }
                    ],
                    alignright: [{
                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
                        styles: {
                          textAlign: 'right'
                        }
                      },
                      {
                        selector: 'img,table,dl.wp-caption',
                        classes: 'alignright'
                      }
                    ],
                    strikethrough: {
                      inline: 'del'
                    }
                  },
                  relative_urls: false,
                  remove_script_host: false,
                  convert_urls: false,
                  browser_spellcheck: true,
                  fix_list_elements: true,
                  entities: "38,amp,60,lt,62,gt",
                  entity_encoding: "raw",
                  keep_styles: false,
                  paste_webkit_styles: "font-weight font-style color",
                  preview_styles: "font-family font-size font-weight font-style text-decoration text-transform",
                  wpeditimage_disable_captions: false,
                  wpeditimage_html5_captions: true,
                  plugins: "charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview",
                  resize: "vertical",
                  menubar: false,
                  wpautop: true,
                  indent: false,
                  toolbar1: "bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv",
                  toolbar2: "formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
                  toolbar3: "",
                  toolbar4: "",
                  height: 200,
                  width: 700,
                  tabfocus_elements: ":prev,:next",
                  body_class: "id post-type-post post-status-publish post-format-standard",
                });
                // this is needed for the editor to initiate
                tinyMCE.execCommand('mceAddEditor', false, key24);

              } else {
                $("#imma_choose_topcontent_type option[value='html']").attr('disabled', 'disabled');
                $("#imma_choose_bottomcontent_type option[value='html']").attr('disabled', 'disabled');
                $('.toggle_html').hide();
                $('.toggle_bhtml').hide();
              }



              if (depth_class != "depth_0") {
                $(".imma_menu_align").prop('disabled', 'disabled');
                $('.depth_check').html(depth_check);
                $('.hide_fortopmenu').show();
                if ($('.imma_menu_item_title').val() == "[Tabs]" || $('.imma_menu_item_title').val() == "[HTabs]") {
                  $('.show_for_tabbed').show();
                }
              } else {
                $('.hide_fortopmenu').hide();
                $('.show_for_tabbed').hide();
              }

              /*
               *  TABS MENU
               */
              $('#imma_menu_' + id + ' .imma_tabs').on('click', function() {
                $('#imma_menu_' + id + ' .imma_tabs').removeClass('active');
                var tab_id = $(this).attr('id');

                // if (tab_id == "im_menu_addon") {
                //   $('.main_submit_section').hide();
                // } else {
                //   $('.main_submit_section').show();
                // }
                $(this).addClass('active');
                // $('#imma_menu_' + id + ' .tab-pane').css('display', 'none');
                $('#imma_menu_' + id + ' .iepa_content_rtsection #tab_' + tab_id).css('display', 'block');
              });

              $('#imma_menu_' + id + ' .imma_tabs').each(function() {
                if ($(this).hasClass("active")) {
                  var tabid = $(this).attr('id');
                  // if (tabid == "im_menu_addon") {
                  //   $('.main_submit_section').hide();
                  // } else {
                  //   $('.main_submit_section').show();
                  // }
                  // $('#imma_menu_' + id + ' .tab-pane').css('display', 'none');
                  $('#imma_menu_' + id + ' .iepa_content_rtsection #tab_' + tabid).css('display', 'block');
                }
              });
              /* tabs menu closed*/

              $( '#imma_menu_' + id + ' .tab-pane .settings_title' ).on( 'click', function() {
                $( this ).closest( '.tab-pane' ).toggleClass( 'active' );
              });

              /************************************* ROLES AND RESTRICTION TABS SECTION START ****************************************/
              $('.imma-by-role').hide();
              $('#imma_menu_' + id + ' .imma_display_mode').on('change', function() {
                var mode = $(this).val();
                if (mode == "by_role") {
                  $('#imma_menu_' + id + ' .imma-by-role').show();
                } else {
                  $('#imma_menu_' + id + ' .imma-by-role').hide();
                }

              });
              var rmode = $('#imma_menu_' + id + ' .imma_display_mode option:selected').val();
              // alert(rmode);
              if (rmode == "by_role") {
                $('#imma_menu_' + id + ' .imma-by-role').show();
              } else {
                $('#imma_menu_' + id + ' .imma-by-role').hide();
              }

              /************************************* CHOOSE GROUP AND SAVE DATA START ****************************************/
              var grpwidgets = new Array();
              var group_results = new Array();

              /*
               * Check if multiple group or not and check if new sub menu items added recently.
               */
              var groupwisewidgets = new Array();
              var selected_grptype = $('#imma_menu_' + id + ' #immam_choose_group option:selected').val();
              if (selected_grptype == "single") {
                $('#imma_menu_' + id + ' .imma_single_group_section').css('display', 'block');
                $('#imma_menu_' + id + ' .imma_mega_settings_multiple').css('display', 'none');
                $('.multiple_button').hide();
              } else {
                $('#imma_menu_' + id + ' .imma_single_group_section').css('display', 'none');
                $('#imma_menu_' + id + ' .imma_mega_settings_multiple').css('display', 'block');
                $('.multiple_button').show();
              }
              if (selected_grptype == "multiple") {
                var group_ref = 1;
                var group_fields = new Array();
                $('.imma_widgets_setup[data-group-ref="' + group_ref + '"] .imma_widget_areaa').each(function() {
                  var field_name = $(this).attr('data-id');
                  group_fields.push(field_name);

                });

                var setwidgets = group_fields.join();
                $('input[data-group-widget-ref="1"]').val(setwidgets);
                $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                  var groupnum = $(this).attr('data-group-widget-ref');
                  var widgets_det = $(this).val();
                  groupwisewidgets.push({
                    group_no: groupnum,
                    lists: widgets_det
                  });

                });
                var widgetdata = {
                  action: "iepa_mm_add_selected_widget_lists",
                  menu_item_id: id, //menu_item_id
                  widget_details: groupwisewidgets,
                  group_type: 'multiple',
                  _wpnonce: admin_nonce,
                  // dataType: 'html'
                };

                $.post(AjaxUrl, widgetdata, function(response) {
                  $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                  groupwisewidgets = [];
                });
              }
              $('#imma_menu_' + id + ' #immam_choose_group').change(function() {
                var grouptype = $(this).val();
                // alert($('#imma_menu_'+id+' .imma_mega_settings_multiple .imma-groups-lists').children().length);
                if (grouptype == "single") {
                  $('#imma_menu_' + id + ' .imma_single_group_section').css('display', 'block');
                  $('#imma_menu_' + id + ' .imma_mega_settings_multiple').css('display', 'none');
                  $('.multiple_button').hide();
                } else {
                  $('#imma_menu_' + id + ' .imma_single_group_section').css('display', 'none');
                  $('#imma_menu_' + id + ' .imma_mega_settings_multiple').css('display', 'block');
                  $('.multiple_button').show();
                }

                $('#imma_menu_' + id).find('.save_ajax_data').show();
                $('#imma_menu_' + id).find('.saving_message').text(saving_data);
                var menutypee = $('#imma_menu_' + id + ' #imma_enable_mega_menu').val();

                if (grouptype == "multiple") {
                  $('#imma_menu_' + id + ' .imma-groups-lists .iepa-group-trigger').each(function() {
                    var group_num = $(this).attr('data-group-ref');
                    var group_column = $(this).attr('data-columns');
                    group_results.push({
                      group_no: group_num,
                      column: group_column
                    });
                  });
                  // $('#imma_menu_'+id+' .imma_mega_settings_multiple .imma-groups-lists').children().length >= 1 &&
                }

                /* insert sub menu data for first time as multiple group selected start*/
                var first_group_fields = new Array();
                $('.imma_widgets_setup[data-group-ref=1] .imma_widget_areaa').each(function() {
                  var field_name = $(this).attr('data-id');
                  first_group_fields.push(field_name);

                });

                var setwidgets = first_group_fields.join();
                $('input[data-group-widget-ref="1"]').val(setwidgets);
                /* insert sub menu data for first time as multiple group selected end*/

                $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                  var groupnum = $(this).attr('data-group-widget-ref');
                  var widgets_det = $(this).val();
                  grpwidgets.push({
                    group_no: groupnum,
                    lists: widgets_det
                  });

                });
                // console.log(grpwidgets);
                // console.log(grpwidgets.length);
                if (typeof grpwidgets !== 'undefined' && grpwidgets.length > 0) {
                  // the array is defined and has at least one element
                  var ww = grpwidgets;
                  var checked = "grouplists";
                } else {
                  var ww = $('.imma_widgetlists').val();
                  var checked = "nogrouplists";
                }

                var menu_type_data = {
                  action: "iepa_mm_save_menuitem_settings",
                  iepa_settings: {
                    menu_type: menutypee,
                    group_type: grouptype,
                    total_results: group_results,
                    submenulists: ww,
                    checked_lists: checked
                  },
                  iepa_mm_menu_item_id: id,
                  _wpnonce: admin_nonce
                };
                $.post(AjaxUrl, menu_type_data, function(new_response) {
                  group_results = [];
                  grpwidgets = [];
                  first_group_fields = [];
                  $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                });
              });

              /* CASE 1 END */
              /**************************************** GROUP SECTION CODE START *************************************************************/
              /*
               *  GROUP COLUMN WISE ADD JQUERY SECTION (ADD)
               */
              $('#imma_menu_' + id + ' .multiple_button .add-mulitple-group').on('click', function() {
                $('#imma-popup-wrap-' + id).fadeIn(500);
                $('#imma-popup-wrap-' + id + ' .iepa-group-title').focus();
                $('#imma-popup-wrap-' + id + ' #popup_type').val('add');
                $('#imma-popup-wrap-' + id + ' .imma-add-group-btn').val('ADD GROUP');
                $('#imma-popup-wrap-' + id + ' #imma_columns-num option[value=2]').attr('selected', 'selected');
                var totl_group = $('#imma_menu_' + id + ' .iepa-field-total-group').val();
                var totalset_count = $("#imma_menu_" + id + " .imma-groups-lists li").length;

                if (totalset_count == 0) {
                  var new_group = parseInt(totl_group) + 1;
                } else {
                  var new_group = parseInt(totalset_count) + 1;
                }
                $('#imma-popup-wrap-' + id + ' .iepa-group-title').val('Group ' + new_group);
              });
              /*
               *  GROUP COLUMN WISE ADD JQUERY SECTION (EDIT)
               */
              $('#imma_menu_' + id + ' .imma-groups-lists').on('click', 'span.iepa-group-column-editer', function() {
                var groupnumber = $(this).parent().attr('data-group-name');
                var groupinnumber = $(this).parent().attr('data-group-ref');
                var original_groupcol = $(this).parent().attr('data-columns');
                $('#imma-popup-wrap-' + id).fadeIn(500);
                $('#imma-popup-wrap-' + id + ' .iepa-group-title').focus();
                $('#imma-popup-wrap-' + id + ' #popup_type').val('edit');
                $('#imma-popup-wrap-' + id + ' .iepa-group-title').val(groupnumber);
                $('#imma-popup-wrap-' + id + ' .imma_group_in_number').val(groupinnumber);
                $('#imma-popup-wrap-' + id + ' .imma-add-group-btn').val('EDIT GROUP');
                $('#imma-popup-wrap-' + id + ' #imma_columns-num option[value=' + original_groupcol + ']').attr('selected', 'selected');

              });
              /*
               *  GROUP COLUMN WISE ADD JQUERY SECTION (Hide overlay)
               */
              $('#imma_menu_' + id + ' .imma-overlay').click(function() {
                $('#imma_menu_' + id + ' .imma-popup-wrap').fadeOut(200);
              });

              $('#imma_menu_' + id + ' .iepa-add-widget-tool_by_grp').on('click', function() {
                $('#imma_menu_' + id).find('.imma_widget_iframe').show();
              });

              /*
               *  GROUP COLUMN WISE ADD JQUERY SECTION (SAVE ADDED/EDITED GROUP WISE COLUMN DATA)
               */
              var group_colum_array = new Array();
              var group_widgets = new Array();
              var results = new Array();
              var groups_widgs = new Array();
              $('#imma_menu_' + id + ' #imma-popup-wrap-' + id + ' .imma-add-group-btn').on('click', function() {
                var popup_type = $('#imma-popup-wrap-' + id + ' .imma_popup_type').val();

                if (popup_type == "edit") {
                  var group_numm = $('#imma-popup-wrap-' + id + ' .imma_group_in_number').val();
                  var new_group_column = $('#imma_menu_' + id + ' #imma_columns-num').val();

                  //multiple
                  $('.imma-groups-lists li[data-group-ref="' + group_numm + '"]').attr('data-columns', new_group_column);
                  $('.imma-groups-lists li[data-group-ref="' + group_numm + '"]').find('span.iepa-group-col').html('( Column ' + new_group_column + ')');
                  $('.imma_field_groups[data-group-fields-ref="' + group_numm + '"]').attr('data-group-column-ref', new_group_column);

                  $('#imma_menu_' + id + ' .imma_group_add_components').find(".imma_widgets_setup[data-group-ref='" + group_numm + "']").attr('data-columns', new_group_column);
                  $('#imma_menu_' + id + ' .imma_group_add_components').find(".imma_widgets_setup[data-group-ref='" + group_numm + "']").find(".imma_widget-total-cols").html(new_group_column);


                  $('.imma_field_groups').each(function() {
                    var groupnumber = $(this).attr('data-group-fields-ref');
                    var column_number = $(this).attr('data-group-column-ref');
                    group_colum_array.push({
                      group_no: groupnumber,
                      column: column_number
                    });
                  });

                  $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                    var groupnum = $(this).attr('data-group-widget-ref');
                    var widgets_det = $(this).val();
                    group_widgets.push({
                      group_no: groupnum,
                      lists: widgets_det
                    });

                  });
                  var total_group = $('#iepa-group-num-' + id).val();
                  var hide_popup = $(this).parent().parent().parent().attr('class');
                  $('.' + hide_popup).fadeOut(200);

                  $('#imma_menu_' + id).find('.save_ajax_data').show();
                  $('#imma_menu_' + id).find('.saving_message').text(saving_data);
                  var post_data = {
                    action: "iepa_mm_edit_menu_group_settings",
                    iepa_mm_group_settings: {
                      totgroup: total_group,
                      groupwidgets: group_widgets,
                      total_group_columns: group_colum_array
                    },
                    iepa_mm_menu_item_id: id,
                    _wpnonce: admin_nonce
                  };

                  $.post(AjaxUrl, post_data, function(response) {
                    $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');

                    group_widgets = [];
                    group_colum_array = [];
                  });

                } else {
                  //ADD
                  var total_groups = $('#imma_menu_' + id + ' .iepa-field-total-group').val();
                  var totalset_count = $("#imma_menu_" + id + " .imma-groups-lists li").length;
                  if (totalset_count == 0) {
                    var new_group = parseInt(total_groups) + 1;
                  } else {
                    var new_group = parseInt(totalset_count) + 1;
                  }

                  $('#imma_menu_' + id + ' .imma_mega_settings_multiple').css('display', 'block');
                  var tot_group_column = $('#imma_menu_' + id + ' #imma_columns-num').val();
                  if (new_group == 1) {
                    var newclass = "imma-grp-active-trigger";
                    var style = "";
                  } else {
                    var newclass = '';
                    var style = "style='display:none;'";
                  }

                  var group_trigger_html = '<li data-group-ref="' + new_group + '" data-columns="' + tot_group_column + '" data-group-name="Group ' + new_group + '" class="iepa-group-trigger ' + newclass + '">Group ' + new_group + '<br/><span class="iepa-group-col">( Column ' + tot_group_column + ' )</span><span class="iepa-group-column-editer" title=' + editmsg + '><i class="fa fa-pencil-square-o"></i></span></li>';
                  var group_fields_html = '<input type="hidden" class="imma_field_groups" name="iepa_settings[field_groups][group' + new_group + '_fields]" data-group-fields-ref="' + new_group + '" data-group-column-ref="' + tot_group_column + '" >';
                  var group_fields_html2 = '<input type="hidden" class="imma_groups_widgets_lists" name="iepa_settings[widget_groups][group' + new_group + ']" data-group-widget-ref="' + new_group + '">';


                  /*total group modified*/
                  $('#imma_menu_' + id + ' .iepa-group-field-holder').append(group_fields_html);
                  $('#imma_menu_' + id + ' .iepa-group-field-holder').append(group_fields_html2);

                  $('#imma_menu_' + id + ' .iepa-field-total-group').val(new_group);

                  $('.imma-groups-lists').append(group_trigger_html);
                  var megatype = $('#imma_menu_' + id + ' #imma_enable_mega_menu').val();
                  if (megatype == "megamenu") {
                    var classtype = "enabled_megamenu";
                  } else {
                    var classtype = "disabled";
                  }
                  var group_details_html =
                    '<div id="imma_widgets_setup_' + tot_group_column + '" class="imma_widgets_setup ui-sortable ' + classtype + '" data-group-ref="' + new_group + '" data-columns="' + tot_group_column + '" ' + style + '></div>';
                  $('#imma_menu_' + id + ' .imma_group_add_components').append(group_details_html);

                  var cl = $(this).parents().parents().parents().attr('class');
                  $('.' + cl).fadeOut(200);

                  $('.imma_field_groups').each(function() {
                    var groupnumber = $(this).attr('data-group-fields-ref');
                    var column_number = $(this).attr('data-group-column-ref');
                    results.push({
                      group_no: groupnumber,
                      column: column_number
                    });
                  });
                  $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                    var groupnum = $(this).attr('data-group-widget-ref');
                    var widgets_det = $(this).val();
                    groups_widgs.push({
                      group_no: groupnum,
                      lists: widgets_det
                    });

                  });

                  //console.log(results);
                  $('#imma_menu_' + id).find('.save_ajax_data').show();
                  $('#imma_menu_' + id).find('.saving_message').text(saving_data);
                  /* save added group into db */
                  var post_data = {
                    action: "iepa_mm_save_menu_group_settings",
                    iepa_mm_group_settings: {
                      totgroup: new_group,
                      total_results: results,
                      act: 'add',
                      widget_details: groups_widgs
                    },
                    iepa_mm_menu_item_id: id,
                    _wpnonce: admin_nonce
                  };

                  $.post(AjaxUrl, post_data, function(response) {
                    $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                    results = [];
                    groups_widgs = [];
                  });

                }

              });


              /**
               * Groups Change Trigger
               */
              var resultss = new Array();
              var groups_widgets2 = new Array();
              $('body').on('click', '.iepa-group-trigger', function() {
                $('.iepa-group-trigger').removeClass('imma-grp-active-trigger');
                $(this).addClass('imma-grp-active-trigger');
                var group_ref = $(this).data('group-ref');

                $('#imma_menu_' + id + ' .imma_group_add_components .imma_widgets_setup').hide();
                $('#imma_menu_' + id + ' .imma_group_add_components .imma_widgets_setup[data-group-ref="' + group_ref + '"]').show();
              });

              /**
               * Group Remover
               */
              $('body').on('click', '.iepa-group-remover', function() {
                var total_groups = $('#imma_menu_' + id + ' .iepa-field-total-group').val();
                // var new_groups = parseInt(total_groups) - 1;
                var new_groups = total_groups;

                if (new_groups == 1) {
                  alert('Sorry!!Cannot delete first group.');
                } else {
                  var confirmation_message = $(this).data('confirm-message');
                  if (confirm(confirmation_message)) {

                    if (new_groups != 1) {
                      $('li[data-group-ref="' + total_groups + '"]').remove();
                      $('input[data-group-fields-ref="' + total_groups + '"]').remove();
                      $('input[data-group-widget-ref="' + total_groups + '"]').remove();
                      /* delete all widget of this group too */
                      $('.imma_widgets_setup[data-group-ref="' + total_groups + '"] .imma_widget_areaa').each(function() {
                        var dataid = $(this).attr('data-id');
                        var data = {
                          action: "imma_delete_widget",
                          widget_id_base: dataid,
                          _wpnonce: admin_nonce
                        };
                        $.post(AjaxUrl, data, function(delete_response) {});
                      });

                      $('div.imma_widgets_setup[data-group-ref="' + total_groups + '"]').remove();
                      var new_deleted_groups = parseInt(new_groups) - 1;
                      $('#imma_menu_' + id + ' .iepa-field-total-group').val(new_deleted_groups);
                      $('#imma_menu_' + id + ' .iepa-group-trigger[data-group-ref="' + new_deleted_groups + '"]').addClass('imma-grp-active-trigger');
                      $('#imma_menu_' + id + ' .imma_widgets_setup[data-group-ref="' + new_deleted_groups + '"]').show();
                    }

                    $('.imma_field_groups').each(function() {
                      var groupnumber = $(this).attr('data-group-fields-ref');
                      var column_number = $(this).attr('data-group-column-ref');
                      resultss.push({
                        group_no: groupnumber,
                        column: column_number
                      });
                    });

                    $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                      var groupnum = $(this).attr('data-group-widget-ref');
                      var widgets_det = $(this).val();
                      groups_widgets2.push({
                        group_no: groupnum,
                        lists: widgets_det
                      });

                    });

                    /* save deleted group into db */
                    var post_data = {
                      action: "iepa_mm_save_menu_group_settings",
                      iepa_mm_group_settings: {
                        totgroup: new_groups,
                        total_results: resultss,
                        widget_details: groups_widgets2,
                        act: 'delete'
                      },
                      iepa_mm_menu_item_id: id,
                      _wpnonce: admin_nonce
                    };

                    $.post(AjaxUrl, post_data, function(response) {
                      $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                      $('#imma_menu_' + id).find('.saving_message').text(saving_data);

                      resultss = [];
                      groups_widgets2 = [];
                    });

                  } //confirmation_message check end

                }

              });

              /**************************************** GROUP SECTION CODE END *************************************************************/

              /* sub menu extra settings*/
              /* $('#imma_menu_'+id+' #imma_content_type').on('change',function(){
                   var vall = $(this).val();
                   if(vall == "description_field"){
                    $('#imma_menu_'+id+' .imma-extra .toggle_description').css('display','block');
                    $('#imma_menu_'+id+' .imma-extra .toggle_shortcodes').css('display','none');
                   }else if(vall == "shortcodes"){
                    $('#imma_menu_'+id+' .imma-extra .toggle_shortcodes').css('display','block');
                    $('#imma_menu_'+id+' .imma-extra .toggle_description').css('display','none');
                   }else{
                       $('#imma_menu_'+id+' .imma-extra .toggle_description').css('display','none');
                    $('#imma_menu_'+id+' .imma-extra .toggle_shortcodes').css('display','none');
                   }
               });
                     var changeval2 =  $('#imma_menu_'+id+' #imma_content_type option:selected').val();
                       if(changeval2 == "description_field"){
                    $('#imma_menu_'+id+' .imma-extra .toggle_description').css('display','block');
                    $('#imma_menu_'+id+' .imma-extra .toggle_shortcodes').css('display','none');
                   }else if(changeval2 == "shortcodes"){
                    $('#imma_menu_'+id+' .imma-extra .toggle_shortcodes').css('display','block');
                    $('#imma_menu_'+id+' .imma-extra .toggle_description').css('display','none');
                   }else{
                       $('#imma_menu_'+id+' .imma-extra .toggle_description').css('display','none');
                    $('#imma_menu_'+id+' .imma-extra .toggle_shortcodes').css('display','none');
                   }
                   */
              /* end*/

              /**************************************** MENU REPLACEMENT JS START *************************************************************/
              $('#imma_menu_' + id + ' #imma_choose_menu_type').on('change', function() {
                var change_value = $(this).val();
                fn_check_replacement(id, change_value);
              });
              var changeval = $('#imma_menu_' + id + ' #imma_choose_menu_type option:selected').val();
              fn_check_replacement(id, changeval);
              /* Case 1: Logo image */
              $('.imma_logo_url_button').on('click', function(e) {
                e.preventDefault();
                var btnClicked = $(this);
                var text;
                var btnClickedid = $(this).attr('id');
                if (btnClickedid == "customimage") {
                  text = "Insert Custom Icon";
                } else {
                  text = "Insert Logo Image";
                }
                var image = wp.media({
                    title: text,
                    button: {
                      text: text
                    },
                    library: {
                      type: 'image'
                    },
                    multiple: false
                  }).open()
                  .on('select', function(e) {

                    var uploaded_image = image.state().get('selection').first();
                    // console.log(uploaded_image);
                    var logo_url = uploaded_image.toJSON().url;
                    if (btnClickedid == "customimage") {
                      $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.iepa-custom-image').attr('src', logo_url);
                      $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-customimage-url').val(logo_url);
                      if ($(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-customimage-url').val(logo_url) != '') {
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview3').show();
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview3 .remove_custom_image_url').show();
                      } else {
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview3').hide();
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview3 .remove_custom_image_url').hide();
                      }
                    } else {
                      $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-logo-image').attr('src', logo_url);
                      $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-logo-url').val(logo_url);
                      if ($(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-logo-url').val(logo_url) != '') {
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview2').show();
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview2 .remove_logo_image').show();
                      } else {
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview2').hide();
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-image-preview2 .remove_logo_image').hide();
                      }
                    }
                  });
              });
              $("#imma_menu_" + id + " .remove_logo_image").each(function() {
                $(this).on('click', function(e) {
                  e.preventDefault();
                  $(this).parent().find('img').attr('src', '');
                  $(this).parent().parent().find('.imma-logo-url').val('');
                  $(this).css('display', 'none');
                  $(this).parent().hide();

                });
              });
              $("#imma_menu_" + id + " .remove_custom_image_url").each(function() {
                $(this).on('click', function(e) {
                  e.preventDefault();
                  $(this).parent().find('img').attr('src', '');
                  $(this).parent().parent().find('.imma-customimage-url').val('');
                  $(this).css('display', 'none');
                  $(this).parent().hide();

                });
              });

              /* ADD SINGLE BACKGROUND IMAGE*/
              $('#imma_menu_' + id + ' .imma_bgimage_type').on('change', function() {
                var bgtype = $(this).val();
                if (bgtype == "single_image") {
                  $('#imma_menu_' + id + ' #imma_single_image').show();
                  $('#imma_menu_' + id + ' .toggle_double_image').hide();
                  $('#imma_menu_' + id + ' #imma_single_image1').show();
                } else {
                  $('#imma_menu_' + id + ' #imma_single_image').hide();
                  $('#imma_menu_' + id + ' .toggle_double_image').show();
                  $('#imma_menu_' + id + ' #imma_single_image1').hide();
                }
              });
              var selected_bgtype = $('#imma_menu_' + id + ' .imma_bgimage_type option:selected').val();
              if (selected_bgtype == "single_image") {
                $('#imma_menu_' + id + ' #imma_single_image').show();
                $('#imma_menu_' + id + ' #imma_double_image').hide();
                $('#imma_menu_' + id + ' #imma_single_image1').show();
                $('#imma_menu_' + id + ' .toggle_double_image').hide();
              } else {
                $('#imma_menu_' + id + ' #imma_single_image').hide();
                $('#imma_menu_' + id + ' #imma_single_image1').hide();
                $('#imma_menu_' + id + ' #imma_double_image').show();
                $('#imma_menu_' + id + ' .toggle_double_image').show();
              }

              $(document).on("click", ".imma_bgimage_btn", function(e) {
                e.preventDefault();
                var btnClicked = $(this);
                var btnClickedid = $(this).attr('id');
                var image = wp.media({
                    title: 'Insert Background Image',
                    button: {
                      text: 'Insert Background Image'
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
                    if (btnClickedid == 'imma_doubleimage-1') {

                      $(btnClicked).parent().find('.imma-sbg-image1').attr('src', image_url);
                      $(btnClicked).parent().find('.imma-sbgimage1').val(image_url);
                      if ($(btnClicked).parent().find('.imma-sbgimage1').val(image_url) != '') {
                        $(btnClicked).parent().find('.imma-bgimage-preview1').show();
                      } else {
                        $(btnClicked).parent().find('.imma-bgimage-preview1').hide();
                      }
                    } else if (btnClickedid == 'imma_doubleimage-2') {
                      $(btnClicked).parent().find('.imma-sbg-image2').attr('src', image_url);
                      $(btnClicked).parent().find('.imma-sbgimage2').val(image_url);
                      if ($(btnClicked).parent().find('.imma-sbgimage2').val(image_url) != '') {
                        $(btnClicked).parent().find('.imma-bgimage-preview2').show();
                      } else {
                        $(btnClicked).parent().find('.imma-bgimage-preview1').hide();
                      }
                    } else {
                      $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-sbg-image').attr('src', image_url);
                      $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-sbgimage').val(image_url);
                      if ($(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-sbgimage').val(image_url) != '') {
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-bgimage-preview').show();
                      } else {
                        $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-bgimage-preview').hide();
                      }
                    }
                  });
              });
              $("#imma_menu_" + id + " .remove_sbg_image_url").each(function() {
                $(this).on('click', function(e) {
                  e.preventDefault();
                  $(this).parent().find('img').attr('src', '');
                  $(this).parent().parent().find('.imma-sbgimage').val('');
                  $(this).parent().hide();
                  // $(this).css('display','none');

                });
              });
              /**************************************** MENU REPLACEMENT JS END *************************************************************/
              /**************************************** TOP SECTION CONTENT FOR MEGAMENU JS START *******************************************/
              $('#imma_menu_' + id + ' #imma_choose_topcontent_type').on('change', function() {
                var change_value = $(this).val();
                if (change_value == "text_only") {
                  $('#imma_menu_' + id + ' .toggle_toptext').show();
                  $('#imma_menu_' + id + ' .toggle_topimage').hide();
                  $('#imma_menu_' + id + ' .toggle_html').hide();
                } else if (change_value == "image_only") {
                  $('#imma_menu_' + id + ' .toggle_toptext').hide();
                  $('#imma_menu_' + id + ' .toggle_topimage').show();
                  $('#imma_menu_' + id + ' .toggle_html').hide();
                } else {
                  $('#imma_menu_' + id + ' .toggle_toptext').hide();
                  $('#imma_menu_' + id + ' .toggle_topimage').hide();
                  $('#imma_menu_' + id + ' .toggle_html').show();
                }
              });

              var changeval = $('#imma_menu_' + id + ' #imma_choose_topcontent_type option:selected').val();
              if (changeval == "text_only") {
                $('#imma_menu_' + id + ' .toggle_toptext').show();
                $('#imma_menu_' + id + ' .toggle_topimage').hide();
                $('#imma_menu_' + id + ' .toggle_html').hide();
              } else if (changeval == "image_only") {
                $('#imma_menu_' + id + ' .toggle_toptext').hide();
                $('#imma_menu_' + id + ' .toggle_topimage').show();
                $('#imma_menu_' + id + ' .toggle_html').hide();
              } else {
                $('#imma_menu_' + id + ' .toggle_toptext').hide();
                $('#imma_menu_' + id + ' .toggle_topimage').hide();
                $('#imma_menu_' + id + ' .toggle_html').show();
              }

              var viewmorebtn_check = $('#imma_menu_' + id + ' #activate_view_more_button');
              viewmorebtn_check.change(function() {
                if ($(this).prop('checked') == true) {
                  $('.viewmoreenable_option').show();
                } else {
                  $('.viewmoreenable_option').hide();
                }
              });


              $('.imma_image_url_button').on('click', function(e) {
                e.preventDefault();
                var btnClicked = $(this);
                var btnClickedid = $(this).attr('id');
                var image = wp.media({
                    title: 'Insert Top Content Image',
                    button: {
                      text: 'Insert Top Content Image'
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

                    $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-top-image').attr('src', image_url);
                    $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.iepa-image-url').val(image_url);
                    if ($(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.iepa-image-url').val(image_url) != '') {
                      $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .iepa-image-preview').show();
                      $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .iepa-image-preview .remove_top_image').show();
                    } else {
                      $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .iepa-image-preview').hide();
                      $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .iepa-image-preview .remove_top_image').hide();
                    }
                  });
              });
              $('#imma_menu_' + id + ' .iepa-image-url').each(function() {
                if ($(this).val() == '') {
                  //  alert($(this).parent().find('.iepa-image-preview').attr('class'));
                  $(this).parent().find('.iepa-image-preview').hide();
                } else {
                  $(this).parent().find('.iepa-image-preview').show();
                }

              });
              /**************************************** TOP SECTION CONTENT FOR MEGAMENU JS END *******************************************/
              /**************************************** BOTTOM SECTION CONTENT FOR MEGAMENU JS START ***************************************/
              $('#imma_menu_' + id + ' #imma_choose_bottomcontent_type').on('change', function() {
                var change_value = $(this).val();
                if (change_value == "text_only") {
                  $('#imma_menu_' + id + ' .toggle_bottomtext').show();
                  $('#imma_menu_' + id + ' .toggle_bimage').hide();
                  $('#imma_menu_' + id + ' .toggle_bhtml').hide();
                } else if (change_value == "image_only") {
                  $('#imma_menu_' + id + ' .toggle_bottomtext').hide();
                  $('#imma_menu_' + id + ' .toggle_bimage').show();
                  $('#imma_menu_' + id + ' .toggle_bhtml').hide();
                } else {
                  $('#imma_menu_' + id + ' .toggle_bottomtext').hide();
                  $('#imma_menu_' + id + ' .toggle_bimage').hide();
                  $('#imma_menu_' + id + ' .toggle_bhtml').show();
                }
              });

              var changeval = $('#imma_menu_' + id + ' #imma_choose_bottomcontent_type option:selected').val();
              if (changeval == "text_only") {
                $('#imma_menu_' + id + ' .toggle_bottomtext').show();
                $('#imma_menu_' + id + ' .toggle_bimage').hide();
                $('#imma_menu_' + id + ' .toggle_bhtml').hide();
              } else if (changeval == "image_only") {
                $('#imma_menu_' + id + ' .toggle_bottomtext').hide();
                $('#imma_menu_' + id + ' .toggle_bimage').show();
                $('#imma_menu_' + id + ' .toggle_bhtml').hide();
              } else {
                $('#imma_menu_' + id + ' .toggle_bottomtext').hide();
                $('#imma_menu_' + id + ' .toggle_bimage').hide();
                $('#imma_menu_' + id + ' .toggle_bhtml').show();
              }

              $('.imma_image_url_bottom').on('click', function(e) {
                e.preventDefault();
                var btnClicked = $(this);
                var btnClickedid = $(this).attr('id');

                var image = wp.media({
                    title: 'Insert Bottom Content Image',
                    button: {
                      text: 'Insert Bottom Content Image'
                    },
                    library: {
                      type: 'image'
                    },
                    multiple: false
                  }).open()
                  .on('select', function(e) {
                    var uploaded_image = image.state().get('selection').first();
                    //console.log(uploaded_image);
                    var image_url = uploaded_image.toJSON().url;

                    $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-bottom-image').attr('src', image_url);
                    $(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-bimage-url').val(image_url);
                    if ($(btnClicked).closest('#imma_menu_' + id + ' tr#' + btnClickedid).find('.imma-bimage-url').val(image_url) != '') {
                      $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-bimage-preview').show();
                    } else {
                      $('#imma_menu_' + id + ' tr#' + btnClickedid + ' .imma-bimage-preview').hide();
                    }


                  });
              });

              $('#imma_menu_' + id + ' .imma-bimage-url').each(function() {
                // alert($(this).val());

                if ($(this).val() == '') {
                  //  alert($(this).parent().find('.iepa-image-preview').attr('class'));
                  $(this).parent().find('.imma-bimage-preview').hide();
                } else {
                  $(this).parent().find('.imma-bimage-preview').show();
                }

              });

              $("#imma_menu_" + id + " .remove_top_image").each(function() {
                $(this).on('click', function(e) {
                  e.preventDefault();
                  $(this).parent().find('img').attr('src', '');
                  $(this).parent().parent().find('.iepa-image-url').val('');
                  $(this).css('display', 'none');

                });
              });

              $("#imma_menu_" + id + " .remove_bottom_image").each(function() {
                $(this).on('click', function(e) {
                  e.preventDefault();
                  $(this).parent().find('img').attr('src', '');
                  $(this).parent().parent().find('.imma-bimage-url').val('');
                  $(this).css('display', 'none');

                });
              });

              megamenu_preview_position(id);

              /*
               * Save On click button :id means menu_item_id
               */
              $('#imma_menu_' + id + ' form').on("submit", function(e) {
                e.preventDefault();
                $('#imma_menu_' + id).find('.save_ajax_data').show();
                $('#imma_menu_' + id).find('.saving_message').text(saving_data);
                var data = $(this).serialize();

                var content = $('textarea#imma_html_content2').val();
                var content2 = $('textarea#imma_html_content1').val();

                // data = data + '&html_content='+content+'&html_content1='+content2;
                // console.log(data);
                // return false;
                $.post(AjaxUrl, data, function(submit_response) {
                  $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                });
              });
              /**************************************** BOTTOM SECTION CONTENT FOR MEGAMENU JS END ***************************************/
              /**************************************** ICON PICKER TABS SECTION JS START ***************************************/
              /*$('#imma_menu_'+id+' .icon-preview').on('click',function(){
              $(this).next('.icon-main').show().slideDown('slow');
          });
           $('#imma_menu_'+id+' .select-icon').on('change',function(){
              var idd = $(this).attr('id');
              if($(this).val()==1){
                  $('.font-awesome-icon').show();
                  $('.genericon-icon').hide();
                  $('.dash-icon').hide();
                  $('.ico-icon').hide();
                  $('.line-icon').hide();
              }else if($(this).val()==2){
                  $('.font-awesome-icon').hide();
                  $('.genericon-icon').show();
                  $('.dash-icon').hide();
                  $('.ico-icon').hide();
                  $('.line-icon').hide();
              }else if($(this).val()==3){
                  $('.font-awesome-icon').hide();
                  $('.genericon-icon').hide();
                  $('.dash-icon').show();
                  $('.ico-icon').hide();
                  $('.line-icon').hide();
              }else if($(this).val()==4){
                  $('.ico-moon').show();
                  $('.genericon-icon').hide();
                  $('.dash-icon').hide();
                  $('.font-awesome-icon').hide();
                  $('.line-icon').hide();
              }
              else if($(this).val()== 5){
                  $('.line-icon').show();
                  $('.ico-moon').hide();
                  $('.genericon-icon').hide();
                  $('.dash-icon').hide();
                  $('.font-awesome-icon').hide();
              }
              $('.icon').show();
              $('.search_icons').val('');
          });
  $('#imma_menu_'+id+' .icon').click(function(){
      var class_name =$(this).children().attr('class');
      $('.icon-preview i').attr({'class':class_name});
      $('#imma_menu_'+id+' #icon_picker_icon1').val(class_name);
      $('.icon-main').slideToggle('fast');
      $('.search_icons').val('');
  });

  $('#imma_menu_'+id+' .search_icons').keyup(function() {
   var defaultText = $(this).val();
   var idd = $(this).attr('id');
   if(defaultText == ''){
    if(idd == "search_faicons"){
       $('.font-awesome-icon .icon').show();
   }else if(idd== "search_gicons"){
    $('.genericon-icon .icon').show();
  }else if(idd == "search_icomoonicons"){
      $('.ico-moon .icon').show();
  }else if(idd == "search_lineicons"){
    $('.line-icon .icon').show();
  }
  else{
    $('.dash-icon .icon').show();
  }

  }else{
   if(idd == "search_faicons"){
      $('.font-awesome-icon .icon').hide();
      $('.font-awesome-icon #icon-'+defaultText).show();
  }else if(idd== "search_gicons"){
      $('.genericon-icon .icon').hide();
      $('.genericon-icon #icon-'+defaultText).show();
  }else if(idd == "search_icomoonicons"){
    $('.ico-moon .icon').hide();
    $('.ico-moon #icon-'+defaultText).show();
  }else if(idd == "search_lineicons"){
    $('.line-icon .icon').hide();
    $('.line-icon #icon-'+defaultText).show();
  }
  else{
      $('.dash-icon .icon').hide();
      $('.dash-icon #icon-'+defaultText).show();
  }
  }

  });

  $(document).mouseup(function (e)
  {
      var container = $(".icon-main");

      if (!container.is(e.target)
          && container.has(e.target).length === 0)
      {
          container.slideUp('fast');
          $('.search_icons').val('');
          $('.icon').show();
      }
  }); */
              /**************************************** ICON PICKER TABS SECTION JS END ***************************************/
              /**************************************** CHECK MEGAMENU OR FLYOUT TYPE START ***********************************/
              /*
               * Check Menu type If Megamenu or FLyout And Save Automatic
               */
              var menutype = $('#imma_menu_' + id).find('#imma_enable_mega_menu').val();
              if (menutype == "megamenu") {
                $('.imma_grp_select').show();
                var grouptype = $('#immam_choose_group option:selected').val();
                if (grouptype == 'single') {
                  $('.main_widget').show();
                  $('.imma_single_group_section').show();
                } else {
                  $('.main_widget').show();
                }
              } else {
                $('.imma_grp_select').hide();
                $('.main_widget').hide();
                $('.imma_single_group_section').hide();
                $('.imma_mega_settings_multiple').hide();
              }
              /* On change Mega menu type as mega menu or flyout Event */
              var menu_type = $('#imma_menu_' + id).find('#imma_enable_mega_menu');
              menu_type.on('change', function() {
                if ($(this).val() == 'megamenu') { //megamenu
                  $('.imma_grp_select').show();
                  var grouptype = $('#immam_choose_group option:selected').val();
                  if (grouptype == 'single') {
                    $('.main_widget').show();
                    $('.imma_single_group_section').show();
                  } else {
                    $('.main_widget').show();
                    $('.imma_mega_settings_multiple').show();
                  }

                  $("#imma_widgets_setup").removeClass('disabled').addClass('enabled_megamenu');

                  $("#imma_widgets_setup2").removeClass('disabled').addClass('enabled_megamenu');
                  $(".imma_add_components").removeClass('disabled');
                  $(".imma_group_add_components").removeClass('disabled');

                  $(".imma_mega_settings_multiple").removeClass('disabled').addClass('enabled_megamenu'); //multiple group

                } else { //flyout
                  $('.imma_grp_select').hide();
                  $('.main_widget').hide();
                  $('.imma_single_group_section').hide();
                  $("#imma_widgets_setup").addClass('disabled').removeClass('enabled_megamenu');
                  $("#imma_widgets_imma_widgets_setup2setup").addClass('disabled').removeClass('enabled_megamenu');
                  $(".imma_add_components").addClass('disabled');
                  $(".imma_group_add_components").addClass('disabled');

                  $(".imma_mega_settings_multiple").addClass('disabled').removeClass('enabled_megamenu'); //multiple group
                  // $('select[name="select-states"]').attr('disabled', 'disabled');
                }

                $('#imma_menu_' + id).find('.save_ajax_data').show();
                $('#imma_menu_' + id).find('.saving_message').text(saving_data);

                var menu_type_data = {
                  action: "iepa_mm_save_menuitem_settings",
                  iepa_settings: {
                    menu_type: $(this).val(),
                    panel_columns: $('#imma_menu_' + id + ' #imma_number_of_columns option:selected').val()
                  },
                  iepa_mm_menu_item_id: id,
                  _wpnonce: admin_nonce
                };
                $.post(AjaxUrl, menu_type_data, function(new_response) {
                  $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                });

              });
              /**************************************** CHECK MEGAMENU OR FLYOUT TYPE END ***********************************/

              /**************************************** CHANGE SINGLE GROUP COLUMN WISE VALUE TO DATABASE START *****************************/
              var get_total_no_of_columns = $('#imma_menu_' + id).find('select#imma_number_of_columns');
              get_total_no_of_columns.on('change', function() {
                var group_type = $('#imma_menu_' + id + ' #immam_choose_group option:selected').val();
                var group_no = $('li.imma-grp-active-trigger').attr('data-group-ref');
                if (group_type == "single") {
                  $('#imma_menu_' + id + ' .imma_add_components').find("#imma_widgets_setup").attr('data-columns', $(this).val());
                  $('#imma_menu_' + id + ' .imma_add_components').find(".imma_widget-total-cols").html($(this).val());
                  $('#imma_menu_' + id).find('.save_ajax_data').show();
                  $('#imma_menu_' + id).find('.saving_message').text(saving_data);
                  var menutype = $('#imma_menu_' + id + ' #imma_enable_mega_menu option:selected').val();
                  var post_data = {
                    action: "iepa_mm_save_menuitem_settings",
                    iepa_settings: {
                      panel_columns: $(this).val(),
                      menu_type: menutype
                    },
                    iepa_mm_menu_item_id: id,
                    _wpnonce: admin_nonce
                  };
                } else {
                  //multiple
                  var group_total_column = $('#imma_menu_' + id + ' .imma_group_add_components').find(".imma_widgets_setup").attr('data-columns');
                  $('#imma_menu_' + id).find(".imma_widget-total-cols").html(group_total_column);
                  $('#imma_menu_' + id + ' .imma_group_add_components').find('.save_ajax_data').show();
                  $('#imma_menu_' + id).find('.saving_message').text(saving_data);
                  var menutype = $('#imma_menu_' + id + ' #imma_enable_mega_menu option:selected').val();
                  var post_data = {
                    action: "iepa_mm_save_menuitem_settings",
                    iepa_settings: {
                      group_type: 'multiple',
                      menu_type: menutype
                    },
                    iepa_mm_menu_item_id: id,
                    _wpnonce: admin_nonce
                  };
                }
                $.post(AjaxUrl, post_data, function(response) {
                  $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                });
              });
              /**************************************** CHANGE SINGLE GROUP COLUMN WISE VALUE TO DATABASE END *****************************/

              add_widget_on_click(id);

              /**************************************** EACH WIDGETS SORTABLE IN ORDER START **********************************************/

              var grptype = $('#imma_menu_' + id + ' #immam_choose_group option:selected').val();


              var widget_area = $('#imma_menu_' + id).find('#imma_widgets_setup'); //single
              var widget_areaa = $('#imma_menu_' + id + ' .imma_group_add_components').find('.imma_widgets_setup'); //multiple
              /* sortable for single group method*/
              widget_area.bind("imma_sortupdate_widgets", function() {
                $('#imma_menu_' + id).find('.save_ajax_data').show();
                $('#imma_menu_' + id).find('.saving_message').text(saving_data);
                var items = [];

                $(".imma_widget_area").each(function() {
                  items.push({
                    'type': $(this).attr('data-type'),
                    'order': $(this).index() + 1,
                    'id': $(this).attr('data-id'),
                    'parent_menu_item_id': id
                  });
                });
                $.post(AjaxUrl, {
                  action: "imma_reorder_widget_items",
                  menuitems: items,
                  _wpnonce: admin_nonce
                }, function(imma_move_response) {
                  $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                });
              });

              /* sortable for mulitple group method*/
              widget_areaa.sortable({
                forcePlaceholderSize: true,
                // containment: "parent",
                items: '.imma_widget_areaa:not(.sub_menu)',
                cursor: "move",
                placeholder: "drop-area",
                update: function(event, ui) {
                  var group_ref = $(this).closest('.imma_widgets_setup').data('group-ref');
                  var group_fields_array = [];
                  var count = 0;
                  $('.imma_widgets_setup[data-group-ref="' + group_ref + '"] .imma_widget_areaa').each(function() {
                    count++;
                    var field_name = $(this).attr('data-id');
                    group_fields_array.push(field_name);

                  });
                  //console.log(group_fields_array);
                  var group_fields = group_fields_array.join();
                  $('input[data-group-widget-ref="' + group_ref + '"]').val(group_fields);

                  $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                    var groupnum = $(this).attr('data-group-widget-ref');
                    var widgets_det = $(this).val();
                    grpwidgets.push({
                      group_no: groupnum,
                      lists: widgets_det
                    });

                  });

                  var wdata = {
                    action: "iepa_mm_add_selected_widget_lists",
                    menu_item_id: id, //menu_item_id
                    widget_details: grpwidgets,
                    group_type: 'multiple',
                    _wpnonce: admin_nonce,
                    // dataType: 'html'
                  };

                  $.post(AjaxUrl, wdata, function(response) {
                    $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                    grpwidgets = [];
                  });
                }
              });

              widget_area.sortable({
                forcePlaceholderSize: true,
                // containment: "parent",
                items: '.imma_widget_area:not(.sub_menu)',
                cursor: "move",
                placeholder: "drop-area",
                start: function(event, ui) {
                  $(".imma_widget_area").removeClass("imma_open");
                  ui.item.data('start_position', ui.item.index());
                },
                stop: function(event, ui) {
                  // clean up
                  ui.item.removeAttr('style');

                  var start_position = ui.item.data('start_position');

                  if (start_position !== ui.item.index()) {
                    widget_area.trigger("imma_sortupdate_widgets");

                  }
                }
              });

              /**************************************** EACH WIDGETS SORTABLE IN ORDER END **********************************************/
              /****************************** ADD WIDGETS SECTION ACCORDING TO SINGLE OR MULTIPLE GROUP START *************************/
              var groups_widgets = new Array();
              $('#imma_menu_' + id + ' .imma_all_wp_widgets').each(function() {
                $(this).on('click', function() {
                  var id_bases = $(this).attr('data-value');
                  var widget_title = $(this).attr('data-text');

                  $('#imma_menu_' + id).find('.save_ajax_data').show();
                  $('#imma_menu_' + id).find('.saving_message').text(saving_data);

                  var group_type = $('#imma_menu_' + id + ' #immam_choose_group option:selected').val();
                  var group_no = $('li.imma-grp-active-trigger').attr('data-group-ref'); //visible group number
                  var widgets_postdata = {
                    action: "imma_add_selected_widget",
                    id_base: id_bases,
                    menu_item_id: id, //menu_item_id
                    title: widget_title,
                    group_type: group_type,
                    group_no: group_no,
                    _wpnonce: admin_nonce,
                    //dataType: 'html'
                  };

                  $.post(AjaxUrl, widgets_postdata, function(response) {
                    var success = response.success; //display widgets by json
                    if (success) {
                      var widget = $(response.data); //display widgets by json
                      if (group_type == "multiple") {
                        //multiple
                        var number_of_columns = $('.imma-grp-active-trigger').attr('data-columns');
                        widget.find("span.imma_widget-total-cols").html(number_of_columns);
                        imma_add_events_to_widget(widget, id, group_type);
                        $('#imma_menu_' + id + ' .imma_widgets_setup').find('span.message').hide();
                        $('#imma_menu_' + id + ' .imma_widgets_setup[data-group-ref=' + group_no + ']').append(widget);
                        /**
                         * Group Widgets Builder functionality
                         */
                        var widgetid = widget.attr('data-id');
                        var active_group_fields = $('input[data-group-widget-ref="' + group_no + '"]').val();
                        if (active_group_fields == '') {
                          $('input[data-group-widget-ref="' + group_no + '"]').val(widgetid);
                        } else {
                          var active_group_fields_array = active_group_fields.split(',');
                          active_group_fields_array.push(widgetid);
                          active_group_fields = active_group_fields_array.join();
                          $('input[data-group-widget-ref="' + group_no + '"]').val(active_group_fields);
                        }

                        $('.imma_widgets_setup').sortable({
                          forcePlaceholderSize: true,
                          // containment: "parent",
                          items: '.imma_widget_areaa:not(.sub_menu)',
                          cursor: "move",
                          placeholder: "drop-area",
                          update: function(event, ui) {
                            var group_ref = $(this).closest('.imma_widgets_setup').data('group-ref');
                            var group_fields_array = [];
                            var count = 0;
                            $('.imma_widgets_setup[data-group-ref="' + group_ref + '"] .imma_widget_areaa').each(function() {
                              count++;
                              var field_name = $(this).attr('data-id');
                              group_fields_array.push(field_name);

                            });
                            //console.log(group_fields_array);
                            var group_fields = group_fields_array.join();
                            $('input[data-group-widget-ref="' + group_ref + '"]').val(group_fields);

                            //widget_area.trigger("imma_sortupdate_widgets"); // to make sortable widgets

                            $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                              var groupnum = $(this).attr('data-group-widget-ref');
                              var widgets_det = $(this).val();
                              grpwidgets.push({
                                group_no: groupnum,
                                lists: widgets_det
                              });

                            });

                            var wdata = {
                              action: "iepa_mm_add_selected_widget_lists",
                              menu_item_id: id, //menu_item_id
                              widget_details: grpwidgets,
                              group_type: 'multiple',
                              _wpnonce: admin_nonce,
                              // dataType: 'html'
                            };

                            $.post(AjaxUrl, wdata, function(response) {
                              //$('#imma_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                              grpwidgets = [];
                            });
                          }
                        });

                        $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                          var groupnum = $(this).attr('data-group-widget-ref');
                          var widgets_det = $(this).val();
                          groups_widgets.push({
                            group_no: groupnum,
                            lists: widgets_det
                          });

                        });


                        var widgetsdata = {
                          action: "iepa_mm_add_selected_widget_lists",
                          menu_item_id: id, //menu_item_id
                          widget_details: groups_widgets,
                          group_type: group_type,
                          _wpnonce: admin_nonce,
                          // dataType: 'html'
                        };

                        $.post(AjaxUrl, widgetsdata, function(response) {
                          $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                          groups_widgets = [];
                        });




                      } else {
                        //single
                        var number_of_columns = $('#imma_menu_' + id).find('#imma_number_of_columns option:selected').val();
                        widget.find("span.imma_widget-total-cols").html(number_of_columns);
                        imma_add_events_to_widget(widget, id, group_type);
                        $('#imma_menu_' + id + ' #imma_widgets_setup').find('span.message').hide();
                        $('#imma_menu_' + id + ' #imma_widgets_setup').append(widget);
                        widget_area.trigger("imma_sortupdate_widgets");
                        $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                      }

                    }

                  });

                });

              });


              $('.imma_widget_area', widget_area).each(function() {
                imma_add_events_to_widget($(this), id, 'single');
              });

              $('.imma_widget_areaa', widget_areaa).each(function() {
                imma_add_events_to_widget($(this), id, 'multiple');
              });

              // fix for WordPress 4.8 widgets when lightbox is opened, closed and reopened
              if (wp.textWidgets !== undefined) {
                wp.textWidgets.widgetControls = {}; // WordPress 4.8 Text Widget
              }

              if (wp.mediaWidgets !== undefined) {
                wp.mediaWidgets.widgetControls = {}; // WordPress 4.8 Media Widgets
              }

            }
          });
        });

      $('.item-title', menu_item).append(button);
    }); // menu item each end
  }


  /****************************** ADD WIDGETS SECTION ACCORDING TO SINGLE OR MULTIPLE GROUP END *************************/
  /************************************* PREVIEW POSITION OF MEGAMENU **************************************************/
  function megamenu_preview_position(id) {
    $('#imma_menu_' + id + ' select.imma_position').on('change', function() {
      $('#imma_menu_' + id + ' .show_megamenu_position_type').show('slow');
      var previewid = $(this).val();
      $('#imma_menu_' + id + ' .imma_preview_position').css('display', 'none');
      $('#imma_menu_' + id + ' .imma_preview_position#preview_' + previewid).show();
    });

    var positionid = $('#imma_menu_' + id + ' select.imma_position').val();
    $('#imma_menu_' + id + ' .show_megamenu_position_type').show('slow');
    $('#imma_menu_' + id + ' .imma_preview_position').css('display', 'none');
    $('#imma_menu_' + id + ' .imma_preview_position#preview_' + positionid).show();


    //megamenu vertical preview
    $('#imma_menu_' + id + ' select.imma_vposition').on('change', function() {
      $('#imma_menu_' + id + ' .show_megamenu_vposition_type').show('slow');
      var previewid2 = $(this).val();
      $('#imma_menu_' + id + ' .imma_preview_vposition').css('display', 'none');
      $('#imma_menu_' + id + ' .imma_preview_vposition#preview_' + previewid2).show();
    });

    var positionid2 = $('#imma_menu_' + id + ' select.imma_vposition').val();
    $('#imma_menu_' + id + ' .show_megamenu_vposition_type').show('slow');
    $('#imma_menu_' + id + ' .imma_preview_vposition').css('display', 'none');
    $('#imma_menu_' + id + ' .imma_preview_vposition#preview_' + positionid2).show();

    //flyout horizontal preview
    $('#imma_menu_' + id + ' select.imma_flyposition').on('change', function() {
      $('#imma_menu_' + id + ' .show_flyposition_type').show('slow');
      var previewid3 = $(this).val();
      $('#imma_menu_' + id + ' .imma_preview_flyposition').css('display', 'none');
      $('#imma_menu_' + id + ' .imma_preview_flyposition#preview2_' + previewid3).show();
    });

    var positionid3 = $('#imma_menu_' + id + ' select.imma_flyposition').val();
    $('#imma_menu_' + id + ' .show_flyposition_type').show('slow');
    $('#imma_menu_' + id + ' .imma_preview_flyposition').css('display', 'none');
    $('#imma_menu_' + id + ' .imma_preview_flyposition#preview2_' + positionid3).show();

    //flyout vertical preview
    $('#imma_menu_' + id + ' select.imma_flyoutvposition').on('change', function() {
      $('#imma_menu_' + id + ' .show_megamenu_flyvposition_type').show('slow');
      var previewid4 = $(this).val();
      $('#imma_menu_' + id + ' .imma_preview_flyvposition').css('display', 'none');
      $('#imma_menu_' + id + ' .imma_preview_flyvposition#preview3_' + previewid4).show();
    });

    var positionid4 = $('#imma_menu_' + id + ' select.imma_flyoutvposition').val();
    $('#imma_menu_' + id + ' .show_megamenu_flyvposition_type').show('slow');
    $('#imma_menu_' + id + ' .imma_preview_flyvposition').css('display', 'none');
    $('#imma_menu_' + id + ' .imma_preview_flyvposition#preview3_' + positionid4).show();

    /* icon settings start*/
    $('#imma_menu_' + id + ' a.imma_iconpicker').on('click', function() {
      if ($("#imma_menu_" + id + " .show_available_icons").is(':visible')) {
        $(this).parent().find('.show_available_icons').animate({
          width: 'hide'
        });
      } else {
        $(this).parent().find('.show_available_icons').animate({
          width: 'show'
        });
      }

    });

    $('#imma_menu_' + id + ' .show_available_icons a').click(function(e) {
      e.preventDefault();
      $('#imma_menu_' + id + ' .show_available_icons a').removeClass('active_icons');
      $(this).addClass('active_icons');
      var attr_class = $(this).find('i').attr('class').replace('fa-3x', '');
      $('#imma_menu_' + id + ' .iepa_show_choosed_icons').css('display', 'block');
      var append_html = '<i class="' + attr_class + '"></i>';
      $('#imma_menu_' + id + ' .iepa_show_choosed_icons').html(append_html);
      $('#imma_menu_' + id + ' input#selected_font_icon').val(attr_class);
    });
    /* icon settings end */
    /* upload sub menu image */
    $('#imma_menu_' + id + ' select.imma_textposition').on('change', function() {
      $('#imma_menu_' + id + ' .show_text_position').show('slow');
      var textposition = $(this).val();
      $('#imma_menu_' + id + ' .imma_preview_textposition').css('display', 'none');
      $('#imma_menu_' + id + ' .imma_preview_textposition#preview_' + textposition).show();
    });

    var txt_position = $('#imma_menu_' + id + ' select.imma_textposition').val();
    $('#imma_menu_' + id + ' .show_text_position').show('slow');
    $('#imma_menu_' + id + ' .imma_preview_textposition').css('display', 'none');
    $('#imma_menu_' + id + ' .imma_preview_textposition#preview_' + txt_position).show();


  }
  /************************************* PREVIEW POSITION OF MEGAMENU END **************************************************/
  /************************************* SHOW WIDGETS LISTS FRAME ON CLICK ADD WIDGET BUTTON START *************************/
  function add_widget_on_click(id) {
    $('#imma_menu_' + id + ' .iepa-add-widget-tool').on('click', function() {
      $('#imma_menu_' + id).find('.imma_widget_iframe').show();
    });

    $('#imma_menu_' + id + ' .btn_close_me > span').on('click', function() {
      $(this).parent().parent().parent().parent().parent().find('.imma_widget_iframe').hide('slow');
    });

    $('#imma_menu_' + id + ' .imma_tabss').on('click', function() {
      $('.imma_tabss').removeClass('active');
      var tab_id = $(this).attr('id');
      $(this).addClass('active');
      $('#imma_menu_' + id + ' .tab-panes').css('display', 'none');
      $('#imma_menu_' + id + ' .widget_right_section #tabs_' + tab_id).css('display', 'block');
    });
    $('#imma_menu_' + id + ' .imma_tabss').each(function() {
      if ($(this).hasClass("active")) {
        var tabid = $(this).attr('id');
        $('#imma_menu_' + id + ' .tab-panes').css('display', 'none');
        $('#imma_menu_' + id + ' .widget_right_section #tabs_' + tabid).css('display', 'block');
      }

    });
  }
  /****************** END******************/
  /************************************* EACH WIDGET EXPAND/DELETE/SAVE/EDITCONTRACT PROCESS START *************************/
  var imma_add_events_to_widget = function(widget, id, grouptypee) {
    var widget_title = widget.find(".widget_title span.wptitle");
    var widget_id = widget.attr("data-id");
    var type = widget.attr('data-type');


    widget.find(".imma_widget-expand").on("click", function() {
      var grptypee = $('#immam_choose_group').val();
      var columns = parseInt(widget.attr("data-columns"), 10); // current colums of widget

      if (grptypee == "single") {
        var maximum_columns = parseInt($("#imma_number_of_columns option:selected").val(), 10); //total columns
      } else {
        var maximum_columns = parseInt($(".imma-groups-lists .imma-grp-active-trigger").attr('data-columns'), 10); //total columns
      }
      if (maximum_columns > columns) {
        columns = columns + 1;

        widget.attr("data-columns", columns);

        $('.imma_widget-num-cols', widget).html(columns);

        $('#imma_menu_' + id).find('.save_ajax_data').show();
        $('#imma_menu_' + id).find('.saving_message').text(saving_data);

        if (type == 'wp_widget') {
          $.post(AjaxUrl, {
            action: "imma_selected_update_widget",
            widget_unique_id: widget_id,
            columns: columns,
            group_type: grptypee,
            _wpnonce: admin_nonce
          }, function(expandresponse) {
            $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
          });

        }
        if (type == 'iepa_menu_subitem') {
          $.post(AjaxUrl, {
            action: "iepa_update_menu_item_columns",
            sub_menu_id: widget_id,
            columns: columns,
            group_type: grptypee,
            _wpnonce: admin_nonce
          }, function(contract_response) {
            $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');

          });

        }

      }
    });

    widget.find(".imma_widget-contract").on('click', function() {

      var columns = parseInt(widget.attr("data-columns"), 10);


      // account for widgets that have say 8 columns but the panel is only 6 wide
      var grptypee = $('#immam_choose_group').val();

      if (grptypee == "single") {
        var maxcols = parseInt($("#imma_number_of_columns option:selected").val(), 10); //total columns
      } else {
        var maxcols = parseInt($(".imma-groups-lists .imma-grp-active-trigger").attr('data-columns'), 10); //total columns
      }

      if (columns > maxcols) {
        columns = maxcols;
      }

      if (columns > 1) {
        columns = columns - 1;
        widget.attr("data-columns", columns);

        $('.imma_widget-num-cols', widget).html(columns);
      } else {
        return;
      }

      $('#imma_menu_' + id).find('.save_ajax_data').show();
      $('#imma_menu_' + id).find('.saving_message').text(saving_data);

      if (type == 'wp_widget') {

        $.post(ajaxurl, {
          action: "imma_selected_update_widget",
          widget_unique_id: widget_id,
          columns: columns,
          group_type: grptypee,
          _wpnonce: admin_nonce
        }, function(contract_response) {
          if (contract_response) {
            $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
          }

        });

      }

      if (type == 'iepa_menu_subitem') {

        $.post(AjaxUrl, {
          action: "iepa_update_menu_item_columns",
          sub_menu_id: widget_id,
          columns: columns,
          group_type: grptypee,
          _wpnonce: admin_nonce
        }, function(cresponse) {
          $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
        });

      }

    });
    var grp_widgets = new Array();
    // for edit widget data
    widget.find(".imma_widget-action").on('click', function() {

      if (!widget.hasClass("imma_open") && !widget.data("imma_loaded")) {
        widget_title.addClass('imma_loading');
        // retrieve the widget settings form
        $.post(AjaxUrl, {
          action: "imma_edit_widget_data",
          widget_id_base: widget_id,
          _wpnonce: admin_nonce,
          dataType: 'html'
        }, function(response) {
          var $response = $(response);
          var $form = $response.find('form');
          // bind delete button action
          $(".imma_delete", $form).on("click", function(e) {
            e.preventDefault();

            var data = {
              action: "imma_delete_widget",
              widget_id_base: widget_id,
              _wpnonce: admin_nonce
            };

            $.post(AjaxUrl, data, function(delete_response) {

              if (grouptypee == "multiple") {
                var grpno = $('li.imma-grp-active-trigger').attr('data-group-ref'); //visible group number
                var widget_lists = $('#imma_menu_' + id + ' .imma_groups_widgets_lists[data-group-widget-ref="' + grpno + '"]').val();
                var returndata = removeValue(widget_lists, widget_id);
                $('#imma_menu_' + id + ' .imma_groups_widgets_lists[data-group-widget-ref="' + grpno + '"]').val(returndata);
                widget.remove();
                $('#imma_menu_' + id + ' .imma_groups_widgets_lists').each(function() {
                  var groupnum = $(this).attr('data-group-widget-ref');
                  var widgets_det = $(this).val();
                  grp_widgets.push({
                    group_no: groupnum,
                    lists: widgets_det
                  });

                });
                var wdata = {
                  action: "iepa_mm_add_selected_widget_lists",
                  menu_item_id: id, //menu_item_id
                  widget_details: grp_widgets,
                  group_type: grouptypee,
                  _wpnonce: admin_nonce,
                };

                $.post(AjaxUrl, wdata, function(response) {

                  $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');
                  grp_widgets = [];

                });

              } else {
                widget.remove();
              }
            });
          });
          // bind close button action
          $(".imma_close", $form).on("click", function(e) {
            e.preventDefault();
            widget.toggleClass("imma_open");
          });

          // bind save button action
          $form.on("submit", function(e) {
            e.preventDefault();

            var dataa = $(this).serialize();
            // alert(dataa);

            $('#imma_menu_' + id).find('.save_ajax_data').show();
            $('#imma_menu_' + id).find('.saving_message').text(saving_data);

            $.post(AjaxUrl, dataa, function(submit_response) {
              // console.log(submit_response);
              $('#imma_menu_' + id).find('.save_ajax_data').fadeOut('slow');

            });

          });

          widget.find(".imma_widget_inner").html($response);
          $('.imma-mm-color-picker').wpColorPicker();

          widget.data("imma_loaded", true).toggleClass("imma_open");

          widget_title.removeClass('imma_loading');


          // Init Black Studio TinyMCE
          if (widget.is('[id^=black-studio-tinymce]')) {
            bstw(widget).deactivate().activate();
          }

          // setTimeout(function(){
          //     //$(document).trigger("widget-added", [widget]);
          //     $(document).on('widget-added', function(event, widget){
          //         var widget_id = $(widget).attr('id');
          //         // any code that needs to be run when a new widget gets added goes here
          //         // widget_id holds the ID of the actual widget that got added
          //         // be sure to only run the code if one of your widgets got added
          //         // otherwise the code will be run when any widget is added
          //         console.log(widget_id);
          //     });
          // }, 100);


          var editorId = widget.find('textarea').attr('id');
          widget.find('input.title').attr('type', 'text').addClass('widefat');

          if (widget.is('[id^=text-]')) {
            if (tinymce.get(editorId)) {
              wp.editor.remove(editorId);
            }

            wp.editor.initialize(editorId, {
              tinymce: {
                wpautop: true,
                setup: function(editor) {
                  editor.on('change', function() {
                    editor.save();
                  });
                }
              },
              quicktags: true
            });
          }
          $('#' + editorId).removeAttr("hidden");

          /*  setTimeout(function(){
               alert(7);
               console.log(widget);
               console.log([widget]);
               $(document).trigger("widget-added", [widget]);
           }, 100); */

          // $( document ).trigger( 'widget-added', [widget]);
        });
      } else {

        widget.toggleClass("imma_open");
      }

      // close all other widgets
      $(".imma_widget_area").not(widget).removeClass("imma_open");
      $(".imma_widget_areaa").not(widget).removeClass("imma_open");

    });
    return widget;
  };

  /************************************* EACH WIDGET EXPAND/DELETE/SAVE/EDITCONTRACT PROCESS END *********************************/

  $('.iepa_menu_wrapper .iepa_overlay').click(function() {
    $(this).css('display', 'none');
    $('#iepa_menu_settings_frame').css('display', 'none');
    $('.iepa_menu_wrapper .close_btn').css('display', 'none');
  });
  $('.iepa_menu_wrapper .close_btn').click(function() {
    $(this).css('display', 'none');
    $('#iepa_menu_settings_frame').css('display', 'none');
    $('.iepa_menu_wrapper .iepa_overlay').css('display', 'none');
  });


  function fn_check_replacement(id, change_value) {
    switch (change_value) {
      case 'search_type':
        $('#imma_menu_' + id + ' .toggle_search_form').show();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        break;
      case 'logo_image':
        $('#imma_menu_' + id + ' .toggle_logo_image').show();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        break;
      case 'shortcode':
        $('#imma_menu_' + id + ' .toggle_shortcode').show();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        break;
      case 'woo_cart_total':
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').show();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        break;
      case 'woo_wishlist':
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').show();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        break;
      case 'login_form':
        $('#imma_menu_' + id + ' .toggle_login_form').show();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        break;
      case 'register_form':
        $('#imma_menu_' + id + ' .toggle_register_form').show();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        break;
      case 'fpassword_form':
        $('#imma_menu_' + id + ' .toggle_fpassword_form').show();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        break;
      default:
        $('#imma_menu_' + id + ' .toggle_fpassword_form').hide();
        $('#imma_menu_' + id + ' .toggle_search_form').hide();
        $('#imma_menu_' + id + ' .toggle_logo_image').hide();
        $('#imma_menu_' + id + ' .toggle_woo_cart_total').hide();
        $('#imma_menu_' + id + ' .toggle_shortcode').hide();
        $('#imma_menu_' + id + ' .toggle_woo_wishlist').hide();
        $('#imma_menu_' + id + ' .toggle_login_form').hide();
        $('#imma_menu_' + id + ' .toggle_register_form').hide();
        break;
    }
  }

  function removeValue(list, value) {
    return list.replace(new RegExp(",?" + value + ",?"), function(match) {
      var first_comma = match.charAt(0) === ',',
        second_comma;

      if (first_comma &&
        (second_comma = match.charAt(match.length - 1) === ',')) {
        return ',';
      }
      return '';
    });
  };

  var checked_enable_megamenu = iepa_mm_variable.checked_enable_megamenu;
  var template_check = iepa_mm_variable.template_check;
  var location_check = iepa_mm_variable.location_check;
  $('.imma_available_custom').click(function() {
    var enablemegamenu = $(this).data('enablemegamenu');
    var mlocation = $(this).data('location');
    var templatetype = $(this).data('templatetype');

    if (enablemegamenu == 0) {
      alert(checked_enable_megamenu);
    } else if (templatetype == '') {
      alert(template_check);
    } else if (mlocation == '') {
      alert(location_check);
    } else {
      $.ajax({
        url: AjaxUrl,
        type: 'post',
        data: {
          action: "iepa_mm_show_custom_option",
          mlocation: mlocation,
          templatetype: templatetype,
          wp_nonce: admin_nonce,
        },
        cache: false,
        complete: function() {
          //$('.immapro-templates-custom-wrapper').show();
        },
        success: function(res) {
          $('.immapro-templates-custom-wrapper').slideToggle();
          $('.immapro-templates-custom-wrapper').html(res);
          $('.imma-mm-color-picker').wpColorPicker();
          $('.iepa-custom-options-wrap .iepa-template-tab-leftsection').on('click', '.imma_tabss', function() {
            $('.iepa-custom-options-wrap .imma_tabss').removeClass('active');
            var tabidd = $(this).attr('id');

            $(this).addClass('active');
            $('.iepa-custom-options-wrap .tab-panes').css('display', 'none');
            $('.iepa-custom-options-wrap .widget_right_section #tabs_' + tabidd).css('display', 'block');
          });


        }
      });
    }
  });

  $('.immapro-templates-custom-wrapper').on('click', 'span.imma-save-data', function(e) {
    e.preventDefault();
    // retrieve the widget settings form
    var wpcsettings = JSON.stringify($("[name^='iepammmegamenu_custommeta']").serializeArray());
    $.ajax({
      url: AjaxUrl,
      type: 'post',
      data: {
        action: "iepammsavecustomsettings",
        iepamenuid: $('#menu').val(),
        iepa_megamenu_cmeta: wpcsettings,
        wp_nonce: admin_nonce
      },
      beforeSend: function() {
        $(".iepa-load-data").css('display', 'block');
        $(".iepa-load-data img").css('display', 'block');
      },
      complete: function() {
        $(".iepa-load-data").css('display', 'block');
        $(".iepa-load-data img").css('display', 'none');
        $(".iepa_saving_message").show();
      },
      success: function(res) {
        //console.log(res);
        $(".iepa-load-data").css('display', 'none');
        $(".iepa_saving_message").html(saved_success_message).delay(2000).fadeOut('slow');
      }
    });
  });


  $('.immapro-templates-custom-wrapper').on('click', 'span.imma-close-wrap', function() {
    $('.immapro-templates-custom-wrapper').hide();
    $('.immapro-templates-custom-wrapper').find('.iepa-custom-options-wrap').remove();
  });


});
