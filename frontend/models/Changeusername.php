<?php

namespace frontend\models;
use dektrium\user\models\User;

use Yii;

/**
 * This is the model class for table "changeusername".
 *
 * @property string $usuario
 * @property string $new_username
 */
class Changeusername extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'changeusername';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'new_username'], 'required'],
            [['usuario', 'new_username'], 'string', 'max' => 100],
            [['usuario', 'new_username'], 'unique', 'targetAttribute' => ['usuario', 'new_username']],
            [['usuario'], 'validacion'],
        ];
    }

    public function validacion()
    {
        $user = User::find()->where(['username' => $this->new_username])->all();
        if (count($user) > 0)
            $this->addError('new_username', 'El usuario ya se encuentra registrado');
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario' => 'Usuario',
            'new_username' => 'Nuevo Username',
        ];
    }
}
