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
        <div class="images-short-description-product">
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
                                                // Nếu là taxonomy (pa_xxx)
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
                        <button class="cart-btn-joinex">🛒 Thêm vào giỏ hàng</button>
                        <button class="buy-btn-joinex">⚡ Mua ngay</button>
                    </div>
                                    
                </div>
            </div>
        </div>     
        <div class="long-description-product">  <!-- KHỐI MÔ TẢ DÀI.  --> 
            <?php echo wpautop($product->get_description()); ?>
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
    
