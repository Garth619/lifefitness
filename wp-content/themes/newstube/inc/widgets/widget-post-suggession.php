<?php
class CT_Suggession extends WP_Widget {



	function __construct() {
    	$widget_ops = array(
			'classname'   => 'ct_post_suggession', 
			'description' => esc_html__('Suggest a related post when user read to the end of the post','cactus')
		);
    	parent::__construct('post_suggession', esc_html__('NewsTube - Post Suggestion','cactus'), $widget_ops);
	}

	/**
	 * This is the part where the heart of this widget is!
	 * here we get al the authors and count their posts. 
	 *
	 * The frontend function
	 */
	function widget( $args, $instance ) {
		extract( $args );
		
		$title 			= empty($instance['title']) ? __('you may like','cactus') : $instance['title'];	
		$suggest_post_in 		= empty($instance['suggest_post_in']) ? '' : $instance['suggest_post_in'];
		$suggest_post_order 		= empty($instance['suggest_post_order']) ? '' : $instance['suggest_post_order'];
		/*content*/
		global $post;
		if($post) {
			$post_id = $post->ID;
		}
		$args = array(
		  	'post_status' => 'publish',
		  	'posts_per_page' => 1,
		  	'orderby' => $suggest_post_order,
		  	'ignore_sticky_posts' => 1,
			'post__not_in' => array ($post_id)
		);
		if ($suggest_post_in == 'cat') {
			$categories = wp_get_post_categories($post_id);

			$args['category__in'] = $categories;
		} else {
			$posttags = wp_get_post_tags($post_id);
			$array_tags = array();
			if ($posttags) {
				foreach($posttags as $tag) {
					$tags = $tag->term_id ;
					array_push ( $array_tags, $tags);
				}
			}

			$args['tag__in'] = $array_tags;
		}

		$sugg_items = new WP_Query( $args );
		if($sugg_items->have_posts() && is_single()){
			while($sugg_items->have_posts()){$sugg_items->the_post();
				?>
				<div class="cactus-post-suggestion">
					<div class="post-suggestion-content">
						<div class="suggestion-header"><span><i class="fa fa-times"></i> <i class="fa fa-plus-square"></i></span> <?php echo esc_attr($title);?></div>
						<div class="suggestion-post">
							<!--Listing-->
							<div class="cactus-listing-wrap">
								<!--Config-->        
								<div class="cactus-listing-config style-1 style-3"> <!--addClass: style-1 + (style-2 -> style-n)-->
								
									<div class="cactus-listing-content"> <!--ajax div-->
									
										<div class="cactus-sub-wrap">
											
											<!--item listing-->
											<div class="cactus-post-item hentry">                                            
												<!--content-->
												<div class="entry-content">
													<div class="primary-post-content"> <!--addClass: related-post, no-picture -->
																					
														<!--picture-->
                                                        <?php if(has_post_thumbnail()){?>
                                                            <div class="picture">                                                        	
                                                                <div class="picture-content">
                                                                    <a href="<?php echo get_permalink(get_the_ID());?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>">
                                                                         <?php echo cactus_thumbnail( 'thumb_253x189' ); ?> 
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
                                                                    <?php show_cat($show_once = 1) ?>
                                                                    <?php echo tm_post_rating(get_the_ID());?>
                                                                </div>                                                            
                                                            </div><!--picture-->
                                                        <?php }?>
														
														<div class="content">
															
															<!--Title-->
															<h3 class="h6 cactus-post-title entry-title"> 
																<a href="<?php echo get_permalink(get_the_ID());?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>"><?php echo esc_attr(get_the_title(get_the_ID()));?></a> 
															</h3><!--Title-->
															
															<!--info-->
															<div class="posted-on">
																<?php echo cactus_get_datetime();?>
																<span class="vcard author"> 
																    <span class="fn"><?php the_author_posts_link(); ?></span>
																</span>
																<div class="comment cactus-info"><?php echo get_comments_number(get_the_ID());?></div>
														  
															</div><!--info-->
															
															<div class="cactus-last-child"></div> <!--fix pixel no remove-->
														</div>
													</div>
													
												</div><!--content-->
												
											</div><!--item listing-->
										</div>                                        
									</div>
									
								</div><!--Config-->
							</div><!--Listing-->                        
						</div>
					</div>
				  </div>
				<?php }
		}
		wp_reset_postdata();
	}

	/**
	 * Update the widget settings.
	 *
	 * Backend widget settings
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['suggest_post_in'] = esc_attr($new_instance['suggest_post_in']);
		$instance['suggest_post_order'] = esc_attr($new_instance['suggest_post_order']);
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 *
	 * Backend widget options form
	 */
	function form( $instance ) {						
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = isset($instance['title']) ? esc_attr( $instance['title'] ): '';
		$suggest_post_in = isset($instance['suggest_post_in']) ? esc_attr($instance['suggest_post_in']) : '';
		$suggest_post_order = isset($instance['suggest_post_order']) ? esc_attr($instance['suggest_post_order']) : '';
		?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:','cactus' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id("suggest_post_in"); ?>">
        <?php esc_html_e('Suggest post in','cactus');	 ?>:
            <select id="<?php echo $this->get_field_id("suggest_post_in"); ?>" name="<?php echo $this->get_field_name("suggest_post_in"); ?>">
              <option value="cat"<?php selected( $suggest_post_in, "cat" ); ?>><?php esc_html_e('Same Categories','cactus'); ?></option>
              <option value="tag"<?php selected( $suggest_post_in, "tag" ); ?>><?php esc_html_e('Same Tags','cactus'); ?></option>
            </select>
        </label>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id("suggest_post_order"); ?>">
        <?php esc_html_e('Suggested post order','cactus');	 ?>:
            <select id="<?php echo $this->get_field_id("suggest_post_order"); ?>" name="<?php echo $this->get_field_name("suggest_post_order"); ?>">
              <option value="latest"<?php selected( $suggest_post_order, "latest" ); ?>><?php esc_html_e('Latest','cactus'); ?></option>
              <option value="rand"<?php selected( $suggest_post_order, "rand" ); ?>><?php esc_html_e('Random','cactus'); ?></option>
            </select>
        </label>
        </p>
		
	<?php
	}
}




// register  widget
add_action( 'widgets_init', create_function( '', 'return register_widget("CT_Suggession");' ) );
?>
