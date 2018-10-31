<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\changepasswordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="changepassword-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usuario') ?>

    <?= $form->field($model, 'pass_actual') ?>

    <?= $form->field($model, 'pass_nuevo') ?>

    <?= $form->field($model, 'confir_pass_nuevo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
