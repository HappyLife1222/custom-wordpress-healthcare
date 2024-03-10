<?php
// form placeholders section uses refresh method
$wp_customize->add_section(
	'sfwf_form_id_placeholders',
	array(
		'title' => 'Placeholders',
		'panel' => 'sfwf_panel',
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[placeholders][font-size]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[placeholders][font-size]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_placeholders', // Required, core or custom.
		'label'       => __( 'Font Size' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 40px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[placeholders][font-color]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[placeholders][font-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Font Color' ),
			'section' => 'sfwf_form_id_placeholders',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[placeholders][padding]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[placeholders][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_placeholders', // Required, core or custom.
		'label'       => __( 'Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);
