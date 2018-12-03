<?php
/**
 * cactus functions and definitions
 *
 * @package cactus
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 900; /* pixels */
}

global $_theme_required_plugins;

/* Define list of recommended and required plugins */
$_theme_required_plugins = array(
		array(
            'name'      => 'Option Tree',
            'slug'      => 'option-tree',
            'required'  => true
        ),
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        ),
		array(
            'name'      => 'BAW Post Views Count',
            'slug'      => 'baw-post-views-count',
            'required'  => false
        ),
		array(
            'name'      => 'Really Simple CAPTCHA',
            'slug'      => 'really-simple-captcha',
            'required'  => false
        ),
		array(
            'name'      => 'WTI Like Post',
            'slug'      => 'wti-like-post',
            'required'  => false
        ),
		array(
            'name'      => 'Yet Another Related Posts Plugin',
            'slug'      => 'yet-another-related-posts-plugin',
            'required'  => false
        ),
		array(
            'name'      => 'W3 Total Cache',
            'slug'      => 'w3-total-cache',
            'required'  => false
        ),
		array(
			'name'		=> 'Black Studio TinyMCE Widget',
			'slug'		=> 'black-studio-tinymce-widget',
			'required'	=> false
		),
		array(
			'name'		=> 'Widget Logic',
			'slug'		=> 'widget-logic',
			'required'	=> false
		),
		array(
              'name'    => 'NewsTube - Shortcodes',
              'slug'    => 'newstube-shortcodes',
              'source'  => get_template_directory() . '/inc/plugins/plugins/newstube-shortcodes.zip',
              'required'=> true,
			  'version' => '1.4.12'
        ),
		array(
              'name'    => 'Cactus Video',
              'slug'    => 'cactus-video',
              'source'  => get_template_directory() . '/inc/plugins/plugins/cactus-video.zip',
              'required'=> false,
			  'version' => '1.4.10.3'
        ),
		array(
              'name'    => 'Cactus Channel',
              'slug'    => 'cactus-channel',
              'source'  => get_template_directory() . '/inc/plugins/plugins/cactus-channel.zip',
              'required'=> false,
			  'version' => '1.3.1.1'
        ),
		array(
              'name'    => 'Cactus Rating',
              'slug'    => 'cactus-rating',
              'source'  => get_template_directory() . '/inc/plugins/plugins/cactus-rating.zip',
              'required'=> false,
			  'version' => '1.2.0.2'
        ),
		array(
              'name'    => 'Cactus Poll',
              'slug'    => 'cactus-poll',
              'source'  => get_template_directory() . '/inc/plugins/plugins/cactus-poll.zip',
              'required'=> false,
			  'version' => '1.2.2.6'
        ),
		array(
              'name'    => 'Cactus Ads',
              'slug'    => 'cactus-ads',
              'source'  => get_template_directory() . '/inc/plugins/plugins/cactus-ads.zip',
              'required'=> false,
			  'version' => '2.5.4.4'
        ),
		array(
                'name'     => 'WPBakery Visual Composer',
                'slug'     => 'js_composer',
				'source'  => get_template_directory() . '/inc/plugins/plugins/js_composer.zip',
                'required' => true,
				'version' => '5.5.2'
            )
    );
	
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); //for check plugin status


/**
 * Core features
 */
require get_template_directory() . '/inc/core/cactus-core.php';

/**
 * Data functions
 */
require get_template_directory() . '/inc/core/data-functions.php';

/**
 * Uncomment below line in Release mode. theme-options.php is generated using Export feature in Option Tree
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Welcome page
 */
require get_template_directory() . '/inc/welcome.php';

/**
 * Add metadata (meta-boxes) for all post types
 */
require get_template_directory() . '/inc/metadata.php';

/**
 * Require Megamenu
 */
require get_template_directory() . '/inc/megamenu/megamenu.php';

/**
 * Add metadata for categories
 */
require get_template_directory() . '/inc/category-metadata.php';

/**
 * Require Widgets
 */
require get_template_directory() . '/inc/widgets/widgets_theme.php';

require get_template_directory() . '/inc/author-metadata.php';

require get_template_directory() . '/inc/shortcodes.php';

if ( ! function_exists( 'cactus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cactus_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cactus, use a find and replace
	 * to change 'cactus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cactus', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'cactus' ),
        'top-menu' => esc_html__( 'Top Nav Menu', 'cactus' ),
        'footer-menu' => esc_html__( 'Footer Menu', 'cactus' ),
		'user-menu' => esc_html__( 'Logged In User Menu', 'cactus' ),

	) );

	add_theme_support('title-tag');
	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cactus_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	// Woocommerce support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

	/**
	 * Add Thumbnail Sizes
	 */
	global $cactus_size_array;
	if(!$cactus_size_array) $cactus_size_array = array();
	$cactus_size_array_theme = array(
		
		'thumb_800x360' => array(800, 360, true, array('thumb_390x215','thumb_800x360','thumb_800x360','thumb_800x360')), //list large (5,6, feature post)
		'thumb_390x260' => array(390, 260, true, ''), //medium (2)
		'thumb_390x215' => array(390, 215, true, ''), //medium (3)
		'thumb_396x325' => array(396, 325, true, ''), //medium (4)
		'thumb_288x190' => array(288, 190, true, ''), //small (1,7)		
		//'thumb_176x130' => array(200, 150, true, ''), //widget popular posts
        'thumb_megamenu' => array(268, 148, true, ''), //Image preview mode Megamenu
		'thumb_253x189' => array(253, 189, true, ''),
		'thumb_103x68' => array(103, 68, true, array('thumb_103x68','thumb_103x68','thumb_103x68','thumb_288x190')), //small 2, widget
	);
	$cactus_size_array = array_merge($cactus_size_array, $cactus_size_array_theme);
	do_action( 'cactus_reg_thumbnail', $cactus_size_array );
	/*remove WTI*/
	remove_filter('the_content', 'PutWtiLikePost');
}
endif; // cactus_setup
add_action( 'after_setup_theme', 'cactus_setup' );

add_action( 'init', 'remove_featured_images_from_page', 11 ); 
function remove_featured_images_from_page() {
    add_theme_support( 'post-thumbnails', array( 'post','ct_playlist','ct_channel','product' ) );
}
/*Woocommerce column*/
add_filter( 'woocommerce_output_related_products_args', 'ct_related_products_args' );
  function ct_related_products_args( $args ) {

	$args['posts_per_page'] = 3; // 3 related products
	return $args;
}

add_action( 'init', 'ct_woocommerce_image_dimensions', 1 );
/**
 * Define image sizes
 */
