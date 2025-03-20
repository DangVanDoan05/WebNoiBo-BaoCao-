<?php
/*
 * @package Affiliate Store
 */

function affiliate_store_admin_enqueue_scripts() {
    wp_enqueue_style( 'affiliate-store-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'affiliate_store_admin_enqueue_scripts' );

add_action('after_switch_theme', 'affiliate_store_options');

function affiliate_store_options() {
    global $pagenow;
    if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        wp_redirect( admin_url( 'themes.php?page=affiliate-store-demo' ) );
        exit;
    }
}

function affiliate_store_theme_info_menu_link() {

    $affiliate_store_theme = wp_get_theme();
    add_theme_page(
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'affiliate-store' ), $affiliate_store_theme->get( 'Name' ), $affiliate_store_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'affiliate-store' ),'edit_theme_options','affiliate-store','affiliate_store_theme_info_page'
    );

    // Add "Theme Demo Import" page
    add_theme_page(
        esc_html__( 'Theme Demo Import', 'affiliate-store' ),
        esc_html__( 'Theme Demo Import', 'affiliate-store' ),
        'edit_theme_options',
        'affiliate-store-demo',
        'affiliate_store_demo_content_page'
    );

}
add_action( 'admin_menu', 'affiliate_store_theme_info_menu_link' );

function affiliate_store_theme_info_page() {

    $affiliate_store_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'affiliate-store' ), esc_html($affiliate_store_theme->get( 'Name' )), esc_html($affiliate_store_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'affiliate-store' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'affiliate-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'affiliate-store' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( AFFILIATE_STORE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'affiliate-store' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'affiliate-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'affiliate-store' ); ?></p>
                <a href="<?php echo esc_url( AFFILIATE_STORE_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'affiliate-store' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'affiliate-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'affiliate-store' ); ?></p>
                <a href="<?php echo esc_url( AFFILIATE_STORE_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'affiliate-store' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'affiliate-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'affiliate-store' ); ?></p>
                <a href="<?php echo esc_url( AFFILIATE_STORE_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'affiliate-store' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'affiliate-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'affiliate-store' ); ?></p>
                <a href="<?php echo esc_url( AFFILIATE_STORE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'affiliate-store' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'affiliate-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'affiliate-store' ); ?></p>
                <a href="<?php echo esc_url( AFFILIATE_STORE_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'affiliate-store' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php printf( esc_html__( 'Getting started with %s', 'affiliate-store' ),
        esc_html($affiliate_store_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'affiliate-store' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($affiliate_store_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $affiliate_store_theme->get_screenshot() ); ?>" alt=""/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'affiliate-store' ); ?></h4>
                    <p class="about">
                    <?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'affiliate-store' ),esc_html($affiliate_store_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'affiliate-store' ); ?></a>
                        <a class="get-premium" href="<?php echo esc_url( AFFILIATE_STORE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'affiliate-store' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'affiliate-store' ),
            esc_html($affiliate_store_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'affiliate-store' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( AFFILIATE_STORE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'affiliate-store' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'affiliate-store' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}

function affiliate_store_demo_content_page() {

    $affiliate_store_theme = wp_get_theme();
    ?>
    <div class="container">
       <div class="start-box">
          <div class="columns-wrapper m-0"> 
             <div class="column column-half clearfix">
               <div class="wrapper-info"> 
                  <img src="<?php echo esc_url( get_template_directory_uri().'/images/Logo.png' ); ?>" />
                  <h2><?php esc_html_e( 'Welcome to Affiliate Store', 'affiliate-store' ); ?></h2>
                  <span class="version"><?php esc_html_e( 'Version', 'affiliate-store' ); ?>: <?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></span>	
                  <p><?php esc_html_e( 'To begin, locate the run importer button and click on it to initiate the importation of all the demo content.', 'affiliate-store' ); ?></p>
                  <?php require get_parent_theme_file_path( '/inc/demo-content.php' ); ?>
               </div>
             </div>
             <div class="column column-half clearfix">
             <div class="get-screenshot">
               <img src="<?php echo esc_url( get_template_directory_uri().'/screenshot.png' ); ?>" />
             </div>   
             </div>
          </div>
       </div>
    </div>
<?php
}

?>
