<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_blogs}}`.
 */
class m210603_141157_create_user_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_blogs}}', [
            'id' => $this->primaryKey(),
            'author_username' => $this->string(255)->comment("author_username"),
            'author_password_hash' => $this->string(255)->comment("author_password_hash"),
            'user_id' => $this->integer()->comment("user_id"),
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_blogs-user_id}}',
            '{{%user_blogs}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-user_blogs-user_id}}',
            '{{%user_blogs}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-user_blogs-user_id}}',
            '{{%user_blogs}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_blogs-user_id}}',
            '{{%user_blogs}}'
        );

        $this->dropTable('{{%user_blogs}}');
    }
}
