<?php
get_header();
$sidebar = get_post_meta(get_the_ID(),'page_sidebar',true);
if(!$sidebar){
	$sidebar = ot_get_option('page_sidebar','right');
}
?>

<div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
	<!--Listing-->
    <div class="cactus-listing-wrap cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>"> <!--add config side bar right-->
        <!--Config-->
        <div class="cactus-listing-config style-1 style-2 channel-list"> <!--addClass: style-1 + (style-2 -> style-n)-->

            <div class="container">
                <div class="row">


                    <div class="col-md-12 cactus-listing-content main-content-col">

                        <!--breadcrumb-->
                        <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                        <!--breadcrumb-->
                            <div class="cactus-listing-heading">
                                <h1><?php echo esc_html('Channels', 'cactus');?></h1>
                            </div>
                            <?php 
                            $paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
                            $args = array(
                                'post_type' => 'ct_channel',
                                'posts_per_page' => get_option('posts_per_page'),
								'post_status' => 'publish',
                                'ignore_sticky_posts' => 1,
                                'paged' => $paged,
                            );
                            $list_query = new WP_Query( $args );
                            $it = $list_query->post_count;
                            if($list_query->have_posts()){?>
							<?php
                            global $wp_query,$wp;
                            $main_query = $wp_query;
                            $wp_query = $list_query;
                            ?>
                            
                            <script type="text/javascript">
                             var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":<?php echo str_replace('\/', '/', json_encode($args)) ?>,"current_url":"<?php echo home_url($wp->request);?>" }
                            </script>    
                            <div class="cactus-sub-wrap">
                                <?php if ( have_posts() ) : ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php get_template_part( 'cactus-channel/content-listing'); ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // ?>
                                <?php endif; ?>
                            </div>
                            <?php }?>
                            <div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config.channel-list .cactus-sub-wrap','cactus-channel/content-listing', esc_html__('Load More Channels','cactus')); ?></div>
							<?php 
                            wp_reset_postdata();
                            if($it>0){
                              $wp_query = $main_query;
                            }?>
                    </div>

                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div>
            </div>

        </div><!--Config-->
    </div><!--Listing-->
</div>
<?php
get_footer();
