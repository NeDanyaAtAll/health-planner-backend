<?php

use yii\db\Migration;

/**
 * Class m240606_084040_craete_user_table
 */
class m240606_084040_craete_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('User', [
            'user_id' => $this->primaryKey(),
            'email' => $this->text(),
            'hashed_password' => $this->text(),
            'name' => $this->text(),
            'date_of_birth' => $this->date(),
            'preferences' => $this->json()
        ]);

        $this->createIndex('idx-User-user_id', 'User', 'user_id');
        $this->createIndex('idx-User-name', 'User', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240606_084040_craete_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240606_084040_craete_user_table cannot be reverted.\n";

        return false;
    }
    */
}
