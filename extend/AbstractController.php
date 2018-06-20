<?php

namespace app\extend;

use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\Response;

abstract class AbstractController extends ActiveController
{

    public $enableCsrfValidation = false;

    public function behaviors() {
        $behaviors = parent::behaviors();
        \Yii::$app->response->headers->set('Access-Control-Allow-Origin', '*');
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ]
        ];
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Access-Control-Request-Headers' => ['Origin', 'Content-Type', 'Accept', 'Authorization'],
                'Access-Control-Request-Method' => ['POST, GET'],
                'Access-Control-Allow-Credentials' => null,
            ]
        ];

        return $behaviors;
    }
}