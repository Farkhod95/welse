<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "_table_of_forum_questions_comments".
 *
 * @property int $id
 * @property int|null $user_id user_id
 * @property int|null $forum_question_id forum_question_id
 * @property int|null $comment_reply_id comment_reply_id
 * @property int|null $created_at created_at
 * @property string|null $content content
 * @property int|null $is_edited is_edited
 *
 * @property ForumQuestionsComments $commentReply
 * @property ForumQuestionsComments[] $forumQuestionsComments
 * @property ForumQuestions $forumQuestion
 * @property Users $user
 * @property ForumQuestionsVotes[] $forumQuestionsVotes
 */
class ForumQuestionsComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%forum_questions_comments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'forum_question_id', 'comment_reply_id', 'is_edited'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['content'], 'string'],
            [['comment_reply_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestionsComments::className(), 'targetAttribute' => ['comment_reply_id' => 'id']],
            [['forum_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestions::className(), 'targetAttribute' => ['forum_question_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_id',], 'required'],
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
            'forum_question_id' => 'Вопрос на форуме',
            'comment_reply_id' => 'Комментарий Ответ',
            'updated_at' => 'Обновлено',
            'created_at' => 'Созданный',
            'content' => 'Содержание',
            'is_edited' => 'Редактируется',
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
     * Gets query for [[CommentReply]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentReply()
    {
        return $this->hasOne(ForumQuestionsComments::className(), ['id' => 'comment_reply_id']);
    }

    /**
     * Gets query for [[ForumQuestionsComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionsComments()
    {
        return $this->hasMany(ForumQuestionsComments::className(), ['comment_reply_id' => 'id']);
    }
    public function getForumQuestionsComment()
    {
        return ArrayHelper::map(ForumQuestionsComments::find()->all(), 'id', 'id');
    }

    /**
     * Gets query for [[ForumQuestion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestion()
    {
        return $this->hasOne(ForumQuestions::className(), ['id' => 'forum_question_id']);
    }
    public function getForum()
    {
        return ArrayHelper::map(ForumQuestions::find()->all(), 'id', 'title');
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
     * Gets query for [[ForumQuestionsVotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionsVotes()
    {
        return $this->hasMany(ForumQuestionsVotes::className(), ['forum_questions_comments_id' => 'id']);
    }
}
