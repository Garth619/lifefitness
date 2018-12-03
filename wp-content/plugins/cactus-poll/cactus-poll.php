<?php
/*
Plugin Name: Cactus Poll
Plugin URI: http://cactusthemes.com/
Description: create polls
Version: 1.2.2.6
Author: CactusThemes
Author URI: http://cactusthemes.com/
License: Commercial
*/
/*translate settings*/
$text_translate_channel_st = esc_html__('reCaptcha API','cactus').esc_html__('Site key','cactus').esc_html__('Get this key from google.com/recaptcha','cactus').esc_html__('Secret key','cactus').esc_html__('Get this key from google.com/recaptcha','cactus');
class Cactus_poll
{
	public function __construct()
	{
		$this->includes();
		$this->register_configuration();

		add_action( 'wp_enqueue_scripts', array( $this, 'cactus_poll_frontend_scripts' ) );
		add_action( 'init', array( $this, 'cactus_poll_custom_post_type' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'cactus_poll_custom_columns' ) );

		add_filter( 'manage_poll_posts_columns', array( $this, 'cactus_poll_edit_columns' ) );

		add_shortcode( 'cactus-poll', array( $this, 'shortcode_cactus_poll' ) );

		add_shortcode( 'cactus-poll-result', array( $this, 'shortcode_cactus_poll_result' ) );

		if (is_admin()) {
			add_action( 'wp_ajax_cactus_save_poll', array( $this, 'ct_wp_ajax_save_poll') );
			add_action( 'wp_ajax_nopriv_cactus_save_poll', array( $this, 'ct_wp_ajax_save_poll') );
		}

	}

	function includes(){
		// custom meta boxes
		if( ! class_exists( 'RW_Meta_Box' ) ) {
			include_once plugin_dir_path( __FILE__ ) . 'includes/custom-meta-box/meta-box.php';
		}

		include_once plugin_dir_path( __FILE__ ) . 'includes/cactus-poll-meta-boxes.php';

		if( ! class_exists( 'ReCaptcha' ) ) {
			include_once plugin_dir_path( __FILE__ ) . 'includes/recaptchalib.php';
		}

		if(!class_exists('Options_Page')){
			include_once('includes/options-page/options-page.php');
		}
		//include_once('classes/u-project-query.php');
	}

	/* This is called as soon as possible to set up options page for the plugin
	 * after that, $this->get_option($name) can be called to get options.
	 *
	 */
	function register_configuration(){
		global $poll_settings;
		$poll_settings = new Options_Page('poll_settings', array('option_file'=>dirname(__FILE__) . '/options.xml','menu_title'=>'Poll Settings','menu_position'=>null), array('page_title'=>esc_html__('Poll Setting Page','cactus'),'submit_text'=>esc_html__('Save','cactus')));
	}

	/*
	 * Enqueue Styles and Scripts
	 */
	function cactus_poll_frontend_scripts()
	{
		// //main css
		wp_enqueue_style( 'cactus-poll', plugins_url( "css/cactus-poll.css", __FILE__ ), array(), '20141105' );

		// //main js
		wp_enqueue_script( 'cactus-poll', plugins_url( "js/cactus-poll.js", __FILE__ ), array(), '20140107', true);
	
		// captcha js
		wp_enqueue_script( 'cactus-poll-captcha', 'https://www.google.com/recaptcha/api.js', array(), '20140107', true);
	}

	function get_poll_settings($options = array())
	{
		if(!isset($options['id'])) return array();
		$poll_config = array(
			'enable_multiple_choices' 	=> rwmb_meta('cactus_poll_enable_multiple_choices', array(), $options['id']),
			'enable_custom_answer' 		=> rwmb_meta('cactus_poll_enable_custom_answer', array(), $options['id']),
			'enable_captcha' 			=> rwmb_meta('cactus_poll_enable_captcha', array(), $options['id']),
			'user_vote_settings' 		=> rwmb_meta('cactus_poll_user_vote_settings', array(), $options['id']),
			'vote_frequency_settings' 	=> rwmb_meta('cactus_poll_vote_frequency_settings', array(), $options['id']),
			'expiry_date' 				=> rwmb_meta('cactus_poll_expiry_date', array(), $options['id']),
			'display_result_settings' 	=> rwmb_meta('cactus_poll_display_result_settings', array(), $options['id'])
			);
		return $poll_config;
	}

