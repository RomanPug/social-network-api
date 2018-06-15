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
            $token->user_id = $this->getUser()->id;
            $token->generateToken(time() + 3600 * 24 * 30);
            return $token->save() ? $token : null;
        } else {
            return null;
        }
    }



    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UserModel::findByEmail($this->email);
        }

        return $this->_user;
    }
}