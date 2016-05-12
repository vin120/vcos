<?php

namespace travelagent\controllers;

use Yii;
use yii\web\Controller;

class ReturningticketController  extends Controller
{
	public $layout = "myloyout";
	
	public function actionReturning_ticket()
	{
		return $this->render('returning_ticket');
	}
}