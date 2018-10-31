<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Graficotarifa */

$this->title = 'Update Graficotarifa: ' . $model->tipo;
$this->params['breadcrumbs'][] = ['label' => 'Graficotarifas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo, 'url' => ['view', 'id' => $model->tipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="graficotarifa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
