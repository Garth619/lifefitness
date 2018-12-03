<?php
class CT_Recent_Comments extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'ct_recent_comments', 'description' => esc_html__( 'The most recent comments', 'cactus' ) );
		parent::__construct('ct-recent-comments', esc_html__('NewsTube - Recent Comments', 'cactus'), $widget_ops);
		$this->alt_option_name = 'ct_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array($this, 'recent_comments_style') );

		add_action( 'comment_post', array($this, 'flush_widget_cache') );
		add_action( 'edit_comment', array($this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
	}

	function recent_comments_style() {
		if ( ! current_theme_supports( 'widgets' ) // Temp  #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
	<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('ct_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('ct_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		
		$d = get_option( 'date_format' ) ;
		
 		extract($args, EXTR_SKIP);
 		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Comments', 'cactus' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
 			$number = 5;

		$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<div class="cactus-widget-posts widget-comment">';
		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment) {
				$title_post = get_the_title($comment->comment_post_ID);
				
				$output .=  '
					<div class="cactus-widget-posts-item">
						<div class="widget-picture">
							<div class="widget-picture-content">
								<a class="cm-avatar" href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">
									'.get_avatar($comment, 60, '', get_the_author()).'
								</a>
							</div>
						</div>
						<div class="cactus-widget-posts-content">';
							if(get_comment_author_url()==''){
								$output .=  '<div class="posted-on"><span> '. get_comment_author() . '</span></div>';
							}else{
								$output .=  '<div class="posted-on"><a href="'.get_comment_author_url().'" class="author cactus-info">'. get_comment_author() . '</a></div>';
							}
							
							$output .=  '
							<h3 class="h6 widget-posts-title">
								<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' .$title_post. '</a>
							</h3>
						</div>
					</div>';
			}
 		}
		$output .= '</div>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('ct_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['ct_recent_comments']) )
			delete_option('ct_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'cactus' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of comments to show:', 'cactus' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
<?php
	}
}




// register  widget
add_action( 'widgets_init', create_function( '', 'return register_widget("CT_Recent_Comments");' ) );
?>
