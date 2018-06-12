<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.02.18
 * Time: 16:47
 */

namespace app\models;


use yii\db\ActiveRecord;

class TestDataModel extends ActiveRecord
{
    public static function tableName() {
        return 'test_table';
    }

    public function getData() {
        return $this::find()->all();
    }
}