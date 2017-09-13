<?php

class Model
{
	//Подключение ReadBean PHP
	function getredbeans(){

		require_once '/../../libraries/rb.php';
		require_once '/../config/dbcfg.php';

		//Подключение к базе данных (MySQL)
		R::setup( 'mysql:host='.$dbhost.';dbname='.$dbname.'',
        ''.$dbusername.'', ''.$dbpass.'' );


	}

	//Подключение Facebook SDK PHP
	function fbSdk(){

		require_once '/../../libraries/fb_sdk_php_v5/vendor/autoload.php';
		require_once '/../config/facebookcfg.php';

		//Создание обьекта Facebook
		 return	$fb = new Facebook\Facebook([
		  'app_id' => FB_ID, 
		  'app_secret' => FB_SECRET,
		  'default_graph_version' => FB_DGV ]);

		

	}



}