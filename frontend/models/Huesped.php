<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "huesped".
 *
 * @property string $fechah
 * @property int $idhotel
 * @property int $extranjeros
 * @property int $nacionales
 * @property int $estadiapromedio
 * @property int $id_socio
 * @property int $mes_huesped
 * @property int $año_huesped
 *
 * @property Hotel $hotel
 */
class Huesped extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'huesped';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechah', 'idhotel', 'id_socio', 'extranjeros', 'nacionales', 'estadiapromedio'], 'required'],
            [['idhotel', 'extranjeros', 'nacionales', 'estadiapromedio', 'id_socio', 'mes_huesped', 'año_huesped'], 'default', 'value' => null],
            [['idhotel', 'id_socio', 'mes_huesped', 'año_huesped'], 'integer'],
            [['fechah'], 'string', 'max' => 10],
	    [['extranjeros'], 'integer','min'=> 0],
            [['nacionales'], 'integer','min'=> 0], 
            [['estadiapromedio'], 'integer', 'max' => 999,'min'=> 0],
            [['fechah'], 'validar'],
            [['fechah', 'idhotel'], 'unique', 'targetAttribute' => ['fechah', 'idhotel']],
            [['idhotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['idhotel' => 'idhotel'], 'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un hotel creado']
        ];
    }

    public function validar()
    {
        list($mes, $año) = explode('-', $this->fechah);
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
                    $this->addError('fechah','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fechah','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fechah','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fechah','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fechah' => 'Fecha',
            'idhotel' => 'Id Hotel',
            'extranjeros' => 'Extranjeros (Cantidad)',
            'nacionales' => 'Nacionales (Cantidad)',
            'estadiapromedio' => 'Estadia promedio',
            'id_socio' => 'Id Socio',
            'mes_huesped' => 'Mes Huesped',
            'año_huesped' => 'Año Huesped',
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
