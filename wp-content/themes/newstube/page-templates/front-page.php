<?php
/**
 * Template Name: Front Page
 *
 * @package cactus
 */

get_header();

    global $paged;
    $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
    wp_reset_postdata();
    $page_content = get_post_meta(get_the_ID(),'fr_page_content',true);

    $sidebar_ot = ot_get_option('blog_sidebar','right');
    $page_on_front = get_option('page_on_front');

    if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php'))
    {
		$page_sidebar_meta = get_post_meta(get_the_ID(),'page_sidebar',true);
        $sidebar_ot = ($page_sidebar_meta == '0' || !$page_sidebar_meta)  ? $sidebar_ot : get_post_meta(get_the_ID(),'page_sidebar',true);
    }
	

    $sidebar = $sidebar_ot == 'fullwidth' ? 'full' : $sidebar_ot;
	
	
	
    $front_page_class = $page_content == 'blog' ? 'cactus-listing-wrap' : 'cactus-single-page';

    $blog_layout_class = '';

    if($page_content == 'blog')
    {
        $blog_layout = ot_get_option('blog_layout', 'layout_1');

        if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php'))
        {
            $blog_layout = get_post_meta(get_the_ID(),'fr_blog_layout',true) == '' ? $blog_layout : get_post_meta(get_the_ID(),'fr_blog_layout',true);
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

    }
?>
    <div id="cactus-body-container"> 
        <!--Add class cactus-body-container for single page-->
        <div class=" <?php echo esc_attr($front_page_class);?> cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
            <?php if($page_content == 'blog'):?>
            <!--.cactus-listing-config-->
            <div class="cactus-listing-config style-1 <?php echo $blog_layout_class;?>"> <!--addClass: style-1 + (style-2 -> style-n)-->
            <?php endif;?>
                <div class="container">
                    <div class="row">

                        <?php
                            $page_on_front = get_option('page_on_front');
                            $getOptionsLayouts = ot_get_option('main_layout', 'boxed');

                            if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php'))
                            {
                                $getOptionsLayouts = get_post_meta(get_the_ID(),'front_page_layout',true) == '' ? ot_get_option('main_layout', 'boxed') : get_post_meta(get_the_ID(),'front_page_layout',true);
                            }

                            $default_front_page_layout  = ot_get_option('default_front_page_layout', 'layout_1');

                            if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php'))
                            {
                                $default_front_page_layout = get_post_meta(get_the_ID(),'front_page_header_layout',true) == '' ? ot_get_option('default_front_page_layout', 'layout_1') : get_post_meta(get_the_ID(),'front_page_header_layout',true);
                            }

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
                                //$header_shortcode = '<div class="thumbslider-for-rev">[rev_slider alias="test1"]</div>';

                            else if($featured_post_layout == 'posts_parallax')
                                $header_shortcode = '[xparallax condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" count="' . $featured_posts_count . '"]';

                            else
                                $header_shortcode = '';

                            if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php')) {
                                $front_page_header_content = get_post_meta(get_the_ID(),'front_page_header_content',true);

                                if($front_page_header_content != '') {
                                    if ((preg_match('/xthumbslider/', $front_page_header_content, $matches) || preg_match('/rev_slider/', $front_page_header_content, $matches)) && $getOptionsLayouts=='boxed')
                                    {
                                        $header_shortcode = '';
                                    }
                                    else
                                    {
                                        if(preg_match('/rev_slider/', $front_page_header_content, $matches))
                                            $header_shortcode = '<div class="front-page-newstube-rev-slider">' . $front_page_header_content . '</div>';
                                        else
                                            $header_shortcode = $front_page_header_content;
                                    }
                                }
                            }
							
							
                        ?>

                        <?php 
						
						$show_header = get_post_meta(get_the_ID(),'front_page_header',true);
						
						if($show_header != 'disabled' && $default_front_page_layout == 'layout_2'):?>
							<div class="cactus-categories-slider">
                                <?php if(isset($front_page_header_content) && $front_page_header_content != ''):?>
                                    <?php echo do_shortcode($header_shortcode);?>
                                <?php else:?>
                                    <?php if($featured_post_layout == 'posts_thumb_slider' && $getOptionsLayouts != 'boxed'):?>
                                        <?php echo do_shortcode($header_shortcode);?>
                                    <?php endif;?>
                                    <?php if($featured_post_layout != 'posts_thumb_slider'):?>
                                        <?php echo do_shortcode($header_shortcode);?>
                                     <?php endif;?>
                                <?php endif;?>

                            </div>
                        <?php endif;?>
                        
                        
                        <?php $listing_front_page_class = $page_content == 'blog' ? 'cactus-listing-content' : 'cactus-config-single'; ?>
                        <div class="main-content-col col-md-12 <?php echo $listing_front_page_class;?>">
                            <div class="build-shortcode">
                                <?php if($default_front_page_layout == 'layout_1'):?>
                                    <?php if(isset($front_page_header_content) && $front_page_header_content != ''):?>
                                        <?php 
										echo do_shortcode($header_shortcode);?>
                                    <?php else:?>
                                        <?php if($featured_post_layout != 'posts_thumb_slider'):?>
                                            <?php echo do_shortcode($header_shortcode);?>
                                        <?php endif;?>
                                    <?php endif;?>

                                <?php endif;?>
                            </div>
                            
                            <?php if($paged < 2):?>
                                <?php if(is_active_sidebar('content-top-sidebar')){
                                        echo '<div class="content-top-sidebar-wrap">';
                                        dynamic_sidebar( 'content-top-sidebar' );
                                        echo '</div>';
                                    } ?>
                            <?php endif;?>


                            <?php if($page_content == 'page_content'):?>
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php get_template_part( 'html/single/content', 'page' ); ?>

                                <?php endwhile; // end of the loop. ?>
                            <?php else:?>

                                    <?php
                                        global $paged, $wp;
                                        global $wp_query;
                                        $temp_query = $wp_query;
                                        $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

                                        $options = array(
                                            'post_type'             => 'post',
                                            'order'                 => 'desc',
                                            'paged'                 => $paged,
                                            'post_status'           => 'publish',
                                            'ignore_sticky_posts'   => true
                                        );

                                        $post_limit                 = get_post_meta(get_the_ID(),'fr_page_post_count',true) != '' ? get_post_meta(get_the_ID(),'fr_page_post_count',true) : 9;
                                        $post_cat                   = get_post_meta(get_the_ID(),'fr_page_post_categories',true);
                                        $post_tags                  = get_post_meta(get_the_ID(),'fr_page_post_tags',true);
                                        $post_ids                   = get_post_meta(get_the_ID(),'fr_page_post_id',true);
                                        $order_by                   = get_post_meta(get_the_ID(),'fr_page_order_by',true);

                                        // if you don't setup post_ids param
                                        if(isset($post_ids) && $post_ids == '')
                                        {
                                            if(isset($post_cat) && $post_cat != '')
                                            {
                                                $cats = explode(",",$post_cat);
                                                if(is_numeric($cats[0]))
                                                    $options['category__in'] = $cats;
                                                else
                                                    $options['category_name'] = $post_cat;
                                            }
                                            if(isset($post_tags) && $post_tags != '')
                                            {
                                                $options['tag'] = $post_tags;
                                            }
                                        }
                                        else
                                        {
                                            $ids = explode(",",$post_ids);
                                            if(is_numeric($ids[0]))
                                                $options['post__in'] = $ids;
                                        }

                                        $options['orderby'] = $order_by == 'random' ? 'rand' : 'date';


                                        $options['posts_per_page'] = $post_limit;

                                        $query= new WP_Query($options);

                                        // echo '<pre>';
                                        //     print_r($query);
                                        // echo '</pre>';
                                        // die;
                                        $wp_query = $query;

                                        $total_page = ceil($query->found_posts / get_option('posts_per_page'));

                                        global $wp_query, $wp;

                                        $js_params['current_url'] =  home_url($wp->request);
                                        //$query->query_vars;
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
                            <?php endif;?>

                            <?php if(is_active_sidebar('content-bottom-sidebar')){
                                echo '<div class="content-bottom-sidebar-wrap">';
                                dynamic_sidebar( 'content-bottom-sidebar' );
                                echo '</div>';
                            } ?>

                        </div>

                        <?php if($sidebar!='full'){ get_sidebar(); } ?>

                    </div><!--.row-->
                </div><!--.container-->
            <?php if($page_content == 'blog'):?>
            <!--.cactus-listing-config-->
            </div>
            <?php endif;?>
        </div>
        <!--#cactus-single-page-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
