<?php

/**
 * @Note Автоматическая загрузка классов
 */

    class autoloader_classes{
        
        public function __construct() {
            function autoload($class_name){
                require_once $class_name . ".php";
            }
            spl_autoload_register('autoload');
        }
    }

?>