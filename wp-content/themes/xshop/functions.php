<?php

/**
 * XShop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package XShop
 */


if (! defined('XSHOP_VERSION')) {
	$xshop_theme = wp_get_theme();
	define('XSHOP_VERSION', $xshop_theme->get('Version'));
}

if (! function_exists('xshop_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function xshop_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on XShop, use a find and replace
		 * to change 'xshop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('xshop', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'main-menu' => esc_html__('Main Menu', 'xshop'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'xshop_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');
		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');
		add_theme_support("responsive-embeds");

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		add_editor_style(array(xshop_fonts_url()));
	}
endif;
add_action('after_setup_theme', 'xshop_setup');



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function xshop_content_width()
{
	$GLOBALS['content_width'] = apply_filters('xshop_content_width', 1170);
}
add_action('after_setup_theme', 'xshop_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function xshop_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'xshop'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'xshop'),
			'before_widget' => '<section id="%1$s" class="widget shadow mb-4 p-3 %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Widget', 'xshop'),
			'id'            => 'footer-widget',
			'description'   => esc_html__('Add Footer widgets here.', 'xshop'),
			'before_widget' => '<section id="%1$s" class="widget footer-widget mb-4 p-3 %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'xshop_widgets_init');

/**
 * Register custom fonts.
 */
function xshop_fonts_url()
{
	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'Brygada 1918:400,400i,700,700i';
	$font_families[] = 'Roboto Slab:400,400i,700,700i';

	$query_args = array(
		'family' => urlencode(implode('|', $font_families)),
		'subset' => urlencode('latin,latin-ext'),
	);

	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');


	return esc_url_raw($fonts_url);
}


/**
 * Enqueue scripts and styles.
 */
function xshop_scripts()
{
	wp_enqueue_style('xshop-google-font', xshop_fonts_url(), array(), null);
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '5.0.1', 'all');
	wp_enqueue_style('slicknav', get_template_directory_uri() . '/assets/css/slicknav.css', array(), '1.0.10', 'all');
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.css', array(), '5.15.3');
	wp_enqueue_style('xshop-block-style', get_template_directory_uri() . '/assets/css/block.css', array(), XSHOP_VERSION);
	wp_enqueue_style('xshop-default-style', get_template_directory_uri() . '/assets/css/default-style.css', array(), XSHOP_VERSION);
	wp_enqueue_style('xshop-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), XSHOP_VERSION);
	wp_enqueue_style('xshop-style', get_stylesheet_uri(), array(), XSHOP_VERSION);
	wp_enqueue_style('xshop-responsive-style', get_template_directory_uri() . '/assets/css/responsive.css', array(), XSHOP_VERSION);

	wp_enqueue_script('masonry');
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), '5.1.2 ', false);
	wp_enqueue_script('xshop-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), XSHOP_VERSION, true);
	wp_enqueue_script('slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.js', array('jquery'), '1.0.10', true);
	wp_enqueue_script('xshop-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), XSHOP_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'xshop_scripts');

function xshop_gb_block_style()
{

	wp_enqueue_style('xshop-gb-block', get_theme_file_uri('/assets/css/admin-block.css'), false, '1.0', 'all');
	wp_enqueue_style('xshop-admin-google-font', xshop_fonts_url(), array(), null);
}
add_action('enqueue_block_assets', 'xshop_gb_block_style');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add tem plugin activation
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/recomended-plugin.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Load all actions file
require get_template_directory() . '/actions/header-actions.php';

if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woo-items/xshop-woocommerce.php';
}
$xshop_theme = wp_get_theme();
$xshop_slug = $xshop_theme->get('TextDomain');



	if (is_admin()) {
		require_once trailingslashit(get_template_directory()) . 'inc/about/about.php';
	}

	require get_template_directory() . '/inc/info/class-customize.php';

// Chuyển hướng về trang chủ sau khi User logout

add_action('wp_logout', 'custom_redirect_after_logout');

function custom_redirect_after_logout() {
    wp_redirect(home_url());
    exit;
}

// Chuyển hướng về trang đăng nhập khi yêu cầu đăng nhập trong lúc thanh toán.

add_action( 'template_redirect', function() {
    if( is_account_page() && !is_user_logged_in() ) {
        wp_redirect( home_url('/dang-nhap/') );
        exit;
    }
});
// Thêm trường số điện thoại để đăng nhập

function wooc_extra_register_fields() { ?>
    <p class="form-row form-row-wide">
        <label for="reg_billing_phone"><?php _e('Số điện thoại', 'woocommerce'); ?></label>
        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>
<?php }
add_action('woocommerce_register_form_start', 'wooc_extra_register_fields');


add_action( 'user_registration_after_register_user_action', function( $user_id, $form_data ) {
    if ( ! empty( $form_data['phone_number'] ) ) {
        update_user_meta( $user_id, 'phone_number', sanitize_text_field( $form_data['phone_number'] ) );
    }
}, 10, 2 );


// đăng nhập bằng số điện thoại
// 
// add_filter('user_registration_form_data', function($form_data) {
    // Kiểm tra nếu người dùng nhập số điện thoại vào trường email
  add_filter('user_registration_form_data', function($form_data) {
    // Kiểm tra nếu người dùng nhập số điện thoại vào trường email
    if (!empty($form_data['user_email']) && preg_match('/^[0-9]{8,15}$/', $form_data['user_email'])) {
        $phone = sanitize_text_field($form_data['user_email']);
        // Chuyển thành email giả hợp lệ
        $form_data['user_email'] = $phone . '@example.com';
        // Lưu số điện thoại riêng nếu cần
        $form_data['phone_number'] = $phone;
    }
    return $form_data;
});



add_filter('user_registration_form_data', function($form_data) {
    if (!empty($form_data['user_email']) && preg_match('/^[0-9]{8,15}$/', $form_data['user_email'])) {
        // Nếu người dùng nhập số điện thoại, tạo email giả
        $phone = sanitize_text_field($form_data['user_email']);
        $form_data['user_email'] = $phone . '@example.com';
        $form_data['phone_number'] = $phone; // Lưu riêng số điện thoại nếu cần
    }
    return $form_data;
});

add_action('user_registration_after_register_user_action', function($user_id, $form_data) {
    if (!empty($form_data['phone_number'])) {
        update_user_meta($user_id, 'phone_number', $form_data['phone_number']);
    }
}, 10, 2);

add_action('user_registration_after_register_user_action', function($user_id, $form_data) {
    if (!empty($form_data['phone_number'])) {
        update_user_meta($user_id, 'phone_number', $form_data['phone_number']);
    }
}, 10, 2);

// Hiển thị tổng tiền hàng
function show_cart_subtotal() {
    ob_start();
    wc_cart_totals_subtotal_html();
    return ob_get_clean();
}
add_shortcode('cart_subtotal', 'show_cart_subtotal');

// Hiển thị phí vận chuyển
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

// Chặn đặt hàng nếu email chưa có tài khoản và hiển thị thông báo dẫn đến trang đăng ký

// 1. Kiểm tra email tại bước checkout
add_action('woocommerce_checkout_process', function () {
    if (is_user_logged_in()) return;

    $email = isset($_POST['billing_email']) ? sanitize_email($_POST['billing_email']) : '';

    if (!$email) {
        wc_add_notice('Vui lòng nhập email để tiếp tục.', 'error');
        return;
    }

    if (!email_exists($email)) {
        wc_add_notice('Email này chưa có tài khoản. Vui lòng đăng ký trước khi đặt hàng.', 'error');
        WC()->session->set('show_register_modal', true);
    }
});

// 2. Không bắt buộc đăng ký tài khoản trong checkout (tránh lỗi ShopEngine)
add_filter('woocommerce_checkout_registration_required', '__return_false');

// 3. Hiển thị modal giữa màn hình nếu email chưa có tài khoản
add_action('wp_footer', function () {
    if (!is_checkout() || !WC()->session) return;

    $show_modal = WC()->session->get('show_register_modal');
    if (!$show_modal) return;

    // Tắt cờ để không hiển thị lại sau refresh
    WC()->session->set('show_register_modal', null);
    ?>
    <style>
      .register-modal-overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.5);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999;
      }
      .register-modal {
        background: #fff; padding: 30px; border-radius: 10px;
        max-width: 400px; width: 90%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        text-align: center;
        font-family: sans-serif;
      }
      .register-modal h3 { margin-bottom: 10px; font-size: 20px; color: #d00; }
      .register-modal p { margin-bottom: 20px; font-size: 16px; }
      .register-modal .actions { display: flex; justify-content: center; gap: 10px; }
      .register-modal .btn {
        padding: 10px 20px; border-radius: 6px;
        text-decoration: none; font-weight: bold;
        transition: background 0.3s ease;
      }
      .btn-primary {
        background: #670130; color: #fff;
      }
      .btn-primary:hover {
        background: #4a0110;
      }
      .btn-secondary {
        background: #eee; color: #333;
      }
      .btn-secondary:hover {
        background: #ccc;
      }
    </style>
    <div class="register-modal-overlay" id="register-modal-overlay">
      <div class="register-modal">
        <h3>Chưa có tài khoản</h3>
        <p>Email này chưa có tài khoản. Vui lòng đăng ký trước khi đặt hàng.</p>
        <div class="actions">
          <a href="#" class="btn btn-primary" onclick="
  var ho = document.querySelector('[name=billing_last_name]')?.value || '';
  var ten = document.querySelector('[name=billing_first_name]')?.value || '';
  var hoten = encodeURIComponent(ho + ' ' + ten);
  window.location.href = 'http://localhost:8888/kamashop/dang-ky/?hoten=' + hoten;
  return false;
">Đến trang đăng ký</a>

          <a href="#" class="btn btn-secondary" onclick="document.getElementById('register-modal-overlay').remove(); return false;">Đóng</a>
        </div>
      </div>
    </div>
    <?php
});


