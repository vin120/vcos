<?php

namespace app\modules\voyagemanagement\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\voyagemanagement\components\Helper;
use app\modules\voyagemanagement\models\VCVoyage;
use app\modules\voyagemanagement\models\VCVoyageI18n;
use yii\db\Query;
use app\modules\voyagemanagement\models\VCVoyagePort;
use app\modules\voyagemanagement\models\VCCabin;
use app\modules\voyagemanagement\models\VCVoyageMapI18n;



class VoyagesetController extends Controller
{
	public function actionIndex()
	{
		$_voyage_name = '';
		$_s_time = '';
		$_e_time = '';
		$where_voyage_name = [];
		$where_s_time = [];
		$where_e_time = [];
		if($_POST){
			$voyage_name = isset($_POST['voyage_name']) ? $_POST['voyage_name'] : '';
			$s_time = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$e_time = isset($_POST['e_time']) ? $_POST['e_time'] : '';
	
			$_voyage_name = $voyage_name;
			$_s_time = $s_time;
			$_e_time = $e_time;
			
			if($voyage_name != ''){
				$where_voyage_name = ['like','voyage_name',$voyage_name];
			}
			
			if($s_time != ''){
				$where_s_time = ['>','a.start_time',$s_time];;
			}

			if($e_time != ''){
				$where_e_time = ['<','a.end_time',$e_time];
			}
		}
		
		$query  = new Query();
		$query->select(['a.id','a.voyage_num','a.start_time','a.end_time','b.voyage_name'])
				->from('v_c_voyage a')
				->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en'])
				->andWhere($where_voyage_name)
				->andWhere($where_s_time)
				->andWhere($where_e_time)
				->all();
		$voyage = $query->createCommand()->queryAll();
		
		
		
		$query  = new Query();
		$count = $query->from('v_c_voyage a')
				->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en'])
				->andWhere($where_voyage_name)
				->andWhere($where_s_time)
				->andWhere($where_e_time)
				->count();
	
		return $this->render("index",['voyage'=>$voyage,'count'=>$count,'voyage_name'=>$_voyage_name,'s_time'=>$_s_time,'e_time'=>$_e_time]);
	}

	//航线分页
	public function actionGet_voyage_page()
	{
		$pag = isset($_GET['pag'])?$_GET['pag']==1?0:($_GET['pag']-1)*2:0;
		$voyage_name = isset($_GET['voyage_name']) ? $_GET['voyage_name'] : '';
		$s_time = isset($_GET['s_time']) ? $_GET['s_time'] : '';
		$e_time = isset($_GET['e_time']) ? $_GET['e_time'] : '';

		$where_voyage_name = [];
		$where_s_time = [];
		$where_e_time = [];
		
		
		if($voyage_name != ''){
			$where_voyage_name = ['like','voyage_name',$voyage_name];
		}
		
		if($s_time != ''){
			$where_s_time = ['>','a.start_time',$s_time];;
		}

		if($e_time != ''){
			$where_e_time = ['<','a.end_time',$e_time];
		}
		
		
		$query  = new Query();
		$query->select(['a.id','a.voyage_num','a.start_time','a.end_time','b.voyage_name'])
				->from('v_c_voyage a')
				->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en'])
				->andWhere($where_voyage_name)
				->andWhere($where_s_time)
				->andWhere($where_e_time)
				->offset($pag)
				->limit(2)
				->all();
		$result = $query->createCommand()->queryAll();
		

		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}

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
			$pdf_path = '';
			if(isset($_FILES['pdf'])){
				if($_FILES['pdf']['error'] != 4){
					if($_FILES['pdf']['type'] == 'application/pdf'){
						$result=Helper::upload_file('pdf', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'pdf', 3);
						$pdf_path=date('Ym',time()).'/'.$result['filename'];
					}else {
						Helper::show_message('Wrong Format','#');
						die;
					}
				}
			}
			$voyage_code = time();

