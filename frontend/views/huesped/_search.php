<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\huespedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="huesped-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fechah') ?>

    <?= $form->field($model, 'idhotel') ?>

    <?= $form->field($model, 'extranjeros') ?>

    <?= $form->field($model, 'nacionales') ?>

    <?= $form->field($model, 'estadiapromedio') ?>

    <?php // echo $form->field($model, 'id_socio') ?>

    <?php // echo $form->field($model, 'mes_huesped') ?>

    <?php // echo $form->field($model, 'año_huesped') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
