<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Restaurante;

/**
 * restauranteSearch represents the model behind the search form of `frontend\models\restaurante`.
 */
class RestauranteSearch extends Restaurante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_restaurante', 'id_socio'], 'integer'],
            [['nombre_restaurante'], 'safe'],
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
        $query = Restaurante::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'id_socio' => $this->id_socio,
        ]);

        $query->andFilterWhere(['ilike', 'nombre_restaurante', $this->nombre_restaurante]);

        return $dataProvider;
    }
}
