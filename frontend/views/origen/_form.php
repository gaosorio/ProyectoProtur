<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model frontend\models\Origen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="origen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'id_hotel')->textInput(['readonly'=>true,'value' => Yii::$app->user->identity->id_socio]) ?>           

    <?= $form->field($model, 'pais')->widget(Select2::classname(), [
            'data' => ['Argentina'=>'Argentina','Brasil'=>'Brasil','Norteamerica'=>'Norteamerica','Asia'=>'Asia',
        	'Europa' => 'Europa','Otros Sudamerica'=>'Otros Sudamerica'],
            'options' => ['placeholder' => 'Seleccione una opción'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'id_socio')->hiddenInput(['value' => Yii::$app->user->identity->id_socio])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
