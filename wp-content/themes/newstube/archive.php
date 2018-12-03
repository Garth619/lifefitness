<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cactus
 */

get_header();
global $blog_layout;
global $_is_retina_;

//get test layout variable from query string
parse_str($_SERVER['QUERY_STRING']);

if(isset($test_layout) && $test_layout != '' && ($test_layout == 'layout_1' || $test_layout == 'layout_2' || $test_layout == 'layout_3' || $test_layout == 'layout_4' || $test_layout == 'layout_5' || $test_layout == 'layout_6' || $test_layout == 'layout_7'))
    $blog_layout = $test_layout;
else
    $blog_layout = ot_get_option('blog_layout', 'layout_1');

if(is_category()){
	$category                       = get_category(get_query_var('cat'));
	$blog_layout                = get_option('blog_layout_' . $category->term_id);
	if($blog_layout ==''){
		$blog_layout = ot_get_option('blog_layout', 'layout_1');
	}
}
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

	$sidebar = ot_get_option('category_sidebar','right');
    $sidebar = ot_get_option('category_sidebar','right') == 'hidden' ? 'full' : $sidebar;
?>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-listing-wrap cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
        	<div class="cactus-listing-config style-1 <?php echo $blog_layout_class;?> <?php if(is_category()){?> cate-listing<?php }?>"> <!--addClass: style-1 + (style-2 -> style-n)-->
            <div class="container">
                <div class="row">

                    <?php $category                       = get_category(get_query_var('cat'));?>
