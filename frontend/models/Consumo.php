<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "consumo".
 *
 * @property int $id_restaurante
 * @property string $fecha_consumo
 * @property int $mes_consumo
 * @property int $año_consumo
 * @property int $consumo_promedio
 * @property int $id_socio
 *
 * @property Restaurante $restaurante
 */
class Consumo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consumo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_restaurante', 'fecha_consumo','consumo_promedio'], 'required'],
            [['id_restaurante', 'mes_consumo', 'año_consumo', 'consumo_promedio', 'id_socio'], 'default', 'value' => null],
            [['id_restaurante', 'mes_consumo', 'año_consumo', 'consumo_promedio', 'id_socio'], 'integer'],
            [['consumo_promedio'], 'integer', 'min' => 0],
            [['fecha_consumo'], 'string', 'max' => 7],
            [['fecha_consumo'], 'validar'],
            [['id_restaurante', 'fecha_consumo'], 'unique', 'targetAttribute' => ['id_restaurante', 'fecha_consumo']],
            [['id_restaurante'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurante::className(), 'targetAttribute' => ['id_restaurante' => 'id_restaurante'],'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un restaurante creado'],
        ];
    }

     public function validar()
    {
        list($mes, $año) = explode('-', $this->fecha_consumo);
        $año_actual = date('Y');
        $mes_actual = date('m');
        $resta_años = $año-$año_actual;
        $resta_meses = $mes-$mes_actual;
        if($resta_años==0)
        {
            if ( ($mes < $mes_actual) ) 
            {
                if ($resta_meses != -1)
                {
                    //echo '<script>alert (" Ha respondido '.$resta_meses.' respuestas afirmativas");</script>';
                    $this->addError('fecha_consumo','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_consumo','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fecha_consumo','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_consumo','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_restaurante' => 'Id Restaurante',
            'fecha_consumo' => 'Fecha Consumo',
            'mes_consumo' => 'Mes Consumo',
            'año_consumo' => 'Año Consumo',
            'consumo_promedio' => 'Consumo Promedio',
            'id_socio' => 'Id Socio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurante()
    {
        return $this->hasOne(Restaurante::className(), ['id_restaurante' => 'id_restaurante']);
    }
}
