<?php

class controllerWall extends Controller
{

	function __construct(){

		$this->model = new modelWall();
		$this->view = new View();
	}



	function actionIndex(){	


		//Получаем ID Сообщения для комментария / изменения
		if(isset($_POST['editval'])){
			if($_POST['editval']!=''){
				if($data[$_POST['editval']]['user_fbid']['user_fbid']==$_SESSION['fb_user']['fb_id'])
				$data['editval']=$_POST['editval'];
			}

		}
		if(isset($_POST['commentval'])){
			if($_POST['commentval']!=''){
				$data['commentval']=$_POST['commentval'];
			}
		}

		//Получаем наши сообщения
		$data= $this->model->getMessages();




		$this->view->generate('wallView.php', 'templateView.php', $data);
	}

	function actionMess(){
			//задаём редирект пользователя
			$data['redirect']='/wall';

			//Проверяем на наличие отправленного сообщения
			if(isset($_POST['usermess'])){
				if($_POST['usermess']==''){
					$data['error_mess']=true;
				}
				else {

					//Обробатываем сообщение
					$message = $_POST['usermess'];
					$message = htmlspecialchars($message);

					//Формируем массив для отправки в модель
					$mess= array();

					
					$mess['message']=$message;

					$parrent_mess_id = '';	
					$mess_lvl='';
						//Получаем данные в случае комментирования (через hidden)
					if($_POST['comment_id']!=''){
						list($parrent_mess_id, $mess_lvl) = explode(':', $_POST['comment_id']);
					}


					//если parrent_mess_id отсутствует - присваеваем 0 по умолчанию
					if($parrent_mess_id==''){
						$parrent_mess_id=0;	
					}
					$mess['parrent_mess_id']=$parrent_mess_id;

						//если mess_lvl отсутствует - присваеваем 0 по умолчанию
						if($mess_lvl==''){
						$mess_lvl=0;	
					}

					//Подключаем конфиг для получения переменной $max_comments_nesting  
					//Для регулирования вложенности сообщений
					require_once __DIR__.'/../config/applicationcfg.php';
					//Задаём ограничение на вложенность

					if($_POST['comment_id']!='' && MAX_COMM_NEST>$mess_lvl){
						// +1 для комментария
						$mess_lvl++;
					}
					


					$mess['mess_lvl']=$mess_lvl;

						//Получаем данные в случае редактирования сообщения (через hidden)
					if($_POST['edit_id']!=''){
						list($mess['edit_id'], $mess['user_chech_id']) = explode(':', $_POST['edit_id']);

						//Редактируем сообщение
						$this->model->editMess($mess);

					} else {

						// Добавляем сообщение / комментарий
						$this->model->addMess($mess);
					}
					

					

				}		
			}


			$this->view->generate('wallView.php', 'templateView.php', $data);
	}	
}