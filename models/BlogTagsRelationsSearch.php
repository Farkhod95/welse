<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BlogTagsRelations;

/**
 * BlogTagsRelationsSearch represents the model behind the search form about `app\models\BlogTagsRelations`.
 */
class BlogTagsRelationsSearch extends BlogTagsRelations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'blog_id', 'blog_tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BlogTagsRelations::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
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
