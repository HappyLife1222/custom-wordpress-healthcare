<?php

$wp_customize->add_section(
	'sfwf_form_id_radio_inputs',
	array(
		'title' => 'Radio Inputs',
		'panel' => 'sfwf_panel',
	)
);


// Label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][max-width-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Width' ),
			'section'  => 'sfwf_form_id_radio_inputs',
			'settings' => array(),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][max-width]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][max-width]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Tablet.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][max-width-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][max-width-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Mobile.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][max-width-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][max-width-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

/*
Start of Section
 */
// Line height label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][line-height-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Line Height' ),
			'section'  => 'sfwf_form_id_radio_inputs',
			'settings' => array(),
		)
	)
);
/* for pc*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][line-height]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][line-height]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][line-height-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][line-height-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][line-height-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][line-height-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// font style buttons.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-style]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Font_Style_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-style]',
		array(
			'label'   => 'Font Style',
			'section' => 'sfwf_form_id_radio_inputs',
			'type'    => 'font_style',
			'choices' => $font_style_choices,
		)
	)
);
// Font size label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-size-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Font Size' ),
			'section'  => 'sfwf_form_id_radio_inputs',
			'settings' => array(),
		)
	)
);
/* for pc*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-size]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-size]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-size-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-size-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-size-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-size-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[radio-inputs][font-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Font Color' ),
			'section' => 'sfwf_form_id_radio_inputs',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][padding]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[radio-inputs][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_radio_inputs', // Required, core or custom.
		'label'       => __( 'Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);
