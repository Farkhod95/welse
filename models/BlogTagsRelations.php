<?php

namespace app\models;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "_table_of_blog_tags_relations".
 *
 * @property int $id
 * @property int|null $blog_id blog_id
 * @property int|null $blog_tag_id blog_tag_id
 *
 * @property Blogs $blog
 * @property BlogTags $blogTag
 */
class BlogTagsRelations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blog_tags_relations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id', 'blog_tag_id'], 'integer'],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blogs::className(), 'targetAttribute' => ['blog_id' => 'id']],
            [['blog_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogTags::className(), 'targetAttribute' => ['blog_tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blog_id' => 'Blog ID',
            'blog_tag_id' => 'Blog Tag ID',
        ];
    }

    /**
     * Gets query for [[Blog]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blogs::className(), ['id' => 'blog_id']);
    }

    /**
     * Gets query for [[BlogTag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTag()
    {
        return $this->hasOne(BlogTags::className(), ['id' => 'blog_tag_id']);
    }
    public function search($params, $id)
    {
        $query = BlogTagsRelations::find()->where(['blog_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'blog_id' => $this->blog_id,
            'blog_tag_id' => $this->blog_tag_id,
        ]);

        return $dataProvider;
    }
}
