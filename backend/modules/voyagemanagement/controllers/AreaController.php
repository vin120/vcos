<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;

class AreaController extends Controller
{
	public function actionArea(){
		/*
		if(isset($_GET['code'])){
			$code = isset($_GET['code'])?$_GET['code']:'';
			$sql = "DELETE FROM `v_c_area` WHERE area_code = '{$code}'";
			$count = Yii::$app->db->createCommand($sql)->execute();
			$sql = "DELETE FROM `v_c_area_i18n` WHERE area_code = '{$code}'";
			Yii::$app->db->createCommand($sql)->execute();
			if($count>0){
				Helper::show_message('Delete the success ', Url::toRoute(['area']));
			}else{
				Helper::show_message('Delete failed ');
			}
		
			//return $this->redirect(['country']);
		}
		if($_POST){
			$ids = implode('\',\'', $_POST['ids']);
			$sql = "DELETE FROM `v_c_area` WHERE area_code in ('$ids')";
			$count = Yii::$app->db->createCommand($sql)->execute();
			$sql = "DELETE FROM `v_c_area_i18n` WHERE area_code in ('$ids')";
			Yii::$app->db->createCommand($sql)->execute();
			if($count>0){
				Helper::show_message('Delete the success ', Url::toRoute(['area']));
			}else{
				Helper::show_message('Delete failed ');
			}
		}*/
		$sql = "SELECT count(*) count FROM `v_c_area`";
		$count = Yii::$app->db->createCommand($sql)->queryOne();
		$sql = "SELECT a.*,b.area_name,b.i18n FROM `v_c_area` a LEFT JOIN `v_c_area_i18n` b ON a.area_code=b.area_code  WHERE b.i18n='en'  limit 10";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		return $this->render("area",['area_result'=>$result,'area_count'=>$count['count'],'area_pag'=>1]);
	}
}