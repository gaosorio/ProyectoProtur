<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use frontend\models\Salon;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\salondeevento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salondeevento-form">


    <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'tipo_salon')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Salon::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio])->asArray()->all(), 'nombre_salon', 'nombre_salon'),
            'options' => ['placeholder' => 'Seleccione un salon','id' => 'zipCode'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])  ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <?= $form->field($model, 'id_centro')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'fecha_salon')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'mes_salon')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'ano_salon')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'tasaocupacion_salon')->hiddenInput(['maxlength' => true,'id' => 'my_id2'])->label(false) ?>

    <?= $form->field($model, 'valorreal_salon')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

$('#zipCode').change(function(){
    var zipId = $(this).val();
    $.get('get',{ zipId: zipId }, function(data){
            var data = $.parseJSON(data);
            $('#my_id2').attr('value',data.ocupacion_salon);
        });
    });
JS;
$this->registerJS($script);
?>
