<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Affiliate Store
 */
?>
<div id="footer">
  <?php 
    $affiliate_store_footer_widget_enabled = get_theme_mod('affiliate_store_footer_widget', true);
    
    if ($affiliate_store_footer_widget_enabled !== false && $affiliate_store_footer_widget_enabled !== '') { ?>

    <?php 
        $affiliate_store_widget_areas = get_theme_mod('affiliate_store_footer_widget_areas', '4');
        if ($affiliate_store_widget_areas == '3') {
            $affiliate_store_cols = 'col-lg-4 col-md-6';
        } elseif ($affiliate_store_widget_areas == '4') {
            $affiliate_store_cols = 'col-lg-3 col-md-6';
        } elseif ($affiliate_store_widget_areas == '2') {
            $affiliate_store_cols = 'col-lg-6 col-md-6';
        } else {
            $affiliate_store_cols = 'col-lg-12 col-md-12';
        }
    ?>

    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($affiliate_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'affiliate-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'affiliate-store'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($affiliate_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'affiliate-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'affiliate-store'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($affiliate_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'affiliate-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'affiliate-store'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($affiliate_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'affiliate-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'affiliate-store'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

    <?php } ?>
    <div class="clear"></div>
  <div class="copywrap text-center">
    <div class="container">
      <p>
        <a href="<?php 
          $affiliate_store_copyright_link = get_theme_mod('affiliate_store_copyright_link', '');
          if (empty($affiliate_store_copyright_link)) {
              echo esc_url('https://www.theclassictemplates.com/products/free-affiliate-store-wordpress-theme');
          } else {
              echo esc_url($affiliate_store_copyright_link);
          } ?>" target="_blank">
          <?php echo esc_html(get_theme_mod('affiliate_store_copyright_line', __('Affiliate Store WordPress Theme', 'affiliate-store'))); ?>
        </a> 
        <?php echo esc_html('By Classic Templates', 'affiliate-store'); ?>
      </p>
    </div>
  </div>
</div>

<?php if(get_theme_mod('affiliate_store_scroll_hide',true)){ ?>
 <a id="button"><?php esc_html_e('TOP', 'affiliate-store'); ?></a>
<?php } ?>
  
<?php wp_footer(); ?>
</body>
</html>
