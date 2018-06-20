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
            [['time'], 'safe'],
            [['token'], 'string', 'max' => 255],
        ];
    }

    public function generateToken() {
        $token_time = time() + 3600 * 24 * 30;
        $checkUser = $this->findByToken($this->user_id);

        if ($checkUser) {
            if ($checkUser->time < time()) {
                $gToken = $this->generateTokenString();
                \Yii::$app->db->createCommand()->update('tokens', [
                    'token' => $gToken,
                    'time' => $token_time
                ], 'user_id = :user_id', [':user_id' => $this->user_id])->execute();
                $this->token = $gToken;
                $this->time = $token_time;
            } else {
                $this->token = $checkUser->token;
                $this->time = $checkUser->time;
            }
            return $this;
        } else {
            $this->time = $token_time;
            $this->token = $this->generateTokenString();
            return $this->save();
        }
    }

    private function findByToken($user_id) {
        return self::find()->where('user_id' === $user_id)->one();
    }

    private function generateTokenString() {
        return \Yii::$app->security->generateRandomString(20);
    }

    public function getId()
    {
        return $this->hasOne(UserModel::className(), ['id' => 'user_id']);
    }
}