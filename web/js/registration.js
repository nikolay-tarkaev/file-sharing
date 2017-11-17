    $(function(){
		$('#registration_form').on('submit', function(e){
			e.preventDefault();
			var $that = $(this),
			formData = new FormData($that.get(0));
			$.ajax({
				url: $that.attr('action'),
				type: $that.attr('method'),
				contentType: false,
				processData: false,
				data: formData,
				dataType: 'json',
				success: function(json){
					if(json){
                        
						if(json.error == "1"){
							$('#registration_result').text(json.info);
							$('#registration_result').addClass('alert alert-danger');
							$('#registration_result').removeClass('hidden');
                            $('body,html').animate({scrollTop: 0}, 200); 
						}
						else {
							$('#registration_form').addClass('hidden');
							$('#registration_result').text(json.info);
							$('#registration_result').append("<br /> Теперь Вы можете войти на сайт используя свой логин и пароль, или перейти на <a href='<?php echo $host; ?>' class='alert-link'>главную</a> страницу");
							$('#registration_result').removeClass('hidden alert-danger');
							$('#registration_result').addClass('alert alert-success');
						}
                        
					}
				}
			});
		});
	});
    