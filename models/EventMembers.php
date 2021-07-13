<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "_table_of_event_members".
 *
 * @property int $id
 * @property int|null $event_id event_id
 * @property int|null $user_id user_id
 * @property int|null $is_organizer is_organizer
 *
 * @property Events $event
 * @property Users $user
 */
class EventMembers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event_members}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id', 'is_organizer'], 'integer'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'user_id' => 'Пользователь',
            'is_organizer' => 'Организатор',
        ];
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'event_id']);
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
        $userRoles = UserRoles::find()->Where(['role_id' => 5])->all();
        $userArray = [];
        foreach ($userRoles as $userRole){
            $userArray  [] = $userRole->user_id;
        }
        return ArrayHelper::map(Users::find()->where(['id'=>$userArray])->all(), 'id', 'fio');
    }
}
