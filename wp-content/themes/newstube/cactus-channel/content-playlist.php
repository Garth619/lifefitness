<!--item listing-->
          <div class="cactus-post-item hentry">
              
              <!--content-->
              <div class="entry-content">
                  <div class="primary-post-content"> <!--addClass: related-post, no-picture -->
                                                  
                      <!--picture-->
                      <div class="picture">
                          <div class="picture-content">
                          <?php 
						  $cr_id = get_the_ID();
								  $args = array(
									'post_type' => 'post',
									'posts_per_page' => -1,
									'post_status' => 'publish',
									'ignore_sticky_posts' => 1,
									'meta_query' => array(
										array(
											'key' => 'playlist_id',
											 'value' => get_the_ID(),
											 'compare' => 'LIKE',
										),
									)
								);
								$the_query = new WP_Query( $args );
								$it = $the_query->post_count;
								$thumb_first ='';
								$post_thubm = get_posts($args);
								foreach ( $post_thubm as $post ):
									$thumb_first =  cactus_thumbnail( $post->ID, 'thumb_390x215' );
									break;
								endforeach; 
								wp_reset_postdata();
							  ?> 
                              <a href="<?php echo get_the_permalink($cr_id);?>" title="<?php echo esc_attr(get_the_title($cr_id));?>">
                                  <?php
								  if(has_post_thumbnail()){
								   	echo cactus_thumbnail( 'thumb_390x215' ); 
								  }else{
									  echo $thumb_first;
								  }
								  ?>
                                  <div class="thumb-overlay"></div>
                                  <i class="fa fa-play-circle-o cactus-icon-fix"></i>
                              </a>                                   
                          </div>                          
                      </div><!--picture-->
                      
                      <div class="content">
                          
                          <!--Title-->
                          <h3 class="h4 cactus-post-title entry-title"> 
                              <a href="<?php echo get_the_permalink($cr_id);?>" title="<?php echo esc_attr(get_the_title($cr_id));?>"><?php echo esc_attr(get_the_title($cr_id));?></a> 
                          </h3><!--Title-->
                          
                          <!--info-->
                          <div class="posted-on">
                              <?php echo cactus_get_datetime();?>
                              <div class="videos cactus-info"><?php echo $it; esc_html_e(' VIDEOS','cactus'); ?></div>                                              			
                          </div><!--info-->
                          
                          <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                      </div>
                  </div>
                  
              </div><!--content-->
              
          </div><!--item listing-->
