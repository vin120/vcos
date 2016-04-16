<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\web\Controller;
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
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_country_i18n` WHERE country_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['country']);
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_country` WHERE country_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_country_i18n` WHERE country_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['country']);
    	}
    	
    	$count = VCCountry::find()->count();
    	$sql = "SELECT a.*,b.country_name,b.i18n FROM `v_c_country` a LEFT JOIN `v_c_country_i18n` b ON a.country_code=b.country_code limit 2";
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
    		
    		$country->country_code = $code;
    		$country->counry_short_code = $code_chara;
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
                Yii::$app->getSession()->setFlash('success', '保存成功');
                return $this->redirect(['country']);
            }catch(Exception $e){
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash('error', '保存失败');
                return $this->redirect(['country_add']);
            }
    	}
    	return $this->render("country_add");
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
    		
    		
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$sql = "UPDATE `v_c_country` set country_code='$code',counry_short_code='$code_chara',status='$state' WHERE country_code='$old_code'";
				Yii::$app->db->createCommand($sql)->execute();
				$sql = "UPDATE `v_c_country_i18n` set country_code='$code',country_name='$name',i18n='en' WHERE country_code='$old_code'";
				Yii::$app->db->createCommand($sql)->execute();
				$transaction->commit();
				return $this->redirect(['country']);
			}catch(Exception $e){
				$transaction->rollBack();
				return $this->redirect(['country_edit','code'=>$old_code]);
			}
		}
    	
    	
    	
    	$sql = "SELECT a.*,b.country_name,b.i18n FROM `v_c_country` a LEFT JOIN `v_c_country_i18n` b ON a.country_code=b.country_code WHERE a.country_code = '$old_code'";
    	$result = Yii::$app->db->createCommand($sql)->queryOne();
    	return $this->render("country_edit",['country_result'=>$result]);
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
    	$sql = "SELECT a.*,b.country_name,b.i18n FROM `v_c_country` a LEFT JOIN `v_c_country_i18n` b ON a.country_code=b.country_code limit $pag,2";
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
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_port_i18n` WHERE port_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['port']);
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_port` WHERE port_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_port_i18n` WHERE port_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['port']);
    	}
    	
    	$count = VCPort::find()->count();
    	$sql = "SELECT a.*,b.port_name,b.i18n FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code limit 2";
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
    			Yii::$app->getSession()->setFlash('success', '保存成功');
    			return $this->redirect(['port']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Yii::$app->getSession()->setFlash('error', '保存失败');
    			return $this->redirect(['port_add']);
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
    			return $this->redirect(['port']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			return $this->redirect(['port_edit','code'=>$old_code]);
    		}
    	}
    	 
    	 
    	$sql = "SELECT a.*,b.port_name,b.i18n FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE a.port_code = '$old_code'";
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
    	$sql = "SELECT a.*,b.port_name,b.i18n FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code limit $pag,2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	if($result){
    		echo json_encode($result);
    	}  else {
    		echo 0;
    	}
    }
    
    
    
    
    //cruise
    public function actionCruise(){
    	if(isset($_GET['code'])){
    		$code = isset($_GET['code'])?$_GET['code']:'';
    		$sql = "DELETE FROM `v_cruise` WHERE cruise_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_cruise_i18n` WHERE cruise_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['cruise']);
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_cruise` WHERE cruise_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_cruise_i18n` WHERE cruise_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['cruise']);
    	}
    	 
    	$count = VCruise::find()->count();
    	$sql = "SELECT a.*,b.cruise_name,b.cruise_desc,b.cruise_img,b.i18n FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code limit 2";
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
    	
    		$cruise->cruise_code = $code;
    		$cruise->status = $state;
    	
    		$cruise_language->cruise_code = $code;
    		$cruise_language->cruise_name = $name;
    		$cruise_language->cruise_desc = $desc;
    		//$cruise_language->cruise_img = $name;
    		$cruise_language->i18n = 'en';
    	
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$cruise->save();
    			$cruise_language->save();
    			$transaction->commit();
    			Yii::$app->getSession()->setFlash('success', '保存成功');
    			return $this->redirect(['cruise']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Yii::$app->getSession()->setFlash('error', '保存失败');
    			return $this->redirect(['cruise_add']);
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
    		//事务处理
    		$transaction=$db->beginTransaction();
    		try{
    			$sql = "UPDATE `v_cruise` set cruise_code='$code',status='$state' WHERE cruise_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$sql = "UPDATE `v_cruise_i18n` set cruise_code='$code',cruise_name='{$name}',cruise_desc='{$desc}',i18n='en' WHERE cruise_code='$old_code'";
    			Yii::$app->db->createCommand($sql)->execute();
    			$transaction->commit();
    			return $this->redirect(['cruise']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			return $this->redirect(['cruise_edit','code'=>$old_code]);
    		}
    	}
    
    
    	$sql = "SELECT a.*,b.cruise_name,b.cruise_desc,b.i18n FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code WHERE a.cruise_code = '$old_code'";
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
    	$sql = "SELECT a.*,b.cruise_name,b.cruise_desc,b.cruise_img,b.i18n FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code limit $pag,2";
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
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_cabin_type_i18n` WHERE type_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['cabin_type']);
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_cabin_type` WHERE type_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_cabin_type_i18n` WHERE type_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['cabin_type']);
    	}
    	
    	$count = VCCabinType::find()->count();
    	$sql = "SELECT a.*,b.type_name,b.type_desc,b.i18n FROM `v_c_cabin_type` a LEFT JOIN `v_c_cabin_type_i18n` b ON a.type_code=b.type_code limit 2";
    	$result = Yii::$app->db->createCommand($sql)->queryAll();
    	return $this->render("cabin_type",['cabin_type_result'=>$result,'cabin_type_count'=>$count,'cabin_type_pag'=>1]);
    }
    
    //cabin type分页
    public function actionGet_cabin_type_page(){
    	$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
    	$sql = "SELECT a.*,b.type_name,b.type_desc,b.i18n FROM `v_c_cabin_type` a LEFT JOIN `v_c_cabin_type_i18n` b ON a.type_code=b.type_code limit $pag,2";
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
    			Yii::$app->getSession()->setFlash('success', '保存成功');
    			return $this->redirect(['cabin_type']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Yii::$app->getSession()->setFlash('error', '保存失败');
    			return $this->redirect(['cabin_type_add']);
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
    			return $this->redirect(['cabin_type']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			return $this->redirect(['cabin_type_edit','code'=>$old_code]);
    		}
    	}
    
    
    	$sql = "SELECT a.*,b.type_name,b.type_desc,b.i18n FROM `v_c_cabin_type` a LEFT JOIN `v_c_cabin_type_i18n` b ON a.type_code=b.type_code WHERE a.type_code = '$old_code'";
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
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_shore_excursion_i18n` WHERE se_code = '{$code}'";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['shore_excursion']);
    	}
    	if($_POST){
    		$ids = implode('\',\'', $_POST['ids']);
    		$sql = "DELETE FROM `v_c_shore_excursion` WHERE se_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		$sql = "DELETE FROM `v_c_shore_excursion_i18n` WHERE se_code in ('$ids')";
    		Yii::$app->db->createCommand($sql)->execute();
    		return $this->redirect(['shore_excursion']);
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
    			Yii::$app->getSession()->setFlash('success', '保存成功');
    			return $this->redirect(['shore_excursion']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			Yii::$app->getSession()->setFlash('error', '保存失败');
    			return $this->redirect(['shore_excursion_add']);
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
    			return $this->redirect(['shore_excursion']);
    		}catch(Exception $e){
    			$transaction->rollBack();
    			return $this->redirect(['shore_excursion_edit','code'=>$old_code]);
    		}
    	}
    
    
    	$sql = "SELECT a.*,b.se_name,b.se_info,b.i18n FROM `v_c_shore_excursion` a LEFT JOIN `v_c_shore_excursion_i18n` b ON a.se_code=b.se_code WHERE a.se_code = '$old_code'";
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
    
    
    
    
    
    
    
}
