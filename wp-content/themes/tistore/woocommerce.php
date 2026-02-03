<?php get_header(); ?>
    <div class="wpdevart-woo-container">

        <?php if ( is_shop() || is_product_category() || is_product_tag() ) { ?>
            <div class="main-woo-container <?php if (( get_theme_mod( 'wpdevart_tistore_woocommerce_shop_category_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_tistore_woocommerce_shop_category_layout' ) == 'sidebarleft' ))
                                                    { echo esc_attr('woo-container-with-sidebar wpdevart-woo-main-content-sidebarleft'); } 
                                                        else if (( get_theme_mod( 'wpdevart_tistore_woocommerce_shop_category_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_tistore_woocommerce_shop_category_layout' ) != 'sidebarleft' )) 
                                                            { echo esc_attr('woo-container-with-sidebar'); } 
                                                                ?> wpdevart-woo-main-content" id="content_navigator">
                <div role="main" class="<?php  if ( get_theme_mod( 'wpdevart_tistore_woocommerce_shop_category_layout' ) == 'sidebarnone' ) { echo esc_attr('wpdevart-woo-product-list-full-width'); } else { echo esc_attr('wpdevart-woo-product-list-with-sidebar'); } ?>">
                    <div class="woocommerce">
						<?php woocommerce_content(); ?>
                    </div>
                </div>
                    <?php  if   ( get_theme_mod( 'wpdevart_tistore_woocommerce_shop_category_layout' ) != 'sidebarnone' )
                                    { get_template_part( 'template-parts/sidebar/sidebar-woo-wpdevart' ); } ?>
            </div>
        <?php } ?>

        <?php if ( is_product() ) { ?>
            <div class="main-woo-container <?php if (( get_theme_mod( 'wpdevart_tistore_woocommerce_product_pages_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_tistore_woocommerce_product_pages_layout' ) == 'sidebarleft' ))
                                                    { echo esc_attr('woo-container-with-sidebar wpdevart-woo-main-content-sidebarleft'); } 
                                                        else if (( get_theme_mod( 'wpdevart_tistore_woocommerce_product_pages_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_tistore_woocommerce_product_pages_layout' ) != 'sidebarleft' )) 
                                                            { echo esc_attr('woo-container-with-sidebar'); } 
                                                                ?> wpdevart-woo-main-content" id="content_navigator">
                <div role="main" class="<?php  if ( get_theme_mod( 'wpdevart_tistore_woocommerce_product_pages_layout' ) == 'sidebarnone' ) { echo esc_attr('wpdevart-woo-product-list-full-width'); } else { echo esc_attr('wpdevart-woo-product-list-with-sidebar'); } ?>">
                    <div class="woocommerce">
                        <?php woocommerce_content(); ?>
                    </div>
                </div>
                    <?php  if   ( get_theme_mod( 'wpdevart_tistore_woocommerce_product_pages_layout' ) != 'sidebarnone' )
                                    { get_template_part( 'template-parts/sidebar/sidebar-woo-wpdevart' ); } ?>
            </div>
        <?php } ?>

        <?php
global $product;
if ( $product->is_on_sale() ) {
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();

    if ( $regular_price > 0 && $sale_price > 0 ) {
        $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
        echo '<span class="onsale">-' . $percentage . '%</span>';
    }
}
?>


    </div>
<?php get_footer(); ?>