<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalrestauranteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personalrestaurante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fecha_personal') ?>

    <?= $form->field($model, 'mes_personal') ?>

    <?= $form->field($model, 'año_personal') ?>

    <?= $form->field($model, 'id_restaurante') ?>

    <?= $form->field($model, 'personal_fijo') ?>

    <?php // echo $form->field($model, 'personal_partime') ?>

    <?php // echo $form->field($model, 'id_socio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
