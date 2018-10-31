<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\consumo */

$this->title = 'Crear Consumo';
$this->params['breadcrumbs'][] = ['label' => 'Consumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consumo-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
