<?php

/*
Plugin Name: Thanh toán riêng
Description: Trang thanh toán tùy chỉnh 2 cột: form bên trái, giỏ hàng bên phải. Tạo order trong WooCommerce.
Version: 1.0
Author: Dang Van Doan
*/


function cc_enqueue_select2() {
    wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'cc_enqueue_select2');


// Đọc file JSON
$locations_file = plugin_dir_path(__FILE__) . 'vn_locations.json';
$locations_json = file_get_contents($locations_file);
$locations_data = json_decode($locations_json, true);

// Thêm menu riêng vào Admin Sidebar
add_action('admin_menu', function() {
    add_menu_page(
        'Thanh toán riêng',          // Page title
        'Thanh toán riêng',          // Menu title
        'manage_options',            // Quyền truy cập (admin)
        'custom-checkout-admin',     // Slug menu
        'cc_admin_page_content',     // Callback hiển thị nội dung
        'dashicons-cart',            // Icon (dùng Dashicons)
        56                           // Vị trí menu (tùy chỉnh)
    );
});

// Nội dung trang admin khi click menu
function cc_admin_page_content() {
    echo '<div class="wrap"><h1>Trang thanh toán riêng</h1>';
    echo '<p>Đây là trang quản lý cho plugin Custom Checkout.</p>';
    echo '<p>Bạn có thể chỉnh sửa logic hoặc thêm cấu hình tại đây.</p>';
    echo '</div>';
}


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Tạo page khi kích hoạt (chỉ tạo 1 lần, lưu page_id vào option)
 */


// Alias: nếu page dùng [custom_checkout], map nó tới handler chính
add_shortcode('custom_checkout', function($atts = array()) {
    return do_shortcode('[custom_checkout_wc]');
});


register_activation_hook( __FILE__, function() {
    $option_key = 'cc_custom_checkout_page_id';
    $existing_id = get_option( $option_key );

    if ( $existing_id && get_post_status( $existing_id ) ) {
        return;
    }

    $slug = 'thanh-toan-rieng';
    $page = get_page_by_path( $slug );
    if ( $page ) {
        update_option( $option_key, $page->ID );
        return;
    }

    $page_id = wp_insert_post( array(
        'post_title'   => 'Thanh toán riêng',
        'post_name'    => $slug,
        'post_content' => '[custom_checkout_wc]',
        'post_status'  => 'publish',
        'post_type'    => 'page',
    ) );

    if ( ! is_wp_error( $page_id ) && $page_id ) {
        update_option( $option_key, $page_id );
    }
});

/**
 * Shortcode hiển thị form và giỏ hàng (2 cột)
 */
