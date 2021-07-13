<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserBlogs;

/**
 * UserBlogsSearch represents the model behind the search form about `app\models\UserBlogs`.
 */
class UserBlogsSearch extends UserBlogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['author_username', 'author_password_hash'], 'safe'],
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
        $query = UserBlogs::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'author_username', $this->author_username])
            ->andFilterWhere(['like', 'author_password_hash', $this->author_password_hash]);

        return $dataProvider;
    }
}
