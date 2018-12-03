var cactus_importer = {};
;(function($){
	cactus_importer.doing = false;
	cactus_importer.do_import = function(pack){
		if(!cactus_importer.doing){
			step = 0;
			
			option_only = $('#import-options-' + pack).is(':checked');

			if(confirm('Install Demo Data:\n' +
						'-----------------------------------------\n' +
						'Are you sure? This will import our predefined settings for the demo (background, template layouts, fonts, colors etc...) and our sample content. \n\n' +
						'Please backup your settings to be sure that you don\'t lose them by accident.\n\n\n' +
						'-----------------------------------------')){
				$('#import-button-' + pack).html('installing...');
				$('#import-progress-' + pack).addClass('loading');
				$('.import-button a').addClass('disabled');
				
				cactus_importer.doing = true;
				cactus_importer.do_import_partial(pack, step, 0, option_only);
			}
		}
	}
	
	cactus_importer.do_import_partial = function(pack, step, index, option_only){
		params = {
					action:'cactus_import',
					pack: pack,
					step: step,
					index: index,
					option_only: (option_only ? 1 : 0)
				};

		$.ajax({
					type: 'post',
					url: ajaxurl,
					dataType: 'html',
					data: params,
					success: function(progress){
						var obj = JSON.parse(progress);
						
						if(obj.error){
							alert(obj.error_message);
						} else {
							progress = obj.total_progress;
							index = obj.index; // index in each progress
							step = obj.step;

							$('#import-progress-' + pack + ' .inner').attr('style', 'width:' + progress + '%');
							
							if(progress >= 100){
								$('#import-button-' + pack).html('Installed!');
								
								// hide progress bar
								$('#import-progress-' + pack + ' .inner').attr('style', 'width:' + 0 + '%');
								$('#import-progress-' + pack).css('background', 'transparent');
								
								cactus_importer.doing = false;
							} else {
								
									cactus_importer.do_import_partial(pack, step, parseInt(index) + 1, option_only);
								
							}
						}
					}
			});
	}
}(jQuery));

jQuery(document).ready(function($){
	
});
