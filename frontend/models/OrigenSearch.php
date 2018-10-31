<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Origen;

/**
 * OrigenSearch represents the model behind the search form of `frontend\models\Origen`.
 */
class OrigenSearch extends Origen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'pais'], 'safe'],
            [['cantidad', 'id_socio','id_hotel'], 'integer'],
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
        $query = Origen::find()->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->Orderby('año_origen,mes_origen ASC');;

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
        $query->andFilterWhere([
            'cantidad' => $this->cantidad,
            'id_socio' => $this->id_socio,
        ]);

        $query->andFilterWhere(['ilike', 'fecha', $this->fecha])
            ->andFilterWhere(['ilike', 'pais', $this->pais]);

        return $dataProvider;
    }
}
