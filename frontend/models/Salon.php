<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "salon".
 *
 * @property int $id_salon
 * @property int $id_socio
 * @property string $nombre_salon
 * @property string $ocupacion_salon
 */
class Salon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_salon', 'nombre_salon', 'ocupacion_salon'], 'required'],
            [['id_salon', 'id_socio'], 'default', 'value' => null],
            [['id_salon', 'id_socio'], 'integer'],
            [['nombre_salon', 'ocupacion_salon'], 'string', 'max' => 50],
            [['id_salon', 'nombre_salon'], 'unique', 'targetAttribute' => ['id_salon', 'nombre_salon']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_salon' => 'Id Salon',
            'id_socio' => 'Id Socio',
            'nombre_salon' => 'Nombre Salon',
            'ocupacion_salon' => 'Ocupacion Salon',
        ];
    }
}
