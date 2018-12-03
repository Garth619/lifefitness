<?php 
/*
 * Template Name: Demo Homepage V1 Default
 */
 ?>
<?php 
global $ctdemo_main_color;
$ctdemo_main_color ='#d3a538';
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]--><head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php if(ot_get_option('favicon', '')):?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(ot_get_option('favicon'));?>">
<?php endif;?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Retina Logo-->
	<style type="text/css" >
		@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
			/* Retina Logo */
			.primary-logo{background:url(<?php echo get_template_directory_uri() . '/images/logo-demo/001-Newstube-logo-news2X.png'; ?>) no-repeat center; display:inline-block !important; background-size:contain;}
			.primary-logo img{ opacity:0; visibility:hidden}
			.primary-logo *{display:inline-block}
			.cactus-sticky-menu .cactus-logo-nav.is-sticky-menu li a span{background:url(<?php echo get_template_directory_uri() . '/images/logo-demo/001-004-default-sticky-2X.png'; ?>) no-repeat center; display:inline-block !important; background-size:contain;}
			.cactus-sticky-menu .cactus-logo-nav.is-sticky-menu li img{ opacity:0; visibility:hidden}
		}
		.cactus-note-cat{ background-color:#d3a538 !important;}
		.cactus-note-cat a{color:#fff !important;}
	</style>

<?php if(ot_get_option('seo_meta_tags', 'on') == 'on' ) ct_meta_tags();?>
<?php wp_head(); ?>
</head>
<?php
	//prepare page title
	global $page_title;
	if(is_search()){
		$page_title = __('Search Result: ','cactus').(isset($_GET['s'])?$_GET['s']:'');
	}elseif(is_category()){
		$page_title = single_cat_title('',false);
	}elseif(is_tag()){
		$page_title = single_tag_title('',false);
	}elseif(is_tax()){
		$page_title = single_term_title('',false);
	}elseif(is_author()){
		$page_title = __("Author: ",'cactus') . get_the_author();
	}elseif(is_day()){
		$page_title = __("Archives for ",'cactus') . date_i18n(get_option('date_format') ,strtotime(get_the_date()));
	}elseif(is_month()){
		$page_title = __("Archives for ",'cactus') . get_the_date('F, Y');
	}elseif(is_year()){
		$page_title = __("Archives for ",'cactus') . get_the_date('Y');
	}elseif(is_home()){
		if(get_option('page_for_posts')){ $page_title = get_the_title(get_option('page_for_posts'));
		}else{
			$page_title = get_bloginfo('name');
		}
	}elseif(is_404()){
		$page_title = ot_get_option('page404_title',__('404 - Page Not Found','cactus'));
	}elseif(  function_exists ( "is_shop" ) && is_shop()){
		$page_title = woocommerce_page_title($echo = false);
    }else{
		global $post;
		if($post){$page_title = $post->post_title;}
	}
	//width flag
	global $cactus_width;
	$cactus_width = 12;
?>
<body <?php body_class(); ?>>
	<input type="hidden" name="cactus_scroll_effect" value="<?php echo esc_attr(ot_get_option('scroll_effect', 'off'));?>"/>
<?php 
	$cactus_main_layout = get_post_meta(get_the_ID(),'front_page_layout',true) == '' ? ot_get_option('main_layout', 'boxed') : get_post_meta(get_the_ID(),'front_page_layout',true);
	$main_layout_class 	= $cactus_main_layout == 'boxed' ? '' : ' class="cactus-full-width"';
?>
<a href="http://themeforest.net/item/newstube-magazine-blog-video/12132780?ref=cactusthemes" target="blank" id="bgLinkLeft"></a>
<a href="http://themeforest.net/item/newstube-magazine-blog-video/12132780?ref=cactusthemes" target="blank" id="bgLinkRight"></a>
<style type="text/css" rel="stylesheet" scoped="">#body-wrap{background-image: url(http://<?php echo home_url(); ?>/wp-content/uploads/2015/01/boxed-background-newstube.jpg);background-repeat: no-repeat;background-attachment: fixed;background-size: cover;}
</style>
<div id="body-wrap">
    <div id="wrap"<?php echo $main_layout_class;?>>

        
		<?php
        //global $post;
        // Get backgroun image and hyperlink to background clickable link.
        //cactus_bg($post);


	$sidebar = get_post_meta(get_the_ID(),'page_sidebar',true);
	if(!$sidebar){
		$sidebar = ot_get_option('page_sidebar','right');
	}
	if($sidebar == 'hidden') $sidebar = 'full';
?>

<header>
    <?php do_action( 'cactus_before_nav' ); ?>

    <?php
		$navigation_style = get_post_meta(get_the_ID(),'front_page_navigation_style',true);
		if($navigation_style==''){
        	$navigation_style = 'style_1';
		}
        if($navigation_style == 'style_1')
            $navigation_style_class = '';
        else if($navigation_style == 'style_2')
            $navigation_style_class = 'style-2';
        else if($navigation_style == 'style_3')
            $navigation_style_class = 'style-3';
        else if($navigation_style == 'style_4')
            $navigation_style_class = 'style-4';
    ?>
    <!--Navigation style-->
    <div class="cactus-nav <?php echo $navigation_style_class;?>">

        <!--Top NAV-->
        <?php get_template_part( 'html/header/header', 'navigation-top' ); ?>
        <!--Top NAV-->

        <!--Branding-->
		<?php
            global $navigation_style;
        ?>
        <div id="main-nav" class="nav-branding">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
        
                    <!--Logo-->
                    <div class="navbar-header">
                        <!--logo-->
                        <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">
                            <div class="primary-logo">
                                <img src="<?php echo get_template_directory_uri() . '/images/logo-demo/001-Newstube-logo-news1X.png'; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            </div>
                        </a><!--logo-->
                    </div><!--Logo-->
                    <?php if($navigation_style != 'style_4'):?>
                        <ul class="nav navbar-nav navbar-right rps-hidden cactus-header-ads">
                            <li><?php cactus_display_ads('ads_top_nav');?></li>
                        </ul>
                    <?php endif;?>
        
                </div>
            </nav>
        </div>
        <!--Branding-->

        <!--Primary menu-->
        <div id="main-menu">

            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="main-menu-wrap">
                        <ul class="nav navbar-nav cactus-logo-nav is-sticky-menu">
                            <li>
                            	<a href="<?php echo esc_url(home_url()); ?>">
                            		<span><img src="<?php echo get_template_directory_uri() . '/images/logo-demo/001-003-default-sticky-1X.png'; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"></span>
                                </a>
                            </li>
                        </ul>
                        <?php if($navigation_style == 'style_3'):?>
                            <?php $logo = ot_get_option('logo_image','') == '' ? esc_url(get_template_directory_uri()) . '/images/logo.png' : ot_get_option('logo_image',''); ?>
                            <ul class="nav navbar-nav cactus-logo-nav">
                                <li><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo get_template_directory_uri() . '/images/logo-demo/001-Newstube-logo-news1X.png'; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"></a></li>
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
                                if($megamenu == 'on' && function_exists('mashmenu_load')  && has_nav_menu( 'primary' )){
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
                                    <?php wp_list_pages('depth=1&number=5&title_li=' ); ?>
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
                        } ?>
                        <?php if(ot_get_option('enable_search')!='off'){ ?>
                        <!--Search-->
                        <ul class="nav navbar-nav navbar-right search-drop-down dark-div">
                            <li>
                                <a href="javascript:;" class="open-search-main-menu"><i class="fa fa-search"></i><i class="fa fa-times"></i></a>
                                <ul class="search-main-menu">
                                    <li>
                                        <form action="<?php echo esc_url(home_url());?>" method="get">
                                            <input type="text" placeholder="<?php echo _e('Search...','cactus');?>" name="s" value="<?php echo esc_attr(get_search_query());?>">
                                            <i class="fa fa-search"></i>
                                            <input type="submit" value="<?php echo _e('search','cactus');?>">
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

        <!--Primary menu-->

    </div>
    <!--Navigation style-->
    <?php do_action( 'cactus_after_nav' ); ?>
</header>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-single-page cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
            <div class="container">
                <div class="row">

                    <?php
                        $default_front_page_layout  = 'layout_2';
                        $featured_post_layout       = 'posts_grid_layout_3';
                        $featured_posts_count       = 5;
                        $featured_posts_categories  = '';
                        $featured_posts_autoplay    = 'on';
                        $xgrid_autoplay             = 5000;
                        $autoplay                   = 1;

                        $header_shortcode = '[xgrid layout="2" condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" speed="' . $xgrid_autoplay . '" count="' . $featured_posts_count . '"]';
						$front_page_header_content = get_post_meta(get_the_ID(),'front_page_header_content',true);
						if($front_page_header_content !=''){$header_shortcode = $front_page_header_content;}
                    ?>

                    <?php if($default_front_page_layout == 'layout_2'):?>
                        <div class="cactus-categories-slider">
                            <?php if($featured_post_layout == 'posts_thumb_slider'):?>
                                <?php echo do_shortcode($header_shortcode);?>
                            <?php endif;?>
                            <?php if($featured_post_layout != 'posts_thumb_slider'):?>
                                <?php echo do_shortcode($header_shortcode);?>
                             <?php endif;?>

                        </div>
                    <?php endif;?>

                    <div class="main-content-col col-md-12 cactus-config-single">


                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'html/single/content', 'page' ); ?>

                    <?php endwhile; // end of the loop. ?>
                    </div>

                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
        </div><!--#cactus-single-page-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
