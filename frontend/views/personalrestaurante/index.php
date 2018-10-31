<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\personalrestauranteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal Restaurante';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalrestaurante-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Personal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fecha_personal',
            //'mes_personal',
            //'año_personal',
            'id_restaurante',
            'personal_fijo',
            'personal_partime',
            //'id_socio',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
