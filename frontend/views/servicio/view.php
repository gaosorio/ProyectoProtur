<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\servicio */

$this->title = $model->tipo_servicio;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicio-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'tipo_servicio' => $model->tipo_servicio, 'fecha_servicio' => $model->fecha_servicio, 'id_restaurante' => $model->id_restaurante], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tipo_servicio',
            'fecha_servicio',
            //'mes_servicio',
            //'año_servicio',
            'id_restaurante',
            'cantidad',
            //'id_socio',
        ],
    ]) ?>

</div>