function ct_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '370',	// px
		'height'	=> '370',	// px
		'crop'		=> 1 		// true
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
}
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cactus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'cactus' ),
		'id'            => 'main-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget col-md-12 module widget-col %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2 class="widget-title h6">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Headline Sidebar', 'cactus' ),
		'id'            => 'headline-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget col-md-12 nav navbar-nav navbar-left cactus-headline rps-hidden module widget-col %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2 class="widget-title h6">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'User Submit Video Sidebar', 'cactus' ),
		'id' => 'user_submit_sidebar',
		'description' => esc_html__( 'Sidebar in popup User submit video', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="user-submit"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h6">',
		'after_title' => '</h2>',
	));
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'cactus' ),
		'id'            => 'footer-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget col-md-3 module widget-col %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2 class="widget-title h6">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Main Top Sidebar', 'cactus' ),
		'id'            => 'main-top-sidebar',
		'description'   => esc_html__('Top of page (Under Header)','cactus'),
		'before_widget' => '<div id="%1$s" class="body-widget %2$s"><div class="body-widget-inner">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="body-widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Main Bottom Sidebar', 'cactus' ),
		'id'            => 'main-bottom-sidebar',
		'description'   => esc_html__( 'Bottom of page (Above Footer)','cactus' ),
		'before_widget' => '<div id="%1$s" class="body-widget %2$s"><div class="body-widget-inner">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="body-widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Body Top Sidebar', 'cactus' ),
		'id'            => 'content-top-sidebar',
		'description'   => esc_html__('Top of content','cactus'),
		'before_widget' => '<div id="%1$s" class="body-widget %2$s"><div class="body-widget-inner">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="body-widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Body Bottom Sidebar', 'cactus' ),
		'id'            => 'content-bottom-sidebar',
		'description'   => esc_html__('Bottom of content','cactus'),
		'before_widget' => '<div id="%1$s" class="body-widget %2$s"><div class="body-widget-inner">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="body-widget-title">',
		'after_title'   => '</h4>',
	) );
	if (class_exists('Woocommerce')) {
	register_sidebar( array(
		'name' => esc_html__( 'WooCommerce Sidebar', 'cactus' ),
		'id' => 'woocommerce_sidebar',
		'description' => esc_html__( '', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget col-md-12 module widget-col %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2 class="widget-title h6">',
		'after_title'   => '</h2>',
	));
	}
}
add_action( 'widgets_init', 'cactus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cactus_scripts() {
	/*remove accesspress social*/
		wp_dequeue_style('apss-font-awesome');
		wp_dequeue_style('apss-font-opensans');
		wp_dequeue_style('apsc-font-awesome');
	/*remove accesspress social*/

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/fonts/css/font-awesome.min.css', array(), '4.3.0');
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/swiper/idangerous.swiper.css');
	if ( is_single() ) {
		wp_enqueue_style( 'malihu-scroll', get_template_directory_uri() . '/js/malihu-scroll/jquery.mCustomScrollbar.min.css');
	}
	wp_enqueue_style( 'cactus-style', get_stylesheet_uri() );
	if (class_exists('Woocommerce')) {
		wp_enqueue_style( 'newstube-woocommrce', get_template_directory_uri() . '/css/newstube-woocommerce.css');
	}

	/**
	 * Register Google Font
	 */
	$g_fonts = array('Open+Sans:400,800,400italic,800italic');

	$google_font = ot_get_option('google_font', 'on');
	if($google_font == 'on'){
		
		$body_font = ot_get_option('main_font_family',''); // for example, Playfair+Display:900
		if($body_font != '' && $body_font != 'Open Sans:400,800,400italic,800italic')
		{
			$font_name = get_google_font_name($body_font);
			array_push($g_fonts, $body_font);
		}

		$heading_font = ot_get_option('heading_font_family', ''); // for example, Playfair+Display:900
		if($heading_font != '' && $heading_font != 'Open Sans:400,800,400italic,800italic')
		{
			$heading_font_name = get_google_font_name($heading_font);
			array_push($g_fonts, $heading_font_name);
		}
		
		$navigation_font = ot_get_option('navigation_font_family', ''); // for example, Playfair+Display:900
		if($navigation_font != ''  && $navigation_font != 'Open Sans:400,800,400italic,800italic')
		{
			$navigation_font_name = get_google_font_name($navigation_font);
			array_push($g_fonts, $navigation_font_name);
		}
	}
	//google font off
	else
	{
		array_push($g_fonts, 'Open Sans:400,800,400italic,800italic');
	}
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=' . implode('|', $g_fonts) );

	/**
	 * Right To Left CSS
	 */
	if(ot_get_option('rtl') == 'on'){
		wp_enqueue_style( 'rtl', get_template_directory_uri() . '/rtl.css');
	}

	wp_enqueue_script( 'jquery'); // use default jQuery packed inside WordPress. If newer version is needed, this should be dequeue and enqueue again
	
	$smoothScroll = ot_get_option('scroll_effect', 'off');
	if($smoothScroll=='on') {
		wp_enqueue_script( 'ct_smoothScroll', get_template_directory_uri() . '/js/smoothscroll.js', array(), '1.3.1', false );
	}
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.1.1', true );

	wp_enqueue_script( 'jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', array(), '1.2.1', true );

	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper/swiper.jquery.min.js', array('jquery'), '3.4.2', true );

	if ( is_single() || is_page()) {
		wp_enqueue_script( 'imagesloaded' );
	}
	
	if ( is_single()) {
		wp_enqueue_script( 'malihu-scroll', get_template_directory_uri() . '/js/malihu-scroll/jquery.mCustomScrollbar.concat.min.js', array(), '3.1.12', true );		
		wp_enqueue_script( 'jquery.ba-throttle-debounce', get_template_directory_uri() . '/js/jquery.ba-throttle-debounce.min.js', array('jquery'), '', true );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// code to embed the java script file that makes the Ajax request
	wp_enqueue_script( 'ajax-request', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ) );

	// main theme javascript code
	wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/template.js', array( 'jquery' ), '', true  );

	// code to declare the URL to the file handling the AJAX request <p></p>
	$js_params = array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
	global $wp_query, $wp;
	$js_params['query_vars'] = $wp_query->query_vars;
	$js_params['current_url'] =  home_url($wp->request);

	$scroll_to_next_post = get_post_meta(get_the_ID(),'enable_scroll_to_next_post',true) != '' ? get_post_meta(get_the_ID(),'enable_scroll_to_next_post',true) : ot_get_option('single_post_scroll_next','off');
	if($scroll_to_next_post == 'on')
	{
		if(ot_get_option('single_post_scroll_next_change_url','on') == 'on'){
			$js_params['scroll_effect_change_url'] = 1;
		}
	}

	wp_localize_script( 'ajax-request', 'cactus', $js_params  );


}
add_action( 'wp_enqueue_scripts', 'cactus_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom WP Footer
 */
add_action('wp_footer','cactus_wp_foot',100);
if(!function_exists('cactus_wp_foot')){
	function cactus_wp_foot(){
		// write out custom code
		$custom_code = ot_get_option('custom_code','');
		echo $custom_code;
	}
}


add_action('wp_head','cactus_wp_head',100);
if(!function_exists('cactus_wp_head')){
	function cactus_wp_head(){
		echo '<!-- custom css -->
				<style type="text/css">';

		require get_template_directory() . '/css/custom.css.php';

		echo '</style>
			<!-- end custom css -->';
	}
}

/*
 * Get label of an option in Option Tree / Theme Options
 */
function get_setting_label_by_id( $id ) {
  if ( empty( $id ) )
    return false;
  $settings = get_option( 'option_tree_settings' );
  if ( empty( $settings['settings'] ) )
    return false;
  foreach( $settings['settings'] as $setting ) {
    if ( $setting['id'] == $id && isset( $setting['label'] ) ) {
      return $setting['label'];
    }
  }
}

/**
 * Print out social accounts link.
 */
if(!function_exists('cactus_print_social_accounts')){
	function cactus_print_social_accounts(){
		/* below are default supported social networks. To support more, add the name of theme option in the array */
		$accounts = array('facebook','youtube','twitter','linkedin','tumblr','google-plus','pinterest','flickr','envelope','rss');
		$target = ot_get_option('open_social_link_new_tab', 'on') == 'on' ? '_blank' : '_parent';
		/* this HTML uses Font Awesome icons */
		?>
		<ul class='nav navbar-nav navbar-right social-listing list-inline social-accounts'>
		<?php
		foreach($accounts as $account){
			$url = ot_get_option($account,'');
			$label = get_setting_label_by_id($account);
			if($url){
				if($account == 'envelope'){
					// this is email account, so use mailto protocol
					$url = 'mailto:' . $url;
				}
			?>
				<li class="<?php echo $account; ?>"><a <?php echo ($account == 'envelope' ? '' : "target='" . $target . "'");?> href="<?php echo $url;?>" title='<?php echo $label;?>'><i class="fa fa-<?php echo $account;?>"></i></a></li>
			<?php }?>
			<?php
		}
		?>
        <?php
			// Custom Social Account
			$custom_social_accounts = ot_get_option('custom_social_account','');
			if( $custom_social_accounts ):
				foreach ($custom_social_accounts as $custom_social_account):?>
					<li  class="<?php echo 'custom-'.$custom_social_account['icon_custom_social_account']; ?>"><a href="<?php echo $custom_social_account["url_custom_social_account"];?>" title='<?php echo $custom_social_account["title"];?>' <?php echo 'target="'. $target . '"'; ?>><i class="fa <?php echo $custom_social_account["icon_custom_social_account"];?>"></i></a></li>
				<?php endforeach;
			endif;
		?>
		</ul>
		<?php
	}
}

/**
 * Print out channel social accounts link.
 */
if(!function_exists('cactus_print_channel_social_accounts')){
	function cactus_print_channel_social_accounts($class_css = false, $id = false){
		/* below are default supported social networks. To support more, add the name of theme option in the array */
		$accounts = array('facebook','youtube','twitter','linkedin','tumblr','google-plus','pinterest','flickr','envelope','rss');
		$target ='_blank';
		if(get_post_meta(get_the_ID(),'open_social_link_new_tab',true) == 'off'){ $target =  '_parent';}
		/* this HTML uses Font Awesome icons */
		?>
		<ul class='social-listing list-inline <?php if(isset($class_css)){ echo $class_css;} ?>'>
		<?php
		foreach($accounts as $account){
			$url = '';
			$url = get_post_meta(get_the_ID(),$account,true);
			$label = get_setting_label_by_id($account);
			if($url){
				if($account == 'envelope'){
					// this is email account, so use mailto protocol
					$url = 'mailto:' . $url;
				}
			?>
				<li class="<?php echo $account; ?>"><a <?php echo ($account == 'envelope' ? '' : "target='" . $target . "'");?> href="<?php echo $url;?>" title='<?php echo $label;?>'><i class="fa fa-<?php echo $account;?>"></i></a></li>
			<?php }?>
			<?php
		}
		?>
        <?php
			// Custom Social Account
			$custom_social_accounts = get_post_meta(get_the_ID(),'custom_social_account',true);
			if( $custom_social_accounts ):
				foreach ($custom_social_accounts as $custom_social_account):?>
					<li  class="<?php echo 'custom-'.$custom_social_account['icon_custom_social_account']; ?>"><a href="<?php echo $custom_social_account["url_custom_social_account"];?>" title='<?php echo $custom_social_account["title"];?>' <?php echo 'target="'. $target . '"'; ?>><i class="fa <?php echo $custom_social_account["icon_custom_social_account"];?>"></i></a></li>
				<?php endforeach;
			endif;
		?>
		</ul>
		<?php
	}
}


/**
 * Display Social Share buttons for FaceBook, Twitter, LinkedIn, Google+, Thumblr, Pinterest, Email
 */
if(!function_exists('cactus_print_social_share')){
function cactus_print_social_share($class_css = false, $id = false){
	if(!$id){
		$id = get_the_ID();
	}
?>
		<ul class="social-listing list-inline <?php if(isset($class_css)){ echo $class_css;} ?>">
	  		<?php if(ot_get_option('sharing_facebook')!='off'){ ?>
		  		<li class="facebook">
		  		 	<a class="trasition-all" title="<?php esc_html_e('Share on Facebook','cactus');?>" href="#" target="_blank" rel="nofollow" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+'<?php echo urlencode(get_permalink($id)); ?>','facebook-share-dialog','width=626,height=436');return false;"><i class="fa fa-facebook"></i>
		  		 	</a>
		  		</li>
	    	<?php }

			if(ot_get_option('sharing_twitter')!='off'){ ?>
		    	<li class="twitter">
			    	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Twitter','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;url=<?php echo urlencode(get_permalink($id)); ?>','twitter-share-dialog','width=626,height=436');return false;"><i class="fa fa-twitter"></i>
			    	</a>
		    	</li>
	    	<?php }

			if(ot_get_option('sharing_linkedIn')!='off'){ ?>
				   	<li class="linkedin">
				   	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on LinkedIn','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink($id)); ?>&amp;title=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;source=<?php echo urlencode(get_bloginfo('name')); ?>','linkedin-share-dialog','width=626,height=436');return false;"><i class="fa fa-linkedin"></i>
				   	 	</a>
				   	</li>
		   	<?php }

			if(ot_get_option('sharing_tumblr')!='off'){ ?>
			   	<li class="tumblr">
			   	   <a class="trasition-all" href="#" title="<?php esc_html_e('Share on Tumblr','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink($id)); ?>&amp;name=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>','tumblr-share-dialog','width=626,height=436');return false;"><i class="fa fa-tumblr"></i>
			   	   </a>
			   	</li>
	    	<?php }

			if(ot_get_option('sharing_google')!='off'){ ?>
		    	 <li class="google-plus">
		    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Google Plus','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode(get_permalink($id)); ?>','googleplus-share-dialog','width=626,height=436');return false;"><i class="fa fa-google-plus"></i>
		    	 	</a>
		    	 </li>
	    	 <?php }

			 if(ot_get_option('sharing_pinterest')!='off'){ ?>
		    	 <li class="pinterest">
		    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Pin this','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('//pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($id)) ?>&amp;media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id($id))); ?>&amp;description=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>','pin-share-dialog','width=626,height=436');return false;"><i class="fa fa-pinterest"></i>
		    	 	</a>
		    	 </li>
	    	 <?php }
			 
			 if(ot_get_option('sharing_vk')!='off'){ ?>
		    	 <li class="vk">
		    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on VK','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('//vkontakte.ru/share.php?url=<?php echo urlencode(get_permalink(get_the_ID())); ?>','vk-share-dialog','width=626,height=436');return false;"><i class="fa fa-vk"></i>
		    	 	</a>
		    	 </li>
	    	 <?php }

			 if(ot_get_option('sharing_email')!='off'){ ?>
		    	<li class="email">
			    	<a class="trasition-all" href="mailto:?subject=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;body=<?php echo urlencode(get_permalink($id)) ?>" title="<?php esc_html_e('Email this','cactus');?>"><i class="fa fa-envelope"></i>
			    	</a>
			   	</li>
		   	<?php }?>
	    </ul>
        <?php
	}
}

