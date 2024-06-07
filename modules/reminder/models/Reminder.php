<?php

namespace app\modules\reminder\models;

use yii\db\ActiveRecord;
use app\modules\user\models\User;
use Yii;
use yii\web\HttpException;

class Reminder extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if($insert && !Yii::$app->user) {
            throw new HttpException(404, 'Остутствует текущий пользователь');
        }
        $this->user_id = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }

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
            [['user_id', 'medication_name'], 'safe'],
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