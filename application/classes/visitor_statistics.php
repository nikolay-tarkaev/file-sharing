<?php

/**
 * @Note 
 * 
 */

    class visitor_statistics {
		public $file_stat="../config/stat.log";	// файл для записи истории посещения сайта
		public $col_zap=49999;	// ограничиваем количество строк log-файла
		
		public function getRealIpAddr() {
			if (!empty($_SERVER['HTTP_CLIENT_IP'])){
				$ip=$_SERVER['HTTP_CLIENT_IP']; 
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$ip=$_SERVER['HTTP_X_FORWARDED_FOR']; 
			}
			else {
				$ip=$_SERVER['REMOTE_ADDR']; 
			}
			return $ip;
		}
		
		public function saveStat() {
			if (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexBot')) {
                $bot='YandexBot';
            } //Выявляем поисковых ботов
			elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')) {
                $bot='GoogleBot';}
			else { 
                $bot=$_SERVER['HTTP_USER_AGENT']; 
            }

			$ip = $this->getRealIpAddr();
			$date = date("H:i:s d.m.Y");
			$home = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $user = "- user not registered -";
            
            if(isset($_SESSION['auth'])){
                $user = $_SESSION['auth']['login'];
            }
            
            $home_explode = explode(".", $home);
			if(end($home_explode) != "css" and end($home_explode) != "js" and end($home_explode) != "ico"){
                $lines = file($this->file_stat);
                while(count($lines) > $this->col_zap) array_shift($lines);
                $lines[] = $date."|".$bot."|".$user."|".$ip."|".$home."|\r\n";
                file_put_contents($this->file_stat, $lines);
            }
		}
	}
?>