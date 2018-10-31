<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $model frontend\models\Graficopersonal */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Gráfico: Personal Contratado';
?>

<div class="graficopersonal-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    	<div class="col-md-3">
    <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
            //'data' => ArrayHelper::map(TipoHabitacion::find()->all(),'idtipo','tipohabitacion'),
            'data'=>['Personal fijo'=>'Personal fijo','Personal part time'=>'Personal part time'],
            //'hideSearch' => true,
            'options' => ['placeholder' => 'Seleccione un tipo de personal'],
            'pluginOptions' => [
                'allowClear' => true
                //,'width' => '200px',
            ],
        ])->label(false); ?>
	</div>
    <div class="col-md-3">
        <?= Html::submitButton('<i class="fa fa-search"></i> Buscar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div>
<?php
 if($fechasSocio >0){
echo Highcharts::widget([
   'options' => [
      'credits' => ['enabled' => false],
      'title' => ['text' => 'Personal'],
      'xAxis' => [
         'categories' => $fechasSocio
      ],
      'yAxis' => [
         'title' => ['text' => 'Cantidad personal']
      ],
      'series' => $b
   ]
]);
}else {
if($fechasSocio == -1){
 ?>
 <BR>
            <div class="alert alert-danger alert-dismissable" style="width:60%;">
                <button type="button" class="close" data-dismiss="alert" >&times;</button>
                <strong>Error!</strong> No se han encontrado resultados. Intente cambiar su consulta
            </div><?php 
}
}
?>
</div>
