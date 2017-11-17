<?php

/**
 * @Note Панель администратора
 */

    class adminpanel{
		
		function stat_file(){
            return file("../config/stat.log");
	    }
        
        function stat_col($num){
            if($num == "all"){
                return sizeof($this->stat_file());
            }
            else{
                $num = (int)$num;
                
                if(intval($num)){
                    return $num;
                }
                else {
                    return $num = 50;
                }
            }
        }
    }

?>