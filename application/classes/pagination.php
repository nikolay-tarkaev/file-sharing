<?php

/**
 * @Note Пагинация страниц
 */

    class pagination{
		
		public $count_posts;		// Всего записей
		public $limit;				// Количество записей на странице
		public $offset;				// Пропустить количество файлов
		public $current_page;		// Текущая страница
		public $count_page;			// Количество страниц
		public $controller_name; 	// Имя контроллера
		
        public function __construct($count_posts, $limit, $offset, $controller_name){
			$this->count_posts = $count_posts;
			$this->limit = $limit;
			$this->offset = $offset;
			$this->current_page = $offset / $limit + 1;
			$this->count_page = ceil($count_posts / $limit);
			$this->controller_name = $controller_name;
		}
        
		public function start(){
			
			$pagination_array = array();
			
			if($this->count_page <= 10){
				for($i = 1; $i <= $this->count_page; $i++){
					$iscurrentpage = "";
					if($i == $this->current_page){
						$iscurrentpage = " class='current_page'";
					}
					
					echo "<a href='" . $this->controller_name . "?page=" . $i . "'" . $iscurrentpage . ">&nbsp;" . $i ."&nbsp;</a>";
				}
			}
			else{
				if($this->current_page <= 8){
					for($i = 1; $i <= 10; $i++){
						$iscurrentpage = "";
						if($i == $this->current_page){
							$iscurrentpage = " class='current_page'";
						}
					
						echo "<a href='" . $this->controller_name . "?page=" . $i . "'" . $iscurrentpage . ">&nbsp;" . $i ."&nbsp;</a>";
					}
				}
				else{
					for($i = 1; $i <= 3; $i++){
						$iscurrentpage = "";
						
						echo "<a href='" . $this->controller_name . "?page=" . $i . "'" . $iscurrentpage . ">&nbsp;" . $i ."&nbsp;</a>";
					}
					$current_area_page1 = $this->current_page - 2;
					$current_area_page2 = $this->current_page - 1;
					$current_area_page3 = $this->current_page;
					$current_area_page4 = $this->current_page + 1;
					$current_area_page5 = $this->current_page + 2;
					echo ".&nbsp;.&nbsp;.&nbsp;.&nbsp;.";
					echo "<a href='" . $this->controller_name . "?page=" . $current_area_page1 . "'>&nbsp;" . $current_area_page1 ."&nbsp;</a>";
					echo "<a href='" . $this->controller_name . "?page=" . $current_area_page2 . "'>&nbsp;" . $current_area_page2 ."&nbsp;</a>";
					echo "<a href='" . $this->controller_name . "?page=" . $current_area_page3 . "' class='current_page'>&nbsp;" . $current_area_page3 ."&nbsp;</a>";
					
					if($current_area_page4 < $this->count_page + 1){
						echo "<a href='" . $this->controller_name . "?page=" . $current_area_page4 . "'>&nbsp;" . $current_area_page4 ."&nbsp;</a>";
					}
					if($current_area_page5 < $this->count_page + 1){
						echo "<a href='" . $this->controller_name . "?page=" . $current_area_page5 . "'>&nbsp;" . $current_area_page5 ."&nbsp;</a>";
					}
				}
			}
		}
    }

?>