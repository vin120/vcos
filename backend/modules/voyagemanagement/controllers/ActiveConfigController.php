<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;
use app\modules\voyagemanagement\models\VCActive;

class ActiveconfigController extends Controller
{

	public function actionActive_config()
	{
		if(isset($_GET['active_id'])){
			$active_id = $_GET['active_id'];

			$sql = "DELETE FROM `v_c_active` WHERE active_id = '{$active_id}' ";
			$count = Yii::$app->db->createCommand($sql)->execute();

			$sql = "DELETE FROM `v_c_active_i18n` WHERE active_id = '{$active_id}'";
			Yii::$app->db->createCommand($sql)->execute();

			if($count>0){
				Helper::show_message('Delete successful ', Url::toRoute(['active_config']));
			}else{
				Helper::show_message('Delete failed ');
			}
		}

		if(isset($_POST['ids'])){
			$ids = implode('\',\'', $_POST['ids']);

			$sql = "DELETE FROM `v_c_active` WHERE active_id in ('$ids')";
			$count = Yii::$app->db->createCommand($sql)->execute();

			$sql = "DELETE FROM `v_c_active_i18n` WHERE active_id in ('$ids')";
			Yii::$app->db->createCommand($sql)->execute();

			if($count>0){
				Helper::show_message('Delete successful ', Url::toRoute(['active_config']));
			}else{
				Helper::show_message('Delete failed ');
			}
		}

		
		
		$sql = " SELECT a.*,b.active_id,b.name,b.i18n FROM `v_c_active` a LEFT JOIN `v_c_active_i18n` b ON a.active_id=b.active_id WHERE b.i18n='en' limit 2";
		$active = Yii::$app->db->createCommand($sql)->queryAll();

		$sql = "SELECT count(*) count FROM `v_c_active`";
		$count = Yii::$app->db->createCommand($sql)->queryOne()['count'];

		return $this->render("active_config",['active'=>$active,'count'=>$count,'active_page'=>1]);
	}


	//活动分页
	public function actionGet_active_page()
	{
		$pag = isset($_GET['pag']) ? $_GET['pag']==1 ? 0 :($_GET['pag']-1) * 2 : 0;
		$sql = "SELECT a.*,b.name FROM `v_c_active` a LEFT JOIN `v_c_active_i18n` b ON a.active_id=b.active_id WHERE b.i18n='en' limit $pag,2";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}
	
	//详细活动分页
	public function actionGet_active_config_page()
	{
		$pag = isset($_GET['pag']) ? $_GET['pag']==1 ? 0 :($_GET['pag']-1) * 2 : 0;
		$sql = "SELECT a.id,a.day_from,a.day_to,b.detail_title,b.detail_desc FROM `v_c_active_detail` a LEFT JOIN `v_c_active_detail_i18n` b ON a.id=b.active_detail_id WHERE b.i18n='en' limit $pag,2";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}
	
	
	//Active Config Add
	public function actionActive_config_add()
	{	
		if(isset($_POST)){
			
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$active_select = isset($_POST['active_select']) ? $_POST['active_select'] : '';
			if($name != '' && $active_select != ''){
				$transaction = Yii::$app->db->beginTransaction();
				try{
				
					$sql = " INSERT INTO `v_c_active` (`status`) VALUES ('$active_select') ";
					$count = Yii::$app->db->createCommand($sql)->execute();
					$last_active_id = Yii::$app->db->getLastInsertID();
						
					$sql = "INSERT INTO `v_c_active_i18n` (`active_id`,`name`,`i18n`) VALUES ('$last_active_id','$name','en')";
					Yii::$app->db->createCommand($sql)->execute();
				
					if($count > 0){
						Helper::show_message('Save successful', Url::toRoute(['active_config_edit'])."&active_id=".$last_active_id);
					}else{
						Helper::show_message('Save failed', Url::toRoute(['active_config_add']));
					}
				
					$transaction->commit();
				}catch (Exception $e){
					$transaction->rollBack();
					Helper::show_message('Save failed', Url::toRoute(['active_config_add']));
				}
			}
			
		}
		return $this->render("active_config_add");
	}



