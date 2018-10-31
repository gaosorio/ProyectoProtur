<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model frontend\models\servicio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_servicio')->widget(Select2::classname(), [
            'data' => ['Desayuno'=>'Desayuno','Almuerzo'=>'Almuerzo','Cena'=>'Cena'],
            //'hideSearch' => true,
            'options' => ['placeholder' => 'Seleccione un tipo de servicio'],
            'pluginOptions' => [
                'allowClear' => true
                //,'width' => '200px',
            ],
        ])->label(false) ?>

    <?= $form->field($model, 'fecha_servicio')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'mes_servicio')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'año_servicio')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_restaurante')->textInput(['readonly'=>true,'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
