<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\UserModel;
use Yii;
use app\models\forms\SignupForm;
use app\extend\AbstractController;
use yii\filters\auth\HttpBearerAuth;

class UsersController extends AbstractController
{
    public $modelClass = 'app/models/UserModel';

    public function actionRegisterUser() {

        $aUserData = Yii::$app->request->post();
        $aUserData['name'] = $aUserData['firstname'];
        $aUserData['surname'] = $aUserData['lastname'];
        unset($aUserData['firstname'], $aUserData['lastname']);

        $user = SignupForm::findByEmail(Yii::$app->request->getBodyParam('email'));
        if ($user) {
            $result =  [
                'success' => 0,
                'code' => 'email_busy'
            ];
        } else {
            $user = new SignupForm();
            $user->name = Yii::$app->request->getBodyParam('firstname');
            $user->surname = Yii::$app->request->getBodyParam('lastname');
            $user->email = Yii::$app->request->getBodyParam('email');
            $user->password = $user->encodePassword(Yii::$app->request->getBodyParam('password'));;
            $user->signup();
            $result =   [
                'success' => 1,
                'email' =>  $user->email,
                'code' => 'user_is_register'
            ];
        }
        return $result;

    }

    public function actionLoginUser() {
        $model = new LoginForm();
        $model->email = Yii::$app->request->getBodyParam('email');
        $model->password = Yii::$app->request->getBodyParam('password');
        if ($token = $model->login()) {
            return [
                'id' => $token->user_id,
                'email' => $model->email,
                'token' => $token->token,
                'token_time' => $token->time,
                'current_time' => time(),
                'password' => $model->password
            ];
        } else return [
            'id' => $token->user_id,
            'email' => $model->email,
            'token' => ''
        ];
    }

    protected function verbs() {
        return [
            'login' => ['post']
        ];
    }

     public function behaviors() {
            $behaviors = parent::behaviors();
            $behaviors['bearerAuth'] = [
                'class' => HttpBearerAuth::className(),
            ];
        return $behaviors;
    }

    public function actionGetUser() {
//        $this->behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className(),
//        ];
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className()
//        ];
        $user = UserModel::findIdentityByAccessToken(Yii::$app->request->getBodyParam('token'));
        return $user;
    }
}