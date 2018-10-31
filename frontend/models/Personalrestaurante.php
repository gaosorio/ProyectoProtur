<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "personalrestaurante".
 *
 * @property string $fecha_personal
 * @property int $mes_personal
 * @property int $año_personal
 * @property int $id_restaurante
 * @property int $personal_fijo
 * @property int $personal_partime
 * @property int $id_socio
 *
 * @property Restaurante $restaurante
 */
class Personalrestaurante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personalrestaurante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_personal', 'id_restaurante','personal_fijo', 'personal_partime'], 'required'],
            [['mes_personal', 'año_personal', 'id_restaurante', 'personal_fijo', 'personal_partime', 'id_socio'], 'default', 'value' => null],
            [['mes_personal', 'año_personal', 'id_restaurante', 'personal_fijo', 'personal_partime', 'id_socio'], 'integer'],
            [['personal_fijo', 'personal_partime'], 'integer', 'min' => 0],
            [['fecha_personal'], 'string', 'max' => 7],
            [['fecha_personal'], 'validar'],
            [['fecha_personal', 'id_restaurante'], 'unique', 'targetAttribute' => ['fecha_personal', 'id_restaurante']],
            [['id_restaurante'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurante::className(), 'targetAttribute' => ['id_restaurante' => 'id_restaurante'], 'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un restaurante creado'],
        ];
    }

    public function validar()
    {
        list($mes, $año) = explode('-', $this->fecha_personal);
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
                    $this->addError('fecha_personal','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_personal','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fecha_personal','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_personal','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'fecha_personal' => 'Fecha Personal',
            'mes_personal' => 'Mes Personal',
            'año_personal' => 'Año Personal',
            'id_restaurante' => 'Id Restaurante',
            'personal_fijo' => 'Personal Fijo (Cantidad)',
            'personal_partime' => 'Personal PartTime (Cantidad)',
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
