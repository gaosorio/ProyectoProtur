<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "personalce".
 *
 * @property string $fecha_personal_ce
 * @property int $mes_personal_ce
 * @property int $ano_personal_ce
 * @property int $id_centro
 * @property int $id_socio
 * @property int $personalfijo_personal_ce
 * @property int $personalparttime_personal_ce
 *
 * @property Centrodeeventos $centro
 */
class Personalce extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personalce';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_personal_ce', 'id_centro', 'id_socio','personalfijo_personal_ce','personalparttime_personal_ce'], 'required'],
            [['mes_personal_ce', 'ano_personal_ce', 'id_centro', 'id_socio', 'personalfijo_personal_ce', 'personalparttime_personal_ce'], 'default', 'value' => null],
            [['mes_personal_ce', 'ano_personal_ce', 'id_centro', 'id_socio', 'personalfijo_personal_ce', 'personalparttime_personal_ce'], 'integer'],

            [['personalparttime_personal_ce'], 'integer', 'min' => 0],
            [['personalfijo_personal_ce'], 'integer', 'min' => 0],

            [['fecha_personal_ce'], 'string', 'max' => 7],
            [['fecha_personal_ce'], 'validar'],
            [['fecha_personal_ce', 'id_centro'], 'unique', 'targetAttribute' => ['fecha_personal_ce', 'id_centro']],
            [['id_centro'], 'exist', 'skipOnError' => true, 'targetClass' => Centrodeeventos::className(), 'targetAttribute' => ['id_centro' => 'id_centro'], 'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un centro de eventos creado'],
        ];
    }

    public function validar()
    {
        list($mes, $año) = explode('-', $this->fecha_personal_ce);
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
                    $this->addError('fecha_personal_ce','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_personal_ce','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fecha_personal_ce','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_personal_ce','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fecha_personal_ce' => 'Fecha',
            'mes_personal_ce' => 'Mes Personal Ce',
            'ano_personal_ce' => 'Ano Personal Ce',
            'id_centro' => 'Id Centro',
            'id_socio' => 'Id Socio',
            'personalfijo_personal_ce' => 'Personal Fijo (Cantidad)',
            'personalparttime_personal_ce' => 'Personal PartTime (Cantidad)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentro()
    {
        return $this->hasOne(Centrodeeventos::className(), ['id_centro' => 'id_centro']);
    }
}
