<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserModel extends ActiveRecord
{
    public function rules() {
        return [
            [['name', 'email', 'password', 'surname'], 'required'],
        ];
    }

    public static function tableName() {
        return 'users';
    }

    public function createUser() {
        $this->save(false);
    }

    public function validatePassword($password) {
        return $this->password === md5($password);
    }

    public static function findByEmail($email) {
        if (self::find()->where(['email' => $email])->one()) {
            $result = self::find()->where('email' === $email)->one();
        } else {
            $result = false;
        }
        return $result;
    }
}