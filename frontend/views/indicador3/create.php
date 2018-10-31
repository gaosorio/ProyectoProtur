<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;
use frontend\models\Evento;
use frontend\models\Salon;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\indicador1 */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Gráfico: Tasa Ocupación Salón';

?>


<?php Pjax::begin(); ?>

<div class="indicador1-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true,'class' => 'form-vertical' ]]); ?>
    <div class="row">
    	<div class="col-md-3">
    <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Salon::find()->where(['id_socio'=>Yii::$app->user->identity->id_socio])->asArray()->all(), 'nombre_salon', 'nombre_salon'),
            'options' => ['placeholder' => 'Seleccione un salon','id' => 'zipCode'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label(false) ?>
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
    echo Highcharts::widget([
     'options' => [
      'credits' => ['enabled' => false],
        'title' => ['text' => 'Tasa de ocupación / Mes '],
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
           'title' => ['text' => 'Cantidad segun capacidad espacio']
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