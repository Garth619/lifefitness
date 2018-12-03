<?php
function cactus_topic_box($params)
{
    //extract  this array to use variable below
    extract(shortcode_atts(array(
        'title'                 => '',
        'layout'                => '',
        'alignment'             => '',
        'count'                 => '',
        'condition'             => '',
        'order'                 => '',
        'cats'                  => '',
        'tags'                  => '',
        'featured'              => '',
        'ids'                   => '',
    ), $params));

    $rand_ID                    =  rand(1, 999);
    $id                         = 'topic_box' . $rand_ID;
    $output_id                  = ' id= "' . $id . '"';
    $title                      = isset($params['title']) && $params['title'] != '' ? $params['title'] : '';
    $cats                       = isset($params['cats']) && $params['cats'] != '' ? $params['cats'] : '';
    $tags                       = isset($params['tags']) && $params['tags'] != '' ? $params['tags'] : '';
    $condition                  = isset($params['condition']) && $params['condition'] != '' ? $params['condition'] : '';
    $layout                     = isset($params['layout']) && $params['layout'] != '' ? $params['layout'] : '1';
    $alignment                     = isset($params['alignment']) && $params['alignment'] != '' ? $params['alignment'] : 'left';
    $count                      = isset($params['count']) && $params['count'] != '' ? $params['count'] : '3';
    $featured                   = isset($params['featured']) && $params['featured'] != '' ? $params['featured'] : '';
    $order                      = isset($params['order']) && $params['order'] != '' ? $params['order'] : 'desc';
    $ids                        = isset($params['ids']) && $params['ids'] != '' ? $params['ids'] : '';

    ob_start();

    $page       ='';
    $the_query  = smartcontentbox_query($count,$condition,$order,$cats,$tags,$featured,$ids,$page);

?>
    <?php if($the_query->have_posts()):?>
        <?php $alignment_class = $alignment != 'left' ? ' topic-box-right' : ''; ?>
        <?php if($layout == 2):?>
            <div class="cactus-topic-box style-2<?php echo esc_attr($alignment_class);?>">
                <div class="topic-box-content">
                    <?php if($title != ''):?><div class="topic-box-title"><?php echo $title;?></div><?php endif;?>
                    <?php while($the_query->have_posts()): $the_query->the_post();?>
                        <?php 
                            $img            = has_post_thumbnail() ? cactus_thumbnail('thumb_250x165') : '<img src="' . get_template_directory_uri().'/images/default_image_250x165.jpg' . '" alt="nothumb">';
                        ?>
                        <div class="topic-box-picture"><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php echo $img;?></a></div>
                        <div class="topic-box-item"><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></div>
                    <?php endwhile;?>
                </div>
            </div>
        <?php else:?>
            
            <div class="cactus-topic-box<?php echo esc_attr($alignment_class);?>">
                <?php
                    $first_posts    = $the_query->posts[0];
                    $img            = has_post_thumbnail( $first_posts->ID ) ? cactus_thumbnail($first_posts->ID, 'thumb_250x165') : '<img src="' . get_template_directory_uri().'/images/default_image_250x165.jpg' . '" alt="nothumb">';
                ?>
                <div class="topic-box-picture"><?php echo $img;?></div>
                <div class="topic-box-content">
                    <?php if($title != ''):?><div class="topic-box-title"><?php echo $title;?></div><?php endif;?>
                    <?php while($the_query->have_posts()): $the_query->the_post();?>
                        <div class="topic-box-item"><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></div>
                    <?php endwhile;?>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>
    <?php
    wp_reset_postdata();
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'xtopic', 'cactus_topic_box' );

//Register Visual composer
add_action( 'after_setup_theme', 'reg_cttopic_box', 100 );
function reg_cttopic_box(){
    if(function_exists('vc_map')){
    vc_map( array(
        "name"      => esc_html__("NewsTube Topic Box", "cactus"),
        "base"      => "xtopic",
        "class"     => "wpb_vc_topic_box_widget",
        "icon"        => "icon-topic-box",
        "category"  => esc_html__('Content', 'cactus'),
        "params"    => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", "cactus"),
                "param_name" => "title",
                "value" => "",
                "description" => esc_html__('heading title of the box. If empty, heading should be hidden', "cactus")
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Layout", "cactus"),
                "param_name" => "layout",
                "value" => array(
                    esc_html__("Layout 1","cactus")=>'1',
                    esc_html__("Layout 2","cactus")=>'2',
                ),
                "description" => esc_html__("choose box layout. Possible values:", "cactus")
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Alignment", "cactus"),
                "param_name" => "alignment",
                "value" => array(
                    esc_html__("Left","cactus")=>'left',
                    esc_html__("Right","cactus")=>'right',
                ),
                "description" => esc_html__("select box alignment", "cactus")
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
                "type" => "textfield",
                "heading" => esc_html__("IDs", "cactus"),
                "param_name" => "ids",
                "value" => "",
                "description" => esc_html__('list of post IDs to query, separated by a comma. If this value is not empty, cats, tags and featured are omitted', "cactus")
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Featured", "cactus"),
                "param_name" => "featured",
                "value" => array(
                esc_html__("No", "cactus") => "0",
                esc_html__("Yes", "cactus") => "1"),
                "description" => esc_html__('choose yes to only query featured posts', 'cactus')
            )
        )
    ) );
    }
}
