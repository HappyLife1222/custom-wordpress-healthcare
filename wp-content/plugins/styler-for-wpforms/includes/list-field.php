<?php
// form fields section
$wp_customize->add_section(
	'sfwf_form_id_list_field',
	array(
		'title' => 'List Field',
		'panel' => 'sfwf_panel',
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-table][background-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[list-field-table][background-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Table background Color' ),
			'section' => 'sfwf_form_id_list_field',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][font-size]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][font-size]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_list_field', // Required, core or custom.
		'label'       => __( 'Heading Font Size' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 40px or 90%',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][font-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[list-field-heading][font-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Heading Font Color' ),
			'section' => 'sfwf_form_id_list_field',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][background-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[list-field-heading][background-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Heading background Color' ),
			'section' => 'sfwf_form_id_list_field',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][text-align]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][text-align]',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_list_field', // Required, core or custom.
		'label'    => __( 'Heading Position' ),
		'choices'  => $align_pos,
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][padding]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[list-field-heading][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_list_field', // Required, core or custom.
		'label'       => __( 'Heading Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell][font-size]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell][font-size]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_list_field', // Required, core or custom.
		'label'       => __( 'Cell Text Font Size' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 40px or 90%',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell][background-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[list-field-cell][background-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Cell background Color' ),
			'section' => 'sfwf_form_id_list_field',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell][font-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[list-field-cell][font-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Cell Text Font Color' ),
			'section' => 'sfwf_form_id_list_field',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell][text-align]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell][text-align]',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_list_field', // Required, core or custom.
		'label'    => __( 'Cell Text Alignment' ),
		'choices'  => $align_pos,
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell-container][padding]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[list-field-cell-container][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_list_field', // Required, core or custom.
		'label'       => __( 'Cell Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);

