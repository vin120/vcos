<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;
use app\modules\voyagemanagement\models\VCCountry;
use app\modules\voyagemanagement\models\VCCountryI18n;
use app\modules\voyagemanagement\models\VCPort;
use app\modules\voyagemanagement\models\VCPortI18n;
use app\modules\voyagemanagement\models\VCCabinType;
use app\modules\voyagemanagement\models\VCruise;
use app\modules\voyagemanagement\models\VCruiseI18n;
use app\modules\voyagemanagement\models\VCCabinTypeI18n;
use app\modules\voyagemanagement\models\VCShoreExcursion;
use app\modules\voyagemanagement\models\VCShoreExcursionI18n;
use app\modules\voyagemanagement\models\VCVoyage;
use app\modules\voyagemanagement\models\VCVoyageI18n;

class DefaultController extends Controller
{
    public function actionIndex()
    {
//        echo 123;exit;
        return $this->render('index');
    }
    
    
    //country
    public function actionCountry()
    {
    	if(isset($_GET['code'])){
    		$code = isset($_GET['code'])?$_GET['code']:'';
    		$sql = "DELETE FROM `v_c_country` WHERE country_code = '{$code}'";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_country_i18n` WHERE country_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['country']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    		
    		//return $this->redirect(['country']);
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_country` WHERE country_code in ('$ids')";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_country_i18n` WHERE country_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['country']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	
    	$count = VCCountry::find()->count();
    	$sql = "SELECT a.*,b.country_name,b.i18n,c.area_name FROM `v_c_country` a LEFT JOIN `v_c_country_i18n` b ON a.country_code=b.country_code LEFT JOIN `v_c_area_i18n` c ON a.area_code=c.area_code WHERE b.i18n='en' AND c.i18n='en' limit 2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("country",['country_result'=>$result,'country_count'=>$count,'country_pag'=>1]);
    }
    
    //country_add
    public function actionCountry_add(){
    	$db = Yii::$app->db;
    	$country = new VCCountry();
    	$country_language = new VCCountryI18n();
    	if($_POST){
    		$code = isset($_POST['code'])?$_POST['code']:'';
    		$code_chara = isset($_POST['code_chara'])?$_POST['code_chara']:'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?$_POST['name']:'';
    		$area_code = isset($_POST['area_code'])?$_POST['area_code']:'';
    		
    		$country->country_code = $code;
    		$country->counry_short_code = $code_chara;
    		$country->area_code = $area_code;
    		$country->status = $state;
    		
    		$country_language->country_code = $code;
    		$country_language->country_name = $name;
    		$country_language->i18n = 'en';
    		
    		//事务处理
    		$transaction=$db->beginTransaction();
            try{
                $country->save();
                $country_language->save();
                $transaction->commit();
	    		Helper::show_message('Save success  ', Url::toRoute(['country']));
            }catch(Exception $e){
                $transaction->rollBack();
                Helper::show_message('Save failed  ','#');
            }
    	}
    	$sql = "SELECT * FROM `v_c_area` a LEFT JOIN `v_c_area_i18n` b ON a.area_code = b.area_code WHERE b.i18n ='en'";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("country_add",['area_result'=>$result]);
    }
    
    //country_edit
    public function actionCountry_edit(){
    	$db = Yii::$app->db;
    	$old_code=$_GET['code'];
    	if($_POST){
    		$code = isset($_POST['code'])?$_POST['code']:'';
    		$code_chara = isset($_POST['code_chara'])?$_POST['code_chara']:'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?$_POST['name']:'';
    		$area_code = isset($_POST['area_code'])?$_POST['area_code']:'';
    		
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$sql = "UPDATE `v_c_country` set country_code='$code',counry_short_code='$code_chara',area_code='$area_code',status='$state' WHERE country_code='$old_code'";
				Yii::$app->db->createCommand($sql)->execute();
				$sql = "UPDATE `v_c_country_i18n` set country_code='$code',country_name='$name',i18n='en' WHERE country_code='$old_code'";
				Yii::$app->db->createCommand($sql)->execute();
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['country']));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
    	
    	
    	
    	$sql = "SELECT a.*,b.country_name,b.i18n FROM `v_c_country` a LEFT JOIN `v_c_country_i18n` b ON a.country_code=b.country_code WHERE b.i18n='en' AND a.country_code = '$old_code'";
    	$result = Yii::$app->db->createCommand($sql)->queryOne();
    	$sql = "SELECT * FROM `v_c_area` a LEFT JOIN `v_c_area_i18n` b ON a.area_code = b.area_code WHERE b.i18n ='en'";
    	$area_result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("country_edit",['country_result'=>$result,'area_result'=>$area_result]);
    }
    
