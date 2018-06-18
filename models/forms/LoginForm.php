<?php

namespace app\models\forms;

use app\models\TokenModel;
use app\models\UserModel;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    private $_user = false;

    public function rules() {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'string'],
            ['password', 'validatePassword']
        ];
    }

    public function login() {
        if ($this->validate()) {
            $token = new TokenModel();
            $this->getUser() ? $token->user_id = $this->getUser()->id : $token->user_id = 'user_not_found';
            $token->generateToken();
            $result = $token ? $token : null;
        } else {
            $result = null;
        }

        return $result;
    }

    public function validatePassword() {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->password = 'password_incorrect';
            } else {
                $this->password = 'password_correct';
            }
        }
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = UserModel::findByEmail($this->email);
        }

        return $this->_user;
    }
}