(function ($) {
  var urlParams = sfwf_localize_current_form.formId;

  /**
   * Not compatible with wordpress 4.7 onwards
   * using wp_localize script from now onwards
   */
  // (window.onpopstate = function () {
  //     var match,
  //         pl     = /\+/g,  // Regex for replacing addition symbol with a space
  //         search = /([^&=]+)=?([^&]*)/g,
  //         decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
  //         query  = window.location.search.substring(1);

  //     urlParams = {};
  //     while (match = search.exec(query))
  //        urlParams[decode(match[1])] = decode(match[2]);
  // })();

  //Check if px is added, if not then add automatically
  function addPxToValue(to) {
    var parsedTo = parseInt(to);
    if (parsedTo == to) {
      to = to + "px";
    }
    return to;
  }

  function addGoogleFont(FontName) {
    var fontPlus = "";
    FontName = FontName.split(" ");
    if ($.isArray(FontName)) {
      fontPlus = FontName[0];
      for (var i = 1; i < FontName.length; i++) {
        fontPlus = fontPlus + "+" + FontName[i];
      }
    }
    $("head").append(
      "<link href='https://fonts.googleapis.com/css?family=" +
        fontPlus +
        "' rel='stylesheet' type='text/css'>"
    );
  }
  //function to set bold/italic/uppercase and underline values

  function setFontStyles(value) {
    var value = value.split("|");
    var fontStyles = {
      "font-weight": "normal",
      "font-style": "normal",
      "text-transform": "none",
      "text-decoration": "none",
    };
    value.map(function (currentValue) {
      // if( fontStyles !== ''){
      // 	fontStyles = fontStyles +',';
      // }
      switch (currentValue) {
        case "bold":
          fontStyles["font-weight"] = "bold";
          break;
        case "italic":
          fontStyles["font-style"] = "italic";
          break;
        case "uppercase":
          fontStyles["text-transform"] = "uppercase";
          break;
        case "underline":
          fontStyles["text-decoration"] = "underline";
          break;
        default:
          break;
      }
    });
    return fontStyles;
  }
  //********************************* Form Wrapper *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][background-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams).css("background", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][max-width]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-" + urlParams).css("width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][font]",
    function (value) {
      value.bind(function (to) {
        if (to == "Default") {
          $("#wpforms-" + urlParams).css("font-family", "inherit");
        } else {
          addGoogleFont(to);
          $("#wpforms-" + urlParams).css("font-family", to);
        }
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][border-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-" + urlParams).css("border-width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][border-type]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams).css("border-style", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][border-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams).css("border-color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][border-radius]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-" + urlParams).css("border-radius", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][background-image]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams).css("background-image", "url(" + to + ")");
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][margin]",
    function (value) {
      value.bind(function (to) {
        //   to = addPxToValue(to);
        $("#wpforms-" + urlParams).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-wrapper][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $("#wpforms-" + urlParams).css("padding", to);
      });
    }
  );

  //********************************* Form Header *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-header][background-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams + " .wpforms-head-container").css(
          "background",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-header][border-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-" + urlParams + " .wpforms-head-container").css(
          "border-width",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-header][border-type]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams + " .wpforms-head-container").css(
          "border-style",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-header][border-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams + " .wpforms-head-container").css(
          "border-color",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-header][border-radius]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-" + urlParams + " .wpforms-head-container").css(
          "border-radius",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-header][margin]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $("#wpforms-" + urlParams + " .wpforms-head-container").css(
          "margin",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-header][padding]",
    function (value) {
      value.bind(function (to) {
        //    to = addPxToValue(to);
        $("#wpforms-" + urlParams + " .wpforms-head-container").css(
          "padding",
          to
        );
      });
    }
  );

  //********************************* Form Title *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-title][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" + urlParams + " .wpforms-head-container .wpforms-title"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-title][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-head-container .wpforms-title"
        ).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-title][text-align]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" + urlParams + " .wpforms-head-container .wpforms-title"
        ).css("text-align", to);
      });
    }
  );
  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-title][font-style]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" + urlParams + " .wpforms-head-container .wpforms-title"
        ).css(setFontStyles(to));
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-title][margin]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-head-container .wpforms-title"
        ).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-title][padding]",
    function (value) {
      value.bind(function (to) {
        //  to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-head-container .wpforms-title"
        ).css("padding", to);
      });
    }
  );

  //********************************* Form Description *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-description][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-head-container .wpforms-description"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-description][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-head-container .wpforms-description"
        ).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-description][text-align]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-head-container .wpforms-description"
        ).css("text-align", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-description][font-style]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-head-container .wpforms-description"
        ).css(setFontStyles(to));
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-description][margin]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-head-container .wpforms-description"
        ).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[form-description][padding]",
    function (value) {
      value.bind(function (to) {
        //  to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-head-container .wpforms-description"
        ).css("padding", to);
      });
    }
  );

  //********************************* Dropdown Fields *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("color", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner .choices__list .choices__item"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("font-size", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][max-width]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("width", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][background-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("background", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner "
        ).css("background", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][font-style]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css(setFontStyles(to));

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css(setFontStyles(to));
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][border-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("border-width", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("border-width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][border-type]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("border-style", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("border-style", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][border-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("border-color", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("border-color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][border-radius]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("border-radius", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("border-radius", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][margin]",
    function (value) {
      value.bind(function (to) {
        //  to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("margin", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[dropdown-fields][padding]",
    function (value) {
      value.bind(function (to) {
        //    to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select select"
        ).css("padding", to);

        // modern dropdown.
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field.wpforms-field-select-style-modern .choices__inner"
        ).css("padding", to);
      });
    }
  );

  //********************************* Radio Inputs *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[radio-inputs][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-radio li label, #wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-payment-multiple li label"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[radio-inputs][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-radio li label, #wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-payment-multiple li label"
        ).css("font-size", to);
      });
    }
  );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[radio-inputs][max-width]', function( value ) {
  //     value.bind( function( to ) {
  //       to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field-radio li label' ).css( 'width',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[radio-inputs][margin]', function( value ) {
  //     value.bind( function( to ) {
  //      // to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field-radio li label' ).css( 'margin',to );
  //          } );
  //   } );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[radio-inputs][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-radio li label, #wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-payment-multiple li label"
        ).css("padding", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[radio-inputs][font-style]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-radio li label, #wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-payment-multiple li label"
        ).css(setFontStyles(to));
      });
    }
  );

  //********************************* Checkbox Inputs *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[checkbox-inputs][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-checkbox li label"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[checkbox-inputs][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-checkbox li label"
        ).css("font-size", to);
      });
    }
  );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[checkbox-inputs][max-width]', function( value ) {
  //     value.bind( function( to ) {
  //       to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field-checkbox li label' ).css( 'width',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[checkbox-inputs][margin]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field-checkbox li label' ).css( 'margin',to );
  //          } );
  //   } );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[checkbox-inputs][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-checkbox li label"
        ).css("padding", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[checkbox-inputs][font-style]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field-checkbox li label"
        ).css(setFontStyles(to));
      });
    }
  );
  //********************************* Field Labels *******************************************

  // wp.customize( 'sfwf_form_id_'+urlParams+'[field-labels][display]', function( value ) {
  //   value.bind( function( to ) {
  //           if(to){
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field label.wpforms-field-label' ).css( 'display','none' );
  //           }
  //           else{
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field label.wpforms-field-label' ).css( 'display','inherit' );
  //           }
  //        } );
  // } );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-labels][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field label.wpforms-field-label"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-labels][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field label.wpforms-field-label"
        ).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-labels][text-align]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field label.wpforms-field-label"
        ).css("text-align", to);
      });
    }
  );
  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-labels][font-style]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field label.wpforms-field-label"
        ).css(setFontStyles(to));
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-labels][margin]",
    function (value) {
      value.bind(function (to) {
        //   to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field label.wpforms-field-label"
        ).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-labels][padding]",
    function (value) {
      value.bind(function (to) {
        //  to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field label.wpforms-field-label"
        ).css("padding", to);
      });
    }
  );

  //********************************* Sub Labels *******************************************

  // wp.customize( 'sfwf_form_id_'+urlParams+'[field-sub-labels][font-color]', function( value ) {
  //     value.bind( function( to ) {
  //                 $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_full label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_right label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_left label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_time_hour label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_time_minute label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_month label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_day label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_year label' ).css( 'color',to );

  //               $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .name_first label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .name_last label' ).css( 'color',to );

  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_line_1 label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_line_2 label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_city label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_state label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_zip label' ).css( 'color',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_country label' ).css( 'color',to );
  //          } );
  //   } );

  //    wp.customize( 'sfwf_form_id_'+urlParams+'[field-sub-labels][font-size]', function( value ) {
  //     value.bind( function( to ) {
  //       to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_full label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_right label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_left label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_time_hour label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_time_minute label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_month label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_day label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_year label' ).css( 'font-size',to );

  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .name_first label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .name_last label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_line_1 label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_line_2 label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_city label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_state label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_zip label' ).css( 'font-size',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_country label' ).css( 'font-size',to );

  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[field-sub-labels][padding]', function( value ) {
  //     value.bind( function( to ) {
  //       //to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_full label' ).css( 'padding',to);
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_right label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_complex .ginput_left label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_time_hour label' ).css( 'padding',to);
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_time_minute label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_month label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_day label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .gfield_date_year label' ).css( 'padding',to );

  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .name_first label' ).css( 'padding',to);
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .name_last label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_line_1 label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_line_2 label' ).css( 'padding',to);
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_city label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_state label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_zip label' ).css( 'padding',to );
  //              $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .address_country label' ).css( 'padding',to );
  //          } );
  //   } );
  //********************************* Field Descriptions *******************************************

  // wp.customize( 'sfwf_form_id_'+urlParams+'[field-descriptions][font-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .wpforms-field-description' ).css( 'color',to );
  //        } );
  // } );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-descriptions][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field .wpforms-field-description"
        ).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-descriptions][text-align]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field .wpforms-field-description"
        ).css("display", "block");
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field .wpforms-field-description"
        ).css("text-align", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-descriptions][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field .wpforms-field-description"
        ).css("color", to);
      });
    }
  );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[field-descriptions][margin]', function( value ) {
  //     value.bind( function( to ) {
  //     //  to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .wpforms-field-description' ).css( 'margin',to );
  //          } );
  //   } );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-descriptions][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field .wpforms-field-description"
        ).css("padding", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[field-descriptions][font-style]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field .wpforms-field-description"
        ).css(setFontStyles(to));
      });
    }
  );

  //********************************* Text Fields *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("font-size", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("font-size", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("font-size", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("font-size", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][max-width]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][background-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("background", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("background", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("background", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("background", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("background", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][border-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("border-width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("border-width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("border-width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("border-width", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("border-width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][border-type]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("border-style", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("border-style", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("border-style", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("border-style", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("border-style", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][border-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("border-color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("border-color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("border-color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("border-color", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("border-color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][border-radius]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("border-radius", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("border-radius", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("border-radius", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("border-radius", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("border-radius", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][margin]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("margin", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("margin", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("margin", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("margin", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css("padding", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css("padding", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css("padding", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css("padding", to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css("padding", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[text-fields][font-style]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=text]"
        ).css(setFontStyles(to));
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=email]"
        ).css(setFontStyles(to));
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=tel]"
        ).css(setFontStyles(to));
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=password]"
        ).css(setFontStyles(to));
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-form .wpforms-field input[type=number]"
        ).css(setFontStyles(to));
      });
    }
  );

  //********************************* Paragraph Textarea Fields *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][max-width]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][background-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("background", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][border-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("border-width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][border-type]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("border-style", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][border-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("border-color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][border-radius]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("border-radius", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][font-style]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css(setFontStyles(to));
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][margin]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[paragraph-textarea][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" + urlParams + " .wpforms-form .wpforms-field textarea"
        ).css("padding", to);
      });
    }
  );

  //********************************* List Field Table*******************************************

  // wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-table][background-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list' ).css( 'background-color',to );
  //        } );
  // } );

  //********************************* List Field Heading*******************************************

  //  wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-heading][font-size]', function( value ) {
  //   value.bind( function( to ) {
  //     to = addPxToValue(to);
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list thead th' ).css( 'font-size',to );
  //        } );
  // } );

  //  wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-heading][font-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list thead th' ).css( 'color',to );
  //        } );
  // } );

  //  wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-heading][background-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list thead th' ).css( 'background-color',to );
  //        } );
  // } );

  //  wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-heading][text-align]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list thead th' ).css( 'text-align',to );
  //        } );
  // } );

  //  wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-heading][padding]', function( value ) {
  //   value.bind( function( to ) {
  //    // to = addPxToValue(to);
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list thead th' ).css( 'padding',to );
  //        } );
  // } );

  //********************************* List Field Cell*******************************************

  //  wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-cell][font-size]', function( value ) {
  //   value.bind( function( to ) {
  //     to = addPxToValue(to);
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'font-size',to );
  //        } );
  // } );

  //     wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-cell][font-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'color',to );
  //        } );
  // } );

  //    wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-cell][background-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'background-color',to );
  //        } );
  // } );

  //    wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-cell][text-align]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'text-align',to );
  //        } );
  // } );

  // //********************************* List Field Cell Container*******************************************

  //  wp.customize( 'sfwf_form_id_'+urlParams+'[list-field-cell-container][padding]', function( value ) {
  //   value.bind( function( to ) {
  //    // to = addPxToValue(to);
  //           $( '#wpforms-'+urlParams+' .wpforms-form .wpforms-field .ginput_list table.gfield_list tbody tr td.gfield_list_cell' ).css( 'padding',to );
  //        } );
  // } );

  //********************************* Submit Button *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][button-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit , #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("background", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'background',to );
      });
    }
  );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[submit-button][hover-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#wpforms-'+urlParams+' .wpforms-submit-container .wpforms-submit:hover' ).css( 'background',to );
  //           $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button:hover' ).css( 'background',to );
  //        } );
  // } );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][width]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][height]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("height", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'height',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][text-align]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container,#wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak .wpforms-pagebreak-left"
        ).css("text-align", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'float',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][font-style]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css(setFontStyles(to));
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'float',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit,#wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("font-size", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'font-size',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][border-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("border-width", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-width',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][border-type]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("border-style", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-style',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][border-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("border-color", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-color',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][border-radius]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("border-radius", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-radius',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][font-color]",
    function (value) {
      value.bind(function (to) {
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("color", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'color',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][margin]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("margin", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'margin',to );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[submit-button][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $(
          "#wpforms-" +
            urlParams +
            " .wpforms-submit-container .wpforms-submit, #wpforms-" +
            urlParams +
            " .wpforms-field-pagebreak button.wpforms-page-button"
        ).css("padding", to);
        // $( '#wpforms-'+urlParams+' .gform_footer button.mdl-button' ).css( 'padding',to);
      });
    }
  );

  //********************************* Section Break Title *******************************************

  //   wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-title][font-color]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_title' ).css( 'color',to );
  //          } );
  //   } );

  //    wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-title][font-size]', function( value ) {
  //     value.bind( function( to ) {
  //       to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_title' ).css( 'font-size',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-title][text-align]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_title' ).css( 'text-align',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-title][background-color]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_title' ).css( 'background-color',to );
  //          } );
  //   } );

  //********************************* Section Break Description *******************************************

  //   wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-description][font-color]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_description' ).css( 'color',to );
  //          } );
  //   } );

  //   wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-description][background-color]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_description' ).css( 'background-color',to );
  //          } );
  //  } );

  //    wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-description][font-size]', function( value ) {
  //     value.bind( function( to ) {
  //       to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_description' ).css( 'font-size',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-description][text-align]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_description' ).css( 'text-align',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-description][margin]', function( value ) {
  //     value.bind( function( to ) {
  //    //   to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection .gsection_description' ).css( 'margin',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[section-break-description][padding]', function( value ) {
  //     value.bind( function( to ) {
  //       //to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' .wpforms-form .gform_fields .gsection' ).css( 'padding',to);
  //          } );
  //   } );

  //********************************* Confirmation Message *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][font-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-confirmation-" + urlParams).css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][text-align]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-confirmation-" + urlParams).css("text-align", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-confirmation-" + urlParams).css("font-size", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][max-width]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-confirmation-" + urlParams).css("width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][background-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-confirmation-" + urlParams).css("background", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][border-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-confirmation-" + urlParams).css("border-width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][border-type]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-confirmation-" + urlParams).css("border-style", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][border-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-confirmation-" + urlParams).css("border-color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][border-radius]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-confirmation-" + urlParams).css("border-radius", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][margin]",
    function (value) {
      value.bind(function (to) {
        //  to = addPxToValue(to);
        $("#wpforms-confirmation-" + urlParams).css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][font-style]",
    function (value) {
      value.bind(function (to) {
        //  to = addPxToValue(to);
        $("#wpforms-confirmation-" + urlParams).css(setFontStyles(to));
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[confirmation-message][padding]",
    function (value) {
      value.bind(function (to) {
        // to = addPxToValue(to);
        $("#wpforms-confirmation-" + urlParams).css("padding", to);
      });
    }
  );

  //********************************* error Message *******************************************

  wp.customize(
    "sfwf_form_id_" + urlParams + "[error-message][font-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams + " label.wpforms-error").css("color", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[error-message][text-align]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams + " label.wpforms-error").css(
          "text-align",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[error-message][font-size]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-" + urlParams + " label.wpforms-error").css(
          "font-size",
          to
        );
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[error-message][max-width]",
    function (value) {
      value.bind(function (to) {
        to = addPxToValue(to);
        $("#wpforms-" + urlParams + " label.wpforms-error").css("width", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[error-message][background-color]",
    function (value) {
      value.bind(function (to) {
        $("#wpforms-" + urlParams + " label.wpforms-error").css(
          "background",
          to
        );
      });
    }
  );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[error-message][border-size]', function( value ) {
  //     value.bind( function( to ) {
  //       to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' label.wpforms-error').css( 'border-width',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[error-message][border-type]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' label.wpforms-error').css( 'border-style',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[error-message][border-color]', function( value ) {
  //     value.bind( function( to ) {
  //             $( '#wpforms-'+urlParams+' label.wpforms-error').css( 'border-color',to );
  //          } );
  //   } );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[error-message][border-radius]', function( value ) {
  //     value.bind( function( to ) {
  //       to = addPxToValue(to);
  //             $( '#wpforms-'+urlParams+' label.wpforms-error').css( 'border-radius',to );
  //          } );
  //   } );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[error-message][margin]",
    function (value) {
      value.bind(function (to) {
        //   to = addPxToValue(to);
        $("#wpforms-" + urlParams + " label.wpforms-error").css("margin", to);
      });
    }
  );

  wp.customize(
    "sfwf_form_id_" + urlParams + "[error-message][padding]",
    function (value) {
      value.bind(function (to) {
        //  to = addPxToValue(to);
        $("#wpforms-" + urlParams + " label.wpforms-error").css("padding", to);
      });
    }
  );

  // wp.customize( 'sfwf_form_id_'+urlParams+'[error-message][font-style]', function( value ) {
  //   value.bind( function( to ) {
  //   //  to = addPxToValue(to);
  //           $( '#wpforms-'+urlParams+' label.wpforms-error').css( setFontStyles( to ) );
  //        } );
  // } );
})(jQuery);
