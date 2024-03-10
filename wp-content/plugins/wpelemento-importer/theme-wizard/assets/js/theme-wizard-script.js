var Whizzie = (function($) {

  var t;
  var current_step = '';
  var step_pointer = '';
  var demo_import_type = '';

  // callbacks from form button clicks.
  var callbacks = {
    do_next_step: function(btn) {
      do_next_step(btn);
    },
    install_themes: function(btn) {
      var themes = new ThemeManager();
      themes.init(btn);
    },
    install_plugins: function(btn) {
      var plugins = new PluginManager();
      plugins.init(btn);
    },
    // add this
    demo_import: function(btn) {
      var importDemo = new ImportManager();
      importDemo.init(btn);
    },

    install_widgets: function(btn) {
      demo_import_type = "customize";
      var widgets = new WidgetManager(demo_import_type);
      widgets.init(btn);
    },
    page_builder: function(btn) {
      demo_import_type = "builder";
      var widgets = new WidgetManager(demo_import_type);
      widgets.init(btn);
    },
    install_content: function(btn) {
      var content = new ContentManager();
      content.init(btn);
    }
  };

  function window_loaded() {
    // Get all steps and find the biggest
    // Set all steps to same height
    var maxHeight = 0;

    $('.whizzie-menu li.step').each(function(index) {
      $(this).attr('data-height', $(this).innerHeight());
      if ($(this).innerHeight() > maxHeight) {
        maxHeight = $(this).innerHeight();
      }
    });

    $('.whizzie-menu li .detail').each(function(index) {
      $(this).attr('data-height', $(this).innerHeight());
      $(this).addClass('scale-down');
    });


    $('.whizzie-menu li.step').css('height', '100%');
    $('.whizzie-menu li.step:first-child').addClass('active-step');
    $('.wee-whizzie-nav li:first-child').addClass('active-step');

    $('.wee-whizzie-wrap').addClass('loaded');

    // init button clicks:
    $('.do-it').on('click', function(e) {
      e.preventDefault();
      step_pointer = $(this).data('step');
      current_step = $('.step-' + $(this).data('step'));
      $('.wee-whizzie-wrap').addClass('spinning');
      if ($(this).data('callback') && typeof callbacks[$(this).data('callback')] != 'undefined') {
        // we have to process a callback before continue with form submission
        callbacks[$(this).data('callback')](this);
        return false;
      } else {
        loading_content();
        return true;
      }
    });
    $('.key-activation-tab-click').on('click', function() {
      document.querySelector(".tab button.tablinks[data-tab='wee_theme_activation']").click();
    });
    $('.button-upload').on('click', function(e) {
      e.preventDefault();
      renderMediaUploader();
    });
    $('.theme-presets a').on('click', function(e) {
      e.preventDefault();
      var $ul = $(this).parents('ul').first();
      $ul.find('.current').removeClass('current');
      var $li = $(this).parents('li').first();
      $li.addClass('current');
      var newcolor = $(this).data('style');
      $('#new_style').val(newcolor);
      return false;
    });
    $('.more-info').on('click', function(e) {
      e.preventDefault();
      var parent = $(this).parent().parent();
      parent.toggleClass('show-detail');
      if (parent.hasClass('show-detail')) {
        var detail = parent.find('.detail');
        parent.animate({
            height: parent.data('height') + detail.data('height')
          },
          500,
          function() {
            detail.toggleClass('scale-down');
          }).css('overflow', 'visible');;
      } else {
        parent.animate({
            height: maxHeight
          },
          500,
          function() {
            detail = parent.find('.detail');
            detail.toggleClass('scale-down');
          }).css('overflow', 'visible');
      }
    });
  }

  function loading_content() {

  }


  function do_next_step(btn) {
    $('.nav-step-plugins').attr('data-enable', 1);
    current_step.removeClass('active-step');
    $('.nav-step-' + step_pointer).removeClass('active-step');
    current_step.addClass('done-step');
    $('.nav-step-' + step_pointer).addClass('done-step');
    current_step.fadeOut(500, function() {
      current_step = current_step.next();
      step_pointer = current_step.data('step');
      current_step.fadeIn();
      current_step.addClass('active-step');
      $('.nav-step-' + step_pointer).addClass('active-step');
      $('.wee-whizzie-wrap').removeClass('spinning');
    });
  }

  function PluginManager() {
    $('.step-loading').css('display', 'none');
    $('.nav-step-widgets').attr('data-enable', 1);
    var complete;
    var items_completed = 0;
    var current_item = '';
    var $current_node;
    var current_item_hash = '';

    function ajax_callback(response) {
      if (typeof response == 'object' && typeof response.message != 'undefined') {
        $current_node.find('.wizard-plugin-status').text(response.message);
        if (typeof response.url != 'undefined') {
          // we have an ajax url action to perform.

          if (response.hash == current_item_hash) {
            $current_node.find('.wizard-plugin-status').text("failed");
            find_next();
          } else {

            current_item_hash = response.hash;
            jQuery.post(response.url, response, function(response2) {
              process_current();
              $current_node.find('.wizard-plugin-status').text(response.message + wpelemento_importer_pro_whizzie_params.verify_text);
            }).fail(ajax_callback);

          }

        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next();
        } else {
          // error processing this plugin
          find_next();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('.wizard-plugin-status').text("ajax error");
        find_next();
      }
    }

    function process_current() {
      if (current_item) {
        // query our ajax handler to get the ajax to send to TGM
        // if we don't get a reply we can assume everything worked and continue onto the next one.
        jQuery.post(wpelemento_importer_pro_whizzie_params.ajaxurl, {
          action: 'setup_plugins',
          wpnonce: wpelemento_importer_pro_whizzie_params.wpnonce,
          slug: current_item
        }, ajax_callback).fail(ajax_callback);
      }
    }

    function find_next() {
      var do_next = false;
      if ($current_node) {
        if (!$current_node.data('done_item')) {
          items_completed++;
          $current_node.data('done_item', 1);
        }
        $current_node.find('.spinner').css('visibility', 'hidden');
      }
      var $li = $('.whizzie-do-plugins li');
      $li.each(function() {
        if (current_item == '' || do_next) {
          current_item = $(this).data('slug');
          $current_node = $(this);
          process_current();
          do_next = false;
          jQuery(this).find('.spinner').css('display', 'inline-block');
        } else if ($(this).data('slug') == current_item) {
          do_next = true;
          jQuery(this).find('.spinner').css('display', 'none');
        }
      });
      if (items_completed >= $li.length) {
        // finished all plugins!
        complete();
        $('.wz-require-plugins').css('display', 'none');
        $('.step.step-plugins .button').text('');
        $('.step.step-plugins .button').text('Skip To Next Step');

        $('.step.step-plugins .summary p').text('');
        $('.step.step-plugins .summary p').text('All required plugins are already installed. click on the below button to go next step.');

      }
    }

    return {

      init: function(btn) {
        if (jQuery('.step.step-plugins .button').text() != "Skip To Next Step") {

          $('.envato-wizard-plugins').addClass('installing');
          complete = function() {
            do_next_step();
            // window.location.href=btn.href;
            // window.location.href = "http://localhost/catapult_themes/whizzie/wp-admin/themes.php?page=whizzie";
          };
          find_next();
        } else {
          do_next_step();
        }
      }
    }
  }

  function WidgetManager(demo_type) {
    $('.step-loading').css('display', 'block');
    var demo_action = '';
    if (demo_type == 'builder') {
      jQuery('.wp-setup-finish .wz-btn-customizer').css('display', 'none');
      jQuery('.wp-setup-finish .wz-btn-builder').css('display', 'inline-block');

      function import_widgets() {
        jQuery.post(
          wpelemento_importer_pro_whizzie_params.ajaxurl, {
            action: 'setup_builder',
            wpnonce: wpelemento_importer_pro_whizzie_params.wpnonce
          }, ajax_callback).fail(ajax_callback);
      }
      $('.nav-step-done').attr('data-enable', 1);
    } else {
      jQuery('.wp-setup-finish .wz-btn-customizer').css('display', 'inline-block');
      jQuery('.wp-setup-finish .wz-btn-builder').css('display', 'none');

      function import_widgets() {
        jQuery.post(
          wpelemento_importer_pro_whizzie_params.ajaxurl, {
            action: 'wpelemento_importer_setup_elementor',
            wpnonce: wpelemento_importer_pro_whizzie_params.wpnonce
          }, ajax_callback_customizer).fail(ajax_callback_customizer);
      }
      $('.nav-step-done').attr('data-enable', 1);
    }
    return {
      init: function(btn) {
        ajax_callback = function(response) {
          var obj = JSON.parse(response);
          if (obj.home_page_url != "") {
            jQuery('.wz-btn-builder').attr('href', obj.home_page_url);
          }
          do_next_step();
        }
        ajax_callback_customizer = function(response) {
          console.log('response', response);
          jQuery('.wz-btn-customizer').attr('href', response.edit_post_link);
          do_next_step();
        }

        import_widgets();
      }
    }
  }

  function ContentManager() {

    var complete;
    var items_completed = 0;
    var current_item = '';
    var $current_node;
    var current_item_hash = '';

    function ajax_callback(response) {
      if (typeof response == 'object' && typeof response.message != 'undefined') {
        $current_node.find('span').text(response.message);
        if (typeof response.url != 'undefined') {
          // we have an ajax url action to perform.
          if (response.hash == current_item_hash) {
            $current_node.find('span').text("failed");
            find_next();
          } else {
            current_item_hash = response.hash;
            jQuery.post(response.url, response, ajax_callback).fail(ajax_callback); // recuurrssionnnnn
          }
        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next();
        } else {
          // error processing this plugin
          find_next();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('span').text("ajax error");
        find_next();
      }
    }

    function process_current() {
      if (current_item) {

        var $check = $current_node.find('input:checkbox');
        if ($check.is(':checked')) {
          // process htis one!
          jQuery.post(wpelemento_importer_pro_whizzie_params.ajaxurl, {
            action: 'envato_setup_content',
            wpnonce: wpelemento_importer_pro_whizzie_params.wpnonce,
            content: current_item
          }, ajax_callback).fail(ajax_callback);
        } else {
          $current_node.find('span').text("Skipping");
          setTimeout(find_next, 300);
        }
      }
    }

    return {
      init: function(btn) {
        $('.envato-setup-pages').addClass('installing');
        $('.envato-setup-pages').find('input').prop("disabled", true);
        complete = function() {
          loading_content();
          window.location.href = btn.href;
        };
        find_next();
      }
    }
  }

  /**
   * Callback function for the 'click' event of the 'Set Footer Image'
   * anchor in its meta box.
   *
   * Displays the media uploader for selecting an image.
   *
   * @since 0.1.0
   */
  function renderMediaUploader() {
    'use strict';

    var file_frame, attachment;

    if (undefined !== file_frame) {
      file_frame.open();
      return;
    }

    file_frame = wp.media.frames.file_frame = wp.media({
      title: 'Upload Logo', //jQuery( this ).data( 'uploader_title' ),
      button: {
        text: 'Select Logo' //jQuery( this ).data( 'uploader_button_text' )
      },
      multiple: false // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on('select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();

      jQuery('.site-logo').attr('src', attachment.url);
      jQuery('#new_logo_id').val(attachment.id);
      // Do something with attachment.id and/or attachment.url here
    });
    // Now display the actual file_frame
    file_frame.open();

  }

  return {
    init: function() {
      t = this;
      $(window_loaded);
    },
    callback: function(func) {}
  }

  function get_client_elemento_elementor_templates() {
    jQuery.ajax({
      method: "POST",
      url: wpelemento_importer_wizard_script_params.WP_ELEMENTO_EXPORTER_LICENCE_ENDPOINT + "get_client_elemento_elementor_templates",
      data: JSON.stringify({
        "limit": 9,
        "start": 1,
        "search": ""
      }),
      dataType: 'json',
      contentType: 'application/json',
    }).done(function(data) {
      if (data.success === true) {
        var elementor_templates = data.data.elementor_templates;
        for (var i = 0; i < elementor_templates.length; i++) {
          var elementor_template = elementor_templates[i];
          var pro_badge = '';
          if (elementor_template.is_paid == "1") {
            pro_badge = wpelemento_importer_wizard_script_params.pro_badge;
          }

          jQuery('.theme-browser.content-filterable .themes.wp-clearfix').append(
            `<div class="theme" data-slug="` + elementor_template.slug + `">
            <div class="theme-screenshot">
            <object type="image/svg+xml" data="${pro_badge}"></object>
            <img src="` + elementor_template.image + `" alt="">
            </div>
            <span class="more-details" data-description="` + elementor_template.description + `" data-iframe="` + elementor_template.demo_url + `" data-is-paid="` + elementor_template.is_paid + `">
            Details &amp; Preview
            </span>
            <div class="theme-id-container">
            <h3 class="theme-name">` + elementor_template.title + `</h3>
            </div>
            </div>`
          );
        }
        $('#elementor_templates').removeClass('wpelemento-importer-spinning');
      }
    });
  }
 get_client_elemento_elementor_templates();

  function ThemeManager() {
    var complete;
    var items_completed = 0;
    var current_item = '';
    var $current_node;
    var current_item_hash = '';

    function ajax_callback(response) {

      if (typeof response == 'object' && typeof response.message != 'undefined') {
        $current_node.find('span').text(response.message);
        if (typeof response.url != 'undefined') {
          // we have an ajax url action to perform.

          if (response.hash == current_item_hash) {
            $current_node.find('span').text("failed");
            find_next();
          } else {
            current_item_hash = response.hash;

            if (response.message == "Installing Plugin") {
              jQuery.get(response.url, function(response2) {
                process_current();
                $current_node.find('span').text(response.message + wpelemento_importer_pro_whizzie_params.verify_text);
              }).fail(ajax_callback);
            } else {
              jQuery.get(response.url, function(response2) {
                process_current();
                $current_node.find('span').text(response.message + wpelemento_importer_pro_whizzie_params.verify_text);
              }).fail(ajax_callback);
            }

          }

        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next();
        } else {
          // error processing this plugin
          find_next();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('span').text("ajax error");
        find_next();
      }
    }


    function process_current() {
      if (current_item) {
        // query our ajax handler to get the ajax to send to TGM
        // if we don't get a reply we can assume everything worked and continue onto the next one.
        jQuery.post(wpelemento_importer_pro_whizzie_params.ajaxurl, {
          action: 'wpelemento_importer_setup_themes',
          wpnonce: wpelemento_importer_pro_whizzie_params.wpnonce,
          slug: current_item
        }, ajax_callback).fail(ajax_callback);

      }
    }
    // add this //
    function ImportManager() {
      function import_elementor() {
        jQuery.post(
          wpelemento_importer_wizard_script_params.ajaxurl, {
            action: 'wpelemento_importer_setup_elementor',
            wpnonce: wpelemento_importer_wizard_script_params.wpnonce,
            elementor_template_response: elementor_template_response
          }, ajax_callback).fail(ajax_callback);
      }

      return {
        init: function(btn) {
          $('.merlin__button--loading__spinner').remove();
          $next_button.append(
            `<div class="merlin__progress-bar">
                	<span class="js-merlin-progress-bar" style="width: 0%;"></span>
                </div>
                <span class="js-merlin-progress-bar-percentage" data-per="0">0%</span>`
          );

          window.progress_bar_interval = setInterval(function() {
            update_progress_bar();
          }, 1000);

          ajax_callback = function(response) {
            update_progress_bar(1);

            $('.merlin__progress-bar').remove();
            $('.js-merlin-progress-bar-percentage').remove();
            $('.wpelemento-importer-demo-main-btn').removeClass('merlin__button--loading');

            jQuery('.button.button-secondary').attr('href', response.edit_post_link);
            jQuery('[data-step="demo_finish"] .button.button-primary').attr('href', response.permalink);
            do_next_step();
          }
          import_elementor();
        }
      }
    }

    function find_next(slug) {
      var do_next = false;
      if ($current_node) {
        if (!$current_node.data('done_item')) {
          items_completed++;
          $current_node.data('done_item', 1);
        }
        $current_node.find('.spinner').css('visibility', 'hidden');
      }
      var $li = $('.wpelemento-importer-do-themes li[data-slug="' + slug + '"]');

      $li.each(function() {
        if (current_item == '' || do_next) {
          current_item = $(this).data('slug');
          $current_node = $(this);
          process_current();
          do_next = false;
        } else if ($(this).data('slug') == current_item) {
          do_next = true;
        }
      });
      if (items_completed >= $li.length) {
        // finished all themes!
        complete();
      }
    }

    return {
      init: function(btn) {
        $('.envato-wizard-plugins').addClass('installing');
        complete = function() {
          do_next_step();
        };
        find_next($(btn).attr('data-slug'));
      }
    }

  }









  // test end //
})(jQuery);

Whizzie.init();

jQuery(document).ready(function() {

  var current_menu = '';
  var current_icon_step = '';

  current_menu = parseInt(jQuery('.wp-wizard-menu-page').length);
  if (current_menu == 1) {
    jQuery('#adminmenu li').removeClass('current');
    jQuery('#adminmenu li a').removeClass('wp-has-current-submenu');
    jQuery('#toplevel_page_elemento-wizard').addClass('current');
  }

  jQuery('.wp-setup-finish .wp-finish-btn a').click(function() {
    jQuery('.wee-tab-sec button.tablinks:nth-child(2)').addClass('active');
  });

  jQuery('.wizard-icon-nav li').click(function() {


    var tabenable = jQuery(this).attr('data-enable');
    if (tabenable == 1) {
      current_icon_step = jQuery(this).attr('wizard-steps');
      jQuery('.wp-wizard-menu-page li.step').removeClass('active-step');
      jQuery('.wp-wizard-menu-page li.step').css('display', 'none');
      jQuery('.wizard-icon-nav li').removeClass('active-step');
      jQuery('.wp-wizard-menu-page .' + current_icon_step).addClass('active-step');
      jQuery('.wp-wizard-menu-page .' + current_icon_step).css('display', 'block');
      jQuery(this).addClass('active-step');
    }
  });

  var plugin_count = "";
  plugin_count = jQuery('.wizard-plugin-count').text();
  if (plugin_count == 0) {
    jQuery('.step.step-plugins a.button').text('');
    jQuery('.step.step-plugins a.button').text('Skip To Next Step');
    jQuery('.wz-require-plugins').css('display', 'none');
    jQuery('.step.step-plugins .summary p').text('');
    jQuery('.step.step-plugins .summary p').text('All required plugins are already installed. click on the below button to go next step.');

  } else {
    jQuery('.step.step-plugins a.button').text('');
    jQuery('.step.step-plugins a.button').text('Install Plugins');
    jQuery('.wz-require-plugins').css('display', 'block');
  }

  // --------- Search --------
  jQuery('.themesearchinput').on('input', function() {
    var search_keyword = jQuery(this).val().toLowerCase();
    var active_sub_cat = jQuery('.o-product-col-1 ul li.active');
    if (active_sub_cat.length != 0) {
      var sub_cat_pro_ids = active_sub_cat.attr('data-ids');
      var sub_cat_arr_ids = sub_cat_pro_ids.split(',');
      jQuery('.o-product-col-2 [data-id]').hide();
      for (var i = 0; i < sub_cat_arr_ids.length; i++) {
        var sub_cat_pro_id = sub_cat_arr_ids[i];
        var pro_card = jQuery('.o-product-col-2 [data-id=' + sub_cat_pro_id + ']');
        var pro_card_text = pro_card.find('h3').text().toLowerCase();
        if (pro_card_text.indexOf(search_keyword) !== -1) {
          pro_card.show();
        }
      }
    }
  });
  // Search text END

  jQuery('#wp-demo-setup-guid ul li a').click(function() {
    var doc_url = jQuery(this).attr('doc-video-url');
    jQuery('.get-stared-page-wrap .wz-video-model').css('display', 'block');
    jQuery('.get-stared-page-wrap .wz-video-model iframe').attr('src', doc_url)
  });
  jQuery('.wz-video-model .dashicons-no').click(function() {
    jQuery('.get-stared-page-wrap .wz-video-model').css('display', 'none');
    jQuery('.get-stared-page-wrap .wz-video-model iframe').attr('src', '')
  });

  jQuery('#wpelemento_importer_pro_license_form button[id="change--key"]').on('click', function() {
    var $wpelemento_importer_pro_license_form = jQuery('#wpelemento_importer_pro_license_form');
    $wpelemento_importer_pro_license_form.find('input[name="wpelemento_importer_pro_license_key"]').val('');
    $wpelemento_importer_pro_license_form.find('input[name="wpelemento_importer_pro_license_key"]').attr('disabled', false);
    $wpelemento_importer_pro_license_form.find('button[type="submit"]').val('');
    $wpelemento_importer_pro_license_form.find('button[type="submit"]').attr('disabled', false);
    $wpelemento_importer_pro_license_form.find('button[type="submit"]').text('Activate');
    jQuery('#start-now-next').hide();
    jQuery(this).remove();
  });
  jQuery('form#wpelemento_importer_pro_license_form').on('submit', function(e) {
    jQuery('.wee_theme_activation_spinner').show();
    e.preventDefault();
    var key_to_send = jQuery('form#wpelemento_importer_pro_license_form').serializeArray()[0].value;
    if (key_to_send == "") {
      alert('Please Enter the license key first!');
      return;
    } else {
      jQuery.post(
        wpelemento_importer_pro_whizzie_params.ajaxurl, {
          action: 'wz_activate_elemento_exporter_pro',
          wpnonce: wpelemento_importer_pro_whizzie_params.wpnonce,
          wpelemento_importer_pro_license_key: key_to_send
        },

        function(data, status) {
          if (status == 'success') {
            if (data.status) {
              location.reload(true);
              jQuery.notify(data.msg, {
                position: "right bottom",
                className: "success"
              });
              document.querySelector('.tablinks[data-tab="wee_demo_offer"]').click();

              jQuery('.wee_theme_activation_spinner').hide();
              jQuery('form#wpelemento_importer_pro_license_form button[type="submit"]').css("background-color:#0a9d2c");
              jQuery('form#wpelemento_importer_pro_license_form button[type="submit"]').text('Activated');
              jQuery('form#wpelemento_importer_pro_license_form button[type="submit"]').attr('disabled', 'disabled');

            } else {
              jQuery.notify(data.msg, {
                position: "right bottom"
              });
              jQuery('.wee_theme_activation_spinner').hide();
            }
          } else {
            jQuery('.wee_theme_activation_spinner').hide();
          }
        },
        'json');
      }
    });
});
