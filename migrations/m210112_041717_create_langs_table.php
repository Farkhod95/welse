<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%langs}}`.
 */
class m210112_041717_create_langs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%langs}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("Наименование"),
            'url' => $this->string(255)->comment("Код языка"),
            'image' => $this->string(255)->comment("Картинка"),
            'status' => $this->integer()->comment("Статус 1- Активно, 0 - Не активно"),
            'default' => $this->boolean()->comment("Default lang      1- по умолчание , 0 - Не по умолчан"),
        ]);
        $this->insert('{{%langs}}',[
            'name' => "O'zbekcha",
            'url' => 'uz',
            'image' => 'uz.png',
            'status' => 1,
            'default' => 1
        ]);

        $this->insert('{{%langs}}',[
            'name' => "Türk",
            'url' => 'tr',
            'image' => 'tr.png',
            'status' => 1,
            'default' => 0
        ]);


        $this->insert('{{%langs}}',[
            'name' => "Русский",
            'url' => 'ru',
            'image' => 'ru.png',
            'status' => 1,
            'default' => 0
        ]);

        $this->insert('{{%langs}}',[
            'name' => "English",
            'url' => 'en',
            'image' => 'ru.png',
            'status' => 1,
            'default' => 0
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%langs}}');
    }
}
