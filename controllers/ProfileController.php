<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use app\extend\AbstractController;
use yii\filters\Cors;

class ProfileController extends AbstractController
{

    public $modelClass = 'app/models/ProfileModel';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::className(),
        ];
        
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionGetUser() {
        print_r(\Yii::$app->request->headers);die;
    }

}