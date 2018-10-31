<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Evento */

$this->title = 'Update Evento: ' . $model->tipo_evento;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo_evento, 'url' => ['view', 'tipo_evento' => $model->tipo_evento, 'id_centro' => $model->id_centro, 'fecha_evento' => $model->fecha_evento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evento-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
