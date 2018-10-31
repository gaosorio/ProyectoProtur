<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\personalrestaurante */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personalrestaurante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_personal')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('app', 'Seleccione una Fecha')],
                    'attribute2'=>'to_date',
                    'readonly' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'startView'=>'year',
                        'minViewMode'=>'months',
                        'format' => 'mm-yyyy'
                    ]
                ]) ?>

    <?= $form->field($model, 'mes_personal')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'año_personal')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_restaurante')->textInput(['readonly'=>true,'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'personal_fijo')->textInput() ?>

    <?= $form->field($model, 'personal_partime')->textInput() ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
