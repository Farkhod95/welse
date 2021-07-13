<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_roles}}`.
 */
class m210603_123110_create_user_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_roles}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment("Ид пользователя"),
            'role_id' => $this->integer()->comment("Ид Роль"),
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_roles-user_id}}',
            '{{%user_roles}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-user_roles-user_id}}',
            '{{%user_roles}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `role_id`
        $this->createIndex(
            '{{%idx-user_roles-role_id}}',
            '{{%user_roles}}',
            'role_id'
        );

        // add foreign key for table `{{%roles}}`
        $this->addForeignKey(
            '{{%fk-user_roles-role_id}}',
            '{{%user_roles}}',
            'role_id',
            '{{%roles}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-user_roles-user_id}}',
            '{{%user_roles}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_roles-user_id}}',
            '{{%user_roles}}'
        );

        // drops foreign key for table `{{%roles}}`
        $this->dropForeignKey(
            '{{%fk-user_roles-role_id}}',
            '{{%user_roles}}'
        );

        // drops index for column `role_id`
        $this->dropIndex(
            '{{%idx-user_roles-role_id}}',
            '{{%user_roles}}'
        );
        $this->dropTable('{{%user_roles}}');
    }
}
