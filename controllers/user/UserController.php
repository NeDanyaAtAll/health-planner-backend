<?php

namespace app\controllers\user;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\modules\user\models\User';
} 