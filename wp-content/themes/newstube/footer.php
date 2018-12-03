<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cactus
 */
global $cactus_width;
$cactus_width = 12;

if(is_active_sidebar('main-bottom-sidebar')){
	echo '<div class="main-bottom-sidebar-wrap">';
		dynamic_sidebar( 'main-bottom-sidebar' );
	echo '</div>';	
}
/* Start Wall Ads */
if(is_category()){
	$category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;
}

$ads_wall_1_adsense = ot_get_option('adsense_slot_ads_wall_1');
$ads_wall_1_custom = ot_get_option('ads_wall_1');
			
if(is_single()){
	
	$tmp = get_post_meta(get_the_ID(),'wall_ads_1_adsense', true);
	if($tmp != '') $ads_wall_1_adsense = $tmp;
	
	$tmp = get_post_meta(get_the_ID(),'wall_ads_1_custom', true);

	if($tmp != '') $ads_wall_1_custom = $tmp;
} elseif(is_category()){
	$tmp = get_option('wall_ads_1_adsense_'.$cat_id);
	if($tmp != '') $ads_wall_1_adsense = $tmp;
	
	$tmp = get_option('wall_ads_1_custom_'.$cat_id);
	if($tmp != '') $ads_wall_1_custom = stripslashes($tmp);
}

$ads_wall_2_adsense = ot_get_option('adsense_slot_ads_wall_2');
$ads_wall_2_custom = ot_get_option('ads_wall_2');

