<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\salon */

$this->title = $model->id_salon;
$this->params['breadcrumbs'][] = ['label' => 'Salons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-view">


    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'id_salon' => $model->id_salon, 'nombre_salon' => $model->nombre_salon], ['class' => 'btn btn-warning']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_salon',
            //'id_socio',
            'nombre_salon',
            'ocupacion_salon',
        ],
    ]) ?>

</div>