<!-- categories list -->
                    <?php
                        if(is_category()):

							$getOptionsLayouts 	= ot_get_option('main_layout', 'boxed');

                            $category_layout                = get_option('cat_layout_' . $category->term_id);
                            $cat_feature_post_layout        = get_option('cat_feature_post_layout_' . $category->term_id);
                            $number_of_featured_posts       = get_option('number_featured_posts_' . $category->term_id);

                            $default_category_layout        = $category_layout == '' ? ot_get_option('default_category_layout', 'layout_1') : $category_layout;
                            $default_featured_post_layout   = $cat_feature_post_layout == '' ? ot_get_option('default_featured_post_layout', '') : $cat_feature_post_layout;
                            $featured_posts_count           = $number_of_featured_posts == '' || !is_numeric($number_of_featured_posts) ? ot_get_option('featured_posts_count', '5')                                                                                                        : $number_of_featured_posts;
                            $cat_featured_posts_autoplay    = ot_get_option('cat_featured_posts_autoplay', 'on');
                            $cat_xgrid_autoplay                 = $cat_featured_posts_autoplay == 'on' ? '5000' : '';
                            $cat_autoplay                   = $cat_featured_posts_autoplay == 'on' ? '1' : '0';

                            $category_id                    = $category->term_id;

                            if($default_featured_post_layout == 'posts_grid_layout_1')
                                $header_category_shortcode = '[xgrid layout="1" condition="" order="DESC" featured="1" cats="' . $category_id . '" speed="' . $cat_xgrid_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_grid_layout_2')
                                $header_category_shortcode = '[xgrid layout="2" condition="" order="DESC" featured="1" cats="' . $category_id . '" speed="' . $cat_xgrid_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_grid_layout_3')
                                $header_category_shortcode = '[xgrid layout="3" condition="" order="DESC" featured="1" cats="' . $category_id . '" speed="' . $cat_xgrid_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_slider')
                                $header_category_shortcode = '[xslider condition="" order="DESC" featured="1" cats="' . $category_id . '" autoplay="' . $cat_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_classic_slider_layout_1')
                                $header_category_shortcode = '[xclassicslider layout="horizontal" condition="" order="DESC" featured="1" cats="' . $category_id . '" autoplay="' . $cat_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_classic_slider_layout_2')
                                $header_category_shortcode = '[xclassicslider layout="vertical" condition="" order="DESC" featured="1" cats="' . $category_id . '" autoplay="' . $cat_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_carousel')
                                $header_category_shortcode = '[xcarousel condition="" order="DESC" featured="1" cats="' . $category_id . '" autoplay="' . $cat_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_thumb_slider' && $getOptionsLayouts!='boxed')
                                $header_category_shortcode = '[xthumbslider condition="" order="DESC" featured="1" cats="' . $category_id . '" autoplay="' . $cat_autoplay . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'posts_parallax')
                                $header_category_shortcode = '[xparallax condition="" order="DESC" featured="1" cats="' . $category_id . '" count="' . $featured_posts_count . '"]';

                            else if($default_featured_post_layout == 'smart_content_box_layout_1')
                                $header_category_shortcode = '[scb title="" layout="1" condition="" order="DESC" featured="1" enable_cat_filter="0" show_meta="1" items_per_page="' . $featured_posts_count . '" cats="' . $category_id . '" big_thumbnail="1"]';

                            else if($default_featured_post_layout == 'smart_content_box_layout_2')
                                $header_category_shortcode = '[scb title="" layout="2" condition="" order="DESC" featured="1" enable_cat_filter="0" show_meta="1" items_per_page="' . $featured_posts_count . '" cats="' . $category_id . '" big_thumbnail="1"]';

                            else if($default_featured_post_layout == 'smart_content_box_layout_3')
                                $header_category_shortcode = '[scb title="" layout="3" condition="" order="DESC" featured="1" enable_cat_filter="0" show_meta="1" items_per_page="' . $featured_posts_count . '" cats="' . $category_id . '" big_thumbnail="1"]';

                            else if($default_featured_post_layout == 'smart_content_box_layout_4')
                                $header_category_shortcode = '[scb title="" layout="4" condition="" order="DESC" featured="1" enable_cat_filter="0" show_meta="1" items_per_page="' . $featured_posts_count . '" cats="' . $category_id . '" big_thumbnail="1"]';

                            else if($default_featured_post_layout == 'smart_content_box_layout_5')
                                $header_category_shortcode = '[scb title="" layout="5" condition="" order="DESC" featured="1" enable_cat_filter="0" show_meta="1" items_per_page="' . $featured_posts_count . '" cats="' . $category_id . '" big_thumbnail="1"]';

                            else if($default_featured_post_layout == 'smart_content_box_layout_6')
                                $header_category_shortcode = '[scb title="" layout="6" condition="" order="DESC" featured="1" enable_cat_filter="0" show_meta="1" items_per_page="' . $featured_posts_count . '" cats="' . $category_id . '" big_thumbnail="1"]';
                            else
                                $header_category_shortcode = '';


                            ?>
                            <?php if($default_category_layout == 'layout_2'):?>
                                <?php $feature_post_content = trim(do_shortcode($header_category_shortcode));?>
                                <?php if($feature_post_content != ''):?>
                                    <div class="cactus-categories-slider">
                                        <?php if($default_featured_post_layout == 'posts_thumb_slider' && $getOptionsLayouts!='boxed'):?>
                                            <?php echo do_shortcode($header_category_shortcode);?>
                                        <?php endif;?>
                                        <!--breadcrumb-->
                                        <!--breadcrumb-->
                                        <?php if($default_featured_post_layout != 'posts_thumb_slider'):?>
                                            <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                                            <?php echo do_shortcode($header_category_shortcode);?>
                                         <?php endif;?>

                                    </div>
                                <?php endif;?>
                            <?php endif;?>

                        <div class="main-content-col col-md-12 cactus-listing-content <?php if(is_category() && $category_layout=='layout_2'){?> cate-listing-style2 <?php }?>">
                        	<?php if(is_active_sidebar('content-top-sidebar')){
								echo '<div class="content-top-sidebar-wrap">';
								dynamic_sidebar( 'content-top-sidebar' );
								echo '</div>';
							} ?>
                            <?php if(($default_category_layout == 'layout_2' && $feature_post_content == '') || ($default_category_layout == 'layout_2' && $default_featured_post_layout == 'posts_thumb_slider' )):?>
                            <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                            <?php endif;?>

                            <?php if($default_category_layout == 'layout_1'):?>
                                <!--breadcrumb-->
                                <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                                <!--breadcrumb-->
                                <?php if($default_featured_post_layout != 'posts_thumb_slider'):?>
                                    <?php echo do_shortcode($header_category_shortcode);?>
                                <?php endif;?>
                            <?php endif;?>
                            <?php if(is_category()){?>
                                <div class="cactus-listing-heading">
                                    <?php
                                        $category                       = get_category( get_query_var( 'cat' ) );
                                        $category_color         = get_option('cat_color_' . $category->term_id);
                                        $category_text_color    = get_option('cat_text_color_' . $category->term_id);

                                        $style_bg_cat = $category_color != '' && $category_color != 'FFFFFF' ? ' background-color: #' . (get_option('cat_color_' . $category->term_id))  . ';' : '';
                                        $style_text_cat = $category_text_color != ''  ? ' style="color: ' . (get_option('cat_text_color_' . $category->term_id))  . ';' . $style_bg_cat . '"' : '';
                                    ?>
                                    <h1 <?php echo $style_text_cat;?>><?php single_cat_title( '', true );?></h1>
                                </div>
                            <?php }?>
                            <?php
	                    		if(ot_get_option('enable_popular_category_posts_page', 'off') == 'on'):
                                    $category_popular_conditions    = ot_get_option('category_popular_conditions', 'latest');
                                    $category_popular_time_range    = ot_get_option('category_popular_time_range', 'all');
                            ?>
    	                            <div class="combo-change">
    	                                <div class="listing-select">
    	                                    <ul>
    	                                        <li>
    	                                            <?php if(isset($listing) && $listing != '')
                                                            echo esc_html__('popular', 'cactus');
                                                          else
                                                            echo esc_html__('latest', 'cactus');
                                                    ?> <i class="fa fa-sort-desc"></i>
    	                                            <ul>
                                                        <?php if(isset($listing) && $listing != ''):?>
                                                            <li><a href="<?php echo get_category_link( $category->term_id );?>" title=""><?php echo esc_html__('latest', 'cactus');?></a></li>
                                                        <?php else:?>
    	                                                   <li><a href="?listing=popular" title=""><?php echo esc_html__('popular', 'cactus');?></a></li>
                                                        <?php endif;?>
    	                                            </ul>
    	                                        </li>
    	                                    </ul>
    	                                </div>
    	                            </div>
                                    <?php if(isset($listing) && $listing != ''):?>
                                        <?php
                                        $paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);

                                        $query = cactus_get_posts($post_type, $category_popular_conditions, $tags='', $number='', $ids='',$sort_by='', $categories=$category->term_id, $args = array(), $trending = 1, $category_popular_time_range, $paged);

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
                                    <?php else: global $wp_query;$query = $wp_query;?>
                                    <?php endif;?>
                            <?php else: global $wp_query;$query = $wp_query;?>
                            <?php endif;?>

                            <div class="cactus-sub-wrap">
                                <?php if ( $query->have_posts() ) : ?>
                                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                        <?php get_template_part( 'html/loop/content', get_post_format() ); ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php get_template_part( 'html/loop/content', 'none' ); ?>
                                <?php endif; ?>
                                <?php wp_reset_postdata();?>
                            </div>

                            <input type="hidden" name="hidden_blog_layout" value="<?php echo $blog_layout;?>"/>
                            <div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config .main-content-col .cactus-sub-wrap','html/loop/content'); ?></div>
                            <?php if(is_active_sidebar('content-bottom-sidebar')){
								echo '<div class="content-bottom-sidebar-wrap">';
								dynamic_sidebar( 'content-bottom-sidebar' );
								echo '</div>';
							} ?>
                        </div><!--.main-content-col-->