    //验证code数据是否唯一
    //act : 1表示编辑  2：表示添加
    public function actionCountry_code_check(){
    	$code = isset($_GET['code'])?$_GET['code']:'';
    	$act = isset($_GET['act'])?$_GET['act']:2;
    	$id = isset($_GET['id'])?$_GET['id']:'';
    	if($act == 1){
    		//edit
    		$sql = "SELECT count(*) count FROM `v_c_country` WHERE country_code='$code' AND id!=$id";
    		$result = Yii::$app->db->createCommand($sql)->queryOne();
    		$count = $result['count'];
    	}else{
    		//add
    		$count = VCCountry::find()->where(['country_code' => $code])->count();
    	}
    	if($count==0){
    		echo 0;
    	}else{
    		echo 1;
    	}
    	
    }
    
    //国家分页
    public function actionGet_country_page(){
    	$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
    	$sql = "SELECT a.*,b.country_name,b.i18n,c.area_name FROM `v_c_country` a LEFT JOIN `v_c_country_i18n` b ON a.country_code=b.country_code LEFT JOIN `v_c_area_i18n` c ON a.area_code=c.area_code WHERE b.i18n='en' AND c.i18n='en' limit $pag,2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	if($result){
    		echo json_encode($result);
    	}  else {
    		echo 0;
    	}
    }
    
    
    
    //port
    public function actionPort()
    {
    	if(isset($_GET['code'])){
    		$code = isset($_GET['code'])?$_GET['code']:'';
    		$sql = "DELETE FROM `v_c_port` WHERE port_code = '{$code}'";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_port_i18n` WHERE port_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['port']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_port` WHERE port_code in ('$ids')";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_port_i18n` WHERE port_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['port']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	
    	$count = VCPort::find()->count();
    	$sql = "SELECT a.*,b.port_name,b.i18n FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE b.i18n='en' limit 2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("port",['port_result'=>$result,'port_count'=>$count,'port_pag'=>1]);
    }
    
    
    //port_add 
    public function actionPort_add(){
    	$db = Yii::$app->db;
    	$port = new VCPort();
    	$port_language = new VCPortI18n();
    	if($_POST){
    		$code = isset($_POST['code'])?$_POST['code']:'';
    		$code_chara = isset($_POST['code_chara'])?$_POST['code_chara']:'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?$_POST['name']:'';
    		$country_code = isset($_POST['country_code'])?$_POST['country_code']:'';
    	
    		$port->port_code = $code;
    		$port->port_short_code = $code_chara;
    		$port->country_code = $country_code;
    		$port->status = $state;
    	
    		$port_language->port_code = $code;
    		$port_language->port_name = $name;
    		$port_language->i18n = 'en';
    	
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$port->save();
    			$port_language->save();
    			$transaction->commit();
    			Helper::show_message('Save success  ', Url::toRoute(['port']));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message('Save failed  ','#');
    		}
    	}
    	$sql = "SELECT country_code FROM `v_c_country` WHERE status=1";
    	$country_result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("port_add",['country_result'=>$country_result]);
    }
    
    
    //port_edit
    public function actionPort_edit(){
    	$db = Yii::$app->db;
    	$old_code=$_GET['code'];
    	if($_POST){
    		$code = isset($_POST['code'])?$_POST['code']:'';
    		$code_chara = isset($_POST['code_chara'])?$_POST['code_chara']:'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?$_POST['name']:'';
    		$country_code = isset($_POST['country_code'])?$_POST['country_code']:'';
    		
    	
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$sql = "UPDATE `v_c_port` set port_code='$code',port_short_code='$code_chara',status='$state',country_code='$country_code' WHERE port_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$sql = "UPDATE `v_c_port_i18n` set port_code='$code',port_name='$name',i18n='en' WHERE port_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$transaction->commit();
    			Helper::show_message('Save success  ', Url::toRoute(['port']));
    			
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message('Save failed  ','#');
    		}
    	}
    	 
    	 
    	$sql = "SELECT a.*,b.port_name,b.i18n FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE b.i18n='en' AND a.port_code = '$old_code'";
    	$result = Yii::$app->db->createCommand($sql)->queryOne();
    	$sql = "SELECT country_code FROM `v_c_country` WHERE status=1";
    	$country_result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("port_edit",['port_result'=>$result,'country_result'=>$country_result]);
    }
    
    
    
    //port name check
    //act==1:edit  act==2:add
    public function actionPort_code_check(){
    	$code = isset($_GET['code'])?$_GET['code']:'';
    	$act = isset($_GET['act'])?$_GET['act']:2;
    	$id = isset($_GET['id'])?$_GET['id']:'';
    	if($act == 1){
    		//edit
     		$sql = "SELECT count(*) count FROM `v_c_port` WHERE port_code='$code' AND id!=$id";
     		$result = Yii::$app->db->createCommand($sql)->queryOne();
     		$count = $result['count'];
    	}else{
    		//add
    		$count = VCPort::find()->where(['port_code' => $code])->count();
    	}
    	if($count==0){
    		echo 0;
    	}else{
    		echo 1;
    	}
    }
    
    //港口分页
    public function actionGet_port_page(){
    	$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
    	$sql = "SELECT a.*,b.port_name,b.i18n FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE b.i18n='en' limit $pag,2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	if($result){
    		echo json_encode($result);
    	}  else {
    		echo 0;
    	}
    }
    
    
    
    
    
    

    //cabin type
    public function actionCabin_type(){
    	if(isset($_GET['code'])){
    		$code = isset($_GET['code'])?$_GET['code']:'';
    		$sql = "DELETE FROM `v_c_cabin_type` WHERE type_code = '{$code}'";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_cabin_type_i18n` WHERE type_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['cabin_type']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_cabin_type` WHERE type_code in ('$ids')";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_cabin_type_i18n` WHERE type_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['cabin_type']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	
    	$count = VCCabinType::find()->count();
    	$sql = "SELECT a.*,b.type_name,b.type_desc,b.i18n FROM `v_c_cabin_type` a LEFT JOIN `v_c_cabin_type_i18n` b ON a.type_code=b.type_code WHERE b.i18n='en' limit 2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("cabin_type",['cabin_type_result'=>$result,'cabin_type_count'=>$count,'cabin_type_pag'=>1]);
    }
    
    //cabin type分页
    public function actionGet_cabin_type_page(){
    	$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
    	$sql = "SELECT a.*,b.type_name,b.type_desc,b.i18n FROM `v_c_cabin_type` a LEFT JOIN `v_c_cabin_type_i18n` b ON a.type_code=b.type_code WHERE b.i18n='en' limit $pag,2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	if($result){
    		echo json_encode($result);
    	}  else {
    		echo 0;
    	}
    
    }
    
    //cabin_type_add
    public function actionCabin_type_add(){
    	$db = Yii::$app->db;
    	$cabin_type = new VCCabinType();
    	$cabin_type_language = new VCCabinTypeI18n();
    	if($_POST){
    		$code = isset($_POST['code'])?addslashes($_POST['code']):'';
    		$cruise_code = isset($_POST['cruise_code'])?addslashes($_POST['cruise_code']):'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?addslashes($_POST['name']):'';
    		$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
    		 
    		$cabin_type->type_code = $code;
    		$cabin_type->type_status = $state;
    		$cabin_type->cruise_code = $cruise_code;
    		 
    		$cabin_type_language->type_code = $code;
    		$cabin_type_language->type_name = $name;
    		$cabin_type_language->type_desc = $desc;
    		$cabin_type_language->i18n = 'en';
    		 
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$cabin_type->save();
    			$cabin_type_language->save();
    			$transaction->commit();
    			Helper::show_message('Save success  ', Url::toRoute(['cabin_type']));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message('Save failed  ','#');
    		}
    	}
    	$sql = "SELECT cruise_code FROM `v_cruise` WHERE status=1";
    	$cruise_result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("cabin_type_add",['cruise_result'=>$cruise_result]);
    }
    
    //cabin_type_edit
    public function actionCabin_type_edit(){
    	$db = Yii::$app->db;
    	$old_code=$_GET['code'];
    	if($_POST){
    		$code = isset($_POST['code'])?addslashes($_POST['code']):'';
    		$cruise_code = isset($_POST['cruise_code'])?$_POST['cruise_code']:'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?addslashes($_POST['name']):'';
    		$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
    
    		 
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$sql = "UPDATE `v_c_cabin_type` set type_code='$code',cruise_code='$cruise_code',type_status='$state' WHERE type_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$sql = "UPDATE `v_c_cabin_type_i18n` set type_code='$code',type_name='$name',type_desc='$desc',i18n='en' WHERE type_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$transaction->commit();
    			Helper::show_message('Save success  ', Url::toRoute(['cabin_type']));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message('Save failed  ','#');
    		}
    	}
    
    
    	$sql = "SELECT a.*,b.type_name,b.type_desc,b.i18n FROM `v_c_cabin_type` a LEFT JOIN `v_c_cabin_type_i18n` b ON a.type_code=b.type_code WHERE b.i18n='en' AND a.type_code = '$old_code'";
    	$result = Yii::$app->db->createCommand($sql)->queryOne();
    	$sql = "SELECT cruise_code FROM `v_cruise` WHERE status=1";
    	$cruise_result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("cabin_type_edit",['cabin_type_result'=>$result,'cruise_result'=>$cruise_result]);
    }
    
    
    //cbain_type type_code验证
    public function actionCabin_type_code_check(){
    	$code = isset($_GET['code'])?$_GET['code']:'';
    	$act = isset($_GET['act'])?$_GET['act']:2;
    	$id = isset($_GET['id'])?$_GET['id']:'';
    	if($act == 1){
    		//edit
    		$sql = "SELECT count(*) count FROM `v_c_cabin_type` WHERE type_code='$code' AND id!=$id";
    		$result = Yii::$app->db->createCommand($sql)->queryOne();
    		$count = $result['count'];
    	}else{
    		//add
    		$count = VCCabinType::find()->where(['type_code' => $code])->count();
    	}
    	if($count==0){
    		echo 0;
    	}else{
    		echo 1;
    	}
    }
    
    
	//shore excursion
    public function actionShore_excursion(){
    	if(isset($_GET['code'])){
    		$code = isset($_GET['code'])?$_GET['code']:'';
    		$sql = "DELETE FROM `v_c_shore_excursion` WHERE se_code = '{$code}'";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_shore_excursion_i18n` WHERE se_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['shore_excursion']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_shore_excursion` WHERE se_code in ('$ids')";
    		$count = Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_shore_excursion_i18n` WHERE se_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		if($count>0){
    			Helper::show_message('Delete the success ', Url::toRoute(['shore_excursion']));
    		}else{
    			Helper::show_message('Delete failed ');
    		}
    	}
    	
    	$count = VCShoreExcursion::find()->count();
    	$sql = "SELECT a.*,b.se_name,b.se_info,b.i18n FROM `v_c_shore_excursion` a LEFT JOIN `v_c_shore_excursion_i18n` b ON a.se_code=b.se_code WHERE b.i18n='en' limit 2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("shore_excursion",['shore_excursion_result'=>$result,'shore_excursion_count'=>$count,'shore_excursion_pag'=>1]);
    }
    
    //shore_excursion分页
    public function actionGet_shore_excursion_page(){
    	$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
    	$sql = "SELECT a.*,b.se_name,b.se_info,b.i18n FROM `v_c_shore_excursion` a LEFT JOIN `v_c_shore_excursion_i18n` b ON a.se_code=b.se_code WHERE b.i18n='en' limit $pag,2";
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
    	$shore_excursion = new VCShoreExcursion();
    	$shore_excursion_language = new VCShoreExcursionI18n();
    	if($_POST){
    		$code = isset($_POST['code'])?addslashes($_POST['code']):'';
    		$state = isset($_POST['state'])?$_POST['state']:'0';
    		$name = isset($_POST['name'])?addslashes($_POST['name']):'';
    		$desc = isset($_POST['desc'])?addslashes(trim($_POST['desc'])):'';
    		 
    		$shore_excursion->se_code = $code;
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
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$sql = "UPDATE `v_c_shore_excursion` set se_code='$code',status='$state' WHERE se_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$sql = "UPDATE `v_c_shore_excursion_i18n` set se_code='$code',se_name='{$name}',se_info='{$desc}',i18n='en' WHERE se_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$transaction->commit();
    			Helper::show_message('Save success  ', Url::toRoute(['shore_excursion']));
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Helper::show_message('Save failed  ','#');
    		}
    	}
    
    
    	$sql = "SELECT a.*,b.se_name,b.se_info,b.i18n FROM `v_c_shore_excursion` a LEFT JOIN `v_c_shore_excursion_i18n` b ON a.se_code=b.se_code WHERE b.i18n='en' AND a.se_code = '$old_code'";
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
    		$sql = "SELECT count(*) count FROM `v_c_shore_excursion` WHERE se_code='$code' AND id!=$id";
    		$result = Yii::$app->db->createCommand($sql)->queryOne();
    		$count = $result['count'];
    	}else{
    		//add
    		$count = VCShoreExcursion::find()->where(['se_code' => $code])->count();
    	}
    	if($count==0){
    		echo 0;
    	}else{
    		echo 1;
    	}
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
