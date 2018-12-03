<?php
/**
 * The Template for displaying all related posts by Category & tag.
 *
 * @package cactus
 */
?>
<?php
$delay_video=1000;
$url = trim(get_post_meta($post->ID, 'tm_video_url', true));
$onoff_related_yt= osp_get('ct_video_settings','onoff_related_yt');
$onoff_html5_yt= osp_get('ct_video_settings','onoff_html5_yt');
$onoff_info_yt = osp_get('ct_video_settings','onoff_info_yt');
$remove_annotations = osp_get('ct_video_settings','remove_annotations');
$using_jwplayer_param = osp_get('ct_video_settings','using_jwplayer_param');

$youtube_reg = '/(y2u\.be)|(youtu\.be)/i';
if ( preg_match( $youtube_reg, $url ) ) {
	$_temp = explode( '/', $url );
	$url = 'https://www.youtube.com/watch?v=' . $_temp[count($_temp) - 1];
}
?>
<script language="javascript" type="text/javascript">
	function nextVideoAndRepeat(delayVideo){
		setTimeout(function(){
			var nextLink;
			var itemNext = jQuery('.cactus-widget-posts-item.active .widget-picture-content a').parents('.cactus-widget-posts-item');
			if(itemNext.next().length > 0) {
				nextLink = itemNext.next().find('.widget-picture-content').find('a').attr('href');
			}else{
				nextLink = jQuery('.cactus-widget-posts-item', '.cactus-video-list-content').eq(0).find('.widget-picture-content').find('a').attr('href');
			};
			if(nextLink != '' && nextLink != null && typeof(nextLink)!='undefined'){ window.location.href= nextLink; }
		}, delayVideo);
	};
