<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\servicioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tipo_servicio') ?>

    <?= $form->field($model, 'fecha_servicio') ?>

    <?= $form->field($model, 'mes_servicio') ?>

    <?= $form->field($model, 'año_servicio') ?>

    <?= $form->field($model, 'id_restaurante') ?>

    <?php // echo $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'id_socio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
