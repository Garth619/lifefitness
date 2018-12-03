// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_testimonial', function(editor, url) {
		editor.addButton('cactus_testimonial', {
			text: '',
			tooltip: 'Testimonial',
			id: 'cactus_testimonial_shortcode',
			icon: 'icon-tooltip',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Testimonial',
					body: [
						{type: 'textbox', name: 'number_of_testimonials', label: 'Number of testimonials', value: '3'},
					],
					onsubmit: function(e) {
						var number_of_testimonials 	= e.data.number_of_testimonials;
						var name 					= e.data.name;
						var title 					= e.data.title;
						var avatar 					= e.data.avatar;
						var avatar_url 				= e.data.avatar_url;
						var shortcode = '[xtestimonial scroll="1"]<br class="nc"/>';
						for(i=0;i<number_of_testimonials;i++)
						{
							shortcode+= '[xtestimonial_item name="Your Name" title="You Position" avatar="1" avatar_url=""]Your testimonial content <br class="nc"/>';
							
							shortcode += '[/xtestimonial_item]<br class="nc"/>';
						}
						shortcode+= '[/xtestimonial]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
