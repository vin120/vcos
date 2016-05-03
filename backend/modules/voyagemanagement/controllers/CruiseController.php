<?php
namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;
use app\modules\voyagemanagement\models\VCruise;
use app\modules\voyagemanagement\models\VCruiseI18n;

class CruiseController extends Controller
{
	//cruise
	public function actionCruise(){
		if(isset($_GET['code'])){
			$code = isset($_GET['code'])?$_GET['code']:'';
			$sql = "DELETE FROM `v_cruise` WHERE cruise_code = '{$code}'";
			$count = Yii::$app->db->createCommand($sql)->execute();
			$sql = "DELETE FROM `v_cruise_i18n` WHERE cruise_code = '{$code}'";
			Yii::$app->db->createCommand($sql)->execute();
			if($count>0){
				Helper::show_message('Delete the success ', Url::toRoute(['cruise']));
			}else{
				Helper::show_message('Delete failed ');
			}
		}
		if(isset($_POST['ids'])){
			
			$ids = implode('\',\'', $_POST['ids']);
			$sql = "DELETE FROM `v_cruise` WHERE cruise_code in ('$ids')";
			$count = Yii::$app->db->createCommand($sql)->execute();
			$sql = "DELETE FROM `v_cruise_i18n` WHERE cruise_code in ('$ids')";
			Yii::$app->db->createCommand($sql)->execute();
			if($count>0){
				Helper::show_message('Delete the success ', Url::toRoute(['cruise']));
			}else{
				Helper::show_message('Delete failed ');
			}
		}
		/*
		 if(isset($_POST['where_submit'])){
		 var_dump($_POST);var_dump('bbbbbbbbbb');exit;
		 }*/
			
		$count = VCruise::find()->count();
		$sql = "SELECT a.*,b.cruise_name,b.cruise_desc,b.cruise_img,b.i18n FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code WHERE b.i18n='en' limit 2";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		return $this->render("cruise",['cruise_result'=>$result,'cruise_count'=>$count,'cruise_pag'=>1]);
		 
	}
	
	//cruise_add
	public function actionCruise_add(){
		$db = Yii::$app->db;
		$cruise = new VCruise();
		$cruise_language = new VCruiseI18n();
		if($_POST){
			$code = isset($_POST['code'])?$_POST['code']:'';
			$desc = isset($_POST['desc'])?$_POST['desc']:'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$name = isset($_POST['name'])?$_POST['name']:'';
			$number = isset($_POST['number'])?$_POST['number']:0;
			if($_FILES['photoimg']['error']!=4){
				$result=Helper::upload_file('photoimg', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'image', 3);
				$photo=date('Ym',time()).'/'.$result['filename'];
			}
			 
			$cruise->cruise_code = $code;
			$cruise->deck_number = $number;
			$cruise->status = $state;
			 
			$cruise_language->cruise_code = $code;
			$cruise_language->cruise_name = $name;
			$cruise_language->cruise_desc = $desc;
			$cruise_language->cruise_img = $photo;
			$cruise_language->i18n = 'en';
			 
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$cruise->save();
				$cruise_language->save();
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['cruise']));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
		return $this->render("cruise_add");
		 
		 
	}
	
	//cruise_edit
	public function actionCruise_edit(){
		$db = Yii::$app->db;
		$old_code=$_GET['code'];
		if($_POST){
			$code = isset($_POST['code'])?addslashes($_POST['code']):'';
			$state = isset($_POST['state'])?$_POST['state']:'0';
			$name = isset($_POST['name'])?addslashes($_POST['name']):'';
			$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
			$number = isset($_POST['number'])?$_POST['number']:0;
			$photo = '';
			if($_FILES['photoimg']['error']!=4){
				$result=Helper::upload_file('photoimg', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'image', 3);
				$photo=date('Ym',time()).'/'.$result['filename'];
			}
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$sql = "UPDATE `v_cruise` set cruise_code='$code',deck_number='$number',status='$state' WHERE cruise_code='$old_code'";
				Yii::$app->db->createCommand($sql)->execute();
				if($photo!=''){
					$sql = "UPDATE `v_cruise_i18n` set cruise_code='$code',cruise_name='{$name}',cruise_desc='{$desc}',cruise_img='{$photo}',i18n='en' WHERE cruise_code='$old_code'";
				}else{
					$sql = "UPDATE `v_cruise_i18n` set cruise_code='$code',cruise_name='{$name}',cruise_desc='{$desc}',i18n='en' WHERE cruise_code='$old_code'";
				}
				Yii::$app->db->createCommand($sql)->execute();
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['cruise']));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
	
	
		$sql = "SELECT a.*,b.cruise_name,b.cruise_desc,b.cruise_img,b.i18n FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code WHERE b.i18n='en' AND a.cruise_code = '$old_code'";
		$result = Yii::$app->db->createCommand($sql)->queryOne();
		 
		return $this->render("cruise_edit",['cruise_result'=>$result]);
	}
	
	
	//邮轮code验证
	public function actionCruise_code_check(){
		$code = isset($_GET['code'])?$_GET['code']:'';
		$act = isset($_GET['act'])?$_GET['act']:2;
		$id = isset($_GET['id'])?$_GET['id']:'';
		if($act == 1){
			//edit
			$sql = "SELECT count(*) count FROM `v_cruise` WHERE cruise_code='$code' AND id!=$id";
			$result = Yii::$app->db->createCommand($sql)->queryOne();
			$count = $result['count'];
		}else{
			//add
			$count = VCruise::find()->where(['cruise_code' => $code])->count();
		}
		if($count==0){
			echo 0;
		}else{
			echo 1;
		}
	}
	
	
	//邮轮分页
	public function actionGet_cruise_page(){
		$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
		$sql = "SELECT a.*,b.cruise_name,b.cruise_desc,b.cruise_img,b.i18n FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code WHERE b.i18n='en' limit $pag,2";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		if($result){
			echo json_encode($result);
		}  else {
			echo 0;
		}
	}
	
}