<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\huesped */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="huesped-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fechah')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'idhotel')->textInput(['readonly'=>true,'value' => Yii::$app->user->identity->id_socio]) ?>

    <?= $form->field($model, 'extranjeros')->textInput() ?>

    <?= $form->field($model, 'nacionales')->textInput() ?>

    <?= $form->field($model, 'estadiapromedio')->textInput() ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <?= $form->field($model, 'mes_huesped')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'año_huesped')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