</script>
<?php
	if((strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false )){
		if( $using_jwplayer_param!=1){
			?>
			<script src="//www.youtube.com/player_api"></script>
				<script>
					
					// create youtube player
					var player;
					function onYouTubePlayerAPIReady() {
						player = new YT.Player('player-embed', {
						  height: '506',
						  width: '900',
						  videoId: '<?php echo extractIDFromURL($url); ?>',
						  <?php if($onoff_related_yt!= '0' || $onoff_html5_yt== '1' || $remove_annotations!= '1' || $onoff_info_yt=='1'){ ?>
						  playerVars : {
							 <?php if($remove_annotations!= '1'){?>
							  iv_load_policy : 3,
							  <?php }
							  if($onoff_related_yt== '1'){?>
							  rel : 0,
							  <?php }
							  if($onoff_html5_yt== '1'){
							  ?>
							  html5 : 1,
							  <?php }
							  if($onoff_info_yt=='1'){
							  ?>
							  showinfo:0,
							  <?php }?>
						  },
						  <?php }?>
						  events: {
							'onReady': onPlayerReady,
							'onStateChange': onPlayerStateChange
						  }
						});
					};
					// autoplay video
					function onPlayerReady(event) { if(!navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {event.target.playVideo();} }
					// when video ends
					function onPlayerStateChange(event) {
						if(event.data === 0) {
							nextVideoAndRepeat(<?php echo $delay_video ?>);
						};
					};		
				</script>
		<?php 

		}
		if($using_jwplayer_param==1 && class_exists('JWP6_Plugin')){?>
		<script>
			jQuery(document).ready(function() {
				jwplayer("player-embed").setup({
					file: "<?php echo $url ?>",
					width: 900,
					height: 506
				});
			});
			</script>
		<?php
		}
	}else if( strpos($url, 'vimeo.com') !== false ){
		?>
		<?php 
			if ( is_ssl() ) { ?>
				<script src="https://secure-a.vimeocdn.com/js/froogaloop2.min.js"></script>
			<?php } else { ?>
				<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
			<?php } ?>
		<script>
			jQuery(document).ready(function() {
				jQuery('iframe').attr('id', 'player_1');
	
				var iframe = jQuery('#player_1')[0],
					player = $f(iframe),
					status = jQuery('.status_videos');
	
				// When the player is ready, add listeners for pause, finish, and playProgress
				player.addEvent('ready', function() {
					status.text('ready');
	
					player.addEvent('pause', onPause);
					player.addEvent('finish', onFinish);
					//player.addEvent('playProgress', onPlayProgress);
				});
	
				// Call the API when a button is pressed
				jQuery(window).load(function() {
					player.api(jQuery(this).text().toLowerCase());
				});
	
				function onPause(id) {
				}
	
				function onFinish(id) {
					nextVideoAndRepeat(<?php echo $delay_video ?>);
				}
			});
		</script>
	<?php  }else if( (strpos($url, 'dailymotion.com') !== false )){?>
	<script>
		// This code loads the Dailymotion Javascript SDK asynchronously.
		(function() {
			var e = document.createElement('script'); e.async = true;
			e.src = document.location.protocol + '//api.dmcdn.net/all.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(e, s);
		}());
	
		// This function init the player once the SDK is loaded
		window.dmAsyncInit = function()
		{
			// PARAMS is a javascript object containing parameters to pass to the player if any (eg: {autoplay: 1})
			var player = DM.player("player-embed", {video: "<?php echo extractIDFromURL($url); ?>", width: "900", height: "506", params:{<?php if($auto_play=='1'){?>autoplay :1, <?php } if($onoff_info_yt== '1'){?> info:0, <?php } if($onoff_related_yt== '1'){?> related:0 <?php }?>}});
	
			// 4. We can attach some events on the player (using standard DOM events)
			player.addEventListener("ended", function(e)
			{
				nextVideoAndRepeat(<?php echo $delay_video ?>);
				
			});
		};
	</script>
<?php }
		
?>
    <?php 
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'orderby' => 'date',
		'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'playlist_id',
                 'value' => $_GET['list'],
                 'compare' => 'LIKE',
            ),
        )
    );
    global $post;
    $author_id=$post->post_author;
	$cr_post_id = $post->ID;
    $url_author = get_author_posts_url( $author_id );
    $author_name = get_the_author_meta( 'display_name', $author_id);
    $the_query = new WP_Query( $args );
	global $check_empty_it;	 
    $it = $the_query->post_count;
	if($it== 0){
		$check_empty_it = 'off';
	}
    if($the_query->have_posts()){?>
	<div class="cactus-top-style-post style-3">
    <!--breadcrumb-->
    <?php if( function_exists('ct_breadcrumbs')){
         ct_breadcrumbs(); 
    } 
    //breadcrumb

        $i =0;
        while($the_query->have_posts()){ $the_query->the_post();
        $i++;
        $file = get_post_meta($post->ID, 'tm_video_file', true);
        $url = trim(get_post_meta($post->ID, 'tm_video_url', true));
        $code = trim(get_post_meta($post->ID, 'tm_video_code', true));
        if(strpos($url, 'youtube.com') !== false){}
        if($i==1){
        ?>           
        <div class="style-post-content dark-div">
            <div class="cactus-video-list-content" data-auto-first="1" data-label = "<?php esc_html_e(' videos','cactus');?>">
                <div class="player-content">
                    <div class="player-iframe">
                        <div class="iframe-change" id="player-embed">
                            <?php tm_video($cr_post_id, true);?>
                        </div>
                        
                        <div class="video-loading">
                            <div class="circularG-wrap">
                                <div class="circularG_1 circularG"></div>
                                <div class="circularG_2 circularG"></div>
                                <div class="circularG_3 circularG"></div>
                                <div class="circularG_4 circularG"></div>
                                <div class="circularG_5 circularG"></div>
                                <div class="circularG_6 circularG"></div>
                                <div class="circularG_7 circularG"></div>
                                <div class="circularG_8 circularG"></div>
                            </div>
                        </div>
                        <?php echo tm_post_rating($cr_post_id);?>
                    </div>                                        	
                </div>
                
                <div class="video-listing">
                    <div class="user-header">
                        <h6><?php echo esc_attr(get_the_title(get_the_ID()));?></h6>
                        <!--info-->
                        <div class="posted-on">                                                    
                            <a href="<?php echo $url_author; ?>" class="author cactus-info"> <?php echo $author_name;?></a>
                            <div class="total-video cactus-info"><span></span><?php esc_html_e(' videos','cactus');?></div>
                        </div><!--info-->
                        
                        <a href="javascript:;" class="pull-right open-video-playlist">play list&nbsp; <i class="fa fa-sort-desc"></i></a>  
                        <a href="javascript:;" class="pull-left open-video-playlist"><i class="fa fa-bars"></i></a>  
                    </div>
                    
                    <div class="fix-open-responsive">
                    
                        <div class="video-listing-content">
                        
                            <div class="cactus-widget-posts">
                            <?php }?>
                    
                                <!--item listing-->
                                <div class="cactus-widget-posts-item <?php if(get_the_ID() == $cr_post_id){ echo 'active';} ?>" data-source="<?php echo extractChanneldFromURL($url);?>"  data-id-post"<?php echo get_the_ID();?>">
                                      <!--picture-->
                                      <div class="widget-picture">
                                        <div class="widget-picture-content"> 
                                          <a href="<?php echo add_query_arg( array('list' => $_GET['list']), get_the_permalink() ); ?>" class="click-play-video-1" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>">
                                            <?php echo cactus_thumbnail( 'thumb_103x68' ); ?>                                                                  
                                          </a>
                                          <?php echo tm_post_rating(get_the_ID());?>
                                          <div class="cactus-note-time"><?php echo get_post_meta(get_the_id(),'time_video',true) ?></div>
                                        </div>
                                      </div>
                                      <!--picture-->
                                      
                                      <div class="cactus-widget-posts-content"> 
                                        <!--Title-->
                                        <h3 class="h6 widget-posts-title"> <a href="<?php echo add_query_arg( array('list' => $_GET['list']), get_the_permalink() ); ?>" class="click-play-video" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>"><?php echo esc_attr(get_the_title(get_the_ID()));?></a></h3>
                                        <!--Title--> 
                                        
                                        <!--info-->
                                        <div class="posted-on"> 
                                    		<?php echo cactus_get_datetime();?>
                                          	<div class="comment cactus-info"><?php echo get_comments_number(get_the_ID());?></div>
                                        </div>
                                        <!--info-->
                                
                                      </div>  
                                      
                                      <div class="order-number"><?php echo $i; ?></div>   
                                      <div class="video-active"></div>
                                </div>
                                <!--item listing-->
                                
                            <?php if($i==$it){?>														
                            </div>
                            
                        </div>
                        
                    </div>
                            
                </div>
            </div>
            
        </div>
        <?php }
        }
        
        wp_reset_postdata();
		?>
    </div>    
    <?php
    }?>
