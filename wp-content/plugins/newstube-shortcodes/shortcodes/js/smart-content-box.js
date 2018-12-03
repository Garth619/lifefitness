// JavaScript Document
(function() {
    tinymce.PluginManager.add('cactus_smart_content_box', function(editor, url) {
		editor.addButton('cactus_smart_content_box', {
			text: '',
			tooltip: 'Smart Content Box',
			id: 'cactus_smart_content_box_shortcode',
			icon: 'icon-tooltip',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Smart Content Box',
					body: [
						{type: 'textbox', name: 'title', label: 'Title'},

						{type: 'listbox',
							name: 'layout',
							label: 'Layout',
							'values': [
								{text: 'Layout 1', value: '1'},
								{text: 'Layout 2', value: '2'},
								{text: 'Layout 3', value: '3'},
								{text: 'Layout 4', value: '4'},
								{text: 'Layout 5', value: '5'},
								{text: 'Layout 6', value: '6'}
							]
						},

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

						{type: 'textbox', name: 'items_per_page', label: 'Items per page'},

						{type: 'listbox',
							name: 'enable_cat_filter',
							label: 'Enable cat filter',
							'values': [
								{text: 'Yes', value: '1'},
								{text: 'No', value: '0'}
							]
						},

						{type: 'listbox',
							name: 'show_meta',
							label: 'Show meta',
							'values': [
								{text: 'Yes', value: '1'},
								{text: 'No', value: '0'}
							]
						},

						{type: 'textbox', name: 'heading_color', label: 'Heading color'},

						{type: 'textbox', name: 'heading_bg', label: 'Heading background'},

					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						 //var uID =  Math.floor((Math.random()*100)+1);
						 editor.insertContent('[scb layout="' + e.data.layout + '" title="' + e.data.title + '" condition="' + e.data.condition + '" order="' + e.data.order + '" tags="' + e.data.tags + '" featured="' + e.data.featured + '" ids="' + e.data.ids + '" cats="' + e.data.cats + '" items_per_page="' + e.data.items_per_page + '" enable_cat_filter="' + e.data.enable_cat_filter + '" show_meta="' + e.data.show_meta + '" heading_color="' + e.data.heading_color + '" heading_bg="' + e.data.heading_bg + '"]');
					}
				});
			}
		});
	});
})();
