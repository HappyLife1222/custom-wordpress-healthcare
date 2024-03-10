function vw_healthcare_menu_open_nav() {
	window.vw_healthcare_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function vw_healthcare_menu_close_nav() {
	window.vw_healthcare_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.vw_healthcare_currentfocus=null;
  	vw_healthcare_checkfocusdElement();
	var vw_healthcare_body = document.querySelector('body');
	vw_healthcare_body.addEventListener('keyup', vw_healthcare_check_tab_press);
	var vw_healthcare_gotoHome = false;
	var vw_healthcare_gotoClose = false;
	window.vw_healthcare_responsiveMenu=false;
 	function vw_healthcare_checkfocusdElement(){
	 	if(window.vw_healthcare_currentfocus=document.activeElement.className){
		 	window.vw_healthcare_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_healthcare_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_healthcare_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_healthcare_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_healthcare_gotoHome = true;
			} else {
				vw_healthcare_gotoHome = false;
			}

		}else{

			if(window.vw_healthcare_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_healthcare_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_healthcare_responsiveMenu){
				if(vw_healthcare_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_healthcare_gotoClose = true;
				} else {
					vw_healthcare_gotoClose = false;
				}
			
			}else{

			if(window.vw_healthcare_responsiveMenu){
			}}}}
		}
	 	vw_healthcare_checkfocusdElement();
	}
});

jQuery('document').ready(function($){
    setTimeout(function () {
		jQuery("#preloader").fadeOut("slow");
    },1000);
});

jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 100) {
	        jQuery('.scrollup i').fadeIn();
	    } else {
	        jQuery('.scrollup i').fadeOut();
	    }
	});
	jQuery('.scrollup i').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});