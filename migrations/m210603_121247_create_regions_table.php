<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%regions}}`.
 */
class m210603_121247_create_regions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%regions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment("Наименование"),
            'country_id' => $this->integer()->comment("Countries"),
            'key' => $this->integer()->comment("Key"),
        ]);

        // creates index for column `country_id`
        $this->createIndex(
            '{{%idx-regions-country_id}}',
            '{{%regions}}',
            'country_id'
        );

        // add foreign key for table `{{%countries}}`
        $this->addForeignKey(
            '{{%fk-regions-country_id}}',
            '{{%regions}}',
            'country_id',
            '{{%countries}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%countries}}`
        $this->dropForeignKey(
            '{{%fk-regions-country_id}}',
            '{{%regions}}'
        );

        // drops index for column `region_id`
        $this->dropIndex(
            '{{%idx-regions-country_id}}',
            '{{%regions}}'
        );

        $this->dropTable('{{%regions}}');
    }
}
