<!-- <?php
if ( class_exists( 'WP_Customize_Control' ) ) :
	class Themes_Pack_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/downloads/theme-pack?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/theme-pack.jpg"></a>
		<h3>Get pack of beautifully crafted themes and design forms instantly</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}


	class Grid_Layout_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/downloads/grid-layout?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/grid-layout.jpg"></a>
		<h3>Divide your form into multiple columns to arrange fields side by side</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}

	class Field_Icons_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/downloads/field-icons?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/field-icons.jpg"></a>
		<h3>Add icons inside form fields</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}

	class Custom_Themes_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/downloads/custom-themes?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/custom-themes.jpg"></a>
		<h3>Save you current form style as theme and apply it on other forms</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}



	class Addon_Bundle_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/downloads/addon-bundle?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/addon-bundle.jpg"></a>
		<h3>Get all the addons at a special discounted price</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}

	class More_Addons_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/styles-and-layouts-for-gravity-forms/?src=customizer#x-section-6" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/more-addons.jpg"></a>
		<h3>Checkout more addons</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}

	class Material_Design_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/downloads/material-design?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/material-design.jpg"></a>
		<h3>Apply material design on Gravity Forms with single click</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}

	class Tooltips_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/downloads/tooltips?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/tooltips.jpg"></a>
		<h3>Show tooltips inside Gravity Form fields</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}

	class Customization_Support_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the control's content.
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		public function render_content() {
			?>
	<label>
		<h2><?php echo esc_html( $this->label ); ?></h2>
		<a href="https://wpmonks.com/contact-us?src=customizer" target="_blank"><img src="<?php echo GF_sfwf_URL; ?>/css/images/support.jpg"></a>
		<h3>Contact us for custom Gravity Forms work or for any support questions</h3>
		<hr>
	</textarea>
	</label>
			<?php
		}
	}


	class WP_Customize_Label_Only extends WP_Customize_Control {
		public $type = 'label_only';

		public function render_content() {
			?>
	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>  
</label>
			<?php
		}
	}
endif;