/**
 * Ajax page navigation
 */

// when the request action is 'load_more', the cactus_ajax_load_next_page() will be called
add_action( 'wp_ajax_load_more', 'cactus_ajax_load_next_page' );
add_action( 'wp_ajax_nopriv_load_more', 'cactus_ajax_load_next_page' );

function cactus_ajax_load_next_page() {
	//get blog listing style
	global $blog_layout;

	$test_layout = isset($_POST['blog_layout']) ? $_POST['blog_layout'] : '';

	if(isset($test_layout) && $test_layout != '' && ($test_layout == 'layout_1' || $test_layout == 'layout_2' || $test_layout == 'layout_3' || $test_layout == 'layout_4' || $test_layout == 'layout_5' || $test_layout == 'layout_6' || $test_layout == 'layout_7'))
	    $blog_layout = $test_layout;
	else
	    $blog_layout = ot_get_option('blog_layout', 'layout_1');


    // Get current page
	$page = $_POST['page'];

	// number of published sticky posts
	$sticky_posts = get_sticky_posts_count();

	// current query vars
	$vars = $_POST['vars'];

	// convert string value into corresponding data types
	foreach($vars as $key=>$value){
		if(is_numeric($value)) $vars[$key] = intval($value);
		if($value == 'false') $vars[$key] = false;
		if($value == 'true') $vars[$key] = true;
	}

	// item template file
	$template = $_POST['template'];

	// Return next page
	$page = intval($page) + 1;

	$posts_per_page = isset($vars['posts_per_page']) ? $vars['posts_per_page'] : get_option('posts_per_page');

	if($page == 0) $page = 1;
	$offset = ($page - 1) * $posts_per_page;
	/*
	 * This is confusing. Just leave it here to later reference
	 *

	 *
	 */


	// get more posts per page than necessary to detect if there are more posts
	$args = array('post_status'=>'publish','posts_per_page' => $posts_per_page + 1,'offset' => $offset);
	$args = array_merge($vars,$args);

	// remove unnecessary variables
	unset($args['paged']);
	unset($args['p']);
	unset($args['page']);
	unset($args['pagename']); // this is neccessary in case Posts Page is set to a static page

	$query = new WP_Query($args);




	$idx = 0;
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$idx = $idx + 1;
			if($idx < $posts_per_page + 1)
				get_template_part( $template, get_post_format() );
		}

		if($query->post_count <= $posts_per_page){
			// there are no more posts
			// print a flag to detect
			echo '<div class="invi no-posts"><!-- --></div>';
		}
	} else {
		// no posts found
	}

	/* Restore original Post Data */
	wp_reset_postdata();

	die('');
}

/* Ajax load next posts in single post */
add_action( 'wp_ajax_scroll_next_post', 'cactus_ajax_scroll_next_post' );
add_action( 'wp_ajax_nopriv_scroll_next_post', 'cactus_ajax_scroll_next_post' );

function cactus_ajax_scroll_next_post()
{
	global $is_auto_load_next_post;
	$timestamp 		= isset($_POST[sanitize_key('timestamp')]) ? $_POST[sanitize_key('timestamp')] : '' ;
	$post_id 		= isset($_POST[sanitize_key('id')]) ? $_POST[sanitize_key('id')] : 0;
	$data_count 	= isset($_POST[sanitize_key('data_count')]) ? $_POST[sanitize_key('data_count')] : 0;
	$data_enable_fb_comment 	= isset($_POST[sanitize_key('data_enable_fb_comment')]) ? $_POST[sanitize_key('data_enable_fb_comment')] : 0;
	$is_auto_load_next_post 	= isset($_POST[sanitize_key('is_auto_load_next_post')]) ? $_POST[sanitize_key('is_auto_load_next_post')] : 0;
	if($timestamp != ''){
		$order = ot_get_option('single_post_scroll_next_order'); // before or after
		$condition = ot_get_option('single_post_scroll_next_condition');

		$args = array('posts_per_page'   => 1,'date_query' => array(
				  array(
						$order => date('Y-m-d H:i:s',$timestamp),
					)
					)
					,'post_status' => 'publish');

		if($condition == 'category' || $condition == 'custom-cats'){
			if($condition == 'custom-cats') {
				$cats = ot_get_option('single_post_scroll_next_custom_values');
			} else {
				$post_categories = wp_get_object_terms($post_id,'category');
				$cats = array();
				foreach($post_categories as $cat){
					$cats[] = $cat->slug;
				}
				$cats = implode(',',$cats);
			}

			$args = array_merge($args,array('category_name'=>$cats));
		} else if($condition == 'tag' || $condition == 'custom-tags'){
			if($condition == 'custom-tags') {
				$tags = ot_get_option('single_post_scroll_next_custom_values');
			} else {
				$post_tags = get_the_tags($post_id);
				$tags = array();
				foreach($post_tags as $tag){
					$tags[] = $tag->name;
				}
				$tags = implode(',',$tags);
			}


			$args = array_merge($args,array('tag'=> $tags));
		}

		$the_query = new WP_Query($args);

		$index = 0;

		global $ajax_layout;
		$ajax_layout = 2;
		global $post;
		global $withcomments;
		$withcomments = true;

		while($the_query->have_posts()) : $the_query->the_post();
				// ignore current post
				$data_count = $data_count + 1;
				if($data_count <= 6)
				{
					$ajax_post_id = get_the_ID();

					if($data_count < 6)
					{
						global $post_standard_layout;
						$post_standard_layout = '1';
						global $post_gallery_layout;
						$post_gallery_layout = '1';
						global $post_video_layout;
						$post_video_layout = '1';
						global $thumb_url;
						$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
						$thumb_url = wp_get_attachment_url( $thumbnail_id );

						echo "<article class='cactus-single-content ajaxed' data-url='".get_permalink()."' data-timestamp='".get_post_time('U')."' data-count='" . $data_count . "'>";

						get_template_part( 'html/single/content', get_post_format() );

						get_template_part( 'html/single/single', 'related' );

						if($data_enable_fb_comment == 0)
						{
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						}
						else
						{
							echo '<div id="comments" class="comments-area">
									<div id="respond" class="comment-respond">
										<div id="fbComments'.get_post_time('U').'" class="fb-comments" data-href="'.get_permalink().'" data-width="900" data-num-posts="10"></div>
									</div>
								</div>';
						}
						echo "</article>";
					}

					if($data_count == 6)
					{
						echo '<div class="page-navigation">
								<nav role="navigation" class="navigation-ajax">
									<div class="wp-pagenavi">
										<a class="load-more btn btn-default font-1" id="navigation-ajax" href="' . esc_url(get_permalink($ajax_post_id)) . '">
											<div class="load-title">' . esc_html__('Load more articles','cactus') . '</div>
										</a>
									</div>
								</nav>
							</div>';
					}
				}

		endwhile;

		wp_reset_postdata();
	}
	die('');
}

