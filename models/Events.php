<?php

namespace app\models;
use app\modules\countries\models\Countries;
use app\modules\regions\models\Regions;
use app\modules\regions\models\Districts;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "_table_of_events".
 *
 * @property int $id
 * @property int|null $author_id author_id
 * @property int|null $country_id countries
 * @property int|null $region_id region
 * @property int|null $district_id district
 * @property string|null $title title
 * @property string|null $description description
 * @property int|null $members_count members_count
 * @property int|null $members_count_limit members_count_limit
 * @property string|null $address address
 * @property string|null $started_date started_date
 * @property string|null $finished_time finished_time
 * @property string|null $url url
 * @property string|null $location_x location_x
 * @property string|null $location_y location_y
 * @property int|null $created_at created_at
 * @property int|null $updated_at updated_at
 * @property int|null $status status
 *
 * @property EventCategoriesRelation[] $eventCategoriesRelations
 * @property EventMembers[] $eventMembers
 * @property Users $author
 * @property Countries $country
 * @property Districts $district
 * @property Regions $region
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%events}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'category_id', 'country_id', 'region_id', 'district_id', 'members_count', 'members_count_limit', 'status'], 'integer'],
            [['description', 'address'], 'string'],
            [['started_date', 'finished_time', 'created_at', 'updated_at'], 'safe'],
            [['title', 'url', 'location_x', 'location_y'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['title', 'status'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Автор',
            'category_id' => 'Category ID',
            'country_id' => 'Страна',
            'region_id' => 'Область',
            'district_id' => 'Район',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'members_count' => 'Количество участников',
            'members_count_limit' => 'Предел количества участников',
            'address' => 'Адрес',
            'started_date' => 'Дата начала',
            'finished_time' => 'Время окончания',
            'url' => 'Url',
            'location_x' => 'Расположение X',
            'location_y' => 'Расположение Y',
            'created_at' => 'Созданный',
            'updated_at' => 'Обновлено',
            'status' => 'Статус',
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
        return $this->hasMany(EventCategoriesRelation::className(), ['event_id' => 'id']);
    }

    /**
     * Gets query for [[EventMembers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventMembers()
    {
        return $this->hasMany(EventMembers::className(), ['event_id' => 'id']);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Users::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }
    public function getCategory()
    {
        return $this->hasOne(EventCategories::className(), ['id' => 'category_id']);
    }
    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
    }
    public function getDistricts($id)
    {
        return ArrayHelper::map(Districts::find()->where(['region_id' => $id])->all(), 'id', 'name');
    }
    public function getRegions($id)
    {
        return ArrayHelper::map(Regions::find()->where(['country_id' => $id])->all(), 'id', 'name');
    }
    public function getCountries()
    {
        return ArrayHelper::map(Countries::find()->all(), 'id', 'name');
    }
    public function getStatus()
    {
        return ArrayHelper::map([
            ['id' => '1', 'status' => Yii::t('app', 'Черновик'),],
            ['id' => '2', 'status' => Yii::t('app', 'Опубликовано'),],
            ['id' => '3', 'status' => Yii::t('app', 'Архивировано'),],
            ['id' => '4', 'status' => Yii::t('app', 'Удалено'),],
        ],
        'id', 'status');
    }
    public function getStatusView($id)
    {
        if($id == 1) return 'Черновик';
        if($id == 2) return 'Опубликовано';
        if($id == 3) return 'Архивировано';
        if($id == 4) return 'Удалено';
    }
    public function getAuthors()
    {
        $userRoles = UserRoles::find()->Where(['role_id' => 5])->all();
        $userArray = [];
        foreach ($userRoles as $userRole){
            $userArray  [] = $userRole->user_id;
        }
        return ArrayHelper::map(Users::find()->where(['id'=>$userArray])->all(), 'id', 'fio');
    }
}
