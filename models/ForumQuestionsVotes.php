<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_table_of_forum_questions_votes".
 *
 * @property int $id
 * @property int|null $user_id user_id
 * @property int|null $forum_question_id forum_question_id
 * @property int|null $forum_questions_comments_id forum_questions_comments_id
 * @property int|null $up up
 *
 * @property ForumQuestions $forumQuestion
 * @property ForumQuestionsComments $forumQuestionsComments
 * @property Users $user
 */
class ForumQuestionsVotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%forum_questions_votes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'forum_question_id', 'forum_questions_comments_id', 'up'], 'integer'],
            [['forum_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestions::className(), 'targetAttribute' => ['forum_question_id' => 'id']],
            [['forum_questions_comments_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestionsComments::className(), 'targetAttribute' => ['forum_questions_comments_id' => 'id']],
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
            'user_id' => 'User ID',
            'forum_question_id' => 'Forum Question ID',
            'forum_questions_comments_id' => 'Forum Questions Comments ID',
            'up' => 'Up',
        ];
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

    /**
     * Gets query for [[ForumQuestionsComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionsComments()
    {
        return $this->hasOne(ForumQuestionsComments::className(), ['id' => 'forum_questions_comments_id']);
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
}
