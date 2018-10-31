<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "graficopersonal".
 *
 * @property string $tipo
 */
class Graficopersonal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graficopersonal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 25],
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
