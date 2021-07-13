<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "user_roles".
 *
 * @property int $id
 * @property int|null $user_id Ид пользователя
 * @property int|null $role_id Ид Роль
 *
 * @property Roles $role
 * @property Users $user
 */
class UserRoles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_roles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'integer'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'role_id' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
    public function getUsers()
    {
        return ArrayHelper::map(Users::find()->all(), 'id', 'fio');
    }
    public function getRoles()
    {
        return ArrayHelper::map(Roles::find()->all(), 'id', 'name');
    }
}
