<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$sidebar = get_post_meta(get_the_ID(),'product-sidebar',true);
if((function_exists('ot_get_option') && $sidebar=='0') || (function_exists('ot_get_option') && $sidebar=='')){
	$sidebar =  ot_get_option('woocommerce_layout','right');
} 

get_header( 'shop' ); ?>
    <div id="cactus-body-container" class="page-main page-normal page-single-product woocommerce-archive "> <!--Add class cactus-body-container for single page-->
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
                        <div class="content-woo main-content-col col-md-12 cactus-config-single">
							<?php 
                             if(function_exists('ct_breadcrumbs')){
                                 ct_breadcrumbs();
                            }
                            ?>
                            <div class="cactus-listing-heading"><h1><?php the_title();?></h1></div>
                			<div id="single-post" class="single-post-content archive-item">
                            	<div class="row">
                                    <?php while ( have_posts() ) : the_post(); ?>
                            
                                        <?php wc_get_template_part( 'content', 'single-product' ); ?>
                            
                                    <?php endwhile; // end of the loop. ?>
                                </div>
                            </div><!-- row -->
                        </div>
                        <?php
                            /**
                             * woocommerce_after_main_content hook
                             *
                             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                             */
                           // do_action( 'woocommerce_after_main_content' );
                        ?>
                    
                        <?php
                            /**
                             * woocommerce_sidebar hook
                             *
                             * @hooked woocommerce_get_sidebar - 10
                             */
                            //do_action( 'woocommerce_sidebar' );
                        ?>
                        <?php if($sidebar!='full'){ do_action( 'woocommerce_sidebar' ); } ?>
                    </div><!-- .row -->
            </div><!-- .post-content -->
        </div><!-- #contennt -->
    </div><!-- .page-main -->
<?php get_footer( 'shop' ); ?>
