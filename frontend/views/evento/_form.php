<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_evento')->widget(Select2::classname(), [
            'data' => ['Composicion Sociales'=>'Composicion Sociales','Congresos'=>'Congresos','Ferias'=>'Ferias','Corporativos'=>'Corportativos','Otros'=>'Otros'],
            'options' => ['placeholder' => 'Seleccione una opcion ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <?= $form->field($model, 'mes_evento')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'ano_evento')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_centro')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'fecha_evento')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'dimension_evento')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'cantida_de_ventos')->textInput() ?>

    <?= $form->field($model, 'personas_atendidas_evento')->textInput() ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
