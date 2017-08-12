<script type="text/javascript">
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
					var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
					xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
						if(evt.lengthComputable) { // если известно количество байт
							// высчитываем процент загруженного
							var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
							// устанавливаем значение в атрибут value тега <progress>
							// и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
							//progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
							progressBar.css('width', percentComplete + '%');
							progressBar.attr('aria-valuenow', percentComplete);
							
						}
					}, false);
					return xhr;
				},
				success: function(json){
					if(json){
						//$that.after(json.error + " " + json.info);
						//$that.after(json);
						if(json.error == "1"){
							$('#result_div').text(json.info);
							$('#result_div').removeClass('hidden');
							$('#result_div').css({'backgroundColor' : '#bd8080'});
						}
						else {
							$('#result_div').text(json.info);
							$('#result_div').removeClass('hidden');
							$('#result_div').css({'backgroundColor' : '#98c28d'});
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
			document.getElementById('fileType').innerHTML = 'Тип: ' + file.type;
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
		$.ajax({
			url: '<?php echo $host; ?>main/ajax?delete_file=true&file_id='+file_id+'&file_passw='+file_passw,
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
</script>

<div id="delete_file_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Удалить файл</h4>
      </div>
      <!-- Основное содержимое модального окна -->
	  <div class="delete_result"></div>
      <div class="modal-body" style="word-wrap: break-word;">
        Введите пароль для удаления файла "<span id="file_delete_name"></span>":<br /><br />
		<form>
			<div class="form-group">
				<input type="password" class="form-control" id="input_password_delete" placeholder="Введите пароль">
			</div>
		</form>
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="delete_button">Удалить</button>
      </div>
    </div>
  </div>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a class="tabnav" data-toggle="tab" href="#download_file">Загруженные файлы</a></li>
	<li><a class="tabnav" data-toggle="tab" href="#upload_file">Загрузить файл</a></li>
</ul>
 
<div class="tab-content">
	<!-- Панель 1 -->
	<div id="download_file" class="tab-pane fade in active">
		<h3>Список файлов (<?php echo $data['count']; ?>)</h3>
		<hr />
		<?php
			if($data['count'] == 0){
				echo "<div class='text-center'>Файлы не найдены. Воспользуйтесь формой для загрузки файлов, чтобы загрузить первый файл.</div>";
			}
			else{
				foreach($data['posts'] as $value){
					?>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 posts" id="block_<?php echo $value->id; ?>">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name_file">
								<?php echo $value->file_name; ?>
							</div>
							<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 well description_file">
								<?php 
									if(empty($value->file_description)){
										echo "<div style='margin-top:39px; color: #999999; font-size: 16px; text-align: center;'>- описание отсутствует -</div>";
									}
									else{
										echo $value->file_description;
									}
								?>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom_file">
								<div class="col-lg-6 col-md-4 col-sm-6 col-xs-6 text-left">
									<?php echo "." . $value->file_extension . " (" . $value->file_size . ")"; ?>
								</div>
								<div class="col-lg-6 col-md-8 col-sm-6 col-xs-6 text-right">
									<a href="#delete_file_modal" class="btn btn-default" data-toggle="modal" onclick="delete_file_modal('<?php echo $value->id . "', '" . $value->file_name; ?>')">Удалить</a> 
									<a href="<?php echo "files/file_" . $value->file_number . "." . $value->file_extension; ?>" class="btn btn-primary">Скачать</a>
								</div>
							</div>
						</div>
					<?php
				}
			}
			
		?>
		<div class="col-xs-12 my_pagination">
			<?php 	
				$data['pagination']->start();
				echo "\n";
			?>
		</div>
	</div>
	
	<!-- Панель 2 -->
	<div id="upload_file" class="tab-pane fade">
		<h3>Загрузить файл</h3>
		<p>
			<hr />
			Размер файла не должен превышать 100 Mb<br />
			Поддерживаемые расширения файлов: 
			<span>
				avi, djvu, dll, doc, docx, exe, fb2, flac, flv, gif, gz, iso, jpg, mkv, mp3, mp4, pdf, png, ppt, pptx, rar, torrent, txt, xls, xlsx, zip<br />
			</span>
			<hr />
		</p>
		
		
		<form role="form" method="POST" action="<?php echo $host; ?>main/ajax" id="form_upload_file" enctype="multipart/form-data" class="well form-horizontal">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center well hidden" style="color: #fff; font-size:1.3em;" id="result_div"></div>
			<div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
				<div class="form-group">
					<label for="file_name" class="control-label col-lg-5 col-md-5 col-sm-4 hidden-xs">Название файла *:</label>	
					<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
						<input name="file_name" id="file_name" type="text"  class="form-control" placeholder="Название файла" maxlength="100" onchange="check_form();" /> 
					</div>
				</div>
				<div class="form-group">
					<label for="passw" class="control-label col-lg-5 col-md-5 col-sm-4 hidden-xs" >Пароль для удаления *:</label>	  
					<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
						<input name="file_passw" id="file_passw" type="text" class="form-control" placeholder="Пароль для удаления" onchange="check_form();" /> 
					</div>
				</div>
				<div class="form-group">
					<label for="passw" class="control-label col-lg-5 col-md-5 col-sm-4 hidden-xs" >Описание:</label>	  
					<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
						<textarea name="file_description" id="file_description" class="form-control" placeholder="Описание"></textarea>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
				<div class="form-group">
					<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12 col-lg-offset-0 col-md-offset-0 col-sm-offset-4 col-xs-offset-0">
						<input type="file" name="file_upload" id="file_upload"  onchange="fileSelected(); check_form();" class="form-control" />
						<!--<progress style="width:100%; height: 30px; margin:10px 0 10px 0;" id="progressbar" value="0" max="100"></progress>-->
						<div class="progress progress-striped active" style="margin-top:10px;">
							<div class="progress-bar progress-bar-primary" id="progressbar"  role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
						</div>
						</div>
						<div id="fileName"></div>
						<div id="fileSize"></div>
						<div id="fileType"></div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
					<input type="submit" name="file_submit" id="file_submit" class="btn btn-info disabled" value="Загрузить" />
				</div>
			</div>
		</form>
	</div>
</div>