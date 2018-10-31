<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Origen */

$this->title = $model->fecha;
$this->params['breadcrumbs'][] = ['label' => 'Países de origen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'fecha' => $model->fecha, 'pais' => $model->pais], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fecha',
            'pais',
            'cantidad',
            //'id_socio',
            'id_hotel',
        ],
    ]) ?>

</div>
