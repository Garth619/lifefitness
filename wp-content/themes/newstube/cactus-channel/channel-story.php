<!--


-->
<?php while ( have_posts() ) : the_post();
global $cpage;
?>
    <?php 
	$cr_id_cn = get_the_ID();
	$paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
		'paged' => $paged,
		'orderby' => 'latest',
        'meta_query' => array(
            array(
                'key' => 'channel_id',
                 'value' => get_the_ID(),
                 'compare' => 'LIKE',
            ),
        )
    );
	if(isset($_GET['sortby'])&& $_GET['sortby']=='view'){
		$args['posts_per_page' ] = -1;
		$postlist = get_posts($args);
		$posts_id = array();
		foreach ( $postlist as $post ) {
		   $posts_id[] += $post->ID;
		}
		wp_reset_postdata();
		$args = null;
		$args = array(
			  'post_type' => 'post',
			  'posts_per_page' => -1,
			  'meta_key' => '_count-views_all',
			  'orderby' => 'meta_value_num',
			  'post_status' => 'publish',
			  'post__in' =>  $posts_id,
			  'ignore_sticky_posts' => 1,
			  'paged' => $paged,
		);
		$postlist_co = get_posts($args);
		$posts_id_co = array();
		foreach ( $postlist_co as $post ) {
		   $posts_id_co[] += $post->ID;
		}
		$co_result= array_diff($posts_id,$posts_id_co);
		$posts_id = array_merge($posts_id_co, $co_result);
		wp_reset_postdata();
		$args = null;
		$args = array(
			  'post_type' => 'post',
			  'orderby'=> 'post__in',
			  'post__in' =>  $posts_id,
			  'ignore_sticky_posts' => 1,
			  'paged' => $paged,
		);
	}elseif(isset($_GET['sortby'])&& $_GET['sortby']=='comment'){
		$args['orderby']= 'comment_count';
	}elseif(isset($_GET['sortby'])&& $_GET['sortby']=='like'){
		$args['posts_per_page' ] = -1;
		$postlist = get_posts($args);
		$posts_id = array();
		foreach ( $postlist as $post ) {
		   $posts_id[] += $post->ID;
		}
		wp_reset_postdata();
		global $wpdb;
		$time_range = 'all';
		$order_by = 'ORDER BY like_count DESC, post_title';
		$show_excluded_posts = get_option('wti_like_post_show_on_widget');
		$excluded_post_ids = explode(',', get_option('wti_like_post_excluded_posts'));

		if(!$show_excluded_posts && count($excluded_post_ids) > 0) {
			$where = "AND post_id NOT IN (" . get_option('wti_like_post_excluded_posts') . ")";
		}
		else{$where = '';}
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
			'orderby'=> 'post__in',
			'order' => 'ASC',
			'post_status' => 'publish',
			'post__in' =>  $p_data,
			'ignore_sticky_posts' => 1,
			'paged' => $paged,
			'meta_query' => array(
				array(
					'key' => 'channel_id',
					 'value' => $cr_id_cn,
					 'compare' => 'LIKE',
				),
			)
		);
		$postlist_like = get_posts($args);
		$postlist_id_like = array();
		foreach ( $postlist_like as $post ) {
		   $postlist_id_like[] += $post->ID;
		}
		$like_result= array_diff($posts_id,$postlist_id_like);
		$posts_id = array_merge($postlist_id_like, $like_result);
		wp_reset_postdata();
		$args = null;
		$args = array(
			  'post_type' => 'post',
			  'orderby'=> 'post__in',
			  'post__in' =>  $posts_id,
			  'ignore_sticky_posts' => 1,
			  'paged' => $paged,
		);
	}
    $list_query = new WP_Query( $args );
    $it = $list_query->post_count;
    if($list_query->have_posts()){
		while($list_query->have_posts()){$list_query->the_post();
		global $first_it;
		$first_it =  get_the_ID();
		?>
    
        <div class="post-channel-special col-md-6 pull-left cactus-listing-content">
            <!--item listing-->
            <div class="cactus-post-item hentry">
                
                <!--content-->
                <div class="entry-content">
                    <div class="primary-post-content"> <!--addClass: related-post, no-picture -->
                                                    
                        <!--picture-->
                        <div class="picture">
                            <div class="picture-content">
                                <a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>">
                                    <?php echo cactus_thumbnail( 'thumb_560x400' ); ?>
                                    <div class="thumb-overlay"></div>
                                    <i class="fa fa-play-circle-o cactus-icon-fix"></i>
                                </a>                                         
                                <?php echo tm_post_rating(get_the_ID());?>
                                <div class="cactus-note-time"><?php echo get_post_meta(get_the_ID(),'time_video',true) ?></div>
                            </div>
                            
                        </div><!--picture-->
                        
                        <div class="content">
                            
                            <!--Title-->
                            <h3 class="h4 cactus-post-title entry-title"> 
                                <a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>"><?php echo esc_attr(get_the_title(get_the_ID()));?></a>
                            </h3><!--Title-->
                            
                            <!--info-->
                            <!--info-->
                            <div class="posted-on">
                                <?php echo cactus_get_datetime();?>
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>" class="author cactus-info"><?php the_author_meta( 'display_name' ); ?></a>
                                <a href="<?php comments_link(); ?>" class="comment cactus-info"><?php echo get_comments_number(get_the_ID());?></a>
                                <?php
                                if(function_exists('GetWtiLikePost')){ 
                                    $like = $unlike = '';
                                    if(function_exists('GetWtiLikeCount')){$like = GetWtiLikeCount(get_the_ID());}
                                    if(function_exists('GetWtiUnlikeCount')){$unlike = GetWtiUnlikeCount(get_the_ID());}
                                    ?>
                                    <div class="like cactus-info"><?php echo $like ?></div>
                                    <div class="dislike cactus-info"><?php echo $unlike ?></div>
                                    <?php
                                }?>
                                <?php if(function_exists('bawpvc_main') || function_exists('get_tptn_post_count_only')){?>
                                <div class="view cactus-info"><?php echo get_formatted_string_number(cactus_get_post_view(get_the_ID())); ?></div>
                                <?php }?>
                            </div><!--info-->
                            
                            <!--excerpt-->
                            <div class="excerpt"><?php the_excerpt(); ?></div><!--excerpt-->
                            
                            <!--read more-->
                            <div class="cactus-readmore">
                                <a href="<?php the_permalink();?>"><?php esc_html_e('read more','cactus'); ?></a>
                            </div><!--read more-->
                            
                            <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                        </div>
                    </div>
                    
                </div><!--content-->
                
            </div><!--item listing-->
        </div>
	<?php
	break; 
	}
wp_reset_postdata();	
}?>
<div class="col-md-6 pull-right cactus-listing-content main-content-col"> <!--ajax div-->
  <div class="cactus-listing-heading fix-channel">
      <div class="navi-channel">                                        	
          <div class="navi pull-left">
              <div class="navi-content">
                  <div class="navi-item <?php if( (!isset($_GET['view']) &&  ($cpage =='')) || ( (isset($_GET['view']) && $_GET['view'] =='videos') &&  ($cpage =='')) || ((isset($_GET['view']) && $_GET['view'] =='')&&  ($cpage ==''))){?> active <?php }?>"><a href="<?php echo add_query_arg( array('view' => 'videos'), get_the_permalink() ); ?>" title=""><?php esc_html_e('videos','cactus');?></a></div>
                  <div class="navi-item <?php if((isset($_GET['view']) && $_GET['view'] =='playlists')){?> active <?php }?>"><a href="<?php echo add_query_arg( array('view' => 'playlists'), get_the_permalink() ); ?>" title=""><?php esc_html_e('playlists','cactus');?></a></div>
                  
                  <?php if ( comments_open() || '0' != get_comments_number() ) :?>
                  <div class="navi-item <?php if((isset($_GET['view']) && $_GET['view'] =='discussion') || ($cpage !='')){?> active <?php }?>"><a href="<?php echo add_query_arg( array('view' => 'discussion'), get_the_permalink() ); ?>" title=""><?php esc_html_e('discussion','cactus');?></a></div>
                  <?php endif;?>
                  
                  <div class="navi-item <?php if((isset($_GET['view']) && $_GET['view'] =='about')){?> active <?php }?>"><a href="<?php echo add_query_arg( array('view' => 'about'), get_the_permalink() ); ?>" title=""><?php esc_html_e('about','cactus');?></a></div>
              </div>
          </div>
          
      </div>
  </div>
      <?php 
      if(isset($_GET['view']) && $_GET['view'] =='playlists'){
          get_template_part( 'cactus-channel/ct-channel-playlist' );
      }elseif(isset($_GET['view']) && $_GET['view'] =='discussion' || ($cpage !='')){
          get_template_part( 'cactus-channel/ct-channel-discus' );
      }elseif(isset($_GET['view']) && $_GET['view'] =='about'){
          get_template_part( 'cactus-channel/ct-channel-about' );
      }else{
          //include( '.php');
          get_template_part( 'cactus-channel/ct-channel-video' );
      }
      ?>                                
      <div class="discus-none" style="display:none">
          <?php get_template_part( 'cactus-channel/ct-channel-discus' ); ?>
      </div>
      <script>
          var locationHashComment = window.location.hash;
          var showElementstag = jQuery('.cactus-listing-wrap .style-channel .combo-change, .cactus-listing-wrap .style-channel .cactus-sub-wrap, .cactus-listing-wrap .style-channel .page-navigation');
          if(locationHashComment!='' && locationHashComment!=null && typeof(locationHashComment)!='undefined' && locationHashComment.toString().split("-").length == 2){
              showElementstag.css({'display':'none'});
              jQuery('.cactus-listing-wrap .style-channel .discus-none').show();
              jQuery('.cactus-listing-wrap .style-channel .navi-content .navi-item').removeClass('active');
              jQuery('.cactus-listing-wrap .style-channel .navi-content .navi-item').eq(2).addClass('active');
          };
      </script>
</div>
<?php endwhile; // end of the loop. ?>
