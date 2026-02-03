<?php
/*
Plugin Name: Store Checker
Description: Hiển thị thông báo khi truy cập vào post type 'store' mà plugin chính đã ngừng kích hoạt.
Version: 1.0
Author: Bạn
*/

// Hook vào admin_init để kiểm tra
add_action('admin_init', function() {
    if (isset($_GET['post_type']) && $_GET['post_type'] === 'store') {
        if (!post_type_exists('store')) {
            wp_die(
                '<h2 style="text-align:center; color:red; margin-top:50px;">
                    Chức năng đã không còn do Plugin đã ngừng kích hoạt
                 </h2>',
                'Thông báo',
                array('back_link' => true)
            );
        }
    }
});

// Hook vào admin_menu để thêm menu hiển thị ở sidebar
add_action('admin_menu', function() {
    add_menu_page(
        'Store Checker',                // Tiêu đề trang
        'Store Checker',                // Tên hiển thị ở menu
        'manage_options',               // Quyền truy cập
        'store-checker',                // Slug menu
        function() {                    // Nội dung trang khi click vào
            echo '<div style="margin:50px; text-align:center;">
                    <h2 style="color:green;">Plugin Store Checker đang được kích hoạt</h2>
                  </div>';
        },
        'dashicons-admin-tools',                // 👈 Icon hiển thị (có thể đổi)
        80                              // Vị trí menu
    );
});
