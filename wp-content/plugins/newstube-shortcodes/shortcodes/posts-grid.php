<?php 
function cactus_post_grid($atts, $content = null) {
	
	$layout 			= isset($atts['layout']) ? $atts['layout'] : '1';	
	$count					= isset($atts['count']) ? $atts['count'] : '12';
	$condition 					= isset($atts['condition']) ? $atts['condition'] : '';
	$order 					= isset($atts['order']) ? $atts['order'] : 'DESC';
	$cats 			= isset($atts['cats']) ? $atts['cats'] : '';
	$tags 					= isset($atts['tags']) ? $atts['tags'] : '';
	$featured 			= isset($atts['featured']) ? $atts['featured'] : '';
	$ids 			= isset($atts['ids']) ? $atts['ids'] : '';	
		
	$speed 			= isset($atts['speed']) ? $atts['speed'] : '';	
	ob_start();
	
	$page='';
	if($condition == 'tags' && $tags != '')
	{
		$tags_arr = explode(',', $tags);
		$first_query = true;
		foreach($tags_arr as $t_arr)
		{
			if($first_query)
			{
				$the_query = smartcontentbox_query($count,$condition,$order,$cats,trim($t_arr),$featured,$ids,$page);
				$new_count = $count - $the_query->post_count;
				$first_query = false;
			}
			else
			{
				if($new_count !=0)
				{
					$the_query1 = smartcontentbox_query($new_count,$condition,$order,$cats,trim($t_arr),$featured,$ids,$page);
					$new_count = $new_count - $the_query1->post_count;
					for($i=0; $i<$the_query1->post_count ; $i++)
					{
						array_push($the_query->posts, $the_query1->posts[$i]);
					}
				}
			}
		}
		$the_query->post_count = count($the_query->posts);
		$num_it = count($the_query->posts);
	}
	else
	{
		$the_query = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page);	
		$num_it = $the_query->post_count;
	}
	?>
	<?php
    if($the_query->have_posts()){?>
    <div class="cactus-slider cactus-slider-wrap slidesPerView style-<?php echo $layout;?>" data-auto-play="<?php if(is_numeric($speed)){ echo $speed;}?>">
        <div class="cactus-slider-content">
            <div class="fix-slider-wrap"> <a href="javascript:;" class="cactus-slider-btn-prev"><i class="fa fa-angle-left"></i></a> <a href="javascript:;" class="cactus-slider-btn-next"><i class="fa fa-angle-right"></i></a>
              <div class="cactus-swiper-container" data-settings='["mode":"cactus-fix-composer"]' data-per-view="2">
                <div class="swiper-wrapper">
    			<?php
				$it_pg =0;
				$thum_size ='';
                while($the_query->have_posts()){ $the_query->the_post();
				$it_pg++;
				if($layout=='1' && $it_pg%3==1){
					$cl ='width-50percent';
					$thum_size = 'thumb_566x377';
				}elseif($layout=='1'){
					$cl ='width-25percent';
					$thum_size = 'thumb_279x184';
				}
				if($layout=='2' && ($it_pg%10==3 || $it_pg%10==8)){
					$cl ='width-50percent';
					$thum_size = 'thumb_566x377';
				}elseif($layout=='2'){
					$cl ='width-25percent';
					$thum_size = 'thumb_279x184';
				}
				if($layout=='3' && ($it_pg%10==1 || $it_pg%10==6)){
					$cl ='width-50percent';
					$thum_size = 'thumb_566x377';
				}elseif($layout=='3'){
					$cl ='width-25percent';
					$thum_size = 'thumb_279x184';
				}
                
                $post_format = get_post_format();
				?>
                    <?php if($layout =='1' && ($it_pg%3==2 || $it_pg%3==1)){ ?>
                    <div class="swiper-slide">
                    <div class="<?php echo $cl;?>">
                    <?php 
					}else if($layout == '2' && ($it_pg%10==1 || $it_pg%10==3 || $it_pg%10==4 || $it_pg%10==6 || $it_pg%10==8 || $it_pg%10==9)){
					?>
                    <div class="swiper-slide">
                    <div class="<?php echo $cl;?>">
                    <?php }else if($layout =='3' && ($it_pg%10==1 || $it_pg%10==2 || $it_pg%10==4 || $it_pg%10==6 || $it_pg%10==7 || $it_pg%10==9)){?>
                    <div class="swiper-slide">
                    <div class="<?php echo $cl;?>">
                    <?php }?>
                    
                      <div class="slide-post-item <?php echo 'format-' . $post_format;?>">
                        <?php ob_start();?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
                            <?php echo cactus_thumbnail($thum_size); ?> 
                            <?php if($post_format == 'video'){?>
                            <i class="fa fa-play-circle-o cactus-icon-fix"></i>
                            <?php }?>
                        </a>
                         <?php 
						$category = get_the_category();

						if(!empty($category)){ ?>
							<?php echo cactus_get_category($category);?>
						<?php } ?>     
                        <?php echo tm_post_rating(get_the_ID());?>
                        <h3 class="h6 cactus-slider-post-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>  </h3>
                        <?php
                            $item_thumbnail = ob_get_contents();
                            ob_end_clean();
                            echo apply_filters('newstube_item_thumbnail_filter', $item_thumbnail, 'posts-grid-' . $layout, array('index'=>$it_pg));
                        ?>
                      </div>
                    <?php if($layout=='1' && ($it_pg%3==0 || $it_pg%3==1 || $it_pg==$num_it)){?>
                    </div>
                    </div>
                    <?php } else if($layout=='2' && ($it_pg%10==2 || $it_pg%10==3 || $it_pg%10==5 || $it_pg%10==7 || $it_pg%10==8 || $it_pg%10==0  || $it_pg==$num_it)){ ?>
                    </div>
                    </div>
                    <?php 
						} else if($layout=='3' && ($it_pg%10==1 || $it_pg%10==3 ||  $it_pg%10==5 ||  $it_pg%10==6  ||  $it_pg%10==8 ||  $it_pg%10==0 || $it_pg==$num_it)){
						?>
                    </div>
                    </div>
                    <?php }?>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php
	wp_reset_postdata();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('xgrid', 'cactus_post_grid');
//Register Visual composer
add_action( 'after_setup_theme', 'reg_ctpost_grid', 100 );
function reg_ctpost_grid(){
	if(function_exists('vc_map')){
	vc_map( array(
		"name"		=> esc_html__("NewsTube Posts Grid", "cactus"),
		"base"		=> "xgrid",
		"class"		=> "wpb_vc_posts_slider_widget",
		"icon"		=> "icon-post-grid",
		"category"  => esc_html__('Content', 'cactus'),
		"params"	=> array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => esc_html__("Layout", "cactus"),
				"param_name" => "layout",
				"value" => array(
					esc_html__("Layout 1","cactus")=>'1',
					esc_html__("Layout 2","cactus")=>'2',
					esc_html__("Layout 3","cactus")=>'3',
				),
				"description" => esc_html__("choose box layout. Possible values:", "cactus")
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Count", "cactus"),
				"param_name" => "count",
				"value" => "",
				"description" => esc_html__('number of items to query', "cactus")
			),	
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => esc_html__("Condition", "cactus"),
				"param_name" => "condition",
				"value" => array(
				esc_html__("Latest","cactus")=>'latest', 
				esc_html__("Most viewed","cactus")=>'view', 
				esc_html__("Most Liked","cactus")=>'like', 
				esc_html__("Most commented","cactus")=>'comment',
				esc_html__("Title", "cactus") => "title", 
				esc_html__("Input(only available when using ids parameter)", "cactus") => "input", 
				esc_html__("Random", "cactus") => "random",
				esc_html__("Tags (only available when using tags parameter)", "cactus") => "tags",
				), 
				"description" => esc_html__("condition to query items", "cactus")
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Order", "cactus"),
				"param_name" => "order",
				"value" => array( 
				esc_html__("Descending", "cactus") => "DESC", 
				esc_html__("Ascending", "cactus") => "ASC" ),
				"description" => esc_html__('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'cactus')
			),

			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Categories", "cactus"),
			  "param_name" => "cats",
			  "description" => esc_html__("list of categories (ID) to query items from, separated by a comma.", "cactus")
			),
	
			array(
				"type" => "textfield",
				"heading" => esc_html__("Tags", "cactus"),
				"param_name" => "tags",
				"value" => "",
				"description" => esc_html__('list of tags to query items from, separated by a comma. For example: tag-1, tag-2, tag-3', "cactus")
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Featured", "cactus"),
				"param_name" => "featured",
				"value" => array( 
				esc_html__("No", "cactus") => "0",
				esc_html__("Yes", "cactus") => "1"), 
				"description" => esc_html__('choose yes to only query featured posts', 'cactus')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("IDs", "cactus"),
				"param_name" => "ids",
				"value" => "",
				"description" => esc_html__('list of post IDs to query, separated by a comma. If this value is not empty, cats, tags and featured are omitted', "cactus")
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Speed", "cactus"),
				"param_name" => "speed",
				"value" => "",
				"description" => esc_html__('number (milliseconds) - speed of animation effect in milliseconds. Leave empty or 0 if autoplay is disabled', "cactus")
			),	
		)
	) );
	}
}
