<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sliders}}`.
 */
class m210603_123025_create_sliders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sliders}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->comment("url"),
            'image' => $this->string(255)->comment("image"),
            'status' => $this->boolean()->comment("status"),
            'title' => $this->string(255)->comment("title"),
            'description' => $this->text()->comment("description"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sliders}}');
    }
}