			if($voyage_name != '' && $voyage_num != '' && $ticket_price != '' && $ticket_taxes != '' && $harbour_taxes != '' && $deposit_ratio != ''){
				//事务处理
				$transaction=Yii::$app->db->beginTransaction();
				try{
					
					Yii::$app->db->createCommand()->insert('v_c_voyage', [
						'voyage_code'=>$voyage_code,
						'cruise_code'=>$cruise_code,
						'start_time'=>$s_time,
						'end_time'=>$e_time,
						'status'=>1,
						'area_code'=>$area_code,
						'voyage_num'=>$voyage_num,
						'pdf_path'=>$pdf_path,
						'start_book_time'=>$s_book_time,
						'stop_book_time'=>$e_book_time,
						'ticket_price'=>$ticket_price,
						'ticket_taxes'=>$ticket_taxes,
						'harbour_taxes'=>$harbour_taxes,
						'deposit_ratio'=>$deposit_ratio,
					])->execute();
					
					$last_active_id = Yii::$app->db->getLastInsertID();
					
					Yii::$app->db->createCommand()->insert('v_c_voyage_i18n', [
						'voyage_code'=>$voyage_code,
						'voyage_name'=>$voyage_name,
						'voyage_desc'=>$desc,
						'i18n'=>'en',
					])->execute();

					$transaction->commit();
					Helper::show_message('Save success  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$last_active_id);
								
				}catch(Exception $e){
					$transaction->rollBack();
					Helper::show_message('Save failed  ',Url::toRoute(['voyage_add']));
				}
			}else{
				Helper::show_message('Save failed  ','#');
			}
		}

