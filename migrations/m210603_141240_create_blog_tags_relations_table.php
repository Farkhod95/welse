<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_tags_relations}}`.
 */
class m210603_141240_create_blog_tags_relations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_tags_relations}}', [
            'id' => $this->primaryKey(),
            'blog_id' => $this->integer()->comment("blog_id"),
            'blog_tag_id' => $this->integer()->comment("blog_tag_id"),
        ]);

        // creates index for column `blog_id`
        $this->createIndex(
            '{{%idx-blog_tags_relations-blog_id}}',
            '{{%blog_tags_relations}}',
            'blog_id'
        );

        // add foreign key for table `{{%blogs}}`
        $this->addForeignKey(
            '{{%fk-blog_tags_relations-blog_id}}',
            '{{%blog_tags_relations}}',
            'blog_id',
            '{{%blogs}}',
            'id',
            'CASCADE'
        );

        // creates index for column `blog_tag_id`
        $this->createIndex(
            '{{%idx-blog_tags_relations-blog_tag_id}}',
            '{{%blog_tags_relations}}',
            'blog_tag_id'
        );

        // add foreign key for table `{{%blog_tags}}`
        $this->addForeignKey(
            '{{%fk-blog_tags_relations-blog_tag_id}}',
            '{{%blog_tags_relations}}',
            'blog_tag_id',
            '{{%blog_tags}}',
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
            '{{%fk-blog_tags_relations-blog_id}}',
            '{{%blog_tags_relations}}'
        );

        // drops index for column `blog_id`
        $this->dropIndex(
            '{{%idx-blog_tags_relations-blog_id}}',
            '{{%blog_tags_relations}}'
        );

         // drops foreign key for table `{{%blog_tags}}`
         $this->dropForeignKey(
            '{{%fk-blog_tags_relations-blog_tag_id}}',
            '{{%blog_tags_relations}}'
        );

        // drops index for column `blog_tag_id`
        $this->dropIndex(
            '{{%idx-blog_tags_relations-blog_tag_id}}',
            '{{%blog_tags_relations}}'
        );

        $this->dropTable('{{%blog_tags_relations}}');
    }
}
