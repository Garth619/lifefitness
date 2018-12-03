<?php

class Popular_posts extends WP_Widget
{
	function __construct()
	{
		$options = array(
			'classname' 	=> 'popular_posts',
			'description' 	=> esc_html__('Show popular posts', 'cactus')
			);
		parent::__construct('popular_posts_id', 'NewsTube - Popular Posts', $options);
	}

	function form($instance)
	{
		$default_value 		= array(
			'title' 		=> esc_html__('Popular Posts', 'cactus'),
			'category' 				=> '',
			'style' 				=> '1',
			'tags' 					=> '',
			'post_ids' 				=> '',
			'number_of_headlines' 	=> '5',
			'number_of_days' 		=> '',
			'order_by'				=> 'latest'
			);
		$instance 				= wp_parse_args((array) $instance, $default_value);
		$title 					= esc_attr($instance['title']);
		$category 				= esc_attr($instance['category']);
		$style 					= esc_attr($instance['style']);
		$tags 					= esc_attr($instance['tags']);
		$post_ids 				= esc_attr($instance['post_ids']);
		$number_of_headlines	= esc_attr($instance['number_of_headlines']);
		$number_of_days			= esc_attr($instance['number_of_days']);
		$order_by				= esc_attr($instance['order_by']);

		// Create form
		$html 	= '';
		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Title', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
		$html  .= '</p>';

		$style1 					= $style == '1' ? 'selected="selected"' : '';
		$style2 					= $style == '2' ? 'selected="selected"' : '';

		$html  .= '<label>' . esc_html__('Style', 'cactus') . ': </label>';
		$html  .= '<p>';
		$html  .= '<select name="' . $this->get_field_name('style') . '">
						<option value="1"' . $style1 . '>' . esc_html__('Style 1', 'cactus') . '</option>
						<option value="2"' . $style2 . '>' . esc_html__('Style 2', 'cactus') . '</option>
					</select>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Category (Category ID or Slug)', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('category') . '" value="' . $category . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Tags', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('tags') . '" value="' . $tags . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Post IDs: (If this param is used, other params are ignored)', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('post_ids') . '" value="' . $post_ids . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Number of items', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('number_of_headlines') . '" value="' . $number_of_headlines . '"/>';
		$html  .= '</p>';

		$one_day 					= $number_of_days == 'day' ? 'selected="selected"' : '';
		$one_week 					= $number_of_days == 'week' ? 'selected="selected"' : '';
		$one_month 					= $number_of_days == 'month' ? 'selected="selected"' : '';
		$one_year 					= $number_of_days == 'year' ? 'selected="selected"' : '';

		$html  .= '<label>' . esc_html__('Number of days', 'cactus') . ': </label>';
		$html  .= '<p>';
		$html  .= '<select name="' . $this->get_field_name('number_of_days') . '">
						<option value="day"' . $one_day . '>' . esc_html__('1 day', 'cactus') . '</option>
						<option value="week"' . $one_week . '>' . esc_html__('1 week', 'cactus') . '</option>
						<option value="month"' . $one_month . '>' . esc_html__('1 month', 'cactus') . '</option>
						<option value="year"' . $one_year . '>' . esc_html__('1 year', 'cactus') . '</option>
					</select>';
		$html  .= '</p>';

		$latest 					= $order_by == 'latest' ? 'selected="selected"' : '';
		$most_viewed 				= $order_by == 'most_viewed' ? 'selected="selected"' : '';
		$most_liked 				= $order_by == 'most_liked' ? 'selected="selected"' : '';
		$most_commented 			= $order_by == 'most_commented' ? 'selected="selected"' : '';
		$featured 					= $order_by == 'featured' ? 'selected="selected"' : '';

		$html  .= '<p><label>' . esc_html__('Order by', 'cactus') . ': </label></p>';
		$html  .= '<p>';
		$html  .= '<select name="' . $this->get_field_name('order_by') . '">
						<option value="latest"' . $latest . '>' . esc_html__('Latest', 'cactus') . '</option>
						<option value="most_viewed"' . $most_viewed . '>' . esc_html__('Most viewed', 'cactus') . '</option>
						<option value="most_liked"' . $most_liked . '>' . esc_html__('Most liked', 'cactus') . '</option>
						<option value="most_commented"' . $most_commented . '>' . esc_html__('Most commented', 'cactus') . '</option>
						<option value="featured"' . $featured . '>' . esc_html__('Featured', 'cactus') . '</option>
					</select>';
		$html  .= '</p>';

		echo $html;
	}

