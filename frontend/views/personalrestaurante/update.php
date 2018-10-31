<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalrestaurante */

$this->title = 'Update Personalrestaurante: ' . $model->fecha_personal;
$this->params['breadcrumbs'][] = ['label' => 'Personalrestaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fecha_personal, 'url' => ['view', 'fecha_personal' => $model->fecha_personal, 'id_restaurante' => $model->id_restaurante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personalrestaurante-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
