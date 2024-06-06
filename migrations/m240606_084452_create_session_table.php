<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m240606_084452_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Session}}', [
            'session_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'login_time' => $this->dateTime(),
            'logout_time' => $this->dateTime(),
            'device_info' => $this->text(),
            'session_token' => $this->text()
        ]);

        $this->addForeignKey('fk-Session-user_id', 'Session', 'user_id', 'User', 'user_id', 'CASCADE');

        $this->createIndex('idx-Session-session_id', 'Session', 'session_id');
        $this->createIndex('idx-Session-session_token', 'Session', 'session_token');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
