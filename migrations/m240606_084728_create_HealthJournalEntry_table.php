<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%HealthJournalEntry}}`.
 */
class m240606_084728_create_HealthJournalEntry_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%HealthJournalEntry}}', [
            'entry_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'entry_date' => $this->date(),
            'symptoms' => $this->text(),
            'condition_description' => $this->text(),
            'other_notes' => $this->text(),
        ]);

        $this->addForeignKey('fk-HealthJournalEntry-user_id', 'HealthJournalEntry', 'user_id', 'User', 'user_id', 'CASCADE');

        $this->createIndex('fk-HealthJournalEntry-entry_id', 'HealthJournalEntry', 'entry_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%HealthJournalEntry}}');
    }
}
