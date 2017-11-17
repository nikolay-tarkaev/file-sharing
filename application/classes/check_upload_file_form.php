<?php

/**
 * @Note Проверка данных из формы form_upload_file
 */

    class check_upload_file_form{
        
        public function check($name, $passw, $file){
			if(empty($name) or empty($passw)){
				return array('error' => '1',
							 'info' => 'Заполните обязательные поля');
				exit;
			}
			elseif(empty($file['name'])){
				return array('error' => '1',
							 'info' => 'Файл не выбран');
				exit;
			}
			elseif($file['size'] > '104857600'){
				return array('error' => '1',
							 'info' => 'Файл слишком большой');
				exit;
			}
			else {
				$types = array('avi', 'djvu', 'dll', 'doc', 'docx', 'exe', 'fb2', 'flac', 'flv', 'gif', 
							   'gz', 'iso', 'jpg', 'mkv', 'mp3', 'mp4', 'pdf', 'png', 'ppt', 'pptx', 
							    'rar', 'torrent', 'txt', 'xls', 'xlsx', 'zip');
				$file_explode = explode(".", $file['name']);
				$file_type = end($file_explode);
				foreach($types as $value){
					if($value == $file_type){
						$type_confirm = true;
						break;
					}
				}
				if(count($file_explode) == 1){
					return array('error' => '1',
								 'info' => 'Файл без расширения');
					exit;
				}
				elseif(!isset($type_confirm)){
					return array('error' => '1',
								 'info' => 'Недопустимое расширение файла');
					exit;
				}
				else {
					return array('error' => '0',
								 'info' => '',
								 'true' => '1');
					exit;
				}
			}
		}
		public function get_type_file($file){
			$file_explode = explode(".", $file['name']);
			return end($file_explode);
		}
		
		public function rename_file($file_type, $last_number){
			function increment($increment){
				$increment = (int)$increment;
				$increment++;
				$increment = (string)$increment;
				return str_pad($increment, 5, "0", STR_PAD_LEFT);
			}
			
			while($last_number = increment($last_number)){
				$file_url = "files/file_" . $last_number . "." . $file_type;
				if(!file_exists($file_url)){
					break;
				}
			}
			return array('number' => $last_number, 'new_name' => "file_" . $last_number . "." . $file_type);
		}
		
		public function save_file_dir($file, $new_name){
			if(move_uploaded_file($file['tmp_name'], "files/" . $new_name)){
				return array('error' => '0', 'info' => '');
			}
			else {
				return array('error' => '1', 'info' => 'Не удалось сохранить файл! Попробуйте ещё раз');
			}
		}
		
		public function get_size_file($file){
			if($file['size'] > 1024 * 1024){
				$file_size = round($file['size'] * 100 / (1024 * 1024) / 100, 2);
				$file_size .= " MB";
			}
			else {
				$file_size = round(($file['size'] * 100 / 1024) / 100, 2);
				$file_size .= " KB";
			}
			return $file_size;
		}
		public static function delete_file($file_number, $file_extension){
			$file = "files/file_" . $file_number . "." . $file_extension;
			unlink($file);
		}
    }

?>