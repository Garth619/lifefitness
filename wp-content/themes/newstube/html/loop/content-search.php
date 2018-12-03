

<!--item listing-->
<div class="cactus-post-item hentry">

    <!--content-->
    <div class="entry-content">
        <div class="primary-post-content"> <!--addClass: related-post, no-picture -->

            <div class="content">

                <!--Title-->
                <h3 class="h4 cactus-post-title entry-title">
                    <a href="<?php echo esc_url(get_permalink());?>" title="<?php the_title_attribute(); ?>"><?php echo the_title();?></a>
                </h3><!--Title-->

                <!--info-->
                <div class="posted-on">
                    <?php echo cactus_get_datetime();?>
        			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" class="author cactus-info"><?php echo esc_html( get_the_author() );?></a>
                        <?php if(function_exists('bawpvc_main') || function_exists('get_tptn_post_count_only')){?>
                        <div class="view cactus-info"><?php echo get_formatted_string_number(cactus_get_post_view());?></div>
                        <?php }?>
                </div><!--info-->

                <!--excerpt-->
                <div class="excerpt">
                <?php the_excerpt(); ?>
                </div><!--excerpt-->

                <!--read more-->
                <div class="cactus-readmore">
                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','cactus'); ?></a>
                </div><!--read more-->

                <div class="cactus-last-child"></div> <!--fix pixel no remove-->
            </div>
        </div>

    </div><!--content-->

</div><!--item listing-->

                            
                        
