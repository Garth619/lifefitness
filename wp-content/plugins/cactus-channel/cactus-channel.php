<?php

/*
Plugin Name: Cactus Channel
Description: Cactus Channel
Author: CactusThemes
Version: 1.3.1.1
Author URI: http://cactusthemes.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//include('shortcode/cactus-player.php');
if(!class_exists('Cactus_channel')){
/*translate settings*/
$text_translate_channel_st = esc_html__('General','cactus').esc_html__('Channel slug','cactus').esc_html__('Change single Channel slug. Remember to save the permalink settings again in Settings > Permalinks','cactus').esc_html__('Channel Listing page','cactus').esc_html__('Assign Channels Listing page to a page. Remember to save the permalink settings again in Settings > Permalinks','cactus').esc_html__('Channel Listing layout','cactus').esc_html__('Channel Layout 1','cactus').esc_html__('Channel Layout 2','cactus').esc_html__('Subscribed Channels page - Number of items per channel','cactus');		
class Cactus_channel{
	/* custom template relative url in theme, default is "ct_channel" */
	public $template_url;
	/* Plugin path */
	public $plugin_path;
	
	/* Main query */
	public $query;
	
	public function __construct() {
		// constructor
		$this->includes();
		$this->register_configuration();
		
		add_action( 'init', array($this,'init'), 0);
		add_action( 'template_redirect', array($this,'ct_stop_redirect'), 0);
		add_action( 'after_setup_theme', array(&$this, 'cactus_setup_cn') );
	}
	
	function cactus_setup_cn() {			
		global $cactus_size_array;
		$cactus_size_array = array(			
			'thumb_367x200' => array(367, 200, true, ''), //medium (3) channel listing
			'thumb_560x400' => array(560, 400, true, ''),// channel special - large pic
			//thumb newsfeed
			'thumb_40x40' => array(40, 40, true, ''),	
		);
		do_action( 'cactus_reg_thumbnail', $cactus_size_array);
	}
	
