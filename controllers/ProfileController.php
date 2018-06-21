<?php

namespace app\controllers;

use app\models\UserModel;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use app\extend\AbstractController;

class ProfileController extends AbstractController
{

    public $modelClass = 'app/models/ProfileModel';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
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
        return $this->findUser(\Yii::$app->user->identity['id']);
    }

    private function findUser($id) {
        return UserModel::find()->where(['id' => $id])->one();
    }

}