// Phân đơn hàng, tính khoảng cách
// -----------------------------
// Store assignment + admin filter
// -----------------------------

// -----------------------------
// Robust order assignment + admin visibility control
// -----------------------------


// Robust order assignment and strict admin visibility for shop_manager
// Replace User-Agent string below with your site name and contact email.

// --- Helper: check shop_manager role
// 
// 

// -----------------------------
// Robust order assignment and strict admin visibility
// Paste this at the end of functions.php
// USER_AGENT updated to use doan.dangv@dongduongpla.com.vn
// -----------------------------

if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

// --- Helper: logging
function my_assign_log($msg) {
    $file = WP_CONTENT_DIR . '/assign-debug.log';
    $time = date('Y-m-d H:i:s');
    @file_put_contents($file, "[$time] $msg\n", FILE_APPEND);
}

// --- Haversine distance (km)
function my_haversine_km($lat1, $lon1, $lat2, $lon2) {
    $R = 6371;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon/2) * sin($dLon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    return $R * $c;
}

// --- Store list: replace with real store coordinates and user IDs
function my_get_store_list() {
    return [
        ['key'=>'hungyen','label'=>'Hưng Yên','lat'=>20.93397297349466,'lon'=>106.00597799731055,'user_id'=>19],
        ['key'=>'hanoi','label'=>'Hà Nội','lat'=>21.0139,'lon'=>105.8206,'user_id'=>18],
    ];
}

