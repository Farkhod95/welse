<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EventCategoriesRelation;

/**
 * EventCategoriesRelationSearch represents the model behind the search form about `app\models\EventCategoriesRelation`.
 */
class EventCategoriesRelationSearch extends EventCategoriesRelation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'event_category_id'], 'integer'],
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
        $query = EventCategoriesRelation::find();

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
            'event_id' => $this->event_id,
            'event_category_id' => $this->event_category_id,
        ]);

        return $dataProvider;
    }
}