<!-- author list and tag list -->

                    <?php elseif(is_author() || is_tag()):?>
                        <div class="main-content-col col-md-12 cactus-listing-content">
                        	<?php if(is_active_sidebar('content-top-sidebar')){
								echo '<div class="content-top-sidebar-wrap">';
								dynamic_sidebar( 'content-top-sidebar' );
								echo '</div>';
							} ?>
                            <!--breadcrumb-->
                           <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                            <!--breadcrumb-->

                        <?php if(is_author()):?>
                            <?php
                                global $author;
                                $userdata               = get_userdata($author);
                                $author_description     = (is_object($userdata) && get_the_author_meta('description',$userdata->ID)) != '' ? get_the_author_meta('description',$userdata->ID) : esc_html_e('','cactus')
                            ?>
                            <div class="cactus-listing-heading author-name">
                                <h1><?php echo $userdata->display_name;?></h1>
                            </div>

                            <div class="cactus-author-post author-arc">
                                <div class="cactus-author-pic">
                                    <div class="img-content">
                                        <?php
                                        if(isset($_is_retina_)&&$_is_retina_){
                                                echo get_avatar( get_the_author_meta('email', $userdata->ID), 260, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg') );
                                        }else{
                                                echo get_avatar( get_the_author_meta('email', $userdata->ID), 130, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg') );
                                        }?>
                                    </div>
                                </div>
                                <div class="cactus-author-content">
                                    <div class="author-content">
                                        <span class="author-body"><?php echo $author_description;?></span>
                                        <ul class="social-listing list-inline not-author-single">
                                            <?php
                                            if($facebook = get_the_author_meta('facebook',$userdata->ID)){ ?>
                                                <li class="facebook"><a rel="nofollow" href="<?php echo esc_url($facebook); ?>" title="<?php esc_html_e('Facebook', 'cactus');?>"><i class="fa fa-facebook"></i></a></li>
                                            <?php }
                                            if($twitter = get_the_author_meta('twitter',$userdata->ID)){ ?>
                                                <li class="twitter"><a rel="nofollow" href="<?php echo esc_url($twitter); ?>" title="<?php esc_html_e('Twitter', 'cactus');?>"><i class="fa fa-twitter"></i></a></li>
                                            <?php }
                                            if($linkedin = get_the_author_meta('linkedin',$userdata->ID)){ ?>
                                                <li class="linkedin"><a rel="nofollow" href="<?php echo esc_url($linkedin); ?>" title="<?php esc_html_e('Linkedin', 'cactus');?>"><i class="fa fa-linkedin"></i></a></li>
                                            <?php }
                                            if($tumblr = get_the_author_meta('tumblr',$userdata->ID)){ ?>
                                                <li class="tumblr"><a rel="nofollow" href="<?php echo esc_url($tumblr); ?>" title="<?php esc_html_e('Tumblr', 'cactus');?>"><i class="fa fa-tumblr"></i></a></li>
                                            <?php }
                                            if($google = get_the_author_meta('google',$userdata->ID)){ ?>
                                               <li class="google-plus"> <a rel="nofollow" href="<?php echo esc_url($google); ?>" title="<?php esc_html_e('Google Plus', 'cactus');?>"><i class="fa fa-google-plus"></i></a></li>
                                            <?php }
                                            if($pinterest = get_the_author_meta('pinterest',$userdata->ID)){ ?>
                                               <li class="pinterest"> <a rel="nofollow" href="<?php echo esc_url($pinterest); ?>" title="<?php esc_html_e('Pinterest', 'cactus');?>"><i class="fa fa-pinterest"></i></a></li>
                                            <?php }
                                            if($email = get_the_author_meta('email',$userdata->ID)){ ?>
                                                <li class="email"><a rel="nofollow" href="mailto:<?php echo esc_url($email); ?>" title="<?php esc_html_e('Email', 'cactus');?>"><i class="fa fa-envelope-o"></i></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                            <div class="cactus-sub-wrap">
                                <?php if ( have_posts() ) : ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php get_template_part( 'html/loop/content', get_post_format() ); ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php get_template_part( 'html/loop/content', 'none' ); ?>
                                <?php endif; ?>
                                <?php wp_reset_postdata();?>
                            </div>

                            <input type="hidden" name="hidden_blog_layout" value="<?php echo $blog_layout;?>"/>
                            <div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config .main-content-col .cactus-sub-wrap','html/loop/content'); ?></div>

                            <?php if(is_active_sidebar('content-bottom-sidebar')){
								echo '<div class="content-bottom-sidebar-wrap">';
								dynamic_sidebar( 'content-bottom-sidebar' );
								echo '</div>';
							} ?>
                        </div>
                        <!--.main-content-col-->

                    <?php else:?>
                        <div class="main-content-col col-md-12 cactus-listing-content">
                        	<?php if(is_active_sidebar('content-top-sidebar')){
								echo '<div class="content-top-sidebar-wrap">';
								dynamic_sidebar( 'content-top-sidebar' );
								echo '</div>';
							} ?>
                            <!--breadcrumb-->
                           <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                           <div class="cactus-sub-wrap">
                                <?php if ( have_posts() ) : ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php get_template_part( 'html/loop/content', get_post_format() ); ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php get_template_part( 'html/loop/content', 'none' ); ?>
                                <?php endif; ?>
                                <?php wp_reset_postdata();?>
                            </div>

                            <input type="hidden" name="hidden_blog_layout" value="<?php echo $blog_layout;?>"/>
                            <div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config .main-content-col .cactus-sub-wrap','html/loop/content'); ?></div>
                            <?php if(is_active_sidebar('content-bottom-sidebar')){
								echo '<div class="content-bottom-sidebar-wrap">';
								dynamic_sidebar( 'content-bottom-sidebar' );
								echo '</div>';
							} ?>
                        </div>
                    <?php endif;?>



                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
            </div><!--.cactus-listing-config-->
        </div><!--.cactus-listing-wrap-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
