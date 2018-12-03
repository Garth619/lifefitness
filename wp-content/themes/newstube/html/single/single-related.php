<?php
/**
 * The Template for displaying all related posts by Category & tag.
 *
 * @package cactus
 */
?>
<?php

	$show_related_post = ot_get_option('show_related_post');

	if($show_related_post == 'off') return;

    $get_related_post_by    = ot_get_option('get_related_post_by', 'cat');
    $get_related_order_by   = ot_get_option('related_posts_order_by', 'date');

    $related_post_limit     = ot_get_option('related_posts_count', 3);
    $enable_yarpp_plugin    = ot_get_option('enable_yarpp_plugin_single_post', 'off');
    $related_posts          = cactus_get_related_posts(array('post_ID' => $post->ID, 'related_post_limit' => $related_post_limit, 'get_related_order_by' => $get_related_order_by, 'get_related_post_by' => $get_related_post_by, 'enable_yarpp_plugin' => $enable_yarpp_plugin));


	if(count($related_posts) == 0) return;

?>
        <!--related post-->
    <div class="cactus-related-posts">
        <div class="title-related-post">
            <?php echo esc_html__('Related Posts','cactus');?>
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
                                            <?php
											foreach ( $related_posts as $related_post) : //$related_items->the_post();
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
                                                                    <a href="<?php echo get_the_permalink($related_post->ID);?>" title="<?php the_title_attribute(array('post' => $related_post->ID));?>">
                                                                        <?php if(has_post_thumbnail($related_post->ID)){
																			echo cactus_thumbnail($related_post->ID, 'thumb_253x189', array('alt' => get_the_title($related_post->ID)));
																		}?>
                                                                        <div class="thumb-overlay"></div>
                                                                        <?php if(get_post_format($related_post->ID)=='video'){?>
                                                                        	<i class="fa fa-play-circle-o cactus-icon-fix"></i>
                                                                        <?php }elseif(get_post_format($related_post->ID)=='audio'){?>
                                                                        	<i class="fa fa-music cactus-icon-fix"></i>
                                                                        <?php }elseif(get_post_format($related_post->ID)=='gallery'){?>
                                                                        	<i class="fa fa-file-image-o cactus-icon-fix"></i>
                                                                        <?php }elseif(get_post_format($related_post->ID)=='image'){?>
                                                                        	<i class="fa fa-camera cactus-icon-fix"></i>
                                                                        <?php }?>
                                                                    </a>
                                                                </div>

                                                            </div><!--picture-->

                                                            <div class="content">

                                                                <!--Title-->
                                                                <h3 class="h6 cactus-post-title entry-title">
                                                                    <a href="<?php echo get_the_permalink($related_post->ID);?>" title="<?php the_title_attribute(array('post' => $related_post->ID));?>"><?php echo get_the_title($related_post->ID); ?></a>
                                                                </h3><!--Title-->

                                                                <!--info-->
                                                                <div class="posted-on">
                                                                    <?php echo cactus_get_datetime($related_post->ID);?>
                                                                    <span class="vcard author"> 
                                                                        <span class="fn"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID', $related_post->post_author) ) ); ?>" class="author cactus-info"><?php echo get_userdata($related_post->post_author)->display_name ;?></a></span>
                                                                    </span>
                                                                    <a href="<?php comments_link(); ?>" class="comment cactus-info"><?php echo get_comments_number($related_post->ID);?></a>

                                                                </div><!--info-->


                                                                <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                                                            </div>
                                                        </div>

                                                    </div><!--content-->

                                                </div><!--item listing-->
                                            </div>
                                            <?php
											endforeach;
											?>
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
    <!--related post-->
<?php
    wp_reset_postdata();
