<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\consumo */

$this->title = 'Update Consumo: ' . $model->id_restaurante;
$this->params['breadcrumbs'][] = ['label' => 'Consumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_restaurante, 'url' => ['view', 'id_restaurante' => $model->id_restaurante, 'fecha_consumo' => $model->fecha_consumo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consumo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
