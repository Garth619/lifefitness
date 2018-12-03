<?php
function cactus_posts_parallax($params)
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
    ), $params));

    $rand_ID                    =  rand(1, 999);
    $id                         = 'posts-parallax' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $cats                       = isset($params['cats']) && $params['cats'] != '' ? $params['cats'] : '';
    $tags                       = isset($params['tags']) && $params['tags'] != '' ? $params['tags'] : '';
    $condition                  = isset($params['condition']) && $params['condition'] != '' ? $params['condition'] : '';
    $featured                   = isset($params['featured']) && $params['featured'] != '' ? $params['featured'] : '';
    $count                      = isset($params['count']) && $params['count'] != '' ? $params['count'] : '4';
    $order                      = isset($params['order']) && $params['order'] != '' ? $params['order'] : 'desc';
    $ids                        = isset($params['ids']) && $params['ids'] != '' ? $params['ids'] : '';

    ob_start();

    $page       ='';
    $the_query  = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page);

?>
    <?php if($the_query->have_posts()): $index = 0;?>
        <?php
            $first_posts    = $the_query->posts[0];
            $img_id         = get_post_thumbnail_id($first_posts->ID);
            $image          = wp_get_attachment_image_src($img_id, 'full');
        ?>
        <div class="cactus-banner-parallax">
            <div class="cactus-banner-parallax-content" style="background-image:url(<?php echo esc_url($image[0]);?>);"> <!--option background image + height(px)-->
                <div class="cactus-banner-gradient"></div>

                <?php while($the_query->have_posts()):?>
                <?php
                    $the_query->the_post();
                    $category = get_the_category();
                    if($index == 0):
                ?>
                <div class="primary-content">
                    <?php if(!empty($category)) echo cactus_get_category($category);?>
                    <?php echo tm_post_rating(get_the_ID());?>
                    <h1><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a> </h1>
                </div>
                <?php $index++; endif; endwhile;?>

                <div class="sub-content">
                    <div class="sub-item-listing">
                        <div class="sub-item-listing-content">
                            <?php while($the_query->have_posts()):?>
                            <?php
                                $the_query->the_post();
                                $category = get_the_category();
                                if($index != 1):
                            ?>
                            <div class="sub-item">
                                <?php if(!empty($category)) echo cactus_get_category($category);?>
                                <?php echo tm_post_rating(get_the_ID());?>
                                <h3 class="h6"><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h3>
                            </div>
                            <?php endif; $index++; endwhile;?>

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
add_shortcode( 'xparallax', 'cactus_posts_parallax' );

//Register Visual composer
add_action( 'after_setup_theme', 'reg_ctposts_parallax', 100 );
function reg_ctposts_parallax(){
    if(function_exists('vc_map')){
    vc_map( array(
        "name"      => esc_html__("NewsTube Posts Parallax", "cactus"),
        "base"      => "xparallax",
        "class"     => "wpb_vc_posts_parallax_widget",
        "icon"        => "icon-post-parallax",
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
            )
        )
    ) );
    }
}
