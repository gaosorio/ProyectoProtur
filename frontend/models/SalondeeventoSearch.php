<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Salondeevento;

/**
 * salondeeventoSearch represents the model behind the search form of `frontend\models\salondeevento`.
 */
class SalondeeventoSearch extends Salondeevento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_salon', 'fecha_salon', 'tasaocupacion_salon'], 'safe'],
            [['id_socio', 'id_centro', 'mes_salon', 'ano_salon', 'valorreal_salon'], 'integer'],
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
        $query = Salondeevento::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'id_socio' => $this->id_socio,
            'id_centro' => $this->id_centro,
            'mes_salon' => $this->mes_salon,
            'ano_salon' => $this->ano_salon,
            'valorreal_salon' => $this->valorreal_salon,
        ]);

        $query->andFilterWhere(['ilike', 'tipo_salon', $this->tipo_salon])
            ->andFilterWhere(['ilike', 'fecha_salon', $this->fecha_salon])
            ->andFilterWhere(['ilike', 'tasaocupacion_salon', $this->tasaocupacion_salon]);

        return $dataProvider;
    }
}