	function shortcode_cactus_poll($atts, $content = "")
	{
		$poll_id				= isset($atts['id']) && $atts['id'] != '' ? $atts['id'] : 0;


		$options = array(
			'post_type' 			=> 'poll',
			'posts_per_page'		=> 1,
			'post_status' 			=> 'publish',
			'ignore_sticky_posts' 	=> true,
			'p'						=> $poll_id
		);

		$the_query = new WP_Query( $options );

		$output = '';

		if($the_query->have_posts())
		{
			while($the_query->have_posts())
			{
				$the_query->the_post();
				$poll_config = $this->get_poll_settings(array('id' => get_the_ID()));

				$output .= '<div class="cactus-poll-block" data-id="' . get_the_ID() . '" data-key="' . md5('cactusthemes' . get_the_ID()) . '" data-msg-error="' . esc_html__('You must choose your answer first, You must verify You\'re not a robot, You\'ve already voted this poll, You\'ve been voted this poll successfully, Voting...','cactus') . '" data-mutilple-choices="' . $poll_config['enable_multiple_choices'] . '" data-enable-captcha="' . $poll_config['enable_captcha'] . '" data-display-result-settings="' . $poll_config['display_result_settings'] . '">';

				$output .= '<div class="poll-title"><div class="poll-table"><span class="poll-question-icon"><span>?</span></span> <span class="question-cdt"><span>' . get_the_title() . '</span></span></div></div>';
				$output .= '<div class="poll-question"><span>' . get_the_content() . '</span></div>';

				$expiry_date = $poll_config['expiry_date'];

				$answers = rwmb_meta( 'cactus_poll_list_answers',array(), get_the_ID());

				if(strtotime($expiry_date) >= strtotime(date('Y-m-d H:i')))
				{

					$output .= '<div class="poll-vote-form-block"><form class="poll-vote-form">';
					$output .= '<div class="poll-list-answers">';
						foreach($answers as $key => $answer)
						{
							if($poll_config['enable_multiple_choices'] == 'yes')
								$output .= '<div class="poll-answer"> <span><input type="checkbox" value="' . $key . '" name="answers' . get_the_ID() . '[]"></span> <span>' . $answer . '</span></div>';
							else
								$output .= '<div class="poll-answer"> <span><input type="radio" value="' . $key . '" name="answers' . get_the_ID() . '"> </span> <span>' . $answer . '</span></div>';
						}
					$output .= '</div>';


					if($poll_config['enable_captcha'] == 'yes')
						$output .= '<div class="g-recaptcha" data-sitekey="' . osp_get('poll_settings', 'cactus-poll-site-key') . '"></div>';

					if($poll_config['user_vote_settings'] == 'only_user')
					{
						if(is_user_logged_in())
						{
							$output .= '<input class="submit-poll-button" type="button" value="' . esc_html__('Submit', 'cactus') . '">';
						}
						else
						{
							$output .= '<div class="poll-msg-error" style="padding-top:0">' . esc_html__('You must login to vote this poll', 'cactus') . '</div>';
						}
					}
					else
					{
						$output .= '<input class="submit-poll-button" type="button" value="' . esc_html__('Submit', 'cactus') . '">';
					}

					$output .= '</form></div>';
				}
				else
				{
					//display poll result
					$poll_result 	= rwmb_meta('cactus_poll_result', array(), $poll_id);
					if($poll_result != '')
					{
						$poll_result_arr = explode(',', $poll_result);
						$total_result = 0;
						foreach($poll_result_arr as $i => $value)
						{
							if(isset($answers[$i]))
								$total_result += $value;
						}
						$output .= '<div class="poll-result-block">';
						$output .= '<div class="result-title">' . esc_html__('RESULT', 'cactus') . '</div>';
						$output .= '<div class="poll-result">';
						foreach($answers as $index => $answer)
						{
							$result_percent = $total_result != 0 && isset($poll_result_arr[$index]) ? $poll_result_arr[$index] / $total_result * 100 : 0;
							$result = isset($poll_result_arr[$index]) ? $poll_result_arr[$index] : 0;
							$output .='		<div class="poll-result-item">
												<div class="option-item">' . $answer . '<span class="number-of-votes">' . $result . esc_html__(' votes', 'cactus') . ' ( ' . round($result_percent) . '% )</span></div>
												<div class="votes-progress-bar">
													<div class="votes-progress" style="width: ' . $result_percent . '%;"></div>
												</div>
											</div>';
						}
						$output .= '</div>';
						$output .= '</div>';
					}
				}

				$output .= '</div>';

			}
			wp_reset_postdata();
		}

		return $output;
	}

