<?php


namespace api\modules\v1\controllers;

use api\modules\v1\models\News;
use yii\rest\ActiveController;

class NewsController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\News';

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'update' => ['POST'],
            'delete' => ['DELETE'],
        ];
    }


}