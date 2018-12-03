<?php

/**
 * Initialize the meta boxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 * @package cactus
 */
add_action( 'admin_init', 'cactus_meta_boxes' );

if ( ! function_exists( 'cactus_meta_boxes' ) ){
	function cactus_meta_boxes() {
		  $post_settings_meta = array(
			'id'        => 'post_meta_box',
			'title'     => esc_html__('Post Settings','cactus'),
			'desc'      => '',
			'pages'     => array( 'post' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
		  			  'id'          => 'featured_post',
		  			  'label'       => esc_html__('Featured Post','cactus'),
		  			  'desc'        => esc_html__('Make this post featured','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'select',
		  			  'choices'     => array(
		  			    array(
		  			      'value'       => 'no',
		  			      'label'       => esc_html__( 'No', 'cactus' ),
		  			      'src'         => ''
		  			    ),
		  			  	array(
		  			      'value'       => 'yes',
		  			      'label'       => esc_html__( 'Yes', 'cactus' ),
		  			      'src'         => ''
		  			    )
		  			  )
		  		),
		  		array(
		  			  'id'          => 'show_related_post_in_archive',
		  			  'label'       => esc_html__('Show Related Posts in Archives','cactus'),
		  			  'desc'        => esc_html__('Show Related Posts in Archive pages.','cactus'),
		  			  'std'         => 'default',
		  			  'type'        => 'select',
		  			  'choices'     => array(
		  			  	array(
		  			      'value'       => 'yes',
		  			      'label'       => esc_html__( 'Yes', 'cactus' ),
		  			      'src'         => ''
		  			    ),
		  			    array(
		  			      'value'       => 'no',
		  			      'label'       => esc_html__( 'No', 'cactus' ),
		  			      'src'         => ''
		  			    )
		  			  )
		  		),
		  		array(
				  'id'          => 'live_post',
				  'label'       => esc_html__('Live post','cactus'),
				  'desc' => esc_html__('Content of Live Post will be updated automatically','cactus'),
				  'std'         => 'off',
				  'type'        => 'on-off',
				  'class'       => '',
				  'choices'     => array()
				),
				array(
				  'id'          => 'live_post_auto_refresh',
				  'label'       => esc_html__('Live Post - Auto refresh time','cactus'),
				  'desc'        => esc_html__('In seconds. Default is 5 (seconds)','cactus'),
				  'std'         => '5',
				  'condition'   => 'live_post:is(on)',
				  'type'        => 'text',
				  'class'       => '',
				  'choices'     => array()
				),
				array(
				  'id'          => 'live_comment',
				  'label'       => esc_html__('Live Comment','cactus'),
				  'desc' => esc_html__('Comments will be updated automatically. In addition, this post layout changes','cactus'),
				  'std'         => 'off',
				  'type'        => 'on-off',
				  'class'       => '',
				  'choices'     => array()
				),
				array(
				  'id'          => 'cm_auto_refresh',
				  'label'       => esc_html__('Live Comment - Auto refresh time','cactus'),
				  'desc'        => esc_html__('In seconds. Default is 5 (seconds)','cactus'),
				  'std'         => '5',
				  'condition'   => 'live_comment:is(on)',
				  'type'        => 'text',
				  'class'       => '',
				  'choices'     => array()
				),
				array(
		  			  'id'          => 'enable_scroll_to_next_post',
		  			  'label'       => esc_html__('Enable scroll to next posts','cactus'),
		  			  'desc'        => esc_html__('When users scroll to bottom of a single post, next posts will be loaded automatically','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'select',
		  			  'choices'     => array(
		  			  	array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => ''
		  			    ),
		  			  	array(
		  			      'value'       => 'on',
		  			      'label'       => esc_html__( 'Yes', 'cactus' ),
		  			      'src'         => ''
		  			    ),
		  			    array(
		  			      'value'       => 'off',
		  			      'label'       => esc_html__( 'No', 'cactus' ),
		  			      'src'         => ''
		  			    )
		  			  )
		  		),
			 )
		  );

		  $post_layout_meta = array('id'        => 'post_meta_box_layout',
			'title'     => esc_html__('Post Layout','cactus'),
			'desc'      => '',
			'pages'     => array( 'post' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					'id'          => 'post_bg',
					'label'       => esc_html__('Background','cactus'),
					'desc'        => esc_html__('Set background image for this post.','cactus'),
					'std'         => '',
					'type'        => 'background'
				),
				array(
					'id'          => 'post_bg_link',
					'label'       => esc_html__('Background Link','cactus'),
					'desc'        => esc_html__('Hyperlink to background image that will overrides default setting in Theme Options','cactus'),
					'std'         => '',
					'type'        => 'text'
				),
				array(
		  			  'id'          => 'post_sidebar',
		  			  'label'       => esc_html__('Sidebar','cactus'),
		  			  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'select',
		  			  'choices'     => array(
		  			  	array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => ''
		  			    ),
		  			    array(
		  			      'value'       => 'right',
		  			      'label'       => esc_html__( 'Right', 'cactus' ),
		  			      'src'         => ''
		  			    ),
		  			    array(
		  			      'value'       => 'left',
		  			      'label'       => esc_html__( 'Left', 'cactus' ),
		  			      'src'         => ''
		  			    ),
		  			    array(
		  			      'value'       => 'hidden',
		  			      'label'       => esc_html__( 'Hidden', 'cactus' ),
		  			      'src'         => ''
		  			    )
		  			  )
		  		),
				array(
		  			  'id'          => 'post_standard_layout',
		  			  'label'       => esc_html__('Standard Layout','cactus'),
		  			  'desc'        => esc_html__('Standard Layout','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'radio-image',
		  			  'choices'     => array(
		  			    array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/default.png'
		  			    ),
		  			  	array(
		  			      'value'       => '1',
		  			      'label'       => esc_html__( 'Layout 1', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-01.png'
		  			    ),
						array(
		  			      'value'       => '2',
		  			      'label'       => esc_html__( 'Layout 2', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-02.png'
		  			    ),
						array(
		  			      'value'       => '3',
		  			      'label'       => esc_html__( 'Layout 3', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-03.png'
		  			    ),
						array(
		  			      'value'       => '4',
		  			      'label'       => esc_html__( 'Layout 4', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-04.png'
		  			    ),
						array(
		  			      'value'       => '5',
		  			      'label'       => esc_html__( 'Layout 5', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-05.png'
		  			    )
		  			  )
		  		),
				array(
		  			  'id'          => 'post_video_layout',
		  			  'label'       => esc_html__('Video Layout','cactus'),
		  			  'desc'        => esc_html__('Video Layout','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'radio-image',
		  			  'choices'     => array(
		  			    array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/default.png'
		  			    ),
		  			  	array(
		  			      'value'       => '1',
		  			      'label'       => esc_html__( 'Boxed', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Video-post-01.png'
		  			    ),
						array(
		  			      'value'       => '2',
		  			      'label'       => esc_html__( 'Full-Width', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Video-post-02.png'
		  			    ),
						array(
		  			      'value'       => '3',
		  			      'label'       => esc_html__( 'Theater', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Video-post-03.png'
		  			    )
		  			  )
		  		),
				array(
		  			  'id'          => 'post_audio_layout',
		  			  'label'       => esc_html__('Audio Layout','cactus'),
		  			  'desc'        => esc_html__('Audio Layout','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'radio-image',
		  			  'choices'     => array(
		  			    array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/default.png'
		  			    ),
		  			  	array(
		  			      'value'       => '1',
		  			      'label'       => esc_html__( 'Layout 1', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Audio-post-01.png'
		  			    ),
						array(
		  			      'value'       => '2',
		  			      'label'       => esc_html__( 'Layout 2', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Audio-post-02.png'
		  			    )
		  			  )
		  		),
				array(
		  			  'id'          => 'post_gallery_layout',
		  			  'label'       => esc_html__('Gallery Layout','cactus'),
		  			  'desc'        => esc_html__('Gallery Layout','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'radio-image',
		  			  'choices'     => array(
		  			    array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/default.png'
		  			    ),
		  			  	array(
		  			      'value'       => '1',
		  			      'label'       => esc_html__( 'Layout 1', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Garelly-post-01.png'
		  			    ),
						array(
		  			      'value'       => '2',
		  			      'label'       => esc_html__( 'Layout 2', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/Garelly-post-02.png'
		  			    )
		  			  )
		  		)
			 ));
		  $post_meta_boxes3 = array(
		  	'id'        => 'ct_post_meta_box3',
		  	'title'     => esc_html__('Advertising','cactus'),
		  	'desc'      => '',
		  	'pages'     => array( 'post' ),
		  	'context'   => 'normal',
		  	'priority'  => 'high',
		  	'fields'    => array(
		  		array(
		  			  'id'          => 'wall_ads_1_adsense',
		  			  'label'       => esc_html__('Wall Ads Left - Adsense Slot','cactus'),
		  			  'desc'        => esc_html__('Enter Google Adsense Slot ID','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'text'
		  		),
				array(
		  			  'id'          => 'wall_ads_1_custom',
		  			  'label'       => esc_html__('Wall Ads Left - Custom Code','cactus'),
		  			  'desc'        => esc_html__('Enter custom HTML ads for this position if you do not use Google Adsense','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'textarea'
		  		),
				array(
		  			  'id'          => 'wall_ads_2_adsense',
		  			  'label'       => esc_html__('Wall Ads Right - Adsense Slot','cactus'),
		  			  'desc'        => esc_html__('Enter Google Adsense Slot ID','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'text'
		  		),
				array(
		  			  'id'          => 'wall_ads_2_custom',
		  			  'label'       => esc_html__('Wall Ads Right - Custom Code','cactus'),
		  			  'desc'        => esc_html__('Enter custom HTML ads for this position if you do not use Google Adsense','cactus'),
		  			  'std'         => '',
		  			  'type'        => 'textarea'
		  		)
		  	 )
		    );


	  ot_register_meta_box( $post_layout_meta );
	  ot_register_meta_box( $post_settings_meta );
	  ot_register_meta_box( $post_meta_boxes3 );
	}
}

/*Page Metabox*/
add_action( 'admin_init', 'cactus_page_meta_boxes' );
if ( ! function_exists( 'cactus_page_meta_boxes' ) ){
	function cactus_page_meta_boxes() {
		$page_meta_boxes = array();

		$page_meta_boxes = array(
			'id'        => 'post_meta_box',
			'title'     => esc_html__('Page Settings','cactus'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
				  'id'          => 'page_sidebar',
				  'label'       => esc_html__('Sidebar','cactus'),
				  'desc'        => esc_html__('Select "Default" to use settings in Theme Options or Front page fullwidth','cactus'),
				  'std'         => '',
				  'type'        => 'select',
				  'class'       => '',
				  'choices'     => array(
					  array(
						'value'       => 0,
						'label'       => 'Default',
						'src'         => ''
					  ),
					  array(
						'value'       => 'left',
						'label'       => 'Left',
						'src'         => ''
					  ),
					  array(
						'value'       => 'right',
						'label'       => 'Right',
						'src'         => ''
					  ),
					  array(
						'value'       => 'full',
						'label'       => 'Hidden',
						'src'         => ''
					  )
				   )
				),
				array(
					  'id'          => 'page_bg',
					  'label'       => esc_html__('Page Background','cactus'),
					  'desc'        => esc_html__('Choose background for this page','cactus'),
					  'std'         => '',
					  'type'        => 'background'
				),

				array(
					'id'          => 'page_bg_link',
					'label'       => esc_html__('Background Link','cactus'),
					'desc'        => esc_html__('Hyperlink to background image that will overrides default setting in Theme Options','cactus'),
					'std'         => '',
					'type'        => 'text'
				),
			)
		);
		ot_register_meta_box( $page_meta_boxes );

		$front_page_popular = array(
			'id'        => 'popular_post',
			'title'     => esc_html__('Popular Posts Content Settings','cactus'),
			'desc'      => 'These settings apply for Popular Posts template',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'front_popular_conditions',
					  'label'       => esc_html__('Conditions','cactus'),
					  'desc'        => esc_html__('Condition to query Popular Posts','cactus'),
					  'std'         => 'latest',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'latest',
					      'label'       => esc_html__( 'Latest', 'cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'most_viewed',
					      'label'       => esc_html__( 'Most Viewed', 'cactus' ),
					      'src'         => ''
					    ),
						array(
					      'value'       => 'most_liked',
					      'label'       => esc_html__( 'Most Liked', 'cactus' ),
					      'src'         => ''
					    ),
						array(
					      'value'       => 'most_commented',
					      'label'       => esc_html__( 'Most commented', 'cactus' ),
					      'src'         => ''
					    ),
					  )
				),
				array(
					  'id'          => 'popular_time_range',
					  'label'       => esc_html__('Time range','cactus'),
					  'desc'        => esc_html__('Time range of condition to query Popular Posts','cactus'),
					  'std'         => 'post-date',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'all',
					      'label'       => esc_html__( 'All time', 'cactus' ),
					      'src'         => ''
					    ),
						array(
					      'value'       => 'day',
					      'label'       => esc_html__( 'A Day ago', 'cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'week',
					      'label'       => esc_html__( 'A Week ago', 'cactus' ),
					      'src'         => ''
					    ),
						array(
					      'value'       => 'month',
					      'label'       => esc_html__( 'A Month ago', 'cactus' ),
					      'src'         => ''
					    ),
						array(
					      'value'       => 'year',
					      'label'       => esc_html__( 'A Year ago', 'cactus' ),
					      'src'         => ''
					    )
					  )
				),
				array(
					  'id'          => 'popular_style',
					  'label'       => esc_html__('Listing Layout','cactus'),

					  'desc'        => esc_html__('Layout of Popular Posts page','cactus'),
					  'std'         => 'layout_1',
					  'type'        => 'radio-image',
					  'choices'     => array(
					  	array(
					      'value'       => 'layout_1',
					      'label'       => esc_html__( 'Layout 1', 'cactus' ),
					      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog1.png'
					    ),
						array(
					      'value'       => 'layout_2',
					      'label'       => esc_html__( 'Layout 2', 'cactus' ),
					      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog2.png'
					    ),
					    array(
					      'value'       => 'layout_3',
					      'label'       => esc_html__( 'Layout 3', 'cactus' ),
					      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog3.png'
					    ),
						array(
					      'value'       => 'layout_4',
					      'label'       => esc_html__( 'Layout 4', 'cactus' ),
					      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog4.png'
					    ),
						array(
					      'value'       => 'layout_5',
					      'label'       => esc_html__( 'Layout 5', 'cactus' ),
					      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog5.png'
					    ),
						array(
					      'value'       => 'layout_6',
					      'label'       => esc_html__( 'Layout 6', 'cactus' ),
					      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog6.png'
					    ),
						array(
					      'value'       => 'layout_7',
					      'label'       => esc_html__( 'Layout 7', 'cactus' ),
					      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog7.png'
					    )
					  )
				),
				array(
				  'id'          => 'enable_popular_posts_button',
				  'label'       => esc_html__('Show Popular Posts select box','cactus'),
				  'desc'        => esc_html__('Show a select box to switch between Popular Posts and Latest Posts (blog) page','cactus'),
				  'std'         => 'off',
				  'type'        => 'on-off',
				  'class'       => '',
				)
			 )
			);
	  ot_register_meta_box( $front_page_popular );


	  $header_front_page = array(
			'id'        => 'header_front_page',
			'title'     => esc_html__('Front Page Header Settings','cactus'),
			'desc'      => esc_html__('These settings apply for Header Front Page template','cactus'),
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'front_page_layout',
					  'label'       => esc_html__('Front Page Layout','cactus'),
					  'desc'        => esc_html__('Choose default to use setting in Theme Options > Theme Layout','cactus'),
					  'std'         => '',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
			  	            'value'       => '',
			  	            'label'       => esc_html__('Default', 'cactus' ),
			  	            'src'         => ''
		  	          	),
					  	array(
			  	            'value'       => 'boxed',
			  	            'label'       => esc_html__('Boxed', 'cactus' ),
			  	            'src'         => ''
		  	          	),
		  	          	array(
			  	            'value'       => 'fullwidth',
			  	            'label'       => esc_html__('Full width', 'cactus' ),
			  	            'src'         => ''
		  	          	)
					  )
				),

				array(
					  'id'          => 'front_page_navigation_style',
					  'label'       => esc_html__('Front Page Navigation Style','cactus'),
					  'desc'        => esc_html__('Choose default to use setting in Theme Options > Theme Layout','cactus'),
					  'std'         => '',
					  'type'        => 'radio-image',
					  'choices'     => array(
					  	array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/default.png'
		  			    ),
					  	array(
			  	            'value'       => 'style_1',
			  	            'label'       => esc_html__('Style 1', 'cactus' ),
			  	            'src'         => get_template_directory_uri() . '/images/theme-options/Layout-Navigation-Style1.png'
		  	          	),
		  	          	array(
			  	            'value'       => 'style_2',
			  	            'label'       => esc_html__('Style 2', 'cactus' ),
			  	            'src'         => get_template_directory_uri() . '/images/theme-options/Layout-Navigation-Style2.png'
		  	          	),
		  	          	array(
			  	            'value'       => 'style_3',
			  	            'label'       => esc_html__('Style 3', 'cactus' ),
			  	            'src'         => get_template_directory_uri() . '/images/theme-options/Layout-Navigation-Style3.png'
		  	          	),
		  	          	array(
			  	            'value'       => 'style_4',
			  	            'label'       => esc_html__('Style 4', 'cactus' ),
			  	            'src'         => get_template_directory_uri() . '/images/theme-options/Layout-Navigation-Style4.png'
		  	          	),
					  )
				),
				array(
					  'id'          => 'front_page_header',
					  'label'       => esc_html__('Front Page Header','cactus'),
					  'desc'        => esc_html__('Enable/Disable Header of this page','cactus'),
					  'std'         => '',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
			  	            'value'       => '',
			  	            'label'       => esc_html__('Enable', 'cactus' )
		  	          	),
					  	array(
			  	            'value'       => 'disabled',
			  	            'label'       => esc_html__('Disable', 'cactus' )
		  	          	)
					  )
				),
				array(
					  'id'          => 'front_page_header_layout',
					  'label'       => esc_html__('Front Page Header Layout','cactus'),
					  'desc'        => esc_html__('Choose default to use setting in Theme Options > Front Page','cactus'),
					  'std'         => '',
					  'type'        => 'radio-image',
					  'choices'     => array(
					  	array(
		  			      'value'       => '',
		  			      'label'       => esc_html__( 'Default', 'cactus' ),
		  			      'src'         => get_template_directory_uri() . '/images/theme-options/default.png'
		  			    ),
					  	array(
				            'value'       => 'layout_1',
				            'label'       => esc_html__('Layout 1', 'cactus'),
				            'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-01.png'
			          	),
				          array(
				            'value'       => 'layout_2',
				            'label'       => esc_html__('Layout 2', 'cactus'),
				            'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-02.png'
			          	),
					  )
				),
				array(
				  'id'          => 'front_page_header_content',
				  'label'       => esc_html__('Front Page Header Content','cactus'),
				  'desc'        => esc_html__('If left empty, settings in Theme Options > Front Page will be used. You can use a shortcode here','cactus'),
				  'std'         => '',
				  'condition'   => '',
				  'type'        => 'textarea',
				  'class'       => '',
				  'choices'     => array()
				),
			 )
			);
	  ot_register_meta_box( $header_front_page );

	  $front_page_content_settings = array(
			'id'        => 'front_page_meta_box2',
			'title'     => esc_html__('Front Page Content Settings','cactus'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'fr_page_content',
					  'label'       => esc_html__('Content','cactus'),
					  'desc'        => '',
					  'std'         => 'page_content',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'page_content',
					      'label'       => esc_html__( 'This Page Content', 'cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'blog',
					      'label'       => esc_html__( 'Blog(latest post)', 'cactus' ),
					      'src'         => ''
					    ),
					  )
				),
				array(
				  'id'          => 'fr_blog_layout',
				  'label'       => esc_html__('Layout', 'cactus' ),
				  'desc'        => esc_html__('Select blog layout', 'cactus' ),
				  'std'         => '',
				  'type'        => 'radio-image',
				  'condition'   => 'fr_page_content:is(blog)',
				  'choices'     => array(
				  	array(
	  			      'value'       => '',
	  			      'label'       => esc_html__( 'Default', 'cactus' ),
	  			      'src'         => get_template_directory_uri() . '/images/theme-options/default.png'
	  			    ),
				    array(
				      'value'       => 'layout_1',
				      'label'       => esc_html__('Layout 1', 'cactus' ),
				      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog1.png'
				    ),
				    array(
				      'value'       => 'layout_2',
				      'label'       => esc_html__('Layout 2', 'cactus' ),
				      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog2.png'
				    ),
				    array(
				      'value'       => 'layout_3',
				      'label'       => esc_html__('Layout 3', 'cactus' ),
				      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog3.png'
				    ),
				    array(
				      'value'       => 'layout_4',
				      'label'       => esc_html__('Layout 4', 'cactus' ),
				      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog4.png'
				    ),
				    array(
				      'value'       => 'layout_5',
				      'label'       => esc_html__('Layout 5', 'cactus' ),
				      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog5.png'
				    ),
				    array(
				      'value'       => 'layout_6',
				      'label'       => esc_html__('Layout 6', 'cactus' ),
				      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog6.png'
				    ),
				    array(
				      'value'       => 'layout_7',
				      'label'       => esc_html__('Layout 7', 'cactus' ),
				      'src'         => get_template_directory_uri() . '/images/theme-options/layout-blog7.png'
				    )
				  )
				),
				array(
				  'id'          => 'fr_page_post_categories',
				  'label'       => esc_html__('Post categories', 'cactus' ),
				  'desc'        => esc_html__('Enter category Ids or slugs to get posts from, separated by a comma', 'cactus' ),
				  'std'         => '',
				  'type'        => 'text',
				  'condition'   => 'fr_page_content:is(blog)',
				  'operator'    => 'and'
				),
				array(
				  'id'          => 'fr_page_post_tags',
				  'label'       => esc_html__('Post tags', 'cactus' ),
				  'desc'        => esc_html__('Enter tags to get posts from, separated by a comma', 'cactus' ),
				  'std'         => '',
				  'type'        => 'text',
				  'condition'   => 'fr_page_content:is(blog)',
				  'operator'    => 'and'
				),
				array(
				  'id'          => 'fr_page_post_id',
				  'label'       => esc_html__('Post Ids', 'cactus' ),
				  'desc'        => esc_html__('Enter post IDs, separated by a comma.If this param is used, other params are ignored', 'cactus' ),
				  'std'         => '',
				  'type'        => 'text',
				  'condition'   => 'fr_page_content:is(blog)',
				  'operator'    => 'and'
				),
				array(
				  'id'          => 'fr_page_order_by',
				  'label'       => esc_html__('Order by','cactus'),
				  'desc'        => esc_html__('','cactus'),
				  'std'         => 'date',
				  'type'        => 'select',
				  'condition'   => 'fr_page_content:is(blog)',
			  		'operator'    => 'and',
				  'choices'     => array(
				  	array(
				      'value'       => 'date',
				      'label'       => esc_html__( 'Post date', 'cactus' ),
				      'src'         => ''
				    ),
				    array(
				      'value'       => 'random',
				      'label'       => esc_html__( 'Random', 'cactus' ),
				      'src'         => ''
				    )
				  )
				),
				array(
				  'id'          => 'fr_page_post_count',
  				  'label'       => esc_html__('Post Count', 'cactus' ),
  				  'desc'        => esc_html__('Enter number of posts to display', 'cactus' ),
  				  'std'         => '9',
  				  'type'        => 'text',
  				  'condition'   => 'fr_page_content:is(blog)',
			  	  'operator'    => 'and'
				),
			 )
			);

		ot_register_meta_box( $front_page_content_settings );

	}
}
