<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalh */

$this->title = 'Update Personal: ' . $model->fechap;
$this->params['breadcrumbs'][] = ['label' => 'Personal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fechap, 'url' => ['view', 'fechap' => $model->fechap, 'idhotel' => $model->idhotel]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personalh-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
