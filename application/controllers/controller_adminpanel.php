<?php

class controller_adminpanel extends Controller
{
	function __construct()
	{
		//$this->model = new Files();
		$this->view = new View();
        $this->template = "default.php";
        $this->adminpanel = new adminpanel;
	}

	function action_index()
	{	
        if(isset($_SESSION['auth'])){
            if($_SESSION['auth']['status'] != "admin"){
                Route::ErrorPage404();
            }
		}
        else{
            Route::ErrorPage404();
        }
        
        if(isset($_GET['stat'])){
            $num = htmlspecialchars(trim($_GET['stat']));
        }
        else {
            $num = 50;    
        }
        
        
        
		
		$this->view->generate('adminpanel_view.php', $this->template, $data = array('col' => $this->adminpanel->stat_col($num),'file' => $this->adminpanel->stat_file()));
	}
	
	function action_ajax()
	{	
		if(isset($_POST['f'])){
            
            
		}
		else {
			Route::ErrorPage404();
		}
	}
}