<?php
/**
 * @package cactus
 */
global $thumb_url;
global $post_standard_layout;
global $post_gallery_layout;
global $show_rating_intt;
global $is_auto_load_next_post;
global $format_sg; global $move_title_to_above;
$tags = ot_get_option('show_tags_single_post');
$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 999 ) );
?>
	<?php 
	if((($move_title_to_above == 'yes') && ($post_standard_layout==1) && $format_sg =='') || (($move_title_to_above == 'yes') && ($post_gallery_layout!=2) && $format_sg =='gallery')){
		ct_heading_title($is_auto_load_next_post,$post_standard_layout,$show_rating_intt);
	}
	if( (has_post_thumbnail() && ($post_standard_layout==1)  && get_post_format()=='' ) || ( $post_gallery_layout!=2 && get_post_format()=='gallery' &&  ($images and count($images)>0) ) ){
	$show_rating_intt = 1;	
	?>
	<div class="style-post">
    	<?php if($post_standard_layout==1 && get_post_format()==''){ ?>
            <?php if($thumb_url){ ?>
                <img src="<?php echo $thumb_url ?>" alt="<?php the_title_attribute();?>" class="featured">
            <?php }else{
                echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'featured' ));
            } ?>
            <?php echo tm_post_rating(get_the_ID());?>
        <?php }if($post_gallery_layout!=2 && get_post_format()=='gallery'){?>
            <div class="post-style-gallery">
                <a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                <a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                <div class="pagination"></div>
                <div class="post-style-gallery-content">
                    <div class="cactus-swiper-container" data-settings='["mode":"cactus-fix-composer"]'>
                        <div class="swiper-wrapper">
						<?php                            
							foreach((array)$images as $attachment_id => $attachment){
								$image_img_tag = wp_get_attachment_image_src( $attachment_id ,'full');
								?>
								<!-- display the gallery -->
								<div class="swiper-slide">
									<div class="img-content">
										<img src="<?php echo $image_img_tag[0]; ?>" alt="<?php echo $attachment->post_title;?>">
									</div>
								</div>
							<?php
							}// end foreach
                        ?>
                        </div>
                    </div>
                </div>
            </div>                                            
            <?php echo tm_post_rating(get_the_ID());?>
        <?php }?>
    </div>
    <?php }
	global $post;
	if(($move_title_to_above == 'yes' && $format_sg =='') && ($post_standard_layout==1 || $post_standard_layout==3) || (($move_title_to_above == 'yes') && $format_sg =='gallery') ){
	}else{
		ct_heading_title($is_auto_load_next_post,$post_standard_layout,$show_rating_intt);
	}
	if(has_post_thumbnail() && ($post_standard_layout==5)  && get_post_format()==''){?>
	<div class="style-post">
        <?php if($thumb_url){ ?>
            <img src="<?php echo $thumb_url ?>" alt="<?php the_title_attribute();?>" class="featured">
        <?php }else{
            echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'featured' ));
        } ?>
        <?php echo tm_post_rating(get_the_ID());?>
    </div>
    <?php }?>
    <?php
	$csscl ='';
	$more = ot_get_option('show_more_posts', 'on') == 'on' ? 1 : 0;
	if($post_standard_layout ==5 ){$csscl = 'fix-left'; $more = 0;}
	cactus_toolbar($id_curr = get_the_ID(),$post_standard_layout, $more, $csscl);?>    
	<div class="body-content <?php if($post_standard_layout==5){ echo 'style-5';} ?>" <?php if((isset($_GET['view-all'])) && ($_GET['view-all']==1)) {?>data-scroll-page-viewall="1"<?php }?>>
    	
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

    <?php
        $live_post = get_post_meta($post->ID,'live_post',true);
        if($live_post=='on'){
            $content_length = strlen(apply_filters('the_content', $post->post_content));
            $_SESSION['content_length'] = $content_length;
            $live_post_auto_refresh = get_post_meta($post->ID,'live_post_auto_refresh',true);
            if($live_post_auto_refresh == '' || !is_numeric($live_post_auto_refresh)){$live_post_auto_refresh='5';}
            ?>
            <script>
                jQuery(document).ready(function($) {
                    var refreshId = setInterval(function(){
                            var $url = "<?php echo wp_nonce_url(home_url().'/?id='.$post->ID,'idn'.$post->ID,'cactus_load_live_content'); ?>";
                            $url = ($url.split("amp;").join(""));
                            jQuery.get($url, function( data ) {
                                if(data != '')
                                {
                                    jQuery("#post-<?php echo $post->ID;?> .body-content").html(data);
                                }
                            });
                    }, <?php echo $live_post_auto_refresh;?>000);
                });
            </script>
            <?php
        }
    ?>

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
	if($post_standard_layout != 5 ){
		cactus_toolbar($id_curr = get_the_ID(), $post_standard_layout, $show_more = 0, $css_class = 'fix-bottom');
	}?> 
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