	//Active Config Edit
	public function actionActive_config_edit()
	{
		//获取编辑页面的信息
		$active_id = isset($_GET['active_id']) ? $_GET['active_id'] : '';
		$sql = " SELECT a.active_id,a.status,b.name FROM `v_c_active` a LEFT JOIN `v_c_active_i18n` b ON a.active_id=b.active_id WHERE a.active_id='{$active_id}' AND b.i18n='en'";
		$active = Yii::$app->db->createCommand($sql)->queryOne();
		
		
		//获取编辑页面的详细信息
		$sql = "SELECT a.id,a.day_from,a.day_to,b.detail_title,b.detail_desc FROM `v_c_active_detail` a LEFT JOIN `v_c_active_detail_i18n` b ON a.id=b.active_detail_id WHERE a.active_id='{$active_id}' AND b.i18n='en' limit 2";
		$active_detail = Yii::$app->db->createCommand($sql)->queryAll();
		
		$sql = "SELECT count(*) count FROM `v_c_active_detail` WHERE active_id='{$active_id}'";
		$count = Yii::$app->db->createCommand($sql)->queryOne()['count'];
		
		
		//更新编辑页面的信息
		if(isset($_POST)){
			
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$active_select = isset($_POST['active_select']) ? $_POST['active_select'] : '';
			$active_id_post = isset($_POST['active_id']) ? $_POST['active_id'] : '';

			if($name != '' && $active_select != '' && $active_id_post){
				$transaction = Yii::$app->db->beginTransaction();
				try{
					$sql = "UPDATE `v_c_active` SET `status`='{$active_select}' WHERE `active_id`='{$active_id_post}'";
					Yii::$app->db->createCommand($sql)->execute();
			
					$sql = "UPDATE `v_c_active_i18n` SET `name`='{$name}' WHERE `active_id`='{$active_id_post}' AND `i18n`='en'";
					Yii::$app->db->createCommand($sql)->execute();
					
					Helper::show_message('Save successful', Url::toRoute(['active_config_edit'])."&active_id=".$active_id_post);
					$transaction->commit();
				}catch (Exception $e){
					$transaction->rollBack();
					Helper::show_message('Save failed', Url::toRoute(['active_config_edit'])."&active_id=".$active_id_post);
				}
			}
		}
		
		
		return $this->render("active_config_edit",['active'=>$active,'active_detail'=>$active_detail,'count'=>$count,'active_config_page'=>1]);
	}

	public function actionActive_config_detail_add()
	{
		$active_id = isset($_GET['active_id']) ? $_GET['active_id'] : '';
		$sql = "SELECT active_id FROM v_c_active WHERE active_id='$active_id' ";
		$active = Yii::$app->db->createCommand($sql)->queryOne();
		
		if($_POST){
			$day_from = isset($_POST['day_from']) ? $_POST['day_from'] : '';
			$day_to = isset($_POST['day_to']) ? $_POST['day_to'] : '';
			$active_id_post = isset($_POST['active_id']) ? $_POST['active_id'] : '';
			$detail_title = isset($_POST['detail_title']) ? $_POST['detail_title'] : '';
			$detail_desc = isset($_POST['detail_desc']) ? $_POST['detail_desc'] : '';
			
			if($_FILES['photoimg']['error']!=4){
				$result=Helper::upload_file('photoimg', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'image', 3);
				$photo=date('Ym',time()).'/'.$result['filename'];
			}
			if(!isset($photo)){
				$photo="";
			}
			if($day_from != '' && $detail_title != ''){
				//事务
				$transaction=Yii::$app->db->beginTransaction();
				try{
					if($day_to ==''){
						$sql = "INSERT INTO `v_c_active_detail` (`active_id`,`day_from`,`day_to`,`detail_img`) VALUES ('$active_id_post','$day_from',null,'$photo')";
					}else{
						$sql = "INSERT INTO `v_c_active_detail` (`active_id`,`day_from`,`day_to`,`detail_img`) VALUES ('$active_id_post','$day_from','$day_to','$photo')";
					}
					Yii::$app->db->createCommand($sql)->execute();
					$last_active_detail_id = Yii::$app->db->getLastInsertID();
					
					$sql = "INSERT INTO `v_c_active_detail_i18n` (`active_detail_id`,`detail_title`,`detail_desc`,`i18n`) VALUES ('$last_active_detail_id','$detail_title','$detail_desc','en')";
					Yii::$app->db->createCommand($sql)->execute();
					$transaction->commit();
					Helper::show_message('Save success  ', Url::toRoute(['active_config_edit'])."&active_id=".$active_id_post);
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message('Save failed  ','#');
				}
			}else{
				Helper::show_message('Save failed  ','#');
			}
		}
		
		return $this->render("active_config_detail_add",['active'=>$active]);
	}
	