// --- Geocode with Nominatim, retry and return array or false
function my_geocode_nominatim($address, $retries = 2, $timeout = 12) {
    if (empty($address)) return false;
    $ua = 'DongDuongPLA-WooCommerce/1.0 (doan.dangv@dongduongpla.com.vn)'; // <-- REPLACED
    $url = 'https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' . rawurlencode($address);
    $attempt = 0;
    while ($attempt <= $retries) {
        $resp = wp_remote_get($url, [
            'timeout' => $timeout,
            'headers' => ['User-Agent' => $ua]
        ]);
        if (is_wp_error($resp)) {
            my_assign_log("geocode attempt {$attempt} error: " . $resp->get_error_message());
        } else {
            $code = wp_remote_retrieve_response_code($resp);
            $body = wp_remote_retrieve_body($resp);
            my_assign_log("geocode attempt {$attempt} HTTP {$code} body_snippet: " . substr($body,0,800));
            $data = json_decode($body, true);
            if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
                return ['lat'=>floatval($data[0]['lat']), 'lon'=>floatval($data[0]['lon']), 'raw'=>$data[0]];
            }
        }
        $attempt++;
        sleep(1);
    }
    return false;
}

// --- Build full address from order
function my_get_full_address_from_order($order) {
    $parts = [
        $order->get_shipping_address_1() ?: $order->get_billing_address_1(),
        $order->get_shipping_address_2() ?: $order->get_billing_address_2(),
        $order->get_shipping_city() ?: $order->get_billing_city(),
        $order->get_shipping_state() ?: $order->get_billing_state(),
        $order->get_shipping_postcode() ?: $order->get_billing_postcode(),
        $order->get_shipping_country() ?: $order->get_billing_country()
    ];
    $parts = array_filter($parts, function($v){ return strlen(trim($v))>0; });
    return implode(', ', $parts);
}

