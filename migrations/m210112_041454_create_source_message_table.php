<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%source_message}}`.
 */
class m210112_041454_create_source_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%source_message}}', [
            'id' => $this->primaryKey(),
            'keyword' => $this->string(255)->comment("Наименование"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%source_message}}');
    }
}
