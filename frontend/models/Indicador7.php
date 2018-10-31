<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "indicador7".
 *
 * @property string $tipo
 * @property string $stand
 */
class Indicador7 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indicador7';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'stand'], 'required'],
            [['tipo', 'stand'], 'string', 'max' => 50],
            [['tipo', 'stand'], 'unique', 'targetAttribute' => ['tipo', 'stand']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipo' => 'Tipo',
            'stand' => 'Stand',
        ];
    }
}
