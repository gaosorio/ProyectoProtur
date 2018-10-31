<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalce */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personalce-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_personal_ce')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'mes_personal_ce')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'ano_personal_ce')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_centro')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <?= $form->field($model, 'personalfijo_personal_ce')->textInput() ?>

    <?= $form->field($model, 'personalparttime_personal_ce')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
