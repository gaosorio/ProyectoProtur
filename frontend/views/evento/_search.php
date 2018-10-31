<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tipo_evento') ?>

    <?= $form->field($model, 'mes_evento') ?>

    <?= $form->field($model, 'ano_evento') ?>

    <?= $form->field($model, 'id_centro') ?>

    <?= $form->field($model, 'fecha_evento') ?>

    <?php // echo $form->field($model, 'dimension_evento') ?>

    <?php // echo $form->field($model, 'cantida_de_ventos') ?>

    <?php // echo $form->field($model, 'personas_atendidas_evento') ?>

    <?php // echo $form->field($model, 'id_socio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
