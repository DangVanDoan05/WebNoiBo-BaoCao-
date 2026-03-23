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
           <div class="images-product-container">    <!-- KHỐI HÌNH ẢNH SẢN PHẨM --> 
                <div class="images-large-product-container"> 
                        <div class="images-large-product">
                            <?php echo $product->get_image('large'); ?>
                        </div>
                </div>
                <div class="images-gallery-product-container"> 
    <div class="images-gallery-product">
        <?php
            $product = wc_get_product( $product_id );
            $gallery_ids = $product->get_gallery_image_ids();                           
            $max_show = 4;
            $total = count($gallery_ids);

            if ( $gallery_ids ) {
                if ($total > $max_show) {
                    // Slider với mũi tên
                    ?>
                    <div class="gallery-container">
                        <button class="btn-prev">◀</button>
                        <div class="product-gallery slider">
                            <?php foreach ($gallery_ids as $img_id) : ?>
                                <div class="gallery-item">
                                    <?php echo wp_get_attachment_image( $img_id, 'large' ); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="btn-next">▶</button>
                    </div>
                    <?php
                } else {
                    // Hiển thị bình thường
                    ?>
                    <div class="product-gallery">
                        <?php foreach ($gallery_ids as $img_id) : ?>
                            <div class="gallery-item">
                                <?php echo wp_get_attachment_image( $img_id, 'large' ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                }
            }
        ?>
    </div>
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
    
