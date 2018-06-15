<?php

namespace app\models;


use yii\db\ActiveRecord;

class TokenModel extends ActiveRecord
{
    public static function tableName() {
        return 'tokens';
    }

    public function rules()
    {
        return [
            [['user_id', 'token'], 'required'],
            [['user_id'], 'integer'],
            [['user_id'], 'unique'],
            [['expire_time'], 'safe'],
            [['token'], 'string', 'max' => 255],
        ];
    }

    public function generateToken($time) {
        $this->time = $time;
        $this->token = \Yii::$app->security->generateRandomString(20);
    }
}