function ct_get_curent_url(){
	global $wp;
	$curent_url ='';
	if(get_option('permalink_structure') != ''){
		$curent_url = home_url( $wp->request );
		if(function_exists('qtrans_getLanguage') && qtrans_getLanguage()!=''){
			$curent_url = '//'.$_SERVER["HTTP_HOST"].$_SERVER['REDIRECT_URL'];
		}
	}else{
		$query_string = $wp->query_string;
		if(isset($_GET['lang'])){
			$query_string = $wp->query_string.'&lang='.$_GET['lang'];
		}
		$curent_url = add_query_arg( $query_string, '', home_url( $wp->request ) );
	}
	return $curent_url;
}


/* Functions, Hooks, Filters and Registers in Admin */
require_once 'inc/functions-admin.php';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(!is_plugin_active('option-tree/ot-loader.php') && !is_plugin_active('cactus-rating/cactus-rating.php'))
{
	if ( ! function_exists( 'ot_get_option' ) )
	{
		function ot_get_option($id, $default_value=null)
		{
			return $default_value;
		}
	}

	if ( ! function_exists( 'ot_settings_id' ) )
	{
		function ot_settings_id()
		{
			return null;
		}
	}

	if ( ! function_exists( 'ot_register_meta_box' ) )
	{
		function ot_register_meta_box()
		{
			return null;
		}
	}
}

if(!is_plugin_active('newstube-shortcode/newstube-shortcode.php'))
{
	if ( ! function_exists( 'cactus_display_ads' ) )
	{
		function cactus_display_ads()
		{
			return null;
		}
	}
}


