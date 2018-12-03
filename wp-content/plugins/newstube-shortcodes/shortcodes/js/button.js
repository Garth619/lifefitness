// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_button', function(editor, url) {
		editor.addButton('cactus_button', {
			text: '',
			tooltip: 'Button',
			id: 'cactus_button_shortcode',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Button',
					body: [
						{type: 'textbox', name: 'text', label: 'Button Text'},
						{type: 'textbox', name: 'href', label: 'Button Link', value:"#"},
						{type: 'textbox', name: 'bg_color', label: 'Background Color', value:"#222"},
						{type: 'textbox', name: 'bg_hover', label: 'Background Color Hover', value:"#555"},
						{type: 'textbox', name: 'text_color', label: 'Text Color'},
						{type: 'textbox', name: 'text_hover', label: 'Text Color Hover', value:"#fff"},
						{type: 'listbox',
							name: 'target',
							label: 'Target',
							'values': [
								{text: 'Open link in current windows', value: '0'},
								{text: 'Open link in new windows', value: '1'},
							]
						},
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						editor.insertContent('[button href="'+e.data.href+'" target="'+e.data.target+'" bg_color="'+e.data.bg_color+'" bg_hover="'+e.data.bg_hover+'" text_color="'+e.data.text_color+'" text_hover="'+e.data.text_hover+'"]'+e.data.text+'[/button]');
					}
				});
			}
		});
	});
})();
