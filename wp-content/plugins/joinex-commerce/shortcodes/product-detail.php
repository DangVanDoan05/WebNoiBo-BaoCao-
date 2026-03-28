<?php
// Shortcode: [joinex_product_detail]
function joinex_product_detail_shortcode() {
    // Lấy ID sản phẩm từ query string (?product_id=123)
    $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
    if (!$product_id) return '<p>Không tìm thấy sản phẩm.</p>';

    $product = wc_get_product($product_id);
    if (!$product) return '<p>Không tìm thấy sản phẩm.</p>';

    ob_start(); ?>

    <!-- KHỐI HTML BẮT ĐẦU -->

    <div class="joinex-product-detail">   
        <div class="images-short-description-product"> <!-- KHỐI HÌNH ẢNH SẢN PHẨM MÔ TẢ NGẮN -->
            <div class="images-product-container">   <!-- KHỐI HÌNH ẢNH SẢN PHẨM -->

                <!-- ẢNH CHÍNH -->
                <div class="main-image-container">
                    <?php
                        $product     = wc_get_product( $product_id );
                        $main_img_id = $product->get_image_id(); // ảnh sản phẩm chính
                        $gallery_ids = $product->get_gallery_image_ids(); // thư viện ảnh

                        if ( $main_img_id ) {
                            echo wp_get_attachment_image( $main_img_id, 'large', false, array( 'id' => 'current-main-image' ));
                        }
                    ?>
                </div>            

                <!-- GALLERY THUMBNAIL--HÌNH ẢNH LIÊN QUAN SẢN PHẨM -->
                <div class="images-gallery-product-container">
                    <?php
                        if ( $main_img_id || $gallery_ids ) {
                            $all_ids = array(); 
                            if ( $main_img_id ) {
                                $all_ids[] = $main_img_id; // đưa ảnh chính lên đầu
                            }
                            if ( $gallery_ids ) {
                                $all_ids = array_merge( $all_ids, $gallery_ids );
                            }

                            $max_show = 4;
                            $total    = count( $all_ids );

                            if ( $total > $max_show ) {
                                // Nếu nhiều hơn 4 ảnh thì hiển thị slider với mũi tên
                                ?>
                                <div class="gallery-container">
                                    <button class="btn-prev">◀</button>
                                    <div class="images-gallery-product slider">
                                        <?php foreach ( $all_ids as $index => $img_id ) : ?>
                                            <div class="gallery-thumb">
                                                <?php 
                                                    $class = $index === 0 ? 'thumb-image active' : 'thumb-image';
                                                    echo wp_get_attachment_image( $img_id, 'thumbnail', false, array( 'class' => $class ));
                                                ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="btn-next">▶</button>
                                </div>
                                <?php
                            } else {
                                // Nếu ≤4 ảnh thì hiển thị bình thường
                                ?>
                                <div class="images-gallery-product">
                                    <?php foreach ( $all_ids as $index => $img_id ) : ?>
                                        <div class="gallery-thumb">
                                            <?php 
                                                $class = $index === 0 ? 'thumb-image active' : 'thumb-image';
                                                echo wp_get_attachment_image( $img_id, 'thumbnail', false, array( 'class' => $class ));
                                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="title-short-description-product">  <!-- KHỐI TIÊU ĐỀ VÀ MÔ TẢ NGẮN  --> 
                <div class="product-title">
                    <h1 class="title"><?php echo esc_html($product->get_name()); ?></h1>
                    <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                </div>               
                <div class="product-price">
                    <?php echo $product->get_price_html(); ?>
                </div>
                <div class="product-short-description">                 
                    <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() );?>
                </div>
                <div class="divider"></div> <!-- ĐƯỜNG PHÂN CÁCH--> 
                <!-- PHẦN GIÁ SẢN PHẨM LẤY ĐỘNG THEO THUỘC TÍNH SẼ ĐỂ XỬ LÝ SAU. --> 
                <div class="product-variation"> <!-- KHỐI THUỘC TÍNH SẢN PHẨM --> 
                <?php
                    // Lấy ID từ URL
                    $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

                    if ($product_id) {
                        $product = wc_get_product($product_id);
                        if ($product) {
                            // Nếu là biến thể thì tìm sản phẩm mẹ
                            if ($product->is_type('variation')) {
                                $parent_id      = $product->get_parent_id();
                                $parent_product = wc_get_product($parent_id);
                            } else {
                                // Nếu đã là sản phẩm mẹ thì dùng luôn
                                $parent_product = $product;
                            }
                            if ($parent_product) {
                                $attributes = $parent_product->get_attributes();                            
                                echo '<div class="cc-variation-container">';
                                    foreach ($attributes as $attribute) {
                                        $name = wc_attribute_label($attribute->get_name());
                                        // KHỐI THUỘC TÍNH SẢN PHẨM
                                        echo '<div class="variation-group">';
                                            echo '<div class="label-variation">' . $name . ':</div> ';              
                                            if ($attribute->is_taxonomy()) {    // Nếu là TAXONOMY
                                                // Nếu là TAXONOMY (pa_xxx)
                                                $terms = wc_get_product_terms(
                                                    $parent_product->get_id(),
                                                    $attribute->get_name(),
                                                    array('fields' => 'names')
                                                );
                                                echo '<div class="button-variation-container">';
                                                    foreach ($terms as $term) {
                                                        echo '<button class="attr-btn" data-attr="' . esc_attr($term) . '">' . esc_html($term) . '</button> ';
                                                    }
                                                echo '</div>';

                                            } else {
                                                // Nếu là custom attribute
                                                $options = $attribute->get_options();
                                                echo '<div class="button-variation-container">';
                                                    foreach ($options as $option) {
                                                        echo '<button class="attr-btn" data-attr="' . esc_attr($option) . '">' . esc_html($option) . '</button> ';
                                                    }
                                                echo '</div>';
                                            }           
                                        echo '</div>';
                                    }
                                echo '</div>';
                            } else {
                                echo '<p>Không tìm thấy sản phẩm mẹ.</p>';
                            }
                        } else {
                            echo '<p>Không tìm thấy sản phẩm với ID này.</p>';
                        }
                    } else {
                        echo '<p>Không có product_id trong URL.</p>';
                    }
                    ?>


                </div>
                <div class="product-actions">  <!-- CÁC HÀNH ĐỘNG SẢN PHẨM --> 
                    <div class="quantity-joinex">
                        <button class="qty-btn-joinex minus-joinex">-</button>
                        <input type="number" class="qty-input-joinex" value="1" min="1">
                        <button class="qty-btn-joinex plus-joinex">+</button>
                    </div>
                    <div class="action-buttons-joinex">
                        <button class="cart-btn-joinex">                          
                             <img class="cart-icon-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/CartIMG.png'; ?>" alt="Cart">                          
                           <!-- <img src="/assets/img/ProductDetailPageIMG/CartIMG.png" alt="" class="cart-icon-joinex"> -->
                             Thêm vào giỏ hàng
                        </button>
                        <button class="buy-btn-joinex">
                        <img class="buy-icon-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/BuyNowIMG.png'; ?>" alt="Cart"> 
                             Mua ngay</button>
                    </div>
                                    
                </div>
                <div class="service-info-joinex"> <!-- KHỐI THÔNG TIN DỊCH VỤ --> 
                        <div class="service-item-joinex">
                            <div class="service-img">
                              <img class="support-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/NutLienHeIMG.png'; ?>" alt="Cart">
                            </div>  
                            <div class="service-text-joinex">
                                <h4>Lắp đặt tận nơi</h4>
                                <p>Hướng dẫn và hỗ trợ lắp đặt tại nhà. <a href="#">Xem chi tiết</a></p>
                            </div>
                        </div>
                         <div class="service-divider"></div> <!-- ĐƯỜNG PHÂN CÁCH--> 
                        <div class="service-item-joinex">
                            <div class="service-img">
                                <img class="transport-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/XeTaiIMG.png'; ?>" alt="Cart">
                            </div>  
                            <div class="service-text-joinex">
                                <h4>Giao hàng miễn phí</h4>
                                <p>Miễn phí giao hàng cho đơn từ 500.000đ.</p>
                            </div>
                        </div>
                        <div class="service-divider"></div> <!-- ĐƯỜNG PHÂN CÁCH--> 
                        <div class="service-item-joinex">
                            <div class="service-img">
                                <img class="return-product-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/HoanHangIMG.png'; ?>" alt="Cart">
                            </div> 
                            <div class="service-text-joinex">
                                <h4>Trả hàng</h4>
                                <p>Miễn phí trả hàng trong vòng 30 ngày. <a href="#">Xem thêm</a></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>     
        <div class="long-description-product">  <!-- KHỐI MÔ TẢ DÀI.  --> 
            <!-- PHẦN MÔ TẢ DÀI SẢN PHẨM  --> 
            <!-- <?php echo wpautop($product->get_description()); ?> --> 
            <div class="product-tabs-joinex">

                <ul class="tab-header-joinex">
                    <li class="tab-link-joinex active" data-tab="desc">Mô tả sản phẩm</li>
                    <li class="tab-link-joinex" data-tab="specs">Thông số kỹ thuật</li>
                    <li class="tab-link-joinex" data-tab="guide">Hướng dẫn lắp đặt</li>
                </ul>
                <div class="tab-content-joinex"> <!-- TAB ĐẦU TIÊN --> 
                    <div id="desc" class="tab-pane-joinex active">
                    <?php echo wpautop($product->get_description()); ?>
                </div>
                <div id="specs" class="tab-pane-joinex"> <!-- TAB GIỮA --> 
                   <?php
                        $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : get_the_ID();
                        // Lấy dữ liệu meta
                        $thong_so = get_post_meta($product_id, '_thong_so_ky_thuat', true);
                        $huong_dan = get_post_meta($product_id, '_huong_dan_lap_dat', true);
                        // Hiển thị nếu có dữ liệu
                        if (!empty($thong_so)) {
                            echo '<div class="product-thong-so">';
                            echo '<h3>Thông số kỹ thuật</h3>';
                            echo wpautop($thong_so);
                            echo '</div>';
                        }
                    ?>
                </div>

                <div id="guide" class="tab-pane-joinex"> <!-- TAB CUỐI --> 
                    <p>Hướng dẫn chi tiết cách lắp đặt sản phẩm tại nhà...</p>
                    <?php
                        $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : get_the_ID();
                        // Lấy dữ liệu meta
                      
                        $huong_dan = get_post_meta($product_id, '_huong_dan_lap_dat', true);
                        if (!empty($huong_dan)) {
                            echo '<div class="product-huong-dan">';
                            echo '<h3>Hướng dẫn lắp đặt</h3>';
                            echo wpautop($huong_dan);
                            echo '</div>';
                        }
                    ?>

                </div>
            </div>
        </div>
        </div> 
        <div id="reviews" class="customer-review-product">  <!-- KHỐI REVIEW SẢN PHẨM  --> 
            <div><p>ĐÂY LÀ KHỐI KẾT QUẢ ĐÁNH GIÁ SẢN PHẨM</p></div>
            <?php
                global $post;
                $product_id = $post->ID; // hoặc $_GET['product_id'] nếu bạn dùng URL query

                // Lấy danh sách review cho sản phẩm
                $args = array(
                    'post_id' => $product_id,
                    'status'  => 'approve',
                    'type'    => 'review',
                );
                $reviews = get_comments($args);

                // Lấy rating trung bình
               // $average_rating = wc_get_rating_html( wc_get_average_rating($product_id) );

                echo '<h3>Đánh giá từ khách hàng</h3>';
              //  echo '<div class="average-rating">' . $average_rating . '</div>';

                if ($reviews) {
                    echo '<div class="product-reviews">';
                    foreach ($reviews as $review) {
                        $rating = get_comment_meta($review->comment_ID, 'rating', true);
                        echo '<div class="single-review">';
                        echo '<strong>' . esc_html($review->comment_author) . '</strong>';
                        if ($rating) {
                            echo wc_get_rating_html($rating);
                        }
                        echo '<p>' . esc_html($review->comment_content) . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>Chưa có đánh giá nào cho sản phẩm này.</p>';
                }
            ?>
        </div>
        <div id="relative-product-slider" class="relative-product-joinex-slider"> <!-- KHỐI SẢN PHẨM  LIÊN QUAN -->
            
            <?php
                $cat_id = isset($_GET['product_cat']) ? intval($_GET['product_cat']) : 0; // DANH MỤC SẢN PHẨM
                $order_by = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : ''; // Tham số để sắp xếp.
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1, // Quy ước của WORDPRESS Nếu bạn đặt -1, WordPress hiểu là “không giới hạn”, tức là lấy ra tất cả các bài viết/sản phẩm phù hợp với query.
                      //tức là lấy ra tất cả các bài viết/sản phẩm phù hợp với query.
                    'post_status'    => 'publish',
                    'orderby'        => 'ID',
                    'order'          => 'DESC',
                );    
                                
                $loop = new WP_Query($args);                            
                ob_start();               
                if ( $loop->have_posts() )               
                 {
                    echo '<div class="product-list-slider">';
                        echo'<div class="product-list-slider-track">'; // RÃNH TRƯỢT CỦA SLIDER
                   
                            while ( $loop->have_posts() ) {
                            //#region LOGIC ĐỂ LẤY GIÁ VÀ CÁC BIẾN THỂ
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
        
                                ?>
                                    <!-- HIỂN THỊ SẢN PHẨM -->
                                    <div class="product-slider-item">
                                        <!-- LINK ĐẾN TRANG CHI TIẾT SẢN PHẨM -->
                                        <a href="<?php echo esc_url( site_url('/chi-tiet-san-pham') . '?product_id=' . $product->get_id() ); ?>">
                                                <div class="product-item-image"> <!-- KHỐI HÌNH ẢNH SẢN PHẨM  -->
                                                    <?php
                                                        echo $product->get_image();
                                                        if ($sale_price && $regular_price ) {                                                                                 
                                                            $discount_percent =  round(( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                                                            echo '<p class="discount-label">- ' .$discount_percent. '%</p>';
                                                        }
                                                    ?>
                                                </div>
                                                <div class="product-item-title"> <!-- TIÊU ĐỀ, THÔNG TIN SẢN PHẨM  -->
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
                                                                <a href="<?php echo esc_url( site_url('/chi-tiet-san-pham') . '?product_id=' . $product->get_id() ); ?>">
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
                        echo '</div>'; // ĐÓNG KHỐI RÃNH TRƯỢT SLIDER
                            echo '<button class="slick-next custom-next" aria-label="Next">&#10095;</button>'; // NÚT DI CHUYỂN
                            echo '<button class="slick-prev custom-prev" aria-label="Previous">&#10094;</button>'; // NÚT DI CHUYỂN
                    echo '</div>'; // ĐÓNG KHỐI BAO NGOÀI RÃNH TRƯỢT SLIDER                
                } else {
                    echo '<p class="no-products">Không có sản phẩm.</p>';
                }
            
                wp_reset_postdata();
                return ob_get_clean();
            
            ?>
        </div>

    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('joinex_product_detail', 'joinex_product_detail_shortcode');


    // Enqueue JS riêng cho shortcode
    function joinex_enqueue_product_detail_scripts() {
        // Đảm bảo chỉ load khi shortcode xuất hiện
        if ( is_singular('product') ) {
            wp_enqueue_script(
                'joinex-product-detail', // handle
                plugin_dir_url(__FILE__) . '../assets/js/product-detail.js', // đường dẫn tới file JS
                array('jquery'), // dependencies
                '1.0.0', // version
                true // in footer
            );
        }
    }
    add_action( 'wp_enqueue_scripts', 'joinex_enqueue_product_detail_scripts' );

    function enqueue_gallery_slider_js() {
        wp_enqueue_script(
            'gallery-slider',
            plugin_dir_url(__FILE__) . '../assets/js/product-detail.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }
    add_action('wp_enqueue_scripts', 'enqueue_gallery_slider_js');
    
