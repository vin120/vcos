<?php
namespace travelagent\controllers;

use Yii;
use yii\web\Controller;

class TicketcenterController  extends Controller
{
	public $layout = 'myloyout';
	
	public function actionTicket_center()
	{
		return $this->render('ticket_center');
	}
}