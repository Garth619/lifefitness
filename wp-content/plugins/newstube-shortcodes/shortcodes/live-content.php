<?php
function cactus_live_content_divider($atts, $content){

    $time   = (isset($atts['time']) && $atts['time'] != '') ? $atts['time'] : '00:00';
    $title  = (isset($atts['title']) && $atts['title'] != '') ? $atts['title'] : 'Default Title';

    $html   = '';
	$html 	.= '<div class="time-live-post"><h6 class="time-live-post">' . $time . ' - ' . $title . '</h6></div>';
	$html 	.= '<p>' . $content . '</p>';

	return $html;
}
add_shortcode( 'live', 'cactus_live_content_divider' );

add_action( 'after_setup_theme', 'reg_ct_live_content' );
function reg_ct_live_content(){
    if(function_exists('vc_map')){
    vc_map( 	array(
			   "name" => esc_html__("NewsTube Live Content",'cactus'),
			   "base" => "live",
			   "class" => "",
			   "icon" => "icon-live-content",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactus'),
			   "params" => 	array(
			   	array(
					"type" => "textfield",
					"heading" => esc_html__("Time", "cactus"),
					"param_name" => "time",
					"value" => "",
					"description" => "",
					),
			   	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", "cactus"),
					"param_name" => "title",
					"value" => "",
					"description" => "",
					),
			   	array(
					"type" => "textarea",
					"heading" => esc_html__("Content", "cactus"),
					"param_name" => "content",
					"value" => "",
					"description" => "",
					),
			   	)
			));
    }
}
