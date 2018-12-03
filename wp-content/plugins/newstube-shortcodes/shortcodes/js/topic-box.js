// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_topic_box', function(editor, url) {
		editor.addButton('cactus_topic_box', {
			text: '',
			tooltip: 'Topic Box',
			id: 'cactus_topic_box_shortcode',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Topic Box',
					body: [
						{type: 'textbox', name: 'title', label: 'Title'},

						{type: 'listbox',
							name: 'layout',
							label: 'Layout',
							'values': [
								{text: 'Layout 1', value: '1'},
								{text: 'Layout 2', value: '2'}
							]
						},

						{type: 'listbox',
							name: 'alignment',
							label: 'Alignment',
							'values': [
								{text: 'Left', value: 'left'},
								{text: 'Right', value: 'right'}
							]
						},

						{type: 'textbox', name: 'count', label: 'Count', value: '3'},

						{type: 'listbox',
							name: 'condition',
							label: 'Condition',
							'values': [
								{text: 'Latest', value: 'latest'},
								{text: 'Most viewed', value: 'view'},
								{text: 'Most Liked', value: 'like'},
								{text: 'Most commented', value: 'comment'},
								{text: 'Title', value: 'title'},
								{text: 'Input(only available when using ids parameter)', value: 'input'},
								{text: 'Random', value: 'random'}
							]
						},

						{type: 'listbox',
							name: 'order',
							label: 'Order',
							'values': [
								{text: 'Descending', value: 'DESC'},
								{text: 'Ascending', value: 'ASC'}
							]
						},

						{type: 'textbox', name: 'cats', label: 'Categories'},

						{type: 'textbox', name: 'tags', label: 'Tags'},

						{type: 'textbox', name: 'ids', label: 'IDs'},

						{type: 'listbox',
							name: 'featured',
							label: 'Featured',
							'values': [
								{text: 'No', value: '0'},
								{text: 'Yes', value: '1'}
							]
						},
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						 //var uID =  Math.floor((Math.random()*100)+1);
						 editor.insertContent('[xtopic title="' + e.data.title + '" layout="' + e.data.layout + '" alignment="' + e.data.alignment + '" count="' + e.data.count + '" condition="' + e.data.condition + '" order="' + e.data.order + '" tags="' + e.data.tags + '" featured="' + e.data.featured + '" ids="' + e.data.ids + '" cats="' + e.data.cats + '"]');
					}
				});
			}
		});
	});
})();