	function shortcode_cactus_poll_result($atts, $content = "")
	{
		$poll_id				= isset($atts['id']) && $atts['id'] != '' ? $atts['id'] : 0;


		$options = array(
			'post_type' 			=> 'poll',
			'posts_per_page'		=> 1,
			'post_status' 			=> 'publish',
			'ignore_sticky_posts' 	=> true,
			'p'						=> $poll_id
		);

		$the_query = new WP_Query( $options );

		$output = '';

		if($the_query->have_posts())
		{
			while($the_query->have_posts())
			{
				$the_query->the_post();
				$poll_config = $this->get_poll_settings(array('id' => get_the_ID()));

				$output .= '<div class="cactus-poll-block">';

				$answers = rwmb_meta( 'cactus_poll_list_answers',array(), get_the_ID());


				//display poll result
				$poll_result 	= rwmb_meta('cactus_poll_result', array(), $poll_id);
				if($poll_result != '')
				{
					$poll_result_arr = explode(',', $poll_result);
					$total_result = 0;
					foreach($poll_result_arr as $i => $value)
					{
						if(isset($answers[$i]))
							$total_result += $value;
					}
					$output .= '<div class="poll-result-block">';
					$output .= '<div class="result-title">' . esc_html__('RESULT', 'cactus') . '</div>';
					$output .= '<div class="poll-result">';
					foreach($answers as $index => $answer)
					{
						$result_percent = $total_result != 0 && isset($poll_result_arr[$index]) ? $poll_result_arr[$index] / $total_result * 100 : 0;
						$result = isset($poll_result_arr[$index]) ? $poll_result_arr[$index] : 0;
						$output .='		<div class="poll-result-item">
											<div class="option-item">' . $answer . '<span class="number-of-votes">' . $result . esc_html__(' votes', 'cactus') . ' ( ' . round($result_percent) . '% )</span></div>
											<div class="votes-progress-bar">
												<div class="votes-progress" style="width: ' . $result_percent . '%;"></div>
											</div>
										</div>';
					}
					$output .= '</div>';
					$output .= '</div>';
				}

				$output .= '</div>';

			}
			wp_reset_postdata();
		}

		return $output;
	}

	function show_result_in_admin($poll_id)
	{
		$output = '';

		

		$output .= '<div style="line-height:1.8;">';

		$answers = rwmb_meta( 'cactus_poll_list_answers',array(), $poll_id);


		//display poll result
		$poll_result 	= rwmb_meta('cactus_poll_result', array(), $poll_id);
		if($poll_result != '')
		{
			$poll_result_arr = explode(',', $poll_result);
			$total_result = 0;
			foreach($poll_result_arr as $i => $value)
			{
				if(isset($answers[$i]))
					$total_result += $value;
			}
			$output .= '<div class="poll-result-admin">';
			foreach($answers as $index => $answer)
			{
				$result_percent = $total_result != 0 && isset($poll_result_arr[$index]) ? $poll_result_arr[$index] / $total_result * 100 : 0;
				$result = isset($poll_result_arr[$index]) ? $poll_result_arr[$index] : 0;
				$output .='		<div class="poll-result-item-admin">
									<div>' . $answer . ' - <span style="font-weight:bold;">' . $result . esc_html__(' votes', 'cactus') . ' ( ' . round($result_percent) . '% )</span></div>
								</div>';
			}
			$output .= '</div>';
		}
		$output .= '</div>';

		return $output;
	}

