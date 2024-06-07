<?php

namespace app\controllers\reminder;


use Yii;
use yii\rest\ActiveController;
use app\controllers\base\ApiController;

class ReminderController extends ApiController
{
    public $modelClass = 'app\modules\reminder\models\Reminder';
}