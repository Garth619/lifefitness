<?php

class newstube_category_metadata{
	static function get_meta_fields(){
		return array(
						'blog_layout' => array(
											'title' => esc_html__('Blog Layout','newstube'),
											'description' => esc_html__('Choose blog layout for this category','newstube'),
											'type' => 'select',
											'options' => array(
															'' => esc_html__('Default', 'newstube'),
															'layout_1' => esc_html__('Layout 1', 'newstube'),
															'layout_2' => esc_html__('Layout 2', 'newstube'),
															'layout_3' => esc_html__('Layout 3', 'newstube'),
															'layout_4' => esc_html__('Layout 4', 'newstube'),
															'layout_5' => esc_html__('Layout 5', 'newstube'),
															'layout_6' => esc_html__('Layout 6', 'newstube'),
															'layout_7' => esc_html__('Layout 7', 'newstube'),
														)
										),
						'cat_layout' => array(),
						'cat_feature_post_layout' => array(),
						'number_featured_posts' => array(),
						'wall_ads_1_adsense' => array(),
						'wall_ads_1_custom' => array(),
						'wall_ads_2_adsense' => array(),
						'wall_ads_2_custom' => array(),
						'cat_color' => array(),
						'cat_text_color' => array(),
						'cat_bg' => array(),
						'cat_bg_link' => array()
					);
	}
	
	function __construct(){
		add_action('init', array($this, 'init'));
		
		/* Category custom field */
		add_action( 'category_add_form_fields', array($this, 'extra_category_fields'), 10 );
		add_action ( 'edit_category_form_fields', array($this, 'extra_category_fields'));
		
		//save extra category extra fields hook
		add_action ( 'edited_category', array($this, 'save_extra_category_fileds'));
		add_action( 'created_category', array($this, 'save_extra_category_fileds', 10, 2 ));
	}

