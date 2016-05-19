<?php

namespace app\modules\ordermanagement\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;

class OrderController extends Controller
{
	public $enableCsrfValidation = false;
    public function actionFree_order()
    {
    	$query  = new Query();
    	$order = $query->select(['order_serial_number','voyage_code','travel_agent_name','total_pay_price','pay_status'])
		    	->from('v_voyage_order')
		    	->all();
    	return $this->render('free_order',['order'=>$order]);
    }
    
    
    public function actionGet_order_page()
    {
    	$pag = isset($_POST['pag']) ? $_POST['pag']==1 ? 0 :($_POST['pag']-1) * 2 : 0;
    	
    	$order_num = Yii::$app->request->post('order_num');
    	$status = Yii::$app->request->post('status');
    	$agent_name = Yii::$app->request->post('agent_name');
    	$voyage_code = Yii::$app->request->post('voyage_code');
    	
    	$where_order_num = [];
    	$where_status = [];
    	$where_agent_name = [];
    	$where_voyage_code = [];
    	
    	
    	if($order_num != ''){
    		$where_order_num = ['order_serial_number'=>$order_num];
    	}
    	if($status != '-1'){
    		$where_status = ['pay_status'=>$status];
    	}
    	
    	if($agent_name != ''){
    		$where_agent_name = ['travel_agent_name'=>$agent_name];
    	}
    	
    	if($voyage_code != ''){
    		$where_voyage_code = ['voyage_code'=>$voyage_code];
    	}
    	
    	
    	$query  = new Query();
    	$result = $query->select(['order_serial_number','voyage_code','travel_agent_name','total_pay_price','pay_status'])
	    	->from('v_voyage_order')
	    	->where($where_order_num)
	    	->andWhere($where_status)
	    	->andWhere($where_agent_name)
	    	->andWhere($where_voyage_code)
	    	->offset($pag)
	    	->limit(2)
	    	->all();
    	
	    	if($result){
	    		echo json_encode($result);
	    	}else{
	    		echo 0;
	    	}
    	
    }
    
    
    public function actionFree_order_detail()
    {
    	$order_serial_number = Yii::$app->request->get('order_serial_number');
    	
    	$query  = new Query();
    	$order = $query->select(['voyage_code','travel_agent_name','total_pay_price'])
		    	->from('v_voyage_order')
		    	->where(['order_serial_number'=>$order_serial_number])
		    	->one();
    	
		    	
		    	
    	$query  = new Query();
    	$order_detail = $query->select(['b.type_name','a.check_in_number','a.cabin_name','a.cabin_price','a.tax_price','a.status','a.passport_number_one','a.passport_number_two','a.passport_number_three','a.passport_number_four'])
		    	->from('v_voyage_order_detail a')
		    	->leftJoin('v_c_cabin_type_i18n b','a.cabin_type_code=b.type_code')
		    	->where(['order_serial_number'=>$order_serial_number])
		    	->all();

		foreach( $order_detail as $key=> $value){
			$query  = new Query();
			$passport_one[$key] = $query->select(['*'])
				->from('v_voyage_order_additional_price')
				->where(['order_serial_number'=>$order_serial_number,'voyage_code'=>$order['voyage_code'],'passport_number'=>$value['passport_number_one']])
				->all();
		}
		    	
		    	
		    	
	

    	return $this->render('free_order_detail',['order_serial_number'=>$order_serial_number,'order'=>$order,'order_detail'=>$order_detail]);
    }
    
    
    public function actionCabin_detail()
    {
    	return $this->render('cabin_detail');
    }
    
}
