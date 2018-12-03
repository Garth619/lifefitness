<?php

/**
 * Core features for all themes
 *
 * @package cactus
 * @version 1.0 - 2014/13/05
 */

/**
 * Mobile Detector 
 *
 */
if(!class_exists('Mobile_Detect')){
    require get_template_directory() . '/inc/core/classes/mobile-detect.php'; 
}

require_once locate_template('/inc/classes/class.content-html.php');

$mobile_detector = new Mobile_Detect;
global $_device_, $_device_name_, $_is_retina_;
$_device_ = $mobile_detector->isMobile() ? ($mobile_detector->isTablet() ? 'tablet' : 'mobile') : 'pc';
$_device_name_ = $mobile_detector->mobileGrade();
$_is_retina_ = $mobile_detector->isRetina();

/**
 * plugin-activation
 */
require_once locate_template('/inc/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php' );


add_action( 'tgmpa_register', 'tm_acplugins' );
function tm_acplugins($plugins) {

	global $_theme_required_plugins;

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'cactus',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required &amp; Recommended Plugins', 'cactus' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'cactus' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'cactus' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'cactus' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'cactus' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'cactus' ),
            'complete'                                  => wp_kses(__( 'All plugins installed and activated successfully. %s', 'cactus' ),array('a'=>array('href'=>array(),'title'=>array(),'rel'=>array()))) // %1$s = dashboard link
        )
    );

    tgmpa( $_theme_required_plugins, $config);
}

/**
 * Option Tree integration
 */
 
 /**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_true' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

require get_template_directory() . '/inc/core/utility-functions.php'; 

require_once locate_template('/inc/custom-menu-walker.php');

/* Enable oEmbed in Text/HTML Widgets */
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );
add_filter( 'widget_text', 'do_shortcode', 8);


/*------------ Add Custom Variation field to all widgets -----------------*/
global $wl_cl_options;
if((!$wl_cl_options = get_option('cactusthemes')) || !is_array($wl_cl_options) ) $wl_cl_options = array();

add_action( 'sidebar_admin_setup', 'ct_expand_control');
// adds in the admin control per widget, but also processes import/export
function ct_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_cl_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'ct_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='ct_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-cactusthemes']))
				$wl_cl_options[$widget_id]=trim($_POST[$widget_id.'-cactusthemes']);
	}
	
	update_option('cactusthemes', $wl_cl_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function ct_empty_control() {}

function ct_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_cl_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_cl_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_cl_options[$id ] ),ENT_QUOTES ) : '';
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-cactusthemes'>".esc_html__('Custom Variation', 'cactus').": <input class='widefat' type='text' name='".$id_disp."-cactusthemes' id='".$id_disp."-cactusthemes' value='".$value."' /></label></p>";
}


/*------------ Add Custom color field to all widgets -----------------*/
global $wl_color_options;
if((!$wl_color_options = get_option('ct_color')) || !is_array($wl_color_options) ) $wl_color_options = array();

add_action( 'sidebar_admin_setup', 'ct_color_expand_control');
// adds in the admin control per widget, but also processes import/export
function ct_color_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_color_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'ct_color_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_color_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='ct_color_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-ct_color']))
				$wl_color_options[$widget_id]=trim($_POST[$widget_id.'-ct_color']);
	}
	
	update_option('ct_color', $wl_color_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function ct_color_empty_control() {}

function ct_color_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_color_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_color_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_color_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_color_options[$id ] ),ENT_QUOTES ) : '';
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-ct_color'>".esc_html__('Color Of Title', 'cactus').": <input class='color' type='text' name='".$id_disp."-ct_color' id='".$id_disp."-ct_color' value='".$value."' />
	</label></p>";
}
/*------------ Add Custom color field to all widgets -----------------*/
/*------------ Add Custom background color field to all widgets -----------------*/
global $wl_bgcolor_options;
if((!$wl_bgcolor_options = get_option('ct_bgcolor')) || !is_array($wl_bgcolor_options) ) $wl_bgcolor_options = array();

