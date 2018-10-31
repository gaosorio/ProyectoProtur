<?php
    
    use miloschuman\highcharts\Highcharts;
    use yii\helpers\Html;
    use frontend\models\consumoycostos;

    $this->title = 'Gráfico: Consumo Promedio';
?>

<div class="my-example">

<?php
  if($cantidades>0)
  {
    echo Highcharts::widget([
     'options' => [
        'credits' => ['enabled' => false],
        'title' => ['text' => 'Consumo Promedio / Mes'],
        'xAxis' => [
           'categories' => $fechas
        ],
        'yAxis' => [
           'title' => ['text' => 'Cantidad']
        ],
        'series' => $cantidades
        ]]);
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