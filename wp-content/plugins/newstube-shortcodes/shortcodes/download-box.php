<?php
function cactus_create_download_box($atts, $content){

	$icon 				= isset($atts['icon']) ? $atts['icon'] : '';
	$title 				= isset($atts['text']) ? $atts['text'] : '';
	$url 				= isset($atts['url']) ? $atts['url'] : '#';
	$target 			= isset($atts['target']) ? $atts['target'] : 1;
	$target_attr		= $target == 1 ? '_blank' : '_parent';

	$html = '';

	$html .= '<div class="cactus-download-box">
            	<a href="' . esc_url($url) . '" title="' . esc_attr($title) . '" target="' . esc_attr($target_attr) . '">
                    <div class="table-download-box">
                        <div class="icon-cell-box">
                        	<div class="icon-content"><i class="fa ' . $icon . '"></i></div>
                        </div>
                        <div class="text-cell-box">
                        	<div class="text-content"><span>' . $title . '</span></div>
                        </div>

                    </div>
                </a>
            </div> ';

	return $html;
}
add_shortcode( 'xdownload', 'cactus_create_download_box' );

add_action( 'after_setup_theme', 'reg_ct_download_box' );
function reg_ct_download_box(){
    if(function_exists('vc_map')){
    vc_map( 	array(
			   "name" => esc_html__("Newtube Download Box",'cactus'),
			   "base" => "xdownload",
			   "class" => "",
			   "icon" => "icon-download-box",
			   "controls" => "full",
			   "category" => esc_html__('Content', 'cactus'),
			   "params" => 	array(
							  	array(
									"type" => "textfield",
									"heading" => esc_html__("Icon", "cactus"),
									"param_name" => "icon",
									"value" => "",
									"description" => esc_html__('Exp: fa-anchor. Find more icons in <a href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a>', 'cactus' ),
								),
								array(
									"type" => "textfield",
									"heading" => esc_html__("Text", "cactus"),
									"param_name" => "text",
									"value" => "",
									"description" => "",
								),
								array(
									"type" => "textfield",
									"heading" => esc_html__("URL", "cactus"),
									"param_name" => "url",
									"value" => "",
									"description" => "",
								),
								array(
			   						"type" => "dropdown",
			   						"holder" => "div",
			   						"heading" => esc_html__("Target", "cactus"),
			   						"param_name" => "target",
			   						"value" => array(
			   							esc_html__("Open link in new windows","cactus")=>'1',
			   							esc_html__("Open link in current windows","cactus")=>'0',
			   						),
			   						"description" => ""
			   					),
							)
			));
    }
}
