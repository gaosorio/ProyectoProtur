<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Consumo;

/**
 * consumoSearch represents the model behind the search form of `frontend\models\consumo`.
 */
class ConsumoSearch extends Consumo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_restaurante', 'mes_consumo', 'año_consumo', 'consumo_promedio', 'id_socio'], 'integer'],
            [['fecha_consumo'], 'safe'],
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
        $query = Consumo::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'id_restaurante' => $this->id_restaurante,
            'mes_consumo' => $this->mes_consumo,
            'año_consumo' => $this->año_consumo,
            'consumo_promedio' => $this->consumo_promedio,
            'id_socio' => $this->id_socio,
        ]);

        $query->andFilterWhere(['ilike', 'fecha_consumo', $this->fecha_consumo]);

        return $dataProvider;
    }
}
