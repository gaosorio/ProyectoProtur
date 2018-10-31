<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\hotel */

$this->title = 'Actualizar Hotel: ' . $model->idhotel;
$this->params['breadcrumbs'][] = ['label' => 'Hotel', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idhotel, 'url' => ['view', 'id' => $model->idhotel]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="hotel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
