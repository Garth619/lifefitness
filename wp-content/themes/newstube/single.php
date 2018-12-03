<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cactus
 */
if(get_post_format()=='video') {
	get_template_part('single-video');
	return;
}
get_header();

$sidebar = get_post_meta(get_the_ID(),'post_sidebar',true);
if(!$sidebar){
	$sidebar = ot_get_option('post_sidebar','right');
}
if($sidebar == 'hidden') $sidebar = 'full';
global $post_standard_layout;
$post_standard_layout = get_post_meta(get_the_ID(),'post_standard_layout',true);
if(!$post_standard_layout){
	$post_standard_layout = ot_get_option('post_standard_layout','1');
}
global $post_gallery_layout;
$post_gallery_layout = get_post_meta(get_the_ID(),'post_gallery_layout',true);
if(!$post_gallery_layout){
	$post_gallery_layout = ot_get_option('post_gallery_layout','1');
}
$show_related_post = ot_get_option('show_related_post','on');
$show_comment = ot_get_option('show_comment','on');
global $thumb_url;
$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
$thumb_url = wp_get_attachment_url( $thumbnail_id );
global $cactus_width;
global $show_rating_intt;
$show_rating_intt = 0;
$cactus_width = $sidebar!='full'?8:12;
$live_cm = get_post_meta($post->ID,'live_comment',true);
global $format_sg; global $move_title_to_above;
$move_title_to_above = ot_get_option('move_title_to_above');
$format_sg = get_post_format();
$getOptionsLayouts 	= ot_get_option('main_layout', 'boxed');
?>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-single-page cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>  <?php if ( $live_cm=='on'){?> post-live-comment<?php }?>">
            <div class="container">
                <div class="row">
					<?php if( (get_post_format()=='' && ( ($post_standard_layout == 2 && $getOptionsLayouts!='boxed') || $post_standard_layout == 3)) || (get_post_format()=='gallery' && $post_gallery_layout==2)){
                        show_thumb_single($format = get_post_format(),$post_standard_layout, $thumb_url);
                    }?>
                    <div class="main-content-col col-md-12 cactus-config-single">
						<?php if(is_active_sidebar('content-top-sidebar')){
                            echo '<div class="content-top-sidebar-wrap">';
							dynamic_sidebar( 'content-top-sidebar' );
							echo '</div>';
                        } ?>
                        
                        <!--breadcrumb-->
                        <?php if(((get_post_format()=='' && $post_standard_layout== 1) || ( get_post_format()=='' && $post_standard_layout== 4) || ( get_post_format()=='' && $post_standard_layout== 5) || get_post_format()=='audio' ) && function_exists('ct_breadcrumbs')){
							 ct_breadcrumbs();
						}
						 if((get_post_format()=='gallery' && $post_gallery_layout!= 2) && function_exists('ct_breadcrumbs')){
							 ct_breadcrumbs();
						}
						?>
                        <!--breadcrumb-->
                        <?php 
                            if(is_plugin_active('facebook/facebook.php') && get_option('facebook_comments_enabled') == 1)
                                $enable_fb_comment = 1;
                            else
                                $enable_fb_comment = 0;

                        ?>
                        <div id='single-post' class="single-post-content">
                            <?php while ( have_posts() ) : the_post(); ?>
                            <?php $query_string =  $_SERVER['QUERY_STRING'] != '' ? '?' . $_SERVER['QUERY_STRING'] : '' ;?>
                            <article data-id="<?php echo get_the_ID();?>" data-url='<?php echo esc_url(get_permalink()) . $query_string ;?>' data-timestamp='<?php echo get_post_time('U');?>' data-count='0' data-enable-fb-comment='<?php echo $enable_fb_comment;?>' id="post-<?php the_ID(); ?>" <?php post_class('cactus-single-content'); ?> <?php if(get_post_meta(get_the_ID(), 'taq_review_score', true)) echo 'itemscope itemtype="http://data-vocabulary.org/Review"'?>>
                                    <?php if($review_point = get_post_meta(get_the_ID(), 'taq_review_score', true)):?>
                                    <div class="hidden">
                                        <span itemprop="itemreviewed"><?php the_title() ?></span>
                                        <span itemprop="reviewer"><?php echo get_bloginfo('name') ?></span>
                                        <span itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">      
                                             Rating: <span itemprop="value"><?php echo round($review_point/10,1) ?></span> / <meta itemprop="best" content="10"/>10
                                        </span>
                                    </div>
                                    <?php endif;?>
									<?php get_template_part( 'html/single/content', get_post_format() ); ?>
                                    <?php if($show_related_post!='off'){ get_template_part( 'html/single/single', 'related' ); }?>
                                <?php
                                    // If comments are open or we have at least one comment, load up the comment template
                                    if ( ($live_cm!='on') && (($show_comment!='off') && (comments_open() || '0' != get_comments_number())) ) :
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

					<?php
						if ( $live_cm=='on'){
							?>
                            
                            <div class="ct-viewfullcontent-gradient">
                                <div class="gradient-pro"></div>
                            </div>
                            
                            <div class="page-navigation ct-viewfullcontent">	
                                <nav class="navigation-ajax" role="navigation">
                                    <div class="wp-pagenavi">
                                        <a href="javascript:;" id="showfullcontentnow">
                                            <div class="load-title"><?php esc_html_e('View full content','cactus'); ?></div>
                                        </a>
                                    </div>
                                </nav>	
                            </div>
                            
                            <div class="live-comment col-md-4 cactus-sidebar main-sidebar-col">
								<?php comments_template();?>
                            </div>
                            <?php
						}elseif($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
        </div><!--#cactus-single-page-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
