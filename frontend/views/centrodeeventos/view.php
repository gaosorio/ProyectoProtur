<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\centrodeeventos */

$this->title = $model->id_centro;
$this->params['breadcrumbs'][] = ['label' => 'Centrodeeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrodeeventos-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'id' => $model->id_centro], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_centro',
            //'id_socio',
            'nombre_centro',
            //'estacionamientos_centro',
        ],
    ]) ?>

</div>
