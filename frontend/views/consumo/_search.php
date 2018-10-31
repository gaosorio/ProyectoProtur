<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\consumoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consumo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_restaurante') ?>

    <?= $form->field($model, 'fecha_consumo') ?>

    <?= $form->field($model, 'mes_consumo') ?>

    <?= $form->field($model, 'año_consumo') ?>

    <?= $form->field($model, 'consumo_promedio') ?>

    <?php // echo $form->field($model, 'id_socio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