	function update($new_instance, $old_instance)
	{
		$instance 							= $old_instance;
		$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['style'] 					= strip_tags($new_instance['style']);
		$instance['category'] 				= strip_tags($new_instance['category']);
		$instance['tags'] 					= strip_tags($new_instance['tags']);
		$instance['post_ids'] 				= strip_tags($new_instance['post_ids']);
		$instance['number_of_headlines'] 	= strip_tags($new_instance['number_of_headlines']);
		$instance['number_of_days'] 		= strip_tags($new_instance['number_of_days']);
		$instance['order_by'] 				= strip_tags($new_instance['order_by']);
		return $instance;
	}

	function widget($args, $instance)
	{
		//extract  this array to use variable below
		extract($args);

		$title 					= $instance['title'] != '' ? $instance['title'] : esc_html__('Headline', 'cactus');
		$style 					= isset($instance['style']) && $instance['style'] != '' ? $instance['style'] : 1;
		$cat 					= $instance['category'];
		$tags 					= $instance['tags'];
		$post_ids 				= $instance['post_ids'];
		$number_of_headlines 	= $instance['number_of_headlines'] != '' ? $instance['number_of_headlines'] : '5';
		$number_of_days 		= $instance['number_of_days'];
		$order_by 				= $instance['order_by'] != '' ? $instance['order_by'] : 'latest';

		$popular_posts_style    = $style != 1 ? 'style-2' : '';

		$popular_query = cactus_get_posts('post', $order_by, $tags, $number_of_headlines, $post_ids, '', $cat, array(), 1, $number_of_days, '' );

		echo $before_widget;


		$html = '';
		$html .= $before_title . $title . $after_title;


		if($popular_query->have_posts())
	    {
			$html .= '<div class="cactus-widget-posts ' . $popular_posts_style . '">';

	    	while($popular_query->have_posts())
    		{
    			$popular_query->the_post();

    			$comment_str = '';
    			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) )
    			    $comment_str = '<div class="comment cactus-info">' . get_comments_number() . '</div>';

    			$info = '';
    			$info .= '
    			    <div class="posted-on">
    			        ' . cactus_get_datetime();
    			$info .= $comment_str;
    			$info .='</div>';

				$html .= '<div class="cactus-widget-posts-item">';
				if(has_post_thumbnail())
				{
					$html .='	<div class="widget-picture">
									<div class="widget-picture-content">';
						if($style != 1)
						{
							$html .= '<a title="' . get_the_title() . '" href="' . get_the_permalink() . '">' . cactus_thumbnail('thumb_396x325') . '
			                        	<div class="thumb-overlay"></div>
		                    			</a>';
		                    $category = get_the_category();
							$html .= 	cactus_get_category($category);
						}
						else
						{
							$html .= '<a title="' . get_the_title() . '" href="' . get_the_permalink() . '">' . cactus_thumbnail('thumb_94x72') . '
			                        	<div class="thumb-overlay"></div>
		                    			</a>';
						}
					$html .=   	tm_post_rating(get_the_ID()) . '
									</div>
								</div>';
				}
				$html .= '	<div class="cactus-widget-posts-content">
								<h3 class="h6 widget-posts-title">
                                        <a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>
                                </h3>'
                                . $info .
                            '</div>
						</div>';
    		}
    		wp_reset_postdata();

    		$html .= '</div>';
	    }

	    echo $html;

		echo $after_widget;

	}
}

add_action('widgets_init',  create_function('', 'return register_widget("Popular_posts");'));

?>