/* Breadcumb */
if(!function_exists('ct_breadcrumbs')){
	function ct_breadcrumbs(){
		/* === OPTIONS === */
		$text['home']     = esc_html__('Home','cactus'); // text for the 'Home' link
		$text['category'] = '%s'; // text for a category page
		$text['search']   = esc_html__('Search Results for','cactus').' "%s"'; // text for a search results page
		$text['tag']      = esc_html__('Tag','cactus').' "%s"'; // text for a tag page
		$text['author']   = esc_html__('','cactus').' %s'; // text for an author page
		$text['404']      = esc_html__('404','cactus'); // text for the 404 page

		$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
		$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
		$show_title     = 1; // 1 - show the title for the links, 0 - don't show
		$delimiter      = ' <i class="fa fa-angle-right"></i> '; // delimiter between crumbs
		$before         = '<span class="current">'; // tag before the current crumb
		$after          = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$home_link    = home_url('/');
		$link_before  = '<span typeof="v:Breadcrumb">';
		$link_after   = '</span>';
		$link_attr    = ' rel="v:url" property="v:title"';
		$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
		$parent_id    = $parent_id_2 = ($post) ? $post->post_parent : 0;
		$frontpage_id = get_option('page_on_front');
		$event_layout ='';

		if(is_front_page()) {

			if ($show_on_home == 1) echo '<div class="cactus-breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

		}elseif(is_home()){
			$title = get_option('page_for_posts')?get_the_title(get_option('page_for_posts')):__('Blog','cactus');
			echo '<div class="cactus-breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a> \ '.$title.'</div>';
		}else{

			echo '<div class="cactus-breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
			if ($show_home_link == 1) {
				if(function_exists ( "is_shop" ) && is_shop()){

				}else{
					echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
					if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
				}
			}

			if ( is_category() ) {
				$this_cat = get_category(get_query_var('cat'), false);
				if ($this_cat->parent != 0) {
					$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
					if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
				}
				if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $home_link . $slug['slug'] . '/', $slug['slug']?$slug['slug']:$post_type->labels->singular_name);
					if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if( !is_wp_error( $cats ) ) {
						if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
						echo $cats;
					}
					if ($show_current == 1) echo $before . get_the_title() . $after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				if(function_exists ( "is_shop" ) && is_shop()){
					do_action( 'woocommerce_before_main_content' );
					do_action( 'woocommerce_after_main_content' );
				}else{
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo $before . ($slug['slug']?$slug['slug']:$post_type->labels->singular_name) . $after;
				}

			} elseif ( is_attachment() ) {
				$parent = get_post($parent_id);
				$cat = get_the_category($parent->ID); $cat = isset($cat[0])?$cat[0]:'';
				if($cat){
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
				}
				printf($link, get_permalink($parent), $parent->post_title);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$parent_id ) {
				if ($show_current == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $parent_id ) {
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo $breadcrumbs[$i];
						if ($i != count($breadcrumbs)-1) echo $delimiter;
					}
				}
				if ($show_current == 1) {
					if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
					echo $before . get_the_title() . $after;
				}

			} elseif ( is_tag() ) {
				echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			}

			echo '</div><!-- .breadcrumbs -->';

		}
	} // end tm_breadcrumbs()
}
/* Get background image, background link in post/category/theme */
function cactus_bg($post){
	$html='';
	// Background image, background link
	$bg = ''; $bgLink = '';
	// post background image, background link
	global $post;
	$post_bg = is_object($post) ? get_post_meta($post->ID, 'post_bg', true) : '';
	$post_bg_link = is_object($post) ? get_post_meta($post->ID, 'post_bg_link', true) : '';

	if(is_page())
    {
    	$page_bg = is_object($post) ? get_post_meta($post->ID, 'page_bg', true) : '';
    	$page_bg_link = is_object($post) ? get_post_meta($post->ID, 'page_bg_link', true) : '';
    }


	// Category background image, background link
	$cat_bg = '';
	$cat_bg_link = '';
	$categories = is_object($post) ? get_the_category($post->ID) : array();
	foreach($categories as $category){
		// Get category background image, background link
		$cat_id = $category->term_id;
		if(get_option('cat_bg_'.$cat_id)){
			$cat_bg = get_option('cat_bg_'.$cat_id);
			$cat_bg_link = get_option('cat_bg_link_'.$cat_id);
		}
	}
	 if( !is_page() && !is_category() && isset($post_bg['background-image']) &&  $post_bg['background-image']!=='' ){
		 $bg = $post_bg;
		 $bgLink = $post_bg_link;
	 }elseif ( !is_page() && isset($cat_bg['background-image']) && $cat_bg['background-image'] !=='' ){
		 $bg = $cat_bg;
		 $bg['background-color'] = '#'.$cat_bg['background-color'];
		 $bgLink = $cat_bg_link;
	 }elseif(is_page() && (isset($page_bg['background-image']) &&  $page_bg['background-image']!=='') || (isset($page_bg['background-color']) &&  $page_bg['background-color']!=='') )
	 {
	 	$bg = $page_bg;
	 	$bgLink = $page_bg_link;
	 }else{
		 $bg = ot_get_option('background','');
		 $bgLink = ot_get_option( 'background_link','' );
	 }

	 // return background image amd bakcground link
	 if(isset($bg['background-color']) || isset($bg['background-image'])){

	 $html .= '<style type="text/css" rel="stylesheet" scoped>';
	 	$html .= '#body-wrap{background:';
 		$html .= isset($bg['background-color']) ? $bg['background-color']:'';
 		$html .= ' ';
 		$html .= (isset($bg['background-image']) && $bg['background-image'] != '')?('url('.$bg['background-image'].') ' . $bg['background-position'] . ' ' . $bg['background-repeat'] . ' ' . $bg['background-attachment'] . ' ' . $bg['background-size']):'';
	 	$html .= ';}';
	 $html .= '</style>';
	 }
	 ?>
	 <?php
	 if( $bgLink != '' ){
	 $html .= '<a href="'.$bgLink.'" target="blank" id="bgLinkLeft"></a>';
	 $html .= '<a href="'.$bgLink.'" target="blank" id="bgLinkRight"></a>';
	 }

	 echo $html;
}
function show_cat($show_once = false){
	$category = get_the_category();
	if(!empty($category)){ ?>
		<?php
		foreach($category as $cat_item){
			?>
        	<?php echo cactus_get_category($cat_item);?>
		<?php
		if($show_once==1){
			break;
		}
		}?>
	<?php
	}
}
function show_thumb_single($format, $style , $thumb_url){
	$css_class = '';
	global $show_rating_intt;
	global $is_auto_load_next_post;
	global $format_sg; global $move_title_to_above;
	if($format !='gallery'){
		$show_rating_intt= 1;
		if($style ==2){$css_class ='style-2';}
		elseif($style == 3){$css_class ='style-3';}
		?>
		<div class="cactus-top-style-post <?php echo $css_class ?>">
			<?php if($style ==3 && function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } 
			//echo $style.' '.$move_title_to_above;exit;
			if($format=='' && $style== 3 && $move_title_to_above =='yes'){
				ct_heading_title($is_auto_load_next_post,$style,$show_rating_intt);					
			}	
			?>
			<div class="style-post-content">
            	<?php if($thumb_url){ ?>
					<img src="<?php echo $thumb_url ?>" alt="<?php the_title_attribute();?>" class="featured">
                <?php }else{
					echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'featured' ));
				} ?>
				<?php if($style ==2){ ?>
				<div class="thumb-gradient"></div>
				<?php }else if($style ==3){ ?>
				<?php echo tm_post_rating(get_the_ID());?>
				<?php }?>
				<?php if($style==2){?>
				<div class="content-abs-post">
					<?php show_cat() ?>
					<?php echo tm_post_rating(get_the_ID());?>
					<!--Title-->
					<?php the_title( '<h1 class="cactus-post-title entry-title"> ', '</h1>' ); ?>
				</div>
				<?php }?>
			</div>
		</div>
		<?php
	}else{
	$images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 999 ) );
	if ( $images and count($images)>0 ) {
	$show_rating_intt= 1;
	?>
    <div class="cactus-top-style-post style-3">
        <!--breadcrumb-->
        <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); }
		if($move_title_to_above =='yes'){
				ct_heading_title($is_auto_load_next_post,$style,$show_rating_intt);					
		}
		?>
        <!--breadcrumb-->

        <div class="style-post-content">
            <div class="post-style-gallery">
                <a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                <a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                <div class="pagination"></div>
                <div class="post-style-gallery-content">
                    <div class="cactus-swiper-container" data-settings='["mode":"cactus-fix-composer"]'>
                        <div class="swiper-wrapper">
						<?php
                                foreach((array)$images as $attachment_id => $attachment){
                                    $image_img_tag = wp_get_attachment_image_src( $attachment_id ,'full');
                        			?>
                                    <!-- display the gallery -->
                                    <div class="swiper-slide">
                                        <div class="img-content">
                                            <img src="<?php echo $image_img_tag[0]; ?>" alt="<?php echo $attachment->post_title;?>">
                                        </div>
                                    </div>
                        		<?php
                                }// end foreach
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo tm_post_rating(get_the_ID());?>

        </div>
    </div>
    <?php }
	}
}
if(!function_exists('ct_heading_title')){
	function ct_heading_title($is_auto_load_next_post,$post_standard_layout,$show_rating_intt){
		?>
		<div class="heading-post">                                            
			<!--info-->
			<div class="posted-on">
				<?php show_cat() ?>
				<div class="fix-responsive"></div>
				<?php echo cactus_get_datetime();?>
				<span class="vcard author"> 
					<span class="fn"><?php the_author_posts_link(); ?></span>
				</span>
				<a href="<?php comments_link(); ?>" class="comment cactus-info"><?php echo get_comments_number(get_the_ID());?></a>                                               
			</div><!--info-->
			
			<!--Title-->
			<h1 class="h3 title entry-title">
				<?php if($is_auto_load_next_post == 1):?>
					<a href="<?php echo esc_url(get_the_permalink());?>" title="<?php esc_attr(the_title_attribute());?>"><?php the_title(); ?></a>
				<?php else:?>
					<?php the_title(); ?>
				<?php endif;?>
					<?php if( ($show_rating_intt== 0 && get_post_format()=='' && $post_standard_layout!=5 ) || ($post_standard_layout==5 && !has_post_thumbnail()) || ($show_rating_intt== 0 && get_post_format()=='gallery')){?>
					<?php echo tm_post_rating(get_the_ID(), true);?>
					<?php }?>
	
			</h1>
			<!--Title-->
			
		</div>
		<?php 				
	}
}
function CtAlreadyVoted($post_id, $ip = null) {
	global $wpdb;

	if (null == $ip) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	$tm_has_voted = $wpdb->get_var("SELECT value FROM {$wpdb->prefix}wti_like_post WHERE post_id = '$post_id' AND ip = '$ip'");

	return $tm_has_voted;
}
if(!function_exists('cactus_toolbar')){
	function cactus_toolbar($id_curr, $layout, $show_more, $css_class = false){
		$show_share_button_social = ot_get_option('show_share_button_social');
		if($css_class!='fix-bottom') {
	?>
		<div class="update_design_post_on">
			<div class="posted-on">       
				<?php if(function_exists('bawpvc_main') || function_exists('get_tptn_post_count_only')){ ?>
					 <div class="view cactus-info"><?php echo  get_formatted_string_number(cactus_get_post_view()); ?></div>
				<?php }?>
				<a href="<?php comments_link(); ?>" class="comment cactus-info"><?php echo get_comments_number(get_the_ID());?></a>
			</div>
		</div>
		
		<?php };?>
		
		<div class="cactus-share-and-like <?php if(isset($css_class)){ echo esc_attr($css_class);}?>">
			<?php if($show_share_button_social!='off'){?>
			<a class="share-tool-block open-cactus-share" data-toggle="tooltip" data-placement="top" href="javascript:;" title="" data-original-title="<?php esc_html_e('social share','cactus');?>">
				<i class="fa fa-share-alt"></i>
				<i class="fa fa-times"></i>
				<?php if($layout==5){?>
				<span><?php esc_html_e('Share','cactus')?></span>
				<?php }?>
			</a>
			<?php }?>
			<?php if($layout == 5){?>
			<?php cactus_print_social_share('change-color');?>
			<?php }?>
			<?php if(function_exists('bawpvc_main') || function_exists('get_tptn_post_count_only')){ ?>
			<div class="share-tool-block view-count">
				<i class="fa fa-eye"></i>&nbsp;
				<span><?php echo  get_formatted_string_number(cactus_get_post_view(get_the_ID())); ?></span>
			</div>
			<?php }?>
			
			<?php if(ot_get_option('video_report','on')!='off') { ?>
			<a class="share-tool-block report-button" title="<?php echo esc_attr__('REPORT THIS','cactus'); ?>" rel="tooltip" data-original-title='<?php echo esc_attr__('REPORT THIS','cactus'); ?>' data-placement="top" href="#reportModal" data-toggle="modal">
				<i class="fa fa-flag"></i>
				<?php if($layout==5){?>
				<span><?php esc_html_e('REPORT THIS','cactus'); ?></span>
				<?php }?>
			</a>
			<script>jQuery(document).ready(function(e) {
				jQuery("[rel='tooltip']").tooltip();
			});</script>
			<?php }?>
			
			<?php if(function_exists('GetWtiLikePost')){
			
			if(function_exists('GetWtiLikeCount')){$like = GetWtiLikeCount(get_the_ID());}
			if(function_exists('GetWtiUnlikeCount')){$unlike = GetWtiUnlikeCount(get_the_ID());}
			$like = $re_like = str_replace('+','',$like);
			$unlike = $re_unlike = str_replace('-','',$unlike);
			$sum = $re_like + $re_unlike;?>
			<div class="share-tool-block like-button <?php echo $css_class;?>_check-like-id-<?php the_ID();?>" data-like="<?php esc_html_e('like','cactus');?>" data-unlike="<?php esc_html_e('dislike','cactus');?>">
				<?php if(function_exists('GetWtiLikePost')){ GetWtiLikePost();}?>
			</div>
			<?php
			if($sum!=0 && $sum!=''){
				$fill_cl = (($re_like/$sum)*100);
			} else
			if($sum==0){
				$fill_cl = 50;
			}
			if(function_exists('GetWtiVotedMessage')){ $msg = GetWtiVotedMessage(get_the_ID());}
			$ip='';
			if(function_exists('WtiGetRealIpAddress')){$ip = WtiGetRealIpAddress();}
			$tm_vote = CtAlreadyVoted(get_the_ID(), $ip);
				// get setting data
				$is_logged_in = is_user_logged_in();
				$mes= '<style type="text/css">.action-like a:before{ color: rgba(28,28,28,1.00) !important}</style>';
				$mes_un= '<style type="text/css">.action-unlike a:before{ color: rgba(28,28,28,1.00)  !important}</style>';
				$login_required = get_option('wti_like_post_login_required');
				if ($login_required && !$is_logged_in) {
						echo $mes;
						echo $mes_un;
				} else {
					if(function_exists('HasWtiAlreadyVoted')){$has_already_voted = HasWtiAlreadyVoted(get_the_ID(), $ip);}
					$voting_period = get_option('wti_like_post_voting_period');
					$datetime_now = date('Y-m-d H:i:s');
					if ("once" == $voting_period && $has_already_voted) {
						// user can vote only once and has already voted.
						if($tm_vote>0){echo $mes;}
						else if ($tm_vote<0){echo $mes_un;}
					} elseif (0 == $voting_period) {
						if($tm_vote>0){echo $mes;}
						else if ($tm_vote<0){echo $mes_un;}
					} else {
						if (!$has_already_voted) {
							// never voted befor so can vote
						} else {
							// get the last date when the user had voted
							if(function_exists('GetWtiLastVotedDate')){$last_voted_date = GetWtiLastVotedDate(get_the_ID(), $ip);}
							// get the bext voted date when user can vote
							if(function_exists('GetWtiLastVotedDate')){$next_vote_date = GetWtiNextVoteDate($last_voted_date, $voting_period);}
							if ($next_vote_date > $datetime_now) {
								$revote_duration = (strtotime($next_vote_date) - strtotime($datetime_now)) / (3600 * 24);
	
								if($tm_vote>0){echo $mes;}
								else if ($tm_vote<0){echo $mes_un;}
							}
						}
					}
				}
			?>
			<div class="share-tool-block like-information">
				<div class="cactus-like-bar"><span style="width:<?php echo $fill_cl ?>%;"></span></div>
				<div class="like-dislike pull-right">
					<span class="like"><i class="fa fa-thumbs-up"></i>&nbsp; <?php echo  get_formatted_string_number($like); ?></span>
					<span class="dislike"><i class="fa fa-thumbs-down"></i>&nbsp; <?php echo  get_formatted_string_number($unlike); ?></span>
				</div>
			</div>
			<script>
				/*like*/
				var __like_number_<?php the_ID();?> = document.createElement('SPAN');
				__like_number_<?php the_ID();?>.className = 'lc';
				var __like_numbertext_<?php the_ID();?> = document.createTextNode('<?php echo  get_formatted_string_number($like);?>');
				__like_number_<?php the_ID();?>.appendChild(__like_numbertext_<?php the_ID();?>);
				var __likediv_<?php the_ID();?> = document.querySelector('.<?php echo $css_class;?>_check-like-id-<?php the_ID();?> .lbg-style1');
				__likediv_<?php the_ID();?>.appendChild(__like_number_<?php the_ID();?>);
				
				/*unlike*/
				var __unlike_number_<?php the_ID();?> = document.createElement('SPAN');
				__unlike_number_<?php the_ID();?>.className = 'unlc';
				var __unlike_numbertext_<?php the_ID();?> = document.createTextNode('<?php echo  get_formatted_string_number($unlike);?>');
				__unlike_number_<?php the_ID();?>.appendChild(__unlike_numbertext_<?php the_ID();?>);
				var __unlikediv_<?php the_ID();?> = document.querySelector('.<?php echo $css_class;?>_check-like-id-<?php the_ID();?> .unlbg-style1');
				__unlikediv_<?php the_ID();?>.appendChild(__unlike_number_<?php the_ID();?>);
			</script>
			<?php }
			if($show_more!=0){?>
			<a href="javascript:;" class="share-tool-block open-carousel-listing pull-right"><?php esc_html_e('more','cactus');?>&nbsp; <i class="fa fa-angle-down"></i></a>
			<?php }?>
			<div class="clearfix"></div>
	
			<!--Share-->
			<?php if($layout!=5){?>
			<?php cactus_print_social_share('change-color');?>
			<?php }elseif($layout==5){
				cactus_print_social_share($class_css = 'mobile-open change-color');
			}?>
			<!--Share-->
		</div>
	
		<?php
		if($show_more!=0){
			$number_of_more = ot_get_option('number_of_more', 10);
			$sort_of_more = ot_get_option('sort_of_more');
			global $wp_query;
			$args = array(
			  'posts_per_page' => $number_of_more,
			  'post_type' => 'post',
			  'post_status' => 'publish',
			  'post__not_in' => array($id_curr),
			);
			if($sort_of_more=='1'){
			   $categories = get_the_category();
			   $category_id = $categories[0]->cat_ID;
			   foreach($categories as $cat_item){
				   $cats[] = $cat_item->cat_ID;
			   }
			   $args['category__in'] = $cats;
			}
			if($sort_of_more=='2'){
			   $cr_tags = get_the_tags();
				$tag_item = '';
				if ($cr_tags) {
					foreach($cr_tags as $tag) {
						$tag_item .= ',' . $tag->slug;
					}
				}
				$tag_item = substr($tag_item, 1);
				$args['tag'] = $tag_item;
			}
			if($sort_of_more == '3' || $sort_of_more == '4') //same playlist, then tags OR same playlist, then categories
			{
				$playlist_ids = get_post_meta($id_curr, 'playlist_id', true);
				$ct_query_more1 = array();
				$ct_query_more2 = array();
				$meta_query_arr = array();
				if(is_array($playlist_ids) && count($playlist_ids) > 0)
				{
					$args['meta_query'] = array(
											'relation' => 'OR',
										);
					foreach($playlist_ids as $index => $pl_id)
					{
						$meta_query_arr[$index] = array(
													'key' => 'playlist_id',
													'value' => $pl_id,
													'compare' => 'LIKE',
													);
						array_push($args['meta_query'], $meta_query_arr[$index]);
					}
					$ct_query_more1 = get_posts($args);
				}
				if($sort_of_more == '3' && (count($ct_query_more1) < $number_of_more))
				{
					unset($args['meta_query']);
					$args['posts_per_page'] = $number_of_more - count($ct_query_more1);
					$cr_tags = get_the_tags();
					$tag_item = '';
					if ($cr_tags) {
						foreach($cr_tags as $tag) {
							$tag_item .= ',' . $tag->slug;
						}
					}
					$tag_item = substr($tag_item, 1);
					$args['tag'] = $tag_item;
					$ct_query_more2 = get_posts($args);
				}
				else if($sort_of_more == '4' && (count($ct_query_more1) < $number_of_more))
				{
					unset($args['meta_query']);
					$args['posts_per_page'] = $number_of_more - count($ct_query_more1);
					$categories = get_the_category();
					$category_id = $categories[0]->cat_ID;
					foreach($categories as $cat_item){
					   $cats[] = $cat_item->cat_ID;
					}
					$args['category__in'] = $cats;
					$ct_query_more2 = get_posts($args);
				}
			}
			

			$current_key_more = '';
			if($sort_of_more != '3' && $sort_of_more != '4')
				$ct_query_more = get_posts($args);
			else
				$ct_query_more = array_merge($ct_query_more1, $ct_query_more2);
			?>
			<!--listing video-->
			<div class="cactus-transition-open">
				<div class="cactus-listing-carousel">
					<a class="pre-carousel" href="javascript:;"><i class="fa fa-angle-left"></i></a>
					<a class="next-carousel" href="javascript:;"><i class="fa fa-angle-right"></i></a>
					<div class="pagination"></div>
					<div class="cactus-listing-carousel-content">
						<!--Listing-->
						<div class="cactus-listing-wrap">
							<!--Config-->
							<div class="cactus-listing-config style-1 style-3"> <!--addClass: style-1 + (style-2 -> style-n)-->
	
								<div class="container">
									<div class="row">
	
										<div class="col-md-12 cactus-listing-content"> <!--ajax div-->
	
											<div class="cactus-sub-wrap">
												<div class="cactus-swiper-container" data-settings='["mode":"cactus-fix-composer"]'>
													<div class="swiper-wrapper">
													<!--Now playing item-->
														<div class="swiper-slide ">
															<!--item listing-->
															<div class="cactus-post-item hentry active">
																<!--content-->
																<div class="entry-content">
																	<div class="primary-post-content"> <!--addClass: related-post, no-picture -->
																		<?php if(has_post_thumbnail($id_curr)){ ?>
																		<!--picture-->
																		<div class="picture">
																			<div class="picture-content">
																				<a href="<?php echo esc_url(get_permalink($id_curr)); ?>" title="<?php echo esc_attr(get_the_title($id_curr));?>">
																					<?php
																					 echo cactus_thumbnail($id_curr, 'thumb_253x189', array('alt' => get_the_title()));
																					?>
																					<div class="thumb-overlay"></div>
																					<i class="fa fa-play-circle-o cactus-icon-fix"></i>
																					<div class="cactus-now-playing"><?php esc_html_e(' now viewing','cactus');?></div>
																				</a>
																			</div>
	
																		</div><!--picture-->
																		<?php }?>
																		<div class="content">
	
																			<!--Title-->
																			<h3 class="h6 cactus-post-title entry-title">
																				<a href="<?php echo esc_url(get_permalink($id_curr)); ?>" title=""><?php echo esc_attr(get_the_title($id_curr)); ?></a>
																			</h3><!--Title-->
																			<div class="posted-on">
																				<?php echo cactus_get_datetime();?>
																				<span class="vcard author"> 
																					<span class="fn"><?php the_author_posts_link(); ?></span>
																				</span>
																			</div>
	
																			<div class="cactus-last-child"></div> <!--fix pixel no remove-->
																		</div>
																	</div>
	
																</div><!--content-->
	
															</div><!--item listing-->
														</div>
													<!--End playing item-->
													<?php
													foreach ( $ct_query_more as $key_more => $post ) :
													?>
														<div class="swiper-slide">
															<!--item listing-->
															<div class="cactus-post-item hentry">
																<!--content-->
																<div class="entry-content">
																	<div class="primary-post-content"> <!--addClass: related-post, no-picture -->
																		<?php if(has_post_thumbnail($post->ID)){ ?>
																			<!--picture-->
																			<div class="picture">
																				<div class="picture-content">
																					<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr($post->post_title);?>">
																						<?php
																						 echo cactus_thumbnail($post->ID, 'thumb_253x189', array('alt' => esc_attr($post->post_title)));
																						?>
																						<div class="thumb-overlay"></div>
																						<?php if(get_post_format($post->ID) == 'video'):?>
																							<i class="fa fa-play-circle-o cactus-icon-fix"></i>
																						<?php elseif(get_post_format($post->ID) == 'image'):?>
																							<i class="fa fa-file-image-o cactus-icon-fix"></i>
																						<?php elseif(get_post_format($post->ID) == 'audio'):?>
																							<i class="fa fa-music cactus-icon-fix"></i>
																						<?php elseif(get_post_format($post->ID) == 'gallery'):?>
																							<i class="fa fa-camera cactus-icon-fix"></i>
																						<?php endif;?>
																						<div class="cactus-now-playing"><?php esc_html_e(' now playing','cactus');?></div>
																					</a>
																				</div>
		
																			</div><!--picture-->
																		<?php }?>
																		<div class="content">
	
																			<!--Title-->
																			<h3 class="h6 cactus-post-title entry-title">
																				<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr($post->post_title);?>"><?php echo esc_attr($post->post_title); ?></a>
																			</h3><!--Title-->
																			<div class="posted-on">
																				<?php echo cactus_get_datetime();?>
																				<span class="vcard author"> 
																					<span class="fn"><?php the_author_posts_link(); ?></span>
																				</span>
																			</div>
	
																			<div class="cactus-last-child"></div> <!--fix pixel no remove-->
																		</div>
																	</div>
	
																</div><!--content-->
	
															</div><!--item listing-->
														</div>
													 <?php endforeach;?>
	
													</div>
												</div>
	
											</div>
	
										</div>
	
									</div>
								</div>
	
							</div><!--Config-->
						</div><!--Listing-->
					</div>
				</div>
			</div>
			<!--listing video-->
		<?php
		wp_reset_postdata();
		}
	}
}
add_action( 'wp_head', 'ct_hook_baw_pvc_main' );
function ct_hook_baw_pvc_main()
{
	global $post, $bawpvc_options;
	$bots = array( 	'wordpress', 'googlebot', 'google', 'msnbot', 'ia_archiver', 'lycos', 'jeeves', 'scooter', 'fast-webcrawler', 'slurp@inktomi', 'turnitinbot', 'technorati',
					'yahoo', 'findexa', 'findlinks', 'gaisbo', 'zyborg', 'surveybot', 'bloglines', 'blogsearch', 'pubsub', 'syndic8', 'userland', 'gigabot', 'become.com' );
	if( 	!( ( $bawpvc_options['no_members']=='on' && is_user_logged_in() ) || ( $bawpvc_options['no_admins']=='on' && current_user_can( 'administrator' ) ) ) &&
			!empty( $_SERVER['HTTP_USER_AGENT'] ) &&
			is_singular( $bawpvc_options['post_types'] ) &&
			!preg_match( '/' . implode( '|', $bots ) . '/i', $_SERVER['HTTP_USER_AGENT'] )
		)
	{
		global $timings;
		$IP = substr( md5( getenv( 'HTTP_X_FORWARDED_FOR' ) ? getenv( 'HTTP_X_FORWARDED_FOR' ) : getenv( 'REMOTE_ADDR' ) ), 0, 16 );
		$time_to_go = $bawpvc_options['time']; // Default: no time between count
		if( (int)$time_to_go == 0 || !get_transient( 'baw_count_views-' . $IP . $post->ID ) ) {
				$channel = get_post_meta( $post->ID, 'channel_id', true );
				if(!is_array($channel)){
					$count_channel = (int)get_post_meta( $channel, 'view_channel', true );
					$count_channel++;
					update_post_meta( $channel, 'view_channel', $count_channel );
				}else{
					foreach($channel as $channel_item){
						$count_channel = (int)get_post_meta( $channel_item, 'view_channel', true );
						$count_channel++;
						update_post_meta( $channel_item, 'view_channel', $count_channel );
					}
				}
				$playlist_v = get_post_meta( $post->ID, 'playlist_id', true );
				if(!is_array($playlist_v)){
					$count_playlist = (int)get_post_meta( $playlist_v, 'view_playlist', true );
					$count_playlist++;
					update_post_meta( $playlist_v, 'view_playlist', $count_playlist );
				}else{
					foreach($playlist_v as $playlist_item){
						$count_playlist = (int)get_post_meta( $playlist_item, 'view_playlist', true );
						$count_playlist++;
						update_post_meta( $playlist_item, 'view_playlist', $count_playlist );
					}
				}
			if( (int)$time_to_go > 0 )
				set_transient( 'baw_count_views-' . $IP . $post->ID, $IP, $time_to_go );
		}
	}
}

