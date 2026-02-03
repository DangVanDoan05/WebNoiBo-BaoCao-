<?php
/*
Plugin Name: Quản lý cửa hàng
Description: Plugin quản lý cửa hàng với dropdown Tỉnh/Thành phố và Xã/Phường.
Version: 1.0
Author: Dang Van Doan
*/

// Đoạn Code show Slug Program

// Lưu dữ liệu meta khi save/update post type 'store'
add_action( 'save_post_store', function( $post_id ) {
    // Kiểm tra nonce
    if ( ! isset( $_POST['qlch_store_location_nonce_field'] ) 
         || ! wp_verify_nonce( $_POST['qlch_store_location_nonce_field'], 'qlch_store_location_nonce' ) ) {
        return;
    }

    // Kiểm tra quyền
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Không chạy khi autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    // Lưu các field
    if ( isset($_POST['store_city']) ) {
        update_post_meta( $post_id, '_store_city', sanitize_text_field($_POST['store_city']) );
    }
    if ( isset($_POST['store_ward']) ) {
        update_post_meta( $post_id, '_store_ward', sanitize_text_field($_POST['store_ward']) );
    }
    if ( isset($_POST['store_address']) ) {
        update_post_meta( $post_id, '_store_address', sanitize_text_field($_POST['store_address']) );
    }
    if ( isset($_POST['store_latitude']) ) {
        update_post_meta( $post_id, '_store_latitude', sanitize_text_field($_POST['store_latitude']) );
    }
    if ( isset($_POST['store_longitude']) ) {
        update_post_meta( $post_id, '_store_longitude', sanitize_text_field($_POST['store_longitude']) );
    }
    if ( isset($_POST['store_manager_user_id']) ) {
        update_post_meta( $post_id, '_store_manager_user_id', intval($_POST['store_manager_user_id']) );
    }
});



add_action( 'save_post_store', function( $post_id ) {
    // Kiểm tra nonce
    if ( ! isset( $_POST['qlch_store_location_nonce_field'] )
         || ! wp_verify_nonce( $_POST['qlch_store_location_nonce_field'], 'qlch_store_location_nonce' ) ) {
        return;
    }

    // Quyền và autosave
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    // Lưu User quản lý
    if ( isset($_POST['store_manager_user_id']) ) {
        update_post_meta( $post_id, '_store_manager_user_id', intval($_POST['store_manager_user_id']) );
    }

    // Lưu các field khác tương tự...
});





// 1. Thêm cột mới cho post type 'store'
add_filter( 'manage_store_posts_columns', function( $columns ) {
    // Đổi nhãn cột Tiêu đề thành "Tên cửa hàng"
    $columns['title'] = 'Tên cửa hàng';

    // Thêm các cột mới
    $columns['store_city']    = 'Tỉnh / Thành phố';
    $columns['store_ward']    = 'Xã / Phường';
    $columns['store_address'] = 'Địa chỉ chi tiết';
    $columns['store_manager'] = 'Người quản lý';

    return $columns;
});

// 2. Hiển thị dữ liệu cho các cột mới
add_action( 'manage_store_posts_custom_column', function( $column, $post_id ) {
    switch ( $column ) {
        case 'store_city':
            echo esc_html( get_post_meta( $post_id, '_store_city', true ) );
            break;

        case 'store_ward':
            echo esc_html( get_post_meta( $post_id, '_store_ward', true ) );
            break;

        case 'store_address':
            echo esc_html( get_post_meta( $post_id, '_store_address', true ) );
            break;

        case 'store_manager':
            $uid = get_post_meta( $post_id, '_store_manager_user_id', true );
            if ( $uid ) {
                $user = get_userdata( $uid );
                if ( $user ) {
                    echo esc_html( $user->display_name ) . ' (' . esc_html( $user->user_email ) . ')';
                }
            }
            break;
    }
}, 10, 2);

// 3. Cho phép sort theo meta (tùy chọn)
add_filter( 'manage_edit-store_sortable_columns', function( $columns ) {
    $columns['store_city']    = 'store_city';
    $columns['store_ward']    = 'store_ward';
    $columns['store_address'] = 'store_address';
    return $columns;
});






// Đăng ký Custom Post Style "store"

