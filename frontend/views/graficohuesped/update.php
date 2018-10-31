<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Graficohuesped */

$this->title = 'Update Graficohuesped: ' . $model->tipo;
$this->params['breadcrumbs'][] = ['label' => 'Graficohuespeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo, 'url' => ['view', 'id' => $model->tipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="graficohuesped-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
