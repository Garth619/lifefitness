// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_posts_classic_slider', function(editor, url) {
		editor.addButton('cactus_posts_classic_slider', {
			text: '',
			tooltip: 'Post Classic Slider',
			id: 'cactus_posts_classic_slider_shortcode',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Post Classic Slider',
					body: [
						{type: 'listbox',
							name: 'layout',
							label: 'Layout',
							'values': [
								{text: 'Horizontal', value: 'horizontal'},
								{text: 'Vertical', value: 'vertical'}
							]
						},

						{type: 'textbox', name: 'count', label: 'Count'},

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

						{type: 'listbox',
							name: 'autoplay',
							label: 'Autoplay',
							'values': [
								{text: 'No', value: '0'},
								{text: 'Yes', value: '1'}
							]
						},
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						 //var uID =  Math.floor((Math.random()*100)+1);
						 editor.insertContent('[xclassicslider layout="' + e.data.layout + '" count="' + e.data.count + '" condition="' + e.data.condition + '" order="' + e.data.order + '" tags="' + e.data.tags + '" featured="' + e.data.featured + '" ids="' + e.data.ids + '" cats="' + e.data.cats + '" autoplay="' + e.data.autoplay + '"]');
					}
				});
			}
		});
	});
})();
