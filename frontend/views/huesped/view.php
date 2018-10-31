<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\huesped */

$this->title = $model->fechah;
$this->params['breadcrumbs'][] = ['label' => 'Huespeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huesped-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'fechah' => $model->fechah, 'idhotel' => $model->idhotel], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fechah',
            'idhotel',
            'extranjeros',
            'nacionales',
            'estadiapromedio',
            //'id_socio',
            //'mes_huesped',
            //'año_huesped',
        ],
    ]) ?>

</div>
