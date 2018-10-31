<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personalce-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fecha_personal_ce') ?>

    <?= $form->field($model, 'mes_personal_ce') ?>

    <?= $form->field($model, 'ano_personal_ce') ?>

    <?= $form->field($model, 'id_centro') ?>

    <?= $form->field($model, 'id_socio') ?>

    <?php // echo $form->field($model, 'personalfijo_personal_ce') ?>

    <?php // echo $form->field($model, 'personalparttime_personal_ce') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
