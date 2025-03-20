<?php
/**
 * @package Affiliate Store
 * Setup the WordPress core custom header feature.
 *
 * @uses affiliate_store_header_style()
 */
function affiliate_store_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'affiliate_store_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 2500,
		'height'                 => 400,
		'wp-head-callback'       => 'affiliate_store_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'affiliate_store_custom_header_setup' );

if ( ! function_exists( 'affiliate_store_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see affiliate_store_custom_header_setup().
 */
function affiliate_store_header_style() {
	$affiliate_store_header_text_color = get_header_textcolor();

	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.mainhead {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat !important;
			background-position: center top;
			background-size: cover !important;
		}

	<?php endif; ?>	

	h1.site-title a, p.site-title a{
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_sitetitle_color')); ?> !important;
	}

	.site-description{
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_sitetagline_color')); ?> !important;
	}

	.main-nav ul li a {
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_menu_color')); ?> !important;
	}

	.main-nav a:hover{
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_menuhrv_color')); ?> !important;
	}

	.main-nav ul ul a{
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_submenu_color')); ?> !important;
	}

	.main-nav ul ul a:hover {
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_submenuhrv_color')); ?> !important;
	}

	.copywrap, .copywrap p, .copywrap p a {
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_footercoypright_color')); ?> !important;
	}
	#footer h3 {
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_footertitle_color')); ?> !important;

	}
	#footer p {
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_footerdescription_color')); ?>;
	}
	#footer ul li a {
		color: <?php echo esc_attr(get_theme_mod('affiliate_store_footerlist_color')); ?>;

	}
	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('affiliate_store_footerbg_color')); ?>;
	}
	

	</style>
	<?php 
}
endif;