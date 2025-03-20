<?php
/**
 * Affiliate Store Theme Customizer
 *
 * @package Affiliate Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function affiliate_store_customize_register( $wp_customize ) {

	function affiliate_store_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	wp_enqueue_style('affiliate-store-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	//Logo
    $wp_customize->add_setting('affiliate_store_logo_width', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'affiliate_store_sanitize_integer'
    ));
    $wp_customize->add_control(new Affiliate_Store_Slider_Custom_Control($wp_customize, 'affiliate_store_logo_width', array(
    	'label'          => __( 'Logo Width', 'affiliate-store'),
        'section' => 'title_tagline',
        'settings' => 'affiliate_store_logo_width',
        'input_attrs' => array(
            'step' => 1,
            'min' => 0,
            'max' => 150,
        ),
    )));

	// color site title
	$wp_customize->add_setting('affiliate_store_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'affiliate_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_sitetitle_color', array(
	   'settings' => 'affiliate_store_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'affiliate-store'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('affiliate_store_title_enable',array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'affiliate_store_title_enable', array(
	   'settings' => 'affiliate_store_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','affiliate-store'),
	   'type'      => 'checkbox'
	));

	// color site tagline
	$wp_customize->add_setting('affiliate_store_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'affiliate_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_sitetagline_color', array(
	   'settings' => 'affiliate_store_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'affiliate-store'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('affiliate_store_tagline_enable',array(
		'default' => false,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'affiliate_store_tagline_enable', array(
	   'settings' => 'affiliate_store_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','affiliate-store'),
	   'type'      => 'checkbox'
	));

	// woocommerce section
	$wp_customize->add_section('affiliate_store_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'affiliate-store'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('affiliate_store_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'affiliate_store_sanitize_checkbox'
	));
	$wp_customize->add_control('affiliate_store_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','affiliate-store'),
		'section' => 'affiliate_store_woocommerce_page_settings',
	));

    // shop page sidebar alignment
    $wp_customize->add_setting('affiliate_store_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'affiliate_store_sanitize_choices',
	));
	$wp_customize->add_control('affiliate_store_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'affiliate-store'),
		'section'        => 'affiliate_store_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'affiliate-store'),
			'Right Sidebar' => __('Right Sidebar', 'affiliate-store'),
		),
	));	 

	$wp_customize->add_setting('affiliate_store_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'affiliate_store_sanitize_choices'
	 ));
	 $wp_customize->add_control('affiliate_store_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','affiliate-store'),
		'choices' => array(
			 'Yes' => __('Yes','affiliate-store'),
			 'No' => __('No','affiliate-store'),
		 ),
		'section' => 'affiliate_store_woocommerce_page_settings',
	 ));

	 $wp_customize->add_setting( 'affiliate_store_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'affiliate_store_sanitize_checkbox'
    ) );
    $wp_customize->add_control('affiliate_store_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','affiliate-store'),
		'section' => 'affiliate_store_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('affiliate_store_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'affiliate_store_sanitize_choices',
	));
	$wp_customize->add_control('affiliate_store_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'affiliate-store'),
		'section'        => 'affiliate_store_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'affiliate-store'),
			'Right Sidebar' => __('Right Sidebar', 'affiliate-store'),
		),
	));

	$wp_customize->add_setting('affiliate_store_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'affiliate_store_sanitize_checkbox'
	));
	$wp_customize->add_control('affiliate_store_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','affiliate-store'),
		'section' => 'affiliate_store_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'affiliate_store_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'affiliate_store_sanitize_integer'
    ) );
    $wp_customize->add_control(new Affiliate_Store_Slider_Custom_Control( $wp_customize, 'affiliate_store_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Product Img Border Radius','affiliate-store'),
		'section'=> 'affiliate_store_woocommerce_page_settings',
		'settings'=>'affiliate_store_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

    // Add a setting for number of products per row
    $wp_customize->add_setting('affiliate_store_products_per_row', array(
	    'default'   => '4',
	    'transport' => 'refresh',
	    'sanitize_callback' => 'affiliate_store_sanitize_integer'  
    ));
    $wp_customize->add_control('affiliate_store_products_per_row', array(
	   'label'    => __('Products Per Row', 'affiliate-store'),
	   'section'  => 'affiliate_store_woocommerce_page_settings',
	   'settings' => 'affiliate_store_products_per_row',
	   'type'     => 'select',
	   'choices'  => array(
		      '2' => '2',
		'      3' => '3',
		      '4' => '4',
	  ),
    ));

	// Add a setting for the number of products per page
	$wp_customize->add_setting('affiliate_store_products_per_page', array(
		'default'   => '9',
		'transport' => 'refresh',
		'sanitize_callback' => 'affiliate_store_sanitize_integer'
	));
	$wp_customize->add_control('affiliate_store_products_per_page', array(
		'label'    => __('Products Per Page', 'affiliate-store'),
		'section'  => 'affiliate_store_woocommerce_page_settings',
		'settings' => 'affiliate_store_products_per_page',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
		),
	));	

   $wp_customize->add_setting('affiliate_store_product_sale_position',array(
	   'default' => 'Left',
	   'sanitize_callback' => 'affiliate_store_sanitize_choices'
	));
	$wp_customize->add_control('affiliate_store_product_sale_position',array(
		'type' => 'radio',
		'label' => __('Product Sale Position','affiliate-store'),
		'section' => 'affiliate_store_woocommerce_page_settings',
		'choices' => array(
			'Left' => __('Left','affiliate-store'),
			'Right' => __('Right','affiliate-store'),
		),
	) );   

	//Theme Options
	$wp_customize->add_panel( 'affiliate_store_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'affiliate-store' ),
	) );

	//Site Layout Section
	$wp_customize->add_section('affiliate_store_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','affiliate-store'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','affiliate-store'),
		'priority'	=> 1,
		'panel' => 'affiliate_store_panel_area',
	));

	$wp_customize->add_setting('affiliate_store_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'affiliate_store_box_layout', array(
	   'section'   => 'affiliate_store_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','affiliate-store'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('affiliate_store_preloader',array(
		'default' => false,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'affiliate_store_preloader', array(
	   'section'   => 'affiliate_store_site_layoutsec',
	   'label'	=> __('Check to Show preloader','affiliate-store'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('affiliate_store_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'affiliate_store_preloader_bg_image',array(
        'section' => 'affiliate_store_site_layoutsec',
		'label' => __('Preloader Background Image','affiliate-store'),
	)));

	$wp_customize->add_setting( 'affiliate_store_theme_page_breadcrumb',array(
		'default' => false,
        'sanitize_callback'	=> 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control('affiliate_store_theme_page_breadcrumb',array(
       'section' => 'affiliate_store_site_layoutsec',
	   'label' => __( 'Check To Enable Theme Page Breadcrumb','affiliate-store' ),
	   'type' => 'checkbox'
   ));	

    // Add Settings and Controls for Page Layout
    $wp_customize->add_setting('affiliate_store_sidebar_page_layout',array(
	  'default' => 'right',
	  'sanitize_callback' => 'affiliate_store_sanitize_choices'
	));
	$wp_customize->add_control('affiliate_store_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'affiliate-store'),
		'section' => 'affiliate_store_site_layoutsec',
		'choices' => array(
			'full' => __('Full','affiliate-store'),
			'left' => __('Left','affiliate-store'),
			'right' => __('Right','affiliate-store'),
	),
	) );		

	$wp_customize->add_setting( 'affiliate_store_layoutsec_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_layoutsec_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_site_layoutsec'
	));	

	//Global Color
	$wp_customize->add_section('affiliate_store_global_color', array(
		'title'    => __('Manage Global Color Section', 'affiliate-store'),
		'panel'    => 'affiliate_store_panel_area',
	));

	$wp_customize->add_setting('affiliate_store_first_color', array(
		'default'           => '#E5220C',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'affiliate_store_first_color', array(
		'label'    => __('Theme Color', 'affiliate-store'),
		'section'  => 'affiliate_store_global_color',
		'settings' => 'affiliate_store_first_color',
	)));

	$wp_customize->add_setting( 'affiliate_store_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_global_color'
	));	

	// Topbar Section
	$wp_customize->add_section('affiliate_store_topbar_section',array(
	    'title' => __('Manage Topbar Section','affiliate-store'),
	    'priority'  => null,
	    'panel' => 'affiliate_store_panel_area',
	));	

	$wp_customize->add_setting('affiliate_store_enable_topbar_section',array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_enable_topbar_section', array(
	   'settings' => 'affiliate_store_enable_topbar_section',
	   'section'   => 'affiliate_store_topbar_section',
	   'label'     => __('Check To Enable This Section','affiliate-store'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('affiliate_store_topbar_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_topbar_text', array(
	   'settings' => 'affiliate_store_topbar_text',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Add Text', 'affiliate-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('affiliate_store_topbar_track_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_topbar_track_text',array(
		'label'	=> esc_html__('Add Track Text','affiliate-store'),
		'section'=> 'affiliate_store_topbar_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('affiliate_store_header_currency_switcher',array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'affiliate_store_header_currency_switcher', array(
	   'section'   => 'affiliate_store_topbar_section',
	   'label'	=> __('Check to Show Curreny Switcher','affiliate-store'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('affiliate_store_middle_header_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'affiliate_store_middle_header_img',array(
	    'label' => __('Middle Header Image','affiliate-store'),
	    'description'	=> __('Use the given image dimension (665 x 77).','affiliate-store'),
	    'section' => 'affiliate_store_topbar_section'
	)));

	$wp_customize->add_setting('affiliate_store_header_img_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_header_img_title', array(
	   'settings' => 'affiliate_store_header_img_title',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Add Text', 'affiliate-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('affiliate_store_header_img_title_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_header_img_title_text', array(
	   'settings' => 'affiliate_store_header_img_title_text',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Add Text', 'affiliate-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('affiliate_store_sale_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_sale_title', array(
	   'settings' => 'affiliate_store_sale_title',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Add Sale Title', 'affiliate-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('affiliate_store_sale_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_sale_text', array(
	   'settings' => 'affiliate_store_sale_text',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Add Sale Text', 'affiliate-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('affiliate_store_enable_social_section',array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_enable_social_section', array(
	   'settings' => 'affiliate_store_enable_social_section',
	   'section'   => 'affiliate_store_topbar_section',
	   'label'     => __('Check To Enable This Section','affiliate-store'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('affiliate_store_facebook_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_facebook_link', array(
	   'settings' => 'affiliate_store_facebook_link',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Facebook Link', 'affiliate-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('affiliate_store_twitter_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_twitter_link', array(
	   'settings' => 'affiliate_store_twitter_link',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Twitter Link', 'affiliate-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('affiliate_store_instagram_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_instagram_link', array(
	   'settings' => 'affiliate_store_instagram_link',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Instagram Link', 'affiliate-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('affiliate_store_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_youtube_link', array(
	   'settings' => 'affiliate_store_youtube_link',
	   'section'   => 'affiliate_store_topbar_section',
	   'label' => __('Youtube Link', 'affiliate-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting( 'affiliate_store_topbar_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_topbar_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_topbar_section'
	));	

	// Slider Section
	$wp_customize->add_section('affiliate_store_slider_section',array(
	    'title' => __('Manage Slider Section','affiliate-store'),
	    'priority'  => null,
	    'description'	=> __('<p class="sec-title">Manage Slider Section</p> Select Category from the Dropdowns for slider, Also use the given image dimension (1000 x 480).','affiliate-store'),
	    'panel' => 'affiliate_store_panel_area',
	));	

	$wp_customize->add_setting('affiliate_store_slider',array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_slider', array(
	   'settings' => 'affiliate_store_slider',
	   'section'   => 'affiliate_store_slider_section',
	   'label'     => __('Check To Enable This Section','affiliate-store'),
	   'type'      => 'checkbox'
	));

	$affiliate_store_categories = get_categories();
	$affiliate_store_cat_post = array();
	$affiliate_store_cat_post['0'] = 'Select';

	foreach ($affiliate_store_categories as $affiliate_store_category) {
	    $affiliate_store_cat_post[$affiliate_store_category->slug] = $affiliate_store_category->name;
	}

	$wp_customize->add_setting('affiliate_store_slider_cat', array(
	    'default' => '0',
	    'sanitize_callback' => 'affiliate_store_sanitize_choices',
	));
	$wp_customize->add_control('affiliate_store_slider_cat', array(
	    'type'    => 'select',
	    'choices' => $affiliate_store_cat_post,
	    'label'   => __('Select Category to display Latest Post', 'affiliate-store'),
	    'description' => __('<p class="sec-title">Choose a category, then reload the page.</p>', 'affiliate-store'),
	    'section' => 'affiliate_store_slider_section',
	));

	$wp_customize->add_setting('affiliate_store_slider_subhead',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_slider_subhead', array(
	   'settings' => 'affiliate_store_slider_subhead',
	   'section'   => 'affiliate_store_slider_section',
	   'label' => __('Add Slider Subheading', 'affiliate-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('affiliate_store_category_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_category_title', array(
	   'settings' => 'affiliate_store_category_title',
	   'section'   => 'affiliate_store_slider_section',
	   'label' => __('Add Categories Title', 'affiliate-store'),
	   'type'      => 'text'
	));

	// Offer Section
	for ($affiliate_store_i = 1; $affiliate_store_i <= 2; $affiliate_store_i++) {
		$wp_customize->add_setting('affiliate_store_offer_bg_image'.$affiliate_store_i,array(
			'default'	=> '',
			'sanitize_callback'	=> 'esc_url_raw',
		));
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'affiliate_store_offer_bg_image'.$affiliate_store_i,array(
		    'label' => __('Select About Image','affiliate-store'),
		    'section' => 'affiliate_store_slider_section'
		)));

		$wp_customize->add_setting('affiliate_store_offer_subhead'.$affiliate_store_i,array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control( 'affiliate_store_offer_subhead'.$affiliate_store_i, array(
		   'settings' => 'affiliate_store_offer_subhead'.$affiliate_store_i,
		   'section'   => 'affiliate_store_slider_section',
		   'label' => __('Add Offer Subheading', 'affiliate-store'),
		   'type'      => 'text'
		));

		$wp_customize->add_setting('affiliate_store_offer_title'.$affiliate_store_i,array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control( 'affiliate_store_offer_title'.$affiliate_store_i, array(
		   'settings' => 'affiliate_store_offer_title'.$affiliate_store_i,
		   'section'   => 'affiliate_store_slider_section',
		   'label' => __('Add Offer Title', 'affiliate-store'),
		   'type'      => 'text'
		));

		$wp_customize->add_setting('affiliate_store_offer_btn_text'.$affiliate_store_i,array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control( 'affiliate_store_offer_btn_text'.$affiliate_store_i, array(
		   'settings' => 'affiliate_store_offer_btn_text'.$affiliate_store_i,
		   'section'   => 'affiliate_store_slider_section',
		   'label' => __('Add Button Text', 'affiliate-store'),
		   'type'      => 'text'
		));

		$wp_customize->add_setting('affiliate_store_offer_btn_link'.$affiliate_store_i,array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control( 'affiliate_store_offer_btn_link'.$affiliate_store_i, array(
		   'settings' => 'affiliate_store_offer_btn_link'.$affiliate_store_i,
		   'section'   => 'affiliate_store_slider_section',
		   'label' => __('Add Button URL', 'affiliate-store'),
		   'type'      => 'url'
		));
	}

	$wp_customize->add_setting( 'affiliate_store_slider_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_slider_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_slider_section'
	));	
    
	// Trending Products Section
	$wp_customize->add_section('affiliate_store_trending_section', array(
	    'title'       => __('Manage Trending Products Section', 'affiliate-store'),
	    'description' => __('<p class="sec-title">Manage Trending Products Section</p>', 'affiliate-store'),
	    'priority'    => null,
	    'panel'       => 'affiliate_store_panel_area',
	));

	$wp_customize->add_setting('affiliate_store_disabled_trending_section', array(
	    'default'           => true,
	    'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('affiliate_store_disabled_trending_section', array(
	    'settings' => 'affiliate_store_disabled_trending_section',
	    'section'  => 'affiliate_store_trending_section',
	    'label'    => __('Check To Enable Section', 'affiliate-store'),
	    'type'     => 'checkbox',
	));

	$wp_customize->add_setting('affiliate_store_trending_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('affiliate_store_trending_title', array(
	    'settings' => 'affiliate_store_trending_title',
	    'section'  => 'affiliate_store_trending_section',
	    'label'    => __('Add Trending Products Title', 'affiliate-store'),
	    'type'     => 'text',
	));

	$affiliate_store_args = array(
       	'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
	$affiliate_store_categories = get_categories($affiliate_store_args);
	$affiliate_store_cat_posts = array();
	$affiliate_store_m = 0;
	$affiliate_store_cat_posts[]='Select';
	foreach($affiliate_store_categories as $affiliate_store_category){
		if($affiliate_store_m==0){
			$affiliate_store_default = $affiliate_store_category->slug;
			$affiliate_store_m++;
		}
		$affiliate_store_cat_posts[$affiliate_store_category->slug] = $affiliate_store_category->name;
	}

	$wp_customize->add_setting('affiliate_store_hot_products_cat',array(
		'default'	=> 'select',
		'sanitize_callback' => 'affiliate_store_sanitize_choices',
	));
	$wp_customize->add_control('affiliate_store_hot_products_cat',array(
		'type'    => 'select',
		'choices' => $affiliate_store_cat_posts,
		'label' => __('Select category to display products ','affiliate-store'),
		'section' => 'affiliate_store_trending_section',
	));

	$wp_customize->add_setting( 'affiliate_store_trending_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_trending_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_trending_section'
	));	

	//Blog post
	$wp_customize->add_section('affiliate_store_blog_post_settings',array(
        'title' => __('Manage Post Section', 'affiliate-store'),
        'priority' => null,
        'panel' => 'affiliate_store_panel_area'
    ) );

	$wp_customize->add_setting('affiliate_store_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control('affiliate_store_metafields_date', array(
	    'settings' => 'affiliate_store_metafields_date', 
	    'section'   => 'affiliate_store_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'affiliate-store'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('affiliate_store_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));	
	$wp_customize->add_control('affiliate_store_metafields_comments', array(
		'settings' => 'affiliate_store_metafields_comments',
		'section'  => 'affiliate_store_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'affiliate-store'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('affiliate_store_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control('affiliate_store_metafields_author', array(
		'settings' => 'affiliate_store_metafields_author',
		'section'  => 'affiliate_store_blog_post_settings',
		'label'    => __('Check to Enable Author', 'affiliate-store'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('affiliate_store_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control('affiliate_store_metafields_time', array(
		'settings' => 'affiliate_store_metafields_time',
		'section'  => 'affiliate_store_blog_post_settings',
		'label'    => __('Check to Enable Time', 'affiliate-store'),
		'type'     => 'checkbox',
	));	

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('affiliate_store_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'affiliate_store_sanitize_choices'
	));
	$wp_customize->add_control('affiliate_store_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'affiliate-store'),
		'description'   => __('This option work for blog page, archive page and search page.', 'affiliate-store'),
		'section' => 'affiliate_store_blog_post_settings',
		'choices' => array(
			'full' => __('Full','affiliate-store'),
			'left' => __('Left','affiliate-store'),
			'right' => __('Right','affiliate-store'),
			'three-column' => __('Three Columns','affiliate-store'),
			'four-column' => __('Four Columns','affiliate-store'),
			'grid' => __('Grid Layout','affiliate-store')
     ),
	) );

	$wp_customize->add_setting('affiliate_store_blog_post_description_option',array(
    	'default'   => 'Excerpt Content', 
        'sanitize_callback' => 'affiliate_store_sanitize_choices'
	));
	$wp_customize->add_control('affiliate_store_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','affiliate-store'),
        'section' => 'affiliate_store_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','affiliate-store'),
            'Excerpt Content' => __('Excerpt Content','affiliate-store'),
            'Full Content' => __('Full Content','affiliate-store'),
        ),
	) );

	$wp_customize->add_setting('affiliate_store_blog_post_thumb',array(
        'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('affiliate_store_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'affiliate-store'),
        'section'     => 'affiliate_store_blog_post_settings',
    ));

    $wp_customize->add_setting( 'affiliate_store_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'affiliate_store_sanitize_integer'
    ) );
    $wp_customize->add_control(new Affiliate_Store_Slider_Custom_Control( $wp_customize, 'affiliate_store_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','affiliate-store'),
		'section'=> 'affiliate_store_blog_post_settings',
		'settings'=>'affiliate_store_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'affiliate_store_blog_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_blog_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_blog_post_settings'
	));	
    
	//Single Post Settings
	$wp_customize->add_section('affiliate_store_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'affiliate-store'),
		'priority' => null,
		'panel' => 'affiliate_store_panel_area'
	));

	$wp_customize->add_setting( 'affiliate_store_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control('affiliate_store_single_page_breadcrumb',array(
       'section' => 'affiliate_store_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','affiliate-store' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('affiliate_store_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'affiliate_store_sanitize_choices'
	));
	$wp_customize->add_control('affiliate_store_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'affiliate-store'),
     	'section' => 'affiliate_store_single_post_settings',
     	'choices' => array(
			'full' => __('Full','affiliate-store'),
			'left' => __('Left','affiliate-store'),
			'right' => __('Right','affiliate-store'),
     ),
	));

	$wp_customize->add_setting( 'affiliate_store_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_single_post_settings'
	)); 

	// Footer Section
	$wp_customize->add_section('affiliate_store_footer', array(
		'title'	=> __('Manage Footer Section','affiliate-store'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','affiliate-store'),
		'priority'	=> null,
		'panel' => 'affiliate_store_panel_area',
	));

	$wp_customize->add_setting('affiliate_store_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'affiliate_store_sanitize_checkbox',
	));
	$wp_customize->add_control('affiliate_store_footer_widget', array(
	    'settings' => 'affiliate_store_footer_widget',
	    'section'   => 'affiliate_store_footer',
	    'label'     => __('Check to Enable Footer Widget', 'affiliate-store'),
	    'type'      => 'checkbox',
	));

	//  footer bg color
	$wp_customize->add_setting('affiliate_store_footerbg_color',array(
		'default' => '',
		'sanitize_callback' => 'affiliate_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_footerbg_color', array(
		'settings' => 'affiliate_store_footerbg_color',
		'section'   => 'affiliate_store_footer',
		'label' => __('Footer Background Color', 'affiliate-store'),
		'type'      => 'color'
	));

	$wp_customize->add_setting('affiliate_store_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'affiliate_store_footer_bg_image',array(
        'label' => __('Footer Background Image','affiliate-store'),
        'section' => 'affiliate_store_footer',
    )));

	$wp_customize->add_setting('affiliate_store_copyright_line',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'affiliate_store_copyright_line', array(
	   'section' 	=> 'affiliate_store_footer',
	   'label'	 	=> __('Copyright Line','affiliate-store'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	$wp_customize->add_setting('affiliate_store_copyright_link',array(
    	'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'affiliate_store_copyright_link', array(
	   'section' 	=> 'affiliate_store_footer',
	   'label'	 	=> __('Copyright Link','affiliate-store'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	//  footer coypright color
	$wp_customize->add_setting('affiliate_store_footercoypright_color',array(
		'default' => '',
		'sanitize_callback' => 'affiliate_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_footercoypright_color', array(
	   'settings' => 'affiliate_store_footercoypright_color',
	   'section'   => 'affiliate_store_footer',
	   'label' => __('Coypright Color', 'affiliate-store'),
	   'type'      => 'color'
	));

	//  footer title color
	$wp_customize->add_setting('affiliate_store_footertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'affiliate_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_footertitle_color', array(
	   'settings' => 'affiliate_store_footertitle_color',
	   'section'   => 'affiliate_store_footer',
	   'label' => __('Title Color', 'affiliate-store'),
	   'type'      => 'color'
	));

	//  footer description color
	$wp_customize->add_setting('affiliate_store_footerdescription_color',array(
		'default' => '',
		'sanitize_callback' => 'affiliate_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_footerdescription_color', array(
	   'settings' => 'affiliate_store_footerdescription_color',
	   'section'   => 'affiliate_store_footer',
	   'label' => __('Description Color', 'affiliate-store'),
	   'type'      => 'color'
	));

	//  footer list color
	$wp_customize->add_setting('affiliate_store_footerlist_color',array(
		'default' => '',
		'sanitize_callback' => 'affiliate_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'affiliate_store_footerlist_color', array(
	   'settings' => 'affiliate_store_footerlist_color',
	   'section'   => 'affiliate_store_footer',
	   'label' => __('List Color', 'affiliate-store'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('affiliate_store_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'affiliate_store_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'affiliate_store_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'affiliate-store' ),
        'section'        => 'affiliate_store_footer',
        'settings'       => 'affiliate_store_scroll_hide',
        'type'           => 'checkbox',
    )));

	$wp_customize->add_setting('affiliate_store_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'affiliate_store_sanitize_choices'
    ));
    $wp_customize->add_control('affiliate_store_scroll_position',array(
        'type' => 'radio',
        'section' => 'affiliate_store_footer',
        'label'	 	=> __('Scroll To Top Positions','affiliate-store'),
        'choices' => array(
            'Right' => __('Right','affiliate-store'),
            'Left' => __('Left','affiliate-store'),
            'Center' => __('Center','affiliate-store')
        ),
    ) );

	$wp_customize->add_setting('affiliate_store_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'affiliate_store_sanitize_choices',
	));
	$wp_customize->add_control('affiliate_store_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'affiliate_store_footer',
		'label'       => __('Footer widget area', 'affiliate-store'),
		'choices' => array(
		   '1'     => __('One', 'affiliate-store'),
		   '2'     => __('Two', 'affiliate-store'),
		   '3'     => __('Three', 'affiliate-store'),
		   '4'     => __('Four', 'affiliate-store')
		),
	));

	$wp_customize->add_setting( 'affiliate_store_footer_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('affiliate_store_footer_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(AFFILIATE_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'affiliate_store_footer'
	));	
    
	// Google Fonts
	$wp_customize->add_section( 'affiliate_store_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'affiliate-store' ),
		'priority'    => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'affiliate_store_headings_fonts', array(
		'sanitize_callback' => 'affiliate_store_sanitize_fonts',
	));
	$wp_customize->add_control( 'affiliate_store_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'affiliate-store'),
		'section' => 'affiliate_store_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'affiliate_store_body_fonts', array(
		'sanitize_callback' => 'affiliate_store_sanitize_fonts'
	));
	$wp_customize->add_control( 'affiliate_store_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'affiliate-store' ),
		'section' => 'affiliate_store_google_fonts_section',
		'choices' => $font_choices
	));
  
}
add_action( 'customize_register', 'affiliate_store_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function affiliate_store_customize_preview_js() {
	wp_enqueue_script( 'affiliate_store_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'affiliate_store_customize_preview_js' );