if(!function_exists('tm_post_rating')){
	function tm_post_rating($post_id,$is_single=false){
		$rating = round(floatval(get_post_meta($post_id, 'taq_review_score', true))/10,1);
		$rating_options = get_option('tmr_options_group');
		if($rating_options['tmr_rate_type'] == 'star')
		{
			$rating = round($rating) / 2;
			$rating = number_format($rating,1,'.','');
		}

		if($rating && $rating_options['tmr_rate_type'] == 'point'){
			$rating = number_format($rating,1,'.','');

		}
		if($rating != 0)
		{
				return '<span class="cactus-note-point">'.$rating.'</span>';
		}
	}
}

if(!function_exists('tm_get_default_image')){
	function tm_get_default_image(){
		return get_template_directory_uri().'/images/default_image.jpg';
	}
}

if(!function_exists('cactus_get_category')){
	function cactus_get_category($category)
	{
		if(is_array($category) && isset($category[0]))
			$category = $category[0];
		$category_color 		= get_option('cat_color_' . $category->term_id);
		$category_text_color 	= get_option('cat_text_color_' . $category->term_id);

		$style_bg_cat = $category_color != '' && $category_color != 'FFFFFF' ? ' style="background-color: #' . (get_option('cat_color_' . $category->term_id))  . '"' : '';
		$style_text_cat = $category_text_color != '' && $category_text_color != '#fff'  ? ' style="color: ' . (get_option('cat_text_color_' . $category->term_id))  . '"' : '';

		return '
				<div class="cactus-note-cat"' . $style_bg_cat . '><a' . $style_text_cat . ' href="' . esc_url(get_category_link( $category->term_id )) . '" title="' . esc_html__('View all posts in ') . $category->name . '">' . $category->name . '</a>
                </div>';
	}
}

