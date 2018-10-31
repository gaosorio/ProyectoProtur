<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrigenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Países de origen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Origen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fecha',
            'pais',
            'cantidad',
            //'id_socio',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
