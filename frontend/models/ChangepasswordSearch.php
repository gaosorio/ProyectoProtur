<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Changepassword;

/**
 * changepasswordSearch represents the model behind the search form of `frontend\models\changepassword`.
 */
class ChangepasswordSearch extends Changepassword
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'pass_actual', 'pass_nuevo', 'confir_pass_nuevo'], 'safe'],
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
        $query = Changepassword::find();

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
            ->andFilterWhere(['ilike', 'pass_actual', $this->pass_actual])
            ->andFilterWhere(['ilike', 'pass_nuevo', $this->pass_nuevo])
            ->andFilterWhere(['ilike', 'confir_pass_nuevo', $this->confir_pass_nuevo]);

        return $dataProvider;
    }
}