	function extra_category_fields( $tag ) {
		$t_id 					= isset($tag->term_id) ? $tag->term_id : '';
		
		/*
		 * later update ...
		$fields = newstube_category_metadata::get_meta_fields();
		
		foreach($fields as $key => $field){
			
		}
		 */

		$blog_layout 			= get_option( "blog_layout_$t_id") ? get_option( "blog_layout_$t_id") : '';
		$cat_layout 			= get_option( "cat_layout_$t_id") ? get_option( "cat_layout_$t_id") : '';
		$cat_feature_post_layout= get_option( "cat_feature_post_layout_$t_id") ? get_option( "cat_feature_post_layout_$t_id"):'';
		$number_featured_posts 	= get_option( "number_featured_posts_$t_id")?get_option( "number_featured_posts_$t_id"):'';
		$wall_ads_1_adsense 	= get_option( "wall_ads_1_adsense_$t_id") ? get_option( "wall_ads_1_adsense_$t_id"):'';
		$wall_ads_1_custom 		= get_option( "wall_ads_1_custom_$t_id") ? get_option( "wall_ads_1_custom_$t_id"):'';
		$wall_ads_2_adsense 	= get_option( "wall_ads_2_adsense_$t_id") ? get_option( "wall_ads_2_adsense_$t_id"):'';
		$wall_ads_2_custom 		= get_option( "wall_ads_2_custom_$t_id") ? get_option( "wall_ads_2_custom_$t_id"):'';
		$cat_color 				= get_option( "cat_color_$t_id") ? get_option( "cat_color_$t_id"):'';
		$cat_text_color 		= get_option( "cat_text_color_$t_id") ? get_option( "cat_text_color_$t_id"):'';
		$cat_bg 				= get_option( "cat_bg_$t_id") ? get_option( "cat_bg_$t_id"):'';
		$cat_bg_link 			= get_option( "cat_bg_link_$t_id") ? get_option( "cat_bg_link_$t_id"):'';
		// Set default values
		if(!$t_id || $cat_bg == ''){
			$cat_bg['background-color'] = 'FFFFFF';
			$cat_bg['background-repeat'] = '';
			$cat_bg['background-attachment'] = '';
			$cat_bg['background-position'] = '';
			$cat_bg['background-size'] = '';
			$cat_bg['background-image'] = '';
		}
	?>

		<tr class="form-field">
			<th><label for="cat_bg"><?php esc_html_e('Category Background','newstube'); ?></label></th>
			<td>
				<label for="cat_bg">
					<input type="text" class="colorpicker" value="<?php echo $cat_bg['background-color'];?>" name="cat-bg[background-color]" style="width:65px;"/>

					<select name="cat-bg[background-repeat]" >
						<option value="" <?php echo $cat_bg['background-repeat'] ==''?'selected="selected"':'' ?> ><?php esc_html_e('background-repeat','newstube') ?></option>
						<option value="no-repeat" <?php echo $cat_bg['background-repeat'] =='no-repeat'?'selected="selected"':'' ?>><?php esc_html_e('No Repeat','newstube') ?></option>
						<option value="repeat" <?php echo $cat_bg['background-repeat'] =='repeat'?'selected="selected"':'' ?>><?php esc_html_e('Repeat All','newstube') ?></option>
						<option value="repeat-x" <?php echo $cat_bg['background-repeat'] =='repeat-x'?'selected="selected"':'' ?>><?php esc_html_e('Repeat Horizontally','newstube') ?></option>
						<option value="repeat-y" <?php echo $cat_bg['background-repeat'] =='repeat-y'?'selected="selected"':'' ?>><?php esc_html_e('Repeat Vertically','newstube') ?></option>
						<option value="inherit" <?php echo $cat_bg['background-repeat'] =='inherit'?'selected="selected"':'' ?>><?php esc_html_e('Inherit','newstube') ?></option>
					</select>
					<select name="cat-bg[background-attachment]" >
						<option value="" <?php echo $cat_bg['background-attachment'] ==''?'selected="selected"':'' ?>><?php esc_html_e('background-attachment','newstube') ?></option>
						<option value="fixed" <?php echo $cat_bg['background-attachment'] =='fixed'?'selected="selected"':'' ?>><?php esc_html_e('Fixed','newstube') ?></option>
						<option value="scroll" <?php echo $cat_bg['background-attachment'] =='scroll'?'selected="selected"':'' ?>><?php esc_html_e('Scroll','newstube') ?></option>
						<option value="inherit" <?php echo $cat_bg['background-attachment'] =='inherit'?'selected="selected"':'' ?>><?php esc_html_e('Inherit','newstube') ?></option>
					</select>
					<select name="cat-bg[background-position]" >
						<option value="" <?php echo $cat_bg['background-position'] ==''?'selected="selected"':'' ?>><?php esc_html_e('background-position','newstube') ?></option>
						<option value="left top" <?php echo $cat_bg['background-position'] =='left top'?'selected="selected"':'' ?>><?php esc_html_e('Left Top','newstube') ?></option>
						<option value="left center" <?php echo $cat_bg['background-position'] =='left center'?'selected="selected"':'' ?>><?php esc_html_e('Left Center','newstube') ?></option>
						<option value="left bottom" <?php echo $cat_bg['background-position'] =='left bottom'?'selected="selected"':'' ?>><?php esc_html_e('Left Bottom','newstube') ?></option>
						<option value="center top" <?php echo $cat_bg['background-position'] =='center top'?'selected="selected"':'' ?>><?php esc_html_e('Center Top','newstube') ?></option>
						<option value="center center" <?php echo $cat_bg['background-position'] =='center center'?'selected="selected"':'' ?>><?php esc_html_e('Center Center','newstube') ?></option>
						<option value="center bottom" <?php echo $cat_bg['background-position'] =='center bottom'?'selected="selected"':'' ?>><?php esc_html_e('Center Bottom','newstube') ?></option>
						<option value="right top" <?php echo $cat_bg['background-position'] =='right top'?'selected="selected"':'' ?>><?php esc_html_e('Right Top','newstube') ?></option>
						<option value="right center" <?php echo $cat_bg['background-position'] =='right center'?'selected="selected"':'' ?>><?php esc_html_e('Right Center','newstube') ?></option>
						<option value="right bottom" <?php echo $cat_bg['background-position'] =='right bottom'?'selected="selected"':'' ?>><?php esc_html_e('Right Bottom','newstube') ?></option>
					</select>
					<input type="text" name="cat-bg[background-size]" value="<?php echo $cat_bg['background-size'];?>" placeholder="background-size" style="width:123px;;">
					<br/>
					<input id="cat_bg" type="text" size="45" name="cat-bg[background-image]" value="<?php echo $cat_bg['background-image'];?>" />
					<input id="upload_image_button" class="button" type="button" value="Upload/Add image" />
					<?php echo parse_str($_SERVER['QUERY_STRING'])?>
					<?php if(isset($action) && $action == 'edit'):?>
						<input id="remove_image_button" class="button" type="button" value="Remove image" /></br>
					<?php endif;?>
				</label>
				<p class="description"><?php esc_html_e('Set background image for this category','newstube')?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th><label for="cat_bg_link"><?php esc_html_e('Background Link','newstube'); ?></label></th>
			<td>
				<label for="cat_bg_link">
					<input id="cat_bg_link" type="text" size="45" name="cat-bg-link" value="<?php echo $cat_bg_link;?>" />
				</label>
				<p class="description"><?php esc_html_e('Hyperlink to background image that will overrides default setting in Theme Options','newstube')?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="cat-color"><?php esc_html_e('Tag Name - Background Color','newstube'); ?></label>
			</th>
			<td>
				<input type="text" class="colorpicker" value="<?php echo $cat_color == '' ? '' : $cat_color;?>" name="cat-color"/>
				<p class="description"><?php esc_html_e('Choose background color of category tag name on items','newstube'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="cat-text-color"><?php esc_html_e('Tag Name - Text Color','newstube'); ?></label>
			</th>
			<td>
				<select name="cat-text-color" id="cat-text-color" >
					<option value="#fff" <?php echo $cat_text_color=='#fff'?'selected="selected"':'' ?>><?php esc_html_e('Light','newstube') ?></option>
					<option value="#111" <?php echo $cat_text_color=='#111'?'selected="selected"':'' ?>><?php esc_html_e('Dark','newstube') ?></option>
				</select>
				<p class="description"><?php esc_html_e('Choose text color schema for category tag name on items','newstube'); ?></p>
			</td>
		</tr>
		
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="blog-layout"><?php esc_html_e('Blog Layout','newstube'); ?></label>
			</th>
			<td>
				<select name="blog-layout" id="blog-layout">
					<option value="" <?php echo !$blog_layout?'selected="selected"':'' ?>><?php esc_html_e('Default','newstube') ?></option>
					<option value="layout_1" <?php echo $blog_layout=='layout_1'?'selected="selected"':'' ?>><?php esc_html_e('Layout 1','newstube') ?></option>
					<option value="layout_2" <?php echo $blog_layout=='layout_2'?'selected="selected"':'' ?>><?php esc_html_e('Layout 2','newstube') ?></option>
					<option value="layout_3" <?php echo $blog_layout=='layout_3'?'selected="selected"':'' ?>><?php esc_html_e('Layout 3','newstube') ?></option>
					<option value="layout_4" <?php echo $blog_layout=='layout_4'?'selected="selected"':'' ?>><?php esc_html_e('Layout 4','newstube') ?></option>
					<option value="layout_5" <?php echo $blog_layout=='layout_5'?'selected="selected"':'' ?>><?php esc_html_e('Layout 5','newstube') ?></option>
					<option value="layout_6" <?php echo $blog_layout=='layout_6'?'selected="selected"':'' ?>><?php esc_html_e('Layout 6','newstube') ?></option>
					<option value="layout_7" <?php echo $blog_layout=='layout_7'?'selected="selected"':'' ?>><?php esc_html_e('Layout 7','newstube') ?></option>
				</select>
				<p class="description"><?php esc_html_e('Choose blog layout for this category','newstube'); ?></p>
			</td>
		</tr>
		
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="category-layout"><?php esc_html_e('Featured Posts Section','newstube'); ?></label>
			</th>
			<td>
				<select name="category-layout" id="category-layout">
					<option value="" <?php echo !$cat_layout?'selected="selected"':'' ?>><?php esc_html_e('Default','newstube') ?></option>
					<option value="layout_1" <?php echo $cat_layout=='layout_1'?'selected="selected"':'' ?>><?php esc_html_e('Layout 1','newstube') ?></option>
					<option value="layout_2" <?php echo $cat_layout=='layout_2'?'selected="selected"':'' ?>><?php esc_html_e('Layout 2','newstube') ?></option>
				</select>
				<p class="description"><?php esc_html_e('Choose featured posts section for this category','newstube'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="cat-feature-post-layout"><?php esc_html_e('Featured Posts Layout','newstube'); ?></label>
			</th>
			<td>
				<select name="cat-feature-post-layout" id="cat-feature-post-layout">
					<option value="" <?php echo !$cat_feature_post_layout?'selected="selected"':'' ?>><?php esc_html_e('Default','newstube') ?></option>
					<option value="posts_grid_layout_1" <?php echo $cat_feature_post_layout=='posts_grid_layout_1'?'selected="selected"':'' ?>><?php esc_html_e('Posts Grid Layout 1','newstube') ?></option>
					<option value="posts_grid_layout_2" <?php echo $cat_feature_post_layout=='posts_grid_layout_2'?'selected="selected"':'' ?>><?php esc_html_e('Posts Grid Layout 2','newstube') ?></option>
					<option value="posts_grid_layout_3" <?php echo $cat_feature_post_layout=='posts_grid_layout_3'?'selected="selected"':'' ?>><?php esc_html_e('Posts Grid Layout 3','newstube') ?></option>
					<option value="posts_slider" <?php echo $cat_feature_post_layout=='posts_slider'?'selected="selected"':'' ?>><?php esc_html_e('Posts Slider','newstube') ?></option>
					<option value="posts_classic_slider_layout_1" <?php echo $cat_feature_post_layout=='posts_classic_slider_layout_1'?'selected="selected"':'' ?>><?php esc_html_e('Posts Classic Slider Layout 1','newstube') ?></option>
					<option value="posts_classic_slider_layout_1" <?php echo $cat_feature_post_layout=='posts_classic_slider_layout_1'?'selected="selected"':'' ?>><?php esc_html_e('Posts Classic Slider Layout 2','newstube') ?></option>
					<option value="posts_carousel" <?php echo $cat_feature_post_layout=='posts_carousel'?'selected="selected"':'' ?>><?php esc_html_e('Posts Carousel','newstube') ?></option>
					<option value="posts_thumb_slider" <?php echo $cat_feature_post_layout=='posts_thumb_slider'?'selected="selected"':'' ?>><?php esc_html_e('Posts Thumb Slider','newstube') ?></option>
					<option value="posts_parallax" <?php echo $cat_feature_post_layout=='posts_parallax'?'selected="selected"':'' ?>><?php esc_html_e('Posts Parallax','newstube') ?></option>
					<option value="smart_content_box_layout_1" <?php echo $cat_feature_post_layout=='smart_content_box_layout_1'?'selected="selected"':'' ?>><?php esc_html_e('Smart Content Box Layout 1','newstube') ?></option>
					<option value="smart_content_box_layout_2" <?php echo $cat_feature_post_layout=='smart_content_box_layout_2'?'selected="selected"':'' ?>><?php esc_html_e('Smart Content Box Layout 2','newstube') ?></option>
					<option value="smart_content_box_layout_3" <?php echo $cat_feature_post_layout=='smart_content_box_layout_3'?'selected="selected"':'' ?>><?php esc_html_e('Smart Content Box Layout 3','newstube') ?></option>
					<option value="smart_content_box_layout_4" <?php echo $cat_feature_post_layout=='smart_content_box_layout_4'?'selected="selected"':'' ?>><?php esc_html_e('Smart Content Box Layout 4','newstube') ?></option>
					<option value="smart_content_box_layout_5" <?php echo $cat_feature_post_layout=='smart_content_box_layout_5'?'selected="selected"':'' ?>><?php esc_html_e('Smart Content Box Layout 5','newstube') ?></option>
					<option value="smart_content_box_layout_6" <?php echo $cat_feature_post_layout=='smart_content_box_layout_6'?'selected="selected"':'' ?>><?php esc_html_e('Smart Content Box Layout 6','newstube') ?></option>
				</select>
				<p class="description"><?php esc_html_e('Choose layout for Featured Posts section','newstube'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="number-of-featured-posts"><?php esc_html_e('Number of featured posts','newstube'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo $number_featured_posts == '' ? '5' : $number_featured_posts;?>" name="number-of-featured-posts"/>
				<p class="description"><?php esc_html_e('Number of featured posts to display','newstube'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="wall-ads-1-adsense"><?php esc_html_e('Wall Ads Left - Adsense Slot','newstube'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo $wall_ads_1_adsense;?>" name="wall-ads-1-adsense"/>
				<p class="description"><?php esc_html_e('Enter Google Adsense Slot ID','newstube'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="wall-ads-1-custom"><?php esc_html_e('Wall Ads Left - Custom Code','newstube'); ?></label>
			</th>
			<td>
				<textarea name="wall-ads-1-custom" cols="40" rows="5"><?php echo stripslashes($wall_ads_1_custom);?></textarea>
				<p class="description"><?php esc_html_e('Enter custom HTML ads for this position if you do not use Google Adsense','newstube'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="wall-ads-2-adsense"><?php esc_html_e('Wall Ads Right - Adsense Slot','newstube'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo $wall_ads_2_adsense;?>" name="wall-ads-2-adsense"/>
				<p class="description"><?php esc_html_e('Enter Google Adsense Slot ID','newstube'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="wall-ads-2-custom"><?php esc_html_e('Wall Ads Right - Custom Code','newstube'); ?></label>
			</th>
			<td>
				<textarea name="wall-ads-2-custom" cols="40" rows="5"><?php echo stripslashes($wall_ads_2_custom);?></textarea>
				<p class="description"><?php esc_html_e('Enter custom HTML ads for this position if you do not use Google Adsense','newstube'); ?></p>
			</td>
		</tr>
	<?php
	}

	function save_extra_category_fileds( $term_id ) {
		if ( isset( $_POST[sanitize_key('category-layout')] ) ) {
			$cat_layout = $_POST['category-layout'];
			update_option( "cat_layout_$term_id", $cat_layout );
		}
		if ( isset( $_POST[sanitize_key('blog-layout')] ) ) {
			$blog_layout = $_POST['blog-layout'];
			update_option( "blog_layout_$term_id", $blog_layout );
		}
		if ( isset( $_POST[sanitize_key('cat-feature-post-layout')] ) ) {
			$cat_feature_post_layout = $_POST['cat-feature-post-layout'];
			update_option( "cat_feature_post_layout_$term_id", $cat_feature_post_layout );
		}

		if ( isset( $_POST[sanitize_key('number-of-featured-posts')] ) ) {
			$number_featured_posts = $_POST[sanitize_key('number-of-featured-posts')];
			update_option( "number_featured_posts_$term_id", $number_featured_posts );
		}

		if ( isset( $_POST[sanitize_key('wall-ads-1-adsense')] ) ) {
			$wall_ads_1_adsense = $_POST[sanitize_key('wall-ads-1-adsense')];
			update_option( "wall_ads_1_adsense_$term_id", $wall_ads_1_adsense );
		}

		if ( isset( $_POST[sanitize_key('wall-ads-1-custom')] ) ) {
			$wall_ads_1_custom = $_POST['wall-ads-1-custom'];

			update_option( "wall_ads_1_custom_$term_id", $wall_ads_1_custom );
		}

		if ( isset( $_POST[sanitize_key('wall-ads-2-adsense')] ) ) {
			$wall_ads_2_adsense = $_POST[sanitize_key('wall-ads-2-adsense')];
			update_option( "wall_ads_2_adsense_$term_id", $wall_ads_2_adsense );
		}

		if ( isset( $_POST[sanitize_key('wall-ads-2-custom')] ) ) {
			$wall_ads_2_custom = $_POST['wall-ads-2-custom'];
			update_option( "wall_ads_2_custom_$term_id", $wall_ads_2_custom );
		}

		if ( isset( $_POST[sanitize_key('cat-color')] ) ) {
			$cat_color = $_POST['cat-color'];
			update_option( "cat_color_$term_id", $cat_color );
		}

		if ( isset( $_POST[sanitize_key('cat-text-color')] ) ) {
			$cat_color = $_POST['cat-text-color'];
			update_option( "cat_text_color_$term_id", $cat_color );
		}

		if ( isset( $_POST[sanitize_key('cat-bg')] ) ) {
			$cat_bg = $_POST['cat-bg'];
			update_option( "cat_bg_$term_id", $cat_bg );
		}

		if ( isset( $_POST[sanitize_key('cat-bg-link')] ) ) {
			$cat_bg_link = $_POST['cat-bg-link'];
			update_option( "cat_bg_link_$term_id", $cat_bg_link );
		}
	}
	
	public function init(){
		
	}
}

$newstube_category_metadata = new newstube_category_metadata();
