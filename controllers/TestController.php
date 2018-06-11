<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.02.18
 * Time: 16:08
 */

namespace app\controllers;


use app\models\TestDataModel;
use yii\rest\ActiveController;

class TestController extends ActiveController
{

    public function actionGetTestData() {
        $model = new TestDataModel();

        $model = $model->getData();
        return $model;
    }
}