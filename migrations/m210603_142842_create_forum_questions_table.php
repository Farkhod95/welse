<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forum_questions}}`.
 */
class m210603_142842_create_forum_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forum_questions}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->comment("title"),
            'content' => $this->text()->comment("content"),
            'created_at' => $this->datetime()->comment("Последное активность"),
            'updated_at' => $this->datetime()->comment("Последное активность"),
            'status' => $this->integer()->comment("status"),
            'viewed' => $this->integer()->comment("viewed"),
            'user_id' => $this->integer()->comment("user_id"),
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-forum_questions-user_id}}',
            '{{%forum_questions}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-forum_questions-user_id}}',
            '{{%forum_questions}}',
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
            '{{%fk-forum_questions-user_id}}',
            '{{%forum_questions}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-forum_questions-user_id}}',
            '{{%forum_questions}}'
        );

        $this->dropTable('{{%forum_questions}}');
    }
}
