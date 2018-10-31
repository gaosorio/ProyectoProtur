<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\huesped */

$this->title = 'Actualizar Huesped: ' . $model->fechah;
$this->params['breadcrumbs'][] = ['label' => 'Huesped', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fechah, 'url' => ['view', 'fechah' => $model->fechah, 'idhotel' => $model->idhotel]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="huesped-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
