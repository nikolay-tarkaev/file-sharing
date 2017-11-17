<?php

class controller_registration extends Controller
{
	function __construct()
	{
		$this->model['0'] = new Users();
		$this->model['1'] = new Info_users();
		$this->view = new View();
        $this->template = "default.php";
	}

	function action_index()
	{	
        if(isset($_SESSION['auth'])){
            if($_SESSION['auth'] == TRUE){
                header("location: http://".$_SERVER['HTTP_HOST']);
            }
            else{
                Route::ErrorPage404();
            }
		}
		
        $this->view->generate('registration_view.php', $this->template, $data);
	}
	
	function action_ajax()
	{	
		if(isset($_POST['user_login'])){
            
            $filtration = new filtration_input_data;
            $registration_form = new check_registration_form;
        
            $user_login = $filtration->str_data($_POST['user_login']);
            $user_password = $filtration->str_data($_POST['user_password']);
            $user_confirm_password = $filtration->str_data($_POST['user_confirm_password']);
            $user_email = $filtration->str_data($_POST['user_email']);
            $user_firstname = $filtration->str_data($_POST['user_firstname']);
            $user_lastname = $filtration->str_data($_POST['user_lastname']);
            $user_sex = $filtration->str_data($_POST['user_sex']);
            $user_day = $filtration->int_data($_POST['user_day']);
            $user_month = $filtration->int_data($_POST['user_month']);
            $user_year = $filtration->int_data($_POST['user_year']);
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $user_date_reg = date("d-m-Y");
            
            $empty_check = $registration_form->empty_check($user_login, $user_password, $user_confirm_password, $user_email, $user_firstname, $user_lastname, $user_sex);
            $login_check = $registration_form->login_check($user_login);
            $password_check = $registration_form->password_check($user_password, $user_confirm_password);
            $email_check = $registration_form->email_check($user_email);
            
            if($empty_check['error'] == 0 and $password_check['error'] == 0 and $email_check['error'] == 0){
                
                if($this->model['0']->check_login_exists($user_login) == "exists"){
                    echo json_encode(array('error' => '1', 'info' => 'Пользователь с таким логином уже существует'));
                }
                elseif($this->model['0']->check_email_exists($user_email) == "exists"){
                    echo json_encode(array('error' => '1', 'info' => 'Такой e-mail уже занят'));
                }
                else{
                    $user_hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
                    
                    $count_users = $this->model['0']->count_users();
                    
                    if($count_users == 0){
                        $user_status = "admin";
                    }
                    else {
                        $user_status = "user";
                    }
                    
                    $create_user = $this->model['0']->registration($user_login, $user_hashed_password, $user_email, $user_ip, $user_date_reg, $user_status);
                    $user_info = $this->model['1']->registration($create_user['last_id'], $user_firstname, $user_lastname, $user_sex, $user_day, $user_month, $user_year);
                    echo json_encode(array('error' => '0', 'info' => 'Регистрация успешно завершена'));
                }
                
                
            }
            else {
                if($empty_check['error'] == 1){
                    echo json_encode(array('error' => '1', 'info' => $empty_check['info']));
                }
                elseif($login_check['error'] == 1){
                    echo json_encode(array('error' => '1', 'info' => $login_check['info']));
                }
                elseif($password_check['error'] == 1){
                    echo json_encode(array('error' => '1', 'info' => $password_check['info']));
                }
                elseif($email_check['error'] == 1){
                    echo json_encode(array('error' => '1', 'info' => $email_check['info']));
                }
                else{
                    echo json_encode(array('error' => '1', 'info' =>'Unknown error'));
                }
            }
		}
		else {
			Route::ErrorPage404();
		}
	}
}