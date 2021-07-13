<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BlogTags;

/**
 * BlogTagsSearch represents the model behind the search form about `app\models\BlogTags`.
 */
class BlogTagsSearch extends BlogTags
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'frequency', 'searching'], 'integer'],
            [['slug', 'name', 'meta_title'], 'safe'],
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
        $query = BlogTags::find();

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
            'frequency' => $this->frequency,
            'searching' => $this->searching,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title]);

        return $dataProvider;
    }
}
