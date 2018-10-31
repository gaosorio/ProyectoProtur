<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\huesped */

$this->title = 'Crear Huesped';
$this->params['breadcrumbs'][] = ['label' => 'Huesped', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huesped-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
