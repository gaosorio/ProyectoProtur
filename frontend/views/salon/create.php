<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\salon */

$this->title = 'Crear Salon';
$this->params['breadcrumbs'][] = ['label' => 'Salons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