// --- Core assign function: geocode -> nearest store -> save meta + post_author
function my_assign_order_to_nearest_store($order_id) {
    if (!$order_id) return;
    $order = wc_get_order($order_id);
    if (!$order) return;

    // If already assigned, skip (comment out to force reassign)
    $existing = get_post_meta($order_id, '_assigned_manager', true);
    if (!empty($existing)) {
        my_assign_log("order {$order_id} already assigned to {$existing}");
        return;
    }

    $address = my_get_full_address_from_order($order);
    my_assign_log("order {$order_id} address: " . $address);

    // Try geocode
    $geo = my_geocode_nominatim($address, 2, 12);
    if ($geo) {
        my_assign_log("order {$order_id} geocoded lat={$geo['lat']} lon={$geo['lon']}");
        // find nearest store
        $stores = my_get_store_list();
        $nearest = null; $min = INF;
        foreach ($stores as $s) {
            $d = my_haversine_km($geo['lat'], $geo['lon'], floatval($s['lat']), floatval($s['lon']));
            if ($d < $min) { $min = $d; $nearest = $s; $nearest['distance_km'] = $d; }
        }
        update_post_meta($order_id, '_debug_geo', ['status'=>'ok','lat'=>$geo['lat'],'lon'=>$geo['lon'],'nearest'=>$nearest ? $nearest['key'] : '']);
        if ($nearest && !empty($nearest['user_id'])) {
            $uid = intval($nearest['user_id']);
            update_post_meta($order_id, '_assigned_manager', $uid);
            wp_update_post(['ID'=>$order_id,'post_author'=>$uid]);
            my_assign_log("order {$order_id} assigned to user {$uid} by geocode (distance_km=" . round($nearest['distance_km'],3) . ")");
            return;
        }
    } else {
        my_assign_log("order {$order_id} geocode failed for address: " . $address);
        update_post_meta($order_id, '_debug_geo', ['status'=>'geocode_failed','address'=>$address]);
    }

    // --- Fallback rules: match billing_city, billing_state, postcode
    $city = strtolower(trim($order->get_billing_city() ?: ''));
    $state = strtolower(trim($order->get_billing_state() ?: ''));
    $postcode = strtolower(trim($order->get_billing_postcode() ?: ''));

    // Example fallback mapping: adjust keys and user IDs to your data
    $fallback_map = [
        'hưng yên' => 19, // any city/state containing 'hưng yên' -> user 19
        '180000' => 19,   // example postcode -> user 19
        // add more mappings if needed
    ];

    foreach ($fallback_map as $k => $uid) {
        if ($k === $postcode && $postcode !== '') {
            update_post_meta($order_id, '_assigned_manager', intval($uid));
            wp_update_post(['ID'=>$order_id,'post_author'=>intval($uid)]);
            update_post_meta($order_id, '_debug_geo_fallback', ['method'=>'postcode','match'=>$k,'assigned'=>$uid]);
            my_assign_log("order {$order_id} fallback assigned to {$uid} by postcode {$k}");
            return;
        }
        if ($k !== $postcode && (strpos($city, $k) !== false || strpos($state, $k) !== false)) {
            update_post_meta($order_id, '_assigned_manager', intval($uid));
            wp_update_post(['ID'=>$order_id,'post_author'=>intval($uid)]);
            update_post_meta($order_id, '_debug_geo_fallback', ['method'=>'city_state','match'=>$k,'assigned'=>$uid]);
            my_assign_log("order {$order_id} fallback assigned to {$uid} by city/state match {$k}");
            return;
        }
    }

    my_assign_log("order {$order_id} no fallback match; left unassigned");
}
add_action('woocommerce_checkout_order_processed', 'my_assign_order_to_nearest_store', 20, 1);

