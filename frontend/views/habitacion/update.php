<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\habitacion */

$this->title = 'Update Habitacion: ' . $model->fechahab;
$this->params['breadcrumbs'][] = ['label' => 'Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fechahab, 'url' => ['view', 'fechahab' => $model->fechahab, 'idhotel' => $model->idhotel]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="habitacion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
