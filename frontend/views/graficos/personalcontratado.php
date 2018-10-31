<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;
use frontend\models\servicio;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use frontend\models\personalrestaurante;

$this->title = 'Gráfico: Cantidad de Personal Contratado';
?>
<?php Pjax::begin(); ?>
<div class="grafico1-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true,'class' => 'form-vertical' ]]); ?>
    <div class="row">
    	<div class="col-md-3">
        <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
            'data' => ['personal_fijo'=>'Personal Fijo','personal_partime'=>'Personal Part-Time'],
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
<div class="my-example">
  <?php 
  if($cantidades>0)
  {
    $tipo = array();
    if ($model->tipo == 'personal_fijo')
    {
        $tipo = 'Personal Fijo';
    }
    elseif ($model->tipo == 'personal_partime') 
    {
        $tipo = 'Personal Part-Time';
    }
    echo Highcharts::widget([
     'options' => [
      'credits' => ['enabled' => false],
        'title' => ['text' => $tipo.' / Mes '],
        'scales' => [
                'xAxis' => [
                    [
                        'scaleLabel' => [
                            'display' => 'true',
                            'labelString' => 'level'
                        ]
                    ]
                ],],
        'xAxis' => [
           'categories' => $meses
        ],
        'yAxis' => [
           'title' => ['text' => 'Cantidad Personal Contratado']
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
