<?php
/**********************/
// child style enqueue
/**********************/
function daraz_store_styles(){

    $themeVersion = wp_get_theme()->get('Version');

    // Enqueue our style.css with our own version

    wp_enqueue_style('daraz-store-styles', get_template_directory_uri() . '/style.css',array(), $themeVersion);

     wp_add_inline_style('daraz-store-styles', daraz_store_custom_styles());

}

add_action('wp_enqueue_scripts', 'daraz_store_styles', 100);

define('DARAZ_STORE_FOOTER_LAYOUT_TWO', get_theme_file_uri(). "/images/widget-footer-2.png");

add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style('daraz-store-admin-css', get_theme_file_uri('/admin.css'), [], '1.0.0');
});


/**********************/
//customize setting
/**********************/

function daraz_store_setting( $wp_customize ){

/******************/
// theme color
/******************/
 $wp_customize->add_setting('open_shop_theme_clr', array(
        'default'        => '#215728',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'open_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'open_shop_theme_clr', array(
        'label'      => __('Theme Color', 'daraz-store' ),
        'section'    => 'open-shop-gloabal-color',
        'settings'   => 'open_shop_theme_clr',
        'priority' => 1,
    ) ) 
 );    
/***********************************/  
// menu alignment
/***********************************/ 
$wp_customize->add_setting('open_shop_menu_alignment', array(
                'default'               => 'right',
                'sanitize_callback'     => 'open_shop_sanitize_select',
            ) );
$wp_customize->add_control( new Open_Shop_Customizer_Buttonset_Control( $wp_customize, 'open_shop_menu_alignment', array(
                'label'                 => esc_html__( 'Menu Alignment', 'daraz-store' ),
                'section'               => 'open-shop-main-header',
                'settings'              => 'open_shop_menu_alignment',
                'choices'               => array(
                    'left'              => esc_html__( 'Left', 'daraz-store' ),
                    'center'        => esc_html__( 'center', 'daraz-store' ),
                    'right'             => esc_html__( 'Right', 'daraz-store' ),
                ),
        ) ) );
// excerpt length
    $wp_customize->add_setting('open_shop_blog_expt_length', array(
            'default'           =>'15',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' =>'open_shop_sanitize_number',
        )
    );
    $wp_customize->add_control('open_shop_blog_expt_length', array(
            'type'        => 'number',
            'section'     => 'open-shop-section-blog-group',
            'label'       => __( 'Excerpt Length', 'daraz-store' ),
            'input_attrs' => array(
                'min'  => 0,
                'step' => 1,
                'max'  => 3000,
            ),
             'priority'   =>10,
        )
    );

/******************/
//Widegt footer
/******************/
if(class_exists('Open_Shop_WP_Customize_Control_Radio_Image')){
               $wp_customize->add_setting(
               'open_shop_bottom_footer_widget_layout', array(
               'default'           => 'ft-wgt-none',
               'sanitize_callback' => 'sanitize_text_field',
            )
        );
$wp_customize->add_control(
            new Open_Shop_WP_Customize_Control_Radio_Image(
                $wp_customize, 'open_shop_bottom_footer_widget_layout', array(
                    'label'    => esc_html__( 'Layout','daraz-store'),
                    'section'  => 'open-shop-widget-footer',
                    'choices'  => array(
                       'ft-wgt-none'   => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_NONE,
                        ),
                        'ft-wgt-one'   => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_1,
                        ),
                        'ft-wgt-two' => array(
                            'url' => DARAZ_STORE_FOOTER_LAYOUT_TWO,
                        ),
                        'ft-wgt-three' => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_3,
                        ),
                        'ft-wgt-four' => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_4,
                        ),
                        'ft-wgt-five' => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_5,
                        ),
                        'ft-wgt-six' => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_6,
                        ),
                        'ft-wgt-seven' => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_7,
                        ),
                        'ft-wgt-eight' => array(
                            'url' => OPEN_SHOP_FOOTER_WIDGET_LAYOUT_8,
                        ),
                    ),
                )
            )
        );
    } 

/******************************/
/* Widget Redirect
/****************************/
if (class_exists('Open_Shop_Widegt_Redirect')){ 
$wp_customize->add_setting(
            'open_shop_bottom_footer_widget_redirect', array(
            'sanitize_callback' => 'sanitize_text_field',
     )
);
$wp_customize->add_control(
            new Open_Shop_Widegt_Redirect(
                $wp_customize, 'open_shop_bottom_footer_widget_redirect', array(
                    'section'      => 'open-shop-widget-footer',
                    'button_text'  => esc_html__( 'Go To Widget', 'daraz-store' ),
                    'button_class' => 'focus-customizer-widget-redirect',  
                )
            )
        );
} 

}

