(function($){
//for font style
wp.customize.bind('ready', function() {
	$('body').on('change', 'input.sfwf_font_style_checkbox[type=checkbox]', function(){

		var $this_el      = $(this),
			$main_option  = $this_el.closest( 'span' ).siblings( 'input.sfwf_font_styles' ),
			value         = $this_el.val(),
			current_value = $main_option.val(),
			values        = ( current_value != 'false' ) ? current_value.split( '|' ) : [],
			query         = $.inArray( value, values ),
			result        = '';
	
		if ( $this_el.prop('checked' ) === true ) {
	
			if ( current_value.length ) {
	
				if ( query < 0 ) {
					values.push( value );
	
					result = values.join( '|' );
				}
			} else {
				result = value;
			}
		} else {
	
			if ( current_value.length !== 0 ) {
	
				if ( query >= 0 ) {
					values.splice( query, 1 );
	
					result = values.join( '|' );
				} else {
					result = current_value;
				}
			}
		}
	
		$main_option.val( result ).trigger( 'change' );
	});
	
	$( 'body' ).on('click', 'span.sfwf_font_style', function() {
		var style_checkbox = $( this ).find( 'input' );
		$( this ).toggleClass( 'sfwf_font_style_checked' );
	
		if ( style_checkbox.is( ':checked' ) ) {
			style_checkbox.prop( 'checked', false );
		} else {
			style_checkbox.prop( 'checked', true );
		}
	
		style_checkbox.change();
	});

	//Text alignment control

	$('body').on('change', 'input.sfwf_text_alignment_radio[type=radio]', function(){

		var $this_el      = $(this),
			$main_option  = $this_el.closest( 'span' ).siblings( 'input.sfwf_text_alignment_control' ),
			value         = $this_el.val();
			//console.log(value);
			//current_value = $main_option.val(),
			// values        = ( current_value != 'false' ) ? current_value.split( '|' ) : [],
			// query         = $.inArray( value, values ),
			// result        = '';
	
		// if ( $this_el.prop('checked' ) === true ) {
	
		// 	if ( current_value.length ) {
	
		// 		if ( query < 0 ) {
		// 			values.push( value );
	
		// 			result = values.join( '|' );
		// 		}
		// 	} else {
		// 		result = value;
		// 	}
		// } else {
	
		// 	if ( current_value.length !== 0 ) {
	
		// 		if ( query >= 0 ) {
		// 			values.splice( query, 1 );
	
		// 			result = values.join( '|' );
		// 		} else {
		// 			result = current_value;
		// 		}
		// 	}
		// }
	
		$main_option.val( value ).trigger( 'change' );
	});

	$( 'body' ).on('click', 'span.sfwf_text_alignment', function() {
		//console.log( this);
		var style_radio = $( this ).find( 'input' );
		var remove_radios = $( this ).siblings( 'span' );
		remove_radios.each(function(){
			$(this).removeClass( 'sfwf_text_alignment_checked');
			$(this).find('input').prop( 'checked', false );
		});
		$( this ).addClass( 'sfwf_text_alignment_checked' );
		style_radio.prop( 'checked', true );
	
		style_radio.change();
	});


	//to switch between different views ( Desktop, Mobile, Tablet)

	$( 'body' ).on('click', 'span.sfwf_desktop_text_input:not(.active)', function() {
		if( ! $('.devices .preview-desktop').hasClass('active') ) {
			$('.preview-desktop').trigger('click');
			$('.sfwf_desktop_text_input').addClass('active');
			$('.sfwf_tab_text_input').removeClass('active');
			$('.sfwf_mobile_text_input').removeClass('active');
		}		
	});

	$( 'body' ).on('click', 'span.sfwf_tab_text_input:not(.active)', function() {
		if( ! $('.devices .preview-tablet').hasClass('active') ) {
			$('.sfwf_tab_text_input').addClass('active');
			$('.sfwf_desktop_text_input').removeClass('active');
			$('.sfwf_mobile_text_input').removeClass('active');
			$('.preview-tablet').trigger('click');
		}
	});


	$( 'body' ).on('click', 'span.sfwf_mobile_text_input:not(.active)', function() {
		if( ! $('.devices .preview-mobile').hasClass('active') ) {
			$('.sfwf_mobile_text_input').addClass('active');
			$('.sfwf_tab_text_input').removeClass('active');
			$('.sfwf_desktop_text_input').removeClass('active');
			$('.preview-mobile').trigger('click');
		}
	});
		// when click on customizer responsive buttons
		$('body').on('click', '.devices .preview-desktop', function(){
			$('.sfwf_desktop_text_input').addClass('active');
			$('.sfwf_tab_text_input').removeClass('active');
			$('.sfwf_mobile_text_input').removeClass('active');
		})
	
		$('body').on('click', '.devices .preview-tablet', function(){

			$('.sfwf_desktop_text_input').removeClass('active');
			$('.sfwf_tab_text_input').addClass('active');
			$('.sfwf_mobile_text_input').removeClass('active');
		})
	
		$('body').on('click', '.devices .preview-mobile', function(){
			$('.sfwf_desktop_text_input').removeClass('active');
			$('.sfwf_tab_text_input').removeClass('active');
			$('.sfwf_mobile_text_input').addClass('active');
		})

	// $( function () {
		// Range Slider
		$( 'body' ).on( 'mousedown', 'input.gf-sfwf-range-btn' , function () {
			var $range = $( this ),
				$range_input = $range.parent().children( '.gf-sfwf-range-input' );

			value = $( this ).attr( 'value' );
			$range_input.val( value );

			$( this ).mousemove( function () {
				value = $( this ).attr( 'value' );
				$range_input.val( value );
			} );
		} );

		




		// Range Slider
		$( 'body' ).on( 'change', 'input.gf-sfwf-range-input' , function () {
			var $range_input = $( this ),
				$range = $range_input.parent().children( '.gf-sfwf-range-btn' );

			value = $( this ).attr( 'value' );
			$range.val( value );
		//	$('input.gf-sfwf-range-btn').trigger(' change ');


	});
	var et_range_input_number_timeout;

		function et_autocorrect_range_input_number( input_number, timeout ) {
			var $range_input = input_number,
				$range       = $range_input.parent().find('input.gf-sfwf-range-btn'),
				value        = parseFloat( $range_input.val() ),
			//	reset        = parseFloat( $range.attr('data-reset_value') ),
				step         = parseFloat( $range_input.attr('step') ),
				min          = parseFloat( $range_input.attr('min') ),
				max          = parseFloat( $range_input.attr('max') );
			// console.log(input_number);
			clearTimeout( et_range_input_number_timeout );

			et_range_input_number_timeout = setTimeout( function() {
				if ( isNaN( value ) ) {
					$range_input.val( min );
					$range.val( min ).trigger( 'change' );
					return;
				}

				if ( step >= 1 && value % 1 !== 0 ) {
					value = Math.round( value );
					$range_input.val( value );
					$range.val( value );
				}

				if ( value > max ) {
					$range_input.val( max );
					$range.val( max ).trigger( 'change' );
				}

				if ( value < min ) {
					$range_input.val( min );
					$range.val( min ).trigger( 'change' );
				}
			}, timeout );

			$range.val( value ).trigger( 'change' );
		}

		$('body').on( 'change keyup', 'input.gf-sfwf-range-input' , function() {
			et_autocorrect_range_input_number( $(this), 1000 );
		}).on( 'focusout', 'input.gf-sfwf-range-input', function() {
			et_autocorrect_range_input_number( $(this), 0 );
		});
	// } );
	});
})(jQuery);
