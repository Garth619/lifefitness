<?php
function cactus_posts_slider($params)
{
    //extract  this array to use variable below
    extract(shortcode_atts(array(
        'condition'             => '',
        'order'                 => '',
        'cats'                  => '',
        'count'                  => '',
        'tags'                  => '',
        'featured'              => '',
        'ids'                   => '',
        'autoplay'              => '',
        'height'                => '',
    ), $params));

    $rand_ID                    =  rand(1, 999);
    $id                         = 'posts-slider' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $cats                       = isset($params['cats']) && $params['cats'] != '' ? $params['cats'] : '';
    $tags                       = isset($params['tags']) && $params['tags'] != '' ? $params['tags'] : '';
    $condition                  = isset($params['condition']) && $params['condition'] != '' ? $params['condition'] : '';
    $featured                   = isset($params['featured']) && $params['featured'] != '' ? $params['featured'] : '';
    $count                      = isset($params['count']) && $params['count'] != '' ? $params['count'] : '5';
    $order                      = isset($params['order']) && $params['order'] != '' ? $params['order'] : 'desc';
    $ids                        = isset($params['ids']) && $params['ids'] != '' ? $params['ids'] : '';
    $autoplay                   = isset($params['autoplay']) && $params['autoplay'] != '' ? $params['autoplay'] : '0';
    $height                     = isset($params['height']) ? $params['height'] : '';

    ob_start();

    $page       ='';
    $the_query  = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page);

?>
    <?php if($the_query->have_posts()):?>
        <?php
            //$first_posts    = $the_query->posts[0];
            //$img_id         = get_post_thumbnail_id($first_posts->ID);
            //$image          = wp_get_attachment_image_src($img_id, 'full');
        ?>

            <div class="cactus-banner-parallax-slider" data-autoplay="<?php echo esc_attr($autoplay);?>">
                <div class="cactus-banner-parallax-content" style=""> <!--option background image + height(px) / background-image:url(<?php //echo esc_url($image[0]);?>);-->
                    <div class="center-pagination">
                        <div class="center-table">
                            <div class="pagination"></div>
                        </div>
                    </div>

                    <div class="cactus-swiper-container">
                        <div class="swiper-wrapper">
                            <?php 
							while($the_query->have_posts()):								
                                $the_query->the_post();
                                $backgroundImg = '';
                                if(has_post_thumbnail()) {
                                    $bg_img_id          = get_post_thumbnail_id();
                                    $bg_img_array       = wp_get_attachment_image_src($bg_img_id, 'full');
                                    $backgroundImg      = $bg_img_array[0];
                                };
                                $category = get_the_category();
                            ?>
                                <div class="swiper-slide" style="background-image:url(<?php echo esc_url($backgroundImg);?>); background-repeat:no-repeat; background-size: cover; background-position:50% 50%;">
                                    <div class="primary-content">
                                        <div class="center-slider">
                                            <div class="center-slider-content">
                                                <div class="posted-on">
                                                    <?php echo cactus_get_datetime();?>
                                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" class="author cactus-info"><?php echo esc_html(get_the_author())?></a>
                                                </div>
                                                <h3 class="h1"><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a> <?php echo tm_post_rating(get_the_ID());?></h3>
                                                <?php if(!empty($category)) echo cactus_get_category($category);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
                <?php if($height != ''):?>
                <style type="text/css" scoped>
                    .cactus-banner-parallax-slider,
                    .cactus-banner-parallax-slider .cactus-banner-parallax-content,
                    .cactus-banner-parallax-slider .swiper-slide {min-height: <?php echo $height;?>px; max-height: <?php echo $height;?>px;}
                </style>
                <?php endif;?>
            </div>
    <?php endif; ?>
    <?php
    wp_reset_postdata();
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'xslider', 'cactus_posts_slider' );

//Register Visual composer
add_action( 'after_setup_theme', 'reg_ctposts_slider', 100 );
function reg_ctposts_slider(){
    if(function_exists('vc_map')){
    vc_map( array(
        "name"      => esc_html__("NewsTube Posts Slider", "cactus"),
        "base"      => "xslider",
        "class"     => "wpb_vc_posts_slider_widget",
        "icon"        => "icon-post-slider",
        "category"  => esc_html__('Content', 'cactus'),
        "params"    => array(
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
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Height", "cactus"),
                "param_name" => "height",
                "value" => "",
                "description" => esc_html__('Height of Slider', "cactus")
            ),
        )
    ) );
    }
}