// --- Ensure admin Orders list only shows assigned orders to shop_manager using post__in (high priority)
add_action('pre_get_posts', 'my_force_orders_for_assigned_manager', 1);
function my_force_orders_for_assigned_manager($query) {
    global $pagenow, $wpdb;
    if (!is_admin()) return;
    if ($pagenow !== 'edit.php') return;
    if (!$query->is_main_query()) return;
    if ($query->get('post_type') !== 'shop_order') return;

    $user = wp_get_current_user();
    if (!$user || in_array('administrator', (array)$user->roles)) return;
    if (!in_array('shop_manager', (array)$user->roles)) return;

    $user_id = intval($user->ID);
    // get post_ids assigned to this user
    $order_ids = $wpdb->get_col( $wpdb->prepare(
        "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = %s AND meta_value = %d",
        '_assigned_manager', $user_id
    ) );

    if (empty($order_ids)) {
        // show none
        $query->set('post__in', array(0));
    } else {
        $query->set('post__in', $order_ids);
    }
    // keep other filters intact
}

// --- Fallback SQL-level enforcement if other plugins bypass (modify WHERE)
add_filter('posts_clauses', 'my_enforce_assigned_manager_sql', 9999, 2);
function my_enforce_assigned_manager_sql($clauses, $query) {
    global $pagenow, $wpdb;
    if (!is_admin()) return $clauses;
    if ($pagenow !== 'edit.php') return $clauses;
    if (!$query->is_main_query()) return $clauses;
    if ($query->get('post_type') !== 'shop_order') return $clauses;

    $user = wp_get_current_user();
    if (!$user || in_array('administrator', (array)$user->roles)) return $clauses;
    if (!in_array('shop_manager', (array)$user->roles)) return $clauses;

    $user_id = intval($user->ID);
    $clauses['where'] .= $wpdb->prepare(
        " AND EXISTS (SELECT 1 FROM {$wpdb->postmeta} pm WHERE pm.post_id = {$wpdb->posts}.ID AND pm.meta_key = %s AND pm.meta_value = %d)",
        '_assigned_manager', $user_id
    );
    return $clauses;
}

// --- Block direct access to edit order if not assigned
add_action('admin_init', 'my_block_shop_manager_viewing_other_orders');
function my_block_shop_manager_viewing_other_orders() {
    if (!is_admin()) return;
    global $pagenow;
    if ($pagenow === 'post.php' && isset($_GET['post'])) {
        $post_id = intval($_GET['post']);
        if (get_post_type($post_id) !== 'shop_order') return;
        $user = wp_get_current_user();
        if (!$user || in_array('administrator', (array)$user->roles)) return;
        if (in_array('shop_manager', (array)$user->roles)) {
            $assigned = get_post_meta($post_id, '_assigned_manager', true);
            if (empty($assigned) || intval($assigned) !== intval($user->ID)) {
                wp_die('Bạn không có quyền xem đơn hàng này.', 'Không có quyền', ['response' => 403]);
            }
        }
    }
}

