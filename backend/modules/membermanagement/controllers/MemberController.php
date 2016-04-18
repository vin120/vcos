<?php

namespace app\modules\membermanagement\controllers;
use Yii;
use yii\web\Controller;
use app\modules\membermanagement\models\VcosMember;

class MemberController extends Controller
{
    public function actionIndex()
    {
    	$name = Yii::$app->request->post('Name');
    	$member_code = Yii::$app->request->post('MemberCode');
    	$gender = Yii::$app->request->post('Gender');
    	$status = Yii::$app->request->post('Status');

        $member_infos = VcosMember::GetMemberInfo($name,$member_code,$gender,$status);

        $count = VcosMember::GetMemberCount();
      

        return $this->render('index',['member_infos'=>$member_infos]);
    }
}