	public function cactus_poll_custom_post_type()
	{

		//$label contain text realated post's name
		$label = array(
			'name'               => esc_html__('Polls', 'cactus'),
			'singular_name'      => esc_html__('Polls', 'cactus'),
			'add_new'            => esc_html__('Add New Poll', 'cactus'),
			'add_new_item'       => esc_html__('Add New Poll', 'cactus'),
			'edit_item'          => esc_html__('Edit Poll', 'cactus'),
			'new_item'           => esc_html__('New Poll', 'cactus'),
			'all_items'          => esc_html__('All Polls', 'cactus'),
			'view_item'          => esc_html__('View Polls', 'cactus'),
			'search_items'       => esc_html__('Search Poll', 'cactus'),
			'not_found'          => esc_html__('No Poll found', 'cactus'),
			'not_found_in_trash' => esc_html__('No Poll found in Trash', 'cactus'),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Polls', 'cactus'),
			);
		//args for custom post type
		$args = array(
			'labels' => $label,
			'description' => esc_html__('Post Type for Polls','cactus'),
			'supports' => array(
	            'title',
	            'editor',
	        ),
	        'taxonomies' => array(),
	        'hierarchical' => false,
	        'public' => false,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => true,
	        'show_in_admin_bar' => true,
	        'menu_position' => 5,
	        'menu_icon' => 'dashicons-editor-ul',
	        'can_export' => true,
	        'has_archive' => true,
	        'exclude_from_search' => false,
	        'publicly_queryable' => false,
	        'capability_type' => 'post'
				);

		//register post type
		register_post_type('poll', $args);
	}


	/**
	*
	* start the Advs listing edit page
	*
	*/
	function cactus_poll_edit_columns( $columns ) {
		$columns = array(
			'cb' 			=> '<input type="checkbox" />',
			'id' 			=> esc_html__( 'ID', 'cactus' ),
			'title' 		=> esc_html__( 'Title', 'cactus' ),
			'content' 		=> esc_html__( 'Content', 'cactus' ),
			'result' 		=> esc_html__( 'Result', 'cactus' ),
			'date' 			=> esc_html__( 'Date', 'cactus' )
		);
		return $columns;
	}

	// return the values for each coupon column on edit.php page
	function cactus_poll_custom_columns( $column ) {
		global $post;
		switch ( $column ) {
			case 'content' :
			    echo $post->post_content;
				break;
			case 'result' :
			    echo $this->show_result_in_admin($post->ID);
				break;
		}
	}

