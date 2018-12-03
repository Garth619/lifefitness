// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_shortcode_button', function(editor, url) {
		editor.addButton('cactus_shortcode_button', {
			text: '',
			tooltip: 'Shortcode',
			id: 'bt_listshortcode',
			icon: 'icons',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Shortcode',
					body: [
						{type: 'button', name: 'Alert', text: 'Alert', label: 'Alert' , id: 'id_cactus_alert'},
						{type: 'button', name: 'Button', text: 'Button', label: 'Button' , id: 'id_cactus_button'},
						{type: 'button', name: 'Dropcap', text: 'Dropcap', label: 'Dropcap' , id: 'id_cactus_dropcap'},
						{type: 'button', name: 'Tooltip', text: 'Tooltip', label: 'Tooltip' , id: 'id_cactus_tooltip'},
						{type: 'button', name: 'Download Box', text: 'Download Box', label: 'Download Box' , id: 'id_cactus_download_box'},
						{type: 'button', name: 'Icon Box', text: 'Icon Box', label: 'Icon Box' , id: 'id_cactus_icon_box'},
						{type: 'button', name: 'Divider', text: 'Divider', label: 'Divider' , id: 'id_cactus_divider'},
						{type: 'button', name: 'Live content', text: 'Live content', label: 'Live content' , id: 'id_cactus_live_content'},
						{type: 'button', name: 'Compare Table', text: 'Compare Table', label: 'Compare Table' , id: 'id_cactus_compare_table'},
						{type: 'button', name: 'Post Grid', text: 'Post Grid', label: 'Post Grid' , id: 'id_cactus_posts_grid'},
						{type: 'button', name: 'Post Carousel', text: 'Post Carousel', label: 'Post Carousel' , id: 'id_cactus_posts_carousel'},
						{type: 'button', name: 'Post Classic Slider', text: 'Post Classic Slider', label: 'Post Classic Slider' , id: 'id_cactus_posts_classic_slider'},
						{type: 'button', name: 'Post Parallax', text: 'Post Parallax', label: 'Post Parallax' , id: 'id_cactus_posts_parallax'},
						{type: 'button', name: 'Post Slider', text: 'Post Slider', label: 'Post Slider' , id: 'id_cactus_posts_slider'},
						{type: 'button', name: 'Post Thumb Slider', text: 'Post Thumb Slider', label: 'Post Thumb Slider' , id: 'id_cactus_posts_thumb_slider'},
						{type: 'button', name: 'Smart Content Box', text: 'Smart Content Box', label: 'Smart Content Box' , id: 'id_cactus_smart_content_box'},
						{type: 'button', name: 'Testimonials', text: 'Testimonials', label: 'Testimonials' , id: 'id_cactus_testimonial'},
						{type: 'button', name: 'Topic Box', text: 'Topic Box', label: 'Topic Box' , id: 'id_cactus_topic_box'},
						{type: 'button', name: 'Tab', text: 'Tab', label: 'Tab' , id: 'id_cactus_tab'},
					],
				});
			}
		});
	});
})();



// #cactus_alert_shortcode,
// #cactus_button_shortcode,
// #cactus_collapse_shortcode,
// #cactus_dropcap_shortcode,
// #cactus_row_col_shortcode,
// #cactus_tabs_shortcode,
// #cactus_text_block_shortcode,
// #cactus_tooltip_shortcode,

// #cactus_iconbox_shortcode,
// #cactus_divider_shortcode,
// #cactus_compare_shortcode,
// #cactus_image_column_shortcode,
// #cactus_image_carousel_shortcode {
