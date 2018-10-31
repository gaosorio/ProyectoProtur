<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\changedatosusernameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="changedatosusername-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usuario') ?>

    <?= $form->field($model, 'cargo') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'socio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
