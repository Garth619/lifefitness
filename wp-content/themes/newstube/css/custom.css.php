<?php

echo ot_get_option('custom_css','');

// main color
$main_color = ot_get_option('main_color', '#f9da16');

global $ctdemo_main_color;
if(isset($ctdemo_main_color) && $ctdemo_main_color!=''){ $main_color = $ctdemo_main_color;}

if(strtolower($main_color) != '#f9da16') {
	?>
	/* background */
    .bg-main-color,
    .cactus-note-cat,
    .subs-button .subs-row .subs-cell a,
    #top-nav .navbar-nav>li ul:before,
    #main-menu .navbar-default .navbar-nav>li>a:hover, 
	#main-menu .navbar-default .navbar-nav>li.current-menu-item>a,
    #main-menu .navbar-default .navbar-nav>li:hover>a,
    #main-menu .navbar-nav>li ul:before,
    #main-menu .navbar-default.cactus-sticky-menu .navbar-nav>li>a:hover, 
    .cactus-nav.style-3 #main-menu .navbar-default.cactus-sticky-menu .navbar-nav>li>a:hover,
    .widget .widget-title:before,
    .cactus-related-posts .title-related-post:before,
    .cactus-now-playing,
    .post-style-gallery .pagination .swiper-pagination-switch:hover,
    .post-style-gallery .pagination .swiper-pagination-switch.swiper-active-switch,
    .cactus-video-list-content .cactus-widget-posts .cactus-widget-posts-item .video-active,
    .comments-area .comment-reply-title:before,
	.comments-area .comments-title:before,
    #main-menu .navbar-default .navbar-nav.user_submit>li>a:hover,
    .cactus-thumb-slider .bottom-absolute,
    .item-review h4:before,
    .item-review .box-progress .progress .progress-bar,
    .star-rating-block .rating-title:before,
    .cactus-slider-sync .cactus-silder-sync-listing .sync-img-content > div > .hr-active,
    .cactus-slider-sync[data-layout="vertical"] .cactus-silder-sync-listing .swiper-slide:before,
    footer .footer-info .link #menu-footer-menu li:after,
    body.archive.category .cactus-listing-heading h1,
    .widget.widget_shopping_cart .buttons a:last-child,
    .woocommerce .widget_price_filter .price_slider_amount .button,
    .woocommerce #reviews #review_form_wrapper h3:before,
    .single-product .upsells.products h2:before,
    .woocommerce-page #payment #place_order, .woocommerce-checkout form.login .form-row .button,
    .woocommerce div.product form.cart .button.single_add_to_cart_button,
    .wpb_row .woocommerce #payment #place_order,
    .wpb_row .woocommerce.add_to_cart_inline .button.add_to_cart_button:hover,
    .cactus-tab .cactus-tab-heading .cactus-tab-title span
	{background-color: <?php echo esc_html($main_color);?>;}
	.woocommerce .sale-on{ border-top-color:<?php echo esc_html($main_color);?>}
	/* color */
	
    .main-color,
	a, 
    a:focus,
	/*a:hover,*/
    .woocommerce .return-to-shop a.button:hover, .woocommerce .cart input.checkout-button.button, .woocommerce-shipping-calculator button.button:hover, .woocommerce .cart .button:hover, .woocommerce .cart input.button:hover,
	.woocommerce #review_form #respond .form-submit input,
    .woocommerce .widget_price_filter .price_slider_amount .button:hover,
    .widget_price_filter .price_slider_amount .button:hover, .widget.widget_shopping_cart .buttons a:hover,
    .btn-default:not(:hover):not(.load-more):not([data-dismiss="modal"]), 
    button:not(:hover):not(.load-more):not([data-dismiss="modal"]):not([name="calc_shipping"]):not(.button), 
    input[type=button]:not(:hover):not(.load-more):not([data-dismiss="modal"]), 
    input[type=submit]:not(:hover):not(.load-more):not([data-dismiss="modal"]):not([name="apply_coupon"]):not([name="update_cart"]):not([name="login"]), 
    .btn-default:not(:hover):not(.load-more):not([data-dismiss="modal"]):visited, 
    button:not(:hover):not(.load-more):not([data-dismiss="modal"]):visited, 
    input[type=button]:not(:hover):not(.load-more):not([data-dismiss="modal"]):visited, 
    input[type=submit]:not(:hover):not(.load-more):not([data-dismiss="modal"]):visited,
	.btn-large,
	.btn-large:visited,
	*[data-toggle="tooltip"]:not(.share-tool-block),
	.dark-div .cactus-info:hover,
	.cactus-note-point,
	#main-menu .navbar-default .navbar-nav>li>a,
	#off-canvas .off-menu ul li a:hover,
	#top-nav .navbar-nav.open-menu-mobile-top>li>ul>li a:hover,
	#main-menu .dropdown-mega .channel-content .row .content-item .video-item .item-head h3 a:hover,
	#main-menu .dropdown-mega .sub-menu-box-grid .columns li ul li.header,
    .cactus-sidebar .widget .widget-title,
    .tag-group a:hover,
	.tag-group a:focus,
    .cactus-listing-carousel-content .cactus-listing-config.style-1.style-3 .cactus-post-title > a:hover,
    .post-style-gallery .pre-carousel:hover,
	.post-style-gallery .next-carousel:hover,
    .dark-div .cactus-video-list-content .video-listing .cactus-widget-posts .widget-posts-title a:hover,
    .cactus-video-list-content .cactus-widget-posts .cactus-widget-posts-item.active .widget-posts-title a,
    footer .footer-info .link a:hover,
	.cactus-nav.style-4 #main-menu .navbar-default:not(.cactus-sticky-menu) .navbar-nav>li:hover>a,	
    .cactus-nav.style-4 #main-menu .navbar-default:not(.cactus-sticky-menu) .navbar-nav.user_submit>li>a:hover,    
    .cactus-nav.style-4 #main-menu .navbar-default:not(.cactus-sticky-menu) .navbar-nav>li.current-menu-item>a,
    .cactus-nav.style-4 #main-menu .navbar-default:not(.cactus-sticky-menu) .navbar-nav:not(.user_submit)>li>a:hover, 
	.cactus-nav.style-4 #main-menu .navbar-default:not(.cactus-sticky-menu) .navbar-nav:not(.user_submit)>li.current-menu-item>a, 
	.cactus-nav.style-4 #main-menu .navbar-default:not(.cactus-sticky-menu) .navbar-nav:not(.user_submit)>li:hover>a,	
    .wptt_TwitterTweets ul.fetched_tweets li.tweets_avatar .tweet_data a:hover,    
	.dark-div .widget_calendar a:hover,    
    
	.item-review .box-text .score,	
	.cactus-slider-sync .pre-carousel:hover,
	.cactus-slider-sync .next-carousel:hover,	
	.cactus-thumb-slider .thumb-content .swiper-slide .thumb-item:hover .cactus-note-cat,
	.cactus-thumb-slider .thumb-content .swiper-slide.active .thumb-item .cactus-note-cat,
	.cactus-thumb-slider .pre-carousel:hover,
	.cactus-thumb-slider .next-carousel:hover,	
	.cactus-banner-parallax .sub-content h3 a:hover,	
	.cactus-slider-wrap .cactus-slider-btn-prev:hover,
	.cactus-slider-wrap .cactus-slider-btn-next:hover,
	.cactus-scb .cactus-scb-title,	
	.cactus-banner-parallax-slider .cactus-info:hover,
	.cactus-banner-parallax-slider .dark-div .cactus-info:hover,	
	.cactus-carousel .pre-carousel:hover,
	.cactus-carousel .next-carousel:hover,
    .compare-table-wrapper .btn-default,
	.compare-table-wrapper .btn-default:visited,
	.cactus-topic-box .topic-box-title,
	.cactus-divider.style-4 > h6,
    .cactus-topic-box .topic-box-item a:hover,
    .cactus-change-video:hover .button-cell > span:last-child,  
    .easy-tab .tabs li.active a,
    .easy-tab .tabs li a:hover,
    .woocommerce .woocommerce-archive ul.products li.item-product .button:hover,
    .widget.widget_shopping_cart .buttons a:last-child:hover,
    .wpb_row .woocommerce ul.products li.item-product .button:hover,
    .wpb_row .woocommerce table.my_account_orders .button.view:hover,
    .cactus-topic-box .topic-box-item a:hover    
	{color: <?php echo esc_html($main_color);?>;}
    
    @media(max-width:1024px) {
    	#wrap .cactus-nav #main-menu .navbar-default.cactus-sticky-menu .navbar-nav.open-menu-mobile>li>a:hover,
		#wrap .cactus-nav #main-menu .navbar-default.cactus-sticky-menu .navbar-nav.search-drop-down>li>a:hover,
		#wrap .cactus-nav #main-menu .navbar-default.cactus-sticky-menu .navbar-nav.user_submit>li>a:hover,
        #wrap .cactus-nav #main-menu .navbar-default.cactus-sticky-menu .navbar-nav.open-menu-mobile>li:hover>a,
		#wrap .cactus-nav #main-menu .navbar-default.cactus-sticky-menu .navbar-nav.search-drop-down>li:hover>a,
		#wrap .cactus-nav #main-menu .navbar-default.cactus-sticky-menu .navbar-nav.user_submit>li:hover>a {color: <?php echo esc_html($main_color);?>;}
   	}

	/* border color */

	#main-menu .dropdown-mega .preview-mode,
	.cactus-nav.style-2 #main-menu,
	.cactus-nav.style-3 #main-menu,
	footer .footer-info,
	.compare-table-wrapper > .compare-table,
	#main-menu .search-drop-down>li>ul,
    .tm-multilink .multilink-table-wrap .multilink-item,
    .cactus-tab .cactus-tab-heading
	{
		border-color: <?php echo esc_html($main_color);?>;
	}

<?php } ?>

