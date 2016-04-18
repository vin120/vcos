<?php

namespace app\modules\membermanagement\controllers;

use yii\web\Controller;

class RefundController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}