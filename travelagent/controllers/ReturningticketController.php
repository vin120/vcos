<?php

namespace travelagent\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;

class ReturningticketController  extends Controller
{
	public $layout = "myloyout";
	
	public function actionReturning_ticket()
	{
		$query  = new Query();
		$order = $query->select(['a.order_serial_number','a.voyage_code','a.total_pay_price','a.create_order_time','a.order_status','b.voyage_name'])
		->from('v_voyage_order a')
		->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where([])
		->limit(2)
		->all();
		
		
		$query  = new Query();
		$count = $query->select(['*'])
		->from('v_voyage_order a')
		->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
		->where([])
		->count();
		
		return $this->render('returning_ticket');
	}
}