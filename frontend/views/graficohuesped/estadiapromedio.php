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

    $this->title = 'Gráfico: Estadía promedio';
    $this->params['breadcrumbs'][] = 'Estadía promedio'
?>
<br>

	<?php
 if($fechasSocio >0){
echo Highcharts::widget([
   'options' => [
      'credits' => ['enabled' => false],
      'title' => ['text' => 'Estadía promedio huéspedes'],
      'xAxis' => [
         'categories' => $fechasSocio
      ],
      'yAxis' => [
         'title' => ['text' => 'Días']
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

