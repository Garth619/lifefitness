<?php
/**
 * cactus theme sample theme options file. This file is generated from Export feature in Option Tree.
 *
 * @package cactus
 */

/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {

  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( ot_settings_id(), array() );

  /**
   * Custom settings array that will eventually be
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'option_types_help',
          'title'     => esc_html__( 'Option Types', 'theme-text-domain' ),
          'content'   => '<p>' . esc_html__( 'Help content goes here!', 'theme-text-domain' ) . '</p>'
        )
      ),
      'sidebar'       => '<p>' . esc_html__( 'Sidebar content goes here!', 'theme-text-domain' ) . '</p>'
    ),
  'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => esc_html__('General', 'cactus')
      ),
      array(
        'id'          => 'color_n_fonts',
        'title'       => esc_html__('Color and Fonts', 'cactus')
      ),
      array(
        'id'          => 'theme_layout',
        'title'       =>  esc_html__('Theme Layout', 'cactus')
      ),
      array(
        'id'          => 'front_page',
        'title'       =>  esc_html__('Front Page', 'cactus')
      ),
      array(
        'id'          => 'blog',
        'title'       => esc_html__('Archives','cactus')
      ),
      array(
        'id'          => 'single_post',
        'title'       => esc_html__('Single Post', 'cactus')
      ),
	  array(
        'id'          => 'user_submit',
        'title'       => esc_html__('Front-end Post Submission','cactus')
      ),
      array(
        'id'          => 'single_page',
        'title'       => esc_html__('Single page', 'cactus')
      ),
      array(
        'id'          => 'categories',
        'title'       => esc_html__('Categories', 'cactus')
      ),
      array(
        'id'          => 'page_not_found',
        'title'       => esc_html__('404 - Page Not Found', 'cactus')
      ),
      array(
        'id'          => 'social_accounts',
        'title'       => esc_html__('Social Accounts','cactus')
      ),
       array(
        'id'          => 'sharing_social',
        'title'       => esc_html__('Sharing','cactus')
      ),
    array(
        'id'          => 'advertising',
        'title'       => esc_html__('Advertising','cactus')
      ),
	  array(
        'id'          => 'woocommerce',
        'title'       => esc_html__('WooCommerce','cactus'),
      ),
    ),
    'settings'        => array(
      array(
        'id'          => 'enable_search',
        'label'       => esc_html__('Enable Search','cactus'),
        'desc'        => esc_html__('Enable or disable default search form in every pages','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'seo_meta_tags',
        'label'       => esc_html__('SEO - Echo Meta Tags','cactus'),
        'desc'        => esc_html__('By default, The Blog generates its own SEO meta tags (for example: Facebook Meta Tags). If you are using another SEO plugin like YOAST or a Facebook plugin, you can turn off this option','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'rtl',
        'label'       => esc_html__( 'RTL Mode', 'cactus' ),
        'desc'        => esc_html__( 'Support Right-to-Left language', 'cactus' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_code',
        'label'       => esc_html__('Custom Code','cactus'),
        'desc'        => esc_html__('Enter custom code or JS code here. For example, enter Google Analytics code','cactus'),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_css',
        'label'       => esc_html__( 'Custom CSS', 'cactus' ),
        'desc'        => esc_html__('Enter CSS code','cactus'),
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_image',
        'label'       => esc_html__('Main Logo (Non-retina)','cactus'),
        'desc'        => esc_html__('Upload your logo image','cactus'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'retina_logo',
        'label'       => esc_html__('Main Logo - Retina','cactus'),
        'desc'        => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices.','cactus'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_image_sticky',
        'label'       => esc_html__('Logo Image For Sticky Menu','cactus'),
        'desc'        => esc_html__('Upload your logo image for sticky menu','cactus'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'login_logo_image',
        'label'       => esc_html__('Login Logo Image','cactus'),
        'desc'        => esc_html__('Upload your Admin Login logo image','cactus'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'copyright',
        'label'       => esc_html__('Copyright Text','cactus'),
        'desc'        => esc_html__('Enter copyright text','cactus'),
        'std'         => 'WordPress Theme by cactus.com',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    array(
        'id'          => 'user_show_info',
        'label'       => esc_html__('User Info Area','cactus'),
        'desc'        => esc_html__('Show login/logout on top of the page','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_link_on_datetime',
        'label'       => esc_html__('Turn on/off Link on Date Time','cactus'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
          'id'          => 'scroll_effect',
          'label'       => esc_html__('Scroll Effect','cactus'),
          'desc'        => esc_html__('Enable Page Scroll effect','cactus'),
          'std'         => 'off',
          'type'        => 'on-off',
          'section'     => 'general',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'min_max_step'=> '',
          'class'       => '',
          'condition'   => '',
          'operator'    => 'and'
        ),

      // Color and font block
      array(
        'id'          => 'main_color',
        'label'       => esc_html__('Main Color', 'cactus' ),
        'desc'        => esc_html__('Choose main color of theme', 'cactus' ),
        'std'         => '#f9da16',
        'type'        => 'colorpicker',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_font',
        'label'       => esc_html__('Google Font','cactus'),
        'desc'        => esc_html__('Use Google Fonts','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_font_family',
        'label'       => esc_html__('Main Font Family', 'cactus' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_font_size',
        'label'       => esc_html__('Main Font Size', 'cactus' ),
        'desc'        => esc_html__('Select base font size', 'cactus' ),
        'std'         => '14',
        'type'        => 'numeric-slider',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '12,20,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'navigation_font_family',
        'label'       => esc_html__('Navigation Font Family', 'cactus' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'navigation_font_size',
        'label'       => esc_html__('Navigation Font Size', 'cactus' ),
        'desc'        => esc_html__('Select base font size', 'cactus' ),
        'std'         => '12',
        'type'        => 'numeric-slider',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '9,17,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'heading_font_family',
        'label'       => esc_html__('Heading Font Family', 'cactus' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_size',
        'label'       => esc_html__('Heading Font Size', 'cactus' ),
        'desc'        => esc_html__('Select base font size', 'cactus' ),
        'std'         => '13',
        'type'        => 'numeric-slider',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '12,20,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'custom_font_1A',
        'label'       => esc_html__('Custom Font 1 (woff)', 'cactus' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-1" in "Main Font Family", "Navigation Font Family" or "Heading Font Family" setting above.', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_1',
        'label'       => esc_html__('Custom Font 1 (woff2)', 'cactus' ),
        'desc'        => esc_html__('', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'custom_font_2A',
        'label'       => esc_html__('Custom Font 2 (woff)', 'cactus' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-2" in "Main Font Family", "Navigation Font Family" or "Heading Font Family" setting above.', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_2',
        'label'       => esc_html__('Custom Font 2 (woff2)', 'cactus' ),
        'desc'        => esc_html__('', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'custom_font_3A',
        'label'       => esc_html__('Custom Font 3 (woff)', 'cactus' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-3" in "Main Font Family", "Navigation Font Family" or "Heading Font Family" setting above.', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_3',
        'label'       => esc_html__('Custom Font 3 (woff2)', 'cactus' ),
        'desc'        => esc_html__('', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'color_n_fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End Color and font block

      array(
        'id'          => 'main_layout',
        'label'       => esc_html__('Main Layout', 'cactus' ),
        'desc'        => esc_html__('', 'cactus' ),
        'std'         => 'boxed',
        'type'        => 'select',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
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
        'id'          => 'navigation_style',
        'label'       => esc_html__('Navigation Style', 'cactus' ),
        'desc'        => esc_html__('', 'cactus' ),
        'std'         => 'style_1',
        'type'        => 'radio-image',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
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
        'id'          => 'megamenu',
        'label'       => esc_html__('Mega Menu','cactus'),
        'desc'        => esc_html__('Enable Mega Menu','cactus'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'sticky_navigation',
        'label'       => esc_html__('Sticky Menu','cactus'),
        'desc'        => esc_html__('Enable Sticky Menu','cactus'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'sticky_up_down',
        'label'       => esc_html__('Sticky Menu Behavior', 'cactus' ),
        'std'         => 'up',
        'type'        => 'select',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
		'condition'	  => 'sticky_navigation:is(on)',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'up',
            'label'       => esc_html__('Only appears when page is Scrolled Up', 'cactus'),
            'src'         => ''
          ),array(
            'value'       => 'down',
            'label'       => esc_html__('Always Sticky', 'cactus'),
            'src'         => ''
          ),         
        )
      ),	  
      array(
        'id'          => 'sticky_main_sidebar',
        'label'       => esc_html__('Sticky Main Sidebar','cactus'),
        'desc'        => esc_html__('Make Main Sidebar float','cactus'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    array(
        'id'          => 'background',
        'label'       => esc_html__('Background', 'cactus' ),
        'desc'        => esc_html__('Set theme background', 'cactus' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'theme_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    array(
      'id'          => 'background_link',
      'label'       => esc_html__('Background Link', 'cactus' ),
      'desc'        => esc_html__('Hyperlink for background image', 'cactus' ),
      'std'         => '',
      'type'        => 'text',
      'section'     => 'theme_layout'
    ),
    array(
        'id'          => 'default_front_page_layout',
        'label'       => esc_html__('Default Layout', 'cactus' ),
        'desc'        => esc_html__('Select default layout for front page', 'cactus' ),
        'std'         => 'layout_1',
        'type'        => 'radio-image',
        'section'     => 'front_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'layout_1',
            'label'       => esc_html__('Layout 1', 'cactus'),
            'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-01.png'
          ),
          array(
            'value'       => 'layout_2',
            'label'       => esc_html__('Layout 2', 'cactus'),
            'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-02.png'
          )
        )
      ),
      array(
        'id'          => 'featured_post_layout',
        'label'       => esc_html__('Header - Featured Posts Layout', 'cactus' ),
        'desc'        => esc_html__('Choose layout for Featured Posts section in Front Page', 'cactus' ),
        'std'         => 'posts_grid_layout_1',
        'type'        => 'select',
        'section'     => 'front_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'hidden',
            'label'       => esc_html__('Hidden', 'cactus'),
            'src'         => ''
          ),array(
            'value'       => 'posts_grid_layout_1',
            'label'       => esc_html__('Posts Grid Layout 1', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_grid_layout_2',
            'label'       => esc_html__('Posts Grid Layout 2', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_grid_layout_3',
            'label'       => esc_html__('Posts Grid Layout 3', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_slider',
            'label'       => esc_html__('Posts Slider', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_classic_slider_layout_1',
            'label'       => esc_html__('Posts Classic Slider Layout 1', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_classic_slider_layout_2',
            'label'       => esc_html__('Posts Classic Slider Layout 2', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_carousel',
            'label'       => esc_html__('Posts Carousel', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_thumb_slider',
            'label'       => esc_html__('Posts ThumbSlider', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_parallax',
            'label'       => esc_html__('Posts Parallax', 'cactus'),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'featured_posts_count_hp',
        'label'       => esc_html__('Header - Featured Posts Count', 'cactus' ),
        'desc'        => esc_html__('Number of items to query on Featured Posts section', 'cactus' ),
        'std'         => '5',
        'type'        => 'text',
        'section'     => 'front_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'featured_posts_categories',
        'label'       => esc_html__('Header - Featured Posts Categories', 'cactus' ),
        'desc'        => esc_html__('List of Category IDs or slugs, separated by a comma', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'front_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'featured_posts_autoplay',
        'label'       => esc_html__('Header - Featured Posts Autoplay', 'cactus' ),
        'desc'        => esc_html__('Some layouts are slider and they have the ability to autoplay', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'front_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'hide_show_header_in_second_page',
        'label'       => esc_html__('Header - Hide in second and next pages', 'cactus' ),
        'desc'        => esc_html__('Hide or show header slider in second and next pages', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'front_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'enable_popular_blog_posts_page',
        'label'       => esc_html__( 'Enable Popular Posts page', 'cactus' ),
        'desc'        => esc_html__('Display a select box in Blog Page to switch between Latest Posts and Popular Posts page', 'cactus' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_list_page_template',
        'label'       => esc_html__( 'Popular Posts template', 'cactus' ),
        'desc'        => esc_html__('Choose the Popular Posts page. This page should use Popular Posts template', 'cactus' ),
        'std'         => '',
        'type'        => 'page_select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'enable_popular_blog_posts_page:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_layout',
        'label'       => esc_html__('Layout', 'cactus' ),
        'desc'        => esc_html__('Select blog layout', 'cactus' ),
        'std'         => 'layout_1',
        'type'        => 'radio-image',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
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
		  'id'          => 'enable_wide_layout_featured',
		  'label'       => esc_html__( 'Use Wide Layout for Featured Posts', 'cactus' ),
		  'desc'        => '',
		  'std'         => 'on',
		  'type'        => 'on-off',
		  'section'     => 'blog',
		  'rows'        => '',
		  'post_type'   => '',
		  'taxonomy'    => '',
		  'min_max_step'=> '',
		  'class'       => '',
		  'condition'   => 'blog_layout:is(layout_2),blog_layout:is(layout_7)',
		  'operator'    => 'or'
      ),
      array(
        'id'          => 'archives_get_related_post_by',
        'label'       => esc_html__('Related Posts - Select', 'cactus' ),
        'desc'        => esc_html__('Get Related Posts by Categories or Tags', 'cactus' ),
        'std'         => 'cat',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => 'blog_layout:is(layout_1),blog_layout:is(layout_2)',
        'choices'     => array(
          array(
            'value'       => 'cat',
            'label'       => 'Categories',
            'src'         => ''
          ),
          array(
            'value'       => 'tag',
            'label'       => 'Tags',
            'src'         => ''
          )
        ),
        'operator'    => 'or'
      ),
      array(
        'id'          => 'archives_related_posts_order_by',
        'label'       => esc_html__('Related Posts - Order By', 'cactus' ),
        'desc'        => esc_html__('Order related posts randomly or by date', 'cactus' ),
        'std'         => 'date',
        'type'        => 'select',
        'section'     => 'blog',
        'condition'   => 'blog_layout:is(layout_1),blog_layout:is(layout_2)',
        'choices'     => array(
          array(
            'value'       => 'date',
            'label'       => esc_html__('Date','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'rand',
            'label'       => esc_html__('Random','cactus'),
            'src'         => ''
          )
        ),
        'operator'    => 'or'
      ),
      array(
        'id'          => 'enable_yarpp_plugin_archives',
        'label'       => esc_html__( 'Related Posts - Integrate YARPP Plugin?', 'cactus' ),
        'desc'        => esc_html__('Enabling this will allow you to use YARPP (Yet Another Related Posts Plugin) with archives', 'cactus' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_sidebar',
        'label'       => esc_html__('Sidebar', 'cactus' ),
        'desc'        => esc_html__('', 'cactus' ),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'right',
            'label'       => esc_html__('Right', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Left', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'hidden',
            'label'       => esc_html__('Hidden', 'cactus' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'navigation',
        'label'       => esc_html__('Page Navigation', 'cactus' ),
        'desc'        => esc_html__('Choose type of navigation for blog and any listing page. For WP PageNavi, you will need to install WP PageNavi plugin', 'cactus' ),
        'std'         => 'def',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'def',
            'label'       => esc_html__('Default', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'ajax',
            'label'       => esc_html__('Ajax', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'wp_pagenavi',
            'label'       => esc_html__('WP PageNavi', 'cactus' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'category_sidebar',
        'label'       => esc_html__( 'Sidebar', 'cactus' ),
        'desc'        => '',
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'categories',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'enable_popular_category_posts_page',
        'label'       => esc_html__( 'Enable Category Popular Posts page', 'cactus' ),
        'desc'        => esc_html__('Display a select box in Category Page to switch between Latest Posts and Popular Posts page', 'cactus' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'categories',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
            'id'          => 'category_popular_conditions',
            'label'       => esc_html__('Popular Posts - Condition','cactus'),
            'desc'        => esc_html__('Select condition for Category - Popular Posts page','cactus'),
            'std'         => 'most_viewed',
            'type'        => 'select',
            'section'     => 'categories',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => '',
            'condition'   => 'enable_popular_category_posts_page:is(on)',
            'choices'     => array(
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
              )
            )
        ),
        array(
            'id'          => 'category_popular_time_range',
            'label'       => esc_html__('Popular Posts - Time range','cactus'),
            'desc'        => esc_html__('Select time range to query for Category - Popular Posts','cactus'),
            'std'         => 'post-date',
            'type'        => 'select',
            'section'     => 'categories',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => '',
            'condition'   => 'enable_popular_category_posts_page:is(on)',
            'choices'     => array(
              array(
                'value'       => 'all',
                'label'       => esc_html__( 'All Time', 'cactus' ),
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
                'label'       => esc_html__( 'An Year ago', 'cactus' ),
                'src'         => ''
              )
            )
        ),
       array(
        'id'          => 'default_category_layout',
        'label'       => esc_html__('Featured Posts Section', 'cactus' ),
        'desc'        => esc_html__('Select default featured posts Section for a category page. This layout can be set for each category', 'cactus' ),
        'std'         => 'layout_1',
        'type'        => 'radio-image',
        'section'     => 'categories',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'layout_1',
            'label'       => esc_html__('Layout 1', 'cactus'),
            'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-01.png'
          ),
          array(
            'value'       => 'layout_2',
            'label'       => esc_html__('Layout 2', 'cactus'),
            'src'         => get_template_directory_uri() . '/images/theme-options/Standard-post-02.png'
          )
        )
      ),
      array(
        'id'          => 'default_featured_post_layout',
        'label'       => esc_html__('Featured Posts - Layout', 'cactus' ),
        'desc'        => esc_html__('Select default layout for Featured Posts Section', 'cactus' ),
        'std'         => 'posts_grid_layout_1',
        'type'        => 'select',
        'section'     => 'categories',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'posts_grid_layout_1',
            'label'       => esc_html__('Posts Grid Layout 1', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_grid_layout_2',
            'label'       => esc_html__('Posts Grid Layout 2', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_grid_layout_3',
            'label'       => esc_html__('Posts Grid Layout 3', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_slider',
            'label'       => esc_html__('Posts Slider', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_classic_slider_layout_1',
            'label'       => esc_html__('Posts Classic Slider Layout 1', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_classic_slider_layout_2',
            'label'       => esc_html__('Posts Classic Slider Layout 2', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_carousel',
            'label'       => esc_html__('Posts Carousel', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_thumb_slider',
            'label'       => esc_html__('Posts ThumbSlider', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'posts_parallax',
            'label'       => esc_html__('Posts Parallax', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'smart_content_box_layout_1',
            'label'       => esc_html__('Smart Content Box Layout 1', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'smart_content_box_layout_2',
            'label'       => esc_html__('Smart Content Box Layout 2', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'smart_content_box_layout_3',
            'label'       => esc_html__('Smart Content Box Layout 3', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'smart_content_box_layout_4',
            'label'       => esc_html__('Smart Content Box Layout 4', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'smart_content_box_layout_5',
            'label'       => esc_html__('Smart Content Box Layout 5', 'cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'smart_content_box_layout_6',
            'label'       => esc_html__('Smart Content Box Layout 6', 'cactus'),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'featured_posts_count',
        'label'       => esc_html__('Featured Posts - Count', 'cactus' ),
        'desc'        => esc_html__('Enter number of Featured Posts', 'cactus' ),
        'std'         => '5',
        'type'        => 'text',
        'section'     => 'categories',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'cat_featured_posts_autoplay',
        'label'       => esc_html__('Featured Posts - Autoplay', 'cactus' ),
        'desc'        => esc_html__('Enable autoplay on Featured Posts', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'categories',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'post_sidebar',
        'label'       => esc_html__('Sidebar', 'cactus' ),
        'desc'        => '',
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'label'       => esc_html__('Default Standard Layout', 'cactus' ),
        'desc'        => esc_html__('Choose default layout for standard posts', 'cactus' ),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(
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
          ),
        ),
      ),

//404 - Page Not Found block
      array(
        'id'          => 'page_title',
        'label'       => esc_html__( 'Page Title', 'cactus' ),
        'desc'        => esc_html__('Title of Page Not Found - 404 page', 'cactus' ),
        'std'         => '404',
        'type'        => 'text',
        'section'     => 'page_not_found',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_description',
        'label'       => esc_html__( 'Page Description', 'cactus' ),
        'desc'        => esc_html__('Short description in Page Not Found - 404 page', 'cactus' ),
        'std'         => esc_html__('Page Not Found', 'cactus' ),
        'type'        => 'text',
        'section'     => 'page_not_found',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_content',
        'label'       => esc_html__( 'Page Content', 'cactus' ),
        'desc'        => esc_html__('Content of Page Not Found - 404 page', 'cactus' ),
        'std'         => esc_html__('404 - Page Not Found', 'cactus' ),
        'type'        => 'textarea',
        'section'     => 'page_not_found',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End 404 - Page Not Found block

    array(
        'id'          => 'post_video_layout',
        'label'       => esc_html__( 'Default Video Layout', 'cactus' ),
        'desc'        => esc_html__('Choose default layout for Video Posts','cactus'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(
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
          ),
        ),
      ),
    array(
        'id'          => 'show_popup_share',
        'label'       => esc_html__( 'Show share post popup when video ended', 'cactus' ),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    array(
        'id'          => 'post_audio_layout',
        'label'       => esc_html__( 'Default Audio Layout', 'cactus' ),
        'desc'        => esc_html__( 'Choose default layout for Audio Posts', 'cactus' ),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => '1',
            'label'       => esc_html__( 'Layout 1', 'cactus' ),
            'src'         => get_template_directory_uri() . '/images/theme-options/Audio-post-01.png'
          ),
          array(
            'value'       => '2',
            'label'       => esc_html__( 'Layout 2', 'cactus' ),
            'src'         => get_template_directory_uri() . '/images/theme-options/Audio-post-02.png'
          ),
        ),
      ),
    array(
        'id'          => 'post_gallery_layout',
        'label'       => esc_html__( 'Default Gallery Layout', 'cactus' ),
        'desc'        => esc_html__('Choose default layout for Gallery Posts','cactus'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => '1',
            'label'       => esc_html__( 'Layout 1', 'cactus' ),
            'src'         => get_template_directory_uri() . '/images/theme-options/Garelly-post-01.png'
          ),
          array(
            'value'       => '2',
            'label'       => esc_html__( 'Layout 2', 'cactus' ),
            'src'         => get_template_directory_uri() . '/images/theme-options/Garelly-post-02.png'
          ),
        ),
      ),
      array(
        'id'          => 'single_post_scroll_next',
        'label'       => esc_html__( 'Scroll To Next Posts', 'cactus' ),
        'desc'        => esc_html__('When users scroll to bottom of a single post, next posts will be loaded automatically', 'cactus' ),
        'type'        => 'on-off',
        'section'     => 'single_post',
        'std'     => 'off',
      ),
      array(
          'id'          => 'single_post_scroll_next_condition',
          'label'       => esc_html__( 'Scroll Next - Condition', 'cactus' ),
          'desc'        => esc_html__('Choose how to load next posts', 'cactus' ),
          'type'        => 'select',
          'section'     => 'single_post',
          'condition'   => 'single_post_scroll_next:is(on)',
          'std'   => 'blog',
          'choices'     => array(
            array(
            'value'       => 'blog',
            'label'       => esc_html__('Next posts in all blog','cactus')
            ),
            array(
            'value'       => 'category',
            'label'       => esc_html__('Next posts in same Categories','cactus')
            )
            ,
            array(
            'value'       => 'tag',
            'label'       => esc_html__('Next posts in same tags','cactus')
            ),
            array(
            'value'       => 'custom-cats',
            'label'       => esc_html__('Custom Categories','cactus')
            ),
            array(
            'value'       => 'custom-tags',
            'label'       => esc_html__('Custom Tags','cactus')
            )
          )
      ),
      array(
          'id'          => 'single_post_scroll_next_custom_values',
          'label'       => esc_html__('Scroll Next - Posts in Custom Taxonomies','cactus'),
          'desc'        => esc_html__('Enter list of taxonomies, separated by a comma','cactus'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'single_post',
          'condition'   => 'single_post_scroll_next:is(on),single_post_scroll_next_condition:contains(custom)'
        ),
      array(
          'id'          => 'single_post_scroll_next_order',
          'label'       => esc_html__( 'Scroll Next Order', 'cactus' ),
          'desc'        => esc_html__('Load newer posts or older posts', 'cactus' ),
          'type'        => 'select',
          'section'     => 'single_post',
          'condition'   => 'single_post_scroll_next:is(on)',
          'std'   => 'newer',
          'choices'     => array(
            array(
            'value'       => 'after',
            'label'       => esc_html__('Load newer posts','cactus')
            ),
            array(
            'value'       => 'before',
            'label'       => esc_html__('Load older posts','cactus')
            )
          )
      ),
      array(
        'id'          => 'single_post_scroll_next_change_url',
        'label'       => esc_html__( 'Scroll Next - Change URL when scrolling', 'cactus' ),
        'desc'        => esc_html__('When next posts are scrolled to, change browser URL (without reloading page)', 'cactus' ),
        'type'        => 'on-off',
        'section'     => 'single_post',
        'std'     => 'on',
        'condition'   => 'single_post_scroll_next:is(on)'
      ),
      array(
        'id'          => 'show_tags_single_post',
        'label'       => esc_html__( 'Show Tags', 'cactus' ),
        'desc'        => esc_html__('Show/hide Tags in Single Post', 'cactus' ),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'show_share_button_social',
        'label'       => esc_html__( 'Show Social Buttons', 'cactus' ),
        'desc'        => esc_html__('Show/hide Social Buttons in Single Post', 'cactus' ),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'show_about_the_author',
        'label'       => esc_html__( 'Show About the Author', 'cactus' ),
        'desc'        => esc_html__('Show/hide "About the Author" section in Single Post', 'cactus' ),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'show_more_posts',
        'label'       => esc_html__( 'Show "More Posts" section', 'cactus' ),
        'desc'        => esc_html__('Show/hide "More Posts" section in Single Post', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'number_of_more',
        'label'       => esc_html__('Number of More Posts','cactus'),
        'type'        => 'text',
        'section'     => 'single_post',
        'class'       => '',
        'condition'   => 'show_more_posts:is(on)'
      ),
      array(
        'id'          => 'sort_of_more',
        'label'       => esc_html__('More Posts in','cactus'),
        'desc'        => '',
        'std'         => '0',
        'type'        => 'select',
        'section'     => 'single_post',
        'choices'     => array(
          array(
            'value'       => '0',
            'label'       => esc_html__('In blog order','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => esc_html__('In same categories','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => esc_html__('Having same tags','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => '3',
            'label'       => esc_html__('Same playlist, then tags','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => '4',
            'label'       => esc_html__('Same playlist, then categories','cactus'),
            'src'         => ''
          ),
        ),
        'condition'   => 'show_more_posts:is(on)'
      ),
      array(
        'id'          => 'next_previous_same',
        'label'       => esc_html__('Next/Previous Post in', 'cactus' ),
        'desc'        => esc_html__('', 'cactus' ),
        'std'         => 'cat',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'cat',
            'label'       => esc_html__('In same category', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'all',
            'label'       => esc_html__('In blog order', 'cactus' ),
            'src'         => ''
          )
        ),
        'operator'    => 'and'
      ),
      array(
        'id'          => 'show_related_post',
        'label'       => esc_html__( 'Show Related Posts', 'cactus' ),
        'desc'        => esc_html__('Show/hide Related Posts section in single post page', 'cactus' ),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'get_related_post_by',
        'label'       => esc_html__('Related Posts - Select', 'cactus' ),
        'desc'        => esc_html__('Get Related Posts by Categories or Tags', 'cactus' ),
        'std'         => 'cat',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'cat',
            'label'       => 'Categories',
            'src'         => ''
          ),
          array(
            'value'       => 'tag',
            'label'       => 'Tags',
            'src'         => ''
          )
        ),
        'operator'    => 'and'
      ),

      array(
        'id'          => 'related_posts_count',
        'label'       => esc_html__('Related Posts - Count','cactus'),
        'desc'        => '',
        'std'         => '3',
        'type'        => 'text',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'related_posts_order_by',
        'label'       => esc_html__('Related Posts - Order By', 'cactus' ),
        'desc'        => esc_html__('Order related posts randomly or by date', 'cactus' ),
        'std'         => 'date',
        'type'        => 'select',
        'section'     => 'single_post',
        'choices'     => array(
          array(
            'value'       => 'date',
            'label'       => esc_html__('Date','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'rand',
            'label'       => esc_html__('Random','cactus'),
            'src'         => ''
          )
        ),
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_yarpp_plugin_single_post',
        'label'       => esc_html__( 'Related Posts - Integrate YARPP Plugin?', 'cactus' ),
        'desc'        => esc_html__('Enabling this will allow you to use YARPP (Yet Another Related Posts Plugin) in single post', 'cactus' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'show_comment',
        'label'       => esc_html__( 'Show Comment', 'cactus' ),
        'desc'        => esc_html__('Show/hide Comment section in single post', 'cactus' ),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'video_report',
        'label'       => esc_html__('Enable Post Report','cactus'),
        'desc'        => esc_html__('Choose to enable Post Report feature','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'class'       => '',
      ),
	  array(
        'id'          => 'video_report_form',
        'label'       => esc_html__('Post Report Form ID','cactus'),
        'desc'        => esc_html__('Enter Contact Form 7 ID for Report Form (Only ID. Ex: 123)','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'single_post',
        'class'       => '',
		'condition'   => 'video_report:is(on)',
      ),
	  array(
        'id'          => 'move_title_to_above',
        'label'       => esc_html__('Move title to above feature image/video', 'cactus' ),
        'desc'        => esc_html__('Only work with boxed layout posts, including Standard Post style 1,3 and Gallery Post and Video Post style 1,2 and Audio Post style 2', 'cactus' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_post',
        'choices'     => array(
          array(
            'value'       => '',
            'label'       => esc_html__('No','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'yes',
            'label'       => esc_html__('Yes','cactus'),
            'src'         => ''
          )
        ),
        'operator'    => 'and'
      ),
	  //user submit
	  array(
        'id'          => 'user_submit',
        'label'       => esc_html__('Enable','cactus'),
        'desc'        => esc_html__('Enable Front-end Post Submission feature','cactus'),
        'std'         => 0,
        'type'        => 'select',
        'section'     => 'user_submit',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => esc_html__('Disabled','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => esc_html__('Enabled','cactus'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'only_user_submit',
        'label'       => esc_html__('Login Required','cactus'),
        'desc'        => esc_html__('Select whether only logged-in users can submit or not','cactus'),
        'std'         => 0,
        'type'        => 'select',
        'section'     => 'user_submit',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => esc_html__('No','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => esc_html__('Yes','cactus'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'text_bt_submit',
        'label'       => esc_html__('Submit Button - Label','cactus'),
        'desc'        => esc_html__('Enter text you want to show','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'bg_bt_submit',
        'label'       => esc_html__('Submit Button - Background Color','cactus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'color_bt_submit',
        'label'       => esc_html__('Submit Button - Text Color','cactus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'bg_hover_bt_submit',
        'label'       => esc_html__('Submit Button - Background Hover Color','cactus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'color_hover_bt_submit',
        'label'       => esc_html__('Submit Button - Text Hover Color','cactus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'user_submit_status',
        'label'       => esc_html__('Default Status for submitted posts','cactus'),
        'desc'        => '',
        'std'         => 'pending',
        'type'        => 'select',
        'section'     => 'user_submit',
        'choices'     => array( 
          array(
            'value'       => 'pending',
            'label'       => esc_html__('Pending','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'publish',
            'label'       => esc_html__('Publish','cactus'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_submit_format',
        'label'       => esc_html__('Default Post Format for submitted posts','cactus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'user_submit',
        'choices'     => array( 
          array(
            'value'       => 'video',
            'label'       => esc_html__('Video','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => '',
            'label'       => esc_html__('Standard','cactus'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_submit_cat_exclude',
        'label'       => esc_html__('Exclude Category from Categories List','cactus'),
        'desc'        => esc_html__('Enter list of category IDs that you don\'t want to be displayed in category checkboxes list (ex: "1,68,86")','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'user_submit_cat_radio',
        'label'       => esc_html__('Categories display as radio buttons','cactus'),
        'desc'        => esc_html__('To limit user to choose one category only','cactus'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'user_submit_limit_tag',
        'label'       => esc_html__('Limit number of tags that users can enter','cactus'),
        'desc'        => esc_html__('Use 0 for unlimited','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'user_submit',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'user_submit_notify',
        'label'       => esc_html__('Notification','cactus'),
        'desc'        => esc_html__('Send notification email to user when post is published','cactus'),
        'std'         => 1,
        'type'        => 'select',
        'section'     => 'user_submit',
        'choices'     => array(
		  array(
            'value'       => 1,
            'label'       => esc_html__('Enable','cactus'),
            'src'         => ''
          ),
		  array(
            'value'       => 0,
            'label'       => esc_html__('Disable','cactus'),
            'src'         => ''
          )
        ),
      ),	 
      //Single page block

      array(
        'id'          => 'page_sidebar',
        'label'       => esc_html__('Sidebar', 'cactus' ),
        'desc'        => '',
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'disable_comments',
        'label'       => esc_html__( 'Disable Comments by default', 'cactus' ),
        'desc'        => esc_html__('Disable Comments on single pages', 'cactus' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

//End single page block

      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => esc_html__('Enter link to your Facebook page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => esc_html__('Enter link to Twitter page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'youtube',
        'label'       => 'YouTube',
        'desc'        => esc_html__('Enter link to your YouTube page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'linkedin',
        'label'       => 'LinkedIn',
        'desc'        => esc_html__('Enter link to your LinkedIn page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tumblr',
        'label'       => 'Tumblr',
        'desc'        => esc_html__('Enter link to your Tumblr page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google-plus',
        'label'       => 'Google Plus',
        'desc'        => esc_html__('Enter link to your Google Plus page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pinterest',
        'label'       => 'Pinterest',
        'desc'        => esc_html__('Enter link to your Pinterest page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'flickr',
        'label'       => 'Flickr',
        'desc'        => esc_html__('Enter link to your Flickr page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),

    array(
        'id'          => 'envelope',
        'label'       => 'Email',
        'desc'        => esc_html__('Enter your email contact', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'rss',
        'label'       => 'RSS',
        'desc'        => esc_html__('Enter your site\'s RSS URL', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    array(
        'id'          => 'custom_social_account',
        'label'       => esc_html__('Custom Social Account', 'cactus' ),
        'desc'        => esc_html__('Add more social accounts using Font Awesome Icons', 'cactus' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
            array(
              'id'          => 'icon_custom_social_account',
              'label'       => esc_html__( 'Font Awesome Icons', 'cactus' ),
              'desc'        => esc_html__( 'Enter Font Awesome class (ex: fa-instagram)', 'cactus' ),
              'std'         => '',
              'type'        => 'text',
              'post_type'   => '',
              'taxonomy'    => '',
              'min_max_step'=> '',
              'class'       => '',
              'condition'   => '',
              'operator'    => 'and',
            ),
          array(
            'id'          => 'url_custom_social_account',
            'label'       => esc_html__( 'URL', 'cactus' ),
            'desc'        => esc_html__( 'Enter full link to your social account (including http)', 'cactus' ),
            'std'         => '#',
            'type'        => 'text',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
	  array(
        'id'          => 'facebook_app_id',
        'label'       => esc_html__('Facebook App ID','cactus'),
        'desc'        => esc_html__('Enter your Facebook App ID (optional)','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'open_social_link_new_tab',
        'label'       => esc_html__( 'Open Social Link in new tab', 'cactus' ),
        'desc'        => esc_html__( 'Open link in new tab?', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'sharing_facebook',
        'label'       => esc_html__( 'Show FaceBook Share button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide FaceBook Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'sharing_twitter',
        'label'       => esc_html__( 'Show Twitter Share Button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide Twitter Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'sharing_linkedIn',
        'label'       => esc_html__( 'Show LinkedIn Share Button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide LinkedIn Share Button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'sharing_tumblr',
        'label'       => esc_html__( 'Show Tumblr Share Button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide Tumblr Share Button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'sharing_google',
        'label'       => esc_html__( 'Show Google+ Share Button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide Google+ Share Button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

       array(
        'id'          => 'sharing_pinterest',
        'label'       => esc_html__( 'Show Pinterest Pin Button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide Pinterest Pin Button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'sharing_vk',
        'label'       => esc_html__( 'Show VK Share Button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide VK Share Button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

        array(
        'id'          => 'sharing_email',
        'label'       => esc_html__( 'Show Email Button', 'cactus' ),
        'desc'        => esc_html__( 'Show/hide Email Button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'sharing_social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
  //ads
  array(
        'id'          => 'adsense_id',
        'label'       => esc_html__('Google AdSense Publisher ID', 'cactus' ),
        'desc'        => esc_html__('Enter your Google AdSense Publisher ID', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
        array(
        'id'          => 'adsense_slot_ads_top_nav',
        'label'       => esc_html__('Top Ads - AdSense Ads Slot ID', 'cactus' ),
        'desc'        => esc_html__('If you want to display Adsense in Top, enter Google AdSense Ad Slot ID here. If left empty, "Top Ads - Custom Code" will be used.', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
       array(
        'id'          => 'ads_top_nav',
        'label'       => esc_html__('Top Ads - Custom Code', 'cactus' ),
        'desc'        => esc_html__('Enter custom code for Top Ads', 'cactus' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising'
      ),
       array(
        'id'          => 'adsense_slot_ads_bottom',
        'label'       => esc_html__('Bottom Ads - AdSense Ads Slot ID', 'cactus' ),
        'desc'        => esc_html__('If you want to display Adsense in Bottom, enter Google AdSense Ad Slot ID here. If left empty, "Bottom Ads - Custom Code" will be used.', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
       array(
        'id'          => 'ads_bottom',
        'label'       => esc_html__('Bottom Ads - Custom Code', 'cactus' ),
        'desc'        => esc_html__('Enter custom code for Bottom Ads', 'cactus' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising'
      ),
        array(
        'id'          => 'adsense_slot_ads_single_bottom',
        'label'       => esc_html__('Single Post/Bottom Ads - AdSense Ads Slot ID', 'cactus' ),
        'desc'        => esc_html__('If you want to display Adsense at Bottom of Single Post, enter Google AdSense Ad Slot ID here. If left empty, "Single Post/Bottom Ads - Custom Code" will be used.', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
       array(
        'id'          => 'ads_single_bottom',
        'label'       => esc_html__('Single Post/Bottom Ads - Custom Code', 'cactus' ),
        'desc'        => esc_html__('Enter custom code for Single Post/Bottom Ads', 'cactus' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising'
      ),
        array(
        'id'          => 'adsense_slot_ads_wall_1',
        'label'       => 'Wall Ads Left - AdSense Ads Slot ID',
        'desc'        => esc_html__('If you want to display Adsense in Wall Ads Left, enter Google AdSense Ad Slot ID here. If left empty, "Wall Ads Left - Custom Code" will be used', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
       array(
        'id'          => 'ads_wall_1',
        'label'       => esc_html__('Wall Ads Left - Custom Code', 'cactus' ),
        'desc'        => esc_html__('Enter custom code for Wall Ads Left', 'cactus' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising'
      ),
    array(
        'id'          => 'ads_wall_1_width',
        'label'       => esc_html__('Wall Ads Left - Width', 'cactus' ),
        'desc'        => esc_html__('Specify width for Wall Ads Left, in pixels', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
    array(
        'id'          => 'ads_wall_1_top',
        'label'       => esc_html__('Wall Ads Left - Top Margin', 'cactus' ),
        'desc'        => esc_html__('Specify Top Margin for Wall Ads Left, in pixels', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
        array(
        'id'          => 'adsense_slot_ads_wall_2',
        'label'       => esc_html__('Wall Ads Right - AdSense Ads Slot ID', 'cactus' ),
        'desc'        => esc_html__('If you want to display Adsense in Wall Ads Right, enter Google AdSense Ad Slot ID here. If left empty, "Wall Ads Right - Custom Code" will be used.', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
       array(
        'id'          => 'ads_wall_2',
        'label'       => esc_html__('Wall Ads Right - Custom Code', 'cactus' ),
        'desc'        => esc_html__('Enter custom code for Wall Ads Right', 'cactus' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising'
      ),
    array(
        'id'          => 'ads_wall_2_width',
        'label'       => esc_html__('Wall Ads Right - Width', 'cactus' ),
        'desc'        => esc_html__('Specify width for Wall Ads Right, in pixels', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
    array(
        'id'          => 'ads_wall_2_top',
        'label'       => esc_html__('Wall Ads Right - Top Margin', 'cactus' ),
        'desc'        => esc_html__('Specify Top Margin for Wall Ads Right, in pixels', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising'
      ),
	  array(
        'id'          => 'woocommerce_layout',
        'label'       => esc_html__('Product Page Layout','cactus'),
        'desc'        => esc_html__('Select default layout of single product pages','cactus'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Right Sidebar','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Left Sidebar','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => esc_html__('No Sidebar','cactus'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'woocommerce_column',
        'label'       => esc_html__('Shop Page Columns','cactus'),
        'desc'        => esc_html__('Select number columns of Shop Page','cactus'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '',
            'label'       => esc_html__('2','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => '3',
            'label'       => esc_html__('3','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => '4',
            'label'       => esc_html__('4','cactus'),
            'src'         => ''
          ),
		  array(
            'value'       => '5',
            'label'       => esc_html__('5','cactus'),
            'src'         => ''
          )
        ),
      ),

  ),
  );

  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings );
  }

}
