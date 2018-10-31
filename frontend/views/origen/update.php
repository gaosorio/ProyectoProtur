<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Origen */

$this->title = 'Actualizar Origen: ' . $model->fecha;
$this->params['breadcrumbs'][] = ['label' => 'Países de origen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fecha, 'url' => ['view', 'fecha' => $model->fecha, 'pais' => $model->pais]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="origen-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
