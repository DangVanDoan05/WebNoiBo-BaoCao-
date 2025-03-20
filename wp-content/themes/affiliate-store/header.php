<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Affiliate Store
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('affiliate_store_preloader', false) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'affiliate-store' ); ?></a>

<div id="pageholder" <?php if( get_theme_mod( 'affiliate_store_box_layout', false) != "" ) { echo 'class="boxlayout"'; } ?>>

<div class="mainhead">
  <?php if(get_theme_mod('affiliate_store_enable_topbar_section', true) != ''){ ?>
    <div class="topbar-sec py-2">
      <div class="container">
        <div class="row">
          <div class="col-xxl-9 col-xl-8 col-lg-7 col-md-6 col-12 align-self-center top-text d-flex align-items-center gap-2 ">
            <?php if(get_theme_mod('affiliate_store_topbar_text') != ''){ ?>
              <i class="fa-solid fa-volume-high"></i><p class="mb-0"><?php echo esc_html(get_theme_mod ('affiliate_store_topbar_text','affiliate-store')); ?></p>
            <?php } ?>
          </div>
          <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-12 align-self-center d-flex justify-content-between align-items-center">
            <?php if(class_exists('woocommerce')){ ?>
              <div class="order-track position-relative align-self-center d-flex">
                <p class="topbar-text mb-0 text-capitalize">
                 <?php echo esc_html(get_theme_mod('affiliate_store_topbar_track_text'));?>
                 <span class="screen-reader-text"><?php esc_html_e( 'Track Order','affiliate-store');?></span>
                </p>
                <div class="order-track-hover text-left">
                  <?php echo do_shortcode('[woocommerce_order_tracking]','affiliate-store'); ?>
                </div>
              </div>
            <?php }?>
            <?php if( class_exists( 'GTranslate' ) ) { ?>
              <div class="translate-lang position-relative d-md-inline-block">
                <?php echo do_shortcode( '[gtranslate]' );?>
              </div>
            <?php }?>
            <?php if(get_theme_mod('affiliate_store_header_currency_switcher', true) != ''){ ?>
              <span class="currency-box">
                <?php echo do_shortcode('[woocommerce_currency_switcher_drop_down_box]'); ?>
              </span>
            <?php } ?>
          </div>
        </div>
      </div> 
    </div>
  <?php } ?>
  <div class="top-image-sec py-2 ps-2">
    <div class="container">
      <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 align-self-center">
          <div class="logo">
            <?php affiliate_store_the_custom_logo(); ?>
            <div class="site-branding-text">
              <?php if (get_theme_mod('affiliate_store_title_enable', true)) { ?>
                <?php if (is_front_page() && is_home()) : ?>
                  <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php else : ?>
                  <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
                <?php endif; ?>
              <?php } ?>
              <?php $affiliate_store_description = get_bloginfo('description', 'display');
              if ($affiliate_store_description || is_customize_preview()) : ?>
                <?php if (get_theme_mod('affiliate_store_tagline_enable', false)) { ?>
                  <span class="site-description"><?php echo esc_html($affiliate_store_description); ?></span>
                <?php } ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 align-items-center d-flex social-main-sec">
          <?php if(get_theme_mod('affiliate_store_enable_social_section', true) != ''){ ?>
            <div class="follow-text">
              <p class="mb-0 me-3 text-capitalize"><?php esc_html_e( 'Follow Us','affiliate-store');?></p>
            </div>
            <div class="social-icons d-flex gap-2">
              <?php if ( get_theme_mod('affiliate_store_facebook_link') != "") { ?>
                <a title="<?php echo esc_attr('facebook', 'affiliate-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('affiliate_store_facebook_link')); ?>"><i class="fa-brands fa-facebook-f"></i></a> 
              <?php } ?>
              <?php if ( get_theme_mod('affiliate_store_twitter_link') != "") { ?> 
                <a title="<?php echo esc_attr('twitter', 'affiliate-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('affiliate_store_twitter_link')); ?>"><i class="fa-brands fa-x-twitter"></i></a>
              <?php } ?>
              <?php if ( get_theme_mod('affiliate_store_instagram_link') != "") { ?> 
                <a title="<?php echo esc_attr('instagram', 'affiliate-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('affiliate_store_instagram_link')); ?>"><i class="fa-brands fa-instagram"></i></a>
              <?php } ?>
              <?php if ( get_theme_mod('affiliate_store_youtube_link') != "") { ?>
                <a title="<?php echo esc_attr('youtube', 'affiliate-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('affiliate_store_youtube_link')); ?>"><i class="fa-brands fa-youtube"></i></a>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
        <div class="col-xxl-5 col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12 position-relative align-self-center">
          <?php if (get_theme_mod('affiliate_store_middle_header_img') != '') { ?>
            <img src="<?php echo esc_url(get_theme_mod('affiliate_store_middle_header_img')); ?>" alt="" class="topbar-img"/>
            <div class="top-img-overlay"></div>
            <div class="image-content position-absolute px-3">
              <div class="row">
                <div class="col-xl-5 col-lg-7 col-md-5 col-sm-6 col-8 align-self-center">
                  <?php if(get_theme_mod('affiliate_store_header_img_title') != ''){ ?>
                    <p class="mb-0 header-img-title text-capitalize"><?php echo esc_html(get_theme_mod ('affiliate_store_header_img_title','affiliate-store')); ?></p>
                  <?php } ?>
                  <?php if(get_theme_mod('affiliate_store_header_img_title_text') != ''){ ?>
                    <p class="mb-0 header-img-text text-capitalize"><?php echo esc_html(get_theme_mod ('affiliate_store_header_img_title_text','affiliate-store')); ?></p>
                  <?php } ?>
                </div>
                <div class="col-xl-7 col-lg-5 col-md-7 col-sm-6 col-4 align-self-center">
                  <div class="sale-tag text-center">
                    <?php if(get_theme_mod('affiliate_store_sale_title') != ''){ ?>
                      <p class="mb-0 sale-tag1 text-uppercase"><?php echo esc_html(get_theme_mod ('affiliate_store_sale_title','affiliate-store')); ?></p>
                    <?php } ?>
                    <?php if(get_theme_mod('affiliate_store_sale_text') != ''){ ?>
                      <p class="mb-0 sale-tag2 text-uppercase"><?php echo esc_html(get_theme_mod ('affiliate_store_sale_text','affiliate-store')); ?></p>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="col-xxl-1 col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12 align-items-center woo-icons d-flex gap-2 justify-content-end">
          <?php if (class_exists('woocommerce')) { ?>
            <span class="wishlist pe-3">
                <?php 
                if (defined('YITH_WCWL') && class_exists('YITH_WCWL_Wishlists')) {
                    $affiliate_store_wishlist_count = 0;
                    $affiliate_store_wishlist_instance = YITH_WCWL_Wishlists::get_instance(); 
                    if ($affiliate_store_wishlist_instance) {
                        $affiliate_store_wishlist_count = $affiliate_store_wishlist_instance->count_items_in_wishlist();
                    }
                ?>
                    <a class="wishlist_view position-relative" href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
                        <i class="far fa-heart"></i>
                        <span class="wishlist-count"><?php echo esc_html($affiliate_store_wishlist_count); ?></span>
                    </a>
                <?php } else { ?>
                    <a class="wishlist_view position-relative" href="#">
                        <i class="far fa-heart"></i>
                        <span class="wishlist-count">0</span>
                    </a>
                <?php } ?>
              </span>
            <span class="product-cart">
              <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','affiliate-store' ); ?>"><i class="fas fa-shopping-bag"></i></a>
              <?php 
                $affiliate_store_cart_count = WC()->cart->get_cart_contents_count(); 
                if($affiliate_store_cart_count > 0): ?>
                <span class="cart-count"><?php echo $affiliate_store_cart_count; ?></span>
              <?php endif; ?>
            </span>
            <span class="product-account text-center">
              <?php if (is_user_logged_in()) { ?>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php esc_attr_e('My Account', 'affiliate-store'); ?>"><i class="far fa-user"></i></a>
              <?php } else { ?>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php esc_attr_e('Login / Register', 'affiliate-store'); ?>"><i class="far fa-user"></i></a>
              <?php } ?>
            </span>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="menu-sec py-1">
    <div class="container">
      <div class="row">
        <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-4 col-6 align-self-center">
          <div class="toggle-nav text-center">
            <?php if (has_nav_menu('primary')) { ?>
              <button role="tab"><?php esc_html_e('Menu', 'affiliate-store'); ?></button>
            <?php } ?>
          </div>
          <div id="mySidenav" class="nav sidenav">
            <nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr_e('Top Menu', 'affiliate-store'); ?>">
              <ul class="mobile_nav">
                <?php wp_nav_menu(array(
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu',
                  'items_wrap' => '%3$s',
                  'fallback_cb' => 'wp_page_menu',
                )); ?>
              </ul>
              <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE', 'affiliate-store'); ?></a>
            </nav>
          </div>
        </div>
        <div class="col-xxl-1 col-xl-1 col-lg-2 col-md-3 col-6 align-self-center p-lg-0">
          <?php if(class_exists('woocommerce')){ ?>
            <div class=" position-relative">
              <button class="product-btn text-lg-start text-md-start text-center"><?php esc_html_e('Categories','affiliate-store'); ?><i class="fa-solid fa-angle-down"></i></button>
                <div class="product-categories">
                  <?php
                    $affiliate_store_args = array(
                      'orderby'    => 'title',
                      'order'      => 'ASC',
                      'hide_empty' => 0,
                      'parent'  => 0
                    );
                    $affiliate_store_product_categories = get_terms( 'product_cat', $affiliate_store_args );
                    $affiliate_store_count = count($affiliate_store_product_categories);
                    if ( $affiliate_store_count > 0 ){
                        foreach ( $affiliate_store_product_categories as $affiliate_store_product_category ) {
                          $affiliate_store_product_cat_id = $affiliate_store_product_category->term_id;
                          $affiliate_store_cat_link = get_category_link( $affiliate_store_product_cat_id );
                          if ($affiliate_store_product_category->category_parent == 0) { ?>
                        <li class="drp_dwn_menu"><a href="<?php echo esc_url(get_term_link( $affiliate_store_product_category ) ); ?>">
                        <?php
                      }
                      echo esc_html( $affiliate_store_product_category->name ); ?></a></li>
                  <?php } } ?>
                </div>
            </div>
          <?php }?>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-12 align-self-center">
          <?php if (class_exists('WooCommerce')): ?>
            <div class="search_box">
              <?php echo get_product_search_form(); ?>
            </div>
          <?php else: ?>
            <div class="search_box">
              <?php echo get_search_form(); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>