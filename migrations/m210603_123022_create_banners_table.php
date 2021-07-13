<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banners}}`.
 */
class m210603_123022_create_banners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banners}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->comment("url"),
            'image' => $this->string(255)->comment("image"),
            'type' => $this->integer()->comment("type"),
            'title' => $this->string(255)->comment("title"),
            'description' => $this->text()->comment("description"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banners}}');
    }
}