add_action( 'customize_register', 'daraz_store_setting', 100 );

/***************************/
//custom style
/***************************/
function daraz_store_custom_styles(){
$open_shop_theme_clr = esc_html(get_theme_mod('open_shop_theme_clr','#215728'));
$open_shop_color_scheme = esc_html(get_theme_mod('open_shop_color_scheme','opn-light'));

$daraz_store_custom_style=""; 

$daraz_store_custom_style.="a:hover, .open-shop-menu li a:hover, .open-shop-menu .current-menu-item a,.woocommerce .thunk-woo-product-list .price,.thunk-product-hover .th-button.add_to_cart_button, .woocommerce ul.products .thunk-product-hover .add_to_cart_button, .woocommerce .thunk-product-hover a.th-butto, .woocommerce ul.products li.product .product_type_variable, .woocommerce ul.products li.product a.button.product_type_grouped,.thunk-compare .compare-button a:hover, .thunk-product-hover .th-button.add_to_cart_button:hover, .woocommerce ul.products .thunk-product-hover .add_to_cart_button :hover, .woocommerce .thunk-product-hover a.th-button:hover,.thunk-product .yith-wcwl-wishlistexistsbrowse.show:before, .thunk-product .yith-wcwl-wishlistaddedbrowse.show:before,.woocommerce ul.products li.product.thunk-woo-product-list .price,.summary .yith-wcwl-add-to-wishlist.show .add_to_wishlist::before, .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a::before, .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a::before,.woocommerce .entry-summary a.compare.button.added:before,.header-icon a:hover,.thunk-related-links .nav-links a:hover,.woocommerce .thunk-list-view ul.products li.product.thunk-woo-product-list .price,.woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button,article.thunk-post-article .thunk-readmore.button,.thunk-wishlist a:hover, .thunk-compare a:hover,.woocommerce .thunk-product-hover a.th-button,.woocommerce ul.cart_list li .woocommerce-Price-amount, .woocommerce ul.product_list_widget li .woocommerce-Price-amount,.open-shop-load-more button, 
.summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a::before,
 .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a::before,.thunk-hglt-icon,.thunk-product .yith-wcwl-wishlistexistsbrowse:before, .thunk-product .yith-wcwl-wishlistaddedbrowse:before,.woocommerce a.button.product_type_simple,.woosw-btn:hover:before,.woosw-added:before,.wooscp-btn:hover:before,.woocommerce #reviews #comments .star-rating span ,.woocommerce p.stars a,.woocommerce .woocommerce-product-rating .star-rating,.woocommerce .star-rating span::before, .woocommerce .entry-summary a.th-product-compare-btn.btn_type:before{color:{$open_shop_theme_clr};} header #thaps-search-button,header #thaps-search-button:hover,.nav-links .page-numbers.current, .nav-links .page-numbers:hover{background:{$open_shop_theme_clr};}";

 if($open_shop_color_scheme=='opn-dark'){
$daraz_store_custom_style.="body.open-shop-dark a:hover, body.open-shop-dark .open-shop-menu > li > a:hover, body.open-shop-dark .open-shop-menu li ul.sub-menu li a:hover,body.open-shop-dark .thunk-product-cat-list li a:hover,body.open-shop-dark .main-header a:hover, body.open-shop-dark #sidebar-primary .open-shop-widget-content a:hover,.open-shop-dark .thunk-woo-product-list .woocommerce-loop-product__title a:hover{color:{$open_shop_theme_clr}} body.open-shop-dark #searchform [type='submit']{background:{$open_shop_theme_clr};border-color:{$open_shop_theme_clr}}";
}

$daraz_store_custom_style.=".toggle-cat-wrap,#search-button,.thunk-icon .cart-icon, .single_add_to_cart_button.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce button.button, .woocommerce input.button,.thunk-woo-product-list .thunk-quickview a,.cat-list a:after,.tagcloud a:hover, .thunk-tags-wrapper a:hover,.btn-main-header,.woocommerce div.product form.cart .button, .thunk-icon .cart-icon .taiowc-cart-item{background:{$open_shop_theme_clr}}
  .open-cart p.buttons a:hover,
  .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.thunk-slide .owl-nav button.owl-prev:hover, .thunk-slide .owl-nav button.owl-next:hover, .open-shop-slide-post .owl-nav button.owl-prev:hover, .open-shop-slide-post .owl-nav button.owl-next:hover,.thunk-list-grid-switcher a.selected, .thunk-list-grid-switcher a:hover,.woocommerce .woocommerce-error .button:hover, .woocommerce .woocommerce-info .button:hover, .woocommerce .woocommerce-message .button:hover,#searchform [type='submit']:hover,article.thunk-post-article .thunk-readmore.button:hover,.open-shop-load-more button:hover,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{background-color:{$open_shop_theme_clr};} 
  .thunk-product-hover .th-button.add_to_cart_button, .woocommerce ul.products .thunk-product-hover .add_to_cart_button, .woocommerce .thunk-product-hover a.th-butto, .woocommerce ul.products li.product .product_type_variable, .woocommerce ul.products li.product a.button.product_type_grouped,.open-cart p.buttons a:hover,.thunk-slide .owl-nav button.owl-prev:hover, .thunk-slide .owl-nav button.owl-next:hover, .open-shop-slide-post .owl-nav button.owl-prev:hover, .open-shop-slide-post .owl-nav button.owl-next:hover,body .woocommerce-tabs .tabs li a::before,.thunk-list-grid-switcher a.selected, .thunk-list-grid-switcher a:hover,.woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button,#searchform [type='submit']:hover,article.thunk-post-article .thunk-readmore.button,.woocommerce .thunk-product-hover a.th-button,.open-shop-load-more button,.woocommerce a.button.product_type_simple{border-color:{$open_shop_theme_clr}} .loader {
    border-right: 4px solid {$open_shop_theme_clr};
    border-bottom: 4px solid {$open_shop_theme_clr};
    border-left: 4px solid {$open_shop_theme_clr};}";

    //ribbon  
 $daraz_store_custom_style.=".openshop-site section.thunk-ribbon-section .content-wrap:before {
    content:'';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:{$open_shop_theme_clr};}";

