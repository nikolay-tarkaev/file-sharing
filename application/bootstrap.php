<?php

// Подключаем файл конфигурации

require_once '../config/config.php';

// Подключаем ActiveRecord

require_once '../lib/activerecord/ActiveRecord.php';

ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('../application/models');
    $cfg->set_connections(array(
        'development' => 'mysql://root:@localhost/file_sharing')); // 'mysql://username:password@hostname/databasename'
});

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

// подключение классов / создание экземпляров классов
require_once 'classes/autoloader_classes.php'; // Автоматическая загрузка классов из "application/classes"
new autoloader_classes;

// Собираем статистику посещений
$getStat = new visitor_statistics;
$getStat->saveStat();



require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
?>