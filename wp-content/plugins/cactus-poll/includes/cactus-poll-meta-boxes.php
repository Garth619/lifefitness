<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'polls_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function polls_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'cactus_poll_';


	$meta_boxes[] = array(
		'title' => esc_html__( 'Poll Settings', 'cactus' ),

		'pages' => array('poll' ),

		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'List answers', 'cactus' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}list_answers",
				// Field description (optional)
				'desc'  => esc_html__( 'List answers for Poll', 'cactus' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => true,
			),

			array(
				'name'        => esc_html__( 'Enable multiple choices', 'cactus' ),
				'id'          => "{$prefix}enable_multiple_choices",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'no' => esc_html__( 'No', 'cactus' ),
					'yes' => esc_html__( 'Yes', 'cactus' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'no',
				'placeholder' => __( 'Select an Item', 'cactus' ),
			),

			array(
				'name'        => esc_html__( 'Enable captcha', 'cactus' ),
				'id'          => "{$prefix}enable_captcha",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'yes' => esc_html__( 'Yes', 'cactus' ),
					'no' => esc_html__( 'No', 'cactus' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'yes',
				'placeholder' => __( 'Select an Item', 'cactus' ),
			),

			array(
				'name'        => esc_html__( 'Who can vote', 'cactus' ),
				'id'          => "{$prefix}user_vote_settings",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'all' => esc_html__( 'All visitors', 'cactus' ),
					'only_user' => esc_html__( 'Only logged-in users', 'cactus' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'all',
				'placeholder' => __( 'Select an Item', 'cactus' ),
			),

			array(
				'name'        => esc_html__( 'Vote Limit', 'cactus' ),
				'id'          => "{$prefix}vote_frequency_settings",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'only_one_time' => esc_html__( 'Only 1 time', 'cactus' ),
					'one_time_per_day' => esc_html__( '1 time / day', 'cactus' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'only_one_time',
				'placeholder' => __( 'Select an Item', 'cactus' ),
			),

			//  EXPIRY DATE
			array(
				'name' => esc_html__( 'Expiry date', 'cactus' ),
				'id'   => "{$prefix}expiry_date",
				'type' => 'datetime',

				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => esc_html__( ' (yyyy-mm-dd)', 'cactus' ),
					'dateFormat'      => esc_html__( 'yy-mm-dd', 'cactus' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
					'stepMinute'     => 1,
					'showTimepicker' => true,
				),
			),

			array(
				'name'        => esc_html__( 'Display result settings', 'cactus' ),
				'id'          => "{$prefix}display_result_settings",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'after_users_voted' => esc_html__( 'After users voted', 'cactus' ),
					'poll_expiried' => esc_html__( 'Poll expiried', 'cactus' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'after_users_voted',
				'placeholder' => __( 'Select an Item', 'cactus' ),
			),

		)
	);
	return $meta_boxes;
}


