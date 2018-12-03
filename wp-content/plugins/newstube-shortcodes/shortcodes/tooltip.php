<?php 
function cactus_create_tooltip($atts, $content = null) {
	$tooltipID =  rand(1, 999);	
	$id = isset($atts['id']) ? $atts['id'] : 'cr-tooltip-'.$tooltipID;
	$title = isset($atts['title']) ? $atts['title'] : 'This tooltip is on top!';
	$target 	= isset($atts['target']) && $atts['target'] != ''  ? $atts['target'] : '_parent';
	$href 		= isset($atts['href']) && $atts['href'] != '' ? $atts['href'] : '#';
	$html = '';
	$html .='
	<a href="'.esc_url($href).'" data-toggle="tooltip" target="' . $target . '" data-placement="top" title="'.$title.'"'.($id?' id="'.$id.'"':'').' class="cactus_tooltip">'.$content.'</a>
	';
	return $html;
}
add_shortcode('tooltip', 'cactus_create_tooltip');
