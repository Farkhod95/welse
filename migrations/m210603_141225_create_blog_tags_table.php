<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_tags}}`.
 */
class m210603_141225_create_blog_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_tags}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)->comment("slug"),
            'frequency' => $this->integer()->comment("frequency"),
            'name' => $this->string(255)->comment("name"),
            'searching' => $this->integer()->comment("searching"),
            'meta_title' => $this->string(255)->comment("meta_title"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blog_tags}}');
    }
}
