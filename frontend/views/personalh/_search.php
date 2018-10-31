<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personalh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fechap') ?>

    <?= $form->field($model, 'idhotel') ?>

    <?= $form->field($model, 'personalfijo') ?>

    <?= $form->field($model, 'personalparttime') ?>

    <?= $form->field($model, 'id_socio') ?>

    <?php // echo $form->field($model, 'mes_personal') ?>

    <?php // echo $form->field($model, 'año_personal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
