<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Habitacion;
use frontend\models\TipoHabitacion;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Graficotarifa */
/* @var $form yii\widgets\ActiveForm */

    $this->title = 'Gráfico: Composición huéspedes';
    $this->params['breadcrumbs'][] = $this->title
?>

<div class="graficotarifa-form">

   <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    	<div class="col-md-3">
    <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
            //'data' => ArrayHelper::map(TipoHabitacion::find()->all(),'idtipo','tipohabitacion'),
            'data'=>['Nacionales'=>'Nacionales','Extranjeros'=>'Extranjeros'],
            //'hideSearch' => true,
            'options' => ['placeholder' => 'Seleccione tipo de huésped'],
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
      'title' => ['text' => 'Composición de huéspedes'],
      'xAxis' => [
         'categories' => $fechasSocio
      ],
      'yAxis' => [
         'title' => ['text' => 'Porcentaje']
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
                <strong>�Error!</strong> No se han encontrado resultados. Intente cambiar su consulta
            </div><?php 
}
}
?>
</div>
