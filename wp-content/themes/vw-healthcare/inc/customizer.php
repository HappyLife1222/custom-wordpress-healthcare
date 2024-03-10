<?php
/**
 * VW Healthcare Theme Customizer
 *
 * @package VW Healthcare
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function vw_healthcare_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_healthcare_custom_controls' );

function vw_healthcare_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_healthcare_Customize_partial_blogname',
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_healthcare_Customize_partial_blogdescription',
	));

	//add home page setting pannel
	$vw_healthcare_parent_panel = new VW_Healthcare_WP_Customize_Panel( $wp_customize, 'vw_healthcare_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Homepage Settings', 'vw-healthcare' ),
		'priority' => 10,
	));

	// Header
	$wp_customize->add_section( 'vw_healthcare_header' , array(
    	'title' => esc_html__( 'Header', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_panel_id'
	) );

   	// Header Background color
	$wp_customize->add_setting('vw_healthcare_header_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_header_background_color', array(
		'label'    => __('Header Background Color', 'vw-healthcare'),
		'section'  => 'header_image',
	)));

	$wp_customize->add_setting('vw_healthcare_header_img_position',array(
	  'default' => 'center top',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_header_img_position',array(
		'type' => 'select',
		'label' => __('Header Image Position','vw-healthcare'),
		'section' => 'header_image',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-healthcare' ),
			'center top'   => esc_html__( 'Top', 'vw-healthcare' ),
			'right top'   => esc_html__( 'Top Right', 'vw-healthcare' ),
			'left center'   => esc_html__( 'Left', 'vw-healthcare' ),
			'center center'   => esc_html__( 'Center', 'vw-healthcare' ),
			'right center'   => esc_html__( 'Right', 'vw-healthcare' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-healthcare' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-healthcare' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-healthcare' ),
		),
	));

	$wp_customize->add_setting('vw_healthcare_opening_time',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_opening_time',array(
		'label'	=> esc_html__('Add Opening Time','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Opening Hours: Monday to Saturday - 8 AM to 5 PM', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_phone_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_phone_text',array(
		'label'	=> esc_html__('Add Phone Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Emergency Number', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_phone_number',array(
		'label'	=> esc_html__('Add Phone Number','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '9876543210', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_location_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_location_text',array(
		'label'	=> esc_html__('Add Location Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Address', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_location',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_location',array(
		'label'	=> esc_html__('Add Location','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Dummy Street, Australia', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_appointment_text_button',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_appointment_text_button',array(
		'label'	=> esc_html__('Button Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'APPOINTMENT', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_appointment_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vw_healthcare_appointment_link',array(
		'label'	=> esc_html__('Button Link','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://www.example.com/appointment', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_header',
		'type'=> 'url'
	));

	//Menus Settings
	$wp_customize->add_section( 'vw_healthcare_menu_section' , array(
    	'title' => __( 'Menus Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_panel_id'
	) );

	$wp_customize->add_setting('vw_healthcare_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_menu_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_navigation_menu_font_weight',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','vw-healthcare'),
        'section' => 'vw_healthcare_menu_section',
        'choices' => array(
        	'100' => __('100','vw-healthcare'),
            '200' => __('200','vw-healthcare'),
            '300' => __('300','vw-healthcare'),
            '400' => __('400','vw-healthcare'),
            '500' => __('500','vw-healthcare'),
            '600' => __('600','vw-healthcare'),
            '700' => __('700','vw-healthcare'),
            '800' => __('800','vw-healthcare'),
            '900' => __('900','vw-healthcare'),
        ),
	) );

	// text trasform
	$wp_customize->add_setting('vw_healthcare_menu_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_menu_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Menus Text Transform','vw-healthcare'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-healthcare'),
            'Capitalize' => __('Capitalize','vw-healthcare'),
            'Lowercase' => __('Lowercase','vw-healthcare'),
        ),
		'section'=> 'vw_healthcare_menu_section',
	));

	$wp_customize->add_setting('vw_healthcare_menus_item_style',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_menus_item_style',array(
        'type' => 'select',
        'section' => 'vw_healthcare_menu_section',
		'label' => __('Menu Item Hover Style','vw-healthcare'),
		'choices' => array(
            'None' => __('None','vw-healthcare'),
            'Zoom In' => __('Zoom In','vw-healthcare'),
        ),
	) );

	$wp_customize->add_setting('vw_healthcare_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_header_menus_color', array(
		'label'    => __('Menus Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_menu_section',
	)));

	$wp_customize->add_setting('vw_healthcare_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_menu_section',
	)));

	$wp_customize->add_setting('vw_healthcare_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_menu_section',
	)));

	$wp_customize->add_setting('vw_healthcare_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_menu_section',
	)));

	//Social links
	$wp_customize->add_section(
		'vw_healthcare_social_links', array(
			'title'		=>	__('Social Links', 'vw-healthcare'),
			'priority'	=>	null,
			'panel'		=>	'vw_healthcare_panel_id'
	));

	$wp_customize->add_setting('vw_healthcare_social_icons',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_social_icons',array(
		'label' =>  __('Steps to setup social icons','vw-healthcare'),
		'description' => __('<p>1. Go to Dashboard >> Appearance >> Widgets</p>
			<p>2. Add Vw Social Icon Widget in Topbar Social Links.</p>
			<p>3. Add social icons url and save.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_social_links',
		'type'=> 'hidden'
	));
	$wp_customize->add_setting('vw_healthcare_social_icon_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_social_icon_btn',array(
		'description' => "<a target='_blank' href='". admin_url('widgets.php') ." '>Setup Social Icons</a>",
		'section'=> 'vw_healthcare_social_links',
		'type'=> 'hidden'
	));

	//Slider
	$wp_customize->add_section( 'vw_healthcare_slidersettings' , array(
    	'title' => esc_html__( 'Slider Settings', 'vw-healthcare' ),
    	'description' => "Free theme has 3 slides options, For unlimited slides and more options </br><a class='go-pro-btn' target='_blank' href='". esc_url(VW_HEALTHCARE_GO_PRO) ." '>GET PRO</a>",
		'panel' => 'vw_healthcare_panel_id'
	) );

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_healthcare_slider_arrows',array(
		'selector'        => '#slider .carousel-caption h1',
		'render_callback' => 'vw_healthcare_Customize_partial_vw_healthcare_slider_arrows',
	));

	$wp_customize->add_setting( 'vw_healthcare_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','vw-healthcare' ),
      	'section' => 'vw_healthcare_slidersettings'
    )));

    $wp_customize->add_setting('vw_healthcare_slider_type',array(
        'default' => 'Default slider',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	) );
	$wp_customize->add_control('vw_healthcare_slider_type', array(
        'type' => 'select',
        'label' => __('Slider Type','vw-healthcare'),
        'section' => 'vw_healthcare_slidersettings',
        'choices' => array(
            'Default slider' => __('Default slider','vw-healthcare'),
            'Advance slider' => __('Advance slider','vw-healthcare'),
        ),
	));

	$wp_customize->add_setting('vw_healthcare_advance_slider_shortcode',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_advance_slider_shortcode',array(
		'label'	=> __('Add Slider Shortcode','vw-healthcare'),
		'section'=> 'vw_healthcare_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_healthcare_advance_slider'
	));

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'vw_healthcare_slider_page' . $count, array(
			'default'  => '',
			'sanitize_callback' => 'vw_healthcare_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_healthcare_slider_page' . $count, array(
			'label'    => esc_html__( 'Select Slider Page', 'vw-healthcare' ),
			'description' => esc_html__('Slider image size (1600 x 650)','vw-healthcare'),
			'section'  => 'vw_healthcare_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'vw_healthcare_default_slider'
		) );
	}

	$wp_customize->add_setting( 'vw_healthcare_slider_small_title', array(
		'default'           => 'Emergency: ',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'vw_healthcare_slider_small_title', array(
		'label'    => __( 'Add Slider Small Text', 'vw-healthcare' ),
		'section'  => 'vw_healthcare_slidersettings',
		'type'     => 'text',
		'active_callback' => 'vw_healthcare_default_slider'
	) );

	$wp_customize->add_setting( 'vw_healthcare_slider_title_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));  
    $wp_customize->add_control( new vw_healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_slider_title_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Title','vw-healthcare' ),
		'section' => 'vw_healthcare_slidersettings',
		'active_callback' => 'vw_healthcare_default_slider'
    )));

   	$wp_customize->add_setting('vw_healthcare_slider_button_text',array(
		'default'=> 'Read More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_healthcare_default_slider'
	));

	$wp_customize->add_setting('vw_healthcare_topbar_btn_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vw_healthcare_topbar_btn_link',array(
		'label'	=> esc_html__('Add Button Link','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'www.example-info.com', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_slidersettings',
		'type'=> 'url'
	));

	//content layout
	$wp_customize->add_setting('vw_healthcare_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Healthcare_Image_Radio_Control($wp_customize, 'vw_healthcare_slider_content_option', array(
        'type' => 'select',
        'label' => esc_html__('Slider Content Layouts','vw-healthcare'),
        'section' => 'vw_healthcare_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ),'active_callback' => 'vw_healthcare_default_slider'
    )));

    //Slider content padding
    $wp_customize->add_setting('vw_healthcare_slider_content_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_slider_content_padding_top_bottom',array(
		'label'	=> __('Slider Content Padding Top Bottom','vw-healthcare'),
		'description'	=> __('Enter a value in %. Example:20%','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_healthcare_default_slider'
	));

	$wp_customize->add_setting('vw_healthcare_slider_content_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_slider_content_padding_left_right',array(
		'label'	=> __('Slider Content Padding Left Right','vw-healthcare'),
		'description'	=> __('Enter a value in %. Example:20%','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_healthcare_default_slider'
	));

	//Slider height
	$wp_customize->add_setting('vw_healthcare_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_slider_height',array(
		'label'	=> __('Slider Height','vw-healthcare'),
		'description'	=> __('Specify the slider height (px).','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_healthcare_default_slider'
	));

	//Opacity
	$wp_customize->add_setting('vw_healthcare_slider_opacity_color',array(
      'default'              => 0.5,
      'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_healthcare_slider_opacity_color', array(
		'label'       => esc_html__( 'Slider Image Opacity','vw-healthcare' ),
		'section'     => 'vw_healthcare_slidersettings',
		'type'        => 'select',
		'settings'    => 'vw_healthcare_slider_opacity_color',
		'choices' => array(
	      '0' =>  esc_attr('0','vw-healthcare'),
	      '0.1' =>  esc_attr('0.1','vw-healthcare'),
	      '0.2' =>  esc_attr('0.2','vw-healthcare'),
	      '0.3' =>  esc_attr('0.3','vw-healthcare'),
	      '0.4' =>  esc_attr('0.4','vw-healthcare'),
	      '0.5' =>  esc_attr('0.5','vw-healthcare'),
	      '0.6' =>  esc_attr('0.6','vw-healthcare'),
	      '0.7' =>  esc_attr('0.7','vw-healthcare'),
	      '0.8' =>  esc_attr('0.8','vw-healthcare'),
	      '0.9' =>  esc_attr('0.9','vw-healthcare')
	),'active_callback' => 'vw_healthcare_default_slider'
	));

	$wp_customize->add_setting( 'vw_healthcare_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_healthcare_switch_sanitization'
   ));
   $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_slider_image_overlay',array(
      	'label' => esc_html__( 'Show / Hide Slider Image Overlay','vw-healthcare' ),
      	'section' => 'vw_healthcare_slidersettings',
      	'active_callback' => 'vw_healthcare_default_slider'
   )));

   $wp_customize->add_setting('vw_healthcare_slider_image_overlay_color', array(
		'default'           => '#2cd7bd',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_slidersettings',
		'active_callback' => 'vw_healthcare_default_slider'
	)));

	$wp_customize->add_setting( 'vw_healthcare_slider_arrow_hide_show',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	));
	$wp_customize->add_control( new vw_healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_slider_arrow_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Arrows','vw-healthcare' ),
		'section' => 'vw_healthcare_slidersettings',
		'active_callback' => 'vw_healthcare_default_slider'
	)));

	$wp_customize->add_setting('vw_healthcare_slider_prev_icon',array(
		'default'	=> 'fas fa-angle-left',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_slider_prev_icon',array(
		'label'	=> __('Add Slider Prev Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_slidersettings',
		'setting'	=> 'vw_healthcare_slider_prev_icon',
		'type'		=> 'icon',
		'active_callback' => 'vw_healthcare_default_slider'
	)));

	$wp_customize->add_setting('vw_healthcare_slider_next_icon',array(
		'default'	=> 'fas fa-angle-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_slider_next_icon',array(
		'label'	=> __('Add Slider Next Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_slidersettings',
		'setting'	=> 'vw_healthcare_slider_next_icon',
		'type'		=> 'icon',
		'active_callback' => 'vw_healthcare_default_slider'
	)));


	//Services
	$wp_customize->add_section('vw_healthcare_services',array(
		'title'	=> __('Our Specialize Section','vw-healthcare'),
		'description' => "For more options for specialize section </br><a class='go-pro-btn' target='_blank' href='". esc_url(VW_HEALTHCARE_GO_PRO) ." '>GET PRO</a>",
		'panel' => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_services_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_services_text',array(
		'label'	=> esc_html__('Services Heading Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Our Speciality', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_services',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_services_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_services_title',array(
		'label'	=> esc_html__('Services Heading Title','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'We Specialize In', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_services',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_services_btn_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_services_btn_text',array(
		'label'	=> esc_html__('Services Button Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'View All Speciality', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_services',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_services_btn_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vw_healthcare_services_btn_link',array(
		'label'	=> esc_html__('Services Button Link','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://www.example.com/services', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_services',
		'type'=> 'url'
	));

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_healthcare_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_healthcare_sanitize_choices',
	));
	$wp_customize->add_control('vw_healthcare_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display services','vw-healthcare'),
		'section' => 'vw_healthcare_services',
	));

	//Appointment Section
	$wp_customize->add_section('vw_healthcare_appointment', array(
		'title'       => __('Appointment Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_appointment_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_appointment_text',array(
		'description' => __('<p>1. More options for appointment section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for appointment section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_appointment',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_appointment_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_appointment_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_appointment',
		'type'=> 'hidden'
	));

	//Features Section
	$wp_customize->add_section('vw_healthcare_features', array(
		'title'       => __('Features Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_features_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_features_text',array(
		'description' => __('<p>1. More options for features section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for features section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_features',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_features_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_features_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_features',
		'type'=> 'hidden'
	));

	//Contact Us Section
	$wp_customize->add_section('vw_healthcare_contact_us', array(
		'title'       => __('Contact Us Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_contact_us_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_contact_us_text',array(
		'description' => __('<p>1. More options for contact us section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for contact us section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_contact_us',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_contact_us_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_contact_us_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_contact_us',
		'type'=> 'hidden'
	));

	//Treatments Section
	$wp_customize->add_section('vw_healthcare_treatments', array(
		'title'       => __('Treatments Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_treatments_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_treatments_text',array(
		'description' => __('<p>1. More options for treatments section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for treatments section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_treatments',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_treatments_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_treatments_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_treatments',
		'type'=> 'hidden'
	));

	//Symptoms Section
	$wp_customize->add_section('vw_healthcare_symptoms', array(
		'title'       => __('Symptoms Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_symptoms_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_symptoms_text',array(
		'description' => __('<p>1. More options for symptoms section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for symptoms section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_symptoms',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_symptoms_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_symptoms_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_symptoms',
		'type'=> 'hidden'
	));

	//How It Work Section
	$wp_customize->add_section('vw_healthcare_how_it_work', array(
		'title'       => __('How It Work Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_how_it_work_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_how_it_work_text',array(
		'description' => __('<p>1. More options for how it work section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for how it work section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_how_it_work',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_how_it_work_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_how_it_work_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_how_it_work',
		'type'=> 'hidden'
	));

	//Emergency Contact Section
	$wp_customize->add_section('vw_healthcare_emergency_contact', array(
		'title'       => __('Emergency Contact Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_emergency_contact_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_emergency_contact_text',array(
		'description' => __('<p>1. More options for emergency contact section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for emergency contact section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_emergency_contact',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_emergency_contact_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_emergency_contact_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_emergency_contact',
		'type'=> 'hidden'
	));

	//Gallery Section
	$wp_customize->add_section('vw_healthcare_gallery', array(
		'title'       => __('Gallery Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_gallery_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_gallery_text',array(
		'description' => __('<p>1. More options for gallery section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for gallery section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_gallery',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_gallery_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_gallery_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_gallery',
		'type'=> 'hidden'
	));

	//Records Section
	$wp_customize->add_section('vw_healthcare_records', array(
		'title'       => __('Records Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_records_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_records_text',array(
		'description' => __('<p>1. More options for records section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for records section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_records',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_records_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_records_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_records',
		'type'=> 'hidden'
	));

	//Video Section
	$wp_customize->add_section('vw_healthcare_video', array(
		'title'       => __('Video Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_video_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_video_text',array(
		'description' => __('<p>1. More options for video section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for video section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_video',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_video_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_video_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_video',
		'type'=> 'hidden'
	));

	//Testimonials Section
	$wp_customize->add_section('vw_healthcare_testimonials', array(
		'title'       => __('Testimonials Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_testimonials_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_testimonials_text',array(
		'description' => __('<p>1. More options for testimonials section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for testimonials section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_testimonials',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_testimonials_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_testimonials_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_testimonials',
		'type'=> 'hidden'
	));

	//Partners Section
	$wp_customize->add_section('vw_healthcare_partners', array(
		'title'       => __('Partners Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_partners_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_partners_text',array(
		'description' => __('<p>1. More options for partners section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for partners section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_partners',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_partners_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_partners_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_partners',
		'type'=> 'hidden'
	));

	//Teams Section
	$wp_customize->add_section('vw_healthcare_teams', array(
		'title'       => __('Teams Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_teams_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_teams_text',array(
		'description' => __('<p>1. More options for teams section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for teams section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_teams',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_teams_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_teams_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_teams',
		'type'=> 'hidden'
	));

	//Newsletter Section
	$wp_customize->add_section('vw_healthcare_newsletter', array(
		'title'       => __('Newsletter Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_newsletter_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_newsletter_text',array(
		'description' => __('<p>1. More options for newsletter section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for newsletter section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_newsletter',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_newsletter_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_newsletter_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_newsletter',
		'type'=> 'hidden'
	));

	//Our Blogs Section
	$wp_customize->add_section('vw_healthcare_our_blogs', array(
		'title'       => __('Our Blogs Section', 'vw-healthcare'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-healthcare'),
		'priority'    => null,
		'panel'       => 'vw_healthcare_panel_id',
	));

	$wp_customize->add_setting('vw_healthcare_our_blogs_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_our_blogs_text',array(
		'description' => __('<p>1. More options for our blogs section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for our blogs section.</p>','vw-healthcare'),
		'section'=> 'vw_healthcare_our_blogs',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_healthcare_our_blogs_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_our_blogs_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_HEALTHCARE_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_healthcare_our_blogs',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('vw_healthcare_footer',array(
		'title'	=> esc_html__('Footer Settings','vw-healthcare'),
		'description' => "For more options for footer section <a class='go-pro-btn' target='_blank' href='". esc_url(VW_HEALTHCARE_GO_PRO) ." '>GET PRO</a>",
		'panel' => 'vw_healthcare_panel_id',
	));	

	$wp_customize->add_setting( 'vw_healthcare_footer_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));
    $wp_customize->add_control( new vw_healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_footer_hide_show',array(
      'label' => esc_html__( 'Show / Hide Footer','vw-healthcare' ),
      'section' => 'vw_healthcare_footer'
    )));

	$wp_customize->add_setting('vw_healthcare_footer_background_color', array(
		'default'           => '#3d3d3d',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_footer_background_color', array(
		'label'    => __('Footer Background Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_footer',
	)));

	$wp_customize->add_setting('vw_healthcare_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_healthcare_footer_background_image',array(
        'label' => __('Footer Background Image','vw-healthcare'),
        'section' => 'vw_healthcare_footer'
	)));

	$wp_customize->add_setting('vw_healthcare_footer_img_position',array(
	  'default' => 'center center',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','vw-healthcare'),
		'section' => 'vw_healthcare_footer',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-healthcare' ),
			'center top'   => esc_html__( 'Top', 'vw-healthcare' ),
			'right top'   => esc_html__( 'Top Right', 'vw-healthcare' ),
			'left center'   => esc_html__( 'Left', 'vw-healthcare' ),
			'center center'   => esc_html__( 'Center', 'vw-healthcare' ),
			'right center'   => esc_html__( 'Right', 'vw-healthcare' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-healthcare' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-healthcare' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-healthcare' ),
		),
	));

	// Footer
	$wp_customize->add_setting('vw_healthcare_img_footer',array(
		'default'=> 'scroll',
		'sanitize_callback'	=> 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_img_footer',array(
		'type' => 'select',
		'label'	=> __('Footer Background Attatchment','vw-healthcare'),
		'choices' => array(
            'fixed' => __('fixed','vw-healthcare'),
            'scroll' => __('scroll','vw-healthcare'),
        ),
		'section'=> 'vw_healthcare_footer',
	));

	// footer padding
	$wp_customize->add_setting('vw_healthcare_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_footer_padding',array(
		'label'	=> __('Footer Top Bottom Padding','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-healthcare' ),
    ),
		'section'=> 'vw_healthcare_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','vw-healthcare'),
        'section' => 'vw_healthcare_footer',
        'choices' => array(
        	'Left' => __('Left','vw-healthcare'),
            'Center' => __('Center','vw-healthcare'),
            'Right' => __('Right','vw-healthcare')
        ),
	) );

	$wp_customize->add_setting('vw_healthcare_footer_widgets_content',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_footer_widgets_content',array(
        'type' => 'select',
        'label' => __('Footer Widget Content','vw-healthcare'),
        'section' => 'vw_healthcare_footer',
        'choices' => array(
        	'Left' => __('Left','vw-healthcare'),
            'Center' => __('Center','vw-healthcare'),
            'Right' => __('Right','vw-healthcare')
        ),
	) );

    // footer social icon
  	$wp_customize->add_setting( 'vw_healthcare_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_footer_icon',array(
		'label' => esc_html__( 'Show / Hide Footer Social Icon','vw-healthcare' ),
		'section' => 'vw_healthcare_footer'
    )));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_healthcare_footer_text', array( 
		'selector' => '.copyright p', 
		'render_callback' => 'vw_healthcare_Customize_partial_vw_healthcare_footer_text', 
	));

	$wp_customize->add_setting( 'vw_healthcare_copyright_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));
    $wp_customize->add_control( new vw_healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_copyright_hide_show',array(
      'label' => esc_html__( 'Show / Hide Copyright','vw-healthcare' ),
      'section' => 'vw_healthcare_footer'
    )));

	$wp_customize->add_setting('vw_healthcare_copyright_background_color', array(
		'default'           => '#00386c',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_footer',
	)));

	$wp_customize->add_setting('vw_healthcare_copyright_text_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_copyright_text_color', array(
		'label'    => __('Copyright Text Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_footer',
	)));
	
	$wp_customize->add_setting('vw_healthcare_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_healthcare_footer_text',array(
		'label'	=> esc_html__('Copyright Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Copyright 2020, .....', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_copyright_font_size',array(
		'label'	=> __('Copyright Font Size','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_copyright_font_weight',array(
	  'default' => 400,
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_copyright_font_weight',array(
	    'type' => 'select',
	    'label' => __('Copyright Font Weight','vw-healthcare'),
	    'section' => 'vw_healthcare_footer',
	    'choices' => array(
	    	'100' => __('100','vw-healthcare'),
	        '200' => __('200','vw-healthcare'),
	        '300' => __('300','vw-healthcare'),
	        '400' => __('400','vw-healthcare'),
	        '500' => __('500','vw-healthcare'),
	        '600' => __('600','vw-healthcare'),
	        '700' => __('700','vw-healthcare'),
	        '800' => __('800','vw-healthcare'),
	        '900' => __('900','vw-healthcare'),
    ),
	));

	$wp_customize->add_setting('vw_healthcare_copyright_alignment',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Healthcare_Image_Radio_Control($wp_customize, 'vw_healthcare_copyright_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Copyright Alignment','vw-healthcare'),
        'section' => 'vw_healthcare_footer',
        'settings' => 'vw_healthcare_copyright_alignment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

	$wp_customize->add_setting( 'vw_healthcare_footer_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_footer_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','vw-healthcare' ),
      	'section' => 'vw_healthcare_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_healthcare_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_healthcare_Customize_partial_vw_healthcare_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_healthcare_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_footer',
		'setting'	=> 'vw_healthcare_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_healthcare_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-healthcare'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_healthcare_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-healthcare' ),
		'section'     => 'vw_healthcare_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('vw_healthcare_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Healthcare_Image_Radio_Control($wp_customize, 'vw_healthcare_scroll_top_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Scroll To Top','vw-healthcare'),
        'section' => 'vw_healthcare_footer',
        'settings' => 'vw_healthcare_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

    //Blog Post
	$wp_customize->add_panel( $vw_healthcare_parent_panel );

	$BlogPostParentPanel = new VW_Healthcare_WP_Customize_Panel( $wp_customize, 'vw_healthcare_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_panel_id',
		'priority' => 20,
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_healthcare_post_settings', array(
		'title' => esc_html__( 'Post Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_blog_post_parent_panel',
	));

	//Blog layout
    $wp_customize->add_setting('vw_healthcare_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
    ));
    $wp_customize->add_control(new vw_healthcare_Image_Radio_Control($wp_customize, 'vw_healthcare_blog_layout_option', array(
        'type' => 'select',
        'label' => esc_html__('Blog Layouts','vw-healthcare'),
        'section' => 'vw_healthcare_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

	$wp_customize->add_setting('vw_healthcare_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_theme_options',array(
        'type' => 'select',
        'label' => esc_html__('Post Sidebar Layout','vw-healthcare'),
        'description' => esc_html__('Here you can change the sidebar layout for posts. ','vw-healthcare'),
        'section' => 'vw_healthcare_post_settings',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','vw-healthcare'),
            'Right Sidebar' => esc_html__('Right Sidebar','vw-healthcare'),
            'One Column' => esc_html__('One Column','vw-healthcare'),
            'Three Columns' => esc_html__('Three Columns','vw-healthcare'),
            'Four Columns' => esc_html__('Four Columns','vw-healthcare'),
            'Grid Layout' => esc_html__('Grid Layout','vw-healthcare')
        ),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_healthcare_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_healthcare_Customize_partial_vw_healthcare_toggle_postdate', 
	));

  	$wp_customize->add_setting('vw_healthcare_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_post_settings',
		'setting'	=> 'vw_healthcare_toggle_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_healthcare_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_toggle_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-healthcare' ),
        'section' => 'vw_healthcare_post_settings'
    )));

	$wp_customize->add_setting('vw_healthcare_toggle_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_post_settings',
		'setting'	=> 'vw_healthcare_toggle_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_healthcare_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-healthcare' ),
		'section' => 'vw_healthcare_post_settings'
    )));

    $wp_customize->add_setting('vw_healthcare_toggle_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_post_settings',
		'setting'	=> 'vw_healthcare_toggle_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_healthcare_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-healthcare' ),
		'section' => 'vw_healthcare_post_settings'
    )));

  	$wp_customize->add_setting('vw_healthcare_toggle_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_post_settings',
		'setting'	=> 'vw_healthcare_toggle_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_healthcare_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','vw-healthcare' ),
		'section' => 'vw_healthcare_post_settings'
    )));

    $wp_customize->add_setting( 'vw_healthcare_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_featured_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','vw-healthcare' ),
		'section' => 'vw_healthcare_post_settings'
    )));

    $wp_customize->add_setting( 'vw_healthcare_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','vw-healthcare' ),
		'section'     => 'vw_healthcare_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_healthcare_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','vw-healthcare' ),
		'section'     => 'vw_healthcare_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Featured Image
	$wp_customize->add_setting('vw_healthcare_blog_post_featured_image_dimension',array(
       'default' => 'default',
       'sanitize_callback'	=> 'vw_healthcare_sanitize_choices'
	));
  	$wp_customize->add_control('vw_healthcare_blog_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Blog Post Featured Image Dimension','vw-healthcare'),
		'section'	=> 'vw_healthcare_post_settings',
		'choices' => array(
		'default' => __('Default','vw-healthcare'),
		'custom' => __('Custom Image Size','vw-healthcare'),
      ),
  	));

	$wp_customize->add_setting('vw_healthcare_blog_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('vw_healthcare_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'vw-healthcare' ),),
		'section'=> 'vw_healthcare_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_healthcare_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('vw_healthcare_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'vw-healthcare' ),),
		'section'=> 'vw_healthcare_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_healthcare_blog_post_featured_image_dimension'
	));

    $wp_customize->add_setting( 'vw_healthcare_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_healthcare_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-healthcare' ),
		'section'     => 'vw_healthcare_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_healthcare_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_healthcare_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-healthcare'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-healthcare'),
		'section'=> 'vw_healthcare_post_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_healthcare_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog Posts','vw-healthcare'),
        'section' => 'vw_healthcare_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-healthcare'),
            'Without Blocks' => __('Without Blocks','vw-healthcare')
        ),
	) );

    $wp_customize->add_setting('vw_healthcare_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Post Content','vw-healthcare'),
        'section' => 'vw_healthcare_post_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','vw-healthcare'),
            'Excerpt' => esc_html__('Excerpt','vw-healthcare'),
            'No Content' => esc_html__('No Content','vw-healthcare')
        ),
	) );

	$wp_customize->add_setting( 'vw_healthcare_blog_pagination_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));
    $wp_customize->add_control( new vw_healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_blog_pagination_hide_show',array(
		'label' => esc_html__( 'Show / Hide Blog Pagination','vw-healthcare' ),
		'section' => 'vw_healthcare_post_settings'
    )));

	$wp_customize->add_setting( 'vw_healthcare_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_healthcare_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_healthcare_blog_pagination_type', array(
        'section' => 'vw_healthcare_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-healthcare' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-healthcare' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-healthcare' ),
    )));

    // Button Settings
	$wp_customize->add_section( 'vw_healthcare_button_settings', array(
		'title' => esc_html__( 'Button Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_healthcare_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'vw_healthcare_Customize_partial_vw_healthcare_button_text', 
	));

    $wp_customize->add_setting('vw_healthcare_button_text',array(
		'default'=> esc_html__('Read More','vw-healthcare'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Read More', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_button_settings',
		'type'=> 'text'
	));

	// font size button
	$wp_customize->add_setting('vw_healthcare_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_button_font_size',array(
		'label'	=> __('Button Font Size','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-healthcare' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_healthcare_button_settings',
	));

	$wp_customize->add_setting( 'vw_healthcare_button_border_radius', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_healthcare_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-healthcare' ),
		'section'     => 'vw_healthcare_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_healthcare_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_button_padding_top_bottom',array(
		'label'	=> esc_html__('Padding Top Bottom','vw-healthcare'),
		'description' => esc_html__('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '10px', 'vw-healthcare' ),
        ),
		'section' => 'vw_healthcare_button_settings',
		'type' => 'text'
	));

	$wp_customize->add_setting('vw_healthcare_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_button_padding_left_right',array(
		'label'	=> esc_html__('Padding Left Right','vw-healthcare'),
		'description' => esc_html__('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '10px', 'vw-healthcare' ),
        ),
		'section' => 'vw_healthcare_button_settings',
		'type' => 'text'
	));

	$wp_customize->add_setting('vw_healthcare_button_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_button_letter_spacing',array(
		'label'	=> __('Button Letter Spacing','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-healthcare' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_healthcare_button_settings',
	));

	// text trasform
	$wp_customize->add_setting('vw_healthcare_button_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','vw-healthcare'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-healthcare'),
            'Capitalize' => __('Capitalize','vw-healthcare'),
            'Lowercase' => __('Lowercase','vw-healthcare'),
        ),
		'section'=> 'vw_healthcare_button_settings',
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_healthcare_related_posts_settings', array(
		'title' => esc_html__( 'Related Posts Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_healthcare_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_healthcare_Customize_partial_vw_healthcare_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_healthcare_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_related_post',array(
		'label' => esc_html__( 'Show / Hide Related Post','vw-healthcare' ),
		'section' => 'vw_healthcare_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_healthcare_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_related_post_title',array(
		'label'	=> esc_html__('Add Related Post Title','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Related Post', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_healthcare_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_related_posts_count',array(
		'label'	=> esc_html__('Add Related Post Count','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '3', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'vw_healthcare_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','vw-healthcare' ),
		'section'     => 'vw_healthcare_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'vw_healthcare_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	// Single Posts Settings
	$wp_customize->add_section( 'vw_healthcare_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_healthcare_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_single_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_single_blog_settings',
		'setting'	=> 'vw_healthcare_single_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_healthcare_single_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_postdate',array(
	    'label' => esc_html__( 'Show / Hide Date','vw-healthcare' ),
	   'section' => 'vw_healthcare_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_healthcare_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_single_author_icon',array(
		'label'	=> __('Add Author Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_single_blog_settings',
		'setting'	=> 'vw_healthcare_single_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_healthcare_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_author',array(
	    'label' => esc_html__( 'Show / Hide Author','vw-healthcare' ),
	    'section' => 'vw_healthcare_single_blog_settings'
	)));

   	$wp_customize->add_setting('vw_healthcare_single_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_single_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_single_blog_settings',
		'setting'	=> 'vw_healthcare_single_comments_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_healthcare_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_comments',array(
	    'label' => esc_html__( 'Show / Hide Comments','vw-healthcare' ),
	    'section' => 'vw_healthcare_single_blog_settings'
	)));

  	$wp_customize->add_setting('vw_healthcare_single_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_single_time_icon',array(
		'label'	=> __('Add Time Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_single_blog_settings',
		'setting'	=> 'vw_healthcare_single_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_healthcare_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_time',array(
	    'label' => esc_html__( 'Show / Hide Time','vw-healthcare' ),
	    'section' => 'vw_healthcare_single_blog_settings'
	)));

	$wp_customize->add_setting( 'vw_healthcare_toggle_tags',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_toggle_tags', array(
		'label' => esc_html__( 'Show / Hide Tags','vw-healthcare' ),
		'section' => 'vw_healthcare_single_blog_settings'
    )));

    $wp_customize->add_setting( 'vw_healthcare_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_post_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Breadcrumb','vw-healthcare' ),
		'section' => 'vw_healthcare_single_blog_settings'
    )));

     // Single Posts Category
  	$wp_customize->add_setting( 'vw_healthcare_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_post_category',array(
		'label' => esc_html__( 'Show / Hide Category','vw-healthcare' ),
		'section' => 'vw_healthcare_single_blog_settings'
    )));

   	$wp_customize->add_setting( 'vw_healthcare_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
	));
	$wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_blog_post_navigation_show_hide', array(
		  'label' => esc_html__( 'Show / Hide Post Navigation','vw-healthcare' ),
		  'section' => 'vw_healthcare_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_healthcare_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-healthcare'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-healthcare'),
		'section'=> 'vw_healthcare_single_blog_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('vw_healthcare_single_blog_comment_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_healthcare_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_single_blog_comment_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_healthcare_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_single_blog_comment_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_single_blog_comment_width',array(
		'label'	=> __('Comment Form Width','vw-healthcare'),
		'description'	=> __('Enter a value in %. Example:50%','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '100%', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_single_blog_settings',
		'type'=> 'text'
	));

	// Grid layout setting
	$wp_customize->add_section( 'vw_healthcare_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_healthcare_grid_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_grid_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_grid_layout_settings',
		'setting'	=> 'vw_healthcare_grid_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_healthcare_grid_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_grid_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-healthcare' ),
        'section' => 'vw_healthcare_grid_layout_settings'
    )));

	$wp_customize->add_setting('vw_healthcare_grid_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_grid_author_icon',array(
		'label'	=> __('Add Author Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_grid_layout_settings',
		'setting'	=> 'vw_healthcare_grid_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_healthcare_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_grid_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-healthcare' ),
		'section' => 'vw_healthcare_grid_layout_settings'
    )));

   	$wp_customize->add_setting('vw_healthcare_grid_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_grid_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_grid_layout_settings',
		'setting'	=> 'vw_healthcare_grid_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_healthcare_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_grid_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-healthcare' ),
		'section' => 'vw_healthcare_grid_layout_settings'
    )));

 	$wp_customize->add_setting('vw_healthcare_grid_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_grid_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-healthcare'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-healthcare'),
		'section'=> 'vw_healthcare_grid_layout_settings',
		'type'=> 'text'
	));

	 $wp_customize->add_setting( 'vw_healthcare_grid_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_healthcare_grid_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-healthcare' ),
		'section'     => 'vw_healthcare_grid_layout_settings',
		'type'        => 'range',
		'settings'    => 'vw_healthcare_grid_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

  	$wp_customize->add_setting('vw_healthcare_grid_button_text',array(
		'default'=> esc_html__('Read More','vw-healthcare'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_grid_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Read More', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_grid_layout_settings',
		'type'=> 'text'
	)); 

    $wp_customize->add_setting('vw_healthcare_display_grid_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_display_grid_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Grid Posts','vw-healthcare'),
        'section' => 'vw_healthcare_grid_layout_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-healthcare'),
            'Without Blocks' => __('Without Blocks','vw-healthcare')
        ),
	) );
	
	$wp_customize->add_setting('vw_healthcare_grid_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_grid_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_grid_layout_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('vw_healthcare_grid_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_grid_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Grid Post Content','vw-healthcare'),
        'section' => 'vw_healthcare_grid_layout_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','vw-healthcare'),
            'Excerpt' => esc_html__('Excerpt','vw-healthcare'),
            'No Content' => esc_html__('No Content','vw-healthcare')
        ),
	) );

    $wp_customize->add_setting( 'vw_healthcare_grid_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_grid_featured_image_border_radius', array(
		'label'       => esc_html__( 'Grid Featured Image Border Radius','vw-healthcare' ),
		'section'     => 'vw_healthcare_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_healthcare_grid_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_grid_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Grid Featured Image Box Shadow','vw-healthcare' ),
		'section'     => 'vw_healthcare_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );
	
	//Other Settings
	$wp_customize->add_panel( $vw_healthcare_parent_panel );

	$OtherParentPanel = new VW_Healthcare_WP_Customize_Panel( $wp_customize, 'vw_healthcare_other_parent_panel', array(
		'title' => esc_html__( 'Other Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_panel_id',
		'priority' => 20,
	));

	$wp_customize->add_panel( $OtherParentPanel );

	// Layout
	$wp_customize->add_section( 'vw_healthcare_left_right', array(
    	'title' => esc_html__( 'General Settings', 'vw-healthcare' ),
		'panel' => 'vw_healthcare_other_parent_panel'
	) );

	$wp_customize->add_setting('vw_healthcare_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Healthcare_Image_Radio_Control($wp_customize, 'vw_healthcare_width_option', array(
        'type' => 'select',
        'label' => esc_html__('Width Layouts','vw-healthcare'),
        'description' => esc_html__('Here you can change the width layout of Website.','vw-healthcare'),
        'section' => 'vw_healthcare_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('vw_healthcare_page_layout',array(
        'default' => 'One_Column',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Page Sidebar Layout','vw-healthcare'),
        'description' => esc_html__('Here you can change the sidebar layout for pages. ','vw-healthcare'),
        'section' => 'vw_healthcare_left_right',
        'choices' => array(
            'Left_Sidebar' => esc_html__('Left Sidebar','vw-healthcare'),
            'Right_Sidebar' => esc_html__('Right Sidebar','vw-healthcare'),
            'One_Column' => esc_html__('One Column','vw-healthcare')
        ),
	) );

    $wp_customize->add_setting( 'vw_healthcare_single_page_breadcrumb',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_single_page_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Page Breadcrumb','vw-healthcare' ),
		'section' => 'vw_healthcare_left_right'
    )));

    //Wow Animation
	$wp_customize->add_setting( 'vw_healthcare_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_animation',array(
        'label' => esc_html__( 'Show / Hide Animations','vw-healthcare' ),
        'description' => __('Here you can disable overall site animation effect','vw-healthcare'),
        'section' => 'vw_healthcare_left_right'
    )));

    $wp_customize->add_setting('vw_healthcare_reset_all_settings',array(
      'sanitize_callback'	=> 'sanitize_text_field',
   	));
   	$wp_customize->add_control(new VW_Healthcare_Reset_Custom_Control($wp_customize, 'vw_healthcare_reset_all_settings',array(
      'type' => 'reset_control',
      'label' => __('Reset All Settings', 'vw-healthcare'),
      'description' => 'vw_healthcare_reset_all_settings',
      'section' => 'vw_healthcare_left_right'
   	)));

    //Pre-Loader
	$wp_customize->add_setting( 'vw_healthcare_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_loader_enable',array(
        'label' => esc_html__( 'Show / Hide Pre-Loader','vw-healthcare' ),
        'section' => 'vw_healthcare_left_right'
    )));

	$wp_customize->add_setting('vw_healthcare_preloader_bg_color', array(
		'default'           => '#2cd7bd',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_left_right',
	)));

	$wp_customize->add_setting('vw_healthcare_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_left_right',
	)));

	$wp_customize->add_setting('vw_healthcare_preloader_bg_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_healthcare_preloader_bg_img',array(
        'label' => __('Preloader Background Image','vw-healthcare'),
        'section' => 'vw_healthcare_left_right'
	)));

    //404 Page Setting
	$wp_customize->add_section('vw_healthcare_404_page',array(
		'title'	=> __('404 Page Settings','vw-healthcare'),
		'panel' => 'vw_healthcare_other_parent_panel',
	));

	$wp_customize->add_setting('vw_healthcare_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_healthcare_404_page_title',array(
		'label'	=> __('Add Title','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_healthcare_404_page_content',array(
		'label'	=> __('Add Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to the home page', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('vw_healthcare_no_results_page',array(
		'title'	=> __('No Results Page Settings','vw-healthcare'),
		'panel' => 'vw_healthcare_other_parent_panel',
	));	

	$wp_customize->add_setting('vw_healthcare_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_healthcare_no_results_page_title',array(
		'label'	=> __('Add Title','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_healthcare_no_results_page_content',array(
		'label'	=> __('Add Text','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_healthcare_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-healthcare'),
		'panel' => 'vw_healthcare_other_parent_panel',
	));

	$wp_customize->add_setting('vw_healthcare_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_social_icon_width',array(
		'label'	=> __('Icon Width','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_social_icon_height',array(
		'label'	=> __('Icon Height','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_social_icon_settings',
		'type'=> 'text'
	));

	//Responsive Media Settings
	$wp_customize->add_section('vw_healthcare_responsive_media',array(
		'title'	=> esc_html__('Responsive Media','vw-healthcare'),
		'panel' => 'vw_healthcare_other_parent_panel',
	));

    $wp_customize->add_setting( 'vw_healthcare_resp_slider_hide_show',array(
      	'default' => 1,
     	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_resp_slider_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Slider','vw-healthcare' ),
      	'section' => 'vw_healthcare_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_healthcare_sidebar_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_sidebar_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Sidebar','vw-healthcare' ),
      	'section' => 'vw_healthcare_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_healthcare_resp_scroll_top_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_resp_scroll_top_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-healthcare' ),
      	'section' => 'vw_healthcare_responsive_media'
    )));

    $wp_customize->add_setting('vw_healthcare_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_responsive_media',
		'setting'	=> 'vw_healthcare_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_healthcare_res_close_menu_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Healthcare_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_healthcare_res_close_menu_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-healthcare'),
		'transport' => 'refresh',
		'section'	=> 'vw_healthcare_responsive_media',
		'setting'	=> 'vw_healthcare_res_close_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_healthcare_resp_menu_toggle_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_healthcare_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'vw-healthcare'),
		'section'  => 'vw_healthcare_responsive_media',
	)));

	
    //Woocommerce settings
	$wp_customize->add_section('vw_healthcare_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-healthcare'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Shop Page Featured Image
	$wp_customize->add_setting( 'vw_healthcare_shop_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_shop_featured_image_border_radius', array(
		'label'       => esc_html__( 'Shop Page Featured Image Border Radius','vw-healthcare' ),
		'section'     => 'vw_healthcare_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_healthcare_shop_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_healthcare_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_healthcare_shop_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Shop Page Featured Image Box Shadow','vw-healthcare' ),
		'section'     => 'vw_healthcare_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_healthcare_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'vw_healthcare_customize_partial_vw_healthcare_woocommerce_shop_page_sidebar', ) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_healthcare_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Shop Page Sidebar','vw-healthcare' ),
		'section' => 'vw_healthcare_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_healthcare_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','vw-healthcare'),
        'section' => 'vw_healthcare_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-healthcare'),
            'Right Sidebar' => __('Right Sidebar','vw-healthcare'),
        ),
	) );

     //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_healthcare_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'vw_healthcare_customize_partial_vw_healthcare_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_healthcare_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Single Product Sidebar','vw-healthcare' ),
		'section' => 'vw_healthcare_woocommerce_section'
    )));

   	$wp_customize->add_setting('vw_healthcare_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','vw-healthcare'),
        'section' => 'vw_healthcare_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-healthcare'),
            'Right Sidebar' => __('Right Sidebar','vw-healthcare'),
        ),
	) );

	$wp_customize->add_setting('vw_healthcare_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_woocommerce_section',
		'type'=> 'text'
	));

    //Products Sale Badge
	$wp_customize->add_setting('vw_healthcare_woocommerce_sale_position',array(
        'default' => 'left',
        'sanitize_callback' => 'vw_healthcare_sanitize_choices'
	));
	$wp_customize->add_control('vw_healthcare_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','vw-healthcare'),
        'section' => 'vw_healthcare_woocommerce_section',
        'choices' => array(
            'left' => __('Left','vw-healthcare'),
            'right' => __('Right','vw-healthcare'),
        ),
	) );

	$wp_customize->add_setting('vw_healthcare_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_woocommerce_sale_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_woocommerce_sale_padding_top_bottom',array(
		'label'	=> __('Sale Padding Top Bottom','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_healthcare_woocommerce_sale_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_healthcare_woocommerce_sale_padding_left_right',array(
		'label'	=> __('Sale Padding Left Right','vw-healthcare'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-healthcare'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-healthcare' ),
        ),
		'section'=> 'vw_healthcare_woocommerce_section',
		'type'=> 'text'
	));

  	// Related Product
    $wp_customize->add_setting( 'vw_healthcare_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_healthcare_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Healthcare_Toggle_Switch_Custom_Control( $wp_customize, 'vw_healthcare_related_product_show_hide',array(
        'label' => esc_html__( 'Show / Hide Related product','vw-healthcare' ),
        'section' => 'vw_healthcare_woocommerce_section'
    )));


    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Healthcare_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Healthcare_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_healthcare_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Healthcare_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_healthcare_panel';
	    public function json() {
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;
			return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Healthcare_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'vw_healthcare_section';
	    public function json() {
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;

			if ( $this->panel ) {
			$array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
			} else {
			$array['customizeAction'] = 'Customizing';
			}
			return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_healthcare_Customize_controls_scripts() {
	wp_enqueue_script( 'vw-healthcare-customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_healthcare_Customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Healthcare_Customize {

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
		$manager->register_section_type( 'VW_Healthcare_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new VW_Healthcare_Customize_Section_Pro( $manager,'vw_healthcare_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW Healthcare Pro', 'vw-healthcare' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-healthcare' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/healthcare-wordpress-theme/'),
		) )	);

		$manager->add_section(new VW_Healthcare_Customize_Section_Pro($manager,'vw_healthcare_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-healthcare' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-healthcare' ),
			'pro_url'  => esc_url('https://preview.vwthemesdemo.com/docs/free-vw-healthcare/'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-healthcare-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-healthcare-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );

		wp_localize_script(
		'vw-healthcare-customize-controls',
		'vw_healthcare_customizer_params',
		array(
			'ajaxurl' =>	admin_url( 'admin-ajax.php' )
		));
	}
}

// Doing this customizer thang!
VW_Healthcare_Customize::get_instance();