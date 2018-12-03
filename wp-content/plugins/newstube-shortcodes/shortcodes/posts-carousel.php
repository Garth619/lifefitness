<?php
function cactus_posts_carousel($params)
{
    //extract  this array to use variable below
    extract(shortcode_atts(array(
        'condition'             => '',
        'order'                 => '',
        'cats'                  => '',
        'count'                 => '',
        'tags'                  => '',
        'featured'              => '',
        'ids'                   => '',
        'autoplay'              => '',
        'visible'               => '',
    ), $params));

    $rand_ID                    =  rand(1, 999);
    $id                         = 'posts-carousel' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $cats                       = isset($params['cats']) && $params['cats'] != '' ? $params['cats'] : '';
    $tags                       = isset($params['tags']) && $params['tags'] != '' ? $params['tags'] : '';
    $condition                  = isset($params['condition']) && $params['condition'] != '' ? $params['condition'] : '';
    $featured                   = isset($params['featured']) && $params['featured'] != '' ? $params['featured'] : '';
    $count                      = isset($params['count']) && $params['count'] != '' ? $params['count'] : '5';
    $order                      = isset($params['order']) && $params['order'] != '' ? $params['order'] : 'desc';
    $ids                        = isset($params['ids']) && $params['ids'] != '' ? $params['ids'] : '';
    $autoplay                   = isset($params['autoplay']) && $params['autoplay'] != '' ? $params['autoplay'] : '0';
    $visible                    = isset($params['visible']) && $params['visible'] != '' ? $params['visible'] : '3';

    $page       ='';
    $the_query  = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page);

?>
    <?php if($the_query->have_posts()):?>
        <div class="cactus-carousel" data-autoplay="<?php echo esc_attr($autoplay);?>" data-visible="<?php echo esc_attr($visible);?>">
            <div class="cactus-swiper-container">
                <div class="swiper-wrapper">
                    <?php while($the_query->have_posts()):?>
                    <?php
                        $the_query->the_post();
                        $category = get_the_category();
                    ?>
                        <div class="swiper-slide">
                            <div class="carousel-item">
                                <?php 
                                ob_start();?>
                                <a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>">
                                    <?php echo cactus_thumbnail('thumb_375x300');?>
                                    <div class="thumb-gradient"></div>
                                    <div class="thumb-overlay"></div>
                                </a>
                                <div class="primary-content">
                                    <?php 
                                    $tag = '';
                                    if(!empty($category)){
                                        $tag = cactus_get_category($category);
                                    }
                                    
                                    echo apply_filters('newstube_item_category_tags', $tag);
                                    ?>
                                    <?php echo tm_post_rating(get_the_ID());?>
                                    <h3 class="h6"><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h3>
                                </div>
                                <?php 
                                $html = ob_get_contents();
                                ob_end_clean();
                                echo apply_filters('newstube_item_thumbnail_filter', $html, 'posts-carousel');
                                ?>
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            </div>
            <a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
            <a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
        </div>
    <?php endif; ?>
    <?php
    wp_reset_postdata();
}
add_shortcode( 'xcarousel', 'cactus_posts_carousel' );

//Register Visual composer
add_action( 'after_setup_theme', 'reg_ctposts_carousel', 100 );
function reg_ctposts_carousel(){
    if(function_exists('vc_map')){
    vc_map( array(
        "name"      => esc_html__("NewsTube Posts Carousel", "cactus"),
        "base"      => "xcarousel",
        "class"     => "wpb_vc_posts_carousel_widget",
        "icon"        => "icon-post-carousel",
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
                "heading" => esc_html__("Visible", "cactus"),
                "param_name" => "visible",
                "value" => "",
                "description" => esc_html__('Number of visible items (items per slide)', "cactus")
            )
        )
    ) );
    }
}
