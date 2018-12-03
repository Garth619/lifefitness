<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$sidebar = get_post_meta(get_option('woocommerce_shop_page_id'),'page_sidebar',true);
if(!$sidebar){
	$sidebar = ot_get_option('page_sidebar','right');
}
$woocommerce_column = ot_get_option('woocommerce_column','');
if($woocommerce_column!=''){ $woocommerce_column = 'columns-'.$woocommerce_column;}
if($sidebar == 'hidden') $sidebar = 'full';
get_header( 'shop' ); ?>
    <div id="cactus-body-container" class="page-main page-normal page-single-product woocommerce-archive <?php echo $woocommerce_column;?>"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-single-page cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
            <div class="container">
                <div class="row">

					<?php
                        /**
                         * woocommerce_before_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                         * @hooked woocommerce_breadcrumb - 20
                         */
                        //do_action( 'woocommerce_before_main_content' );
                    ?>
                    <div class="main-content-col col-md-12 cactus-config-single">
						<?php if(is_active_sidebar('content-top-sidebar')){
                            echo '<div class="content-top-sidebar-wrap">';
							dynamic_sidebar( 'content-top-sidebar' );
							echo '</div>';
                        } ?>
                        
                        <!--breadcrumb-->
                        <?php 
						 if(function_exists('ct_breadcrumbs')){
							 ct_breadcrumbs();
						}
						?>
                        <div class="cactus-listing-heading"><h1><?php esc_html_e('product list','cactus');?></h1></div>
                		<div id="single-post" class="single-post-content archive-item">
                        <?php do_action( 'woocommerce_archive_description' ); ?>
                        <?php if ( have_posts() ) : 
						
						
							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked wc_print_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );

							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 *
									 * @hooked WC_Structured_Data::generate_product_data() - 10
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							/**
							 * Hook: woocommerce_after_shop_loop.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );

							elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                
                            <?php 
							
							/**
							 * Hook: woocommerce_no_products_found.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );
							

							?>
                
                        <?php endif; ?>
                        </div>
                        </div><!-- row -->
                        <?php if($sidebar != 'full'){ do_action( 'woocommerce_sidebar' ); } ?>
                    </div>
                    <?php
                        /**
                         * woocommerce_after_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        //do_action( 'woocommerce_after_main_content' );
                    ?>
                
                    <?php
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        //do_action( 'woocommerce_sidebar' );
                    ?>
                    </div><!-- .row -->
            </div><!-- .post-content -->
        </div><!-- #contennt -->
    </div><!-- .page-main -->
<?php get_footer( 'shop' ); ?>