// --- Add Assigned Manager column for visibility
add_filter('manage_edit-shop_order_columns', 'my_add_assigned_manager_column', 20);
function my_add_assigned_manager_column($columns) {
    $new = [];
    foreach ($columns as $key => $title) {
        $new[$key] = $title;
        if ($key === 'order_status') $new['assigned_manager'] = 'Assigned Manager';
    }
    return $new;
}
add_action('manage_shop_order_posts_custom_column', 'my_show_assigned_manager_column', 20, 2);
function my_show_assigned_manager_column($column, $post_id) {
    if ($column === 'assigned_manager') {
        $uid = get_post_meta($post_id, '_assigned_manager', true);
        if ($uid) {
            $user = get_userdata($uid);
            echo esc_html($user ? $user->display_name . " (ID: $uid)" : "User ID: $uid");
        } else {
            echo '<span style="color:#999">—</span>';
        }
    }
}

add_action('admin_init', function() {
    if (!current_user_can('manage_options')) return;
    $order_id = 4665;
    // Nếu đã tồn tại thì dừng
    if (get_post($order_id)) {
        error_log("Order $order_id already exists");
        return;
    }
    $postarr = [
        'ID' => $order_id,
        'post_author' => 19,
        'post_date' => current_time('mysql'),
        'post_date_gmt' => current_time('mysql', 1),
        'post_content' => 'Order created for testing geocode and assignment',
        'post_title' => 'Order #4665',
        'post_status' => 'wc-processing',
        'post_type' => 'shop_order',
        'post_name' => 'order-4665'
    ];
    $new_id = wp_insert_post($postarr, true);
    if (is_wp_error($new_id)) {
        error_log('wp_insert_post error: ' . $new_id->get_error_message());
        return;
    }
    // Thêm postmeta
    $meta = [
        '_order_key' => 'wc_test_4665',
        '_customer_user' => '0',
        '_billing_first_name' => 'Chu',
        '_billing_last_name' => 'Cong Can',
        '_billing_address_1' => 'Số 12, Ngõ 45, Thôn Phú Lương',
        '_billing_city' => 'Nghĩa Trụ',
        '_billing_state' => 'Văn Giang',
        '_billing_postcode' => '180000',
        '_billing_country' => 'VN',
        '_billing_email' => 'test@example.com',
        '_billing_phone' => '0363739821',
        '_shipping_first_name' => 'Chu',
        '_shipping_last_name' => 'Cong Can',
        '_shipping_address_1' => 'Số 12, Ngõ 45, Thôn Phú Lương',
        '_shipping_city' => 'Nghĩa Trụ',
        '_shipping_state' => 'Văn Giang',
        '_shipping_postcode' => '180000',
        '_shipping_country' => 'VN',
        '_order_total' => '399000',
        '_order_currency' => 'VND',
        '_assigned_manager' => '19',
        '_debug_geo' => maybe_serialize(['status'=>'ok','lat'=>'20.93397297349466','lon'=>'106.00597799731055','nearest'=>'hungyen'])
    ];
    foreach ($meta as $k => $v) update_post_meta($new_id, $k, $v);
    // Log
    error_log("Created test order $new_id and assigned to user 19");
});
// Thay thế an toàn cho pre_get_posts / posts_clauses filter
add_action('pre_get_posts', 'my_safe_force_orders_for_assigned_manager', 1);
function my_safe_force_orders_for_assigned_manager($query) {
    global $pagenow, $wpdb;
    if (!is_admin()) return;
    if ($pagenow !== 'edit.php') return;
    if (!$query->is_main_query()) return;
    if ($query->get('post_type') !== 'shop_order') return;

    $user = wp_get_current_user();
    if (!$user || in_array('administrator', (array)$user->roles)) return;
    if (!in_array('shop_manager', (array)$user->roles)) return;

    // Không dùng post__in; để an toàn, thêm một flag để posts_clauses xử lý
    $query->set('my_assigned_manager_filter', true);
}

