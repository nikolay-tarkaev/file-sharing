<?php

class controller_404 extends Controller
{
    function __construct()
	{
        $this->view = new View();
        $this->template = "default.php";
	}
	
	function action_index()
	{
		$this->view->generate('404_view.php', $this->template);
	}

}
