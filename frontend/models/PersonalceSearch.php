<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Personalce;

/**
 * personalceSearch represents the model behind the search form of `frontend\models\personalce`.
 */
class PersonalceSearch extends Personalce
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_personal_ce'], 'safe'],
            [['mes_personal_ce', 'ano_personal_ce', 'id_centro', 'id_socio', 'personalfijo_personal_ce', 'personalparttime_personal_ce'], 'integer'],
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
        $query = Personalce::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'mes_personal_ce' => $this->mes_personal_ce,
            'ano_personal_ce' => $this->ano_personal_ce,
            'id_centro' => $this->id_centro,
            'id_socio' => $this->id_socio,
            'personalfijo_personal_ce' => $this->personalfijo_personal_ce,
            'personalparttime_personal_ce' => $this->personalparttime_personal_ce,
        ]);

        $query->andFilterWhere(['ilike', 'fecha_personal_ce', $this->fecha_personal_ce]);

        return $dataProvider;
    }
}
