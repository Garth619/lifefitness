// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_live_content', function(editor, url) {
		editor.addButton('cactus_live_content', {
			text: '',
			tooltip: 'Live content',
			id: 'cactus_live_content_shortcode',
			// icon: 'icon-divider',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Live content',
					body: [
						{type: 'textbox', name: 'time', label: 'Time', multiline: true},
						{type: 'textbox', name: 'title', label: 'Title', multiline: true},
					],
					onsubmit: function(e) {
						 editor.insertContent('[live time="' + e.data.time + '" title="' + e.data.title + '"]Content here[/live]');

					}
				});
			}
		});
	});
})();