<?php
$google_font = ot_get_option('google_font', 'off');
if($google_font == 'on'){
	//main font family
	$font_name = 'Open Sans';
	$main_font = ot_get_option('main_font_family');

	if($main_font){
		$font_name = get_google_font_name($main_font);		
	}
	
	//Heading font family
	$font_heading_name = 'Open Sans';
	$heading_font_family = ot_get_option('heading_font_family');
	if($heading_font_family){		
		$font_heading_name = get_google_font_name($heading_font_family);
	};
	
	//Navigation font family
	$font_navigation_name = 'Open Sans';
	$navigation_font_family = ot_get_option('navigation_font_family');
	if($navigation_font_family){
		$font_navigation_name = get_google_font_name($navigation_font_family);		
	};
	
	if($font_name != 'Open Sans' || $font_heading_name != 'Open Sans' || $font_navigation_name != 'Open Sans') {?>
    	/*main font*/
            body,
            .wptt_TwitterTweets ul.fetched_tweets li.tweets_avatar .tweet_data,
            .cactus-navigation-post .prev-post span, 
            .cactus-navigation-post .next-post span,
            .wptt_TwitterTweets ul.fetched_tweets li.tweets_avatar .times a	
            {font-family: "<?php echo esc_html($font_name);?>";}
        /*main font*/
        
        /*heading font*/
        	h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6,
            .easy-tab .tabs li a,
            .cactus-note-point,
            .cactus-readmore,
            .page-navigation,
            .dropcaps,
            .btn, 
            button, 
            input[type=button], 
            input[type=submit],
            .cactus-navigation-post .prev-post, 
            .cactus-navigation-post .next-post,
            .cactus-author-post .cactus-author-content .author-content .author-name,
            .cactus-related-posts .title-related-post,
            .cactus-topic-box .topic-box-item,
            .cactus-tab .cactus-tab-heading
            {font-family: "<?php echo esc_html($font_heading_name);?>";}
        /*heading font*/
        
        /*Navigation font family*/
            .cactus-nav {font-family: "<?php echo esc_html($font_navigation_name);?>";}
            
            .cactus-nav .cactus-note-cat,
            #main-menu .search-drop-down>li>ul>li input[type="text"]  {font-family: "<?php echo esc_html($font_name);?>";}
            
            .cactus-nav .cactus-note-point,
            #main-menu .dropdown-mega .channel-content .row .content-item .video-item .item-head h3 a {font-family: "<?php echo esc_html($font_heading_name);?>";}
        /*Navigation font family*/
        
	<?php		
	};
}
?>

