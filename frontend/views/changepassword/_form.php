<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\changepassword */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="changepassword-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass_actual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass_nuevo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confir_pass_nuevo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
