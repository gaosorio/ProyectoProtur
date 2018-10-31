<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "restaurante".
 *
 * @property int $id_restaurante
 * @property string $nombre_restaurante
 * @property int $id_socio
 *
 * @property Servicio[] $servicios
 */
class Restaurante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_restaurante','nombre_restaurante'], 'required'],
            [['id_restaurante', 'id_socio'], 'default', 'value' => null],
            [['id_restaurante', 'id_socio'], 'integer'],
            [['nombre_restaurante'], 'string', 'max' => 30],
            [['id_restaurante'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_restaurante' => 'Id Restaurante',
            'nombre_restaurante' => 'Nombre Restaurante',
            'id_socio' => 'Id Socio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicio::className(), ['id_restaurante' => 'id_restaurante']);
    }
}
