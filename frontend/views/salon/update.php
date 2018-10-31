<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\salon */

$this->title = 'Update Salon: ' . $model->id_salon;
$this->params['breadcrumbs'][] = ['label' => 'Salons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_salon, 'url' => ['view', 'id_salon' => $model->id_salon, 'nombre_salon' => $model->nombre_salon]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
