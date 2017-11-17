<?php

class users extends Model
{
	
	public function registration($user_login, $user_hashed_password, $user_email, $user_ip, $user_date_reg, $user_status = "user"){
        
        $this->user_login = $user_login;
        $this->user_password = $user_hashed_password;
        $this->user_email = $user_email;
        $this->user_status = $user_status;
        $this->user_ip = $user_ip;
        $this->date_reg = $user_date_reg;
        
        $this->save();
        
        $last_id['last_id'] = $this->id;
        return $last_id;
    }
    public function check_login_exists($check_login){
        if($this->first(array('conditions' => array('user_login=?', $check_login))) == NULL){
            return "not_exists";
        }
        else {
            return "exists";
        }
    }
    public function check_email_exists($check_email){
        if($this->first(array('conditions' => array('user_email=?', $check_email))) == NULL){
            return "not_exists";
        }
        else {
            return "exists";
        }
    }
    
    public function login($user_login, $user_password){
        $find_user = $this->first(array('conditions' => array('user_login=?', $user_login)));
        if($find_user != NULL){
            
            if(password_verify($user_password, $find_user->user_password)){
                if($find_user->user_delete == 1){
                    return array('error' => '1',
							 'info' => 'Пользователь удален');
                }
                else{
                    return array('error' => '0',
							 'info' => 'Вы авторизированы',
                             'data' => array(
                                       'user_id' => $find_user->id,
                                       'user_login' => $find_user->user_login,
                                       'user_status' => $find_user->user_status)
                                );
                }
                
            }
            else{
                return array('error' => '1',
							 'info' => 'Неправильный логин или пароль');
            }
            
        }
        else {
            return array('error' => '1',
							 'info' => 'Неправильный логин или пароль');
        }
    }
    public function count_users(){
        return $this->count();
    }
}