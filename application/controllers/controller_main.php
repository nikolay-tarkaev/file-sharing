<?php

class Controller_Main extends Controller
{
	function __construct()
	{
		$this->model = new Model_Files();
		$this->view = new View();
	}

	function action_index()
	{	
		$count_files = $this->model->count();
		$limit = 6;
		$count_page = ceil($count_files / $limit);
		
		if(isset($_GET['page'])){
			$page = htmlspecialchars(trim($_GET['page']));
			$page = (int)$page;
			if($page > $count_page or $page < 1){
				Route::ErrorPage404();
			}
			$offset = ($page - 1) * $limit;
		}
		else {
			$offset = 0;
		}
		
		$pagination = new pagination($count_files, $limit, $offset, "main");
		
		$data['count'] = $count_files;
	    $data['posts'] = $this->model->get_files($limit, $offset);
		$data['pagination'] = $pagination;
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
	
	function action_ajax()
	{	
		if(isset($_FILES['file_upload'])){
	
			$file_upload_name = htmlspecialchars(trim($_POST['file_name']));
			$file_upload_passw = htmlspecialchars(trim($_POST['file_passw']));
			$file_upload_description = htmlspecialchars(trim($_POST['file_description']));
			$file_upload = $_FILES['file_upload'];
			
			$unknown_error = array('error' => '1', 'info' => 'Неизвестная ошибка! Попробуйте ещё раз');
			
			$upload_file_form = new upload_file_form;
			
			if(!$check_error = $upload_file_form->check($file_upload_name, $file_upload_passw, $file_upload)){
				echo json_encode($unknown_error);
				exit;
			} //return array('error', 'info')
			
			if($check_error['error'] == '1'){
				echo json_encode($check_error);
				exit;
			}
			
			if(!$file_type = $upload_file_form->get_type_file($file_upload)){
				echo json_encode($unknown_error);
				exit;
			} //return $var
			
			if(!$file_size = $upload_file_form->get_size_file($file_upload)){
				echo json_encode($unknown_error);
				exit;
			} //return $var
			
			if(!$last_number = $this->model->get_last_number_file()){
				echo json_encode($unknown_error);
				exit;
			} //return $var
			
			if(!$new_name_file = $upload_file_form->rename_file($file_type, $last_number)){
				echo json_encode($unknown_error);
				exit;
			} //return array('number' => '', 'new_name' => '')
			
			$new_number = $new_name_file['number'];
			
			if(!$save_file_dir = $upload_file_form->save_file_dir($file_upload, $new_name_file['new_name'])){
				echo json_encode($unknown_error);
				exit;
			} //return array('error' => '', 'info' => '')
			if($save_file_dir['error'] == '1'){
				echo json_encode($save_file_dir);
				exit;
			}
			
			$save_to_db = $this->model->create(array('file_name' => $file_upload_name,
													 'file_description' => $file_upload_description,
													 'file_passw' => $file_upload_passw,
													 'file_number' => $new_number,
													 'file_extension' => $file_type,
													 'file_size' => $file_size));
													 
			echo json_encode(array('error' => '0', 'info' => 'Файл сохранен'));
			
		}
		elseif($_GET['delete_file']){
			$file_id = htmlspecialchars(trim($_GET['file_id']));
			$file_passw = htmlspecialchars(trim($_GET['file_passw']));
			if(empty($file_passw)){
				echo json_encode(array('error' => '1', 'info' => 'Введите пароль'));
				exit;
			}
			$delete_query = $this->model->delete_file($file_id, $file_passw);
				
			if($delete_query == "1"){
				echo json_encode(array('error' => '0', 'info' => ''));
			}
			elseif($delete_query == "0"){
				echo json_encode(array('error' => '1', 'info' => 'Неправильный пароль'));
			}
		}
		else {
			header("location: http://".$_SERVER['HTTP_HOST']);
		}
	}
}