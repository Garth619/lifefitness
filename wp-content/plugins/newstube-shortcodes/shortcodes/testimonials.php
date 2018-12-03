<?php
function cactus_testimonials($atts, $content='')
{

    $rand_ID                    =  rand(1, 999);
    $id                         = 'testimonials-' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $scroll                     = isset($atts['scroll']) ? $atts['scroll'] : 1;
	$speed                     = isset($atts['speed']) ? $atts['speed'] : '';
	if($scroll==''){$scroll = 1;}
    ob_start();

?>
    <div class="create-testimonials" data-autoplay="<?php echo esc_attr($scroll);?>" data-speed="<?php echo esc_attr($speed);?>">
        <a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
        <a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
        <div class="pagination"></div>
        <div class="cactus-swiper-container testimonials">
            <div class="swiper-wrapper">

                <?php echo do_shortcode(str_replace('<br class="nc" />', '', $content)); ?>

            </div>
        </div>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode( 'xtestimonial', 'cactus_testimonials' );

function cactus_testimonial_item($atts, $content='')
{
    $rand_ID                    =  rand(1, 999);
    $id                         = 'testimonial-item-' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $name                       = isset($atts['name']) ? $atts['name'] : '';
    $title                      = isset($atts['title']) ? $atts['title'] : '';
    $avatar                     = isset($atts['avatar']) ? $atts['avatar'] : '';
    $avatar_url                 = isset($atts['avatar_url']) ? $atts['avatar_url'] : '';
    ob_start();?>

        <div class="swiper-slide">

            <div class="cactus-testimonials-wrap">
                <div class="cactus-testimonials">
                    <?php echo do_shortcode(str_replace('<br class="nc" />', '', $content)); ?>
                </div>

                <div class="cactus-testimonials-info">
                    <?php if($avatar && $avatar != ''):?>
                        <div class="c-picture">
                            <div>
                                <?php if(is_numeric($avatar)):?>
                                    <?php $thumbnail = wp_get_attachment_image_src($avatar,'thumbnail', true); ?>
                                    <img src="<?php echo esc_url($thumbnail[0]); ?>" width="50" height="50" alt="<?php echo esc_attr($name); ?>">
                                <?php endif;?>
                            </div>
                        </div>
                    <?php elseif($avatar_url && $avatar_url != ''):?>
                        <div class="c-picture">
                            <div>
                                <img src="<?php echo esc_url($avatar_url);?>" width="50" height="50" alt="<?php echo esc_attr($name); ?>">
                            </div>
                        </div>
                    <?php endif;?>

                    <div class="info-content">
                        <h6 class="testi-name"><?php echo $name; ?></h6>
                        <span class="testi-info"><?php echo $title; ?></span>
                    </div>

                </div>

            </div>

        </div>

    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode( 'xtestimonial_item', 'cactus_testimonial_item' );


add_action( 'after_setup_theme', 'reg_xtestimonial' );
function reg_xtestimonial(){
    if(function_exists('vc_map')){
        //parent
        vc_map( array(
            "name" => esc_html__("NewsTube Testimonials", "cactus"),
            "base" => "xtestimonial",
            "as_parent" => array('only' => 'xtestimonial_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
            "content_element" => true,
            "show_settings_on_create" => false,
            "icon" => "icon-testimonial",
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Auto Scroll", "cactus"),
                    "param_name" => "scroll",
                    "value" => array(
                        esc_html__('Yes', 'cactus') => '1',
                        esc_html__('No', 'cactus') => '0',
                    ),
                    "description" => esc_html__('Auto scroll Testimonials','cactus')
                ),
				array(
                    "type" => "textfield",
                    "heading" => esc_html__("Speed", "cactus"),
                    "param_name" => "speed",
                    "value" => "",
                    "description" => esc_html__("(milliseconds) speed of auto play", "cactus"),
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
        
        //child
        vc_map( array(
            "name" => esc_html__("Testimonial Item", "cactus"),
            "base" => "xtestimonial_item",
            "content_element" => true,
            "as_child" => array('only' => 'xtestimonial_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
            // "icon" => "icon-testimonial-item",
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Name", "cactus"),
                    "param_name" => "name",
                    "value" => "",
                    "description" => ""
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", "cactus"),
                    "param_name" => "title",
                    "value" => "",
                    "description" => esc_html__("Title of person (Ex: Professor)", "cactus"),
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Avatar", "cactus"),
                    "param_name" => "avatar",
                    "value" => "",
                    "description" => esc_html__("Avatar of person", "cactus"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Avatar URL", "cactus"),
                    "param_name" => "avatar_url",
                    "value" => "",
                    "description" => esc_html__("Avatar URL of person", "cactus"),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Testimonial content", "cactus"),
                    "param_name" => "content",
                    "value" => "",
                    "description" => "",
                ),
            )
        ) );
        
    }
}
if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
class WPBakeryShortCode_xtestimonial extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_xtestimonial_item extends WPBakeryShortCode{}
}
