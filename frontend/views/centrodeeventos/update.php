<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\centrodeeventos */

$this->title = 'Update Centrodeeventos: ' . $model->id_centro;
$this->params['breadcrumbs'][] = ['label' => 'Centrodeeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_centro, 'url' => ['view', 'id' => $model->id_centro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="centrodeeventos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
