<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package cactus
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
$live_cm = get_post_meta($post->ID,'live_comment',true);
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>
	<?php 
	if($live_cm=='on'){
		$arrFixCommentPlaceholder = array(
									'comment_field' => '<textarea id="comment" name="comment" aria-required="true" placeholder="'.esc_html__('Your comment ...','cactus').'"></textarea>',
									'title_reply'       => esc_html__( 'YOUR COMMENTS', 'cactus' ),
									'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'cactus' ),
									);
		comment_form($arrFixCommentPlaceholder); 
	};
    ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				echo esc_html__('Comment', 'cactus').'(<span id="tdt-f-number-calc">'.number_format_i18n( get_comments_number() ).'</span>)';
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' )  && $live_cm!='on') : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'cactus' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'cactus' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'cactus' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation 
		$order ='ASC';
		if($live_cm=='on'){
			$order ='DESC';
			$cm_auto_refresh = get_post_meta($post->ID,'cm_auto_refresh',true);
			if($cm_auto_refresh=='' || !is_numeric($cm_auto_refresh)){$cm_auto_refresh='5';}
			?>
			<script>
				jQuery(document).ready(function($) {					
					
					function testSpaceBar(obj){
						if(obj.value=="")return false;
						else{		
							var s = obj.value;
							var temp = s.split(" ");
							var str = "";
							for(var i=0; i<temp.length; i++)str=str + temp[i];
							if(str==""){
								obj.value = str.substring(0,str.length);
								return false;
							}
						}
						return true;
					};
					
					jQuery('#commentform').submit(function(){
						if(jQuery(this).find('.logged-in-as').length > 0) {
							if(!testSpaceBar(document.getElementById('comment'))) {								
								return false;
							}else{
								jQuery(this).find('#submit').css({'opacity':'0.5', 'pointer-events':'none'});
							};
						}else{
							if(!testSpaceBar(document.getElementById('email')) || !testSpaceBar(document.getElementById('comment')) || !testSpaceBar(document.getElementById('author')) ) {								
								return false;
							}else{
								jQuery(this).find('#submit').css({'opacity':'0.5', 'pointer-events':'none'});
							};
						};
					});
															
					function formatNumber (num) {return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");};
					function isNumber(n) {return !isNaN(parseFloat(n)) && isFinite(n);};
					function replaceAll(find, replace, str) {return str.replace(new RegExp(find, 'g'), replace);}
					
					var id_comment = "#load-comment-<?php echo $post->ID; ?>";	
					function checkNumberCommentPlus(data){
						var defaultNumber = replaceAll(',','',jQuery(id_comment).parents('#comments').find('#tdt-f-number-calc').text());
						if(isNumber(defaultNumber)) {
							jQuery(id_comment).parents('#comments').find('#tdt-f-number-calc').text(formatNumber(parseFloat(defaultNumber)+(data.split('<!-- #comment-## -->').length-1)));
						};
					};
					
					function setIDDateComments(){
						var strListID = '';
						var lengthComments = jQuery('#comments .comment').length;
						jQuery('#comments .comment').each(function(index, element) {
                            var commentID = $(this).attr('id');
							if(index == lengthComments-1){
								strListID+=(commentID.split('-')[1]);
							}else{
								strListID+=(commentID.split('-')[1])+',';
							}
                        });
						
						jQuery('#list_cm').val(strListID);
					}
					var intDate=0;
					var nowDate = 
					intDate = new Date().getTime();
					
					
					var refreshId;
					function createAutoRefresh(){
						$dateim = '<?php echo current_time( 'timestamp' );?>';
						$i =0;		
						refreshId = setInterval(function(){
								$i ++;
								if($i>1){
									$dateim = Math.round((parseFloat($dateim) + <?php echo $cm_auto_refresh;?>));
								}
								$idliscm = jQuery('#list_cm').val();
								var $url = "<?php echo wp_nonce_url(home_url('/').'?id='.$post->ID,'idn'.$post->ID,'ct_comment_wpnonce'); ?>&idlist="+($idliscm)+'&dateim='+($dateim);
								$url = ($url.split("amp;").join(""));
								jQuery.get($url, function( data ) {							
									jQuery(".comment-list").prepend(data);
									setIDDateComments();
									checkNumberCommentPlus(data);
								});
						}, <?php echo $cm_auto_refresh;?>000);
					};
					createAutoRefresh();
					function clearInterValAutoRefresh(){
						if(refreshId!=null) {
							clearInterval(refreshId);
						};
					};
					
					jQuery(id_comment).click(function(){
						$idliscm = jQuery('#list_cm').val();
						$page_cm = jQuery('#page_cm').val();
						var $url = "<?php echo wp_nonce_url(home_url('/').'?id='.$post->ID.'&ids='.$post->ID,'idn'.$post->ID,'cactus_load_cm'); ?>&idlist="+($idliscm)+"&page="+($page_cm);
						$url = ($url.split("amp;").join(""));
						clearInterValAutoRefresh();
						jQuery(id_comment).css({'pointer-events':'none'});
						jQuery(id_comment).find('.load-title').hide();
						jQuery(id_comment).find('.fa-refresh').removeClass('hide').addClass('fa-spin');
						
						jQuery.get($url, function( data ) {
							jQuery(".comment-list").append(data);
							setIDDateComments();
							jQuery(id_comment).css({'pointer-events':'auto'});
							jQuery(id_comment).find('.load-title').show();
							jQuery(id_comment).find('.fa-refresh').addClass('hide').removeClass('fa-spin');
							createAutoRefresh();
							if(data=='') {
								jQuery(id_comment).remove();
							};
						});
					});
				});
			</script>
			<?php 
            $arr_all = array(
                'comment__not_in' => '',
                'post_id' => $post->ID,
                'order' => $order,
                'number' => '',   
            );
            $cm_curent = array();
            foreach(get_comments($arr_all) as $comment) :
                $cm_curent[] = $comment->comment_ID;
            endforeach;
		}
		$arr = array(
			'comment__not_in' => '',
			'post_id' => $post->ID,
			'number' => get_option( 'comments_per_page' ),
		);
		$cm = get_comments($arr);
		$show_cm_it = array();
		foreach(get_comments($arr) as $it_comment) :
			$show_cm_it[] = $it_comment->comment_ID;
		endforeach;
		?>
		<ol class="comment-list">
        	<input type="hidden" id="list_cm" name="list_cm" value="<?php echo implode(",",$show_cm_it);?>">
            <input type="hidden" id="page_cm" name="page_cm" value="1">
			<?php
				if($live_cm=='on'){
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'avatar_size'       => 50,
					),$cm);
				}else{
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'avatar_size'       => 50,
					));
				};
			?>
		</ol><!-- .comment-list -->
		<?php if($live_cm== 'on' && count($cm_curent) > get_option( 'comments_per_page' )){?>
            <div class="page-navigation">	
            	<nav class="navigation-ajax" role="navigation">
                    <div class="wp-pagenavi">
                        <a id="load-comment-<?php echo $post->ID; ?>" href="javascript:;" class="loadmore-comment load-more">
                        	<div class="load-title"><?php esc_html_e('More Comments','cactus'); ?></div>
                            <i class="fa fa-refresh hide" id="load-spin"></i>
                        </a>
                    </div>
                </nav>	
			</div>
        <?php }?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) && $live_cm!='on') : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'cactus' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'cactus' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'cactus' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'cactus' ); ?></p>
	<?php endif; ?>

	<?php 
		if($live_cm!='on'){
			$arrFixCommentPlaceholder = array(
										'comment_field' => '<textarea id="comment" name="comment" aria-required="true" placeholder="'.esc_html__('Your comment ...','cactus').'"></textarea>',
										'title_reply'       => esc_html__( 'LEAVE YOUR COMMENT', 'cactus' ),
										'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'cactus' ),
										);
			comment_form($arrFixCommentPlaceholder); 
		};
	?>

</div><!-- #comments -->
