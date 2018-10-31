<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property int $idhotel
 * @property string $nombrehotel
 * @property int $id_socio
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idhotel'], 'required'],
            [['idhotel', 'id_socio'], 'default', 'value' => null],
            [['idhotel', 'id_socio'], 'integer'],
            [['nombrehotel'], 'string', 'max' => 1024],
            [['idhotel'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idhotel' => 'Id Hotel',
            'nombrehotel' => 'Nombre Hotel',
            'id_socio' => 'Id Socio',
        ];
    }
}
