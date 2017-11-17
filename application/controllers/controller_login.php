<?php

class controller_login extends Controller
{
	function __construct()
	{
		$this->model = new Users();
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
		
		$this->view->generate('login_view.php', $this->template, $data);
	}
	
	function action_ajax()
	{	
		if(isset($_SESSION['auth'])){
            if($_SESSION['auth'] == TRUE){
                header("location: http://".$_SERVER['HTTP_HOST']);
            }
            else{
                Route::ErrorPage404();
            }
		}
        
        if(isset($_POST['user_login'])){
            
            $filtration = new filtration_input_data;
            $login_form = new check_login_form;
        
            $user_login = $filtration->str_data($_POST['user_login']);
            $user_password = $filtration->str_data($_POST['user_password']);
            
            $empty_check = $login_form->empty_check($user_login, $user_password);
            
            if($empty_check['error'] == 0){
                
                $user_check = $this->model->login($user_login, $user_password);
                if($user_check['error'] == 0){
                    $_SESSION['auth'] = TRUE;
                    $_SESSION['auth'] = array('id' => $user_check['data']['user_id'],
                                              'login' => $user_check['data']['user_login'],
                                              'status' => $user_check['data']['user_status']
                                             );
                    echo json_encode(array('error' => '0', 'info' => 'Вы успешно авторизировались'));
                }
                else{
                    echo json_encode(array('error' => '1', 'info' => $user_check['info']));
                }
                
                
            }
            else {
                if($empty_check['error'] == 1){
                    echo json_encode(array('error' => '1', 'info' => $empty_check['info']));
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