return $daraz_store_custom_style;
}

function daraz_store_customizer_script_registers(){
wp_enqueue_script( 'daraz_store_custom_customizer_script', get_theme_file_uri() . '/customizer/js/customizer.js', array("jquery"), '', true  ); 
}
add_action('customize_controls_enqueue_scripts', 'daraz_store_customizer_script_registers',100 );


// customizer style
function daraz_store_store_style(){ ?>
<style>
.customize-control-radio-image .ui-state-active img {
    border-color: #00b6ff!important;
    -webkit-box-shadow: 0 0 1px #3ec8ff!important;
    box-shadow: 0 0 5px #3ec8fe!important;
}
</style>
<?php }
add_action('customize_controls_print_styles','daraz_store_store_style',100 );

remove_action( 'open_shop_below_header', 'open_shop_below_header_markup' );

/**************************************/
//Main Header function
/**************************************/
if ( ! function_exists( 'open_shop_main_header_markup' ) ){ 
function open_shop_main_header_markup(){ 

$main_header_opt = get_theme_mod('open_shop_main_header_option','none');
$open_shop_menu_alignment = get_theme_mod('open_shop_menu_alignment','right');

$open_shop_menu_open = get_theme_mod('open_shop_mobile_menu_open','left');
?>
<div class="main-header mhdrdefault <?php echo esc_attr($main_header_opt);?> <?php echo esc_attr($open_shop_menu_alignment);?>">
            <div class="container">
                <div class="main-header-bar thnk-col-3">
                    <div class="main-header-col1">
          <span class="logo-content">
            <?php open_shop_logo();?> 
          </span>
     
        </div>
                    <div class="main-header-col2">
      
        <nav>
        <!-- Menu Toggle btn-->
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn">
                <div class="btn">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
               </div>
            </button>
        </div>
        <div class="sider main  open-shop-menu-hide <?php echo esc_attr($open_shop_menu_open);?>">
        <div class="sider-inner">
          <?php if(has_nav_menu('open-shop-main-menu' )){ 

             if (wp_is_mobile()!== false){
                   if(has_nav_menu('open-shop-above-menu' )){
                                open_shop_abv_nav_menu();
                       }
                  }  
                    open_shop_main_nav_menu();
              }else{
                 wp_page_menu(array( 
                 'items_wrap'  => '<ul class="open-shop-menu" data-menu-style="horizontal">%3$s</ul>',
                 'link_before' => '<span>',
                 'link_after'  => '</span>'));
             }?>
        </div>
        </div>
        </nav>
 
      </div> 
<?php if($main_header_opt!=='none'):?>
                    <div class="main-header-col3">
             <?php open_shop_main_header_optn();?>
          </div>
<?php endif; ?>
                </div> <!-- end main-header-bar -->
            </div>
        </div> 
<?php   }
}
add_action( 'open_shop_main_header', 'open_shop_main_header_markup' );

