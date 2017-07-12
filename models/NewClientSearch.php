<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NewClient;

/**
 * NewClientSearch represents the model behind the search form about `app\models\NewClient`.
 */
class NewClientSearch extends NewClient
{    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['lastname', 'name', 'middlename', 'birthday', 'sex', 'added', 'updated', 'allSearch'], 'safe'],
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
        $query = NewClient::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('phones');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'birthday' => $this->birthday,
            'added' => $this->added,
            'updated' => $this->updated,
        ]);

        $query->orFilterWhere(['like', 'lastname', $this->allSearch])
            // ->andFilterWhere(['like', 'name', $this->name])
            // ->andFilterWhere(['like', 'middlename', $this->middlename])
            // ->andFilterWhere(['like', 'sex', $this->sex]);
        ->orFilterWhere(['like', 'client_phone.phone', $this->allSearch]);

        return $dataProvider;
    }
}
