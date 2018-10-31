<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\consumo */

$this->title = $model->id_restaurante;
$this->params['breadcrumbs'][] = ['label' => 'Consumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consumo-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'id_restaurante' => $model->id_restaurante, 'fecha_consumo' => $model->fecha_consumo], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_restaurante',
            'fecha_consumo',
            //'mes_consumo',
            //'año_consumo',
            'consumo_promedio',
            //'id_socio',
        ],
    ]) ?>

</div>
