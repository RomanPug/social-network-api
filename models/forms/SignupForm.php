<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\UserModel;

class SignupForm extends Model
{
    public $email;
    public $password;
    public $name;
    public $surname;
    public $day;
    public $month;
    public $year;
    public $gender;

    public function rules() {
        return [
            [['name', 'email', 'password', 'surname'], 'required'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new UserModel();

            $user->attributes = $this->attributes;

            return $user->createUser();
        }
    }

    public static function findByEmail($email) {
        if (UserModel::find()->where('email' === $email)->one()) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    public function encodePassword($pass) {
        $pass = md5($pass);

        return $pass;
    }
}