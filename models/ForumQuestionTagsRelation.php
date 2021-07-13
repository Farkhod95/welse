<?php

namespace app\models;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "_table_of_forum_question_tags_relation".
 *
 * @property int $id
 * @property int|null $forum_question_id forum_question_id
 * @property int|null $forum_question_tag_id forum_question_tag_id
 *
 * @property ForumQuestions $forumQuestion
 * @property ForumQuestionTags $forumQuestionTag
 */
class ForumQuestionTagsRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%forum_question_tags_relation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['forum_question_id', 'forum_question_tag_id'], 'integer'],
            [['forum_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestions::className(), 'targetAttribute' => ['forum_question_id' => 'id']],
            [['forum_question_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestionTags::className(), 'targetAttribute' => ['forum_question_tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'forum_question_id' => 'Forum Question ID',
            'forum_question_tag_id' => 'Forum Question Tag ID',
        ];
    }
    public function search($params, $id)
    {
        $query = ForumQuestionTagsRelation::find()->where(['forum_question_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'forum_question_id' => $this->forum_question_id,
            'forum_question_tag_id' => $this->forum_question_tag_id,
        ]);

        return $dataProvider;
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
     * Gets query for [[ForumQuestionTag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionTag()
    {
        return $this->hasOne(ForumQuestionTags::className(), ['id' => 'forum_question_tag_id']);
    }
}
