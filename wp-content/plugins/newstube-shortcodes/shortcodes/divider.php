<?php
function cactus_create_divider($atts, $content){

	$rand_ID              	=  rand(1, 9999);
    $id                 	= 'divider-' . $rand_ID;
    $output_id              = ' id= "' . $id . '"';

	$layout = isset($atts['layout']) ? $atts['layout'] : 1;
	$link = isset($atts['link']) ? $atts['link'] : '';
	$target = isset($atts['target']) ? $atts['target'] : '';
	$open_l = '';
	if($target!=''){
		$open_l = 'target="'.$target.'"';
	}
	if(isset($atts['color']) && $atts['color'] != '')
		$color = $atts['color'];
	else
		if($layout == 1)
			$color = '#000';
		else if($layout == 2 || $layout == 3)
			$color = '#e7e7e7';

	if($layout == 1) $layout_class = ' style-4';
	else if($layout == 2) $layout_class = ' style-3';
	else $layout_class = '';
	if($link!=''){$content = '<a href="'.$link.'" class="di-link" '.$open_l.'>'.$content.'</a>';}
	$html = 	'<div class="cactus-divider' . $layout_class . '" ' . $output_id . '><h6>' . $content . '</h6></div>';

	$style = '';
	if(isset($color) && $color!=''){
		$style.=		'<style type="text/css" scoped>';
		if($layout == 1 || $layout == 2)
		{
			$style.=			'#'.$id.' {border-color:'.$color.';}';
			if($layout == 1)
				$style.=		'#'.$id.' h6 {background-color:'.$color.';}';
		}
		else if($layout == 3)
			$style.=			'#'.$id.' {background-color:'.$color.';}';

		$style.=		'</style>';
	};

	return $html . $style;
}
add_shortcode( 'divider', 'cactus_create_divider' );

add_action( 'after_setup_theme', 'reg_ct_divider' );
function reg_ct_divider(){
    if(function_exists('vc_map')){
    vc_map( 	array(
			   "name" => esc_html__("NewsTube Divider",'cactus'),
			   "base" => "divider",
			   "class" => "",
			   "icon" => "icon-divider",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactus'),
			   "params" => 	array(
			   	array(
					"type" => "textfield",
					"heading" => esc_html__("Text", "cactus"),
					"param_name" => "content",
					"admin_label" => true,
					"value" => "",
					"description" => "",
					),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link", "cactus"),
					"param_name" => "link",
					"admin_label" => true,
					"value" => "",
					"description" => "",
					),
				array(
					 "type" => "dropdown",
					 "heading" => esc_html__("Open Link in", "cactus"),
					 "param_name" => "target",
					 "value" => array(
						esc_html__('Curent Tab', 'cactus') => '',
						esc_html__('New Tab', 'cactus') => '_blank',
					 ),
					 "admin_label" => true,
					 "description" => "",
				  ),
				array(
					"type" => "dropdown",
					// "holder" => "div",
					"heading" => esc_html__("Layout", "cactus"),
					"param_name" => "layout",
					"admin_label" => true,
					"value" => array(
						esc_html__("Solid box","cactus")=>'1',
						esc_html__("Divider with text","cactus")=>'2',
						esc_html__("Simple line","cactus")=>'3',
					),
					"description" => "select layout"
					),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Color", "cactus"),
					"param_name" => "color",
					"value" => "",
					"description" => "color of divider",
					),
			   	)
			));
    }
}
