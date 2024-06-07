<?php

namespace app\controllers\healthJournalEntry;

use yii\rest\ActiveController;

class EntryController extends ActiveController
{
    public $modelClass = 'app\modules\healthJournalEntry\models\HealthJournalEntry';
}