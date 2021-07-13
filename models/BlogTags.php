<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_table_of_blog_tags".
 *
 * @property int $id
 * @property string|null $slug slug
 * @property int|null $frequency frequency
 * @property string|null $name name
 * @property int|null $searching searching
 * @property string|null $meta_title meta_title
 *
 * @property BlogTagsRelations[] $blogTagsRelations
 */
class BlogTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blog_tags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['frequency', 'searching'], 'integer'],
            [['slug', 'name', 'meta_title'], 'string', 'max' => 255],
            [['name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Слуг',
            'frequency' => 'Частота',
            'name' => 'Название',
            'searching' => 'Поисковый',
            'meta_title' => 'Мета-заголовок',
        ];
    }

    /**
     * Gets query for [[BlogTagsRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTagsRelations()
    {
        return $this->hasMany(BlogTagsRelations::className(), ['blog_tag_id' => 'id']);
    }
}