if(is_single()){
	$tmp = get_post_meta(get_the_ID(),'wall_ads_2_adsense', true);
	if($tmp != '') $ads_wall_2_adsense = $tmp;
	
	$tmp = get_post_meta(get_the_ID(),'wall_ads_2_custom', true);
	if($tmp != '') $ads_wall_2_custom = $tmp;
} elseif(is_category()){
	$tmp = get_option('wall_ads_2_adsense_'.$cat_id);
	if($tmp != '') $ads_wall_2_adsense = $tmp;
	
	$tmp = get_option('wall_ads_2_custom_'.$cat_id);
	if($tmp != '') $ads_wall_2_custom = stripslashes($tmp);
}
			
			
if(($ads_wall_1_adsense != '' || $ads_wall_1_custom != '') || ($ads_wall_2_adsense != '' || $ads_wall_2_custom != '')){
?>
<div id="ads_walls">
	<div class="container">
<?php
	if($ads_wall_1_adsense != '' || $ads_wall_1_custom != ''){
	?>
	<div id='ads_wall_1'>
		<div id="ads_wall_1_in">
			<?php 
			
			if($ads_wall_1_custom != '') 
				echo do_shortcode($ads_wall_1_custom);
			else if($ads_wall_1_adsense != ''){
				do_shortcode('[adsense pub="' . ot_get_option('adsense_id') . '" slot="' . $ads_wall_1_adsense . '"]');
			}
			?>
		</div>
	</div>
	<?php
	}

	if($ads_wall_2_adsense != '' || $ads_wall_2_custom != ''){
	?>
	<div id='ads_wall_2'>
		<?php 
			
			
			
			if($ads_wall_2_custom != '') 
				echo do_shortcode($ads_wall_2_custom);
			else if($ads_wall_2_adsense != ''){
				do_shortcode('[adsense pub="' . ot_get_option('adsense_id') . '" slot="' . $ads_wall_2_adsense . '"]');
			}
			?>
	</div>
	<?php
	}
?>
	</div>
</div>
<?php
}
/* End Wall Ads */
?>

    <footer>
        <div class="footer-inner dark-div">
            <?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
            <div class="footer-sidebar">
                <div class="container">
                    <?php
                    $adsense_publisher_id = ot_get_option('adsense_id', '');
                    $ads_bottom = ot_get_option('ads_bottom', '');
                    $adsense_slot_ads_bottom = ot_get_option('adsense_slot_ads_bottom', '');
                    if($ads_bottom != '' || ($adsense_publisher_id != '' && $adsense_slot_ads_bottom != '')):
                    ?>
                        <div class="row footer-banner-wrapper"><?php cactus_display_ads('ads_bottom');?></div>
                    <?php endif;?>
                    <div class="row">
                        <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                    </div>
                </div>
            </div><!--.footer-sidebar-->
            <?php endif; //if active sidebar ?>
        </div><!--.footer-inner-->
        
        <div class="footer-info dark-div">
            <div class="container">
                <div class="row">                        
                    <div class="col-md-6 col-sm-6 copyright font-1"><?php echo ot_get_option('copyright', '@2015 CactusThemes.com - We built amazing and functional Wordpress Themes');?></div>
                    <div class="col-md-6 col-sm-6 link font-1">
                      <div class="menu-footer-menu-container">
                          <ul id="menu-footer-menu" class="menu">
                            <?php
                                if(has_nav_menu( 'footer-menu' )){
                                    wp_nav_menu(array(
                                        'theme_location'  => 'footer-menu',
                                        'container' => false,
                                        'items_wrap' => '%3$s',
                                    ));	
                                }
                            ?>
                          </ul>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        
    </footer>
            
	</div><!--#wrap-->
        
    <!--Menu moblie-->
    <div class="canvas-ovelay"></div>
    <div id="off-canvas" class="off-canvas-default dark-div">
        <div class="off-canvas-inner">
            <div class="close-canvas-menu">
                <i class="fa fa-times"></i> Close
            </div>
            <nav class="off-menu">
                <ul>                        	
                    <?php
                    if(has_nav_menu( 'primary' )){
                        wp_nav_menu(array(
                            'theme_location'  => 'primary',
                            'container' => false,
                            'items_wrap' => '%3$s',
                        ));	
                    }else{ ?>
                        <li><a href="<?php echo home_url(); ?>"><?php esc_html_e('Home','cactus') ?></a></li>
                        <?php wp_list_pages('depth=1&number=4&title_li=' );
                    } ?>                      
                </ul>
                
                <ul class="search-mobile-menu">
                    <li>
                        <form action="<?php echo esc_url(home_url());?>" method="get">
                            <input type="text" placeholder="<?php echo esc_html_e('Search...','cactus');?>" name="s" value="<?php echo esc_attr(get_search_query());?>">
                            <i class="fa fa-search"></i>
                            <input type="submit" value="<?php echo esc_html_e('search','cactus');?>">
                        </form>
                    </li>
                </ul>
                
            </nav>
        </div>
    </div><!--Menu moblie-->
<?php
	if(ot_get_option('user_submit',1)) {?>
	<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><?php esc_html_e('Submit Video','cactus'); ?></h4>
		  </div>
		  <div class="modal-body">
			<?php dynamic_sidebar( 'user_submit_sidebar' ); ?>
		  </div>
		</div>
	  </div>
	</div>
<?php } ?>
<?php
	if( is_single() && ot_get_option('video_report','on')!='off' ) {?>
	<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><?php esc_html_e('REPORT THIS','cactus'); ?></h4>
		  </div>
		  <div class="modal-body">
			<?php echo do_shortcode('[contact-form-7 id="'.ot_get_option('video_report_form','').'"]'); ?>
		  </div>
		</div>
	  </div>
	</div>
<?php } ?>
    
    <div class="go-to-top">
    	<i class="fa fa-angle-up"></i>
    </div>
    <div class="popup_share_overlay"></div>
    <div class="popup_share_video_wrapper">
    	<div class="popup_share_video">
    		<h4><?php esc_html_e('Share this video','cactus'); ?></h4>
    		<?php cactus_print_social_share('change-color popup_share_video_listing');?>
    	</div>
    </div>
               
	</div><!--#body-wrap-->
    <?php wp_footer(); ?>     
</body>
</html>
