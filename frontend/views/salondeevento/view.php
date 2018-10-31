<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\salondeevento */

$this->title = $model->tipo_salon;
$this->params['breadcrumbs'][] = ['label' => 'Salondeeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salondeevento-view">


    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'tipo_salon' => $model->tipo_salon, 'id_centro' => $model->id_centro, 'fecha_salon' => $model->fecha_salon], ['class' => 'btn btn-warning']) ?>
     </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tipo_salon',
            //'id_socio',
            'id_centro',
            'fecha_salon',
            //'mes_salon',
            //'ano_salon',
            //'tasaocupacion_salon',
            'valorreal_salon',
        ],
    ]) ?>

</div>
