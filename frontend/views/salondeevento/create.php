<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\salondeevento */

$this->title = 'Crear Salon de evento';
$this->params['breadcrumbs'][] = ['label' => 'Salondeeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salondeevento-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
