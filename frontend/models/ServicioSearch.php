<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Servicio;

/**
 * servicioSearch represents the model behind the search form of `frontend\models\servicio`.
 */
class ServicioSearch extends Servicio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_servicio', 'fecha_servicio'], 'safe'],
            [['mes_servicio', 'año_servicio', 'id_restaurante', 'cantidad', 'id_socio'], 'integer'],
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
        $query = Servicio::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'mes_servicio' => $this->mes_servicio,
            'año_servicio' => $this->año_servicio,
            'id_restaurante' => $this->id_restaurante,
            'cantidad' => $this->cantidad,
            'id_socio' => $this->id_socio,
        ]);

        $query->andFilterWhere(['ilike', 'tipo_servicio', $this->tipo_servicio])
            ->andFilterWhere(['ilike', 'fecha_servicio', $this->fecha_servicio]);

        return $dataProvider;
    }
}
