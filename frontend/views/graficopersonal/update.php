<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Graficopersonal */

$this->title = 'Update Graficopersonal: ' . $model->tipo;
$this->params['breadcrumbs'][] = ['label' => 'Graficopersonals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo, 'url' => ['view', 'id' => $model->tipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="graficopersonal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
