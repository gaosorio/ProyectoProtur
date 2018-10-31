<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;
use frontend\models\servicio;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
$this->title = 'Gráfico: Personas Atendidas';
?>

<?php Pjax::begin(); ?>
<div class="grafico1-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true,'class' => 'form-vertical' ]]); ?>
    <div class="row">
    	<div class="col-md-3">
        <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
            'data' => ['Desayuno'=>'Desayuno','Almuerzo'=>'Almuerzo','Cena'=>'Cena'],
            //'hideSearch' => true,
            'options' => ['placeholder' => 'Seleccione un tipo de servicio'],
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
<div class="my-example">
  <?php 
  if($cantidades>0)
  {
    $tipo = array();
    if ($model->tipo == 'Desayuno')
    {
        $tipo = 'al Desayuno';
    }
    elseif ($model->tipo == 'Almuerzo') 
    {
        $tipo = 'al Almuerzo';
    }
    elseif ($model->tipo == 'Cena') 
    {
        $tipo = 'en la Cena';
    }
    echo Highcharts::widget([
     'options' => [
      'credits' => ['enabled' => false],
        'title' => ['text' => 'Personas Atendidas '.$tipo.' / Mes '],
        'xAxis' => [
           'categories' => $meses
        ],
        'yAxis' => [
           'title' => ['text' => 'Cantidad Personas Atendidas']
        ],
        'lineTension' => 0.8,
        'series' => $cantidades
        ]
     ]);
    }
    else
    {
        if($cantidades == -1)
        {
            ?><BR>
            <div class="alert alert-danger alert-dismissable" style="width:60%;">
                <button type="button" class="close" data-dismiss="alert" >&times;</button>
                <strong>¡Error!</strong> No se han encontrado resultados. Intente cambiar su consulta
            </div>
            <?php
        }
    }
  ?>
</div>
<?php Pjax::end(); ?>