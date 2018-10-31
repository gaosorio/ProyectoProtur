<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "salondeevento".
 *
 * @property string $tipo_salon
 * @property int $id_socio
 * @property int $id_centro
 * @property string $fecha_salon
 * @property int $mes_salon
 * @property int $ano_salon
 * @property string $tasaocupacion_salon
 * @property int $valorreal_salon
 *
 * @property Centrodeeventos $centro
 */
class Salondeevento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salondeevento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_salon', 'id_centro','id_socio', 'fecha_salon','valorreal_salon'], 'required'],
            [['id_socio', 'id_centro', 'mes_salon', 'ano_salon', 'valorreal_salon'], 'default', 'value' => null],
            [['id_socio', 'id_centro', 'mes_salon', 'ano_salon', 'valorreal_salon'], 'integer'],
            [['tipo_salon'], 'string', 'max' => 1024],
            [['fecha_salon'], 'string', 'max' => 7],
            [['fecha_salon'], 'validar'],

            [['valorreal_salon'], 'integer', 'min' => 0],
            //[['valorreal_salon'], 'validarValor'],

            [['tasaocupacion_salon'], 'string', 'max' => 50],
            [['tipo_salon', 'id_centro', 'fecha_salon'], 'unique', 'targetAttribute' => ['tipo_salon', 'id_centro', 'fecha_salon']],
            [['id_centro'], 'exist', 'skipOnError' => true, 'targetClass' => Centrodeeventos::className(), 'targetAttribute' => ['id_centro' => 'id_centro']],
        ];
    }
    
    public function validar()
    {
        list($mes, $año) = explode('-', $this->fecha_salon);
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
                    $this->addError('fecha_salon','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_salon','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fecha_salon','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_salon','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }


public function validarValor()
    {
        $prueba = $this->valorreal_salon;
        $prueba2 = "400+";

        if (strcmp($this->tasaocupacion_salon,$prueba2) == 0){

            list($inicio1) = explode('+', $this->tasaocupacion_salon);

            if($prueba < $inicio1){
            $this->addError('valorreal_salon','Debe ingresar un valor mayor a 400 para el salon '.$this->tipo_salon);
            }


        }
        
        else{
        list($inicio, $fin) = explode('-', $this->tasaocupacion_salon);
        
        if (($prueba < $inicio) || ($prueba > $fin)) 
                {
                    //echo '<script>alert (" Ha respondido '.$resta_meses.' respuestas afirmativas");</script>';
                    $this->addError('valorreal_salon','Debe ingresar un valor segun rango ('.$inicio.' - '.$fin.') establecido en el salon '.$this->tipo_salon);
                }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipo_salon' => 'Nombre Salon',
            'id_socio' => 'Id Socio',
            'id_centro' => 'Id Centro',
            'fecha_salon' => 'Fecha Salon',
            'mes_salon' => 'Mes Salon',
            'ano_salon' => 'Ano Salon',
            'tasaocupacion_salon' => 'Tasaocupacion Salon',
            'valorreal_salon' => 'Asistentes',
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
