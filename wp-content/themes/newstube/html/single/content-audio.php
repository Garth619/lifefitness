<?php
/**
 * @package cactus
 */
global $is_auto_load_next_post;
$post_audio_layout = get_post_meta(get_the_ID(),'post_audio_layout',true);
if(!$post_audio_layout){
	$post_audio_layout = ot_get_option('post_audio_layout','1');
}
$tags = ot_get_option('show_tags_single_post');
preg_match("/<embed\s+(.+?)>/i", $post->post_content, $matches_emb); if(isset($matches_emb[0])){ echo $matches_emb[0];}
preg_match("/<source\s+(.+?)>/i", $post->post_content, $matches_sou) ;
preg_match('/\<object(.*)\<\/object\>/is', $post->post_content, $matches_oj); 
preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $post->post_content, $matches);
preg_match( '#\[audio\s*.*?\]#s', $post->post_content, $matches_sc );
preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $post->post_content, $match);
if(isset($match[0])){
	foreach ($match[0] as $matc) {
		if(strpos($matc,'soundcloud.com') !== false){
			  $check_link_s = 1;break;
		}
	}
}
$move_title_to_above = ot_get_option('move_title_to_above');
?>
	<?php if($post_audio_layout==2){
	if(($move_title_to_above == 'yes') ){
		ct_heading_title($is_auto_load_next_post,$post_audio_layout,$show_rating_intt =0);
	}	
	?>
	<div class="style-post" <?php if(!isset($matches_emb[0]) && !isset($matches_emb[0]) && !isset($matches_sou[0]) && !isset($matches_oj[0]) && !isset($matches[0]) && !isset($matches_sc[0]) && !isset($check_link_s)){?> style="display:none" <?php }?>>
    	<div class="clearfix"></div>
        <div class="style-audio-content">
            <div class="audio-iframe <?php if(!isset($matches_emb[0]) && !isset($matches_emb[0]) && !isset($matches_sou[0]) && !isset($matches_oj[0]) && !isset($matches[0]) && isset($matches_sc[0])){?> audio-shortcode <?php }?>">
                <div>
                    <?php
                      
                      if(!isset($matches_emb[0]) && isset($matches_sou[0])){
                          echo $matches_sou[0];
                      }else if(!isset($matches_sou[0]) && isset($matches_oj[0])){
                          echo $matches_oj[0];
                      }else if( !isset($matches_oj[0]) && isset($matches[0])){
                          echo $matches[0];
                      }else
					  if( !isset($matches[0]) && isset($matches_sc[0])){
						   echo do_shortcode($matches_sc[0]);
					  }else if( !isset($matches_sc[0]) && isset($match[0])){
                          foreach ($match[0] as $matc) {
                              if(strpos($matc,'soundcloud.com') !== false){
                                    echo wp_oembed_get($matc);break;
                              }
                          }
                      }
                  ?>
                </div>
        	</div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php }
	global $post;
	$checkSmartListPost = 0;
	if(strpos($post->post_content, '<!--nextpage-->')!=false &&( !isset($_GET['view-all']) || $_GET['view-all']!=1 )){
		$checkSmartListPost = 1;
	};
	$paged = get_query_var('page')?get_query_var('page'):1;
	if(($move_title_to_above == 'yes' && $post_audio_layout==2) ){
		
	}else{
		ct_heading_title($is_auto_load_next_post,$post_audio_layout,$show_rating_intt =0);
	}
	$csscl = '';
    
	$more = ot_get_option('show_more_posts', 'on') == 'on' ? 1 : 0;
    
	cactus_toolbar($id_curr = get_the_ID(), 1, $more, $csscl);?>   
    <?php if($post_audio_layout==1){?>
    <div class="style-post" <?php if(!isset($matches_emb[0]) && !isset($matches_emb[0]) && !isset($matches_sou[0]) && !isset($matches_oj[0]) && !isset($matches[0]) && !isset($matches_sc[0]) && !isset($check_link_s)){?> style="display:none" <?php }?>>
        <div class="clearfix"></div>
        <div class="style-audio-content">
            <div class="audio-iframe <?php if(!isset($matches_emb[0]) && !isset($matches_emb[0]) && !isset($matches_sou[0]) && !isset($matches_oj[0]) && !isset($matches[0]) && isset($matches_sc[0])){?> audio-shortcode <?php }?>">
                <div>
				<?php
                      if(!isset($matches_emb[0]) && isset($matches_sou[0])){
                          echo $matches_sou[0];
                      }else if(!isset($matches_sou[0]) && isset($matches_oj[0])){
                          echo $matches_oj[0];
                      }else if( !isset($matches_oj[0]) && isset($matches[0])){
                          echo $matches[0];
                      }else
					  if( !isset($matches[0]) && isset($matches_sc[0])){
						   echo do_shortcode($matches_sc[0]);
					  }else if( !isset($matches_sc[0]) && isset($match[0])){
                          foreach ($match[0] as $matc) {
                              if(strpos($matc,'soundcloud.com') !== false){
                                    echo wp_oembed_get($matc);break;
                              }
                          }
                      }
                ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div> 
    <?php }?>
	<div class="body-content">
		<?php 
		if($checkSmartListPost == 1){
			if((!isset($_GET['view-all']) || $_GET['view-all'] != 1)){
				$content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', get_the_content(),1);
				$content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content,1);
				$content =  preg_replace ('#\[audio\s*.*?\]#s', ' ', $content,1);
				$content =  preg_replace ('#\[/audio]#s', ' ', $content,1);
				preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
				foreach ($match[0] as $amatch) {
					if(strpos($amatch,'soundcloud.com') !== false){
						$content = str_replace($amatch, '', $content);
					}
				}
				echo '<div class="ct-smlist">';
				echo apply_filters('the_content',$content);
				echo '</div>';
			}
		}
		if( $checkSmartListPost == 1){
			$all_ct = explode("<!--nextpage-->", $post->post_content);
			$i =0;
			foreach($all_ct as $it_content){
				$i++;
				if($i==2){
					preg_match('/\<h2(.*)\<\/h2\>/isU',$it_content, $h2_tag);
					break;
				}
			}
			?>
        	<div class="smart-list-post-wrap">
            	
                
                <h2 class="h3 title-page-post"><span class="post-static-page" data-scroll-page="1"><?php echo $paged;?></span><span><?php if(isset($h2_tag[0])){echo strip_tags($h2_tag[0]);}?></span></h2>
                
                <div class="page-links">
                    <a class="prev-smart-post" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    <a class="next-smart-post" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                </div>  
            </div>
            <div class="content-first-content" data-index="1">
        <?php    
		};
		if( isset($_GET['view-all'] ) && ($_GET['view-all'] == 1)){
			$ct =  $post->post_content = str_replace( "<!--nextpage-->", "<br/>", $post->post_content );
			$content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', $ct,1);
			$content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content,1);
			$content =  preg_replace ('#\[audio\s*.*?\]#s', ' ', $content,1);
			$content =  preg_replace ('#\[/audio]#s', ' ', $content,1);
			preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
			foreach ($match[0] as $amatch) {
				if(strpos($amatch,'soundcloud.com') !== false){
					$content = str_replace($amatch, '', $content);
				}
			}
			$content = preg_replace('%<object.+?</object>%is', '', $content);
			echo apply_filters('the_content',$content);

		}else{
			if( $checkSmartListPost != 1){
				$content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', get_the_content(),1);
				$content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content,1);
				$content =  preg_replace ('#\[audio\s*.*?\]#s', ' ', $content,1);
				$content =  preg_replace ('#\[/audio]#s', ' ', $content,1);
				preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
				foreach ($match[0] as $amatch) {
					if(strpos($amatch,'soundcloud.com') !== false){
						$content = str_replace($amatch, '', $content);
					}
				}
				if(isset($h2_tag[0])){
					$content =  preg_replace ('/\<h2(.*)\<\/h2\>/isU', ' ', $content,1);
				}
				$content = preg_replace('%<object.+?</object>%is', '', $content,1);
				echo apply_filters('the_content',$content);
			}elseif( $checkSmartListPost == 1){
				$all_ct = explode("<!--nextpage-->", $post->post_content);
				$i =0;
				foreach($all_ct as $st2_content){
					$i++;
					if($i==2){
						$st2_content =  preg_replace ('/\<h2(.*)\<\/h2\>/isU', ' ', $st2_content,1);
						$st2_content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', $st2_content,1);
						$st2_content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $st2_content,1);
						$st2_content =  preg_replace ('#\[audio\s*.*?\]#s', ' ', $st2_content,1);
						$st2_content =  preg_replace ('#\[/audio]#s', ' ', $st2_content,1);
						preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $st2_content, $match);
						foreach ($match[0] as $amatch) {
							if(strpos($amatch,'soundcloud.com') !== false){
								$st2_content = str_replace($amatch, '', $st2_content);
							}
						}
						echo apply_filters('the_content',$st2_content);
						break;
					}
				}
				?>
					<div class="thumb-opacity"><div class="circle"></div><div class="circle1"></div></div>
				</div> 
				<div class="content-smart-hidden" style="display:none;">
					<?php 
					$counter = 0;
					foreach($all_ct as $it_content){
					$counter ++;
					if($counter>1){
						preg_match('/\<h2(.*)\<\/h2\>/isU',$it_content, $h2_tag_title);
						$it_content =  preg_replace ('/\<h2(.*)\<\/h2\>/isU', ' ', $it_content);
						?>                            
						<div class="page-break-item" data-title="<?php if(isset($h2_tag_title[0])){echo strip_tags($h2_tag_title[0]);}?>">
							<?php echo '<!--hidden-page--><!--'.(apply_filters('the_content',$it_content)).'--><!--hidden-page-->';?>
						</div>
						<?php }
					}?>
				</div> 
				<?php
			}
			?>
		<?php
			if(strpos($post->post_content, '<!--nextpage-->')!=false){?>
            	<div class="viewallpost-wrap">
                    <div class="cactus-view-all-pages">
                        <span><span></span></span>
                        <a href="<?php echo add_query_arg( array('view-all' => 1), ct_get_curent_url() ); ?>" title=""><span><?php echo esc_html__( 'View as one page', 'cactus' )?></span></a>
                        <span><span></span></span>
                    </div>
                </div>
                <?php
			}
		}
		?>
	</div><!-- .entry-content -->
    
    <?php if(!$is_auto_load_next_post): ?>
        <?php cactus_display_ads('ads_single_bottom');?>
    <?php endif;?>

    <?php
	$tag_list = get_the_tag_list();
	if($tags!='off' && $tag_list !=''){?>
    <div class="tag-group">
        <span><?php esc_html_e('tags:','cactus') ?></span>
        <?php echo $tag_list; ?>
    </div>
    <?php }
		cactus_toolbar($id_curr = get_the_ID(), 1, $show_more = 0, $css_class='fix-bottom');
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
