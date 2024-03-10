<?php

class Sfwf_Addons_Page {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
	}

	public function register_menu() {

		add_submenu_page(  'sfwf_licenses', 'Add-Ons', 'Add-Ons', 'manage_options', 'sfwf-addons', array( $this, 'show_addons' ) );
	}

	public function show_addons() {

?>
		 <div class="sfwf-admin-addon-wrap">
		<div class="sfwf-page-heading">
		<h2 class="sfwf-addon-heading">Addons </h2>
		<p> You can use below addons to extend the functionality of Styler for WPForms</p>
		</div>

		<div class="sfwf-extend sfwf-box">
		<img src="<?php echo SFWF_URL; ?>/css/images/addons/bootstrap.png">
		<div class="sfwf-extend-content">
		<h5>Bootstrap</h5>
		<p>Easily add bootstrap to your forms</p>
		<div class="sfwf-extend-buttons">
		<a href="https://wpmonks.com/downloads/bootstrap-for-wpforms/?utm_source=dashboard&utm_medium=addons-menu&utm_campaign=wpforms-styler-plugin" target="_blank" class="button-secondary nf-doc-button">Documentation</a>
		<a href="https://wpmonks.com/downloads/bootstrap-for-wpforms/?utm_source=dashboard&utm_medium=addons-menu&utm_campaign=wpforms-styler-plugin" target="_blank" title="Conditional Logic" class="button-primary nf-button">Learn More</a>
		</div>
		</div>
		</div> <!-- End Sfwf Box -->

		<div class="sfwf-extend sfwf-box">
		<img src="<?php echo SFWF_URL; ?>/css/images/addons/field-icons.png">
		<div class="sfwf-extend-content">
		<h5>Field Icons</h5>
		<p>Easily add field icons to your forms</p>
		<div class="sfwf-extend-buttons">
		<a href="https://wpmonks.com/downloads/field-icons-for-wpforms/?utm_source=dashboard&utm_medium=addons-menu&utm_campaign=wpforms-styler-plugin" target="_blank" class="button-secondary nf-doc-button">Documentation</a>
		<a href="https://wpmonks.com/downloads/field-icons-for-wpforms/?utm_source=dashboard&utm_medium=addons-menu&utm_campaign=wpforms-styler-plugin" target="_blank" title="Conditional Logic" class="button-primary nf-button">Learn More</a>
		</div>
		</div>
		</div> <!-- End Sfwf Box -->

		<div class="sfwf-extend sfwf-box sfwf-no-margin">
		<img src="<?php echo SFWF_URL; ?>/css/images/addons/tooltips.png">
		<div class="sfwf-extend-content">
		<h5>Tooltips</h5>
		<p>Easily add tooltips to your forms</p>
		<div class="sfwf-extend-buttons">
		<a href="https://wpmonks.com/downloads/tooltips-for-wpforms/?utm_source=dashboard&utm_medium=addons-menu&utm_campaign=wpforms-styler-plugin" target="_blank" class="button-secondary nf-doc-button">Documentation</a>
		<a href="https://wpmonks.com/downloads/tooltips-for-wpforms/?utm_source=dashboard&utm_medium=addons-menu&utm_campaign=wpforms-styler-plugin" target="_blank" title="Conditional Logic" class="button-primary nf-button">Learn More</a>
		</div>
		</div>
		</div> <!-- End Sfwf Box -->
		<div class="sfwf-addon-clearfix"></div>
		</div>
		<br/>
		<div class="sfwf-admin-addon-wrap">
		<div class="sfwf-page-heading">
			<h2 class="sfwf-addon-heading">Views for WPForms </h2>
			<p> Display & Edit WPForms Entries on your site frontend easily!</p>
		</div>

		<div class="sfwf-extend sfwf-box" style="float: none;margin: 10px auto;">
			<img src="<?php echo SFWF_URL; ?>/css/images/addons/views.png">
			<div class="sfwf-extend-content">
			<h5>Views for WPForms</h5>
			<p>Display & Edit WPForms Entries on your site frontend</p>
			<div class="sfwf-extend-buttons">

			<a href="https://formviewswp.com/pricing/?utm_source=dashboard&utm_medium=addons-menu&utm_campaign=wpforms-styler-plugin" target="_blank" title="Conditional Logic" class="button-primary nf-button">Learn More</a>
			</div>
			</div>
			</div> <!-- End Sfwf Box -->
		<div class="sfwf-addon-clearfix"></div>
		</div>

	<?php
	}



}

add_action( 'plugins_loaded', 'sfwf_addons_page' );

function sfwf_addons_page() {
	new Sfwf_Addons_Page();

}


