<?php

namespace app\models;
use app\modules\countries\models\Countries;
use app\modules\regions\models\Regions;
use app\modules\regions\models\Districts;
use yii\helpers\ArrayHelper;
use app\modules\translates\models\Langs;
use app\modules\translates\models\Translates;
use Yii;

/**
 * This is the model class for table "_table_of_blogs".
 *
 * @property int $id
 * @property string|null $slug slug
 * @property int|null $author_id author_id
 * @property int|null $country_id countries
 * @property int|null $region_id region
 * @property int|null $district_id district
 * @property int|null $created_at created_at
 * @property int|null $updated_at updated_at
 * @property int|null $published_at published_at
 * @property int|null $status status
 * @property int|null $viewed viewed
 *
 * @property BlogCategoriesRelations[] $blogCategoriesRelations
 * @property BlogTagsRelations[] $blogTagsRelations
 * @property Users $author
 * @property Countries $country
 * @property Districts $district
 * @property Regions $region
 */
class Blogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $tr_title;
    public $tags;
    public static function tableName()
    {
        return '{{%blogs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'category_id', 'country_id', 'region_id', 'district_id', 'published_at', 'status', 'viewed'], 'integer'],
            [['slug', 'title'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['region_id' => 'id']],
            // [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['author_id', 'status'], 'required'],
            [['tr_title'],'safe'],
            [['tr_title'],'validateName'],
            ['tags' , 'validateTags'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'tr_title' => 'Заголовок',
            'slug' => 'Слуг',
            'author_id' => 'Автор',
            'category_id' => 'Категория',
            'country_id' => 'Страна',
            'region_id' => 'Область',
            'district_id' => 'Район',
            'created_at' => 'Созданный',
            'updated_at' => 'Обновлено',
            'published_at' => 'Опубликовано',
            'status' => 'Статус',
            'viewed' => 'Просмотрено',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(BlogCategories::className(), ['id' => 'category_id']);
    }
    public function getCategories()
    {
        return ArrayHelper::map(BlogCategories::find()->all(), 'id', 'name');
    }

    public function validateTags($attribute, $params)
    {   
        $res = [];
        $tags = BlogTags::find()->select('id')->asArray()->all();
        foreach ($tags as $key => $value) {
            $res [] = $value['id'];
        }
        $array = array_diff($this->tags , $res);
        if($array){
            foreach ($array as $key => $value) {
                $model = new BlogTags();            
                $model->name = $value; 
                if ($model->save()){
                }else{
                    $this->addError($attribute,"Не создан новый группа товары");
                    echo "<pre>".print_r($model,true)."</pre>";
                }
            }

        }
    }
    public function getTagsList()
    {
        $tags = BlogTags::find()->all();
        return ArrayHelper::map($tags, 'id', 'name');
    }
    public function setPostTags()
    {   
        $blog = BlogTagsRelations::find()->where(['blog_id' => $this->id])->all();
        if($blog){
            foreach ($blog as $key => $value) {
               $value->delete();
            }
        }

        $idTags = [];
        if($this->tags){
            foreach ($this->tags as $key => $value) {
               if(is_numeric($value)) $idTags [] = $value;
            }
        }
        $blog_tags = BlogTags::find()
                        ->andWhere(['or',
                            ['id' => $idTags],
                            ['name' => $this->tags]
                        ])
                      ->all();
        if($blog_tags)
        {
            foreach ($blog_tags as $key => $value) {
                $tags = new BlogTagsRelations();
                $tags->blog_id = $this->id;
                $tags->blog_tag_id = $value->id;
                $tags->save();
            }
        }
    }
    public function getTags()
    {
        $tags = BlogTagsRelations::find()->where(['blog_id' => $this->id])->all();
        $result = [];
        if($tags != null){
            foreach ($tags as $key => $value) {
                $result [] = $value->blog_tag_id;
            }
        }
        return $result;
    }
    /**
     * Gets query for [[BlogCategoriesRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategoriesRelations()
    {
        return $this->hasMany(BlogCategoriesRelations::className(), ['blog_id' => 'id']);
    }

    /**
     * Gets query for [[BlogTagsRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTagsRelations()
    {
        return $this->hasMany(BlogTagsRelations::className(), ['blog_id' => 'id']);
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
    public function getAuthors()
    {
        $userRoles = UserRoles::find()->Where(['role_id' => 5])->all();
        $userArray = [];
        foreach ($userRoles as $userRole){
            $userArray  [] = $userRole->user_id;
        }
        return ArrayHelper::map(Users::find()->where(['id'=>$userArray])->all(), 'id', 'fio');
    }

    public static function TranslatableFields()
    {
        return [
            'title' => 'tr_title',
        ];
    }

    public function validateName($attr)
    {
        $available_languages = Langs::getLanguages();
        $valid = $this->$attr[Langs::MAIN_LANGUAGE];
        foreach ($available_languages as $available_language){
            $valid = $valid && $this->$attr[$available_language->url];
            if(!$valid){
                $this->addError($attr,Yii::t('app','You should add all translations {attribute} !'));
            }
        }
    }

    public function getTranslate()
    {
        return $this->hasOne(Translates::className(), ['field_id' => 'id'])
            ->where(['table_name'=>self::tableName(),'field_name'=>'title' , 'language_code' =>Yii::$app->language ]);
    }
    public function beforeSave($insert)
    {
        $translatable_fields = self::TranslatableFields();
        //saqlashdan oldin asosiy tilda kiritilgan malumotlar ni asosiy jadvalga yozish
        foreach ($translatable_fields as $key => $translatable_field) {
            $this->$key = $this->$translatable_field[Langs::MAIN_LANGUAGE];
        }
        if($this->updated_at != null ) $this->updated_at = \Yii::$app->formatter->asDate($this->updated_at, 'php:Y-m-d');
        if ($this->isNewRecord)
        {
            if($this->created_at != null ) $this->created_at = \Yii::$app->formatter->asDate($this->created_at, 'php:Y-m-d');
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        // tarjimalarni saqlash
        $this->setTranslates();
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    // asosiy tildan boshqa tilda kiritilgan tarjimalarni saqlash uchun
    public function setTranslates()
    {
        $available_languages = Langs::getLanguages();
        $translatable_fields = self::TranslatableFields();
        $data = [];

        // barcha tarjimalrni massivga yiigb olish
        foreach ($available_languages as $available_language) {
            foreach ($translatable_fields as $key => $translatable_field){
                // asosiy til uchun kiritilgan tarjimalar asosiy jadvalga yoziladi
                // if($available_language->url != Langs::MAIN_LANGUAGE && $this->$translatable_field[$available_language->url]){
                if($this->$translatable_field[$available_language->url]){
                    $data[] = [
                        $this->tableName(),
                        $this->id,
                        $key,
                        $this->$translatable_field[$available_language->url],
                        $available_language->url
                    ];
                }
            }
        }
        if(!empty($data)){
            //barcha tarjimalarni tarjimalar jadvaliga saqlash
            Yii::$app->db
                ->createCommand()
                ->batchInsert('{{%translates}}', [
                    'table_name',
                    'field_id',
                    'field_name',
                    'field_value',
                    'language_code'
                ],$data)
                ->execute();
        }

    }
    public function getTranslates()
    {
        $translatable_fields = self::TranslatableFields();

        // aynan shu model ga tegishli barcha tarjimalarni olish
        $translates = (new \yii\db\Query())
            ->select('field_name,group_concat(field_value) as values,group_concat(language_code) as keys')
            ->from("{{%translates}}")
            ->where([ 'field_id' => $this->id])
            ->groupBy('field_name')
            ->all();

        // tarjimalar jadvalidan tarjimalarni yordamchi massivga yuklab olamiz
        foreach ($translates as $translate) {
            $arr = array_combine(explode(',',$translate['keys']), explode(',',$translate['values']));
            // echo '<pre>';
            // print_r($arr);
            // echo '</pre>';
            $this->{$translatable_fields[$translate['field_name']]} = $arr;
        }

        // asosiy jadvaldagi tarjimalarni yordamchi massivga yuklab olish
        foreach ($translatable_fields as $key => $translatable_field) {
            $this->{$translatable_field}[Langs::MAIN_LANGUAGE] = $this->{$key};
        }

    }
}
