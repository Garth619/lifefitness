// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_download_box', function(editor, url) {
		editor.addButton('cactus_download_box', {
			text: '',
			tooltip: 'Download Box',
			id: 'cactus_download_box_shortcode',
			// icon: 'icon-box',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Download Box',
					body: [
						{type: 'textbox', name: 'icon', label: 'Icon - Font Awesome', multiline: false},
						{type: 'textbox', name: 'text', label: 'Text', multiline: true},
						{type: 'textbox', name: 'url', label: 'URL', multiline: true},
						{type: 'listbox',
							name: 'target',
							label: 'Target',
							'values': [
								{text: 'Open link in new windows', value: '1'},
								{text: 'Open link in current windows', value: '0'},
							]
						},
					],
					onsubmit: function(e) {
						 editor.insertContent('[xdownload icon="' + e.data.icon + '" text="' + e.data.text + '" url="' + e.data.url + '" target="' + e.data.target + '"]');

					}
				});
			}
		});
	});
})();
