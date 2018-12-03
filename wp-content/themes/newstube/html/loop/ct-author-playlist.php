    <?php 
	global $author;
    $userdata               = get_userdata($author);
	$paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
    $args = array(
        'post_type' => 'ct_playlist',
		'author__in' => array($userdata->ID),
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
		'paged' => $paged,
        'orderby' => 'modified',
    );
    $list_query = new WP_Query( $args );
	$total_page = ceil($list_query->found_posts / get_option('posts_per_page'));
    $it = $list_query->post_count;
    if($list_query->have_posts()){?>

<?php
	  global $wp_query,$wp;
	  $main_query = $wp_query;
	  $wp_query = $list_query;
	  ?>

	  <script type="text/javascript">
	   var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":<?php echo str_replace('\/', '/', json_encode($args)) ?>,"current_url":"<?php echo home_url($wp->request);?>" }
	  </script>    
    <div class="cactus-sub-wrap">
    	<?php while(have_posts()){the_post(); 
			get_template_part( 'cactus-channel/content-playlist' );
		}?>
    </div>
    <div class="page-navigation"><?php cactus_paging_nav('.cactus-sub-wrap','cactus-channel/content-playlist', esc_html__('Load More Playlists','cactus')); ?></div>
    <?php 
	}
	?>
    <?php 
	wp_reset_postdata();
	if($it>0){
	$wp_query = $main_query;
	}
