<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\huespedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Huesped';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huesped-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Huesped', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fechah',
            'idhotel',
            'extranjeros',
            'nacionales',
            'estadiapromedio',
            //'id_socio',
            //'mes_huesped',
            //'año_huesped',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
