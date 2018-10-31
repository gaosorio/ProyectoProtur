<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalrestaurante */

$this->title = $model->fecha_personal;
$this->params['breadcrumbs'][] = ['label' => 'Personalrestaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalrestaurante-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'fecha_personal' => $model->fecha_personal, 'id_restaurante' => $model->id_restaurante], ['class' => 'btn btn-warning']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fecha_personal',
            //'mes_personal',
            //'año_personal',
            'id_restaurante',
            'personal_fijo',
            'personal_partime',
            //'id_socio',
        ],
    ]) ?>

</div>
