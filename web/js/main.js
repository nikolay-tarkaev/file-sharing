    $(function(){
		var progressBar = $('#progressbar');
		$('#form_upload_file').on('submit', function(e){
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
				xhr: function(){
					var xhr = $.ajaxSettings.xhr();
					xhr.upload.addEventListener('progress', function(evt){
						if(evt.lengthComputable) {
							var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
							progressBar.css('width', percentComplete + '%');
							progressBar.attr('aria-valuenow', percentComplete);
							
						}
					}, false);
					return xhr;
				},
				success: function(json){
					if(json){
						if(json.error == "1"){
                            
                            $('#result_div').text(json.info);
							$('#result_div').addClass('alert alert-danger');
							$('#result_div').removeClass('hidden');
                            $('body,html').animate({scrollTop: 0}, 200);
						}
						else {
							$('#result_div').text(json.info);
                            $('#result_div').addClass('alert alert-success');
							$('#result_div').removeClass('hidden alert-danger');
							setTimeout(function(){window.location.reload()}, 2000);
						}
					}
				}
			});
		});
	});
	function fileSelected() {
        var file = document.getElementById('file_upload').files[0];
        if (file) {
			var fileSize = 0;
			if (file.size > 1024 * 1024)
				fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
			else
				fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';

			document.getElementById('fileName').innerHTML = 'Имя: ' + file.name;
			document.getElementById('fileSize').innerHTML = 'Размер: ' + fileSize;
        }
    }
	function delete_file_modal(file_id, file_name){
		$('.delete_result').html('');
		$('#file_delete_name').text(file_name);
		$('#input_password_delete').val('');
		$('#delete_button').attr("onclick", "delete_file(" + file_id + ");");
		
	}
	function delete_file(file_id){
		var file_passw = $('#input_password_delete').val();
        if($("#checkbox_admin_password_delete").is(":checked")) {  
            var url_delete = '/main/ajax?delete_file=true&file_id='+file_id+'&file_passw='+file_passw+'&admin=1';
        }
        else {
            var url_delete = '/main/ajax?delete_file=true&file_id='+file_id+'&file_passw='+file_passw;
        }
		$.ajax({
			url: url_delete,
			dataType: 'json',
			success: function(data) {
				if(data.error == "1"){
					$('.delete_result').html(data.info);
					$('.delete_result').removeClass('hidden');
				}
				else if(data.error == "0"){
					hidden_deleted_block("block_"+file_id);
					$('#delete_file_modal').modal('hide');
				}
				else {
					$('.delete_result').html("Неизвестная ошибка");
					$('.delete_result').removeClass('hidden');
				}
			}
		});
	}
	function hidden_deleted_block(id_block){
		var block = $('#'+id_block);
		var height_block = block.height();
		block.html("- Файл удален -");
		block.height(height_block);
		block.css({'color' : '#697068', 'font-size' : '20px', 'text-align' : 'center', 'padding-top' : height_block / 2 - 10});
	}
	function check_form(){
		var file_name = $('#file_name').val();
		var file_passw = $('#file_passw').val();
		var file = document.getElementById('file_upload').files[0];
		var file_types = ['avi', 'djvu', 'dll', 'doc', 'docx', 'exe', 'fb2', 'flac', 'flv', 'gif', 
					 'gz', 'iso', 'jpg', 'mkv', 'mp3', 'mp4', 'pdf', 'png', 'ppt', 'pptx', 
					 'rar', 'torrent', 'txt', 'xls', 'xlsx', 'zip'];
		
		if(file_name.length != 0 && file_passw.length != 0){
			var explode_name = file.name.split('.');
			var type_file = explode_name[explode_name.length-1];
			if(file_types.indexOf(type_file) != -1){
				if(file.size <= '104857600'){
					$('#file_submit').removeClass('disabled');
				}
				else {
					$('#file_submit').addClass('disabled');
				}
			}
			else {
				$('#file_submit').addClass('disabled');
			}
		}
		else {
			$('#file_submit').addClass('disabled');
		}
	}