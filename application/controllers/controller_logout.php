<?php

class controller_logout extends Controller
{
	
	function action_index()
	{	
        if(isset($_SESSION['auth'])){
            unset($_SESSION['auth']);
            header("location: http://".$_SERVER['HTTP_HOST']);
            
		}
        else{
            Route::ErrorPage404();
        }
	}
}