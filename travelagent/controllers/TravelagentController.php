<?php
namespace travelagent\controllers;

use Yii;
use yii\web\Controller;

class TravelagentController  extends Controller
{
	public $layout = 'myloyout';
	public function actionAgentinfo()
	{
		$travel_agent_id=23;
		$sql="select * from v_travel_agent where travel_agent_id='$travel_agent_id'";
		$data= Yii::$app->db->createCommand($sql)->queryAll();
		return $this->render("agentinfo",array('data'=>$data));
	}
	public function actionCheckpassword()
	{//密码查询
	
		$travel_agent_id=23;
		
		//$password=isset($_POST['pay_password'])?$_POST['pay_password']:'';
		$password=23;
		$sql="select pay_password from v_travel_agent where travel_agent_id='$travel_agent_id' and pay_password='$password'";
		$data= Yii::$app->db->createCommand($sql)->queryAll();
		if (!empty($data)){
		echo json_encode(array(0=>1));
		
		}
		else{
		echo json_encode(array(0=>0));
			
		}
		
	}
}