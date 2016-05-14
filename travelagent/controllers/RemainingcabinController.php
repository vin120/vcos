<?php
namespace travelagent\controllers;

use Yii;
use yii\web\Controller;

class RemainingcabinController extends Controller
{
	public $enableCsrfValidation = false;
	public $layout = 'myloyout';
	public function actionRemaininginfo()
	{
		$voyagesql="select * from v_c_voyage_i18n where i18n='en'";
		$cabintypesql="select * from v_c_cabin_type_i18n where i18n='en'";
		$voyageinfo=\Yii::$app->db->createCommand($voyagesql)->queryAll();
		$cabintypeinfo=\Yii::$app->db->createCommand($cabintypesql)->queryAll();
		return $this->render("remaininginfo",array('voyageinfo'=>$voyageinfo,'cabintypeinfo'=>$cabintypeinfo));
	}
	public function actionGet_remaininginfo(){//请求数据
		$voyage_code=isset($_POST['voyage_code'])?$_POST['voyage_code']:'';
		$type_code=isset($_POST['type_code'])?$_POST['type_code']:'';
		$data=array(
			0=>array('cabin_type'=>'Cabin_type1','deck'=>'10','quantity'=>'Quantity1'),	
			1=>array('cabin_type'=>'Cabin_type2','deck'=>'10','quantity'=>'Quantity2'),
			2=>array('cabin_type'=>'Cabin_type3','deck'=>'10','quantity'=>'Quantity3'),
		);
		\Yii::$app->session['remaininginfo']=$data;
		if ($data){
			echo json_encode($data);
		}
		else{
			echo 0;
		}
	}
	public function actionGet_remaining_page_info(){
		$pag=isset($_POST['pag'])?$_POST['pag']:1;
		$data=array();
		$remaininginfo=\Yii::$app->session['remaininginfo'];
		$j=0;
		$endpage=2*$pag;
		if ($endpage>sizeof($remaininginfo)){
			$endpage=sizeof($remaininginfo);
		}
		for ($i=($pag-1)*2;$i<$endpage;$i++){
			$data[$j]=$remaininginfo[$i];
			$j++;
		}
		if ($data){
		echo json_encode($data);
		}
		else{
			echo 0;
		}
	}
}