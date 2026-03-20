<?php
// File: shortcodes/list-product-home-page.php
// Shortcode: [List_product_Home_page]
// Hiển thị danh sách sản phẩm kèm giá hiện tại và "giá thấp nhất" (nếu giá thấp nhất có cả sale và regular thì hiển thị sale trên, regular gạch dưới).

function list_product_home_page_shortcode() {
    $args = array(
        'post_type'      => 'product', // Loại nội dung cần lấy.
        'posts_per_page' => 8,    // Số bản ghi trả về.
        'post_status'    => 'publish',
        'orderby'        => 'ID', // Trường sắp xếp.
        'order'          => 'DESC', // Hướng sắp xếp
    );

    //WP_Query là class chính của WordPress để tạo truy vấn tùy chỉnh lấy bài viết (posts) theo nhiều tiêu chí
    $loop = new WP_Query( $args ); // WP_Query là một Class truy vấn tùy chỉnh của WordPress
    // $loop là một WP_Query object chứa:

    // methods: have_posts(), the_post(), rewind_posts(), get_posts(), next_post(), in_the_loop().

    //  properties: posts (mảng WP_Post), post_count, found_posts, max_num_pages, query_vars.

    ob_start(); // Bắt đầu output buffering của PHP: mọi output (echo, HTML trực tiếp) sau đó sẽ được lưu vào bộ đệm thay vì in ra trình duyệt ngay.

    if ( $loop->have_posts() )
     // Duyệt lần lượt từng đối tượng , xem truy vấn hiện tại còn bản ghi nào chưa được duyệt hay không.
     // Nó trả về 'true' nếu còn bài viết để lặp, 'false' nếu đã hết.
     {
        echo '<div class="product-list">';
        while ( $loop->have_posts() ) {
            $loop->the_post(); // Dùng trong vòng lặp để tiến con trỏ truy vấn

            // Lấy product object an toàn
            $product = wc_get_product( get_the_ID() );
            if ( ! $product ) continue;

            // --- BẮT ĐẦU: Thu thập tất cả entry giá (product mẹ + từng biến thể) ---

            $entries = array(); // mỗi phần tử: ['price'=>float, 'regular'=>float|null, 'sale'=>float|null, 'type'=>..., 'id'=>..., 'name'=>..., 'permalink'=>...]

            $add_entry = function( $price_val, $regular_val, $sale_val, $info ) use ( & $entries ) {
                if ( $price_val === '' || ! is_numeric( $price_val ) ) return;
                $entries[] = array(
                    'price'     => floatval( $price_val ),
                    'regular'   => ( $regular_val !== '' && is_numeric( $regular_val ) ) ? floatval( $regular_val ) : null,
                    'sale'      => ( $sale_val !== '' && is_numeric( $sale_val ) ) ? floatval( $sale_val ) : null,
                    'type'      => isset( $info['type'] ) ? $info['type'] : 'unknown',
                    'id'        => isset( $info['id'] ) ? $info['id'] : null,
                    'name'      => isset( $info['name'] ) ? $info['name'] : '',
                    'permalink' => isset( $info['permalink'] ) ? $info['permalink'] : '',
                );
            };

            // Product mẹ
            $add_entry(
                $product->get_price(),
                $product->get_regular_price(),
                $product->get_sale_price(),
                array(
                    'type' => 'product',
                    'id' => $product->get_id(),
                    'name' => $product->get_name(),
                    'permalink' => $product->get_permalink(),
                )
            );

            // Nếu variable, thêm từng biến thể
            if ( $product->is_type( 'variable' ) ) {
                $variation_ids = $product->get_children();
                if ( is_array( $variation_ids ) && ! empty( $variation_ids ) ) {
                    foreach ( $variation_ids as $vid ) {
                        $var = wc_get_product( $vid );
                        if ( ! $var ) continue;
                        $add_entry(
                            $var->get_price(),
                            $var->get_regular_price(),
                            $var->get_sale_price(),
                            array(
                                'type' => 'variation',
                                'id' => $vid,
                                'name' => $var->get_name() ? $var->get_name() : $var->get_id(),
                                'permalink' => $var->get_permalink(),
                            )
                        );
                    }
                }
            }

            // Fallback: nếu không có entry nào, thử lookup table
            if ( empty( $entries ) ) {
                global $wpdb;
                $min_lookup = $wpdb->get_var( $wpdb->prepare(
                    "SELECT min_price FROM {$wpdb->prefix}wc_product_meta_lookup WHERE product_id = %d",
                    $product->get_id()
                ) );
                if ( $min_lookup !== null && is_numeric( $min_lookup ) ) {
                    $add_entry( $min_lookup, null, null, array(
                        'type' => 'lookup',
                        'id' => $product->get_id(),
                        'name' => $product->get_name(),
                        'permalink' => $product->get_permalink(),
                    ) );
                }
            }

            // Tìm entry có price nhỏ nhất
            $min_entry = null;

            foreach ( $product->get_children() as $variation_id ) {
                $variation = wc_get_product( $variation_id );
                if ( $variation ) {
                    $price = $variation->get_price();
                    if ( $price !== '' ) {
                        $price = floatval( $price );
                        if ( $min_entry === null || $price < $min_entry['price'] ) {
                            $min_entry = [
                                'id'    => $variation_id,
                                'price' => $price,
                            ];
                        }
                    }
                }
            }

            $min_product = wc_get_product( $min_entry['id'] );
            if ( $min_product ) {
                $regular_price = $min_product->get_regular_price();
                
            }          

            $sale_price = $min_product->get_sale_price();

            // --- KẾT THÚC: Thu thập và chọn min_entry ---

            // Nếu có min_entry, lấy ID và kiểm tra giá thực (regular)
                $min_real_price_html = '';
                if ( $min_entry && ! empty( $min_entry['id'] ) ) {
                    error_log('Min entry ID: ' . $min_entry['id']); // Debug ID

                    $min_product = wc_get_product( $min_entry['id'] );
                    if ( $min_product ) {
                        $regular_price = $min_product->get_regular_price();

                        error_log('Regular price raw: ' . var_export($regular_price, true)); // Debug giá gốc

                        if ( $regular_price !== '' && is_numeric( $regular_price ) ) {
                            $min_real_price_html = wc_price( floatval( $regular_price ) );

                            error_log('Formatted regular price: ' . $min_real_price_html); // Debug HTML đã format
                        }
                    }
                }

            
            // Chuẩn bị hiển thị
            $current_price_html = $product->get_price_html();
            if ( ! $current_price_html ) {
                $prod_price = $product->get_price();
                $current_price_html = ( $prod_price !== '' && is_numeric( $prod_price ) ) ? wc_price( floatval( $prod_price ) ) : '<em>Liên hệ</em>';
            }

            // Tạo HTML cho giá thấp nhất theo yêu cầu:
            // Nếu min_entry có cả sale và regular -> hiển thị sale (dòng trên) và regular (gạch) dòng dưới.
            // Ngược lại hiển thị 1 dòng giá min.
           // $min_price_html = '<em>Liên hệ</em>';
           // if ( $min_entry ) {
             //   if ( $min_entry['sale'] !== null && $min_entry['regular'] !== null ) {
                    // Hiển thị sale trên, regular gạch dưới
                 //   $min_price_html = '<span class="min-sale">' . wc_price( $min_entry['sale'] ) . '</span>';
                  //  $min_price_html .= '<br><span class="min-regular"><del>' . wc_price( $min_entry['regular'] ) . '</del></span>';
             //   } else {
                    // Chỉ có 1 giá (hoặc không có regular/sale rõ ràng)
                   // $min_price_html = '<span class="min-only">' . wc_price( $min_entry['price'] ) . '</span>';
              //  }
          //  }

            // Show ra HTML của sản phẩm với giá của nó.

            ?>
                <div class="product-item">
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                        <div class="product-item-image">
                            <?php echo $product->get_image(); ?>
                        </div>

                        <div class="product-item-title">
                            <div class="product-item-title-detail">
                                <h3><?php echo esc_html( get_the_title() ); ?></h3> <!-- TIÊU ĐỀ SẢN PHẨM  -->
                                <div class="product-divider"></div> <!-- ĐƯỜNG PHÂN CÁCH  -->

                                <div class="product-price-add-to-cart">
                                    <div class="price-min-real-price">
                                            <?php
                                             if ( $sale_price )// Nếu $sale_price rỗng hoặc bằng null, thì khối lệnh bên trong sẽ không chạy.
                                                { 
                                                    echo '<p class="HomePage_Sale_Price">'. wc_price( $sale_price ).'</p>';
                                                }
                                            else // Giá $sale_price rỗng thì in ra giá thường. 
                                                {
                                                    echo '<p class="HomePage_Regular_Price_Sale">'. wc_price( $regular_price ).'</p>';
                                                }

                                            if ($sale_price && $regular_price ) {
                                             echo '<p class="HomePage_Regular_Price">'. wc_price( $regular_price ).'</p>';
                                            }                                          
                                            ?>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="<?php echo esc_url( get_the_permalink( $product->get_id() ) ); ?>">
                                            <img class="cc-img-CartHomePage" 
                                                src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductHomePageIMG/AddToCart.png'; ?>" 
                                                alt="Xem chi tiết sản phẩm">  
                                        </a>
                                    </div>
                                </div>
                                <!-- Nút mua ngay -->
                               <!-- <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="btn-buy">Mua ngay</a>-->
                            </div>
                        </div>
                    </a>
                </div>
            <?php

        } // end while
        echo '</div>';
    } else {
        echo '<p>Không có sản phẩm.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'List_product_Home_page', 'list_product_home_page_shortcode' );
