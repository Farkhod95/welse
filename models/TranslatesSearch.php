<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Translates;

/**
 * TranslatesSearch represents the model behind the search form about `app\models\Translates`.
 */
class TranslatesSearch extends Translates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'field_id'], 'integer'],
            [['table_name', 'language_code', 'field_name', 'field_value', 'field_description'], 'safe'],
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
        $query = Translates::find();

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
            'field_id' => $this->field_id,
        ]);

        $query->andFilterWhere(['like', 'table_name', $this->table_name])
            ->andFilterWhere(['like', 'language_code', $this->language_code])
            ->andFilterWhere(['like', 'field_name', $this->field_name])
            ->andFilterWhere(['like', 'field_value', $this->field_value])
            ->andFilterWhere(['like', 'field_description', $this->field_description]);

        return $dataProvider;
    }
}
