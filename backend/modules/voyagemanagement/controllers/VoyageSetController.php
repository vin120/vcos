<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;

class VoyageSetController extends Controller
{
	public function actionIndex()
	{
		$sql = " SELECT a.id,a.voyage_num,a.start_time,a.end_time,b.voyage_name FROM v_c_voyage a LEFT JOIN v_c_voyage_i18n b ON a.voyage_code=b.voyage_code ";
		$count_sql = " SELECT COUNT(*) count FROM v_c_voyage a LEFT JOIN v_c_voyage_i18n b ON a.voyage_code=b.voyage_code ";
		$where_sql = ' WHERE 1 ';
		$_voyage_name = '';
		$_s_time = '';
		$_e_time = '';

		if($_POST){
			$voyage_name = isset($_POST['voyage_name']) ? $_POST['voyage_name'] : '';
			$s_time = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$e_time = isset($_POST['e_time']) ? $_POST['e_time'] : '';
			
			$_voyage_name = $voyage_name;
			$_s_time = $s_time;
			$_e_time = $e_time;
			if($voyage_name != ''){
				$where_sql .= " AND voyage_name LIKE '%$voyage_name%' ";
			}

			if($s_time != ''){
				$where_sql .= " AND a.start_time > '$s_time' ";
			}

			if($e_time != ''){
				$where_sql .= " AND a.end_time < '$e_time' ";
			}
			$where_sql .= " AND b.i18n='en'  ";
		}

		$voyage = Yii::$app->db->createCommand($sql.$where_sql)->queryAll();
		$count = Yii::$app->db->createCommand($count_sql.$where_sql)->queryOne()['count'];

		return $this->render("index",['voyage'=>$voyage,'count'=>$count,'voyage_name'=>$_voyage_name,'s_time'=>$_s_time,'e_time'=>$_e_time]);
	}

	//航线分页
	public function actionGet_voyage_page()
	{
		$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
		$voyage_name = isset($_GET['voyage_name']) ? $_GET['voyage_name'] : '';
		$s_time = isset($_GET['s_time']) ? $_GET['s_time'] : '';
		$e_time = isset($_GET['e_time']) ? $_GET['e_time'] : '';

		$sql = " SELECT a.id,a.voyage_num,a.start_time,a.end_time,b.voyage_name FROM v_c_voyage a LEFT JOIN v_c_voyage_i18n b ON a.voyage_code=b.voyage_code ";
		$where_sql = " WHERE 1 ";
		

		if($voyage_name != ''){
			$where_sql .= " AND voyage_name LIKE '%$voyage_name%' ";
		}

		if($s_time != ''){
			$where_sql .= " AND a.start_time > '$s_time' ";
		}

		if($e_time != ''){
			$where_sql .= " AND a.end_time < '$e_time' ";
		}

		$where_sql .= " AND b.i18n='en'  ";

		$limit_sql = " limit $pag,2 ";

		$result = Yii::$app->db->createCommand($sql.$where_sql.$limit_sql)->queryAll();

		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}