<?php
// main font size
	$main_font_size = ot_get_option('main_font_size', '14');
	if($main_font_size != '14'){
		$fontsizenew11 = round($main_font_size * 0.786);
		$fontsizenew12 = round($main_font_size * 0.858);
?>
	html, 
    body, 
    
    .cactus-listing-config.style-1 .entry-content > *:not(.primary-post-content),
    .cactus-listing-config.style-1 .entry-content .primary-post-content > *,
    .cactus-listing-config.style-1 .entry-content > .related-post:not(.primary-post-content) > *,
    .cactus-listing-config.style-1.style-3 .cactus-sub-wrap > *,
    .cactus-listing-config.style-1.style-4 .cactus-sub-wrap > *,
    .navi-channel .navi-content > *,
    .footer-sidebar .container > .row:not(.footer-banner-wrapper) > *,
    .cactus-scb[data-style="2"] .cactus-listing-config.style-1 .cactus-sub-wrap > *,  
      
    input:not([type]), 
	input[type="color"], 
	input[type="email"], 
	input[type="number"], 
	input[type="password"], 
	input[type="tel"], 
	input[type="url"], 
	input[type="text"], 
	input[type="search"], 
	textarea, 
	.form-control, 
	select,    
    h6, 
    .h6,
    .easy-tab .tabs li a,
    .cactus-listing-config.style-1.style-2.channel-list .cactus-info,
    .cactus-listing-config.style-1.style-3.style-channel.ct-special .row > *:not(.post-channel-special) .cactus-post-title,
    .cactus-listing-config.style-1.style-4 .primary-post-content .picture-content .content-abs-post .cactus-post-title,
    #main-menu .dropdown-mega .channel-content .row .content-item .video-item .item-head h3,
    #main-menu .dropdown-mega .sub-menu-box-grid .columns li ul li.header, 
    .cactus-change-video span,
    .comments-area .comments-title,
    .smart-list-post-wrap .post-static-page,
    .cactus-post-suggestion .suggestion-header,
    .content-404,
    .wptt_TwitterTweets ul.fetched_tweets li.tweets_avatar .tweet_data,
    .cactus-slider-sync[data-layout="vertical"] .cactus-silder-sync-listing .sync-img-content > div > a,
    .cactus-thumb-slider .cactus-note-point,
    .cactus-scb .cactus-scb-title,
    .cactus-scb ul.category > li.current-category > a,
    .cactus-scb ul.category > li.current-category > i,
    .cactus-scb ul.category > li.current-category > ul li a,    
    .compare-table-wrapper .compare-table-price span:last-child,
    .comments-area .comment-reply-title, 
    .comments-area .comments-title,
    .icon-box-group .cactus-icon-box,
    .body-content .vc_tta-container .vc_tta.vc_general .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-title,
    .cactus-carousel .swiper-slide,
    .cactus-widget-posts.style-2 > *,
    .tm-multilink .multilink-table-wrap .multilink-item span.mtitle,
    .tm-multilink .multilink-table-wrap .multilink-item span a
     {font-size: <?php echo intval($main_font_size);?>px}

     @media(max-width:767px) {
        .cactus-banner-parallax .primary-content h1,
        .cactus-banner-parallax .primary-content h1 a {font-size: <?php echo intval($main_font_size);?>px}
     }
         
    /*11px*/
        table:not(#wp-calendar) tbody tr:first-child,
        table:not(#wp-calendar) thead tr:first-child,
        .cactus-breadcrumb,
        .cactus-breadcrumb a, 
        .cactus-readmore > a,
        .cactus-note-cat,
        .cactus-note-point,
        .cactus-note-time,
        .subs-button .subs-row .subs-cell a,
        .subs-button .subs-row .subs-cell > span,
        .cactus-listing-config.style-1 .primary-post-content .cactus-readmore > a,
        .combo-change .listing-select > ul > li,
        .combo-change .listing-select > ul > li > ul > li > a,
        .cactus-listing-heading h1 span,
        .navi-channel .navi .navi-item a,
        .page-navigation .nav-next,
        .wp-pagenavi span,        
        .widget_categories li, 
        .widget_meta li, 
        .widget_archive li, 
        .widget_recent_entries li, 
        .widget_recent_comments li,
        .widget_pages li, 
        .widget_nav_menu li,
        .widget_mostlikedpostswidget li,
        .widget_recentlylikedpostswidget li,
        .widget_most_viewed_entries li,
        .widget_categories li a, 
        .widget_meta li a, 
        .widget_archive li a, 
        .widget_recent_entries li a, 
        .widget_recent_comments li a,
        .widget_pages li a, 
        .widget_nav_menu li a,
        .widget_mostlikedpostswidget li a,
        .widget_recentlylikedpostswidget li a,
        .widget_most_viewed_entries li a,
        .tag-group a,
        .cactus-top-style-post.style-2 .style-post-content .content-abs-post .cactus-note-point,
        .cactus-change-video-sub > span,
        .cactus-video-list-content .video-listing .cactus-note-point,
        .cactus-video-list-content .cactus-widget-posts .cactus-widget-posts-item .order-number,
        footer .footer-info .link a,
        .body-content .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
        .cactus-topic-box .topic-box-title,
        .cactus-download-box .text-content  ,
        .btn-default, 
        button, 
        input[type=button], 
        input[type=submit],
        .btn-default:visited, 
        button:visited, 
        input[type=button]:visited, 
        input[type=submit]:visited,
        .page-navigation .nav-previous, 
        .page-navigation .nav-next ,
        .wp-pagenavi a, 
		.wp-pagenavi span,
        .body-content .vc_tta-container .vc_tta-tabs.vc_tta.vc_general .vc_tta-tabs-container .vc_tta-tab > a
        {font-size:<?php echo $fontsizenew11?>px}
        .widget_tag_cloud .tagcloud a[class*="tag-link-"] {font-size:<?php echo $fontsizenew11?>px !important;}
    /*11px*/
    
    /*12px*/
        .tooltip,
        .cactus-info,
        .vcard.author .fn > a,
        .cactus-listing-config.style-1.style-2.channel-list .cactus-info:before,
        .cactus-widget-posts.widget-comment .posted-on > span,
        .share-tool-block.view-count span,
        .share-tool-block.open-carousel-listing,
        .cactus-share-and-like .watch-action .jlk,
        .share-tool-block.like-information span,
        .tag-group > span,
        .cactus-navigation-post .next-post > a > span,
        .body-content .wp-caption .wp-caption-text,
        div[id^="cactus-lightbox-caption-content"] .post-style-gallery > span,
        div[id^="cactus-lightbox-caption-content"] .caption-number,
        .cactus-change-video span:first-child,
        .comments-area .comment-metadata a,
        .comments-area .comment-author > .fn:after,
        .comments-area .comment-metadata .edit-link:before,
        .comments-area .reply a,
        .cactus-view-all-pages > a > span,
        .cactus-post-suggestion .suggestion-header > span,
        .wptt_TwitterTweets ul.fetched_tweets li.tweets_avatar .times a,
        .cactus-navigation-post .prev-post > a > span, 
        .cactus-navigation-post .next-post > a > span {font-size:<?php echo $fontsizenew12;?>px}
        @media(min-width:768px) {
            .cactus-share-and-like.fix-left .share-tool-block.open-cactus-share,
            .cactus-share-and-like.fix-left .cactus-add-favourite .wpfp-link {font-size:<?php echo $fontsizenew12;?>px}
        }
   /*12px*/
    
<?php } ?>

<?php
// Navigation font
	$navigation_font_size = ot_get_option('navigation_font_size', '12');
	if($navigation_font_size != '11'){?>
        .sub-menu,
        #top-nav .navbar-nav>li>a,
        #top-nav .navbar-nav>li ul li a,
        #main-menu .navbar-default .navbar-nav>li>a,
        #main-menu .navbar-nav>li ul li a,
        .cactus-headline .title,
        #main-menu .navbar-default .navbar-nav.user_submit>li>a>span,
        .cactus-headline .cactus-note-cat,
        .cactus-headline .swiper-slide a.title-slide { font-size:<?php echo $navigation_font_size;?>px;}
<?php 
		if((int)$navigation_font_size>14) {
		?>		
            .cactus-headline .button-prev, 
     		.cactus-headline .button-next {font-size:<?php echo $navigation_font_size;?>px;}
        <?php	
		}else{
		?>
            .cactus-headline .button-prev, 
    		.cactus-headline .button-next {font-size:14px;}	            
		<?php
		}
	}; 
	
// Heading font
	$heading_font_size = ot_get_option('heading_font_size', '13');
	if($heading_font_size != '14'){
		$fontsizenewH1 = round($heading_font_size * 2.857);
		$fontsizenewH2 = round($heading_font_size * 2.29);
		$fontsizenewH3 = round($heading_font_size * 1.858);
		$fontsizenewH4 = round($heading_font_size * 1.43);
		$fontsizenewH5 = round($heading_font_size * 1.15);
	?>
    	h1, .h1 { font-size:<?php echo $fontsizenewH1;?>px;} 	
		h2, .h2,
        .cactus-listing-config.style-1 .cactus-post-item.featured-post .cactus-post-title { font-size:<?php echo $fontsizenewH2;?>px;} 
        
        						
		h3, .h3 { font-size:<?php echo $fontsizenewH3;?>px;} 						
		h4, .h4 { font-size:<?php echo $fontsizenewH4;?>px;} 						
		h5, .h5 { font-size:<?php echo $fontsizenewH5;?>px;}							
    	h6, .h6,
        .easy-tab .tabs li a,
        .cactus-scb[data-style="1"] .cactus-listing-config.style-1 .cactus-post-item:not(:first-child) .cactus-post-title,
    	.cactus-scb[data-style="3"] .cactus-listing-config.style-1 .cactus-post-item:not(:first-child) .primary-post-content .picture-content .content-abs-post .cactus-post-title,
    	.cactus-scb[data-style="4"] .cactus-listing-config.style-1 .fix-right-style-4 .cactus-post-item .cactus-post-title,
    	.cactus-scb[data-style="5"] .cactus-listing-config.style-1 .primary-post-content .picture-content .content-abs-post .cactus-post-title,
    	.cactus-scb[data-style="6"] .cactus-listing-config.style-1 .cactus-post-item:not(:first-child) .cactus-post-title,
        .cactus-widget-posts.style-2 .widget-posts-title,
        .cactus-tab .cactus-tab-heading { font-size:<?php echo $heading_font_size;?>px}        
	<?php };	
?>

<?php

//custom fonts 1
$custom_font_1 = ot_get_option( 'custom_font_1');
$custom_font_1A = ot_get_option( 'custom_font_1A');
if($custom_font_1!= '' || $custom_font_1A!=''){ ?>
	@font-face{
    	font-family: 'custom-font-1';
        <?php if($custom_font_1!='') {?>
    		src: url(<?php echo esc_url($custom_font_1); ?>) format('woff2');
        <?php };
		 	if($custom_font_1A!='') {
		?>
        	src: url(<?php echo esc_url($custom_font_1A); ?>) format('woff');
        <?php } ?>
    }
<?php } ?>


<?php

//custom fonts 2
$custom_font_2 = ot_get_option( 'custom_font_2');
$custom_font_2A = ot_get_option( 'custom_font_2A');
if($custom_font_2!= '' || $custom_font_2A!=''){ ?>
    @font-face{
        font-family: 'custom-font-2';
        <?php if($custom_font_2!='') {?>
            src: url(<?php echo esc_url($custom_font_2); ?>) format('woff2');
        <?php };
            if($custom_font_2A!='') {
        ?>
            src: url(<?php echo esc_url($custom_font_2A); ?>) format('woff');
        <?php } ?>
    }
<?php } ?>


<?php

//custom fonts 3
$custom_font_3 = ot_get_option( 'custom_font_3');
$custom_font_3A = ot_get_option( 'custom_font_3A');
if($custom_font_3!= '' || $custom_font_3A!=''){ ?>
    @font-face{
        font-family: 'custom-font-3';
        <?php if($custom_font_3!='') {?>
            src: url(<?php echo esc_url($custom_font_3); ?>) format('woff2');
        <?php };
            if($custom_font_3A!='') {
        ?>
            src: url(<?php echo esc_url($custom_font_3A); ?>) format('woff');
        <?php } ?>
    }
<?php } ?>

<?php

if(ot_get_option('ads_wall_1_width') != ''){?>
#ads_wall_1{margin-left: -<?php echo (ot_get_option('ads_wall_1_width')+5);?>px;}
<?php }

if(ot_get_option('ads_wall_1_top') != ''){?>
#ads_wall_1{margin-top: <?php echo ot_get_option('ads_wall_1_top');?>px;}
<?php }

if(ot_get_option('ads_wall_2_width') != ''){?>
#ads_wall_2{margin-right: -<?php echo (ot_get_option('ads_wall_2_width')+4);?>px;}
<?php }

if(ot_get_option('ads_wall_2_top') != ''){?>
#ads_wall_2{margin-top: <?php echo ot_get_option('ads_wall_2_top');?>px;}
<?php }
?>
@media screen and (max-width: 600px) {
	/*
	Label the data
	*/
	.woocommerce-page table.shop_table td.product-remove:before {
		content: "<?php esc_html_e( 'DELETE', 'cactusthemes' ); ?>";
	}
	
	.woocommerce-page table.shop_table td.product-thumbnail:before {
		content: "<?php esc_html_e( 'IMAGE', 'cactusthemes' ); ?>";
	}
	
	.woocommerce-page table.shop_table td.product-name:before {
		content: "<?php esc_html_e( 'PRODUCT', 'cactusthemes' ); ?>";
	}
	
	.woocommerce-page table.shop_table td.product-price:before {
		content: "<?php esc_html_e( 'PRICE', 'cactusthemes' ); ?>";
	}
	
	.woocommerce-page table.shop_table td.product-quantity:before {
		content: "<?php esc_html_e( 'QUANTITY', 'cactusthemes' ); ?>";
	}
	
	.woocommerce-page table.shop_table td.product-subtotal:before {
		content: "<?php esc_html_e( 'SUBTOTAL', 'cactusthemes' ); ?>";
	}
	
	.woocommerce-page table.shop_table td.product-total:before {
		content: "<?php esc_html_e( 'TOTAL', 'cactusthemes' ); ?>";
	}
}
