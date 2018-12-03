<?php
/**
 * The Template for displaying single video.
 *
 * @package cactus
 */

get_header();

$sidebar = get_post_meta(get_the_ID(),'post_sidebar',true);
if(!$sidebar){
	$sidebar = ot_get_option('post_sidebar','right');
}
global $post_video_layout;
$post_video_layout = get_post_meta(get_the_ID(),'post_video_layout',true);
if(!$post_video_layout){
	$post_video_layout = ot_get_option('post_video_layout','1');
}
$playlist_id = get_post_meta(get_the_ID(),'playlist_id',true);
global $exits_list;
$exits_list = 0;
if(is_array($playlist_id) && isset($_GET['list'])){
	if (in_array($_GET['list'], $playlist_id)) {
		$exits_list = 1;
	}
}elseif($playlist_id!='' && isset($_GET['list'])){
	if ($_GET['list'] == $playlist_id) {
		$exits_list = 1;
	}
}
$show_related_post = ot_get_option('show_related_post','on');
$show_comment = ot_get_option('show_comment','on');
global $thumb_url;
$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
$thumb_url = wp_get_attachment_url( $thumbnail_id );
global $cactus_width;
$cactus_width = $sidebar!='full'?8:12;
$file = get_post_meta($post->ID, 'tm_video_file', true);
$url = (get_post_meta($post->ID, 'tm_video_url', true));
$code = (get_post_meta($post->ID, 'tm_video_code', true));
$live_cm = get_post_meta($post->ID,'live_comment',true);
global $move_title_to_above; 
$move_title_to_above = ot_get_option('move_title_to_above');
?>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-single-page cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
            <div class="container">
                <div class="row">
                	<?php if( ($exits_list == 1) && isset($_GET['list']) && $_GET['list']!=''){
						get_template_part( 'html/single/single', 'videoplaylist' );	
					}
					global $check_empty_it;
					if( ($exits_list == 0 && $post_video_layout!= 1) || ($post_video_layout!= 1 && !isset($_GET['list'])) || ($post_video_layout!= 1 && isset($_GET['list']) && $_GET['list']=='') ||  ($post_video_layout!=1 && $check_empty_it== 'off') ){ ?>
                    <div class="cactus-top-style-post style-video">
                    <!--breadcrumb-->
                    <?php 
                     if(function_exists('ct_breadcrumbs')){  ct_breadcrumbs(); } 
					if(($move_title_to_above == 'yes') && ($post_video_layout== 2) && $exits_list == 0 ){
						ct_heading_title($is_auto_load_next_post =0,$post_video_layout,$show_rating_intt =0);
					}
                    ?>
                    <!--breadcrumb-->                    
                    <div class="style-post-content" <?php if(($file=='') && ($url=='') && ($code=='')){?> style="display:none" <?php }?>>
                    	<div class="cactus-post-format-video style-2 <?php if($post_video_layout==3){ echo 'style-3';}?>"> 
                        	<div class="cactus-video-content">
    							<div class="background-tablet-mobile"></div> 
                                                  
								<?php
                                if ( ! isset( $content_width ) ) $content_width = 1140;
                                echo do_shortcode('[cactus_player]');
                                ?> 
    
                                <?php echo tm_post_rating(get_the_ID());?>
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
                                <a href="<?php echo get_permalink($p->ID) ?>" class="cactus-change-video cactus-new active" style="margin-right: 181px;">
                                	
                                        <div class="button-table">
                                            <div class="button-cell">
                                                <span><i class="fa fa-play-circle-o"></i>&nbsp; <?php echo esc_html__( 'Previous Video', 'cactus' )?></span>
                                                <span><?php echo esc_attr($p->post_title) ?></span>
                                			</div>
                                        </div>
                                   
                                </a>
                                <?php }
                                if(!empty($n)){ 
                                ?>
                                <a href="<?php echo get_permalink($n->ID) ?>" class="cactus-change-video cactus-old active" style="margin-left: 182px;">
                                	
                                        <div class="button-table">
                                            <div class="button-cell">
                                                <span><i class="fa fa-play-circle-o"></i>&nbsp; <?php echo esc_html__( 'Next Video', 'cactus' )?></span>
                                                <span><?php echo esc_attr($n->post_title) ?></span>
                                            </div>
                                        </div>
                                    
                                </a>
                                <?php }?>
                                    
                    		</div> <!--content video-->
                            
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
                        </div>
                    </div>
                    </div>
                    <?php
                    }?>
                    <div class="main-content-col col-md-12 cactus-config-single <?php echo 'fm-'.$post_video_layout?>">
						<?php 
						if($post_video_layout!=1){
							$multi_link = get_post_meta(get_the_ID(), 'tm_multi_link', true);
							if(!empty($multi_link)&& function_exists('tm_build_multi_link')){
								tm_build_multi_link($multi_link, true);
							}
						}
                        ?>

                    	<?php if(is_active_sidebar('content-top-sidebar')){
							echo '<div class="content-top-sidebar-wrap">';
							dynamic_sidebar( 'content-top-sidebar' );
							echo '</div>';
						} ?>
                        
                    	<?php if($exits_list == 0 && $post_video_layout== 1){
                     		if(function_exists('ct_breadcrumbs')){  ct_breadcrumbs(); } 
                   		}?>

                        <?php 
                            if(is_plugin_active('facebook/facebook.php') && get_option('facebook_comments_enabled') == 1)
                                $enable_fb_comment = 1;
                            else
                                $enable_fb_comment = 0;

                        ?>
                        <div id='single-post' class="single-post-content">
                            <?php while ( have_posts() ) : the_post(); ?>
                            <?php $query_string =  $_SERVER['QUERY_STRING'] != '' ? '?' . $_SERVER['QUERY_STRING'] : '' ;?>
                            <article data-id="<?php echo get_the_ID();?>" data-url='<?php echo esc_url(get_permalink()) . $query_string ;?>' data-timestamp='<?php echo get_post_time('U');?>' data-count='0' data-enable-fb-comment='<?php echo $enable_fb_comment;?>' id="post-<?php the_ID(); ?>" <?php post_class('cactus-single-content'); ?>>
									<?php get_template_part( 'html/single/content-video'); ?>
                                    <?php if($show_related_post!='off'){ get_template_part( 'html/single/single', 'related' ); }?>
                                <?php
                                    // If comments are open or we have at least one comment, load up the comment template
                                    if ( ($show_comment!='off') && (comments_open() || '0' != get_comments_number()) ) :
                                        comments_template();
                                    endif;
                                ?>

                            </article>
                            <?php endwhile; // end of the loop. ?>
                        </div>
                        <?php
                        $single_post_scroll_next = get_post_meta(get_the_ID(),'enable_scroll_to_next_post',true) != '' ? get_post_meta(get_the_ID(),'enable_scroll_to_next_post',true) : ot_get_option('single_post_scroll_next','off');
                        if($single_post_scroll_next == 'on' && $live_cm!='on'):?>
                            <div id="scroll_next_marker"><span class="loader hidden"><!-- --></span></div>
                        <?php endif;?>
                        
                        <?php if(is_active_sidebar('content-bottom-sidebar')){
							echo '<div class="content-bottom-sidebar-wrap">';
							dynamic_sidebar( 'content-bottom-sidebar' );
							echo '</div>';
						} ?>
                    </div>


                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
        </div><!--#cactus-single-page-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