	public function actionActive_config_detail_edit()
	{
		
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$active_id = isset($_GET['active_id']) ? $_GET['active_id'] : '';
	
		$sql = "SELECT a.id,a.active_id, a.day_from,a.day_to,a.detail_img,b.detail_title,b.detail_desc FROM `v_c_active_detail` a LEFT JOIN `v_c_active_detail_i18n` b ON a.id=b.active_detail_id WHERE a.id='$id' AND a.active_id='$active_id' AND b.i18n='en' ";
		$active_detail = Yii::$app->db->createCommand($sql)->queryOne();
		
	
		if(isset($_POST)){
			
			$day_from = isset($_POST['day_from']) ? $_POST['day_from'] : '';
			$day_to = isset($_POST['day_to']) ? $_POST['day_to'] : '';
			$detail_title = isset($_POST['detail_title']) ? $_POST['detail_title'] : '';
			$detail_desc = isset($_POST['detail_desc']) ? $_POST['detail_desc'] : '';
			$active_id_post = isset($_POST['active_id']) ? $_POST['active_id'] : '';
			$active_detail_id = isset($_POST['active_detail_id']) ? $_POST['active_detail_id'] :'';
			
			if(isset($_FILES['photoimg'])){
				if($_FILES['photoimg']['error']!=4){
					$result=Helper::upload_file('photoimg', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'image', 3);
					$photo=date('Ym',time()).'/'.$result['filename'];
				}
				if(!isset($photo)){
					$photo=null;
				}
			}
			
			if($day_from != '' && $detail_title != '' && $active_detail_id !=''){
				$transaction = Yii::$app->db->beginTransaction();
				try{
					if($day_to != ''){
						$sql = "UPDATE `v_c_active_detail` SET `day_from`='{$day_from}',`day_to`='{$day_to}',`detail_img`='$photo' WHERE `id`='{$active_detail_id}'";
					}else{
						$sql = "UPDATE `v_c_active_detail` SET `day_from`='{$day_from}',`day_to`= null,`detail_img`='$photo' WHERE `id`='{$active_detail_id}'";
					}
					
					Yii::$app->db->createCommand($sql)->execute();
			
					$sql = "UPDATE `v_c_active_detail_i18n` SET `detail_title`='{$detail_title}',`detail_desc`='{$detail_desc}' WHERE `active_detail_id`='{$active_detail_id}' AND `i18n`='en'";
					Yii::$app->db->createCommand($sql)->execute();
					
					Helper::show_message('Save successful', Url::toRoute(['active_config_edit'])."&active_id=".$active_id_post);
					$transaction->commit();
				}catch (Exception $e){
					$transaction->rollBack();
					Helper::show_message('Save failed', Url::toRoute(['active_config_edit'])."&active_id=".$active_id_post);
				}
			}
		}
		
		
		return $this->render("active_config_detail_edit",['active_detail'=>$active_detail]);
	}
	
	//Delete Active Config Detail
	public function actionActive_config_detail_delete()
	{
		//单项删除
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$active_id = $_GET['active_id'];
			$sql = "DELETE FROM `v_c_active_detail` WHERE id = '{$id}' ";
			$count = Yii::$app->db->createCommand($sql)->execute();
			
			$sql = "DELETE FROM `v_c_active_detail_i18n` WHERE active_detail_id = '{$id}'";
			Yii::$app->db->createCommand($sql)->execute();
			
			if($count>0){
				Helper::show_message('Delete successful', Url::toRoute(['active_config_edit'])."&active_id=".$active_id);
			}else{
				Helper::show_message('Delete failed ');
			}
		}
		
		//选中删除
		if(isset($_POST['ids'])){
			$ids = implode('\',\'', $_POST['ids']);
			$active_id = $_POST['active_id'];
			$sql = "DELETE FROM `v_c_active_detail` WHERE id in ('{$ids}')";
			$count = Yii::$app->db->createCommand($sql)->execute();
		
			$sql = "DELETE FROM `v_c_active_detail_i18n` WHERE active_detail_id in ('{$ids}')";
			Yii::$app->db->createCommand($sql)->execute();
		
			if($count>0){
				Helper::show_message('Delete successful ', Url::toRoute(['active_config_edit'])."&active_id=".$active_id);
			}else{
				Helper::show_message('Delete failed ');
			}
		}
	}
	

}