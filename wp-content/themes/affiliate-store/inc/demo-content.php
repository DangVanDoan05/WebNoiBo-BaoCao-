<div class="theme-offer">
   <?php
     // POST and update the customizer and other related data of Affiliate Store
    if ( isset( $_POST['submit'] ) ) {

        // Check if woocommerce is installed and activated
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
        // Install the plugin if it doesn't exist
        $affiliate_store_plugin_slug = 'woocommerce';
        $affiliate_store_plugin_file = 'woocommerce/woocommerce.php';

        // Check if plugin is installed
        $affiliate_store_installed_plugins = get_plugins();
        if (!isset($affiliate_store_installed_plugins[$affiliate_store_plugin_file])) {
            include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
            include_once(ABSPATH . 'wp-admin/includes/file.php');
            include_once(ABSPATH . 'wp-admin/includes/misc.php');
            include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

            // Install the plugin
            $affiliate_store_upgrader = new Plugin_Upgrader();
            $affiliate_store_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
        }
        // Activate the plugin
        activate_plugin($affiliate_store_plugin_file);
        }

        // Check if  GTranslate is installed and activated
        if (!is_plugin_active('gtranslate/gtranslate.php')) {
        // Install the plugin if it doesn't exist
        $affiliate_store_plugin_slug = 'gtranslate';
        $affiliate_store_plugin_file = 'gtranslate/gtranslate.php';

        // Check if plugin is installed
        $affiliate_store_installed_plugins = get_plugins();
        if (!isset($affiliate_store_installed_plugins[$affiliate_store_plugin_file])) {
            include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
            include_once(ABSPATH . 'wp-admin/includes/file.php');
            include_once(ABSPATH . 'wp-admin/includes/misc.php');
            include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

            // Install the plugin
            $affiliate_store_upgrader = new Plugin_Upgrader();
            $affiliate_store_upgrader->install('https://downloads.wordpress.org/plugin/gtranslate.latest-stable.zip');
        }
        // Activate the plugin
        activate_plugin($affiliate_store_plugin_file);
        }

        //Check if  YITH WooCommerce Wishlist is installed and activated
        if (!is_plugin_active('yith-woocommerce-wishlist/yith-woocommerce-wishlist.php')) {       
            // Install the plugin if it doesn't exist
            $affiliate_store_plugin_slug = 'yith-woocommerce-wishlist';
            $affiliate_store_plugin_file = 'yith-woocommerce-wishlist/yith-woocommerce-wishlist.php';

            // Check if plugin is installed
            $affiliate_store_installed_plugins = get_plugins();
            if (!isset($affiliate_store_installed_plugins[$affiliate_store_plugin_file])) {
            include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
            include_once(ABSPATH . 'wp-admin/includes/file.php');
            include_once(ABSPATH . 'wp-admin/includes/misc.php');
            include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

            // Install the plugin
            $affiliate_store_upgrader = new Plugin_Upgrader();
            $affiliate_store_upgrader->install('https://downloads.wordpress.org/plugin/yith-woocommerce-wishlist.latest-stable.zip');
            }

            // Activate the plugin
            activate_plugin($affiliate_store_plugin_file);
        }

        // ------- Create Main Menu --------
        $affiliate_store_menuname = 'Primary Menu';
        $affiliate_store_bpmenulocation = 'primary';
        $affiliate_store_menu_exists = wp_get_nav_menu_object( $affiliate_store_menuname );
    
        if ( !$affiliate_store_menu_exists ) {
            $affiliate_store_menu_id = wp_create_nav_menu( $affiliate_store_menuname );

            // Create Home Page
            $affiliate_store_home_title = 'Home';
            $affiliate_store_home = array(
                'post_type'    => 'page',
                'post_title'   => $affiliate_store_home_title,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'home'
            );
            $affiliate_store_home_id = wp_insert_post($affiliate_store_home);
            // Assign Home Page Template
            add_post_meta($affiliate_store_home_id, '_wp_page_template', 'templates/template-home-page.php');
            // Update options to set Home Page as the front page
            update_option('page_on_front', $affiliate_store_home_id);
            update_option('show_on_front', 'page');
            // Add Home Page to Menu
            wp_update_nav_menu_item($affiliate_store_menu_id, 0, array(
                'menu-item-title' => __('Home', 'affiliate-store'),
                'menu-item-classes' => 'home',
                'menu-item-url' => home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $affiliate_store_home_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create a new Page 
            $affiliate_store_pages_title = 'Pages';
            $affiliate_store_pages_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
            $affiliate_store_pages = array(
                'post_type'    => 'page',
                'post_title'   => $affiliate_store_pages_title,
                'post_content' => $affiliate_store_pages_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'pages'
            );
            $affiliate_store_pages_id = wp_insert_post($affiliate_store_pages);
            // Add Pages Page to Menu
            wp_update_nav_menu_item($affiliate_store_menu_id, 0, array(
                'menu-item-title' => __('Pages', 'affiliate-store'),
                'menu-item-classes' => 'pages',
                'menu-item-url' => home_url('/pages/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $affiliate_store_pages_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create About Us Page with Dummy Content
            $affiliate_store_about_title = 'About Us';
            $affiliate_store_about_content = '<P>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</P>';
            $affiliate_store_about = array(
                'post_type'    => 'page',
                'post_title'   => $affiliate_store_about_title,
                'post_content' => $affiliate_store_about_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'about-us'
            );
            $affiliate_store_about_id = wp_insert_post($affiliate_store_about);
            // Add About Us Page to Menu
            wp_update_nav_menu_item($affiliate_store_menu_id, 0, array(
                'menu-item-title' => __('About Us', 'affiliate-store'),
                'menu-item-classes' => 'about-us',
                'menu-item-url' => home_url('/about-us/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $affiliate_store_about_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Assign the menu to the primary location if not already set
            if ( ! has_nav_menu( $affiliate_store_bpmenulocation ) ) {
                $affiliate_store_locations = get_theme_mod( 'nav_menu_locations' );
                if ( empty( $affiliate_store_locations ) ) {
                    $affiliate_store_locations = array();
                }
                $affiliate_store_locations[ $affiliate_store_bpmenulocation ] = $affiliate_store_menu_id;
                set_theme_mod( 'nav_menu_locations', $affiliate_store_locations );
            }
        }

        // Header Section
        set_theme_mod( 'affiliate_store_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));

        //Topbar Section
        set_theme_mod( 'affiliate_store_topbar_text', 'Lorem Ipsum is simply dummy text of the printing' );
        set_theme_mod( 'affiliate_store_topbar_track_text', 'Tracking Order' );
        set_theme_mod( 'affiliate_store_middle_header_img', esc_url( get_template_directory_uri().'/images/header.png'));
        set_theme_mod( 'affiliate_store_header_img_title', 'New Watch Collection' );
        set_theme_mod( 'affiliate_store_header_img_title_text', 'Limited Offer 25% OFF' );
        set_theme_mod( 'affiliate_store_sale_title', 'BIG' );
        set_theme_mod( 'affiliate_store_sale_text', 'SALE' );
        set_theme_mod( 'affiliate_store_facebook_link', '#' );
        set_theme_mod( 'affiliate_store_twitter_link', '#' );
        set_theme_mod( 'affiliate_store_instagram_link', '#' );
        set_theme_mod( 'affiliate_store_youtube_link', '#' );

        //Slider Section
        set_theme_mod( 'affiliate_store_slider_subhead', 'Best Deals' );
        set_theme_mod( 'affiliate_store_category_title', 'Top Categories' );
        set_theme_mod( 'affiliate_store_middle_header_img', esc_url( get_template_directory_uri().'/images/header.png'));

        // Create the 'Affiliate' category and retrieve its ID
        $affiliate_store_slider_category_id = wp_create_category('Affiliate');

        // Set the slider category in theme mods
        set_theme_mod('affiliate_store_slider_cat', 'Affiliate');
        
        // Array of related titles
        $affiliate_store_titles = array(     
            'Enjoy Every Single Beat On Headphone',
            'Hear the harmony, live the moment',
            'Feel the pulse of every sound'
        );

        // Create three posts and assign them to the 'Affiliate' category
        for ($affiliate_store_i = 1; $affiliate_store_i <= 3; $affiliate_store_i++) {
            $affiliate_store_title = $affiliate_store_titles[$affiliate_store_i - 1];
            $affiliate_store_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.';
            
            // Create the post object
            $affiliate_store_my_post = array(
                'post_title'    => wp_strip_all_tags($affiliate_store_title),
                'post_content'  => $affiliate_store_content,
                'post_status'   => 'publish',
                'post_type'     => 'post',
                'post_category' => array($affiliate_store_slider_category_id),  
            );

            // Insert the post into the database
            $affiliate_store_post_id = wp_insert_post($affiliate_store_my_post);

            // If the post was successfully created
            if ($affiliate_store_post_id) {
                // Set the theme mod for the slider page
                set_theme_mod('affiliate_store_slider_cat' . $affiliate_store_i, $affiliate_store_post_id);
  
                 $affiliate_store_image_url = get_template_directory_uri().'/images/slider'.$affiliate_store_i.'.png';
  
               $affiliate_store_image_id = media_sideload_image($affiliate_store_image_url, $affiliate_store_post_id, null, 'id');
  
                   if (!is_wp_error($affiliate_store_image_id)) {
                       // Set the downloaded image as the post's featured image
                       set_post_thumbnail($affiliate_store_post_id, $affiliate_store_image_id);
                   }
            }
        }

        // Add Offer Section to Demo Import
        for ($affiliate_store_i = 1; $affiliate_store_i <= 2; $affiliate_store_i++) {
            
            // Set different subheads, titles, and button texts for each offer
            if ($affiliate_store_i == 1) {
                $affiliate_store_offer_subhead = 'Best Offer';
                $affiliate_store_offer_title = 'Brand New Version iPhone 18Pro';
                $affiliate_store_offer_image_name = 'offer_headphones.png'; // Image for first offer
            } elseif ($affiliate_store_i == 2) {
                $affiliate_store_offer_subhead = '15% Off';
                $affiliate_store_offer_title = 'Home Decoration Furniture';
                $affiliate_store_offer_image_name = 'offer_smartwatch.png'; // Image for second offer
            }
            
            // Set default values for subhead, title, button text, and button link
            set_theme_mod('affiliate_store_offer_subhead' . $affiliate_store_i, $affiliate_store_offer_subhead);
            set_theme_mod('affiliate_store_offer_title' . $affiliate_store_i, $affiliate_store_offer_title);
            set_theme_mod('affiliate_store_offer_btn_text' . $affiliate_store_i, 'Shop Now');
            set_theme_mod('affiliate_store_offer_btn_link' . $affiliate_store_i, '#' . $affiliate_store_i);

            // Set the image path for the offer background image
            $affiliate_store_image_path = get_template_directory() . '/images/offer/' . $affiliate_store_offer_image_name;

            // Check if the image exists and upload it
            if (file_exists($affiliate_store_image_path)) {
                $affiliate_store_upload_dir = wp_upload_dir();
                $affiliate_store_file_path = $affiliate_store_upload_dir['path'] . '/' . $affiliate_store_offer_image_name;

                if (copy($affiliate_store_image_path, $affiliate_store_file_path)) {
                    // Get file type and prepare for attachment
                    $affiliate_store_filetype = wp_check_filetype($affiliate_store_offer_image_name, null);
                    $affiliate_store_attachment = array(
                        'post_mime_type' => $affiliate_store_filetype['type'],
                        'post_title'     => sanitize_file_name($affiliate_store_offer_image_name),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    // Insert the image as an attachment
                    $affiliate_store_attach_id = wp_insert_attachment($affiliate_store_attachment, $affiliate_store_file_path);
                    $affiliate_store_attach_data = wp_generate_attachment_metadata($affiliate_store_attach_id, $affiliate_store_file_path);
                    wp_update_attachment_metadata($affiliate_store_attach_id, $affiliate_store_attach_data);

                    // Set the image as the offer background image in Customizer
                    set_theme_mod('affiliate_store_offer_bg_image' . $affiliate_store_i, wp_get_attachment_url($affiliate_store_attach_id));
                }
            }
        }

        // Create product categories and their respective images
        $affiliate_store_product_categories = [
            'Clothing',
            'Books',
            'Smartphones',
            'Furniture',
            'Watches',
            'Electronics',
            'Sports',
        ];

        foreach ($affiliate_store_product_categories as $affiliate_store_index => $affiliate_store_category_name) {
            // Create the product category
            $affiliate_store_category = wp_insert_term($affiliate_store_category_name, 'product_cat');

            // Check if the category was created successfully
            if (!is_wp_error($affiliate_store_category)) {
                // Set the category in theme mods
                set_theme_mod('affiliate_store_category_' . sanitize_title($affiliate_store_category_name), $affiliate_store_category_name);

                // Construct the image path dynamically
                // Adjust the image name based on your logic
                $affiliate_store_image_name = 'Top-Categories' . ($affiliate_store_index + 1) . '.png'; 
                $affiliate_store_image_path = get_template_directory() . '/images/Top-Categories/' . $affiliate_store_image_name;

                // Debugging output
                error_log("Checking for image: " . $affiliate_store_image_path);

                // Check if the image exists and upload it
                if (file_exists($affiliate_store_image_path)) {
                    $affiliate_store_upload_dir = wp_upload_dir();
                    $affiliate_store_file_path = $affiliate_store_upload_dir['path'] . '/' . $affiliate_store_image_name;

                    // Debugging output
                    error_log("Copying image to: " . $affiliate_store_file_path);

                    if (copy($affiliate_store_image_path, $affiliate_store_file_path)) {
                        // Get file type and prepare for attachment
                        $affiliate_store_filetype = wp_check_filetype($affiliate_store_image_name, null);
                        $affiliate_store_attachment = [
                            'post_mime_type' => $affiliate_store_filetype['type'],
                            'post_title' => sanitize_file_name($affiliate_store_image_name),
                            'post_content' => '',
                            'post_status' => 'inherit',
                        ];

                        // Insert the image as an attachment
                        $affiliate_store_attach_id = wp_insert_attachment($affiliate_store_attachment, $affiliate_store_file_path);
                        $affiliate_store_attach_data = wp_generate_attachment_metadata($affiliate_store_attach_id, $affiliate_store_file_path);
                        wp_update_attachment_metadata($affiliate_store_attach_id, $affiliate_store_attach_data);

                        // Set the image as the category image in Customizer (use term_id to associate with product category)
                        if (isset($affiliate_store_category['term_id'])) {
                            update_term_meta($affiliate_store_category['term_id'], 'thumbnail_id', $affiliate_store_attach_id);
                        }

                        // Debugging output
                        error_log("Category image set for: " . $affiliate_store_category_name);
                    } else {
                        error_log("Failed to copy image: " . $affiliate_store_image_path);
                    }
                } else {
                    error_log("Image file does not exist: " . $affiliate_store_image_path);
                }
            } else {
                error_log("Error creating category: " . $affiliate_store_category_name . " - " . $affiliate_store_category->get_error_message());
            }
        }

        // Set theme mod for Trending Products Section
        define('AFFILIATE_STORE_IMAGE_DIR', get_template_directory() . '/images/affiliate-products/'); // Define constant for image directory

        set_theme_mod('affiliate_store_trending_title', 'Trending Products');

        // Check if the demo importer button was clicked
        if (isset($_POST['import_demo_content'])) {
            affiliate_store_import_products(); // Run the import function
        }

        // Define the product names you want to use
        $affiliate_store_product_names = array('Winter Red Jacket', 'DSLR Camera', 'S-7 Ortho Headphone', 'Drilling Machine', 'Business Chair');

        // Get or create the 'Trending' category
        $affiliate_store_category_name = 'Trending';
        set_theme_mod('affiliate_store_hot_products_cat', $affiliate_store_category_name);

        $affiliate_store_category = get_term_by('name', $affiliate_store_category_name, 'product_cat');

        if (!$affiliate_store_category) {
            // If the category does not exist, create it
            $affiliate_store_category = wp_insert_term($affiliate_store_category_name, 'product_cat');
            $affiliate_store_category_id = is_array($affiliate_store_category) ? $affiliate_store_category['term_id'] : 0;
        } else {
            $affiliate_store_category_id = $affiliate_store_category->term_id;
        }

        if (is_wp_error($affiliate_store_category_id) || !$affiliate_store_category_id) {
            error_log('Error creating or retrieving product category: ' . $affiliate_store_category_id->get_error_message());
            return; // Exit if category creation fails
        }

        // Loop through the product names and create products
        foreach ($affiliate_store_product_names as $affiliate_store_i => $affiliate_store_product_name) {
            // Prepare product data
            $affiliate_store_product_id = wp_insert_post(array(
                'post_title'  => wp_strip_all_tags($affiliate_store_product_name),  // Assign each product name dynamically
                'post_status' => 'publish',
                'post_type'   => 'product',
            ));

            if (is_wp_error($affiliate_store_product_id)) {
                error_log('Error creating product: ' . $affiliate_store_product_id->get_error_message());
                continue;
            }

            // Set featured meta, regular price, and sale price
            update_post_meta($affiliate_store_product_id, '_featured', 'yes');
            update_post_meta($affiliate_store_product_id, '_regular_price', '109.00');
            update_post_meta($affiliate_store_product_id, '_sale_price', '79.00');
            update_post_meta($affiliate_store_product_id, '_price', '79.00');

            // Set the image path
            $affiliate_store_image_path = AFFILIATE_STORE_IMAGE_DIR . 'affiliate-product' . ($affiliate_store_i + 1) . '.png';

            // Check if the image exists and upload it
            if (file_exists($affiliate_store_image_path)) {
                $affiliate_store_upload_dir = wp_upload_dir();
                $affiliate_store_image_name = 'affiliate-product' . ($affiliate_store_i + 1) . '.png';
                $affiliate_store_file_path = $affiliate_store_upload_dir['path'] . '/' . $affiliate_store_image_name;

                if (copy($affiliate_store_image_path, $affiliate_store_file_path)) {
                    // Get file type and prepare for attachment
                    $affiliate_store_filetype = wp_check_filetype($affiliate_store_image_name, null);
                    $affiliate_store_attachment = array(
                        'post_mime_type' => $affiliate_store_filetype['type'],
                        'post_title'     => sanitize_file_name($affiliate_store_image_name),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    // Insert the image as an attachment
                    $affiliate_store_attach_id = wp_insert_attachment($affiliate_store_attachment, $affiliate_store_file_path, $affiliate_store_product_id);

                    // Generate attachment metadata and assign featured image
                    if (!is_wp_error($affiliate_store_attach_id)) {
                        $affiliate_store_attach_data = wp_generate_attachment_metadata($affiliate_store_attach_id, $affiliate_store_file_path);
                        wp_update_attachment_metadata($affiliate_store_attach_id, $affiliate_store_attach_data);
                        set_post_thumbnail($affiliate_store_product_id, $affiliate_store_attach_id);
                    } else {
                        error_log('Error creating image attachment: ' . $affiliate_store_attach_id->get_error_message());
                    }
                }
            } else {
                error_log('Image file does not exist: ' . $affiliate_store_image_path);
            }

            // Assign the product to the 'Trending' category
            wp_set_object_terms($affiliate_store_product_id, $affiliate_store_category_id, 'product_cat');

            // Ensure all relationships are updated and product data is refreshed
            wc_delete_product_transients($affiliate_store_product_id); // Clear WooCommerce cache
            clean_post_cache($affiliate_store_product_id); // Ensure post cache is cleared
        }

        //Footer Copyright Text
        set_theme_mod( 'affiliate_store_copyright_line', 'Affiliate Store WordPress Theme' );

    // Show success message and the "View Site" button
         echo '<div class="success">Demo Import Successful</div>';
    }
     ?>
    <ul>
        <li>
        <hr>
        <?php 
        // Check if the form is submitted
        if ( !isset( $_POST['submit'] ) ) : ?>
           <!-- Show demo importer form only if it's not submitted -->
           <?php echo esc_html( 'Click on the below content to get demo content installed.', 'affiliate-store' ); ?>
          <br>
          <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'affiliate-store' ); ?></b></small>
          <br><br>

          <form id="demo-importer-form" action="" method="POST" onsubmit="return confirm('Do you really want to do this?');">
            <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer','affiliate-store'); ?>" class="button button-primary button-large">
          </form>
        <?php 
        endif; 

        // Show "View Site" button after form submission
        if ( isset( $_POST['submit'] ) ) {
        echo '<div class="view-site-btn">';
        echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
        echo '</div>';
        }
        ?>

        <hr>
        </li>
    </ul>
 </div>