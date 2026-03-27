<?php
/*
Plugin Name: Joinex Commerce
Description: Custom Checkout for Joinex
Version: 1.0
Author: Dang Van Doan
*/
define('JOINEX_PLUGIN_URL', plugin_dir_url(__FILE__));
define('JOINEX_PLUGIN_PATH', plugin_dir_path(__FILE__));

if (!defined('ABSPATH')) {
    exit;
}


/* Tạo ra Icon khi load Plugin */
add_action('admin_menu', 'joinex_admin_menu');

function joinex_admin_menu() {

    add_menu_page(
        'Joinex Commerce',          // Page title
        'Joinex Commerce',         // Menu title
        'manage_options',           // Permission
        'joinex-commerce',          // Slug
        'joinex_admin_page',        // Function hiển thị trang
        'dashicons-cart',           // Icon
        56                          // Vị trí menu
    );
}

/* Load CSS - ĐÃ CÓ PHẦN LOAD CSS NÀY RỒI */

// joinex-commerce.php

function joinex_load_assets(){
    // CSS chung của plugin (ví dụ checkout)
    wp_enqueue_style(
        'joinex-checkout-css',
        plugin_dir_url(__FILE__) . 'assets/css/checkout.css',
        array(), // phụ thuộc nếu cần
        filemtime( plugin_dir_path(__FILE__) . 'assets/css/checkout.css' )
    );

    // CSS cho List product (đảm bảo load sau Elementor)
    wp_enqueue_style(
        'joinex-product-list',
        plugin_dir_url(__FILE__) . 'assets/css/List-product-HomePage.css',
        array('elementor-frontend', 'joinex-checkout-css'), // load sau Elementor và CSS plugin khác
        filemtime( plugin_dir_path(__FILE__) . 'assets/css/List-product-HomePage.css' )
    );

    // CSS cho List product ở trang SẢN PHẨM (đảm bảo load sau Elementor)
    wp_enqueue_style(
        'joinex-product-list-ProductPage',
        plugin_dir_url(__FILE__) . 'assets/css/List-product-ProductPage.css',
        array('elementor-frontend', 'joinex-checkout-css'), // load sau Elementor và CSS plugin khác
        filemtime( plugin_dir_path(__FILE__) . 'assets/css/List-product-ProductPage.css' )
    );

    // CSS cho Bộ lọc sản phẩm
    wp_enqueue_style(
        'joinex-product-filter-dropdown',
        plugin_dir_url(__FILE__) . 'assets/css/product_filter_dropdown.css',
        array('elementor-frontend', 'joinex-checkout-css'), // load sau Elementor và CSS plugin khác
        filemtime( plugin_dir_path(__FILE__) . 'assets/css/product_filter_dropdown.css' )
    );

    // CSS cho Trang chi tiết sản phẩm
    wp_enqueue_style(
        'joinex-product-detail-page',
        plugin_dir_url(__FILE__) . 'assets/css/product-detail.css',
        array('elementor-frontend', 'joinex-checkout-css'), // load sau Elementor và CSS plugin khác
        filemtime( plugin_dir_path(__FILE__) . 'assets/css/product-detail.css' )
    );


}
add_action('wp_enqueue_scripts','joinex_load_assets', 20);



/* Load logic -- XỬ LÝ CÁC HÀM. */  

require_once plugin_dir_path(__FILE__) . 'includes/checkout.php';


/* Load shortcode - Cái mà WordPress và Elementor Page sử dụng để Show ra trang mà Plugin không cần tạo ra Page */

require_once plugin_dir_path(__FILE__) . 'shortcodes/checkout-shortcode.php';

// joinex-commerce.php
function joinex_commerce_load_shortcodes() {

    include_once plugin_dir_path(__FILE__) . 'shortcodes/List-product-HomePage.php';
    include_once plugin_dir_path(__FILE__) . 'shortcodes/List-product-ProductPage.php';
    include_once plugin_dir_path(__FILE__) . 'shortcodes/product_filter_dropdown.php';
    include_once plugin_dir_path(__FILE__) . 'shortcodes/product-detail.php';
}

add_action('init', 'joinex_commerce_load_shortcodes');

/* Load phần Custom trang chỉnh sửa sản phẩm THÊM Ô NHẬP THÔNG SỐ KỸ THUẬT VÀ HƯỚNG DẪN LẮP ĐẶT */

require_once plugin_dir_path(__FILE__) . 'includes/product-custom-fields.php';

/* THÊM PHẦN PHÔNG CHỮ VÀO CÀI ĐẶT */

require_once plugin_dir_path(__FILE__) . 'includes/editor-fonts.php';
