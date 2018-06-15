<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use Yii;
use app\models\forms\SignupForm;
use yii\filters\auth\HttpBearerAuth;
use app\extend\AbstractController;

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
                'token' => $token->token,
                'time' => date(DATE_RFC3339, $token->time),
            ];
        } else return $model;
    }
}