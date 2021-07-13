<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blogs}}`.
 */
class m210603_141210_create_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blogs}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->comment("title"),
            'slug' => $this->string(255)->comment("slug"),
            'author_id' => $this->integer()->comment("author_id"),
            'country_id' => $this->integer()->comment("countries"), 
            'region_id' => $this->integer()->comment("region"),  
            'district_id' => $this->integer()->comment("district"),
            'category_id' => $this->integer()->comment("category"),
            'created_at' => $this->datetime()->comment("Последное активность"),
            'updated_at' => $this->datetime()->comment("Последное активность"),
            'published_at' => $this->integer()->comment("published_at"),
            'status' => $this->integer()->comment("status"),
            'viewed' => $this->integer()->comment("viewed"),
        ]);
        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-blogs-author_id}}',
            '{{%blogs}}',
            'author_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-blogs-author_id}}',
            '{{%blogs}}',
            'author_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `country_id`
        $this->createIndex(
            '{{%idx-blogs-country_id}}',
            '{{%blogs}}',
            'country_id'
        );

        // add foreign key for table `{{%countries}}`
        $this->addForeignKey(
            '{{%fk-blogs-country_id}}',
            '{{%blogs}}',
            'country_id',
            '{{%countries}}',
            'id',
            'CASCADE'
        );

        // creates index for column `region_id`
        $this->createIndex(
            '{{%idx-blogs-region_id}}',
            '{{%blogs}}',
            'region_id'
        );

        // add foreign key for table `{{%region}}`
        $this->addForeignKey(
            '{{%fk-blogs-region_id}}',
            '{{%blogs}}',
            'region_id',
            '{{%regions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `district_id`
        $this->createIndex(
            '{{%idx-blogs-district_id}}',
            '{{%blogs}}',
            'district_id'
        );

        // add foreign key for table `{{%district}}`
        $this->addForeignKey(
            '{{%fk-blogs-district_id}}',
            '{{%blogs}}',
            'district_id',
            '{{%districts}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-blogs-category_id}}',
            '{{%blogs}}',
            'category_id'
        );

        // add foreign key for table `{{%blog_categories}}`
        $this->addForeignKey(
            '{{%fk-blogs-category_id}}',
            '{{%blogs}}',
            'category_id',
            '{{%blog_categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%blogs}}`
        $this->dropForeignKey(
            '{{%fk-blogs-author_id}}',
            '{{%blogs}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-blogs-author_id}}',
            '{{%blogs}}'
        );

        // drops foreign key for table `{{%blogs}}`
        $this->dropForeignKey(
            '{{%fk-blogs-country_id}}',
            '{{%blogs}}'
        );

        // drops index for column `country_id`
        $this->dropIndex(
            '{{%idx-blogs-country_id}}',
            '{{%blogs}}'
        );

        // drops foreign key for table `{{%region}}`
        $this->dropForeignKey(
            '{{%fk-blogs-region_id}}',
            '{{%blogs}}'
        );

        // drops index for column `region_id`
        $this->dropIndex(
            '{{%idx-blogs-region_id}}',
            '{{%blogs}}'
        );

        // drops foreign key for table `{{%district}}`
        $this->dropForeignKey(
            '{{%fk-blogs-district_id}}',
            '{{%blogs}}'
        );

        // drops index for column `district_id`
        $this->dropIndex(
            '{{%idx-blogs-district_id}}',
            '{{%blogs}}'
        );

        // drops foreign key for table `{{%blog_categories}}`
        $this->dropForeignKey(
            '{{%fk-blogs-category_id}}',
            '{{%blogs}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-blogs-category_id}}',
            '{{%blogs}}'
        );

        $this->dropTable('{{%blogs}}');
    }
}