add_shortcode( 'custom_checkout_wc', function() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return '<p>WooCommerce chưa được kích hoạt.</p>';
    }

    // Xử lý submit
   

    ob_start();

    // CSS cho toàn bộ trang.

    ?>
    <style>

        /* Xóa gutter ngang của row và padding của cột */
        .page-id-4734 .row {
        --bs-gutter-x: 0 !important;
        }

        /* Xóa padding trái/phải của các cột bootstrap bên trong */
        .page-id-4734 .row > [class*="col-"] 
        {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Xóa padding trái/phải của container ngoài cùng nếu có */
        .page-id-4734 .container.mt-5.mb-5.pt-5.pb-5 {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-top: 0 !important;
        padding-top: 8px !important;
        }


        .page-id-4734 .container.mt-5.mb-5.pt-5.pb-5 {
        padding-left: 0 !important;
        padding-right: 0 !important;
        }

        /* Giảm/mất khoảng trắng do các utility class trên trang Thanh toán riêng */
            .page-id-4734 .container.mt-5.mb-5.pt-5.pb-5 {
            margin-top: 0 !important;
            margin-bottom: 12px !important;
            padding-top: 8px !important;
            padding-bottom: 8px !important;
            }


            /* Áp dụng cho container plugin checkout */
            .cc-checkout-container {
                margin-top: 0 !important;
                padding-top: 0px !important; /* Ngay đây còn đi tìm ở đâu */
            }

            /* Nếu container nằm trong entry-content, giảm khoảng cách giữa header và container */
            .entry-content > .cc-checkout-container:first-child {
            margin-top: 0 !important;
            padding-top: 12px !important;
            }


            /* Nếu theme thêm margin cho tiêu đề mặc định */
            .page-id-4734 .entry-title {
            margin-top: 0 !important;
            margin-bottom: 8px !important;
            }

            /* Nếu builder (Elementor/Block) thêm padding cho section đầu */
            .page-id-4734 .elementor-section,
            .page-id-4734 .wp-block-group,
            .page-id-4734 .wp-block-cover {
            padding-top: 8px !important;
            }

            /* Giảm khoảng cách trên cùng của nội dung checkout */
                .page-id-4734 .cc-checkout-container {
                margin-top: 0;   /* bỏ khoảng cách */
                padding-top: 20px; /* giữ khoảng cách nhỏ cho thoáng */
                }

            /* Nếu theme thêm margin cho entry-content */
            .page-id-4734 .entry-content
                {
                margin-top: 0 !important;
                padding-top: 0 !important;
                }

            .page-id-4734 .entry-title
                {
                    display: none;
                }

        .cc-checkout-container   /* Đây là khối ngoài cùng đây. */
            { 
            max-width: 1140px;
            margin: 0 auto;
            padding: 0px;
            box-sizing: border-box; 
            }
            /* Tiêu đề chính */
         .cc-main-title
                { 
                    font-family: 'Be VietNam Pro', sans-serif;
                    font-weight: 600;
                    font-size: 30px;
                    margin-bottom: 10px;
                 } 
          /* Tiêu đề phụ */
           .cc-sub-title { 
            font-family: 'Be VietNam Pro', sans-serif;
            font-weight: 450;
            font-size: 16px;
            margin-bottom: 8px;
             color: #555; /* màu nhẹ hơn để phân cấp */
            }

        .cc-checkout-wrap
             {
               /* background-color: #c5f5d5;*/
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
                max-width: 1140px; /* giới hạn chiều rộng */
                margin: 0 auto; /* căn giữa khối */
                padding: 0px; /* thêm khoảng cách trong */
                box-sizing: border-box;
                display:flex;
                gap:24px;
                flex-wrap:wrap; 
            }

            /* Khối bên trái: kích thước cố định, bo góc, đổ bóng nhẹ */
          
            /* Form tổng bên trái. */

            .cc-form
             {
                 padding: 15px;
                 width: 625px;
                 font-family: 'Be VietNam', sans-serif;
                 background-color: #fff0f6;
             }

            /* Hàng chung */
            .cc-row
            { 
                display:block;
                margin-bottom:14px; 
            }

            /* Hai cột trên cùng và dropdown cuối */
            .cc-row--two {
            display:flex;
            gap:16px;
            align-items:flex-start;
            }

            /* Trường chung */
            .cc-field { display:flex; flex-direction:column; flex:1; }
            .cc-label { font-weight:600; margin-bottom:8px; color:#222; font-size:14px; }
            .cc-optional { font-weight:400; font-size:12px; color:#777; }

                /* Inputs và selects */
                .cc-field input[type="text"],
                .cc-field input[type="tel"],
                .cc-field input[type="email"],
                .cc-field select {
                height:44px;
                padding:10px 12px;
                border:1px solid #ddd;
                border-radius:6px;
                background:#fff;
                box-sizing:border-box;
                font-size:14px;
                }

            /* Nếu bạn muốn giới hạn chiều rộng cố định cho khối trái */
            /* Ép khối trái cố định 625px trên desktop, responsive trên mobile */
            .cc-left {
            box-sizing: border-box !important;
            flex: 0 0 625px !important;    /* không co, không giãn, basis = 625px */
            width: 625px !important;        /* đảm bảo width */
            max-width: 625px !important;    /* ngăn stylesheet khác thu nhỏ */
            min-width: 320px !important;    /* vẫn cho mobile an toàn */
            height: 555px;                  /* theo yêu cầu trước */
            border-radius: 5px;
            padding: 20px;                  /* chỉnh theo nhu cầu */
            background: #fff;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            overflow: auto;
            }

            /* Nếu parent có display:flex với gap, đảm bảo không bị ảnh hưởng */
            .cc-checkout-wrap { align-items: flex-start; }

            /* Khi màn hình nhỏ, cho khối chiếm 100% */
            @media (max-width: 800px) {
            .cc-left {
                flex: 1 1 100% !important;
                width: 100% !important;
                max-width: 100% !important;
                height: auto;
            }
            }

            /* Nút */
            .cc-btn {
            display:inline-block;
            padding:10px 18px;
            background:#0b74de;
            color:#fff;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-weight:600;
            }

                /* Responsive: khi màn hình nhỏ, các cột xếp chồng */
                @media (max-width:800px) {
                .cc-row--two { flex-direction:column; gap:12px; }
                .cc-left .cc-form { width:100%; }
                }


        /* Responsive: khi màn hình nhỏ, khối sẽ chiếm 100% */
        @media (max-width: 800px) 
            {
            .cc-left {
                width: 100%;
                height: auto;
                border-radius: 5px;
                box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            }
            }

        /* Responsive: khối bên phải màn hình nhỏ, khối sẽ chiếm 100% */
            .cc-right
                {                              
                flex:0 0 480px;
                background-color: #ffe3ef; 
                border:1px solid #e5e5e5;
                padding:16px;
                box-sizing:border-box;
                width:480px;
                }


            .cc-right table
                {
                    width:100%;
                    border-collapse:collapse; 
                }
            .cc-right td, .cc-right th
                {
                    padding:6px 0;
                    vertical-align:top;
                }
            .cc-cart-item
            { 
                border-bottom:1px solid #f0f0f0;
                    padding:8px 0; 
                }
            .cc-total 
            {
                font-weight:700;
                margin-top:12px;
            }

            @media (max-width:800px) 
            {
                .cc-right {
                    width:100%;
                    flex:1 1 100%; 
                    }
            }

            select
             {
                position: relative;
             }
            select option 
            {
             direction: ltr;
            }


    </style>

   <div class="cc-checkout-container">

        <!-- Tiêu đề chính -->
        <h1 class="cc-main-title">Thông tin giao hàng</h1>
        <!-- Tiêu đề phụ -->
        <p class="cc-sub-title">Vui lòng nhập thông tin nhận hàng của bạn</p>


        <!-- Khối 2 cột -->
        <div class="cc-checkout-wrap"> <!-- Đây là khối bao ngoài cùng 2 khối thanh toán. -->

         <!-- Đây là thẻ Form này. -->
        <form class="cc-form" method="post" novalidate> 

            <!-- Hàng họ tên + số điện thoại -->
            <div class="cc-row cc-row--two">
                <label class="cc-field">
                <span class="cc-label">Họ và tên</span>
                <input type="text" name="cc_fullname" required placeholder="Nhập họ tên">
                </label>

                <label class="cc-field">
                <span class="cc-label">Số điện thoại</span>
                <input type="tel" name="cc_phone" required placeholder="Nhập số điện thoại">
                </label>
            </div>

            <!-- Hàng điền cột Email. -->
            <div class="cc-row">
                <label class="cc-field">
                <span class="cc-label">Email <small class="cc-optional">(Tùy chọn)</small></span>
                <input type="email" name="cc_email" placeholder="example@gmail.com">
                </label>
            </div>
             
            <!-- Load tỉnh và thành phố -->
              <div class="cc-row cc-row--two">
                <label class="cc-field">
                    <span class="cc-label">Tỉnh/Thành phố</span>
                    <select id="province" name="cc_province" required>
                    <option value="">Chọn Tỉnh/TP</option>
                    </select>
                </label>

                <label class="cc-field">
                    <span class="cc-label">Xã/Phường</span>
                    <select id="ward" name="cc_ward" required>
                    <option value="">Chọn Xã/Phường</option>
                    </select>
                </label>
                </div>

                <!-- Địa chỉ cụ thể -->
                <div class="cc-row">
                    <label class="cc-field">
                    <span class="cc-label">Địa chỉ cụ thể</span>
                    <input type="text" name="cc_address" required placeholder="Số nhà, đường, phường, quận...">
                    </label>
                </div>

                <!-- submit hoặc các trường khác -->
                <div class="cc-row">
                        <button type="submit" class="cc-btn">Tiếp tục</button>
                </div>

            </form>
                
        <!-- Đoạn script chạy -->

       
 


           







                       
                        <!-- Thêm thanh tìm kiếm -->
                      
                        <script>
                            $(document).ready(function() {
                            $('#province').select2({
                                dropdownParent: $('#province').parent(),
                                dropdownPosition: 'below',
                                placeholder: "Chọn Tỉnh/TP",
                                allowClear: true
                            });
                            });
                        </script>


                        <!-- Đoạn để đổ Dropdown xuống phía bên dưới. -->
                        <script>
                            jQuery(document).ready(function($) {
                                $('#province').select2({
                                    placeholder: "Chọn Tỉnh/TP",
                                    dropdownParent: $('#province').parent(),
                                    dropdownPosition: 'below',
                                    allowClear: true
                                });
                            });

                            jQuery(document).ready(function($) {
                            $('#ward').select2({
                                placeholder: "Chọn Xã/Phường",
                                dropdownParent: $('#ward').parent(),
                                dropdownPosition: 'below',
                                allowClear: true
                            });
                            });

                        </script>


                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const provinceSelect = document.getElementById("province");
                                const wardSelect = document.getElementById("ward");                   
                            });
                        </script>


            <div class="cc-right"> <!-- Đây là khối bên phải. -->
            
                <h3>Đơn hàng của bạn</h3>
                <?php
                $cart = WC()->cart;
                if ( ! $cart || $cart->is_empty() ) {
                    echo '<p>Giỏ hàng trống.</p>';
                } else {
                    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
                        $product = $cart_item['data'];
                        $qty = intval( $cart_item['quantity'] );
                        ?>
                        <div class="cc-cart-item">
                          
                            <div>Số lượng: <?php echo $qty; ?></div>
                            <div>Giá: <?php echo wc_price( $product->get_price() ); ?></div>
                        </div>
                        <?php
                    }

                    // Tổng tạm, phí ship (nếu có), tổng
                    $subtotal = $cart->get_subtotal();
                    $total = $cart->get_total( 'edit' ); // chuỗi formatted
                    ?>
                    <div class="cc-total">
                        <div>Tạm tính: <?php echo wc_price( $subtotal ); ?></div>
                        <div>Phí vận chuyển: <?php echo wc_price( 0 ); ?></div>
                        <div style="margin-top:8px;">Tổng: <?php echo $cart->get_cart_contents_total() ? wc_price( $cart->get_cart_contents_total() ) : wc_price(0); ?></div>
                    </div>
                <?php } ?>
            </div>
            
        </div>
    </div>
    <?php

    return ob_get_clean();
} );

/**
 * Xử lý submit: tạo order từ giỏ hàng
 * Trả về order_id hoặc WP_Error
 */

    // Thêm sản phẩm từ cart vào order
  
   


