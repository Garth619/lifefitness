<?php
function parse_cactus_player($atts, $content){
global $post;
$file = get_post_meta($post->ID, 'tm_video_file', true);
global $url;
$url = trim(get_post_meta($post->ID, 'tm_video_url', true));
$code = trim(get_post_meta($post->ID, 'tm_video_code', true));
$multi_link = get_post_meta($post->ID, 'tm_multi_link', true);
global $link_arr;
global $is_auto_load_next_post;
if(!empty($multi_link)){
	$link_arr = tm_build_multi_link($multi_link, false);
	//check request
	if(isset($_GET['link']) && $_GET['link']!==''){
		$url = $link_arr[$_GET['link']]['url'];
	}
}
$auto_load = osp_get('ct_video_settings','auto_load_next_video');

$auto_load_prev = osp_get('ct_video_settings','auto_load_next_prev');
global $auto_play;
$auto_play = osp_get('ct_video_settings','auto_play_video');
$delay_video = osp_get('ct_video_settings','delay_video');
$delay_video=$delay_video*1000;
if($delay_video==''){$delay_video=1000;}
$detect = new Mobile_Detect;
global $_device_, $_device_name_, $_is_retina_;
$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
if($detect->isMobile() || $detect->isTablet()){
	$auto_play=0;
}
$onoff_related_yt= osp_get('ct_video_settings','onoff_related_yt');
$onoff_html5_yt= osp_get('ct_video_settings','onoff_html5_yt');
$using_yt_param = osp_get('ct_video_settings','using_yout_param');
$onoff_info_yt = osp_get('ct_video_settings','onoff_info_yt');
$allow_full_screen = osp_get('ct_video_settings','allow_full_screen');
$allow_networking = osp_get('ct_video_settings','allow_networking');
$remove_annotations = osp_get('ct_video_settings','remove_annotations');
$user_turnoff = '';//osp_get('ct_video_settings','user_turnoff_load_next');
$interactive_videos = osp_get('ct_video_settings','interactive_videos');
$using_jwplayer_param = osp_get('ct_video_settings','using_jwplayer_param');
$force_videojs = osp_get('ct_video_settings','force_videojs');
$single_player_video = osp_get('ct_video_settings','single_player_video');
$social_locker = get_post_meta($post->ID, 'social_locker', true);
$video_ads_id = get_post_meta($post->ID, 'ads_id', true);
$enable_video_ads = class_exists('cactus_ads') ? osp_get( 'ads_config', 'enable-ads' ) : 'no';
$show_popup_share = ot_get_option('show_popup_share', 'off');

$player_embed = $is_auto_load_next_post != '1' ? 'player-embed' : 'player-embed1';

$video_source = '';
$main_video_url = '';

if((strpos($file, 'youtube.com') !== false)||(strpos($url, 'youtube.com') !== false )) {
	$video_source = 'youtube';
	$main_video_url = extractIDFromURL($url);
}
else if((strpos($file, 'vimeo.com') !== false)||(strpos($url, 'vimeo.com') !== false )) {
	$video_source = 'vimeo';
	$main_video_url = extractIDFromURL($url);
}
else {
	$video_source = 'self-hosted';
	$main_video_url = $file;
}

echo '<input type="hidden" name="main_video_url" value="' . $main_video_url . '"/>
	 <input type="hidden" name="main_video_type" value="' . $video_source . '"/>';

$player_logic = get_post_meta($post->ID, 'player_logic', true);
if((strpos($player_logic, '[sociallocker]') !== false)){
	$auto_play = '0';
}
$player_logic_alt = get_post_meta($post->ID, 'player_logic_alt', true);
$video_source = '';
$id_vid = trim(get_post_meta($post->ID, 'tm_video_id', true));
if($force_videojs=='on' && $single_player_video== 'videojs'  && $is_auto_load_next_post != 1 && (strpos($url, 'youtube.com') !== false || (strpos($url, 'vimeo.com') !== false ) || strpos($url, 'dailymotion.com') !== false)){
}else{
	if((strpos($file, 'youtube.com') !== false)||(strpos($url, 'youtube.com') !== false )){
		
		if($using_yt_param != 1 && $using_jwplayer_param != 1){
			//if ads is on
			if(class_exists('cactus_ads') && ($enable_video_ads=='yes' && $video_ads_id !== '' ) && $is_auto_load_next_post != 1):

			?>
			<?php else:?>
			<script src="//www.youtube.com/player_api"></script>
				<script>
					// create youtube player
					var player;
					function onYouTubePlayerAPIReady() {
						player = new YT.Player('<?php echo $player_embed; ?>', {
						  height: '506',
						  width: '900',
						  videoId: '<?php echo extractIDFromURL($url); ?>',
						  <?php if($onoff_related_yt!= '0' || $onoff_html5_yt== '1' || $remove_annotations!= '1' || $onoff_info_yt=='1' || $allow_full_screen=='0'){ ?>
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
							  <?php 
							  if($allow_full_screen=='0'){
							  ?>
							  fs:0,
							  <?php }?>
						  },
						  <?php }?>
						  events: {
							<?php if($auto_play=='1'){
								?>
							'onReady': onPlayerReady,
							<?php } if($auto_load=='1' || $user_turnoff==1 || $show_popup_share == 'on'){?>
							'onStateChange': onPlayerStateChange
							<?php } ?>
						  }
						});
					}
					// autoplay video
					<?php
					if($auto_play=='1'){?>
					function onPlayerReady(event) { event.target.playVideo(); }
					<?php }?>
					// when video ends
					function onPlayerStateChange(event) {
						if(event.data === 0) {
							<?php if($show_popup_share == 'on'):?>
								jQuery('body').addClass('popup-share-active');
							<?php endif;?>
							<?php if($auto_load=='1'): ?>
								setTimeout(function(){
									var link = jQuery('a.cactus-new').attr('href');
									<?php if($auto_load_prev){ ?>
										link = jQuery('a.cactus-old').attr('href');
									<?php } ?>
									var className = jQuery('#tm-autonext span#autonext').attr('class');
									//alert(className);
									if(className!=''){
									  if(link !=undefined){ window.location.href= link; }
									}
								},<?php echo $delay_video ?>);
							<?php endif;?>
					}
				}
		
				</script>
		<?php 
		endif;
		}
		if($using_jwplayer_param==1 && class_exists('JWP6_Plugin') && $single_player_video!='jwplayer_7'){?>
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
	}else if( $auto_load == '1' && (strpos($file, 'vimeo.com') !== false )|| $auto_load == '1' && (strpos($url, 'vimeo.com') !== false )|| $auto_load == '1' &&(strpos($code, 'vimeo.com') !== false ) ){
		
		if(class_exists('cactus_ads') && ($enable_video_ads=='yes' && $video_ads_id !== '' ) && $is_auto_load_next_post != 1):
		?>
		<?php else:?>
		<script src="//a.vimeocdn.com/js/froogaloop2.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				jQuery('iframe').attr('id', 'player_1');
	
				var iframe = jQuery('#player-embed #player_1')[0],
					player = $f(iframe),
					status = jQuery('.status_videos');
	
				// When the player is ready, add listeners for pause, finish, and playProgress
				player.addEvent('ready', function() {

					status.text('ready');
	
					player.addEvent('pause', onPause);
					<?php if ($auto_load=='1' || $user_turnoff==1 || $show_popup_share == 'on'){?>
					player.addEvent('finish', onFinish);
					<?php }?>
					//player.addEvent('playProgress', onPlayProgress);
				});
	
				// Call the API when a button is pressed
				jQuery(window).load(function() {
					player.api(jQuery(this).text().toLowerCase());
				});
	
				function onPause(id) {
				}
	
				function onFinish(id) {
					<?php if($show_popup_share == 'on'):?>
						jQuery('body').addClass('popup-share-active');
					<?php endif;?>
					<?php if($auto_load=='1'): ?>
						setTimeout(function(){
							var link = jQuery('a.cactus-new').attr('href');
							<?php if($auto_load_prev){ ?>
								link = jQuery('a.cactus-old').attr('href');
							<?php } ?>
							var className = jQuery('#tm-autonext span#autonext').attr('class');
							//alert(className);
							if(className!=''){
							  if(link !=undefined){ window.location.href= link; }
							}
						},<?php echo $delay_video ?>);
					<?php endif;?>
				}
			});
		</script>
	<?php endif; } else if( $auto_load=='1' && (strpos($file, 'dailymotion.com') !== false )||  $auto_load=='1' && (strpos($url, 'dailymotion.com') !== false )){?>
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
			var player = DM.player("player-embed", {video: "<?php echo extractIDFromURL($url); ?>", width: "900", height: "506", params:{'html':1, <?php if($auto_play=='1'){?>autoplay :1, <?php } if($onoff_info_yt== '1'){?> info:0, <?php } if($onoff_related_yt== '1'){?> related:0 <?php }?>}});
	
			// 4. We can attach some events on the player (using standard DOM events)
			player.addEventListener("ended", function(e)
			{
				<?php if($show_popup_share == 'on'):?>
					jQuery('body').addClass('popup-share-active');
				<?php endif;?>
				<?php if($auto_load=='1'): ?>
					setTimeout(function(){
						var link = jQuery('a.cactus-new').attr('href');
						<?php if($auto_load_prev){ ?>
							link = jQuery('a.cactus-old').attr('href');
						<?php } ?>
						var className = jQuery('#tm-autonext span#autonext').attr('class');
						//alert(className);
						if(className!=''){
						  if(link !=undefined){ window.location.href= link; }
						}
					},<?php echo $delay_video ?>);
				<?php endif;?>
				
			});
		};
	</script>
