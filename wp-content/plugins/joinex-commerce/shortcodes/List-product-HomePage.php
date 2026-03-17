<?php
// File: shortcodes/list-product-home-page.php
// Shortcode: [List_product_Home_page]
// Hiển thị danh sách sản phẩm kèm giá hiện tại và "giá thấp nhất" (nếu giá thấp nhất có cả sale và regular thì hiển thị sale trên, regular gạch dưới).

function list_product_home_page_shortcode() {
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 4,    // SỐ SẢN PHẨM HIỂN THỊ TRÊN TRANG.
        'post_status'    => 'publish',
        'orderby'        => 'ID',
        'order'          => 'DESC',
    );

    $loop = new WP_Query( $args );
    ob_start();

    if ( $loop->have_posts() ) {
        echo '<div class="product-list">';
        while ( $loop->have_posts() ) {
            $loop->the_post();

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
            if ( ! empty( $entries ) ) {
                usort( $entries, function( $a, $b ) {
                    if ( $a['price'] == $b['price'] ) return 0;
                    return ( $a['price'] < $b['price'] ) ? -1 : 1;
                } );
                $min_entry = $entries[0];
            }
            // --- KẾT THÚC: Thu thập và chọn min_entry ---

            // Chuẩn bị hiển thị
            $current_price_html = $product->get_price_html();
            if ( ! $current_price_html ) {
                $prod_price = $product->get_price();
                $current_price_html = ( $prod_price !== '' && is_numeric( $prod_price ) ) ? wc_price( floatval( $prod_price ) ) : '<em>Liên hệ</em>';
            }

            // Tạo HTML cho giá thấp nhất theo yêu cầu:
            // Nếu min_entry có cả sale và regular -> hiển thị sale (dòng trên) và regular (gạch) dòng dưới.
            // Ngược lại hiển thị 1 dòng giá min.
            $min_price_html = '<em>Liên hệ</em>';
            if ( $min_entry ) {
                if ( $min_entry['sale'] !== null && $min_entry['regular'] !== null ) {
                    // Hiển thị sale trên, regular gạch dưới
                    $min_price_html = '<span class="min-sale">' . wc_price( $min_entry['sale'] ) . '</span>';
                    $min_price_html .= '<br><span class="min-regular"><del>' . wc_price( $min_entry['regular'] ) . '</del></span>';
                } else {
                    // Chỉ có 1 giá (hoặc không có regular/sale rõ ràng)
                    $min_price_html = '<span class="min-only">' . wc_price( $min_entry['price'] ) . '</span>';
                }
            }

            // Render product item
            ?>
            <div class="product-item">
                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                    <div class="product-item-image">
                        <?php echo $product->get_image(); ?>
                    </div>

                    <div class="product-item-title">
                        <div class="product-item-title-detail">
                            <h3><?php echo esc_html( get_the_title() ); ?></h3>
                            <div class="product-divider"></div>

                            <!-- Giá hiện tại (product mẹ) -->
                            <p class="price current-price"><?php echo $current_price_html; ?></p>

                            <!-- Giá thấp nhất: sale trên, giá gốc dưới (nếu có) -->
                            <p class="price min-price"><?php echo $min_price_html; ?></p>

                            <!-- Nút mua ngay -->
                            <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="btn-buy">Mua ngay</a>
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
