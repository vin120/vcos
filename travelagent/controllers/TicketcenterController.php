<?php
namespace travelagent\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
class TicketcenterController  extends Controller
{
	public $layout = 'myloyout';
	
	public function actionTicket_center()
	{
		$query  = new Query();
		$query->select(['a.order_serial_number','a.voyage_code','a.total_pay_price','a.create_order_time','a.order_status','b.voyage_name'])
				->from('v_voyage_order a')
				->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where([])
				->limit(2)
				->all();
		
		$order = $query->createCommand()->queryAll();
		
		$query  = new Query();
		$count = $query->select(['*'])
				->from('v_voyage_order a')
				->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where([])
				->count();
		
		return $this->render('ticket_center',['order'=>$order,'count'=>$count,'pag'=>1]);
	}
}