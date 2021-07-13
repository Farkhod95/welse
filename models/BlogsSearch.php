<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Blogs;

/**
 * BlogsSearch represents the model behind the search form about `app\models\Blogs`.
 */
class BlogsSearch extends Blogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'category_id', 'country_id', 'region_id', 'updated_at', 'published_at', 'status', 'viewed'], 'integer'],
            [['slug', 'title', 'district_id', 'created_at'], 'safe'],
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
        $query = Blogs::find();

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
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,
            'country_id' => $this->country_id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'published_at' => $this->published_at,
            'status' => $this->status,
            'viewed' => $this->viewed,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
              ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
