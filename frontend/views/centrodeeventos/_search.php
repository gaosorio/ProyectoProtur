<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\centrodeeventosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centrodeeventos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_centro') ?>

    <?= $form->field($model, 'id_socio') ?>

    <?= $form->field($model, 'nombre_centro') ?>

    <?= $form->field($model, 'estacionamientos_centro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
