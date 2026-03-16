<?php
// File: shortcodes/list-product-home-page.php
function list_product_home_page_shortcode() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 8    // SỐ SẢN PHẨM HIỂN THỊ TRÊN TRANG.
    );

    $loop = new WP_Query($args);
    ob_start();
    echo '<div class="product-list">';
    while ($loop->have_posts()) : $loop->the_post();
        global $product; ?>

        <div class="product-item">

            <!--SHOW SẢN PHẨM VÀ GIÁ -->
            <a href="<?php the_permalink(); ?>">

                 <div class="product-item-image">
                    <?php echo $product->get_image(); ?>
                </div>            
                <div  class="product-item-title">
                    <div  class="product-item-title-detail">
                        <h3><?php the_title(); ?></h3>
                        <div class="product-divider"></div>
                        <p class="price"><?php echo $product->get_price_html(); ?></p>
                        <!--SHOW NÚT MUA NGAY -->
                        <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                        class="btn-buy">Mua ngay</a> 
                    </div>
                </div>
            </a>
            
            
        </div>
    <?php endwhile;
    echo '</div>';
    wp_reset_query();
    return ob_get_clean();
}
add_shortcode('List_product_Home_page', 'list_product_home_page_shortcode');