// Sử dụng posts_clauses để thêm EXISTS subquery an toàn
add_filter('posts_clauses', 'my_safe_enforce_assigned_manager_sql', 9999, 2);
function my_safe_enforce_assigned_manager_sql($clauses, $query) {
    global $pagenow, $wpdb;
    if (!is_admin()) return $clauses;
    if ($pagenow !== 'edit.php') return $clauses;
    if (!$query->is_main_query()) return $clauses;
    if ($query->get('post_type') !== 'shop_order') return $clauses;
    if (!$query->get('my_assigned_manager_filter')) return $clauses;

    $user = wp_get_current_user();
    if (!$user || in_array('administrator', (array)$user->roles)) return $clauses;
    if (!in_array('shop_manager', (array)$user->roles)) return $clauses;

    $user_id = intval($user->ID);

    // Dùng EXISTS với TRIM để tránh mismatch do khoảng trắng hoặc kiểu chuỗi
    $clauses['where'] .= $wpdb->prepare(
        " AND EXISTS (
            SELECT 1 FROM {$wpdb->postmeta} pm
            WHERE pm.post_id = {$wpdb->posts}.ID
              AND pm.meta_key = %s
              AND TRIM(pm.meta_value) = %s
        )",
        '_assigned_manager',
        (string) $user_id
    );

    return $clauses;
}
 // Test thử xong sẽ xóa đi
add_action('admin_init', function() {
    if (!current_user_can('manage_options')) return;
    // Tạm remove filter có thể chặn orders list
    remove_all_filters('pre_get_posts');
    remove_all_filters('posts_clauses');
    // Log để biết đã chạy
    error_log('DEBUG: temporary removed pre_get_posts and posts_clauses for testing orders display');
});

// Debug + alert nếu user hiện tại là assigned manager của order 4665
add_action('wp_footer', function() {
    if (is_admin()) return; // chỉ frontend
    $logfile = WP_CONTENT_DIR . '/debug-assigned.log';

    // Ghi log mỗi lần hook chạy
    file_put_contents($logfile, date('c') . " wp_footer fired\n", FILE_APPEND);

    if (!is_user_logged_in()) {
        file_put_contents($logfile, date('c') . " no user logged in\n", FILE_APPEND);
        echo "<!-- DEBUG: no user logged in -->";
        return;
    }

    $current_user_id = get_current_user_id();
    file_put_contents($logfile, date('c') . " current_user_id={$current_user_id}\n", FILE_APPEND);

    $order_id = 4665;
    $post = get_post($order_id);
    if (!$post) {
        file_put_contents($logfile, date('c') . " post_not_found order={$order_id}\n", FILE_APPEND);
        echo "<!-- DEBUG: post {$order_id} not found -->";
        return;
    }
    if ($post->post_type !== 'shop_order') {
        file_put_contents($logfile, date('c') . " post_type_not_shop_order order={$order_id} type={$post->post_type}\n", FILE_APPEND);
        echo "<!-- DEBUG: post {$order_id} type={$post->post_type} -->";
        return;
    }

    $assigned = get_post_meta($order_id, '_assigned_manager', true);
    file_put_contents($logfile, date('c') . " assigned_meta=" . var_export($assigned, true) . "\n", FILE_APPEND);

    if (trim((string)$assigned) === (string)$current_user_id) {
        $msg = 'có quản lý đơn hàng 4665';
        // In alert
        printf(
            "<script>document.addEventListener('DOMContentLoaded', function(){ alert(%s); });</script>\n",
            wp_json_encode($msg)
        );
        // In thêm banner HTML để chắc chắn nhìn thấy
        echo '<div id="assigned-notice" style="position:fixed;right:10px;bottom:10px;background:#fffae6;border:1px solid #ffd24d;padding:10px;z-index:99999;font-family:Arial, sans-serif;">' . esc_html($msg) . '</div>';
        file_put_contents($logfile, date('c') . " showed_alert_and_banner\n", FILE_APPEND);
    } else {
        file_put_contents($logfile, date('c') . " not_assigned current={$current_user_id} assigned=" . var_export($assigned, true) . "\n", FILE_APPEND);
        echo "<!-- DEBUG: user not assigned -->";
    }
});

  
 
  


 










  
  
  

  
 











  
