<?php
/*
Plugin Name: NewsTube - Shortcodes
Plugin URI: http://cactusthemes.com/
Description: NewsTube - Shortcodes
Version: 1.4.12
Author: CactusThemes
Author URI: http://cactusthemes.com/
License: Commercial
*/

if ( ! defined( 'CT_SHORTCODE_BASE_FILE' ) )
    define( 'CT_SHORTCODE_BASE_FILE', __FILE__ );
if ( ! defined( 'CT_SHORTCODE_BASE_DIR' ) )
    define( 'CT_SHORTCODE_BASE_DIR', dirname( CT_SHORTCODE_BASE_FILE ) );
if ( ! defined( 'CT_SHORTCODE_PLUGIN_URL' ) )
    define( 'CT_SHORTCODE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/* ================================================================
 *
 *
 * Class to register shortcode with TinyMCE editor
 *
 * Add to button to tinyMCE editor
 *
 */
class CactusThemeShortcodes{

	function __construct()
	{
		add_action('init',array(&$this, 'init'));
		add_action( 'after_setup_theme', array(&$this, 'cactus_setup_scb') );
	}

	function init(){
		if(is_admin()){
			// CSS for button styling
			wp_enqueue_style("ct_shortcode_admin_style", CT_SHORTCODE_PLUGIN_URL . '/shortcodes/css/style-admin.css');
		}
		else
		{
			wp_enqueue_style("ct_shortcode_style", CT_SHORTCODE_PLUGIN_URL . 'shortcodes/css/shortcode.css');
			wp_enqueue_script( 'jquery-touchSwipe',plugins_url('/newstube-shortcodes/shortcodes/library/touchswipe/jquery.touchSwipe.min.js') , array('jquery'), '', true );
			wp_enqueue_script( 'ct-shortcode-js',plugins_url('/newstube-shortcodes/shortcodes/js/shortcode.js') , array('jquery', 'jquery-touchSwipe'), '20150305', true );
		}

		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
	    	return;
		}

		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', array(&$this, 'regplugins'));
			add_filter( 'mce_buttons_3', array(&$this, 'regbtns') );

			// remove a button. Used to remove a button created by another plugin
			remove_filter('mce_buttons_3', array(&$this, 'remobtns'));
		}

	    
	}
	

	function cactus_setup_scb() {			
		global $cactus_size_array;
		if(!$cactus_size_array) $cactus_size_array = array();
		$cactus_size_array_shortcode = array(
			
			// post-grid
			'thumb_566x377' => array(566, 377, true, array('thumb_566x377','thumb_566x377','thumb_566x377','thumb_760x570')),//
			'thumb_279x184' => array(279, 184, true, array('thumb_279x184','thumb_279x184','thumb_279x184','thumb_566x377')),//
			
			//posts classic slider
			'thumb_799x519' => array(799, 580, true, ''),//
			'thumb_220x220' => array(220, 220, true, ''),
			
			// post-carousel
			'thumb_375x300' => array(375, 300, true, ''),				
			
			//topicbox
			'thumb_250x165' => array(250, 165, true, ''),
			
			/*Smart Content Box*/
			'thumb_780x470' => array(780, 470, true, ''),
			'thumb_390x235' => array(390, 235, true, array('thumb_780x470','thumb_780x470','thumb_390x235','thumb_780x470')),
			
			'thumb_1110x666' => array(1110, 666, true, ''),
			'thumb_555x333' => array(555, 333, true, array('thumb_1110x666','thumb_1110x666','thumb_555x333','thumb_1110x666')),
			
			'thumb_760x570' => array(760, 570, true, ''),
			'thumb_380x285' => array(380, 285, true, array('thumb_760x570','thumb_760x570','thumb_380x285','thumb_760x570')),
			
			'thumb_540x330' => array(540, 330, true, ''),
			'thumb_270x165' => array(270, 165, true, array('thumb_540x330','thumb_540x330','thumb_270x165','thumb_540x330')),
			
			'thumb_550x420' => array(550, 420, true, ''),
			'thumb_275x210' => array(275, 210, true, array('thumb_550x420','thumb_550x420','thumb_275x210','thumb_550x420')),
			
			'thumb_188x144' => array(188, 144, true, ''),
			'thumb_94x72' => array(94, 72, true, array('thumb_188x144','thumb_188x144','thumb_94x72','thumb_188x144')),
	
		);
		$cactus_size_array = array_merge($cactus_size_array, $cactus_size_array_shortcode);
		do_action( 'cactus_reg_thumbnail', $cactus_size_array);
	}

	function remobtns($buttons){
		// add a button to remove
		// array_push($buttons, 'ct_shortcode_collapse');
		return $buttons;
	}

	function regbtns($buttons)
	{
		array_push($buttons, 'cactus_shortcode_button');
		array_push($buttons, 'cactus_dropcap');
		array_push($buttons, 'cactus_tooltip');
		array_push($buttons, 'cactus_button');
		array_push($buttons, 'cactus_alert');
		array_push($buttons, 'cactus_compare_table');
		array_push($buttons, 'cactus_posts_grid');
		array_push($buttons, 'cactus_posts_carousel');
		array_push($buttons, 'cactus_posts_classic_slider');
		array_push($buttons, 'cactus_posts_parallax');
		array_push($buttons, 'cactus_posts_slider');
		array_push($buttons, 'cactus_posts_thumb_slider');
		array_push($buttons, 'cactus_smart_content_box');
		array_push($buttons, 'cactus_testimonial');
		array_push($buttons, 'cactus_topic_box');
		array_push($buttons, 'cactus_download_box');
		array_push($buttons, 'cactus_icon_box');
		array_push($buttons, 'cactus_divider');
		array_push($buttons, 'cactus_live_content');
		array_push($buttons, 'cactus_tab');
		return $buttons;
	}

	function regplugins($plgs)
	{
		$plgs['cactus_shortcode_button'] 		= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/shortcode-button.js';
		$plgs['cactus_dropcap'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/dropcap.js';
		$plgs['cactus_tooltip'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/tooltip.js';
		$plgs['cactus_button'] 					= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/button.js';
		$plgs['cactus_alert'] 					= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/alert.js';
		$plgs['cactus_compare_table'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/compare-table.js';
		$plgs['cactus_posts_grid'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/posts-grid.js';
		$plgs['cactus_posts_carousel'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/posts-carousel.js';
		$plgs['cactus_posts_classic_slider'] 	= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/posts-classic-slider.js';
		$plgs['cactus_posts_parallax'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/posts-parallax.js';
		$plgs['cactus_posts_slider'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/posts-slider.js';
		$plgs['cactus_posts_thumb_slider'] 		= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/posts-thumb-slider.js';
		$plgs['cactus_smart_content_box'] 		= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/smart-content-box.js';
		$plgs['cactus_testimonial'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/testimonial.js';
		$plgs['cactus_topic_box'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/topic-box.js';
		$plgs['cactus_download_box'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/download-box.js';
		$plgs['cactus_icon_box'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/icon-box.js';
		$plgs['cactus_divider'] 				= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/divider.js';
		$plgs['cactus_live_content'] 			= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/live-content.js';
		$plgs['cactus_tab'] 					= CT_SHORTCODE_PLUGIN_URL . 'shortcodes/js/tab.js';
		return $plgs;
	}
}

$ctshortcode = new CactusThemeShortcodes();
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); //for check plugin status
// Register element with visual composer and do shortcode
include('shortcodes/smart-contentbox.php');
include('shortcodes/posts-grid.php');
include('shortcodes/posts-classic-slider.php');
include('shortcodes/posts-thumb-slider.php');
include('shortcodes/posts-slider.php');
include('shortcodes/posts-parallax.php');
include('shortcodes/posts-carousel.php');
include('shortcodes/testimonials.php');
include('shortcodes/dropcap.php');
include('shortcodes/tooltip.php');
include('shortcodes/button.php');
include('shortcodes/alert.php');
include('shortcodes/google-adsense-responsive.php');
include('shortcodes/compare-table.php');
include('shortcodes/topic-box.php');
include('shortcodes/icon-box.php');
include('shortcodes/download-box.php');
include('shortcodes/divider.php');
include('shortcodes/live-content.php');
include('shortcodes/tab.php');
include('shortcodes/newstube_playlist.php');

//function
if(!function_exists('cactus_hex2rgb')){
	function cactus_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}
//Smart ct box
if(!function_exists('smartcontentbox_query')){
	function smartcontentbox_query($number,$conditions,$sort_by,$categories,$tags,$featured,$ids,$paged,$offset = false) {
		if($conditions == 'view' && $ids == ''){
            
            if(function_exists('bawpvc_main')){
                // BAW plugin
			  $args = array(
				  'post_type' => 'post',
				  'posts_per_page' => $number,
				  'meta_key' => '_count-views_all',
				  'orderby' => 'meta_value_num',
				  'order' => $sort_by,
				  'post_status' => 'publish',
				  'tag' => $tags,
				  'ignore_sticky_posts' => 1
			  );	
			} elseif(function_exists('get_tptn_post_count')) {
                // Top 10 plugin
                $ids = '';
                
                if(!$offset){
                    $offset = 0;
                    if($paged && $paged > 0) $offset = ($paged - 1) * $number;
                }
                    
                $args2 = array(
                    'daily' => 0,
                    'post_types' => 'post',
                    'limit' => $number,
                    'offset' => $offset
                );
                
                $ids = cactus_get_tptn_pop_posts($args2);

                $args = array(
                    'post__in'=> $ids,
                    'orderby'=> 'post__in'
                );
            }
		}elseif($conditions == 'comment' && $ids == ''){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'orderby' => 'comment_count',
				'order' => $sort_by,
				'post_status' => 'publish',
				'tag' => $tags
				);
				
		}elseif($conditions == 'high_rated' && $ids == ''){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'meta_key' => '_count-views_all',
				'orderby' => 'meta_value_num',
				'order' => $sort_by,
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1
				);
		} elseif($ids != ''){
			$ids = explode(",", $ids);
			$gc = array();
			$dem=0;
			foreach ( $ids as $grid_cat ) {
				$dem++;
				array_push($gc, $grid_cat);
			}
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'orderby' => 'post__in',
				'post_status' => 'publish',
				'tag' => $tags,
				'post__in' =>  $gc,
				'ignore_sticky_posts' => 1);

		} elseif($ids=='' && $conditions=='latest'){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'order' => $sort_by,
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1);
				
		} elseif($ids=='' && $conditions=='like'){
			global $wpdb;	
			$time_range = 'all';
			
			$order_by = 'ORDER BY like_count DESC, post_title';
			$show_excluded_posts = get_option('wti_like_post_show_on_widget');
			$excluded_post_ids = explode(',', get_option('wti_like_post_excluded_posts'));
			
			if(!$show_excluded_posts && count($excluded_post_ids) > 0) {
				$where = "AND post_id NOT IN (" . get_option('wti_like_post_excluded_posts') . ")";
			}
			else {$where = '';}
			$query = "SELECT post_id, SUM(value) AS like_count, post_title FROM `{$wpdb->prefix}wti_like_post` L, {$wpdb->prefix}posts P ";
			$query .= "WHERE L.post_id = P.ID AND post_status = 'publish' AND value > -1 $where GROUP BY post_id $order_by";
			$posts = $wpdb->get_results($query);
			
			$p_data = array();
			
			if(count($posts) > 0) {
				foreach ($posts as $post) {
					$p_data[] = $post->post_id;
				}
			}

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'orderby'=> 'post__in',
				'order' => 'ASC',
				'post_status' => 'publish',
				'tag' => $tags,
				'post__in' =>  $p_data,
				'ignore_sticky_posts' => 1);
		} else {
			if($conditions == 'random'){ $conditions = 'rand';}
			if($conditions == 'random'){ $conditions = 'rand';}
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'order' => $sort_by,
				'orderby' => $conditions, /* title or modified */
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1);
		}
		if($featured==1 && $ids==''){
			$args += array('meta_key' => 'featured_post', 'meta_value' => 'yes');
		}
		if(!is_array($categories)) {
			if(isset($categories)){
				$cats = explode(",",$categories);
				if(is_numeric($cats[0])){
					//$args += array('category__in' => $cats);
					$args['category__in'] = $cats;
				}else{			 
					$args['category_name'] = $categories;
				}
			}
		}else if(count($categories) > 0){
			$args += array('category__in' => $categories);
		}
		
		if($paged){$args['paged'] = $paged;}
		if(isset($offset) && $offset!='' && is_numeric($offset)){$args['offset'] = $offset;}
		$query = new WP_Query($args);
		
		return $query;
	}	
	
}

function cactusSCBdata_html() {
	$page ='';
	$page = $_POST['page'];
	if(isset($_POST['dataShortcode'])){
		$arr_sc = explode(",",$_POST['dataShortcode']);
		//print_r($arr_sc);
		$per_page = $arr_sc[0];
		$condition = $arr_sc[1];
		$order = $arr_sc[2];
		$cats = str_replace(' ',',',$arr_sc[3]);
		$tags = str_replace(' ',',',$arr_sc[4]);
		$featured = $arr_sc[5];
		$ids = str_replace(' ',',',$arr_sc[6]);
		$enable_cat_filter =  $arr_sc[7];
		$show_meta = $arr_sc[8];
		$count = $arr_sc[9];
		$layout = $arr_sc[10];
		$big_thumbnail = $arr_sc[11];
		$show_category_tag = $arr_sc[12];
		$total_pg = $arr_sc[13];
		$end_pg_it = $arr_sc[14];
		$show_datetime  = $arr_sc[15];
		$show_author = $arr_sc[16];
		$show_comment_count = $arr_sc[17];
		$show_like = $arr_sc[18];
		$show_dislike = $arr_sc[19];
		$show_view = $arr_sc[20];
		$offset ='';
		if(isset($arr_sc[21])){
			$offset = $arr_sc[21];		
		}
	}
	$check_item_last_page = 0;
	if(($total_pg==$page) && ($end_pg_it < $per_page) && ($end_pg_it!=0)){ $check_item_last_page = $end_pg_it;}
	if(isset($_POST['category'])&& $_POST['category']!='all'){$cats = $_POST['category'];}
	if($per_page==''){$per_page='4';}
	$the_query = smartcontentbox_query($per_page,$condition,$order,$cats,$tags,$featured,$ids,$page,$offset);
	$it = $the_query->post_count;	
	$show_excerpt = "no";
	$show_content = "no";
	$show_read_more = "no";
	$show_sub_abs_post = "no";
	
	if($the_query->have_posts()){
		?>
		<div class="cactus-listing-wrap">
		  <!--Config-->        
		  <div class="cactus-listing-config style-1"> <!--addClass: style-1 + (style-a -> style-f)-->
				  
			  <div class="cactus-listing-content">
			  
				  <div class="cactus-sub-wrap">
								
					<?php
					$it_c = 0;
					while($the_query->have_posts()){ $the_query->the_post();
						$it_c++;
						if($it_c>$check_item_last_page && $total_pg==$page&&$check_item_last_page!=0){
							break;
						}
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
						
						if($layout=='4'&&$it_c==2){
						?>
						<div class="fix-right-style-4">
						<?php }?>
						<div class="cactus-post-item hentry <?php if($per_page==1&&$it_c==1 &&$layout=='4' ){?> no-last-post <?php }?>">
									<!--content-->
									<div class="entry-content">
										<div class="primary-post-content"> <!--addClass: related-post, no-picture -->
																		
											<!--picture-->
                                            <?php  if ( cactus_thumbnail('full')!='' || $layout=='3' || $layout=='5') { ?>
											<div class="picture">
                                            	<?php
												//global $cactus_width;
													if($layout=='1'&& $it_c==1 || $layout=='4'&& $it_c==1 || $layout=='6'){
														$thumb_sz = $big_thumbnail?'thumb_780x470':'thumb_390x235';
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
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<?php echo cactus_thumbnail($thumb_sz); 
														?>
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
													if($show_category_tag != 0)
                                                    {
                                                        if(!empty($category)){
                                                            echo cactus_get_category($category);
                                                           }
                                                    }
                                                    ?>                                          
													<?php echo tm_post_rating(get_the_ID());?>
													<?php if($show_sub_abs_post == "yes") {?>
                                                        <div class="content-abs-post">
                                                            <?php 
                                                            if($show_category_tag != 0)
                                                            {
                                                                if(!empty($category)){
                                                                    echo cactus_get_category($category);
                                                                   }
                                                            }
                                                            ?>
                                                            <?php echo tm_post_rating(get_the_ID());?>
                                                            <h3 class="h4 cactus-post-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                                        </div>
                                                    <?php }?>    													
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
                                                        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) && $show_comment_count!=0 ) : ?>
                                                            <?php comments_popup_link('0', '1','%', 'comment cactus-info'); ?>
                                                        <?php endif; ?>
                                                        <?php
                                                        if(function_exists('GetWtiLikeCount')){
                                                            $like = GetWtiLikeCount(get_the_ID());
                                                            $unlike = GetWtiUnlikeCount(get_the_ID());
                                                        ?>
                                                            <?php if($show_like!=0) {?><div class="like cactus-info"><?php echo $like?></div><?php }?>
                                                            <?php if($show_dislike!=0) {?><div class="dislike cactus-info"><?php echo $unlike?></div><?php }?>
                                                        <?php }?>
                                                        <?php if($show_view!=0) {?><div class="view cactus-info"><?php echo  cactus_short_number(get_post_meta(get_the_ID(),'_count-views_all',true)) ?></div><?php }?>
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

			  </div><!--Config-->
		  </div><!--Listing-->
		<?php
	}
	wp_reset_postdata();
	exit;
}
add_action( 'wp_ajax_cactusSCBdata', 'cactusSCBdata_html' );
add_action( 'wp_ajax_nopriv_cactusSCBdata', 'cactusSCBdata_html' );
//smartctbox json
function cactusSCBjson_json() {
	if(isset($_POST['dataShortcode'])){
		$arr_sc = explode(",",$_POST['dataShortcode']);
		$per_page = $arr_sc[0];
		$condition = $arr_sc[1];
		$order = $arr_sc[2];
		$cats = str_replace(' ',',',$arr_sc[3]);
		$tags = str_replace(' ',',',$arr_sc[4]);
		$featured = $arr_sc[5];
		$ids = $arr_sc[6];
		$enable_cat_filter =  $arr_sc[7];
		$show_meta = $arr_sc[8];
		$count = $arr_sc[9];
	}
	if(isset($_POST['category'])&& $_POST['category']!='all'){$cats = $_POST['category'];}
	$number_it = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page='');
	$num_it = $number_it->post_count;
	if(($count=='-1') || ($count > $num_it)){$count = $num_it;}
	$array=	array	('totalRecords' => $num_it, 'itemInPage' => $per_page);
	echo json_encode($array);exit;
}
add_action( 'wp_ajax_cactusSCBjson', 'cactusSCBjson_json' );
add_action( 'wp_ajax_nopriv_cactusSCBjson', 'cactusSCBjson_json' );
//
if(!function_exists('cactus_short_number')) {
function cactus_short_number($n, $precision = 3) {
	$n = $n*1;
    if ($n < 1000000) {
        // Anything less than a million
        $n_format = number_format($n);
    } else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, $precision) . 'M';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000000, $precision) . 'B';
    }

    return $n_format;
}
}

