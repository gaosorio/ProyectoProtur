<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
/* @var $model frontend\models\GraficoPais */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Paises de origen';
$this->params['breadcrumbs'][] = ['label' => 'Países', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="grafico-pais-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    	<div class="col-md-3">
    <?= $form->field($model, 'pais')->widget(Select2::classname(), [
            'data' => ['Argentina'=>'Argentina','Brasil'=>'Brasil','Norteamerica'=>'Norteamerica','Asia'=>'Asia',
        	'Europa' => 'Europa','Otros Sudamerica'=>'Otros Sudamerica'],
            'options' => ['placeholder' => 'Seleccione un país de origen'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); ?>
    </div>
    <div class="col-md-3">
        <?= Html::submitButton('<i class="fa fa-search"></i> Buscar', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>

</div>

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
    
