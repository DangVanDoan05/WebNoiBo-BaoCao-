<?php

##################------ Pro Button Section ------##################
	$wp_customize->register_section_type( 'wpdevart_tistore_Section_Premium' );

	$wp_customize->add_section(
		new wpdevart_tistore_Section_Premium(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__('TiStore','tistore'),
				'pro_text' => esc_html__('Premium','tistore'),
				'pro_url'  => apply_filters( 'parent_wpdevart_tistore_premium_features_url', esc_url('https://wpdevart.com/tistore-best-ecommerce-theme-for-wordpress')),
				'priority'  => 10,
			)
		)
	);