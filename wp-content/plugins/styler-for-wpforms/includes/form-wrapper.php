<?php
// form wrapper section.
$wp_customize->add_section(
	'sfwf_form_id_form_wrapper',
	array(
		'title' => 'Form Wrapper',
		'panel' => 'sfwf_panel',
	)
);
// Label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][max-width-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Width' ),
			'section'  => 'sfwf_form_id_form_wrapper',
			'settings' => array(),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][max-width]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][max-width]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_wrapper', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Tablet
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][max-width-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][max-width-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_wrapper', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Mobile
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][max-width-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][max-width-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_wrapper', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][font]',
	array(
		'default'   => 'Default',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][font]',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_form_wrapper', // Required, core or custom.
		'label'    => __( 'Font Family' ),
		'choices'  => $font_collection,
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][background-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][background-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Background Color' ),
			'section' => 'sfwf_form_id_form_wrapper',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][background-image]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][background-image]',
		array(
			'label'    => 'Background Image',
			'section'  => 'sfwf_form_id_form_wrapper',
			'settings' => 'sfwf_form_id_' . $current_form_id . '[form-wrapper][background-image]',
		)
	)
);

// Border Label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Form Border' ),
			'section'  => 'sfwf_form_id_form_wrapper',
			'settings' => array(),
		)
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-size]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-size]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_form_wrapper', // Required, core or custom.
		'label'       => __( 'Size' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 4px or 10%',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-type]',
	array(
		'default'   => 'solid',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-type]',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_form_wrapper', // Required, core or custom.
		'label'    => __( 'Type' ),
		'choices'  => $border_types,
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

// border radius.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-radius]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-radius]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_form_wrapper', // Required, core or custom.
		'label'       => __( 'Radius' ),
		'input_attrs' => array(
			'placeholder' => 'Ex.4px',
		),
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[form-wrapper][border-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Border Color' ),
			'section' => 'sfwf_form_id_form_wrapper',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][margin]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][margin]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_form_wrapper', // Required, core or custom.
		'label'       => __( 'Margin' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][padding]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-wrapper][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_form_wrapper', // Required, core or custom.
		'label'       => __( 'Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);
