<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "servicio".
 *
 * @property string $tipo_servicio
 * @property string $fecha_servicio
 * @property int $mes_servicio
 * @property int $año_servicio
 * @property int $id_restaurante
 * @property int $cantidad
 * @property int $id_socio
 *
 * @property Restaurante $restaurante
 */
class Servicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_servicio', 'fecha_servicio', 'id_restaurante','cantidad'], 'required'],
            [['mes_servicio', 'año_servicio', 'id_restaurante', 'cantidad', 'id_socio'], 'default', 'value' => null],
            [['mes_servicio', 'año_servicio', 'id_restaurante', 'cantidad', 'id_socio'], 'integer'],
            [['tipo_servicio'], 'string', 'max' => 8],
            [['fecha_servicio'], 'string', 'max' => 7],
            [['cantidad'], 'integer', 'min' => 0],
            [['fecha_servicio'], 'validar'],
            [['tipo_servicio', 'fecha_servicio', 'id_restaurante'], 'unique', 'targetAttribute' => ['tipo_servicio', 'fecha_servicio', 'id_restaurante']],
            [['id_restaurante'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurante::className(), 'targetAttribute' => ['id_restaurante' => 'id_restaurante'],'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un restaurante creado'],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function validar()
    {
        list($mes, $año) = explode('-', $this->fecha_servicio);
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
                    $this->addError('fecha_servicio','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_servicio','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fecha_servicio','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_servicio','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'tipo_servicio' => 'Tipo Servicio',
            'fecha_servicio' => 'Fecha Servicio',
            'mes_servicio' => 'Mes Servicio',
            'año_servicio' => 'Año Servicio',
            'id_restaurante' => 'Id Restaurante',
            'cantidad' => 'Personas Atendidas (Cantidad)',
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
