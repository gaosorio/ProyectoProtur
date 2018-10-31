<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\personalceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal Centro de eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalce-index">

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Personal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fecha_personal_ce',
            //'mes_personal_ce',
            //'ano_personal_ce',
            'id_centro',
            //'id_socio',
            'personalfijo_personal_ce',
            'personalparttime_personal_ce',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}',],
        ],
    ]); ?></div>
</div>
