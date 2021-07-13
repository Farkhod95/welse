<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%countries}}`.
 */
class m210603_121239_create_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%countries}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("Наименование"),
            'key' => $this->integer()->comment("Key"),
        ]);
        $this->insert('{{%countries}}',array('id' => '1','name' => 'Uzbekistan','key' => 1001,));
        $this->insert('{{%countries}}',array('id' => '2','name' => 'Turkey','key' => 1002,));
        $this->insert('{{%countries}}',array('id' => '3','name' => 'USA','key' => 1003,));
        $this->insert('{{%countries}}',array('id' => '4','name' => 'Russia','key' => 1004,));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%countries}}');
    }
}
