<?php
/**
 * @package Affiliate Store
 */
?>

<?php
    $affiliate_store_post_date = esc_html(get_the_date());
    
    $affiliate_store_author_name = esc_html(get_the_author());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    
    <?php 
    $affiliate_store_designation = get_post_meta($post->ID, 'affiliate_store_designation', true);
    
    if ($affiliate_store_designation) : ?>
        <p class="serv-content"><?php echo esc_html($affiliate_store_designation); ?></p>
    <?php endif; ?>
    <div class="social-icon text-start">
        <?php
        $affiliate_store_facebook_link = get_post_meta($post->ID, 'affiliate_store_facebook_link', true);
        $affiliate_store_twitter_link = get_post_meta($post->ID, 'affiliate_store_twitter_link', true);
        $affiliate_store_telegram_link = get_post_meta($post->ID, 'affiliate_store_telegram_link', true);

        if ($affiliate_store_facebook_link || $affiliate_store_twitter_link || $affiliate_store_telegram_link) :
        ?>
            <div class="meta-fields text-start">
                <?php if ($affiliate_store_facebook_link) : ?>
                    <a href="<?php echo esc_url($affiliate_store_facebook_link); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                <?php endif; ?>

                <?php if ($affiliate_store_twitter_link) : ?>
                    <a href="<?php echo esc_url($affiliate_store_twitter_link); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                <?php endif; ?>

                <?php if ($affiliate_store_telegram_link) : ?>
                    <a href="<?php echo esc_url($affiliate_store_telegram_link); ?>" target="_blank"><i class="fab fa-telegram"></i></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if (has_post_thumbnail() ){ ?>
        <div class="post-thumb">
           <?php the_post_thumbnail(); ?>
        </div>
    <?php } ?>

    <?php if ('post' == get_post_type()) : ?>
        <div class="postmeta">
            <div class="post-date">
                <i class="fas fa-calendar-alt"></i> &nbsp;<?php echo esc_html($affiliate_store_post_date); ?>
            </div>
            <div class="post-comment">&nbsp; &nbsp;
                <i class="fa fa-comment"></i> &nbsp; <?php comments_number(); ?>
            </div>
            <div class="post-author">&nbsp; &nbsp;
                <i class="fas fa-user"></i> &nbsp; <?php echo esc_html($affiliate_store_author_name); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'affiliate-store' ),
                'after'  => '</div>',
            ) );
        ?>
        <div class="tags"><?php the_tags(); ?></div>
    </div>
    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'affiliate-store' ), '<span class="edit-link">', '</span>' ); ?>
    </footer>
</article>