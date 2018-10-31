<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\salonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salon-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_salon') ?>

    <?= $form->field($model, 'id_socio') ?>

    <?= $form->field($model, 'nombre_salon') ?>

    <?= $form->field($model, 'ocupacion_salon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
