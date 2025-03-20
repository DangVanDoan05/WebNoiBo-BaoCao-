<?php
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function affiliate_store_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Woocommerce', 'affiliate-store' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'affiliate-store' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Currency Switcher for WooCommerce', 'affiliate-store' ),
			'slug'             => 'currency-switcher-woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'GTranslate', 'affiliate-store' ),
			'slug'             => 'gtranslate',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'affiliate_store_register_recommended_plugins' );