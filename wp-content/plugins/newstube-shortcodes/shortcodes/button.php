<?php
function cactus_create_button($atts, $content){
	$btnID 		=  rand(1, 9990);
	$id 		= isset($atts['id']) ? $atts['id'] : 'cactus-btn-'.$btnID;
	$target 	= isset($atts['target']) && $atts['target'] != ''  ? $atts['target'] : 0;
	$href 		= isset($atts['href']) && $atts['href'] != '' ? $atts['href'] : '#';
	$bg_color 	= isset($atts['bg_color']) && $atts['bg_color'] != '' ? $atts['bg_color'] : '#222';
	$bg_hover 	= isset($atts['bg_hover']) && $atts['bg_hover'] != '' ? $atts['bg_hover'] : '#555';
	$text_color = isset($atts['text_color']) && $atts['text_color'] != '' ? $atts['text_color'] : '';
	$text_hover = isset($atts['text_hover']) && $atts['text_hover'] != '' ? $atts['text_hover'] : '#fff';

	$url 		= $href != '#' ? 'href="' . esc_url($href) . '"' : '';
	$target_attr= $target == 0 ? '_parent' : '_blank';

	$html = '';
	$html .= '<a ' . $url . ' title="' . $content . '"'. ' id="'.$id.'" target="' . $target_attr . '" class="btn btn-default font-1"' .">" .$content.'</a>';

	if($bg_color != '#222' || $bg_hover != '#555'|| $text_color != '' || $text_hover != '#fff' || $href == '#')
	{
		$html.=		'<style type="text/css" scoped>';

		if($text_color != '')
			$html.=		'#'.$id.' {color:'.$text_color.';}';

			$html.=		'#'.$id.' {background-color:'.$bg_color.';}';

			$html.=			'#'.$id.':hover {background-color:'.$bg_hover.'; color:' . $text_hover . '}';

		if($href == '#')
			$html.=			'#'.$id.':hover {cursor: default;}';

		$html.=		'</style>';
	};

	return $html;
}
add_shortcode( 'button', 'cactus_create_button' );

add_action( 'after_setup_theme', 'reg_ct_button' );
function reg_ct_button(){
    if(function_exists('vc_map')){
    vc_map( 	array(
			   "name" => esc_html__("NewsTube Button",'cactus'),
			   "base" => "button",
			   "class" => "",
			   "icon" => "icon-button",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactus'),
			   "params" => 	array(
								array(
								"type" => "textfield",
								"heading" => esc_html__("Text", "cactus"),
								"param_name" => "content",
								"value" => "",
								"description" => "",
							  ),
							  array(
								"type" => "textfield",
								"heading" => esc_html__("Link", "cactus"),
								"param_name" => "href",
								"value" => "#",
								"description" => "",
							  ),
							  array(
								 "type" => "colorpicker",
								 "holder" => "div",
								 "class" => "",
								 "heading" => esc_html__("Background Color", 'cactus'),
								 "param_name" => "bg_color",
								 "value" => '',
								 "description" => '',
							  ),
							  array(
								 "type" => "colorpicker",
								 "holder" => "div",
								 "class" => "",
								 "heading" => esc_html__("Background Color Hover", 'cactus'),
								 "param_name" => "bg_hover",
								 "value" => '',
								 "description" => '',
							  ),
							  array(
								 "type" => "colorpicker",
								 "holder" => "div",
								 "class" => "",
								 "heading" => esc_html__("Text Color", 'cactus'),
								 "param_name" => "text_color",
								 "value" => '',
								 "description" => '',
							  ),
							  array(
								 "type" => "colorpicker",
								 "holder" => "div",
								 "class" => "",
								 "heading" => esc_html__("Text Color Hover", 'cactus'),
								 "param_name" => "text_hover",
								 "value" => '',
								 "description" => '',
							  ),
							  array(
			   						"type" => "dropdown",
			   						"holder" => "div",
			   						"heading" => esc_html__("Target", "cactus"),
			   						"param_name" => "target",
			   						"value" => array(
			   							esc_html__("Open link in current windows","cactus")=>'0',
			   							esc_html__("Open link in new windows","cactus")=>'1',
			   						),
			   						"description" => ""
			   					),
						  )
			));
    }
}
