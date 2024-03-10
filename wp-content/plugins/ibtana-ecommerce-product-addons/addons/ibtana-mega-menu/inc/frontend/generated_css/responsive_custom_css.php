<?php
$content .= '/*Responsive Pre Available Template Custom CSS End*/';
$content .= '
@media( max-width:' . $custom_responsive_bp . 'px ) {';

$content .= '
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper .iepamegamenu-toggle{
        display:block;
	}
	.iepa-askins-wrapper .iepamegamenu-toggle .iepamega-closeblock,.iepa-askins-wrapper .iepamegamenu-toggle .menutoggle{
		display:none;
	}
   .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper {
    	overflow: hidden;
    	z-index: 999;
    	display:none;
    }
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper.iepa-show-menu{
		display:block;
	}
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li {
		width: 100%;
		border-bottom: 1px solid #ccc;
		text-align: left;
		position: relative;
	}
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper li:last-child {
		border-bottom: none;
	}
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper li .dropdown-toggle {
		display: none;
	}
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li > a,
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchdown,
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchinline {
		padding: 15px 10px;
	}
	.iepa_megamenu .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchinline,
	.iepa_megamenu .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li > a.iepa-csingle-menu {
		padding: 15px 10px;
	}
	.iepa-megamenu-main-wrapper.iepamega-midnightblue-sky-white.iepa-askins-wrapper ul.iepa-mega-wrapper > li > a::before {
		display: none;
	}
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li.menu-item-has-children a {
		margin-right: 0;
	}
	.iepa-askins-wrapper .iepamegamenu-toggle .iepamega-openblock,
	.iepa-askins-wrapper .iepamegamenu-toggle .iepamega-closeblock {
		padding: 10px 10px 13px;
		color: #000;
	}

	.iepa-askins-wrapper .iepamegamenu-toggle .iepamega-openblock,
	.iepa-askins-wrapper .iepamegamenu-toggle .iepamega-closeblock {
		padding: 10px 10px 13px;
		color: #fff;
	}
    .iepa-askins-wrapper.iepamega-clean-white .iepamegamenu-toggle .iepamega-openblock,
	.iepa-askins-wrapper.iepamega-clean-white .iepamegamenu-toggle .iepamega-closeblock {
		color: #000;
	}
	.iepa-askins-wrapper.iepamega-clean-white .iepamegamenu-toggle{
	    border: 1px solid #ccc;
     }

	.iepa-askins-wrapper.iepa-orientation-vertical.iepamega-clean-white .iepamegamenu-toggle .iepamega-openblock,
	.iepa-askins-wrapper.iepa-orientation-vertical.iepamega-clean-white .iepamegamenu-toggle .iepamega-closeblock{
      color: #000;
	}

	.iepa-megamenu-main-wrapper.iepa-askins-wrapper .iepa-mega-menu-label {
		top: 50%;
		transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		left: 23%;
	}
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper .iepa-mega-menu-label::before {
		border-color: #d500fb transparent transparent;
		border-style: solid;
		border-width: 7px 4.5px 0;
		bottom: -6px;
		content: "";
		height: 0;
		left: -6px;
		margin-left: auto;
		margin-right: auto;
		position: absolute;
		right: auto;
		top: 50%;
		transform: rotate(90deg) translateX(-50%);
		width: 0;
	}
	.iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
		transition: none;
		-webkit-transition: none;
		-ms-transition: none;
	}
	.iepa-askins-wrapper .iepamega-responsive-closebtn {
		color: #fff;
		border-top: 1px solid #fff;
		padding: 15px 10px;
		font-weight: 600;
		position: relative;
		padding-left: 30px;
		cursor: pointer;
		z-index: 999999;
		overflow: hidden;
		clear: both;
	}

	.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepa-menu-align-right.iepa-search-type:hover .iepa-sub-menu-wrap {
		top: 0;
	}
	.iepa-askins-wrapper ul.iepa-mega-wrapper li .iepa-search-form .iepa-search-icon.inline-toggle-right.inline-search.searchbox-open {
		left: auto;
		opacity: 1;
		right: 10px;
	}
	.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout ul {
		width: 100%;
	}
	.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div,
	.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div ul li div {
		width: 100%;
		position: relative;
		max-height: 0;
	}
	.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.active-show > div {
		max-height: 1000px;
	}
	.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.active-show > div ul li.active-show > div {
    	max-height: 1000px;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout li.menu-item-has-children > a::after {
    	top: 12px;
    }
    .iepa_megamenu .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper > li > a.iepamega-searchdown {
    	padding: 15px 10px;
    }
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
    	position: relative;
    	max-height: 0;
    	transition: all ease 0.1s;
    	-webkit-transition: all ease 0.1s;
    	-ms-transition: all ease 0.1s;
    	padding: 0 8px 0;
    }
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper ul.iepa-mega-wrapper li.active-show .iepa-sub-menu-wrap {
    	position: relative;
    	max-height: 10000px;
    	transition: all ease 0.3s;
    	-webkit-transition: all ease 0.3s;
    	-ms-transition: all ease 0.3s;
    	padding: 15px 8px 5px;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right ul.iepa-mega-sub-menu li.iepa-submenu-align-left.menu-item-has-children a:after,
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left ul.iepa-mega-sub-menu li.iepa-submenu-align-left.menu-item-has-children a:after {
    	left: auto;
    	right: 10px;
    	transform: rotate(180deg) !important;
	    -webkit-transform: rotate(180deg) !important;
	    -ms-transform: rotate(180deg) !important;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right ul.iepa-mega-sub-menu li.iepa-submenu-align-left.menu-item-has-children a.iepa-mega-menu-link {
    	padding-left: 10px;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout ul.iepa-mega-sub-menu li a {
    	padding-left: 20px !important;
    }
    .iepa-megamenu-main-wrapper.iepa-onclick.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout > div {
    	overflow: hidden;
    	height: 0;
    }
    .iepa-megamenu-main-wrapper.iepa-onclick.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout > div.iepa-open-fade {
    	height: 100%;
    	z-index: 999;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left div ul li div {
    	right: 0;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div {
    	z-index: 999;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-left div ul li.iepa-submenu-align-right div {
    	left: 0;
    }
    .iepa_megamenu ul.iepa-mega-wrapper.iepa-askins-wrapper li.iepamega-hide-on-mobile {
		display: none;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper {
		width: 100%;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper .iepa-mega-toggle-block {
		color: #fff;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper .iepa-mega-toggle-block .iepamega-openblock,
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper .iepa-mega-toggle-block .iepamega-closeblock {
		padding: 10px 10px 13px;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper .iepa-mega-toggle-block .dashicons {
		font-size: 26px;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper .iepa-mega-toggle-block .menutoggle {
		display: none;
	}
	.iepa-orientation-vertical.iepa-askins-wrapper .iepamega-responsive-closebtn {
	    color: #fff;
	    border-top: 1px solid #fff;
	    padding: 10px;
	    font-weight: 600;
	    position: relative;
	    padding-left: 10px;
	    cursor: pointer;
	    z-index: 999999;
	}
	.iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
    	<!-- position: relative; -->
    	max-height: 0;
    	transition: all ease 0.1s;
    	-webkit-transition: all ease 0.1s;
    	-ms-transition: all ease 0.1s;
    	padding: 0 8px 0;
    	left: 0;
    	width: 100% !important;
    	right: 0;
    }
    .iepa-megamenu-main-wrapper.iepa-orientation-vertical.iepa-askins-wrapper ul.iepa-mega-wrapper li.active-show .iepa-sub-menu-wrap {
    	position: relative;
    	max-height: 10000px;
    	transition: all ease 0.3s;
    	-webkit-transition: all ease 0.3s;
    	-ms-transition: all ease 0.3s;
    	padding: 15px 8px 5px;
    }
    .iepa-orientation-vertical.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout div {
    	left: 0;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li .iepa-search-form .iepa-search-icon.inline-toggle-left.inline-search.searchbox-open {
    	left: 40px;
    	top: 27px;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li {
        width: 49%;
        padding: 0;
        margin: 0 0 10px;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li .iepa-sub-menu-wrap ul.iepa-mega-sub-menu li.iepamega-vertical-tabs ul.iepa-tab-groups > li.iepa-tabs-section > div.iepa-sub-menu-wrapper > ul.iepa-tab-groups-panel > li:nth-child(even) {
        margin-left: 1%;
    }
     .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right div ul li.iepa-submenu-align-left div{
        right:0;
    }
    .iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.iepamega-flyout-horizontal-right div ul li div{
        left:0;
    }
    /*=============
    slide on click for responsive
    ==============*/
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper.iepa-slide ul.iepa-mega-wrapper li .iepa-sub-menu-wrap,
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper.iepa-slide ul.iepa-mega-wrapper li.iepamega-horizontal-left-edge .iepa-sub-menu-wrap,
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper.iepa-slide ul.iepa-mega-wrapper li.iepamega-horizontal-center .iepa-sub-menu-wrap {
    	left: 0;
    }
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper.iepa-slide ul.iepa-mega-wrapper li .iepa-sub-menu-wrap {
    	position: static;
    	padding: 0 8px;
    }
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper.iepa-slide ul.iepa-mega-wrapper li:hover .iepa-sub-menu-wrap {
		opacity: 0;
		visibility: hidden;
		max-height: 0;
		padding: 0 8px;
    }
    .iepa-megamenu-main-wrapper.iepa-askins-wrapper.iepa-slide.iepa-onclick ul.iepa-mega-wrapper li.active-show .iepa-sub-menu-wrap {
		opacity: 1;
		visibility: visible;
		max-height: 10000px;
		z-index: 999;
		transition: all 0.4s ease-in;
		-webkit-transition: all 0.4s ease-in;
		-ms-transition: all 0.4s ease-in;
		padding: 15px 8px 5px;
    }
    .iepa-megamenu-main-wrapper.iepa-onclick.iepa-askins-wrapper ul.iepa-mega-wrapper li.iepamega-menu-flyout.active-show > div {
    	overflow: visible;
}';
$content .= '}';
$content .= '/*Responsive Custom CSS End*/';