		$query  = new Query();
		$query->select(['a.area_code','b.area_name'])
				->from('v_c_area a')
				->join('LEFT JOIN','v_c_area_i18n b','a.area_code=b.area_code')
				->where(['b.i18n'=>'en','a.status'=>'1'])
				->all();
		$area = $query->createCommand()->queryAll();
		
		
		$query  = new Query();
		$query->select(['a.cruise_code','b.cruise_name'])
				->from('v_cruise a')
				->join('LEFT JOIN','v_cruise_i18n b','a.cruise_code=b.cruise_code')
				->where(['b.i18n'=>'en','a.status'=>'1'])
				->all();
		$cruise = $query->createCommand()->queryAll();

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
					if($_FILES['pdf']['type'] == 'application/pdf'){
						$result=Helper::upload_file('pdf', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'pdf', 3);
						$pdf_path=date('Ym',time()).'/'.$result['filename'];
					}else{
						Helper::show_message('Wrong Format',Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
						die;
					}
				}
			}
			if($voyage_name != '' && $voyage_num != '' && $ticket_price != '' && $ticket_taxes != '' && $harbour_taxes != '' && $deposit_ratio != '' ){
				//事务
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
					Helper::show_message('Save failed  ',Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
				}
			}else{
				Helper::show_message('Save failed  ',Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
			}
		}
		

		
		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id'] : '';
		
		$query  = new Query();
		$query->select(['a.*','b.voyage_name','b.voyage_desc'])
				->from('v_c_voyage a')
				->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['a.id'=>$voyage_id,'b.i18n'=>'en','a.status'=>'1'])
				->one();
		$voyage = $query->createCommand()->queryOne();
		
		
		$query  = new Query();
		$query->select(['a.area_code','b.area_name'])
				->from('v_c_area a')
				->join('LEFT JOIN','v_c_area_i18n b','a.area_code=b.area_code')
				->where(['b.i18n'=>'en','a.status'=>'1'])
				->all();
		$area = $query->createCommand()->queryAll();
		

		$query  = new Query();
		$query->select(['a.cruise_code','b.cruise_name'])
				->from('v_cruise a')
				->join('LEFT JOIN','v_cruise_i18n b','a.cruise_code=b.cruise_code')
				->where(['b.i18n'=>'en','a.status'=>'1'])
				->all();
		$cruise = $query->createCommand()->queryAll();
		
		$count = VCVoyagePort::find()->where(['voyage_id'=>$voyage_id])->count();

		
		return $this->render('voyage_edit',['voyage'=>$voyage,'area'=>$area,'cruise'=>$cruise,'voyage_port_page'=>1,'count'=>$count]);
	}
	
	
	
	//voyage port ajax 
	public function actionGet_voyage_port_ajax()
	{
		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id'] : '';
		
		$query  = new Query();
		$query->select(['*'])
				->from('v_c_voyage_port')
				->where(['voyage_id'=>$voyage_id])
				->limit(2)
				->all();
		$voyage_port = $query->createCommand()->queryAll();
		
		
		$query  = new Query();
		$query->select(['a.port_code','b.port_name'])
				->from('v_c_port a')
				->join('LEFT JOIN','v_c_port_i18n b','a.port_code=b.port_code')
				->where(['b.i18n'=>'en','a.status'=>'1'])
				->all();
		$port = $query->createCommand()->queryAll();
		
		
		foreach($port as $port_row){
			foreach ($voyage_port as $key => $value ) {
				if($port_row['port_code'] == $value['port_code']) {
					$voyage_port[$key]['port_name'] = $port_row['port_name'];
				}
			}
		}
		
		
		if($voyage_port){
			echo json_encode($voyage_port);
		}else{
			echo 0;
		}
		
	}
	
	//active ajax
	public function actionGet_active_ajax()
	{
		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id'] : '';
		
		$query  = new Query();
				$query->select(['a.active_id','b.name'])
				->from('v_c_active a')
				->join('LEFT JOIN','v_c_active_i18n b','a.active_id=b.active_id')
				->where(['a.status'=>1,'b.i18n'=>'en'])
				->all();
		$active_result = $query->createCommand()->queryAll();
		
		
		$query  = new Query();
		$query->select(['a.id','c.name'])
				->from('v_c_voyage_active a')
				->leftJoin('v_c_active b','a.curr_active_id=b.active_id')
				->leftJoin('v_c_active_i18n c','b.active_id=c.active_id')
				->where(['b.status'=>1,'c.i18n'=>'en','a.voyage_id'=>$voyage_id])
				->limit(1)
				->one();
		$curr_active_result = $query->createCommand()->queryOne();
		
		$arr = [];
		$arr['active'] = $active_result;
		$arr['curr_active'] = $curr_active_result;
		if($arr){
			echo json_encode($arr);
		}else{
			echo 0;
		}
		
	}
	
	//map ajax
	public function actionGet_voyage_map_ajax()
	{
		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id'] : '';
		
		$query  = new Query();
		$query->select(['id'])
				->from('v_c_voyage')
				->where(['id'=>$voyage_id])
				->one();
		$voyage = $query->createCommand()->queryOne();
		
		
		$query  = new Query();
		$query->select(['*'])
				->from('v_c_voyage_map a')
				->join('LEFT JOIN','v_c_voyage_map_i18n b','a.id=b.map_id')
				->where(['a.voyage_id'=>$voyage_id])
				->limit(1)
				->one();
		$map_result = $query->createCommand()->queryOne();
		
		$arr = [];
		$arr['voyage'] = $voyage;
		$arr['map_result'] = $map_result;
		if($arr){
			echo json_encode($arr);
		}else{
			echo 0;
		}
	}
	
	//cabin ajax
	public function actionGet_cabin_ajax()
	{
		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id'] : '';
		
		$query  = new Query();
		$query->select(['id'])
				->from('v_c_voyage')
				->where(['id'=>$voyage_id])
				->one();
		$voyage = $query->createCommand()->queryOne();
		
		$query  = new Query();
		$query->select(['a.id','b.type_name'])
				->from('v_c_cabin_type a')
				->join('LEFT JOIN','v_c_cabin_type_i18n b','a.type_code=b.type_code')
				->where(['b.i18n'=>'en','a.type_status'=>'1'])
				->all();
		$cabin_type_result = $query->createCommand()->queryAll();
		
		$query  = new Query();
		$query->select(['id','cabin_name'])
				->from('v_c_cabin_lib')
				->where(['status'=>1,'cabin_type_id'=>$cabin_type_result[0]['id'],'deck_num'=>1])
				->all();
		$cabin_result = $query->createCommand()->queryAll();
		
		$query  = new Query();
		$query->select(['a.cabin_lib_id','b.cabin_name'])
				->from('v_c_cabin a')
				->join('LEFT JOIN','v_c_cabin_lib b','a.cabin_lib_id=b.id')
				->where(['a.deck'=>1,'a.cabin_type_id'=>$cabin_type_result[0]['id']])
				->all();
		$really_cabin_result = $query->createCommand()->queryAll();
		
		$cruise_code = Yii::$app->params['cruise_code'];
		
		
		$query  = new Query();
		$query->select(['deck_number'])
				->from('v_cruise')
				->where(['cruise_code'=>$cruise_code])
				->one();
		$cruise_result = $query->createCommand()->queryOne();
		
		$arr =  [];
		$arr['voyage'] = $voyage;
		$arr['cabin_result'] = $cabin_result;
		$arr['cabin_type_result'] = $cabin_type_result;
		$arr['really_cabin_result'] = $really_cabin_result;
		$arr['cruise_result'] = $cruise_result;
		if($arr){
			echo json_encode($arr);
		}else{
			echo 0;
		}
	}
	
	
	//return ajax
	public function actionGet_return_route_ajax()
	{
		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id'] : '';
		
		$query  = new Query();
		$query->select(['a.id','c.voyage_name'])
				->from('v_c_return_voyage a')
				->leftJoin('v_c_voyage b','a.return_voyage_id=b.id')
				->leftJoin('v_c_voyage_i18n c','b.voyage_code=c.voyage_code')
				->where(['b.status'=>1,'c.i18n'=>'en','a.voyage_id'=>$voyage_id])
				->limit(1)
				->one();
		$curr_return_voyage_result = $query->createCommand()->queryOne();
		
		$query  = new Query();
		$query->select(['a.id','b.voyage_name'])
				->from('v_c_voyage a')
				->leftJoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['a.status'=>1,'b.i18n'=>'en'])
				->all();
		$voyage_return = $query->createCommand()->queryAll();
		
		$arr = [];
		$arr['curr_return_voyage_result'] = $curr_return_voyage_result;
		$arr['voyage_return'] = $voyage_return;
		
		if($arr){
			echo json_encode($arr);
		}else{
			echo 0;
		}
	}
	

	//港口分页
	public function actionGet_voyage_port_page()
	{
		$pag = isset($_GET['pag']) ? $_GET['pag']==1 ? 0 :($_GET['pag']-1) * 2 : 0;
		$voyage_id = isset($_GET['voyage_id']) ?$_GET['voyage_id'] :'';
		
		
		$query  = new Query();
		$query->select(['*'])
				->from('v_c_voyage_port')
				->where(['voyage_id'=>$voyage_id])
				->offset($pag)
				->limit(2)
				->all();
		$result = $query->createCommand()->queryAll();
		
		
		$query  = new Query();
		$query->select(['a.port_code','b.port_name'])
				->from('v_c_port a')
				->leftJoin('v_c_port_i18n b','a.port_code=b.port_code')
				->where(['a.status'=>1,'b.i18n'=>'en'])
				->all();
		$port = $query->createCommand()->queryAll();
		
		
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
			VCVoyagePort::deleteAll(['id'=>$id]);
			Helper::show_message('Delete successful', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
		}
		
		//选中删除
		if(isset($_POST['ids'])){
			$ids = implode(',', $_POST['ids']);
			$voyage_id = $_POST['voyage_id'];
			VCVoyagePort::deleteAll("id in ($ids)");
			Helper::show_message('Delete successful ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id);
		}
	}

	
	//港口添加
	public function actionVoyage_port_add()
	{
		$voyage_id = isset($_GET['voyage_id']) ? $_GET['voyage_id'] : '';
		$voyage = VCVoyage::find()->where(['id'=>$voyage_id])->one();
		
		if($_POST){
			$order_no = isset($_POST['order_no']) ? $_POST['order_no'] : '';
			$port_code = isset($_POST['port_code']) ? $_POST['port_code'] : '';
			$EIA = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$ETD = isset($_POST['e_time']) ? $_POST['e_time'] : '';
			$voyage_id_post = isset($_POST['voyage_id']) ? $_POST['voyage_id'] : '';
 
			if($order_no != '' && $port_code != '' ){
				$count = VCVoyagePort::find()->where(['order_no'=>$order_no,'voyage_id'=>$voyage_id_post])->count();
				if($count <= 0){
					$vcvoyageport_obj = new VCVoyagePort();
					$vcvoyageport_obj->voyage_id = $voyage_id_post;
					$vcvoyageport_obj->port_code = $port_code;
					$vcvoyageport_obj->order_no = $order_no;
					if($ETD != ''){
						$vcvoyageport_obj->ETD = $ETD;
					}else{
						$vcvoyageport_obj->ETD = null;
					}
					if($EIA != ''){
						$vcvoyageport_obj->EIA = $EIA;
					}else{
						$vcvoyageport_obj->EIA = null;
					}
					$vcvoyageport_obj->save();
					
					Helper::show_message('Save success  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post);
				}else{
					Helper::show_message('Save failed , Num '.$order_no .' Exists ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post);
				}
			}
		}
		
		$query  = new Query();
		$query->select(['a.port_code','b.port_name'])
				->from('v_c_port a')
				->join('LEFT JOIN','v_c_port_i18n b','a.port_code=b.port_code')
				->where(['a.status'=>1,'b.i18n'=>'en'])
				->all();
		$port = $query->createCommand()->queryAll();

		return $this->render('voyage_port_add',['port'=>$port,'voyage'=>$voyage]);
	}

	
	//港口编辑
	public function actionVoyage_port_edit()
	{
		$voyage_id = isset($_GET['voyage_id']) ? $_GET['voyage_id'] : '';
		$voyage = VCVoyage::find()->where(['id'=>$voyage_id])->one();

		$port_id = isset($_GET['port_id']) ? $_GET['port_id'] : '';
		$voyage_port = VCVoyagePort::find()->where(['voyage_id'=>$voyage_id,'id'=>$port_id])->one();
		
		
		if($_POST){
			$order_no = isset($_POST['order_no']) ? $_POST['order_no'] : '';
			$port_code = isset($_POST['port_code']) ? $_POST['port_code'] : '';
			$EIA = isset($_POST['s_time']) ? $_POST['s_time'] : '';
			$ETD = isset($_POST['e_time']) ? $_POST['e_time'] : '';
			$voyage_id_post = isset($_POST['voyage_id']) ? $_POST['voyage_id'] : '';
			$port_id = isset($_POST['port_id']) ? $_POST['port_id'] : '';
			
			if($order_no != '' && $port_code != '' ){
				$exist = VCVoyagePort::find()->where(['order_no'=>$order_no,'voyage_id'=>$voyage_id_post])->andWhere(['!=','id',$port_id])->one();
				
				if(!$exist){
					$vcvoyageport_obj = VCVoyagePort::findOne(['voyage_id'=>$voyage_id_post,'id'=>$port_id]);
					$vcvoyageport_obj->order_no = $order_no;
					$vcvoyageport_obj->port_code = $port_code;
					if($ETD !=''){
						$vcvoyageport_obj->ETD = $ETD;
					}else{
						$vcvoyageport_obj->ETD = null;
					}
					if($EIA != ''){
						$vcvoyageport_obj->EIA = $EIA;
					}else{
						$vcvoyageport_obj->EIA = null;
					}
					$vcvoyageport_obj->save();
					Helper::show_message('Save success  ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post."&port_id=".$port_id);
				}else{
					Helper::show_message('Save failed , Num '.$order_no .' Exists ', Url::toRoute(['voyage_edit'])."&voyage_id=".$voyage_id_post."&port_id=".$port_id);
				}
			}
		}

		$query  = new Query();
		$query->select(['a.port_code','b.port_name'])
				->from('v_c_port a')
				->join('LEFT JOIN','v_c_port_i18n b','a.port_code=b.port_code')
				->where(['a.status'=>1,'b.i18n'=>'en'])
				->all();
		$port = $query->createCommand()->queryAll();

		return $this->render('voyage_port_edit',['port'=>$port,'voyage'=>$voyage,'voyage_port'=>$voyage_port]);
	}
	
	

	//航线-》船舱保存
	public function actionVoyage_cabin_save(){
		$db = Yii::$app->db;
		$res = 0;
		$cabin_type_id = isset($_GET['cabin_type_id'])?$_GET['cabin_type_id']:'0';
		$cabin_deck = isset($_GET['cabin_deck'])?$_GET['cabin_deck']:'0';
		$voyage_id = isset($_GET['voyage_id'])?$_GET['voyage_id']:'0';
		$cabin_lib_id = isset($_GET['cabin_lib_id'])?$_GET['cabin_lib_id']:'';
	
		$cabin_lib_id = explode(',', $cabin_lib_id);
		$data = '';
		foreach ($cabin_lib_id as $v){
			if($v!=''){
				$data .= "(".$voyage_id.",".$cabin_type_id.",".$cabin_deck.",".$v."),";
			}
		}
		$data = trim($data,',');
	
		//事务处理
		$transaction=$db->beginTransaction();
		try{
			
			VCCabin::deleteAll(['voyage_id'=>$voyage_id,'cabin_type_id'=>$cabin_type_id,'deck'=>$cabin_deck]);
			
			$sql = "INSERT INTO `v_c_cabin` (voyage_id,cabin_type_id,deck,cabin_lib_id) VALUES ".$data;
			Yii::$app->db->createCommand($sql)->execute();
			
			$transaction->commit();
			$res = 1;
		}catch(Exception $e){
			$transaction->rollBack();
			$res = 0;
		}
		echo $res;
	}
	
	
	
	//航线-》船舱改变类型
	public function actionVoyage_cabin_change_type_get_cabin_lib(){
		$type_id = isset($_GET['type_id'])?$_GET['type_id']:'';
		$deck = isset($_GET['deck'])?$_GET['deck']:'';
		
		$query  = new Query();
		$query->select(['id','cabin_name'])
				->from('v_c_cabin_lib')
				->where(['status'=>1,'cabin_type_id'=>$type_id,'deck_num'=>$deck])
				->all();
		$cabin_result = $query->createCommand()->queryAll();
		
		$query  = new Query();
		$query->select(['a.cabin_lib_id','b.cabin_name'])
				->from('v_c_cabin a')
				->join('LEFT JOIN','v_c_cabin_lib b','a.cabin_lib_id=b.id')
				->where(['status'=>1,'a.cabin_type_id'=>$type_id,'a.deck_num'=>$deck])
				->all();
		$really_cabin_result = $query->createCommand()->queryAll();
		
		$result_arr = array();
		$result_arr['cabin_lib'] = $cabin_result;
		$result_arr['really'] = $really_cabin_result;
		if($result_arr){
			echo json_encode($result_arr);
		}else{
			echo 0;
		}
	}
	
	
	//航线-》航线图上传
	public function actionVoyage_map(){
		$db = Yii::$app->db;
		if($_POST){
			$map_id = isset($_POST['map_id'])?$_POST['map_id']:'';
			$voyage_map_id = isset($_POST['voyage_map_id'])?$_POST['voyage_map_id']:'0';
				
			$photo = '';
			$photo_data = '';
			if($_FILES['photoimg']['error']!=4){
				$result=Helper::upload_file('photoimg', Yii::$app->params['img_save_url'].'voyagemanagement/themes/basic/static/upload/'.date('Ym',time()), 'image', 3);
				$photo_data=$result['filename'];
			}
			$photo=date('Ym',time()).'/'.$photo_data;
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				if($map_id!=''){
					if($photo_data!=''){
						
						$sql = "UPDATE `v_c_voyage_map_i18n` set map_img='$photo' WHERE map_id='{$map_id}'";
						Yii::$app->db->createCommand($sql)->execute();
					}
				}else{
					$sql = "insert into `v_c_voyage_map` (voyage_id) values ('$voyage_map_id')";
					Yii::$app->db->createCommand($sql)->execute();
					$last_id = Yii::$app->db->getLastInsertID();
					$sql = "insert into `v_c_voyage_map_i18n` (map_id,map_img,i18n) values ($last_id,'$photo','en')";
					Yii::$app->db->createCommand($sql)->execute();
				}
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['voyage_edit','voyage_id'=>$voyage_map_id]));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
	}
	
	
	public function actionVoyage_active(){
		$db = Yii::$app->db;
	
		if($_GET){
			$voyage_active_id = isset($_GET['voyage_active_id'])?$_GET['voyage_active_id']:'0';
			$voyage_active = isset($_GET['voyage_active'])?$_GET['voyage_active']:'';
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$sql = "DELETE FROM `v_c_voyage_active` WHERE voyage_id=".$voyage_active_id;
				Yii::$app->db->createCommand($sql)->execute();
				$sql = "INSERT INTO `v_c_voyage_active` (voyage_id,curr_active_id) values ('$voyage_active_id','$voyage_active')";
				Yii::$app->db->createCommand($sql)->execute();
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['voyage_edit','voyage_id'=>$voyage_active_id]));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
	}
	
	public function actionReturn_voyage(){
		$db = Yii::$app->db;
	
		if($_GET){
			$return_voyage_id = isset($_GET['return_voyage_id'])?$_GET['return_voyage_id']:'0';
			$return_voyage = isset($_GET['return_voyage'])?$_GET['return_voyage']:'';
			//事务处理
			$transaction=$db->beginTransaction();
			try{
				$sql = "DELETE FROM `v_c_return_voyage` WHERE voyage_id=".$return_voyage_id;
				Yii::$app->db->createCommand($sql)->execute();
				$sql = "INSERT INTO `v_c_return_voyage` (voyage_id,return_voyage_id) values ('$return_voyage_id','$return_voyage')";
				Yii::$app->db->createCommand($sql)->execute();
				$transaction->commit();
				Helper::show_message('Save success  ', Url::toRoute(['voyage_edit','voyage_id'=>$return_voyage_id]));
			}catch(Exception $e){
				$transaction->rollBack();
				Helper::show_message('Save failed  ','#');
			}
		}
	}

}