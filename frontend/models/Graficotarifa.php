<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "graficotarifa".
 *
 * @property int $tipo
 */
class Graficotarifa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graficotarifa';
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
