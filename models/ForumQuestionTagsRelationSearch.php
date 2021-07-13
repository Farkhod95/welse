<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ForumQuestionTagsRelation;

/**
 * ForumQuestionTagsRelationSearch represents the model behind the search form about `app\models\ForumQuestionTagsRelation`.
 */
class ForumQuestionTagsRelationSearch extends ForumQuestionTagsRelation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'forum_question_id', 'forum_question_tag_id'], 'integer'],
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
        $query = ForumQuestionTagsRelation::find();

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
            'forum_question_id' => $this->forum_question_id,
            'forum_question_tag_id' => $this->forum_question_tag_id,
        ]);

        return $dataProvider;
    }
}
