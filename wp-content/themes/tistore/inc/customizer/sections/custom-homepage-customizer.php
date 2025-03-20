<?php
	$wp_customize->add_panel( 'wpdevart_tistore_custom_homepage_panel', 
    array(
		'title'	=> esc_html__('Custom Homepage','tistore'),
        'description'	=> esc_html__('Customize the theme custom homepage','tistore'),		
		'priority'		=> 28
    ) 
	);
	$wp_customize->add_section('wpdevart_tistore_custom_homepage_section',array(
		'title'	=> esc_html__('Enable Custom Homepage','tistore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_custom_homepage_panel'
	));
    $wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_display_option',
    array(
       'default' => esc_html('1'),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_tistore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_tistore_custom_homepage_display_option',
        array(
        'label' => esc_html__( 'Enable custom homepage', 'tistore' ),
		'description' => esc_html__( 'Display custom homepage instead of the latest posts', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_section'
        )
    ) );

	$wp_customize->add_section('wpdevart_tistore_custom_homepage_general_section',array(
		'title'	=> esc_html__('General','tistore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_custom_homepage_panel'
	));
	$wp_customize->add_setting('wpdevart_tistore_homepage_sections_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_homepage_sections_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_homepage_sections_title_color', array(
        'label' => esc_html__('Sections Title Color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_general_section',
        'settings' => 'wpdevart_tistore_homepage_sections_title_color'
    )));
	
	$wp_customize->add_section('wpdevart_tistore_custom_homepage_banner_section',array(
		'title'	=> esc_html__('Banner Section','tistore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_custom_homepage_panel'
	));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_theme',array(
		'default'	=> esc_html('banner-first-theme'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_tistore_custom_homepage_banner_theme',array(
			'label'	=> esc_html__('Banner Theme','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_tistore_custom_homepage_banner_theme',
			'type' => 'select',
			'choices' => array(
				'banner-first-theme' => esc_html__('First Theme', 'tistore'),
				'banner-second-theme' => esc_html__('Second Theme', 'tistore'),
				)
	));	
	$wp_customize->add_setting('wpdevart_tistore_homepage_large_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_homepage_large_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_homepage_large_banner_bg_color', array(
        'label' => esc_html__('Banner background color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_homepage_large_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_homepage_large_banner_bg_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_tistore_homepage_large_banner_bg_gradient_type',array(
			'label'	=> esc_html__('Gradient type','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_tistore_homepage_large_banner_bg_gradient_type',
			'type' => 'select',
			'choices' => array(
				'to right' => esc_html__('To right','tistore'),
				'to left' => esc_html__('To left','tistore'),
				'to bottom' => esc_html__('To bottom','tistore'),
				'to top' => esc_html__('To top','tistore'),
				'to bottom right' => esc_html__('To bottom right','tistore'),
				'to bottom left' => esc_html__('To bottom left','tistore'),
				'to top right' => esc_html__('To top right','tistore'),
				'to top left' => esc_html__('To top left','tistore'),
				)
	));
	$wp_customize->add_setting('wpdevart_tistore_homepage_large_banner_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_homepage_large_banner_bg_gradient_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_homepage_large_banner_bg_gradient_color', array(
        'label' => esc_html__('Banner background gradient color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_homepage_large_banner_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_short_description',array(
		'default'	=> esc_html('An online store that delivers more than expected!'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_short_description',
            array(
                'label'    => esc_html__('Banner short description','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_short_description',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_banner_short_description_font_size',
    array(
       'default' => esc_html('17'),
       'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_short_description_font_size',
		array(
		'label' => esc_html__( 'Short description font-size (px)', 'tistore' ),
		'section' => 'wpdevart_tistore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('35'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_short_description_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_custom_homepage_banner_short_description_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_short_description_color', array(
        'label' => esc_html__('Short description color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_short_description_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_title',array(
		'default'	=> esc_html('Best Online Store'),'tistore',
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_title',
            array(
                'label'    => esc_html__('Banner title','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_title',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_banner_title_font_size',
    array(
       'default' => esc_html('43'),
       'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_title_font_size',
		array(
		'label' => esc_html__( 'Title font-size (px)', 'tistore' ),
		'section' => 'wpdevart_tistore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('90'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_custom_homepage_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_title_color', array(
        'label' => esc_html__('Banner title color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_title_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_sliding_first_text',array(
		'default'	=> esc_html('Express Delivery'),'tistore',
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_sliding_first_text',
            array(
                'label'    => esc_html__('First sliding text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_sliding_first_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_sliding_second_text',array(
		'default'	=> esc_html('Valuable Prices'),'tistore',
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_sliding_second_text',
            array(
                'label'    => esc_html__('Second sliding text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_sliding_second_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_sliding_third_text',array(
		'default'	=> esc_html('24/7 Support'),'tistore',
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_sliding_third_text',
            array(
                'label'    => esc_html__('Third sliding text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_sliding_third_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_sliding_fourth_text',array(
		'default'	=> esc_html('Guaranteed Quality'),'tistore',
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_sliding_fourth_text',
            array(
                'label'    => esc_html__('Fourth sliding text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_sliding_fourth_text',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_banner_sliding_text_font_size',
    array(
       'default' => esc_html('37'),
       'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_sliding_text_font_size',
		array(
		'label' => esc_html__( 'Sliding text font-size (px)', 'tistore' ),
		'section' => 'wpdevart_tistore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('35'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_sliding_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_custom_homepage_banner_sliding_text_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_sliding_text_color', array(
        'label' => esc_html__('Sliding text title color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_sliding_text_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_content',array(
		'default'	=> esc_html('We offer all services in one place including express delivery, 24/7 support, competitive prices, and guaranteed quality. Use the navigation buttons below to find out more information about us and our services. Share and tell your friends about it.'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_content',
            array(
                'label'    => esc_html__('Banner content text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_content',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_banner_content_font_size',
    array(
       'default' => esc_html('17'),
       'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_content_font_size',
		array(
		'label' => esc_html__( 'Content text font-size (px)', 'tistore' ),
		'section' => 'wpdevart_tistore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('35'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_content_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_custom_homepage_banner_content_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_content_color', array(
        'label' => esc_html__('Banner content text color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_content_color'
    )));
	$wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_show_banner_first_button',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_tistore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_tistore_custom_homepage_show_banner_first_button',
        array(
        'label' => esc_html__( 'Hide the first button', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_first_button_text',array(
		'default'	=> esc_html('More Details'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_first_button_text',
            array(
                'label'    => esc_html__('First button text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_first_button_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_first_button_url',array(
		'default'	=> esc_url('#'),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'
	));
	$wp_customize->add_control('wpdevart_tistore_custom_homepage_banner_first_button_url',array(
			'label'	=> esc_html__('First button URL','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_tistore_custom_homepage_banner_first_button_url'
	));	
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_first_button_style',array(
		'default'	=> esc_html('wpdevart_tistore_primary_button_slide primary_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_tistore_custom_homepage_banner_first_button_style',array(
			'label'	=> esc_html__('First button color','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_tistore_custom_homepage_banner_first_button_style',
			'type' => 'select',
			'choices' => array(
				'wpdevart_tistore_primary_button_slide primary_btn_slide_right' => esc_html__('Custom Primary', 'tistore'),
				'wpdevart_tistore_secondary_button_slide secondary_btn_slide_right' => esc_html__('Custom Secondary', 'tistore'),
				'wpdevart_tistore_first_button_slide first_btn_slide_right' => esc_html__('WpDevArt Color', 'tistore'),
				'wpdevart_tistore_second_button_slide second_btn_slide_right' => esc_html__('Grapefruit Red', 'tistore'),
				'wpdevart_tistore_third_button_slide third_btn_slide_right' => esc_html__('Blue', 'tistore'),
				'wpdevart_tistore_fourth_button_slide fourth_btn_slide_right' => esc_html__('Black', 'tistore'),
				'wpdevart_tistore_fifth_button_slide fifth_btn_slide_right' => esc_html__('Green', 'tistore'),
				'wpdevart_tistore_sixth_button_slide sixth_btn_slide_right' => esc_html__('Yellow', 'tistore'),
				'wpdevart_tistore_seventh_button_slide seventh_btn_slide_right' => esc_html__('Custom Green', 'tistore'),
				'wpdevart_tistore_eighth_button_slide eighth_btn_slide_right' => esc_html__('White', 'tistore'),
				)
	));
	$wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_show_banner_second_button',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_tistore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_tistore_custom_homepage_show_banner_second_button',
        array(
        'label' => esc_html__( 'Hide the second button', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_second_button_text',array(
		'default'	=> esc_html('Shop Now'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_banner_second_button_text',
            array(
                'label'    => esc_html__('Second button text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_banner_section',
                'settings' => 'wpdevart_tistore_custom_homepage_banner_second_button_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_second_button_url',array(
		'default'	=> esc_url('#'),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'
	));
	$wp_customize->add_control('wpdevart_tistore_custom_homepage_banner_second_button_url',array(
			'label'	=> esc_html__('Second button URL','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_tistore_custom_homepage_banner_second_button_url'
	));	
	
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_second_button_style',array(
		'default'	=> esc_html('wpdevart_tistore_third_button_slide third_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_tistore_custom_homepage_banner_second_button_style',array(
			'label'	=> esc_html__('Second button color','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_tistore_custom_homepage_banner_second_button_style',
			'type' => 'select',
			'choices' => array(
				'wpdevart_tistore_primary_button_slide primary_btn_slide_right' => esc_html__('Custom Primary', 'tistore'),
				'wpdevart_tistore_secondary_button_slide secondary_btn_slide_right' => esc_html__('Custom Secondary', 'tistore'),
				'wpdevart_tistore_first_button_slide first_btn_slide_right' => esc_html__('WpDevArt Color', 'tistore'),
				'wpdevart_tistore_second_button_slide second_btn_slide_right' => esc_html__('Grapefruit Red', 'tistore'),
				'wpdevart_tistore_third_button_slide third_btn_slide_right' => esc_html__('Blue', 'tistore'),
				'wpdevart_tistore_fourth_button_slide fourth_btn_slide_right' => esc_html__('Black', 'tistore'),
				'wpdevart_tistore_fifth_button_slide fifth_btn_slide_right' => esc_html__('Green', 'tistore'),
				'wpdevart_tistore_sixth_button_slide sixth_btn_slide_right' => esc_html__('Yellow', 'tistore'),
				'wpdevart_tistore_seventh_button_slide seventh_btn_slide_right' => esc_html__('Custom Green', 'tistore'),
				'wpdevart_tistore_eighth_button_slide eighth_btn_slide_right' => esc_html__('White', 'tistore'),
				)
	));	
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_image_1',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-1.jpg')),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_image_1', array(
        'label' => esc_html__('Banner Main Image','tistore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_image_1',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','tistore'),
                    'remove' => esc_html__('Remove Image','tistore'),
                    'change' => esc_html__('Change Image','tistore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_image_2',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-2.png')),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_image_2', array(
        'label' => esc_html__('Banner Second Image','tistore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_image_2',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','tistore'),
                    'remove' => esc_html__('Remove Image','tistore'),
                    'change' => esc_html__('Change Image','tistore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_image_3',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-3.png')),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_image_3', array(
        'label' => esc_html__('Banner Third Image','tistore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_image_3',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','tistore'),
                    'remove' => esc_html__('Remove Image','tistore'),
                    'change' => esc_html__('Change Image','tistore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_banner_image_4',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-4.png')),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_image_4', array(
        'label' => esc_html__('Banner Fourth Image','tistore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'settings' => 'wpdevart_tistore_custom_homepage_banner_image_4',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','tistore'),
                    'remove' => esc_html__('Remove Image','tistore'),
                    'change' => esc_html__('Change Image','tistore'),
                    )
    )));

	$wp_customize->add_section('wpdevart_tistore_custom_homepage_call_action_section',array(
		'title'	=> esc_html__('Call to Action Section','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_custom_homepage_panel'
	));

	$wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_hide_call_action',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_tistore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_tistore_custom_homepage_hide_call_action',
        array(
        'label' => esc_html__( 'Hide Call to Action section', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_call_action_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_action_title',array(
		'default'	=> esc_html('Best Offer'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_call_action_title',
            array(
                'label'    => esc_html__('Call to action title','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_tistore_custom_homepage_call_action_title',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_action_desc',array(
		'default'	=> esc_html('A brief description of the section below.'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_call_action_desc',
            array(
                'label'    => esc_html__('Call to action description','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_tistore_custom_homepage_call_action_desc',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_to_action_image',array(
		'default'	=> esc_url(get_theme_file_uri('/images/call-to-action.jpg')),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_call_to_action_image', array(
        'label' => esc_html__('Call To Action Image','tistore'),
		'description' => esc_html__( 'Recommended image size ~1200*600', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_tistore_custom_homepage_call_to_action_image',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','tistore'),
                    'remove' => esc_html__('Remove Image','tistore'),
                    'change' => esc_html__('Change Image','tistore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_tistore_call_action_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_call_action_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_call_action_bg_color', array(
        'label' => esc_html__('Call to action background color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_tistore_call_action_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_call_action_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_call_action_gradient_type',array(
			'label'	=> esc_html__('Gradient type','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_call_action_section',
			'setting'	=> 'wpdevart_tistore_call_action_gradient_type',
			'type' => 'select',
			'choices' => array(
				'to right' => esc_html__('To right','tistore'),
				'to left' => esc_html__('To left','tistore'),
				'to bottom' => esc_html__('To bottom','tistore'),
				'to top' => esc_html__('To top','tistore'),
				'to bottom right' => esc_html__('To bottom right','tistore'),
				'to bottom left' => esc_html__('To bottom left','tistore'),
				'to top right' => esc_html__('To top right','tistore'),
				'to top left' => esc_html__('To top left','tistore'),
				)
	));	
	$wp_customize->add_setting('wpdevart_tistore_call_action_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_call_action_bg_gradient_color', esc_html('#fcfcfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_call_action_bg_gradient_color', array(
        'label' => esc_html__('Call to action background gradient color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_tistore_call_action_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_action_sub_title',array(
		'default'	=> esc_html('Call to Action Title'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_call_action_sub_title',
            array(
                'label'    => esc_html__('Call to action subtitle','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_tistore_custom_homepage_call_action_sub_title',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_call_action_sub_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_call_action_sub_title_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_call_action_sub_title_color', array(
        'label' => esc_html__('Call to action subtitle color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_tistore_call_action_sub_title_color'
    )));

    $wp_customize->add_setting( 'wpdevart_tistore_call_action_sub_title_font_size',
    array(
       'default' => esc_html('30'),
       'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_call_action_sub_title_font_size',
		array(
		'label' => esc_html__( 'Call to action subtitle font-size (px)', 'tistore' ),
		'section' => 'wpdevart_tistore_custom_homepage_call_action_section',
		'input_attrs' => array(
			'min' => esc_html('25'),
			'max' => esc_html('45'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_action_text',array(
		'default'	=> esc_html('This is sample text for a call to action section. You can use this section to encourage users to click a button and find out more information about your services.'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_call_action_text',
            array(
                'label'    => esc_html__('Call to action text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_tistore_custom_homepage_call_action_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_call_action_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_call_action_text_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_call_action_text_color', array(
        'label' => esc_html__('Call to action text color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_tistore_call_action_text_color'
    )));

    $wp_customize->add_setting( 'wpdevart_tistore_call_action_text_font_size',
    array(
       'default' => esc_html('16'),
       'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_call_action_text_font_size',
		array(
		'label' => esc_html__( 'Call to action text font-size (px)', 'tistore' ),
		'section' => 'wpdevart_tistore_custom_homepage_call_action_section',
		'input_attrs' => array(
			'min' => esc_html('15'),
			'max' => esc_html('45'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_action_button_text',array(
		'default'	=> esc_html('Check More Details'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_call_action_button_text',
            array(
                'label'    => esc_html__('Call to action button text','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_tistore_custom_homepage_call_action_button_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_action_button_url',array(
		'default'	=> esc_url('#'),
		'sanitize_callback'	=> 'wpdevart_tistore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_custom_homepage_call_action_button_url',array(
			'label'	=> esc_html__('Call to action button URL','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_call_action_section',
			'setting'	=> 'wpdevart_tistore_custom_homepage_call_action_button_url'
	));		

	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_call_action_button_style',array(
		'default'	=> esc_html('wpdevart_tistore_primary_button_slide primary_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_tistore_custom_homepage_call_action_button_style',array(
			'label'	=> esc_html__('Call to action button color','tistore'),
			'section'	=> 'wpdevart_tistore_custom_homepage_call_action_section',
			'setting'	=> 'wpdevart_tistore_custom_homepage_call_action_button_style',
			'type' => 'select',
			'choices' => array(
				'wpdevart_tistore_primary_button_slide primary_btn_slide_right' => esc_html__('Custom Primary', 'tistore'),
				'wpdevart_tistore_secondary_button_slide secondary_btn_slide_right' => esc_html__('Custom Secondary', 'tistore'),
				'wpdevart_tistore_first_button_slide first_btn_slide_right' => esc_html__('WpDevArt Color', 'tistore'),
				'wpdevart_tistore_second_button_slide second_btn_slide_right' => esc_html__('Grapefruit Red', 'tistore'),
				'wpdevart_tistore_third_button_slide third_btn_slide_right' => esc_html__('Blue', 'tistore'),
				'wpdevart_tistore_fourth_button_slide fourth_btn_slide_right' => esc_html__('Black', 'tistore'),
				'wpdevart_tistore_fifth_button_slide fifth_btn_slide_right' => esc_html__('Green', 'tistore'),
				'wpdevart_tistore_sixth_button_slide sixth_btn_slide_right' => esc_html__('Yellow', 'tistore'),
				'wpdevart_tistore_seventh_button_slide seventh_btn_slide_right' => esc_html__('Custom Green', 'tistore'),
				'wpdevart_tistore_eighth_button_slide eighth_btn_slide_right' => esc_html__('White', 'tistore'),
				)
	));	
	$wp_customize->add_section('wpdevart_tistore_custom_homepage_latest_posts_section',array(
		'title'	=> esc_html__('Latest Posts Section','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_custom_homepage_panel'
	));

	$wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_hide_latest_post_section',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_tistore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_tistore_custom_homepage_hide_latest_post_section',
        array(
        'label' => esc_html__( 'Hide Latest Posts section', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_latest_posts_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_latest_post_title',array(
		'default'	=> esc_html('Latest Posts'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_latest_post_title',
            array(
                'label'    => esc_html__('Latest Posts section title','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_latest_posts_section',
                'settings' => 'wpdevart_tistore_custom_homepage_latest_post_title',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_latest_post_desctiption',array(
		'default'	=> esc_html('Latest posts from our blog'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_custom_homepage_latest_post_desctiption',
            array(
                'label'    => esc_html__('Latest Posts section description','tistore'),
                'section'  => 'wpdevart_tistore_custom_homepage_latest_posts_section',
                'settings' => 'wpdevart_tistore_custom_homepage_latest_post_desctiption',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_number_of_latest_posts',
    array(
       'default' => esc_html('6'),
       'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_number_of_latest_posts',
		array(
		'label' => esc_html__( 'The number of posts', 'tistore' ),
		'section' => 'wpdevart_tistore_custom_homepage_latest_posts_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('20'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_latest_posts_block_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_custom_homepage_latest_posts_block_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_latest_posts_block_color', array(
        'label' => esc_html__('Latest posts block bg color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_latest_posts_section',
        'settings' => 'wpdevart_tistore_custom_homepage_latest_posts_block_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_latest_posts_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_custom_homepage_latest_posts_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_latest_posts_title_color', array(
        'label' => esc_html__('Latest posts title color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_latest_posts_section',
        'settings' => 'wpdevart_tistore_custom_homepage_latest_posts_title_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_custom_homepage_latest_posts_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_custom_homepage_latest_posts_text_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_custom_homepage_latest_posts_text_color', array(
        'label' => esc_html__('Latest posts text color','tistore'),
        'section' => 'wpdevart_tistore_custom_homepage_latest_posts_section',
        'settings' => 'wpdevart_tistore_custom_homepage_latest_posts_text_color'
    )));