<?php
    global $navigation_style;
?>
<div id="main-menu">

    <nav class="navbar navbar-default <?php echo ot_get_option('sticky_up_down')=='down'?'fix-down-scroll':'';?>" role="navigation">
        <div class="container">
            <div class="main-menu-wrap">
                <?php $sticky_logo = ot_get_option('logo_image_sticky','') == '' ? esc_url(get_template_directory_uri()) . '/images/logo-dark-3.png' : ot_get_option('logo_image_sticky',''); ?>
                <ul class="nav navbar-nav cactus-logo-nav is-sticky-menu">
                    <li><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo $sticky_logo; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"></a></li>
                </ul>
                <?php if($navigation_style == 'style_3'):?>
					<?php $logo = ot_get_option('logo_image','') == '' ? esc_url(get_template_directory_uri()) . '/images/logo.png' : ot_get_option('logo_image',''); ?>
                    <ul class="nav navbar-nav cactus-logo-nav">
                        <li><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo $logo; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"></a></li>
                    </ul>
                <?php endif;?>
                <ul class="nav navbar-nav open-menu-mobile">
                  <li class="show-mobile open-menu-mobile-rps"><a href="javascript:;"><i class="fa fa-bars"></i></a></li>
                </ul>
                
                <?php
                    $megamenu = ot_get_option('megamenu', 'off');
                    $megamenu_class = ($megamenu == 'on' && function_exists('mashmenu_load')) ? 'cactus-megamenu' : '';
                ?>
                <!--HTML Struc (truemag)-->
                <ul class="nav navbar-nav cactus-main-menu <?php echo esc_attr($megamenu_class);?>">
                    <?php
                        if($megamenu == 'on' && function_exists('mashmenu_load') && has_nav_menu( 'primary' )){
                            mashmenu_load();
                        }elseif(has_nav_menu( 'primary' )){
                            wp_nav_menu(array(
                                'theme_location'  => 'primary',
                                'container' => false,
                                'items_wrap' => '%3$s',
                                'walker'=> new custom_walker_nav_menu()
                            )); 
                        }else{?>
                            <li><a href="<?php echo home_url(); ?>/"><?php esc_html_e('Home','cactus') ?></a></li>
                            <?php wp_list_pages('depth=1&title_li=' ); ?>
                    <?php } ?>
                </ul>
                <!--HTML Struc (truemag)-->
				<?php
					if(ot_get_option('user_submit')==1) {
						$text_bt_submit = ot_get_option('text_bt_submit');
						$bg_bt_submit = ot_get_option('bg_bt_submit');
						$color_bt_submit = ot_get_option('color_bt_submit');
						$bg_hover_bt_submit = ot_get_option('bg_hover_bt_submit');
						$color_hover_bt_submit = ot_get_option('color_hover_bt_submit');
						if($bg_hover_bt_submit!='' || $color_hover_bt_submit !='' ){?>
							<style>
								.navbar-right.user_submit li:hover a,
								.navbar-right.user_submit:hover{ background-color:<?php echo $bg_hover_bt_submit;?> !important}
								.navbar-right.user_submit:hover a span{ color:<?php echo $color_hover_bt_submit;?> !important}
							</style>
						<?php }
						if($text_bt_submit==''){ $text_bt_submit = esc_html__('Submit Video','cactus');}
						if(ot_get_option('only_user_submit',1)){
							if(is_user_logged_in()){?>
							<ul class="nav navbar-nav navbar-right hidden-xs user_submit">
								<li class="main-menu-item">

									<a class="submit-video" href="#" data-toggle="modal" data-target="#submitModal" <?php if($bg_bt_submit){?> style="background-color:<?php echo $bg_bt_submit;?>"<?php }?>>
                                    	<span class="btn btn-xs" <?php if($color_bt_submit){?> style="color:<?php echo $color_bt_submit;?>"<?php }?> ><?php _e($text_bt_submit,'cactus'); ?></span>
                                    </a>
								</li>
							</ul>
						<?php }
						} else{
						?>
							<ul class="nav navbar-nav navbar-right hidden-xs user_submit" <?php if($bg_bt_submit){?> style="background-color:<?php echo $bg_bt_submit;?>"<?php }?>>
								<li class="main-menu-item">
									<a class="submit-video" href="#" data-toggle="modal" data-target="#submitModal" <?php if($bg_bt_submit){?> style="background-color:<?php echo $bg_bt_submit;?>"<?php }?>>
                                    	<span class="btn btn-xs" <?php if($color_bt_submit){?> style="color:<?php echo $color_bt_submit;?>"<?php }?>><?php _e($text_bt_submit,'cactus'); ?></span>
                                   </a>
								</li>
							</ul>
						<?php
						}
						if($limit_tags = ot_get_option('user_submit_limit_tag')){ ?>
						<script>
						jQuery(document).ready(function(e) {
							jQuery("form.wpcf7-form").submit(function (e) {
								var submit_tags = jQuery('input[name=tag].wpcf7-form-control').val().split(",");
								if(submit_tags.length > <?php echo $limit_tags ?>){
									if(jQuery('.limit-tag-alert').length==0){
										jQuery('.wpcf7-form-control-wrap.tag').append('<span role="alert" class="wpcf7-not-valid-tip limit-tag-alert"><?php esc_html_e('Please enter less than or equal to ','cactus') .$limit_tags. esc_html_e(' tags', 'cactus'); ?>.</span>');
									}
									return false;
								}else{
									return true;
								}
							});
						});
						</script>
						<?php
						}
				} ?>
                <?php if(ot_get_option('enable_search')!='off'){ ?>
                <!--Search-->
                <ul class="nav navbar-nav navbar-right search-drop-down dark-div">
                    <li>
                        <a href="javascript:;" class="open-search-main-menu"><i class="fa fa-search"></i><i class="fa fa-times"></i></a>
                        <ul class="search-main-menu">
                            <li>
                                <form action="<?php echo esc_url(home_url());?>" method="get">
                                    <input type="hidden" name="post_type" value="post">
                                    <input type="text" placeholder="<?php echo esc_html_e('Search...','cactus');?>" name="s" value="<?php echo esc_attr(get_search_query());?>">
                                    <i class="fa fa-search"></i>
                                    <input type="submit" value="<?php echo esc_html_e('search','cactus');?>">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--Search-->
				<?php }?>
            </div>
        </div>
    </nav>
	<input type="hidden" name="sticky_navigation" value="<?php echo esc_attr(ot_get_option('sticky_navigation', 'off'));?>"/>
</div>
