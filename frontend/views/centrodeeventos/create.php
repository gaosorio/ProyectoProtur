<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\centrodeeventos */

$this->title = 'Crear Centro de eventos';
$this->params['breadcrumbs'][] = ['label' => 'Centrodeeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrodeeventos-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
