<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property string $tipo_evento
 * @property int $mes_evento
 * @property int $ano_evento
 * @property int $id_centro
 * @property string $fecha_evento
 * @property double $dimension_evento
 * @property int $cantida_de_ventos
 * @property int $personas_atendidas_evento
 * @property int $id_socio
 *
 * @property Centrodeeventos $centro
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_evento', 'fecha_evento', 'id_centro', 'id_socio','cantida_de_ventos','personas_atendidas_evento'], 'required'],
            [['mes_evento', 'ano_evento', 'id_centro', 'cantida_de_ventos', 'personas_atendidas_evento', 'id_socio'], 'default', 'value' => null],
            [['mes_evento', 'ano_evento', 'id_centro', 'cantida_de_ventos', 'personas_atendidas_evento', 'id_socio'], 'integer'],
            [['dimension_evento'], 'number'],

            [['dimension_evento'], 'integer', 'min' => 0],
            [['personas_atendidas_evento'], 'integer', 'min' => 0],
            [['cantida_de_ventos'], 'integer', 'min' => 0],

            [['tipo_evento'], 'string', 'max' => 1024],
            [['fecha_evento'], 'string', 'max' => 7],
            [['fecha_evento'], 'validar'],
            [['tipo_evento', 'id_centro', 'fecha_evento'], 'unique', 'targetAttribute' => ['tipo_evento', 'id_centro', 'fecha_evento']],
            [['id_centro'], 'exist', 'skipOnError' => true, 'targetClass' => Centrodeeventos::className(), 'targetAttribute' => ['id_centro' => 'id_centro'], 'message'=>'El socio: '.Yii::$app->user->identity->socio.'; no tiene un centro de eventos creado'],
        ];
    }

    public function validar()
    {
        list($mes, $año) = explode('-', $this->fecha_evento);
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
                    
                    $this->addError('fecha_evento','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_evento','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
        else
        {
            if($resta_años == -1 )
            {
                if($resta_meses != 11)
                {
                    $this->addError('fecha_evento','Debe ingresar informacion del mes anterior de la fecha actual');
                }
            }
            else
            {
                $this->addError('fecha_evento','Debe ingresar informacion del mes anterior de la fecha actual');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipo_evento' => 'Tipo Evento',
            'mes_evento' => 'Mes Evento',
            'ano_evento' => 'Ano Evento',
            'id_centro' => 'Id Centro',
            'fecha_evento' => 'Fecha Evento',
            'dimension_evento' => 'Dimension Evento',
            'cantida_de_ventos' => 'Cantidad De Eventos',
            'personas_atendidas_evento' => 'Personas Atendidas',
            'id_socio' => 'Id Socio',
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
