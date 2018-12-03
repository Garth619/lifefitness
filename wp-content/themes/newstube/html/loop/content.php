<?php
/**
 * @package cactus
 */

    global $blog_layout;

    /*emulate variable*/

    $has_featured_post              = get_post_meta(get_the_ID(), 'featured_post', true);
    $has_featured_post_class        = ($blog_layout == 'layout_1' && $has_featured_post == 'yes') ? ' featured-post' : '';
    $has_featured_post_full_class   = (($blog_layout == 'layout_2' || $blog_layout == 'layout_7' ) && $has_featured_post == 'yes') ? ' featured-post-full' : '';
	if(ot_get_option('enable_wide_layout_featured','on') =='off'){$has_featured_post_full_class = '';}
    /*end emulate variable*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("cactus-post-item hentry" . $has_featured_post_class. $has_featured_post_full_class); ?>>

    <?php
        $comment_str = '';
        if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) )
            $comment_str = '<div class="comment cactus-info">' . get_comments_number() . '</div>';
    ?>
    <?php

        // get categories
        $categories = get_the_category();
        $category_str = '';
        if(!empty($categories))
        {
            foreach($categories as $index => $category)
            {
                if($blog_layout == 'layout_2' && $has_featured_post_full_class != '')
                {
                    if($index == 0)
                    {
                        $category_str .= cactus_get_category($category);
                        break;
                    }
                }
                else if($blog_layout == 'layout_2')
                    $category_str .= cactus_get_category($category);
                else
                {
                    if($index == 0)
                    {
                        $category_str .= cactus_get_category($category);
                        break;
                    }
                }

            }
        }
        
        $category_str = apply_filters('newstube_item_category_tags', $category_str, $blog_layout);

        //title
        $title = '';
        if($blog_layout == 'layout_2' && $has_featured_post_full_class == '')
        {

            $title .= $category_str;
        }
        $title .= '
            <h3 class="h4 cactus-post-title entry-title">
                <a href="' . get_the_permalink() . '" title="' . esc_html(get_the_title()) . '" rel="bookmark">' . get_the_title() . '</a>
            </h3>';

        // info
        $info = '';
        $info .= '
            <div class="posted-on">
                ' . cactus_get_datetime() . '
                <span class="vcard author"> 
                    <span class="fn"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="author cactus-info">' . esc_html( get_the_author() ) . '</a></span>
                </span>';
        $info .= $comment_str;
        $like       = function_exists('GetWtiLikeCount') ? '<div class="like cactus-info">' . GetWtiLikeCount(get_the_ID()) . '</div>' : '';
        $unlike     = function_exists('GetWtiUnlikeCount') ? '<div class="dislike cactus-info">' . GetWtiUnlikeCount(get_the_ID()) . '</div>' : '';
        $viewed     = (function_exists('bawpvc_main') || function_exists('get_tptn_post_count_only')) ? '<div class="view cactus-info">' . get_formatted_string_number(cactus_get_post_view()) . '</div>' : '';
        $info .= $like . $unlike . $viewed . '</div>';
    ?>

    <?php if($blog_layout == 'layout_1') echo $title . $info;?>

    <?php
        $show_related_posts = get_post_meta($post->ID, 'show_related_post_in_archive', true);

        $has_related_post_class = ($has_featured_post_class == '' && ($blog_layout == 'layout_1') && ($show_related_posts != 'no')) ? 'related-post' : '';
        $has_no_picture_class = !has_post_thumbnail() ? 'no-picture' : '';
    ?>
    <!--content-->
    <div class="entry-content">
        <div class="primary-post-content <?php echo $has_related_post_class;?> <?php echo $has_no_picture_class;?>"> <!--addClass: related-post, no-picture -->
            <?php ob_start();?>
            <?php if(has_post_thumbnail()): ?>
            <!--picture-->
            <div class="picture">
                <div class="picture-content <?php echo function_exists('newstube_item_thumbnail_do_filter') ? get_post_format(get_the_ID()) : '';?>">
                    <?php ob_start();?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php
                            if(($blog_layout=='layout_1' && $has_related_post_class!='' && $has_featured_post_class=='' && $has_no_picture_class=='') || ($blog_layout == 'layout_7' && $has_featured_post_full_class=='')){
								echo cactus_thumbnail('thumb_288x190');
							}else if($blog_layout == 'layout_5' || $blog_layout == 'layout_6' || ($blog_layout == 'layout_2' && $has_featured_post_full_class!='') || ($blog_layout == 'layout_7' && $has_featured_post_full_class!='')){
                                echo cactus_thumbnail('thumb_800x360');
							}else{
								switch($blog_layout){
									case 'layout_3':
										echo cactus_thumbnail('thumb_390x215');
										break;
									case 'layout_4':
										echo cactus_thumbnail('thumb_396x325');
										break;
									default:	
										echo cactus_thumbnail('thumb_390x260');
								};								
							};
                        ?>
                        <div class="thumb-overlay"></div>
                        
                        <?php if($blog_layout == 'layout_4' || ($blog_layout == 'layout_2' && $has_featured_post_full_class!='') || ($blog_layout == 'layout_7' && $has_featured_post_full_class!='')) { ?>
                        	<div class="thumb-gradient"></div>
                        <?php };?>

                        <?php if(get_post_format() == 'video'):?>
                            <i class="fa fa-play-circle-o cactus-icon-fix"></i>
                        <?php elseif(get_post_format() == 'image'):?>
                            <i class="fa fa-file-image-o cactus-icon-fix"></i>
                        <?php elseif(get_post_format() == 'audio'):?>
                            <i class="fa fa-music cactus-icon-fix"></i>
                        <?php elseif(get_post_format() == 'gallery'):?>
                            <i class="fa fa-camera cactus-icon-fix"></i>
                        <?php endif;?>

                    </a>

                    <?php if($has_featured_post_full_class != '' || $blog_layout == 'layout_4'):?>
                        <div class="content-abs-post">
                            <?php echo $category_str;?>
                            <?php echo tm_post_rating(get_the_ID());?>
                            <!--Title-->
                            <?php echo $title;?>
                        </div>
                    <?php else:?>
                        <?php echo $category_str;?>

                        <?php echo tm_post_rating(get_the_ID());?>
                    <?php endif;?>
                    <?php
                    $item_thumbnail = ob_get_contents();
                    ob_end_clean();

                    echo apply_filters('newstube_item_thumbnail_filter', $item_thumbnail, 'blog-' . $blog_layout, array());
                    ?>
                </div>
            </div>
            <!--picture-->
            <?php elseif(!has_post_thumbnail() && ($blog_layout == 'layout_4' || ($blog_layout == 'layout_7' && $has_featured_post_full_class != '') || ($blog_layout == 'layout_2' && $has_featured_post_full_class != ''))):?>
                    <div class="picture">
                        <div class="picture-content">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/default_image.jpg');?>" alt="">
                                <div class="thumb-overlay"></div>                                
                            </a>
                            <?php if($has_featured_post_full_class != '' || $blog_layout == 'layout_4' || $blog_layout == 'layout_7'):?>
                                <div class="content-abs-post">
                                    <?php echo $category_str;?>
                                    <?php echo tm_post_rating(get_the_ID());?>
                                    <!--Title-->
                                    <?php echo $title;?>
                                </div>
                            <?php else:?>
                                <?php echo $category_str;?>

                                <?php echo tm_post_rating(get_the_ID());?>
                            <?php endif;?>
                        </div>

                    </div>
            <?php endif; ?>
            <?php
                        
            $html = ob_get_contents();
            ob_end_clean();
            echo apply_filters('loop_blog_item_thumbnail', $html, get_the_ID(), $blog_layout, $category_str);
                ?>
            <?php if($has_featured_post_full_class == ''):?>
                <div class="content">

                    <?php if($blog_layout == 'layout_2' || $blog_layout == 'layout_3' || $blog_layout == 'layout_5' || $blog_layout == 'layout_6' || $blog_layout == 'layout_7') echo $title . $info;?>

                    <!--excerpt-->
                    <div class="excerpt">
                    <?php echo  get_the_excerpt(); ?>
                    </div><!--excerpt-->

                    <!--read more-->
                    <div class="cactus-readmore">
                        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','cactus'); ?></a>
                    </div><!--read more-->

                    <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                </div>
            <?php else:?>
                <!--info-->
                 <?php echo $info;?>
                <!--info -->
            <?php endif;?>

        </div>

        <!-- begin related post -->
        <?php
		
            if($show_related_posts != 'no'):
        ?>
            <?php
                if($has_featured_post_class == '' && $has_featured_post_full_class == '' && ($blog_layout == 'layout_1' || $blog_layout == 'layout_2')):

                    $get_related_post_by    = ot_get_option('archives_get_related_post_by', 'cat');
                    $get_related_order_by   = ot_get_option('archives_related_posts_order_by', 'date');

                    $related_post_limit     = $blog_layout == 'layout_1' ? 1 : 2;
                    $enable_yarpp_plugin    = ot_get_option('enable_yarpp_plugin_archives', 'off');
                    $related_posts          = cactus_get_related_posts(array('post_ID' => $post->ID, 'related_post_limit' => $related_post_limit, 'get_related_order_by' => $get_related_order_by, 'get_related_post_by' => $get_related_post_by, 'enable_yarpp_plugin' => $enable_yarpp_plugin));
                    ?>

                    <?php if(count($related_posts) > 0):?>

                    <!-- open tag for related post layout 2 -->
                    <?php if($blog_layout == 'layout_2'):?>
                        <div class="related-post">
                    <?php endif;?>

                    <?php foreach($related_posts as $related_post):
                                ?>
                            <?php if($blog_layout == 'layout_1'):?>
                                <!--related post layout 1 (remove) -->
                                <div class="cactus-related-post">
                                    <?php if(has_post_thumbnail($related_post->ID)):?>
                                        <div class="picture">
                                            <div class="picture-content">
                                                <a href="<?php echo get_the_permalink($related_post->ID);?>" title="<?php the_title_attribute(array('post' => $related_post->ID));?>">
                                                    <?php echo cactus_thumbnail($related_post->ID, 'thumb_188x144');?>
                                                    <div class="thumb-overlay"></div>
                                                </a>
                                                <?php echo tm_post_rating($related_post->ID);?>
                                            </div>
                                        </div>
                                    <?php endif;?>

                                    <!--Title (remove)-->
                                    <h4 class="h6 cactus-post-title entry-title">
                                        <a href="<?php echo get_the_permalink($related_post->ID);?>" title="<?php the_title_attribute(array('post' => $related_post->ID));?>"><?php echo get_the_title($related_post->ID);?></a>
                                    </h4><!--Title-->

                                    <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                                </div>
                                <!--related post-->
                            <?php elseif($blog_layout == 'layout_2'):?>
                                    <!--item listing-->
                                    <div class="cactus-post-item hentry">

                                        <!--content-->
                                        <div class="entry-content">
                                            <?php $has_no_picture_related_post_class = !has_post_thumbnail($related_post->ID) ? 'no-picture' : '';?>
                                            <div class="primary-post-content <?php echo $has_no_picture_related_post_class;?>"> <!--addClass: related-post, no-picture -->

                                                <?php if(has_post_thumbnail($related_post->ID)):?>
                                                    <!--picture-->
                                                    <div class="picture">
                                                        <div class="picture-content">
                                                            <a href="<?php echo get_the_permalink($related_post->ID);?>" title="<?php the_title_attribute(array('post' => $related_post->ID));?>">
                                                                <?php echo cactus_thumbnail($related_post->ID, 'thumb_103x68');?>
                                                                <div class="thumb-overlay"></div>
                                                            </a>
                                                            <?php echo tm_post_rating($related_post->ID);?>
                                                        </div>

                                                    </div>
                                                    <!--picture-->
                                                <?php endif;?>

                                                <div class="content">

                                                    <!--Title-->
                                                    <h4 class="h6 cactus-post-title entry-title">
                                                        <a href="<?php echo get_the_permalink($related_post->ID); ?>" title="<?php the_title_attribute(array('post' => $related_post->ID)); ?>" rel="bookmark"><?php echo get_the_title($related_post->ID); ?></a>
                                                    </h4>
                                                    <!--Title-->

                                                    <!--info-->
                                                    <div class="posted-on">
                                                        <?php echo cactus_get_datetime($related_post->ID);?>
                                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $related_post->post_author ) ) ) ?>" class="author cactus-info"><?php echo esc_html( get_the_author_meta('display_name', $related_post->post_author) ); ?></a>
                                                        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                                                        <?php comments_popup_link('0', '1','%', 'comment cactus-info'); ?>
                                                        <?php endif; ?>
                                                        <?php if(function_exists('GetWtiLikeCount')):?>
                                                            <div class="like cactus-info"><?php echo GetWtiLikeCount($related_post->ID);?></div>
                                                        <?php endif;?>
                                                        <?php if(function_exists('GetWtiUnlikeCount')):?>
                                                            <div class="dislike cactus-info"><?php echo GetWtiUnlikeCount($related_post->ID);?></div>
                                                        <?php endif;?>

                                                        <?php if(function_exists('bawpvc_main') || function_exists('get_tptn_post_count_only')):?>
                                                            <div class="view cactus-info"><?php echo get_formatted_string_number(cactus_get_post_view($related_post->ID));?></div>
                                                        <?php endif;?>
                                                    </div><!--info-->

                                                    <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                                                </div>
                                            </div>

                                        </div><!--content-->

                                    </div>
                                    <!--item listing-->
                            <?php endif;?>

                        <?php endforeach;?>

                        <!-- end tag for related post layout 2 -->
                        <?php if($blog_layout == 'layout_2'):?>
                            </div>
                        <?php endif;?>

                    <?php endif;?>

            <?php endif;?>
        <?php endif;?>
        <!-- end related post -->

    </div><!--content-->

</article>
