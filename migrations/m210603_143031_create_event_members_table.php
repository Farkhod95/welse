<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_members}}`.
 */
class m210603_143031_create_event_members_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_members}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->comment("event_id"),
            'user_id' => $this->integer()->comment("user_id"),
            'is_organizer' => $this->boolean()->comment("is_organizer"),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-event_members-event_id}}',
            '{{%event_members}}',
            'event_id'
        );

        // add foreign key for table `{{%events}}`
        $this->addForeignKey(
            '{{%fk-event_members-event_id}}',
            '{{%event_members}}',
            'event_id',
            '{{%events}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-event_members-user_id}}',
            '{{%event_members}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-event_members-user_id}}',
            '{{%event_members}}',
            'user_id',
            '{{%users}}',
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
            '{{%fk-event_members-event_id}}',
            '{{%event_members}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-event_members-event_id}}',
            '{{%event_members}}'
        );

         // drops foreign key for table `{{%users}}`
         $this->dropForeignKey(
            '{{%fk-event_members-user_id}}',
            '{{%event_members}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-event_members-user_id}}',
            '{{%event_members}}'
        );

        $this->dropTable('{{%event_members}}');
    }
}