	//添加航线
	public function actionVoyage_add()
	{
		if($_POST){
			$voyage_name = isset($_POST['voyage_name']) ? $_POST['voyage_name'] : '';
			$voyage_num = isset($_POST['voyage_num']) ? $_POST['voyage_num'] : '';
			$area_code = isset($_POST['area']) ? $_POST['area'] : '';
			$cruise_code = isset($_POST['cruise']) ? $_POST['cruise'] : '';
			$s_time = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$e_time = isset($_POST['e_time']) ? $_POST['e_time'] : '';
			$desc = isset($_POST['desc']) ? $_POST['desc'] : '';
			$s_book_time = isset($_POST['s_book_time']) ? $_POST['s_book_time'] : '';
			$e_book_time = isset($_POST['e_book_time']) ? $_POST['e_book_time'] : '';
			$ticket_price = isset($_POST['ticket_price']) ? $_POST['ticket_price'] : 0;
			$ticket_taxes = isset($_POST['ticket_taxes']) ? $_POST['ticket_taxes'] : 0;
			$harbour_taxes = isset($_POST['harbour_taxes']) ? $_POST['harbour_taxes'] : 0;
			$deposit_ratio = isset($_POST['deposit_ratio']) ? $_POST['deposit_ratio'] : 0;
			if(isset($_FILES['pdf'])){
				if($_FILES['pdf']['error'] != 4){
					$result=Helper::upload_file('pdf', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'pdf', 3);
					$pdf_path=date('Ym',time()).'/'.$result['filename'];
				}
			}
			$voyage_code = time();

			if($voyage_name != '' && $voyage_num != '' && $ticket_price != '' && $ticket_taxes != '' && $harbour_taxes != '' && $deposit_ratio != ''){
				//事务处理
				$transaction=Yii::$app->db->beginTransaction();
				try{

					$sql = "INSERT INTO `v_c_voyage` (`voyage_code`,`cruise_code`,`start_time`,`end_time`,`status`,`area_code`,`voyage_num`,`pdf_path`,`start_book_time`,`stop_book_time`,`ticket_price`,`ticket_taxes`,`harbour_taxes`,`deposit_ratio`) VALUES ('$voyage_code','$cruise_code','$s_time','$e_time','1','$area_code','$voyage_num','$pdf_path','$s_book_time','$e_book_time','$ticket_price','$ticket_taxes','$harbour_taxes','$deposit_ratio') ";
					Yii::$app->db->createCommand($sql)->execute();
					$last_active_id = Yii::$app->db->getLastInsertID();
					$sql = " INSERT INTO `v_c_voyage_i18n` (`voyage_code`,`voyage_name`,`voyage_desc`,`i18n`) VALUES ('$voyage_code','$voyage_name','$desc','en')";
					Yii::$app->db->createCommand($sql)->execute();
					$transaction->commit();
					Helper::show_message('Save success  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$last_active_id);
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message('Save failed  ','#');
				}
			}
		}

		$sql = "SELECT a.area_code,b.area_name FROM `v_c_area` a LEFT JOIN `v_c_area_i18n` b ON a.area_code=b.area_code WHERE a.status=1 AND b.i18n='en' ";
		$area = Yii::$app->db->createCommand($sql)->queryAll();


		$sql = " SELECT a.cruise_code , b.cruise_name FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code WHERE a.status=1 AND b.i18n='en'";
		$cruise = Yii::$app->db->createCommand($sql)->queryAll();

		return $this->render('voyage_add',['area'=>$area,'cruise'=>$cruise]);
	}
	
	
	public function actionVoyage_edit()
	{
		if($_POST){
			$voyage_name = isset($_POST['voyage_name']) ? $_POST['voyage_name'] : '';
			$voyage_num = isset($_POST['voyage_num']) ? $_POST['voyage_num'] : '';
			$area_code = isset($_POST['area']) ? $_POST['area'] : '';
			$cruise_code = isset($_POST['cruise']) ? $_POST['cruise'] : '';
			$s_time = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$e_time = isset($_POST['e_time']) ? $_POST['e_time'] : '';
			$desc = isset($_POST['desc']) ? $_POST['desc'] : '';
			$s_book_time = isset($_POST['s_book_time']) ? $_POST['s_book_time'] : '';
			$e_book_time = isset($_POST['e_book_time']) ? $_POST['e_book_time'] : '';
			$ticket_price = isset($_POST['ticket_price']) ? $_POST['ticket_price'] : 0;
			$ticket_taxes = isset($_POST['ticket_taxes']) ? $_POST['ticket_taxes'] : 0;
			$harbour_taxes = isset($_POST['harbour_taxes']) ? $_POST['harbour_taxes'] : 0;
			$deposit_ratio = isset($_POST['deposit_ratio']) ? $_POST['deposit_ratio'] : 0;
			$voyage_code = isset($_POST['voyage_code']) ? $_POST['voyage_code'] : time();
			$voyage_id = isset($_POST['voyage_id']) ? $_POST['voyage_id'] : '';
			
			$sql = "SELECT pdf_path FROM `v_c_voyage` WHERE id='$voyage_id' ";
			$pdf_path = Yii::$app->db->createCommand($sql)->queryOne()['pdf_path'];
			
			if(isset($_FILES['pdf'])){
				if($_FILES['pdf']['error'] != 4){
					$result=Helper::upload_file('pdf', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'pdf', 3);
					$pdf_path=date('Ym',time()).'/'.$result['filename'];
				}
			}
			
			$transaction=Yii::$app->db->beginTransaction();
			try{
				$sql = " UPDATE `v_c_voyage` SET `voyage_code`='$voyage_code',`cruise_code`='$cruise_code',`start_time`='$s_time',`end_time`='$e_time',`area_code`='$area_code',`voyage_num`='$voyage_num',`pdf_path`='$pdf_path',`start_book_time`='$s_book_time',`stop_book_time`='$e_book_time',`ticket_price`='$ticket_price',`ticket_taxes`='$ticket_taxes',`harbour_taxes`='$harbour_taxes',`deposit_ratio`='$deposit_ratio' WHERE id='$voyage_id' ";
				Yii::$app->db->createCommand($sql)->execute();

				$sql = " UPDATE `v_c_voyage_i18n` SET `voyage_name`='$voyage_name',`voyage_desc`='$desc' WHERE voyage_code ='$voyage_code'";
				Yii::$app->db->createCommand($sql)->execute();

				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}

		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id'] : '';
		$sql = " SELECT a.*,b.voyage_name,b.voyage_desc FROM `v_c_voyage` a LEFT JOIN `v_c_voyage_i18n` b ON a.voyage_code=b.voyage_code WHERE a.id='$voyage_id' AND a.status=1 AND b.i18n='en' ";
		$voyage = Yii::$app->db->createCommand($sql)->queryOne();

		$sql = "SELECT a.area_code,b.area_name FROM `v_c_area` a LEFT JOIN `v_c_area_i18n` b ON a.area_code=b.area_code WHERE a.status=1 AND b.i18n='en' ";
		$area = Yii::$app->db->createCommand($sql)->queryAll();


		$sql = " SELECT a.cruise_code , b.cruise_name FROM `v_cruise` a LEFT JOIN `v_cruise_i18n` b ON a.cruise_code=b.cruise_code WHERE a.status=1 AND b.i18n='en'";
		$cruise = Yii::$app->db->createCommand($sql)->queryAll();


		$sql = "SELECT * FROM `v_c_voyage_port` WHERE voyage_id='$voyage_id' limit 2 ";
		$voyage_port = Yii::$app->db->createCommand($sql)->queryAll();

		$sql = "SELECT a.port_code,b.port_name FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE a.status=1 AND b.i18n='en' " ;
		$port = Yii::$app->db->createCommand($sql)->queryAll();

		$sql = " SELECT COUNT(*) count FROM `v_c_voyage_port` WHERE voyage_id='$voyage_id'";
		$count = Yii::$app->db->createCommand($sql)->queryOne()['count'];

		return $this->render('voyage_edit',['voyage'=>$voyage,'area'=>$area,'cruise'=>$cruise,'voyage_port'=>$voyage_port,'port'=>$port,'count'=>$count,'voyage_port_page'=>1]);
	}
	
	//-----

	//港口分页
	public function actionGet_voyage_port_page()
	{
		$pag = isset($_GET['pag']) ? $_GET['pag']==1 ? 0 :($_GET['pag']-1) * 2 : 0;
		$voyage_id = isset($_GET['voyage_id']) ?$_GET['voyage_id'] :'';
		$sql = "SELECT * FROM `v_c_voyage_port` WHERE voyage_id='$voyage_id' limit $pag,2 ";
		$result = Yii::$app->db->createCommand($sql)->queryAll();

		$sql = "SELECT a.port_code,b.port_name FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE a.status=1 AND b.i18n='en' " ;
		$port = Yii::$app->db->createCommand($sql)->queryAll();

		foreach($port as $port_row){
			foreach ($result as $key => $value ) {
				if($port_row['port_code'] == $value['port_code']) {
					$result[$key]['port_name'] = $port_row['port_name'];
				}
			}
		}

		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}

	//港口删除
	public function actionVoyage_edit_delete()
	{
		//单项删除
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$voyage_id = $_GET['voyage_id'];
			$sql = "DELETE FROM `v_c_voyage_port` WHERE id ='{$id}' ";
			$count = Yii::$app->db->createCommand($sql)->execute();
			
			if($count>0){
				Helper::show_message('Delete successful', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
			}else{
				Helper::show_message('Delete failed ');
			}
		}
		
		//选中删除
		if(isset($_POST['ids'])){
			$ids = implode('\',\'', $_POST['ids']);
			$voyage_id = $_POST['voyage_id'];
			$sql = "DELETE FROM `v_c_voyage_port` WHERE id in ('{$ids}')";
			$count = Yii::$app->db->createCommand($sql)->execute();
		
			if($count>0){
				Helper::show_message('Delete successful ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
			}else{
				Helper::show_message('Delete failed ');
			}
		}
	}


	public function actionVoyage_port_add()
	{
		$voyage_id = isset($_GET['voyage_id']) ? $_GET['voyage_id'] : '';
		$sql = "SELECT id FROM `v_c_voyage` WHERE id='$voyage_id' ";
		$voyage = Yii::$app->db->createCommand($sql)->queryOne();

		if($_POST){
			$order_no = isset($_POST['order_no']) ? $_POST['order_no'] : '';
			$port_code = isset($_POST['port_code']) ? $_POST['port_code'] : '';
			$EIA = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$ETD = isset($_POST['e_time']) ? $_POST['e_time'] : '';
			$voyage_id_post = isset($_POST['voyage_id']) ? $_POST['voyage_id'] : '';
 
			if($order_no != '' && $port_code != '' ){

				$sql = "SELECT COUNT(*) count FROM `v_c_voyage_port` WHERE order_no='$order_no' AND voyage_id='$voyage_id_post'";
				$count = Yii::$app->db->createCommand($sql)->queryOne()['count'];

				if($count <= 0){
					if($EIA ==''){
						$sql = " INSERT INTO `v_c_voyage_port` (`voyage_id`,`port_code`,`order_no`,`ETD`) VALUES ('$voyage_id_post','$port_code','$order_no','$ETD')";
					}
					if($ETD == ''){
						$sql = " INSERT INTO `v_c_voyage_port` (`voyage_id`,`port_code`,`order_no`,`EIA`) VALUES ('$voyage_id_post','$port_code','$order_no','$EIA')";
					}
					
					$count = Yii::$app->db->createCommand($sql)->execute();
					if($count){
						Helper::show_message('Save success  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post);
					}else{
						Helper::show_message('Save failed  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post);
					}
				}else{
					Helper::show_message('Num Exists ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post);
				}
			}
		}


		$sql = "SELECT a.port_code,b.port_name FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE a.status=1 AND b.i18n='en' " ;
		$port = Yii::$app->db->createCommand($sql)->queryAll();

		return $this->render('voyage_port_add',['port'=>$port,'voyage'=>$voyage]);
	}

	
	
	public function actionVoyage_port_edit()
	{
		$voyage_id = isset($_GET['voyage_id']) ? $_GET['voyage_id'] : '';
		$sql = "SELECT id FROM `v_c_voyage` WHERE id='$voyage_id' ";
		$voyage = Yii::$app->db->createCommand($sql)->queryOne();



		$port_id = isset($_GET['port_id']) ? $_GET['port_id'] : '';
		$sql = "SELECT * FROM `v_c_voyage_port` WHERE voyage_id='$voyage_id' AND id='$port_id' ";
		$voyage_port = Yii::$app->db->createCommand($sql)->queryOne();

		if($_POST){
			$order_no = isset($_POST['order_no']) ? $_POST['order_no'] : '';
			$port_code = isset($_POST['port_code']) ? $_POST['port_code'] : '';
			$EIA = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$ETD = isset($_POST['e_time']) ? $_POST['e_time'] : '';
			$voyage_id_post = isset($_POST['voyage_id']) ? $_POST['voyage_id'] : '';
			$port_id = isset($_POST['port_id']) ? $_POST['port_id'] : '';
			if($order_no != '' && $port_code != '' ){

				$sql = "SELECT * FROM `v_c_voyage_port` WHERE order_no='$order_no' AND voyage_id !='$voyage_id_post'";
				$exist = Yii::$app->db->createCommand($sql)->queryOne();

				if($exist){
					if($EIA ==''){
						$sql = " INSERT INTO `v_c_voyage_port` (`voyage_id`,`port_code`,`order_no`,`ETD`) VALUES ('$voyage_id_post','$port_code','$order_no','$ETD')";
					}
					if($ETD == ''){
						$sql = " INSERT INTO `v_c_voyage_port` (`voyage_id`,`port_code`,`order_no`,`EIA`) VALUES ('$voyage_id_post','$port_code','$order_no','$EIA')";
					}
					
					$count = Yii::$app->db->createCommand($sql)->execute();
					if($count){
						Helper::show_message('Save success  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post."&port_id=".$port_id);
					}else{
						Helper::show_message('Save failed  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post."&port_id=".$port_id);
					}
				}else{
					Helper::show_message('Num Exists ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post."&port_id=".$port_id);
				}
			}
		}


		$sql = "SELECT a.port_code,b.port_name FROM `v_c_port` a LEFT JOIN `v_c_port_i18n` b ON a.port_code=b.port_code WHERE a.status=1 AND b.i18n='en' " ;
		$port = Yii::$app->db->createCommand($sql)->queryAll();

		return $this->render('voyage_port_edit',['port'=>$port,'voyage'=>$voyage,'voyage_port'=>$voyage_port]);
	}

	


}