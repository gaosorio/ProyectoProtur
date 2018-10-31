<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "indicador8".
 *
 * @property string $tipo
 */
class Indicador8 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indicador8';
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
