<?php
if(!function_exists('cactus_subcribe_button')){
	function cactus_subcribe_button($ID=''){
		$subcribe_ID = $ID != '' ? $ID : get_the_ID();
		$j_subscribe = '';
		$j_subscribe_text = esc_html__('subscribe','cactus');
		if ( is_user_logged_in() ) {
			?>
			<script>
			jQuery(document).ready(function() {
				function isNumber(n) {return !isNaN(parseFloat(n)) && isFinite(n);};
				var id_sub = "#subscribe-<?php echo $subcribe_ID ; ?>";
				if(jQuery(id_sub).length > 0) {
					jQuery(id_sub).click(function(){	
						jQuery(id_sub).addClass('cactus-disable-btn');			
						var $url = "<?php echo wp_nonce_url(home_url().'/?id='.$subcribe_ID.'&id_user='.get_current_user_id(),'idn'.$subcribe_ID,'sub_wpnonce'); ?>";
						$url = ($url.split("amp;").join(""));
						var counterCheck = 0;
						jQuery.get($url, function( data ) {
						  if(data==1){
							  jQuery(id_sub).addClass( "subscribed" ).removeClass('cactus-disable-btn');
							  counterCheck=jQuery(id_sub).find('.subscribe-counter').text();
							  if(isNumber(counterCheck)) {
								  counterCheck=parseFloat(counterCheck);
								  jQuery(id_sub).find('.subscribe-counter').text(counterCheck+1);
							  };
							  jQuery(id_sub).find('.first-title').text('<?php esc_html_e('subscribed','cactus');?>');
						  }else{
							  jQuery(id_sub).removeClass( "subscribed" ).removeClass('cactus-disable-btn');
							  counterCheck=jQuery(id_sub).find('.subscribe-counter').text();
							  if(isNumber(counterCheck)) {
								  counterCheck=parseFloat(counterCheck);
								  jQuery(id_sub).find('.subscribe-counter').text(counterCheck-1);
							  };
							  jQuery(id_sub).find('.first-title').text('<?php esc_html_e('subscribe','cactus');?>');
						  };
						});
					});
				};
			});
			</script>
			<?php 
			$meta_user = get_user_meta(get_current_user_id(), 'subscribe_channel_id',true);
			if(!is_array($meta_user)&& $meta_user== $subcribe_ID){
				$j_subscribe = 'subscribed';
				$j_subscribe_text = esc_html__('subscribed','cactus');
			}elseif(is_array($meta_user)&& in_array($subcribe_ID, $meta_user)){
				$j_subscribe = 'subscribed';
				$j_subscribe_text = esc_html__('subscribed','cactus');
			}
			$l_href = 'javascript:;';
		}else{
			$l_href = wp_login_url( get_permalink() );
		}
		$subscribe_counter = get_post_meta($subcribe_ID, 'subscribe_counter',true);
		if($subscribe_counter){
			$subscribe_counter = get_formatted_string_number($subscribe_counter);
		}else{$subscribe_counter = 0;}
		?>
        <div class="subs-button <?php echo $j_subscribe; ?>" id="subscribe-<?php echo $subcribe_ID; ?>">
        	<div class="loading-subscribe">
                <div class="floatingCirclesG">
                    <div class="f_circleG frotateG_01"></div>
                    <div class="f_circleG frotateG_02"></div>
                    <div class="f_circleG frotateG_03"></div>
                    <div class="f_circleG frotateG_04"></div>
                    <div class="f_circleG frotateG_05"></div>
                    <div class="f_circleG frotateG_06"></div>
                    <div class="f_circleG frotateG_07"></div>
                    <div class="f_circleG frotateG_08"></div>
                </div>
            </div>
            <div class="subs-row">
                <div class="subs-cell"><a href="<?php echo $l_href;?>"><i class="fa fa-eye"></i><i class="fa fa-times"></i><i class="fa fa-check"></i> <span class="first-title"><?php echo $j_subscribe_text;?></span><span class="last-title"><?php esc_html_e('unSubscribe','cactus');?></span></a></div>
                <div class="subs-cell"><span class="subscribe-counter"><?php echo $subscribe_counter;?></span></div>
            </div>
        </div>
        <?php
	}
}
//subscribe button
add_action( 'init', 'ajax_cactus_subscribe_button' );

function ajax_cactus_subscribe_button(){
	if(isset($_GET['sub_wpnonce']) && wp_verify_nonce($_GET['sub_wpnonce'], 'idn' . $_GET['id'])&&!is_admin()){
		$meta =  get_user_meta($_GET['id_user'], 'subscribe_channel_id',true);
		$subscribe_counter =  (int)get_post_meta($_GET['id'], 'subscribe_counter',true);
		if($subscribe_counter=='' || $subscribe_counter==null) {$subscribe_counter=0;};
		if($meta){
			if(!is_array($meta)){
				if($meta!= $_GET['id']){
					$arr = array();
					array_push($arr, $meta);
					array_push($arr, $_GET['id']);
					$meta = $arr;
					update_user_meta( $_GET['id_user'], 'subscribe_channel_id', $meta);
					$subscribe_counter = $subscribe_counter +1; 
					update_post_meta( $_GET['id'], 'subscribe_counter', $subscribe_counter);
					echo '1';
				}else{
					$meta= '';
					update_user_meta( $_GET['id_user'], 'subscribe_channel_id', $meta);
					$subscribe_counter = $subscribe_counter -1; 
					update_post_meta( $_GET['id'], 'subscribe_counter', $subscribe_counter);
					echo '0';
				}
			}else{
				if(in_array($_GET['id'], $meta)){
					$key = array_search($_GET['id'], $meta);
					unset($meta[$key]);
					update_user_meta( $_GET['id_user'], 'subscribe_channel_id', $meta);
					$subscribe_counter = $subscribe_counter -1; 
					update_post_meta( $_GET['id'], 'subscribe_counter', $subscribe_counter);
					echo 0;
				}else{
					array_push($meta, $_GET['id']);
					update_user_meta( $_GET['id_user'], 'subscribe_channel_id', $meta);
					$subscribe_counter = $subscribe_counter +1; 
					update_post_meta( $_GET['id'], 'subscribe_counter', $subscribe_counter);
					echo 1;
				}
			}
		}else{
			$meta = $_GET['id'];
			update_user_meta( $_GET['id_user'], 'subscribe_channel_id', $meta);
			$subscribe_counter = $subscribe_counter +1; 
			update_post_meta( $_GET['id'], 'subscribe_counter', $subscribe_counter);
			echo 1;
		}
		exit;
	}
}
