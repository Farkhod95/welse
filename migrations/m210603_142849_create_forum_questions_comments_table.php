<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forum_questions_comments}}`.
 */
class m210603_142849_create_forum_questions_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forum_questions_comments}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment("user_id"),
            'forum_question_id' => $this->integer()->comment("forum_question_id"),
            'comment_reply_id' => $this->integer()->comment("comment_reply_id"),
            'created_at' => $this->datetime()->comment("Последное активность"),
            'updated_at' => $this->datetime()->comment("Последное активность"),
            'content' => $this->text()->comment("content"),
            'is_edited' => $this->boolean()->comment("is_edited"),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-forum_questions_comments-user_id}}',
            '{{%forum_questions_comments}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-forum_questions_comments-user_id}}',
            '{{%forum_questions_comments}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `forum_question_id`
        $this->createIndex(
            '{{%idx-forum_questions_comments-forum_question_id}}',
            '{{%forum_questions_comments}}',
            'forum_question_id'
        );

        // add foreign key for table `{{%forum_questions}}`
        $this->addForeignKey(
            '{{%fk-forum_questions_comments-forum_question_id}}',
            '{{%forum_questions_comments}}',
            'forum_question_id',
            '{{%forum_questions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `comment_reply_id`
        $this->createIndex(
            '{{%idx-forum_questions_comments-comment_reply_id}}',
            '{{%forum_questions_comments}}',
            'comment_reply_id'
        );

        // add foreign key for table `{{%forum_questions_comments}}`
        $this->addForeignKey(
            '{{%fk-forum_questions_comments-comment_reply_id}}',
            '{{%forum_questions_comments}}',
            'comment_reply_id',
            '{{%forum_questions_comments}}',
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
            '{{%fk-forum_questions_comments-user_id}}',
            '{{%forum_questions_comments}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-forum_questions_comments-user_id}}',
            '{{%forum_questions_comments}}'
        );

        // drops foreign key for table `{{%forum_questions}}`
        $this->dropForeignKey(
            '{{%fk-forum_questions_comments-forum_question_id}}',
            '{{%forum_questions_comments}}'
        );

        // drops index for column `forum_question_id`
        $this->dropIndex(
            '{{%idx-forum_questions_comments-forum_question_id}}',
            '{{%forum_questions_comments}}'
        );

        // drops foreign key for table `{{%forum_questions_comments}}`
        $this->dropForeignKey(
            '{{%fk-forum_questions_comments-comment_reply_id}}',
            '{{%forum_questions_comments}}'
        );

        // drops index for column `comment_reply_id`
        $this->dropIndex(
            '{{%idx-forum_questions_comments-comment_reply_id}}',
            '{{%forum_questions_comments}}'
        );

        $this->dropTable('{{%forum_questions_comments}}');
    }
}
