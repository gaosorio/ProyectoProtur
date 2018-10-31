<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\servicio */

$this->title = 'Update Servicio: ' . $model->tipo_servicio;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo_servicio, 'url' => ['view', 'tipo_servicio' => $model->tipo_servicio, 'fecha_servicio' => $model->fecha_servicio, 'id_restaurante' => $model->id_restaurante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicio-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
