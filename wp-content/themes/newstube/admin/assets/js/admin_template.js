jQuery(document).ready(function() {

	//show hide settings when choose page tempate
	var page_tpl_obj 				= jQuery('select[name=page_template]');
	var page_tpl 					= jQuery('select[name=page_template]').val();
	var front_page_header_obj 		= jQuery('#header_front_page.postbox');
	var front_page_content_obj 		= jQuery('#front_page_meta_box2.postbox');

	var popular_post 	= jQuery('#popular_post.postbox');

	if(page_tpl == 'page-templates/front-page.php' || page_tpl == 'page-templates/default-demo-v1.php' || page_tpl == 'page-templates/demo-classic-slyde-layout-1.php' || page_tpl == 'page-templates/demo-classic-slyde-layout-2.php' || page_tpl == 'page-templates/demo-grid-layout-1.php' || page_tpl == 'page-templates/demo-grid-layout-2.php' || page_tpl == 'page-templates/demo-grid-layout-3.php' || page_tpl == 'page-templates/demo-post-carousel.php' || page_tpl == 'page-templates/demo-post-silder.php' || page_tpl == 'page-templates/demo-silder-parallax.php' || page_tpl == 'page-templates/demo-thumb-silder.php' || page_tpl == 'page-templates/demo-v2-sport.php' || page_tpl == 'page-templates/demo-v3-tech.php' || page_tpl == 'page-templates/demo-v4-fashion.php' || page_tpl == 'page-templates/demo-v5-travel.php' || page_tpl == 'page-templates/demo-blog-v1.php' || page_tpl == 'page-templates/demo-blog-v2.php' || page_tpl == 'page-templates/demo-blog-v3.php' || page_tpl == 'page-templates/demo-blog-v4.php' || page_tpl == 'page-templates/demo-blog-v5.php' || page_tpl == 'page-templates/demo-blog-v6.php' || page_tpl == 'page-templates/demo-blog-v7.php'|| page_tpl == 'page-templates/homepage-v1.php'|| page_tpl == 'page-templates/homepage-v2.php'|| page_tpl == 'page-templates/homepage-v3.php'|| page_tpl == 'page-templates/homepage-v4.php' || page_tpl == 'page-templates/demo-rtl.php'){
		front_page_header_obj.show();
		if(page_tpl == 'page-templates/front-page.php')
		{
			front_page_content_obj.show();
		}
		else
		{
			front_page_content_obj.show();
		}
	}else{
		front_page_header_obj.hide();
		front_page_content_obj.hide();
	}

	page_tpl_obj.change(function(event) {
		if(jQuery(this).val() == 'page-templates/front-page.php'|| jQuery(this).val() == 'page-templates/default-demo-v1.php' || jQuery(this).val() == 'page-templates/demo-classic-slyde-layout-1.php' || jQuery(this).val() == 'page-templates/demo-classic-slyde-layout-2.php' || jQuery(this).val() == 'page-templates/demo-grid-layout-1.php' || jQuery(this).val() == 'page-templates/demo-grid-layout-2.php' || jQuery(this).val() == 'page-templates/demo-grid-layout-3.php' || jQuery(this).val() == 'page-templates/demo-post-carousel.php' || jQuery(this).val() == 'page-templates/demo-post-silder.php' || jQuery(this).val() == 'page-templates/demo-silder-parallax.php' || jQuery(this).val() == 'page-templates/demo-thumb-silder.php' || jQuery(this).val() == 'page-templates/demo-v2-sport.php' || jQuery(this).val() == 'page-templates/demo-v3-tech.php' || jQuery(this).val() == 'page-templates/demo-v4-fashion.php' || jQuery(this).val() == 'page-templates/demo-v5-travel.php' || jQuery(this).val() == 'page-templates/demo-blog-v1.php' || jQuery(this).val() == 'page-templates/demo-blog-v2.php' || jQuery(this).val() == 'page-templates/demo-blog-v3.php' || jQuery(this).val() == 'page-templates/demo-blog-v4.php' || jQuery(this).val() == 'page-templates/demo-blog-v5.php' || jQuery(this).val() == 'page-templates/demo-blog-v6.php' || jQuery(this).val() == 'page-templates/demo-blog-v7.php'|| jQuery(this).val() == 'page-templates/homepage-v1.php'|| jQuery(this).val() == 'page-templates/homepage-v2.php'|| jQuery(this).val() == 'page-templates/homepage-v3.php'|| jQuery(this).val() == 'page-templates/homepage-v4.php' || jQuery(this).val() == 'page-templates/demo-rtl.php'){
			front_page_header_obj.show(200);
			if(jQuery(this).val() == 'page-templates/front-page.php')
			{
				front_page_content_obj.show(200);
			}
			else
			{
				front_page_content_obj.hide(200);
			}
		}else{
			front_page_header_obj.hide(200);
			front_page_content_obj.hide(200);
		}
	});

	if(page_tpl == 'page-templates/popular-posts.php'){
		popular_post.show();
	}else{
		popular_post.hide();
	}

	page_tpl_obj.change(function(event) {
		if(jQuery(this).val() == 'page-templates/popular-posts.php'){
			popular_post.show(200);
		}else{
			popular_post.hide(200);
		}
	});

	//js for theme options


	jQuery(document).on('click','#id_cactus_alert button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_alert_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_button button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_button_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_dropcap button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_dropcap_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_tooltip button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_tooltip_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_download_box button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_download_box_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_icon_box button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_icon_box_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_divider button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_divider_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_live_content button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_live_content_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_compare_table button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_compare_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_posts_grid button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_posts_grid_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_posts_carousel button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_posts_carousel_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_posts_classic_slider button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_posts_classic_slider_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_posts_parallax button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_posts_parallax_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_posts_slider button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_posts_slider_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_posts_thumb_slider button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_posts_thumb_slider_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_smart_content_box button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_smart_content_box_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_testimonial button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_testimonial_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_topic_box button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_topic_box_shortcode button').trigger( "click" );
	});

	jQuery(document).on('click','#id_cactus_tab button',function() {
		jQuery('.mce-foot button').trigger( "click" );
		jQuery('#cactus_tab_shortcode button').trigger( "click" );
	});
    
    jQuery('.color').wpColorPicker();
});

