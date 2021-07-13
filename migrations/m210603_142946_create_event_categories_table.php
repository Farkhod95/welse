<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_categories}}`.
 */
class m210603_142946_create_event_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("name"),
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
        $this->dropTable('{{%event_categories}}');
    }
}
