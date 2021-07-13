<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%regions}}`
 * - `{{%districts}}`
 */
class m210603_123100_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(255)->comment("fio"),
            'username' => $this->string(255)->comment("username"),
            'auth_key' => $this->string(255)->comment("auth_key"),
            'password' => $this->string(255)->comment("password_hash"),
            'password_reset_token' => $this->string(255)->comment("password_reset_token"),
            'email' => $this->string(255)->comment("email"),
            'email_verification_key' => $this->string(255)->comment("email_verification_key"),
            'status' => $this->integer()->comment("Статус пользователя"),
            'created_at' => $this->datetime()->comment("Последное активность"),
            'updated_at' => $this->datetime()->comment("Последное активность"),
            'selected_langauge' => $this->string(255)->comment("selected_langauge"),
            'country_id' => $this->integer()->comment("countries"), 
            'region_id' => $this->integer()->comment("region"),  
            'district_id' => $this->integer()->comment("district"),
            'phone' => $this->string(255)->comment("Телефон номер"),
            'last_seen' => $this->datetime()->comment("Последное активность"),
            'birthday' => $this->date()->comment("Дата рождение"),
            'avatar' => $this->string(255)->comment("Аватар"),
        ]);

        // creates index for column `country_id`
        $this->createIndex(
            '{{%idx-users-country_id}}',
            '{{%users}}',
            'country_id'
        );

        // add foreign key for table `{{%countries}}`
        $this->addForeignKey(
            '{{%fk-users-country_id}}',
            '{{%users}}',
            'country_id',
            '{{%countries}}',
            'id',
            'CASCADE'
        );

        // creates index for column `region_id`
        $this->createIndex(
            '{{%idx-users-region_id}}',
            '{{%users}}',
            'region_id'
        );

        // add foreign key for table `{{%region}}`
        $this->addForeignKey(
            '{{%fk-users-region_id}}',
            '{{%users}}',
            'region_id',
            '{{%regions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `district_id`
        $this->createIndex(
            '{{%idx-users-district_id}}',
            '{{%users}}',
            'district_id'
        );

        // add foreign key for table `{{%district}}`
        $this->addForeignKey(
            '{{%fk-users-district_id}}',
            '{{%users}}',
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

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-users-country_id}}',
            '{{%users}}'
        );

        // drops index for column `country_id`
        $this->dropIndex(
            '{{%idx-users-country_id}}',
            '{{%users}}'
        );

        // drops foreign key for table `{{%region}}`
        $this->dropForeignKey(
            '{{%fk-users-region_id}}',
            '{{%users}}'
        );

        // drops index for column `region_id`
        $this->dropIndex(
            '{{%idx-users-region_id}}',
            '{{%users}}'
        );

        // drops foreign key for table `{{%district}}`
        $this->dropForeignKey(
            '{{%fk-users-district_id}}',
            '{{%users}}'
        );

        // drops index for column `district_id`
        $this->dropIndex(
            '{{%idx-users-district_id}}',
            '{{%users}}'
        );

        $this->dropTable('{{%users}}');
    }
}
