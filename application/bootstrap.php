<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/view.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/route.php';

// Подключаем файлы ядра
Route::start(); //Запускаем маршрутизатор

