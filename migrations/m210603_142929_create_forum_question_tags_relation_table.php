<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forum_question_tags_relation}}`.
 */
class m210603_142929_create_forum_question_tags_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forum_question_tags_relation}}', [
            'id' => $this->primaryKey(),
            'forum_question_id' => $this->integer()->comment("forum_question_id"),
            'forum_question_tag_id' => $this->integer()->comment("forum_question_tag_id"),
        ]);

        // creates index for column `forum_question_id`
        $this->createIndex(
            '{{%idx-forum_question_tags_relation-forum_question_id}}',
            '{{%forum_question_tags_relation}}',
            'forum_question_id'
        );

        // add foreign key for table `{{%forum_questions}}`
        $this->addForeignKey(
            '{{%fk-forum_question_tags_relation-forum_question_id}}',
            '{{%forum_question_tags_relation}}',
            'forum_question_id',
            '{{%forum_questions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `forum_question_tag_id`
        $this->createIndex(
            '{{%idx-forum_question_tags_relation-forum_question_tag_id}}',
            '{{%forum_question_tags_relation}}',
            'forum_question_tag_id'
        );

        // add foreign key for table `{{%forum_question_tags}}`
        $this->addForeignKey(
            '{{%fk-forum_question_tags_relation-forum_question_tag_id}}',
            '{{%forum_question_tags_relation}}',
            'forum_question_tag_id',
            '{{%forum_question_tags}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%forum_questions}}`
        $this->dropForeignKey(
            '{{%fk-forum_question_tags_relation-forum_question_id}}',
            '{{%forum_question_tags_relation}}'
        );

        // drops index for column `forum_question_id`
        $this->dropIndex(
            '{{%idx-forum_question_tags_relation-forum_question_id}}',
            '{{%forum_question_tags_relation}}'
        );

        // drops foreign key for table `{{%forum_question_tags}}`
        $this->dropForeignKey(
            '{{%fk-forum_question_tags_relation-forum_question_tag_id}}',
            '{{%forum_question_tags_relation}}'
        );

        // drops index for column `forum_question_tag_id`
        $this->dropIndex(
            '{{%idx-forum_question_tags_relation-forum_question_tag_id}}',
            '{{%forum_question_tags_relation}}'
        );

        $this->dropTable('{{%forum_question_tags_relation}}');
    }
}