	function ct_stop_redirect(){
		if ( is_singular('ct_channel') ) {
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
	function ct_channel_scripts_styles() {
		global $wp_styles;
		
		/*
		 * Loads our main javascript.
		 */	
		wp_enqueue_script( 'custom',plugins_url('/js/custom.js', __FILE__) , array(), '', true );
	}
	function admin_channel_scripts_styles() {
		global $wp_styles;
			wp_enqueue_style('admin-channel-css',plugins_url('/css/admin-css.css', __FILE__));
	}
	
	function includes(){
		// custom meta boxes
		include_once('channel-functions.php');
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
		global $ct_channel_settings;
		$ct_channel_settings = new Options_Page('ct_channel_settings', array('option_file'=>dirname(__FILE__) . '/options.xml','menu_title'=>esc_html__('Cactus Channel Settings','cactus'),'menu_position'=>null), array('page_title'=>esc_html__('Cactus Channel Setting','cactus'),'submit_text'=>esc_html__('Save','cactus')));
	}
	
	/* Get main options of the plugin. If there are any sub options page, pass Options Page Id to the second args
	 *
	 *
	 */
	function get_option($option_name, $op_id = ''){
		return $GLOBALS[$op_id != ''?$op_id:'ct_channel_settings']->get($option_name);
	}
	
	function init(){
		// Variables
		$this->register_taxonomies();
		$this->template_url			= apply_filters( 'ct_channel_template_url', 'cactus-channel/' );
		add_filter( 'cmb_meta_boxes', array($this,'register_post_type_metadata') );
		add_action( 'admin_init', array( $this, 'social_account_meta' ) );	
		add_filter( 'template_include', array( $this, 'template_loader' ) );
		add_action( 'template_redirect', array($this, 'template_redirect' ) );
		add_action( 'wp_enqueue_scripts', array($this, 'ct_channel_scripts_styles') );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_channel_scripts_styles') );
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
		$find = array('cactus-channel.php');
		$file = '';
		$slug_lis = '';
		$slug_lis =  $this->get_option('channel-lis-slug');
		if(!is_numeric($slug_lis)){
			$slug_lis = 'channels';
		}
		if(is_post_type_archive( 'ct_channel' ) || is_page($slug_lis) || is_tax('ct_channel_cat')){
			$file = 'channel-listing.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;
		}
		elseif(is_singular('ct_channel')){
			$file = 'single-channel.php';
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
		global $ct_channel, $wp_query;
		$slug_cn =  $this->get_option('channel-slug');
		if(is_numeric($slug_cn)){ 
			$slug_cn = get_post($slug_cn);
			$slug_cn = $slug_cn->post_name;
		}
		if($slug_cn==''){
			$slug_cn = 'channel';
		}
		// When default permalinks are enabled, redirect stores page to post type archive url
		if ( ! empty( $_GET['page_id'] ) && get_option( 'permalink_structure' ) == "" && $_GET['page_id'] ==  $slug_cn) {
			wp_safe_redirect( get_post_type_archive_link('ct_channel') );
			exit;
		}
	}
	function register_taxonomies(){
		$this->register_ct_channel();
	}
	
	/* Register ct_channel post type and its custom taxonomies */
	function register_ct_channel(){
		$labels = array(
			'name'               => esc_html__('Channel', 'cactus'),
			'singular_name'      => esc_html__('Channel', 'cactus'),
			'add_new'            => esc_html__('Add New Channel', 'cactus'),
			'add_new_item'       => esc_html__('Add New Channel', 'cactus'),
			'edit_item'          => esc_html__('Edit Channel', 'cactus'),
			'new_item'           => esc_html__('New Channel', 'cactus'),
			'all_items'          => esc_html__('All Channels', 'cactus'),
			'view_item'          => esc_html__('View Channel', 'cactus'),
			'search_items'       => esc_html__('Search Channel', 'cactus'),
			'not_found'          => esc_html__('No Channel found', 'cactus'),
			'not_found_in_trash' => esc_html__('No Channel found in Trash', 'cactus'),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Channel', 'cactus'),
		  );
		$slug_cn =  $this->get_option('channel-slug');
		if(is_numeric($slug_cn)){ 
			$slug_cn = get_post($slug_cn);
			$slug_cn = $slug_cn->post_name;
		}
		if($slug_cn==''){
			$slug_cn = 'channel';
		}
		if ( $slug_cn )
			$rewrite =  array( 'slug' => untrailingslashit( $slug_cn ), 'with_front' => false, 'feeds' => true );
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
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
		  );
		register_post_type( 'ct_channel', $args );
		
		/* Register Channel Categories */
		$ct_channel_cat_labels = array(
			'name'=>'Channel Categories',
			'singular_name'=>'Channel Category'
		);
		$ct_channel_tag_labels = array(
			'name'=>'Channel Tags',
			'singular_name'=>'Channel Tags'
		);
		register_taxonomy('ct_channel_tags', 'ct_channel', array('labels'=>$ct_channel_tag_labels,'meta_box_cb'=>array($this,'ct_channel_type_meta_box_cb')));
		//register_taxonomy('ct_channel_cat', 'ct_channel', array('labels'=>$ct_channel_cat_labels,'show_admin_column'=>true,'hierarchical'=>true,'rewrite'=>array('slug'=>''),'meta_box_cb'=>array($this,'ct_channel_categories_meta_box_cb')));
	}			
	/* Register meta box for Store Type 
	 * Wordpress 3.8
	 */
	function ct_channel_type_meta_box_cb($post, $box){
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
	function ct_channel_categories_meta_box_cb( $post, $box ) {
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
		$channel_fields = array(	
				array( 'id' => 'channel_layout', 'name' => esc_html__('Channel Layout','cactus'), 'type' => 'select', 'options' => array('' => esc_html__('Default','cactus'),'video' => esc_html__('Channel Layout 1','cactus'), 'story' => esc_html__('Channel Layout 2','cactus')),  'desc' => esc_html__('Choose layout for this channel','cactus'), 'repeatable' => false, 'multiple' => false));

		$meta_boxes[] = array(
			'title' => esc_html__('Channel Settings','cactus'),
			'pages' => 'ct_channel',
			'fields' => $channel_fields,
			'priority' => 'high'
		);
		return $meta_boxes;
	}
	function social_account_meta(){
		//option tree
		  $meta_box_review = array(
			'id'        => 'social_acount_box',
			'title'     => esc_html__('Social Account Settings', 'cactus'),
			'desc'      => esc_html__('', 'cactus'),
			'pages'     => array( 'ct_channel' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'facebook',
					  'label'       => esc_html__('Facebook', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel Facebook page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'twitter',
					  'label'       => esc_html__('Twitter', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel Twitter page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'youtube',
					  'label'       => esc_html__('YouTube', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel YouTube page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'linkedin',
					  'label'       => esc_html__('LinkedIn', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel LinkedIn page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'tumblr',
					  'label'       => esc_html__('Tumblr', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel Tumblr page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'google-plus',
					  'label'       => esc_html__('Google Plus', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel Google Plus page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'pinterest',
					  'label'       => esc_html__('Pinterest', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel Pinterest page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'flickr',
					  'label'       => esc_html__('Flickr', 'cactus'),
					  'desc'        => esc_html__('Enter link to channel Flickr page', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'envelope',
					  'label'       => esc_html__('Email', 'cactus'),
					  'desc'        => esc_html__('Enter channel email contact', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  ),
				  array(
					  'id'          => 'rss',
					  'label'       => esc_html__('RSS', 'cactus'),
					  'desc'        => esc_html__('Enter channel site\'s RSS URL', 'cactus' ),
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  )
		  	)
		  );
		  $meta_box_review['fields'][] = array(
				'label'       => esc_html__('Custom Social Account', 'cactus'),
				'id'          => 'custom_social_account',
				'type'        => 'list-item',
				'class'       => '',
				'desc'        => esc_html__('Add more social accounts using Font Awesome Icons', 'cactus'),
				'choices'     => array(),
				'settings'    => array(
					 array(
						'label'       => esc_html__( 'Font Awesome Icons', 'cactus' ),
						'id'          => 'icon_custom_social_account',
						'type'        => 'text',
						'desc'        => esc_html__( 'Enter Font Awesome class (ex: fa-instagram)', 'cactus' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => ''
					 ),
					 array(
						'label'       => esc_html__( 'URL', 'cactus' ),
						'id'          => 'url_custom_social_account',
						'type'        => 'text',
						'desc'        => esc_html__( 'Enter full link to channel social account (including http)', 'cactus' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => ''
					 ),
				)
		  );
		  $meta_box_review['fields'][] = array(
					  'id'          => 'open_social_link_new_tab',
					  'label'       => esc_html__( 'Open Social Link in new tab', 'cactus' ),
					  'desc'        => esc_html__( 'Open link in new tab?', 'cactus' ),
					  'std'         => 'on',
					  'type'        => 'on-off',
					  'class'       => '',
					  'choices'     => array()
				  );
		  if (function_exists('ot_register_meta_box')) {
			ot_register_meta_box( $meta_box_review );
		  }
	}
	
}


} // class_exists check
/**
 * Init Cactus_channel
 */
$GLOBALS['cactus_channel'] = new Cactus_channel();
?>
