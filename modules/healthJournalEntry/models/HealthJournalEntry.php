<?php

namespace app\modules\healthJournalEntry\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\user\models\User;
/**
 * This is the model class for table "HealthJournalEntry".
 *
 * @property int $entry_id
 * @property int|null $user_id
 * @property string|null $entry_date
 * @property string|null $symptoms
 * @property string|null $condition_description
 * @property string|null $other_notes
 *
 * @property User $user
 */
class HealthJournalEntry extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'HealthJournalEntry';
    }

    public function fields()
    {
        return [
            'entry_id',
            'user_id',
            'entry_date',
            'symptomps',
            'condition+description',
            'other_notes',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['entry_date'], 'safe'],
            [['symptoms', 'condition_description', 'other_notes'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    public function extraFields()
    {
        return ['user'];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['user_id' => 'user_id']);
    }
}
