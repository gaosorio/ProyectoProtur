<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "personalh".
 *
 * @property string $fechap
 * @property int $idhotel
 * @property int $personalfijo
 * @property int $personalparttime
 * @property int $id_socio
 * @property int $mes_personal
 * @property int $año_personal
 *
 * @property Hotel $hotel
 */
class Personalh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personalh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechap', 'idhotel', 'id_socio', 'personalfijo', 'personalparttime'], 'required'],
            [['idhotel', 'personalfijo', 'personalparttime', 'id_socio', 'mes_personal', 'año_personal'], 'default', 'value' => null],
            [['idhotel', 'id_socio', 'mes_personal', 'año_personal'], 'integer'],
            [['fechap'], 'string', 'max' => 10],
	    [['personalfijo'], 'integer', 'max' => 29999, 'min' => 0],
            [['personalparttime'], 'integer', 'max' => 29999, 'min' => 0],
            [['fechap'], 'validar'],
            [['fechap', 'idhotel'], 'unique', 'targetAttribute' => ['fechap', 'idhotel']],
	    [['idhotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['idhotel' => 'idhotel'], 'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un hotel creado']
        ];
    }

    public function validar()
    {
        list($mes, $año) = explode('-', $this->fechap);
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
                    $this->addError('fechap','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fechap','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fechap','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fechap','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fechap' => 'Fecha',
            'idhotel' => 'Id Hotel',
            'personalfijo' => 'Personal Fijo (Cantidad)',
            'personalparttime' => 'Personal PartTime (Cantidad)',
            'id_socio' => 'Id Socio',
            'mes_personal' => 'Mes Personal',
            'año_personal' => 'Año Personal',
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
