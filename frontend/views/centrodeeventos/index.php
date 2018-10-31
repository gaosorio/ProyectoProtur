<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\centrodeeventosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Centro de Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrodeeventos-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Centro de Eventos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_centro',
            //'id_socio',
            'nombre_centro',
            //'estacionamientos_centro',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?>
</div>
