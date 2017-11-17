<?php

/**
 * @Note Проверка данных из формы входа
 */

    class check_login_form{
        
        public function empty_check($user_login, $user_password){
			if(empty($user_login) or empty($user_password)){
				return array('error' => '1',
							 'info' => 'Заполните поля');
				exit;
			}
			else {
				return array('error' => '0',
				             'info' => '');
				exit;
			}
		}
    }

?>