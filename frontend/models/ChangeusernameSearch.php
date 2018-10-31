<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Changeusername;

/**
 * changeusernameSearch represents the model behind the search form of `frontend\models\changeusername`.
 */
class ChangeusernameSearch extends Changeusername
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'new_username'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Changeusername::find();

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

        // grid filtering conditions
        $query->andFilterWhere(['ilike', 'usuario', $this->usuario])
            ->andFilterWhere(['ilike', 'new_username', $this->new_username]);

        return $dataProvider;
    }
}
