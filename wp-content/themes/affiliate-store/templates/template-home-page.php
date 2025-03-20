<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Affiliate Store
 */

get_header(); ?>

<div id="content" >
    <?php
        $affiliate_store_hidepageboxes = get_theme_mod('affiliate_store_slider', true);
        $affiliate_store_catData = get_theme_mod('affiliate_store_slider_cat');
        if ($affiliate_store_hidepageboxes && $affiliate_store_catData) { ?>
        <section id="main-slider" class="py-2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                        <div class="slider-cat position-relative">
                            <div class="owl-carousel m-0">
                                <?php
                                    $affiliate_store_page_query = new WP_Query(
                                        array(
                                            'category_name' => esc_attr($affiliate_store_catData),
                                            'posts_per_page' => -1,
                                        )
                                    );
                                    while ($affiliate_store_page_query->have_posts()) : $affiliate_store_page_query->the_post(); ?>
                                        <div class="imagebox">
                                            <?php if(has_post_thumbnail()){
                                                the_post_thumbnail('full', array('class' => 'post-image'));
                                            } else { ?>
                                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slider.png" alt="" class="post-image"/>
                                            <?php } ?>
                                            <div class="slider-overlay"></div>
                                            <div class="text-content position-absolute px-5">
                                                <?php if(get_theme_mod('affiliate_store_slider_subhead') != ''){ ?>
                                                    <p class="slider-subhead mb-2 text-capitalize"><?php echo esc_html(get_theme_mod ('affiliate_store_slider_subhead','affiliate-store')); ?></p>
                                                <?php } ?>
                                                <h1 class="text-capitalize"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                                <?php
                                                    $affiliate_store_trimexcerpt  = get_the_excerpt();
                                                    $affiliate_store_shortexcerpt = wp_trim_words($affiliate_store_trimexcerpt, $affiliate_store_num_words = 20);
                                                    echo '<p class="slider-content my-3">' . esc_html($affiliate_store_shortexcerpt) . '</p>';
                                                ?>
                                            </div>
                                        </div>
                                    <?php endwhile;
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-12 d-flex flex-column gap-3 ps-lg-0">
                        <?php for ($affiliate_store_i = 1; $affiliate_store_i <= 2; $affiliate_store_i++) { ?>
                            <div class="offer-sec">
                                <?php if (empty(get_theme_mod('affiliate_store_offer_bg_image'.$affiliate_store_i))) { ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/offer-img.png" alt=""/>
                                <?php } else { ?>
                                    <img src="<?php echo esc_url(get_theme_mod('affiliate_store_offer_bg_image'.$affiliate_store_i)); ?>" alt="" />
                                <?php } ?>
                                <div class="offer-overlay"></div>
                                <div class="offer-content px-4">
                                    <?php if(get_theme_mod('affiliate_store_offer_subhead'.$affiliate_store_i) != ''){ ?>
                                        <p class="offer-subhead mb-2 text-capitalize"><?php echo esc_html(get_theme_mod ('affiliate_store_offer_subhead'.$affiliate_store_i,'affiliate-store')); ?></p>
                                    <?php } ?>
                                    <?php if(get_theme_mod('affiliate_store_offer_title'.$affiliate_store_i) != ''){ ?>
                                        <h4 class="offer-title mb-4 text-capitalize"><?php echo esc_html(get_theme_mod ('affiliate_store_offer_title'.$affiliate_store_i,'affiliate-store')); ?></h4>
                                    <?php } ?>
                                    <?php if ( get_theme_mod('affiliate_store_offer_btn_text'.$affiliate_store_i, '') != '') { ?> 
                                        <div class="offer-btn">
                                            <a href="<?php echo esc_url(get_theme_mod ('affiliate_store_offer_btn_link'.$affiliate_store_i,'')); ?>" class="text-capitalize"><?php echo esc_html(get_theme_mod ('affiliate_store_offer_btn_text'.$affiliate_store_i,'','affiliate-store')); ?></a>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-cat py-4">
                    <?php if(get_theme_mod('affiliate_store_category_title') != ''){ ?>
                        <h2 class="category-head mb-3 text-capitalize text-center"><?php echo esc_html(get_theme_mod ('affiliate_store_category_title','affiliate-store')); ?></h2>
                    <?php } ?>
                    <div class="owl-carousel">
                        <?php
                        $affiliate_store_args = array(
                            'taxonomy'   => 'product_cat',
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => 0,
                            'parent'     => 0
                        );
                        $affiliate_store_product_categories = get_terms($affiliate_store_args);

                        if (!empty($affiliate_store_product_categories)) {
                            foreach ($affiliate_store_product_categories as $affiliate_store_product_category) {
                                $affiliate_store_category_id = $affiliate_store_product_category->term_id;
                                $affiliate_store_category_link = get_category_link($affiliate_store_category_id);
                                $affiliate_store_thumbnail_id = get_term_meta($affiliate_store_category_id, 'thumbnail_id', true);
                                ?>
                                <div class="cat-box p-4">
                                    <?php
                                    if ($affiliate_store_thumbnail_id) {
                                        $affiliate_store_image_url = wp_get_attachment_image_url($affiliate_store_thumbnail_id, 'medium');
                                        echo '<img class="thumb_img" src="' . esc_url($affiliate_store_image_url) . '" alt="' . esc_attr($affiliate_store_product_category->name) . '" />';
                                    } else { ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/dummy-post.png" alt="" class="post-image"/>
                                    <?php } ?>
                                    <div class="articles pt-3 text-center">
                                        <a href="<?php echo esc_url(get_term_link($affiliate_store_product_category)); ?>">
                                            <?php echo esc_html($affiliate_store_product_category->name); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <!-- Trending Products Section -->
    <?php
        $affiliate_store_hide_trending_section = get_theme_mod('affiliate_store_disabled_trending_section', true);
        $affiliate_store_post_cat = get_theme_mod('affiliate_store_posts'); 
        if ($affiliate_store_hide_trending_section){ ?>
        <section id="trending-section" class="py-5">
            <div class="container">
                <div class="blog-bx mb-4">
                    <?php if (get_theme_mod('affiliate_store_trending_title') != "") { ?>
                        <h3 class="trending-title mb-1 text-capitalize text-start"><?php echo esc_html(get_theme_mod('affiliate_store_trending_title', 'affiliate-store')); ?></h3>
                    <?php } ?>
                </div> 
                <div class="owl-carousel">
                    <?php if(class_exists('woocommerce')){
                        $affiliate_store_args = array(
                            'post_type' => 'product',
                            'product_cat' => get_theme_mod('affiliate_store_hot_products_cat'),
                            'order' => 'ASC'
                        );
                        $affiliate_store_loop = new WP_Query($affiliate_store_args);
                        
                        while ($affiliate_store_loop->have_posts()) : $affiliate_store_loop->the_post(); global $product;
                            $affiliate_store_product_categories = wp_get_post_terms($product->get_id(), 'product_cat');
                            if (!empty($affiliate_store_product_categories) && !is_wp_error($affiliate_store_product_categories)) {
                                $affiliate_store_product_category = $affiliate_store_product_categories[0];
                            }
                            ?>
                            <div class="product-image pt-4 px-4 pb-2">
                                <?php
                                if (has_post_thumbnail($affiliate_store_loop->post->ID)) {
                                    echo get_the_post_thumbnail($affiliate_store_loop->post->ID, 'shop_catalog');
                                } else {
                                    echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="" />';
                                }
                                ?>
                                <div class="box-content text-left mt-3">
                                    <?php if (isset($affiliate_store_product_category)) { ?>
                                        <a href="<?php echo esc_url(get_term_link($affiliate_store_product_category)); ?>" class="product-category">
                                            <?php echo esc_html($affiliate_store_product_category->name); ?>
                                        </a>
                                    <?php } ?>
                                    <h4 class="product-text my-1 text-capitalize">
                                        <a href="<?php echo esc_url(get_permalink($affiliate_store_loop->post->ID)); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <div class="price mb-2"><?php echo $product->get_price_html(); ?></div>
                                </div>
                            </div>
                        <?php endwhile; 
                        wp_reset_postdata();
                    }?>
                </div>
            </div>
        </section>
    <?php } ?>
</div>
<?php get_footer(); ?>
