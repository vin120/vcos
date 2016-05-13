<?php
/**
 * Created by PhpStorm.
 * User: leijiao
 * Date: 16/3/15
 * Time: 下午4:58
 */

namespace travelagent\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;


class BookingtickeController  extends Controller
{
	public $layout = "myloyout.php";
	public $enableCsrfValidation = false;
	
	public function actionBooking_ticke(){
		
		$query  = new Query();
		$result = $query->select(['a.voyage_code','a.ticket_price','a.start_time','a.end_time','b.voyage_name','b.i18n'])
		->from('v_c_voyage a')
		->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->limit(2)
		->all();
		
		$query  = new Query();
		$count = $query->select(['*'])
		->from('v_c_voyage a')
		->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->count();
		
		return $this->render("booking_ticke",['result'=>$result,'count'=>$count,'booking_ticke_pag'=>1]);
	}
	
	//通过ajax搜索内容
	public function actionBooking_ticket_search()
	{
		$sailing_date = Yii::$app->request->post('sailing_date','');
		$route_name = Yii::$app->request->post('route_name','');
		$route_code = Yii::$app->request->post('route_code','');
		
		$where_sailing_data = [];
		$where_route_name = [];
		$where_route_code = [];
		
		if($sailing_date != ''){
			$where_sailing_data = ['=','a.start_time',$sailing_date];
		}
		
		if($route_name != ''){
			$where_route_name = ['like','b.voyage_name',$route_name];
		}
		
		if($route_code != ''){
			$where_route_code = ['like','a.voyage_code',$route_code];
		}
		
		$query  = new Query();
		$result = $query->select(['a.voyage_code','a.ticket_price','a.start_time','a.end_time','b.voyage_name','b.i18n'])
		->from('v_c_voyage a')
		->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->andWhere($where_sailing_data)
		->andWhere($where_route_name)
		->andWhere($where_route_code)
		->limit(2)
		->all();
		
		$query  = new Query();
		$count = $query->select(['*'])
		->from('v_c_voyage a')
		->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->andWhere($where_sailing_data)
		->andWhere($where_route_name)
		->andWhere($where_route_code)
		->count();
		
		
		$result['count'] = $count;
		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}
	

	
	//分页
	public function actionGet_booking_ticke_page(){
		
		$pag = isset($_POST['pag']) ? $_POST['pag']==1 ? 0 :($_POST['pag']-1) * 2 : 0;
		
		$sailing_date_hidden = Yii::$app->request->post('sailing_date_hidden','');
		$route_name_hidden = Yii::$app->request->post('route_name_hidden','');
		$route_code_hidden = Yii::$app->request->post('route_code_hidden','');
		
		$where_sailing_data = [];
		$where_route_name = [];
		$where_route_code = [];
		
		if($sailing_date_hidden != ''){
			$where_sailing_data = ['=','a.start_time',$sailing_date_hidden];
		}
		
		if($route_name_hidden != ''){
			$where_route_name = ['like','b.voyage_name',$route_name_hidden];
		}
		
		if($route_code_hidden != ''){
			$where_route_code = ['like','a.voyage_code',$route_code_hidden];
		}
		
		
		$query  = new Query();
		$result = $query->select(['a.voyage_code','a.ticket_price','a.start_time','a.end_time','b.voyage_name','b.i18n'])
		->from('v_c_voyage a')
		->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->andWhere($where_sailing_data)
		->andWhere($where_route_name)
		->andWhere($where_route_code)
		->offset($pag)
		->limit(2)
		->all();
		
		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}

	public function actionInput_mode(){
		$voyage_code = isset($_GET['code'])?$_GET['code']:'';
		return $this->render("input_mode",['code'=>$voyage_code]);
	}
	
	
	public function actionAdd_uest_info(){
		return $this->render("add_uest_info");
	}
	
	public function actionAdd_uest_info_save(){
		
		
	}
	
	
	public function actionGet_country_data(){
		$query  = new Query();
		$result = $query->select(['a.country_code','b.country_name'])
		->from('v_c_country a')
		->join('LEFT JOIN','v_c_country_i18n b','a.country_code=b.country_code')
		->where(['b.i18n'=>'en','a.status'=>'1'])
		->offset($pag)
		->limit(2)
		->all();
		
		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}
}