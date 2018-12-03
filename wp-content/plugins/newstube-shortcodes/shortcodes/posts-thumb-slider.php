<?php
function cactus_posts_thumb_slider($params)
{
    //extract  this array to use variable below
    extract(shortcode_atts(array(
        'layout'                => '',
        'condition'             => '',
        'order'                 => '',
        'cats'                  => '',
        'tags'                  => '',
        'featured'              => '',
        'ids'                   => '',
        'height'                => '',
        'autoplay'              => '',
    ), $params));

    $rand_ID                    =  rand(1, 999);
    $id                         = 'posts-thumb-slider' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $cats                       = isset($params['cats']) && $params['cats'] != '' ? $params['cats'] : '';
    $tags                       = isset($params['tags']) && $params['tags'] != '' ? $params['tags'] : '';
    $condition                  = isset($params['condition']) && $params['condition'] != '' ? $params['condition'] : '';
    $layout                     = isset($params['layout']) && $params['layout'] != '' ? $params['layout'] : 'horizontal ';
    $featured                   = isset($params['featured']) && $params['featured'] != '' ? $params['featured'] : '';
    $order                      = isset($params['order']) && $params['order'] != '' ? $params['order'] : 'desc';
    $ids                        = isset($params['ids']) && $params['ids'] != '' ? $params['ids'] : '';
    $height                     = isset($params['height']) && $params['height'] != '' && is_numeric($params['height']) ? $params['height'] : '750';
    $autoplay                   = isset($params['autoplay']) && $params['autoplay'] != '' ? $params['autoplay'] : '0';

    ob_start();

    $page       ='';
    $count      = '4';
    $the_query  = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page);

?>
    <?php if($the_query->have_posts()):?>
        <?php $height_style = 'style="max-height:' . esc_attr($height) . 'px; height:' . esc_attr($height) . 'px;"';?>
        <div class="cactus-thumb-slider" <?php echo $height_style;?> data-autoplay="<?php echo esc_attr($autoplay);?>">
            <div class="slider-content">
                <div class="cactus-thumb-slider-container">
                    <div class="swiper-wrapper">
                        <?php while($the_query->have_posts()):?>
                        <?php
                            $the_query->the_post();
                            //get images thumbnail and alt text
                            $img_id     = get_post_thumbnail_id();
                            $image      = wp_get_attachment_image_src($img_id, 'full');
							
							$category               = get_the_category();
                        ?>
                            <div class="swiper-slide" style="background-image:url('<?php echo esc_url($image[0]);?>')">                                
                                <!--<a href="<?php esc_url(the_permalink());?>" title="<?php esc_attr(the_title_attribute()); ?>" class="thumb-link-hover">-->
                                    <div class="thumb-primary-content">                                	
                                        <div class="thumb-content-bg dark-div">
                                            <div class="thumb-absolute">
                                                <?php echo cactus_get_category($category[0]);?>
                                            </div>
                                            
                                            <h2 class="thumb-title"><?php the_title(); ?></h2>
                                            <div class="thumb-excerpt"><?php the_excerpt(); ?></div>
                                        </div>                                    
                                    </div>
                                <!--</a>-->
                                <a href="<?php esc_url(the_permalink());?>" title="<?php esc_attr(the_title_attribute()); ?>"></a>
                            </div>
                        <?php endwhile;?>
                    </div>
                </div>

                <div class="prev-next-fix">
                    <a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    <a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <div class="slider-thumb">
                <div class="thumb-content">
                    <div class="cactus-thumb-slider-listing">
                        <div class="swiper-wrapper">
                            <?php while($the_query->have_posts()):?>
                            <?php
                                $the_query->the_post();
                                $category               = get_the_category();
                                $category_color         = get_option('cat_color_' . $category[0]->term_id) != '' && get_option('cat_color_' . $category[0]->term_id) != 'FFFFFF' ? 'data-tag-color="#' . (get_option('cat_color_' . $category[0]->term_id))  . '"' : '';

                                $category_text_color    = get_option('cat_text_color_' . $category[0]->term_id) != '' && get_option('cat_text_color_' . $category[0]->term_id) != '#fff' ? ' style="color: ' . (get_option('cat_text_color_' . $category[0]->term_id))  . '"' : '';
                            ?>
                                <div class="swiper-slide">

                                    <div class="thumb-item" <?php //echo $category_color;?>>
                                        <!--<div class="cactus-note-cat"<?php //echo $category_text_color;?>><?php //echo $category[0]->name;?></div>-->
                                        <?php //echo tm_post_rating(get_the_ID());?>
                                        <div class="thumb-absolute-item">
                                        	<div class="thumb-absolute-table">
                                            	<div>
                                        			<h3 class="h6"><?php the_title();?></h3>
                                                </div>
                                            </div> 
										</div>
                                        <!--<div class="bottom-absolute"></div>-->
                                    </div>

                                </div>
                            <?php endwhile;?>

                        </div>
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
add_shortcode( 'xthumbslider', 'cactus_posts_thumb_slider' );

//Register Visual composer
add_action( 'after_setup_theme', 'reg_ctposts_thumb_slider', 100 );
function reg_ctposts_thumb_slider(){
    if(function_exists('vc_map')){
    vc_map( array(
        "name"      => esc_html__("NewsTube Posts Thumb Slider", "cactus"),
        "base"      => "xthumbslider",
        "class"     => "wpb_vc_posts_thumb_slider_widget",
        "icon"        => "icon-post-thumb-slider",
        "category"  => esc_html__('Content', 'cactus'),
        "params"    => array(
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
              "type" => "textfield",
              "heading" => esc_html__("Height", "cactus"),
              "param_name" => "height",
              "description" => esc_html__("Height of posts thumb slider", "cactus")
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
