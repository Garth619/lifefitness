<?php
class CT_Authors extends WP_Widget {



	function __construct() {
    	$widget_ops = array(
			'classname'   => 'ct_authors_widget', 
			'description' => esc_html__('NewsTube author','cactus')
		);

    	parent::__construct('top_authors', esc_html__('NewsTube Author', 'cactus'), $widget_ops);

	}

	/**
	 * This is the part where the heart of this widget is!
	 * here we get al the authors and count their posts. 
	 *
	 * The frontend function
	 */
	function widget( $args, $instance ) {
		extract( $args );
		
		$title 			= empty($instance['title']) ? '' : $instance['title'];	
		$id 			= empty($instance['id']) ? get_the_author_meta('ID') : $instance['id'];	
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;	
		/*content*/
		//echo get_the_author_meta( 'email', $id );
		?>
		<div class="author-widget-ct">
        	<div class="avatar-author"><?php echo get_avatar( $id, 353 );?></div>
			<?php if(get_the_author_meta( 'description', $id )!=''){ ?><div class="description-author"><?php echo get_the_author_meta( 'description', $id );?></div><?php }?>
            <!--Share-->
            <ul class="social-listing list-inline">
            	<?php if(get_the_author_meta( 'facebook', $id )!=''){ ?>
                <li class="facebook">                                                
                    <a title="Facebook" href="<?php echo get_the_author_meta( 'facebook', $id ); ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>
                </li>
                <?php }?>
                <?php if(get_the_author_meta( 'twitter', $id )!=''){ ?>
                <li class="twitter">                                                
                    <a href="<?php echo get_the_author_meta( 'twitter', $id ); ?>" title="Twitter" rel="nofollow" target="_blank" ><i class="fa fa-twitter"></i></a>
                </li>
                <?php }?>
                <?php if(get_the_author_meta( 'linkedin', $id )!=''){ ?>
                <li class="linkedin">                                                
                    <a href="<?php echo get_the_author_meta( 'linkedin', $id ); ?>" title="LinkedIn" rel="nofollow" target="_blank"><i class="fa fa-linkedin"></i></a>
                </li>
                <?php }?>
                <?php if(get_the_author_meta( 'tumblr', $id )!=''){ ?>
                <li class="tumblr">                                                
                    <a href="<?php echo get_the_author_meta( 'tumblr', $id ); ?>" title="Tumblr" rel="nofollow" target="_blank"><i class="fa fa-tumblr"></i></a>
                </li>
                <?php }?>
                <?php if(get_the_author_meta( 'google', $id )!=''){ ?>
                <li class="google-plus">                                                
                    <a href="<?php echo get_the_author_meta( 'google', $id ); ?>" title="Google Plus" rel="nofollow" target="_blank"><i class="fa fa-google-plus"></i></a>
                </li>
                <?php }?>
                <?php if(get_the_author_meta( 'pinterest', $id )!=''){ ?>
                <li class="pinterest">                                                
                    <a href="<?php echo get_the_author_meta( 'pinterest', $id ); ?>" title="Pinterest" rel="nofollow" target="_blank"><i class="fa fa-pinterest"></i></a>
                </li>
                <?php }?>
                <?php if(get_the_author_meta( 'author_email', $id )!=''){ ?>
                <li class="email">                                                
                    <a href="mailto:<?php echo get_the_author_meta( 'author_email', $id ); ?>" title="Email"><i class="fa fa-envelope-o"></i></a>
                </li>
                <?php }?>
            </ul><!--Share-->
        </div>
        <?php 
		echo $after_widget;
	
	}

	/**
	 * Update the widget settings.
	 *
	 * Backend widget settings
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['id'] = 			strip_tags( $new_instance['id'] );		
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 *
	 * Backend widget options form
	 */
	function form( $instance ) {						
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'id' => '') );
		$title = esc_attr( $instance['title'] );
		$ids = isset($instance['id']) ? esc_attr($instance['id']) : '';
		?>
        
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:','cactus' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p><label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php esc_html_e('ID:', 'cactus'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" value="<?php echo $instance['id']; ?>" />
		</p>
		
	<?php
	}
}




// register  widget
add_action( 'widgets_init', create_function( '', 'return register_widget("CT_Authors");' ) );
?>
