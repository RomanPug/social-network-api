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
            [['expire_time'], 'safe'],
            [['token'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => UserModel::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    public function getId()
    {
        return $this->hasOne(UserModel::className(), ['id' => 'user_id']);
    }

    public static function find()
    {
        return new TokenQuery(get_called_class());
    }
}