<?php

namespace app\controllers\base;

use Yii;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass;

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        return $this->modelClass::findAll(['user_id' => 16]);
    }
}