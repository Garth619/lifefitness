<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cactus
 */

get_header();
global $blog_layout;

global $paged;
$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

//get test layout variable from query string
parse_str($_SERVER['QUERY_STRING']);

if(isset($test_layout) && $test_layout != '' && ($test_layout == 'layout_1' || $test_layout == 'layout_2' || $test_layout == 'layout_3' || $test_layout == 'layout_4' || $test_layout == 'layout_5' || $test_layout == 'layout_6' || $test_layout == 'layout_7'))
    $blog_layout = $test_layout;
else
    $blog_layout = ot_get_option('blog_layout', 'layout_1');


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
    $sidebar = ot_get_option('blog_sidebar','right') == 'hidden' ? 'full' : $sidebar;
?>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-listing-wrap cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
            <div class="cactus-listing-config style-1 <?php echo $blog_layout_class;?>"> <!--addClass: style-1 + (style-2 -> style-n)-->
            <div class="container">
                <div class="row">
                    <?php
                        $getOptionsLayouts  = ot_get_option('main_layout', 'boxed');

                        $default_front_page_layout  = ot_get_option('default_front_page_layout', 'layout_1');
                        $featured_post_layout       = ot_get_option('featured_post_layout', '');
                        $number_of_featured_posts   = ot_get_option('featured_posts_count_hp', '5');
                        $featured_posts_count       = $number_of_featured_posts == '' || !is_numeric($number_of_featured_posts) ? '5' : $number_of_featured_posts;
                        $featured_posts_categories  = ot_get_option('featured_posts_categories', '');
                        $featured_posts_autoplay    = ot_get_option('featured_posts_autoplay', 'on');
                        $xgrid_autoplay             = $featured_posts_autoplay == 'on' ? '5000' : '';
                        $autoplay                   = $featured_posts_autoplay == 'on' ? '1' : '0';

                        if($featured_post_layout == 'posts_grid_layout_1')
                            $header_shortcode = '[xgrid layout="1" condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" speed="' . $xgrid_autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_grid_layout_2')
                            $header_shortcode = '[xgrid layout="2" condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" speed="' . $xgrid_autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_grid_layout_3')
                            $header_shortcode = '[xgrid layout="3" condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" speed="' . $xgrid_autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_slider')
                            $header_shortcode = '[xslider condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" autoplay="' . $autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_classic_slider_layout_1')
                            $header_shortcode = '[xclassicslider layout="horizontal" condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" autoplay="' . $autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_classic_slider_layout_2')
                            $header_shortcode = '[xclassicslider layout="vertical" condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" autoplay="' . $autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_carousel')
                            $header_shortcode = '[xcarousel condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" autoplay="' . $autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_thumb_slider' && $getOptionsLayouts!='boxed')
                            $header_shortcode = '[xthumbslider condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" autoplay="' . $autoplay . '" count="' . $featured_posts_count . '"]';

                        else if($featured_post_layout == 'posts_parallax')
                            $header_shortcode = '[xparallax condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" count="' . $featured_posts_count . '"]';

                        else
                            $header_shortcode = '';
                    ?>

                    <?php $hide_show_header_slider = ot_get_option('hide_show_header_in_second_page','on');?>
                    <?php if($default_front_page_layout == 'layout_2'):?>
                        <?php if($hide_show_header_slider == 'on') :?>
                                <?php if($paged < 2):?>
                                    <div class="cactus-categories-slider">
                                        <?php if($featured_post_layout == 'posts_thumb_slider' && $getOptionsLayouts!='boxed'):?>
                                            <?php echo do_shortcode($header_shortcode);?>
                                        <?php endif;?>
                                        <?php if($featured_post_layout != 'posts_thumb_slider'):?>
                                            <?php echo do_shortcode($header_shortcode);?>
                                         <?php endif;?>
                                    </div>
                                <?php endif;?>
                            <?php else:?>
                                <div class="cactus-categories-slider">
                                    <?php if($featured_post_layout == 'posts_thumb_slider' && $getOptionsLayouts!='boxed'):?>
                                        <?php echo do_shortcode($header_shortcode);?>
                                    <?php endif;?>
                                    <?php if($featured_post_layout != 'posts_thumb_slider'):?>
                                        <?php echo do_shortcode($header_shortcode);?>
                                     <?php endif;?>
                                </div>
                        <?php endif;?>
                    <?php endif;?>

                    <div class="main-content-col col-md-12 cactus-listing-content">
                        <?php if(is_active_sidebar('content-top-sidebar')){
                            echo '<div class="content-top-sidebar-wrap">';
                            dynamic_sidebar( 'content-top-sidebar' );
                            echo '</div>';
                        } ?>

                        <?php if($default_front_page_layout == 'layout_1'):?>
                            <?php if($hide_show_header_slider == 'on'):?>
                                <?php if($paged < 2):?>
                                    <?php if($featured_post_layout != 'posts_thumb_slider'):?>
                                        <?php echo do_shortcode($header_shortcode);?>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php else:?>
                                <?php if($featured_post_layout != 'posts_thumb_slider'):?>
                                    <?php echo do_shortcode($header_shortcode);?>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endif;?>

                        <?php if(ot_get_option('enable_popular_blog_posts_page', 'off') == 'on'):
                                $blog_page_template_id = ot_get_option('blog_list_page_template', '');
                                if($blog_page_template_id != ''):
                            ?>
                            <div class="combo-change">
                                <div class="listing-select">
                                    <ul>
                                        <li>
                                            <?php echo esc_html__('latest', 'cactus');?> <i class="fa fa-sort-desc"></i>
                                            <ul>
                                                <li><a href="<?php echo get_page_link($blog_page_template_id);?>" title=""><?php echo esc_html__('popular', 'cactus');?></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; endif;?>

                        <div class="cactus-sub-wrap is-blog-listing">
                        <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php get_template_part( 'html/loop/content', get_post_format() ); ?>

                            <?php endwhile; ?>
                        <?php else : ?>

                            <?php get_template_part( 'html/loop/content', 'none' ); ?>

                        <?php endif; ?>
                        </div>

                    <input type="hidden" name="hidden_blog_layout" value="<?php echo $blog_layout;?>"/>
                    <div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config .main-content-col .cactus-sub-wrap.is-blog-listing','html/loop/content'); ?></div>
                    
                    <?php if(is_active_sidebar('content-bottom-sidebar')){
                        echo '<div class="content-bottom-sidebar-wrap">';
                        dynamic_sidebar( 'content-bottom-sidebar' );
                        echo '</div>';
                    } ?>
                    
                    </div><!--.main-content-col-->

                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
            </div><!--.cactus-listing-config-->
        </div><!--.cactus-listing-wrap-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
