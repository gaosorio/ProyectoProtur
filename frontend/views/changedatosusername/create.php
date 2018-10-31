<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;
/* @var $this yii\web\View */
/* @var $model frontend\models\changedatosusername */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Cambiar datos usuarios';
?>

<div class="changedatosusername-form col-md-6">
    <?php if (Yii::$app->session->hasFlash('myflash')): ?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('myflash') ?>
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(User::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio])->asArray()->all(), 'username', 'username'),
            'options' => ['placeholder' => 'Seleccione un usuario','id' => 'zipCode'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true,'id' => 'my_id2']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true,'id' => 'my_id']) ?>

    <?= $form->field($model, 'socio')->textInput(['maxlength' => true,'id' => 'my_id3']) ?>

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
            $('#my_id').attr('value',data.usuario);
            $('#my_id2').attr('value',data.cargo);
            $('#my_id3').attr('value',data.socio);
        });
    });
JS;
$this->registerJS($script);
?>