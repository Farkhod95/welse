<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "_table_of_forum_questions".
 *
 * @property int $id
 * @property string|null $title title
 * @property string|null $content content
 * @property int|null $updated_at updated_at
 * @property int|null $created_at created_at
 * @property int|null $status status
 * @property int|null $viewed viewed
 * @property int|null $user_id user_id
 *
 * @property ForumQuestionTagsRelation[] $forumQuestionTagsRelations
 * @property Users $user
 * @property ForumQuestionsComments[] $forumQuestionsComments
 * @property ForumQuestionsVotes[] $forumQuestionsVotes
 */
class ForumQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $tags;
    public static function tableName()
    {
        return '{{%forum_questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status', 'viewed', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['title', 'user_id', 'status'], 'required'],
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
            'content' => 'Содержание',
            'updated_at' => 'Обновлено',
            'created_at' => 'Созданный',
            'status' => 'Статус',
            'viewed' => 'Просмотрено',
            'user_id' => 'Пользователь',
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
     * Gets query for [[ForumQuestionTagsRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionTagsRelations()
    {
        return $this->hasMany(ForumQuestionTagsRelation::className(), ['forum_question_id' => 'id']);
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
    /**
     * Gets query for [[ForumQuestionsComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionsComments()
    {
        return $this->hasMany(ForumQuestionsComments::className(), ['forum_question_id' => 'id']);
    }

    /**
     * Gets query for [[ForumQuestionsVotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionsVotes()
    {
        return $this->hasMany(ForumQuestionsVotes::className(), ['forum_question_id' => 'id']);
    }
    public function getStatus()
    {
        return ArrayHelper::map([
            ['id' => '1', 'status' => Yii::t('app', 'Активный'),],
            ['id' => '2', 'status' => Yii::t('app', 'Закрыто'),],
        ],
        'id', 'status');
    }

    public function validateTags($attribute, $params)
    {   
        $res = [];
        $tags = ForumQuestionTags::find()->select('id')->asArray()->all();
        foreach ($tags as $key => $value) {
            $res [] = $value['id'];
        }
        $array = array_diff($this->tags , $res);
        if($array){
            foreach ($array as $key => $value) {
                $model = new ForumQuestionTags();            
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
        $tags = ForumQuestionTags::find()->all();
        return ArrayHelper::map($tags, 'id', 'name');
    }

    public function setPostTags()
    {   
        $blog = ForumQuestionTagsRelation::find()->where(['forum_question_id' => $this->id])->all();
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
        $blog_tags = ForumQuestionTags::find()
                        ->andWhere(['or',
                            ['id' => $idTags],
                            ['name' => $this->tags]
                        ])
                      ->all();
        if($blog_tags)
        {
            foreach ($blog_tags as $key => $value) {
                $tags = new ForumQuestionTagsRelation();
                $tags->forum_question_id = $this->id;
                $tags->forum_question_tag_id = $value->id;
                $tags->save();
            }
        }
    }

    public function getTags()
    {
        $tags = ForumQuestionTagsRelation::find()->where(['forum_question_id' => $this->id])->all();
        $result = [];
        if($tags != null){
            foreach ($tags as $key => $value) {
                $result [] = $value->forum_question_tag_id;
            }
        }
        return $result;
    }
}
