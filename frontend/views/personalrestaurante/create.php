<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\personalrestaurante */

$this->title = 'Crear Personal Restaurante';
$this->params['breadcrumbs'][] = ['label' => 'Personalrestaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalrestaurante-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
