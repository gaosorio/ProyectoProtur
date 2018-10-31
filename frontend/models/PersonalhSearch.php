<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Personalh;

/**
 * personalhSearch represents the model behind the search form of `frontend\models\personalh`.
 */
class PersonalhSearch extends Personalh
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechap'], 'safe'],
            [['idhotel', 'personalfijo', 'personalparttime', 'id_socio', 'mes_personal', 'año_personal'], 'integer'],
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
        $query = Personalh::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio]);

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
            'personalfijo' => $this->personalfijo,
            'personalparttime' => $this->personalparttime,
            'id_socio' => $this->id_socio,
            'mes_personal' => $this->mes_personal,
            'año_personal' => $this->año_personal,
        ]);

        $query->andFilterWhere(['ilike', 'fechap', $this->fechap]);

        return $dataProvider;
    }
}