if(!function_exists('cactus_get_datetime')){
	function cactus_get_datetime($post_ID = '')
	{
		if($post_ID == ''){
			global $post;
		 	if($post) {
		 		$post_ID = $post->ID;
		 	}
		}
		$post_datetime_setting  = ot_get_option('enable_link_on_datetime', 'on');
		if($post_datetime_setting == 'on')
			return '<a href="' . esc_url(get_the_permalink($post_ID)) . '" class="cactus-info" rel="bookmark"><time datetime="' . get_the_date( 'c', $post_ID ) . '" class="entry-date updated">' . date_i18n(get_option('date_format') ,get_the_time('U', $post_ID)) . '</time></a>';
		else
			return '<div class="cactus-info" rel="bookmark"><time datetime="' . get_the_date( 'c', $post_ID ) . '" class="entry-date updated">' . date_i18n(get_option('date_format') ,get_the_time('U', $post_ID)) . '</time></div>';
	}
}


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(!is_plugin_active('option-tree/ot-loader.php'))
{
	if ( ! function_exists( 'ot_get_option' ) )
	{
		function ot_get_option($id, $default_value=null)
		{
			return $default_value;
		}
	}

	if ( ! function_exists( 'ot_settings_id' ) )
	{
		function ot_settings_id()
		{
			return null;
		}
	}

	if ( ! function_exists( 'ot_register_meta_box' ) )
	{
		function ot_register_meta_box()
		{
			return null;
		}
	}
}

if(!is_plugin_active('newstube-shortcode/newstube-shortcode.php'))
{
	if ( ! function_exists( 'cactus_display_ads' ) )
	{
		function cactus_display_ads()
		{
			return null;
		}
	}
}

add_filter('comment_post_redirect', 'ct_redirect_after_comment');
function ct_redirect_after_comment($location)
{
	global $post;
	if(get_post_meta($post->ID,'live_comment',true) == 'on'){
		return $_SERVER["HTTP_REFERER"];
	}else{
		return $location;
	}
}

//add report post type
add_action( 'init', 'reg_report_post_type' );
function reg_report_post_type() {
	$args = array(
		'labels' => array(
			'name' => esc_html__( 'Reports', 'cactus' ),
			'singular_name' => esc_html__( 'Report', 'cactus' )
		),
		'menu_icon' 		=> 'dashicons-flag',
		'public'             => true,
		'publicly_queryable' => true,
		'exclude_from_search'=> true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor', 'custom-fields' )
	);
	if(ot_get_option('video_report','on')!='off'){
		register_post_type( 'tm_report', $args );
	}
}
//redirect report post type
add_action( 'template_redirect', 'redirect_report_post_type' );
function redirect_report_post_type() {
	global $post;
	if(is_singular('tm_report')){
		if($url = get_post_meta(get_the_ID(),'tm_report_url',true)){
			wp_redirect($url);
		}
	}
}

