<?php

use yii\db\Migration;

/**
 * Class m210603_143044_add_some_data_for_testing
 */
class m210603_143044_add_some_data_for_testing extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Faker\Factory::create();
        //add some data to {{%users}
        $this->insert('{{%users}}',[
            'username' => 'welse',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'fio' => 'Admin Welse',
            'email' => 'admin@gmail.com',
            'phone' => '',
            'birthday' => '',
            'status' => 1,
        ]);

        $this->insert('{{%users}}',[
            'username' => 'welse2',
            'password' => Yii::$app->security->generatePasswordHash('admin2'),
            'fio' => 'Murodova Dilbar',
            'email' => 'admin@gmail.com',
            'phone' => '',
            'birthday' => '',
            'status' => 1,
        ]);


        $this->insert('{{%users}}',[
            'username' => 'welse3',
            'password' => Yii::$app->security->generatePasswordHash('admin3'),
            'fio' => 'Jumayev Ilhom',
            'email' => 'admin@gmail.com',
            'phone' => '',
            'birthday' => '',
            'status' => 1,
        ]);


        $this->insert('{{%users}}',[
            'username' => 'welse4',
            'password' => Yii::$app->security->generatePasswordHash('admin4'),
            'fio' => 'Murodov Ulug\'bek',
            'email' => 'admin@gmail.com',
            'phone' => '',
            'birthday' => '',
            'status' => 1,
        ]);

        $this->insert('{{%users}}',[
            'username' => 'welse5',
            'password' => Yii::$app->security->generatePasswordHash('admin5'),
            'fio' => 'Jo\'rayev Umar',
            'email' => 'admin@gmail.com',
            'phone' => '',
            'birthday' => '',
            'status' => 1,
        ]);
        //add some data to {{%user_roles}
        $this->insert('{{%user_roles}}',['user_id' => 1, 'role_id' => 1,]);
        $this->insert('{{%user_roles}}',['user_id' => 2, 'role_id' => 2,]);
        $this->insert('{{%user_roles}}',['user_id' => 3, 'role_id' => 3,]);
        $this->insert('{{%user_roles}}',['user_id' => 4, 'role_id' => 4,]);
        $this->insert('{{%user_roles}}',['user_id' => 5, 'role_id' => 5,]);

    }

    /**
     * {@inheritdoc}-
     */
    public function safeDown()
    {
        return true;
    }
}
