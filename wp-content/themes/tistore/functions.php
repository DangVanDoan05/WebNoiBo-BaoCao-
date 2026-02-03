<?php

    function wpdevart_tistore_files() {
        wp_enqueue_style('wpdevart_tistore_styles', get_template_directory_uri() . '/assets/css/front-end/index.css');
        wp_enqueue_style('wpdevart-font-awesome', get_template_directory_uri().'/assets/icons/font-awesome/css/fontawesome.min.css');
        wp_enqueue_style( 'wpdevart-theme-fonts', wpdevart_tistore_enqueue_fonts_url(), array(), null );
        wp_enqueue_script('wpdevart-js', get_template_directory_uri() . '/assets/js/front-end/index.js', array('jquery'), '1.0', true);
        wp_enqueue_script('wpdevart-search-js', get_template_directory_uri() . '/assets/js/front-end/search.js', array('jquery'), '1.0', true);
    }

    add_action('wp_enqueue_scripts', 'wpdevart_tistore_files');

    function wpdevart_tistore_theme_features() {
        register_nav_menu('primary_menu', esc_html__( 'Primary Menu', 'tistore'));
        load_theme_textdomain( 'tistore', get_template_directory() . '/languages' ); 
        add_theme_support( 'custom-logo' );
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('wp-block-styles');
        add_theme_support('widgets');
        add_theme_support('widgets-block-editor');
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( "responsive-embeds" );
        add_theme_support( "align-wide" );
        add_editor_style( 'editor-style.css' );
        add_theme_support('woocommerce');
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }

    add_action('after_setup_theme', 'wpdevart_tistore_theme_features');

    ##################------ INCLUDING CUSTOM CSS ------##################
    
    require( get_template_directory() . '/assets/css/admin/wpdevart-theme-styles.php' );
    
    ##################------ INCLUDING DEFAULT OPTIONS ------##################

    require( get_template_directory() . '/inc/admin/wpdevart-add-default-options.php' );
	
    ##################------ INCLUDING BREADCRUMBS ------##################

    require( get_template_directory() . '/inc/front-end/wpdevart-breadcrumbs.php' );

    ##################------ INCLUDING CUSTOMIZER ------##################

    require( get_template_directory() . '/inc/customizer/customizer.php' );

    ##################------ INCLUDING FONTS ------##################

    require( get_template_directory() . '/inc/front-end/wpdevart-fonts.php' );

    ##################------ INCLUDING MENU FILE ------##################

    require( get_template_directory() . '/inc/front-end/walker.php' );
	
	##################------ INCLUDING BLOCK PATTERNS ------##################

	require get_template_directory() . '/inc/block-patterns/block-patterns.php';

    ##################------ INCLUDING GETTING STARTED NOTICE ------##################

    require( get_template_directory() . '/inc/getting-started/getting-started.php' );

    ##################------ INCLUDING THEME PAGE ------##################

    require( get_template_directory() . '/inc/getting-started/theme-page.php' );

    ##################------ INCLUDING WOOCOMMERCE ------##################

    if ( class_exists( 'WooCommerce' ) ) {
        require( get_template_directory() . '/inc/front-end/woocommerce-wpdevart.php' );
    }
  
    ##################------ Logo ------##################

    function wpdevart_tistore_custom_logo_setup() {
        $defaults = array(
            'height'               => 100,
            'width'                => 400,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array( 'site-title', 'site-description' ),
            'unlink-homepage-logo' => true, 
        );
        add_theme_support( 'custom-logo', $defaults );
    }
    add_action( 'after_setup_theme', 'wpdevart_tistore_custom_logo_setup' );

    ##################------ REGISTERING WIDGETS ------##################

    function wpdevart_tistore_widgets_init() {
        $defaults = array(
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        );
        register_sidebar( array_merge( $defaults, array(
            'id'          => 'wpdevart_tistore_blog_sidebar',
            'name'        => esc_html__( 'Blog Sidebar', 'tistore'),
            'description' => esc_html__( 'Default sidebar for blog/archive and post/page.', 'tistore'),
        ) ) );	
        register_sidebar( array_merge( $defaults, array(
            'id'          => 'wpdevart_tistore_footer_large_widget',
            'name'        => esc_html__( 'Footer Large Widget', 'tistore'),
            'description' => esc_html__( 'Large footer widget.', 'tistore'),
        ) ) );
        register_sidebar( array_merge( $defaults, array(
            'id'          => 'wpdevart_tistore_footer_widget_01',
            'name'        => esc_html__( 'Footer Widget 1', 'tistore'),
            'description' => esc_html__( 'A regular footer widget.', 'tistore'),
        ) ) );
        register_sidebar( array_merge( $defaults, array(
            'id'          => 'wpdevart_tistore_footer_widget_02',
            'name'        => esc_html__( 'Footer Widget 2', 'tistore'),
            'description' => esc_html__( 'A regular footer widget.', 'tistore'),
        ) ) );
        register_sidebar( array_merge( $defaults, array(
            'id'          => 'wpdevart_tistore_footer_widget_03',
            'name'        => esc_html__( 'Footer Widget 3', 'tistore'),
            'description' => esc_html__( 'A regular footer widget.', 'tistore'),
        ) ) );
        register_sidebar( array_merge( $defaults, array(
            'id'          => 'wpdevart_tistore_footer_widget_04',
            'name'        => esc_html__( 'Footer Widget 4', 'tistore'),
            'description' => esc_html__( 'A regular footer widget.', 'tistore'),
        ) ) );
        register_sidebar( array_merge( $defaults, array(
            'id'          => 'wpdevart_tistore_woocommerce_sidebar',
            'name'        => esc_html__( 'WooCommerce Sidebar', 'tistore'),
            'description' => esc_html__( 'Sidebar for WooCommerce store pages.', 'tistore'),
        ) ) );        
    }
    add_action( 'widgets_init', 'wpdevart_tistore_widgets_init' );


