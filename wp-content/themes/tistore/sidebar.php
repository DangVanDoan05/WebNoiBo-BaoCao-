<aside id="primary" class="sidebar-widget-area">
    <?php if (!is_active_sidebar('wpdevart_tistore_blog_sidebar')) { ?>
        <section id="search" class="widget widget_search">
            <h3 class="widget-title sidebar-widget-area-default-title"><?php esc_html_e('Search', 'tistore'); ?></h3>
            <?php get_search_form(); ?>
        </section>
        <section id="tags" class="widget widget_tag_cloud">
            <h3 class="widget-title sidebar-widget-area-default-title"><?php esc_html_e('Tag Cloud', 'tistore'); ?></h3>
            <?php wp_tag_cloud(); ?>
        </section>
        <section id="login" class="widget widget_meta">
            <h3 class="widget-title sidebar-widget-area-default-title"><?php esc_html_e('Login', 'tistore'); ?></h3>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
        </section>
        <section id="archives" class="widget widget_archive">
            <h3 class="widget-title sidebar-widget-area-default-title"><?php esc_html_e('Archives', 'tistore'); ?></h3>
                <?php wp_get_archives(); ?>
        </section>
    <?php } else { dynamic_sidebar( 'wpdevart_tistore_blog_sidebar' ); } ?>
</aside>