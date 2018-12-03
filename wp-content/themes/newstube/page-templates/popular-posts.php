<?php
/**
 * Template Name: Popular Posts
 *
 * @package cactus
 */

get_header();
global $blog_layout;

$popular_style = get_post_meta( get_the_ID(), 'popular_style', true );
//get test layout variable from query string
$blog_layout = $popular_style;


if($blog_layout == 'layout_1')
    $blog_layout_class = '';
else if($blog_layout == 'layout_2')
    $blog_layout_class = 'style-2';

else if($blog_layout == 'layout_3')
    $blog_layout_class = 'style-3';

else if($blog_layout == 'layout_4')
    $blog_layout_class = 'style-4';

else if($blog_layout == 'layout_5')
    $blog_layout_class = 'style-5';

else if($blog_layout == 'layout_6')
    $blog_layout_class = 'style-6';

else if($blog_layout == 'layout_7')
    $blog_layout_class = 'style-7';

else
    $blog_layout_class = '';

	$sidebar = ot_get_option('blog_sidebar','right');
    $sidebar = ot_get_option('blog_sidebar','right') == 'fullwidth' ? 'full' : $sidebar;
?>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-listing-wrap cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
        	<div class="cactus-listing-config style-1 <?php echo $blog_layout_class;?>"> <!--addClass: style-1 + (style-2 -> style-n)-->
            <div class="container">
                <div class="row">

                    <div class="main-content-col col-md-12 cactus-listing-content">

                        <?php if(get_post_meta(get_the_ID(), 'enable_popular_posts_button', true) == 'on'):?>
                            <div class="combo-change">
                                <div class="listing-select">
                                    <ul>
                                        <li>
                                        <?php echo esc_html__('popular', 'cactus');?> <i class="fa fa-sort-desc"></i>
                                        <?php
                                            $page_for_posts = get_option('page_for_posts');
                                            $page_posts_link = ($page_for_posts != 0 && $page_for_posts != '') ? get_page_link($page_for_posts) : home_url();
                                        ?>
                                        <ul>
                                            <li><a href="<?php echo $page_posts_link;?>" title=""><?php echo esc_html__('latest', 'cactus');?></a></li>
                                        </ul>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="cactus-sub-wrap">

                            <?php
                            $paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
                            $conditions = get_post_meta( get_the_ID(), 'front_popular_conditions', true );
                            $timerange = get_post_meta( get_the_ID(), 'popular_time_range', true );

                            $query = cactus_get_posts($post_type, $conditions, $tags='', $number='', $ids='',$sort_by='', $categories='', $args = array(), $trending = 1, $timerange, $paged);

                            global $wp_query;
                            $wp_query = $query;

                            $js_query_vars = '';
                            foreach($query->query as $key=>$value){
                               if(is_numeric($value)){
                                   $js_query_vars .= '"'.$key.'":'.$value.',';
                               }
                                elseif(is_array($value)) {
                                    $output = array();
                                    foreach($value as $json_arr)
                                    {
                                        $output[] = '"' . $json_arr . '"';
                                    }
                                    $js_query_vars .= '"'.$key.'":['.implode(',', $output).'],';
                                }
                                else
                                   $js_query_vars .= '"'.$key.'":"'.$value.'",';

                            }
                            ?>

                            <script type="text/javascript">
                             var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":{<?php echo $js_query_vars; ?>},"current_url":"<?php echo home_url($wp->request);?>" }
                            </script>

                            <?php

                            while ( $query->have_posts() ) : $query->the_post(); ?>

                                <?php get_template_part( 'html/loop/content', get_post_format() ); ?>

                            <?php endwhile; // end of the loop. ?>

                        </div>

                    <input type="hidden" name="hidden_blog_layout" value="<?php echo $blog_layout;?>"/>
                    <div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config .main-content-col .cactus-sub-wrap','html/loop/content'); ?></div>
                    </div><!--.main-content-col-->

                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
            </div><!--.cactus-listing-config-->
        </div><!--.cactus-listing-wrap-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
