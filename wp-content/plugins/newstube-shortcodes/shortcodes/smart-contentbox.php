<?php 
function cactus_smart_contentbox($atts, $content = null) {

    $output_id                  = isset($atts['id']) && $atts['id'] != '' ? ' id= "' . $atts['id'] . '"' : '';
    $title          = isset($atts['title']) ? $atts['title'] : '';  
	$title_link 	= isset($atts['title_link']) ? $atts['title_link'] : '';	
    // $title_url      = $title_link != ''  ? 'href="' . esc_url($title_link) . '"' : '';
	$layout 			= isset($atts['layout']) ? $atts['layout'] : '1';	
	$count					= isset($atts['number']) ? $atts['number'] : '20';
	$offset					= isset($atts['offset']) ? $atts['offset'] : '';
	
	$condition 					= isset($atts['condition']) ? $atts['condition'] : 'latest';
	$order 					= isset($atts['order']) ? $atts['order'] : 'DESC';
	$cats 			= isset($atts['cats']) ? $atts['cats'] : '';
	$tags 					= isset($atts['tags']) ? $atts['tags'] : '';
	$featured 			= isset($atts['featured']) ? $atts['featured'] : '';
	$ids 			= isset($atts['ids']) ? $atts['ids'] : '';	
		
	$items_per_page 			= isset($atts['items_per_page']) && $atts['items_per_page'] != '' ? $atts['items_per_page'] : '4';	
	$enable_cat_filter 				= isset($atts['enable_cat_filter']) ? $atts['enable_cat_filter'] : '0';
    $show_meta          = isset($atts['show_meta']) ? $atts['show_meta'] : '1';
	$show_category_tag 			= isset($atts['show_category_tag']) ? $atts['show_category_tag'] : '1';
	$show_datetime 			= isset($atts['show_datetime']) ? $atts['show_datetime'] : '1';
	$show_author 			= isset($atts['show_author']) ? $atts['show_author'] : '1';
	$show_comment_count 			= isset($atts['show_comment_count']) ? $atts['show_comment_count'] : '1';
	$show_like 			= isset($atts['show_like']) ? $atts['show_like'] : '1';
	$show_dislike 			= isset($atts['show_dislike']) ? $atts['show_dislike'] : '1';
	$show_view 			= isset($atts['show_view']) ? $atts['show_view'] : '1';
	$big_thumbnail 			= isset($atts['big_thumbnail']) ? $atts['big_thumbnail'] : '';
	
	$heading_color 					= isset($atts['heading_color']) ? $atts['heading_color'] : '';
	$heading_bg 			= isset($atts['heading_bg']) ? $atts['heading_bg'] : '';	
    $sub_class_tab          = isset($atts['sub_class_tab']) && $atts['sub_class_tab'] != '' ? $atts['sub_class_tab'] : '';
	ob_start();
	if(($items_per_page > $count) && $count!='-1'){ $items_per_page = $count;}
	$page='1';
	$scats = $cats;
	$filter_text = 'no';
	$scat_ar='';
	if($enable_cat_filter=='1' && $cats!=''){
		$scat_ar = array_filter(explode(",",$cats));
		$scats = $scat_ar[0];
		$filter_text = 'yes';
	}
	$the_query = smartcontentbox_query($items_per_page,$condition,$order,$scats,$tags,$featured,$ids,$page,$offset);
	$num_it = $the_query->found_posts;
	if(($count > $num_it)){$count = $num_it;}
	$cats = str_replace(',',' ',$cats);
	$tags = str_replace(',',' ',$tags);
	$ids = str_replace(',',' ',$ids);
	$style ='';

    if($title_link != '')
    {
        $title = '<a href="' . esc_url($title_link) . '">' . $title . '</a>';
    }

	if($count<= $items_per_page || $num_it <= $items_per_page ){ $style =' style="display: none" ';}
	
	$class_improve = '';
	if(($count<= $items_per_page || $num_it <= $items_per_page) && ((is_array($scat_ar) && count($scat_ar)<2) || $filter_text=='no')){ $class_improve =' one-page-no-filter';}
	$tt_page = ceil($count/$items_per_page);
	$it_pp_ep = $count%$items_per_page;
	
	$show_excerpt = "no";
	$show_content = "no";
	$show_read_more = "no";
	$show_sub_abs_post = "no";
	?>
    
    <div <?php echo $output_id;?> class="cactus-scb <?php echo $sub_class_tab.$class_improve;?> <?php if($show_datetime==0){echo ' hidden-datetime ';}?> <?php if($show_author==0){echo ' hidden-author ';}?> <?php if($show_comment_count==0){echo ' hidden-commentcount ';}?> <?php if($show_like==0){echo ' hidden-like ';}?> <?php if($show_dislike==0){echo ' hidden-dislike ';}?> <?php if($show_view==0){echo ' hidden-view ';}?>" data-total-records="<?php echo $count?>" data-item-in-page="<?php echo $items_per_page ?>" data-style="<?php echo $layout;?>" data-ajax-server="<?php echo home_url( 'wp-admin/admin-ajax.php' )?>" data-json-server="<?php echo home_url( 'wp-admin/admin-ajax.php' )?>" data-lang-err="Err" data-bg-color="<?php echo $heading_bg;?>" data-title-color="<?php echo $heading_color; ?>" data-shortcode="<?php echo esc_attr($items_per_page.','.$condition.','.$order.','.$cats.','.$tags.','.$featured.','.$ids.','.$enable_cat_filter.','.$show_meta.','.$count.','.$layout.','.$big_thumbnail.','.$show_category_tag).','.$tt_page.','.$it_pp_ep.','.$show_datetime.','.$show_author.','.$show_comment_count.','.$show_like.','.$show_dislike.','.$show_view.','.$offset; ?>" data-ids="">
            <h2 class="cactus-scb-title <?php if($title=='' && $style!=''){ echo 'fix-not-title';} ?>" <?php if($title==''){ echo $style;} ?>><?php echo $title; ?></h2> 
            <?php
				if((isset($heading_bg) && $heading_bg!='') || (isset($heading_color) && $heading_color!='')) {
					echo '<style type="text/css" scoped>';
					if($heading_bg!='') echo '.cactus-scb[data-bg-color="'.$heading_bg.'"] .cactus-scb-title,.cactus-scb[data-bg-color="'.$heading_bg.'"] .cactus-scb-title:before{background-color:'.$heading_bg.'}';
					if($heading_color!='') echo '.cactus-scb[data-title-color="'.$heading_color.'"] .cactus-scb-title {color:'.$heading_color.'}';
					echo '</style>';
				};
			?>           
            <a class="pre-carousel" href="javascript:;" <?php echo $style ?>><i class="fa fa-angle-left"></i></a>
            <a class="next-carousel" href="javascript:;"  <?php echo $style ?>><i class="fa fa-angle-right"></i></a>
            
            <div class="hidden-pre-carousel"></div>
            <div class="hidden-next-carousel"></div>
            
            <div class="change-page" data-enable-cat-filter="<?php echo $filter_text;?>">
                <!--remove page-->
                    <ul class="category" <?php if(is_array($scat_ar) && count($scat_ar)<2){?> style="display:none" <?php }?>>
                        <li class="current-category">
                        	<?php if(is_array($scat_ar)){?>
                            <a href="javascript:;" data-category-id="<?php echo $scat_ar[0]?>" class="current-data"><?php echo get_cat_name($scat_ar[0]);?></a> <i class="fa fa-angle-down"></i>
                            <?php }else{?>
                            <a href="javascript:;" data-category-id="all" class="current-data"></a> <i class="fa fa-angle-down"></i>
                            <?php }?>
                            <!--Change / remove enable_cat_filter="no"-->
                            <ul class="ajax-submenu">
                            	<?php 
								if(is_array($scat_ar)){
									$i='';
									foreach($scat_ar as $scats_it){
										$i++;
										if($i!=1){
										?>
										<li><a href="javascript:;" data-category-id="<?php echo $scats_it ?>" class="new-data"><?php echo get_cat_name($scats_it);?></a></li>
                                <?php }} 
								}?>
                            </ul>
                            <!--Change-->
                        </li>
                    </ul>
                <!--remove page-->
            </div>
            
            <div class="cactus-swiper-container" data-settings='["mode":"cactus-fix-composer"]'>
                <div class="swiper-wrapper">
                
                    <div class="swiper-slide"> <!--Slide item-->
                        
                        <div class="append-slide-auto" data-page="1">
				 			<?php
                            if($the_query->have_posts()){
                            ?>       
                            <!--Listing-->
                            <div class="cactus-listing-wrap">
                                <!--Config-->        
                                <div class="cactus-listing-config style-1"> <!--addClass: style-1 + (style-a -> style-f)-->
                                        
                                    <div class="cactus-listing-content">
                                    
                                        <div class="cactus-sub-wrap">
                                        <?php
										$it_c = 0;
										while($the_query->have_posts()){ $the_query->the_post();
										$it_c++;
										
										switch($layout) {
											case 1:
												if($it_c==1) {
													$show_excerpt='yes';
													$show_read_more = 'yes';
												}else{
													$show_excerpt='no';
													$show_read_more='no';
												}
												$show_content = "yes";
												break;
											case 2:
												$show_excerpt='yes';
												$show_read_more = 'yes';
												$show_content = "yes";
												break;
											case 3:
												$show_excerpt='no';
												$show_content = "no";
												$show_sub_abs_post = "yes";
												break;
											case 4:
												if($it_c==1) {
													$show_excerpt='yes';
													$show_read_more = 'yes';
												}else{
													$show_excerpt='no';
													$show_read_more = 'no';
												}
												$show_content = "yes";
												break;
											case 5:
												$show_excerpt='no';
												$show_content = "no";
												$show_sub_abs_post = "yes";
												break;
											case 6:
												if($it_c==1) {
													$show_excerpt='yes';
													$show_read_more = 'yes';
												}else{
													$show_excerpt='no';
													$show_read_more = 'no';
												}
												$show_content = "yes";
												break;
										}
										
										
										if($layout == '4' && $it_c == 2){
										?>
                                        <div class="fix-right-style-4">
                                        <?php }?>
                                        <div class="cactus-post-item hentry <?php if($items_per_page==1 && $it_c == 1 && $layout == '4'){?> no-last-post <?php }?>">
                                                    <!--content-->
                                                    <div class="entry-content">
                                                        <div class="primary-post-content"> <!--addClass: related-post, no-picture -->
                                                                                        
                                                            <!--picture-->
                                                            <?php  if ( cactus_thumbnail('full') != '' || $layout == '3' || $layout == '5') { ?>
                                                            <div class="picture">
                                                            	<?php
																	if($layout=='1'&& $it_c==1 || $layout=='4'&& $it_c==1 || $layout=='6'){
																		$thumb_sz = $big_thumbnail ? 'thumb_780x470' : 'thumb_390x235';																		
																	}else if($layout=='1'&& $it_c!=1 || $layout=='4'&& $it_c!=1){
																		$thumb_sz = $big_thumbnail?'thumb_188x144':'thumb_94x72';
																	}
																	if($layout=='2'&& $it_c==1){
																		$thumb_sz = $big_thumbnail?'thumb_1110x666':'thumb_555x333';
																	}else if($layout=='2'&& $it_c!=1){
																		$thumb_sz = $big_thumbnail?'thumb_540x330':'thumb_270x165';
																	}
																	if($layout=='3'&& $it_c==1){
																		$thumb_sz = $big_thumbnail?'thumb_1110x666':'thumb_555x333';
																	}else if($layout=='3'&& $it_c!=1){
																		$thumb_sz = $big_thumbnail?'thumb_550x420':'thumb_275x210';
																	}
																	if($layout=='5'){
																		$thumb_sz = $big_thumbnail?'thumb_760x570':'thumb_380x285';
																	}

																?>
                                                                <div class="picture-content">
                                                                    <?php ob_start();?>
                                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                                    	<?php echo cactus_thumbnail($thumb_sz); ?>
                                                                        <div class="thumb-overlay"></div>
                                                                        
                                                                        <?php 
																		$format_it = get_post_format();
																		if($format_it=='video'){?>
                                                                            <i class="fa fa-play-circle-o cactus-icon-fix"></i>
                                                                        <?php }elseif($format_it=='audio'){?>
                                                                            <i class="fa fa-music cactus-icon-fix"></i>
                                                                        <?php }elseif($format_it=='gallery'){?>
                                                                            <i class="fa fa-file-image-o cactus-icon-fix"></i>
                                                                        <?php }elseif($format_it=='image'){?>
                                                                            <i class="fa fa-camera cactus-icon-fix"></i>
                                                                        <?php }?>
                                                                        
                                                                        <?php
																		if($layout=='5' || $layout=='3'){
																			echo '<div class="thumb-gradient" style="display:block;"></div>';
																		};
                                                                        ?>
                                                                    </a>

                                                                    <?php 
                                                                        $category = get_the_category();
                                                                        $tag = '';
                                                                        if($show_category_tag == 1)
                                                                        {
                                                                            if(!empty($category)){
                                                                                $tag = cactus_get_category($category);
                                                                            }
                                                                        }
                                                                        echo apply_filters('newstube_item_category_tags', $tag);
                                                                        ?>
                                                                        <?php echo tm_post_rating(get_the_ID());?>
                                                                        <?php if($show_sub_abs_post == "yes") {?>
                                                                            <div class="content-abs-post">
                                                                                <?php 
                                                                                $tag = '';
                                                                                if($show_category_tag == 1)
                                                                                {
                                                                                    if(!empty($category)){
                                                                                        $tag = cactus_get_category($category);
                                                                                    }
                                                                                }
                                                                                echo apply_filters('newstube_item_category_tags', $tag);
                                                                                ?>
                                                                                <?php echo tm_post_rating(get_the_ID());?>                                                                                
                                                                                <h3 class="h4 cactus-post-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                                                                            </div> 
                                                                         <?php }?> 
                                                                    <?php
                                                                    $item_thumbnail = ob_get_contents();
                                                                    ob_end_clean();
                                                                    echo apply_filters('newstube_item_thumbnail_filter', $item_thumbnail, 'scb-layout-' . $layout, array('index'=>$it_c));
                                                                    ?>
                                                                </div>                                                                
                                                            </div>
                                                            <?php }?>
                                                            
                                                            <?php if($show_content=='yes'){?>
                                                                <div class="content">
                                                                    <h3 class="h4 cactus-post-title entry-title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                                                                    <?php 
                                                                    if($show_meta!=0){
                                                                    ?>
                                                                    <div class="posted-on">
                                                                        <?php if($show_datetime!=0) {echo cactus_get_datetime();}?>
                                                                        <?php if($show_author!=0) {?>
                                                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" class="author cactus-info"><?php echo esc_html( get_the_author() ); ?></a>
                                                                        <?php }?>                                                                        
                                                                        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) && $show_comment_count!=0) : ?>
                                                                            <?php comments_popup_link('0', '1','%', 'comment cactus-info'); ?>
                                                                        <?php endif; ?>                                                                        
                                                                        <?php 
                                                                        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                                                                        if(is_plugin_active('wti-like-post/wti_like_post.php')){
                                                                            $like = GetWtiLikeCount(get_the_ID());
                                                                            $unlike = GetWtiUnlikeCount(get_the_ID());
                                                                        ?>
                                                                            <?php if($show_like!=0) {?><div class="like cactus-info"><?php echo $like?></div><?php }?>
                                                                            <?php if($show_dislike!=0) {?><div class="dislike cactus-info"><?php echo $unlike?></div><?php }?>
                                                                        <?php }?>
                                                                        <?php if($show_view != 0) {?><div class="view cactus-info"><?php echo cactus_short_number(cactus_get_post_view(get_the_ID())) ?></div><?php }?>
                                                                    </div>
                                                                    <?php }?> 
                                                                    <?php if($show_excerpt=='yes') {?>
                                                                        <div class="excerpt">
                                                                        <?php the_excerpt(); ?>
                                                                        </div>
                                                                    <?php }?>
                                                                    <?php if($show_read_more=='yes'){?>
                                                                        <div class="cactus-readmore">
                                                                            <a href="<?php the_permalink(); ?>"><?php _e('read more','cactus');?></a>
                                                                        </div>
                                                                    <?php }?>                                                                    
                                                                    <div class="cactus-last-child"></div>
                                                                </div>
                                                             <?php }?>   
                                                        </div>
                                                        
                                                    </div><!--content-->
                                                    
                                                </div>                                                
												<?php
                                                }
                                                ?>
                                        	<?php if($layout=='4'&&$it_c>1){?>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                               </div>
                           </div>
                           <?php
							}
						   ?>
                       </div>
               	  </div>
               </div>
          	</div>
            </div>
    <?php
	wp_reset_postdata();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('scb', 'cactus_smart_contentbox');
