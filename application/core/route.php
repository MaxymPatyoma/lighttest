<?php

class Route
{
	static function start()
	{
		session_start();
		// Подключаем конфиг
		require_once ('/../config/applicationcfg.php');


		// Контроллер и действие по умолчанию
		$controller_name = $default_controller;
		$action_name = $default_action;
		
		// Разбиваем URL на Контроллер/Екшен
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// Получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// Получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];


		}

		// Добавляем префиксы
		$model_name = 'Model'.$controller_name;
		$controller_name = 'Controller'.$controller_name;
		$action_name = 'action'.$action_name;

		// Подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}

		// Подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}  else {
			//Делаем редирект на страницу 404
			
			Route::ErrorPage404();
		}
		
		// Создаем контроллер
		$controller = new $controller_name;

		// Убираем параметры в URL в названии контроллера для корректной работы
		$ex=explode('?', $action_name);

		$action=$ex[0];

		if(method_exists($controller, $action))
		{
			// Вызываем действие контроллера
			$controller->$action();
		} else {
			//Делаем редирект на страницу 404
			Route::ErrorPage404();
		}
	
	}
	
		
	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}