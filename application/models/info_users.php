<?php

class info_users extends Model
{
	
	public function registration($user_id, $user_firstname, $user_lastname, $user_sex, $day_of_born, $month_of_born, $year_of_born){
        $this->create(array('user_id' => $user_id,
                            'user_firstname' => $user_firstname,
                            'user_lastname' => $user_lastname,
                            'user_sex' => $user_sex,
                            'day_of_born' => $day_of_born,
                            'month_of_born' => $month_of_born,
                            'year_of_born' => $year_of_born)
                     );
    }
}