jQuery(document).ready(function(){
	var defaultVal=jQuery('input[name=post_format]:checked', '#post').val();
	checkPostformat(defaultVal);
	jQuery('input[name=post_format]', '#post').click(function(){
		var keyVal=jQuery(this).val();
		checkPostformat(keyVal);
	});
	function checkPostformat(strVal){

		switch(strVal) {
		case "0":
			jQuery('#post_meta_box_layout #setting_post_standard_layout').show('slow');
			jQuery('#post_meta_box_layout #setting_post_video_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_audio_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_gallery_layout').hide('slow');
			break;
		case "video":
			jQuery('#post_meta_box_layout #setting_post_video_layout').show('slow');
			jQuery('#post_meta_box_layout #setting_post_standard_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_audio_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_gallery_layout').hide('slow');
			break;
		case "audio":
			jQuery('#post_meta_box_layout #setting_post_audio_layout').show('slow');
			jQuery('#post_meta_box_layout #setting_post_standard_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_video_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_gallery_layout').hide('slow');
			break;
		case "gallery":
			jQuery('#post_meta_box_layout #setting_post_gallery_layout').show('slow');
			jQuery('#post_meta_box_layout #setting_post_standard_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_video_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_audio_layout').hide('slow');
			break;
		default:
			jQuery('#post_meta_box_layout #setting_post_gallery_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_standard_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_video_layout').hide('slow');
			jQuery('#post_meta_box_layout #setting_post_audio_layout').hide('slow');
			break;

		}
	};
});

//custom upload image in User Setting.
jQuery(document).ready(function($){

    var custom_uploader;

    $('#upload_image_button').click(function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            if($('#author_header_background').length > 0)
            	$('#author_header_background').val(attachment.url);
            if($('#cat_bg').length > 0)
            	$('#cat_bg').val(attachment.url);
        });
        //Open the uploader dialog
        custom_uploader.open();

    });

    $('#remove_image_button').click(function(e) {
    	if($('#cat_bg').length > 0)
    	{
        	$('#cat_bg').val("");
    	}
 	});

	$('#upload_image_button1').click(function(e) {

	    e.preventDefault();

	    //If the uploader object has already been created, reopen the dialog
	    if (custom_uploader) {
	        custom_uploader.open();
	        return;
	    }

	    //Extend the wp.media object
	    custom_uploader = wp.media.frames.file_frame = wp.media({
	        title: 'Choose Image',
	        button: {
	            text: 'Choose Image'
	        },
	        multiple: false
	    });

	    //When a file is selected, grab the URL and set it as the text field's value
	    custom_uploader.on('select', function() {
	        attachment = custom_uploader.state().get('selection').first().toJSON();
	        if($('#cat_bg').length > 0)
	        	$('#cat_bg').val(attachment.url);
	    });
	    //Open the uploader dialog
	    custom_uploader.open();

	});

});
