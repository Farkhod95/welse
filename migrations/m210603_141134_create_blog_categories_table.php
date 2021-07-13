<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_categories}}`.
 */
class m210603_141134_create_blog_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("Name"),
            'slug' => $this->string(255)->comment("slug"),
            'status' => $this->integer()->comment("status"),
            'created_at' => $this->datetime()->comment("Последное активность"),
            'updated_at' => $this->datetime()->comment("Последное активность"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blog_categories}}');
    }
}