// hienr thị % sale
// 
function get_discount_percentage_shortcode() {
    global $product;

    if ( ! is_a( $product, 'WC_Product' ) ) {
        $product = wc_get_product( get_the_ID() );
    }

    if ( $product->is_on_sale() ) {
        $regular_price = (float) $product->get_regular_price();
        $sale_price = (float) $product->get_sale_price();

        if ( $regular_price > 0 && $sale_price > 0 ) {
            $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
            return '-' . $percentage . '%';
        }
    }

    return ''; // Không hiển thị gì nếu không giảm giá
}
add_shortcode( 'discount_percent', 'get_discount_percentage_shortcode' );
// Đổi text nút Thêm vào giỏ hàng trên trang chi tiết sản phẩm
add_filter( 'woocommerce_product_single_add_to_cart_text', function() {
    return 'Thêm vào giỏ hàng';
});

// Đổi text Buy Now thành Mua ngay
add_filter( 'gettext', function( $translated_text, $text, $domain ) {
    if ( $text === 'Buy Now' ) {
        $translated_text = 'Mua ngay';
    }
    return $translated_text;
}, 20, 3 );
// Đổi text nút Thêm vào giỏ hàng trên trang chi tiết sản phẩm
add_filter( 'woocommerce_product_single_add_to_cart_text', function() {
    return 'Thêm vào giỏ hàng';
});

// Đổi text Buy Now thành Mua ngay
add_filter( 'gettext', function( $translated_text, $text, $domain ) {
    if ( $text === 'Buy Now' ) {
        $translated_text = 'Mua ngay';
    }
    return $translated_text;
}, 20, 3 );
// Đổi text Buy Now thành Mua ngay
add_filter( 'gettext', function( $translated_text, $text, $domain ) {
    if ( $text === 'Buy Now' ) {
        $translated_text = 'Mua ngay';
    }
    if ( $text === 'Add to cart' ) {
        $translated_text = 'Thêm vào giỏ hàng';
    }
    return $translated_text;
}, 20, 3 );

// Sắp xếp thuộc tính

add_filter('woocommerce_attribute_orderby', function($orderby, $attribute){
    // Thay 'pa_chieu-dai-day-voi' bằng slug thuộc tính bạn muốn ép sắp xếp
    if ($attribute === 'pa_chieu-dai-day-voi') {
        return 'name_num'; // ép sắp xếp theo tên dạng số
    }
    return $orderby;
}, 10, 2);


add_filter('woocommerce_attribute_orderby', function($orderby, $attribute){
    // Slug của thuộc tính là 'duong-kinh-trong' → thêm tiền tố 'pa_'
    if ($attribute === 'pa_duong-kinh-trong') {
        return 'name_num'; // ép sắp xếp theo tên dạng số
    }
    return $orderby;
}, 10, 2);

// Hiển thị tổng tiền hàng
function show_cart_subtotal() {
    ob_start();
    wc_cart_totals_subtotal_html();
    return ob_get_clean();
}
add_shortcode('cart_subtotal', 'show_cart_subtotal');

// Hiển thị phí vận chuyển
// Hiển thị phí vận chuyển động
function show_cart_shipping() {
    ob_start();
    wc_cart_totals_shipping_html();
    return ob_get_clean();
}
add_shortcode('cart_shipping', 'show_cart_shipping');


// Hiển thị tổng thanh toán
function show_cart_total() {
    ob_start();
    wc_cart_totals_order_total_html();
    return ob_get_clean();
}
add_shortcode('cart_total', 'show_cart_total');

function cart_shipping_amount_only() {
    $packages = WC()->shipping->get_packages();
    $total_shipping = 0;

    foreach ( $packages as $i => $package ) {
        $chosen_method = isset( WC()->session ) ? WC()->session->get( "chosen_shipping_methods" )[ $i ] : '';
        if ( isset( $package['rates'][ $chosen_method ] ) ) {
            $total_shipping += $package['rates'][ $chosen_method ]->cost;
        }
    }

    // Format số tiền theo kiểu WooCommerce
    return wc_price( $total_shipping );
}
add_shortcode( 'shipping_amount_only', 'cart_shipping_amount_only' );




?>



