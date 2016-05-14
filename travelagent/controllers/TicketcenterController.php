<?php
namespace travelagent\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
class TicketcenterController  extends Controller
{
	public $layout = 'myloyout';
	public $enableCsrfValidation = false;
	
	
	public function actionTicket_center()
	{
		$query  = new Query();
		$order = $query->select(['a.order_serial_number','a.voyage_code','a.total_pay_price','a.create_order_time','a.pay_status','b.voyage_name'])
				->from('v_voyage_order a')
				->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en'])
				->limit(2)
				->all();
		$query  = new Query();
		$order_num = $query->select(['order_serial_number'])
				->from('v_voyage_order')
				->all();
				
		$query  = new Query();
		$count = $query->select(['a.order_serial_number','a.voyage_code','a.total_pay_price','a.create_order_time','a.order_status','b.voyage_name'])
				->from('v_voyage_order a')
				->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en'])
				->count();
	
		return $this->render('ticket_center',['order'=>$order,'count'=>$count,'order_num'=>$order_num,'pag'=>1]);
	}
	
	
	//ajax搜索
	public function actionTicket_center_search()
	{
		$order_no = Yii::$app->request->post('order_no','');
		$route_name = Yii::$app->request->post('route_name','');
		$start_time = Yii::$app->request->post('start_time','');
		$end_time = Yii::$app->request->post('end_time','');
		$route_code = Yii::$app->request->post('route_code','');
		
		
		$where_order_no = [];
		$where_route_name = [];
		$where_start_time = [];
		$where_end_time = [];
		$where_route_code = [];
		
		if($order_no != 'All'){
			$where_order_no = ['=','a.order_serial_number',$order_no];
		}
		
		if($route_name != ''){
			$where_route_name = ['like','b.voyage_name',$route_name];
		}
		
		if($start_time != ''){
			$where_start_time = ['>','a.create_order_time',$start_time];
		}
		
		if($end_time != ''){
			$where_end_time = ['<','a.create_order_time',$end_time];
		}
		
		if($route_code != ''){
			$where_route_code = ['like','a.voyage_code',$route_code];
		}
		
		$query  = new Query();
		$result = $query->select(['a.order_serial_number','a.voyage_code','a.total_pay_price','a.create_order_time','a.pay_status','b.voyage_name'])
		->from('v_voyage_order a')
		->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->andWhere($where_order_no)
		->andWhere($where_route_name)
		->andWhere($where_start_time)
		->andWhere($where_end_time)
		->andWhere($where_route_code)
		->limit(2)
		->all();
		
		
		$query  = new Query();
		$count = $query->select(['*'])
		->from('v_voyage_order a')
		->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->andWhere($where_order_no)
		->andWhere($where_route_name)
		->andWhere($where_start_time)
		->andWhere($where_end_time)
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
	public function actionGet_ticket_center_page()
	{
		$pag = isset($_POST['pag']) ? $_POST['pag']==1 ? 0 :($_POST['pag']-1) * 2 : 0;
		
		$order_no_hidden = Yii::$app->request->post('order_no_hidden','');
		$route_name_hidden = Yii::$app->request->post('route_name_hidden','');
		$start_time_hidden = Yii::$app->request->post('start_time_hidden','');
		$end_time_hidden = Yii::$app->request->post('end_time_hidden','');
		$route_code_hidden = Yii::$app->request->post('route_code_hidden','');
		
		$where_order_no = [];
		$where_route_name = [];
		$where_start_time = [];
		$where_end_time = [];
		$where_route_code = [];
		
		if($order_no_hidden != 'All'){
			$where_order_no = ['=','a.order_serial_number',$order_no_hidden];
		}
		
		if($route_name_hidden != ''){
			$where_route_name = ['like','b.voyage_name',$route_name_hidden];
		}
		
		if($start_time_hidden != ''){
			$where_start_time = ['>','a.create_order_time',$start_time_hidden];
		}
		
		if($end_time_hidden != ''){
			$where_end_time = ['<','a.create_order_time',$end_time_hidden];
		}
		
		if($route_code_hidden != ''){
			$where_route_code = ['like','a.voyage_code',$route_code_hidden];
		}
		
		$query  = new Query();
		$result = $query->select(['a.order_serial_number','a.voyage_code','a.total_pay_price','a.create_order_time','a.pay_status','b.voyage_name'])
		->from('v_voyage_order a')
		->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where(['b.i18n'=>'en'])
		->andWhere($where_order_no)
		->andWhere($where_route_name)
		->andWhere($where_start_time)
		->andWhere($where_end_time)
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
	
}