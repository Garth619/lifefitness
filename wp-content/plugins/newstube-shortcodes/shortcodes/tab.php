<?php
function cactus_tab($atts, $content='')
{

    $rand_ID                    =  rand(1, 999);
    $class                      = 'cactus-tabs-' . $rand_ID;
    $total_tabs                 = substr_count($content, '[/xtab_item]');
    $box_title                  = isset($atts['box_title']) && $atts['box_title'] != '' ? $atts['box_title'] : esc_html__('Smart Box', 'cactus');
    $bg_color                   = isset($atts['bg_color']) ? $atts['bg_color'] : '';
    $text_color                 = isset($atts['text_color']) ? $atts['text_color'] : '';
    global $count_tab; $count_tab= 0;
    global $total_of_tabs; $total_of_tabs = $total_tabs;
    global $tab_content; $tab_content = array();
    global $first_id; $first_id = 0;
    global $last_id; $last_id = 0;
    global $heading; $heading = ' <div class="cactus-tab-title"><span>' . $box_title . '</span></div>';
    ob_start();

?>
    <div class="cactus-tab <?php echo $class;?>">
        <?php echo do_shortcode(str_replace('<br class="nc" />', '', $content)); ?>
    </div>

    <?php
        if($bg_color != '' || $text_color != '')
        {
            echo '<style type="text/css" scoped>';
            if($bg_color != '')
            {
                echo '.' . $class . ' .cactus-tab-heading {border-color:'.$bg_color.';}';
                echo '.' . $class . ' .cactus-tab-heading .cactus-tab-title span {background-color:'.$bg_color.';}';
            }
            if($text_color != '')
            {
                echo '.' . $class . ' .cactus-tab-heading .cactus-tab-title span {color:'.$text_color.';}';
            }
            echo '</style>';
        }
    ?>

    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode( 'xtab', 'cactus_tab' );

function cactus_tab_item($atts, $content='')
{
    global $count_tabs;
    $count_tabs++;
    global $total_of_tabs;
    global $tab_content;
    global $first_id;
    global $last_id;
    global $heading;

    $rand_ID                    =  rand(1, 9999);
    $id                         = 'tab-item-' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $title                      = isset($atts['title']) ? $atts['title'] : '';

    ob_start();?>
        <?php if($count_tabs == 1): ?>
            <div class="cactus-tab-heading">
                    <?php echo $heading;?>
                    <div class="cactus-tab-button">
                        <div class="sub-items show-on-mobile">
                            <span class="active not-button"><i class="fa fa-bars"></i><?php echo $title;?></span>
                        </div>
                        <div class="sub-items">
            <?php $first_id = $rand_ID;?>
        <?php endif;?>
                <?php $active_class = $count_tabs == 1 ? 'class="active"' : '';?>

                <span data-active="id-<?php echo esc_attr($rand_ID);?>" <?php echo ($active_class);?>><i class="fa fa-bars"></i><?php echo esc_html($title);?></span>
                <?php $tab_content[$rand_ID] = $content;?>

        <?php if($total_of_tabs == $count_tabs):?>
                    </div>
                </div>
            </div>
            <?php $last_id = $rand_ID?>
            <?php echo build_tab_content($tab_content, $first_id, $last_id); $count_tabs = 0;?>
        <?php endif;?>

    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

add_shortcode( 'xtab_item', 'cactus_tab_item' );

function build_tab_content($tab_content, $first_id, $last_id)
{
    $count_tab_content = count($tab_content);
ob_start();?>
    <?php foreach($tab_content as $index => $content):?>

        <?php $active_class = $index == $first_id ? 'class="active check-smart-init"' : '';?>
        <?php if($index == $first_id): ?>
            <div class="cactus-tab-content">
        <?php endif;?>

            <div data-active="id-<?php echo esc_attr($index);?>" <?php echo ($active_class);?>>
                <?php
                    $content = str_replace('[scb', '[scb sub_class_tab="no-tab-ajax-load"', $content);
                    echo do_shortcode($content);
                ?>
            </div>

        <?php if($index == $last_id): ?>
            </div>
        <?php endif;?>

    <?php endforeach;?>

<?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}


add_action( 'after_setup_theme', 'reg_xtab' );

function reg_xtab(){
    if(function_exists('vc_map')){
        //parent
        vc_map( array(
            "name" => esc_html__("NewsTube Tabs", "cactus"),
            "base" => "xtab",
            "as_parent" => array('only' => 'xtab_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "icon-tab",
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Box Title", "cactus"),
                    "param_name" => "box_title",
                    "value" => "",
                    "description" => esc_html__("Title of this box", "cactus"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Heading Color", "cactus"),
                    "param_name" => "text_color",
                    "value" => "",
                    "description" => esc_html__("Text color of tabs", "cactus"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Heading Background", "cactus"),
                    "param_name" => "bg_color",
                    "value" => "",
                    "description" => esc_html__("Background color of tabs", "cactus")
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );

        //child
        vc_map( array(
            "name" => esc_html__("Tab Item", "cactus"),
            "base" => "xtab_item",
            "content_element" => true,
            "as_child" => array('only' => 'xtab_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
            // "icon" => "icon-tab-item",
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", "cactus"),
                    "param_name" => "title",
                    "value" => "",
                    "description" => esc_html__("Title of tab", "cactus"),
                ),
                array(
                    "type" => "textarea_html",
                    "heading" => esc_html__("Tab content", "cactus"),
                    "param_name" => "content",
                    "value" => "",
                    "description" => "",
                ),
            )
        ) );

    }
    if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_xtab extends WPBakeryShortCodesContainer{}
    class WPBakeryShortCode_xtab_item extends WPBakeryShortCode{}
    }
}
