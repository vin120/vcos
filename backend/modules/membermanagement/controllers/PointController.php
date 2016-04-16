<?php

namespace app\modules\membermanagement\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionPointset()
    {
        return $this->render('pointset');
    }
    
    public function actionExchange()
    {
    	return $this->render('exchange');
    }
}