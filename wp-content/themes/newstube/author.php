<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cactus
 */

get_header();
global $_is_retina_;

//get test layout variable from query string
parse_str($_SERVER['QUERY_STRING']);

$sidebar = ot_get_option('blog_sidebar','right');

if($sidebar == 'hidden') $sidebar = 'full';
?>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-listing-wrap cactus-sidebar-control category-change-style-slider <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
        	<div class="cactus-listing-config style-1 style-3 author-page"> <!--addClass: style-1 + (style-2 -> style-n)-->
            <div class="container">
                <div class="row">
                        <div class="main-content-col col-md-12 cactus-listing-content">
                        	<?php if(is_active_sidebar('content-top-sidebar')){
								echo '<div class="content-top-sidebar-wrap">';
								dynamic_sidebar( 'content-top-sidebar' );
								echo '</div>';
							} ?>
                            
                            <!--breadcrumb-->
                           <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                            <!--breadcrumb-->
                            <?php
                                global $author;
                                $userdata               = get_userdata($author);
                                $author_description     = (is_object($userdata) && get_the_author_meta('description',$userdata->ID)) != '' ? get_the_author_meta('description',$userdata->ID) : esc_html_e('','cactus')
                            ?>
                            <div class="cactus-listing-heading author-name">
                                <h1><?php echo $userdata->display_name;?></h1>
                            </div>

                            <div class="cactus-author-post author-arc">
                                <div class="cactus-author-pic">
                                    <div class="img-content">
                                        <?php
                                        if(isset($_is_retina_)&&$_is_retina_){
                                                echo get_avatar( get_the_author_meta('email', $userdata->ID), 260, esc_url(get_template_directory_uri() . '/images/avatar-2x-retina.jpg') );
                                        }else{
                                                echo get_avatar( get_the_author_meta('email', $userdata->ID), 130, esc_url(get_template_directory_uri() . '/images/avatar-2x.jpg') );
                                        }?>
                                    </div>
                                </div>
                                <div class="cactus-author-content">
                                    <div class="author-content">
                                    	<?php if($author_description){?>
                                        	<span class="author-body"><?php echo $author_description;?></span>
                                        <?php }?>
                                        <ul class="social-listing list-inline not-author-single change-color">
                                            <?php
                                            if($facebook = get_the_author_meta('facebook',$userdata->ID)){ ?>
                                                <li class="facebook"><a rel="nofollow" href="<?php echo esc_url($facebook); ?>" title="<?php esc_html_e('Facebook', 'cactus');?>"><i class="fa fa-facebook"></i></a></li>
                                            <?php }
                                            if($twitter = get_the_author_meta('twitter',$userdata->ID)){ ?>
                                                <li class="twitter"><a rel="nofollow" href="<?php echo esc_url($twitter); ?>" title="<?php esc_html_e('Twitter', 'cactus');?>"><i class="fa fa-twitter"></i></a></li>
                                            <?php }
                                            if($linkedin = get_the_author_meta('linkedin',$userdata->ID)){ ?>
                                                <li class="linkedin"><a rel="nofollow" href="<?php echo esc_url($linkedin); ?>" title="<?php esc_html_e('Linkedin', 'cactus');?>"><i class="fa fa-linkedin"></i></a></li>
                                            <?php }
                                            if($tumblr = get_the_author_meta('tumblr',$userdata->ID)){ ?>
                                                <li class="tumblr"><a rel="nofollow" href="<?php echo esc_url($tumblr); ?>" title="<?php esc_html_e('Tumblr', 'cactus');?>"><i class="fa fa-tumblr"></i></a></li>
                                            <?php }
                                            if($google = get_the_author_meta('google',$userdata->ID)){ ?>
                                               <li class="google-plus"> <a rel="nofollow" href="<?php echo esc_url($google); ?>" title="<?php esc_html_e('Google Plus', 'cactus');?>"><i class="fa fa-google-plus"></i></a></li>
                                            <?php }
                                            if($pinterest = get_the_author_meta('pinterest',$userdata->ID)){ ?>
                                               <li class="pinterest"> <a rel="nofollow" href="<?php echo esc_url($pinterest); ?>" title="<?php esc_html_e('Pinterest', 'cactus');?>"><i class="fa fa-pinterest"></i></a></li>
                                            <?php }
                                            if($email = get_the_author_meta('author_email',$userdata->ID)){ ?>
                                                <li class="email"><a rel="nofollow" href="mailto:<?php echo esc_attr($email); ?>" title="<?php esc_html_e('Email', 'cactus');?>"><i class="fa fa-envelope-o"></i></a></li>
                                            <?php }
											if($custom_acc = get_the_author_meta('cactus_account',$userdata->ID)){
												foreach($custom_acc as $acc){
													if($acc['icon'] || $acc['url']){
												?>
                                                <li class="cactus_account custom-account-<?php echo sanitize_title(@$acc['title']);?>"><a rel="nofollow" href="<?php echo esc_attr(@$acc['url']); ?>" title="<?php echo esc_attr(@$acc['title']);?>"><i class="fa <?php echo esc_attr(@$acc['icon']);?>"></i></a></li>
                                            <?php 	}
												}
											} ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php if ( is_plugin_active( 'cactus-video/cactus-video.php' ) || is_plugin_active( 'cactus-channel/cactus-channel.php' ) ) { ?>
							<div class="cactus-listing-heading fix-channel">
                                <div class="navi-channel">                                        	
                                    <div class="navi pull-left">
                                        <div class="navi-content">
                                            <div class="navi-item <?php if( (!isset($_GET['view'])) || ( (isset($_GET['view']) && $_GET['view'] =='videos')) || ((isset($_GET['view']) && $_GET['view'] ==''))){?> active <?php }?>"><a href="<?php echo add_query_arg( array('view' => 'videos'), get_current_url()); ?>" title=""><?php esc_html_e('Latest from ','cactus'); echo esc_attr($userdata->display_name);?></a></div>
                                            <?php if ( is_plugin_active( 'cactus-video/cactus-video.php' ) ) { ?>
                                            <div class="navi-item <?php if((isset($_GET['view']) && $_GET['view'] =='playlists')){?> active <?php }?>"><a href="<?php echo add_query_arg( array('view' => 'playlists'), get_current_url() ); ?>" title=""><?php esc_html_e('playlists','cactus');?></a></div>
                                            <?php }?>
                                            <?php if ( is_plugin_active( 'cactus-channel/cactus-channel.php' ) ) { ?>
                                            <div class="navi-item <?php if((isset($_GET['view']) && $_GET['view'] =='channel')){?> active <?php }?>"><a href="<?php echo add_query_arg( array('view' => 'channel'), get_current_url() ); ?>" title=""><?php esc_html_e('channel','cactus');?></a></div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php }?>
                            <?php 
							if(isset($_GET['view']) && $_GET['view'] =='playlists'){
								get_template_part( 'html/loop/ct-author-playlist' );
							}elseif(isset($_GET['view']) && $_GET['view'] =='channel'){
								get_template_part( 'html/loop/ct-author-channel' );
							}else{?>
                            <div class="cactus-sub-wrap">
                                <?php if ( have_posts() ) : ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php get_template_part( 'html/loop/ct-author-video'); ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php get_template_part( 'html/loop/content', 'none' ); ?>
                                <?php endif; ?>
                            </div>

                            <input type="hidden" name="hidden_blog_layout" value="<?php echo $blog_layout;?>"/>
                            <div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config .main-content-col .cactus-sub-wrap','html/loop/ct-author-video'); ?></div>
							<?php }?>
                            
                            <?php if(is_active_sidebar('content-bottom-sidebar')){
								echo '<div class="content-bottom-sidebar-wrap">';
								dynamic_sidebar( 'content-bottom-sidebar' );
								echo '</div>';
							} ?>
                        </div>
                        <!--.main-content-col-->
                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
            </div><!--.cactus-listing-config-->
        </div><!--.cactus-listing-wrap-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
