<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\habitacion */

$this->title = $model->fechahab;
$this->params['breadcrumbs'][] = ['label' => 'Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitacion-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'fechahab' => $model->fechahab, 'idhotel' => $model->idhotel], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fechahab',
            'idhotel',
            'tarifahabitacion',
            'cantidadhabitacion',
            'ocupacion',
            //'id_socio',
            //'mes_habitacion',
            //'año_habitacion',
        ],
    ]) ?>

</div>
