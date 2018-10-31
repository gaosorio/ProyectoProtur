<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\GraficoPais */

$this->title = 'Update Grafico Pais: ' . $model->pais;
$this->params['breadcrumbs'][] = ['label' => 'Grafico Pais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pais, 'url' => ['view', 'id' => $model->pais]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grafico-pais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
