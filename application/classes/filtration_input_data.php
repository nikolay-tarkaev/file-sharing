<?php

/**
 * @Note Фильтрация данных введённых пользователем
 */

    class filtration_input_data{
        
        public function __construct(){
            header("Content-Type: text/html; charset=UTF-8");
        }
        
        public function str_data($data, $tags = 1){
            if($tags == 0){
                $data = strip_tags($data);
            }
			$data = trim($data);
            $data = htmlspecialchars($data);
            //$data = addslashes($data);
            return $data;
		}
        
        public function int_data($data){
			$data = intval($data);
            return $data;
		}
    }

?>