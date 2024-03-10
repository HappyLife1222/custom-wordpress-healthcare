var Whizzie = (function ($) {
  var t;
  var current_step = '';
  var step_pointer = '';

  // callbacks from form button clicks.
  var callbacks = {
    do_next_step_freeSW: function (btn) {
      do_next_step_freeSW(btn);
    },
    install_plugins_freeSW: function (btn) {
      var plugins = new PluginManager_freeSW();
      plugins.init(btn);do_next_step_freeSW
    },
    install_widgets_freeSW: function (btn) {
      var widgets = new WidgetManager_freeSW();
      widgets.init(btn);
    },
    install_elementor_freeSW: function (btn) {
      var widgets = new ElementorManager_freeSW();
      widgets.init(btn);
    },
    install_content_freeSW: function (btn) {
      var content = new ContentManager_freeSW();
      content.init(btn);
    }
  };

  function window_loaded_freeSW() {
    var maxHeight = 0;

    $('.ibtana-whizzie-menu li.step').each(function (index) {
      $(this).attr('data-height', $(this).innerHeight());
      if ($(this).innerHeight() > maxHeight) {
        maxHeight = $(this).innerHeight();
      }
    });

    $('.ibtana-whizzie-menu li .detail').each(function (index) {
      $(this).attr('data-height', $(this).innerHeight());
      $(this).addClass('ibtana-scale-down');
    });


    $('.ibtana-whizzie-menu li.step').css('height', maxHeight);
    $('.ibtana-whizzie-menu li.step:first-child').addClass('active-step');
    $('.ibtana-whizzie-nav li:first-child').addClass('active-step');
    $('.ibtana-whizzie-wrap').addClass('loaded');

    // init button clicks:
    $('.do-it').on('click', function (e) {
      e.preventDefault();
      step_pointer = $(this).data('step');
      current_step = $('.step-' + $(this).data('step'));
      $('.ibtana-whizzie-wrap').addClass('ibtana-spinning');
      if ($(this).data('callback') && typeof callbacks[$(this).data('callback')] != 'undefined') {
        // we have to process a callback before continue with form submission
        callbacks[$(this).data('callback')](this);
        return false;
      } else {
        loading_content_freeSW();
        return true;
      }
    });
    $('.button-upload').on('click', function (e) {
      e.preventDefault();
      renderMediaUploader_freeSW();
    });
    $('.theme-presets a').on('click', function (e) {
      e.preventDefault();
      var $ul = $(this).parents('ul').first();
      $ul.find('.current').removeClass('current');
      var $li = $(this).parents('li').first();
      $li.addClass('current');
      var newcolor = $(this).data('style');
      $('#new_style').val(newcolor);
      return false;
    });
    $('.ibtana-more-info').on('click', function (e) {
      e.preventDefault();
      var parent = $(this).parent().parent();
      parent.toggleClass('ibtana-show-detail');
      if (parent.hasClass('ibtana-show-detail')) {
        var detail = parent.find('.detail');
        parent.animate({
          height: parent.data('height') + detail.data('height')
        },
          500,
          function () {
            detail.toggleClass('ibtana-scale-down');
          }).css('overflow', 'visible');;
      } else {
        parent.animate({
          height: maxHeight
        },
          500,
          function () {
            detail = parent.find('.detail');
            detail.toggleClass('ibtana-scale-down');
          }).css('overflow', 'visible');
      }
    });
  }

  function loading_content_freeSW() {
  }

  function do_next_step_freeSW(btn) {
    current_step.removeClass('active-step');
    $('.nav-step-' + step_pointer).removeClass('active-step');
    current_step.addClass('done-step');
    $('.nav-step-' + step_pointer).addClass('done-step');
    current_step.fadeOut(500, function () {
      current_step = current_step.next();
      step_pointer = current_step.data('step');
      current_step.fadeIn();
      current_step.addClass('active-step');
      $('.nav-step-' + step_pointer).addClass('active-step');
      $('.ibtana-whizzie-wrap').removeClass('ibtana-spinning');
    });
  }
  function PluginManager_freeSW() {
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
            find_next_freeSW();
          } else {
            current_item_hash = response.hash;
            jQuery.post(response.url, response, function (response2) {
              process_current_freeSW();
              $current_node.find('span').text(response.message + whizzie_params.verify_text);
            }).fail(ajax_callback);
          }

        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next_freeSW();
        } else {
          // error processing this plugin
          find_next_freeSW();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('span').text("ajax error");
        find_next_freeSW();
      }
    }
    function process_current_freeSW() {
      if (current_item) {
        jQuery.post(whizzie_params.ajaxurl, {
          action: 'setup_plugins_freeSW',
          wpnonce: whizzie_params.wpnonce,
          slug: current_item
        }, ajax_callback).fail(ajax_callback);
      }
    }
    function find_next_freeSW() {
      var do_next = false;
      if ($current_node) {
        if (!$current_node.data('done_item')) {
          items_completed++;
          $current_node.data('done_item', 1);
        }
        $current_node.find('.spinner').css('visibility', 'hidden');
      }
      var $li = $('.ibtana-whizzie-do-plugins li');
      $li.each(function () {
        if (current_item == '' || do_next) {
          current_item = $(this).data('slug');
          $current_node = $(this);
          process_current_freeSW();
          do_next = false;
        } else if ($(this).data('slug') == current_item) {
          do_next = true;
        }
      });
      if (items_completed >= $li.length) {
        // finished all plugins!
        complete();
      }
    }
    return {
      init: function (btn) {
        $('.envato-wizard-plugins').addClass('installing');
        complete = function () {
          do_next_step_freeSW();
        };
        find_next_freeSW();
      }
    }
  }

  function ElementorManager_freeSW() {
    function import_elementor_freeSW() {
      jQuery.post(
        whizzie_params.ajaxurl,
        {
          action: 'setup_elementor_freeSW',
          wpnonce: whizzie_params.wpnonce
        },
        complete
      );
    }
    return {
      init: function (btn) {
        complete = function () {
          do_next_step_freeSW();
        }
        import_elementor_freeSW();
      }
    }
  }

  function WidgetManager_freeSW() {
    function import_widgets_freeSW() {
      jQuery.post(
        whizzie_params.ajaxurl,
        {
          action: 'setup_widgets_freeSW',
          wpnonce: whizzie_params.wpnonce
        },
        complete
      );
    }
    return {
      init: function (btn) {
        complete = function () {
          do_next_step_freeSW();
        }
        import_widgets_freeSW();
      }
    }
  }
  function ContentManager_freeSW() {
    var complete;
    var items_completed = 0;
    var current_item = '';
    var $current_node;
    var current_item_hash = '';

    function ajax_callback(response) {
      if (typeof response == 'object' && typeof response.message != 'undefined') {
        $current_node.find('span').text(response.message);
        if (typeof response.url != 'undefined') {
          if (response.hash == current_item_hash) {
            $current_node.find('span').text("failed");
            find_next_freeSW();
          } else {
            current_item_hash = response.hash;
            jQuery.post(response.url, response, ajax_callback).fail(ajax_callback); // recuurrssionnnnn
          }
        } else if (typeof response.done != 'undefined') {
          // finished processing this plugin, move onto next
          find_next_freeSW();
        } else {
          // error processing this plugin
          find_next_freeSW();
        }
      } else {
        // error - try again with next plugin
        $current_node.find('span').text("ajax error");
        find_next_freeSW();
      }
    }

    function process_current_freeSW() {
      if (current_item) {
        var $check = $current_node.find('input:checkbox');
        if ($check.is(':checked')) {
          // process htis one!
          jQuery.post(whizzie_params.ajaxurl, {
            action: 'envato_setup_content',
            wpnonce: whizzie_params.wpnonce,
            content: current_item
          }, ajax_callback).fail(ajax_callback);
        } else {
          $current_node.find('span').text("Skipping");
          setTimeout(find_next_freeSW, 300);
        }
      }
    }


    return {
      init: function (btn) {
        $('.envato-setup-pages').addClass('installing');
        $('.envato-setup-pages').find('input').prop("disabled", true);
        complete = function () {
          loading_content_freeSW();
          window.location.href = btn.href;
        };
        find_next_freeSW();
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
  function renderMediaUploader_freeSW() {
    'use strict';
    var file_frame, attachment;

    if (undefined !== file_frame) {
      file_frame.open();
      return;
    }

    file_frame = wp.media.frames.file_frame = wp.media({
      title: 'Upload Logo',//jQuery( this ).data( 'uploader_title' ),
      button: {
        text: 'Select Logo' //jQuery( this ).data( 'uploader_button_text' )
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on('select', function () {
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
    init: function () {
      t = this;
      $(window_loaded_freeSW);
    },
    callback: function (func) {
      console.log(func);
      console.log(this);
    }
  }

})(jQuery);

Whizzie.init();
