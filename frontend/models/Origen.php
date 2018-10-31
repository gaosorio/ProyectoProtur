<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "origen".
 *
 * @property string $fecha
 * @property string $pais
 * @property int $cantidad
 * @property int $id_socio
 * @property int $id_hotel
 */
class Origen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'origen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'pais','cantidad'], 'required'],
            [['fecha', 'pais'], 'string'],
            [['cantidad', 'id_socio'], 'default', 'value' => null],
            [['id_socio','id_hotel'], 'integer'],
            [['cantidad'], 'integer','min'=> 0, 'max'=> 99999],
            [['fecha', 'pais','id_hotel'], 'unique', 'targetAttribute' => ['fecha', 'pais','id_hotel']],
            [['id_hotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['id_hotel' => 'idhotel'], 'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un hotel creado']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fecha' => 'Fecha',
            'pais' => 'País',
            'cantidad' => 'Cantidad',
            'id_socio' => 'Id Socio',
            'id_hotel' => 'Id Hotel',
        ];
    }
}
