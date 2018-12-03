          <div class="cactus-listing-heading fix-channel">
              <div class="navi-channel">
                  <div class="channel-name-wrap pull-left">
                  	  <?php  if(has_post_thumbnail()){ ?>
                      <div class="channel-picture">
                          <?php
                              echo cactus_thumbnail(get_the_ID(), 'thumb_40x40', array('alt' => get_the_title()));
                         ?>
                      </div>
                      <?php };?>
                      <h3><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
                  </div>
                                                          
                  <div class="subs pull-right">                                            	
                      
                      
                      <?php 
                      if(function_exists('cactus_subcribe_button')){
                          cactus_subcribe_button();
                      }
                      ?>                                             
                      
                  </div>
                  
              </div>
          </div>
          <?php 
		  $subscreibed_item_page ='';
		  if(function_exists('osp_get')){
		  	$subscreibed_item_page = osp_get('ct_channel_settings','subscreibed_item_page');
		  }
		  if($subscreibed_item_page ==''){$subscreibed_item_page = 3;}
          $args = array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'ignore_sticky_posts' => 1,
              'posts_per_page' => $subscreibed_item_page,
              'orderby' => 'latest',
              'meta_query' => array(
                  array(
                      'key' => 'channel_id',
                       'value' => get_the_ID(),
                       'compare' => 'LIKE',
                  ),
              )
          );
          ?>
          <div class="cactus-sub-wrap">
          <?php
          $list_query = new WP_Query( $args );
          $it = $list_query->post_count;
          if($list_query->have_posts()){
              while($list_query->have_posts()){$list_query->the_post(); ?>
                  <!--item listing-->
                  <div class="cactus-post-item hentry">
                      
                      <!--content-->
                      <div class="entry-content">
                          <div class="primary-post-content"> <!--addClass: related-post, no-picture -->
                              
                              <?php  if(has_post_thumbnail()){ ?>                            
                              <!--picture-->
                              <div class="picture">                              	  
                                  <div class="picture-content">
                                      <a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>">
                                          <?php echo cactus_thumbnail( 'thumb_367x200' ); ?>
                                          <div class="thumb-overlay"></div>
                                      </a>                                        
                                      <?php echo tm_post_rating(get_the_ID());?>
                                      <div class="cactus-note-time"><?php echo get_post_meta(get_the_id(),'time_video',true) ?></div>
                                  </div>
                                  
                              </div><!--picture-->
                              <?php };?>
                              
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
              <?php }
              wp_reset_postdata();
          }?>
          </div><!--End listing-->
