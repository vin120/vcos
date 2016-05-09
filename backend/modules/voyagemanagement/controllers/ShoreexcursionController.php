<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;

use app\modules\voyagemanagement\models\VCShoreExcursionLib;
use app\modules\voyagemanagement\models\VCShoreExcursionLibI18n;


class ShoreexcursionController extends Controller
{




	//shore excursion
	public function actionShore_excursion(){
		if(isset($_GET['code'])){
			$code = isset($_GET['code'])?$_GET['code']:'';
			$sql = "DELETE FROM `v_c_shore_excursion_lib` WHERE se_code = '{$code}'";
			$count = Yii::$app->db->createCommand($sql)->execute();
			$sql = "DELETE FROM `v_c_shore_excursion_lib_i18n` WHERE se_code = '{$code}'";
			Yii::$app->db->createCommand($sql)->execute();
			if($count>0){
				Helper::show_message('Delete the success ', Url::toRoute(['shore_excursion']));
			}else{
				Helper::show_message('Delete failed ');
			}
		}
		if($_POST){
			$ids = implode('\',\'', $_POST['ids']);
			$sql = "DELETE FROM `v_c_shore_excursion_lib` WHERE se_code in ('$ids')";
			$count = Yii::$app->db->createCommand($sql)->execute();
			$sql = "DELETE FROM `v_c_shore_excursion_lib_i18n` WHERE se_code in ('$ids')";
			Yii::$app->db->createCommand($sql)->execute();
			if($count>0){
				Helper::show_message('Delete the success ', Url::toRoute(['shore_excursion']));
			}else{
				Helper::show_message('Delete failed ');
			}
		}
		
		$where = '';
		$w_code = '';
		$w_name = '';
		$w_state = 2;
		if(isset($_GET['w_submit'])){
			$w_code = isset($_GET['w_code'])?$_GET['w_code']:'';
			$w_name = isset($_GET['w_name'])?$_GET['w_name']:'';
			$w_state = isset($_GET['w_state'])?$_GET['w_state']:2;
			
			if($w_code!=''){
				$where .= "a.se_code='{$w_code}' AND ";
			}
			if($w_name!=''){
				$where .= "b.se_name='{$w_name}' AND ";
			}
			if($w_state!=2){
				$where .= "a.status=".$w_state." AND ";
			}
			$where = trim($where,'AND ');
			
		}
		if($where==''){$where = 1;}
		$sql = "SELECT count(*) count FROM `v_c_shore_excursion_lib` a LEFT JOIN `v_c_shore_excursion_lib_i18n` b ON a.se_code=b.se_code WHERE b.i18n='en' AND ".$where;
		$count = Yii::$app->db->createCommand($sql)->queryOne();
		$sql = "SELECT a.*,b.se_name,b.se_info,b.i18n FROM `v_c_shore_excursion_lib` a LEFT JOIN `v_c_shore_excursion_lib_i18n` b ON a.se_code=b.se_code WHERE b.i18n='en' AND ".$where." limit 2";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		return $this->render("shore_excursion",['w_code'=>$w_code,'w_name'=>$w_name,'w_state'=>$w_state,'shore_excursion_result'=>$result,'shore_excursion_count'=>$count['count'],'shore_excursion_pag'=>1]);
	}
	
