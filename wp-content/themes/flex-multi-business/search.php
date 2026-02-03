<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package flex-multi-business
 */

get_header();
?>

<div class="box-image position-relative">
   <div class="single-page-img"></div>
   <div class="page-header">
      <?php echo '<h1 class="mb-2">' . esc_html__('Results For: ', 'flex-multi-business') . get_search_query() . '</h1>'; ?>
      <span><?php flex_multi_business_the_breadcrumb(); ?></span>  
   </div>
</div>

<?php
    $sidebar_layout = get_theme_mod('flex_multi_business_sidebar_layout_section', 'right');
    if ($sidebar_layout == 'left') {
        $sidebar_layout = 'has-left-sidebar';
    } elseif ($sidebar_layout == 'right') {
        $sidebar_layout = 'has-right-sidebar';
    } elseif ($sidebar_layout == 'no') {
        $sidebar_layout = 'no-sidebar';
    }
?>

	<div class="mt-5 bg-w">
        <div class="container">
            <div class="row <?php echo esc_attr($sidebar_layout); ?>">
                <div class="col-lg-8">

					<header class="page-header">
						<h1 class="page-title">
							<?php
							printf( esc_html__( 'Search Results for: %s', 'flex-multi-business' ), '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
					</header> 
					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						<?php endwhile; ?>

						<div class="row">
	                        <div class="col-12 text-center">
	                            <div class="pagination mt-5 mb-3">
	                                <?php echo paginate_links(); ?>
	                            </div>
	                        </div>
	                    </div>
						

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif;?>

				</div>

					<?php
		        	if (($sidebar_layout == 'has-left-sidebar') || ($sidebar_layout == 'has-right-sidebar')) { ?>
						<div class="col-lg-4">
							<aside class="sidebar mt-5 mt-lg-0">
	                        	<?php get_sidebar(); ?>
	                    	</aside>
						</div>
					<?php } ?>
			</div> 
		</div> 
	</section>

<?php
get_footer();