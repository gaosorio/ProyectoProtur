<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrigenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="origen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'pais') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'id_socio') ?>

    <?= $form->field($model, 'id_hotel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
