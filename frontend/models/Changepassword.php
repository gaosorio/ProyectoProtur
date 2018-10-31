<?php

namespace frontend\models;
use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "change_password".
 *
 * @property string $usuario
 * @property string $pass_actual
 * @property string $pass_nuevo
 * @property string $confir_pass_nuevo
 */
class ChangePassword extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'changepassword';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'pass_actual', 'pass_nuevo', 'confir_pass_nuevo'], 'required'],
            [['usuario', 'pass_actual', 'pass_nuevo', 'confir_pass_nuevo'], 'string', 'max' => 100],
            ['confir_pass_nuevo', 'compare', 'compareAttribute'=>'pass_nuevo', 'message'=>"Las contraseñas no coinciden" ],
            [['pass_actual'], 'validar'],
        ];
    }

    public function validar()
    {
        $user = User::find()->where(['username' => $this->usuario])->all();
        $cantidadTipo = array();
        for ($i = 0; $i < sizeof($user); $i++)
        {
            $cantidadTipo[$i] = $user[$i]["password_hash"];
        }
        if (!password_verify($this->pass_actual, $cantidadTipo[0]))
            $this->addError('pass_actual', 'La contraseña actual es incorrecta.');
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario' => 'Usuario',
            'pass_actual' => 'Contraseña Actual',
            'pass_nuevo' => 'Nueva Contraseña',
            'confir_pass_nuevo' => 'Confirmar nueva contraseña',
        ];
    }
}
