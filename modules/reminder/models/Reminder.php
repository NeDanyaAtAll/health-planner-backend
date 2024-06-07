<?php

namespace app\modules\reminder\models;

use yii\db\ActiveRecord;
use app\modules\user\models\User;

class Reminder extends ActiveRecord
{
    public static function tableName()
    {
        return 'Reminder';
    }

    public function fields()
    {
        return [
            'reminder_id',
            'user_id',
            'medication_name',
            'dosage',
            'time_to_take',
            'frequency',
            'start_date',
            'end_date',
            'notes'
        ];
    }
    //http://localhost/users?fields=id,email&expand=user
    public function extraFields()
    {
        return ['user'];
    }

    public function rules()
    {
        return [
            [['user_id', 'medication_name', 'dosage', 'time_to_take', 'frequency', 'start_date', 'end_date'], 'required'],
            [['user_id'], 'integer'],
            [['medication_name', 'dosage', 'frequency'], 'string', 'max' => 255],
            [['start_date', 'end_date'], 'date', 'format' => 'php:Y-m-d'],
            [['time_to_take'], 'date', 'format' => 'php:H:i'],
            [['notes'], 'trim'],
            [['notes'], 'string', 'max' => 1000],
            [['frequency'], 'in', 'range' => ['daily', 'weekly', 'monthly', 'as_needed']],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['user_id' => 'user_id']);
    }
}