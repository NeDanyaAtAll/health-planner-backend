<?php

namespace app\modules\reminder\repos;

use app\modules\reminder\models\Reminder;

interface IReminderRepo
{
    public function create(array $data): Reminder;
}

class ReminderRepo implements IReminderRepo
{
    public function create(array $data): Reminder
    {
        $data['user_id'] = \Yii::$app->user->id;
        $reminder = new Reminder();
        $reminder->load($data);
        $reminder->save(false);
        return $reminder;
    }
}