add_action('init', function() {
    register_post_type('store', array(
        'labels' => array(
            'name' => 'Quản lý cửa hàng',
            'singular_name' => 'Cửa hàng',
            'add_new' => 'Thêm cửa hàng mới',
            'add_new_item' => 'Thêm cửa hàng mới',
            'edit_item' => 'Chỉnh sửa cửa hàng',
            'new_item' => 'Cửa hàng mới',
            'view_item' => 'Xem cửa hàng',
            'search_items' => 'Tìm cửa hàng',
            'all_items' => 'Tất cả cửa hàng',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title'), // chỉ giữ lại tiêu đề
        'menu_icon' => 'dashicons-store',
    ));
});

// Thêm meta box
add_action('add_meta_boxes', function() {
    add_meta_box(
        'store_location_box',
        'Dữ liệu cửa hàng',
        'render_store_location_box',
        'store',
        'normal',
        'high'
    );
});


// Hàm Check quyền quản lý cửa hàng của User
/**
 * Trả về slug role tương ứng với tên hiển thị (label).
 * Nếu không tìm thấy slug, trả về null.
 */
/*
function qlch_get_role_slug_by_label( $label ) {
    $roles = wp_roles()->roles;
    foreach ( $roles as $slug => $data ) {
        if ( isset( $data['name'] ) ) {
            // So sánh không phân biệt hoa thường, loại bỏ khoảng trắng 2 đầu
            if ( mb_strtolower( trim( $data['name'] ) ) === mb_strtolower( trim( $label ) ) ) {
                return $slug;
            }
        }
    }
    return null;
}
*/
/**
 * Lấy danh sách WP_User objects của những user có role label nhất định.
 * Nếu slug tìm được thì dùng get_users(['role' => $slug]) cho nhanh.
 * Nếu không, duyệt tất cả user và so khớp role label.
 */

 /*
function qlch_get_users_by_role_label( $label ) {
    $slug = qlch_get_role_slug_by_label( $label );

    if ( $slug ) {
        // Lấy nhanh theo slug
        return get_users( array(
            'role'    => $slug,
            'orderby' => 'display_name',
            'order'   => 'ASC',
            'fields'  => array( 'ID', 'display_name', 'user_email', 'roles' ),
        ) );
    }

    // Nếu không tìm slug, fallback: duyệt tất cả user và so khớp label với role name
    $matched = array();
    $all_users = get_users( array(
        'orderby' => 'display_name',
        'order'   => 'ASC',
        'fields'  => array( 'ID', 'display_name', 'user_email', 'roles' ),
    ) );

    $roles_map = wp_roles()->roles; // slug => ['name'=>..., 'capabilities'=>...]

    foreach ( $all_users as $u ) {
        if ( empty( $u->roles ) ) {
            continue;
        }
        foreach ( (array) $u->roles as $r ) {
            if ( isset( $roles_map[ $r ] ) && isset( $roles_map[ $r ]['name'] ) ) {
                if ( mb_strtolower( trim( $roles_map[ $r ]['name'] ) ) === mb_strtolower( trim( $label ) ) ) {
                    $matched[] = $u;
                    break;
                }
            }
        }
    }

    return $matched;
}


*/


// Hàm Render các ô nhập liệu lên giao diện meta box   Mở rộng render_store_location_box để hiển thị select user quản lý
 
/**
 * Render meta box: store location + manager user
 */
/**
 * Helper: tìm slug role theo label (name) hoặc trả null
 */
function render_store_location_box( $post ) {
    // Nonce để bảo mật khi lưu
    wp_nonce_field( 'qlch_store_location_nonce', 'qlch_store_location_nonce_field' );

    // Lấy meta đã lưu
    $saved_city    = get_post_meta( $post->ID, '_store_city', true );
    $saved_ward    = get_post_meta( $post->ID, '_store_ward', true );
    $saved_address = get_post_meta( $post->ID, '_store_address', true );
    $saved_lat     = get_post_meta( $post->ID, '_store_latitude', true );
    $saved_lng     = get_post_meta( $post->ID, '_store_longitude', true );
    $saved_manager = get_post_meta( $post->ID, '_store_manager_user_id', true );

    // --- Tỉnh / Thành (ví dụ tĩnh, thay bằng nguồn dữ liệu thực tế nếu có) ---
    $provinces = array(
        '' => '-- Chọn tỉnh/thành --',
        'hung_yen' => 'Hưng Yên',
        'ha_noi'   => 'Hà Nội',
        'hcm'      => 'Hồ Chí Minh',
        'da_nang'  => 'Đà Nẵng',
    );

    // Lấy danh sách user quản lý (shop_manager hoặc store_manager)
    $store_managers = get_users( array(
        'role__in' => array( 'shop_manager', 'store_manager' ),
        'orderby'  => 'display_name',
        'order'    => 'ASC',
        'fields'   => array( 'ID','display_name','user_email' ),
    ) );

    if ( empty( $store_managers ) ) {
        $store_managers = get_users( array(
            'role__in' => array( 'administrator' ),
            'orderby'   => 'display_name',
            'order'     => 'ASC',
            'fields'    => array( 'ID','display_name','user_email' ),
        ) );
        echo '<p style="color:#777; font-size:12px; margin:4px 0;">(Chưa tìm thấy user có role Quản lý cửa hàng. Hiển thị admin để chọn tạm.)</p>';
    }

    // --- Container chính ---
    echo '<div style="display:flex; gap:20px; align-items:flex-end; flex-wrap:wrap;">';

    // Tỉnh / Thành phố
    echo '<div style="min-width:220px;">';
    echo '<label><strong>Tỉnh / Thành phố: </strong></label><br>';
    echo '<select name="store_city" id="store_city" style="width:220px;">';
    foreach ( $provinces as $key => $name ) {
        $sel = ( (string)$saved_city === (string)$key ) ? ' selected' : '';
        echo '<option value="'.esc_attr($key).'"'.$sel.'>'.esc_html($name).'</option>';
    }
    echo '</select>';
    echo '</div>';

    // Xã / Phường
    echo '<div style="min-width:220px;">';
    echo '<label><strong>Xã / Phường: </strong></label><br>';
    echo '<select name="store_ward" id="store_ward" style="width:220px;">';
    if ( ! empty( $saved_ward ) ) {
        echo '<option value="'.esc_attr($saved_ward).'" selected>'.esc_html($saved_ward).'</option>';
    } else {
        echo '<option value="">-- Chọn xã/phường --</option>';
    }
    echo '</select>';
    echo '</div>';

    // Địa chỉ chi tiết
    echo '<div style="flex:1; min-width:220px;">';
    echo '<label><strong>Địa chỉ chi tiết: </strong></label><br>';
    echo '<input type="text" id="store_address" name="store_address" value="'.esc_attr($saved_address).'" style="width:100%;" />';
    echo '</div>';

    // Vĩ độ
    echo '<div style="min-width:150px;">';
    echo '<label><strong>Vĩ độ (Latitude): </strong></label><br>';
    echo '<input type="text" id="store_latitude" name="store_latitude" value="'.esc_attr($saved_lat).'" style="width:150px;" />';
    echo '</div>';

    // Kinh độ
    echo '<div style="min-width:150px;">';
    echo '<label><strong>Kinh độ (Longitude): </strong></label><br>';
    echo '<input type="text" id="store_longitude" name="store_longitude" value="'.esc_attr($saved_lng).'" style="width:150px;" />';
    echo '</div>';

    // User quản lý (ngay cạnh Kinh độ)
    echo '<div style="min-width:220px;">';
    echo '<label><strong>User quản lý: </strong></label><br>';
    echo '<select name="store_manager_user_id" id="store_manager_user_id" style="width:220px;">';
    echo '<option value="">-- Chọn User quản lý --</option>';
    foreach ( $store_managers as $u ) {
        $uid = intval( $u->ID );
        $selected = ( $saved_manager && intval( $saved_manager ) === $uid ) ? ' selected' : '';
        $label = sprintf( '%s (ID:%d) - %s', $u->display_name, $uid, $u->user_email );
        echo '<option value="'.esc_attr($uid).'"'.$selected.'>'.esc_html($label).'</option>';
    }
    echo '</select>';
    echo '</div>';

    echo '</div>'; // end flex container
}



// Lưu dữ liệu (mở rộng)
add_action('save_post_store', function($post_id) {
    // Kiểm tra nonce
    if ( ! isset($_POST['qlch_store_location_nonce_field']) 
         || ! wp_verify_nonce($_POST['qlch_store_location_nonce_field'], 'qlch_store_location_nonce') ) {
        return;
    }
    // Quyền và autosave
    if ( ! current_user_can('edit_post', $post_id) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    // Lưu các field
    if (isset($_POST['store_city'])) {
        update_post_meta($post_id, '_store_city', sanitize_text_field($_POST['store_city']));
    }
    if (isset($_POST['store_ward'])) {
        update_post_meta($post_id, '_store_ward', sanitize_text_field($_POST['store_ward']));
    }
    if (isset($_POST['store_address'])) {
        update_post_meta($post_id, '_store_address', sanitize_text_field($_POST['store_address']));
    }
    if (isset($_POST['store_latitude'])) {
        update_post_meta($post_id, '_store_latitude', sanitize_text_field($_POST['store_latitude']));
    }
    if (isset($_POST['store_longitude'])) {
        update_post_meta($post_id, '_store_longitude', sanitize_text_field($_POST['store_longitude']));
    }

    // Lưu user quản lý
    if (isset($_POST['store_manager_user_id']) && $_POST['store_manager_user_id'] !== '') {
        $user_id = intval($_POST['store_manager_user_id']);
        $user = get_userdata($user_id);
        if ($user && (
            in_array('store_manager', (array)$user->roles) ||
            in_array('shop_manager', (array)$user->roles) ||
            in_array('administrator', (array)$user->roles)
        )) {
            update_post_meta($post_id, '_store_manager_user_id', $user_id);
        } else {
            delete_post_meta($post_id, '_store_manager_user_id');
        }
    } else {
        delete_post_meta($post_id, '_store_manager_user_id');
    }
});



// Thêm cột Vĩ độ và Kinh độ, đặt trước Người quản lý
add_filter('manage_store_posts_columns', function($columns) {
    // Chèn thêm cột sau cột "Địa chỉ chi tiết"
    $new_columns = [];
    foreach ($columns as $key => $label) {
        $new_columns[$key] = $label;
        if ($key === 'store_address') { // sau cột địa chỉ
            $new_columns['store_latitude']  = 'Vĩ độ';
            $new_columns['store_longitude'] = 'Kinh độ';
        }
    }
    return $new_columns;
});

// Hiển thị dữ liệu trong cột
add_action('manage_store_posts_custom_column', function($column, $post_id) {
    if ($column === 'store_latitude') {
        $lat = get_post_meta($post_id, '_store_latitude', true);
        echo $lat ? esc_html($lat) : '-';
    }
    if ($column === 'store_longitude') {
        $lng = get_post_meta($post_id, '_store_longitude', true);
        echo $lng ? esc_html($lng) : '-';
    }
}, 10, 2);



// Cho phép sort theo Vĩ độ và Kinh độ (tuỳ chọn)

add_filter('manage_edit-store_sortable_columns', function($columns) {
    $columns['store_latitude']  = 'store_latitude';
    $columns['store_longitude'] = 'store_longitude';
    return $columns;
});

// Giới hạn độ rộng cột Vĩ độ và Kinh độ trong bảng hiển thị:

add_action('admin_head', function() {
    $screen = get_current_screen();
    if ($screen->post_type === 'store') {
        echo '<style>
            .column-store_latitude { width: 80px; }
            .column-store_longitude { width: 100px; }
        </style>';
    }
});

// Giới hạn độ rộng các cột trong màn hình quản lý cửa hàng
add_action('admin_head', function() {
    $screen = get_current_screen();
    if ($screen->post_type === 'store') {
        echo '<style>
            .column-store_latitude { width: 80px; text-align:center; }
            .column-store_longitude { width: 100px; text-align:center; }
            .column-store_city { width: 200px; }
            .column-store_ward { width: 120px; }
        </style>';
    }
});



// Nạp JS
add_action('admin_enqueue_scripts', function($hook) {
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_script('store-location', plugin_dir_url(__FILE__).'store-location.js', array('jquery'), null, true);
        wp_localize_script('store-location', 'storeLocationAjax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'json_url' => plugin_dir_url(__FILE__).'vn_locations.json'
        ));
    }
});


// Lưu dữ liệu mà người dùng nhập.
add_action('save_post_store', function($post_id) {
    if (isset($_POST['store_address'])) {
        update_post_meta($post_id, '_store_address', sanitize_text_field($_POST['store_address']));
    }
});



// Đổi "Thêm tiêu đề" thành "Tên cửa hàng"
add_filter('enter_title_here', function($title, $post){
    if ($post->post_type == 'store') {
        $title = 'Tên cửa hàng';
    }
    return $title;
}, 10, 2);



// AJAX handler: LOAD dữ liệu vào Dropdown xã/phường
add_action('wp_ajax_get_wards', function() {
    $city = sanitize_text_field($_POST['city']);
    $json_file = plugin_dir_path(__FILE__).'vn_locations.json';
    $data = json_decode(file_get_contents($json_file), true);

    $wards = isset($data[$city]) ? $data[$city] : array();
    wp_send_json($wards);
});
