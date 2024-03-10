<?php
// submit button
$wp_customize->add_section(
	'sfwf_form_id_submit_button',
	array(
		'title' => 'Submit Button',
		'panel' => 'sfwf_panel',
	)
);

// font align style buttons.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][text-align]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Text_Alignment_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][text-align]',
		array(
			'label'   => 'Alignment',
			'section' => 'sfwf_form_id_submit_button',
			'type'    => 'text_alignment',
			'choices' => $align_pos,
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][button-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][button-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Background Color' ),
			'section' => 'sfwf_form_id_submit_button',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][hover-color]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][hover-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Hover Background Color' ),
			'section' => 'sfwf_form_id_submit_button',
		)
	)
);

	// font style buttons.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][font-style]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Font_Style_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][font-style]',
		array(
			'label'   => 'Font Style',
			'section' => 'sfwf_form_id_submit_button',
			'type'    => 'font_style',
			'choices' => $font_style_choices,
		)
	)
);

// Font size label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][font-size-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Font Size' ),
			'section'  => 'sfwf_form_id_submit_button',
			'settings' => array(),
		)
	)
);
/* for pc*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][font-size]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][font-size]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][font-size-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);
$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][font-size-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][font-size-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][font-size-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
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
		'sfwf_form_id_' . $current_form_id . '[submit-button][line-height-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Line Height' ),
			'section'  => 'sfwf_form_id_submit_button',
			'settings' => array(),
		)
	)
);
/* for pc*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][line-height]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][line-height]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][line-height-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][line-height-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][line-height-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][line-height-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][font-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][font-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Font Color' ),
			'section' => 'sfwf_form_id_submit_button',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][font-hover-color]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][font-hover-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Hover Font Color' ),
			'section' => 'sfwf_form_id_submit_button',
		)
	)
);

// Label width.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][max-width-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Width' ),
			'section'  => 'sfwf_form_id_submit_button',
			'settings' => array(),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][max-width]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][max-width]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Tablet.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][max-width-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][max-width-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Mobile.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][max-width-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][max-width-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Label height.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][height-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Height' ),
			'section'  => 'sfwf_form_id_submit_button',
			'settings' => array(),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][height]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][height]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Tablet.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][height-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][height-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Mobile.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][height-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[submit-button][height-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
// Border Label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][border-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Border' ),
			'section'  => 'sfwf_form_id_submit_button',
			'settings' => array(),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][border-size]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[submit-button][border-size]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
		'label'       => __( 'Size' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 4px or 10%',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][border-type]',
	array(
		'default'   => 'solid',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[submit-button][border-type]',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_submit_button', // Required, core or custom.
		'label'    => __( 'Type' ),
		'choices'  => $border_types,
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][border-radius]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[submit-button][border-radius]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
		'label'       => __( 'Radius' ),
		'input_attrs' => array(
			'placeholder' => 'Ex.4px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][border-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[submit-button][border-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Border Color' ),
			'section' => 'sfwf_form_id_submit_button',
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][margin]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[submit-button][margin]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
		'label'       => __( 'Margin' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[submit-button][padding]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[submit-button][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_submit_button', // Required, core or custom.
		'label'       => __( 'Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);
