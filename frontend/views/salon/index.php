<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\salonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salon';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-index">

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Crear Salon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_salon',
            //'id_socio',
            'nombre_salon',
            'ocupacion_salon',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],
        ],
    ]); ?>
</div>
