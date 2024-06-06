<?php

namespace app\controllers\reminder;

use yii\rest\ActiveController;

class ReminderController extends ActiveController
{
    public $modelClass = 'app\modules\reminder\models\Reminder';
}