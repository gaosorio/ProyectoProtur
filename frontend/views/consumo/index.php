<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\consumoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consumo-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Consumo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_restaurante',
            'fecha_consumo',
            //'mes_consumo',
            //'año_consumo',
            'consumo_promedio',
            //'id_socio',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],
        ],
    ]); ?></div>
</div>
