<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Indicador7;

/**
 * indicador7Search represents the model behind the search form of `frontend\models\indicador7`.
 */
class Indicador7Search extends Indicador7
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'stand'], 'safe'],
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
        $query = Indicador7::find();

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
        $query->andFilterWhere(['ilike', 'tipo', $this->tipo])
            ->andFilterWhere(['ilike', 'stand', $this->stand]);

        return $dataProvider;
    }
}
