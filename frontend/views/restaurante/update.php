<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\restaurante */

$this->title = 'Update Restaurante: ' . $model->id_restaurante;
$this->params['breadcrumbs'][] = ['label' => 'Restaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_restaurante, 'url' => ['view', 'id' => $model->id_restaurante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="restaurante-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
