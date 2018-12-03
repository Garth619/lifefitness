;(function($){
	$(document).ready(function() {
		$('.submit-poll-button').each(function() {
			var $this = $(this);
			$this.click(function() {
				var $this1 = $(this);
				var poll_id 				= $this1.parents('.cactus-poll-block').attr('data-id');
				var poll_key 				= $this1.parents('.cactus-poll-block').attr('data-key');

				var data_mutilple_choices 	= $this1.parents('.cactus-poll-block').attr('data-mutilple-choices');
				var data_enable_captcha 	= $this1.parents('.cactus-poll-block').attr('data-enable-captcha');
				var data_display_result 	= $this1.parents('.cactus-poll-block').attr('data-display-result-settings');

				var static_text_str 		= $this1.parents('.cactus-poll-block').attr('data-msg-error');

				var static_text             = typeof(static_text_str) != 'undefined' ? static_text_str.split(",") : new Array();

				if(data_enable_captcha == 'yes')
				{
					var g_recaptcha_response = $('#g-recaptcha-response').val();
				}
				else
				{
					var g_recaptcha_response = 'no-captcha';
				}

				var is_choose_answer = true;
				if(data_mutilple_choices == 'yes')
				{
				    if($('input[name="answers' + poll_id  + '[]"]:checked').length == 0)
				    {
				        is_choose_answer = false;
				    }
				}
				else
				{
					$(':radio').each(function(){
					    if($('input[name="answers' + poll_id  + '"]:checked').length == 0)
					    {
					        is_choose_answer = false;
					    }
					});
				}

				if(g_recaptcha_response != '')
				{
					if(is_choose_answer == true)
					{
						if(data_mutilple_choices == 'yes')
						{
							var selected_value = [];
							$('input[name="answers' + poll_id  + '[]"]:checked').each(function()
							{
							    selected_value.push($(this).val());
							});
						}else{
							var selected_value 	= $('input[name="answers' + poll_id  + '"]:checked').val();
						};

						$.ajax(
						{
						    type:   'post',
						    cache: 	false,
						    url:    cactus.ajaxurl,
						    data:   {
						        'poll_id'   			: poll_id,
						        'poll_key'   			: poll_key,
						        'selected_value'   		: selected_value,
						        'g_recaptcha_response'	: g_recaptcha_response,
						        'action'				:'cactus_save_poll'
						    },
						    beforeSend: function() {
						    	$this1.parents('.poll-vote-form').find('.poll-msg-error').remove();
						    	$this1.parents('.poll-vote-form').append('<div class="poll-msg-error" style="padding-top:0">' + static_text[4] + '</div>');
						    	$this1.hide();
						    },
						    success: function(data)
						    {
						    	var responseText = data.slice(0, -1);
								$this1.parents('.poll-vote-form').find('.poll-msg-error').remove();
								
								if(data_display_result == 'after_users_voted')
								{
									$this1.parents('.poll-vote-form-block').hide('slow');
									$this1.parents('.cactus-poll-block').append(responseText);
								}
								else
								{
									if(responseText != 'existed')
									{
										$this1.parents('.poll-vote-form').append('<div class="poll-msg-error" style="padding-top:0">' + static_text[3] + '</div>');
										$this1.remove();
									}
									else
									{
										$this1.parents('.poll-vote-form').append('<div class="poll-msg-error" style="padding-top:0">' + static_text[2] + '</div>');
										$this1.remove();
									}
								}					
						    }
						});
					}
					else
					{
						$this1.parents('.poll-vote-form').find('.poll-msg-error').remove();
						$(this).parents('.poll-vote-form').append('<div class="poll-msg-error">' + static_text[0] + '</div>');
					}
				}
				else
				{
					// alert('hhee');
					$this1.parents('.poll-vote-form').find('.poll-msg-error').remove();
					$(this).parents('.poll-vote-form').append('<div class="poll-msg-error">' + static_text[1] + '</div>');
				}

			});
		});
	});
}(jQuery));
