<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\hotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Hotel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idhotel',
            'nombrehotel',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
