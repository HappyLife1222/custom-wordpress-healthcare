jQuery(document).ready(function(){

	if(jQuery('.iepa-slider-for').length > 0){

		$selector = jQuery('.iepa-slider-for');

		var sliderArrow  = ($selector.attr('data-arrow') === "true");
		var lightbox     = ($selector.attr('data-lightbox') === "true");
		var autoplay     = ($selector.attr('data-autoplay') === "true");
		var loop         = ($selector.attr('data-loop') === "true");
		var zoom         = ($selector.attr('data-zoom') === "true");
		var arrowColor   = $selector.attr('data-arrow-color'); 
		var arrowBgColor = $selector.attr('data-arrow-bg-color'); 
		var galleryPosition = $selector.attr('data-arrow-position');

		if(sliderArrow == 1){ 
			var slider_arrow = true;
		}else{
			var slider_arrow = false;
		}			
		
		if(lightbox != 1){
			jQuery('a.iepa-popup').remove();
		}
		
		if(autoplay == 1){ 
			var slider_autoplay = true;
		}else{
			var slider_autoplay = false;
		}
		
		
		var arrowinfinite = loop;
		var sliderlayout = galleryPosition;
		
		if(arrowinfinite==1 && arrowinfinite!=''){
			var infinitescroll = true;
		}
		else{
			var infinitescroll = false;
		}
		
		
		if(sliderlayout!='horizontal' && sliderlayout!=' '){
			var verticalslider = true;
		}
		else
		{
			var verticalslider = false;
		}
		
		jQuery('.iepa-slider-for').slick({
			fade: false,
			dots : false,
			lazyLoad: 'progressive',
			autoplay : slider_autoplay,
			arrows: slider_arrow,
			slidesToScroll:1,
			slidesToShow:1,
			infinite:infinitescroll,
			swipe:true,
			asNavFor: '.iepa-slider-nav',
			prevArrow: '<i class="btn-prev dashicons dashicons-arrow-left-alt2"></i>',
		    nextArrow: '<i class="btn-next dashicons dashicons-arrow-right-alt2"></i>',
			verticalSwiping: true,
		});
		
		jQuery('.iepa-slider-nav').slick({
			dots: false,
			arrows: false,
			centerMode: false,
			focusOnSelect: true,
			vertical:verticalslider,
			infinite:infinitescroll,
			slidesToShow: 4,
			slidesToScroll: 1,
			asNavFor: '.iepa-slider-for',
			responsive: [
		    {
		      breakpoint: 767,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 1,
		        vertical: false,
		        draggable: true,
		        autoplay: false,//no autoplay in mobile
				isMobile: true,// let custom knows on mobile
				arrows: false //hide arrow on mobile
		      }
		    },
		    ]
		});
		
		
		if(sliderlayout=='left'){
			jQuery(".slider.iepa-slider-for").addClass("vertical-img-left");
		}
		else if(sliderlayout=='right'){
			jQuery(".slider.iepa-slider-for").addClass("vertical-img-right");
		}
		else{
			jQuery(".slider.iepa-slider-for").removeClass('vertical-img-left');
			jQuery(".slider.iepa-slider-for").removeClass('vertical-img-right');
		}
		
		if(arrowColor!=''){
			jQuery(".btn-prev, .btn-next").css("color",arrowColor);	
		}
		if(arrowBgColor!=''){
			jQuery(".btn-prev, .btn-next").css("background",arrowBgColor);
		}
		
		if(zoom == 1){
			jQuery('.iepa-slider-for .slick-slide').zoom();
		}
		jQuery('.iepa-slider-for .slick-track').addClass('woocommerce-product-gallery__image single-product-main-image');
		jQuery('.iepa-slider-nav .slick-track').addClass('flex-control-nav');
		jQuery('.iepa-slider-nav .slick-track li img').removeAttr('srcset');
		
		jQuery('.variations select').change(function(){
			jQuery('.iepa-slider-nav').slick('slickGoTo', 0);
			window.setTimeout( function() {
				if(zoom == 'true'){
					jQuery('.iepa-slider-for .slick-track .slick-current').zoom();
				}
			}, 20 );
		});
		
		jQuery('[data-fancybox="product-gallery"]').fancybox({
			slideShow  : true,
			fullScreen : false,
			transitionEffect: "slide",
			arrows: true,
			thumbs : false,
			infobar : false,
		});
		
	}
});