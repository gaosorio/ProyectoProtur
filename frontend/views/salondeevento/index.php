<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\salondeeventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salon de eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salondeevento-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Salon de evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tipo_salon',
            //'id_socio',
            'id_centro',
            'fecha_salon',
            //'mes_salon',
            //'ano_salon',
            //'tasaocupacion_salon',
            'valorreal_salon',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],
        ],
    ]); ?>
</div>
