<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%langs}}`
 * - `{{%source_message}}`
 */
class m210112_041923_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'translation' => $this->text()->comment("Перевод"),
            'lang_id' => $this->integer()->comment("Язык"),
            'source_message_id' => $this->integer()->comment("Ключевая слова"),
        ]);

        // creates index for column `lang_id`
        $this->createIndex(
            '{{%idx-message-lang_id}}',
            '{{%message}}',
            'lang_id'
        );

        // add foreign key for table `{{%langs}}`
        $this->addForeignKey(
            '{{%fk-message-lang_id}}',
            '{{%message}}',
            'lang_id',
            '{{%langs}}',
            'id',
            'CASCADE'
        );

        // creates index for column `source_message_id`
        $this->createIndex(
            '{{%idx-message-source_message_id}}',
            '{{%message}}',
            'source_message_id'
        );

        // add foreign key for table `{{%source_message}}`
        $this->addForeignKey(
            '{{%fk-message-source_message_id}}',
            '{{%message}}',
            'source_message_id',
            '{{%source_message}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%langs}}`
        $this->dropForeignKey(
            '{{%fk-message-lang_id}}',
            '{{%message}}'
        );

        // drops index for column `lang_id`
        $this->dropIndex(
            '{{%idx-message-lang_id}}',
            '{{%message}}'
        );

        // drops foreign key for table `{{%source_message}}`
        $this->dropForeignKey(
            '{{%fk-message-source_message_id}}',
            '{{%message}}'
        );

        // drops index for column `source_message_id`
        $this->dropIndex(
            '{{%idx-message-source_message_id}}',
            '{{%message}}'
        );

        $this->dropTable('{{%message}}');
    }
}
