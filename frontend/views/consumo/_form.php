<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\consumo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consumo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_restaurante')->textInput(['readonly'=>true,'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'fecha_consumo')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'mes_consumo')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'año_consumo')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'consumo_promedio')->textInput() ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
