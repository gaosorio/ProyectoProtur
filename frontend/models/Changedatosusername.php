<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "changedatosusername".
 *
 * @property string $usuario
 * @property string $cargo
 * @property string $nombre
 * @property string $socio
 */
class Changedatosusername extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'changedatosusername';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario','cargo', 'nombre', 'socio'], 'required'],
            [['usuario', 'cargo', 'nombre', 'socio'], 'string', 'max' => 100],
            [['usuario'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario' => 'Usuario',
            'cargo' => 'Cargo',
            'nombre' => 'Nombre',
            'socio' => 'Socio',
        ];
    }
}
