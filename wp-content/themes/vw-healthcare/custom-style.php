<?php

	$vw_healthcare_custom_css= "";

	/*--------------------First highlight color-------------------*/

	$vw_healthcare_first_color = get_theme_mod('vw_healthcare_first_color');

	if($vw_healthcare_first_color != false){
		$vw_healthcare_custom_css .='.middle-bar i, .topbar-btn a, #header, .main-navigation ul.sub-menu>li>a:before, .more-btn a,#comments input[type="submit"],#comments a.comment-reply-link,input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,nav.woocommerce-MyAccount-navigation ul li,.pro-button a, #footer-2, .scrollup i, .pagination span, .pagination a, .widget_product_search button, .woocommerce span.onsale,#sidebar h3, #sidebar .wp-block-search .wp-block-search__label, nav.navigation.posts-navigation .nav-previous a, nav.navigation.posts-navigation .nav-next a, #sidebar .wp-block-heading, .wp-block-button__link, .entry-content .wp-block-button__link{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_first_color).';';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_first_color != false){
		$vw_healthcare_custom_css .='.more-btn a,#comments input[type="submit"],#comments a.comment-reply-link,input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,nav.woocommerce-MyAccount-navigation ul li,.pro-button a,.bradcrumbs a, .post-categories li a,.bradcrumbs span{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_first_color).'!important;';
		$vw_healthcare_custom_css .='}';
	} 

	if($vw_healthcare_first_color != false){
		$vw_healthcare_custom_css .='a, .topbar-btn a:hover,.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,#slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.widget_product_search button:hover,nav.woocommerce-MyAccount-navigation ul li:hover, .woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce ul.products li.product .price, .post-navigation span.meta-nav{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_first_color).';';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_first_color != false){
		$vw_healthcare_custom_css .='.topbar-btn a:hover,.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,#slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.widget_product_search button:hover,nav.woocommerce-MyAccount-navigation ul li:hover, nav.navigation.posts-navigation .nav-previous a:hover, nav.navigation.posts-navigation .nav-next a:hover{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_first_color).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_first_color != false){
		$vw_healthcare_custom_css .='.entry-content .wp-block-button__link{';
			$vw_healthcare_custom_css .='border-color: '.esc_attr($vw_healthcare_first_color).';';
		$vw_healthcare_custom_css .='}';
	}

	/*------------------Second highlight color-------------------*/

	$vw_healthcare_second_color = get_theme_mod('vw_healthcare_second_color');

	if($vw_healthcare_second_color != false){
		$vw_healthcare_custom_css .='.topbar-btn a:hover,.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,#slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.widget_product_search button:hover,nav.woocommerce-MyAccount-navigation ul li:hover, .slide-image, #preloader, #footer .wp-block-search .wp-block-search__button, #sidebar .wp-block-search .wp-block-search__button, nav.navigation.posts-navigation .nav-previous a:hover, nav.navigation.posts-navigation .nav-next a:hover{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_second_color).';';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_second_color != false){
		$vw_healthcare_custom_css .='.topbar-btn a:hover,.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,#slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.widget_product_search button:hover,nav.woocommerce-MyAccount-navigation ul li:hover, .post-categories li a:hover{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_second_color).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_second_color != false){
		$vw_healthcare_custom_css .='#footer .textwidget a,#footer li a:hover,.post-main-box:hover h3 a,#sidebar ul li a:hover,.post-navigation a:hover .post-title, .post-navigation a:focus .post-title,.post-navigation a:hover,.post-navigation a:focus, .copyright a:hover, .logo h1 a:hover, .logo p.site-title a:hover, .middle-bar h6 a:hover, .slider-inner-box h1 a:hover, .post-main-box:hover h2 a, .post-main-box:hover .post-info a, .single-post .post-info:hover a{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_second_color).';';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_second_color != false){
		$vw_healthcare_custom_css .='.middle-bar i{';
			$vw_healthcare_custom_css .='border-color: '.esc_attr($vw_healthcare_second_color).';';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_second_color != false){
		$vw_healthcare_custom_css .='.top-bar{';
			$vw_healthcare_custom_css .='border-bottom-color: '.esc_attr($vw_healthcare_second_color).';';
		$vw_healthcare_custom_css .='}';
	}

	if($vw_healthcare_second_color != false){
		$vw_healthcare_custom_css .='.top-bar .custom-social-icons i{';
			$vw_healthcare_custom_css .='border-right-color: '.esc_attr($vw_healthcare_second_color).';';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_width_option','Full Width');
    if($vw_healthcare_theme_lay == 'Boxed'){
		$vw_healthcare_custom_css .='body{';
			$vw_healthcare_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='#slider .carousel-caption{';
			$vw_healthcare_custom_css .='right: 18% !important; left: 18% !important;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.scrollup i{';
		  $vw_healthcare_custom_css .='right: 100px;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.scrollup.left i{';
		  $vw_healthcare_custom_css .='left: 100px;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Wide Width'){
		$vw_healthcare_custom_css .='body{';
			$vw_healthcare_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.scrollup i{';
		  $vw_healthcare_custom_css .='right: 30px;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.scrollup.left i{';
		  $vw_healthcare_custom_css .='left: 30px;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Full Width'){
		$vw_healthcare_custom_css .='body{';
			$vw_healthcare_custom_css .='max-width: 100%;';
		$vw_healthcare_custom_css .='}';
	}

	/*--------------------- Slider Content Layout -------------------*/

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_slider_content_option','Left');
    if($vw_healthcare_theme_lay == 'Left'){
		$vw_healthcare_custom_css .='#slider .carousel-caption{';
			$vw_healthcare_custom_css .='text-align:left; right: 40%; left:20%';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Center'){
		$vw_healthcare_custom_css .='#slider .carousel-caption{';
			$vw_healthcare_custom_css .='text-align:center; right: 25%; left: 25%;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Right'){
		$vw_healthcare_custom_css .='#slider .carousel-caption{';
			$vw_healthcare_custom_css .='text-align:right; right: 20%; left: 40%;';
		$vw_healthcare_custom_css .='}';
	}

	/*------------- Slider Content Padding Settings ------------------*/

	$vw_healthcare_slider_content_padding_top_bottom = get_theme_mod('vw_healthcare_slider_content_padding_top_bottom');
	$vw_healthcare_slider_content_padding_left_right = get_theme_mod('vw_healthcare_slider_content_padding_left_right');
	if($vw_healthcare_slider_content_padding_top_bottom != false || $vw_healthcare_slider_content_padding_left_right != false){
		$vw_healthcare_custom_css .='#slider .carousel-caption{';
			$vw_healthcare_custom_css .='top: '.esc_attr($vw_healthcare_slider_content_padding_top_bottom).'; bottom: '.esc_attr($vw_healthcare_slider_content_padding_top_bottom).';left: '.esc_attr($vw_healthcare_slider_content_padding_left_right).';right: '.esc_attr($vw_healthcare_slider_content_padding_left_right).';';
		$vw_healthcare_custom_css .='}';
	}

	/*--------------------------- Slider -------------------*/

	$vw_healthcare_slider = get_theme_mod('vw_healthcare_slider_arrows');
	if($vw_healthcare_slider == false){
		$vw_healthcare_custom_css .='#services-sec{';
			$vw_healthcare_custom_css .='background: none; padding-bottom: 0px !important;';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_blog_layout_option','Default');
    if($vw_healthcare_theme_lay == 'Default'){
		$vw_healthcare_custom_css .='.post-main-box{';
			$vw_healthcare_custom_css .='';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Center'){
		$vw_healthcare_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p{';
			$vw_healthcare_custom_css .='text-align:center;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.post-info{';
			$vw_healthcare_custom_css .='margin-top:10px;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Left'){
		$vw_healthcare_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, #our-services p{';
			$vw_healthcare_custom_css .='text-align:Left;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.post-main-box h2{';
			$vw_healthcare_custom_css .='margin-top:10px;';
		$vw_healthcare_custom_css .='}';
	}

	/*--------------------- Grid Posts Posts -------------------*/

	$vw_healthcare_display_grid_posts_settings = get_theme_mod( 'vw_healthcare_display_grid_posts_settings','Into Blocks');
    if($vw_healthcare_display_grid_posts_settings == 'Without Blocks'){
		$vw_healthcare_custom_css .='.grid-post-main-box{';
			$vw_healthcare_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$vw_healthcare_custom_css .='}';
	}

	/*--------------------- Blog Page Posts -------------------*/

	$vw_healthcare_blog_page_posts_settings = get_theme_mod( 'vw_healthcare_blog_page_posts_settings','Into Blocks');
		if($vw_healthcare_blog_page_posts_settings == 'Without Blocks'){
		$vw_healthcare_custom_css .='.post-main-box{';
			$vw_healthcare_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$vw_healthcare_custom_css .='}';
	}

	/*----------------Responsive Media -----------------------*/

	$vw_healthcare_resp_slider = get_theme_mod( 'vw_healthcare_resp_slider_hide_show',true);
	if($vw_healthcare_resp_slider == true && get_theme_mod( 'vw_healthcare_slider_arrows', false) == false){
    	$vw_healthcare_custom_css .='#slider{';
			$vw_healthcare_custom_css .='display:none;';
		$vw_healthcare_custom_css .='} ';
	}
    if($vw_healthcare_resp_slider == true){
    	$vw_healthcare_custom_css .='@media screen and (max-width:575px) {';
		$vw_healthcare_custom_css .='#slider{';
			$vw_healthcare_custom_css .='display:block;';
		$vw_healthcare_custom_css .='} }';
	}else if($vw_healthcare_resp_slider == false){
		$vw_healthcare_custom_css .='@media screen and (max-width:575px) {';
		$vw_healthcare_custom_css .='#slider{';
			$vw_healthcare_custom_css .='display:none;';
		$vw_healthcare_custom_css .='} }';
	}

	$vw_healthcare_resp_sidebar = get_theme_mod( 'vw_healthcare_sidebar_hide_show',true);
    if($vw_healthcare_resp_sidebar == true){
    	$vw_healthcare_custom_css .='@media screen and (max-width:575px) {';
		$vw_healthcare_custom_css .='#sidebar{';
			$vw_healthcare_custom_css .='display:block;';
		$vw_healthcare_custom_css .='} }';
	}else if($vw_healthcare_resp_sidebar == false){
		$vw_healthcare_custom_css .='@media screen and (max-width:575px) {';
		$vw_healthcare_custom_css .='#sidebar{';
			$vw_healthcare_custom_css .='display:none;';
		$vw_healthcare_custom_css .='} }';
	}

	$vw_healthcare_resp_scroll_top = get_theme_mod( 'vw_healthcare_resp_scroll_top_hide_show',true);
	if($vw_healthcare_resp_scroll_top == true && get_theme_mod( 'vw_healthcare_footer_scroll',true) != true){
    	$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='visibility:hidden !important;';
		$vw_healthcare_custom_css .='} ';
	}
    if($vw_healthcare_resp_scroll_top == true){
    	$vw_healthcare_custom_css .='@media screen and (max-width:575px) {';
		$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='visibility:visible !important;';
		$vw_healthcare_custom_css .='} }';
	}else if($vw_healthcare_resp_scroll_top == false){
		$vw_healthcare_custom_css .='@media screen and (max-width:575px){';
		$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='visibility:hidden !important;';
		$vw_healthcare_custom_css .='} }';
	}

	$vw_healthcare_resp_menu_toggle_btn_bg_color = get_theme_mod('vw_healthcare_resp_menu_toggle_btn_bg_color');
	if($vw_healthcare_resp_menu_toggle_btn_bg_color != false){
		$vw_healthcare_custom_css .='.toggle-nav i{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_resp_menu_toggle_btn_bg_color).';';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------- Menus Settings ------------------*/

	$vw_healthcare_navigation_menu_font_size = get_theme_mod('vw_healthcare_navigation_menu_font_size');
	if($vw_healthcare_navigation_menu_font_size != false){
		$vw_healthcare_custom_css .='.main-navigation a{';
			$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_navigation_menu_font_size).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_header_menus_color = get_theme_mod('vw_healthcare_header_menus_color');
	if($vw_healthcare_header_menus_color != false){
		$vw_healthcare_custom_css .='.main-navigation a{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_header_menus_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_header_menus_hover_color = get_theme_mod('vw_healthcare_header_menus_hover_color');
	if($vw_healthcare_header_menus_hover_color != false){
		$vw_healthcare_custom_css .='.main-navigation a:hover{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_header_menus_hover_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_header_submenus_color = get_theme_mod('vw_healthcare_header_submenus_color');
	if($vw_healthcare_header_submenus_color != false){
		$vw_healthcare_custom_css .='.main-navigation ul ul a{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_header_submenus_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_header_submenus_hover_color = get_theme_mod('vw_healthcare_header_submenus_hover_color');
	if($vw_healthcare_header_submenus_hover_color != false){
		$vw_healthcare_custom_css .='.main-navigation ul.sub-menu a:hover{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_header_submenus_hover_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_menus_item = get_theme_mod( 'vw_healthcare_menus_item_style','None');
    if($vw_healthcare_menus_item == 'None'){
		$vw_healthcare_custom_css .='.main-navigation a{';
			$vw_healthcare_custom_css .='';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_menus_item == 'Zoom In'){
		$vw_healthcare_custom_css .='.main-navigation a:hover{';
			$vw_healthcare_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #2cd7bd;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_navigation_menu_font_weight = get_theme_mod('vw_healthcare_navigation_menu_font_weight','');
	if($vw_healthcare_navigation_menu_font_weight != false){
		$vw_healthcare_custom_css .='.main-navigation a{';
			$vw_healthcare_custom_css .='font-weight: '.esc_attr($vw_healthcare_navigation_menu_font_weight).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_menu_text_transform','Capitalize');
	if($vw_healthcare_theme_lay == 'Capitalize'){
		$vw_healthcare_custom_css .='.main-navigation a{';
			$vw_healthcare_custom_css .='text-transform:Capitalize;';
		$vw_healthcare_custom_css .='}';
	}
	if($vw_healthcare_theme_lay == 'Lowercase'){
		$vw_healthcare_custom_css .='.main-navigation a{';
			$vw_healthcare_custom_css .='text-transform:Lowercase;';
		$vw_healthcare_custom_css .='}';
	}
	if($vw_healthcare_theme_lay == 'Uppercase'){
		$vw_healthcare_custom_css .='.main-navigation a{';
			$vw_healthcare_custom_css .='text-transform:Uppercase;';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------- Posts Settings ------------------*/

	$vw_healthcare_featured_image_border_radius = get_theme_mod('vw_healthcare_featured_image_border_radius', 0);
	if($vw_healthcare_featured_image_border_radius != false){
		$vw_healthcare_custom_css .='.box-image img, .feature-box img{';
			$vw_healthcare_custom_css .='border-radius: '.esc_attr($vw_healthcare_featured_image_border_radius).'px;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_featured_image_box_shadow = get_theme_mod('vw_healthcare_featured_image_box_shadow',0);
	if($vw_healthcare_featured_image_box_shadow != false){
		$vw_healthcare_custom_css .='.box-image img, .feature-box img, #content-vw img{';
			$vw_healthcare_custom_css .='box-shadow: '.esc_attr($vw_healthcare_featured_image_box_shadow).'px '.esc_attr($vw_healthcare_featured_image_box_shadow).'px '.esc_attr($vw_healthcare_featured_image_box_shadow).'px #cccccc;';
		$vw_healthcare_custom_css .='}';
	}

	// featured image dimention
	$vw_healthcare_blog_post_featured_image_dimension = get_theme_mod('vw_healthcare_blog_post_featured_image_dimension', 'default');
	$vw_healthcare_blog_post_featured_image_custom_width = get_theme_mod('vw_healthcare_blog_post_featured_image_custom_width',250);
	$vw_healthcare_blog_post_featured_image_custom_height = get_theme_mod('vw_healthcare_blog_post_featured_image_custom_height',250);
	if($vw_healthcare_blog_post_featured_image_dimension == 'custom'){
		$vw_healthcare_custom_css .='.box-image img{';
			$vw_healthcare_custom_css .='width: '.esc_attr($vw_healthcare_blog_post_featured_image_custom_width).'; height: '.esc_attr($vw_healthcare_blog_post_featured_image_custom_height).';';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------- Single Post Settings ------------------*/

	$vw_healthcare_single_blog_comment_title = get_theme_mod('vw_healthcare_single_blog_comment_title', 'Leave a Reply');
	if($vw_healthcare_single_blog_comment_title == ''){
		$vw_healthcare_custom_css .='#comments h2#reply-title {';
			$vw_healthcare_custom_css .='display: none;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_single_blog_comment_button_text = get_theme_mod('vw_healthcare_single_blog_comment_button_text', 'Post Comment');
	if($vw_healthcare_single_blog_comment_button_text == ''){
		$vw_healthcare_custom_css .='#comments p.form-submit {';
			$vw_healthcare_custom_css .='display: none;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_comment_width = get_theme_mod('vw_healthcare_single_blog_comment_width');
	if($vw_healthcare_comment_width != false){
		$vw_healthcare_custom_css .='#comments textarea{';
			$vw_healthcare_custom_css .='width: '.esc_attr($vw_healthcare_comment_width).';';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_healthcare_button_letter_spacing = get_theme_mod('vw_healthcare_button_letter_spacing',14);
	$vw_healthcare_custom_css .='.post-main-box .more-btn a{';
		$vw_healthcare_custom_css .='letter-spacing: '.esc_attr($vw_healthcare_button_letter_spacing).';';
	$vw_healthcare_custom_css .='}';

	$vw_healthcare_button_border_radius = get_theme_mod('vw_healthcare_button_border_radius');
	if($vw_healthcare_button_border_radius != false){
		$vw_healthcare_custom_css .='.post-main-box .more-btn a{';
			$vw_healthcare_custom_css .='border-radius: '.esc_attr($vw_healthcare_button_border_radius).'px;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_button_padding_top_bottom = get_theme_mod('vw_healthcare_button_padding_top_bottom');
	$vw_healthcare_button_padding_left_right = get_theme_mod('vw_healthcare_button_padding_left_right');
	if($vw_healthcare_button_padding_top_bottom != false || $vw_healthcare_button_padding_left_right != false){
		$vw_healthcare_custom_css .='.post-main-box .more-btn a{';
			$vw_healthcare_custom_css .='padding-top: '.esc_attr($vw_healthcare_button_padding_top_bottom).'!important; 
			padding-bottom: '.esc_attr($vw_healthcare_button_padding_top_bottom).'!important;
			padding-left: '.esc_attr($vw_healthcare_button_padding_left_right).'!important;
			padding-right: '.esc_attr($vw_healthcare_button_padding_left_right).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_button_font_size = get_theme_mod('vw_healthcare_button_font_size',14);
	$vw_healthcare_custom_css .='.post-main-box .more-btn a{';
		$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_button_font_size).';';
	$vw_healthcare_custom_css .='}';

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_button_text_transform','Uppercase');
	if($vw_healthcare_theme_lay == 'Capitalize'){
		$vw_healthcare_custom_css .='.post-main-box .more-btn a{';
			$vw_healthcare_custom_css .='text-transform:Capitalize;';
		$vw_healthcare_custom_css .='}';
	}
	if($vw_healthcare_theme_lay == 'Lowercase'){
		$vw_healthcare_custom_css .='.post-main-box .more-btn a{';
			$vw_healthcare_custom_css .='text-transform:Lowercase;';
		$vw_healthcare_custom_css .='}';
	}
	if($vw_healthcare_theme_lay == 'Uppercase'){ 
		$vw_healthcare_custom_css .='.post-main-box .more-btn a{';
			$vw_healthcare_custom_css .='text-transform:Uppercase;';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_blog_layout_option','Default');
    if($vw_healthcare_theme_lay == 'Default'){
		$vw_healthcare_custom_css .='.post-main-box{';
			$vw_healthcare_custom_css .='';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Center'){
		$vw_healthcare_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn{';
			$vw_healthcare_custom_css .='text-align:center;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.post-info{';
			$vw_healthcare_custom_css .='margin-top:10px;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.post-info hr{';
			$vw_healthcare_custom_css .='margin:15px auto;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_theme_lay == 'Left'){
		$vw_healthcare_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_healthcare_custom_css .='text-align:Left;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.post-info hr{';
			$vw_healthcare_custom_css .='margin-bottom:10px;';
		$vw_healthcare_custom_css .='}';
		$vw_healthcare_custom_css .='.post-main-box h2{';
			$vw_healthcare_custom_css .='margin-top:10px;';
		$vw_healthcare_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_healthcare_copyright_background_color = get_theme_mod('vw_healthcare_copyright_background_color');
	if($vw_healthcare_copyright_background_color != false){
		$vw_healthcare_custom_css .='#footer-2{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_copyright_background_color).';';
		$vw_healthcare_custom_css .='}';
	} 

	$vw_healthcare_footer_background_color = get_theme_mod('vw_healthcare_footer_background_color');
	if($vw_healthcare_footer_background_color != false){
		$vw_healthcare_custom_css .='#footer{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_footer_background_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_copyright_font_size = get_theme_mod('vw_healthcare_copyright_font_size');
	if($vw_healthcare_copyright_font_size != false){
		$vw_healthcare_custom_css .='.copyright p{';
			$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_copyright_font_size).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_copyright_alignment = get_theme_mod('vw_healthcare_copyright_alignment');
	if($vw_healthcare_copyright_alignment != false){
		$vw_healthcare_custom_css .='.copyright p{';
			$vw_healthcare_custom_css .='text-align: '.esc_attr($vw_healthcare_copyright_alignment).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_footer_img_position = get_theme_mod('vw_healthcare_footer_img_position','center center');
	if($vw_healthcare_footer_img_position != false){
		$vw_healthcare_custom_css .='#footer{';
			$vw_healthcare_custom_css .='background-position: '.esc_attr($vw_healthcare_footer_img_position).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_products_btn_padding_top_bottom = get_theme_mod('vw_healthcare_products_btn_padding_top_bottom');
	if($vw_healthcare_products_btn_padding_top_bottom != false){
		$vw_healthcare_custom_css .='.woocommerce a.button{';
			$vw_healthcare_custom_css .='padding-top: '.esc_attr($vw_healthcare_products_btn_padding_top_bottom).' !important; padding-bottom: '.esc_attr($vw_healthcare_products_btn_padding_top_bottom).' !important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_products_btn_padding_left_right = get_theme_mod('vw_healthcare_products_btn_padding_left_right');
	if($vw_healthcare_products_btn_padding_left_right != false){
		$vw_healthcare_custom_css .='.woocommerce a.button{';
			$vw_healthcare_custom_css .='padding-left: '.esc_attr($vw_healthcare_products_btn_padding_left_right).' !important; padding-right: '.esc_attr($vw_healthcare_products_btn_padding_left_right).' !important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_footer_icon = get_theme_mod('vw_healthcare_footer_icon');
	if($vw_healthcare_footer_icon == false){
		$vw_healthcare_custom_css .='.copyright p{';
			$vw_healthcare_custom_css .='width:100%; text-align:center; float:none;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_footer_background_image = get_theme_mod('vw_healthcare_footer_background_image');
	if($vw_healthcare_footer_background_image != false){
		$vw_healthcare_custom_css .='#footer{';
			$vw_healthcare_custom_css .='background: url('.esc_attr($vw_healthcare_footer_background_image).');';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_woocommerce_sale_position = get_theme_mod( 'vw_healthcare_woocommerce_sale_position','left');
    if($vw_healthcare_woocommerce_sale_position == 'left'){
		$vw_healthcare_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_healthcare_custom_css .='left: -10px; right: auto;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_woocommerce_sale_position == 'right'){
		$vw_healthcare_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_healthcare_custom_css .='left: auto !important; right: 5px !important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_woocommerce_sale_font_size = get_theme_mod('vw_healthcare_woocommerce_sale_font_size');
	if($vw_healthcare_woocommerce_sale_font_size != false){
		$vw_healthcare_custom_css .='.woocommerce span.onsale{';
			$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_woocommerce_sale_font_size).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_woocommerce_sale_padding_top_bottom = get_theme_mod('vw_healthcare_woocommerce_sale_padding_top_bottom');
	if($vw_healthcare_woocommerce_sale_padding_top_bottom != false){
		$vw_healthcare_custom_css .='.woocommerce span.onsale{';
			$vw_healthcare_custom_css .='padding-top: '.esc_attr($vw_healthcare_woocommerce_sale_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_healthcare_woocommerce_sale_padding_top_bottom).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_woocommerce_sale_padding_left_right = get_theme_mod('vw_healthcare_woocommerce_sale_padding_left_right');
	if($vw_healthcare_woocommerce_sale_padding_left_right != false){
		$vw_healthcare_custom_css .='.woocommerce span.onsale{';
			$vw_healthcare_custom_css .='padding-left: '.esc_attr($vw_healthcare_woocommerce_sale_padding_left_right).'; padding-right: '.esc_attr($vw_healthcare_woocommerce_sale_padding_left_right).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_related_product_show_hide = get_theme_mod('vw_healthcare_related_product_show_hide',true);
	if($vw_healthcare_related_product_show_hide != true){
		$vw_healthcare_custom_css .='.related.products{';
			$vw_healthcare_custom_css .='display: none;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_footer_padding = get_theme_mod('vw_healthcare_footer_padding');
	if($vw_healthcare_footer_padding != false){
		$vw_healthcare_custom_css .='#footer{';
			$vw_healthcare_custom_css .='padding: '.esc_attr($vw_healthcare_footer_padding).' 0;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_footer_widgets_heading = get_theme_mod( 'vw_healthcare_footer_widgets_heading','Left');
    if($vw_healthcare_footer_widgets_heading == 'Left'){
		$vw_healthcare_custom_css .='#footer h3, #footer h3 .wp-block-search .wp-block-search__label{';
		$vw_healthcare_custom_css .='text-align: left;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_footer_widgets_heading == 'Center'){
		$vw_healthcare_custom_css .='#footer h3, #footer h3 .wp-block-search .wp-block-search__label{';
			$vw_healthcare_custom_css .='text-align: center;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_footer_widgets_heading == 'Right'){
		$vw_healthcare_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$vw_healthcare_custom_css .='text-align: right;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_footer_widgets_content = get_theme_mod( 'vw_healthcare_footer_widgets_content','Left');
    if($vw_healthcare_footer_widgets_content == 'Left'){
		$vw_healthcare_custom_css .='#footer li{';
		$vw_healthcare_custom_css .='text-align: left;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_footer_widgets_content == 'Center'){
		$vw_healthcare_custom_css .='#footer li{';
			$vw_healthcare_custom_css .='text-align: center;';
		$vw_healthcare_custom_css .='}';
	}else if($vw_healthcare_footer_widgets_content == 'Right'){
		$vw_healthcare_custom_css .='#footer li{';
			$vw_healthcare_custom_css .='text-align: right;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_img_footer','scroll');
	if($vw_healthcare_theme_lay == 'fixed'){
		$vw_healthcare_custom_css .='#footer{';
			$vw_healthcare_custom_css .='background-attachment: fixed !important;';
		$vw_healthcare_custom_css .='}';
	}elseif ($vw_healthcare_theme_lay == 'scroll'){
		$vw_healthcare_custom_css .='#footer{';
			$vw_healthcare_custom_css .='background-attachment: scroll !important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_copyright_font_weight = get_theme_mod('vw_healthcare_copyright_font_weight');
	if($vw_healthcare_copyright_font_weight != false){
		$vw_healthcare_custom_css .='.copyright p, .copyright a{';
			$vw_healthcare_custom_css .='font-weight: '.esc_attr($vw_healthcare_copyright_font_weight).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_copyright_text_color = get_theme_mod('vw_healthcare_copyright_text_color');
	if($vw_healthcare_copyright_text_color != false){
		$vw_healthcare_custom_css .='.copyright p, .copyright a{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_copyright_text_color).';';
		$vw_healthcare_custom_css .='}';
	} 
	/*------------------ Logo  -------------------*/

	$vw_healthcare_logo_padding = get_theme_mod('vw_healthcare_logo_padding');
	if($vw_healthcare_logo_padding != false){
		$vw_healthcare_custom_css .='.middle-bar .logo{';
			$vw_healthcare_custom_css .='padding: '.esc_attr($vw_healthcare_logo_padding).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_logo_margin = get_theme_mod('vw_healthcare_logo_margin');
	if($vw_healthcare_logo_margin != false){
		$vw_healthcare_custom_css .='.middle-bar .logo{';
			$vw_healthcare_custom_css .='margin: '.esc_attr($vw_healthcare_logo_margin).';';
		$vw_healthcare_custom_css .='}';
	}

	// Site title Font Size
	$vw_healthcare_site_title_font_size = get_theme_mod('vw_healthcare_site_title_font_size');
	if($vw_healthcare_site_title_font_size != false){
		$vw_healthcare_custom_css .='.logo p.site-title, .logo h1{';
			$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_site_title_font_size).';';
		$vw_healthcare_custom_css .='}';
	}

	// Site tagline Font Size
	$vw_healthcare_site_tagline_font_size = get_theme_mod('vw_healthcare_site_tagline_font_size');
	if($vw_healthcare_site_tagline_font_size != false){
		$vw_healthcare_custom_css .='.logo p.site-description{';
			$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_site_tagline_font_size).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_site_title_color = get_theme_mod('vw_healthcare_site_title_color');
	if($vw_healthcare_site_title_color != false){
		$vw_healthcare_custom_css .='p.site-title a{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_site_title_color).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_site_tagline_color = get_theme_mod('vw_healthcare_site_tagline_color');
	if($vw_healthcare_site_tagline_color != false){
		$vw_healthcare_custom_css .='.logo p.site-description{';
			$vw_healthcare_custom_css .='color: '.esc_attr($vw_healthcare_site_tagline_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_logo_width = get_theme_mod('vw_healthcare_logo_width');
	if($vw_healthcare_logo_width != false){
		$vw_healthcare_custom_css .='.logo img{';
			$vw_healthcare_custom_css .='width: '.esc_attr($vw_healthcare_logo_width).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_logo_height = get_theme_mod('vw_healthcare_logo_height');
	if($vw_healthcare_logo_height != false){
		$vw_healthcare_custom_css .='.logo img{';
			$vw_healthcare_custom_css .='height: '.esc_attr($vw_healthcare_logo_height).';';
		$vw_healthcare_custom_css .='}';
	}

	// Woocommerce img

	$vw_healthcare_shop_featured_image_border_radius = get_theme_mod('vw_healthcare_shop_featured_image_border_radius', 0);
	if($vw_healthcare_shop_featured_image_border_radius != false){
		$vw_healthcare_custom_css .='.woocommerce ul.products li.product a img{';
			$vw_healthcare_custom_css .='border-radius: '.esc_attr($vw_healthcare_shop_featured_image_border_radius).'px;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_shop_featured_image_box_shadow = get_theme_mod('vw_healthcare_shop_featured_image_box_shadow');
	if($vw_healthcare_shop_featured_image_box_shadow != false){
		$vw_healthcare_custom_css .='.woocommerce ul.products li.product a img{';
				$vw_healthcare_custom_css .='box-shadow: '.esc_attr($vw_healthcare_shop_featured_image_box_shadow).'px '.esc_attr($vw_healthcare_shop_featured_image_box_shadow).'px '.esc_attr($vw_healthcare_shop_featured_image_box_shadow).'px #ddd;';
		$vw_healthcare_custom_css .='}';
	}

	/*--------------- Preloader Background Color  -------------------*/

	$vw_healthcare_preloader_bg_color = get_theme_mod('vw_healthcare_preloader_bg_color');
	if($vw_healthcare_preloader_bg_color != false){
		$vw_healthcare_custom_css .='#preloader{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_preloader_bg_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_preloader_border_color = get_theme_mod('vw_healthcare_preloader_border_color');
	if($vw_healthcare_preloader_border_color != false){
		$vw_healthcare_custom_css .='.loader-line{';
			$vw_healthcare_custom_css .='border-color: '.esc_attr($vw_healthcare_preloader_border_color).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_preloader_bg_img = get_theme_mod('vw_healthcare_preloader_bg_img');
	if($vw_healthcare_preloader_bg_img != false){
		$vw_healthcare_custom_css .='#preloader{';
			$vw_healthcare_custom_css .='background: url('.esc_attr($vw_healthcare_preloader_bg_img).');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$vw_healthcare_custom_css .='}';
	}

	// Header Background Color

	$vw_healthcare_header_background_color = get_theme_mod('vw_healthcare_header_background_color');
	if($vw_healthcare_header_background_color != false){
		$vw_healthcare_custom_css .='.middle-bar{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_header_background_color).';';
		$vw_healthcare_custom_css .='}';
	} 

	$vw_healthcare_header_img_position = get_theme_mod('vw_healthcare_header_img_position','center top');
	if($vw_healthcare_header_img_position != false){
		$vw_healthcare_custom_css .='.middle-bar{';
			$vw_healthcare_custom_css .='background-position: '.esc_attr($vw_healthcare_header_img_position).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_healthcare_slider_height = get_theme_mod('vw_healthcare_slider_height');
	if($vw_healthcare_slider_height != false){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='height: '.esc_attr($vw_healthcare_slider_height).';';
		$vw_healthcare_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_healthcare_theme_lay = get_theme_mod( 'vw_healthcare_slider_opacity_color','0.5');
	if($vw_healthcare_theme_lay == '0'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.1'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.1';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.2'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.2';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.3'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.3';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.4'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.4';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.5'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.5';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.6'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.6';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.7'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.7';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.8'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.8';
		$vw_healthcare_custom_css .='}';
		}else if($vw_healthcare_theme_lay == '0.9'){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:0.9';
		$vw_healthcare_custom_css .='}';
		}

	/*---------------------- Slider Image Overlay ------------------------*/

	$vw_healthcare_slider_image_overlay = get_theme_mod('vw_healthcare_slider_image_overlay', true);
	if($vw_healthcare_slider_image_overlay == false){
		$vw_healthcare_custom_css .='#slider img{';
			$vw_healthcare_custom_css .='opacity:1;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_slider_image_overlay_color = get_theme_mod('vw_healthcare_slider_image_overlay_color', true);
	if($vw_healthcare_slider_image_overlay_color != false){
		$vw_healthcare_custom_css .='.slide-image{';
			$vw_healthcare_custom_css .='background-color: '.esc_attr($vw_healthcare_slider_image_overlay_color).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_single_blog_post_navigation_show_hide = get_theme_mod('vw_healthcare_single_blog_post_navigation_show_hide',true);
	if($vw_healthcare_single_blog_post_navigation_show_hide != true){
		$vw_healthcare_custom_css .='.post-navigation{';
			$vw_healthcare_custom_css .='display: none;';
		$vw_healthcare_custom_css .='}';
	}


	/*----------------Sroll to top Settings ------------------*/

	$vw_healthcare_scroll_to_top_font_size = get_theme_mod('vw_healthcare_scroll_to_top_font_size');
	if($vw_healthcare_scroll_to_top_font_size != false){
		$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_scroll_to_top_font_size).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_scroll_to_top_padding = get_theme_mod('vw_healthcare_scroll_to_top_padding');
	$vw_healthcare_scroll_to_top_padding = get_theme_mod('vw_healthcare_scroll_to_top_padding');
	if($vw_healthcare_scroll_to_top_padding != false){
		$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='padding-top: '.esc_attr($vw_healthcare_scroll_to_top_padding).' !important;padding-bottom: '.esc_attr($vw_healthcare_scroll_to_top_padding).'!important;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_scroll_to_top_width = get_theme_mod('vw_healthcare_scroll_to_top_width');
	if($vw_healthcare_scroll_to_top_width != false){
		$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='width: '.esc_attr($vw_healthcare_scroll_to_top_width).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_scroll_to_top_height = get_theme_mod('vw_healthcare_scroll_to_top_height');
	if($vw_healthcare_scroll_to_top_height != false){
		$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='height: '.esc_attr($vw_healthcare_scroll_to_top_height).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_scroll_to_top_border_radius = get_theme_mod('vw_healthcare_scroll_to_top_border_radius');
	if($vw_healthcare_scroll_to_top_border_radius != false){
		$vw_healthcare_custom_css .='.scrollup i{';
			$vw_healthcare_custom_css .='border-radius: '.esc_attr($vw_healthcare_scroll_to_top_border_radius).'px;';
		$vw_healthcare_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_healthcare_social_icon_font_size = get_theme_mod('vw_healthcare_social_icon_font_size');
	if($vw_healthcare_social_icon_font_size != false){
		$vw_healthcare_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_healthcare_custom_css .='font-size: '.esc_attr($vw_healthcare_social_icon_font_size).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_social_icon_padding = get_theme_mod('vw_healthcare_social_icon_padding');
	if($vw_healthcare_social_icon_padding != false){
		$vw_healthcare_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_healthcare_custom_css .='padding: '.esc_attr($vw_healthcare_social_icon_padding).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_social_icon_width = get_theme_mod('vw_healthcare_social_icon_width');
	if($vw_healthcare_social_icon_width != false){
		$vw_healthcare_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_healthcare_custom_css .='width: '.esc_attr($vw_healthcare_social_icon_width).';';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_social_icon_height = get_theme_mod('vw_healthcare_social_icon_height');
	if($vw_healthcare_social_icon_height != false){
		$vw_healthcare_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_healthcare_custom_css .='height: '.esc_attr($vw_healthcare_social_icon_height).';';
		$vw_healthcare_custom_css .='}';
	}

	/*---------------- Grid Posts Settings ------------------*/

	$vw_healthcare_grid_featured_image_border_radius = get_theme_mod('vw_healthcare_grid_featured_image_border_radius', 0);
	if($vw_healthcare_grid_featured_image_border_radius != false){
		$vw_healthcare_custom_css .='.grid-post-main-box .box-image img, .grid-post-main-box .feature-box img{';
			$vw_healthcare_custom_css .='border-radius: '.esc_attr($vw_healthcare_grid_featured_image_border_radius).'px;';
		$vw_healthcare_custom_css .='}';
	}

	$vw_healthcare_grid_featured_image_box_shadow = get_theme_mod('vw_healthcare_grid_featured_image_box_shadow',0);
	if($vw_healthcare_grid_featured_image_box_shadow != false){
		$vw_healthcare_custom_css .='.grid-post-main-box .box-image img, .grid-post-main-box .feature-box img, #content-vw img{';
			$vw_healthcare_custom_css .='box-shadow: '.esc_attr($vw_healthcare_grid_featured_image_box_shadow).'px '.esc_attr($vw_healthcare_grid_featured_image_box_shadow).'px '.esc_attr($vw_healthcare_grid_featured_image_box_shadow).'px #cccccc;';
		$vw_healthcare_custom_css .='}';
	}

