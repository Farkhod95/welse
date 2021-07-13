<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forum_question_tags}}`.
 */
class m210603_141311_create_forum_question_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forum_question_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("name"),
            'slug' => $this->string(255)->comment("slug"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%forum_question_tags}}');
    }
}
