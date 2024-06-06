<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reminder}}`.
 */
class m240606_084703_create_reminder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Reminder}}', [
            'reminder_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'medication_name' => $this->text(),
            'dosage' => $this->text(),
            'time_to_take' => $this->time(),
            'frequency' => $this->text(),
            'start_date' => $this->date(),
            'end_date' => $this->date(),
            'notes' => $this->text()
        ]);

        $this->addForeignKey('fk-Reminder-user_id', 'Reminder', 'user_id', 'User', 'user_id', 'CASCADE');

        $this->createIndex('idx-Reminder-reminder_id', 'Reminder', 'reminder_id');
        $this->createIndex('idx-Reminder-medication_name', 'Reminder', 'medication_name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reminder}}');
    }
}
