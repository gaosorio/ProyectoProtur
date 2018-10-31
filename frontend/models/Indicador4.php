<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "indicador4".
 *
 * @property string $tipo
 */
class Indicador4 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indicador4';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 50],
            [['tipo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipo' => 'Tipo',
        ];
    }
}
