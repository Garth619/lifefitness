<?php 
			global $author;
    		$userdata               = get_userdata($author);
			$paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
			$query = new WP_Query( array( 'post_type' => 'ct_channel', 'author__in' => array($userdata->ID) , 'paged' => $paged) );
			$it = $query->post_count;
			if($query->have_posts()){
				global $wp_query,$wp;
				$main_query = $wp_query;
				$wp_query = $query;
				?>
				
				<script type="text/javascript">
				 var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":<?php echo str_replace('\/', '/', json_encode(array( 'post_type' => 'ct_channel', 'author__in' => array($userdata->ID) , 'paged' => $paged))) ?>,"current_url":"<?php echo home_url($wp->request);?>" }
				</script> 
                <div class="cactus-sub-wrap">
				<?php	
				while ( $query->have_posts() ) : $query->the_post(); 
					get_template_part( 'html/loop/content-channel-at' );
				endwhile;
				wp_reset_postdata();
				?>
                </div>
                <div class="page-navigation"><?php cactus_paging_nav('.cactus-sub-wrap','html/loop/content-channel-at', esc_html__('Load More Channels','cactus')); ?></div>
                <?php
			}?>
        <?php
		if($it>0){ 
			$wp_query = $main_query;
		}
		?>
