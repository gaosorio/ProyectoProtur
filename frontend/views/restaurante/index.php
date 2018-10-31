<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\restauranteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Restaurantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurante-index">

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Crear Restaurante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_restaurante',
            'nombre_restaurante',
            //'id_socio',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
