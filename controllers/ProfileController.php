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
        $user = $this->findUser(\Yii::$app->user->identity['id']);
        unset($user['password']);
        unset($user['is_blocked']);
        unset($user['is_deleted']);
        return $user;
    }

    private function findUser($id) {
        return UserModel::find()->where(['id' => $id])->asArray()->one();
    }

    //Положить юзера в локал сторедж  ++++++
    //При каждом запросе проверять юзера в локал сторедж с тем что пришел в ответе от сервера
    //Сделать формат урлов в виде ид123 ++++++
    //Сделать редирект с пустого урла на главную страницу пользователя в случае если он заголинен
    //Сделать логаут пользователя при его неудачной валидации и запретить посещать другие страницы сайта
    //Сделать таблицу под сайдбар в общем виде, то что по дефолту в него выводится
    //
    //
    //
    //
    //Роутинг: по токену достаем юзера, потом
    //
    //
    //

}