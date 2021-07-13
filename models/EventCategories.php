<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "_table_of_event_categories".
 *
 * @property int $id
 * @property string|null $slug slug
 * @property int|null $status status
 * @property int|null $created_at created_at
 *
 * @property EventCategoriesRelation[] $eventCategoriesRelations
 */
class EventCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event_categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status',], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['name', 'slug', 'status'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'Слуг',
            'status' => 'Статус',
            'created_at' => 'Созданный',
            'updated_at' => 'Обновленный',
        ];
    }
    public function beforeSave($insert)
    {
        if($this->updated_at != null ) $this->updated_at = \Yii::$app->formatter->asDate($this->updated_at, 'php:Y-m-d');
        if ($this->isNewRecord)
        {
            if($this->created_at != null ) $this->created_at = \Yii::$app->formatter->asDate($this->created_at, 'php:Y-m-d');
        }
        return parent::beforeSave($insert);
    }
    /**
     * Gets query for [[EventCategoriesRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventCategoriesRelations()
    {
        return $this->hasMany(EventCategoriesRelation::className(), ['event_category_id' => 'id']);
    }
    public function getStatus()
    {
        return ArrayHelper::map([
            ['id' => '1', 'status' => 'Актив',],
            ['id' => '2', 'status' => 'Не Актив',],
        ],
        'id', 'status');
    }

    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['category_id' => 'id']);
    }
}