	function ct_wp_ajax_save_poll()
	{

		// The response from reCAPTCHA
		$resp = null;

		$pass_captcha = false;

		//enable captcha
		if ($_POST["g_recaptcha_response"] && $_POST["g_recaptcha_response"] != 'no-captcha')
		{
			$reCaptcha = new ReCaptcha(osp_get('poll_settings', 'cactus-poll-secret-key'));
		    $resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g_recaptcha_response"]);
			if ($resp != null && $resp->success)
			{
				$pass_captcha = true;
			}

		}
		else
		{
			$pass_captcha = true;
		}

		if($pass_captcha)
		{
			//get poll by
			if(isset($_POST['poll_id']))
			{
				$selected_value =  isset($_POST['selected_value']) ? $_POST['selected_value'] : -1;

				$poll_key 		=  isset($_POST['poll_key']) ? $_POST['poll_key'] : -1;

				if(md5('cactusthemes' . $_POST['poll_id']) == $poll_key)
				{
					//get poll id from ajax
					$post_id 			= $_POST['poll_id'];

					$vote_frequency = rwmb_meta( 'cactus_poll_vote_frequency_settings',array(), $post_id);

					$display_result_settings = rwmb_meta( 'cactus_poll_display_result_settings',array(), $post_id);

					$answers = rwmb_meta( 'cactus_poll_list_answers',array(), $post_id);

					$number_of_answer = count($answers);

					$poll_result 		= get_post_meta($post_id, 'cactus_poll_result', true);

					$html = '';

					// //first vote
					if(!isset($_COOKIE['poll_id_voted_' . $post_id]))
					{

						//first time
						if($poll_result == '')
						{
							$result_data = array();
							foreach($answers as $index => $value)
							{
								// if enable mutilple choices
								if(is_array($selected_value))
								{
									foreach($selected_value as $sv)
									{
										if($index == $sv)
										{
											$result_data[$index] = 1;
											break;
										}
										else
											$result_data[$index] = 0;
									}
								}
								else
								{
									if($index == $selected_value)
										$result_data[$index] = 1;
									else
										$result_data[$index] = 0;
								}
							}
							if(count($result_data) > 0)
							{
								$result_data_str = implode(',', $result_data);
								add_post_meta($post_id, 'cactus_poll_result', $result_data_str);
							}
						}

						//if database had record
						else
						{
							$result_data 		= explode(',', $poll_result);

							$number_of_result 	= count($result_data);
							$new_result_data 	= array();

							//if add new answer
							if($number_of_result < $number_of_answer)
							{
								foreach($answers as $i => $as)
								{
									if(!isset($result_data[$i]))
										$result_data[$i] = 0;
								}
							}

							foreach($result_data as $index => $value)
							{
								// if enable mutilple choices
								if(is_array($selected_value))
								{
									foreach($selected_value as $sv)
									{
										if($index == $sv)
										{
											$new_result_data[$index] = $value + 1;
											break;
										}
										else
											$new_result_data[$index] = $value;
									}
								}
								else
								{
									if($index == $selected_value)
										$new_result_data[$index] = $value + 1;
									else
										$new_result_data[$index] = $value;
								}
							}
							if(count($new_result_data) > 0)
							{
								$result_data_str = implode(',', $new_result_data);
								update_post_meta($post_id, 'cactus_poll_result', $result_data_str);
							}
						}

						if($vote_frequency == 'only_one_time')
							//save to cookie
							setcookie('poll_id_voted_' . $post_id, $post_id, time()+60*60*24*30, '/');
						else
							setcookie('poll_id_voted_' . $post_id, $post_id, strtotime("tomorrow"), '/');
					}
					else
					{
						if($display_result_settings == 'after_users_voted')
							$html .= '<div class="poll-msg-error" style="padding-top:20px;">' . esc_html__('You\'ve already voted this poll', 'cactus') . '</div>';
						else
							echo 'existed';
					}

					if($display_result_settings == 'after_users_voted')
					{
						$answers = rwmb_meta( 'cactus_poll_list_answers',array(), $post_id);
						$poll_result 	= rwmb_meta('cactus_poll_result', array(), $post_id);
						if($poll_result != '')
						{
							$poll_result_arr = explode(',', $poll_result);
							$total_result = 0;
							foreach($poll_result_arr as $value)
							{
								$total_result += $value;
							}
							$html .= '<div class="poll-result-block">';
							$html .= '<div class="result-title">' . esc_html__('RESULT', 'cactus') . '</div>';
							$html .= '<div class="poll-result">';
							foreach($answers as $index => $answer)
							{
								$result_percent = $total_result != 0 && isset($poll_result_arr[$index]) ? $poll_result_arr[$index] / $total_result * 100 : 0;
								$result = isset($poll_result_arr[$index]) ? $poll_result_arr[$index] : 0;
								$html .='		<div class="poll-result-item">
													<div class="option-item">' . $answer . '<span class="number-of-votes">' . $result . esc_html__(' votes', 'cactus') . ' ( ' . round($result_percent) . '% )</span></div>
													<div class="votes-progress-bar">
														<div class="votes-progress" style="width: ' . $result_percent . '%;"></div>
													</div>
												</div>';
							}
							$html .= '</div>';
							$html .= '</div>';
						}

						echo $html;
					}
				}
			}
		}
	}
}

$cactus_poll = new Cactus_poll();


?>
