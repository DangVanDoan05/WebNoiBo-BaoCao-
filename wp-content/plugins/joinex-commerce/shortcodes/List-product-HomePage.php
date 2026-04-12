<?php
// File: shortcodes/list-product-home-page.php
// Shortcode: [List_product_Home_page]
// Hiển thị danh sách sản phẩm kèm giá hiện tại và "giá thấp nhất" (nếu giá thấp nhất có cả sale và regular thì hiển thị sale trên, regular gạch dưới).

function list_product_home_page_shortcode() {
    $cat_id = isset($_GET['product_cat']) ? intval($_GET['product_cat']) : 0;

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'orderby'        => 'ID',
    'order'          => 'DESC',
);

if ($cat_id > 0) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $cat_id,
        ),
    );
}

$loop = new WP_Query($args);
    // $loop là một WP_Query object chứa:

    // methods: have_posts(), the_post(), rewind_posts(), get_posts(), next_post(), in_the_loop().

    //  properties: posts (mảng WP_Post), post_count, found_posts, max_num_pages, query_vars.

    ob_start(); // Bắt đầu output buffering của PHP: mọi output (echo, HTML trực tiếp) sau đó sẽ được lưu vào bộ đệm thay vì in ra trình duyệt ngay.

    // KHỐI LẤY SẢN PHẨM ĐÃ BỎ LỖI LẤY SẢN PHẨM ĐƠN GIẢN

    if ( $loop->have_posts() ) {
    
        echo '<div class="product-list-joinex">';
             // VÒNG LẶP ĐỂ LẤY SẢN PHẨM
            while ( $loop->have_posts() ) {
                $loop->the_post();
        
                $product = wc_get_product( get_the_ID() );
                if ( ! $product ) continue;
        
                // =============================
                // 🔥 LẤY GIÁ THẤP NHẤT (FIX FULL)
                // =============================
                $min_product = null;
        
                if ( $product->is_type( 'variable' ) ) {
        
                    $min_price = null;
                    $variation_ids = $product->get_children();
        
                    foreach ( $variation_ids as $vid ) {
                        $variation = wc_get_product( $vid );
                        if ( ! $variation ) continue;
        
                        $price = $variation->get_price();
        
                        if ( $price !== '' && is_numeric( $price ) ) {
                            $price = floatval( $price );
        
                            if ( $min_price === null || $price < $min_price ) {
                                $min_price = $price;
                                $min_product = $variation;
                            }
                        }
                    }
        
                    // fallback nếu không tìm được biến thể
                    if ( ! $min_product ) {
                        $min_product = $product;
                    }
        
                } else {
                    // 👉 sản phẩm đơn
                    $min_product = $product;
                }
        
                // =============================
                // 🔥 LẤY GIÁ AN TOÀN
                // =============================
                $regular_price = '';
                $sale_price    = '';
        
                if ( $min_product && is_a( $min_product, 'WC_Product' ) ) {
                    $regular_price = $min_product->get_regular_price();
                    $sale_price    = $min_product->get_sale_price();
                }
        
                // =============================
                // 🔥 TÍNH % GIẢM GIÁ
                // =============================
                $discount_percent = null;
        
                if ( $sale_price && $regular_price && $regular_price > 0 ) {
                    $discount_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                }
                ?>
        
                <div class="product-item-joinex">
                    <a href="<?php echo esc_url( site_url('/chi-tiet-san-pham') . '?product_id=' . $product->get_id() ); ?>">
                        <div class="product-item-joinex-image">
                            <?php
                                echo $product->get_image();
        
                                if ( $discount_percent ) {
                                    echo '<p class="discount-label">- ' . $discount_percent . '%</p>';
                                }
                            ?>
                        </div>
        
                        <div class="product-item-joinex-title">

                                <div class="product-item-joinex-title-detail">    
                                    <h3><?php echo esc_html( get_the_title() ); ?></h3>
                                </div>

                                <div class="product-joinex-divider"></div>

                                <div class="product-joinex-price-add-to-cart">
        
                                    <div class="price-min-real-price">
        
                                        <?php
                                        // 👉 Có giá sale
                                        if ( $sale_price ) {
                                            echo '<p class="HomePage_Sale_Price">' . wc_price( $sale_price ) . '</p>';
        
                                            if ( $regular_price ) {
                                                echo '<p class="HomePage_Regular_Price">' . wc_price( $regular_price ) . '</p>';
                                            }
                                        } 
                                        // 👉 Không có sale → giá thường
                                        else {
                                            if ( $regular_price ) {
                                                echo '<p class="HomePage_Regular_Price_Sale">' . wc_price( $regular_price ) . '</p>';
                                            } else {
                                                echo '<p><em>Liên hệ</em></p>';
                                            }
                                        }
                                        ?>
        
                                    </div>
        
                                    <div class="add-to-cart">
                                        <a href="<?php echo esc_url( site_url('/chi-tiet-san-pham') . '?product_id=' . $product->get_id() ); ?>">
                                            <img class="cc-img-CartHomePage" 
                                                src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductHomePageIMG/AddToCart.png'; ?>" 
                                                alt="Xem chi tiết sản phẩm">  
                                        </a>
                                    </div>
        
                                </div>  

                        </div>

                    </a>
                </div>
                <?php
            }
        echo '</div>';
    } else {
        echo '<p class="no-products">Không có sản phẩm.</p>';
    }  
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'List_product_Home_page', 'list_product_home_page_shortcode' );
