<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Evento */

$this->title = $model->tipo_evento;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'tipo_evento' => $model->tipo_evento, 'id_centro' => $model->id_centro, 'fecha_evento' => $model->fecha_evento], ['class' => 'btn btn-warning']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tipo_evento',
            //'mes_evento',
            //'ano_evento',
            'id_centro',
            'fecha_evento',
            //'dimension_evento',
            'cantida_de_ventos',
            'personas_atendidas_evento',
            //'id_socio',
        ],
    ]) ?>

</div>
