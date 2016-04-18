<?php

namespace app\modules\membermanagement\controllers;

use yii\web\Controller;

class PointController extends Controller
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