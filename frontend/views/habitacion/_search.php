<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\habitacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="habitacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fechahab') ?>

    <?= $form->field($model, 'idhotel') ?>

    <?= $form->field($model, 'tarifahabitacion') ?>

    <?= $form->field($model, 'cantidadhabitacion') ?>

    <?php // echo $form->field($model, 'ocupacion') ?>

    <?php // echo $form->field($model, 'id_socio') ?>

    <?php // echo $form->field($model, 'mes_habitacion') ?>

    <?php // echo $form->field($model, 'año_habitacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
