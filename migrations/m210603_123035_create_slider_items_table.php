<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%slider_items}}`.
 */
class m210603_123035_create_slider_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slider_items}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->comment("url"),
            'image' => $this->string(255)->comment("image"),
            'slider_id' => $this->integer()->comment("slider_id"),
            'title' => $this->string(255)->comment("title"),
            'description' => $this->text()->comment("description"),
        ]);
        // creates index for column `slider_id`
        $this->createIndex(
            '{{%idx-slider_items-slider_id}}',
            '{{%slider_items}}',
            'slider_id'
        );

        // add foreign key for table `{{%sliders}}`
        $this->addForeignKey(
            '{{%fk-slider_items-slider_id}}',
            '{{%slider_items}}',
            'slider_id',
            '{{%sliders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%sliders}}`
        $this->dropForeignKey(
            '{{%fk-slider_items-slider_id}}',
            '{{%slider_items}}'
        );

        // drops index for column `slider_id`
        $this->dropIndex(
            '{{%idx-slider_items-slider_id}}',
            '{{%slider_items}}'
        );

        $this->dropTable('{{%slider_items}}');
    }
}
