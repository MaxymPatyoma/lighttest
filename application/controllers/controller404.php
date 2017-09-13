<?php

class controller404 extends Controller
{
	
	function actionIndex()
	{
		$this->view->generate('404view.php', 'templateview.php');
	}

}