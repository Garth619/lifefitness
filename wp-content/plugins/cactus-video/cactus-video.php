<?php

/*
Plugin Name: Cactus Video
Description: Provide Video features
Author: CactusThemes
Version: 1.4.10.3
Author URI: http://www.cactusthemes.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
include('shortcode/cactus-player.php');
if(!class_exists('Cactus_video')){	
$text_translate_video_st = esc_html__('General','cactus').esc_html__('Player for Video File','cactus').esc_html__('JWPlayer','cactus').esc_html__('FlowPlayer','cactus').esc_html__('VideoJS - HTML5 Video Player','cactus').esc_html__('WordPress Native Player: MediaElement','cactus').esc_html__('Force Using VideoJS for external videos','cactus').esc_html__('Yes','cactus').esc_html__('No','cactus').esc_html__('Auto Play Video','cactus').esc_html__('Yes','cactus').esc_html__('No','cactus').esc_html__('Auto Load Next Video','cactus').esc_html__('Yes','cactus').esc_html__('No','cactus').esc_html__('Auto Load Next Video after','cactus').esc_html__('Enter number in seconds. Ex: 5 (seconds)','cactus').esc_html__('Choose Next Video for Auto Load','cactus').esc_html__('Newer Video','cactus').esc_html__('Older Video','cactus').esc_html__('Youtube Settings','cactus').esc_html__('Force Using JWPlayer','cactus').esc_html__('No','cactus').esc_html__('Yes','cactus').esc_html__('Related videos','cactus').esc_html__('Display related videos at the end of the video','cactus').esc_html__('Hide','cactus').esc_html__('Show','cactus').esc_html__('Use HTML5 player','cactus').esc_html__('Use HTML5 player to play YouTube videos','cactus').esc_html__('No','cactus').esc_html__('Yes','cactus').esc_html__('Show Video Info on player','cactus').esc_html__('Show','cactus').esc_html__('Hide','cactus').esc_html__('Remove annotations on video','cactus').esc_html__('Yes','cactus').esc_html__('No','cactus').esc_html__('Force using Embed Code','cactus').esc_html__('No','cactus').esc_html__('Yes','cactus').esc_html__('Allow Full Screen','cactus').esc_html__('Yes','cactus').esc_html__('No','cactus').esc_html__('Allow Networking','cactus').esc_html__('Allow Interactive Videos','cactus').esc_html__('Disable','cactus').esc_html__('Enable','cactus').esc_html__('Playlist settings','cactus').esc_html__('Playlist slug','cactus').esc_html__('Change single playlist slug. Remember to save the permalink settings again in Settings > Permalinks','cactus').esc_html__('Playlists Listing page','cactus').esc_html__('Assign Playlists Listing page to a page. Remember to save the permalink settings again in Settings > Permalinks','cactus');
class Cactus_video{
	/* custom template relative url in theme, default is "ct_video" */
	public $template_url;
	public static $woocommerce;
	/* Plugin path */
	public $plugin_path;
	
	/* Main query */
	public $query;
	
	public function __construct() {
		// constructor
		$this->includes();
		$this->register_configuration();
		
		add_action( 'init', array($this,'init'), 0);
		add_action( 'after_setup_theme', array($this,'includes_after'), 0 );
		add_action( 'template_redirect', array($this,'ct_plstop_redirect'), 0);
	}
	function ct_plstop_redirect(){
		if ( is_singular('ct_playlist') ) {
			global $wp_query;
			$page = (int) $wp_query->get('page');
			if ( $page > 1 ) {
		 		 // convert 'page' to 'paged'
		  		$query->set( 'page', 1 );
		  		$query->set( 'paged', $page );
			}
		// prevent redirect
		remove_action( 'template_redirect', 'redirect_canonical' );
	  }
	  if(is_front_page()){
		  global $wp_query;
		  $page = (int) $wp_query->get('page');
		  if ( $page > 1 ) {
		  	remove_action( 'template_redirect', 'redirect_canonical' );
		  }
	  }
	}
	function ct_video_scripts_styles() {
		global $wp_styles;
		
		/*
		 * Loads our main javascript.
		 */	
		wp_enqueue_script( 'custom',plugins_url('/js/custom.js', __FILE__) , array(), '', true );
	}
	function admin_video_scripts_styles() {
		global $wp_styles;
			wp_enqueue_style('admin-video-css',plugins_url('/css/admin-css.css', __FILE__));
	}
	function includes_after(){
		include_once('video-functions.php');
	}
	function includes(){
		include_once('video-data-functions.php');
		// custom meta boxes
		if(!function_exists('cmb_init')){
			if(!class_exists('CMB_Meta_Box')){
				include_once('includes/Custom-Meta-Boxes-master/custom-meta-boxes.php');
			}
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
		global $ct_video_settings;
		$ct_video_settings = new Options_Page('ct_video_settings', array('option_file'=>dirname(__FILE__) . '/options.xml','menu_title'=>esc_html__('Cactus Video Settings','cactus'),'menu_position'=>null), array('page_title'=>esc_html__('Cactus Video Setting Page','cactus'),'submit_text'=>esc_html__('Save','cactus')));
	}
	
	/* Get main options of the plugin. If there are any sub options page, pass Options Page Id to the second args
	 *
	 *
	 */
	function get_option($option_name, $op_id = ''){
		return $GLOBALS[$op_id != ''?$op_id:'ct_video_settings']->get($option_name);
	}
	
	function init(){
		// Variables
		$this->register_taxonomies();
		$this->template_url			= apply_filters( 'ct_video_template_url', 'cactus-video/' );
		add_filter( 'cmb_meta_boxes', array($this,'register_post_type_metadata') );
		add_filter( 'template_include', array( $this, 'template_loader' ) );
		//add_action( 'template_redirect', array($this, 'template_redirect' ) );
		add_action( 'wp_enqueue_scripts', array($this, 'ct_video_scripts_styles') );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_video_scripts_styles') );
	}	
	/**
	 * Get the plugin path.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_path() {
		if ( $this->plugin_path ) return $this->plugin_path;

		return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
	/**
	 *
	 * Load custom page template for specific pages 
	 *
	 * @return string
	 */
	function template_loader($template){
		$find = array('cactus-video.php');
		$file = '';
		$slug_lis = '';
		$slug_lis =  $this->get_option('playlist-lis-slug');
		if(!is_numeric($slug_lis)){
			$slug_lis = 'playlist';
		}
		if(is_post_type_archive( 'ct_playlist' ) || is_page($slug_lis)){
			$file = 'playlist-listing.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;
		}
		elseif(is_singular('ct_playlist')){
			$file = 'single-playlist.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;
		}
		if ( $file ) {
			$template = locate_template( $find );
			
			if ( ! $template ) $template = $this->plugin_path() . '/templates/' . $file;
		}
		return $template;		
	}
	
	/**
	 * Handle redirects before content is output - hooked into template_redirect so is_page works.
	 *
	 * @access public
	 * @return void
	 */
	function template_redirect(){
		global $ct_video, $wp_query;

		// When default permalinks are enabled, redirect stores page to post type archive url
		if ( ! empty( $_GET['page_id'] ) && get_option( 'permalink_structure' ) == "" && $_GET['page_id'] ==  'video') {
			wp_safe_redirect( get_post_type_archive_link('ct_video') );
			exit;
		}
	}

	function register_taxonomies(){
		$this->register_ct_video();
	}
	/* Register ct_channel post type and its custom taxonomies */
	function register_ct_video(){
				$labels = array(
			'name'               => esc_html__('Playlist', 'cactus'),
			'singular_name'      => esc_html__('Playlist', 'cactus'),
			'add_new'            => esc_html__('Add New Playlist', 'cactus'),
			'add_new_item'       => esc_html__('Add New Playlist', 'cactus'),
			'edit_item'          => esc_html__('Edit Playlist', 'cactus'),
			'new_item'           => esc_html__('New Playlist', 'cactus'),
			'all_items'          => esc_html__('All Playlists', 'cactus'),
			'view_item'          => esc_html__('View Playlist', 'cactus'),
			'search_items'       => esc_html__('Search Playlist', 'cactus'),
			'not_found'          => esc_html__('No Playlist found', 'cactus'),
			'not_found_in_trash' => esc_html__('No Playlist found in Trash', 'cactus'),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Playlist', 'cactus'),
		  );
		$slug_pl =  $this->get_option('playlist-slug');
		if(is_numeric($slug_pl)){ 
			$slug_pl = get_post($slug_pl);
			$slug_pl = $slug_pl->post_name;
		}
		if($slug_pl==''){
			$slug_pl = 'playlist';
		}
		if ( $slug_pl )
			$rewrite =  array( 'slug' => untrailingslashit( $slug_pl ), 'with_front' => false, 'feeds' => true );
		else
			$rewrite = false;

		  $args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => $rewrite,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
		  );
		register_post_type( 'ct_playlist', $args );
	}			
			
	/* Register meta box for Store Type 
	 * Wordpress 3.8
	 */
	function ct_video_type_meta_box_cb($post, $box){
		$defaults = array('taxonomy' => 'post_tag');
		if ( !isset($box['args']) || !is_array($box['args']) )
			$args = array();
		else
			$args = $box['args'];
		extract( wp_parse_args($args, $defaults), EXTR_SKIP );
		$tax_name = esc_attr($taxonomy);
		$taxonomy = get_taxonomy($taxonomy);
		$user_can_assign_terms = current_user_can( $taxonomy->cap->assign_terms );
		$comma = _x( ',', 'tag delimiter' );
		?>
		<div class="tagsdiv" id="<?php echo $tax_name; ?>">
			<div class="jaxtag">
			<div class="nojs-tags hide-if-js">
			<p><?php echo $taxonomy->labels->add_or_remove_items; ?></p>
			<textarea name="<?php echo "tax_input[$tax_name]"; ?>" rows="3" cols="20" class="the-tags" id="tax-input-<?php echo $tax_name; ?>" <?php disabled( ! $user_can_assign_terms ); ?>><?php echo str_replace( ',', $comma . ' ', get_terms_to_edit( $post->ID, $tax_name ) ); // textarea_escaped by esc_attr() ?></textarea></div>
			<?php if ( $user_can_assign_terms ) : ?>
			<div class="ajaxtag hide-if-no-js">
				<label class="screen-reader-text" for="new-tag-<?php echo $tax_name; ?>"><?php echo $box['title']; ?></label>
				<div class="taghint"><?php echo $taxonomy->labels->add_new_item; ?></div>
				<p><input type="text" id="new-tag-<?php echo $tax_name; ?>" name="newtag[<?php echo $tax_name; ?>]" class="newtag form-input-tip" size="16" autocomplete="off" value="" />
				<input type="button" class="button tagadd" value="<?php esc_attr_e('Add'); ?>" /></p>
			</div>
			<p class="howto"><?php echo $taxonomy->labels->separate_items_with_commas; ?></p>
			<?php endif; ?>
			</div>
			<div class="tagchecklist"></div>
		</div>
		<?php if ( $user_can_assign_terms ) : ?>
		<p class="hide-if-no-js"><a href="#titlediv" class="tagcloud-link" id="link-<?php echo $tax_name; ?>"><?php echo $taxonomy->labels->choose_from_most_used; ?></a></p>
		<?php endif; ?>
		<?php
	}
	
	/**
	 * Display post categories form fields.
	 *
	 * @since 2.6.0
	 *
	 * @param object $post
	 */
	function ct_video_categories_meta_box_cb( $post, $box ) {
	$defaults = array('taxonomy' => 'category');
	if ( !isset($box['args']) || !is_array($box['args']) )
		$args = array();
	else
		$args = $box['args'];
	extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	$tax = get_taxonomy($taxonomy);

	?>
	<div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
		<ul id="<?php echo $taxonomy; ?>-tabs" class="category-tabs">
			<li class="tabs"><a href="#<?php echo $taxonomy; ?>-all"><?php echo $tax->labels->all_items; ?></a></li>
			<li class="hide-if-no-js"><a href="#<?php echo $taxonomy; ?>-pop"><?php _e( 'Most Used' ); ?></a></li>
		</ul>

		<div id="<?php echo $taxonomy; ?>-pop" class="tabs-panel" style="display: none;">
			<ul id="<?php echo $taxonomy; ?>checklist-pop" class="categorychecklist form-no-clear" >
				<?php $popular_ids = wp_popular_terms_checklist($taxonomy); ?>
			</ul>
		</div>

		<div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
			<?php
            $name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
			<ul id="<?php echo $taxonomy; ?>checklist" data-wp-lists="list:<?php echo $taxonomy?>" class="categorychecklist form-no-clear">
				<?php wp_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
			</ul>
		</div>
	<?php if ( current_user_can($tax->cap->edit_terms) ) : ?>
			<div id="<?php echo $taxonomy; ?>-adder" class="wp-hidden-children">
				<h4>
					<a id="<?php echo $taxonomy; ?>-add-toggle" href="#<?php echo $taxonomy; ?>-add" class="hide-if-no-js">
						<?php
							/* translators: %s: add new taxonomy label */
							printf( __( '+ %s' ), $tax->labels->add_new_item );
						?>
					</a>
				</h4>
				<p id="<?php echo $taxonomy; ?>-add" class="category-add wp-hidden-child">
					<label class="screen-reader-text" for="new<?php echo $taxonomy; ?>"><?php echo $tax->labels->add_new_item; ?></label>
					<input type="text" name="new<?php echo $taxonomy; ?>" id="new<?php echo $taxonomy; ?>" class="form-required form-input-tip" value="<?php echo esc_attr( $tax->labels->new_item_name ); ?>" aria-required="true"/>
					<label class="screen-reader-text" for="new<?php echo $taxonomy; ?>_parent">
						<?php echo $tax->labels->parent_item_colon; ?>
					</label>
					<?php wp_dropdown_categories( array( 'taxonomy' => $taxonomy, 'hide_empty' => 0, 'name' => 'new'.$taxonomy.'_parent', 'orderby' => 'name', 'hierarchical' => 1, 'show_option_none' => '&mdash; ' . $tax->labels->parent_item . ' &mdash;' ) ); ?>
					<input type="button" id="<?php echo $taxonomy; ?>-add-submit" data-wp-lists="add:<?php echo $taxonomy ?>checklist:<?php echo $taxonomy ?>-add" class="button category-add-submit" value="<?php echo esc_attr( $tax->labels->add_new_item ); ?>" />
					<?php wp_nonce_field( 'add-'.$taxonomy, '_ajax_nonce-add-'.$taxonomy, false ); ?>
					<span id="<?php echo $taxonomy; ?>-ajax-response"></span>
				</p>
			</div>
		<?php endif; ?>
	</div>
	<?php

}
	
	function register_post_type_metadata(array $meta_boxes){
		// register aff store metadata
		$video_fields = array(	
				array( 'id' => 'tm_video_url', 'name' => esc_html__( 'Video URL','cactus'), 'type' => 'text','desc' => wp_kses(__( 'Paste the url from popular video sites like YouTube or Vimeo. For example: <br/><code>http://www.youtube.com/watch?v=nTDNLUzjkpg</code><br/>or<br/><code>http://vimeo.com/23079092</code>','cactus'),array('br'=>array()),array('code'=>array())),  'repeatable' => false, 'multiple' => false ),	
				array( 'id' => 'tm_video_file', 'name' => esc_html__('Video File','cactus'), 'type' => 'textarea', 'desc' => wp_kses(__( 'Paste your video file url to here. Supported Video Formats: mp4, m4v, webmv, webm, ogv and flv.<br/><b>About Cross-platform and Cross-browser Support</b><br/>If you want your video works in all platforms and browsers(HTML5 and Flash), you should provide various video formats for same video, if the video files are ready, enter one url per line.<br/> For Example:<br/> <code>http://yousite.com/sample-video.m4v</code><br/><code>http://yousite.com/sample-video.ogv</code><br/> <b>Recommended Format Solution:</b> webmv + m4v + ogv. ','cactus'),array('br'=>array()),array('b'=>array()),array('code'=>array())),  'repeatable' => false, 'multiple' => false ),	
				array( 'id' => 'tm_video_code', 'name' => esc_html__('Video Embeded Code'), 'type' => 'textarea', 'desc' => wp_kses(__( 'Paste the raw video code to here, such as <code>&lt;</code><code>object</code><code>&gt;</code>,<code>&lt;</code><code>embed</code><code>&gt;</code> or <code>&lt;</code><code>iframe</code><code>&gt;</code> code.','cactus'),array('br'=>array()),array('b'=>array()),array('code'=>array())),  'repeatable' => false, 'multiple' => false ),	
				array( 'id' => 'time_video', 'name' => esc_html__('Duration'), 'type' => 'text',  'repeatable' => false, 'multiple' => false ),
			);

		$meta_boxes[] = array(
			'title' => esc_html__('Video settings','cactus'),
			'pages' => 'post',
			'fields' => $video_fields,
			'priority' => 'high'
		);	
		$playlogic_fields = array(	
				array( 'id' => 'player_logic', 'name' => esc_html__( 'Player logic','cactus'), 'type' => 'text','desc' => wp_kses(__( 'Enter shortcode (ex: [my_shortcode][player][/my_shortcode], <strong>[player]</strong> is required)<br>or condition function (ex: <b>is_user_logged_in() && is_sticky()</b> ) to control video player visiblitily','cactus'),array('br'=>array()),array('strong'=>array()),array('code'=>array())) ,  'repeatable' => false, 'multiple' => false ),	
				array( 'id' => 'player_logic_alt', 'name' => esc_html__('Alternative Content'), 'type' => 'text', 'desc' => esc_html__( 'Content to display when Condition is false (Not work with Shortcodes)','cactus') ,  'repeatable' => false, 'multiple' => false ),
			);
		$meta_boxes[] = array(
			'title' => esc_html__('Player Logic','cactus'),
			'pages' => 'post',
			'fields' => $playlogic_fields,
			'priority' => 'high'
		);
		if(class_exists('cactus_channel')){
			$channel_fields = array(	
					array( 'id' => 'channel_id', 'name' => esc_html__('Channel','cactus'), 'type' => 'post_select', 'use_ajax' => true, 'query' => array( 'post_type' => 'ct_channel' ), 'multiple' => true,  'desc' => esc_html__('Add this video to a channel'),  'repeatable' => false),
			);
	
			$meta_boxes[] = array(
				'title' => esc_html__('Cactus - Channel','cactus'),
				'pages' => 'post',
				'fields' => $channel_fields,
				'priority' => 'high'
			);	
		}
		// Plays list meta
		$playlist_channel = array(	
				array( 'id' => 'playlist_channel_id', 'name' => esc_html__('Channel','cactus'), 'type' => 'post_select', 'use_ajax' => true, 'query' => array( 'post_type' => 'ct_channel' ), 'multiple' => true,  'desc' => esc_html__('Add this playlist to a channel') , 'repeatable' => false ),
		);
		$meta_boxes[] = array(
			'title' => esc_html__('Cactus - Channel','cactus'),
			'pages' => 'ct_playlist',
			'fields' => $playlist_channel,
			'priority' => 'high'
		);
		
		$playlist_id = array(	
				array( 'id' => 'playlist_id', 'name' => esc_html__('Playlist','cactus'), 'type' => 'post_select', 'use_ajax' => true, 'query' => array( 'post_type' => 'ct_playlist' ), 'multiple' => true,  'desc' => esc_html__('Add this video to a playlist'),  'repeatable' => false),
		);

		$meta_boxes[] = array(
			'title' => esc_html__('Cactus - PlayList','cactus'),
			'pages' => 'post',
			'fields' => $playlist_id,
			'priority' => 'high'
		);
		return $meta_boxes;
	}
}


} // class_exists check
if ( ! function_exists( 'ct_video_get_page_id' ) ) {

	/**
	 * Affiliatez page IDs
	 *
	 * retrieve page ids - used for myaccount, edit_address, change_password, shop, cart, checkout, pay, view_order, thanks, terms
	 *
	 * returns -1 if no page is found
	 *
	 * @access public
	 * @param string $page
	 * @return int
	 */
	 /* function ct_video_get_page_id( $page ) {
		  global $affiliatez;
		  $page = apply_filters('affiliatez_get_' . $page . '_page_id', $affiliatez->get_option($page . '-page-id'));
		  return ( $page ) ? $page : -1;
	  }*/
}

/**
 * Init Cactus_video
 */
$GLOBALS['cactus_video'] = new Cactus_video();
?>
