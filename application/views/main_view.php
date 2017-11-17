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
				<input type="password" class="form-control" id="input_password_delete" placeholder="Введите пароль" />
                <br />
                <?php 
                    if(isset($_SESSION['auth'])){
                        if($_SESSION['auth']['status'] == "admin"){
                            ?>
                                <label class="form-check-label">
                                    <input type="checkbox" id="checkbox_admin_password_delete" class="form-check-input" checked="checked">&nbsp;&nbsp;&nbsp;Удалить от имени администратора
                                </label>
                            <?php
                        }
                    }
                ?>
			</div>
		</form>
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Закрыть</button>
        <button type="button" class="btn btn-danger" id="delete_button"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Удалить</button>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
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
                            <div class="panel panel-primary file_block" id="block_<?php echo $value->id; ?>">
                                <div class="panel-heading">
                                    <h3><?php echo $value->file_name; ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div id="more_<?php echo $value->id; ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<pre><?php 
                                            if(empty($value->file_description)){
                                                echo "<div style='color: #999999; font-size: 16px; text-align: center;'>- описание отсутствует -</div>";
                                            }
                                            else{
                                                echo $value->file_description;
                                            }
                                        ?>
</pre>
                                        <hr />
                                    </div>
                                    <div class="file_properties">
                                        Расширение файла: <b><?php echo "." . $value->file_extension; ?></b> | 
                                        Размер файла: <b><?php echo $value->file_size; ?></b>
                                        <?php
                                            if($value->date_upload != NULL){
                                                ?>
                                                    <br />Дата загрузки: <b><?php echo $value->date_upload; ?></b>
                                                <?php
                                            }
                                        ?>
                                        <?php 
                                            if($value->uploaded_by_user != NULL){
                                                echo "<br />Файл загружен пользователем: <b>" . $value->uploaded_by_user . "</b>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <div class="btn-group btn-group">
                                        <a href="#delete_file_modal" class="btn btn-default" data-toggle="modal" onclick="delete_file_modal('<?php echo $value->id . "', '" . $value->file_name; ?>')"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Удалить</a> 
                                        <a href="<?php echo "files/file_" . $value->file_number . "." . $value->file_extension; ?>" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;&nbsp;Скачать</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }

            ?>
            <div class="col-xs-12 text-center">
                <?php 	
                    $data['pagination']->start();
                    echo "\n";
                ?>
            </div>
        </div>

        <!-- Панель 2 -->
        <div id="upload_file" class="tab-pane fade">
            <h3>Загрузить файл</h3>
            <div>
                <hr />
                Размер файла не должен превышать <b>100 Mb</b><br />
                Поддерживаемые расширения файлов: 
                <span>
                    <b>avi, djvu, dll, doc, docx, exe, fb2, flac, flv, gif, gz, iso, jpg, mkv, mp3, mp4, pdf, png, ppt, pptx, rar, torrent, txt, xls, xlsx, zip</b><br />
                </span>
                <hr />
            </div>


            <form role="form" method="POST" action="<?php echo $host; ?>main/ajax" id="form_upload_file" enctype="multipart/form-data" class="well form-horizontal">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center hidden" id="result_div"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="file_name" class="control-label col-lg-3 col-md-4 col-sm-4 hidden-xs">Название файла *:</label>	
                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                            <input name="file_name" id="file_name" type="text"  class="form-control" placeholder="Название файла" maxlength="100" onchange="check_form();" /> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passw" class="control-label col-lg-3 col-md-4 col-sm-4 hidden-xs" >Пароль для удаления *:</label>	  
                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                            <input name="file_passw" id="file_passw" type="text" class="form-control" placeholder="Пароль для удаления" onchange="check_form();" /> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passw" class="control-label col-lg-3 col-md-4 col-sm-4 hidden-xs" >Описание:</label>	  
                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                            <textarea name="file_description" id="file_description" class="form-control" placeholder="Описание"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-4">
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-12 col-lg-offset-0 col-md-offset-0 col-sm-offset-4 col-xs-offset-0">
                            <input type="file" name="file_upload" id="file_upload"  onchange="fileSelected(); check_form();" class="form-control" />
                            <div class="progress progress-striped active" style="margin-top:10px;">
                                <div class="progress-bar progress-bar-primary" id="progressbar"  role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                            </div>
                            </div>
                            <div id="fileName"></div>
                            <div id="fileSize"></div>
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
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    &nbsp;
</div>