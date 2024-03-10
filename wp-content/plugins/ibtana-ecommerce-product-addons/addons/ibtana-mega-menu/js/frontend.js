/**
 * IEPA Mega Menu Version 2.1.1 jQuery Plugin
 */
jQuery(function($) {
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    var is_mobile = true;
  } else {
    var is_mobile = false;
  }
  var mobile_toggle_option = iepa_megamenu_params.iepa_mobile_toggle_option; //toggle_standard or toggle_accordion
  var event_behavior = iepa_megamenu_params.iepa_event_behavior;
  var ajaxurl = iepa_megamenu_params.iepa_ajaxurl;
  var ajax_nonce = iepa_megamenu_params.iepa_ajax_nonce;
  var check_woocommerce_enabled = iepa_megamenu_params.check_woocommerce_enabled;
  var enable_mobile = iepa_megamenu_params.enable_mobile;
  var enable_rtl = iepa_megamenu_params.iepa_enable_rtl;

  $('body').addClass('iepa_megamenu');

  if (enable_rtl == 1) {
    $('body').addClass('iepa_enable_rtl');
  }

  /*
   * Search box Integration
   */
  var submitIcon = $('.iepa-search-inline');
  var inputBox = $('.iepa-search-icon .search-field');
  var isOpen = false;
  submitIcon.click(function(e) {
    e.preventDefault();
    if ($(this).next().find('.iepa-search-icon').hasClass('inline-search')) {
      if (isOpen == false) {
        $(this).next().find('.inline-search').addClass('searchbox-open').removeClass('searchbox-closed');
        inputBox.focus();
        isOpen = true;
      } else {
        $(this).next().find('.inline-search').removeClass('searchbox-open').addClass('searchbox-closed');
        inputBox.focusout();
        isOpen = false;
      }
    }
  });


  var isOpen2 = false;
  /*
   * Search Box In Popup Integration
   */
  $('.iepa-search-popup').click(function(e) {

    if ($(e.target).hasClass('search-submit') || $(e.target).hasClass('search-field')) {} else {
      e.preventDefault();
      if ($(this).parent().find('.iepa-search-icon').hasClass('popup-search-form')) {
        if (isOpen2 == false) {
          $(this).parent().find('.popup-search-form').addClass('popup-searchbox-open').removeClass('popup-searchbox-closed');
          inputBox.focus();
          isOpen2 = true;
        } else {
          $(this).parent().find('.popup-search-form').removeClass('popup-searchbox-open').addClass('popup-searchbox-closed');
          inputBox.focusout();
          isOpen2 = false;
        }
      }
    }

  });

  /*
   * Search Box In Popup Close Integration
   */
  $('.closepopup, .iepa-search-overlay').click(function(e) {
    $(this).parent().removeClass('popup-searchbox-open').addClass('popup-searchbox-closed');
  });


  // $(".iepa-search-popup").colorbox({inline:true, width:"50%",transition:"fade"});
  /*
   * Add Woocommerce Class
   */
  if (check_woocommerce_enabled == "true") {
    $('.iepa-megamenu-main-wrapper').each(function() {
      $(this).addClass('woocommerce');
    });
  }

  var submenu_open = event_behavior; // check event behavior as follow link on second click or toggle menu on second click
  /* searchtype onclick function */
  $('.iepa-onclick .iepamega-searchdown').click(function(e) {
    e.preventDefault();
    if ($(this).closest('.iepa-megamenu-main-wrapper').hasClass('iepa-fade')) {
      //fade
      if ($(this).parent().find('.iepa-sub-menu-wrap').hasClass('iepa-open-fade')) {
        $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
      } else {
        $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
        $(this).parent().find('.iepa-sub-menu-wrap').addClass('iepa-open-fade');
      }
    } else {

      //slide
      if ($(this).parent().find('.iepa-sub-menu-wrap').hasClass('iepa-mega-slidedown')) {
        $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown').addClass('iepa-mega-slideup');
        $(this).parent().find('.iepa-mega-slideup').slideUp('slow');
      } else {
        $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown');
        $(this).parent().find('.iepa-sub-menu-wrap').removeClass("iepa-mega-slideup").addClass("iepa-mega-slidedown");
        $(this).parent().find('.iepa-mega-slidedown').slideDown('slow');

      }
    }
  });

  $('.iepa-mega-menu-link').click(function() {
    var parentclass = $(this).parent().attr('class');
    if (parentclass == "iepareadmorelink") {
      var linkk = $(this).attr('href');
      window.open(linkk, "_self");
    } else if (parentclass == "iepa-custom-postimage") {
      var linkk = $(this).attr('href');
      window.open(linkk, "_self");
    }
  });

  $('body').on("mouseenter", '.iepa-onhover .iepa-mega-menu-link', function() {
    // "mouse enter"
    if ($(this).parent().find('.iepa-sub-menu-wrap').length > 0 || $(this).parent().find('.iepa-sub-menu-wrapper').length > 0) {
      if ($(this).closest('.iepa-megamenu-main-wrapper').hasClass('iepa-slide-right')) {
        $(this).parent().find('.iepa-sub-menu-wrap').addClass('iepammenu-slideRight');
      }
    }
  }).on("mouseleave", '.iepa-onhover .iepa-mega-menu-link', function() {
    //  "mouse leave"
    if ($(this).parent().find('.iepa-sub-menu-wrap').length > 0 || $(this).parent().find('.iepa-sub-menu-wrapper').length > 0) {
      if ($(this).closest('.iepa-megamenu-main-wrapper').hasClass('iepa-slide-right')) {
        $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepammenu-slideRight');
      }
    }
  });

  $('body').on("click", '.iepa-onclick .iepa-mega-menu-link', function(e) {
    e.preventDefault();
    var link = $(this).attr('href');
    var parent_class = $(this).parent().attr('class');
    if (!$(this).parent().hasClass('iepa-tabs-section')) {
      if ($(this).parent().find('.iepa-sub-menu-wrap').length > 0 || $(this).parent().find('.iepa-sub-menu-wrapper').length > 0) {
        if (submenu_open == "follow_link") {
          //Open submenu on first click and follow link on second click.
          if (!$(this).hasClass('clicked')) {
            if ($(this).closest('.iepa-megamenu-main-wrapper').hasClass('iepa-fade')) {
              //effect as fade
              if ($(this).parent().hasClass('iepamega-menu-megamenu')) {
                //megamenu
                if ($(this).parent().find('.iepa-sub-menu-wrap').hasClass('iepa-open-fade')) {

                  $(this).closest('.iepa-mega-wrapper').find('.iepa-mega-menu-link').removeClass('clicked');
                  $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
                  $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrapper').removeClass('iepa-open-fade');
                  $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');

                } else {

                  $('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
                  $('.iepa-mega-menu-link').removeClass('clicked');
                  $('.iepa-sub-menu-wrapper').removeClass('iepa-open-fade');
                  $('.iepa-mega-wrapper').find('li').removeClass('active-show');

                  $(this).parent().find('.iepa-sub-menu-wrap').addClass('iepa-open-fade');
                  $(this).parent().find('.iepa-sub-menu-wrapper').addClass('iepa-open-fade');
                  $(this).parent().find('.iepa-mega-menu-link').addClass('clicked');
                  $(this).parent().addClass('active-show');

                }

              } else {
                //flyout
                $(this).siblings('.iepa-sub-menu-wrapper').toggleClass('iepa-open-fade');
                $(this).parent().addClass('active-show');
                if (!$(this).siblings('.iepa-sub-menu-wrapper').hasClass('iepa-open-fade')) {
                  $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
                  $(this).closest('.iepa-mega-wrapper').find('.iepa-mega-menu-link').not($(this)).removeClass('clicked');
                  $(this).closest('.iepa-mega-wrapper').find('.iepa-mega-menu-link').removeClass('clicked');
                  $(this).parent().removeClass('active-show');
                }
              }
            } else {

              //slide
              if ($(this).parent().hasClass('iepamega-menu-megamenu')) {
                if ($(this).parent().find('.iepa-sub-menu-wrap').hasClass('iepa-mega-slidedown')) {

                  $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown').addClass('iepa-mega-slideup');
                  $(this).parent().removeClass('active-show');
                } else {

                  $(this).closest('.iepa-mega-wrapper').find('.iepa-mega-menu-link').removeClass('clicked');
                  $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');
                  $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown');
                  $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slidedown');
                  $(this).parent().find('.iepa-sub-menu-wrap').removeClass("iepa-mega-slideup").addClass("iepa-mega-slidedown");
                  $(this).parent().addClass('active-show');
                }
              } else {
                //flyout
                if ($(this).parent().find('.iepa-sub-menu-wrapper').hasClass('iepa-mega-slidedown')) {
                  $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slidedown');
                  $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');
                } else {

                  $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slideup').addClass("iepa-mega-slidedown");
                  $(this).parent().addClass('active-show');

                }
              }
            }
            $(this).addClass('clicked');
          } else {
            //has been clicked once.
            if (!link || link == '#') {
              $(this).removeClass('clicked');

              if ($(this).parent().hasClass('iepamega-menu-megamenu')) {
                if ($('.iepa-megamenu-main-wrapper').hasClass('iepa-fade')) {
                  $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
                  $(this).parent().removeClass('active-show');
                } else {

                  if ($(this).parent().find('.iepa-sub-menu-wrap').hasClass('iepa-mega-slidedown')) {
                    $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown').addClass('iepa-mega-slideup');
                    $(this).parent().removeClass('active-show');
                  } else {
                    $(this).closest('.iepa-mega-wrapper').find('.iepa-mega-menu-link').removeClass('clicked');
                    $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');
                    $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown');
                    $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slidedown');
                    $(this).parent().find('.iepa-sub-menu-wrap').removeClass("iepa-mega-slideup").addClass("iepa-mega-slidedown");
                    $(this).parent().addClass('active-show');
                  }

                  // $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown').addClass('iepa-mega-slideup');
                  // $(this).parent().addClass('active-show');
                  // $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');
                }
              } else {
                //flyout
                if ($('.iepa-megamenu-main-wrapper').hasClass('iepa-fade')) {
                  //fade open
                  $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-open-fade');
                  $(this).parent().removeClass('active-show');
                } else {
                  //slide
                  if ($(this).parent().find('.iepa-sub-menu-wrapper').hasClass('iepa-mega-slidedown')) {
                    $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slidedown');
                    $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');
                  } else {

                    $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slideup').addClass("iepa-mega-slidedown");
                    $(this).parent().addClass('active-show');

                  }

                  // $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slidedown');
                  // $(this).parent().addClass('active-show');
                }

              }
              return false;
            } else {

              if ($(this).hasClass('clicked')) {
                var target = $(this).attr('target');
                //  alert(target);
                if (target == "_blank") {
                  window.open(link, target);
                } else {
                  window.location = link;
                }

              } else {
                $(this).closest('.iepa-mega-wrapper').find('.iepa-mega-menu-link').removeClass('clicked');
                $(this).addClass('clicked');
              }

            }
          }
        } else {
          //submenu_click
          //Open Submenu on first click and close on second click.
          $(this).removeClass('clicked');

          if ($(this).closest('.iepa-megamenu-main-wrapper').hasClass('iepa-fade')) {
            //fade effect
            if ($(this).parent().hasClass('iepamega-menu-megamenu')) {
              // alert('megamenu');
              //megamennu
              if ($(this).parent().find('.iepa-sub-menu-wrap').hasClass('iepa-open-fade')) {
                $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
                $(this).parent().removeClass('active-show');
              } else {
                $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-open-fade');
                $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');
                $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrapper').removeClass('iepa-open-fade');
                $(this).parent().find('.iepa-sub-menu-wrap').addClass('iepa-open-fade');
                $(this).parent().addClass('active-show');
              }
            } else {
              //flyout

              if ($(this).siblings('.iepa-sub-menu-wrapper').hasClass('iepa-open-fade')) {
                $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-open-fade');
                $(this).parent().removeClass('active-show');
              } else {
                $(this).siblings('.iepa-sub-menu-wrapper').addClass('iepa-open-fade');
                $(this).parent().addClass('active-show');
              }

            }


          } else {
            // alert('yes_slide');
            //slide effect
            if ($(this).parent().hasClass('iepamega-menu-megamenu')) {
              if ($(this).parent().find('.iepa-sub-menu-wrap').hasClass('iepa-mega-slidedown')) {
                $(this).parent().find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown');
                $(this).parent().removeClass('active-show');
              } else {
                $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrap').removeClass('iepa-mega-slidedown');
                $(this).closest('.iepa-mega-wrapper').find('li').removeClass('active-show');
                $(this).closest('.iepa-mega-wrapper').find('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slidedown');
                $(this).parent().find('.iepa-sub-menu-wrap').removeClass("iepa-mega-slideup").addClass("iepa-mega-slidedown");
                $(this).parent().addClass('active-show');
              }
            } else {
              //flyout
              if ($(this).siblings('.iepa-sub-menu-wrapper').hasClass('iepa-mega-slidedown')) {
                $(this).siblings('.iepa-sub-menu-wrapper').removeClass('iepa-mega-slidedown');
                $(this).parent().removeClass('active-show');
              } else {
                $(this).siblings('.iepa-sub-menu-wrapper').removeClass("iepa-mega-slideup").addClass("iepa-mega-slidedown");
                $(this).parent().addClass('active-show');
              }


            }
          }
        }
      } else {
        var target = $(this).attr('target');
        if (target == "") {
          target = "_self";
        }
        //  alert(target);
        if (target == "_blank") {
          window.open(link, target);
        } else {
          window.location = link;
        }
      }
      e.stopImmediatePropagation();
      //  e.stopPropagation();
      return false;
    }
  });
  $(document).on('click', function(e) {
    if ($(e.target).closest(".iepa-megamenu-main-wrapper").length === 0) {
      $(".iepa-megamenu-main-wrapper .iepa-sub-menu-wrap").removeClass('iepa-open-fade');
      $(".iepa-megamenu-main-wrapper li").removeClass('active-show');
      $(".iepa-megamenu-main-wrapper .iepa-search-form .iepa-search-icon").addClass('searchbox-closed');
      $(".iepa-megamenu-main-wrapper .iepa-sub-menu-wrapper").removeClass('iepa-open-fade');
      $(".iepa-megamenu-main-wrapper .iepa-mega-menu-link").removeClass('clicked');
    }
  });


  /* Responsive Settings Toggle Bar*/
  /*  $('.iepamega-closeblock').click(function() {
     $(this).parent().parent().parent().find('.iepa-mega-wrapper').slideToggle(1000,function(){
       $(this).parent().parent().parent().find('.iepa-mega-wrapper').addClass('hide-menu');
     });
     $(this).parent().parent().parent().find('.iepamega-openblock').show();
     $(this).hide();
     $(this).closest('.iepa-megamenu-main-wrapper').find('.iepamega-responsive-closebtn').hide();
    });

    $('.iepamega-openblock').click(function() {
      $(this).parent().parent().parent().find('.iepa-mega-wrapper').slideToggle(1000,function(){
        $(this).parent().parent().parent().find('.iepa-mega-wrapper').removeClass('hide-menu');
      });
      $(this).parent().parent().parent().find('.iepamega-closeblock').show();
      $(this).closest('.iepa-megamenu-main-wrapper').find('.iepamega-responsive-closebtn').show();
      $(this).hide();
    });
  */

  /*
   * Mobile - Set to clickable menu always
   */
  if (enable_mobile == 1) {
    var winwidth = '';
    $(window).on("resize", function(event) {
      winwidth = $(this).width();
      $('.iepa-megamenu-main-wrapper').each(function() {
        var trigger_effect = $(this).find('.iepa-mega-wrapper').attr('data-trigger-effect'); //iepa-onhover
        var responsive_breakingpoint = $(this).find('.iepamegamenu-toggle').attr('data-responsive-breakpoint');
        responsive_breakingpoint = responsive_breakingpoint.replace('px', '');
        if (responsive_breakingpoint == '') {
          responsive_breakingpoint = "910";
        }
        if (winwidth <= responsive_breakingpoint) {
          if ($(this).hasClass('iepa-onhover')) {
            $(this).removeClass('iepa-onhover');
            $(this).addClass('iepa-onclick');
          }
          $('.iepamega-tabs').each(function() {
            if ($(this).hasClass('iepa-tabbed-onhover')) {
              $(this).removeClass('iepa-tabbed-onhover');
              $(this).addClass('iepa-tabbed-onclick');
            }
          });
        } else {
          if (trigger_effect == 'iepa-onhover') {
            $(this).removeClass('iepa-onclick');
            $(this).addClass('iepa-onhover');
          }
        }

      });

    }).resize();

    $('.iepa-megamenu-main-wrapper').on('click', '.iepamega-openblock', function() {
      var $selector = $(this);
      $selector.closest('.iepa-megamenu-main-wrapper').find('.iepa-mega-wrapper').toggleClass('iepa-show-menu');
      $selector.closest('.iepa-megamenu-main-wrapper').find('.iepa-mega-wrapper').slideDown('slow');
      $selector.hide();
      $selector.closest('.iepa-megamenu-main-wrapper').find('.iepamegamenu-toggle .iepamega-closeblock').show();
    });

    $( '.iepa-megamenu-main-wrapper' ).on('click', '.iepamega-closeblock', function() {
      var $selector1 = $(this);
      $selector1.closest('.iepa-megamenu-main-wrapper').find('.iepa-mega-wrapper').toggleClass('iepa-show-menu');
      $selector1.closest('.iepa-megamenu-main-wrapper').find('.iepa-mega-wrapper').slideUp('slow');
      $selector1.hide();
      $selector1.closest('.iepa-megamenu-main-wrapper').find('.iepamegamenu-toggle .iepamega-openblock').show();
    });

  }






  var win_width = $(window).width();
  if (!is_mobile) {
    if (win_width > 980) {
      $('.iepa-orientation-vertical > .iepa-mega-wrapper > li > .iepa-sub-menu-wrap > .iepa-sub-menu-wrapper').each(function() {
        var height1 = $(this).outerHeight();
        var height5 = $(this).prev().outerHeight();
        var height4 = $(this).next().outerHeight();
        var height2 = $(this).prev().prev().outerHeight();
        var height3 = $(this).next().next().outerHeight();
        var height = parseInt(height1) + parseInt(height2) + parseInt(height3) + parseInt(height5) + parseInt(height4);
        $(this).parent('.iepa-sub-menu-wrap').height(height);
      });
    }

    $(window).resize(function() {
      $('.iepa-orientation-vertical').each(function() {

        if (win_width < 1200) {
          var menu_width = $(this).width();
          //var total_width = parseInt(win_width) - parseInt(menu_width)- 70;
          var total_width = parseInt(win_width) - parseInt(menu_width);
          $(this).find('.iepa-sub-menu-wrap').width(total_width);

        }

      });

    }).resize();
  }


  /*  if(!is_mobile){

        $('.iepa-orientation-vertical > .iepa-mega-wrapper > li > .iepa-sub-menu-wrap > .iepa-sub-menu-wrapper').each(function(){
          var height1 = $(this).outerHeight();
          var height2 = $(this).prev().prev().outerHeight();
          var height3 = $(this).next().next().outerHeight();
          var height = parseInt(height1) + parseInt(height2) + parseInt(height3);
          // var height = parseInt(Total) + parseInt(height1);
          $(this).parent('.iepa-sub-menu-wrap').height(height);


     });

    /* $('.iepa-orientation-vertical > .iepa-mega-wrapper > li > .iepa-sub-menu-wrap > .iepa-sub-menu-wrapper').each(function(){
          var height1 = $(this).outerHeight();


          // var height2 = $(this).prev().prev().outerHeight();
          // var height3 = $(this).next().next().outerHeight();
          // var height = parseInt(height1) + parseInt(height2) + parseInt(height3);

         var h1 = $(this).prev().outerHeight();
         var h2 = $(this).prev().prev().outerHeight();
         var h3 = $(this).next().outerHeight();
         var h4 = $(this).next().next().outerHeight();
        // if(h1 != "undefined" && h2 != "undefined"){
           var t1 = parseInt(h1) + parseInt(h2);
        // }else if(h1 != "undefined" && h2 == "undefined"){
          //  var t1 = parseInt(h1);
        // }else if(h1 == "undefined" && h2 != "undefined"){
          // var t1 = parseInt(h2);
        // }else{
          // var t1 = 0;
        // }

          //if(h3 != "undefined" && h4 != "undefined"){
           var t2 = parseInt(h3) + parseInt(h4);
        // }else if(h3 != "undefined" && h4 == "undefined"){
            //var t2 = parseInt(h3);
         //}else if(h3 == "undefined" && h4 != "undefined"){
          // var t2 = parseInt(h4);
       //  }else{
         //  var t2 = 0;
        // }


          var Total = parseInt(t1) +  parseInt(t2);
          var height = parseInt(Total) + parseInt(height1);

          $(this).parent('.iepa-sub-menu-wrap').height(height);


     });

      $( window ).resize(function() {
        $('.iepa-orientation-vertical').each(function(){
                 var win_width = $(window).width();
                 if(win_width < 1200){
                   var menu_width = $(this).width();
                   var total_width = parseInt(win_width) - parseInt(menu_width)- 70;

                   $(this).find('.iepa-sub-menu-wrap').width(total_width);

                 }

        });

       }).resize();
    }

    */
  /* Tabs Javascript */

  $('.iepamega-tabs').find('.iepa-mega-sub-menu li').addClass('iepa-tabs-section');
  // Example Hints: http://jsfiddle.net/uyvUZ/2/
  $('.iepamega-tabs > .iepa-sub-menu-wrapper ul.iepa-mega-sub-menu').each(function(i) {
    $(this).addClass('iepa-tab-groups');
  });
  $('.iepamega-tabs > .iepa-sub-menu-wrapper ul.iepa-mega-sub-menu > li .iepa-mega-sub-menu').each(function(i) {
    $(this).addClass('iepa-tab-groups-panel');
    $(this).removeClass('iepa-tab-groups');
  });
  $(".iepa-tabs-section").removeClass('show_tab');
  $(".iepamega-tabs .iepa-sub-menu-wrapper ul.iepa-mega-sub-menu.iepa-tab-groups").each(function() {
    $(this).find('li:first').addClass("show_tab");
    $(this).nextAll('.iepa-mega-sub-menu:first').find('.iepa-tabs-section:first').addClass('show_tab');
  });


  $(".iepamega-tabs.iepa-tabbed-onhover .iepa-sub-menu-wrapper ul.iepa-mega-sub-menu.iepa-tab-groups > li > a").on('hover', function() {
    var cTab = $(this).closest('li');
    var animated = cTab.closest('.iepamega-tabs').attr('data-animation');
    var vcontent_height = $(this).parent().find('.iepa-tab-groups-panel').actual('outerHeight');
    var totaltabheight = $(this).parents('.iepa-tab-groups').actual('outerHeight');
    var hTabTitleHeight = parseInt($(this).parent().height()) + 15;
    var target = $(this).attr('target');
    var link = $(this).attr('href');

    if (totaltabheight > 0) {
      /* Open hide tab content start */
      cTab.siblings('li').removeClass('show_tab');
      $('.iepa-tab-groups-panel').removeClass(animated);
      cTab.addClass('show_tab');
      cTab.find('.iepa-tab-groups-panel').addClass('animated ' + animated);
      cTab.closest('ul.iepa-mega-sub-menu').nextAll('.iepa-mega-sub-menu:first').find('.iepa-tabs-section').removeClass('show_tab');
      /* Open hide tab content end */
      if ($(this).closest('.iepamega-tabs').hasClass('iepamega-vertical-tabs')) {
        if (totaltabheight > vcontent_height) {
          $(this).parents('.iepa-tab-groups').css('min-height', totaltabheight);
        } else {
          $(this).parents('.iepa-tab-groups').css('min-height', vcontent_height);
        }
      } else {
        var hcontent_height = $(this).parent().find('.iepa-tab-groups-panel').actual('outerHeight') + 10;
        var total_height = parseInt(hcontent_height) + parseInt(hTabTitleHeight);
        $(this).parents('.iepa-tab-groups').css('min-height', total_height);
      }
    }

    return false;
  });
  // $(".iepamega-tabs.iepa-tabbed-onhover .iepa-sub-menu-wrapper").on({
  //     mouseenter: function () {
  //        var cTab = $(this).closest('li');
  //       var animated = cTab.closest('.iepamega-tabs').attr('data-animation');
  //       var vcontent_height =  $(this).parent().find('.iepa-tab-groups-panel').actual( 'outerHeight' );
  //       var totaltabheight = $(this).parents('.iepa-tab-groups').actual('outerHeight');
  //       var hTabTitleHeight = parseInt($(this).parent().height()) + 15;
  //       var target = $(this).attr('target');
  //       var link = $(this).attr('href');
  //
  //       if(totaltabheight > 0){
  //         /* Open hide tab content start */
  //         cTab.siblings('li').removeClass('show_tab');
  //         $('.iepa-tab-groups-panel').removeClass(animated);
  //         cTab.addClass('show_tab');
  //         cTab.find('.iepa-tab-groups-panel').addClass('animated '+animated);
  //         cTab.closest('ul.iepa-mega-sub-menu').nextAll('.iepa-mega-sub-menu:first').find('.iepa-tabs-section').removeClass('show_tab');
  //         /* Open hide tab content end */
  //         if($(this).closest('.iepamega-tabs').hasClass('iepamega-vertical-tabs')){
  //           if(totaltabheight > vcontent_height){
  //             $(this).parents('.iepa-tab-groups').css('min-height',totaltabheight);
  //           }else{
  //             $(this).parents('.iepa-tab-groups').css('min-height',vcontent_height);
  //           }
  //         }else{
  //           var hcontent_height =  $(this).parent().find('.iepa-tab-groups-panel').actual( 'outerHeight' ) + 10;
  //           var total_height = parseInt(hcontent_height) + parseInt(hTabTitleHeight);
  //           $(this).parents('.iepa-tab-groups').css('min-height',total_height);
  //         }
  //       }
  //
  //       return false;
  //     },
  //     mouseleave:function () {
  // //        $(this).removeClass("hover");
  //     }
  // },'ul.iepa-mega-sub-menu.iepa-tab-groups > li > a');
  $(window).resize(function() {
    if ($(window).width() <= 910) {
      $('.iepamega-tabs.iepa-tabbed-onclick .iepa-sub-menu-wrapper ul.iepa-mega-sub-menu.iepa-tab-groups > li > a').on('click', function(e) {
        e.preventDefault();
        var cTab = $(this).closest('li');
        var animated = cTab.closest('.iepamega-tabs').attr('data-animation');
        var vcontent_height = $(this).parent().find('.iepa-tab-groups-panel').actual('outerHeight');
        var totaltabheight = $(this).parents('.iepa-tab-groups').actual('outerHeight');
        var hTabTitleHeight = parseInt($(this).parent().height()) + 15;
        var target = $(this).attr('target');
        var link = $(this).attr('href');
        if (link == '' || link == '#') {
          if (totaltabheight > 0) {
            /* Open hide tab content start */
            /* if(cTab.hasClass('show_tab')){
              cTab.removeClass('show_tab');
             }else{
              cTab.siblings('li').removeClass('show_tab');
              cTab.closest('ul.iepa-mega-sub-menu').nextAll('.iepa-mega-sub-menu:first').find('.iepa-tabs-section').removeClass('show_tab');
              cTab.addClass('show_tab');
             }*/
            //cTab.siblings('li').removeClass('show_tab');
            //  cTab.closest('ul.iepa-mega-sub-menu').nextAll('.iepa-mega-sub-menu:first').find('.iepa-tabs-section').removeClass('show_tab');
            cTab.closest('ul.iepa-tab-groups').find('li').removeClass('show_tab');
            cTab.addClass('show_tab');

            /* Open hide tab content end */
            $('.iepa-tab-groups-panel').removeClass(animated);
            cTab.find('.iepa-tab-groups-panel').addClass('animated ' + animated);
            if ($(this).closest('.iepamega-tabs').hasClass('iepamega-vertical-tabs')) {
              if (totaltabheight > vcontent_height) {
                $(this).parents('.iepa-tab-groups').css('min-height', totaltabheight);
              } else {
                $(this).parents('.iepa-tab-groups').css('min-height', vcontent_height);
              }
            } else {
              var hcontent_height = $(this).parent().find('.iepa-tab-groups-panel').actual('outerHeight') + 10;
              var total_height = parseInt(hcontent_height) + parseInt(hTabTitleHeight);
              if (cTab.hasClass('show_tab')) {
                $(this).parents('.iepa-tab-groups').css('min-height', total_height);
              } else {
                $(this).parents('.iepa-tab-groups').css('min-height', 0);
              }

            }

          }
        } else {
          if (target == "_blank") {
            window.open(link, target);
          } else {
            window.location = link;
          }
        }
      });
    } else {
      $('.iepamega-tabs.iepa-tabbed-onclick .iepa-sub-menu-wrapper').on('click', 'ul.iepa-mega-sub-menu.iepa-tab-groups > li > a', function(e) {
        e.preventDefault();
        var cTab = $(this).closest('li');
        var animated = cTab.closest('.iepamega-tabs').attr('data-animation');
        var vcontent_height = $(this).parent().find('.iepa-tab-groups-panel').actual('outerHeight');
        var totaltabheight = $(this).parents('.iepa-tab-groups').actual('outerHeight');
        var hTabTitleHeight = parseInt($(this).parent().height()) + 15;
        var target = $(this).attr('target');
        var link = $(this).attr('href');

        if (link == '' || link == '#') {
          if (totaltabheight > 0) {
            /* Open hide tab content start */
            cTab.siblings('li').removeClass('show_tab');
            $('.iepa-tab-groups-panel').removeClass(animated);
            // cTab.addClass('show_tab');
            cTab.toggleClass('show_tab');
            cTab.find('.iepa-tab-groups-panel').addClass('animated ' + animated);
            cTab.closest('ul.iepa-mega-sub-menu').nextAll('.iepa-mega-sub-menu:first').find('.iepa-tabs-section').removeClass('show_tab');
            /* Open hide tab content end */
            if ($(this).closest('.iepamega-tabs').hasClass('iepamega-vertical-tabs')) {
              if (totaltabheight > vcontent_height) {
                $(this).parents('.iepa-tab-groups').css('min-height', totaltabheight);
              } else {
                $(this).parents('.iepa-tab-groups').css('min-height', vcontent_height);
              }
            } else {
              var hcontent_height = $(this).parent().find('.iepa-tab-groups-panel').actual('outerHeight') + 10;
              var total_height = parseInt(hcontent_height) + parseInt(hTabTitleHeight);
              $(this).parents('.iepa-tab-groups').css('min-height', total_height);
            }
          }
        } else {
          if (target == "_blank") {
            window.open(link, target);
          } else {
            window.location = link;
          }
        }
      });

    }
  }).resize();




  setTimeout(function() {
    $('.iepamega-tabs > .iepa-sub-menu-wrapper ul.iepa-tab-groups').each(function() {
      var height = $(this).actual('outerHeight');
      var content_height = $(this).children('li').first().find('.iepa-tab-groups-panel').actual('outerHeight');
      var horizontalTabTitleHeight = parseInt($(this).children('li').first().actual('outerHeight')) + 15;
      if ($(this).closest('.iepamega-tabs').hasClass('iepamega-vertical-tabs')) {
        if (height > content_height) {
          $(this).css('min-height', height);
        } else {
          $(this).css('min-height', content_height);
        }
      } else {
        var total_height = parseInt(content_height) + parseInt(horizontalTabTitleHeight);
        $(this).css('min-height', total_height);
      }
    });
  }, 2000);
  /* tabs end */

  //sticky menu
  var sticky_opacity = iepa_megamenu_params.iepa_sticky_opacity;
  var sticky_offset = iepa_megamenu_params.iepa_sticky_offset;

  if (sticky_offset == '') {
    sticky_offset = '0px';
  } else {
    sticky_offset = parseInt(sticky_offset) + 'px';
  }

  var sticky_zindex = iepa_megamenu_params.iepa_sticky_zindex;

  if ($('.iepa-megamenu-main-wrapper').hasClass("iepa-pro-sticky")) {

    $this = $('.iepa-pro-sticky');
    // Check the initial Poistion of the Sticky Header
    var stickyHeaderTop = $('.iepa-pro-sticky').offset().top;
    $(window).scroll(function() {
      if ($(window).scrollTop() > stickyHeaderTop) {

        $this.addClass('navbar-fixed-top');
        $('.navbar-fixed-top').css({
          'top': sticky_offset,
          'z-index': sticky_zindex
        });
        $('.navbar-fixed-top').css('opacity', sticky_opacity);
      } else {
        $this.removeClass('navbar-fixed-top');
      }
    });
  }
  // sticky menu end

  /*   $('.iepa-megamenu-main-wrapper .iepa-sub-menu-wrap').each(function(){
      var nextimage = $(this).attr('data-nextimage');
      var nextimage1 = $(this).attr('data-nextimage1');
      var repeat = $(this).attr('data-repeat');
      var position = $(this).attr('data-position');
      if(nextimage != '' && nextimage != undefined){

        $(this).hover(function(){
          $(this).addClass("iepa-fadeOut");
          $(this).css("background-image", "url("+nextimage+")");
          $(this).css("background-repeat",repeat);
          $(this).css("background-position",position);
          $(this).css("background-size",'cover');
        //$(this).css("transition",'2.5s');

      }).mouseleave(function(){
        $(this).removeClass("iepa-fadeOut");
        $(this).css("background-image", "url("+nextimage1+")");
        $(this).css("background-repeat",repeat);
        $(this).css("background-position",position);
        $(this).css("background-size",'cover');
         //$(this).css("transition",'0s');
       });

    }

  });*/


  $('.iepa-original-submenus').each(function() {
    var id = $(this).find('li').attr('id');
    var appended_html = $(this).html();
    $(this).parent().find('.iepa-group1').find('.iepa-clone-submenus').find('li#' + id).parent().replaceWith(appended_html);
    $(this).remove();
  });


  /* widget posts slider*/
  $('.iepamega-posts-slider').each(function() {
    var selector = $(this);
    var speed = $(this).data('speed');
    var auto = $(this).data('auto-slide');
    var slider_duration = $(this).data('duration');
    var controls = $(this).data('controls');
    var id = $(this).data('id');
    var mode = $(this).data('mode');
    $(this).bxSlider({
      speed: speed,
      pause: slider_duration,
      auto: auto,
      pager: false,
      mode: mode,
      controls: controls,
      infiniteLoop: false,
      adaptiveHeight: true
    });

  });

  /*
   * Double animation background image
   */
  $('.iepa-sub-menu-wrap').each(function() {
    if ($(this).hasClass('iepa-double-image-animation')) {
      var topimage = $(this).find('.animation-double-bgimage').data('top-image');
      var bottomimage = $(this).find('.animation-double-bgimage').data('second-image');
      $(this).hover(function() {
        $(this).css("background-image", "url(" + bottomimage + ")");
      }).mouseleave(function() {
        $(this).css("background-image", "url(" + topimage + ")");
      });
    }
  });

  /*
   * Fusion Avada Theme with its Search icon inside menu compatibiltiy
   */
  $('.iepa-megamenu-main-wrapper').each(function() {
    var liclass = $(this).find('li.fusion-custom-menu-item');
    if (liclass.hasClass('fusion-main-menu-search')) {
      //has search icon
      $(this).find('li.fusion-custom-menu-item.fusion-main-menu-search .fusion-custom-menu-item-contents').addClass('iepa-sub-menu-wrap');
    }
  });

  // Menu Should be open if the window size is <= 1024
  function openIepaMegaWrapper() {
    if ($(window).width() <= 1024) {
      $( '.iepa-mega-wrapper' ).addClass( 'iepa-show-menu' );
      $( '.iepamega-closeblock' ).show();
      $( '.iepamega-openblock' ).hide();
    }
  }
  $(window).on('resize', function() {
    openIepaMegaWrapper();
  });
  openIepaMegaWrapper();
  // Menu Should be open if the window size is <= 1024 END


  // IEPA: Post Taxonomy Layout START
  $( '.iepa-pctw-tab-wrap' ).on('click', function () {
    var $this       = $(this);
    var $this_index = $(this).index();
    $(this).closest( '.iepa-pctw-tabs' ).find('.iepa-pctw-tab-wrap').removeClass('active');
    $(this).addClass('active');
    $(this).closest('.iepa-pctw-wrapper').find('.iepa-pctw-container').removeClass('active');
    $(this).closest('.iepa-pctw-wrapper').find('.iepa-pctw-container-wrap .iepa-pctw-container:nth-child('+(1+$this_index)+')').addClass('active');
  });

  $( '.iepa-pctw-accordion-wrap .iepa-pctw-accordion' ).on( 'click', function() {
    var $this = $(this);
    if ( $this.closest( '.iepa-pctw-accordion-wrap' ).hasClass( 'active' ) ) {
      $this.closest( '.iepa-pctw-accordion-wrap' ).removeClass( 'active' );
    } else {
      $this.closest( '.iepa-pctw-accordions' ).find( '.iepa-pctw-accordion-wrap' ).removeClass( 'active' );
      $this.closest( '.iepa-pctw-accordion-wrap' ).addClass( 'active' );
    }
  } );
  // IEPA: Post Taxonomy Layout END
});
