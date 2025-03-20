<?php 
	$wp_customize->add_panel( 'wpdevart_tistore_single_post_page_panel', 
	array(
		'title'	=> esc_html__('Single Post/Page','tistore'),			
		'description'	=> esc_html__('Single Post/Page settings','tistore'),		
		'priority'		=> 25
	) 
	);

	##################------ Single Post ------##################

	$wp_customize->add_section('wpdevart_tistore_single_post_section',array(
		'title'	=> esc_html__('Single Post','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_single_post_page_panel'
	));

	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_single_post_banner_width',array(
			'label'	=> esc_html__('Single post banner width','tistore'),
			'section'	=> 'wpdevart_tistore_single_post_section',
			'setting'	=> 'wpdevart_tistore_single_post_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','tistore'),
				'wide' => esc_html__('Wide','tistore')
				)
	));	
	$wp_customize->add_setting('wpdevart_tistore_single_post_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_single_post_title_alignment',array(
			'label'	=> esc_html__('Position of elements','tistore'),
			'section'	=> 'wpdevart_tistore_single_post_section',
			'setting'	=> 'wpdevart_tistore_single_post_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','tistore'),
				'center' => esc_html__('Center','tistore'),
				'right' => esc_html__('Right','tistore')
				)
	));	
	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_post_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_post_banner_bg_color', array(
        'label' => esc_html__('Single post banner BG color','tistore'),
        'section' => 'wpdevart_tistore_single_post_section',
        'settings' => 'wpdevart_tistore_single_post_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_single_post_banner_gradient_type',array(
			'label'	=> esc_html__('Single post banner gradient type','tistore'),
			'section'	=> 'wpdevart_tistore_single_post_section',
			'setting'	=> 'wpdevart_tistore_single_post_banner_gradient_type',
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
	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_post_banner_gradient_color', esc_html('#fcfeff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_post_banner_gradient_color', array(
        'label' => esc_html__('Single post banner gradient color','tistore'),
        'section' => 'wpdevart_tistore_single_post_section',
        'settings' => 'wpdevart_tistore_single_post_banner_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_post_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_post_banner_title_color', array(
        'label' => esc_html__('Banner/Single Post title color','tistore'),
        'section' => 'wpdevart_tistore_single_post_section',
        'settings' => 'wpdevart_tistore_single_post_banner_title_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_entry_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_post_banner_entry_text_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_post_banner_entry_text_color', array(
        'label' => esc_html__('Banner text color','tistore'),
        'section' => 'wpdevart_tistore_single_post_section',
        'settings' => 'wpdevart_tistore_single_post_banner_entry_text_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_entry_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_post_banner_entry_link_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_post_banner_entry_link_color', array(
        'label' => esc_html__('Banner link color','tistore'),
        'section' => 'wpdevart_tistore_single_post_section',
        'settings' => 'wpdevart_tistore_single_post_banner_entry_link_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_post_banner_entry_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_post_banner_entry_link_hover_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_post_banner_entry_link_hover_color', array(
        'label' => esc_html__('Banner link hover color','tistore'),
        'section' => 'wpdevart_tistore_single_post_section',
        'settings' => 'wpdevart_tistore_single_post_banner_entry_link_hover_color'
    )));
    $wp_customize->add_setting( 'wpdevart_tistore_single_post_layout',
	array(
		'default' => esc_html('sidebarright'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_tistore_single_post_layout',
	array(
		'label' => esc_html__( 'Single Post Layout', 'tistore' ),
		'description' => esc_html__( 'Choose the single post layout.', 'tistore' ),
		'section' => 'wpdevart_tistore_single_post_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'tistore' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'tistore' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'tistore' )
		)
		)
	)
	) );

	##################------ Single Page ------##################

	$wp_customize->add_section('wpdevart_tistore_single_page_section',array(
		'title'	=> esc_html__('Single Page','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_single_post_page_panel'
	));

	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_single_page_banner_width',array(
			'label'	=> esc_html__('Single page banner width','tistore'),
			'section'	=> 'wpdevart_tistore_single_page_section',
			'setting'	=> 'wpdevart_tistore_single_page_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','tistore'),
				'wide' => esc_html__('Wide','tistore')
				)
	));	
	$wp_customize->add_setting('wpdevart_tistore_single_page_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_single_page_title_alignment',array(
			'label'	=> esc_html__('Position of elements','tistore'),
			'section'	=> 'wpdevart_tistore_single_page_section',
			'setting'	=> 'wpdevart_tistore_single_page_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','tistore'),
				'center' => esc_html__('Center','tistore'),
				'right' => esc_html__('Right','tistore')
				)
	));	
	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_page_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_page_banner_bg_color', array(
        'label' => esc_html__('Single page banner BG color','tistore'),
        'section' => 'wpdevart_tistore_single_page_section',
        'settings' => 'wpdevart_tistore_single_page_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_tistore_single_page_banner_gradient_type',array(
			'label'	=> esc_html__('Single page banner gradient type','tistore'),
			'section'	=> 'wpdevart_tistore_single_page_section',
			'setting'	=> 'wpdevart_tistore_single_page_banner_gradient_type',
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
	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_page_banner_gradient_color', esc_html('#fcfeff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_page_banner_gradient_color', array(
        'label' => esc_html__('Single page banner gradient color','tistore'),
        'section' => 'wpdevart_tistore_single_page_section',
        'settings' => 'wpdevart_tistore_single_page_banner_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_page_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_page_banner_title_color', array(
        'label' => esc_html__('Banner/Single page title color','tistore'),
        'section' => 'wpdevart_tistore_single_page_section',
        'settings' => 'wpdevart_tistore_single_page_banner_title_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_entry_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_page_banner_entry_text_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_page_banner_entry_text_color', array(
        'label' => esc_html__('Banner text color','tistore'),
        'section' => 'wpdevart_tistore_single_page_section',
        'settings' => 'wpdevart_tistore_single_page_banner_entry_text_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_entry_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_page_banner_entry_link_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_page_banner_entry_link_color', array(
        'label' => esc_html__('Banner link color','tistore'),
        'section' => 'wpdevart_tistore_single_page_section',
        'settings' => 'wpdevart_tistore_single_page_banner_entry_link_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_single_page_banner_entry_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_single_page_banner_entry_link_hover_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_single_page_banner_entry_link_hover_color', array(
        'label' => esc_html__('Banner link hover color','tistore'),
        'section' => 'wpdevart_tistore_single_page_section',
        'settings' => 'wpdevart_tistore_single_page_banner_entry_link_hover_color'
    )));
    $wp_customize->add_setting( 'wpdevart_tistore_single_page_layout',
	array(
		'default' => esc_html('sidebarnone'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_tistore_single_page_layout',
	array(
		'label' => esc_html__( 'Single Page Layout', 'tistore' ),
		'description' => esc_html__( 'Choose the single page layout.', 'tistore' ),
		'section' => 'wpdevart_tistore_single_page_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'tistore' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'tistore' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'tistore' )
		)
		)
	)
	) );

	##################------ Breadcrumbs ------##################

	$wp_customize->add_section('wpdevart_tistore_breadcrumbs_section',array(
		'title'	=> esc_html__('Breadcrumbs','tistore'),
		'description'	=> esc_html__('This section is for single posts and pages only. If you want to enable/edit WooCommerce breadcrumbs, you can do so from the WooCommerce WpDevArt section.','tistore'),	
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_single_post_page_panel'
	));

	$wp_customize->add_setting( 'wpdevart_tistore_post_breadcrumbs_display_option',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_tistore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_tistore_post_breadcrumbs_display_option',
        array(
        'label' => esc_html__( 'Enable Post Breadcrumbs', 'tistore' ),
		'description' => esc_html__( 'Check the option if you need to display the breadcrumbs for the single post.', 'tistore' ),
        'section' => 'wpdevart_tistore_breadcrumbs_section'
        )
    ) );
	$wp_customize->add_setting( 'wpdevart_tistore_page_breadcrumbs_display_option',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_tistore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_tistore_page_breadcrumbs_display_option',
        array(
        'label' => esc_html__( 'Enable Page Breadcrumbs', 'tistore' ),
		'description' => esc_html__( 'Check the option if you need to display the breadcrumbs for the single page.', 'tistore' ),
        'section' => 'wpdevart_tistore_breadcrumbs_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_tistore_page_breadcrumbs_home_text',array(
		'default'	=> esc_html('Home'),'tistore',
		'sanitize_callback'	=> 'wpdevart_tistore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_tistore_page_breadcrumbs_home_text',
            array(
                'label'    => esc_html__('Breadcrumb Home Text','tistore'),
                'section'  => 'wpdevart_tistore_breadcrumbs_section',
                'settings' => 'wpdevart_tistore_page_breadcrumbs_home_text',
                'type'     => 'text'
            )
        )
    );

	##################------ Comments ------##################

	$wp_customize->add_section('wpdevart_tistore_comments_settings',array(
		'title'	=> esc_html__('Comments Box','tistore'),
		'description'	=> esc_html__('The Comment Box is a block of user responses. Other comments section settings can be managed on the General settings page (for example, the Post Comment button can be controlled in the Primary Button section, or the text colors for Comment*, Name*, Email*, or Website can be controlled in the Colors section).','tistore'),	
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_single_post_page_panel'
	));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_box_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_box_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_box_bg_color', array(
        'label' => esc_html__('Comments reply box background color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_box_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_box_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_box_text_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_box_text_color', array(
        'label' => esc_html__('Comments reply box text color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_box_text_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_box_heading_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_box_heading_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_box_heading_color', array(
        'label' => esc_html__('Comments reply box heading color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_box_heading_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_box_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_box_link_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_box_link_color', array(
        'label' => esc_html__('Comments reply box link color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_box_link_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_box_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_box_link_hover_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_box_link_hover_color', array(
        'label' => esc_html__('Comments reply box link hover color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_box_link_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_button_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_button_bg_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_button_bg_color', array(
        'label' => esc_html__('Comments reply button bg color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_button_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_button_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_button_border_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_button_border_color', array(
        'label' => esc_html__('Comments reply button border color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_button_border_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_button_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_button_link_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_button_link_color', array(
        'label' => esc_html__('Comments reply button link color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_button_link_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_button_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_button_bg_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_button_bg_hover_color', array(
        'label' => esc_html__('Comments reply button bg hover color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_button_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_button_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_button_border_hover_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_button_border_hover_color', array(
        'label' => esc_html__('Comments reply button border hover color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_button_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_comments_reply_button_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_comments_reply_button_link_hover_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_comments_reply_button_link_hover_color', array(
        'label' => esc_html__('Comments reply button link hover color','tistore'),
        'section' => 'wpdevart_tistore_comments_settings',
        'settings' => 'wpdevart_tistore_comments_reply_button_link_hover_color'
    )));