//contact form 7 hook
function tm_contactform7_hook($WPCF7_ContactForm) {
	if(ot_get_option('user_submit',1)){
		$submission = WPCF7_Submission::get_instance();
		if($submission) {
			$posted_data = $submission->get_posted_data();
			if(isset($posted_data['video-url']) || isset($posted_data['post-description'])){
				$video_url = $posted_data['video-url'];
				$post_title = isset($posted_data['post-title'])?$posted_data['post-title']:'';
				$post_description = isset($posted_data['post-description'])?$posted_data['post-description']:'';
				$post_excerpt = isset($posted_data['post-excerpt'])?$posted_data['post-excerpt']:'';
				$post_user = isset($posted_data['your-email'])?$posted_data['your-email']:'';
				$post_cat = isset($posted_data['cat'])?$posted_data['cat']:'';
				$post_tag = isset($posted_data['tag'])?$posted_data['tag']:'';
				$post_status = ot_get_option('user_submit_status','pending');
				$post_format = ot_get_option('user_submit_format');
				$post_post = array(
				  'post_content'   => $post_description,
				  'post_excerpt'   => $post_excerpt,
				  'post_name' 	   => sanitize_title($post_title), //slug
				  'post_title'     => $post_title,
				  'post_status'    => $post_status,
				  'post_category'  => $post_cat,
				  'tags_input'	   => $post_tag,
				  'post_type'      => 'post'
				);
				if($new_ID = wp_insert_post( $post_post, false )){
					add_post_meta( $new_ID, 'tm_video_url', $video_url );
					add_post_meta( $new_ID, 'tm_user_submit', $post_user );
					set_post_format( $new_ID, $post_format );
					$post_post['ID'] = $new_ID;
					wp_update_post( $post_post );
				}
			}//if video_url
		}//if submission
	}
	
	//catch report form
	$submission = WPCF7_Submission::get_instance();
	if($submission) {
		$posted_data = $submission->get_posted_data();
		//error_log(print_r($posted_data, true));
		if(isset($posted_data['report-url'])){
			$post_url = $posted_data['report-url'];
			$post_user = isset($posted_data['your-email'])?$posted_data['your-email']:'';
			$post_message = isset($posted_data['your-message'])?$posted_data['your-message']:'';
			
			$post_title = $post_user.(esc_html__(' reported a post','cactus'));
			$post_content = $post_user.esc_html__(' reported a post has inappropriate content with message:','cactus').
				'<blockquote>'.$post_message.'</blockquote><br><br>'.
				esc_html__('You could review it here','cactus').' <a href="'.esc_attr($post_url).'">'.$post_url.'</a>';
			
			$report_post = array(
			  'post_content'   => $post_content,
			  'post_name' 	   => sanitize_title($video_title), //slug
			  'post_title'     => $post_title,
			  'post_status'    => 'publish',
			  'post_type'      => 'tm_report'
			);
			if($new_report = wp_insert_post( $report_post, false )){
				add_post_meta( $new_report, 'tm_report_url', $post_url );
				add_post_meta( $new_report, 'tm_user_submit', $post_user );
			}
		}//if report_url
	}//if submission
}
add_action("wpcf7_before_send_mail", "tm_contactform7_hook");

function tm_wpcf7_cactus_shortcode(){
	if(function_exists('wpcf7_add_form_tag')){
		wpcf7_add_form_tag(array('category','category*'), 'tm_catdropdown', true);
		wpcf7_add_form_tag(array('report_url','report_url*'), 'tm_report_input', true);
	} elseif(function_exists('wpcf7_add_shortcode')){
		wpcf7_add_shortcode(array('category','category*'), 'tm_catdropdown', true);
		wpcf7_add_shortcode(array('report_url','report_url*'), 'tm_report_input', true);
	}
}
function tm_catdropdown($tag){
	$class = '';
	$is_required = 0;
	if(class_exists('WPCF7_Shortcode')){
		$tag = new WPCF7_Shortcode( $tag );
		if ( $tag->is_required() ){
			$is_required = 1;
			$class .= ' required-cat';
		}
	}
	$cargs = array(
		'hide_empty'    => false, 
		'exclude'       => explode(",",ot_get_option('user_submit_cat_exclude',''))
	); 
	$cats = get_terms( 'category', $cargs );
	if($cats){
		$output = '<span class="wpcf7-form-control-wrap cat"><span class="row wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required'.$class.'">';
		if(ot_get_option('user_submit_cat_radio','off')=='on'){
			foreach ($cats as $acat){
				$output .= '<label class="col-md-4 wpcf7-list-item"><input type="radio" name="cat[]" value="'.$acat->term_id.'" /> '.$acat->name.'</label>';
			}
		}else{
			foreach ($cats as $acat){
				$output .= '<label class="col-md-4 wpcf7-list-item"><input type="checkbox" name="cat[]" value="'.$acat->term_id.'" /> '.$acat->name.'</label>';
			}
		}
		$output .= '</span></span>';
	}
	ob_start();
	if($is_required){
	?>
    <script>
	jQuery(document).ready(function(e) {
		jQuery("form.wpcf7-form").submit(function (e) {
			var checked = 0;
			jQuery.each(jQuery("input[name='cat[]']:checked"), function() {
				checked = jQuery(this).val();
			});
			if(checked == 0){
				if(jQuery('.cat-alert').length==0){
					jQuery('.wpcf7-form-control-wrap.cat').append('<span role="alert" class="wpcf7-not-valid-tip cat-alert"><?php esc_html_e('Please choose a category','cactus') ?>.</span>');
				}
				return false;
			}else{
				return true;
			}
		});
	});
	</script>
	<?php
	}
	$js_string = ob_get_contents();
	ob_end_clean();
	return $output.$js_string;
}
function tm_report_input($tag){
	$class = '';
	$is_required = 0;
	if(class_exists('WPCF7_Shortcode')){
		$tag = new WPCF7_Shortcode( $tag );
		if ( $tag->is_required() ){
			$is_required = 1;
			$class .= ' required-cat';
		}
	}
	$output = '<div class="hidden wpcf7-form-control-wrap report_url"><div class="wpcf7-form-control wpcf7-validates-as-required'.$class.'">';
	$output .= '<input name="report-url" class="hidden wpcf7-form-control wpcf7-text wpcf7-validates-as-required" type="hidden" value="'.esc_attr(get_current_url()).'" />';
	$output .= '</div></div>';
	return $output;
}
add_action( 'init', 'tm_wpcf7_cactus_shortcode' );

//mail after publish
add_action( 'save_post', 'notify_user_submit');
function notify_user_submit( $post_id ) {
	if ( wp_is_post_revision( $post_id ) || !ot_get_option('user_submit_notify',1) )
		return;
	$notified = get_post_meta($post_id,'notified',true);
	$email = get_post_meta($post_id,'tm_user_submit',true);
	if(!$notified && $email && get_post_status($post_id)=='publish'){
		$subject = esc_html__('Your video submission has been approved','cactus');
		$message = esc_html__('Your video ','cactus').get_post_meta($post_id,'tm_video_url',true).' '.esc_html__('has been approved. You can see it here','cactus').' '.get_permalink($post_id);
		wp_mail( $email, $subject, $message );
		update_post_meta( $post_id, 'notified', 1);
	}
}

function enable_extended_upload ( $mime_types =array() ) {
 
   // The MIME types listed here will be allowed in the media library.
   // You can add as many MIME types as you want.
   $mime_types['woff2']  = 'application/font-woff2';
   $mime_types['woff']  = 'application/x-font-woff';
 
   // If you want to forbid specific file types which are otherwise allowed,
   // specify them here.  You can add as many as possible.
   unset( $mime_types['exe'] );
   unset( $mime_types['bin'] );
 
   return $mime_types;
}
 
add_filter('upload_mimes', 'enable_extended_upload');
//smartlist
if(!function_exists('ct_smartlist_post')){
	function  ct_smartlist_post($checkSmartListPost){
		global $post;
		$paged = get_query_var('page')?get_query_var('page'):1;
		if( $checkSmartListPost == 1){
			$all_ct = explode("<!--nextpage-->", $post->post_content);
			$i =0;
			foreach($all_ct as $it_content){
				$i++;
				if($i==2){
					preg_match('/\<h2(.*)\<\/h2\>/isU',$it_content, $h2_tag);
					break;
				}
			}
			?>
        	<div class="smart-list-post-wrap">
            	
                
                <h2 class="h3 title-page-post"><span class="post-static-page" data-scroll-page="1"><?php echo $paged;?></span><span><?php if(isset($h2_tag[0])){echo strip_tags($h2_tag[0]);}?></span></h2>
                
                <div class="page-links">
                    <a class="prev-smart-post" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    <a class="next-smart-post" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                </div>  
            </div>
            <div class="content-first-content" data-index="1">
        <?php    
		};
		if(isset($_GET['view-all']) && $_GET['view-all'] == 1){
			$ct =  $post->post_content = str_replace( "<!--nextpage-->", "<br/>", $post->post_content );
			echo apply_filters('the_content',$ct);
		}else{
			$i =0;
			foreach($all_ct as $st2_content){
				$i++;
				if($i==2){
					$st2_content =  preg_replace ('/\<h2(.*)\<\/h2\>/isU', ' ', $st2_content);
					echo apply_filters('the_content',$st2_content);
					break;
				}
			}
			if( $checkSmartListPost == 1){
			?>
            	<div class="thumb-opacity"><div class="circle"></div><div class="circle1"></div></div>
            </div> 
            <div class="content-smart-hidden" style="display:none;">
                <?php 
				$counter = 0;
				foreach($all_ct as $it_content){
					$counter ++;
					if($counter>1){
					preg_match('/\<h2(.*)\<\/h2\>/isU',$it_content, $h2_tag_title);
					$it_content =  preg_replace ('/\<h2(.*)\<\/h2\>/isU', ' ', $it_content);
					?>                            
					<div class="page-break-item" data-title="<?php if(isset($h2_tag_title[0])){echo strip_tags($h2_tag_title[0]);}?>">
						<?php echo '<!--hidden-page--><!--'.(apply_filters('the_content',$it_content)).'--><!--hidden-page-->';?>
					</div>
                <?php }
				}?>
            </div> 
            <?php
			}
			?>
		<?php
			
			if(strpos($post->post_content, '<!--nextpage-->')!=false){?>
            	<div class="viewallpost-wrap">
                    <div class="cactus-view-all-pages">
                        <span><span></span></span>
                        <a href="<?php echo add_query_arg( array('view-all' => 1), ct_get_curent_url() ); ?>" title=""><span><?php echo esc_html__( 'View as one page', 'cactus' )?></span></a>
                        <span><span></span></span>
                    </div>
                </div>
                <?php
			}
		}
	}
}

add_action('after_switch_theme', 'newstube_after_activated');

function newstube_after_activated () {
	
}
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		$woocommerce_column = ot_get_option('woocommerce_column','2');
		return $woocommerce_column; 
	}
}
