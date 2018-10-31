<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\models\changeusername */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Cambiar username';
?>

<div class="changeusername-form col-md-6">
    <?php if (Yii::$app->session->hasFlash('myflash')): ?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('myflash') ?>
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(User::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio])->asArray()->all(), 'username', 'username'),
            'options' => ['placeholder' => 'Seleccione un usuario','id' => 'zipCode'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]) 
    ?>

    <?= $form->field($model, 'new_username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>