<?php
/**
 * Online Pharmacy: Customizer
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function online_pharmacy_customize_register( $wp_customize ) {

	require get_parent_theme_file_path('/inc/controls/icon-changer.php');

	require get_parent_theme_file_path('/inc/controls/range-slider-control.php');

	// Register the custom control type.
	$wp_customize->register_control_type( 'Online_Pharmacy_Toggle_Control' );

	//Register the sortable control type.
	$wp_customize->register_control_type( 'Online_Pharmacy_Control_Sortable' );

	//add home page setting pannel
	$wp_customize->add_panel( 'online_pharmacy_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Custom Home page', 'online-pharmacy'),
	    'description' => __( 'Description of what this panel does.', 'online-pharmacy'),
	) );

	$wp_customize->add_section('online_pharmacy_mobile_media_option',array(
		'title'         => __('Mobile Responsive media', 'online-pharmacy'),
		'priority' => 22,
		'panel' => 'online_pharmacy_panel_id'
	) );

	$wp_customize->add_setting( 'online_pharmacy_return_to_header_mob', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_return_to_header_mob', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'online-pharmacy'),
		'section'     => 'online_pharmacy_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_return_to_header_mob',
	) ) );

	$wp_customize->add_setting( 'online_pharmacy_slider_buttom_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_slider_buttom_mob', array(
		'label'       => esc_html__( 'Show / Hide Slider Button', 'online-pharmacy'),
		'section'     => 'online_pharmacy_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_slider_buttom_mob',
	) ) );

	//Sidebar Position
	$wp_customize->add_section('online_pharmacy_tp_general_settings',array(
        'title' => __('TP General Option', 'online-pharmacy'),
        'priority' => 2,
        'panel' => 'online_pharmacy_panel_id'
    ) );

 	$wp_customize->add_setting('online_pharmacy_tp_body_layout_settings',array(
		'default' => 'Full',
		'sanitize_callback' => 'online_pharmacy_sanitize_choices'
	));
 	$wp_customize->add_control('online_pharmacy_tp_body_layout_settings',array(
		'type' => 'radio',
		'label'     => __('Body Layout Setting', 'online-pharmacy'),
		'description'   => __('This option work for complete body, if you want to set the complete website in container.', 'online-pharmacy'),
		'section' => 'online_pharmacy_tp_general_settings',
		'choices' => array(
		'Full' => __('Full','online-pharmacy'),
		'Container' => __('Container','online-pharmacy'),
		'Container Fluid' => __('Container Fluid','online-pharmacy')
		),
	) );

   // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('online_pharmacy_sidebar_post_layout',array(
     'default' => 'right',
     'sanitize_callback' => 'online_pharmacy_sanitize_choices'
	));
	$wp_customize->add_control('online_pharmacy_sidebar_post_layout',array(
     'type' => 'radio',
     'label'     => __('Post Sidebar Position', 'online-pharmacy'),
     'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'online-pharmacy'),
     'section' => 'online_pharmacy_tp_general_settings',
     'choices' => array(
         'full' => __('Full','online-pharmacy'),
         'left' => __('Left','online-pharmacy'),
         'right' => __('Right','online-pharmacy'),
         'three-column' => __('Three Columns','online-pharmacy'),
         'four-column' => __('Four Columns','online-pharmacy'),
         'grid' => __('Grid Layout','online-pharmacy')
     ),
	) );
	// Add Settings and Controls for Post sidebar Layout
	$wp_customize->add_setting('online_pharmacy_sidebar_single_post_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'online_pharmacy_sanitize_choices'
	));
	$wp_customize->add_control('online_pharmacy_sidebar_single_post_layout',array(
        'type' => 'radio',
        'label'     => __('Single Post Sidebar Position', 'online-pharmacy'),
        'description'   => __('This option work for single blog page', 'online-pharmacy'),
        'section' => 'online_pharmacy_tp_general_settings',
        'choices' => array(
            'full' => __('Full','online-pharmacy'),
            'left' => __('Left','online-pharmacy'),
            'right' => __('Right','online-pharmacy'),
        ),
	) );
	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('online_pharmacy_sidebar_page_layout',array(
     'default' => 'right',
     'sanitize_callback' => 'online_pharmacy_sanitize_choices'
	));
	$wp_customize->add_control('online_pharmacy_sidebar_page_layout',array(
     'type' => 'radio',
     'label'     => __('Page Sidebar Position', 'online-pharmacy'),
     'description'   => __('This option work for pages.', 'online-pharmacy'),
     'section' => 'online_pharmacy_tp_general_settings',
     'choices' => array(
         'full' => __('Full','online-pharmacy'),
         'left' => __('Left','online-pharmacy'),
         'right' => __('Right','online-pharmacy')
     ),
	) );	
	$wp_customize->add_setting( 'online_pharmacy_sticky', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_sticky', array(
		'label'       => esc_html__( 'Show / Hide Sticky Header', 'online-pharmacy'),
		'section'     => 'online_pharmacy_tp_general_settings',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_sticky',
	) ) );

	  	//MENU TYPOGRAPHY
	$wp_customize->add_section( 'online_pharmacy_menu_typography', array(
    	'title'      => __( 'Menu Typography', 'online-pharmacy'),
    	'priority' => 10,
		'panel' => 'online_pharmacy_panel_id'
	) );

	$wp_customize->add_setting('online_pharmacy_menu_text_tranform',array(
		'default' => 'Uppercase',
		'sanitize_callback' => 'online_pharmacy_sanitize_choices'
 	));
 	$wp_customize->add_control('online_pharmacy_menu_text_tranform',array(
		'type' => 'select',
		'label' => __('Menu Text Transform','online-pharmacy'),
		'section' => 'online_pharmacy_menu_typography',
		'choices' => array(
		   'Uppercase' => __('Uppercase','online-pharmacy'),
		   'Lowercase' => __('Lowercase','online-pharmacy'),
		   'Capitalize' => __('Capitalize','online-pharmacy'),
		),
	) );


	$wp_customize->add_setting('online_pharmacy_menu_font_size', array(
	'default' => 10,
    'sanitize_callback' => 'online_pharmacy_sanitize_number_range',
	));

	$wp_customize->add_control(new Online_Pharmacy_Range_Slider($wp_customize, 'online_pharmacy_menu_font_size', array(
    'section' => 'online_pharmacy_menu_typography',
    'label' => esc_html__('Font Size', 'online-pharmacy'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 20,
        'step' => 1
    )
	)));

	//TP Blog Option
	$wp_customize->add_section('online_pharmacy_blog_option',array(
		'title' => __('TP Blog Option', 'online-pharmacy'),
		'priority' => 8,
		'panel' => 'online_pharmacy_panel_id'
	) );
	/** Meta Order */
    $wp_customize->add_setting('blog_meta_order', array(
        'default' => array('date', 'author', 'comment', 'category'),
        'sanitize_callback' => 'online_pharmacy_sanitize_sortable',
    ));
    $wp_customize->add_control(new Online_Pharmacy_Control_Sortable($wp_customize, 'blog_meta_order', array(
    	'label' => esc_html__('Meta Order', 'online-pharmacy'),
        'description' => __('Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'online-pharmacy') ,
        'section' => 'online_pharmacy_blog_option',
        'choices' => array(
            'date' => __('date', 'online-pharmacy') ,
            'author' => __('author', 'online-pharmacy') ,
            'comment' => __('comment', 'online-pharmacy') ,
            'category' => __('category', 'online-pharmacy') ,
        ) ,
    )));
    $wp_customize->add_setting( 'online_pharmacy_excerpt_count', array(
		'default'              => 35,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'online_pharmacy_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'online_pharmacy_excerpt_count', array(
		'label'       => esc_html__( 'Edit Excerpt Limit','online-pharmacy'),
		'section'     => 'online_pharmacy_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );
	$wp_customize->add_setting('online_pharmacy_read_more_text',array(
		'default'=> __('Read More','online-pharmacy'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('online_pharmacy_read_more_text',array(
		'label'	=> __('Edit Button Text','online-pharmacy'),
		'section'=> 'online_pharmacy_blog_option',
		'type'=> 'text'
	));
	$wp_customize->add_setting( 'online_pharmacy_remove_read_button', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_remove_read_button', array(
		'label'       => esc_html__( 'Show / Hide Read More Button', 'online-pharmacy'),
		'section'     => 'online_pharmacy_blog_option',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_remove_read_button',
	) ) );
    $wp_customize->selective_refresh->add_partial( 'online_pharmacy_remove_read_button', array(
		'selector' => '.readmore-btn',
		'render_callback' => 'online_pharmacy_customize_partial_online_pharmacy_remove_read_button',
	 ));
     $wp_customize->add_setting( 'online_pharmacy_remove_tags', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
 	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_remove_tags', array(
		 'label'       => esc_html__( 'Show / Hide Tags Option', 'online-pharmacy'),
		 'section'     => 'online_pharmacy_blog_option',
		 'type'        => 'toggle',
		 'settings'    => 'online_pharmacy_remove_tags',
	) ) );
	$wp_customize->selective_refresh->add_partial( 'online_pharmacy_remove_tags', array(
		'selector' => '.box-content a[rel="tag"]',
		'render_callback' => 'online_pharmacy_customize_partial_online_pharmacy_remove_tags',
	));
	$wp_customize->add_setting( 'online_pharmacy_remove_category', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_remove_category', array(
		'label'       => esc_html__( 'Show / Hide Category Option', 'online-pharmacy' ),
		'section'     => 'online_pharmacy_blog_option',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_remove_category',
	) ) );
    $wp_customize->selective_refresh->add_partial( 'online_pharmacy_remove_category', array(
		'selector' => '.box-content a[rel="category"]',
		'render_callback' => 'online_pharmacy_customize_partial_online_pharmacy_remove_category',
	));
	$wp_customize->add_setting( 'online_pharmacy_remove_comment', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
 	) );

	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_remove_comment', array(
	 'label'       => esc_html__( 'Show / Hide Comment Form', 'online-pharmacy' ),
	 'section'     => 'online_pharmacy_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'online_pharmacy_remove_comment',
	) ) );

	$wp_customize->add_setting( 'online_pharmacy_remove_related_post', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
 	) );

	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_remove_related_post', array(
	 'label'       => esc_html__( 'Show / Hide Related Post', 'online-pharmacy' ),
	 'section'     => 'online_pharmacy_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'online_pharmacy_remove_related_post',
	) ) );
	$wp_customize->add_setting( 'online_pharmacy_related_post_per_page', array(
		'default'              => 3,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'online_pharmacy_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'online_pharmacy_related_post_per_page', array(
		'label'       => esc_html__( 'Related Post Per Page','online-pharmacy' ),
		'section'     => 'online_pharmacy_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 3,
			'max'              => 9,
		),
	) );

	//TP Preloader Option
	$wp_customize->add_section('online_pharmacy_prelaoder_option',array(
		'title'         => __('TP Preloader Option', 'online-pharmacy'),
		'priority' => 4,
		'panel' => 'online_pharmacy_panel_id'
	) );

	$wp_customize->add_setting( 'online_pharmacy_preloader_show_hide', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_preloader_show_hide', array(
		'label'       => esc_html__( 'Show / Hide Preloader Option', 'online-pharmacy'),
		'section'     => 'online_pharmacy_prelaoder_option',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_preloader_show_hide',
	) ) );

	$wp_customize->add_setting( 'online_pharmacy_tp_preloader_color1_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_pharmacy_tp_preloader_color1_option', array(
			'label'     => __('Preloader First Ring Color', 'online-pharmacy'),
	    'description' => __('It will change the complete theme preloader ring 1 color in one click.', 'online-pharmacy'),
	    'section' => 'online_pharmacy_prelaoder_option',
	    'settings' => 'online_pharmacy_tp_preloader_color1_option',
  	)));

  	$wp_customize->add_setting( 'online_pharmacy_tp_preloader_color2_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_pharmacy_tp_preloader_color2_option', array(
			'label'     => __('Preloader Second Ring Color', 'online-pharmacy'),
	    'description' => __('It will change the complete theme preloader ring 2 color in one click.', 'online-pharmacy'),
	    'section' => 'online_pharmacy_prelaoder_option',
	    'settings' => 'online_pharmacy_tp_preloader_color2_option',
  	)));

  	$wp_customize->add_setting( 'online_pharmacy_tp_preloader_bg_color_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_pharmacy_tp_preloader_bg_color_option', array(
			'label'     => __('Preloader Background Color', 'online-pharmacy'),
	    'description' => __('It will change the complete theme preloader bg color in one click.', 'online-pharmacy'),
	    'section' => 'online_pharmacy_prelaoder_option',
	    'settings' => 'online_pharmacy_tp_preloader_bg_color_option',
  	)));


	// Top Bar
	$wp_customize->add_section( 'online_pharmacy_topbar', array(
    	'title'      => __( 'Contact Details', 'online-pharmacy'),
    	'priority' => 12,
    	'description' => __( 'Add your contact details', 'online-pharmacy'),
		'panel' => 'online_pharmacy_panel_id'
	) );

	$wp_customize->add_setting('online_pharmacy_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'online_pharmacy_sanitize_phone_number'
	));
	$wp_customize->add_control('online_pharmacy_phone_number',array(
		'label'	=> __('Add Phone Number','online-pharmacy'),
		'section'=> 'online_pharmacy_topbar',
		'type'=> 'text'
	));

	 $wp_customize->add_setting('online_pharmacy_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_phone_icon',array(
		'label'	=> __('Phone Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->selective_refresh->add_partial( 'online_pharmacy_phone_number', array(
		'selector' => '.top-header span i',
		'render_callback' => 'online_pharmacy_customize_partial_online_pharmacy_phone_number',
	) );

	$wp_customize->add_setting('online_pharmacy_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('online_pharmacy_email_address',array(
		'label'	=> __('Add Email Address','online-pharmacy'),
		'section'=> 'online_pharmacy_topbar',
		'type'=> 'text'
	));

	 $wp_customize->add_setting('online_pharmacy_mail_icon',array(
		'default'	=> 'fas fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_mail_icon',array(
		'label'	=> __('Mail Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('online_pharmacy_my_account_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('online_pharmacy_my_account_link',array(
		'label'	=> __('Add My Account Page Link','online-pharmacy'),
		'section'=> 'online_pharmacy_topbar',
		'type'=> 'url'
	));

	$wp_customize->add_setting('online_pharmacy_book_ticket_button',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('online_pharmacy_book_ticket_button',array(
		'label'	=> __('Add Header Button Text','online-pharmacy'),
		'section'=> 'online_pharmacy_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('online_pharmacy_book_ticket_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('online_pharmacy_book_ticket_link',array(
		'label'	=> __('Add Header Page Link','online-pharmacy'),
		'section'=> 'online_pharmacy_topbar',
		'type'=> 'url'
	));
	 if(class_exists('woocommerce')){
	$wp_customize->add_setting( 'online_pharmacy_shopping_bag', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_shopping_bag', array(
		'label'       => esc_html__( ' show Shopping Bag', 'online-pharmacy'),
		'section'     => 'online_pharmacy_topbar',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_shopping_bag',
	) ) );
}
	// Social Media
	$wp_customize->add_section( 'online_pharmacy_social_media', array(
    	'title'      => __( 'Social Media Links', 'online-pharmacy'),
    	'priority' => 14,
    	'description' => __( 'Add your Social Links', 'online-pharmacy'),
		'panel' => 'online_pharmacy_panel_id'
	) );

	$wp_customize->add_setting( 'online_pharmacy_header_fb_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_header_fb_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'online-pharmacy'),
		'section'     => 'online_pharmacy_social_media',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_header_fb_new_tab',
	) ) );

	$wp_customize->add_setting('online_pharmacy_facebook_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('online_pharmacy_facebook_url',array(
		'label'	=> __('Facebook Link','online-pharmacy'),
		'section'=> 'online_pharmacy_social_media',
		'type'=> 'url'
	));
	 $wp_customize->add_setting('online_pharmacy_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_facebook_icon',array(
		'label'	=> __('Facebook Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_social_media',
		'type'		=> 'icon'
	)));
	$wp_customize->selective_refresh->add_partial( 'online_pharmacy_facebook_url', array(
		'selector' => '.media-links a i',
		'render_callback' => 'online_pharmacy_customize_partial_online_pharmacy_facebook_url',
	) );

	$wp_customize->add_setting( 'online_pharmacy_header_twt_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_header_twt_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'online-pharmacy'),
		'section'     => 'online_pharmacy_social_media',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_header_twt_new_tab',
	) ) );

	$wp_customize->add_setting('online_pharmacy_twitter_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('online_pharmacy_twitter_url',array(
		'label'	=> __('Twitter Link','online-pharmacy'),
		'section'=> 'online_pharmacy_social_media',
		'type'=> 'url'
	));
	 $wp_customize->add_setting('online_pharmacy_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_twitter_icon',array(
		'label'	=> __('Twitter Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'online_pharmacy_header_ins_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_header_ins_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'online-pharmacy'),
		'section'     => 'online_pharmacy_social_media',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_header_ins_new_tab',
	) ) );

	$wp_customize->add_setting('online_pharmacy_instagram_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('online_pharmacy_instagram_url',array(
		'label'	=> __('Instagram Link','online-pharmacy'),
		'section'=> 'online_pharmacy_social_media',
		'type'=> 'url'
	));

	 $wp_customize->add_setting('online_pharmacy_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_instagram_icon',array(
		'label'	=> __('Instagram Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'online_pharmacy_header_ut_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_header_ut_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'online-pharmacy'),
		'section'     => 'online_pharmacy_social_media',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_header_ut_new_tab',
	) ) );

	$wp_customize->add_setting('online_pharmacy_youtube_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('online_pharmacy_youtube_url',array(
		'label'	=> __('YouTube Link','online-pharmacy'),
		'section'=> 'online_pharmacy_social_media',
		'type'=> 'url'
	));

	 $wp_customize->add_setting('online_pharmacy_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_youtube_icon',array(
		'label'	=> __('YouTube Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'online_pharmacy_header_pint_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_header_pint_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'online-pharmacy'),
		'section'     => 'online_pharmacy_social_media',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_header_pint_new_tab',
	) ) );

	$wp_customize->add_setting('online_pharmacy_pint_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('online_pharmacy_pint_url',array(
		'label'	=> __('Pinterest Link','online-pharmacy'),
		'section'=> 'online_pharmacy_social_media',
		'type'=> 'url'
	));

	 $wp_customize->add_setting('online_pharmacy_pinterest_icon',array(
		'default'	=> 'fab fa-pinterest',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_pinterest_icon',array(
		'label'	=> __('Pinterest Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('online_pharmacy_social_icon_fontsize',array(
	'default'=> '14',
	'sanitize_callback'	=> 'online_pharmacy_sanitize_number_absint'
	));
	$wp_customize->add_control('online_pharmacy_social_icon_fontsize',array(
		'label'	=> __('Social Icons Font Size in PX','online-pharmacy'),
		'type'=> 'number',
		'section'=> 'online_pharmacy_social_media',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 100,
				),
	));

	//home page slider
	$wp_customize->add_section( 'online_pharmacy_slider_section' , array(
    	'title'      => __( 'Slider Section', 'online-pharmacy'),
    	'priority' => 16,
		'panel' => 'online_pharmacy_panel_id'
	) );

	$wp_customize->add_setting( 'online_pharmacy_slider_arrows', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_slider_arrows', array(
		'label'       => esc_html__( 'Show / Hide Slider', 'online-pharmacy'),
		'priority' => 1,
		'section'     => 'online_pharmacy_slider_section',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_slider_arrows',
	) ) );

 	$wp_customize->selective_refresh->add_partial( 'online_pharmacy_slider_arrows', array(
		'selector' => '#slider .carousel-caption',
		'render_callback' => 'online_pharmacy_customize_partial_online_pharmacy_slider_arrows',
	) );

	for ( $online_pharmacy_count = 1; $online_pharmacy_count <= 4; $online_pharmacy_count++ ) {

		$wp_customize->add_setting( 'online_pharmacy_slider_page' . $online_pharmacy_count, array(
			'default'           => '',
			'sanitize_callback' => 'online_pharmacy_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'online_pharmacy_slider_page' . $online_pharmacy_count, array(
			'label'    => __( 'Select Slide Image Page', 'online-pharmacy'),
			'priority' => 1,
			'description' => __('Image Size ( 1835 x 700 ) px','online-pharmacy'),
			'section'  => 'online_pharmacy_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('online_pharmacy_slider_content_layout',array(
        'default' => 'CENTER-ALIGN',
        'sanitize_callback' => 'online_pharmacy_sanitize_choices'
	));
	$wp_customize->add_control('online_pharmacy_slider_content_layout',array(
        'type' => 'radio',
        'label'     => __('Slider Content Layout', 'online-pharmacy'),
        'section' => 'online_pharmacy_slider_section',
        'choices' => array(
            'CENTER-ALIGN' => __('CENTER-ALIGN','online-pharmacy'),
            'LEFT-ALIGN' => __('LEFT-ALIGN','online-pharmacy'),
            'RIGHT-ALIGN' => __('RIGHT-ALIGN','online-pharmacy'),
        ),
	) );

	//footer
	$wp_customize->add_section('online_pharmacy_footer_section',array(
		'title'	=> __('Footer Text','online-pharmacy'),
		'priority' => 18,
		'description'	=> __('Add copyright text.','online-pharmacy'),
		'panel' => 'online_pharmacy_panel_id'
	));

	$wp_customize->add_setting('online_pharmacy_footer_widget_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'online_pharmacy_footer_widget_image',array(
    'label' => __('Footer Widget Background Image','online-pharmacy'),
    'section' => 'online_pharmacy_footer_section'
	)));

	$wp_customize->add_setting('online_pharmacy_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('online_pharmacy_footer_text',array(
		'label'	=> __('Copyright Text','online-pharmacy'),
		'section'	=> 'online_pharmacy_footer_section',
		'type'		=> 'text'
	));

		// footer columns
	$wp_customize->add_setting('online_pharmacy_footer_columns',array(
		'default'	=> 4,
		'sanitize_callback'	=> 'online_pharmacy_sanitize_number_absint'
	));
	$wp_customize->add_control('online_pharmacy_footer_columns',array(
		'label'	=> __('Footer Widget Columns','online-pharmacy'),
		'section'	=> 'online_pharmacy_footer_section',
		'setting'	=> 'online_pharmacy_footer_columns',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 4,
		),
	));


	$wp_customize->add_setting( 'online_pharmacy_tp_footer_bg_color_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_pharmacy_tp_footer_bg_color_option', array(
	    'description' => __('It will change the complete theme hover link color in one click.', 'online-pharmacy'),
	    'section' => 'online_pharmacy_footer_section',
	    'settings' => 'online_pharmacy_tp_footer_bg_color_option',
  	)));

	$wp_customize->add_setting('online_pharmacy_footer_widget_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'online_pharmacy_footer_widget_image',array(
    'label' => __('Footer Widget Background Image','online-pharmacy'),
    'section' => 'online_pharmacy_footer_section'
	)));

	$wp_customize->selective_refresh->add_partial( 'online_pharmacy_footer_text', array(
		'selector' => '#footer p',
		'render_callback' => 'online_pharmacy_customize_partial_online_pharmacy_footer_text',
	) );

	$wp_customize->add_setting( 'online_pharmacy_return_to_header', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_return_to_header', array(
		'label'       => esc_html__( 'Show / Hide Return to Header', 'online-pharmacy'),
		'section'     => 'online_pharmacy_footer_section',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_return_to_header',
	) ) );

	 $wp_customize->add_setting('online_pharmacy_scroll_top_icon',array(
		'default'	=> 'fas fa-arrow-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Online_Pharmacy_Icon_Changer(
        $wp_customize,'online_pharmacy_scroll_top_icon',array(
		'label'	=> __('Scroll to top Icon','online-pharmacy'),
		'transport' => 'refresh',
		'section'	=> 'online_pharmacy_footer_section',
		'type'		=> 'icon'
	)));

   // Add Settings and Controls for Scroll top
	$wp_customize->add_setting('online_pharmacy_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'online_pharmacy_sanitize_choices'
	));
	$wp_customize->add_control('online_pharmacy_scroll_top_position',array(
     'type' => 'radio',
     'label'     => __('Scroll to top Position', 'online-pharmacy'),
     'description'   => __('This option work for scroll to top', 'online-pharmacy'),
     'section' => 'online_pharmacy_footer_section',
     'choices' => array(
         'Right' => __('Right','online-pharmacy'),
         'Left' => __('Left','online-pharmacy'),
         'Center' => __('Center','online-pharmacy')
     ),
	) );

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'online_pharmacy_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'online_pharmacy_customize_partial_blogdescription',
	) );

	$wp_customize->add_setting( 'online_pharmacy_site_title_text', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_site_title_text', array(
		'label'       => esc_html__( 'Show / Hide Site Title', 'online-pharmacy'),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'online_pharmacy_site_title_text',
	) ) );

	// logo site title size
	$wp_customize->add_setting('online_pharmacy_site_title_font_size',array(
		'default'	=> 25,
		'sanitize_callback'	=> 'online_pharmacy_sanitize_number_absint'
	));
	$wp_customize->add_control('online_pharmacy_site_title_font_size',array(
		'label'	=> __('Site Title Font Size in PX','online-pharmacy'),
		'section'	=> 'title_tagline',
		'setting'	=> 'online_pharmacy_site_title_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

		$wp_customize->add_setting( 'online_pharmacy_site_tagline_text', array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_site_tagline_text', array(
			'label'       => esc_html__( 'Show / Hide Tagline', 'online-pharmacy'),
			'section'     => 'title_tagline',
			'type'        => 'toggle',
			'settings'    => 'online_pharmacy_site_tagline_text',
		) ) );

		// logo site tagline size
	$wp_customize->add_setting('online_pharmacy_site_tagline_font_size',array(
		'default'	=> 10,
		'sanitize_callback'	=> 'online_pharmacy_sanitize_number_absint'
	));
	$wp_customize->add_control('online_pharmacy_site_tagline_font_size',array(
		'label'	=> __('Site Tagline Font Size in PX','online-pharmacy'),
		'section'	=> 'title_tagline',
		'setting'	=> 'online_pharmacy_site_tagline_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 30,
		),
	));

    $wp_customize->add_setting('online_pharmacy_logo_width',array(
		'default' => 150,
		'sanitize_callback'	=> 'online_pharmacy_sanitize_number_absint'
	));
	 $wp_customize->add_control('online_pharmacy_logo_width',array(
		'label'	=> esc_html__('Here You Can Customize Your Logo Size','online-pharmacy'),
		'section'	=> 'title_tagline',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('online_pharmacy_logo_settings',array(
        'default' => 'Different Line',
        'sanitize_callback' => 'online_pharmacy_sanitize_choices'
	));
    $wp_customize->add_control('online_pharmacy_logo_settings',array(
        'type' => 'radio',
        'label'     => __('Logo Layout Settings', 'online-pharmacy'),
        'description'   => __('Here you have two options 1. Logo and Site tite in differnt line. 2. Logo and Site title in same line.', 'online-pharmacy'),
        'section' => 'title_tagline',
        'choices' => array(
            'Different Line' => __('Different Line','online-pharmacy'),
            'Same Line' => __('Same Line','online-pharmacy')
        ),
	) );

	$wp_customize->add_setting('online_pharmacy_per_columns',array(
		'default'=> 3,
		'sanitize_callback'	=> 'online_pharmacy_sanitize_number_absint'
	));
	$wp_customize->add_control('online_pharmacy_per_columns',array(
		'label'	=> __('Product Per Row','online-pharmacy'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

	$wp_customize->add_setting('online_pharmacy_product_per_page',array(
		'default'=> 9,
		'sanitize_callback'	=> 'online_pharmacy_sanitize_number_absint'
	));
	$wp_customize->add_control('online_pharmacy_product_per_page',array(
		'label'	=> __('Product Per Page','online-pharmacy'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

		$wp_customize->add_setting( 'online_pharmacy_product_sidebar', array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_product_sidebar', array(
			'label'       => esc_html__( 'Show / Hide Shop Page Sidebar', 'online-pharmacy' ),
			'section'     => 'woocommerce_product_catalog',
			'type'        => 'toggle',
			'settings'    => 'online_pharmacy_product_sidebar',
		) ) );

		$wp_customize->add_setting( 'online_pharmacy_single_product_sidebar', array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_single_product_sidebar', array(
			'label'       => esc_html__( 'Show / Hide Product Page Sidebar', 'online-pharmacy' ),
			'section'     => 'woocommerce_product_catalog',
			'type'        => 'toggle',
			'settings'    => 'online_pharmacy_single_product_sidebar',
		) ) );

		$wp_customize->add_setting( 'online_pharmacy_related_product', array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'online_pharmacy_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Online_Pharmacy_Toggle_Control( $wp_customize, 'online_pharmacy_related_product', array(
			'label'       => esc_html__( 'Show / Hide related product', 'online-pharmacy' ),
			'section'     => 'woocommerce_product_catalog',
			'type'        => 'toggle',
			'settings'    => 'online_pharmacy_related_product',
		) ) );

	// 404 PAGE
	$wp_customize->add_section('online_pharmacy_404_page_section',array(
		'title'         => __('404 Page', 'online-pharmacy'),
		'description'   => 'Here you can customize 404 Page content.',
	) );
	$wp_customize->add_setting('online_pharmacy_not_found_title',array(
		'default'=> __('Oops! That page cant be found.','online-pharmacy'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('online_pharmacy_not_found_title',array(
		'label'	=> __('Edit Title','online-pharmacy'),
		'section'=> 'online_pharmacy_404_page_section',
		'type'=> 'text',
	));
	$wp_customize->add_setting('online_pharmacy_not_found_text',array(
		'default'=> __('It looks like nothing was found at this location. Maybe try a search?','online-pharmacy'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('online_pharmacy_not_found_text',array(
		'label'	=> __('Edit Text','online-pharmacy'),
		'section'=> 'online_pharmacy_404_page_section',
		'type'=> 'text'
	));


}
add_action( 'customize_register', 'online_pharmacy_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Online Pharmacy 1.0
 * @see online_pharmacy_customize_register()
 *
 * @return void
 */
function online_pharmacy_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Online Pharmacy 1.0
 * @see online_pharmacy_customize_register()
 *
 * @return void
 */
function online_pharmacy_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( ! defined( 'ONLINE_PHARMACY_PRO_THEME_NAME' ) ) {
	define( 'ONLINE_PHARMACY_PRO_THEME_NAME', esc_html__( 'Online Pharmacy Pro', 'online-pharmacy'));
}
if ( ! defined( 'ONLINE_PHARMACY_PRO_THEME_URL' ) ) {
	define( 'ONLINE_PHARMACY_PRO_THEME_URL', esc_url('https://www.themespride.com/themes/online-pharmacy-wordpress-theme/'));
}
if ( ! defined( 'ONLINE_PHARMACY_DOCS_URL' ) ) {
	define( 'ONLINE_PHARMACY_DOCS_URL', esc_url('https://www.themespride.com/demo/docs/online-pharmacy-lite/'));
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Online_Pharmacy_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Online_Pharmacy_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Online_Pharmacy_Customize_Section_Pro(
				$manager,
				'online_pharmacy_section_pro',
				array(
					'priority'   => 9,
					'title'    => ONLINE_PHARMACY_PRO_THEME_NAME,
					'pro_text' => esc_html__( 'Upgrade Pro', 'online-pharmacy'),
					'pro_url'  => esc_url( ONLINE_PHARMACY_PRO_THEME_URL, 'online-pharmacy'),
				)
			)
		);

		// Register sections.
		$manager->add_section(
			new Online_Pharmacy_Customize_Section_Pro(
				$manager,
				'online_pharmacy_documentation',
				array(
					'priority'   => 500,
					'title'    => esc_html__( 'Theme Documentation', 'online-pharmacy'),
					'pro_text' => esc_html__( 'Click Here', 'online-pharmacy'),
					'pro_url'  => esc_url( ONLINE_PHARMACY_DOCS_URL, 'online-pharmacy'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'online_pharmacy-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'online_pharmacy-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Online_Pharmacy_Customize::get_instance();
