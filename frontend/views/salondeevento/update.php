<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\salondeevento */

$this->title = 'Update Salondeevento: ' . $model->tipo_salon;
$this->params['breadcrumbs'][] = ['label' => 'Salondeeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo_salon, 'url' => ['view', 'tipo_salon' => $model->tipo_salon, 'id_centro' => $model->id_centro, 'fecha_salon' => $model->fecha_salon]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salondeevento-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
