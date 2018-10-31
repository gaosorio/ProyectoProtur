<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\habitacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Habitaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitacion-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Habitacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fechahab',
            'idhotel',
            'tarifahabitacion',
            'cantidadhabitacion',
            'ocupacion',
            //'id_socio',
            //'mes_habitacion',
            //'año_habitacion',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
