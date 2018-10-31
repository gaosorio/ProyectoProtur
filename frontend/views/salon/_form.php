<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model frontend\models\salon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_salon')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <?= $form->field($model, 'nombre_salon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ocupacion_salon')->widget(Select2::classname(), [
            'data' => ['10-50'=>'10-50','51-100'=>'51-100','101-200'=>'101-200','201-400'=>'201-400', '400+' => '400+'],
            'options' => ['placeholder' => 'Seleccione una opcion ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
