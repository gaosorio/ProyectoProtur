<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\indicador3 */

$this->title = 'Update Indicador3: ' . $model->tipo;
$this->params['breadcrumbs'][] = ['label' => 'Indicador3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo, 'url' => ['view', 'id' => $model->tipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="indicador3-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
