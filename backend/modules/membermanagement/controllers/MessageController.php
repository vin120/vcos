<?php

namespace app\modules\membermanagement\controllers;

use yii\web\Controller;

class MessageController extends Controller
{
    public function actionSendmessage()
    {
        return $this->render('sendmessage');
    }
    
    public function actionMessagelog()
    {
    	return $this->render('messagelog');
    }
    
    public function actionContacts()
    {
    	return $this->render('contacts');
    }
    
    public function actionPhrasebook()
    {
    	return $this->render('phrasebook');
    }
}