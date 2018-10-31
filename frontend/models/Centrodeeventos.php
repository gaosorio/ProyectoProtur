<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "centrodeeventos".
 *
 * @property int $id_centro
 * @property int $id_socio
 * @property string $nombre_centro
 * @property int $estacionamientos_centro
 *
 * @property Evento[] $eventos
 * @property Personalce[] $personalces
 * @property Salondeevento[] $salondeeventos
 * @property Stand[] $stands
 */
class Centrodeeventos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centrodeeventos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_centro', 'id_socio','nombre_centro'], 'required'],
            [['id_centro', 'id_socio', 'estacionamientos_centro'], 'default', 'value' => null],
            [['id_centro', 'id_socio', 'estacionamientos_centro'], 'integer'],
            [['nombre_centro'], 'string', 'max' => 1024],
            [['id_centro'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_centro' => 'Id Centro',
            'id_socio' => 'Id Socio',
            'nombre_centro' => 'Nombre Centro',
            'estacionamientos_centro' => 'Estacionamientos Centro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['id_centro' => 'id_centro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalces()
    {
        return $this->hasMany(Personalce::className(), ['id_centro' => 'id_centro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalondeeventos()
    {
        return $this->hasMany(Salondeevento::className(), ['id_centro' => 'id_centro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStands()
    {
        return $this->hasMany(Stand::className(), ['id_centro' => 'id_centro']);
    }
}
