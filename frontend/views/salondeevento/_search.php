<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\salondeeventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salondeevento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tipo_salon') ?>

    <?= $form->field($model, 'id_socio') ?>

    <?= $form->field($model, 'id_centro') ?>

    <?= $form->field($model, 'fecha_salon') ?>

    <?= $form->field($model, 'mes_salon') ?>

    <?php // echo $form->field($model, 'ano_salon') ?>

    <?php // echo $form->field($model, 'tasaocupacion_salon') ?>

    <?php // echo $form->field($model, 'valorreal_salon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
