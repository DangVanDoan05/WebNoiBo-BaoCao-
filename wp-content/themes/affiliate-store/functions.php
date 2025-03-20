<?php
/**
 * Affiliate Store functions and definitions
 *
 * @package Affiliate Store
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'affiliate_store_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function affiliate_store_setup() {
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 680;
	
	load_theme_textdomain( 'affiliate-store', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 70,
		'width'       => 150,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'affiliate-store' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_editor_style( 'editor-style.css' );
}
endif; // affiliate_store_setup
add_action( 'after_setup_theme', 'affiliate_store_setup' );

function affiliate_store_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function affiliate_store_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'affiliate-store' ),
		'description'   => __( 'Appears on blog page sidebar', 'affiliate-store' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'affiliate-store' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'affiliate-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'affiliate-store' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'affiliate-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
        'name'          => __('Shop Sidebar', 'affiliate-store'),
        'description'   => __('Sidebar for WooCommerce shop pages', 'affiliate-store'),
		'id'            => 'woocommerce_sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'affiliate-store'),
        'description'   => __('Sidebar for single product pages', 'affiliate-store'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));		
	
	$affiliate_store_widget_areas = get_theme_mod('affiliate_store_footer_widget_areas', '4');
	for ($affiliate_store_i=1; $affiliate_store_i<=$affiliate_store_widget_areas; $affiliate_store_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'affiliate-store' ) . $affiliate_store_i,
			'id'            => 'footer-' . $affiliate_store_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-4 %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'affiliate_store_widgets_init' );

// Change number of products per row to 3
add_filter('loop_shop_columns', 'affiliate_store_loop_columns');
if (!function_exists('affiliate_store_loop_columns')) {
    function affiliate_store_loop_columns() {
        $colm = get_theme_mod('affiliate_store_products_per_row', 4); // Default to 3 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function affiliate_store_products_per_page($cols) {
    $cols = get_theme_mod('affiliate_store_products_per_page', 9); // Default to 9 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'affiliate_store_products_per_page', 9);

function affiliate_store_scripts() {
	
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style('affiliate-store-style', get_stylesheet_uri(), array() );
		wp_style_add_data('affiliate-store-style', 'rtl', 'replace');

	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'affiliate-store-style',$affiliate_store_color_scheme_css );
	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/css/owl.carousel.css" );
	wp_enqueue_style( 'affiliate-store-default', esc_url(get_template_directory_uri())."/css/default.css" );
	
	wp_enqueue_style( 'affiliate-store-style', get_stylesheet_uri() );
	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'affiliate-store-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	wp_enqueue_style( 'affiliate-store-block-style', esc_url( get_template_directory_uri() ).'/css/blocks.css' );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
    $affiliate_store_body_font = esc_html(get_theme_mod('affiliate_store_body_fonts'));

    if ($affiliate_store_body_font) {
        wp_enqueue_style('affiliate-store-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($affiliate_store_body_font));
    } else {
        wp_enqueue_style('Rubik', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900');
    }

}
add_action( 'wp_enqueue_scripts', 'affiliate_store_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Sanitization Callbacks.
 */
require get_template_directory() . '/inc/sanitization-callbacks.php';

/**
 * Webfont-Loader.
 */
require get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * select .
 */
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

if ( ! defined( 'AFFILIATE_STORE_PRO_NAME' ) ) {
	define( 'AFFILIATE_STORE_PRO_NAME', __( 'About Affiliate Store', 'affiliate-store' ));
}
if ( ! defined( 'AFFILIATE_STORE_PREMIUM_PAGE' ) ) {
define('AFFILIATE_STORE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/affiliate-marketing-wordpress-theme','affiliate-store'));
}
if ( ! defined( 'AFFILIATE_STORE_THEME_PAGE' ) ) {
	define('AFFILIATE_STORE_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','affiliate-store'));
}
if ( ! defined( 'AFFILIATE_STORE_SUPPORT' ) ) {
define('AFFILIATE_STORE_SUPPORT',__('https://wordpress.org/support/theme/affiliate-store/','affiliate-store'));
}
if ( ! defined( 'AFFILIATE_STORE_REVIEW' ) ) {
define('AFFILIATE_STORE_REVIEW',__('https://wordpress.org/support/theme/affiliate-store/reviews/#new-post','affiliate-store'));
}
if ( ! defined( 'AFFILIATE_STORE_PRO_DEMO' ) ) {
define('AFFILIATE_STORE_PRO_DEMO',__('https://live.theclassictemplates.com/affiliate-store-pro/','affiliate-store'));
}
if ( ! defined( 'AFFILIATE_STORE_THEME_DOCUMENTATION' ) ) {
define('AFFILIATE_STORE_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/affiliate-store-free/','affiliate-store'));
}

/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'footer-1' => array(
				'categories',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'meta',
			),
			'footer-4' => array(
				'search',
			),
		),
    ));
    
// logo
if ( ! function_exists( 'affiliate_store_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function affiliate_store_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;
