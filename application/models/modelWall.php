<?php

class modelWall extends Model
{
	//Добавляем сообщение / комментарий
	function addMess($message){

		$this-> getredbeans();

	    $mess = R::dispense('messages');

	    // Достаём ID юзера и записываем в Таблицу messages
	     $us= R::findOne( 'users', 'user_fbid = '.$_SESSION['fb_user']['fb_id']);
	     $usr = R::load( 'users', $us['id'], 'LIMIT 1' );
	     $user_id=$usr->id;

	     	//В Случае, если комментарий - заносим его в БД как предка

	     if($message['parrent_mess_id']!='' && $message['mess_lvl']!=''){
	     	
	    	$mess->message=$message['message'];
	    	$mess->mess_time=R::isoDateTime();
	   	    $mess->mess_lvl=$message['mess_lvl'];

	   	    $parr = R::load( 'messages', $message['parrent_mess_id'], 'LIMIT 1'  );
			$mess->ownCommentList = $parr; // Связь Комментарий -> Сообщение/Комментарий
			$mess->ownUsersList=$usr; // Связь Комментарий -> Юзер
    	 
	   	    R::store($mess);

	     } else {
	    	$mess->message=$message['message'];
	    	$mess->mess_time=R::isoDateTime();
	   	    $mess->mess_lvl=$message['mess_lvl'];
	    // так же в БД будет mess_edited_time, которая будет записывать время последнего редактирования
	   	    $mess->ownUsersList=$usr; // Связь Сообщение -> Юзер


	    	R::store($mess);

	     }



	}
	//Редактируем сообщение
	function editMess($message){

		$this-> getredbeans();

		// Делаем проверку на соответствие отправленного юзера и залогиненного юзера 
		//(во избежание подмены параметра user_chech_id перед отправкой формы)
		$us = R::findOne( 'users', 'id = '.$message['user_chech_id'] );
		$usr = R::load( 'users', $us['id'], 'LIMIT 1'  );

		if($usr->user_fbid == $_SESSION['fb_user']['fb_id']){
			$mess = R::load( 'messages', $message['edit_id'], 'LIMIT 1'  );
			$mess->message=$message['message']; // Вносим изменённое сообщение
			$mess->mess_edited_time=R::isoDateTime(); // Добавляем дату последнего измненения
			R::store($mess);

		}

		return($message);

	}

	//Достаём все сообщения и комментарии


	//Функция для получения массива сообщений
	function getMessages(){
			//Функция для получения массива комментариев (всех уровней вложенности)
			function getComments($id){
					//Получаем все комментарии для заданного ID родителя и сортируем
				$comments = R::find('messages', 'ownComment_id = ?  ORDER BY mess_time', [$id]);	

					foreach ($comments as &$comm) {

							//Подготавливаем $comments, изменяя $comm через оператор &
						$comm['id']=$comm->id;
						$comm['user_id']=$comm->ownUsers_id;

							//Данные, связанные с юзером (Имя, Аватар)
				     	$user = R::load( 'users', $comm['user_id'], 'LIMIT 1'  );
				     	$comm['user_fbid']=$user->user_fbid;
						$comm['name']=$user->name;
						$comm['image']=$user->image;


						$comm['message']=$comm->message;
						$comm['mess_time']=$comm->mess_time;
						$comm['parrent_mess_id']=$comm->ownComment_id;
						$comm['mess_lvl']=$comm->mess_lvl;
						$comm['mess_edited_time']=$comm->mess_edited_time;


						
						//Если у какого-либо комментария есть связь 
						//Связь Комментарий -> Сообщение/Комментарий -> Вызываем функцию getComments

						// Если нет Комментариев для этого сообщения - $comm['parrents']=NULL
						if(!$parr = R::findOne( 'messages', 'ownComment_id = '.$comm['id'] )){
							$comm['parrents']=NULL;
						} else {				
						// Если комментарии есть = получаем их и заносим в массив;			
							$comm['parrents']=getComments($comm['id']);
						}

							//Делаем Unset используемых переменных т.к. используем оператор &
						unset($user);
						unset($comm);

					}

			return $comments;
		}


		$this-> getredbeans();

			//Получаем все сообщения и сортируем
		$messages = R::find('messages', 'mess_lvl = 0  ORDER BY mess_time DESC');

		foreach ($messages as &$mess) {

				//Подготавливаем $messages, изменяя $mess через оператор &
			$mess['id']=$mess->id;
			$mess['user_id']=$mess->ownUsers_id;

				//Данные, связанные с юзером (Имя, Аватар)
	     	$user = R::load( 'users', $mess['user_id'], 'LIMIT 1'  );
	     	$mess['user_fbid']=$user->user_fbid;
			$mess['name']=$user->name;
			$mess['image']=$user->image;


			$mess['message']=$mess->message;
			$mess['mess_time']=$mess->mess_time;
			$mess['parrent_mess_id']=$mess->ownComment_id;
			$mess['mess_lvl']=$mess->mess_lvl;
			$mess['mess_edited_time']=$mess->mess_edited_time;

			//Если у какого-либо сообщения есть связь 
			//Связь Комментарий -> Сообщение/Комментарий -> Вызываем функцию getComments

			// Если нет Комментариев для этого сообщения - $mess['parrents']=NULL
			if(!$parr = R::findOne( 'messages', 'ownComment_id = '.$mess['id'] )){
				$mess['parrents']=NULL;
			} else {
				// Если комментарии есть = получаем их и заносим в массив;
				$mess['parrents']=getComments($mess['id']);

			}
			//Делаем Unset используемых переменных т.к. используем оператор &
			unset($user);
			unset($mess);
		}

		return $messages;
	}


	
}
