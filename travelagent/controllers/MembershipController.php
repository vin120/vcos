<?php
namespace travelagent\controllers;

use Yii;
use yii\web\Controller;

class MembershipController extends Controller
{
	public $enableCsrfValidation = false;
	public $layout = 'myloyout';
	public function actionMemberinfo()
	{
	$sql="select * from v_travelagent_membership";
	$data=\Yii::$app->db->createCommand($sql)->queryAll();
     return $this->render("memberinfo",array('data'=>$data));
	}
}