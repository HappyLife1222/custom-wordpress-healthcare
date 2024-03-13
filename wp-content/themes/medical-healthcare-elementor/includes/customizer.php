<?php

if ( class_exists("Kirki")){

	Kirki::add_config('theme_config_id', array(
		'capability'   =>  'edit_theme_options',
		'option_type'  =>  'theme_mod',
	));

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'medical_healthcare_elementor_logo_resizer',
		'label'       => esc_html__( 'Adjust Logo Size', 'medical-healthcare-elementor' ),
		'section'     => 'title_tagline',
		'default'     => 70,
		'choices'     => [
			'min'  => 10,
			'max'  => 300,
			'step' => 10,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_enable_logo_text',
		'section'     => 'title_tagline',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

  	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_healthcare_elementor_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'medical-healthcare-elementor' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-healthcare-elementor' ),
			'off' => esc_html__( 'Disable', 'medical-healthcare-elementor' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_healthcare_elementor_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'medical-healthcare-elementor' ),
		'section'     => 'title_tagline',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-healthcare-elementor' ),
			'off' => esc_html__( 'Disable', 'medical-healthcare-elementor' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_site_tittle_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Font Size', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_site_tittle_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo a'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_site_tittle_transform_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Text Transform', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'medical_healthcare_elementor_site_tittle_transform',
		'section'     => 'title_tagline',
		'default'     => 'none',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'medical-healthcare-elementor' ),
			'uppercase' => esc_html__( 'Uppercase', 'medical-healthcare-elementor' ),
			'lowercase' => esc_html__( 'Lowercase', 'medical-healthcare-elementor' ),
			'capitalize' => esc_html__( 'Capitalize', 'medical-healthcare-elementor' ),
		],
		'output' => array(
			array(
				'element'  => array( '.logo a'),
				'property' => ' text-transform',
			),
		),
	 ) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_site_tagline_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Tagline Font Size', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_site_tagline_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo span'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );
	
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_logo_settings_premium_features',
		'section'     => 'title_tagline',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Unlock More Features in the Premium Version!', 'medical-healthcare-elementor' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Customizable Text Logo', 'medical-healthcare-elementor' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Enhanced Typography Options', 'medical-healthcare-elementor' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Priority Support', 'medical-healthcare-elementor' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'medical-healthcare-elementor' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/elementor/healthcare-wordpress-theme/', 'medical-healthcare-elementor' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'medical-healthcare-elementor' ) .'</a></div>',
	) );

	// TYPOGRAPHY SETTINGS
	Kirki::add_panel( 'medical_healthcare_elementor_typography_panel', array(
		'priority' => 10,
		'title'    => __( 'Typography', 'medical-healthcare-elementor' ),
	) );

	//Heading 1 Section

	Kirki::add_section( 'medical_healthcare_elementor_h1_typography_setting', array(
		'title'    => __( 'Heading 1', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_h1_typography_heading',
		'section'     => 'medical_healthcare_elementor_h1_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 1 Typography', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'medical_healthcare_elementor_h1_typography_font',
		'section'   =>  'medical_healthcare_elementor_h1_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Figtree',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h1',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 2 Section

	Kirki::add_section( 'medical_healthcare_elementor_h2_typography_setting', array(
		'title'    => __( 'Heading 2', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_h2_typography_heading',
		'section'     => 'medical_healthcare_elementor_h2_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 2 Typography', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'medical_healthcare_elementor_h2_typography_font',
		'section'   =>  'medical_healthcare_elementor_h2_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Figtree',
			'font-size'       => '',
			'variant'       =>  '700',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h2',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 3 Section

	Kirki::add_section( 'medical_healthcare_elementor_h3_typography_setting', array(
		'title'    => __( 'Heading 3', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_h3_typography_heading',
		'section'     => 'medical_healthcare_elementor_h3_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 3 Typography', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'medical_healthcare_elementor_h3_typography_font',
		'section'   =>  'medical_healthcare_elementor_h3_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Figtree',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h3',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 4 Section

	Kirki::add_section( 'medical_healthcare_elementor_h4_typography_setting', array(
		'title'    => __( 'Heading 4', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_h4_typography_heading',
		'section'     => 'medical_healthcare_elementor_h4_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 4 Typography', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_i-healthcare-elementord', array(
		'type'  =>  'typography',
		'settings'  => 'medical_healthcare_elementor_h4_typography_font',
		'section'   =>  'medical_healthcare_elementor_h4_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Figtree',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h4',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 5 Section

	Kirki::add_section( 'medical_healthcare_elementor_h5_typography_setting', array(
		'title'    => __( 'Heading 5', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_h5_typography_heading',
		'section'     => 'medical_healthcare_elementor_h5_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 5 Typography', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'medical_healthcare_elementor_h5_typography_font',
		'section'   =>  'medical_healthcare_elementor_h5_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Figtree',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h5',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 6 Section

	Kirki::add_section( 'medical_healthcare_elementor_h6_typography_setting', array(
		'title'    => __( 'Heading 6', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_h6_typography_heading',
		'section'     => 'medical_healthcare_elementor_h6_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 6 Typography', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'medical_healthcare_elementor_h6_typography_font',
		'section'   =>  'medical_healthcare_elementor_h6_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Figtree',
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h6',
				'suffix' => '!important'
			],
		],
	) );

	//body Typography

	Kirki::add_section( 'medical_healthcare_elementor_body_typography_setting', array(
		'title'    => __( 'Content Typography', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_body_typography_heading',
		'section'     => 'medical_healthcare_elementor_body_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Content  Typography', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'medical_healthcare_elementor_body_typography_font',
		'section'   =>  'medical_healthcare_elementor_body_typography_setting',
		'default'   =>  [
			'font-family'   =>  'Roboto Condensed',
			'variant'       =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   => 'body',
				'suffix' => '!important'
			],
		],
	) );

	// Theme Options Panel
	Kirki::add_panel( 'medical_healthcare_elementor_theme_options_panel', array(
		'priority' => 10,
		'title'    => __( 'Theme Options', 'medical-healthcare-elementor' ),
	) );

	// HEADER SECTION

	Kirki::add_section( 'medical_healthcare_elementor_section_topbar', array(
	    'title'          => esc_html__( 'Header Settings', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_theme_options_panel',
		'description'    => esc_html__( 'Here you can add header information.', 'medical-healthcare-elementor' ),
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_enable_toptext_heading',
		'priority'       => 1,
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Top Bar Info', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_healthcare_elementor_sticky_header',
		'label'       => esc_html__( 'Enable/Disable Sticky Header', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => 0,
		'priority'       => 1,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-healthcare-elementor' ),
			'off' => esc_html__( 'Disable', 'medical-healthcare-elementor' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'priority'       => 1,
		'settings'    => 'medical_healthcare_elementor_menu_size_heading',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_menu_size',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'medical-healthcare-elementor' ),
		'type'        => 'text',
		'priority'       => 1,
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => 'font-size',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'priority'       => 1,
		'settings'    => 'medical_healthcare_elementor_menu_text_transform_heading',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'priority'       => 1,
		'settings'    => 'medical_healthcare_elementor_menu_text_transform',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => 'uppercase',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'medical-healthcare-elementor' ),
			'uppercase' => esc_html__( 'Uppercase', 'medical-healthcare-elementor' ),
			'lowercase' => esc_html__( 'Lowercase', 'medical-healthcare-elementor' ),
			'capitalize' => esc_html__( 'Capitalize', 'medical-healthcare-elementor' ),
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => ' text-transform',
			),
		),
	 ) );

	Kirki::add_field( 'theme_config_id', [
		'label'    =>  esc_html__( 'Add Topbar Text', 'medical-healthcare-elementor' ),
		'type'     => 'text',
		'settings' => 'medical_healthcare_elementor_header_toptxt',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
		'priority'       => 2,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    => esc_html__( 'Contact Text', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_contact_button_text',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
		'priority'       => 3,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'url',
		'label'    =>  esc_html__( 'Contact Number', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_contact_number',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
		'priority'       => 4,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_enable_socail_link',
		'priority'       => 5,
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'priority'       => 6,
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Social Icon', 'medical-healthcare-elementor' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'medical-healthcare-elementor' ),
		'settings'     => 'medical_healthcare_elementor_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'medical-healthcare-elementor' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'medical-healthcare-elementor' ). ' <a href="https://fontawesome.com/v5/search?o=r&m=free&f=brands" target="_blank"><strong>' . esc_html__( 'View All', 'medical-healthcare-elementor' ) . ' </strong></a>',
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'medical-healthcare-elementor' ),
				'description' => esc_html__( 'Add the social icon url here.', 'medical-healthcare-elementor' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_enable_time_heading',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Operating Time', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Text', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_time_text',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Time', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_time',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_enable_location_heading',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Location', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Text', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_location_text',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Location Address', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_location',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_header_phone_number_heading',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Phone Number', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Text', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_phone_number_text',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Phone Number', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_phone_number',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
		'sanitize_callback' => 'medical_healthcare_elementor_sanitize_phone_number',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_enable_button_heading',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( ' Header Button', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'       => 11,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Button Text', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_button_text',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
		'priority'       => 12,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'url',
		'label'    =>  esc_html__( 'Button URL', 'medical-healthcare-elementor' ),
		'settings' => 'medical_healthcare_elementor_header_button_url',
		'section'  => 'medical_healthcare_elementor_section_topbar',
		'default'  => '',
		'priority'       => 13,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_menu_color',
		'label'       => __( 'Menu Color', 'medical-healthcare-elementor' ),
		'type'        => 'color',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'transport' => 'auto',
		'priority'       => 14,
		'default'     => '#000000',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_menu_hover_color',
		'label'       => __( 'Menu Hover Color', 'medical-healthcare-elementor' ),
		'type'        => 'color',
		'priority'       => 15,
		'default'     => '#1565c0',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'transport' => 'auto',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a:hover', '#main-menu ul li a:hover', '#main-menu li:hover > a','#main-menu a:focus','#main-menu li.focus > a','#main-menu ul li.current-menu-item > a','#main-menu ul li.current_page_item > a','#main-menu ul li.current-menu-parent > a','#main-menu ul li.current_page_ancestor > a','#main-menu ul li.current-menu-ancestor > a'),
				'property' => 'color',
			),

		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_submenu_color',
		'label'       => __( 'Submenu Color', 'medical-healthcare-elementor' ),
		'type'        => 'color',
		'priority'       => 16,
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'transport' => 'auto',
		'default'     => '#000000',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu ul.children li a', '#main-menu ul.sub-menu li a'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_submenu_hover_color',
		'label'       => __( 'Submenu Hover Color', 'medical-healthcare-elementor' ),
		'type'        => 'color',
		'priority'       => 17,
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'transport' => 'auto',
		'default'     => '#fff',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu ul.children li a:hover', '#main-menu ul.sub-menu li a:hover'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_submenu_hover_background_color',
		'label'       => __( 'Submenu Hover Background Color', 'medical-healthcare-elementor'),
		'type'        => 'color',
		'priority'       => 18,
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'transport' => 'auto',
		'default'     => '#1565c0',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu ul.children li a:hover', '#main-menu ul.sub-menu li a:hover'),
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_logo_settings_premium_features_header',
		'section'     => 'medical_healthcare_elementor_section_topbar',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Enhance your header design now!', 'medical-healthcare-elementor' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Customize your header background color', 'medical-healthcare-elementor' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Adjust icon and text font sizes', 'medical-healthcare-elementor' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Explore enhanced typography options', 'medical-healthcare-elementor' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'medical-healthcare-elementor' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/elementor/healthcare-wordpress-theme/', 'medical-healthcare-elementor' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'medical-healthcare-elementor' ) .'</a></div>',
	) );
	
	//ADDITIONAL SETTINGS

	Kirki::add_section( 'medical_healthcare_elementor_additional_setting', array(
		'title'          => esc_html__( 'Additional Settings', 'medical-healthcare-elementor' ),
		'description'    => esc_html__( 'Additional Settings of themes', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_theme_options_panel',
		'priority'       => 10,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_preloader_hide',
		'label'       => esc_html__( 'Here you can enable or disable your preloader.', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '0',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '0',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_single_page_layout_heading',
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Page Layout', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'medical_healthcare_elementor_single_page_layout',
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => 'One Column',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'medical-healthcare-elementor' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'medical-healthcare-elementor' ),
			'One Column' => esc_html__( 'One Column', 'medical-healthcare-elementor' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_header_background_attachment_heading',
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Attachment', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'medical_healthcare_elementor_header_background_attachment',
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => 'scroll',
		'choices'     => [
			'scroll' => esc_html__( 'Scroll', 'medical-healthcare-elementor' ),
			'fixed' => esc_html__( 'Fixed', 'medical-healthcare-elementor' ),
		],
		'output' => array(
			array(
				'element'  => '.header-image-box',
				'property' => 'background-attachment',
			),
		),
	 ) );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_header_image_height_heading',
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image height', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_header_image_height',
		'label'       => __( 'Image Height', 'medical-healthcare-elementor' ),
		'description'    => esc_html__( 'Enter a value in pixels. Example:500px', 'medical-healthcare-elementor' ),
		'type'        => 'text',
		'default'    => [
			'desktop' => '550px',
			'tablet'  => '350px',
			'mobile'  => '200px',
		],
		'responsive' => true,
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.header-image-box'),
				'property' => 'height',
				'media_query' => [
					'desktop' => '@media (min-width: 1024px)',
					'tablet'  => '@media (min-width: 768px) and (max-width: 1023px)',
					'mobile'  => '@media (max-width: 767px)',
				],
			),
		),
	) );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_header_overlay_heading',
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Overlay', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_header_overlay_setting',
		'label'       => __( 'Overlay Color', 'medical-healthcare-elementor' ),
		'type'        => 'color',
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'transport' => 'auto',
		'default'     => '#00000080',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.header-image-box:before',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_header_page_title',
		'label'       => esc_html__( 'Enable / Disable Header Image Page Title.', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_header_breadcrumb',
		'label'       => esc_html__( 'Enable / Disable Header Image Breadcrumb.', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	// POST SECTION

	Kirki::add_section( 'medical_healthcare_elementor_blog_post', array(
		'title'          => esc_html__( 'Post Settings', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_theme_options_panel',
		'description'    => esc_html__( 'Here you can add post information.', 'medical-healthcare-elementor' ),
		'priority'       => 160,
	) );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_post_layout_heading',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Layout', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'medical_healthcare_elementor_post_layout',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'medical-healthcare-elementor' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'medical-healthcare-elementor' ),
			'One Column' => esc_html__( 'One Column', 'medical-healthcare-elementor' ),
			'Three Columns' => esc_html__( 'Three Columns', 'medical-healthcare-elementor' ),
			'Four Columns' => esc_html__( 'Four Columns', 'medical-healthcare-elementor' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_length_setting_heading',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'medical_healthcare_elementor_length_setting',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '15',
		'priority'    => 10,
		'choices'  => [
					'min'  => -10,
					'max'  => 40,
						'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'medical-healthcare-elementor' ),
		'settings'    => 'medical_healthcare_elementor_single_post_tag',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'medical-healthcare-elementor' ),
		'settings'    => 'medical_healthcare_elementor_single_post_category',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_post_comment_show_hide',
		'label'       => esc_html__( 'Show / Hide Comment Box', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_single_post_radius',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_single_post_border_radius',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'medical-healthcare-elementor' ),
		'type'        => 'text',
		'section'     => 'medical_healthcare_elementor_blog_post',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.post-img img'),
				'property' => 'border-radius',
			),
		),
	) );

	// WOOCOMMERCE SETTINGS

	Kirki::add_section( 'medical_healthcare_elementor_woocommerce_settings', array(
		'title'          => esc_html__( 'Woocommerce Settings', 'medical-healthcare-elementor' ),
		'panel'    => 'woocommerce',
		'description'    => esc_html__( 'Woocommerce Settings of themes', 'medical-healthcare-elementor' ),
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_shop_page_sidebar',
		'label'       => esc_html__( 'Enable/Disable Shop Page Sidebar', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => 'true',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Shop Page Layouts', 'medical-healthcare-elementor' ),
		'settings'    => 'medical_healthcare_elementor_shop_page_layout',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'medical-healthcare-elementor' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'medical-healthcare-elementor' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'medical_healthcare_elementor_shop_page_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]

	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'label'       => esc_html__( 'Products Per Row', 'medical-healthcare-elementor' ),
		'settings'    => 'medical_healthcare_elementor_products_per_row',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => '3',
		'priority'    => 10,
		'choices'     => [
			'2' => '2',
			'3' => '3',
			'4' => '4',
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'label'       => esc_html__( 'Products Per Page', 'medical-healthcare-elementor' ),
		'settings'    => 'medical_healthcare_elementor_products_per_page',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => '9',
		'priority'    => 10,
		'choices'  => [
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_healthcare_elementor_single_product_sidebar',
		'label'       => esc_html__( 'Enable / Disable Single Product Sidebar', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => 'true',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Single Product Layout', 'medical-healthcare-elementor' ),
		'settings'    => 'medical_healthcare_elementor_single_product_sidebar_layout',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'medical-healthcare-elementor' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'medical-healthcare-elementor' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'medical_healthcare_elementor_single_product_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_products_button_border_radius_heading',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Products Button Border Radius', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'medical_healthcare_elementor_products_button_border_radius',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
		'choices'  => [
					'min'  => 1,
					'max'  => 50,
					'step' => 1,
				],
		'output' => array(
			array(
				'element'  => array('.woocommerce ul.products li.product .button',' a.checkout-button.button.alt.wc-forward','.woocommerce #respond input#submit', '.woocommerce a.button', '.woocommerce button.button','.woocommerce input.button','.woocommerce #respond input#submit.alt','.woocommerce button.button.alt','.woocommerce input.button.alt'),
				'property' => 'border-radius',
				'units' => 'px',
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_sale_badge_position_heading',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Badge Position', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'medical_healthcare_elementor_sale_badge_position',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'     => 'right',
		'choices'     => [
			'right' => esc_html__( 'Right', 'medical-healthcare-elementor' ),
			'left' => esc_html__( 'Left', 'medical-healthcare-elementor' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_products_sale_font_size_heading',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Font Size', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'text',
		'settings'    => 'medical_healthcare_elementor_products_sale_font_size',
		'section'     => 'medical_healthcare_elementor_woocommerce_settings',
		'priority'    => 10,
		'output' => array(
			array(
				'element'  => array('.woocommerce span.onsale','.woocommerce ul.products li.product .onsale'),
				'property' => 'font-size',
				'units' => 'px',
			),
		),
	] );

	// No Results Page Settings

	Kirki::add_section( 'medical_healthcare_elementor_no_result_section', array(
		'title'          => esc_html__( '404 & No Results Page Settings', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_theme_options_panel',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_page_not_found_title_heading',
		'section'     => 'medical_healthcare_elementor_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Title', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_healthcare_elementor_page_not_found_title',
		'section'  => 'medical_healthcare_elementor_no_result_section',
		'default'  => esc_html__('404 Error!', 'medical-healthcare-elementor'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_page_not_found_text_heading',
		'section'     => 'medical_healthcare_elementor_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Text', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_healthcare_elementor_page_not_found_text',
		'section'  => 'medical_healthcare_elementor_no_result_section',
		'default'  => esc_html__('The page you are looking for may have been moved, deleted, or possibly never existed.', 'medical-healthcare-elementor'),
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'     => 'custom',
		'settings' => 'medical_healthcare_elementor_page_not_found_line_break',
		'section'  => 'medical_healthcare_elementor_no_result_section',
		'default'  => '<hr>',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_no_results_title_heading',
		'section'     => 'medical_healthcare_elementor_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Title', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_healthcare_elementor_no_results_title',
		'section'  => 'medical_healthcare_elementor_no_result_section',
		'default'  => esc_html__('Nothing Found', 'medical-healthcare-elementor'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_no_results_content_heading',
		'section'     => 'medical_healthcare_elementor_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Content', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_healthcare_elementor_no_results_content',
		'section'  => 'medical_healthcare_elementor_no_result_section',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'medical-healthcare-elementor'),
	] );

	// FOOTER SECTION

	Kirki::add_section( 'medical_healthcare_elementor_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'medical-healthcare-elementor' ),
		'panel'    => 'medical_healthcare_elementor_theme_options_panel',
        'description'    => esc_html__( 'Here you can change copyright text', 'medical-healthcare-elementor' ),
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_footer_text_heading',
		'section'     => 'medical_healthcare_elementor_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_healthcare_elementor_footer_text',
		'section'  => 'medical_healthcare_elementor_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_footer_enable_heading',
		'section'     => 'medical_healthcare_elementor_footer_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_healthcare_elementor_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-healthcare-elementor' ),
			'off' => esc_html__( 'Disable', 'medical-healthcare-elementor' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_footer_background_widget_heading',
		'section'     => 'medical_healthcare_elementor_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Background', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',
	[
		'settings'    => 'medical_healthcare_elementor_footer_background_widget',
		'type'        => 'background',
		'section'     => 'medical_healthcare_elementor_footer_section',
		'default'     => [
			'background-color'      => 'rgba(42, 47, 53,1)',
			'background-image'      => '',
			'background-repeat'     => 'no-repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => '.footer-widget',
			],
		],
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_footer__widget_alignment_heading',
		'section'     => 'medical_healthcare_elementor_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Alignment', 'medical-healthcare-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'medical_healthcare_elementor_footer__widget_alignment',
		'section'     => 'medical_healthcare_elementor_footer_section',
		'default'     => 'left',
		'choices'     => [
			'center' => esc_html__( 'center', 'medical-healthcare-elementor' ),
			'right' => esc_html__( 'right', 'medical-healthcare-elementor' ),
			'left' => esc_html__( 'left', 'medical-healthcare-elementor' ),
		],
		'output' => array(
			array(
				'element'  => '.footer-area',
				'property' => 'text-align',
			),
		),
	 ) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_footer_copright_color_heading',
		'section'     => 'medical_healthcare_elementor_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Background Color', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_footer_copright_color',
		'type'        => 'color',
		'label'       => __( 'Background Color', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_footer_section',
		'transport' => 'auto',
		'default'     => '#2a2f35',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.footer-copyright',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_footer_copright_text_color_heading',
		'section'     => 'medical_healthcare_elementor_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Text Color', 'medical-healthcare-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'medical_healthcare_elementor_footer_copright_text_color',
		'type'        => 'color',
		'label'       => __( 'Text Color', 'medical-healthcare-elementor' ),
		'section'     => 'medical_healthcare_elementor_footer_section',
		'transport' => 'auto',
		'default'     => '#ffffff',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '.footer-copyright a', '.footer-copyright p'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'settings'    => 'medical_healthcare_elementor_logo_settings_premium_features_footer',
		'section'     => 'medical_healthcare_elementor_footer_section',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Elevate your footer with premium features:', 'medical-healthcare-elementor' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Tailor your footer layout', 'medical-healthcare-elementor' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Integrate an email subscription form', 'medical-healthcare-elementor' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Personalize social media icons', 'medical-healthcare-elementor' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'medical-healthcare-elementor' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/elementor/healthcare-wordpress-theme/', 'medical-healthcare-elementor' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'medical-healthcare-elementor' ) .'</a></div>',
	) );
}
