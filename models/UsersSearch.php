<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'country_id', 'district_id' , 'region_id'], 'integer'],
            [['selected_langauge', 'auth_key','username', 'password', 'password_reset_token', 'avatar', 'email', 'email_verification_key', 'fio', 'phone', 'last_seen', 'birthday', 'created_at', 'updated_at'], 'safe'],
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
        $userRoles = UserRoles::find()->Where(['!=','role_id', 5])->all();
        $userArray = [];
        foreach ($userRoles as $userRole){
            $userArray  [] = $userRole->user_id;
        }

        $query = Users::find();
        foreach($userArray as $word){
            $query->orWhere(['id'=> $word]);
        }

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
            'status' => $this->status,
            'last_seen' => $this->last_seen,
            'birthday' => $this->birthday,

            'country_id' => $this->country_id,
            'district_id' => $this->district_id,
            'region_id' => $this->region_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'selected_langauge', $this->selected_langauge])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email_verification_key', $this->email_verification_key])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }

    public function searchAdmin($params)
    {
        $userRoles = UserRoles::find()->Where(['role_id' => 5])->all();
        $userArray = [];
        foreach ($userRoles as $userRole){
            $userArray  [] = $userRole->user_id;
        }

        $query = Users::find();
        foreach($userArray as $word){
            $query->orWhere(['id'=> $word]);
        }

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
            'status' => $this->status,
            'last_seen' => $this->last_seen,
            'birthday' => $this->birthday,

            'country_id' => $this->country_id,
            'district_id' => $this->district_id,
            'region_id' => $this->region_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'selected_langauge', $this->selected_langauge])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email_verification_key', $this->email_verification_key])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