add_action( 'sidebar_admin_setup', 'ct_bgcolor_expand_control');
// adds in the admin control per widget, but also processes import/export
function ct_bgcolor_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_bgcolor_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'ct_bgcolor_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_bgcolor_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='ct_bgcolor_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-ct_bgcolor']))
				$wl_bgcolor_options[$widget_id]=trim($_POST[$widget_id.'-ct_bgcolor']);
	}
	
	update_option('ct_bgcolor', $wl_bgcolor_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function ct_bgcolor_empty_control() {}

function ct_bgcolor_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_bgcolor_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_bgcolor_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_bgcolor_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_bgcolor_options[$id ] ),ENT_QUOTES ) : '';
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-ct_bgcolor'>".esc_html__('Background Color Of Title', 'cactus').": <input class='color' type='text' name='".$id_disp."-ct_bgcolor' id='".$id_disp."-ct_bgcolor' value='".$value."' />
	</label></p>";
}
/*------------ Add Custom bgcolor field to all widgets -----------------*/
/**
 * Hook before widget 
 */
if(!is_admin()){
	add_filter('dynamic_sidebar_params', 'cactusthemes_hook_before_widget'); 	
	function cactusthemes_hook_before_widget($params){
		/* Add custom variation classs to widgets */
		global $wl_cl_options;
		global $wl_bgcolor_options;
		global $wl_color_options;
		$id=$params[0]['widget_id'];
		$classe_to_add = !empty( $wl_cl_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_cl_options[$id ] ),ENT_QUOTES ) : '';
		
		if ($params[0]['before_widget'] != ""){  
			$classe_to_add = 'class="'.($classe_to_add?$classe_to_add.' ':'');
			$params[0]['before_widget'] = implode($classe_to_add, explode('class="', $params[0]['before_widget'], 2));
		}else{
			$classe_to_add = $classe_to_add;
			$params[0]['before_widget'] = '<div class="'.$classe_to_add.'">';
			$params[0]['after_widget'] = '</div>';
		}
		if(!empty( $wl_color_options[$id ] ) || !empty( $wl_bgcolor_options[$id ] )){
            $color = $wl_color_options[$id];
            $bgcolor = $wl_bgcolor_options[$id ];
            
            if(! strpos($color, '#') === false) { $color = '#' . $color;}
            if(! strpos($bgcolor, '#') === false) { $bgcolor = '#' . $bgcolor;}
            
			$params[0]['before_widget'].='
				<style type="text/css">
					#'.$id.' .easy-tab .tabs li.active a,
					#'.$id.' .widget-title{color:'.$wl_color_options[$id ].' !important; background:'.$wl_bgcolor_options[$id ].' !important}
					#'.$id.' .easy-tab .tabs li:not(.active) a:hover{color:'.$wl_bgcolor_options[$id ].' !important}
					#'.$id.' .easy-tab .tabs li:first-child a:before, .cactus-sidebar '.$id.'.widget .widget-title:before,
					#'.$id.' .widget-title:before{background:'.$wl_bgcolor_options[$id ].' !important}
				</style>';
		}
		return $params;
	}
}