if(!function_exists('cactus_get_tptn_pop_posts')){
	/*
	$args = array(
		'daily' => true, -- false to get all
		'daily_range' => '', -- number date to get
		'limit' => '', -- number post to query
		'offset' => '', -- number of posts to ignore
		'post_types' => '',
	);
	*/
	function cactus_get_tptn_pop_posts( $args = array() ) {
		if(!function_exists('get_tptn_post_count_only')){
			return;
		}
		global $wpdb, $tptn_settings;
		if($tptn_settings == ''){ $tptn_settings = array();}	
		// Initialise some variables
		if($tptn_settings)
		$fields = '';
		$where = '';
		$join = '';
		$groupby = '';
		$orderby = '';
		$limits = '';
	
		$defaults = array(
			'daily' => true,
			'strict_limit' => true,
			'posts_only' => false,
		);
	
		// Merge the $defaults array with the $tptn_settings array
		$defaults = array_merge( $defaults, $tptn_settings );
	
		// Parse incomming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );
		if ( $args['daily'] ) {
			$table_name = $wpdb->base_prefix . 'top_ten_daily';
		} else {
			$table_name = $wpdb->base_prefix . 'top_ten';
		}
		
	
		$limit = $args['limit'] ? $args['limit'] : 0;
	
		// If post_types is empty or contains a query string then use parse_str else consider it comma-separated.
		if ( ! empty( $args['post_types'] ) && false === strpos( $args['post_types'], '=' ) ) {
			$post_types = explode( ',', $args['post_types'] );
		} else {
			parse_str( $args['post_types'], $post_types );	// Save post types in $post_types variable
		}
	
		// If post_types is empty or if we want all the post types
		if ( empty( $post_types ) || 'all' === $args['post_types'] ) {
			$post_types = get_post_types( array(
				'public'	=> true,
			) );
		}
	
		$blog_id = get_current_blog_id();
	
		$current_time = current_time( 'timestamp', 0 );
		$from_date = $current_time - ( $args['daily_range'] * DAY_IN_SECONDS );
		$from_date = gmdate( 'Y-m-d' , $from_date );
	
		/**
		 *
		 * We're going to create a mySQL query that is fully extendable which would look something like this:
		 * "SELECT $fields FROM $wpdb->posts $join WHERE 1=1 $where $groupby $orderby $limits"
		 */
	
		// Fields to return
		$fields[] = 'ID';
		$fields[] = 'postnumber';
		$fields[] = ( $args['daily'] ) ? 'SUM(cntaccess) as sumCount' : 'cntaccess as sumCount';
	
		$fields = implode( ', ', $fields );
	
		// Create the JOIN clause
		$join = " INNER JOIN {$wpdb->posts} ON postnumber=ID ";
	
		// Create the base WHERE clause
		$where .= $wpdb->prepare( ' AND blog_id = %d ', $blog_id );				// Posts need to be from the current blog only
		$where .= " AND $wpdb->posts.post_status = 'publish' ";					// Only show published posts
	
		if ( $args['daily'] ) {
			$where .= $wpdb->prepare( " AND dp_date >= '%s' ", $from_date );	// Only fetch posts that are tracked after this date
		}
	
		// Convert exclude post IDs string to array so it can be filtered
		$exclude_post_ids = explode( ',', $args['exclude_post_ids'] );
	
		/**
		 * Filter exclude post IDs array.
		 *
		 * @param array   $exclude_post_ids  Array of post IDs.
		 */
		$exclude_post_ids = apply_filters( 'tptn_exclude_post_ids', $exclude_post_ids );
	
		// Convert it back to string
		$exclude_post_ids = implode( ',', array_filter( $exclude_post_ids ) );
	
		if ( '' != $exclude_post_ids ) {
			$where .= " AND $wpdb->posts.ID NOT IN ({$exclude_post_ids}) ";
		}
		$where .= " AND $wpdb->posts.post_type IN ('" . join( "', '", $post_types ) . "') ";	// Array of post types
	
		// How old should the posts be?
		if ( $args['how_old'] ) {
			$where .= $wpdb->prepare( " AND $wpdb->posts.post_date > '%s' ", gmdate( 'Y-m-d H:m:s', $current_time - ( $args['how_old'] * DAY_IN_SECONDS ) ) );
		}
	
		// Create the base GROUP BY clause
		if ( $args['daily'] ) {
			$groupby = ' postnumber ';
		}
	
		// Create the base ORDER BY clause
		$orderby = ' sumCount DESC ';
	
		// Create the base LIMITS clause
		$limits .= $limit ? $wpdb->prepare( ' LIMIT %d ', $limit ): '';	
		$limits .= $limits ? $wpdb->prepare('OFFSET %d', $args['offset'] ? $args['offset'] : 0) : '';
	
		if ( ! empty( $groupby ) ) {
			$groupby = " GROUP BY {$groupby} ";
		}
		if ( ! empty( $orderby ) ) {
			$orderby = " ORDER BY {$orderby} ";
		}
	
		$sql = "SELECT DISTINCT $fields FROM {$table_name} $join WHERE 1=1 $where $groupby $orderby $limits";
		$results = $wpdb->get_results( $sql );
		$ids = array();
		foreach ( $results as $result ) {
			$ids[] = $result->ID;
		}
		return $ids;
	}
}

