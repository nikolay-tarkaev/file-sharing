<?php

/**
 * @Note Проверка данных из формы регистрации
 */

    class check_registration_form{
        
        public function empty_check($user_login, $user_password, $user_confirm_password, $user_email, $user_firstname, $user_lastname, $user_sex){
			if(empty($user_login) or empty($user_password) or empty($user_confirm_password) or empty($user_email) or empty($user_firstname) or empty($user_lastname) or empty($user_sex)){
				return array('error' => '1',
							 'info' => 'Заполните обязательные поля');
				exit;
			}
			else {
				return array('error' => '0',
				             'info' => '');
				exit;
			}
		}
		public function login_check($user_login){
			if(!preg_match("|[-0-9a-z_\.]|i", $user_login)) {
                return array('error' => '1',
							 'info' => 'Логин не может иметь кириллицу. Допускаются латинские буквы, цифры, тире, знак подчеркивания, точка');
				exit;
            }
            else {
                return array('error' => '0',
				             'info' => '');
				exit;
            }
		}
        public function password_check($user_password, $user_confirm_password){
			if(iconv_strlen($user_password) < 6) {
                return array('error' => '1',
							 'info' => 'Длина пароля должна быть не менее 6 символов');
				exit;
            }
            elseif(iconv_strlen($user_password) > 255) {
                return array('error' => '1',
							 'info' => 'Слишком длинный пароль');
				exit;
            }
            elseif(!preg_match("/^[0-9A-Za-z@#\-_$%^&+=§!\?]{6,255}$/", $user_password)) {
                return array('error' => '1',
							 'info' => 'Некорректный пароль, содержит либо кириллицу, либо недопустимые знаки');
				exit;
            }
            elseif($user_password != $user_confirm_password) {
                return array('error' => '1',
							 'info' => 'Пароли не совпадают');
				exit;
            }
            else {
                return array('error' => '0',
				             'info' => '');
				exit;
            }
		}
		public function email_check($user_email){
			if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $user_email)) {
                return array('error' => '1',
							 'info' => 'Некорректный email');
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