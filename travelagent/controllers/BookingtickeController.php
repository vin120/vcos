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
	public $layout = "myloyout";
	public function actionBooking_ticke(){
		
		$query  = new Query();
		$query->select(['a.voyage_code','a.ticket_price','a.start_time','a.end_time','b.voyage_name','b.i18n'])
				->from('v_c_voyage a')
				->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en'])
				->limit(2)
				->all();
		$result = $query->createCommand()->queryAll();
		
		$query  = new Query();
		$count = $query->select(['a.*'])
				->from('v_c_voyage a')
				->join('LEFT JOIN','v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en'])
				->count();
		return $this->render("booking_ticke",['result'=>$result,'count'=>$count,'booking_ticke_pag'=>1]);
	}
	
	
}