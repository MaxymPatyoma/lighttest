<?php

class controllerFacebook extends Controller
{
	function __construct(){

		$this->model = new modelFacebook();
		$this->view = new View();
	}


	function actionIndex(){	

		//Получаем URL для логина
		$data = $this->model->fbgetloginlink();

		//Выводим URL
		$this->view->generate('facebookView.php', 'templateView.php', $data);
	}


	function actionCallback(){


		//Получаем токен после нажатия пользователем на Логин URL
		$param = explode('?', $_SERVER['REQUEST_URI']);
		$cd = $param[1];
		$c=array();
		parse_str($cd, $c);
		$code = $c['code'];

			if(strpos($code, '#_=_')!==false){
				// убираем добавленные в последнем обновлении символы #_=_ в конце URL
				$code = substr($code, 0, strstr($code, '#_=_', true)); 
				
			}
		

			//Получаем данные юзера
			$data= $this->model->fbgetUser($code);

			//Заносим юзера в базу данных
			$this->model->sendUserToDb($data['user']);

			//задаём редирект пользователя
			$data['redirect']='/wall';

			$this->view->generate('facebookView.php', 'templateView.php', $data);


	}

	function actionLogout(){

		//ЛогАут
		$this->model->fblogout();
		
		//задаём редирект пользователя
		$data['redirect']='/facebook';
		$this->view->generate('facebookView.php', 'templateView.php', $data);

	}





}