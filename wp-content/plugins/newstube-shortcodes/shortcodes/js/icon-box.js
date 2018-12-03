// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_icon_box', function(editor, url) {
		editor.addButton('cactus_icon_box', {
			text: '',
			tooltip: 'Icon Box',
			id: 'cactus_icon_box_shortcode',
			// icon: 'icon-box',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Icon Box',
					body: [
						{type: 'listbox',
							name: 'layout',
							label: 'Layout',
							'values': [
								{text: 'Center', value: 'center'},
								{text: 'Left', value: 'left'},
								{text: 'Right', value: 'right'}
							]
						},
						{type: 'textbox', name: 'icon', label: 'Icon - Font Awesome', multiline: false},
						{type: 'textbox', name: 'title', label: 'Title', multiline: true},
						{type: 'textbox', name: 'content', label: 'Content', multiline: true},
					],
					onsubmit: function(e) {
						 var icon = e.data.icon? e.data.icon:'';
						 var title = e.data.title? e.data.title:'';
						 var content = e.data.content? e.data.content:'';

						 editor.insertContent('[xicon-box-group]'+
						 '[xicon-box layout="' + e.data.layout + '" icon="'+icon+'" title="'+title+'"]'+content+'[/xicon-box]'+
						 '[xicon-box layout="' + e.data.layout + '" icon="'+icon+'" title="'+title+'"]'+content+'[/xicon-box]'+
						 '[xicon-box layout="' + e.data.layout + '" icon="'+icon+'" title="'+title+'"]'+content+'[/xicon-box]'+
						 '[/xicon-box-group]');

					}
				});
			}
		});
	});
})();
