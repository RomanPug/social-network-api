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


}