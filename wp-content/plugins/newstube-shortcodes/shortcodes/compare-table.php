<?php
/* SHORT CODE FOR COMPARE TABLE
 *
 *
 */
function parse_compare_table($atts, $content)
{
    $id                 	= (isset($atts['id']) && $atts['id'] != '') ? $atts['id'] : '';
    $output_id              = ' id= "' . $id . '"';

    $class                 	= (isset($atts['class']) && $atts['class'] != '') ? $atts['class'] : '';
    $color 					= (isset($atts['color']) && $atts['color'] != '') ? 'color:' . $atts['color'] . ';' : '';
 
	$html = '
	<div ' . $output_id . ' class="container">
		<div class="row ' . $class . '">
			'.do_shortcode(str_replace('<br class="nc" />', '', $content)).'
		</div>
	</div>
	';

	$style = '';
	if($color != '')
	{
		$style .= '<style type="text/css">';
		$style .= '#' . $id . '{' . $color . '}';
		$style .= '</style>';
	}

	return $html . $style;
}

function parse_compare_table_column($atts, $content)
{

 	$rand_ID              	=  rand(1, 9999);
    $id                 	= 'compare-table-colum-' . $rand_ID;
    $output_id              = ' id= "' . $id . '"';

    $class                 	= (isset($atts['class']) && $atts['class'] != '') ? $atts['class'] : '';
    $color 					= (isset($atts['color']) && $atts['color'] != '') ? 'color:' . $atts['color'] . ';' : '';
    $bg_color 				= (isset($atts['bg_color']) && $atts['bg_color'] != '') ? 'background:' . $atts['bg_color'] . ';' : '';
    $title 					= (isset($atts['title']) && $atts['title'] != '') ? $atts['title'] : 'Default Title';
	$price					= (isset($atts['price']) && $atts['price'] != '') ? $atts['price'] : '120';
	$price_text				= (isset($atts['price_text']) && $atts['price_text'] != '') ? $atts['price_text'] : 'per month';
	$currency				= (isset($atts['currency']) && $atts['currency'] != '') ? $atts['currency'] : '$';
	$price_color 			=  isset($atts['price_color']) ? $atts['price_color'] : '';
	
	if((isset($atts['column']) && ($atts['column'] != '')))
	{
		if($atts['column'] == 1)
			$md_column = 12;
		else if($atts['column'] == 2)
			$md_column = 6;
		else if($atts['column'] == 3)
			$md_column = 4;
		else if($atts['column'] == 4)
			$md_column = 3;
		else
			$md_column = 4;
	}
	else
	{
		$md_column = 12;
	}
	
	$price_html = '<div class="compare-table-price font-1"'. ($price_color != ''? ' style="color:'.$price_color.'"':''). '><span>' . $currency . '</span> ' . $price . '<span>' . $price_text . '</span></div>';

	$md_class = 'class="col-md-' . $md_column . ' ' . $class .' compare-table-wrapper"';

	$html = '
		<div ' . $md_class . '>
			<div class="compare-table" ' . $output_id . '>
				<div class="compare-table-border">
					<div class="compare-table-title font-1"><span class="font-1">' . $title . '</span><span></span></div>
					'.$price_html.'
					'.do_shortcode(str_replace('<br class="nc" />', '', $content)).'
				</div>
			</div>
		</div> ';

	$style = '';
	if($color != '' || $bg_color != '')
	{
		$style .= '<style type="text/css">';
		$style .= '#' . $id . '{' . $color . $bg_color . '}';
		$style .= '</style>';
	}

	$html=str_replace("<p></p>","",$html);
	return $html . $style;
}

function parse_compare_table_row($atts, $content)
{
	$rand_ID              	=  rand(1, 9999);
    $id                 	= 'compare-table-row-' . $rand_ID;
    $output_id              = ' id= "' . $id . '"';

	$class                 	= (isset($atts['class']) && $atts['class'] != '') ? $atts['class'] : '';
    $color 					= (isset($atts['color']) && $atts['color'] != '') ? 'color:' . $atts['color'] . ';' : '';
    $bg_color 				= (isset($atts['bg_color']) && $atts['bg_color'] != '') ? 'background:' . $atts['bg_color'] . ';' : '';
	
	$html ='';
	$html .= '<div class="table-options' . $class . '" ' . $output_id . '>' .do_shortcode( $content) . '</div>';

	$style = '';
	if($color != '' || $bg_color != '')
	{
		$style .= '<style type="text/css">';
		$style .= '#' . $id . '{' . $color . $bg_color . '}';
		$style .= '</style>';
	}

	$html=str_replace("<p></p>","",$html);
	return $html . $style;
}

add_shortcode( 'comparetable', 'parse_compare_table' );
add_shortcode( 'c_column', 'parse_compare_table_column' );
add_shortcode( 'c_row', 'parse_compare_table_row' );
add_shortcode( 'price', 'parse_compare_table_price' );

add_action( 'after_setup_theme', 'reg_ct_comparetable' );
function reg_ct_comparetable(){
	if(function_exists('vc_map')){
	vc_map( array(
			"name" => esc_html__("NewsTube Comparetable", "cactus"),
			"base" => "c_column",
			"content_element" => true,
			"as_parent" => array('only' => 'c_row'),
			"icon" => "icon-comparetable",
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Column Title", "cactus"),
					"param_name" => "title",
					"value" => "Compare Table Column",
					"description" => "",
					"admin_label" => true
				  ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("CSS Class", "cactus"),
					"param_name" => "class",
					"value" => "",
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
					"type" => "textfield",
					"heading" => esc_html__("Price", "cactus"),
					"param_name" => "price",
					"value" => "120",
					"description" => "",
					"admin_label" => true
				  ),
				   array(
					"type" => "textfield",
					"heading" => esc_html__("Price Text", "cactus"),
					"param_name" => "price_text",
					"value" => "per month",
					"description" => "",
				  ),
				  array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", "cactus"),
					"param_name" => "currency",
					"value" => "$",
					"description" => "",
				  ),
				   array(
					 "type" => "colorpicker",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Price Color", 'cactus'),
					 "param_name" => "price_color",
					 "value" => '',
					 "description" => '',
				  ),
				  
			),
			"js_view" => 'VcColumnView'
		) );
		vc_map( array(
			"name" => esc_html__("Row", "cactus"),
			"base" => "c_row",
			"content_element" => true,
			"as_child" => array('only' => 'c_row'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"as_parent" => array('except' => 'comparetable'),
			// "icon" => "icon-comparetable-row",
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Row Content", "cactus"),
					"param_name" => "content",
					"value" => "Content",
					"description" => "",
					"admin_label" => true
				  ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("CSS Class", "cactus"),
					"param_name" => "class",
					"value" => "",
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
			),
			 "js_view" => 'VcColumnView'
		) );
	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
		class WPBakeryShortCode_comparetable extends WPBakeryShortCodesContainer{}
		class WPBakeryShortCode_c_column extends WPBakeryShortCodesContainer{}
		class WPBakeryShortCode_c_row extends WPBakeryShortCodesContainer{}
	}
}
