jQuery(document).ready(function($) {


  $('.iepamega-user-login-form').on('click', function(e) {
    $(this).find('.iepa-login-form').addClass('imma_show_form');
    // $('form#imma_login').fadeIn(500);
    $('form#imma_login').show();
    $('form#imma_register').hide();
  });

  $('.iepamega-user-register-form').on('click', function() {
    $(this).find('.iepa-login-form').addClass('imma_show_form');
    // $('form#imma_register').fadeIn(500);
    $('form#imma_register').show();
    $('form#imma_login').hide();
  });


  // Display form from link inside a popup
  /*$('#imma_pop_login, #imma_pop_signup').live('click', function (e) {
        formToFadeOut = $('form#imma_register');
        formtoFadeIn = $('form#imma_login');
        if ($(this).attr('id') == 'imma_pop_signup') {
            formToFadeOut = $('form#imma_login');
            formtoFadeIn = $('form#imma_register');
        }
        formToFadeOut.fadeOut(500, function () {
            formtoFadeIn.fadeIn();
        })
        return false;
    });*/
  // Close popup
  $(document).on('click', '.iepa_login_overlay, .close', function() {
    $('.ajax-auth').fadeOut();
    $('.iepa-login-form').removeClass('imma_show_form');
  });

  // Perform AJAX login/register on form submit
  $('form#imma_login, form#imma_register').on('submit', function(e) {
    if (!$(this).valid()) return false;
    $('p.status', this).show().text(iepa_megamenu_ajax_auth_object.loadingmessage);
    action = 'ajaxlogin';
    username = $('form#imma_login #username').val();
    password = $('form#imma_login #password').val();
    email = '';
    security = $('form#imma_login #security').val();
    if ($(this).attr('id') == 'imma_register') {
      action = 'ajaxregister';
      username = $('#signonname').val();
      password = $('#signonpassword').val();
      email = $('#email').val();
      security = $('#signonsecurity').val();
    }
    ctrl = $(this);
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: iepa_megamenu_ajax_auth_object.ajaxurl,
      data: {
        'action': action,
        'username': username,
        'password': password,
        'email': email,
        'security': security
      },
      success: function(data) {
        $('p.status', ctrl).text(data.message);
        if (data.loggedin == true) {
          document.location.href = iepa_megamenu_ajax_auth_object.redirecturl;
        }
      }
    });
    e.preventDefault();
  });

  // Client side form validation
  if (jQuery("#imma_register").length)
    jQuery("#imma_register").validate({
      rules: {
        password2: {
          equalTo: '#signonpassword'
        }
      }
    });
  else if (jQuery("#imma_login").length)
    jQuery("#imma_login").validate();
});
