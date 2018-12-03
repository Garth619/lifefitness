<?php
function cactus_create_iconbox($atts, $content){
	$main_color 		= ot_get_option('main_color', '#25c3d8');
	$icon 				= isset($atts['icon']) ? $atts['icon'] : '';
	$title 				= isset($atts['title']) ? esc_html($atts['title']) : '';
    $url 				= isset($atts['url']) ? $atts['url'] : '';
	$layout 			= isset($atts['layout']) ? $atts['layout'] : 'center';
    
	if($layout == 'center') $layout_class = ' icon-top';
	else if($layout == 'right')  $layout_class = ' icon-right';
	else $layout_class = '';
    
    if($url != '') $layout_class .= ' linked';

	$html = 	'';
	$html .='<a href="' . ($url != '' ? esc_url($url) : 'javascript:;') . '" class="cactus-icon-box' . esc_attr($layout_class) . '">
				
			        <div class="icon-box-table">
			            <div class="icon-box">
			                <div class="cactus-content"><i class="fa '. esc_attr($icon) .'"></i></div>
			            </div>
			            <div class="icon-box-content">
			                <div class="cactus-content">
			                    <div class="cactus-title">' . $title . '</div>
			                    <div class="cactus-descriptions">' . $content .'</div>
			                </div>
			            </div>
			        </div>

			</a>';

	return $html;
}
add_shortcode( 'xicon-box', 'cactus_create_iconbox' );

add_action( 'after_setup_theme', 'reg_ct_iconbox' );
function reg_ct_iconbox(){
    if(function_exists('vc_map')){
    vc_map( 	array(
			   "name" => esc_html__("Newtube Iconbox",'cactus'),
			   "base" => "xicon-box",
			   "class" => "",
			   "icon" => "icon-iconbox",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactus'),
			   "params" => 	array(
			   					array(
			   						"type" => "dropdown",
			   						"holder" => "div",
			   						"heading" => esc_html__("Layout", "cactus"),
			   						"param_name" => "layout",
			   						"value" => array(
			   							esc_html__("Center","cactus")=>'center',
			   							esc_html__("Left","cactus")=>'left',
			   							esc_html__("Right","cactus")=>'right',
			   						),
			   						"description" => esc_html__("choose box layout. Possible values:", "cactus")
			   					),
							  	array(
									"type" => "textfield",
									"heading" => esc_html__("Icon", "cactus"),
									"param_name" => false,
									"param_name" => "icon",
									"value" => "",
									"description" => esc_html__('Exp: fa-anchor. Find more icons in <a href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a>', 'cactus' ),
								),
								array(
									"type" => "textfield",
									"heading" => esc_html__("Title", "cactus"),
									"param_name" => false,
									"param_name" => "title",
									"value" => "",
									"description" => "",
								),
								array(
									"type" => "textfield",
									"heading" => esc_html__("Content", "cactus"),
									"param_name" => false,
									"param_name" => "content",
									"value" => "",
									"description" => "",
								),
                                array(
									"type" => "textfield",
									"heading" => esc_html__("URL", "cactus"),
									"param_name" => false,
									"param_name" => "url",
									"value" => "",
									"description" => esc_html__("URL to navigate", 'cactus'),
								),
							)
			));
    }
}

function cactus_create_iconbox_wrap($atts, $content){
	$html ='<div class="icon-box-group cactus-icon-box-group">' . do_shortcode($content) .'</div>';
	return $html;
}
add_shortcode( 'xicon-box-group', 'cactus_create_iconbox_wrap' );
