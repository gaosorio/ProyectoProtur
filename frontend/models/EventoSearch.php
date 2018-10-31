<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Evento;

/**
 * EventoSearch represents the model behind the search form of `frontend\models\Evento`.
 */
class EventoSearch extends Evento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_evento', 'fecha_evento'], 'safe'],
            [['mes_evento', 'ano_evento', 'id_centro', 'cantida_de_ventos', 'personas_atendidas_evento', 'id_socio'], 'integer'],
            [['dimension_evento'], 'number'],
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
        $query = Evento::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'mes_evento' => $this->mes_evento,
            'ano_evento' => $this->ano_evento,
            'id_centro' => $this->id_centro,
            'dimension_evento' => $this->dimension_evento,
            'cantida_de_ventos' => $this->cantida_de_ventos,
            'personas_atendidas_evento' => $this->personas_atendidas_evento,
            'id_socio' => $this->id_socio,
        ]);

        $query->andFilterWhere(['ilike', 'tipo_evento', $this->tipo_evento])
            ->andFilterWhere(['ilike', 'fecha_evento', $this->fecha_evento]);

        return $dataProvider;
    }
}
