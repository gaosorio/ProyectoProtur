<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\GraficoPais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grafico-pais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
