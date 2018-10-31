<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Habitacion;

/**
 * habitacionSearch represents the model behind the search form of `frontend\models\habitacion`.
 */
class HabitacionSearch extends Habitacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechahab'], 'safe'],
            [['idhotel', 'cantidadhabitacion', 'ocupacion', 'id_socio', 'mes_habitacion', 'año_habitacion'], 'integer'],
            [['tarifahabitacion'], 'number'],
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
        $query = Habitacion::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'idhotel' => $this->idhotel,
            'tarifahabitacion' => $this->tarifahabitacion,
            'cantidadhabitacion' => $this->cantidadhabitacion,
            'ocupacion' => $this->ocupacion,
            'id_socio' => $this->id_socio,
            'mes_habitacion' => $this->mes_habitacion,
            'año_habitacion' => $this->año_habitacion,
        ]);

        $query->andFilterWhere(['ilike', 'fechahab', $this->fechahab]);

        return $dataProvider;
    }
}