//Register Visual composer
add_action( 'after_setup_theme', 'reg_ctscb', 100 );
function reg_ctscb(){
	if(function_exists('vc_map')){
	vc_map( array(
		"name"		=> esc_html__("NewsTube Smart Content Box", "cactus"),
		"base"		=> "scb",
		"class"		=> "wpb_vc_posts_slider_widget",
		"icon"		=> "icon-smart-content-box",
		"category"  => esc_html__('Content', 'cactus'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "cactus"),
				"param_name" => "title",
				"value" => "",
				"description" => esc_html__('', "cactus"),
                "admin_label" => true
			),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title Link", "cactus"),
                "param_name" => "title_link",
                "value" => "",
                "description" => esc_html__('', "cactus")
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => esc_html__("Layout", "cactus"),
				"param_name" => "layout",
				"value" => array(
					esc_html__("Layout 1","cactus")=>'1',
					esc_html__("Layout 2","cactus")=>'2',
					esc_html__("Layout 3","cactus")=>'3',
					esc_html__("Layout 4","cactus")=>'4',
					esc_html__("Layout 5","cactus")=>'5',
					esc_html__("Layout 6","cactus")=>'6',
				),
				"description" => esc_html__("choose box layout. Possible values:", "cactus"),
                "admin_label" => true
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Count", "cactus"),
				"param_name" => "number",
				"value" => "",
				"description" => esc_html__('number of items to query', "cactus"),
                "admin_label" => true
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Offset", "cactus"),
				"param_name" => "offset",
				"value" => "",
				"description" => esc_html__('number of post to displace or pass over. Warning: Setting the offset parameter overrides/ignores the paged parameter and breaks pagination. The offset parameter is ignored when items_per_page = count (show all posts) is used.', "cactus")
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
				esc_html__("Random", "cactus") => "random"), 
				"description" => esc_html__("condition to query items", "cactus"),
                "admin_label" => true
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Order by", "cactus"),
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
				"heading" => esc_html__("Items per page", "cactus"),
				"param_name" => "items_per_page",
				"value" => "",
				"description" => esc_html__('Number of items per page. If items_per_page is smaller than count value, the pagination buttons/arrows will appear', "cactus")
			),	
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Enable cat filter", "cactus"),
				"param_name" => "enable_cat_filter",
				"value" => array( 
				esc_html__("No", "cactus") => "0",
				esc_html__("Yes", "cactus") => "1" ), 
				"description" => esc_html__('Enable the category filter select-box. If this select-box is enabled, items are arranged by category', 'cactus')
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show meta", "cactus"),
				"param_name" => "show_meta",
				"value" => array( 
				esc_html__("Yes", "cactus") => "1", 
				esc_html__("No", "cactus") => "0" ),
				"description" => esc_html__("Show post metadata (author name, published date...)", "cactus")
			),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Show category tag", "cactus"),
                "param_name" => "show_category_tag",
                "value" => array( 
                esc_html__("Yes", "cactus") => "1", 
                esc_html__("No", "cactus") => "0" ),
            ),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show datetime", "cactus"),
				"param_name" => "show_datetime",
				"value" => array( 
				esc_html__("Yes", "cactus") => "1", 
				esc_html__("No", "cactus") => "0" ),
				"description" => esc_html__('', 'cactus')
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show author", "cactus"),
				"param_name" => "show_author",
				"value" => array( 
				esc_html__("Yes", "cactus") => "1", 
				esc_html__("No", "cactus") => "0" ),
				"description" => esc_html__('', 'cactus')
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show comment count", "cactus"),
				"param_name" => "show_comment_count",
				"value" => array( 
				esc_html__("Yes", "cactus") => "1", 
				esc_html__("No", "cactus") => "0" ),
				"description" => esc_html__('', 'cactus')
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show like", "cactus"),
				"param_name" => "show_like",
				"value" => array( 
				esc_html__("Yes", "cactus") => "1", 
				esc_html__("No", "cactus") => "0" ),
				"description" => esc_html__('', 'cactus')
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show dislike", "cactus"),
				"param_name" => "show_dislike",
				"value" => array( 
				esc_html__("Yes", "cactus") => "1", 
				esc_html__("No", "cactus") => "0" ),
				"description" => esc_html__('', 'cactus')
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show view", "cactus"),
				"param_name" => "show_view",
				"value" => array( 
				esc_html__("Yes", "cactus") => "1", 
				esc_html__("No", "cactus") => "0" ),
				"description" => esc_html__('', 'cactus')
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Heading color", "cactus"),
				"param_name" => "heading_color",
				"value" => "",
				"description" => esc_html__('', "cactus")
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__("Heading background", "cactus"),
				"param_name" => "heading_bg",
				"value" => "",
				"description" => esc_html__('', "cactus")
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Use bigger thumbnail sizes", "cactus"),
				"param_name" => "big_thumbnail",
				"value" => array(
				esc_html__("No", "cactus") => "",
				esc_html__("Yes", "cactus") => "1"),
				"description" => esc_html__('', 'cactus')
			),
		)
	) );
	}
}
