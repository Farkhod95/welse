<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_table_of_forum_question_tags".
 *
 * @property int $id
 * @property string|null $name name
 * @property string|null $slug slug
 *
 * @property ForumQuestionTagsRelation[] $forumQuestionTagsRelations
 */
class ForumQuestionTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%forum_question_tags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'string', 'max' => 255],
            [['name',], 'required'],
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
        ];
    }

    /**
     * Gets query for [[ForumQuestionTagsRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQuestionTagsRelations()
    {
        return $this->hasMany(ForumQuestionTagsRelation::className(), ['forum_question_tag_id' => 'id']);
    }
}
