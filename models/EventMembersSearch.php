<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EventMembers;

/**
 * EventMembersSearch represents the model behind the search form about `app\models\EventMembers`.
 */
class EventMembersSearch extends EventMembers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'user_id'], 'integer'],
            [['is_organizer'], 'safe'],
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
        $query = EventMembers::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'is_organizer', $this->is_organizer]);

        return $dataProvider;
    }
}
