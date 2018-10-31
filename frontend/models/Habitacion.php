<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "habitacion".
 *
 * @property string $fechahab
 * @property int $idhotel
 * @property double $tarifahabitacion
 * @property int $cantidadhabitacion
 * @property int $ocupacion
 * @property int $id_socio
 * @property int $mes_habitacion
 * @property int $año_habitacion
 *
 * @property Hotel $hotel
 */
class Habitacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'habitacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
	return [
            [['fechahab', 'idhotel','cantidadhabitacion', 'ocupacion','tarifahabitacion'], 'required'],
            [['idhotel', 'cantidadhabitacion', 'ocupacion', 'id_socio', 'mes_habitacion', 'año_habitacion'], 'default', 'value' => null],
            [['idhotel', 'id_socio', 'mes_habitacion', 'año_habitacion'], 'integer'],
            [['tarifahabitacion'], 'number','min'=>0,'max'=>99999999],
	    [['cantidadhabitacion'], 'integer','min'=>0,'max'=>99999999],
	    [['ocupacion'], 'integer','min'=>0,'max'=>100],
            [['fechahab'], 'string', 'max' => 10],
	    [['fechahab'], 'validar'],
            [['fechahab', 'id_socio'], 'unique', 'targetAttribute' => ['fechahab', 'id_socio']],
	    [['idhotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['idhotel' => 'idhotel'], 'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un hotel creado']
        ];

    }

    public function validar()
    {
        list($mes, $año) = explode('-', $this->fechahab);
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
                    $this->addError('fechahab','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fechahab','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fechahab','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fechahab','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'fechahab' => 'Fecha',
            'idhotel' => 'Id Hotel',
            'tarifahabitacion' => 'Tarifa promedio (Cantidad)',
            'cantidadhabitacion' => 'Habitaciones disponibles (Cantidad)',
            'ocupacion' => 'Ocupacion (Porcentaje)',
            'id_socio' => 'Id Socio',
            'mes_habitacion' => 'Mes Habitacion',
            'año_habitacion' => 'Año Habitacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['idhotel' => 'idhotel']);
    }
}
