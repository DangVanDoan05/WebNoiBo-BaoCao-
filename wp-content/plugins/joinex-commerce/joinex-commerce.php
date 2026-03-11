<?php
/*
Plugin Name: Joinex Commerce
Description: Custom Checkout for Joinex
Version: 1.0
Author: Dang Van Doan
*/



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

/* Load CSS */

function joinex_load_assets(){

wp_enqueue_style(
'joinex-checkout-css',
plugin_dir_url(__FILE__) . 'assets/css/checkout.css'
);

}

add_action('wp_enqueue_scripts','joinex_load_assets');


/* Load logic -- XỬ LÝ CÁC HÀM. */  

require_once plugin_dir_path(__FILE__) . 'includes/checkout.php';


/* Load shortcode - Cái mà WordPress và Elementor Page sử dụng để Show ra trang mà Plugin không cần tạo ra Page */

require_once plugin_dir_path(__FILE__) . 'shortcodes/checkout-shortcode.php';