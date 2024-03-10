<?php

class Sfwf_Views_Custom_Control extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {
		?>

		<label>
			<h2><?php echo esc_html( $this->label ); ?></h2>
			<a href="https://formviewswp.com/pricing/?utm_source=dashboard&utm_medium=customizer&utm_campaign=wpforms-styler-plugin" target="_blank"><img src="<?php echo SFWF_URL; ?>/css/images/addons/views.png"></a>
			<h3>Display WPForms Entries on your site frontend!</h3>
			<hr>
		</textarea>
		</label>
		<?php
	}
}

class Sfwf_Bootstrap_Custom_Control extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {
		?>

		<label>
			<h2><?php echo esc_html( $this->label ); ?></h2>
			<a href="https://wpmonks.com/downloads/bootstrap-for-wpforms/?utm_source=dashboard&utm_medium=customizer&utm_campaign=wpforms-styler-plugin" target="_blank"><img src="<?php echo SFWF_URL; ?>/css/images/addons/bootstrap.png"></a>
			<h3>Add Bootstrap styles into your form</h3>
			<hr>
		</textarea>
		</label>
		<?php
	}
}


class Sfwf_Field_Icons_Custom_Control extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {
		?>
		<label>
			<h2><?php echo esc_html( $this->label ); ?></h2>
			<a href="https://wpmonks.com/downloads/field-icons-for-wpforms/?utm_source=dashboard&utm_medium=customizer&utm_campaign=wpforms-styler-plugin" target="_blank"><img src="<?php echo SFWF_URL; ?>/css/images/addons/field-icons.png"></a>
			<h3>Add icons inside form fields</h3>
			<hr>
		</textarea>
		</label>
		<?php
	}
}


class Sfwf_More_Addons_Custom_Control extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {
		?>
		<label>
			<h2><?php echo esc_html( $this->label ); ?></h2>
			<a href="https://wpmonks.com/downloads/?utm_source=dashboard&utm_medium=customizer&utm_campaign=wpforms-styler-plugin" target="_blank"><img src="<?php echo SFWF_URL; ?>/css/images/addons/more-addons.png"></a>
			<h3>Checkout more addons</h3>
			<hr>
		</textarea>
		</label>
		<?php
	}
}

class Sfwf_Tooltips_Custom_Control extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {
		?>
		<label>
			<h2><?php echo esc_html( $this->label ); ?></h2>
			<a href="https://wpmonks.com/downloads/tooltips-for-wpforms/?utm_source=dashboard&utm_medium=customizer&utm_campaign=wpforms-styler-plugin" target="_blank"><img src="<?php echo SFWF_URL; ?>/css/images/addons/tooltips.png"></a>
			<h3>Show tooltips inside Gravity Form fields</h3>
			<hr>
		</textarea>
	</label>
		<?php
	}
}

class Sfwf_Customization_Support_Custom_Control extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {
		?>
		<label>
			<h2><?php echo esc_html( $this->label ); ?></h2>
			<a href="https://wpmonks.com/contact-us?utm_source=dashboard&utm_medium=customizer&utm_campaign=wpforms-styler-plugin" target="_blank"><img src="<?php echo SFWF_URL; ?>/css/images/addons/support.png"></a>
			<h3>Contact us for custom Gravity Forms work or for any support questions</h3>
			<hr>
		</textarea>
		</label>
		<?php
	}
}



$wp_customize->add_section(
	'sfwf_form_id_addons',
	array(
		'title' => 'Addons',
		'panel' => 'sfwf_panel',
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_[addons][views]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);


$wp_customize->add_control(
	new Sfwf_Views_Custom_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_[addons][views]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Views for WPForms' ),
			'section' => 'sfwf_form_id_addons',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_[addons][bootstrap]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Bootstrap_Custom_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_[addons][bootstrap]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Bootstrap' ),
			'section' => 'sfwf_form_id_addons',
		)
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_[addons][field-icons]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Field_Icons_Custom_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_[addons][field-icons]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Field Icons' ),
			'section' => 'sfwf_form_id_addons',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_[addons][tooltips]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tooltips_Custom_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_[addons][tooltips]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Tooltips' ),
			'section' => 'sfwf_form_id_addons',
		)
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_[addons][widget-sidebar]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);




$wp_customize->add_setting(
	'sfwf_form_id_[addons][woocommerce-addon]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);



$wp_customize->add_setting(
	'sfwf_form_id_[addons][more]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_More_Addons_Custom_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_[addons][more]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'More Addons ' ),
			'section' => 'sfwf_form_id_addons',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_[addons][customization-support]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Customization_Support_Custom_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_[addons][customization-support]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Customization & Support' ),
			'section' => 'sfwf_form_id_addons',
		)
	)
);
