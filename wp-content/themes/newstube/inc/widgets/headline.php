<?php

class Headline extends WP_Widget
{
	function __construct()
	{
		$options = array(
			'classname' 	=> 'headline',
			'description' 	=> esc_html__('Display post titles as headlines', 'cactus')
			);
		parent::__construct('headline_id', 'NewsTube - Headlines', $options);
	}

	function form($instance)
	{
		$default_value 		= array(
			'headline_text' 		=> esc_html__('Headline', 'cactus'),
			'category' 				=> '',
			'tags' 					=> '',
			'post_ids' 				=> '',
			'number_of_headlines' 	=> '5',
			'number_of_days' 		=> '',
			'order_by'				=> 'latest'
			);
		$instance 				= wp_parse_args((array) $instance, $default_value);
		$headline_text 			= esc_attr($instance['headline_text']);
		$category 				= esc_attr($instance['category']);
		$tags 					= esc_attr($instance['tags']);
		$post_ids 				= esc_attr($instance['post_ids']);
		$number_of_headlines	= esc_attr($instance['number_of_headlines']);
		$number_of_days			= esc_attr($instance['number_of_days']);
		$order_by				= esc_attr($instance['order_by']);

		// Create form
		$html 	= '';
		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Headline Text', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('headline_text') . '" value="' . $headline_text . '"/>';
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
		$html  .= '<label>' . esc_html__('Number of headlines', 'cactus') . ': </label>';
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
		$instance['headline_text'] 			= strip_tags($new_instance['headline_text']);
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

		$headline_text 			= $instance['headline_text'] != '' ? $instance['headline_text'] : esc_html__('Headline', 'cactus');
		$cat 					= $instance['category'];
		$tags 					= $instance['tags'];
		$post_ids 				= $instance['post_ids'];
		$number_of_headlines 	= $instance['number_of_headlines'] != '' ? $instance['number_of_headlines'] : '5';
		$number_of_days 		= $instance['number_of_days'];
		$order_by 				= $instance['order_by'] != '' ? $instance['order_by'] : 'latest';

		$the_query = cactus_get_posts('post', $order_by, $tags, $number_of_headlines, $post_ids, '', $cat, array(), 1, $number_of_days, '' );


		echo $before_widget;

		$html = '';

		if($the_query->have_posts())
	    {
			$html .= '<ul class="nav navbar-nav navbar-left rps-hidden"><li class="title">' . $headline_text . '</li>';
			$html .= '
					<li class="navigation">
				       <div class="button-prev"><i class="fa fa-angle-left"></i></div>
				       <div class="button-next"><i class="fa fa-angle-right"></i></div>
				   	</li>
				   	<li class="cactus-swiper-container" data-settings="[mode:cactus-fix-composer]"><div class="swiper-wrapper">';

				    	while($the_query->have_posts())
			    		{
			    			$the_query->the_post();
							$category 		=  get_the_category();
			    			$html .= '
				    			<div class="swiper-slide">'
				    			. cactus_get_category($category) .
				    			'<a class="title-slide" href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>
				    			</div>';
			    		}
			    		wp_reset_postdata();

	        $html .='</div></li>';
	        $html .='</ul>';
	    }
	    echo $html;

		echo $after_widget;

	}
}

add_action('widgets_init',  create_function('', 'return register_widget("Headline");'));

?>
