<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

if ( !$related_products ) return;

$ids = array();
foreach ( $related_products as $related_product ) {
	array_push($ids, $related_product->get_id());
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $ids,
	'post__not_in'         => array( $product->get_id() )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;
?>
<?php
if ( $products->have_posts() ) : ?>
<div class="col-md-12">
<div class="cactus-related-posts" style=" float:left">
        <div class="title-related-post">
            <?php echo esc_html__('Related Products','cactus');?>
            <a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
            <a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
            <div class="pagination"></div>
        </div>
        <div class="related-posts-content">

            <!--Listing-->
            <div class="cactus-listing-wrap">
                <!--Config-->
                <div class="cactus-listing-config style-1 style-3"> <!--addClass: style-1 + (style-2 -> style-n)-->

                    <div class="container">
                        <div class="row">

                            <div class="col-md-12 cactus-listing-content"> <!--ajax div-->

                                <div class="cactus-sub-wrap">
                                    <div class="cactus-swiper-container" data-settings='["mode":"cactus-fix-composer"]'>
                                        <div class="swiper-wrapper">
											<?php while ( $products->have_posts() ) : $products->the_post();
                                             ?>
                                                <div class="swiper-slide">
                                                <!--item listing-->
                                                <div class="cactus-post-item hentry">

                                                    <!--content-->
                                                    <div class="entry-content">
                                                        <div class="primary-post-content"> <!--addClass: related-post, no-picture -->

                                                            <!--picture-->
                                                            <div class="picture">
                                                                <div class="picture-content">
                                                                    <a href="<?php echo get_the_permalink();?>" title="<?php the_title_attribute();?>">
                                                                        <?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
                                                                    </a>
                                                                </div>

                                                            </div><!--picture-->

                                                            <div class="content <?php if(!has_post_thumbnail()){ echo ' no-thumb ';}?>">

                                                                <!--Title-->
                                                                <h3 class="h6 cactus-post-title entry-title">
                                                                    <a href="<?php echo get_the_permalink();?>" title="<?php the_title_attribute();?>"><?php echo get_the_title(); ?></a>
                                                                </h3><!--Title-->
                                                                <?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
                                                                <!--info-->
                                                                <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                                                            </div>
                                                        </div>

                                                    </div><!--content-->

                                                </div><!--item listing-->
                                            </div>
										 <?php endwhile; // end of the loop. ?>
                						 </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div><!--Config-->
            </div><!--Listing-->

        </div>
    </div>
</div>
    <!--related post-->
<?php endif;

wp_reset_postdata();
