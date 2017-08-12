<?php

class Model_Files extends Model
{
	
	public function get_last_number_file()
	{
		if($this->last()->file_number == true){
			return $this->last()->file_number;
		}
		else {
			return "00000";
		}
	}
	public function get_files($limit = 5, $offset = 0)
	{
		return $this->find('all', array('select' => 'id, file_name, file_description, file_number, file_extension, file_size', 'limit' => $limit, 'offset' => $offset, 'order' => 'id desc'));
	}
	public function delete_file($id_file, $password){
		$file = $this->find('last', array('conditions' => array('id = ?', $id_file)));
		
		if($file->file_passw == $password){
			upload_file_form::delete_file($file->file_number, $file->file_extension);
			$file->delete();
			return "1";
		}
		else{
			return "0";
		}
	}
}