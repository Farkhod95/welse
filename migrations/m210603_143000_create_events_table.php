<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m210603_143000_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->comment("author_id"),
            'country_id' => $this->integer()->comment("countries"), 
            'region_id' => $this->integer()->comment("region"),  
            'district_id' => $this->integer()->comment("district"),
            'title' => $this->string(255)->comment("title"),
            'description' => $this->text()->comment("description"),
            'members_count' => $this->integer()->comment("members_count"),
            'members_count_limit' => $this->integer()->comment("members_count_limit"),
            'address' => $this->text()->comment("address"),
            'started_date' => $this->datetime()->comment("started_date"),
            'finished_time' => $this->datetime()->comment("finished_time"),
            'url' => $this->string(255)->comment("url"),
            'location_x' => $this->string(255)->comment("location_x"),
            'location_y' => $this->string(255)->comment("location_y"),
            'created_at' => $this->datetime()->comment("Последное активность"),
            'updated_at' => $this->datetime()->comment("Последное активность"),
            'status' => $this->integer()->comment("status"),
            'category_id' => $this->integer()->comment("category_id"),
        ]);
        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-events-category_id}}',
            '{{%events}}',
            'category_id'
        );

        // add foreign key for table `{{%event_categories}}`
        $this->addForeignKey(
            '{{%fk-events-category_id}}',
            '{{%events}}',
            'category_id',
            '{{%event_categories}}',
            'id',
            'CASCADE'
        );

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-events-author_id}}',
            '{{%events}}',
            'author_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-events-author_id}}',
            '{{%events}}',
            'author_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `country_id`
        $this->createIndex(
            '{{%idx-events-country_id}}',
            '{{%events}}',
            'country_id'
        );

        // add foreign key for table `{{%countries}}`
        $this->addForeignKey(
            '{{%fk-events-country_id}}',
            '{{%events}}',
            'country_id',
            '{{%countries}}',
            'id',
            'CASCADE'
        );

        // creates index for column `region_id`
        $this->createIndex(
            '{{%idx-events-region_id}}',
            '{{%events}}',
            'region_id'
        );

        // add foreign key for table `{{%region}}`
        $this->addForeignKey(
            '{{%fk-events-region_id}}',
            '{{%events}}',
            'region_id',
            '{{%regions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `district_id`
        $this->createIndex(
            '{{%idx-events-district_id}}',
            '{{%events}}',
            'district_id'
        );

        // add foreign key for table `{{%district}}`
        $this->addForeignKey(
            '{{%fk-events-district_id}}',
            '{{%events}}',
            'district_id',
            '{{%districts}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%event_categories}}`
        $this->dropForeignKey(
            '{{%fk-events-category_id}}',
            '{{%events}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-events-category_id}}',
            '{{%events}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-events-author_id}}',
            '{{%events}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-events-author_id}}',
            '{{%events}}'
        );

        // drops foreign key for table `{{%events}}`
        $this->dropForeignKey(
            '{{%fk-events-country_id}}',
            '{{%events}}'
        );

        // drops index for column `country_id`
        $this->dropIndex(
            '{{%idx-events-country_id}}',
            '{{%events}}'
        );

        // drops foreign key for table `{{%region}}`
        $this->dropForeignKey(
            '{{%fk-events-region_id}}',
            '{{%events}}'
        );

        // drops index for column `region_id`
        $this->dropIndex(
            '{{%idx-events-region_id}}',
            '{{%events}}'
        );

        // drops foreign key for table `{{%district}}`
        $this->dropForeignKey(
            '{{%fk-events-district_id}}',
            '{{%events}}'
        );

        // drops index for column `district_id`
        $this->dropIndex(
            '{{%idx-events-district_id}}',
            '{{%events}}'
        );

        $this->dropTable('{{%events}}');
    }
}
