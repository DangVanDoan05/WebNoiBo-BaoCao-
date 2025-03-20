<?php

$affiliate_store_first_color = get_theme_mod('affiliate_store_first_color');
$affiliate_store_color_scheme_css = '';

/*------------------ Global First Color -----------*/
$affiliate_store_color_scheme_css .='.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current, .top-image-sec .product-cart .cart-count, .top-image-sec .social-icons i:hover, .top-image-sec .woo-icons i:hover, .top-image-sec .image-content .sale-tag, .menu-sec, .page-template-template-home-page li.main-nav .current_page_item, .slider-cat .owl-dots .owl-dot.active, .offer-sec .offer-btn a, .product-cat .owl-nav button i, #trending-section .owl-nav button i, .postsec-list .search-form input.search-submit, #sidebar form .wp-block-search__button, .nav-links .page-numbers, span.page-numbers.current, .nav-links .page-numbers:hover, input.search-submit, .page-links a, .page-links span, .tagcloud a:hover, .copywrap{';
$affiliate_store_color_scheme_css .='background-color: '.esc_attr($affiliate_store_first_color).'';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.breadcrumb a, .wp-block-button .wp-block-button__link, #commentform input#submit, nav.woocommerce-MyAccount-navigation ul li, span.onsale, .wp-block-woocommerce-empty-cart-block .wc-block-grid__product-onsale, .wc-block-cart__submit .wc-block-cart__submit-container a, .wc-block-components-totals-coupon__button.contained, button.wc-block-components-checkout-place-order-button, .woocommerce ul.products li.product .button, .woocommerce a.button, .woocommerce ul.products li.product .added_to_cart, .woocommerce button.button.alt, .woocommerce button.button{';
$affiliate_store_color_scheme_css .='background-color: '.esc_attr($affiliate_store_first_color).'!important';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.postsec-list .wp-block-button__link, .site-main .wp-block-button__link, .tags a, .serach_inner, #button, .product-categories li:hover, #sidebar input.search-submit, #footer input.search-submit, form.woocommerce-product-search button, .widget_calendar caption, .widget_calendar #today, #footer input.search-submit {';
$affiliate_store_color_scheme_css .='background: '.esc_attr($affiliate_store_first_color).'';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.breadcrumb .current-breadcrumb, a.add_to_wishlist.single_add_to_wishlist{';
$affiliate_store_color_scheme_css .='background: '.esc_attr($affiliate_store_first_color).'!important';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.page-template-template-home-page .search-box i:hover, .page-template-template-home-page h1.site-title a:hover, .main-nav ul.sub-menu li a:hover, #trending-section .product-image:hover .product-text a, .listarticle h2 a:hover, #sidebar ul li::before, #sidebar .widget a:hover,
#sidebar .widget a:active, .widget .tagcloud a:hover, #footer a:hover, #footer h6, #sidebar .widget-title, .ftr-4-box h5{';
$affiliate_store_color_scheme_css .='color: '.esc_attr($affiliate_store_first_color).'';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.postmeta a:hover, .woocommerce ul.products li.product .price, .woocommerce div.product p.price{';
$affiliate_store_color_scheme_css .='color: '.esc_attr($affiliate_store_first_color).'!important';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.site-main .wp-block-button.is-style-outline a, .postsec-list .wp-block-button.is-style-outline a, .widget .tagcloud a:hover, span.onsale, .wp-block-woocommerce-empty-cart-block .wc-block-grid__product-onsale{';
$affiliate_store_color_scheme_css .='border: 1px solid'.esc_attr($affiliate_store_first_color).'!important';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.main-nav ul.sub-menu li a:focus, .main-nav ul ul a:focus, .serach_inner input[type="submit"]:focus, .postsec-list .search-form input.search-submit, #sidebar form .wp-block-search__button, #sidebar input[type="text"], #sidebar input[type="search"], #footer input[type="search"]{';
$affiliate_store_color_scheme_css .='border: 2px solid '.esc_attr($affiliate_store_first_color).'';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.main-nav li ul{';
$affiliate_store_color_scheme_css .='border-top: 3px solid'.esc_attr($affiliate_store_first_color).'';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='#sidebar .widget{';
$affiliate_store_color_scheme_css .='border-bottom: 3px solid'.esc_attr($affiliate_store_first_color).'';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.tagcloud a:hover, .wp-block-quote:not(.is-large):not(.is-style-large){';
$affiliate_store_color_scheme_css .='border-color: '.esc_attr($affiliate_store_first_color).'!important';
$affiliate_store_color_scheme_css .='}';

$affiliate_store_color_scheme_css .='.wp-block-quote:not(.is-large):not(.is-style-large), blockquote{';
$affiliate_store_color_scheme_css .='border-left: 5px solid'.esc_attr($affiliate_store_first_color).'';
$affiliate_store_color_scheme_css .='}'; 

$affiliate_store_color_scheme_css .= '
@media screen and (max-width: 1000px) {
  .page-template-template-home-page .main-nav .current_page_item a {
    color: ' . esc_attr($affiliate_store_first_color) . ' !important;
  }
}

@media screen and (min-width: 768px) and (max-width: 991px) {
 .page-template-template-home-page .header .toggle-nav button{
    background: ' . esc_attr($affiliate_store_first_color) . ' !important;
  }
}    

@media screen and (max-width: 767px) {
  .page-template-template-home-page .product-cart .cart-count {
    background-color: ' . esc_attr($affiliate_store_first_color) . ' !important;
  }
}';

//---------------------------------Logo-Max-height--------- 
  $affiliate_store_logo_width = get_theme_mod('affiliate_store_logo_width');

  if($affiliate_store_logo_width != false){

    $affiliate_store_color_scheme_css .='.logo .custom-logo-link img{';

      $affiliate_store_color_scheme_css .='width: '.esc_html($affiliate_store_logo_width).'px;';

    $affiliate_store_color_scheme_css .='}';
  }

  // by default header
  $affiliate_store_slider = get_theme_mod('affiliate_store_slider', 'true');

  if($affiliate_store_slider != true){

  $affiliate_store_color_scheme_css .='.page-template-template-home-page .mainhead{';

    $affiliate_store_color_scheme_css .='position: static;';

  $affiliate_store_color_scheme_css .='}';

  }

  $affiliate_store_slider_nav_img = get_theme_mod('affiliate_store_slider_nav_img');
  if($affiliate_store_slider_nav_img != false){
    $affiliate_store_color_scheme_css .='#slider-cat .owl-nav .owl-next:after{';
      $affiliate_store_color_scheme_css .='background: url('.esc_attr($affiliate_store_slider_nav_img).'); background-size: cover;';
    $affiliate_store_color_scheme_css .='}';
  }


/*--------------------------- Scroll to top positions -------------------*/

$affiliate_store_scroll_position = get_theme_mod( 'affiliate_store_scroll_position','Right');
if($affiliate_store_scroll_position == 'Right'){
    $affiliate_store_color_scheme_css .='#button{';
        $affiliate_store_color_scheme_css .='right: 20px;';
    $affiliate_store_color_scheme_css .='}';
}else if($affiliate_store_scroll_position == 'Left'){
    $affiliate_store_color_scheme_css .='#button{';
        $affiliate_store_color_scheme_css .='left: 20px;';
    $affiliate_store_color_scheme_css .='}';
}else if($affiliate_store_scroll_position == 'Center'){
    $affiliate_store_color_scheme_css .='#button{';
        $affiliate_store_color_scheme_css .='right: 50%;left: 50%;';
    $affiliate_store_color_scheme_css .='}';
}

/*--------------------------- Footer background image -------------------*/

$affiliate_store_footer_bg_image = get_theme_mod('affiliate_store_footer_bg_image');
if($affiliate_store_footer_bg_image != false){
    $affiliate_store_color_scheme_css .='#footer{';
        $affiliate_store_color_scheme_css .='background: url('.esc_attr($affiliate_store_footer_bg_image).')!important;';
        $affiliate_store_color_scheme_css .= 'background-size: cover!important;';  
    $affiliate_store_color_scheme_css .='}';
}

/*--------------------------- Blog Post Page Image Box Shadow -------------------*/

$affiliate_store_blog_post_page_image_box_shadow = get_theme_mod('affiliate_store_blog_post_page_image_box_shadow',0);
if($affiliate_store_blog_post_page_image_box_shadow != false){
    $affiliate_store_color_scheme_css .='.post-thumb img{';
        $affiliate_store_color_scheme_css .='box-shadow: '.esc_attr($affiliate_store_blog_post_page_image_box_shadow).'px '.esc_attr($affiliate_store_blog_post_page_image_box_shadow).'px '.esc_attr($affiliate_store_blog_post_page_image_box_shadow).'px #cccccc;';
    $affiliate_store_color_scheme_css .='}';
}  

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$affiliate_store_woo_product_img_border_radius = get_theme_mod('affiliate_store_woo_product_img_border_radius');
  if($affiliate_store_woo_product_img_border_radius != false){
    $affiliate_store_color_scheme_css .='.woocommerce ul.products li.product a img{';
    $affiliate_store_color_scheme_css .='border-radius: '.esc_attr($affiliate_store_woo_product_img_border_radius).'px;';
    $affiliate_store_color_scheme_css .='}';
}  

/*--------------------------- Woocommerce Product Sale Position -------------------*/    

$affiliate_store_product_sale_position = get_theme_mod( 'affiliate_store_product_sale_position','Left');
if($affiliate_store_product_sale_position == 'Right'){
    $affiliate_store_color_scheme_css .='.woocommerce ul.products li.product .onsale{';
        $affiliate_store_color_scheme_css .='left:auto !important; right:.5em !important;';
    $affiliate_store_color_scheme_css .='}';
}else if($affiliate_store_product_sale_position == 'Left'){
    $affiliate_store_color_scheme_css .='.woocommerce ul.products li.product .onsale {';
        $affiliate_store_color_scheme_css .='right:auto !important; left:.5em !important;';
    $affiliate_store_color_scheme_css .='}';
}        

/*--------------------------- Shop page pagination -------------------*/

$affiliate_store_wooproducts_nav = get_theme_mod('affiliate_store_wooproducts_nav', 'Yes');
if($affiliate_store_wooproducts_nav == 'No'){
  $affiliate_store_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
    $affiliate_store_color_scheme_css .='display: none;';
  $affiliate_store_color_scheme_css .='}';
}

/*--------------------------- Related Product -------------------*/

$affiliate_store_related_product_enable = get_theme_mod('affiliate_store_related_product_enable',true);
if($affiliate_store_related_product_enable == false){
  $affiliate_store_color_scheme_css .='.related.products{';
    $affiliate_store_color_scheme_css .='display: none;';
  $affiliate_store_color_scheme_css .='}';
}

/*--------------------------- Preloader Background Image ------------*/

$affiliate_store_preloader_bg_image = get_theme_mod('affiliate_store_preloader_bg_image');
if($affiliate_store_preloader_bg_image != false){
  $affiliate_store_color_scheme_css .='#preloader{';
    $affiliate_store_color_scheme_css .='background: url('.esc_attr($affiliate_store_preloader_bg_image).'); background-size: cover;';
  $affiliate_store_color_scheme_css .='}';
}
