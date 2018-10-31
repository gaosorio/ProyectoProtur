<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Personalrestaurante;

/**
 * personalrestauranteSearch represents the model behind the search form of `frontend\models\personalrestaurante`.
 */
class PersonalrestauranteSearch extends Personalrestaurante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_personal'], 'safe'],
            [['mes_personal', 'año_personal', 'id_restaurante', 'personal_fijo', 'personal_partime', 'id_socio'], 'integer'],
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
        $query = Personalrestaurante::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'mes_personal' => $this->mes_personal,
            'año_personal' => $this->año_personal,
            'id_restaurante' => $this->id_restaurante,
            'personal_fijo' => $this->personal_fijo,
            'personal_partime' => $this->personal_partime,
            'id_socio' => $this->id_socio,
        ]);

        $query->andFilterWhere(['ilike', 'fecha_personal', $this->fecha_personal]);

        return $dataProvider;
    }
}
