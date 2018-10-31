<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalce */

$this->title = 'Update Personalce: ' . $model->fecha_personal_ce;
$this->params['breadcrumbs'][] = ['label' => 'Personalces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fecha_personal_ce, 'url' => ['view', 'fecha_personal_ce' => $model->fecha_personal_ce, 'id_centro' => $model->id_centro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personalce-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
