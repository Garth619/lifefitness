<?php
/**
 * @package cactus
 */
global $thumb_url;
global $post_video_layout;
$tags = ot_get_option('show_tags_single_post');
global $exits_list;
global $check_empty_it;
global $is_auto_load_next_post;
global $move_title_to_above;

$file = get_post_meta($post->ID, 'tm_video_file', true);
$url = (get_post_meta($post->ID, 'tm_video_url', true));
$code = (get_post_meta($post->ID, 'tm_video_code', true));
?>
	<?php 
	if(($move_title_to_above == 'yes') && ($post_video_layout== 1) && $exits_list == 0 ){
		ct_heading_title($is_auto_load_next_post,$post_video_layout,$show_rating_intt =0);
	}
	if(($exits_list == 0 && $post_video_layout== 1) || ($post_video_layout== 1 && !isset($_GET['list'])) || ($post_video_layout== 1 && isset($_GET['list']) && $_GET['list']=='') ||  ($post_video_layout==1 && $check_empty_it== 'off') ){?>
	<div class="style-post" <?php if(($file=='') && ($url=='') && ($code=='')){?> style="display:none" <?php }?>>
		<div class="cactus-post-format-video">
        	<div class="cactus-video-content">
				<?php
                if ( ! isset( $content_width ) ) $content_width = 1140;
                do_shortcode('[cactus_player]');
                ?>
            </div>
        </div>
        <?php echo tm_post_rating(get_the_ID());?>
        <div class="cactus-change-sub">
        	<div class="table-sub-100-percent">
				<?php
                $next_previous_same = ot_get_option('next_previous_same');
                if($next_previous_same!='all'){
                    $p = get_adjacent_post(true, '', true);
                    $n = get_adjacent_post(true, '', false);
                }else{
                    $p = get_adjacent_post(false, '', true);
                    $n = get_adjacent_post(false, '', false);
                }
                if(!empty($p)){ 
                ?>
                    <a href="<?php echo get_permalink($p->ID) ?>" class="cactus-change-video-sub cactus-prev cactus-new">
                        <span><i class="fa fa-angle-left"></i>&nbsp; <?php echo esc_html__( 'prev', 'cactus' )?></span>
                    </a> 
                <?php }
                if(!empty($n)){ 
                ?>    
                    <a href="<?php echo get_permalink($n->ID) ?>" class="cactus-change-video-sub cactus-prev cactus-old">
                        <span><?php echo esc_html__( 'next', 'cactus' )?> &nbsp;<i class="fa fa-angle-right"></i></span>
                    </a> 
                <?php }?>    
         	</div>
        </div>
        <?php 
		$multi_link = get_post_meta(get_the_ID(), 'tm_multi_link', true);
		if(!empty($multi_link) && function_exists('tm_build_multi_link')){
			tm_build_multi_link($multi_link, true);
		}
		?>
    </div>
    <?php }
	global $post;
	if(($move_title_to_above == 'yes') && ($post_video_layout== 1 || $post_video_layout== 2) && $exits_list == 0 ){
	}else{
		ct_heading_title($is_auto_load_next_post,$post_video_layout,$show_rating_intt =0);
	}
	?>
    <?php
	$csscl ='';
	
    $more = ot_get_option('show_more_posts', 'on') == 'on' ? 1 : 0;
    
	cactus_toolbar($id_curr = get_the_ID(),1, $more, $csscl);?>    
	<div class="body-content " <?php if((isset($_GET['view-all'])) && ($_GET['view-all']==1)) {?>data-scroll-page-viewall="1"<?php }?>>
		<?php
			global $post;
			$checkSmartListPost = 0;
			if(strpos($post->post_content, '<!--nextpage-->')!=false &&( !isset($_GET['view-all']) || $_GET['view-all']!=1 )){
				$checkSmartListPost = 1;
			}; 
			if($checkSmartListPost == 1 || (isset($_GET['view-all']) && $_GET['view-all'] == 1)){
				if((!isset($_GET['view-all']) || $_GET['view-all'] != 1)){
					echo '<div class="ct-smlist">';
					the_content();
					echo '</div>';
				}
				ct_smartlist_post($checkSmartListPost);
			}else{
				the_content();
			}
		?>
	</div><!-- .entry-content -->

    <?php if(!$is_auto_load_next_post): ?>
        <?php cactus_display_ads('ads_single_bottom');?>
    <?php endif;?>
    
    <?php
	$tag_list = get_the_tag_list(' ', ' ');
	if($tags!='off' && str_replace(' ', '', $tag_list) !=''){?>
    <div class="tag-group">
        <span><?php esc_html_e('tags:','cactus') ?></span>
        <?php echo $tag_list; ?>
    </div>
    <?php }
		cactus_toolbar($id_curr = get_the_ID(), 1 , $show_more = 0, $css_class='fix-bottom');
	?> 
    <!--navigation post-->
    <div class="cactus-navigation-post">
    	<?php 
		$next_previous_same = ot_get_option('next_previous_same');
		if($next_previous_same!='all'){
			$p = get_adjacent_post(true, '', true);
			$n = get_adjacent_post(true, '', false);
		}else{
			$p = get_adjacent_post(false, '', true);
			$n = get_adjacent_post(false, '', false);
		}
		if(!empty($p)){ 
		?>
        <div class="prev-post">
            <a href="<?php echo get_permalink($p->ID) ?>" title="<?php echo esc_attr($p->post_title) ?>">
                <span><?php echo esc_html__( 'previous', 'cactus' )?></span>
                <?php echo esc_attr($p->post_title) ?>
            </a>
        </div>
        <?php }
		if(!empty($n)){ 
		?>
        <div class="next-post">
            <a href="<?php echo get_permalink($n->ID) ?>" title="<?php echo esc_attr($n->post_title) ?>">
                <span><?php echo esc_html__( 'next', 'cactus' )?></span>
                <?php echo esc_attr($n->post_title) ?>
            </a>
        </div>
        <?php }?>
    </div>
    <!--navigation post-->
    <?php 
    $show_about_the_author = ot_get_option('show_about_the_author','on');
	if($show_about_the_author!='off'){
	?>
    <!--Author-->
    <?php get_template_part( 'html/single/content', 'about-author' ); ?>
    <!--Author-->
    <?php }?>
