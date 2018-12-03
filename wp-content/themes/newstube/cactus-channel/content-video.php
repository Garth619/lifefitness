        <!--item listing-->
        <div class="cactus-post-item hentry">
            
            <!--content-->
            <div class="entry-content">
                <div class="primary-post-content"> <!--addClass: related-post, no-picture -->
                             
                    <?php if(has_post_thumbnail()): ?>                            
                        <!--picture-->
                        <div class="picture">
                            <div class="picture-content">
                                <a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>">
                                    <?php echo cactus_thumbnail( 'thumb_390x215' ); ?>
                                    <div class="thumb-overlay"></div>
                                    <?php if(get_post_format()=='video'){?>
                                        <i class="fa fa-play-circle-o cactus-icon-fix"></i>
                                    <?php }elseif(get_post_format()=='audio'){?>
                                        <i class="fa fa-music cactus-icon-fix"></i>
                                    <?php }elseif(get_post_format()=='gallery'){?>
                                        <i class="fa fa-file-image-o cactus-icon-fix"></i>
                                    <?php }elseif(get_post_format()=='image'){?>
                                        <i class="fa fa-camera cactus-icon-fix"></i>
                                    <?php }?>
                                </a>                                          
                                <?php echo tm_post_rating(get_the_ID());?>
                                <div class="cactus-note-time"><?php echo get_post_meta(get_the_id(),'time_video',true) ?></div>
                            </div>
                            
                        </div><!--picture-->
                    <?php endif ?>
                    
                    <div class="content">
                        
                        <!--Title-->
                        <h3 class="h4 cactus-post-title entry-title"> 
                            <a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>"><?php echo esc_attr(get_the_title(get_the_ID()));?></a> 
                        </h3><!--Title-->
                        
                        <!--info-->
                        <div class="posted-on">
                            <?php echo cactus_get_datetime();?>
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>" class="author cactus-info"><?php the_author_meta( 'display_name' ); ?></a>
                            <a href="<?php comments_link(); ?>" class="comment cactus-info"><?php echo get_comments_number(get_the_ID());?></a>
                            <?php
							if(function_exists('GetWtiLikePost')){ 
								$like = $unlike = '';
								if(function_exists('GetWtiLikeCount')){$like = GetWtiLikeCount(get_the_ID());}
								if(function_exists('GetWtiUnlikeCount')){$unlike = GetWtiUnlikeCount(get_the_ID());}
								?>
								<div class="like cactus-info"><?php echo $like ?></div>
								<div class="dislike cactus-info"><?php echo $unlike ?></div>
								<?php
							}?>
                            <?php if(function_exists('bawpvc_main') || function_exists('get_tptn_post_count_only')){?>
                            <div class="view cactus-info"><?php echo  get_formatted_string_number(cactus_get_post_view(get_the_ID())); ?></div>
                            <?php }?>
                        </div><!--info-->
                        
                        <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                    </div>
                </div>
                
            </div><!--content-->
            
        </div><!--item listing-->
