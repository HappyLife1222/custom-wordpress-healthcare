<?php

$wp_customize->add_section(
	'sfwf_form_id_form_title_description',
	array(
		'title' => 'Form Title & Description',
		'panel' => 'sfwf_panel',
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][font-color]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[form-title][font-color]', // Setting id.
		array( // Args, including any custom ones.
			'label'   => __( 'Title Font Color' ),
			'section' => 'sfwf_form_id_form_title_description',
		)
	)
);

// font style buttons.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][font-style]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Font_Style_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][font-style]',
		array(
			'label'   => 'Title Font Style',
			'section' => 'sfwf_form_id_form_title_description',
			'type'    => 'font_style',
			'choices' => $font_style_choices,
		)
	)
);

// Font size.
$wp_customize->add_control(
	new Sfwf_Label_Only(
		$wp_customize, // WP_Customize_Manager.
		'sfwf_form_id_' . $current_form_id . '[form-title][font-size-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Title Font Size' ),
			'section'  => 'sfwf_form_id_form_title_description',
			'settings' => array(),
		)
	)
);
/* for pc*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][font-size]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][font-size]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][font-size-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][font-size-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][font-size-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][font-size-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
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
		'sfwf_form_id_' . $current_form_id . '[form-title][line-height-label-only]', // Setting id.
		array( // Args, including any custom ones.
			'label'    => __( 'Line Height' ),
			'section'  => 'sfwf_form_id_form_title_description',
			'settings' => array(),
		)
	)
);
/* for pc*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][line-height]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Desktop_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][line-height]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);
/* for_tablet*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][line-height-tab]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Tab_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][line-height-tab]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);


/* for mobile*/
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][line-height-phone]',
	array(
		'default'   => '',
		'transport' => 'refresh',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Mobile_Text_Input_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][line-height-phone]',
		array(
			'type'        => 'text',
			'priority'    => 10, // Within the section.
			'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
			'label'       => __( '' ),
			'input_attrs' => array(
				'placeholder' => 'Ex.40px',
			),
		)
	)
);

// font align style buttons.
$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][text-align]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	new Sfwf_Text_Alignment_Option(
		$wp_customize,
		'sfwf_form_id_' . $current_form_id . '[form-title][text-align]',
		array(
			'label'   => 'Title Font Alignment',
			'section' => 'sfwf_form_id_form_title_description',
			'type'    => 'text_alignment',
			'choices' => $align_pos,
		)
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][margin]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-title][margin]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
		'label'       => __( 'Margin' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);

$wp_customize->add_setting(
	'sfwf_form_id_' . $current_form_id . '[form-title][padding]',
	array(
		'default'   => '',
		'transport' => 'postMessage',
		'type'      => 'option',
	)
);

$wp_customize->add_control(
	'sfwf_form_id_' . $current_form_id . '[form-title][padding]',
	array(
		'type'        => 'text',
		'priority'    => 10, // Within the section.
		'section'     => 'sfwf_form_id_form_title_description', // Required, core or custom.
		'label'       => __( 'Padding' ),
		'input_attrs' => array(
			'placeholder' => 'Example: 5px 10px 5px 10px',
		),
	)
);
