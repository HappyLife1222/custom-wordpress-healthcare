<?php

if ( class_exists("Kirki")){

	// LOGO

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'medical_clinic_lite_logo_resizer',
		'label'       => esc_html__( 'Adjust Your Logo Size ', 'medical-clinic-lite' ),
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
		'settings'    => 'medical_clinic_lite_enable_logo_text',
		'section'     => 'title_tagline',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'medical-clinic-lite' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
		'partial_refresh'    => [
		'medical_clinic_lite_display_header_title' => [
			'selector'        => '.logo a',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'medical-clinic-lite' ),
		'section'     => 'title_tagline',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
		'partial_refresh'    => [
		'medical_clinic_lite_display_header_text' => [
			'selector'        => '.logo-content span',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	// FONT STYLE TYPOGRAPHY

	Kirki::add_panel( 'medical_clinic_lite_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Typography', 'medical-clinic-lite' ),
	) );

	Kirki::add_section( 'medical_clinic_lite_font_style_section', array(
		'title'      => esc_attr__( 'Typography Option',  'medical-clinic-lite' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_all_headings_typography',
		'section'     => 'medical_clinic_lite_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading Of All Sections',  'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'medical_clinic_lite_all_headings_typography',
		'label'       => esc_attr__( 'Heading Typography',  'medical-clinic-lite' ),
		'description' => esc_attr__( 'Select the typography options for your heading.',  'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'h1','h2','h3','h4','h5','h6', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_body_content_typography',
		'section'     => 'medical_clinic_lite_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Body Content',  'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'medical_clinic_lite_body_content_typography',
		'label'       => esc_attr__( 'Content Typography',  'medical-clinic-lite' ),
		'description' => esc_attr__( 'Select the typography options for your content.',  'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'body', ),
			),
		),
	) );

	// Additional Settings

	Kirki::add_section( 'medical_clinic_lite_additional_settings', array(
	    'title'          => esc_html__( 'Additional Settings', 'medical-clinic-lite' ),
	    'description'    => esc_html__( 'Scroll To Top', 'medical-clinic-lite' ),
	    'panel'          => 'medical_clinic_lite_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_clinic_lite_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_additional_settings',
		'default'     => '1',
		'priority'    => 10,
		'partial_refresh'    => [
		'medical_clinic_lite_scroll_enable_setting' => [
			'selector'        => '.scroll-up a',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	new \Kirki\Field\Radio_Buttonset(
		[
			'settings'    => 'medical_clinic_lite_scroll_top_position',
			'label'       => esc_html__( 'Alignment for Scroll To Top', 'medical-clinic-lite' ),
			'section'     => 'medical_clinic_lite_additional_settings',
			'default'     => 'Right',
			'priority'    => 10,
			'choices'     => [
				'Left'   => esc_html__( 'Left', 'medical-clinic-lite' ),
				'Center' => esc_html__( 'Center', 'medical-clinic-lite' ),
				'Right'  => esc_html__( 'Right', 'medical-clinic-lite' ),
			],
		]
		);

	new \Kirki\Field\Select(
	[
		'settings'    => 'menu_text_transform_medical_clinic_lite',
		'label'       => esc_html__( 'Menus Text Transform', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_additional_settings',
		'default'     => 'CAPITALISE',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'CAPITALISE' => esc_html__( 'CAPITALISE', 'medical-clinic-lite' ),
			'UPPERCASE' => esc_html__( 'UPPERCASE', 'medical-clinic-lite' ),
			'LOWERCASE' => esc_html__( 'LOWERCASE', 'medical-clinic-lite' ),

		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'medical_clinic_lite_container_width',
		'label'       => esc_html__( 'Theme Container Width', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_additional_settings',
		'default'     => 100,
		'choices'     => [
			'min'  => 50,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_clinic_lite_site_loader',
		'label'       => esc_html__( 'Here you can enable or disable your Site Loader.', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_additional_settings',
		'default'     => false,
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_page_layout',
		'label'       => esc_html__( 'Page Layout Setting', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_additional_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','medical-clinic-lite'),
            'Right Sidebar' => __('Right Sidebar','medical-clinic-lite'),
            'One Column' => __('One Column','medical-clinic-lite')
		],
	] );

	if ( class_exists("woocommerce")){

	// Woocommerce Settings

	Kirki::add_section( 'medical_clinic_lite_woocommerce_settings', array(
			'title'          => esc_html__( 'Woocommerce Settings', 'medical-clinic-lite' ),
			'description'    => esc_html__( 'Shop Page', 'medical-clinic-lite' ),
			'panel'          => 'medical_clinic_lite_panel_id',
			'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_clinic_lite_shop_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable shop page sidebar.', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_clinic_lite_product_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable product page sidebar.', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_clinic_lite_related_product_setting',
		'label'       => esc_html__( 'Here you can enable or disable your related products.', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_woocommerce_settings',
		'default'     => true,
		'priority'    => 10,
	] );

	new \Kirki\Field\Number(
	[
		'settings' => 'medical_clinic_lite_per_columns',
		'label'    => esc_html__( 'Product Per Row', 'medical-clinic-lite' ),
		'section'  => 'medical_clinic_lite_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'medical_clinic_lite_product_per_page',
		'label'    => esc_html__( 'Product Per Page', 'medical-clinic-lite' ),
		'section'  => 'medical_clinic_lite_woocommerce_settings',
		'default'  => 9,
		'choices'  => [
			'min'  => 1,
			'max'  => 15,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number_per_row',
		'label'    => esc_html__( 'Related Product Per Column', 'medical-clinic-lite' ),
		'section'  => 'medical_clinic_lite_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number',
		'label'    => esc_html__( 'Related Product Per Page', 'medical-clinic-lite' ),
		'section'  => 'medical_clinic_lite_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_shop_page_layout',
		'label'       => esc_html__( 'Shop Page Layout Setting', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','medical-clinic-lite'),
            'Right Sidebar' => __('Right Sidebar','medical-clinic-lite')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_product_page_layout',
		'label'       => esc_html__( 'Product Page Layout Setting', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','medical-clinic-lite'),
            'Right Sidebar' => __('Right Sidebar','medical-clinic-lite')
		],
	] );

}

	// COLOR SECTION

	Kirki::add_section( 'medical_clinic_lite_section_color', array(
	    'title'          => esc_html__( 'Global Color', 'medical-clinic-lite' ),
	    'description'    => esc_html__( 'Theme Color Settings', 'medical-clinic-lite' ),
	    'panel'          => 'medical_clinic_lite_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_global_colors',
		'section'     => 'medical_clinic_lite_section_color',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Here you can change your theme color on one click.', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'medical_clinic_lite_global_color',
		'label'       => __( 'choose your Appropriate Color', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_color',
		'default'     => '#0da7bb',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'medical_clinic_lite_global_color_2',
		'label'       => __( 'Choose Your Second Color', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_color',
		'default'     => '#f95759',
	] );

	// PANEL

	Kirki::add_panel( 'medical_clinic_lite_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Options', 'medical-clinic-lite' ),
	) );

	// POST SECTION

	Kirki::add_section( 'medical_clinic_lite_section_post', array(
	    'title'          => esc_html__( 'Post Settings', 'medical-clinic-lite' ),
	    'description'    => esc_html__( 'Here you can get different post settings', 'medical-clinic-lite' ),
	    'panel'          => 'medical_clinic_lite_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_enable_post_heading',
		'section'     => 'medical_clinic_lite_section_post',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Post Settings.', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
		'partial_refresh'    => [
		'medical_clinic_lite_enable_post_heading' => [
			'selector'        => 'h3.post-title',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_blog_admin_enable',
		'label'       => esc_html__( 'Post Author Enable / Disable Button', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_blog_comment_enable',
		'label'       => esc_html__( 'Post Comment Enable / Disable Button', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'medical_clinic_lite_post_excerpt_number',
		'label'       => esc_html__( 'Post Content Range', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default'     => 15,
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'medical_clinic_lite_pagination_setting',
		'label'       => esc_html__( 'Here you can enable or disable your Pagination.', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default'     => true,
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_archive_sidebar_layout',
		'label'       => esc_html__( 'Archive Post Sidebar Layout Setting', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','medical-clinic-lite'),
            'Right Sidebar' => __('Right Sidebar','medical-clinic-lite')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_single_post_sidebar_layout',
		'label'       => esc_html__( 'Single Post Sidebar Layout Setting', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','medical-clinic-lite'),
            'Right Sidebar' => __('Right Sidebar','medical-clinic-lite')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_search_sidebar_layout',
		'label'       => esc_html__( 'Search Page Sidebar Layout Setting', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','medical-clinic-lite'),
            'Right Sidebar' => __('Right Sidebar','medical-clinic-lite')
		],
	] );

	Kirki::add_field( 'medical_clinic_lite_config', [
		'type'        => 'select',
		'settings'    => 'medical_clinic_lite_post_column_count',
		'label'       => esc_html__( 'Grid Column for Archive Page', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_section_post',
		'default'    => '2',
		'choices' => [
				'1' => __( '1 Column', 'medical-clinic-lite' ),
				'2' => __( '2 Column', 'medical-clinic-lite' ),
				'3' => __( '3 Column', 'medical-clinic-lite' ),
				'4' => __( '4 Column', 'medical-clinic-lite' ),
			],
	] );


	// HEADER SECTION

	Kirki::add_section( 'medical_clinic_lite_section_header', array(
	    'title'          => esc_html__( 'Header Settings', 'medical-clinic-lite' ),
	    'description'    => esc_html__( 'Here you can add header information.', 'medical-clinic-lite' ),
	    'panel'          => 'medical_clinic_lite_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_header_announcement_alert_text_heading',
		'section'     => 'medical_clinic_lite_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Alert Text', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_header_announcement_alert_text',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
		'partial_refresh'    => [
		'medical_clinic_lite_header_announcement_alert_text' => [
			'selector'        => '.top-header span',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_header_announcement_text_heading',
		'section'     => 'medical_clinic_lite_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Announcement Text', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_header_announcement_text',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_phone_number_heading',
		'section'     => 'medical_clinic_lite_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Phone Number', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_header_phone_number',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_phone_icon',
		'section'     => 'medical_clinic_lite_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Choose Your Icon Here', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'medical_clinic_lite_dashicons_setting_1',
		'label'    => esc_html__( 'Select Appropriate Icon', 'medical-clinic-lite' ),
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => 'dashicons dashicons-clock',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_opening_time_heading',
		'section'     => 'medical_clinic_lite_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Opening Time', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_opening_time',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_opening_time_text',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
		'partial_refresh'    => [
		'medical_clinic_lite_opening_time_text' => [
			'selector'        => '.center-header h6',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_phone_icon_2',
		'section'     => 'medical_clinic_lite_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Choose Your Icon Here', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'medical_clinic_lite_dashicons_setting_2',
		'label'    => esc_html__( 'Select Appropriate Icon', 'medical-clinic-lite' ),
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => 'dashicons dashicons-location',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_location_heading',
		'section'     => 'medical_clinic_lite_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Location', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_location',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_location_text',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_header_appointment_button_heading',
		'section'     => 'medical_clinic_lite_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Appointment Button', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'       => esc_html__( 'Text', 'medical-clinic-lite' ),
		'settings' => 'medical_clinic_lite_header_text_appointment_button',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
		'partial_refresh'    => [
		'medical_clinic_lite_header_text_appointment_button' => [
			'selector'        => 'a.appoint-btn',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'url',
		'label'       => esc_html__( 'URL', 'medical-clinic-lite' ),
		'settings' => 'medical_clinic_lite_header_url_appointment_button',
		'section'  => 'medical_clinic_lite_section_header',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_enable_socail_link',
		'section'     => 'medical_clinic_lite_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'medical_clinic_lite_section_header',
		'priority'    => 10,
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Social Icon', 'medical-clinic-lite' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'medical-clinic-lite' ),
		'settings'     => 'medical_clinic_lite_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'medical-clinic-lite' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'medical-clinic-lite' ),
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'medical-clinic-lite' ),
				'description' => esc_html__( 'Add the social icon url here.', 'medical-clinic-lite' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 5
		],
		'partial_refresh'    => [
		'medical_clinic_lite_social_links_settings' => [
			'selector'        => '.social-links a',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	// SLIDER SECTION

	Kirki::add_section( 'medical_clinic_lite_blog_slide_section', array(
        'title'          => esc_html__( ' Slider Settings', 'medical-clinic-lite' ),
        'description'    => esc_html__( 'You have to select post category to show slider.', 'medical-clinic-lite' ),
        'panel'          => 'medical_clinic_lite_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_enable_heading',
		'section'     => 'medical_clinic_lite_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Slider', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_blog_box_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_title_unable_disable',
		'label'       => esc_html__( 'Slide Title Enable / Disable', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_button_unable_disable',
		'label'       => esc_html__( 'Slide Button Enable / Disable', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_slider_heading',
		'section'     => 'medical_clinic_lite_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Slider', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'medical_clinic_lite_blog_slide_number',
		'label'       => esc_html__( 'Number of slides to show', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => 0,
		'choices'     => [
			'min'  => 1,
			'max'  => 5,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'settings'    => 'medical_clinic_lite_blog_slide_category',
		'label'       => esc_html__( 'Select the category to show slider ( Image Dimension 1600 x 600 )', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => '',
		'placeholder' => esc_html__( 'Select an category...', 'medical-clinic-lite' ),
		'priority'    => 10,
		'choices'     => medical_clinic_lite_get_categories_select(),
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_slider_short_heading',
		'section'     => 'medical_clinic_lite_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Slider Sub Title', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
		'partial_refresh'    => [
		'medical_clinic_lite_slider_short_heading' => [
			'selector'        => '.blog_box h3',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_slider_short_title',
		'section'  => 'medical_clinic_lite_blog_slide_section',
		'priority' => 10,
    ] );

		Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_enable_heading_22',
		'section'     => 'medical_clinic_lite_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Content Alignment', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

		new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_slider_content_alignment',
		'label'       => esc_html__( 'Slider Content Alignment', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'medical-clinic-lite' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'medical-clinic-lite' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'medical-clinic-lite' ),

		],
	] );

		new \Kirki\Field\Select(
	[
		'settings'    => 'medical_clinic_lite_slider_opacity_color',
		'label'       => esc_html__( 'Slider Opacity Option', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => '0.6',
		'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
		'choices'     => [
			'0' => esc_html__( '0', 'medical-clinic-lite' ),
			'0.1' => esc_html__( '0.1', 'medical-clinic-lite' ),
			'0.2' => esc_html__( '0.2', 'medical-clinic-lite' ),
			'0.3' => esc_html__( '0.3', 'medical-clinic-lite' ),
			'0.4' => esc_html__( '0.4', 'medical-clinic-lite' ),
			'0.5' => esc_html__( '0.5', 'medical-clinic-lite' ),
			'0.6' => esc_html__( '0.6', 'medical-clinic-lite' ),
			'0.7' => esc_html__( '0.7', 'medical-clinic-lite' ),
			'0.8' => esc_html__( '0.8', 'medical-clinic-lite' ),
			'0.9' => esc_html__( '0.9', 'medical-clinic-lite' ),
			'1.0' => esc_html__( '1.0', 'medical-clinic-lite' ),
			

		],
	] );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_overlay_option',
		'label'       => esc_html__( 'Enable / Disable Slider Overlay', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
	] );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'medical_clinic_lite_slider_image_overlay_color',
		'label'       => __( 'choose your Appropriate Overlay Color', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_blog_slide_section',
		'default'     => '',
	] );


	// ABOUT US SECTION

	Kirki::add_section( 'medical_clinic_lite_about_us_section', array(
        'title'          => esc_html__( 'About Us Settings', 'medical-clinic-lite' ),
        'description'    => esc_html__( 'You have to select page to show about us section.', 'medical-clinic-lite' ),
        'panel'          => 'medical_clinic_lite_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_about_us_section_enable_heading',
		'section'     => 'medical_clinic_lite_about_us_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable About Us Section', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'medical_clinic_lite_about_us_section_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_about_us_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'medical-clinic-lite' ),
			'off' => esc_html__( 'Disable', 'medical-clinic-lite' ),
		],
		'partial_refresh'    => [
		'medical_clinic_lite_about_us_section_enable' => [
			'selector'        => '#about h4',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_about_us_section_title_heading',
		'section'     => 'medical_clinic_lite_about_us_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Section Title', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_about_us_section_title',
		'section'  => 'medical_clinic_lite_about_us_section',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_about_us_page_heading',
		'section'     => 'medical_clinic_lite_about_us_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Page Dropdown', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'dropdown-pages',
		'settings'    => 'medical_clinic_lite_about_us',
		'section'     => 'medical_clinic_lite_about_us_section',
		'default'     => 42,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_about_excerpt_heading',
		'section'     => 'medical_clinic_lite_about_us_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Number Of Text', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'medical_clinic_lite_about_excerpt_number',
		'label'       => esc_html__( 'Number of text to show', 'medical-clinic-lite' ),
		'section'     => 'medical_clinic_lite_about_us_section',
		'default'     => 60,
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
	] );

	// FOOTER SECTION

	Kirki::add_section( 'medical_clinic_lite_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'medical-clinic-lite' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'medical-clinic-lite' ),
        'panel'          => 'medical_clinic_lite_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_footer_text_heading',
		'section'     => 'medical_clinic_lite_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'medical_clinic_lite_footer_text',
		'section'  => 'medical_clinic_lite_footer_section',
		'default'  => '',
		'priority' => 10,
		'partial_refresh'    => [
		'medical_clinic_lite_footer_text' => [
			'selector'        => '.copy-text p',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			},
		],
	],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_footer_text_heading_2',
		'section'     => 'medical_clinic_lite_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Alignment', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
		] );

		new \Kirki\Field\Select(
		[
			'settings'    => 'medical_clinic_lite_copyright_text_alignment',
			'label'       => esc_html__( 'Copyright text Alignment', 'medical-clinic-lite' ),
			'section'     => 'medical_clinic_lite_footer_section',
			'default'     => 'LEFT-ALIGN',
			'placeholder' => esc_html__( 'Choose an option', 'medical-clinic-lite' ),
			'choices'     => [
				'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'medical-clinic-lite' ),
				'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'medical-clinic-lite' ),
				'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'medical-clinic-lite' ),

			],
		] );

		Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'medical_clinic_lite_footer_text_heading_1',
		'section'     => 'medical_clinic_lite_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Background Color', 'medical-clinic-lite' ) . '</h3>',
		'priority'    => 10,
		] );

		Kirki::add_field( 'theme_config_id', [
			'type'        => 'color',
			'settings'    => 'medical_clinic_lite_copyright_bg',
			'label'       => __( 'Choose Your Copyright Background Color', 'medical-clinic-lite' ),
			'section'     => 'medical_clinic_lite_footer_section',
			'default'     => '',
		] );
}
