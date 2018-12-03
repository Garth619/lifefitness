// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_divider', function(editor, url) {
		editor.addButton('cactus_divider', {
			text: '',
			tooltip: 'Divider',
			id: 'cactus_divider_shortcode',
			// icon: 'icon-divider',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Divider',
					body: [
						{type: 'textbox', name: 'title', label: 'Title', multiline: true},
						{type: 'listbox',
							name: 'layout',
							label: 'Layout',
							'values': [
								{text: 'Solid box', value: '1'},
								{text: 'Divider with text', value: '2'},
								{text: 'Simple line', value: '3'},
							]
						},
						{type: 'textbox', name: 'color', label: 'Color', multiline: true},
					],
					onsubmit: function(e) {
						 editor.insertContent('[divider layout="' + e.data.layout + '" color="' + e.data.color + '"]' + e.data.title + '[/divider]');

					}
				});
			}
		});
	});
})();