	//shore_excursion分页
	public function actionGet_shore_excursion_page(){
		$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
		$w_code = isset($_GET['w_code'])?$_GET['w_code']:'';
		$w_name = isset($_GET['w_name'])?$_GET['w_name']:'';
		$w_state = isset($_GET['w_state'])?$_GET['w_state']:2;
		$where = '';
		if($w_code!=''){
			$where .= "a.se_code='{$w_code}' AND ";
		}
		if($w_name!=''){
			$where .= "b.se_name='{$w_name}' AND ";
		}
		if($w_state!=2){
			$where .= "a.status=".$w_state." AND ";
		}
		$where = trim($where,'AND ');
		if($where==''){$where=1;}
		$sql = "SELECT a.*,b.se_name,b.se_info,b.i18n FROM `v_c_shore_excursion_lib` a LEFT JOIN `v_c_shore_excursion_lib_i18n` b ON a.se_code=b.se_code WHERE b.i18n='en' AND ".$where." limit $pag,2";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		if($result){
			echo json_encode($result);
		}  else {
			echo 0;
		}
	
	}
	
	
	//shore_excursion_add
	public function actionShore_excursion_add(){
		$db = Yii::$app->db;
		$shore_excursion = new VCShoreExcursionLib();
		$shore_excursion_language = new VCShoreExcursionLibI18n();
		if($_POST){
			$code = isset($_POST['code'])?addslashes($_POST['code']):'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$name = isset($_POST['name'])?addslashes($_POST['name']):'';
			$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
			$price = isset($_POST['price'])?$_POST['price']:'0';
			$date_of_entry = isset($_POST['date_of_entry'])?$_POST['date_of_entry']:date("Y-m-d H:i:s",time());
			if(isset($_POST['date_of_entry'])){
				$date_of_entry = Helper::GetCreateTime($date_of_entry);
			}
			$shore_excursion->se_code = $code;
			$shore_excursion->price = $price;
			$shore_excursion->date = $date_of_entry;
			$shore_excursion->status = $state;
			 
			$shore_excursion_language->se_code = $code;
			$shore_excursion_language->se_name = $name;
			$shore_excursion_language->se_info = $desc;
			$shore_excursion_language->i18n = 'en';
			 
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$shore_excursion->save();
				$shore_excursion_language->save();
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['shore_excursion']));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
		return $this->render("shore_excursion_add");
	}
	
	//shore_excursion_edit
	public function actionShore_excursion_edit(){
		$db = Yii::$app->db;
		$old_code=$_GET['code'];
		if($_POST){
			$code = isset($_POST['code'])?addslashes($_POST['code']):'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$name = isset($_POST['name'])?addslashes($_POST['name']):'';
			$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
			$price = isset($_POST['price'])?$_POST['price']:'0';
			$date_of_entry = isset($_POST['date_of_entry'])?$_POST['date_of_entry']:date("Y-m-d H:i:s",time());
			if(isset($_POST['date_of_entry'])){
				$date_of_entry = Helper::GetCreateTime($date_of_entry);
			}
		//事务处理
			$transaction=$db->beginTransaction();
			try{
				$sql = "UPDATE `v_c_shore_excursion_lib` set se_code='$code',price='$price',date='$date_of_entry',status='$state' WHERE se_code='$old_code'";
				Yii::$app->db->createCommand($sql)->execute();
				$sql = "UPDATE `v_c_shore_excursion_lib_i18n` set se_code='$code',se_name='{$name}',se_info='{$desc}',i18n='en' WHERE se_code='$old_code'";
				Yii::$app->db->createCommand($sql)->execute();
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['shore_excursion']));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
	
	
		$sql = "SELECT a.*,b.se_name,b.se_info,b.i18n FROM `v_c_shore_excursion_lib` a LEFT JOIN `v_c_shore_excursion_lib_i18n` b ON a.se_code=b.se_code WHERE b.i18n='en' AND a.se_code = '$old_code'";
		$result = Yii::$app->db->createCommand($sql)->queryOne();
	
		return $this->render("shore_excursion_edit",['shore_excursion_result'=>$result]);
	}
	
	
	
	//shore_excursion se_code验证
	public function actionShore_excursion_code_check(){
		$code = isset($_GET['code'])?$_GET['code']:'';
		$act = isset($_GET['act'])?$_GET['act']:2;
		$id = isset($_GET['id'])?$_GET['id']:'';
		if($act == 1){
			//edit
			$sql = "SELECT count(*) count FROM `v_c_shore_excursion_lib` WHERE se_code='$code' AND id!=$id";
			$result = Yii::$app->db->createCommand($sql)->queryOne();
			$count = $result['count'];
		}else{
			//add
			$count = VCShoreExcursionLib::find()->where(['se_code' => $code])->count();
		}
		if($count==0){
			echo 0;
		}else{
			echo 1;
		}
	}
	
	
}