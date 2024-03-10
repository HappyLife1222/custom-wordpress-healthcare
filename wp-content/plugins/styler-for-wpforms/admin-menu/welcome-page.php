<?php

class Sfwf_Welcome_Page {

    function __construct() {
        add_action( 'admin_menu', array( $this, 'register_menu' ) );
		
	}

	public function register_menu() {

		add_submenu_page( 'sfwf_licenses', 'Documentation', 'Documentation', 'manage_options', 'sfwf-documentation', array( $this, 'sfwf_show_documentation' ) );
    }

    function sfwf_show_documentation(){
?>

    <div class="sfwf-welcome-wrapper">
        <div class="sfwf-about-section sfwf-section">
            <div class="sfwf-left-logo-cont">
                <img src="<?php echo SFWF_URL . '/admin-menu/images/icon.png'; ?>">
            </div>
            <div class="sfwf-right-logo-text-cont">
                <h2> Welcome to Styler for WPForms</h2>
                <p> Thank you for choosing Styler for WPForms - the most used, cost free plugin that let you style WPForms without any coding.</P>
            </div>
        </div>

        <div class="sfwf-usage-section sfwf-section-spacing">
            <div class="sfwf-usage-text sfwf-center-text sfwf-section">
                <h2> How to use Styler for WPForms</h2>
                <p> Login into your WordPress dashboard and go to the page in which you have added the form ( in frontend ). Now click on <em>Customize</em> option form admin bar and the go <em>Styler for WPForms</em> section. </p>
				<p> <strong>Here is the video tutorial for using Styler for WPForms</strong></p>
            </div>
                <div class="sfwf-video-section">
                    <?php add_thickbox(); ?>
                    <a href="https://www.youtube.com/embed/JiWDrTt82DM?autoplay=1?TB_iframe=true&width=1180&height=750" class="thickbox">
                    <img class="" src="<?php echo SFWF_URL . '/admin-menu/images/video-banner.png'; ?>" />
                    </a>
                </div>
        </div>
        <div class="sfwf-feature-section sfwf-section sfwf-section-spacing">
            <div class="sfwf-feature-head-text sfwf-center-text">
                    <h2> Plugin Feature & Addons</h2>
                    <p>Styler for WPForms lets you create beautiful designs for WPForms. It uses WordPress Customizer so you get a true WYSIWYG experience. All the changes you make in this plugin are instantaneously visible so you can see how the form looks in realtime.</p>
            </div>
            <div class="sfwf-feature-info-container">
                <div class="sfwf-left-half">
                    <img src="<?php echo SFWF_URL . '/css/images/welcome/welcome-feature.png'; ?>" />
                    <h5>100+ Styling options</h5>
                    <p>Easily create an amazing form designs in just a few minutes without writing any code.</p>
                </div>
                <div class="sfwf-right-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/preview.png'; ?>" />
                        <h5>Live Preview Changes</h5>
                        <p>All the changes you make are previed instantly without any need to refresh the page.</p>
                </div>
                <div class="sfwf-left-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/responsive.png'; ?>" />
                        <h5>Responsive Options</h5>
                        <p>Style your form differently for Desktops, Tablets and Mobile devices.</p>
                </div>
                <div class="sfwf-right-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/individual-form.png'; ?>" />
                        <h5>Style Individual Form</h5>
                        <p>Each form can be designed separtely even if they are added into same page</p>
                </div>
                <div class="sfwf-left-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/theme.png'; ?>" />
                        <h5>Compatible with Every Theme</h5>
                        <p>Ability to overwrite default theme styles by making Styler for WPForms CSS as important.</p>
                </div>
                <div class="sfwf-right-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/easy-to-use.png'; ?>" />
                        <h5>Easy to Use</h5>
                        <p>Easy to use controls like color picker, range slider and ability to give values in px, %, rem, em etc.</p>
                </div>
                <div class="sfwf-left-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/flexible.png'; ?>" />
                        <h5>Flexible</h5>
                        <p>Multiple settings for each field type to create the design you want to have.</p>
                </div>
                <div class="sfwf-right-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/customer-service.png'; ?>" />
                        <h5><a href="https://wpmonks.com/contact-us/?utm_source=dashboard&utm_medium=welcome&utm_campaign=wpforms" target="_blank">Premium Support</a></h5>
                        <p>Need custom design, functionality or want to report an issue then get in touch.</p>
                </div>
                <div class="sfwf-left-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/addons.png'; ?>" />
                        <h5> <a href="https://wpmonks.com/wpforms-addons/?utm_source=dashboard&utm_medium=welcome&utm_campaign=wpforms" target="_blank">Addons With Rich Settings</a></h5>
                        <p>Carefully designed set of addons to make your forms look amazing with minimal effort.</p>
                </div>
                <div class="sfwf-right-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/bootstrap.png'; ?>" />
                        <h5><a href="https://wpmonks.com/downloads/bootstrap-for-wpforms?utm_source=dashboard&utm_medium=welcome&utm_campaign=wpforms" target="_blank">Bootstrap</a></h5>
                        <p>Implement Bootstrap design on your form with single click. Customize color theme as you wish.</p>
                </div>
                <div class="sfwf-left-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/field-icons.png'; ?>" />
                        <h5><a href="https://wpmonks.com/downloads/field-icons-for-wpforms?utm_source=dashboard&utm_medium=welcome&utm_campaign=wpforms" target="_blank">Field Icons </a></h5>
                        <p>Add fontawesome icons to form fields and position them.</p>
                </div>
                <div class="sfwf-right-half">
                        <img src="<?php echo SFWF_URL . '/css/images/welcome/tooltip.png'; ?>" />
                        <h5><a href= "https://wpmonks.com/downloads/tooltips-for-wpforms/?utm_source=dashboard&utm_medium=welcome&utm_campaign=wpforms" target="_blank">Tooltips</a></h5>
                        <p>Add helpful tips for each form field with a wide range of tooltip icon selection</p>
                </div>
            </div>
        </div>

        <div class="sfwf-section-spacing sfwf-addon-bundle">
            <div class="sfwf-update-left">
				<h2> Addon Bundle</h2>
				<ul>
					<li><span class="dashicons dashicons-yes"></span> Bootstrap </li>
					<li><span class="dashicons dashicons-yes"></span> Tooltips </li>
					<li><span class="dashicons dashicons-yes"></span> Field Icons </li>
                    <li><span class="dashicons dashicons-yes"></span> Premium Support </li>
                    <li><span class="dashicons dashicons-yes"></span> Documentation </li>

				</ul>
			</div>
			<div class="sfwf-update-right">
				<h2> <span> PRO</span> </h2>
				<div class="sfwf-wel-addon-price">
					<span class="sfwf-wel-amount">49.99</span> 
					<br>
					<span  class="sfwf-wel-term">per year</span>
				</div>
				<a class="sfwf-wel-page-button" href="https://wpmonks.com/downloads/addon-bundle-for-wpforms/?utm_source=dashboard&utm_medium=welcome&utm_campaign=wpforms" target="_blank">Buy Now</a>
			</div>
        </div>

        <div class="sfwf-testimonial-section sfwf-section sfwf-section-spacing">
                <h2>Testimonials</h2>
                <div class="sfwf-testimonial-first">
                    <p>
                    "I was looking to change the form design without CSS since ages. Great plugin to design a WPForm just with few clicks! It’s very easy to style a WPForm with it according to your choice. Great job by the developers!" <em>-wordorg2019</em>
                    </p>
                </div>
                <div class="sfwf-testimonial-text">
                    <p>
                    I am pretty good with CSS but I still prefer to use Styler for WPForms because it is so easy to use. It has really made my job as a web designer easy. <em>-Jasvir</em>
                    </p>
                </div>
        </div>
        <div class="sfwf-donation-sec">
            <div class="sfwf-left-half">
                <a class="sfwf-wel-page-button" href="https://paypal.me/wpmonks" target="_blank">Donate to Support Plugin</a>
            </div>
            <div class="sfwf-right-half">
                <a class="sfwf-wel-page-button sfwf-donation-button" href="https://twitter.com/wp_monk" target="_blank"><span class="sfwf-follow-text">Follow us on Twitter<span class="dashicons dashicons-arrow-right"></span></span>
            </a>
            </div>
        </div>
        <div class="sfwf-support-section sfwf-section-spacing" style="background-image: url(<?php echo SFWF_URL . '/admin-menu/images/support.png'; ?>)">
            <div class="sfwf-support-left">
                <h2>Let us Know your Suggestions.</h2>
                <p>Your suggestion and reviews are valuable for us. Let us know if you have any problem with plugin.</p>
                <a class="sfwf-wel-page-button" href="https://wpmonks.com/contact-us/?utm_source=dashboard&utm_medium=welcome&utm_campaign=wpforms" target="_blank">Contact Us</a>
            </div>
        </div>
    </div>


<?php
    }
}

new Sfwf_Welcome_Page();