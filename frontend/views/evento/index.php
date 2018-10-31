<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">
    <p>
        <?= Html::a('<i class="fa fa-fw fa-plus"></i> Crear Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tipo_evento',
            //'mes_evento',
            //'ano_evento',
            'id_centro',
            'fecha_evento',
            //'dimension_evento',
            'cantida_de_ventos',
            'personas_atendidas_evento',
            //'id_socio',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],
        ],
    ]); ?>
</div>
