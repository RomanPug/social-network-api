<?php

namespace app\models\forms;

use app\models\UserModel;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    public function rules() {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'string']
        ];
    }

    public function login() {
        if ($this->validate()) {
            $user = new UserModel();

            $user->attributes = $this->attributes;

            return $user->$this->login();
        }
    }
}