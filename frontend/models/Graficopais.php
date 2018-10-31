<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "graficopais".
 *
 * @property string $pais
 */
class Graficopais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graficopais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pais'], 'required'],
            [['pais'], 'string', 'max' => 15],
            [['pais'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pais' => 'Pais',
        ];
    }
}
