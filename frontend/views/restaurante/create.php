<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\restaurante */

$this->title = 'Crear Restaurante';
$this->params['breadcrumbs'][] = ['label' => 'Restaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurante-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
