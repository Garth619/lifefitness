<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package cactus
 */
global $cactus_width;
$cactus_width = 4;
$sticky_main_sidebar_class = ot_get_option('sticky_main_sidebar', 'off') == 'on' ? ' fixed-now' : '';
?>
<!--Sidebar-->
<div class="col-md-4 cactus-sidebar main-sidebar-col"> <!--addClass: left / right -> config sidebar position-->
	<div class="sidebar-content-fixed-scroll<?php echo esc_attr($sticky_main_sidebar_class);?>">
		<?php 
        if(is_front_page() && is_active_sidebar('frontpage_sidebar')){
            dynamic_sidebar( 'frontpage_sidebar' );
        }elseif(is_category()||is_home()&&!is_front_page()){
            $cat_id = get_query_var('cat');
            $style = get_option("cat_layout_$cat_id")?get_option("cat_layout_$cat_id"):ot_get_option('blog_style','video');
            if($style=='video'&&is_active_sidebar('video_listing_sidebar')){
                dynamic_sidebar( 'video_listing_sidebar' );
            }elseif($style=='blog'&&is_active_sidebar('blog_sidebar')){
                dynamic_sidebar( 'blog_sidebar' );
            }elseif(is_active_sidebar('main-sidebar')){
                dynamic_sidebar( 'main-sidebar' );
            }
        }elseif(is_active_sidebar('u_event_sidebar')&&is_singular('u_event') || is_active_sidebar('u_event_sidebar')&&is_post_type_archive( 'u_event' )){
            dynamic_sidebar( 'u_event_sidebar' );	
        }elseif(is_active_sidebar('u_course_sidebar')&&is_singular('u_course') || is_active_sidebar('u_course_sidebar')&&is_post_type_archive( 'u_course' )){
            dynamic_sidebar( 'u_course_sidebar' );	
        }elseif(is_active_sidebar('woocommerce_sidebar') && function_exists('is_woocommerce') && is_woocommerce()){
            dynamic_sidebar( 'woocommerce_sidebar' );
        }elseif(is_active_sidebar('main-sidebar')){
            dynamic_sidebar( 'main-sidebar' );
        }else{ ?>
        
            <aside id="search" class="widget widget_search col-md-12 module widget-col">
                <div class="widget-inner">
                    <h2 class="widget-title h6"><?php esc_html_e('Search','cactus') ?></h2>
                    <?php get_search_form(); ?>
                </div>
            </aside>
        
        <?php } // end sidebar widget area ?>  
    </div>  
</div>
<!--Sidebar-->
