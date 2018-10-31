<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "graficohuesped".
 *
 * @property string $tipo
 */
class Graficohuesped extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graficohuesped';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'default', 'value' => null],
            [['tipo'], 'string'],
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
