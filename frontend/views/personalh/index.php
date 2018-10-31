<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\personalhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalh-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Personal hotel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fechap',
            'idhotel',
            'personalfijo',
            'personalparttime',
            //'id_socio',
            //'mes_personal',
            //'año_personal',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
