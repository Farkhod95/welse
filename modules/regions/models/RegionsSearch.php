<?php

namespace app\modules\regions\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\regions\models\Regions;

/**
 * RegionsSearch represents the model behind the search form about `app\modules\regions\models\Regions`.
 */
class RegionsSearch extends Regions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'key', 'country_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = Regions::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->with('translate');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'key' => $this->key,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
