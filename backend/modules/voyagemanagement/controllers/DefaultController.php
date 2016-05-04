<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;


use app\modules\voyagemanagement\models\VCVoyage;
use app\modules\voyagemanagement\models\VCVoyageI18n;

class DefaultController extends Controller
{
    public function actionIndex()
    {
//        echo 123;exit;
    	return $this->render('index');
    }
    
    public function actionCabin_a()
    {
    	//        echo 123;exit;
    	return $this->render('cabin_a');
    }
    
    //voyage set
    public function actionVoyage_set()
    {
    	if(isset($_GET['code'])){
    		$code = isset($_GET['code'])?$_GET['code']:'';
    		$sql = "DELETE FROM `v_c_voyage` WHERE voyage_code = '{$code}'";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_voyage_i18n` WHERE voyage_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['voyage_set']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    		
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_voyage` WHERE voyage_code in ('$ids')";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_voyage_i18n` WHERE voyage_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['voyage_set']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	 
    	$count = VCVoyage::find()->count();
    	$sql = "SELECT a.*,b.voyage_name,b.voyage_desc,b.i18n FROM `v_c_voyage` a LEFT JOIN `v_c_voyage_i18n` b ON a.voyage_code=b.voyage_code WHERE b.i18n='en' limit 2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("voyage_set",['voyage_set_result'=>$result,'voyage_set_count'=>$count,'voyage_set_pag'=>1]);
    }
    
    //voyage_set分页
    public function actionGet_voyage_set_page(){
    	$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
    	$sql = "SELECT a.*,b.voyage_name,b.voyage_desc,b.i18n FROM `v_c_voyage` a LEFT JOIN `v_c_voyage_i18n` b ON a.voyage_code=b.voyage_code WHERE b.i18n='en' limit $pag,2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	if($result){
    		echo json_encode($result);
    	}  else {
    		echo 0;
    	}
    
    }
    
    //voyage_set_add
    public function actionVoyage_set_add(){
    	$db = Yii::$app->db;
    	$voyage = new VCVoyage();
    	$voyage_language = new VCVoyageI18n();
    	if($_POST){
    		$code = isset($_POST['code'])?addslashes($_POST['code']):'';
    		$cruise_code = isset($_POST['cruise_code'])?$_POST['cruise_code']:'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?addslashes($_POST['name']):'';
    		$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
    		$s_time = isset($_POST['s_time'])?$_POST['s_time']:'';
    		$e_time = isset($_POST['e_time'])?$_POST['e_time']:'';
    
    		$voyage->voyage_code = $code;
    		$voyage->cruise_code = $cruise_code;
    		$voyage->start_time = $s_time;
    		$voyage->end_time = $e_time;
    		$voyage->status = $state;
    
    		$voyage_language->voyage_code = $code;
    		$voyage_language->voyage_name = $name;
    		$voyage_language->voyage_desc = $desc;
    		$voyage_language->i18n = 'en';
    
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$voyage->save();
    			$voyage_language->save();
    			$transaction->commit();
    			Helper::show_message('Save success  ', Url::toRoute(['voyage_set']));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message('Save failed  ','#');
    		}
    	}
    	$sql = "SELECT cruise_code FROM `v_cruise` WHERE status=1";
    	$cruise_result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("voyage_set_add",['cruise_result'=>$cruise_result]);
    }
    
    //voyage_set_edit
    public function actionVoyage_set_edit(){
    	$db = Yii::$app->db;
    	$old_code=$_GET['code'];
    	if($_POST){
    		$code = isset($_POST['code'])?addslashes($_POST['code']):'';
    		$cruise_code = isset($_POST['cruise_code'])?$_POST['cruise_code']:'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?addslashes($_POST['name']):'';
    		$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
    		$s_time = isset($_POST['s_time'])?$_POST['s_time']:'';
    		$e_time = isset($_POST['e_time'])?$_POST['e_time']:'';
    
    		 
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$sql = "UPDATE `v_c_voyage` set voyage_code='$code',cruise_code='$cruise_code',start_time='$s_time',end_time='$e_time',status='$state' WHERE voyage_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$sql = "UPDATE `v_c_voyage_i18n` set voyage_code='$code',voyage_name='$name',voyage_desc='$desc',i18n='en' WHERE voyage_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$transaction->commit();
    			Helper::show_message('Save success  ', Url::toRoute(['voyage_set']));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message('Save failed  ','#');
    		}
    	}
    
    
    	$sql = "SELECT a.*,b.voyage_name,b.voyage_desc,b.i18n FROM `v_c_voyage` a LEFT JOIN `v_c_voyage_i18n` b ON a.voyage_code=b.voyage_code WHERE b.i18n='en' AND a.voyage_code = '$old_code'";
    	$result = Yii::$app->db->createCommand($sql)->queryOne();
    	$sql = "SELECT cruise_code FROM `v_cruise` WHERE status=1";
    	$cruise_result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("voyage_set_edit",['voyage_set_result'=>$result,'cruise_result'=>$cruise_result]);
    }
    
    //voyage_set voyage_code验证
    public function actionVoyage_set_code_check(){
    	$code = isset($_GET['code'])?$_GET['code']:'';
    	$act = isset($_GET['act'])?$_GET['act']:2;
    	$id = isset($_GET['id'])?$_GET['id']:'';
    	if($act == 1){
    		//edit
    		$sql = "SELECT count(*) count FROM `v_c_voyage` WHERE voyage_code='$code' AND id!=$id";
    		$result = Yii::$app->db->createCommand($sql)->queryOne();
    		$count = $result['count'];
    	}else{
    		//add
    		$count = VCVoyage::find()->where(['voyage_code' => $code])->count();
    	}
    	if($count==0){
    		echo 0;
    	}else{
    		echo 1;
    	}
    }
    
    
    
    
    
    
    
}
