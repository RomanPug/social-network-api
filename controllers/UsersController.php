<?php

namespace app\controllers;

use Yii;
use app\extend\AbstractController;
use app\models\forms\SignupForm;

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
//            $user->generateAuthKey();
            $user->signup();
//            $token = $this->genegateToken($user->id);
            $result =   [
                'success' => 1,
                'email' =>  $user->email,
                'code' => 'user_is_register'
            ];
        }
        return $result;

    }

    public function actionLoginUser() {
        return Yii::$app->request->post();
    }
}