/* Remove query strings from static resources */
function _remove_query_strings_1( $src ){	
	$rqs = explode( '?ver', $src );
        return $rqs[0];
}
		if ( is_admin() ) {
// Remove query strings from static resources disabled in admin
}

		else {
add_filter( 'script_loader_src', '_remove_query_strings_1', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_1', 15, 1 );
}

function _remove_query_strings_2( $src ){
	$rqs = explode( '&ver', $src );
        return $rqs[0];
}
		if ( is_admin() ) {
// Remove query strings from static resources disabled in admin
}

		else {
add_filter( 'script_loader_src', '_remove_query_strings_2', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_2', 15, 1 );
}
if(!function_exists('alter_comment_form_fields')){
	function alter_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$fields['author']='<input id="author" name="author" type="text" placeholder="'.($req ? '' : '').esc_html__('Your Name *','cactus').'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '>';
		$fields['email']='<input id="email" placeholder="'.($req ? '' : '').esc_html__('Your Email *','cactus').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '>';
		$fields['url']='<input id="url" placeholder="'.esc_html__('Your Website','cactus').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />';
		
		return $fields;
	}
	
	add_filter('comment_form_default_fields','alter_comment_form_fields');
}


/* Clone from ot-functions.php*/
function ot_get_option_core( $option_id, $default = '' ) {

  /* get the saved options */
  $options = get_option( ot_options_id() );

  /* look for the saved value */
  if ( isset( $options[$option_id] ) && '' != $options[$option_id] ) {

    return ot_wpml_filter( $options, $option_id );

  }

  return $default;

}

if ( ! function_exists( 'ot_options_id' ) ) {

  function ot_options_id() {

    return apply_filters( 'ot_options_id', 'option_tree' );

  }

}

if ( ! function_exists( 'ot_settings_id' ) ) {

  function ot_settings_id() {

    return apply_filters( 'ot_settings_id', 'option_tree_settings' );

  }

}

if ( ! function_exists( 'ot_wpml_filter' ) ) {

  function ot_wpml_filter( $options, $option_id ) {

    // Return translated strings using WMPL
    if ( function_exists('icl_t') ) {

      $settings = get_option( ot_settings_id() );

      if ( isset( $settings['settings'] ) ) {

        foreach( $settings['settings'] as $setting ) {

          // List Item & Slider
          if ( $option_id == $setting['id'] && in_array( $setting['type'], array( 'list-item', 'slider' ) ) ) {

            foreach( $options[$option_id] as $key => $value ) {

              foreach( $value as $ckey => $cvalue ) {

                $id = $option_id . '_' . $ckey . '_' . $key;
                $_string = icl_t( 'Theme Options', $id, $cvalue );

                if ( ! empty( $_string ) ) {

                  $options[$option_id][$key][$ckey] = $_string;

                }

              }

            }

          // List Item & Slider
          } else if ( $option_id == $setting['id'] && $setting['type'] == 'social-links' ) {

            foreach( $options[$option_id] as $key => $value ) {

              foreach( $value as $ckey => $cvalue ) {

                $id = $option_id . '_' . $ckey . '_' . $key;
                $_string = icl_t( 'Theme Options', $id, $cvalue );

                if ( ! empty( $_string ) ) {

                  $options[$option_id][$key][$ckey] = $_string;

                }

              }

            }

          // All other acceptable option types
          } else if ( $option_id == $setting['id'] && in_array( $setting['type'], apply_filters( 'ot_wpml_option_types', array( 'text', 'textarea', 'textarea-simple' ) ) ) ) {

            $_string = icl_t( 'Theme Options', $option_id, $options[$option_id] );

            if ( ! empty( $_string ) ) {

              $options[$option_id] = $_string;

            }

          }

        }

      }

    }

    return $options[$option_id];

  }

}
/* End Clone from ot-functions.php*/

/* Echo meta data tags */
function ct_meta_tags(){
	$description = get_bloginfo('description');
	if(is_single()){
		global $post;

		$description = $post->post_excerpt;
		if($description == '')
			$description = strip_tags(substr($post->post_content, 0,165));
		$post_format	= get_post_format($post->ID) != '' && get_post_format($post->ID) == 'video'  ? 'video.movie' : 'article' ;
?>
	<meta property="og:image" content="<?php echo esc_attr(wp_get_attachment_url(get_post_thumbnail_id($post->ID))); ?>"/>
	<meta property="og:title" content="<?php echo esc_attr(get_the_title($post->ID));?>"/>
	<meta property="og:url" content="<?php echo esc_url(get_permalink($post->ID));?>"/>
	<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name'));?>"/>
	<meta property="og:type" content="<?php echo $post_format;?>"/>
	<meta property="og:description" content="<?php echo esc_attr(strip_shortcodes($description));?>"/>
    <meta property="fb:app_id" content="<?php echo ot_get_option('facebook_app_id');?>" />
    <!--Meta for twitter-->
    <meta name="twitter:card" value="summary" />
    <meta name="twitter:site" content="@<?php echo esc_attr(get_bloginfo('name'));?>" />
    <meta name="twitter:title" content="<?php echo esc_attr(get_the_title($post->ID));?>" />
    <meta name="twitter:description" content="<?php echo esc_attr(strip_shortcodes($description));?>" />
    <meta name="twitter:image" content="<?php echo esc_attr(wp_get_attachment_url(get_post_thumbnail_id($post->ID))); ?>" />
    <meta name="twitter:url" content="<?php echo esc_url(get_permalink($post->ID));?>" />    
<?php
	}
	?>
	<meta property="description" content="<?php echo esc_attr(strip_shortcodes($description));?>"/>
	<?php
}