<?php }
}//end if player
wp_reset_postdata();
//endwhile;
?>
	
<?php
    ob_start(); //for social locker
?>
<div id="player-embed" 
	<?php if(strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {echo 'class="fix-youtube-player"';}?> 
	<?php if((strpos($file, 'dailymotion.com') !== false) || (strpos($url, 'dailymotion.com') !== false) || ($code !='')){echo 'class="fix-dailymotion-player"';}?>
>
    <?php
		if( ($using_jwplayer_param==1 && $single_player_video =='jwplayer_7' && (strpos($url, 'youtube.com') !== false  || strpos($url, 'youtu.be') !== false))
			|| ($single_player_video =='jwplayer_7' && $file !=='')){
			cactus_jwplayer7();
		}elseif($force_videojs=='on' && $single_player_video== 'videojs' && $is_auto_load_next_post != 1   && (strpos($url, 'youtube.com') !== false  || strpos($url, 'youtu.be') !== false || (strpos($url, 'vimeo.com') !== false ) || strpos($url, 'dailymotion.com') !== false)){
            ?>
            <link type="text/css" rel="stylesheet" href="https://vjs.zencdn.net/4.5.1/video-js.css" />
            <script src="https://vjs.zencdn.net/4.5.1/video.js"></script>
            <?php 
            global $url;
            global $auto_play;
            if(strpos($url, 'youtube.com') !== false  || strpos($url, 'youtu.be') !== false){
            ?>
            <script src="<?php echo plugins_url('/inc/videojs/youtube.js', __FILE__); ?>" ></script>
            <video id="vid1" src="" class="video-js vjs-default-skin" controls preload="auto" width="640" height="360" data-setup='{ "techOrder": ["youtube"], "src": "<?php echo $url;?>" <?php if($auto_play=='1'){?>, "autoplay": true <?php }?>}'></video>
            <?php 
            }else
            if (strpos($url, 'vimeo.com') !== false){?>
            <video id="vid1" muted src="" class="video-js vjs-default-skin" controls preload="auto" width="640" height="360" data-setup='{ "techOrder": ["vimeo"], "src": "<?php echo $url;?>", "loop": true <?php if($auto_play=='1'){?>, "autoplay": true <?php }?> }'></video>
            <script src="<?php echo plugins_url('/inc/videojs/vjs.vimeo.js', __FILE__); ?>" ></script>
            <?php }else
            if (strpos($url, 'dailymotion.com') !== false){?>
            <script src="<?php echo plugins_url('/inc/videojs/vjs.dailymotion.js', __FILE__); ?>" ></script>
            <script>
                    videojs.options.flash.swf = "<?php echo plugins_url('/inc/videojs/video-js.swf', __FILE__); ?>";
            </script>
            <video id="vid1" class="video-js vjs-default-skin" controls preload="auto" width="750" height="506"
                   data-setup='{ "techOrder": ["dailymotion"], "dmControls" : "1", "src": "<?php echo $url;?>"}'></video>
            <?php }?>

            <?php
        }else{
            if((strpos($url, 'wistia.com') !== false )|| (strpos($code, 'wistia.com') !== false ) ){
                $id = substr($url, strrpos($url,'medias/')+7);
                ?>
                <div id="wistia_<?php echo $id ?>" class="wistia_embed" style="width:900px;height:506px;" data-video-width="900" data-video-height="506">&nbsp;</div>
                <script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js"></script>
                <script>
                wistiaEmbed = Wistia.embed("<?php echo $id ?>", {
                  version: "v1",
                  videoWidth: 900,
                  videoHeight: 506,
                  volumeControl: true,
                  controlsVisibleOnLoad: true,
                  playerColor: "688AAD",
                  volume: 5
                });
                </script>
                <?php
            }else {
                 if((strpos($file, 'youtube.com') !== false  || strpos($url, 'youtu.be') !== false) && ($using_yt_param ==1) || (strpos($url, 'youtube.com') !== false  || strpos($url, 'youtu.be') !== false) && ($using_yt_param == 1)){?>
                 <div class="obj-youtube">
                    <object width="900" height="506">
                    <param name="movie" value="//www.youtube.com/v/<?php echo extractIDFromURL($url); ?><?php if($onoff_related_yt!= '0'){?>&rel=0<?php }if($auto_play=='1'){?>&autoplay=1<?php }if($onoff_info_yt=='1'){?>&showinfo=0<?php }if($remove_annotations!= '1'){?>&iv_load_policy=3<?php }if($onoff_html5_yt== '1'){?>&html5=1<?php }?>&wmode=transparent" ></param>
                    <param name="allowFullScreen" value="<?php if($allow_full_screen!='0'){?>true<?php }else {?>false<?php }?>"></param>
                    <?php if($interactive_videos==0){?>
                    <param name="allowScriptAccess" value="samedomain"></param>
                    <?php } else {?>
                    <param name="allowScriptAccess" value="always"></param>
                    <?php }?>
                    <param name="wmode" value="transparent"></param>
                    <embed src="//www.youtube.com/v/<?php echo extractIDFromURL($url);if($onoff_related_yt!= '0'){?>&rel=0<?php }if($auto_play=='1'){?>&autoplay=1<?php }if($onoff_info_yt=='1'){?>&showinfo=0<?php }if($remove_annotations!= '1'){?>&iv_load_policy=3<?php }if($onoff_html5_yt== '1'){?>&html5=1<?php }?>"
                      type="application/x-shockwave-flash"
                      allowfullscreen="<?php if($allow_full_screen!='0'){?>true<?php }else {?>false<?php }?>"
                      <?php if($allow_networking=='0'){ ?>
                      allowNetworking="internal"
                      <?php }?>
                      <?php if($interactive_videos==0){?>
                      allowscriptaccess="samedomain"
                      <?php } else {?>
                      allowscriptaccess="always"
                      <?php }?>
                      wmode="transparent"
                      width="100%" height="100%">
                    </embed>
                    </object>
                    </div>
                 <?php
                 }else {
                     if($auto_play=='1'){ $url = (tm_video($post->ID, true));
                     }else { $url = (tm_video($post->ID, false));  }
                 }
             }
        }// end if player
        ?>
    <?php
    
    ?>            
</div><!--/player-->
<?php if($single_player_video == 'mediaelement' && $file != ''):?>
	<script>
		cactus_player = jQuery('#player-embed .wp-video-shortcode');
		cactus_player.get(0).onended = function(e) {
			<?php if($show_popup_share == 'on'):?>
				jQuery('body').addClass('popup-share-active');
			<?php endif;?>
			<?php if($auto_load=='1'): ?>
				setTimeout(function(){
					var link = jQuery('a.cactus-new').attr('href');
					<?php if($auto_load_prev){ ?>
						link = jQuery('a.cactus-old').attr('href');
					<?php } ?>
					var className = jQuery('#tm-autonext span#autonext').attr('class');
					//alert(className);
					if(className!=''){
					  if(link !=undefined){ window.location.href= link; }
					}
				},<?php echo $delay_video ?>);
			<?php endif;?>
        }
	</script>
<?php endif;?>

<?php
    //social locker
    $player_html=ob_get_contents();
    ob_end_clean();
    
    if(class_exists('cactus_ads') && ($enable_video_ads=='yes' && $video_ads_id !== '' ) && $is_auto_load_next_post != 1)
    {
    	$player_html = apply_filters('cactus_player_html','', $player_html, $post->ID);
    }



    //for new shortcode
    ob_start();
    echo $player_html;

    $player_html_2=ob_get_contents();
    ob_end_clean();
    
    if(!strpos($player_logic, '[player]')===false){ //have shortcode
        echo do_shortcode(str_replace("[player]",$player_html_2,$player_logic));
    }elseif($player_logic){
        $player_logic="return (" . $player_logic . ");";
        if( eval($player_logic) ){
            echo $player_html_2;
        }elseif($player_logic_alt){
            echo '<div class="player-logic-alt">'.do_shortcode($player_logic_alt).'</div>';
        }
    }else{
        echo $player_html_2;
    }
}

add_shortcode( 'cactus_player', 'parse_cactus_player' );

