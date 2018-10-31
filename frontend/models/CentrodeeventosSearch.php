<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Centrodeeventos;

/**
 * centrodeeventosSearch represents the model behind the search form of `frontend\models\centrodeeventos`.
 */
class CentrodeeventosSearch extends Centrodeeventos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_centro', 'id_socio', 'estacionamientos_centro'], 'integer'],
            [['nombre_centro'], 'safe'],
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
        $query = Centrodeeventos::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'id_centro' => $this->id_centro,
            'id_socio' => $this->id_socio,
            'estacionamientos_centro' => $this->estacionamientos_centro,
        ]);

        $query->andFilterWhere(['ilike', 'nombre_centro', $this->nombre_centro]);

        return $dataProvider;
    }
}
