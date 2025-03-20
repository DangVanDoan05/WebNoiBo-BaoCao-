<?php

    $wp_customize->register_section_type( 'Wpdevart_Premium_Features_List' );


	##################------ Premium Features Sections ------##################

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_tistore_theme_general_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'tistore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_tistore_premium_features_url', esc_url('https://wpdevart.com/tistore-best-ecommerce-theme-for-wordpress')),
				'premium_features_list' => array(
					esc_html__( '+40 Other Popular Fonts', 'tistore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'tistore' ),
					esc_html__( 'Preloader', 'tistore' ),
                    esc_html__( 'Button Animation', 'tistore' ),
                    esc_html__( '+6 Beautiful Patterns', 'tistore' ),
					esc_html__( 'Customizable Search Overlay', 'tistore' ),
					esc_html__( 'Back To Top Button', 'tistore' ),
					esc_html__( '... and Other Premium Features', 'tistore' ),
				),
				'panel'         => 'wpdevart_tistore_general_settings_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_tistore_theme_header_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'tistore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_tistore_premium_features_url', esc_url('https://wpdevart.com/tistore-best-ecommerce-theme-for-wordpress')),
				'premium_features_list' => array(
					esc_html__( 'Sticky Header Feature', 'tistore' ),
					esc_html__( 'Sticky Header Feature for Mobile', 'tistore' ),
                    esc_html__( 'Logo Animations', 'tistore' ),
					esc_html__( 'Search Button Animations', 'tistore' ),
                    esc_html__( 'Woo Cart Animations', 'tistore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'tistore' ),
					esc_html__( '... and Other Premium Features', 'tistore' ),
				),
				'panel'         => 'wpdevart_tistore_header_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_tistore_theme_single_post_page_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'tistore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_tistore_premium_features_url', esc_url('https://wpdevart.com/tistore-best-ecommerce-theme-for-wordpress')),
				'premium_features_list' => array(
					esc_html__( '+6 Beautiful Patterns', 'tistore' ),
                    esc_html__( 'Post/Page Title Animations', 'tistore' ),
					esc_html__( 'Post/Page Banner Animations', 'tistore' ),
                    esc_html__( '4 Animated Banner Elements', 'tistore' ),
					esc_html__( 'Animated Elements Colors', 'tistore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'tistore' ),
					esc_html__( '... and Other Premium Features', 'tistore' ),
				),
				'panel'         => 'wpdevart_tistore_single_post_page_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_tistore_theme_blog_archive_search_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'tistore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_tistore_premium_features_url', esc_url('https://wpdevart.com/tistore-best-ecommerce-theme-for-wordpress')),
				'premium_features_list' => array(
					esc_html__( 'Images Hover Effects', 'tistore' ),
					esc_html__( 'Archive/Search Page Title Animations', 'tistore' ),
                    esc_html__( 'Archive/Search Page Banner Animations', 'tistore' ),
					esc_html__( '4 Animated Elements', 'tistore' ),
                    esc_html__( 'Animated Elements Colors', 'tistore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'tistore' ),
					esc_html__( '... and Other Premium Features', 'tistore' ),
				),
				'panel'         => 'wpdevart_tistore_blog_archive_search_panel',
				'priority'      => 7777,
			)
		)
	);

    $wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_tistore_theme_custom_homepage_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'tistore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_tistore_premium_features_url', esc_url('https://wpdevart.com/tistore-best-ecommerce-theme-for-wordpress')),
				'premium_features_list' => array(
                    esc_html__( '+4 Beautiful Banner Themes', 'tistore' ),
                    esc_html__( 'Homepage Sections Positions', 'tistore' ),
					esc_html__( 'WooCommerce Section', 'tistore' ),
					esc_html__( 'Sales Section', 'tistore' ),
                    esc_html__( 'Benefits of Ordering Section', 'tistore' ),
                    esc_html__( 'Shop by Brand Section', 'tistore' ),
                    esc_html__( 'Shop by Category Section', 'tistore' ),
					esc_html__( 'Achievements Section', 'tistore' ),
					esc_html__( 'Advantages Section', 'tistore' ),
					esc_html__( 'Services Section', 'tistore' ),
					esc_html__( 'Sections Description Color', 'tistore' ),
					esc_html__( 'Sections Title Lines Color', 'tistore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'tistore' ),
					esc_html__( '... and Other Premium Features', 'tistore' ),
				),
				'panel'         => 'wpdevart_tistore_custom_homepage_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_tistore_theme_woo_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'tistore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_tistore_premium_features_url', esc_url('https://wpdevart.com/tistore-best-ecommerce-theme-for-wordpress')),
				'premium_features_list' => array(
                    esc_html__( 'WooCommerce Search Bar Section', 'tistore' ),
                    esc_html__( 'Customizable Category List and Search Bar', 'tistore' ),
					esc_html__( 'WooCommerce Breadcrumbs', 'tistore' ),
					esc_html__( 'WooCommerce Header Cart Design', 'tistore' ),
                    esc_html__( 'WooCommerce Button Animation', 'tistore' ),
					esc_html__( 'WooCommerce Sidebar Options', 'tistore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'tistore' ),
					esc_html__( '... and Other Premium Features', 'tistore' ),
				),
				'panel'         => 'wpdevart_tistore_woocommerce_settings_panel',
				'priority'      => 7777,
			)
		)
	);
        
    ##################------ Premium Features Controls------##################

    $wp_customize->add_setting( 'wpdevart_tistore_logo_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization',
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_logo_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'title_tagline',
        'priority' => 50,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Text Logo Animations', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Text Logo Font-size', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Text Logo Font Weight', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_tistore_font_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_font_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_fonts_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+40 Other Popular Fonts', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_tistore_primary_button_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_primary_button_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_primary_button_settings',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Button Animation', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_tistore_header_general_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_header_general_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_header_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Sticky Header Feature', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Sticky Header Feature for Mobile', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Animations for Header Elements', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_tistore_top_header_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_top_header_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_top_header_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Address Section', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Phone/Email/Address Icon Color', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Animations for Top Header Elements', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    
    $wp_customize->add_setting( 'wpdevart_tistore_header_menu_search_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_header_menu_search_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_header_menu_search_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Search Button Animations', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );

	if ( class_exists( 'WooCommerce' ) ) {
    $wp_customize->add_setting( 'wpdevart_tistore_woo_primary_button_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_woo_primary_button_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'woocommerce_primary_button_colors_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'WooCommerce Button Animation', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    };

    $wp_customize->add_setting( 'wpdevart_tistore_single_post_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_single_post_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_single_post_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+6 Beautiful Patterns', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Title Animations', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Banner Animations', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '4 Animated Elements', 'tistore' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'tistore' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_tistore_single_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_single_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_single_page_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+6 Beautiful Patterns', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Title Animations', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Banner Animations', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '4 Animated Elements', 'tistore' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'tistore' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_tistore_blog_archive_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_blog_archive_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_blog_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Title Animations', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Banner Animations', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '4 Animated Elements', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'tistore' )
            ),
            'feature5' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_tistore_search_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_search_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_search_page_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Title Animations', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Banner Animations', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '4 Animated Elements', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'tistore' )
            ),
            'feature5' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_tistore_blog_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_blog_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_blog_archive_search_general_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Images Hover Effects', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Ordering of Metas', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_banner_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_custom_homepage_banner_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_banner_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+4 Beautiful Banner Themes', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_tistore_custom_homepage_general_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_custom_homepage_general_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_custom_homepage_general_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Ordering of Sections', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Sections Description Color', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Sections Title Lines Color', 'tistore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_tistore_footer_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_tistore_footer_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'tistore' ),
        'section' => 'wpdevart_tistore_footer_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+4 Beautiful Footer Themes', 'tistore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Copyright Section Image', 'tistore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '... and Other Premium Features', 'tistore' )
            ),
        )
    )
    ) );