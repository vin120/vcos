<?php

namespace travelagent\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;

class ReturningticketController  extends Controller
{
	public $layout = "myloyout";
	public $enableCsrfValidation = false;
	public function actionReturning_ticket()
	{
		$query  = new Query();
		$order = $query->select(['a.order_serial_number','a.voyage_code','a.total_pay_price','a.create_order_time','a.pay_status','b.voyage_name'])
				->from('v_voyage_order a')
				->leftjoin('v_c_voyage_i18n b','a.voyage_code=b.voyage_code')
				->where(['b.i18n'=>'en','a.pay_status'=>1])
				->limit(2)
				->all();
		return $this->render('returning_ticket',['order'=>$order]);
	}
	public function actionReturn_ticket_info(){
		$order_serial_number=isset($_GET['id'])?$_GET['id']:'';
		$member = [];
		$sql = "SELECT passport_number_one,passport_number_two,passport_number_three,passport_number_four,cabin_price,tax_price FROM v_voyage_order_detail WHERE order_serial_number ='$order_serial_number'";
		$passport = Yii::$app->db->createCommand($sql)->queryAll();
		$totalroomprice=0;
		$tax_price=0;
		$surcharge=0;
		$quayage=0;
		foreach ($passport as $key=>$row ){
			$totalroomprice=$totalroomprice+$row['cabin_price'];//房间总价
			$tax_price=$tax_price+$row['tax_price'];//税收
			$tmp1 = $row['passport_number_one'];
			$tmp2 = $row['passport_number_two'];
			$tmp3 = $row['passport_number_three'];
			$tmp4 = $row['passport_number_four'];
			$quayagesql1="select additional_price from v_voyage_order_detail d left join v_voyage_order_additional_price a on a.order_serial_number=d.order_serial_number and a.passport_number=d.passport_number_one and a.price_type=1 where a.passport_number='$tmp1'";
			$quayagesql2="select additional_price from v_voyage_order_detail d left join v_voyage_order_additional_price a on a.order_serial_number=d.order_serial_number and a.passport_number=d.passport_number_two and a.price_type=1 where a.passport_number='$tmp2'";
			$quayagesql3="select additional_price from v_voyage_order_detail d left join v_voyage_order_additional_price a on a.order_serial_number=d.order_serial_number and a.passport_number=d.passport_number_three and a.price_type=1 where a.passport_number='$tmp3'";
			$quayagesql4="select additional_price from v_voyage_order_detail d left join v_voyage_order_additional_price a on a.order_serial_number=d.order_serial_number and a.passport_number=d.passport_number_four and a.price_type=1 where a.passport_number='$tmp4'";
			$quayage1 = Yii::$app->db->createCommand($quayagesql1)->queryOne();//码头税
			$quayage2 = Yii::$app->db->createCommand($quayagesql2)->queryOne();//码头税
			$quayage3 = Yii::$app->db->createCommand($quayagesql3)->queryOne();//码头税
			$quayage4 = Yii::$app->db->createCommand($quayagesql4)->queryOne();//码头税
			$quayage=$quayage+$quayage1['additional_price']+$quayage2['additional_price']+$quayage3['additional_price']+$quayage4['additional_price'];
			$tmp = $row['passport_number_one'];
			//$sql = "SELECT * FROM v_membership WHERE passport_number='$tmp'";
			$sql="select m.*,a.additional_price,a.price_type from v_voyage_order_detail d
			left join v_membership m on m.passport_number=d.passport_number_one
			left join v_voyage_order_additional_price a on d.order_serial_number=a.order_serial_number and d.passport_number_one=a.passport_number and a.price_type=2
			where m.passport_number='$tmp'";	
			$info1 = Yii::$app->db->createCommand($sql)->queryOne();
			if(!empty($info1)){
				$surcharge=$surcharge+$info1['additional_price'];
				$member[$key][]=$info1;
			}
			$tmp = $row['passport_number_two'];
			//$sql = "SELECT * FROM v_membership WHERE passport_number='$tmp'";
			$sql="select m.*,a.additional_price,a.price_type from v_voyage_order_detail d
			left join v_membership m on m.passport_number=d.passport_number_two
			left join v_voyage_order_additional_price a on d.order_serial_number=a.order_serial_number and d.passport_number_two=a.passport_number  and a.price_type=2
			where  m.passport_number='$tmp'";
			$info2 = Yii::$app->db->createCommand($sql)->queryOne();
			if(!empty($info2)){
			$surcharge=$surcharge+$info2['additional_price'];
				$member[$key][]=$info2;
			}
			$tmp = $row['passport_number_three'];
			//$sql = "SELECT * FROM v_membership WHERE passport_number='$tmp'";
			$sql="select m.*,a.additional_price,a.price_type from v_voyage_order_detail d
			left join v_membership m on m.passport_number=d.passport_number_three
			left join v_voyage_order_additional_price a on d.order_serial_number=a.order_serial_number and d.passport_number_three=a.passport_number and a.price_type=2
			where  m.passport_number='$tmp'";
			$info3 = Yii::$app->db->createCommand($sql)->queryOne();
			if(!empty($info3)){
			$surcharge=$surcharge+$info3['additional_price'];
			$member[$key][]=$info3;
			}
			$tmp = $row['passport_number_four'];
			//$sql = "SELECT * FROM v_membership WHERE passport_number='$tmp'";
			$sql="select m.*,a.additional_price,a.price_type from v_voyage_order_detail d
			left join v_membership m on m.passport_number=d.passport_number_four
			left join v_voyage_order_additional_price a on d.order_serial_number=a.order_serial_number and d.passport_number_four=a.passport_number and a.price_type=2
			where m.passport_number='$tmp'";
			$info4= Yii::$app->db->createCommand($sql)->queryOne();
			if(!empty($info4)){
			$surcharge=$surcharge+$info4['additional_price'];
			$member[$key][]=$info4;
			}
		}
	
		$sql="select * from v_voyage_order_detail where order_serial_number='$order_serial_number'";
			$data=\Yii::$app->db->createCommand($sql)->queryAll();
			for($i=0;$i<sizeof($data);$i++){
			$data[$i]['member'] = $member;
	}
	
			return $this->render("return_ticket_info",['data'=>$data,'totalroomprice'=>$totalroomprice,'tax_price'=>$tax_price,'surcharge'=>$surcharge,'quayage'=>$quayage]);
	
	}
	public function actionReturnticket(){
		
	
		$ids=[];
		$ids=isset($_POST['value'])?$_POST['value']:'';
	
	 		if($ids!=''){
			$ids=implode('\',\'',$ids);
			$sql="update v_voyage_order_detail set status=2 where id in('$ids')";
			$transaction =\Yii::$app->db->beginTransaction();
			try {
				$command2= \Yii::$app->db->createCommand($sql)->execute();
				$transaction->commit();
				echo 1;
			} catch(Exception $e) {
				$transaction->rollBack();
				echo 0;
			}
		}
		else{
			echo 2;
		} 
	}
}