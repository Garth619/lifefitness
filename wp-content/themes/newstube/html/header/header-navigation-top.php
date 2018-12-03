<div id="top-nav">

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!--Headlines-->
             <?php get_sidebar('headline');?>
            <!--Headlines-->
            <?php 
			$user_show_info = ot_get_option('user_show_info');
			if($user_show_info!='off'){
			?>
			<ul class="nav navbar-nav navbar-right top-menu-rps cactus-login">                	                 
                <li>   
                	<?php if ( !is_user_logged_in() ) { ?>                                      
                    	<a href="<?php echo wp_login_url(get_current_url());?>"><?php esc_html_e('login','cactus');?></a>
                    <?php }else{
					$current_user = wp_get_current_user();
					 ?>
                    	<a href="javascript:;"><?php echo $current_user->display_name;?></a>
                        <?php
						if(has_nav_menu( 'user-menu' )){
							?>
							 <ul class="dropdown-menu">
								<?php
                                wp_nav_menu(array(
                                    'theme_location'  => 'user-menu',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                ));
                                ?>
                            	<li><a href="<?php echo wp_logout_url( get_current_url() ); ?>"><?php esc_html_e('Logout','cactus') ?></a></li>
							</ul>
							<?php 
						}else{
						?>
                        <ul class="dropdown-menu">
                        	<?php
                        	$query = new WP_Query( array('post_type'  => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'page-templates/newsfeed-subscribe.php' ) );
                            if ( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post();?>
                            	<li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endwhile; 
							wp_reset_postdata();
							?>
                            <li><a href="<?php echo get_edit_user_link( $current_user->ID ); ?>"><?php esc_html_e('Edit Profile','cactus') ?></a></li>
                            <li><a href="<?php echo wp_logout_url( get_current_url() ); ?>"><?php esc_html_e('Logout','cactus') ?></a></li>
                        </ul>
                        <?php }?>
                    <?php }?>
                </li>                                       
            </ul>
            <?php }?>	
            <!--Share list-->
           <?php 
		   		cactus_print_social_accounts();
		   ?>
            <!--Share list-->

            <!--Menu-->
            <ul class="nav navbar-nav navbar-right rps-hidden top-menu-rps">
                <?php
                    if(has_nav_menu( 'top-menu' )){
                        wp_nav_menu(array(
                            'theme_location'  => 'top-menu',
                            'container' => false,
                            'items_wrap' => '%3$s',
                        ));
                    }
                ?>
            </ul><!--Menu-->

            <!--mobile-->
            <?php if(has_nav_menu( 'top-menu' )){
				$ct_topmenu = wp_nav_menu(array(
								'echo'  => false,
								'theme_location'  => 'top-menu',
								'container' => false,
								'items_wrap' => '%3$s',
							));
				if(!is_wp_error($ct_topmenu) && !empty($ct_topmenu)) {
			?>
                    <ul class="open-menu-mobile-top nav navbar-nav navbar-right">
                        <li>
                            <a href="javascript:;"> <span></span><span></span><span></span></a>
                            <!--Submenu-->
                            <ul class="dropdown-menu">
                                <?php                            
                                    echo $ct_topmenu;
                                ?>
                            </ul>
                            <!--Submenu-->
                        </li>
                    </ul>
            <?php 
				};
			};?>
            <!--mobile-->

        </div>
    </nav>

</div>
