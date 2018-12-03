<?php
function cactus_posts_classic_slider($params)
{
    //extract  this array to use variable below
    extract(shortcode_atts(array(
        'layout'                => '',
        'count'                 => '',
        'condition'             => '',
        'order'                 => '',
        'cats'                  => '',
        'tags'                  => '',
        'featured'              => '',
        'ids'                   => '',
        'autoplay'              => '',
    ), $params));

    $rand_ID                    =  rand(1, 999);
    $id                         = 'posts-classic-slider' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $cats                       = isset($params['cats']) && $params['cats'] != '' ? $params['cats'] : '';
    $tags                       = isset($params['tags']) && $params['tags'] != '' ? $params['tags'] : '';
    $condition                  = isset($params['condition']) && $params['condition'] != '' ? $params['condition'] : '';
    $layout                     = isset($params['layout']) && $params['layout'] != '' ? $params['layout'] : 'horizontal ';
    $count                      = isset($params['count']) && $params['count'] != '' ? $params['count'] : '10';
    $featured                   = isset($params['featured']) && $params['featured'] != '' ? $params['featured'] : '';
    $order                      = isset($params['order']) && $params['order'] != '' ? $params['order'] : 'desc';
    $ids                        = isset($params['ids']) && $params['ids'] != '' ? $params['ids'] : '';
    $autoplay                   = isset($params['autoplay']) && $params['autoplay'] != '' ? $params['autoplay'] : '0';

    ob_start();

    $page       ='';
    $count      = $data_layout = $layout == 'vertical' ? '6' : $count;
    $the_query  = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page);

?>
    <?php if($the_query->have_posts()):?>
        <?php $data_layout = $layout == 'vertical' ? 'data-layout="vertical"' : '';?>
        <div class="cactus-slider-sync" <?php echo $data_layout ;?> data-autoplay="<?php echo esc_attr($autoplay);?>">
            <div class="horizontal-align">
                <div class="cactus-silder-sync-content">
                    <div class="swiper-wrapper">
                        <?php while($the_query->have_posts()):?>
                        <?php
                            $the_query->the_post();
                            $category       = get_the_category();
                        ?>
                            <div class="swiper-slide">
                                <div class="sync-img-content">
                                    <a href="<?php esc_url(the_permalink());?>" title="<?php esc_attr(the_title_attribute()); ?>">
                                        <?php echo cactus_thumbnail('thumb_799x519');?>
                                        <div class="thumb-gradient"></div>
                                        <div class="thumb-overlay"></div>
                                    </a>
                                    <div class="primary-content">
                                        <?php if(!empty($category)) echo cactus_get_category($category);?>
                                        <?php echo tm_post_rating(get_the_ID());?>
                                        <h4> <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a>  </h4>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;?>
                    </div>
                    <a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    <a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <div class="vertical-align">
                <div class="cactus-silder-sync-listing">
                    <div class="swiper-wrapper">
                        <?php $index = 0;?>
                        <?php while($the_query->have_posts()): $the_query->the_post();?>
                            <?php $active = $index == 0 ? 'active' : ''; $index++;?>
                            <div class="swiper-slide <?php echo esc_attr($active);?>">
                                <?php if($layout == 'vertical'):?>
                                    <div class="sync-img-content">
                                        <div>
                                            <a href="<?php esc_url(the_permalink());?>" title="<?php esc_attr(the_title_attribute()); ?>"><span><?php the_title(); ?></span></a>
                                        </div>
                                    </div>
                                <?php else:?>
                                    <div class="sync-img-content">
                                        <div>
                                            <?php echo cactus_thumbnail('thumb_220x220');?>
                                            <div class="thumb-overlay"></div>
                                            <div class="hr-active"></div>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        <?php endwhile;?>
                    </div>
                </div>
             </div>
        </div>
    <?php endif; ?>
    <?php
    wp_reset_postdata();
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'xclassicslider', 'cactus_posts_classic_slider' );

//Register Visual composer
add_action( 'after_setup_theme', 'reg_ctposts_classic_slider', 100 );
function reg_ctposts_classic_slider(){
    if(function_exists('vc_map')){
    vc_map( array(
        "name"      => esc_html__("NewsTube Posts Classic Slider", "cactus"),
        "base"      => "xclassicslider",
        "class"     => "wpb_vc_posts_classic_slider_widget",
        "icon"        => "icon-post-classic-slider",
        "category"  => esc_html__('Content', 'cactus'),
        "params"    => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Layout", "cactus"),
                "param_name" => "layout",
                "value" => array(
                    esc_html__("Horizontal","cactus")=>'horizontal',
                    esc_html__("Vertical","cactus")=>'vertical',
                ),
                "description" => esc_html__("choose box layout. Possible values:", "cactus")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Count", "cactus"),
                "param_name" => "count",
                "value" => "",
                "description" => esc_html__('number of items to query', "cactus")
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Condition", "cactus"),
                "param_name" => "condition",
                "value" => array(
                esc_html__("Latest","cactus")=>'latest',
                esc_html__("Most viewed","cactus")=>'view',
                esc_html__("Most Liked","cactus")=>'like',
                esc_html__("Most commented","cactus")=>'comment',
                esc_html__("Title", "cactus") => "title",
                esc_html__("Input(only available when using ids parameter)", "cactus") => "input",
                esc_html__("Random", "cactus") => "random"),
                "description" => esc_html__("condition to query items", "cactus")
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Order", "cactus"),
                "param_name" => "order",
                "value" => array(
                esc_html__("Descending", "cactus") => "DESC",
                esc_html__("Ascending", "cactus") => "ASC" ),
                "description" => esc_html__('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'cactus')
            ),

            array(
              "type" => "textfield",
              "heading" => esc_html__("Categories", "cactus"),
              "param_name" => "cats",
              "description" => esc_html__("list of categories (ID) to query items from, separated by a comma.", "cactus")
            ),

            array(
                "type" => "textfield",
                "heading" => esc_html__("Tags", "cactus"),
                "param_name" => "tags",
                "value" => "",
                "description" => esc_html__('list of tags to query items from, separated by a comma. For example: tag-1, tag-2, tag-3', "cactus")
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Featured", "cactus"),
                "param_name" => "featured",
                "value" => array(
                esc_html__("No", "cactus") => "0",
                esc_html__("Yes", "cactus") => "1"),
                "description" => esc_html__('choose yes to only query featured posts', 'cactus')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("IDs", "cactus"),
                "param_name" => "ids",
                "value" => "",
                "description" => esc_html__('list of post IDs to query, separated by a comma. If this value is not empty, cats, tags and featured are omitted', "cactus")
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Autoplay", "cactus"),
                "param_name" => "autoplay",
                "value" => array(
                esc_html__("No", "cactus") => "0",
                esc_html__("Yes", "cactus") => "1"),
                "description" => esc_html__('Autoplay or not', 'cactus')
            )
        )
    ) );
    }
}
