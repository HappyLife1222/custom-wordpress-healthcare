<?php
// form text fields section
$wp_customize->add_section(
	'sfwf_form_id_paragraph_textarea',
	array(
		'title' => 'Paragraph Textarea Fields',
		'panel' => 'sfwf_panel',
	)
);

// Label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][max-width-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Width' ),
			'section'  => 'sfwf_form_id_paragraph_textarea',
			'settings' => array(),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][max-width]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][max-width]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Tablet.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][max-width-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][max-width-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// Mobile.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][max-width-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][max-width-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// font style buttons.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-style]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Font_Style_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-style]',
		array(
			'label'   => 'Font Style',
			'section' => 'sfwf_form_id_paragraph_textarea',
			'type'    => 'font_style',
			'choices' => $font_style_choices,
		)
	)
);


// Font size label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-size-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Font Size' ),
			'section'  => 'sfwf_form_id_paragraph_textarea',
			'settings' => array(),
		)
	)
);
/* for pc*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-size]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-size]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-size-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-size-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-size-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-size-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
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
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][line-height-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Line Height' ),
			'section'  => 'sfwf_form_id_paragraph_textarea',
			'settings' => array(),
		)
	)
);
/* for pc */
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][line-height]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][line-height]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][line-height-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][line-height-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][line-height-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][line-height-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][font-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Font Color' ),
			'section' => 'sfwf_form_id_paragraph_textarea',
		)
	)
);
// Border Label.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Text Field Border' ),
			'section'  => 'sfwf_form_id_paragraph_textarea',
			'settings' => array(),
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-size]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-size]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
		'label'       => __( 'Size' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 4px or 10%',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-type]',
	array(
		'default'   => 'solid',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-type]',
	array(
		'type'     => 'select',
		'priority' => 10, // Within the section.
		'section'  => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
		'label'    => __( 'Type' ),
		'choices'  => $border_types,
	)
);
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-radius]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-radius]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
		'label'       => __( 'Radius' ),
		'input_attrs' => array(
			'placeholder' => 'Ex.4px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][border-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Border Color' ),
			'section' => 'sfwf_form_id_paragraph_textarea',
		)
	)
);



$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][background-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][background-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Background Color' ),
			'section' => 'sfwf_form_id_paragraph_textarea',
		)
	)
);


$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][margin]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][margin]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
		'label'       => __( 'Margin' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][padding]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[paragraph-textarea][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_paragraph_textarea', // Required, core or custom.
		'label'       => __( 'Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);
