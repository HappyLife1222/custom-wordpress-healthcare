<?php
$wp_customize->add_section(
	'sfwf_select_form_section',
	array(
		'title' => 'Select WPForm',
		'panel' => 'sfwf_panel',
	)
);

$wp_customize->add_setting(
	'sfwf_select_form_id',
	array(
		'default'   => '-1',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

// get all WPForms forms created by user.
if ( function_exists( 'wpforms' ) || class_exists( 'WPForms' ) ) {
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
	'sfwf_select_form_id',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_select_form_section', // Required, core or custom.
		'label'    => __( 'Select WPForm' ),
		'choices'  => $select_form,

	)
);
