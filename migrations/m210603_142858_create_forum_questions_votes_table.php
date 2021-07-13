<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forum_questions_votes}}`.
 */
class m210603_142858_create_forum_questions_votes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forum_questions_votes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment("user_id"),
            'forum_question_id' => $this->integer()->comment("forum_question_id"),
            'forum_questions_comments_id' => $this->integer()->comment("forum_questions_comments_id"),
            'up' => $this->boolean()->comment("up"),
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-forum_questions_votes-user_id}}',
            '{{%forum_questions_votes}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-forum_questions_votes-user_id}}',
            '{{%forum_questions_votes}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `forum_question_id`
        $this->createIndex(
            '{{%idx-forum_questions_votes-forum_question_id}}',
            '{{%forum_questions_votes}}',
            'forum_question_id'
        );

        // add foreign key for table `{{%forum_questions}}`
        $this->addForeignKey(
            '{{%fk-forum_questions_votes-forum_question_id}}',
            '{{%forum_questions_votes}}',
            'forum_question_id',
            '{{%forum_questions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `forum_questions_comments_id`
        $this->createIndex(
            '{{%idx-forum_questions_votes-forum_questions_comments_id}}',
            '{{%forum_questions_votes}}',
            'forum_questions_comments_id'
        );

        // add foreign key for table `{{%forum_questions}}`
        $this->addForeignKey(
            '{{%fk-forum_questions_votes-forum_questions_comments_id}}',
            '{{%forum_questions_votes}}',
            'forum_questions_comments_id',
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
            '{{%fk-forum_questions_votes-user_id}}',
            '{{%forum_questions_votes}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-forum_questions_votes-user_id}}',
            '{{%forum_questions_votes}}'
        );

        // drops foreign key for table `{{%forum_questions}}`
        $this->dropForeignKey(
            '{{%fk-forum_questions_votes-forum_question_id}}',
            '{{%forum_questions_votes}}'
        );

        // drops index for column `forum_question_id`
        $this->dropIndex(
            '{{%idx-forum_questions_votes-forum_question_id}}',
            '{{%forum_questions_votes}}'
        );

        // drops foreign key for table `{{%forum_questions}}`
        $this->dropForeignKey(
            '{{%fk-forum_questions_votes-forum_questions_comments_id}}',
            '{{%forum_questions_votes}}'
        );

        // drops index for column `forum_questions_comments_id`
        $this->dropIndex(
            '{{%idx-forum_questions_votes-forum_questions_comments_id}}',
            '{{%forum_questions_votes}}'
        );

        $this->dropTable('{{%forum_questions_votes}}');
    }
}
