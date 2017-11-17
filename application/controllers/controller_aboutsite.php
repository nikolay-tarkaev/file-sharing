<?php

class controller_aboutsite extends Controller
{
	function __construct()
	{
		$this->view = new View();
        $this->template = "default.php";
	}

	function action_index()
	{	
		
		$this->view->generate('aboutsite_view.php', $this->template, $data);
	}
	
	function action_ajax()
	{	
		if($_GET['q']){
			
		}
		else {
			header("location: http://".$_SERVER['HTTP_HOST']);
		}
	}
}