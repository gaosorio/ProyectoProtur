<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\centrodeeventos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centrodeeventos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_centro')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <?= $form->field($model, 'nombre_centro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estacionamientos_centro')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
