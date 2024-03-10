<?php
$wp_customize->add_section(
	'sfwf_form_id_general_settings',
	array(
		'title' => 'General Settings',
		'panel' => 'sfwf_panel',
	)
);

$wp_customize->add_setting(
	'sfwf_general_settings[admin-bar]',
	array(
		'default'   => true,
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_general_settings[admin-bar]',
	array(
		'type'     => 'checkbox',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_general_settings', // Required, core or custom.
		'label'    => __( 'Enable Admin Bar (Tries to enable admin bar for users with "manage_options" capability. "Save" changes and close customizer to see its effect) ' ),
	)
);

$wp_customize->add_setting(
	'sfwf_general_settings' . $current_form_id . '[force-style]',
	array(
		'default'   => false,
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_general_settings' . $current_form_id . '[force-style]',
	array(
		'type'     => 'checkbox',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_general_settings', // Required, core or custom.
		'label'    => __( 'Enable this option if your theme is overwriting "Styles for wpforms styling"' ),
	)
);

$wp_customize->add_setting(
	'sfwf_general_settings[reset-styles]',
	array(
		'default'   => -1,
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

// get all WPForms forms created by user.
if ( class_exists( 'WPForms_Form_Handler' ) ) {
	$wpforms_hander = wpforms()->form;
	$forms          = $wpforms_hander->get();
	$select_form    = array( -1 => '---Select form --' );
	if ( $forms ) {
		foreach ( $forms as $form ) {
			$select_form[ $form->ID ] = $form->post_title;
		}
	}
} else {
	$select_form['form not installed'] = 'WPForms not installed';
}

$wp_customize->add_control(
	'sfwf_general_settings[reset-styles]',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_general_settings', // Required, core or custom.
		'label'    => __( 'Select Form to Reset Styles' ),
		'choices'  => $select_form,

	)
);

// reset styles button.
$wp_customize->add_setting(
	'sfwf_form_id_reset_style_button',
	array(
		'default'   => 'Delete Styles',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_reset_style_button',
	array(
		'type'        => 'button',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_general_settings', // Required, core or custom.
		'input_attrs' => array(
			'style' => 'float:left',
			'class' => 'gf-sfwf-reset-style-button',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[general-settings][custom-css]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[general-settings][custom-css]',
	array(
		'type'        => 'textarea',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_general_settings', // Required, core or custom.
		'label'       => __( 'Custom CSS' ),
		'input_attrs' => array(
			'placeholder' => 'Enter your custom css code here',
		),
	)
);
