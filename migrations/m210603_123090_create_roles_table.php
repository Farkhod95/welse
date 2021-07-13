<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%roles}}`.
 */
class m210603_123090_create_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%roles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("Наименование"),
            'key' => $this->string(255)->comment("Key"),
        ]);
        $this->insert('{{%roles}}',['id' => 1, 'name' => 'Главный админ', 'key' => 'Administrator',]);
        $this->insert('{{%roles}}',['id' => 2, 'name' => 'Модератор', 'key' => 'Moderator',]);
        $this->insert('{{%roles}}',['id' => 3, 'name' => 'Поддержка', 'key' => 'Support',]);
        $this->insert('{{%roles}}',['id' => 4, 'name' => 'Маркетолог', 'key' => 'Marketer',]);
        $this->insert('{{%roles}}',['id' => 5, 'name' => 'Пользователь', 'key' => 'User',]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%roles}}');
    }
}
