    $(function(){
		$('#login_form').on('submit', function(e){
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
							$('#login_result').text(json.info);
							$('#login_result').addClass('alert alert-danger');
							$('#login_result').removeClass('hidden');
                            $('body,html').animate({scrollTop: 0}, 200); 
						}
                        else {
                            window.location.href = "/";
                        }
					}
				}
			});
		});
	});