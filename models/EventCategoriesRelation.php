<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_table_of_event_categories_relation".
 *
 * @property int $id
 * @property int|null $event_id event_id
 * @property int|null $event_category_id event_category_id
 *
 * @property EventCategories $eventCategory
 * @property Events $event
 */
class EventCategoriesRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event_categories_relation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'event_category_id'], 'integer'],
            [['event_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventCategories::className(), 'targetAttribute' => ['event_category_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
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
            'event_category_id' => 'Event Category ID',
        ];
    }

    /**
     * Gets query for [[EventCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventCategory()
    {
        return $this->hasOne(EventCategories::className(), ['id' => 'event_category_id']);
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
}
