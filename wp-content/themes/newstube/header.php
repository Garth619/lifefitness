<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cactus
 */
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
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Retina Logo-->
	<?php if(ot_get_option('retina_logo','')):?>
	<style type="text/css" >
		@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
			/* Retina Logo */
			.primary-logo{background:url(<?php echo ot_get_option('retina_logo', ''); ?>) no-repeat center; display:inline-block !important; background-size:contain;}
			.primary-logo img{ opacity:0; visibility:hidden}
			.primary-logo *{display:inline-block}
		}
	</style>
	<?php endif;?>

<?php if(ot_get_option('seo_meta_tags', 'on') == 'on' ) ct_meta_tags();?>
<?php wp_head(); ?>
</head>
<?php
	//prepare page title
	global $page_title;
	if(is_search()){
		$page_title = esc_html__('Search Result: ','cactus').(isset($_GET['s'])?$_GET['s']:'');
	}elseif(is_category()){
		$page_title = single_cat_title('',false);
	}elseif(is_tag()){
		$page_title = single_tag_title('',false);
	}elseif(is_tax()){
		$page_title = single_term_title('',false);
	}elseif(is_author()){
		$page_title = esc_html__("Author: ",'cactus') . get_the_author();
	}elseif(is_day()){
		$page_title = esc_html__("Archives for ",'cactus') . date_i18n(get_option('date_format') ,strtotime(get_the_date()));
	}elseif(is_month()){
		$page_title = esc_html__("Archives for ",'cactus') . get_the_date('F, Y');
	}elseif(is_year()){
		$page_title = esc_html__("Archives for ",'cactus') . get_the_date('Y');
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
	
	$post_video_layout='';
	$class_improveSingleVideo = '';
	if(is_single()) {
		$post_video_layout = get_post_meta(get_the_ID(),'post_video_layout',true);
		if(!$post_video_layout){
			$post_video_layout = ot_get_option('post_video_layout','1');
		}
		
		if($post_video_layout=='3'){
			$class_improveSingleVideo='fix-header-theater';
		}
	};
	$facebook_comments =  get_option( 'facebook_post_features' );
	$cl_fbcm = '';
	if(isset($facebook_comments['comments']) && $facebook_comments['comments'] =='1' && is_single() && is_plugin_active( 'facebook/facebook.php' )){
		$cl_fbcm = 'facebook-comment-cl';
	}
?>
<body <?php body_class($class_improveSingleVideo.' '.$cl_fbcm); ?>>	
<?php
    $page_on_front = get_option('page_on_front');
    $cactus_main_layout = ot_get_option('main_layout', 'boxed');

    if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php'))
    {
        $cactus_main_layout = get_post_meta(get_the_ID(),'front_page_layout',true) == '' ? ot_get_option('main_layout', 'boxed') : get_post_meta(get_the_ID(),'front_page_layout',true);
    }

	$main_layout_class 	= $cactus_main_layout == 'boxed' ? '' : ' class="cactus-full-width"';
	$getOptionsLayouts 	= $cactus_main_layout;
	$subClassStandardV2 = '';


	/*Shortcode Thumb*/
	if(is_category() || is_front_page() || is_page_template('page-templates/front-page.php')){
		$header_shortcode			= '';

		$default_layout 			= ot_get_option('setting_default_front_page_layout', 'layout_1');
		$featured_post_layout       = ot_get_option('featured_post_layout', '');
		$number_of_featured_posts   = ot_get_option('featured_posts_count_hp', '5');
		$featured_posts_count       = $number_of_featured_posts == '' || !is_numeric($number_of_featured_posts) ? '5' : $number_of_featured_posts;
		$featured_posts_categories  = ot_get_option('featured_posts_categories', '');
		$featured_posts_autoplay    = ot_get_option('featured_posts_autoplay', 'on');
		$autoplay                   = $featured_posts_autoplay == 'on' ? '1' : '0';

		if(is_category())
		{
			$category                       = get_category(get_query_var('cat'));

			$category_layout                = get_option('cat_layout_' . $category->term_id);
            $cat_feature_post_layout        = get_option('cat_feature_post_layout_' . $category->term_id);
            $number_of_featured_posts       = get_option('number_featured_posts_' . $category->term_id);

            $default_layout        			= $category_layout == '' ? ot_get_option('default_category_layout', 'layout_1') : $category_layout;
            $featured_post_layout   		= $cat_feature_post_layout == '' ? ot_get_option('default_featured_post_layout', '') : $cat_feature_post_layout;
            $featured_posts_count           = $number_of_featured_posts == '' || !is_numeric($number_of_featured_posts) ? ot_get_option('featured_posts_count', '5')                                                                                                        : $number_of_featured_posts;
            $featured_posts_autoplay    	= ot_get_option('cat_featured_posts_autoplay', 'on');
            $autoplay                   	= $featured_posts_autoplay == 'on' ? '1' : '0';
            $category_id                    = $category->term_id;
		}

		if($featured_post_layout == 'posts_thumb_slider' && $getOptionsLayouts=='boxed' && $default_layout == 'layout_2') {
			$header_shortcode = '[xthumbslider condition="" order="DESC" featured="1" cats="' . $featured_posts_categories . '" autoplay="' . $autoplay . '" count="' . $featured_posts_count . '"]';
			$subClassStandardV2 = 'fixPosition';
		};

	    if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php'))
	    {
	    	$front_page_header_content = get_post_meta(get_the_ID(),'front_page_header_content',true);
    		if($front_page_header_content != '')
    		{
    			if ((preg_match('/xthumbslider/', $front_page_header_content, $matches) || preg_match('/rev_slider/', $front_page_header_content, $matches)) && $getOptionsLayouts=='boxed')
    			{
    				if(preg_match('/rev_slider/', $front_page_header_content, $matches))
    			    	$header_shortcode = '<div class="front-page-newstube-rev-slider">' . $front_page_header_content . '</div>';
    			    else
    			    	$header_shortcode = $front_page_header_content;

    			    $subClassStandardV2 = 'fixPosition';
    			}
    		}
	    }
		
	};
	/*Shortcode Thumb*/

	if(is_single()){
		$post_standard_layout = get_post_meta(get_the_ID(),'post_standard_layout',true);
		if(!$post_standard_layout){
			$post_standard_layout = ot_get_option('post_standard_layout','1');
		};

		if( get_post_format()=='' &&  ($post_standard_layout == 2 && $getOptionsLayouts=='boxed') ){
			$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$thumb_url = wp_get_attachment_url( $thumbnail_id );
			if($thumb_url!='') {
				$subClassStandardV2 = 'fixPosition';
			};
		};
	};
?>
<?php
global $post;
// Get backgroun image and hyperlink to background clickable link.
cactus_bg($post);
?>
<div id="body-wrap" class="<?php echo $subClassStandardV2;?>">
    <div id="wrap"<?php echo $main_layout_class;?>>
        <header class="<?php echo $subClassStandardV2;?>">
    	<?php
            get_template_part( 'html/header/header', 'navigation' ); // load header-navigation.php

            if(is_single()){
                if( $subClassStandardV2=='fixPosition' ){
                	show_thumb_single($format = get_post_format(), 2, $thumb_url);
                };
            }elseif(is_category()){
                if( $subClassStandardV2=='fixPosition' ){
                	echo do_shortcode($header_shortcode);
                };
            }elseif(is_front_page()||is_page_template('page-templates/front-page.php')){
            	if( $subClassStandardV2=='fixPosition' ){
                	echo do_shortcode($header_shortcode);
                };
            }
        ?>
        </header>
        
        <?php if(is_active_sidebar('main-top-sidebar')){
			echo '<div class="main-top-sidebar-wrap">';
            	dynamic_sidebar( 'main-top-sidebar' );
			echo '</div>';
        }
