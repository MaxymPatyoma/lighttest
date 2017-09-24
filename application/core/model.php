<?php

class Model
{
	//Подключение ReadBean PHP
	function getredbeans(){

		require_once $_SERVER['DOCUMENT_ROOT'].'/libraries/rb.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/application/config/dbcfg.php';

		//Подключение к базе данных (MySQL)
		R::setup( 'mysql:host='.$dbhost.';dbname='.$dbname.'',
        ''.$dbusername.'', ''.$dbpass.'' );


	}

	//Подключение Facebook SDK PHP
	function fbSdk(){

		require_once $_SERVER['DOCUMENT_ROOT'].'/libraries/fb_sdk_php_v5/vendor/autoload.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/application/config/facebookcfg.php';

		//Создание обьекта Facebook
		 return	$fb = new Facebook\Facebook([
		  'app_id' => FB_ID, 
		  'app_secret' => FB_SECRET,
		  'default_graph_version' => FB_DGV ]);

		

	}



}