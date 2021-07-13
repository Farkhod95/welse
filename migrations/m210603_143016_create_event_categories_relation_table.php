<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_categories_relation}}`.
 */
class m210603_143016_create_event_categories_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_categories_relation}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->comment("event_id"),
            'event_category_id' => $this->integer()->comment("event_category_id"),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-event_categories_relation-event_id}}',
            '{{%event_categories_relation}}',
            'event_id'
        );

        // add foreign key for table `{{%events}}`
        $this->addForeignKey(
            '{{%fk-event_categories_relation-event_id}}',
            '{{%event_categories_relation}}',
            'event_id',
            '{{%events}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_category_id`
        $this->createIndex(
            '{{%idx-event_categories_relation-event_category_id}}',
            '{{%event_categories_relation}}',
            'event_category_id'
        );

        // add foreign key for table `{{%event_categories}}`
        $this->addForeignKey(
            '{{%fk-event_categories_relation-event_category_id}}',
            '{{%event_categories_relation}}',
            'event_category_id',
            '{{%event_categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%events}}`
        $this->dropForeignKey(
            '{{%fk-event_categories_relation-event_id}}',
            '{{%event_categories_relation}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-event_categories_relation-event_id}}',
            '{{%event_categories_relation}}'
        );

         // drops foreign key for table `{{%event_categories}}`
         $this->dropForeignKey(
            '{{%fk-event_categories_relation-event_category_id}}',
            '{{%event_categories_relation}}'
        );

        // drops index for column `event_category_id`
        $this->dropIndex(
            '{{%idx-event_categories_relation-event_category_id}}',
            '{{%event_categories_relation}}'
        );

        $this->dropTable('{{%event_categories_relation}}');
    }
}
