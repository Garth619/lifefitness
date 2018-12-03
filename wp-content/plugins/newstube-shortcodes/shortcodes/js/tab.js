// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_tab', function(editor, url) {
		editor.addButton('cactus_tab', {
			text: '',
			tooltip: 'Tab',
			id: 'cactus_tab_shortcode',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Tab',
					body: [
						{type: 'textbox', name: 'box_title', label: 'Box Title', value: 'Smart Box'},
						{type: 'textbox', name: 'title', label: 'Tab Title', value: 'Tab Title'},
						{type: 'textbox', name: 'text_color', label: 'Heading Color', value: ''},
						{type: 'textbox', name: 'bg_color', label: 'Heading Background', value: ''},
						{type: 'textbox', name: 'number_of_tab', label: 'Number of tab', value: '3'},
					],
					onsubmit: function(e) {
						var number_of_tab 	= e.data.number_of_tab;
						var shortcode = '[xtab box_title="'+e.data.box_title+'" text_color="' + e.data.text_color + '" bg_color="' + e.data.bg_color + '"]<br class="nc"/>';
						for(i=0;i<number_of_tab;i++)
						{
							shortcode+= '[xtab_item title="'+e.data.title+'"]Your tab content <br class="nc"/>';

							shortcode += '[/xtab_item]<br class="nc"/>';
						}
						shortcode+= '[/xtab]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
